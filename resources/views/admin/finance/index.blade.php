@extends('layout.dashboard')
@section('title','Deposit')
@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Deposit Funds</h2>
                <hr>
                <div class="row">
                    <div class="col-lg-4">
                        <p><strong>1. </strong>Type User's Name</p>
                    </div>
                </div>
                <form action="{{ route('admin.finance.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter User's Usernames">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="amount">Amount</label>
                                <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check card-radio">
                                    <input id="add" name="add" type="radio" value="1" class="form-check-input" checked>
                                    <label class="form-check-label" for="add">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="avatar">
                                                <i class="ri-add-circle-line fs-1"></i>
                                            </span>
                                            <span class="fs-3xl float-end mt-2 text-wrap d-block fw-semibold">Add</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check card-radio">
                                    <input id="subtract" name="add" type="radio" value="0" class="form-check-input">
                                    <label class="form-check-label" for="subtract">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="avatar">
                                                <i class=" ri-indeterminate-circle-line fs-1"></i>
                                            </span>
                                            <span class="fs-3xl float-end mt-2 text-wrap d-block fw-semibold">Subtract</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="Deposit">Deposit</option>
                                    <option value="Balance Adjust">Balance Adjust</option>
                                    <option value="Daily ROI">Daily ROI</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-danger btn-label"> Confirm <i class="ph-arrow-fat-line-right label-icon align-middle fs-lg me-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection