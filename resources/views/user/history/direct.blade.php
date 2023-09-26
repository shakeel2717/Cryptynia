@extends('layout.dashboard')
@section('title','All Direct Commissions')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <h2 class="card-title">@yield('title')</h2>
            <livewire:user.transactions :type="['Direct Commission']" />
        </div>
    </div>
</div>
@endsection