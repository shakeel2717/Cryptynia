@extends('layout.dashboard')
@section('title', 'Withdraw Request')
@section('content')
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
                                        <h4 class="card-title mb-0 ms-2">Your Balance</h4>
                                    </div>
                                    <h2 class="card-title mb-0">${{ number_format(balance(auth()->user()->id), 2) }}</h2>
                                </div>
                            </div>
                            <div class="card bg-primary shadow-lg card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i class="ph-wallet fs-1"></i>
                                        <h4 class="card-title mb-0 ms-2">Max Purcahse</h4>
                                    </div>
                                    <h2 class="card-title mb-0">${{ number_format($exchange->amount, 2) }}</h2>
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
                                    <label for="amount">USDT Amount <span class="text-danger">*</span></label>
                                    <input type="number" name="amount" id="amount" class="form-control"
                                        placeholder="Enter Amount" max="{{ $exchange->amount }}" onchange="getTotalAmount()" value="{{ $exchange->amount }}">
                                    <small>Enter USDT Amount you want to Purchase</small>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="price">Price in PKR <span class="text-danger">*</span></label>
                                    <input type="text" id="price" value="{{ $exchange->price }}"
                                        class="form-control text-dark" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price">Total Amount to Paid <span class="text-danger">*</span></label>
                                    <input type="text" id="total" value="" class="form-control text-dark"
                                        readonly>
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
@section('footer')
    <script>
        function getTotalAmount(){
            var amount = document.getElementById('amount').value;
            var price = document.getElementById('price').value;
            var total = amount * price;
            document.getElementById('total').value = total;
        }
        getTotalAmount();
    </script>
@endsection
