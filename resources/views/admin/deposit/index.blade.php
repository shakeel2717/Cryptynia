@extends('layout.dashboard')
@section('title', 'All Deposits')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <livewire:admin.all-deposits />
            </div>
        </div>
    </div>
@endsection
