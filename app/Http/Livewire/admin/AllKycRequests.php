<?php

namespace App\Http\Livewire\admin;

use App\Models\Kyc;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class AllKycRequests extends PowerGridComponent
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
     * @return Builder<\App\Models\Kyc>
     */
    public function datasource(): Builder
    {
        return Kyc::query()->where('status', false);
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
            ->addColumn('name')

            /** Example of custom column using a closure **/
            ->addColumn('username', fn (Kyc $model) => strtolower(e($model->user->username)))

            ->addColumn('address')
            ->addColumn('status')
            ->addColumn('created_at_formatted', fn (Kyc $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
            Column::make('User id', 'username'),

            Column::make('CNIC/Passport', 'cnic')
                ->sortable()
                ->searchable(),

            Column::make('Full Address', 'address')
                ->sortable()
                ->searchable(),

            Column::make('B Name', 'b_name')
                ->sortable()
                ->searchable(),

            Column::make('B Relationship', 'b_f_name')
                ->sortable()
                ->searchable(),

            Column::make('B Mobile', 'b_mobile')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->toggleable(),

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
            Filter::inputText('address')->operators(['contains']),
            Filter::inputText('front')->operators(['contains']),
            Filter::inputText('back')->operators(['contains']),
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
     * PowerGrid Kyc Action Buttons.
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

    public function approve($id)
    {
        $kyc = Kyc::find($id['id']);
        $kyc->status = true;
        $kyc->save();

        $this->dispatchBrowserEvent('deleted', ['status' => 'KYC Approved!']);
    }

    public function delete($id)
    {
        $this->dispatchBrowserEvent('warning', ['id' => $id['id']]);
    }

    public function confirmedDelete($id)
    {
        $kyc = Kyc::find($id);
        $kyc->delete();

        $this->dispatchBrowserEvent('deleted', ['status' => 'Withdrawal Deleted Successfully']);
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Kyc Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($kyc) => $kyc->id === 1)
                ->hide(),
        ];
    }
    */
}
