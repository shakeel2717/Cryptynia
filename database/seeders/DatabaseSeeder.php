<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Option;
use App\Models\Plan;
use App\Models\PlanProfit;
use App\Models\Post;
use App\Models\Reward;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "Administrator";
        $user->username = "admin";
        $user->email = "admin@test.com";
        $user->mobile = "03001212123";
        $user->country = "Pakistan";
        $user->email_verified_at = now();
        $user->password = bcrypt('asdfasdf');
        $user->role = 'admin';
        $user->save();


        // adding default package plan
        $plan = new Plan();
        $plan->name = "Silver Package";
        $plan->min_price = 25;
        $plan->max_price = 499;
        $plan->min_profit = 0.75;
        $plan->max_profit = 1;
        $plan->save();

        $planProfit = new PlanProfit();
        $planProfit->plan_id = $plan->id;
        $planProfit->profit = $plan->min_profit;
        $planProfit->direct_commission = 10;
        $planProfit->binary_commission = 7;
        $planProfit->save();

        $plan = new Plan();
        $plan->name = "Gold Package";
        $plan->min_price = 500;
        $plan->max_price = 9999;
        $plan->min_profit = 1;
        $plan->max_profit = 1.25;
        $plan->save();

        $planProfit = new PlanProfit();
        $planProfit->plan_id = $plan->id;
        $planProfit->profit = $plan->min_profit;
        $planProfit->direct_commission = 12;
        $planProfit->binary_commission = 10;
        $planProfit->save();

        $plan = new Plan();
        $plan->name = "Diamond Package";
        $plan->min_price = 10000;
        $plan->max_price = 1000000;
        $plan->min_profit = 1;
        $plan->max_profit = 1.50;
        $plan->save();

        $planProfit = new PlanProfit();
        $planProfit->plan_id = $plan->id;
        $planProfit->profit = $plan->min_profit;
        $planProfit->direct_commission = 15;
        $planProfit->binary_commission = 12;
        $planProfit->save();


        $wallet = new Wallet();
        $wallet->name = "Tether";
        $wallet->symbol = "USDT";
        $wallet->network = "TRX";
        $wallet->icon = "usdt.png";
        $wallet->fees = 1;
        $wallet->address = "kwejrlwjer2l3kj4l2j34ljl";
        $wallet->save();
        
        $wallet = new Wallet();
        $wallet->name = "Ethereum";
        $wallet->symbol = "ETH";
        $wallet->network = "ETH";
        $wallet->icon = "ethereum.png";
        $wallet->fees = 1;
        $wallet->address = "kwejrlwjer2l3kj4l2j34ljl";
        $wallet->save();

        $option = new Option();
        $option->key = 'min_deposit';
        $option->value = 10;
        $option->save();


        $option = new Option();
        $option->key = 'deposit_fees';
        $option->value = 1;
        $option->save();


        $option = new Option();
        $option->key = 'withdraw_fees';
        $option->value = 5;
        $option->save();


        $option = new Option();
        $option->key = 'networkCap';
        $option->value = 3;
        $option->save();

        $option = new Option();
        $option->key = 'rewards_auto';
        $option->value = true;
        $option->save();


        $option = new Option();
        $option->key = 'freeze_transaction_duration';
        $option->value = -15;
        $option->save();

        $option = new Option();
        $option->key = 'daily_roi_network_x';
        $option->value = 2;
        $option->save();



        $post = new Post();
        $post->title = 'The Basics of Forex Trading: A Beginner\'s Guide';
        $post->body = 'In this introductory blog post, we cover the fundamental concepts of forex trading, making it an ideal starting point for newcomers to the world of currency trading. From understanding forex markets and currency pairs to learning how to read forex quotes and execute trades, this guide will provide beginners with the essential knowledge and terminology to embark on their forex trading journey confidently.';
        $post->img = null;
        $post->save();

        $post = new Post();
        $post->title = 'Mastering Technical Analysis for Forex Trading';
        $post->body = 'Technical analysis is a powerful tool in the arsenal of successful forex traders. This blog post delves into the world of technical analysis, exploring popular indicators, chart patterns, and price action techniques that help identify trends, entry and exit points, and potential market reversals. Whether you\'re a seasoned trader or a beginner, this comprehensive guide will equip you with the skills to interpret charts and make well-informed trading decisions based on technical insights.';
        $post->img = null;
        $post->save();

        $post = new Post();
        $post->title = 'Risk Management: Safeguarding Your Forex Investments';
        $post->body = 'Risk management is the backbone of profitable forex trading. This post emphasizes the significance of implementing a robust risk management strategy to protect your capital and maintain steady growth. We delve into position sizing, setting stop-loss orders, and understanding leverage, empowering traders to minimize potential losses and optimize risk-to-reward ratios. Learn how to stay disciplined, protect your investments, and preserve your trading account for sustained success in the dynamic forex market.';
        $post->img = null;
        $post->save();


        $reward = new Reward();
        $reward->name = "PROMINENCE";
        $reward->business = 3000;
        $reward->reward = 200;
        $reward->save();

        $reward = new Reward();
        $reward->name = "EMPYREAN";
        $reward->business = 10000;
        $reward->reward = 500;
        $reward->save();

        $reward = new Reward();
        $reward->name = "PINNACLE";
        $reward->business = 25000;
        $reward->reward = 1000;
        $reward->save();

        $reward = new Reward();
        $reward->name = "ELITE";
        $reward->business = 50000;
        $reward->reward = 2000;
        $reward->save();

        $reward = new Reward();
        $reward->name = "APEX";
        $reward->business = 100000;
        $reward->reward = 5000;
        $reward->save();

        $reward = new Reward();
        $reward->name = "SOVEREIGN";
        $reward->business = 250000;
        $reward->reward = 10000;
        $reward->save();

        $reward = new Reward();
        $reward->name = "LUMINARY";
        $reward->business = 500000;
        $reward->reward = 20000;
        $reward->save();

        $reward = new Reward();
        $reward->name = "ECHELON";
        $reward->business = 3000000;
        $reward->reward = 50000;
        $reward->save();

        $reward = new Reward();
        $reward->name = "SUPREME";
        $reward->business = 10000000;
        $reward->reward = 100000;
        $reward->save();
    }
}
