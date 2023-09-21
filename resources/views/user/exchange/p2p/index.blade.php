@extends('layout.dashboard')
@section('title')
    Welcome Back {{ auth()->user()->username }}
@endsection
@section('content')
    @include('inc.p2p_recieve')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body mb-4">
                <h2 class="card-title">All Orders List</h2>
                @forelse ($exchanges->where('status',true) as $exchange)
                    <div class="card shadow-lg mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h4 class="mb-2 text-uppercase"><small>{{ $exchange->user->username }}:</small>
                                        ${{ number_format($exchange->amount, 2) }}/- @ <span
                                            class="text-success">Rs:{{ number_format($exchange->price, 2) }}/-</span></h4>
                                    <h6 class="text-uppercase mb-2">{{ $exchange->created_at->diffForHumans() }}</h6>
                                </div>
                                <div class="text-end">
                                    <a href="{{ route('user.exchange.show', ['exchange' => $exchange->id]) }}"
                                        class="btn btn-primary btn-sm">Buy</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="text-success">NO Transaction Found</h4>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
