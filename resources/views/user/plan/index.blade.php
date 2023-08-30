@extends('layout.dashboard')
@section('title', 'Deposit')
@section('content')
    <div class="row g-4">
        @foreach ($plans as $plan)
            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center mt-3 mb-4">{{ $plan->name }}</h4>
                        <i data-feather="award" class="text-primary icon-xxl d-block mx-auto my-3"></i>
                        <h1 class="text-center">${{ number_format($plan->price, 2) }}</h1>
                        <p class="text-muted text-center mb-4 fw-light">Duration: {{ $plan->duration }} Days</p>
                        <h5 class="text-primary text-center mb-4">UPGRADE ANY TIME</h5>
                        <table class="mx-auto">
                            <tr>
                                <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                <td>
                                    <p>Instant Deposit</p>
                                </td>
                            </tr>
                            <tr>
                                <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                <td>
                                    <p>Instant Withdrawals</p>
                                </td>
                            </tr>
                            <tr>
                                <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                <td>
                                    <p>Daily Profit: {{ $plan->min_profit }}% - {{ $plan->max_profit }}%</p>
                                </td>
                            </tr>
                            <tr>
                                <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                <td>
                                    <p>Min Withdarawal: ${{ number_format($plan->withdrawals, 2) }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                <td>
                                    <p>Withdrawal Time: 24 Hours</p>
                                </td>
                            </tr>
                        </table>
                        <div class="d-grid">
                            <form action="{{ route('user.plan.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                <button type="submit" class="btn btn-lg btn-block w-100 btn-primary mt-4">Activate Plan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
