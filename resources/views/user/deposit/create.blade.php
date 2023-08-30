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
                        <div class="col-lg-4">
                            <p><strong>1. </strong>Select Payment Method</p>
                        </div>
                    </div>
                    <form action="{{ route('user.deposit.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            @foreach ($wallets as $wallet)
                                <div class="col-lg-6">
                                    <div class="form-check card-radio">
                                        <input id="paymentMethod{{ $loop->iteration }}" name="paymentMethod" type="radio"
                                            value="{{ $wallet->id }}" class="form-check-input"
                                            {{ $loop->first ? 'checked' : '' }}>
                                        <label class="form-check-label" for="paymentMethod{{ $loop->iteration }}">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="avatar">
                                                    <img src="{{ asset('methods/') }}/{{ $wallet->icon }}" width="40"
                                                        alt="{{ $wallet->name }}">
                                                </span>
                                                <span
                                                    class="fs-3xl float-end mt-2 text-wrap d-block fw-semibold">{{ $wallet->name }}
                                                    ({{ $wallet->symbol }}) ({{ $wallet->network }}) 
                                                </span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="amount">Amount in USD $ <span class="text-danger">*</span></label>
                                    <input type="text" name="amount" id="amount" class="form-control"
                                        placeholder="Enter Amount in USD">
                                        <small class="text-danger">Please Enter Amount in only USD</small>
                                </div>
                                <input type="hidden" name="exchange" value="Binance">
                            </div>
                            {{-- <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <label for="exchange">Exchange Name <span class="text-danger">*</span></label>
                                    <select name="exchange" id="exchange" class="form-control">
                                        <option value="">From which exchange will you be transferring funds?</option>
                                        <option value="Binance">Binance (Auto Approval)</option>
                                        <option value="Other">Other (Manual)</option>
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-danger btn-label"> Continue <i
                                    class="ph-arrow-fat-line-right label-icon align-middle fs-lg me-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
