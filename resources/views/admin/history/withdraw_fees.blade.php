@extends('layout.dashboard')
@section('title','All Withdrawal Fees')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <livewire:admin.transactions :type="['Withdraw Fees']" />
        </div>
    </div>
</div>
@endsection