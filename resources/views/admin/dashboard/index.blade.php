@extends('layout.dashboard')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">{{ App\Models\User::whereDate('created_at', '>=', newDateTimeForStats())->count() }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Total Users</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        {{ App\Models\User::whereDate('created_at', '>=', newDateTimeForStats())->where('status', 'active')->count() }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Active Users</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        {{ App\Models\User::whereDate('created_at', '>=', newDateTimeForStats())->where('status', 'pending')->count() }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Pending Users</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        {{ App\Models\User::whereDate('created_at', '>=', newDateTimeForStats())->where('status', 'suspend')->count() }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Suspended Users</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- <div class="col-md-3">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(App\Models\Transaction::whereDate('created_at', '>=', newDateTimeForStats())->where('type', 'Deposit')->where('status', true)->sum('amount')) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Total Approved Deposit</p>
                </div>
            </div>
        </div> --}}
        <div class="col-md-3">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(App\Models\Transaction::whereDate('created_at', '>=', newDateTimeForStats())->where('type', 'Deposit')->where('status', false)->sum('amount'),2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Total Pending Deposit</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(totalRealDeposit(), 2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Real Deposit</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(App\Models\Transaction::where('type', 'Deposit')->where('status', true)->whereDate('created_at', now()->today())->sum('amount'),2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Today Deposit</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- <div class="col-md-4">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(totalInvestment(), 2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Total Investment <small>(with Upgrade
                            Amount)</small></p>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-md-4">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(totalPinInvestment(), 2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Total PIN Investment</p>
                </div>
            </div>
        </div> --}}
        <div class="col-md-4">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(totalRealInvestment(), 2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Total Real Investment</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(App\Models\Transaction::where('type', 'Withdraw')->whereDate('created_at', '>=', newDateTimeForStats())->sum('amount'),2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Total Withdrawals</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(App\Models\Transaction::where('type', 'Withdraw')->where('status', false)->whereDate('created_at', '>=', newDateTimeForStats())->sum('amount'),2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Pending Withdrawals</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(App\Models\Transaction::where('type', 'Withdraw')->where('status', true)->whereDate('created_at', '>=', newDateTimeForStats())->sum('amount'),2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Approved Withdrawals</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(App\Models\Transaction::where('type', 'Daily ROI')->whereDate('created_at', '>=', newDateTimeForStats())->where('status', true)->sum('amount'),2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Total Daily ROI</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(App\Models\Transaction::where('type', 'Daily ROI')->where('status', true)->whereDate('created_at', now()->today())->sum('amount'),2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Today Daily ROI</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(App\Models\Transaction::where('type', 'Direct Commission')->whereDate('created_at', '>=', newDateTimeForStats())->where('status', true)->sum('amount'),2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Total Direct Commission</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(App\Models\Transaction::where('type', 'Direct Commission')->where('status', true)->whereDate('created_at', now()->today())->sum('amount'),2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Today Direct Commission</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(App\Models\Transaction::where('type', 'Binary Commission')->whereDate('created_at', '>=', newDateTimeForStats())->where('status', true)->sum('amount'),2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Total Binary Commission</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-bottom border-3 card-animate border-danger">
                <div class="card-body">
                    <span class="avatar-sm text-success float-end">
                        <span class="avatar-title bg-primary-subtle text-danger rounded-circle fs-3">
                            <i class="ph-wallet"></i>
                        </span>
                    </span>
                    <h4 class="mb-4">
                        ${{ number_format(App\Models\Transaction::where('type', 'Binary Commission')->where('status', true)->whereDate('created_at', now()->today())->sum('amount'),2) }}
                    </h4>
                    <p class="text-muted fw-medium text-uppercase mb-0">Today Binary Commission</p>
                </div>
            </div>
        </div>
    </div>
@endsection
