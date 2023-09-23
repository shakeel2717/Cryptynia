<?php

namespace App\Http\Controllers;

use App\Models\CoinPayment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CoinPaymentController extends Controller
{
    public function webhook(Request $request)
    {
        info('CoinPayment webhook Request: ' . json_encode($request->all()));

        $merchant_id = env('COINPAYMENTSMERCHANT');
        $ipn_secret = env('IPN_SECRET');
        info('CoinPayment webhook  Init');
        $txn_id = $request->txn_id;
        $payment = CoinPayment::where("txn_id", $txn_id)->firstOrFail();
        $order_currency = $payment->currencyf; //BTC
        $order_total = $payment->amount; //BTC

        if (!isset($request->ipn_mode) || $request->ipn_mode != 'hmac') {
            edie("IPN Mode is not HMAC");
        }

        if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
            edie("No HMAC Signature Sent.");
        }

        $requestFile = file_get_contents('php://input');
        if ($requestFile === false || empty($requestFile)) {
            edie("Error in reading Post Data");
        }

        if (!isset($request->merchant) || $request->merchant != trim($merchant_id)) {
            edie("No or incorrect merchant id.");
        }

        $hmac =  hash_hmac("sha512", $requestFile, trim($ipn_secret));
        if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
            edie("HMAC signature does not match.");
        }

        $amount1 = floatval($request->amount1); //IN USD
        $amount2 = floatval($request->amount2); //IN BTC
        $currency1 = $request->currency1; //USD
        $currency2 = $request->currency2; //BTC
        $status = intval($request->status);

        if ($currency2 != $payment->currency->symbol) {
            edie("Currency Mismatch");
        }

        if ($amount2 < $order_total) {
            edie("Amount is lesser than order total");
        }

        if ($status == 1 || $status == 2) {
            // Payment is complete
            $payment->status = "success";
            $payment->save();

            // Inserting User Plan
            // checking if already inserted
            $transaction = Transaction::where('user_id', $payment->user_id)->where('reference', $txn_id)->count();
            if ($transaction < 1) {
                // adding balance to this user
                $transaction = $payment->user->transactions()->create([
                    'type' => 'Deposit',
                    'sum' => true,
                    'amount' => $amount1,
                    'status' => true,
                    'reference' => $txn_id,
                ]);
                info('CoinPayment Payment  Success');

                // adding deposit bonus
                if (site_option('deposit_bonus') > 0) {
                    $bonusAmount = site_option('deposit_bonus') * $amount1 / 100;
                    $bonus = $payment->user->transactions()->create([
                        'type' => 'Deposit Bonus',
                        'sum' => true,
                        'amount' => $bonusAmount,
                        'status' => true,
                        'reference' => $txn_id,
                    ]);
                }
            } else {
                info('CoinPayment Payment Already Inserted');
            }
        } else if ($status >= 100) {
            // Payment is complete
            $payment->status = "complete";
            $payment->save();

            // checking if already inserted
            $transaction = Transaction::where('user_id', $payment->user_id)->where('reference', $txn_id)->count();
            if ($transaction < 1) {
                // getting this user Payment ID
                $transaction = $payment->user->transactions()->create([
                    'type' => 'Deposit',
                    'sum' => true,
                    'amount' => $amount1,
                    'status' => true,
                    'reference' => $txn_id,
                ]);
                info('CoinPayment Payment Status 100 Success');
                
                // adding deposit bonus
                if (site_option('deposit_bonus') > 0) {
                    $bonusAmount = site_option('deposit_bonus') * $amount1 / 100;
                    $bonus = $payment->user->transactions()->create([
                        'type' => 'Deposit Bonus',
                        'sum' => true,
                        'amount' => $bonusAmount,
                        'status' => true,
                        'reference' => $txn_id,
                    ]);
                }
            } else {
                info('CoinPayment Payment Already Inserted 100');
            }
        } else if ($status < 0) {
            // Payment Error
            $payment->status = "error";
            $payment->save();
        } else {
            // Payment Pending
            $payment->status = "pending";
            $payment->save();
        }
    }
}
