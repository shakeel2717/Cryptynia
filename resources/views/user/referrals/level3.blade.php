@extends('layout.dashboard')
@section('title', 'All Deposits')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <livewire:user.all-referrals type="level3" />
            </div>
        </div>
    </div>
@endsection
