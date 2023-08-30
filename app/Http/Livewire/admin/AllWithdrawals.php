<?php

namespace App\Http\Livewire\admin;

use App\Mail\WithdrawComplete;
use App\Models\Withdraw;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class AllWithdrawals extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
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
     * @return Builder<\App\Models\Withdraw>
     */
    public function datasource(): Builder
    {
        return Withdraw::query()->where('status', false);
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
        return [
            "User" => [
                'username'
            ]
        ];
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
            ->addColumn('user', fn (Withdraw $model) => strtolower(e($model->user->username)))
            ->addColumn('amount')
            ->addColumn('wallet')

            /** Example of custom column using a closure **/
            ->addColumn('wallet_lower', fn (Withdraw $model) => strtolower(e($model->wallet)))

            ->addColumn('status')
            ->addColumn('method')
            ->addColumn('created_at_formatted', fn (Withdraw $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
            Column::make('Id', 'id'),
            Column::make('User id', 'user'),
            Column::make('Amount', 'amount')
                ->sortable()
                ->searchable(),

            Column::make('Wallet', 'wallet')
                ->sortable()
                ->searchable(),

            Column::make('Method', 'method')
                ->sortable()
                ->searchable(),

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
            Filter::inputText('wallet')->operators(['contains']),
            Filter::boolean('status'),
            Filter::inputText('method')->operators(['contains']),
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
     * PowerGrid Withdraw Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            //    Button::make('edit', 'Edit')
            //        ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
            //        ->route('withdraw.edit', function(\App\Models\Withdraw $model) {
            //             return $model->id;
            //        }),

            //    Button::make('destroy', 'Delete')
            //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //        ->route('withdraw.destroy', function(\App\Models\Withdraw $model) {
            //             return $model->id;
            //        })
            //        ->method('delete')


            Button::make('approve', 'Approve')
                ->class('btn btn-danger btn-sm')
                ->emit('approve', ['id' => 'id']),

            Button::make('delete', 'Delete')
                ->class('btn btn-danger btn-sm')
                ->emit('delete', ['id' => 'id']),
        ];
    }


    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'approve' => 'approve',
                'confirmedapprove' => 'confirmedapprove',
                'delete' => 'delete',
                'confirmedDelete' => 'confirmedDelete'
            ]
        );
    }

    public function delete($id)
    {
        $this->dispatchBrowserEvent('warning', ['id' => $id['id']]);
    }

    public function confirmedDelete($id)
    {
        $user = Withdraw::find($id);
        $user->delete();

        $this->dispatchBrowserEvent('deleted', ['status' => 'Withdrawal Deleted Successfully']);
    }


    public function approve($id)
    {
        $this->dispatchBrowserEvent('txId', ['id' => $id['id']]);
    }


    public function confirmedapprove($id)
    {
        $withdraw = Withdraw::find($id['id']);
        $withdraw->txId = $id['txId'];
        $withdraw->status = true;
        $withdraw->save();

        // approving transaction
        foreach ($withdraw->transactions as $transaction) {
            $transaction->status = true;
            $transaction->reference = $transaction->reference . " & txId: " . $id['txId'];
            $transaction->save();
        }

        if (!env('APP_DEBUG')) {
            // sending email to this user
            Mail::to($withdraw->user->email)->send(new WithdrawComplete($withdraw));
        }

        $this->dispatchBrowserEvent('deleted', ['status' => 'Withdrawals Approved Successfully']);
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Withdraw Action Rules.
     *
     * @return array<int, RuleActions>
     */


    public function actionRules(): array
    {
        return [

            Rule::rows()
                ->when(fn ($withdraw) => $withdraw->user->withdraw == false)
                ->setAttribute('class', 'bg-danger'),

            Rule::rows()
                ->when(fn ($withdraw) => $withdraw->user->vip == true)
                ->setAttribute('class', 'bg-success'),
        ];
    }
}
