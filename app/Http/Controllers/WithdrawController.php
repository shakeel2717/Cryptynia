<?php

namespace App\Http\Controllers;

use App\Mail\WithdrawComplete;
use App\Mail\WithdrawRequest;
use App\Models\Wallet;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use CoinpaymentsAPI;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallets = Wallet::where('status', true)->get();
        return view('user.withdraw.index', compact('wallets'));
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
            'paymentMethod' => 'required|integer|exists:wallets,id',
            'amount' => 'required|numeric|min:1',
            'wallet' => 'required|string',
        ]);

        $private_key = env('PRIKEY');
        $public_key = env('PUBKEY');

        // checking if this user have enough balance
        if (balance(auth()->user()->id) < $validatedData['amount']) {
            return back()->withErrors(['Insufficient Balance']);
        }

        // checking if withdraw is stopped for this user
        if (!auth()->user()->withdraw) {
            return back()->withErrors(['Withdraw is Temporary Suspended']);
        }

        // checking if withdraw amount is enough
        if ($validatedData['amount'] < site_option('min_withdraw')) {
            return back()->withErrors(['Minimum Withdrawal Limit is: ' . site_option('min_withdraw')]);
        }

        if (!env('APP_DEBUG')) {
            // checking if this user KYC is Complete
            if (!auth()->user()->kyc || !auth()->user()->kyc->status) {
                return back()->withErrors(['You can Place Withdraw Request After KYC Approved.']);
            }
        }

        $wallet = Wallet::findOrFail($validatedData['paymentMethod']);

        // getting user active plan
        // if (empty(auth()->user()->userPlan)) {
        //     return back()->withErrors(['You must have Active Plan in order to Get Paid']);
        // }

        $fees = $validatedData['amount'] * site_option('withdraw_fees') / 100;
        $amount = $validatedData['amount'] - $fees;

        $withdraw = new Withdraw();
        $withdraw->user_id = auth()->user()->id;
        $withdraw->amount = $amount;
        $withdraw->wallet = $validatedData['wallet'];
        $withdraw->method = $wallet->symbol;
        $withdraw->save();

        auth()->user()->transactions()->create([
            'type' => 'Withdraw',
            'sum' => false,
            'status' => false,
            'reference' => 'Withdraw Funds throw ' . $wallet->name . " " . $wallet->symbol,
            'user_plan_id' => auth()->user()->userPlan->id ?? null,
            'withdraw_id' => $withdraw->id,
            'amount' => $amount,
        ]);

        auth()->user()->transactions()->create([
            'type' => 'Withdraw Fees',
            'sum' => false,
            'status' => false,
            'user_plan_id' => auth()->user()->userPlan->id ?? null,
            'reference' => 'Withdraw Funds throw ' . $wallet->name . " " . $wallet->symbol,
            'withdraw_id' => $withdraw->id,
            'amount' => $fees,
        ]);

        if (!env('APP_DEBUG')) {
            // sending email to this user
            Mail::to(auth()->user()->email)->send(new WithdrawRequest($withdraw));
        }

        if (site_option('auto_withdrawal')) {
            $cps_api = new CoinpaymentsAPI($private_key, $public_key, 'json');

            $withdrawalParams = [
                'amount' => $amount,
                'currency' => $wallet->code,
                'add_tx_fee' => 0,
                'address' => $validatedData['wallet'],
                'ipn_url' => env('IPN_URL'),
                'auto_confirm' => 0,
                'note' => 'Withdrawal Request for user: ' . auth()->user()->username,
            ];

            try {
                $withdrawalResult = $cps_api->CreateWithdrawal($withdrawalParams);
                info($withdrawalResult);

                if ($withdrawalResult['error'] == 'ok') {
                    $withdrawalId = $withdrawalResult['result']['id'];
                    $withdraw->txId = $withdrawalId;
                    $withdraw->status = true;
                    $withdraw->save();

                    // approving transaction
                    foreach ($withdraw->transactions as $transaction) {
                        $transaction->status = true;
                        $transaction->reference = $transaction->reference . " & txId: " . $withdrawalId;
                        $transaction->save();
                    }

                    if (!env('APP_DEBUG')) {
                        // sending email to this user
                        Mail::to($withdraw->user->email)->send(new WithdrawComplete($withdraw));
                    }
                } else {
                    info("Withdrawal request failed: {$withdrawalResult['error']}");
                }
            } catch (\Exception $e) {
                info("Error: " . $e->getMessage());
            }
        }

        return back()->with('success', 'Withdraw Request Send Successfully');
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
