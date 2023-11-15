<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exchanges = Exchange::where('status', true)->get();
        return view('user.exchange.p2p.index', compact('exchanges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.exchange.p2p.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|min:1|max:999999',
            'currency' => 'required|string|max:3',
            'price' => 'required|min:1|max:999999'
        ]);

        // checking if this user profile is updated
        if (
            empty(auth()->user()->account->bank_name) ||
            empty(auth()->user()->account->account_title) ||
            empty(auth()->user()->account->account_title)
        ) {
            return back()->withErrors(['Please Update Your Payment Profile First']);
        }



        // checking if this user have enough balnace
        if (balance(auth()->user()->id) < $validatedData['amount']) {
            return back()->withErrors(['Insufficient Balance']);
        }

        // creating new p2p order
        $exchange = new Exchange();
        $exchange->user_id = auth()->user()->id;
        $exchange->amount = $validatedData['amount'];
        $exchange->price = $validatedData['price'];
        $exchange->currency = $validatedData['currency'];
        $exchange->save();

        // removing balance from this user account
        auth()->user()->transactions()->create([
            'type' => 'P2P Sell',
            'sum' => false,
            'status' => false,
            'reference' => 'USDT Sell P2P @ ' . number_format($exchange->price, 2),
            'exchange_id' => $exchange->id,
            'amount' => $exchange->amount,
        ]);

        logHistory("User P2P Order Placed" . 'USDT Sell P2P @ ' . number_format($exchange->price, 2));


        return back()->with('success', 'Your P2P Order Placed');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exchange $exchange)
    {
        return view('user.exchange.p2p.show', compact('exchange'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exchange $exchange)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exchange $exchange)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exchange $exchange)
    {
        // removing balance from this user account
        auth()->user()->transactions()->create([
            'type' => 'P2P Sell Reverse',
            'sum' => true,
            'status' => true,
            'reference' => 'P2P Order Deleted: USDT Sell P2P @ ' . number_format($exchange->price, 2),
            'amount' => $exchange->amount,
        ]);

        $exchange->status = false;
        $exchange->save();

        return back()->with('success', 'P2P Transaction Deleted');
    }
}
