<?php

namespace App\Http\Livewire\admin;

use App\Events\PlanActivatedEvent;
use App\Models\Plan;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdraw;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class AllUsers extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public $name;
    public $email;


    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */

    // public function header(): array
    // {
    //     return [
    //         Button::add('bulk-sold-out')
    //             ->caption(__('Withdraw All Balance'))
    //             ->class('btn btn-white')
    //             ->emit('withdrawAllBalance', [])
    //     ];
    // }


    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Header::make()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }



    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\User>
     */
    public function datasource(): Builder
    {
        return User::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')

            /** Example of custom column using a closure **/
            ->addColumn('name_lower', fn (User $model) => strtolower(e($model->name)))

            ->addColumn('balance', function (User $model) {
                return number_format(balance($model->id), 2);
            })

            ->addColumn('investment', function (User $model) {
                return number_format(getActivePlan($model->id), 2);
            })

            ->addColumn('my_referrals', function (User $model) {
                return myReferrals($model->id);
            })

            ->addColumn('username')
            ->addColumn('email')
            ->addColumn('refer')
            ->addColumn('status')
            ->addColumn('networker')
            ->addColumn('created_at_formatted', fn (User $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            // Column::make('Id', 'id'),
            Column::make('Full Name', 'name')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Username', 'username')
                ->sortable()
                ->editOnClick()
                ->clickToCopy(true)
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Refer', 'refer')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Status', 'status'),

            Column::make('Networker', 'networker')
                ->toggleable(),

            Column::make('Balance', 'balance'),
            Column::make('Investment', 'investment'),
            Column::make('My Referrals', 'my_referrals'),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::inputText('name')->operators(['contains']),
            Filter::inputText('username')->operators(['contains']),
            Filter::inputText('email')->operators(['contains']),
            Filter::inputText('refer')->operators(['contains']),
            Filter::boolean('networker'),
            Filter::select('status', 'status')
                ->dataSource(User::status())
                ->optionValue('label')
                ->optionLabel('status'),
            Filter::datetimepicker('created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid User Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            // Button::make('delete', 'Delete')
            //     ->class('btn btn-primary btn-sm')
            //     ->emit('delete', ['id' => 'id']),

            // Button::make('suspend', 'Suspend')
            //     ->class('btn btn-primary btn-sm')
            //     ->emit('suspend', ['id' => 'id']),

            // Button::make('activate', 'Activate')
            //     ->class('btn btn-primary btn-sm')
            //     ->emit('activate', ['id' => 'id']),

            // Button::make('withdraw', 'Withdraw All Fund')
            //     ->class('btn btn-primary btn-sm')
            //     ->emit('withdraw', ['id' => 'id']),

            Button::make('pin', 'Make PIN')
                ->class('btn btn-primary btn-sm')
                ->emit('pin', ['id' => 'id']),


            Button::make('withdrawStop', 'Withdraw Stop')
                ->class('btn btn-primary btn-sm')
                ->emit('withdrawStop', ['id' => 'id']),

            Button::make('withdrawStart', 'Withdraw Start')
                ->class('btn btn-primary btn-sm')
                ->emit('withdrawStart', ['id' => 'id']),

            Button::make('unpin', 'Make Normal')
                ->class('btn btn-primary btn-sm')
                ->emit('unpin', ['id' => 'id']),

            Button::make('login', 'Login')
                ->class('btn btn-primary btn-sm')
                ->emit('login', ['id' => 'id']),


            // Button::make('package', 'Activate Package')
            //     ->class('btn btn-primary btn-sm')
            //     ->emit('package', ['id' => 'id']),

            //    Button::make('destroy', 'Delete')
            //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //        ->route('user.destroy', function(\App\Models\User $model) {
            //             return $model->id;
            //        })
            //        ->method('delete')
        ];
    }

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'delete'   => 'delete',
                'pin'   => 'pin',
                'login'   => 'login',
                'unpin'   => 'unpin',
                'package'   => 'package',
                'suspend'   => 'suspend',
                'activate'   => 'activate',
                'withdraw'   => 'withdraw',
                'confirmedDelete' => 'confirmedDelete',
                'withdrawAllBalance' => 'withdrawAllBalance',
                'withdrawStop' => 'withdrawStop',
                'withdrawStart' => 'withdrawStart',
            ]
        );
    }


    public function onUpdatedEditable(string $id, string $field, string $value): void
    {
        User::query()->find($id)->update([
            $field => $value,
        ]);
    }


    public function withdrawAllBalance()
    {
        if (count($this->checkboxValues) == 0) {
            $this->dispatchBrowserEvent('deleted', ['status' => 'Select At Least One Item']);
            return;
        }

        $users = User::whereIn('id', $this->checkboxValues)->get();
        foreach ($users as $user) {

            $amount = balance($user->id);
            $fees = $amount * site_option('withdraw_fees') / 100;
            $amount = $amount - $fees;

            $wallet = Wallet::find(1);

            $withdraw = new Withdraw();
            $withdraw->user_id = $user->id;
            $withdraw->amount = $amount;
            $withdraw->wallet = "Balance Adjustment";
            $withdraw->method = $wallet->name;
            $withdraw->save();

            $user->transactions()->create([
                'type' => 'Withdraw',
                'sum' => false,
                'status' => false,
                'reference' => 'Withdraw Funds throw ' . $wallet->name . " " . $wallet->symbol,
                'user_plan_id' => $user->userPlan->id ?? null,
                'withdraw_id' => $withdraw->id,
                'amount' => $amount,
            ]);

            $user->transactions()->create([
                'type' => 'Withdraw Fees',
                'sum' => false,
                'status' => false,
                'user_plan_id' => $user->userPlan->id ?? null,
                'reference' => 'Withdraw Funds throw ' . $wallet->name . " " . $wallet->symbol,
                'withdraw_id' => $withdraw->id,
                'amount' => $fees,
            ]);



            $this->dispatchBrowserEvent('deleted', ['status' => 'Withdraw Balance Added']);
        }
    }


    public function confirmedDelete($id)
    {
        $user = User::find($id);
        $user->delete();

        $this->dispatchBrowserEvent('deleted', ['status' => 'User Deleted Successfully']);
    }


    public function withdraw($id)
    {
        $user = User::find($id['id']);


        $amount = balance($user->id);
        $fees = $amount * site_option('withdraw_fees') / 100;
        $amount = $amount - $fees;

        $wallet = Wallet::find(1);

        $withdraw = new Withdraw();
        $withdraw->user_id = $user->id;
        $withdraw->amount = $amount;
        $withdraw->wallet = "Balance Adjustment";
        $withdraw->method = $wallet->name;
        $withdraw->save();

        $user->transactions()->create([
            'type' => 'Withdraw',
            'sum' => false,
            'status' => false,
            'reference' => 'Withdraw Funds throw ' . $wallet->name . " " . $wallet->symbol,
            'user_plan_id' => $user->userPlan->id ?? null,
            'withdraw_id' => $withdraw->id,
            'amount' => $amount,
        ]);

        $user->transactions()->create([
            'type' => 'Withdraw Fees',
            'sum' => false,
            'status' => false,
            'user_plan_id' => $user->userPlan->id ?? null,
            'reference' => 'Withdraw Funds throw ' . $wallet->name . " " . $wallet->symbol,
            'withdraw_id' => $withdraw->id,
            'amount' => $fees,
        ]);



        $this->dispatchBrowserEvent('deleted', ['status' => 'User Deleted Successfully']);
    }


    public function delete($id)
    {
        $this->dispatchBrowserEvent('warning', ['id' => $id['id']]);
    }

    public function activate($id)
    {
        $user = User::find($id['id']);
        $user->status = 'active';
        $user->save();

        $this->dispatchBrowserEvent('deleted', ['status' => 'User Suspended Successfully']);
    }

    public function package($id)
    {
        $user = User::find($id['id']);
        // get plan id with amount
        $balance = balance($user->id);

        if ($balance < 1) {
            abort(404);
        }



        $plan = Plan::findOrFail(getPackageByAmount($balance));

        // checking if this useer networking cap is full
        if (networkCapInPercentage($user->id) >= 100) {
            info("user Cap Already Full");
            // checking if this user already have active plan
            if (getActivePlan($user->id) > 0) {
                info("User Already have Active Plan");
                info("Checking if this user trying to actiavet lower plan");
                if (getActivePlan($user->id) > $balance) {
                    info("User trying to Activate Lower Plan");
                    return back()->withErrors(['Insufficient investment. Please allocate more than $' . getActivePlan($user->id) . ' to activate the plan']);
                }
            }
        }

        // checking if this user have enough balnace
        // if ($balance < $balance) {
        //     return back()->withErrors(['Insufficient Balance']);
        // }

        // checking if this user already have active plan
        if ($user->userPlan) {
            $newAmount = $user->userPlan->amount + $balance;

            // activating user plan
            $userPlan = $user->userPlan;
            $userPlan->plan_id = getPackageByAmount($newAmount);
            $userPlan->amount = $newAmount;
            $userPlan->status = 'active';
            $userPlan->save();
        } else {
            // activating user plan
            $userPlan = $user->userPlan()->create([
                'plan_id' => $plan->id,
                'amount' => $balance,
                'status' => 'active',
            ]);
        }


        // removing balance from user transaction
        $transaction = $user->transactions()->create([
            'type' => 'Plan Active',
            'amount' => $balance,
            'status' => true,
            'sum' => false,
            'reference' => "Plan: " . $plan->name . " Activated",
        ]);

        // activating this user
        $user->status = 'active';
        $user->save();

        // Deliving Direct Commision
        event(new PlanActivatedEvent($transaction, $userPlan));

        $this->dispatchBrowserEvent('deleted', ['status' => 'User\'s Package Activated Successfully']);
    }

    public function login($id)
    {
        $user = User::find($id['id']);

        Auth::login($user);

        return redirect()->route('user.dashboard.index');
    }

    public function suspend($id)
    {
        $user = User::find($id['id']);
        $user->status = 'suspend';
        $user->save();

        $this->dispatchBrowserEvent('deleted', ['status' => 'User Suspended Successfully']);
    }


    public function pin($id)
    {
        $user = User::find($id['id']);
        $user->networker = true;
        $user->save();

        $this->dispatchBrowserEvent('deleted', ['status' => 'User Account Converted to PIN Account']);
    }

    public function unpin($id)
    {
        $user = User::find($id['id']);
        $user->networker = false;
        $user->save();

        $this->dispatchBrowserEvent('deleted', ['status' => 'PIN Account Converted to Normal Account']);
    }


    public function withdrawStop($id)
    {
        $user = User::find($id['id']);
        $user->withdraw = false;
        $user->save();

        $this->dispatchBrowserEvent('deleted', ['status' => 'User Withdraw Stopped']);
    }

    public function withdrawStart($id)
    {
        $user = User::find($id['id']);
        $user->withdraw = true;
        $user->save();

        $this->dispatchBrowserEvent('deleted', ['status' => 'User Withdraw Started']);
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid User Action Rules.
     *
     * @return array<int, RuleActions>
     */


    public function actionRules(): array
    {
        return [

            //Hide button edit for ID 1
            Rule::button('suspend')
                ->when(fn ($user) => $user->status === 'suspend')
                ->hide(),

            Rule::button('activate')
                ->when(fn ($user) => $user->status === 'active')
                ->hide(),

            Rule::button('pin')
                ->when(fn ($user) => $user->networker == true)
                ->hide(),

            Rule::button('unpin')
                ->when(fn ($user) => $user->networker == false)
                ->hide(),

            Rule::button('package')
                ->when(fn ($user) => $user->status == 'active')
                ->hide(),


            Rule::rows()
                ->when(fn ($user) => $user->status == "active")
                ->setAttribute('class', 'bg-success-subtle'),

            Rule::rows()
                ->when(fn ($user) => $user->networker == true)
                ->setAttribute('class', 'bg-primary-subtle'),


            Rule::button('withdrawStart')
                ->when(fn ($user) => $user->withdraw == true)
                ->hide(),

            Rule::button('withdrawStop')
                ->when(fn ($user) => $user->withdraw == false)
                ->hide(),
        ];
    }
}
