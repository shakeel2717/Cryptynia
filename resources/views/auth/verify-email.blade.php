@extends('layout.auth')
@section('form')
    <div class="card">
        <div class="card-body p-sm-5 m-lg-4">
            <div class="text-center mt-5">
                <div class="mb-3">
                    <i class="bi bi-check-circle-fill display-1 text-success"></i>
                </div>
                <h5 class="fs-3xl">Please Verify Your Email to Continue</h5>
                <p class="text-muted">OTP Sent to your Email, kindly confirm OTP to verify your Email.</p>
            </div>
            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success my-4">
                    {{ __('New OTP Sent Successfully.') }}
                </div>
            @endif
            <div class="p-2 mt-2">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('verifyEmail') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="otp">Enter OTP</label>
                                <input type="text" name="otp" id="otp" class="form-control"
                                    placeholder="Enter OTP Here">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary mt-4 w-100" type="submit">Verify Email</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <form method="POST" action="{{ route('resendverifyOtp') }}">
                        @csrf
                        <button class="btn btn-danger"> Resend Verification Email </button>
                    </form>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger"> Log Out </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
