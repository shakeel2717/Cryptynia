<?php

namespace App\Http\Controllers\user;

use App\Actions\CoinPaymentGateway;
use App\Http\Controllers\Controller;
use App\Models\CoinPayment;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use CoinpaymentsAPI;
use Exception;

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

        // getting this wallet fees
        $wallet = Wallet::findOrFail($validatedData['paymentMethod']);

        if ($wallet->status == null || $wallet->status == false) {
            abort(404);
        }

        switch (site_option("active_gateway")) {
            case 0:
                $coinPaymentGateway = new CoinPaymentGateway();
                $information = $coinPaymentGateway->init($validatedData['amount'], $wallet->code, auth()->user()->email);

                $data = $information['result'];

                $finalAmount = $information['result']['amount'];
                $fees = 0;

                if ($wallet->fees > 0) {
                    $fees = $information['result']['amount'] * $wallet->fees /  100;
                    $finalAmount = $information['result']['amount'] + $fees;
                }

                $amount = $validatedData['amount'];

                logHistory("User Init Deposit Request: " . $finalAmount);

                return view('user.deposit.address', compact('data', 'wallet', 'fees', 'finalAmount', 'amount'));
                break;

            case 1:
                $amount = $validatedData['amount'];
                $finalAmount = $amount;
                $fees = 0;
                if ($wallet->fees > 0) {
                    $fees = $amount * $wallet->fees / 100;
                    $finalAmount = $amount + $fees;
                }
                return view('user.deposit.binance', compact('wallet', 'amount', 'fees', 'finalAmount'));
                break;
            default:
                throw new Exception("No Payment Gateway Activated.");
                break;
        }
    }


    public function verify(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:1',
            'hash_id' => 'required|string|unique:tids,hash_id',
            'wallet_id' => 'required|integer',
            'finalAmount' => 'required|numeric|min:1',
        ]);


        $wallet = Wallet::findOrFail($validatedData['wallet_id']);

        // checking if this user request already pending
        if (auth()->user()->pending_tids()->get()->count() > 0) {
            return back()->withErrors(['Your Deposit Request Already Received, Please wait!']);
        }

        auth()->user()->tids()->create([
            'hash_id' => $validatedData['hash_id'],
            'wallet_id' => $validatedData['wallet_id'],
            'amount' => $validatedData['finalAmount'],
            'fees' => $validatedData['finalAmount'] - $validatedData['amount'],
        ]);

        return redirect()->route('user.dashboard.index')->with('success', 'Deposit Request Sent Successfully, Please wait...');
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
