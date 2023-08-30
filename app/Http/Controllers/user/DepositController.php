<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\CoinPayment;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use CoinpaymentsAPI;

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

        if ($wallet->status == null) {
            abort(404);
        }

        $private_key = env('PRIKEY');
        $public_key = env('PUBKEY');

        try {
            $cps_api = new CoinpaymentsAPI($private_key, $public_key, 'json');
            $amount = $validatedData['amount'];;
            $currency1 = "USD";
            $currency2 = $wallet->code;
            $buyer_email = auth()->user()->email;
            $ipn_url = env('IPN_URL');
            $information = $cps_api->CreateSimpleTransactionWithConversion($amount, $currency1, $currency2, $buyer_email, $ipn_url);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            exit();
        }

        if ($information['error'] != 'ok') {
            return "Payment Gateway Timeout Error.";
        }

        // Inserting New Transaction Request Storing into session
        $task = new CoinPayment();
        $task->user_id = auth()->user()->id;
        $task->amount = $information['result']['amount'];
        $task->amountf = $validatedData['amount'];
        $task->address = $information['result']['address'];
        $task->timeout = $information['result']['timeout'];
        $task->dest_tag = 1;
        $task->from_currency = $currency1;
        $task->to_currency = $currency2;
        $task->txn_id = $information['result']['txn_id'];
        $task->confirms_needed = $information['result']['confirms_needed'];
        $task->checkout_url = $information['result']['checkout_url'];
        $task->status_url = $information['result']['status_url'];
        $task->qrcode_url = $information['result']['qrcode_url'];
        $task->save();
        $data = $information['result'];

        $finalAmount = $information['result']['amount'];
        $fees = 0;


        if ($wallet->fees > 0) {
            $fees = $information['result']['amount'] * $wallet->fees /  100;
            $finalAmount = $information['result']['amount'] + $fees;
        }

        $amount = $validatedData['amount'];

        return view('user.deposit.address', compact('data','wallet', 'fees', 'finalAmount', 'amount'));
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
