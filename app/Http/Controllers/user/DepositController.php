<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.history.deposits');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wallets = Wallet::where('status', true)->get();
        return view('user.deposit.create', compact('wallets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'paymentMethod' => 'required|integer|exists:wallets,id',
            'amount' => 'required|integer|digits_between:1,1000000',
            'exchange' => 'required|string',
        ]);

        // checking if deposit amount is enough
        if ($validatedData['amount'] < site_option('min_deposit')) {
            return back()->withErrors(['Minimum Withdrawal Limit is: ' . site_option('min_deposit')]);
        }

        $finalAmount = $validatedData['amount'];
        $fees = 0;
        // getting this wallet fees
        $wallet = Wallet::find($validatedData['paymentMethod']);
        if ($wallet->fees > 0) {
            $fees = $validatedData['amount'] * $wallet->fees /  100;
            $finalAmount = $validatedData['amount'] + $fees;
        }

        if ($wallet->status == null) {
            abort(0);
        }

        $amount = $validatedData['amount'];
        $exchange = $validatedData['exchange'];

        return view('user.deposit.address', compact('wallet', 'fees', 'finalAmount', 'amount', 'exchange'));
    }


    public function verify(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:1',
            'hash_id' => 'required|string|unique:tids,hash_id',
            'exchange' => 'required|string',
            'wallet_id' => 'required|integer',
            'screenshot' => 'required|image',
            'finalAmount' => 'required|numeric|min:1',
        ]);


        $wallet = Wallet::findOrFail($validatedData['wallet_id']);

        $screenshot = $request->file('screenshot');
        $screenshot_name = auth()->user()->username . time() . rand(00, 11) . '.' . $screenshot->getClientOriginalExtension();
        $screenshot->move(public_path('screenshots/'), $screenshot_name);

        // checking if this user request already pending
        if (auth()->user()->pending_tids()->get()->count() > 0) {
            return back()->withErrors(['Your Deposit Request Already Received, Please wait!']);
        }

        auth()->user()->tids()->create([
            'hash_id' => $validatedData['hash_id'],
            'wallet_id' => $validatedData['wallet_id'],
            'amount' => $validatedData['finalAmount'],
            'screenshot' => $screenshot_name,
            'exchange' => $validatedData['exchange'],
            'fees' => $validatedData['finalAmount'] - $validatedData['amount'],
        ]);

        return redirect()->route('user.dashboard.index')->with('success', 'Deposit Request Sent Successfully');
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
