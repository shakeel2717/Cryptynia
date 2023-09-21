@extends('layout.dashboard')
@section('title', 'Withdraw Request')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Buy USDT </h2>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-4">
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
                    <form action="{{ route('user.order.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <hr>
                        <input type="hidden" name="exchange_id" value="{{ $exchange->id }}">
                        <div class="card bg-success shadow-lg card-body mb-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="ph-wallet fs-1"></i>
                                    <h4 class="card-title mb-0 ms-2">Please send Payment to This Bank Account, and then uplaod screenshot and submit for review</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h3 class="title mb-3">
                                    Seller Bank Detail
                                </h3>
                            </div>
                            <div class="col-md-12">
                                <div class="py-2 px-3 border border-dashed rounded">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h6 class="fs-md text-truncate">
                                                <a href="#!" class="text-reset">Bank Name</a>
                                            </h6>
                                            <p class="text-muted mb-0">This is Seller Bank, Send Payment on this Bank</p>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="fs-md text-primary mb-0">{{ $exchange->user->account->bank_name }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="py-2 px-3 border border-dashed rounded">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h6 class="fs-md text-truncate">
                                                <a href="#!" class="text-reset">Bank Account Title</a>
                                            </h6>
                                            <p class="text-muted mb-0">Confirm this Seller Title before sending Payment</p>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="fs-md text-primary mb-0">
                                                {{ $exchange->user->account->account_title }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="py-2 px-3 border border-dashed rounded">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h6 class="fs-md text-truncate">
                                                <a href="#!" class="text-reset">Bank Account Number</a>
                                            </h6>
                                            <p class="text-muted mb-0">Seller Bank Account Number/ IBAN</p>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="fs-md text-primary mb-0">
                                                {{ $exchange->user->account->account_number }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="amount">USDT Amount <span class="text-danger">*</span></label>
                                    <input type="number" name="amount" id="amount" class="form-control"
                                        placeholder="Enter Amount" max="{{ $exchange->amount }}" onchange="getTotalAmount()"
                                        value="{{ $exchange->amount }}">
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
                                    <label for="price">Total Amount to Paid in PKR <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="total" value="" class="form-control text-dark"
                                        readonly>
                                    <small>Send <span id="total_notice"></span> PKR to Seller Account and then
                                        upload screenshot</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-3">
                                    <label for="screenshot">Upload Payment Screenshot <span
                                            class="text-danger">*</span></label>
                                    <input type="file" id="screenshot" name="screenshot" value="screenshot"
                                        class="form-control text-dark" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary btn-lg">Submit for Review</button>
                                </div>
                                <div class="form-group mt-3">
                                    <small>*Your USDT Balance will be add to your Account Balance Once your Payment
                                        Verified</small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        function getTotalAmount() {
            var amount = document.getElementById('amount').value;
            var price = document.getElementById('price').value;
            var total = amount * price;
            document.getElementById('total').value = total;
            document.getElementById('total_notice').innerHTML = total;
        }
        getTotalAmount();
    </script>
@endsection
