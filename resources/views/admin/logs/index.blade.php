@extends('layout.dashboard')
@section('title', 'All Users Logs')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <livewire:admin.all-log-history />
            </div>
        </div>
    </div>
@endsection
