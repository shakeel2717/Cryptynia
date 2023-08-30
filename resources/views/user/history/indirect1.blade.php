@extends('layout.dashboard')
@section('title','In-Direct Commission L01')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <livewire:user.transactions :type="['In-Direct Commission L01']" />
        </div>
    </div>
</div>
@endsection