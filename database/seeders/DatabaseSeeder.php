<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Option;
use App\Models\Plan;
use App\Models\PlanProfit;
use App\Models\Post;
use App\Models\Reward;
use App\Models\TeamReward;
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


        $user = new User();
        $user->name = "Shakeel Ahmad";
        $user->username = "shakeel2717";
        $user->email = "shakeel2717@gmail.com";
        $user->mobile = "03001212133";
        $user->country = "Pakistan";
        $user->email_verified_at = now();
        $user->password = bcrypt('asdfasdf');
        $user->save();

        $user = new User();
        $user->name = "Test 1";
        $user->username = "test1";
        $user->email = "test1@gmail.com";
        $user->mobile = rand(0000000, 9999999);
        $user->country = "Pakistan";
        $user->refer = "shakeel2717";
        $user->email_verified_at = now();
        $user->password = bcrypt('asdfasdf');
        $user->save();

        $user = new User();
        $user->name = "Test 2";
        $user->username = "test2";
        $user->email = "test2@gmail.com";
        $user->mobile = rand(0000000, 9999999);
        $user->country = "Pakistan";
        $user->refer = "shakeel2717";
        $user->email_verified_at = now();
        $user->password = bcrypt('asdfasdf');
        $user->save();

        $user = new User();
        $user->name = "Test 3";
        $user->username = "test3";
        $user->email = "test3@gmail.com";
        $user->mobile = rand(0000000, 9999999);
        $user->country = "Pakistan";
        $user->refer = "test1";
        $user->email_verified_at = now();
        $user->password = bcrypt('asdfasdf');
        $user->save();

        $user = new User();
        $user->name = "Test 4";
        $user->username = "test4";
        $user->email = "test4@gmail.com";
        $user->mobile = rand(0000000, 9999999);
        $user->country = "Pakistan";
        $user->refer = "test1";
        $user->email_verified_at = now();
        $user->password = bcrypt('asdfasdf');
        $user->save();

        $user = new User();
        $user->name = "Test 5";
        $user->username = "test5";
        $user->email = "test5@gmail.com";
        $user->mobile = rand(0000000, 9999999);
        $user->country = "Pakistan";
        $user->refer = "test3";
        $user->email_verified_at = now();
        $user->password = bcrypt('asdfasdf');
        $user->save();

        $user = new User();
        $user->name = "Test 6";
        $user->username = "test6";
        $user->email = "test6@gmail.com";
        $user->mobile = rand(0000000, 9999999);
        $user->country = "Pakistan";
        $user->refer = "test3";
        $user->email_verified_at = now();
        $user->password = bcrypt('asdfasdf');
        $user->save();

        $user = new User();
        $user->name = "Test 7";
        $user->username = "test7";
        $user->email = "test7@gmail.com";
        $user->mobile = rand(0000000, 9999999);
        $user->country = "Pakistan";
        $user->refer = "test4";
        $user->email_verified_at = now();
        $user->password = bcrypt('asdfasdf');
        $user->save();


        // adding default package plan
        $plan = new Plan();
        $plan->name = "Plan 1";
        $plan->price = 50;
        $plan->min_profit = 1;
        $plan->max_profit = 1.5;
        $plan->withdrawals = 10;
        $plan->duration = 90;
        $plan->save();

        $planProfit = new PlanProfit();
        $planProfit->plan_id = $plan->id;
        $planProfit->profit = $plan->min_profit;
        $planProfit->save();

        $plan = new Plan();
        $plan->name = "Plan 2";
        $plan->price = 100;
        $plan->min_profit = 1;
        $plan->max_profit = 1.5;
        $plan->withdrawals = 20;
        $plan->duration = 90;
        $plan->save();

        $planProfit = new PlanProfit();
        $planProfit->plan_id = $plan->id;
        $planProfit->profit = $plan->min_profit;
        $planProfit->save();

        $plan = new Plan();
        $plan->name = "Plan 3";
        $plan->price = 300;
        $plan->min_profit = 1;
        $plan->max_profit = 1.5;
        $plan->withdrawals = 30;
        $plan->duration = 90;
        $plan->save();

        $planProfit = new PlanProfit();
        $planProfit->plan_id = $plan->id;
        $planProfit->profit = $plan->min_profit;
        $planProfit->save();

        $plan = new Plan();
        $plan->name = "Plan 4";
        $plan->price = 500;
        $plan->min_profit = 1;
        $plan->max_profit = 1.5;
        $plan->withdrawals = 50;
        $plan->duration = 90;
        $plan->save();

        $planProfit = new PlanProfit();
        $planProfit->plan_id = $plan->id;
        $planProfit->profit = $plan->min_profit;
        $planProfit->save();

        $plan = new Plan();
        $plan->name = "Plan 5";
        $plan->price = 1000;
        $plan->min_profit = 1;
        $plan->max_profit = 1.5;
        $plan->withdrawals = 50;
        $plan->duration = 90;
        $plan->save();

        $planProfit = new PlanProfit();
        $planProfit->plan_id = $plan->id;
        $planProfit->profit = $plan->min_profit;
        $planProfit->save();

        $plan = new Plan();
        $plan->name = "Plan 6";
        $plan->price = 3000;
        $plan->min_profit = 1;
        $plan->max_profit = 1.5;
        $plan->withdrawals = 50;
        $plan->duration = 90;
        $plan->save();

        $planProfit = new PlanProfit();
        $planProfit->plan_id = $plan->id;
        $planProfit->profit = $plan->min_profit;
        $planProfit->save();

        $plan = new Plan();
        $plan->name = "Plan 7";
        $plan->price = 5000;
        $plan->min_profit = 1;
        $plan->max_profit = 1.5;
        $plan->withdrawals = 50;
        $plan->duration = 90;
        $plan->save();

        $planProfit = new PlanProfit();
        $planProfit->plan_id = $plan->id;
        $planProfit->profit = $plan->min_profit;
        $planProfit->save();

        $plan = new Plan();
        $plan->name = "Plan 8";
        $plan->price = 10000;
        $plan->min_profit = 1;
        $plan->max_profit = 1.5;
        $plan->withdrawals = 50;
        $plan->duration = 90;
        $plan->save();

        $planProfit = new PlanProfit();
        $planProfit->plan_id = $plan->id;
        $planProfit->profit = $plan->min_profit;
        $planProfit->save();


        $wallet = new Wallet();
        $wallet->name = "Tether";
        $wallet->symbol = "USDT";
        $wallet->code = "USDT.TRC20";
        $wallet->network = "TRX";
        $wallet->icon = "usdt.png";
        $wallet->fees = 0;
        $wallet->save();

        $wallet = new Wallet();
        $wallet->name = "Ethereum";
        $wallet->symbol = "ETH";
        $wallet->code = "ETH";
        $wallet->network = "ETH";
        $wallet->icon = "ethereum.png";
        $wallet->fees = 0;
        $wallet->save();

        $option = new Option();
        $option->key = 'min_deposit';
        $option->value = 10;
        $option->save();


        $option = new Option();
        $option->key = 'min_withdraw';
        $option->value = 10;
        $option->save();


        $option = new Option();
        $option->key = 'withdraw_fees';
        $option->value = 5;
        $option->save();

        $option = new Option();
        $option->key = 'auto_withdrawal';
        $option->value = 1;
        $option->save();


        $option = new Option();
        $option->key = 'direct_commission';
        $option->value = 5;
        $option->save();

        $option = new Option();
        $option->key = 'in_direct_commission_1';
        $option->value = 2;
        $option->save();


        $option = new Option();
        $option->key = 'in_direct_commission_2';
        $option->value = 1;
        $option->save();


        $option = new Option();
        $option->key = 'in_direct_commission_3';
        $option->value = 0.5;
        $option->save();

        $option = new Option();
        $option->key = 'deposit_bonus';
        $option->value = 10;
        $option->save();


        $option = new Option();
        $option->key = 'social_facebook';
        $option->value = 'https://facebook.com/';
        $option->save();

        $option = new Option();
        $option->key = 'social_youtube';
        $option->value = 'https://youtube.com/';
        $option->save();

        $option = new Option();
        $option->key = 'social_tiktok';
        $option->value = 'https://tiktok.com/';
        $option->save();

        $option = new Option();
        $option->key = 'social_telegram';
        $option->value = 'https://telegram.org/';
        $option->save();

        $option = new Option();
        $option->key = 'social_instagram';
        $option->value = 'https://www.instagram.com';
        $option->save();

        $option = new Option();
        $option->key = 'social_twitter';
        $option->value = 'https://www.twitter.com';
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
        $reward->business = 1000;
        $reward->reward = 50;
        $reward->save();

        $reward = new Reward();
        $reward->name = "EMPYREAN";
        $reward->business = 3000;
        $reward->reward = 150;
        $reward->save();

        $reward = new Reward();
        $reward->name = "PINNACLE";
        $reward->business = 5000;
        $reward->reward = 300;
        $reward->save();

        $reward = new Reward();
        $reward->name = "ELITE";
        $reward->business = 10000;
        $reward->reward = 700;
        $reward->save();

        $reward = new Reward();
        $reward->name = "APEX";
        $reward->business = 30000;
        $reward->reward = 3000;
        $reward->save();

        $reward = new TeamReward();
        $reward->name = "Innovate";
        $reward->business = 10000;
        $reward->reward = 100;
        $reward->save();

        $reward = new TeamReward();
        $reward->name = "Collaborator";
        $reward->business = 30000;
        $reward->reward = 300;
        $reward->save();

        $reward = new TeamReward();
        $reward->name = "Excellence";
        $reward->business = 50000;
        $reward->reward = 1000;
        $reward->save();

        $reward = new TeamReward();
        $reward->name = "Leadership";
        $reward->business = 100000;
        $reward->reward = 3000;
        $reward->save();

        $reward = new TeamReward();
        $reward->name = "Harmony";
        $reward->business = 200000;
        $reward->reward = 6000;
        $reward->save();
    }
}
