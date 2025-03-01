<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusDiscount;
use App\Enums\TypeDiscount;
use App\Models\Discount;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Discounts";
        $discounts = Discount::all();
        return view('dashboard.discounts.index', compact('title', 'discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Discounts";
        return view('dashboard.discounts.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'type' => ['required', Rule::enum(TypeDiscount::class)],
            'value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => ['required', Rule::enum(StatusDiscount::class)]
        ]);

        Discount::create($request->all());

        Sweetalert::success('berhasil menabah diskon baru', 'Tambah Diskon Berhasil!');
        return redirect()->route('dashboard.discounts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        $title = "Edit Discount";
        return view('dashboard.discounts.edit', compact('title', 'discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'name' => 'required|min:3',
            'type' => ['required', Rule::enum(TypeDiscount::class)],
            'value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => ['required', Rule::enum(StatusDiscount::class)]
        ]);

        $discount->update($request->all());

        Sweetalert::success('berhasil ubah detail diskon', 'Ubah Diskon Berhasil!');
        return redirect()->route('dashboard.discounts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        Sweetalert::success('berhasil menghapus diskon dengan id: ' . $discount->id, 'Hapus Berhasil');
        return redirect()->route('dashboard.discounts.index');
    }
}
