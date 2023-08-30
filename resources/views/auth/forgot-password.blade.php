@extends('layout.auth')
@section('form')
    <div class="card">
        <div class="card-body p-sm-5 m-lg-4">
            <div class="text-center mt-5">
                <h5 class="fs-3xl">Forgot Your Password?</h5>
                <p class="text-muted">Forgot your password? No problem. Just let us know your email address and we will
                    email you a password reset link that will allow you to choose a new one.</p>
            </div>
            <div class="p-2 mt-2">
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter Email"
                                class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" placeholder="Enter Username"
                                class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-danger w-100" type="submit">Email Password Reset Link</button>
                    </div>
                </form>

                <div class="text-center mt-5">
                    <p class="mb-0">
                        Remember Password?
                        <a href="{{ route('login') }}" class="fw-semibold text-secondary text-decoration-underline">
                            Sign In</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
