@extends('layout.dashboard')
@section('title')
    Welcome Back {{ auth()->user()->username }}
@endsection
@section('content')
    <div class="row">
        @include('inc.box', [
            'title' => 'Available Balance',
            'value' => number_format(balance(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Total Income',
            'value' => number_format(totalIncome(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Total Withdrawal',
            'value' => number_format(getAllWithdraw(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Today ROI',
            'value' => number_format(todayRoi(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Today Withdrawal',
            'value' => number_format(getTodayWithdraw(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Total ROI',
            'value' => number_format(totalRoi(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Total Direct Commission',
            'value' => number_format(totalDirectCommission(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Total ROI',
            'value' => number_format(totalRoi(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Total ROI',
            'value' => number_format(totalRoi(auth()->user()->id), 2),
        ])
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body mb-4">
                <h2 class="card-title">Recent Transactions</h2>
                @forelse (auth()->user()->transactions()->latest()->take(10)->get() as $transaction)
                    <div class="card shadow-lg mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h4 class="mb-2 {{ $transaction->sum ? 'text-success' : 'text-danger' }}">
                                        ${{ number_format($transaction->amount, 2) }}</h4>
                                    <h4 class="text-uppercase mb-0">{{ $transaction->type }}</h4>
                                    <p class="text-uppercase mb-0"><small>{{ $transaction->reference }}</small></p>
                                </div>
                                <div class="text-end">
                                    <h6 class="text-uppercase mb-2">{{ $transaction->created_at }}</h6>
                                    <h6 class="text-uppercase mb-0">{{ $transaction->status ? 'Approved' : 'Pending' }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="text-success">NO Transaction Found</h4>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body mb-4">
                <h2 class="card-title">All Active Packages</h2>
                @forelse (auth()->user()->userPlans()->latest()->take(10)->get() as $plan)
                    <div class="card shadow-lg mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h4 class="mb-2 {{ $plan->sum ? 'text-success' : 'text-danger' }}">
                                        ${{ number_format($plan->amount, 2) }}</h4>
                                    <h4 class="text-uppercase mb-0">{{ $plan->plan->name }}</h4>
                                </div>
                                <div class="text-end">
                                    <h6 class="text-uppercase mb-2">{{ $plan->created_at->diffForHumans() }}</h6>
                                    <h6 class="text-uppercase mb-0">{{ $plan->status ? 'Active' : 'Expired' }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="text-success">NO Transaction Found</h4>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
