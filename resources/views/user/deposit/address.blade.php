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
                            <p><strong>1. </strong>Please Send
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
                                        <h5 class="fs-md text-primary mb-0">${{ number_format($finalAmount, 2) }}</h5>
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
                                        <strong class="text-danger">{{ number_format(getDepositAmount($wallet->symbol, $finalAmount), 8) }}
                                            {{ $wallet->name }} </strong> to the following Wallet address
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <form action="{{ route('user.deposit.verify') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label for="amount">Wallet Address</label>
                                            <input type="text" name="amount" id="amount"
                                                class="form-control text-center" placeholder="Enter Amount"
                                                value="{{ $wallet->address }}" readonly>
                                            <small>Send your Funds to This Wallet Address</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label for="hash_id">Transaction ID, Hash ID <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="hash_id" id="hash_id" class="form-control"
                                                placeholder="Enter Your Hash ID">
                                            <small>Enter Your Payment Transaction Id / Reference Id</small>
                                            <input type="hidden" name="wallet_id" value="{{ $wallet->id }}">
                                            <input type="hidden" name="exchange" value="{{ $exchange }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="finalAmount" value="{{ $finalAmount }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label for="screenshot">Upload Screenshot <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="screenshot" id="screenshot" class="form-control"
                                                placeholder="Screenshot / Payment Proof">
                                            <small>After Payment Succesfull, Take a screenshot and Attach here.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-danger btn-label"> Send Deposit Request <i
                                            class="ph-arrow-fat-line-right label-icon align-middle fs-lg me-2"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl={{ $wallet->address }}&chld=L|1&choe=UTF-8"
                                    alt="Address">
                                <div class="row">
                                    <small>Wallet: {{ $wallet->address }} & Amount:
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
