<?php

namespace App\Http\Livewire;

use App\Mail\GenerateOtp;
use App\Models\Wallet;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class WithdrawBox extends Component
{
    public $wallets;


    public function mount()
    {
        $this->wallets = Wallet::where('status', true)->get();
    }


    public function generateOtp()
    {
        // generating token
        $token = str()->random(8);
        session(['token' => $token]);
        Mail::to(auth()->user()->email)->send(new GenerateOtp($token));

        $this->dispatchBrowserEvent('deleted', ['status' => 'OTP Sent to your Email']);
    }

    public function render()
    {
        return view('livewire.withdraw-box');
    }
}
