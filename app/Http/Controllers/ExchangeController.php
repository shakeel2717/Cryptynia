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
            'price' => 'required|min:1|max:999999'
        ]);

        // creating new p2p order
        $exchange = new Exchange();
        $exchange->user_id = auth()->user()->id;
        $exchange->amount = $validatedData['amount'];
        $exchange->price = $validatedData['price'];
        $exchange->save();

        return back()->with('status', 'Your P2P Order Placed');
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
        //
    }
}
