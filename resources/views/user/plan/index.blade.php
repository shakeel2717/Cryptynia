@extends('layout.dashboard')
@section('title','Deposit')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if (networkCapInPercentage(auth()->user()->id) >= 100)
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="alert alert-success">
                    <h5 class="mb-0 text-success">Total Freeze Balance: ${{ number_format(auth()->user()->freeze_transactions->sum('amount'),2) }}</h5>
                    <h5 class="text-success">Available Balance: ${{ number_format(balance(auth()->user()->id),2) }}</h5>
                    <h5 class="text-success">Total ${{ number_format(balance(auth()->user()->id) + auth()->user()->freeze_transactions->sum('amount'),2) }}</h5>
                    <p class="mb-0">We Offer you to Use your Freeze Balance to ReInvest or Upgrade Plan</p>
                    <form action="{{route('user.plan.networkcap')}}" method="POST">
                        @csrf
                        <button class="btn btn-success mt-3">Activate Plan</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            @foreach ($plans as $plan)
            <div class="col-md-6">
                <form action="{{ route('user.plan.store') }}" method="POST">
                    @csrf
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-5">
                                <div class="card-body bg-success-subtle h-100 d-flex flex-column">
                                    <div>
                                        <h5>{{ $plan->name }}</h5>
                                        <p>Package: {{ $loop->iteration }}</p>
                                    </div>

                                    <div class="pt-3 mt-auto">
                                        <h2 class="text-success mb-0"> <small>Min:</small> ${{ $plan->min_price }} <br> <small>Max:</small> ${{ $plan->max_price }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-body h-100">
                                    <ul class="list-unstyled vstack gap-3 mb-4">
                                        <li><i class="bi bi-check2-square text-success me-1"></i> Daily Min Profit: <span class="fw-semibold">{{ $plan->min_profit }}%</span></li>
                                        <li><i class="bi bi-check2-square text-success me-1"></i> Daily Max Profit: <span class="fw-semibold">{{ $plan->max_profit }}%</span></li>
                                        <li><i class="bi bi-check2-square text-success me-1"></i> Working days: <span class="fw-semibold">5</span></li>
                                        <li><i class="bi bi-check2-square text-success me-1"></i> Withdraw Fees : <span class="fw-semibold">{{ site_option('withdraw_fees') }}%</span></li>
                                    </ul>
                                    <div class="form-group mb-2">
                                        <label for="amount">Enter Amount</label>
                                        <input type="hidden" name="plan_id" id="plan_id" value="{{ $plan->id }}">
                                        <input type="number" class="form-control" name="amount" id="amount" min="{{ $plan->min_price }}" max="{{ $plan->max_price }}">
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">Activate Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection