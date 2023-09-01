@extends('layout.dashboard')
@section('title', 'Withdraw Request')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">Add Your Bank Detail to Recieve Payments </h2>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            @if (empty(auth()->user()->account->bank_name) &&
                                    empty(auth()->user()->account->account_title) &&
                                    empty(auth()->user()->account->account_title))
                                <div class="card bg-danger shadow-lg card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="ph-wallet fs-1"></i>
                                            <h4 class="card-title mb-0 ms-2">Please Update your Payment Detail before Place
                                                Order</h4>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card bg-success shadow-lg card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="ph-wallet fs-1"></i>
                                            <h4 class="card-title mb-0 ms-2">Your Payment Profile is Updated</h4>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <form action="{{ route('user.account.store') }}" method="POST">
                        @csrf
                        <hr>
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name <span class="text-danger">*</span></label>
                                    <input type="text" name="bank_name" id="bank_name" class="form-control"
                                        placeholder="Bank Name, Example: Mobicash, Allied Bank etc."
                                        value="{{ auth()->user()->account->bank_name ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="account_number">Account Number <span class="text-danger">*</span></label>
                                    <input type="text" name="account_number" id="account_number" class="form-control"
                                        placeholder="IBAN, or Account Number"
                                        value="{{ auth()->user()->account->account_number ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="account_title">Account Title <span class="text-danger">*</span></label>
                                    <input type="text" name="account_title" id="account_title" class="form-control"
                                        placeholder="Your Bank Account Title"
                                        value="{{ auth()->user()->account->account_title ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary btn-label"> Update Bank Detail <i
                                    class="ph-arrow-fat-line-right label-icon align-middle fs-lg me-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Sell USDT </h2>
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
                    <form action="{{ route('user.exchange.store') }}" method="POST">
                        @csrf
                        <hr>
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="amount">Amount in USDT <span class="text-danger">*</span></label>
                                    <input type="text" name="amount" id="amount" class="form-control"
                                        placeholder="Enter Amount">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price">Price in PKR <span class="text-danger">*</span></label>
                                    <input type="text" name="price" id="price" class="form-control"
                                        placeholder="Enter Price">
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary btn-label"> Sell USDT <i
                                    class="ph-arrow-fat-line-right label-icon align-middle fs-lg me-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
