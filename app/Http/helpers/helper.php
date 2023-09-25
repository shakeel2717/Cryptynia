<?php

use App\Models\Option;
use App\Models\Plan;
use App\Models\Reward;
use App\Models\TeamReward;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserPlan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

function site_option($key)
{
    $option = Option::where('key', $key)->first();
    return $option->value;
}

function balance($user_id)
{
    $in = Transaction::where('user_id', $user_id)->where('sum', true)->where('status', true)->sum('amount');
    $out = Transaction::where('user_id', $user_id)->where('sum', false)->sum('amount');
    return $in - $out;
}

function checkUserStatus($user_id)
{
    $user = User::find($user_id);
    if (!$user) {
        return false;
    }
    if ($user->status == 'active') {
        return true;
    } else {
        return false;
    }
}


function totalIncome($user_id)
{
    $in = Transaction::where('user_id', $user_id)
        ->where('sum', true)
        ->where('status', true)
        ->where('type', '!=', 'Deposit')
        ->where('type', '!=', 'Freeze Balance Recover')
        ->sum('amount');
    return $in;
}

function getActivePlan($user_id)
{
    $userPlan = UserPlan::where('user_id', $user_id)->where('status', 'active')->sum('amount');
    return $userPlan;
}


function getAllPlansAmount($user_id)
{
    $userPlan = UserPlan::where('user_id', $user_id)->sum('amount');
    return $userPlan;
}


function totalRoi($user_id)
{
    $user = User::find($user_id);
    if (!$user->userPlan) {
        return 0;
    }
    $transaction = Transaction::where('user_id', $user_id)->where('type', 'Daily ROI')->sum('amount');
    return $transaction;
}


function todayRoi($user_id)
{
    $transaction = Transaction::where('user_id', $user_id)->where('type', 'Daily ROI')->whereDate('created_at', Carbon::today())->sum('amount');
    return $transaction;
}


function getAllWithdraw($user_id)
{
    $transaction = Transaction::where('user_id', $user_id)->where('type', 'Withdraw')->sum('amount');
    return $transaction;
}


function getTodayWithdraw($user_id)
{
    $transaction = Transaction::where('user_id', $user_id)->where('type', 'Withdraw')->whereDate('created_at', Carbon::today())->sum('amount');
    return $transaction;
}


function totalDirectCommission($user_id)
{
    $transaction = Transaction::where('user_id', $user_id)->where('type', 'Direct Commission')->sum('amount');
    return $transaction;
}


function totalInDirectCommission($user_id)
{
    $transaction = Transaction::where('user_id', $user_id)->whereIn('type', ['In-Direct Commission L01','In-Direct Commission L02','In-Direct Commission L03'])->sum('amount');
    return $transaction;
}

function myReferrals($user_id)
{
    $user = User::find($user_id);
    $refers = User::where('refer', $user->username)->get();
    $leftUserCount = 0;
    foreach ($refers as $refer) {
        $leftUserCount++;
    }
    return $leftUserCount;
}

function myDirectBusiness($user_id)
{
    $user = User::find($user_id);
    $refers = User::where('refer', $user->username)->get();
    $directBusiness = 0;
    foreach ($refers as $refer) {
        $directBusiness += $refer->userPlans()->sum('amount');
    }
    return $directBusiness;
}

function myTeamBusiness($user_id)
{
    $user = User::find($user_id);
    $teamBusiness = 0;
    $calculateTeamBusiness = function ($user) use (&$calculateTeamBusiness, &$teamBusiness) {
        foreach ($user->directReferrals as $directReferral) {
            $teamBusiness += $directReferral->userPlans()->sum('amount');
            $calculateTeamBusiness($directReferral);
        }
    };

    $calculateTeamBusiness($user);

    return $teamBusiness;
}

function leftReferrals($user_id)
{
    $user = User::find($user_id);
    return count($user->getMyDownline('left'));
}


function rightReferrals($user_id)
{
    $user = User::find($user_id);
    return count($user->getMyDownline('right'));
}

function BusinessVolume($user_id, $position)
{
    $user = User::find($user_id);
    $totalAmount =  0;


    // getting all direct left users business

    $allDirectRefers = User::where('refer', $user->username)->where('position', $position)->where('status', 'active')->get();
    if ($allDirectRefers->count() < 0) {
        return 0;
    }

    foreach ($allDirectRefers as $count => $directRefer) {
        // checking if this user is networker
        if (!$directRefer->networker) {
            $totalAmount += $directRefer->userPlan->amount;
        }
        // info($directRefer->username . " Direct Balance Added: " . $directRefer->userPlan->amount);
        $directBusinessAlreadyCount[] = $directRefer->id;
        if ($count == 0) {
            $firstLevelActiveUser = $directRefer->userPlan->created_at;
        }
    }

    if (!checkLeftRightActiveStatus($user_id)) {
        // // info("User not have both side active, skipping");
        goto endThisFunction;
    }

    foreach ($user->getMyDownline($position) as $leftUser) {
        // info($leftUser->username . " User Investigating");
        // checking if this user have active plan
        if ($leftUser->userPlan == null) {
            // info($leftUser->username . " Not have active plan");
            goto endThisDirectLeftBusinessLoop;
        }


        if (in_array($leftUser->id, $directBusinessAlreadyCount)) {
            // info($leftUser->username . " This User Business Already Count");
            goto endThisDirectLeftBusinessLoop;
        }

        // checking if this user plan is activated before the direct user plan
        $directUserPlanDate = Carbon::parse($firstLevelActiveUser);
        $thisUserPlanDate = Carbon::parse($leftUser->userPlan->created_at);

        if ($directUserPlanDate->isBefore($thisUserPlanDate)) {

            // checking networker
            if (!$leftUser->networker) {
                $totalAmount += $leftUser->userPlan->amount;
            }
            // info($leftUser->username . " downline team Balance Added: " . $leftUser->userPlan->amount);
        } else {
            // info($firstLevelActiveUser . " Date of First Level Direct User");
            // info($leftUser->userPlan->created_at . " Date of " . $leftUser->username . " Direct User");
            // info($leftUser->username . " This User Plan Activate Before the Direct Refer");
        }



        endThisDirectLeftBusinessLoop:
    }

    endThisFunction:

    // dd($totalAmount);


    return $totalAmount;
}


function checkLeftRightActiveStatus($user_id)
{
    $user = User::find($user_id);
    $point = 0;
    $directRefers = User::where('refer', $user->username)->where('position', 'left')->where('status', 'active')->get();
    if ($directRefers->count() > 0) {
        $point++;
    }

    $directRefers = User::where('refer', $user->username)->where('position', 'right')->where('status', 'active')->get();
    if ($directRefers->count() > 0) {
        $point++;
    }

    if ($point == 2) {
        return true;
    } else {
        return false;
    }
}


function getLeftUserPlanTime($user)
{
    foreach ($user->getMyDownline('left')  as $leftUser) {
        if ($leftUser->UserPlan != null) {
            return strtotime($leftUser->UserPlan->created_at);
        }
    }
    return false;
}


function getRightUserPlanTime($user)
{
    foreach ($user->getMyDownline('right')  as $rightUser) {
        if ($rightUser->UserPlan != null) {
            return strtotime($rightUser->UserPlan->created_at);
        }
    }
    return false;
}

function totalMatchingBusiness($user_id)
{
    $leftBV = BusinessVolume($user_id, 'left');
    $rightBV = BusinessVolume($user_id, 'right');
    if ($leftBV > $rightBV) {
        return $rightBV;
    } else {
        return $leftBV;
    }
}

function getPackageByAmount($amount)
{
    $plans = Plan::get();
    foreach ($plans as $plan) {
        if ($amount == $plan->price) {
            return $plan->id;
        }
    }
    abort(500);
}


function getBinaryCommission($user_id)
{
    $commission = Transaction::where('user_id', $user_id)->where('type', 'Binary Commission')->where('sum', true)->where('status', true)->sum('amount');
    return $commission;
}


function checkRewardStatus($reward_id, $user_id)
{
    $reward = Reward::find($reward_id);
    $transactions = Transaction::where('user_id', $user_id)->where('reference', $reward->name . ' Reward Achieved')->count();
    if ($transactions > 0) {
        return 1;
    } else {
        return 0;
    }
}


function checkTeamRewardStatus($reward_id, $user_id)
{
    $reward = TeamReward::find($reward_id);
    $transactions = Transaction::where('user_id', $user_id)->where('reference', $reward->name . ' Reward Achieved')->count();
    if ($transactions > 0) {
        return 1;
    } else {
        return 0;
    }
}

function checkRewardAchieve($user_id)
{
    $transactions = Transaction::where('user_id', $user_id)->where('type', 'Reward Achieved')->count();
    if ($transactions > 0) {
        return 1;
    } else {
        return 0;
    }
}

function getAwardBadge($user_id)
{
    $transactions = Transaction::latest()->where('user_id', $user_id)->where('type', 'Reward Achieved')->first();
    return $transactions->reward->id;
}

function checkFreezeDaysCount($user_id)
{
    $user = User::find($user_id);
    // checking if this freez transaction almost 2 weeks
    if ($user->freeze_transactions->sum('amount') > 0) {
        $firstFreezeTransaction = $user->freeze_transactions->first();
        if (strtotime($firstFreezeTransaction->created_at) < strtotime(now()->addDays(site_option('freeze_transaction_duration')))) {
            // info("Transaction Freeze 15 days Found");
            return true;
        }
    }

    return false;
}

function checkFreezeFirstDate($user_id)
{
    $user = User::find($user_id);
    $firstFreezeTransaction = $user->freeze_transactions->first();
    if ($firstFreezeTransaction) {
        return $firstFreezeTransaction->created_at;
    } else {
        return false;
    }
}


function totalDailyRoiCap($user_id)
{
    return getActivePlan($user_id) * site_option('daily_roi_network_x');
}


function totalInvestment()
{
    $investments = Transaction::where('type', 'Plan Active')->whereDate('created_at', '>=', newDateTimeForStats())->sum('amount');
    return $investments;
}

function totalRealInvestment()
{
    $invest = 0;
    $investments = Transaction::where('type', 'Plan Active')->whereDate('created_at', '>=', newDateTimeForStats())->get();
    foreach ($investments as $investment) {
        // checking if this user is not a PIN
        if (!$investment->user->networker) {
            $invest += $investment->amount;
        }
    }
    return $invest;
}


function totalPinInvestment()
{
    $invest = 0;
    $investments = Transaction::where('type', 'Plan Active')->whereDate('created_at', '>=', newDateTimeForStats())->get();
    foreach ($investments as $investment) {
        // checking if this user is not a PIN
        if ($investment->user->networker) {
            $invest += $investment->amount;
        }
    }
    return $invest;
}


function allWithdrawals()
{
    $withdrawals = Transaction::where('type', 'Withdraw')->sum('amount');
    return  $withdrawals;
}

function pendingWithdrawals()
{
    $withdrawals = Transaction::where('type', 'Withdraw')->where('status', false)->sum('amount');
    return  $withdrawals;
}


function approvedWithdrawals()
{
    $withdrawals = Transaction::where('type', 'Withdraw')->where('status', true)->sum('amount');
    return  $withdrawals;
}


function totalRealDeposit()
{
    $invest = 0;
    $investments = Transaction::where('type', 'Deposit')->whereDate('created_at', '>=', newDateTimeForStats())->get();
    foreach ($investments as $investment) {
        // checking if this user is not a PIN
        if (!$investment->user->networker) {
            $invest += $investment->amount;
        }
    }
    return $invest;
}


// getting currency to deposit
function getDepositAmount($currency, $usdAmount)
{
    if ($currency == "USDT") {
        return $usdAmount * 1;
    }

    $currency = $currency . "USDT";
    $response = Http::withHeaders([
        'X-MBX-APIKEY' => '',
    ])->get('https://api.binance.com/api/v3/ticker/price', [
        'symbol' => $currency,
    ]);

    if ($response->json() == []) {
        info("Invalid Wallet");
        abort(500);
    }

    $liveRate = $response->json();
    return $usdAmount / $liveRate['price'];
}


function getLiveRate($currency)
{
    $apiKey = env('BINANCE_API_KEY');
    $response = Http::withHeaders([
        'X-MBX-APIKEY' => $apiKey,
    ])->get('https://api.binance.com/api/v3/ticker/price', [
        'symbol' => $currency . "USDT",
    ]);

    if ($response->json() == []) {
        info("Invalid Wallet");
        abort(500);
    }

    $liveRate = $response->json();
    return $liveRate['price'];
}


function newDateTimeForStats()
{
    return now()->parse("2023-08-19 04:48:52");
}

function edie($string)
{
    info($string);
    die();
}
