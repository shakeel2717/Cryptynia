<?php

namespace App\Actions;

use App\Models\CoinPayment;
use CoinpaymentsAPI;
use Exception;

class CoinPaymentGateway
{
    public $private_key;
    public $public_key;


    public function __construct()
    {
        $this->private_key = env('PRIKEY');
        $this->public_key = env('PUBKEY');
    }

    public function init($amount, $currency, $email)
    {
        try {
            $cps_api = new CoinpaymentsAPI($this->private_key, $this->public_key, 'json');
            $amount = $amount;
            $currency1 = "USD";
            $currency2 = $currency;
            $buyer_email = $email;
            $ipn_url = env('IPN_URL');
            $information = $cps_api->CreateSimpleTransactionWithConversion($amount, $currency1, $currency2, $buyer_email, $ipn_url);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            exit();
        }

        if ($information['error'] != 'ok') {
            throw new Exception("Payment Gateway Timeout Error.");
        }

        // Inserting New Transaction Request Storing into session
        $task = new CoinPayment();
        $task->user_id = auth()->user()->id;
        $task->amount = $information['result']['amount'];
        $task->amountf = $amount;
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

        return $information;
    }
}
