@extends('layout.dashboard')
@section('title', 'All Active Plans')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h2 class="card-title">@yield('title')</h2>
                <livewire:user.all-active-plans />
            </div>
        </div>
    </div>
@endsection
