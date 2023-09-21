<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderConfirmationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|integer|exists:orders,id'
        ]);

        try {
            DB::beginTransaction();
            // marking this order as complete, and deliver the dollars to buyer balance
            $order = Order::findOrFail($validatedData['order_id']);
            $order->status = true;
            $order->save();

            // deliver balance to buyer
            $buyer = User::findOrFail($order->user_id);

            // removing balance from this user account
            $buyer->transactions()->create([
                'type' => 'P2P Buy',
                'sum' => true,
                'status' => true,
                'reference' => 'Funds Buy via P2P : ' . $order->amount_in_pkr,
                'amount' => $order->amount,
            ]);

            // marking this exchange transaction as complete
            $transaction = Transaction::where('exchange_id',$order->exchange_id)->firstOrFail();
            $transaction->status = true;
            $transaction->save();

            // marking this order as complete
            DB::commit();
            return redirect()->route('user.dashboard.index')->with('success', 'Transaction Accepted');
        } catch (\Exception $e) {
            return redirect()->route('user.dashboard.index')->withError($e->getMessage());
        }

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
