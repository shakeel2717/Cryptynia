<?php

namespace App\Listeners;

use App\Events\FreezeBalanceVerification;
use App\Events\PlanActivatedEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeliverDirectCommission
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PlanActivatedEvent $event): void
    {
        $user = User::find($event->transaction->user_id);
        $transaction = $event->transaction;
        $userPlan = $event->userPlan;
        // getting this user upliner
        if ($user->refer != 'default') {
            // info("User have valid refer");

            // finding the refer
            $sponser = User::where('username', $user->refer)->first();
            if (!$sponser) {
                goto EndThisListener;
                die();
            }

            // checking if sponser is active
            if ($sponser->status != 'active') {
                goto EndThisListener;
                die();
            }

            // checking networker account
            if ($user->networker) {
                // info("Networker Account, Skipping Direct Profit");
                goto EndThisListener;
            }

            // getting direct commission
            $amount = $transaction->amount * site_option('direct_commission') / 100;

            $thisSponser = $sponser->transactions()->create([
                'type' => "Direct Commission",
                'sum' => true,
                'amount' => $amount,
                'user_plan_id' => $sponser->userPlan->id,
                'status' => true,
                'reference' => 'Direct Commission from: ' . $user->username,
            ]);

            // delivering indirect Commission

            if ($sponser->refer != 'default') {
                // info("User have valid refer");

                // finding the refer
                $indirect1 = User::where('username', $user->refer)->first();
                if (!$indirect1) {
                    goto EndThisListener;
                    die();
                }

                // checking if indirect1 is active
                if ($indirect1->status != 'active') {
                    goto EndThisListener;
                    die();
                }

                // checking networker account
                if ($user->networker) {
                    // info("Networker Account, Skipping Direct Profit");
                    goto EndThisListener;
                }

                // getting direct commission
                $amount = $transaction->amount * site_option('in_direct_commission_1') / 100;

                $thisindirect1 = $indirect1->transactions()->create([
                    'type' => "In-Direct Commission L01",
                    'sum' => true,
                    'amount' => $amount,
                    'status' => true,
                    'reference' => 'In-Direct Commission from: ' . $user->username,
                ]);

                // delivering indirect Commission L02

                if ($indirect1->refer != 'default') {
                    // info("User have valid refer");

                    // finding the refer
                    $indirect2 = User::where('username', $user->refer)->first();
                    if (!$indirect2) {
                        goto EndThisListener;
                        die();
                    }

                    // checking if indirect2 is active
                    if ($indirect2->status != 'active') {
                        goto EndThisListener;
                        die();
                    }

                    // checking networker account
                    if ($user->networker) {
                        // info("Networker Account, Skipping Direct Profit");
                        goto EndThisListener;
                    }

                    // getting direct commission
                    $amount = $transaction->amount * site_option('in_direct_commission_2') / 100;

                    $thisindirect2 = $indirect2->transactions()->create([
                        'type' => "In-Direct Commission L02",
                        'sum' => true,
                        'amount' => $amount,
                        'status' => true,
                        'reference' => 'In-Direct Commission from: ' . $user->username,
                    ]);

                    // delivering indirect Commission L03

                    if ($indirect2->refer != 'default') {
                        // info("User have valid refer");

                        // finding the refer
                        $indirect3 = User::where('username', $user->refer)->first();
                        if (!$indirect3) {
                            goto EndThisListener;
                            die();
                        }

                        // checking if indirect3 is active
                        if ($indirect3->status != 'active') {
                            goto EndThisListener;
                            die();
                        }

                        // checking networker account
                        if ($user->networker) {
                            // info("Networker Account, Skipping Direct Profit");
                            goto EndThisListener;
                        }

                        // getting direct commission
                        $amount = $transaction->amount * site_option('in_direct_commission_3') / 100;

                        $thisindirect3 = $indirect3->transactions()->create([
                            'type' => "In-Direct Commission L03",
                            'sum' => true,
                            'amount' => $amount,
                            'status' => true,
                            'reference' => 'In-Direct Commission from: ' . $user->username,
                        ]);
                    }
                }
            }
        }

        EndThisListener:
    }
}
