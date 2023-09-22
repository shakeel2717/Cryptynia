@extends('layout.dashboard')
@section('title', 'Ranks & Rewards')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">All Ranks & Rewards</h2>
                    <hr>
                    @foreach ($rewards as $reward)
                        <div
                            class="card mb-3 border {{ checkTeamRewardStatus($reward->id, auth()->user()->id) ? 'border-success' : 'border-dark' }}  py-4 px-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <h4
                                        class="{{ checkTeamRewardStatus($reward->id, auth()->user()->id) ? 'text-success' : 'text-light' }} text-uppercase">
                                        {{ $reward->name }} <small>(${{ number_format($reward->business, 2) }})</small></h4>
                                </div>
                                <div class="reward">
                                    <h4
                                        class="{{ checkTeamRewardStatus($reward->id, auth()->user()->id) ? 'text-success' : 'text-light' }} text-uppercase">
                                        ${{ number_format($reward->reward, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
