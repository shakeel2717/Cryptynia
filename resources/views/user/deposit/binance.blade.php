@extends('layout.dashboard')
@section('title', 'Deposit')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Deposit Funds</h2>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="mb-2"><strong>1. </strong>Please Send
                                <strong>{{ number_format(getDepositAmount($wallet->symbol, $finalAmount), 8) }}
                                    {{ $wallet->name }} </strong> to
                                the
                                following address
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="py-2 px-3 border border-dashed rounded">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="fs-md text-truncate"><a href="#!" class="text-reset">Selected
                                                Currency</a>
                                        </h6>
                                        <p class="text-muted mb-0">Network: {{ $wallet->network }}</p>
                                        <small>Please note that only supported networks on Binance platform are shown, if
                                            you deposit via another network your assets may be lost.</small>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="fs-md text-primary mb-0">{{ $wallet->name }} ({{ $wallet->symbol }})</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="py-2 px-3 border border-dashed rounded">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="fs-md text-truncate"><a href="#!" class="text-reset">Amount in
                                                USD</a></h6>
                                        <p class="text-muted mb-0">Amount in USD</p>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="fs-md text-primary mb-0">${{ number_format($amount, 2) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="py-2 px-3 border border-dashed rounded">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="fs-md text-truncate"><a href="#!" class="text-reset">Fees</a></h6>
                                        <p class="text-muted mb-0">Deposit Fees</p>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="fs-md text-primary mb-0">${{ number_format($fees, 2) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="py-2 px-3 border border-dashed rounded">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="fs-md text-truncate"><a href="#!" class="text-reset">Total
                                                Amount in USD</a></h6>
                                        <p class="text-muted mb-0">Total Amount (Includd Tax + Charges)</p>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="fs-md text-primary mb-0">${{ number_format($amount, 2) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="py-2 px-3 border border-dashed rounded">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="fs-md text-truncate"><a href="#!" class="text-reset">Total
                                                Amount in {{ $wallet->name }}</a></h6>
                                        <p class="text-muted mb-0">Total Amount (Includd Tax + Charges)</p>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="fs-md text-primary mb-0">
                                            {{ number_format(getDepositAmount($wallet->symbol, $finalAmount), 8) }}
                                            {{ $wallet->symbol }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body shadow-lg">
                                    <h2 class="card-title mb-0 text-center">
                                        Please Send
                                        <strong
                                            class="text-danger">{{ number_format(getDepositAmount($wallet->symbol, $finalAmount), 8) }}
                                            {{ $wallet->name }} </strong> to the following Wallet address
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <form action="{{ route('user.deposit.verify') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-2">
                                            <label for="wallet_address">Wallet Address</label>
                                            <input type="text" name="wallet_address" id="wallet_address"
                                                class="form-control text-center text-dark" placeholder="API Address"
                                                value="{{ $wallet->wallet }}" readonly>
                                            <small class="mt-4">Send your Funds to This Wallet Address</small>
                                        </div>
                                        <input type="hidden" name="amount" value="{{ $amount }}">
                                        <input type="hidden" name="finalAmount" value="{{ $finalAmount }}">
                                        <input type="hidden" name="wallet_id" value="{{ $wallet->id }}">

                                        <div class="form-group">
                                            <label for="network">Network</label>
                                            <input type="text" name="network" id="network"
                                                class="form-control text-center text-dark" placeholder="API Address"
                                                value="{{ $wallet->network }}" readonly>
                                            <small class="mt-4">Please note that only supported networks are shown, if you
                                                deposit via another network your assets may be lost.</small>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="hash_id">Transaction ID/Hash <span class="text-danger">*</span></label>
                                            <input type="text" name="hash_id" id="hash_id" class="form-control">
                                            <small>After Payment Sent, Copy Transaction Id/ Hash and Past here, then Press Submit</small>
                                        </div>
                                        <div class="form-group mb-4">
                                            <button type="submit" class="btn btn-primary mt-3">Verify Deposit</button>
                                        </div>
                                    </div>
                                </div>
                                <p class="">Your Funds will be automaticaly added into your account.</p>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl={{ $wallet->wallet }}&chld=L|1&choe=UTF-8"
                                    alt="Address">
                                <div class="row">
                                    <small class="mt-4">Wallet: {{ $wallet->wallet }} <br> & Amount:
                                        {{ number_format(getDepositAmount($wallet->symbol, $finalAmount), 8) }}
                                        {{ $wallet->symbol }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
