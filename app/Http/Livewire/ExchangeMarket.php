<?php

namespace App\Http\Livewire;

use App\Models\Exchange;
use Livewire\Component;

class ExchangeMarket extends Component
{
    public $exchanges;
    public $currencyFilter = 'PKR';

    public function mount()
    {
        $this->exchanges = Exchange::where('status', true)->where('currency', 'like', '%' . $this->currencyFilter . '%')->get();
    }

    public function search()
    {
        $this->mount();
    }

    public function render()
    {
        return view('livewire.exchange-market');
    }
}
