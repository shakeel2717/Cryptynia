@extends('layout.auth')
@section('form')
    <div class="card">
        <div class="card-body p-sm-5 m-lg-4">
            <div class="text-center mt-5">
                <h5 class="fs-3xl">Reset Password</h5>
            </div>
            <div class="p-2 mt-2">
                <form action="{{ route('password.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter Email"
                                class="form-control" value="{{ $request->email }}" readonly>
                            <input type="hidden" name="token" id="tokeen" value="{{ $request->token }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" placeholder="Enter Username"
                                class="form-control" value="{{ $request->username }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password" placeholder="New Password"
                                class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="password_confirmation">Cofnrim New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Confirm New Password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-danger w-100" type="submit">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
