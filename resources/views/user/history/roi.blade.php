@extends('layout.dashboard')
@section('title','All Daily ROI Transactions')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <livewire:user.transactions :type="['Daily ROI']" />
        </div>
    </div>
</div>
@endsection