@extends('layout.dashboard')
@section('content')
    <div class="row">
        @include('inc.box', [
            'title' => 'Total Users',
            'value' => App\Models\User::whereDate('created_at', '>=', newDateTimeForStats())->count(),
        ])
        @include('inc.box', [
            'title' => 'Active Users',
            'value' => App\Models\User::whereDate('created_at', '>=', newDateTimeForStats())->where('status', 'active')->count(),
        ])
        @include('inc.box', [
            'title' => 'Pending Users',
            'value' => App\Models\User::whereDate('created_at', '>=', newDateTimeForStats())->where('status', 'pending')->count(),
        ])
        @include('inc.box', [
            'title' => 'Suspended Users',
            'value' => number_format(
                App\Models\Transaction::whereDate('created_at', '>=', newDateTimeForStats())->where('type', 'Deposit')->where('status', true)->sum('amount')),
        ])
        @include('inc.box', [
            'title' => 'Total Approved Deposit',
            'value' => number_format(
                App\Models\Transaction::whereDate('created_at', '>=', newDateTimeForStats())->where('type', 'Deposit')->where('status', false)->sum('amount'),
                2),
        ])
        @include('inc.box', [
            'title' => 'Total Pending Deposit',
            'value' => App\Models\User::whereDate('created_at', '>=', newDateTimeForStats())->count(),
        ])
        @include('inc.box', [
            'title' => 'Real Deposit',
            'value' => number_format(totalRealDeposit(), 2),
        ])
        @include('inc.box', [
            'title' => 'Today Deposit',
            'value' => number_format(
                App\Models\Transaction::where('type', 'Deposit')->where('status', true)->whereDate('created_at', now()->today())->sum('amount'),
                2),
        ])
        @include('inc.box', [
            'title' => 'Total Investment',
            'value' => number_format(totalInvestment(), 2),
        ])
        @include('inc.box', [
            'title' => 'Total PIN Investment',
            'value' => number_format(totalPinInvestment(), 2),
        ])
        @include('inc.box', [
            'title' => 'Total Real Investment',
            'value' => number_format(totalRealInvestment(), 2),
        ])
        @include('inc.box', [
            'title' => 'Total Withdrawals',
            'value' => number_format(
                App\Models\Transaction::where('type', 'Withdraw')->whereDate('created_at', '>=', newDateTimeForStats())->sum('amount'),
                2),
        ])
        @include('inc.box', [
            'title' => 'Pending Withdrawals',
            'value' => number_format(
                App\Models\Transaction::where('type', 'Withdraw')->where('status', false)->whereDate('created_at', '>=', newDateTimeForStats())->sum('amount'),
                2),
        ])
        @include('inc.box', [
            'title' => 'Approved Withdrawals',
            'value' => number_format(
                App\Models\Transaction::where('type', 'Withdraw')->where('status', true)->whereDate('created_at', '>=', newDateTimeForStats())->sum('amount'),
                2),
        ])
        @include('inc.box', [
            'title' => 'Total Daily ROI',
            'value' => number_format(
                App\Models\Transaction::where('type', 'Daily ROI')->whereDate('created_at', '>=', newDateTimeForStats())->where('status', true)->sum('amount'),
                2),
        ])
        @include('inc.box', [
            'title' => 'Today Daily ROI',
            'value' => number_format(
                App\Models\Transaction::where('type', 'Daily ROI')->where('status', true)->whereDate('created_at', now()->today())->sum('amount'),
                2),
        ])
        @include('inc.box', [
            'title' => 'Total Direct Commission',
            'value' => number_format(
                App\Models\Transaction::where('type', 'Direct Commission')->whereDate('created_at', '>=', newDateTimeForStats())->where('status', true)->sum('amount'),
                2),
        ])
        @include('inc.box', [
            'title' => 'Today Direct Commission',
            'value' => number_format(
                App\Models\Transaction::where('type', 'Direct Commission')->where('status', true)->whereDate('created_at', now()->today())->sum('amount'),
                2),
        ])
    </div>
@endsection
