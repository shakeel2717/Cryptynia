@extends('layout.dashboard')
@section('title')
    Welcome Back {{ auth()->user()->username }}
@endsection
@section('content')
    @include('inc.p2p_recieve')
    @livewire('exchange-market')
@endsection
