@extends('layout.dashboard')
@section('title','All Recent Transactions')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <h2 class="card-title">@yield('title')</h2>
            <livewire:user.transactions :type="['Deposit','Withdraw','Withdraw Fees','Daily ROI','Direct Commission']" />
        </div>
    </div>
</div>
@endsection