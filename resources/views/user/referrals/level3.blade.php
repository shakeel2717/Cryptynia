@extends('layout.dashboard')
@section('title', 'All In-Direct L03 Referrals')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h2 class="card-title">@yield('title')</h2>
                <livewire:user.all-referrals type="level3" />
            </div>
        </div>
    </div>
@endsection
