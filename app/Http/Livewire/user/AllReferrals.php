<?php

namespace App\Http\Livewire\user;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class AllReferrals extends PowerGridComponent
{
    use ActionButton;

    public $type;

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource(): ?Collection
    {
        switch ($this->type) {
            case 'direct':
                return auth()->user()->directReferrals;
                break;

            case 'level1':
                foreach (auth()->user()->directReferrals as $level1Referrals) {
                    return $level1Referrals->directReferrals;
                }
                break;

            case 'level2':
                foreach (auth()->user()->directReferrals as $level1Referrals) {
                    foreach ($level1Referrals->directReferrals as $level2Referrals) {
                        return $level2Referrals->directReferrals;
                    }
                }
                break;

            case 'level3':
                foreach (auth()->user()->directReferrals as $level1Referrals) {
                    foreach ($level1Referrals->directReferrals as $level2Referrals) {
                        foreach ($level2Referrals->directReferrals as $level3Referrals) {
                            return $level3Referrals->directReferrals;
                        }
                    }
                }
                break;

            default:
                return auth()->user()->directReferrals;
                break;
        }
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
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
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('email')
            ->addColumn('investment', function ($entry) {
                return getActivePlan($entry->id);
            })
            ->addColumn('created_at_formatted', function ($entry) {
                return Carbon::parse($entry->created_at)->format('d/m/Y');
            });
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

            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),

            Column::make('Name', 'username')
                ->searchable()
                ->sortable(),

            Column::make('Email', 'email')
                ->searchable()
                ->sortable(),

            Column::make('Investment', 'investment')
                ->searchable()
                ->sortable(),

            Column::make('Created', 'created_at_formatted'),
        ];
    }
}
