<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class BinanceTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'binance:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currency = "ETH";
        $apiKey = env('BINANCE_API_KEY');
        $response = Http::withHeaders([
            'X-MBX-APIKEY' => $apiKey,
        ])->get('https://api.binance.com/api/v3/ticker/price', [
            'symbol' => $currency . "USDT",
        ]);

        info($response->json());
        $liveRate = $response->json();
        return $liveRate['price'];
    }
}
