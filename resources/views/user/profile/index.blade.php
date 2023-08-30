@extends('layout.dashboard')
@section('title', 'Account Setting')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <div class="d-flex align-items-start">
                    <div class="col-md-4">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active text-start" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true">Change Profile</button>
                            <button class="nav-link text-start" id="v-pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-profile" type="button" role="tab"
                                aria-controls="v-pills-profile" aria-selected="false">Change Password</button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="card-title">My Profile</h2>
                                        <form action="{{ route('user.profile.store') }}" method="POST">
                                            @csrf
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="fname">First Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="fname" id="fname"
                                                            class="form-control" placeholder="Enter Name"
                                                            value="{{ auth()->user()->fname }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="lname">Last Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="lname" id="lname"
                                                            class="form-control" placeholder="Last Name"
                                                            value="{{ auth()->user()->lname }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="email">Email Address <span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" name="email" id="email"
                                                            class="form-control" placeholder="Enter Email"
                                                            value="{{ auth()->user()->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="username">Username <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="username" id="username"
                                                            class="form-control" placeholder="Enter Username"
                                                            value="{{ auth()->user()->username }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="mobile">Mobile # <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="mobile" id="mobile"
                                                            class="form-control" placeholder="Enter Mobile"
                                                            value="{{ auth()->user()->mobile }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="country">Country <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="country" id="country"
                                                            class="form-control" placeholder="Enter Country"
                                                            value="{{ auth()->user()->country }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="sponser">Sponser <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="sponser" id="sponser"
                                                            class="form-control" placeholder="Sponser Username"
                                                            value="{{ auth()->user()->refer }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end mt-4">
                                                <button type="submit" class="btn btn-danger btn-label"> Update Profile <i
                                                        class="ph-arrow-fat-line-right label-icon align-middle fs-lg me-2"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="card-title">Update Password</h2>
                                        <form action="{{ route('user.profile.password') }}" method="POST">
                                            @csrf
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="cpassword">Current Password</label>
                                                        <div class="input-group mb-3">
                                                            <input type="password" name="cpassword" id="cpassword"
                                                                class="form-control" placeholder="Current Password"
                                                                aria-label="Password" aria-describedby="cpassword">
                                                            <button class="btn btn-outline-secondary" type="button"
                                                                id="togglePassword2">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="password">New Password</label>
                                                        <div class="input-group mb-3">
                                                            <input type="password" name="password" id="passwordInput"
                                                                class="form-control" placeholder="Password"
                                                                aria-label="Password" aria-describedby="togglePassword">
                                                            <button class="btn btn-outline-secondary" type="button"
                                                                id="togglePassword">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="password_confirmation">Confirm New Password</label>
                                                        <div class="input-group mb-3">
                                                            <input type="password" name="password_confirmation"
                                                                id="password_confirmation" class="form-control"
                                                                placeholder="Password" aria-label="Password"
                                                                aria-describedby="togglePassword">
                                                            <button class="btn btn-outline-secondary" type="button"
                                                                id="togglePassword3">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end mt-4">
                                                <button type="submit" class="btn btn-danger btn-label"> Update Password
                                                    <i
                                                        class="ph-arrow-fat-line-right label-icon align-middle fs-lg me-2"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        document.getElementById("togglePassword").addEventListener("click", function() {

            const passwordInput = document.getElementById("passwordInput");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    </script>

    <script>
        document.getElementById("togglePassword2").addEventListener("click", function() {

            const passwordInput = document.getElementById("cpassword");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    </script>
    <script>
        document.getElementById("togglePassword3").addEventListener("click", function() {

            const passwordInput = document.getElementById("password_confirmation");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    </script>
@endsection
