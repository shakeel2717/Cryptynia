@extends('layout.dashboard')
@section('title','Ranks & Rewards')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">All Ranks</h2>
                <hr>
                @foreach ($rewards as $reward)
                <div class="card border {{ checkRewardStatus($reward->id, auth()->user()->id) ? 'border-danger' : 'border-dark' }}  p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="ph-medal {{ checkRewardStatus($reward->id, auth()->user()->id) ? 'text-danger' : 'text-light' }} display-5 me-2"></i>
                            <h4 class="{{ checkRewardStatus($reward->id, auth()->user()->id) ? 'text-danger' : 'text-light' }} text-uppercase">{{ $reward->name }} <small>(${{ number_format($reward->business,2) }})</small></h4>
                        </div>
                        <div class="reward">
                            <h4 class="{{ checkRewardStatus($reward->id, auth()->user()->id) ? 'text-danger' : 'text-light' }} text-uppercase">${{ number_format($reward->reward,2) }}</h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection