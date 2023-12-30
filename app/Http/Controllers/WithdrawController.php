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
            'wallet' => 'required|string',
            'code' => 'required|string',
        ]);

        // checking if this user have enough balance
        if (balance(auth()->user()->id) < $validatedData['amount']) {
            return back()->withErrors(['Insufficient Balance']);
        }

        // checking OTP
        if ($validatedData['code'] != session('token')) {
            return back()->withErrors(['OTP Not Matched, Please try again']);
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
        $withdraw->method = $wallet->code;
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

        logHistory("User Withdraw Request " . $withdraw->amount  . " " . $wallet->name  . " " . $wallet->symbol);

        // checking if withdraw is direct_binance_withdraw_approval on then proceed the withdraw now.
        if(site_option("direct_binance_withdraw_approval")){
            if (site_option('auto_withdrawal')) {

                $apiKey = env('BINANCE_API_KEY');
                $apiSecret = env('BINANCE_API_SECRET');
                $timestamp = round(microtime(true) * 1000);
    
                $coin = "USDT";
                $network = 'TRX';
                $address = $withdraw->wallet; // Replace with actual address
                $amount = $withdraw->amount + 1;
    
                $data = [
                    'coin' => $coin,
                    'network' => $network,
                    'address' => $address,
                    'amount' => $amount,
                    'timestamp' => $timestamp,
                ];
    
                $signature = hash_hmac('sha256', http_build_query($data), $apiSecret);
    
                $curl = curl_init();
    
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.binance.com/sapi/v1/capital/withdraw/apply?coin=' . $coin . '&network=' . $network . '&address=' . $address . '&amount=' . $amount . '&timestamp=' . $timestamp . '&signature=' . $signature,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'X-MBX-APIKEY: ' . $apiKey
                    ),
                ));
    
                $response = curl_exec($curl);
                info($response);
    
                $apiData = json_decode($response);
    
                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
                curl_close($curl);
    
                if ($httpCode == 200) {
                    $withdraw->txId = $apiData->id;
                    $withdraw->status = true;
                    $withdraw->save();
    
                    foreach ($withdraw->transactions as $transaction) {
                        $transaction->status = true;
                        $transaction->reference = $transaction->reference . " & txId: " . $apiData->id;
                        $transaction->save();
                    }
    
                    if (!env('APP_DEBUG')) {
                        // sending email to this user
                        Mail::to($withdraw->user->email)->send(new WithdrawComplete($withdraw));
                    }
                            info("Withdrawal request approved");
    
                } else {
                    info("Error: ");
                }
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
