<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // get all transaction from member

        return response()->json([
            'status' => 'success',
            'message' => 'list all transaction from ' . $request->user()->full_name,
            'data' => TransactionResource::collection($request->user()->transactions)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'show detail transaction for ' . $transaction->member->full_name . ' with id ' . $transaction->id,
            'transaction' => new TransactionResource($transaction),
            'invoice' => $transaction->invoice_number
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
