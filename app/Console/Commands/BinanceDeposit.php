<?php

namespace App\Console\Commands;

use App\Models\Tid;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class BinanceDeposit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:deposits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch All Binance Deposits and Approved Them';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiKey = env('BINANCE_API_KEY');
        $apiSecret = env('BINANCE_API_SECRET');
        $timestamp = round(microtime(true) * 1000);

        // finding pending tid
        $tids = Tid::where('status', 'false')->where('exchange', 'Binance')->get();
        foreach ($tids as $tid) {
            $params = [
                'timestamp' => $timestamp,
                'txId' => $tid->hash_id,
                'status' => 1,
                // Add other required parameters as needed
            ];
            $params['signature'] = hash_hmac('sha256', http_build_query($params), $apiSecret);
            $response = Http::withHeaders([
                'X-MBX-APIKEY' => $apiKey,
            ])->get('https://api.binance.com/sapi/v1/capital/deposit/hisrec', $params);
            // info($response);
            // checking if this response is empty
            if ($response->json() == []) {
                // info("This TID not Found");
                goto endThisTxLoop;
            }

            $transaction = $response->json();
            if (!$transaction[0]['status']) {
                info("Transaction Not yet Approved");
                goto endThisTxLoop;
            }

            // checking if this coin is usdt
            if ($transaction[0]['coin'] == 'USDT') {
                $finalAmount = $transaction[0]['amount'];
                $fees = 0;
            } elseif ($transaction[0]['coin'] == 'ETH') {
                // precess eth coin
                // getting amount in USDT
                $ethAmount = $transaction[0]['amount'];
                $ethRate = getLiveRate('ETH');
                $finalAmount = $ethAmount * $ethRate;
            }

            if ($tid->wallet->fees > 0) {
                $getFeesReverse = $tid->wallet->fees / 100;

                $depositAmount = $finalAmount / (1 + $getFeesReverse);
                $fees = $finalAmount - $depositAmount;

                // $fees = $finalAmount * $tid->wallet->fees / 100;
            }

            // approving this transaction
            $tid->status = true;
            $tid->amount = $finalAmount;
            $tid->save();

            // adding Transaction to user balance
            $transaction = new Transaction();
            $transaction->user_id = $tid->user_id;
            $transaction->type = 'Deposit';
            $transaction->amount = $finalAmount;
            $transaction->status = true;
            $transaction->sum = true;
            $transaction->reference = "Deposit Approved, TxId: " . $tid->hash_id;
            $transaction->save();
            info("Deposit Added");


            // adding Transaction to user balance
            $transationFees = new Transaction();
            $transationFees->user_id = $tid->user_id;
            $transationFees->type = 'Deposit Fees';
            $transationFees->amount = $fees;
            $transationFees->status = true;
            $transationFees->sum = false;
            $transationFees->reference = "Deposit Approved, TxId: " . $tid->hash_id;
            $transationFees->save();
            info("Deposit Fees Added");



            endThisTxLoop:
        }
    }
}
