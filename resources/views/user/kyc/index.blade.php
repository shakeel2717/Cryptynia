@extends('layout.dashboard')
@section('title', 'Account Setting')
@section('content')
    @if (auth()->user()->kyc && auth()->user()->kyc->status == false)
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="alert alert-primary">
                    Your KYC Request is Under Review!
                </div>
            </div>
        </div>
    @elseif (auth()->user()->kyc && auth()->user()->kyc->status == true)
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="alert alert-success">
                    Your KYC Request is Successfully Approved!
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Account Verification</h2>
                    <form action="{{ route('user.kyc.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="cnic">CNIC/Passport/Driving license<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="cnic" id="cnic" class="form-control"
                                        placeholder="Enter CNIC/Passport/Driving license" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                                    <input type="text" name="dob" id="dob" class="form-control"
                                        placeholder="DD/MM/YYYY" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="address">Address<span class="text-danger">*</span></label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        placeholder="Enter Full Address" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-dark">
                                    <div class="text-center">
                                        <img src="{{ asset('front.png') }}" class="mb-3" alt="ID Card" width="150">
                                    </div>
                                    <div class="form-group">
                                        <label for="front" class="text-white">Front Side</label>
                                        <input type="file" name="front" id="front" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-dark">
                                    <div class="text-center">
                                        <img src="{{ asset('back.png') }}" class="mb-3" alt="ID Card" width="150">
                                    </div>
                                    <div class="form-group">
                                        <label for="back" class="text-white">Back Side</label>
                                        <input type="file" name="back" id="back" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-danger btn-label"> Submit KYC Request <i
                                    class="ph-arrow-fat-line-right label-icon align-middle fs-lg me-2"></i></button>
                        </div>
                        <small>Note: * KYC Approval can take upto 24 Hours.</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
