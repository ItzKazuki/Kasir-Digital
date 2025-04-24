<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\FonnteService;
use App\Traits\GenerateStrukPdf;
use Wavey\Sweetalert\Sweetalert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\RawbtPrintConnector;
use Mike42\Escpos\CapabilityProfile;

class TransactionController extends Controller
{
    use GenerateStrukPdf;

    protected $fonnteService;

    public function __construct(FonnteService $fonnteService)
    {
        $this->fonnteService = $fonnteService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Transactions";

        $query = Transaction::with('order');

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('orders.order_date', [$request->start_date, $request->end_date]);
        } else {
            // urutkan data $query berdasarkan asc dari order_date
            $query->join('orders', 'transactions.order_id', '=', 'orders.id')
                ->select('transactions.*', 'orders.order_date') // Pastikan memilih kolom yang dibutuhkan
                ->orderBy('orders.order_date', 'DESC')
                ->orderBy('transactions.id', 'DESC');
        }

        if ($request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        $transactions = $query->paginate(10)->appends(request()->query());

        $income = Transaction::where('payment_status', 'paid')->sum('cash');
        $outcome = Transaction::where('payment_status', 'paid')->sum('cash_change');


        return view('dashboard.transactions.index', compact('title', 'transactions', 'income', 'outcome'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function print(Request $request, Transaction $transaction)
    {
        try {
            // Load printer profile
            $profile = CapabilityProfile::load("SP2000");

            // Load transaction with related order and orderDetails
            $transaction->load('order.orderDetails.product');

            // Connect to RawBT
            $connector = new RawbtPrintConnector();

            // Initialize printer
            $printer = new Printer($connector, $profile);

            // Print shop details
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text(config('app.name') . "\n");
            $printer->selectPrintMode();
            $printer->text(config('app.address') . "\n");
            $printer->feed();

            // Print transaction details
            $printer->setEmphasis(true);
            $printer->text("Detail Transaksi\n");
            $printer->setEmphasis(false);
            $printer->setJustification(Printer::JUSTIFY_LEFT);

            foreach ($transaction->order->orderDetails as $item) {
                $printer->text($item->product->name . " x" . $item->quantity . " @ " . number_format($item->product->price, 0, ',', '.') . "\n");
            }

            $printer->feed();
            $printer->setEmphasis(true);
            $printer->text("Total: " . number_format($transaction->total_price, 0, ',', '.') . "\n");
            $printer->text("Dibayar: " . number_format($transaction->cash, 0, ',', '.') . "\n");
            $printer->text("Kembali: " . number_format($transaction->cash_change, 0, ',', '.') . "\n");
            $printer->setEmphasis(false);

            // Print footer
            $printer->feed(2);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Terima kasih telah berbelanja di " . config('app.name') . "\n");
            $printer->text("Tanggal: " . now()->format('d-m-Y H:i:s') . "\n");
            $printer->feed(2);

            // Print QR Code (optional)
            $printer->qrCode($transaction->struk_url, Printer::QR_ECLEVEL_M, 8);

            // Cut the receipt and open the cash drawer
            $printer->cut();
            $printer->pulse();

            // Close the printer connection
            $printer->close();

            return response()->json(['status' => 'success', 'message' => 'Struk berhasil dicetak.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function pdf(Request $request, Transaction $transaction)
    {
        $strukPath = Storage::disk('local')->path('/static/struk/' . $transaction->invoice_number . '.pdf');

        if (!file_exists($strukPath)) {
            if ($transaction->payment_status == 'unpaid' || $transaction->payment_status == 'pending') {
                return abort(402);
            }

            $this->generateStrukPdf($transaction);
        }

        return response()->download($strukPath);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $title = "Detail Transaction";
        return view('dashboard.transactions.show', compact('title', 'transaction'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        Sweetalert::success('berhasil menghapus transaction dengan nomor invoice: ' . $transaction->invoice_number, 'Hapus Berhasil');
        return redirect()->route('dashboard.transactions.index');
    }

    public function streamStruk(string $invoice)
    {
        $transaction = Transaction::findByInvoice($invoice)->first();

        if (!$transaction) {
            return abort(404);
        }

        // $strukPath = Storage::disk('local')->path('/static/struk/' . $transaction->invoice_number . '.pdf');

        // if (!file_exists($strukPath)) {
        //     return abort(404);
        // }

        // return response()->file($strukPath, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="' . $transaction->invoice_number . '.pdf"'
        // ]);

        return view('layouts.struk', compact('transaction'));
    }

    public function updateStatusPayment(Request $request, Transaction $transaction)
    {
        $request->validate([
            'payment_status' => 'required|in:unpaid,pending,paid'
        ]);

        $transaction->update([
            'payment_status' => $request->payment_status
        ]);

        Sweetalert::success('berhasil mengubah status pembayaran', 'Update Status Pembayaran');
        return redirect()->route('dashboard.transactions.show', $transaction);
    }

    public function sendWhatsappMessage(Request $request, Transaction $transaction)
    {
        // Validasi input untuk memastikan target dan pesan ada dan valid
        $request->validate([
            'phone'    => 'required|string',
        ]);

        // Ambil target dan pesan dari body request
        $target         = $request->input('phone');
        $message        = "Terimakasih telah berbelanja di " . config('app.name') . ". Struk dapat di akses disini " . route('struk.search', $transaction->invoice_number);
        // Kirim pesan menggunakan FonnteService
        $response = $this->fonnteService->sendWhatsAppMessage($target, $message);

        // Periksa apakah API Fonnte mengembalikan status false
        if (!$response['status'] || (isset($response['data']['status']) && !$response['data']['status'])) {
            // Jika terjadi error atau status false, kembalikan pesan error
            $errorReason = $response['data']['reason'] ?? 'Unknown error occurred';
            return response()->json(['message' => 'Error', 'error' => $errorReason], 500);
        }

        // Jika berhasil, kembalikan pesan sukses
        return response()->json([
            'status' => 'success',
            'message' => 'Pesan berhasil dikirim!',
            'data' => $response['data']
        ]);
    }
}
