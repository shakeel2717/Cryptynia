@extends('layout.dashboard')
@section('title', 'Withdraw Request')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Withdrawal Funds </h2>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card bg-primary shadow-lg card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i class="ph-wallet fs-1"></i>
                                        <h4 class="card-title mb-0 ms-2">Available Balance</h4>
                                    </div>
                                    <h2 class="card-title mb-0">${{ number_format(balance(auth()->user()->id), 2) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-2">
                            <p><strong>1. </strong>Select Payment Method</p>
                        </div>
                    </div>
                    @livewire('withdraw-box')
                </div>
            </div>
        </div>
    </div>
@endsection
