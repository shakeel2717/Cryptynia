<?php

namespace App\Http\Livewire\admin;

use App\Models\Tid;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class allDeposits extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public $fees;
    public $amount;
    public $exchange;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        // $this->showCheckBox();

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
     * @return Builder<\App\Models\Tid>
     */
    public function datasource(): Builder
    {
        return Tid::query()->where('status', false);
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
            ->addColumn('user_id')
            ->addColumn('user', fn (Tid $model) => strtolower(e($model->user->username)))
            ->addColumn('amount')
            ->addColumn('fees')
            ->addColumn('hash_id')
            ->addColumn(
                'screenshot',
                function (Tid $model) {
                    $asset = asset('screenshots/') . "/" . $model->screenshot;
                    return '<img src="' . $asset . '" width="150">';
                }
            )

            /** Example of custom column using a closure **/
            ->addColumn('hash_id_lower', fn (Tid $model) => strtolower(e($model->hash_id)))

            ->addColumn('status')
            ->addColumn('created_at_formatted', fn (Tid $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
            Column::make('User id', 'user'),
            Column::make('Amount', 'amount')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Exchange', 'exchange')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('FEES', 'fees')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Hash id', 'hash_id')
                ->sortable()
                ->searchable(),


            Column::make('SCREENSHOT', 'screenshot'),


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
            Filter::inputText('hash_id')->operators(['contains']),
            Filter::boolean('status'),
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
     * PowerGrid Tid Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
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
        $user = Tid::find($id);
        $user->delete();

        $this->dispatchBrowserEvent('deleted', ['status' => 'Withdrawal Deleted Successfully']);
    }


    public function approve($id)
    {
        $tid = Tid::find($id['id']);
        $tid->status = true;
        $tid->save();

        // adding Transaction to user balance
        $transaction = new Transaction();
        $transaction->user_id = $tid->user_id;
        $transaction->type = 'Deposit';
        $transaction->amount = $tid->amount;
        $transaction->status = true;
        $transaction->sum = true;
        $transaction->reference = "Deposit Approved, TxId: " . $tid->hash_id;
        $transaction->save();


        // adding Transaction to user balance
        $transationFees = new Transaction();
        $transationFees->user_id = $tid->user_id;
        $transationFees->type = 'Deposit Fees';
        $transationFees->amount = $tid->fees;
        $transationFees->status = true;
        $transationFees->sum = false;
        $transationFees->reference = "Deposit Approved, TxId: " . $tid->hash_id;
        $transationFees->save();

        $this->dispatchBrowserEvent('deleted', ['status' => 'Deposit Approved Successfully']);
    }


    public function onUpdatedEditable(string $id, string $field, string $value): void
    {
        Tid::query()->find($id)->update([
            $field => $value,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Tid Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($tid) => $tid->id === 1)
                ->hide(),
        ];
    }
    */
}
