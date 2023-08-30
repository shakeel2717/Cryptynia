@extends('layout.dashboard')
@section('title', 'All Users')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <livewire:admin.all-kyc-requests/>
            </div>
        </div>
    </div>
@endsection
