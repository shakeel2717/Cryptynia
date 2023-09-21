<div class="row">
    <form action="{{ route('user.withdraw.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            @foreach ($wallets as $wallet)
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-2 border rounded border-1 border-primary gap-2">
                        <input id="paymentMethod{{ $loop->iteration }}" name="paymentMethod" type="radio"
                            value="{{ $wallet->id }}" class="form-check-input" {{ $loop->first ? 'checked' : '' }}>
                        <label class="form-check-label" for="paymentMethod{{ $loop->iteration }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="avatar me-2">
                                    <img src="{{ asset('methods/') }}/{{ $wallet->icon }}" width="40"
                                        alt="{{ $wallet->name }}">
                                </span>
                                <span class="fs-3xl float-end mt-2 text-wrap d-block fw-semibold">{{ $wallet->name }}
                                    ({{ $wallet->symbol }})
                                    ({{ $wallet->network }})
                                </span>
                            </div>
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <label for="wallet">Wallet Address <span class="text-danger">*</span></label>
                    <input type="text" name="wallet" id="wallet" class="form-control"
                        placeholder="Enter Wallet Address">
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <label for="amount">Amount in USD <span class="text-danger">*</span></label>
                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount">
                    <small>Withdraw Fees: {{ site_option('withdraw_fees') }}%</small>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <label for="code">OTP (One Time Passcode) <span class="text-danger">*</span></label>
                    <input type="text" name="code" id="code" class="form-control" placeholder="Enter OTP here">
                    <small><a href="javascript:void(0);" wire:click="generateOtp">Request OTP Code</a></small>
                </div>
            </div>
        </div>
        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary btn-label"> Withdraw Reqeust <i
                    class="ph-arrow-fat-line-right label-icon align-middle fs-lg me-2"></i></button>
        </div>
    </form>
</div>
