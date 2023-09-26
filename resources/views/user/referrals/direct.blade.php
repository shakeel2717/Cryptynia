@extends('layout.dashboard')
@section('title', 'All Direct Referrals')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h2 class="card-title">@yield('title')</h2>
                <livewire:user.all-referrals type="direct" />
            </div>
        </div>
    </div>
@endsection
