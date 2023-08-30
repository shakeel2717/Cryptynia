@extends('layout.dashboard')
@section('title','All Deposits')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <livewire:user.transactions :type="['Deposit']" />
        </div>
    </div>
</div>
@endsection