@extends('layout.dashboard')
@section('title','All ROI')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <livewire:admin.transactions :type="['Daily ROI']" />
        </div>
    </div>
</div>
@endsection