<?php

namespace App\Console\Commands;

use App\Models\Reward;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Console\Command;

class CheckRewardCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:reward';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking All Users Rewards';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // getting all active users
        $users = User::where('status', 'active')->get();
        foreach ($users as $user) {
            // checking if this user have plan

            if($user->userPlan == ""){
                info("User not have active plan");
                goto ThisUserEndLoop;
            }

            if ($user->userPlan->amount < 1) {
                info("User not have amount invested");
            }

            // getting this user matching business
            $myDirectBusiness = myDirectBusiness($user->id);
            if ($myDirectBusiness < 1) {
                info("not Eligible For Reward");
            }

            info("Eligible For Reward" . $user->username);
            $rewards = Reward::get();
            $currentRewardRequried = 0;
            foreach ($rewards as $reward) {
                $currentRewardRequried += $reward->business;
                info("Current Reward: " . $currentRewardRequried);
                if (myDirectBusiness($user->id) < $currentRewardRequried) {
                    info("Reward not Achieved" . myDirectBusiness($user->id) . " " . $reward->business);
                    goto ThisUserEndLoop;
                }

                info("Reward Achieved" . $reward->name);

                // checking if this reward already devliered
                $alreadyTransaction = Transaction::where('user_id', $user->id)
                    ->where('type', 'Reward Achieved')
                    ->where('amount',$reward->reward)
                    ->count();
                    if($alreadyTransaction < 1){
                        info("Reward Already Delivered");
                    } else {
                        // delivering Profit to this User
                        $transaction = $user->transactions()->create([
                            'type' => 'Reward Achieved',
                            'sum' => true,
                            'status' => true,
                            'reference' => $reward->name . ' Reward Achieved',
                            'amount' =>  $reward->reward,
                            'reward_id' =>  $reward->id,
                        ]);
        
                        info("Reward Transaction Added");
                    }

            }


            ThisUserEndLoop:
        }
    }
}
