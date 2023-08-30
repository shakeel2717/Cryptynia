@extends('layout.auth')
@section('form')
<div class="card">
    <div class="card-body p-sm-5 m-lg-4">
        <div class="text-center mt-5">
            <div class="mb-3">
                <i class="bi bi-check-circle-fill display-1 text-success"></i>
            </div>
            <h5 class="fs-3xl">Please Verify Your Email to Continue</h5>
            <p class="text-muted">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>
        </div>
        @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success my-4">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
        @endif
        <div class="p-2 mt-2">
            <div class="d-flex justify-content-between">
                <form method="POST" action="{{ route('verification.send') }}">
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