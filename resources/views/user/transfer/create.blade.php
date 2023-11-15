@extends('layout.dashboard')
@section('title', 'Withdraw Request')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Transfer Funds </h2>
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
                        <div class="col-md-12">
                            <form action="{{ route('user.transfer.store') }}" method="POST">
                                @csrf
                                <div class="from-group">
                                    <label for="username">Enter Recipient Username</label>
                                    <input type="text" name="username" id="username" class="form-control mt-2"
                                        placeholder="Enter Recipient Username">
                                </div>
                                <br>
                                <div class="from-group">
                                    <label for="amount">Amount to Transfer</label>
                                    <input type="text" name="amount" id="amount" class="form-control mt-2"
                                        placeholder="Amount to Transfer">
                                </div>
                                <div class="from-group">
                                    <button type="submit" class="btn btn-primary mt-4">Transfer Fund now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
