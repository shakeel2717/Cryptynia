<?php

namespace App\Console\Commands;

use App\Models\Withdraw;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class BinanceWithdraw extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'binance:withdraw';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Approve Binance Withdraw for VIP Users Only';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // getting all withdraw transactions
        $withdraws = Withdraw::where('status', false)->get();
        foreach ($withdraws as $withdraw) {
            // checking if this user is VIP
            if (!$withdraw->user->vip || $withdraw->method != "USDT") {
                goto exitThisLoop;
            }

            info($withdraw);
            // processing this withdraw request for auto withdraw
            $apiKey = env('BINANCE_API_KEY');
            $apiSecret = env('BINANCE_API_SECRET');
            $timestamp = round(microtime(true) * 1000);

            $coin = $withdraw->method;
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
                // Request successful
                echo "Withdrawal request successful:\n";
                // Withdraw Approved.
                $withdraw->txId = $apiData->id;
                $withdraw->status = true;
                $withdraw->save();
                echo "Withdraw Approved:\n";

                // approving transaction
                foreach ($withdraw->transactions as $transaction) {
                    $transaction->status = true;
                    $transaction->reference = $transaction->reference . " & txId: " . $apiData->id;
                    $transaction->save();
                    echo "Transactions Approved:\n";
                }
            } else {
                // Request failed
                info("Withdrawal request failed. HTTP Status Code: " . $httpCode . "\n");
                info($response);
            }

            exitThisLoop:
        }
    }
}
