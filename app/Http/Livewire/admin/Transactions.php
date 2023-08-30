<?php

namespace App\Http\Livewire\admin;

use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class Transactions extends PowerGridComponent
{
    use ActionButton;
    use WithExport;
    public array $type;
    public $amount;

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
            Header::make()
                ->showSearchInput()
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
     * @return Builder<\App\Models\Transaction>
     */
    public function datasource(): Builder
    {
        return Transaction::query()
            ->latest()
            ->whereIn('type', $this->type)
            ->limit(2);
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
            ->addColumn('user', fn (Transaction $model) => e($model->user->username))
            ->addColumn('amount')
            ->addColumn('type')

            /** Example of custom column using a closure **/
            ->addColumn('amount_format', fn (Transaction $model) => e("$" . number_format($model->amount, 2)))
            ->addColumn('status_format', fn (Transaction $model) => e($model->status ? "Approved" : "Pending"))

            ->addColumn('status')
            ->addColumn('sum')
            ->addColumn('reference')
            ->addColumn('created_at_formatted', fn (Transaction $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
            Column::make('User id', 'user'),
            Column::make('Amount', 'amount_format', 'amount')
                ->sortable()
                ->editOnClick()
                ->searchable(),

            Column::make('Type', 'type')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status_format', 'status'),

            Column::make('Reference', 'reference')
                ->sortable()
                ->clickToCopy(true)
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
            Filter::inputText('type')->operators(['contains']),
            Filter::number('amount'),
            Filter::boolean('status'),
            Filter::boolean('sum'),
            Filter::inputText('reference')->operators(['contains']),
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
     * PowerGrid Transaction Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('delete', 'DELETE')
                ->class('btn btn-danger btn-sm')
                ->emit('delete', ['id' => 'id'])

            //    Button::make('destroy', 'Delete')
            //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //        ->route('transaction.destroy', function(\App\Models\Transaction $model) {
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
                'confirmedDelete' => 'confirmedDelete'
            ]
        );
    }


    public function confirmedDelete($id)
    {
        $user = Transaction::find($id);
        $user->delete();

        $this->dispatchBrowserEvent('deleted', ['status' => 'Transaction Deleted Successfully']);
    }


    public function delete($id)
    {
        $this->dispatchBrowserEvent('warning', ['id' => $id['id']]);
    }

    public function onUpdatedEditable(string $id, string $field, string $value): void
    {
        Transaction::query()->find($id)->update([
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
     * PowerGrid Transaction Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($transaction) => $transaction->id === 1)
                ->hide(),
        ];
    }
    */
}
