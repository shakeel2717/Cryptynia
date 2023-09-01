<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
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
            'exchange_id' => 'required|integer',
            'amount' => 'required|numeric|min:1',
            'screenshot' => 'required|image',
        ]);

        $exchange = Exchange::findOrFail($validatedData['exchange_id']);

        $screenshot = $request->file('screenshot');
        $screenshot_name = auth()->user()->username . time() . rand(00, 11) . '.' . $screenshot->getClientOriginalExtension();
        $screenshot->move(public_path('orders/'), $screenshot_name);

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->exchange_id = $validatedData['exchange_id'];
        $order->screenshot = $screenshot_name;
        $order->amount_in_pkr = $validatedData['amount'];
        $order->save();

        return back()->with('success', 'Order Placed, Your Funds will be added into your account payment verification');
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
