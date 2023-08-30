@extends('layout.dashboard')
@section('title')
    Welcome Back {{ auth()->user()->username }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Available Balance</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="my-2">
                                        ${{ number_format(balance(auth()->user()->id), 2) }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>+0.0%</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Total Income</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="my-2">
                                        ${{ number_format(totalIncome(auth()->user()->id), 2) }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>+0.0%</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Total Withdrawal</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="my-2">
                                        ${{ number_format(getAllWithdraw(auth()->user()->id), 2) }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>+0.0%</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Today ROI</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="my-2">
                                        ${{ number_format(todayRoi(auth()->user()->id), 2) }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>+0.0%</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Today Withdrawal</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="my-2">
                                        ${{ number_format(getTodayWithdraw(auth()->user()->id), 2) }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>+0.0%</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Total ROI</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="my-2">
                                        ${{ number_format(totalRoi(auth()->user()->id), 2) }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>+0.0%</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Total Direct Commission</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="my-2">
                                        ${{ number_format(totalDirectCommission(auth()->user()->id), 2) }}
                                    </h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>+0.0%</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h2 class="card-title">Recent Transactions</h2>
                @forelse (auth()->user()->transactions()->latest()->take(10)->get() as $transaction)
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h4 class="{{ $transaction->sum ? 'text-success' : 'text-danger' }}">
                                        ${{ number_format($transaction->amount, 2) }}</h4>
                                    <h6 class="text-uppercase mb-0">{{ $transaction->type }}</h6>
                                    <p class="text-uppercase mb-0">{{ $transaction->reference }}</p>
                                </div>
                                <div class="text-end">
                                    <h6 class="text-uppercase mb-0">{{ $transaction->created_at }}</h6>
                                    <h6 class="text-uppercase mb-0">{{ $transaction->status ? 'Approved' : 'Pending' }}
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

    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h2 class="card-title">Pending Deposits</h2>
                @forelse (auth()->user()->pending_tids->take(10) as $tid)
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h4 class="">
                                        ${{ number_format($tid->amount, 2) }} <br> <small class="fs-6">Fees:
                                            ${{ number_format($tid->fees, 2) }}</small></h4>
                                    <h6 class="text-uppercase mb-0">{{ $tid->type }}</h6>
                                </div>
                                <div class="text-end">
                                    <h6 class="text-uppercase mb-0">{{ $tid->status ? 'Approved' : 'Pending' }}</h6>
                                    <h6 class="text-uppercase mb-0">{{ $tid->created_at }}</h6>
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
@section('footer')
    @if (networkCapInPercentage(auth()->user()->id) >= 100)
        <script>
            (function() {
                // Get the past date and time in milliseconds
                var pastDateTime = new Date("{{ checkFreezeFirstDate(auth()->user()->id) }}").getTime();

                // Update the counter every second
                var interval = setInterval(function() {
                    var now = new Date().getTime();
                    var timeRemaining = now - pastDateTime;

                    // If the past date has not passed yet
                    if (timeRemaining > 0) {
                        // Calculate days, hours, minutes, and seconds
                        var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
                        if (days > 14) {
                            document.getElementById('counter').textContent = "Expired";
                        } else {
                            // Update the counter element with the remaining time
                            document.getElementById('counter').textContent = days + 'D ' + hours + 'H ' + minutes +
                                'M ' + seconds + 'S';
                        }

                    } else {
                        clearInterval(interval);
                        document.getElementById('counter').textContent = 'Subscription Expired';
                    }
                }, 1000); // Update every second
            })();
        </script>
    @endif
    <script>
        (function() {
            // Get the past date and time in milliseconds
            var pastDateTime = new Date("2023-09-05 13:42:49").getTime();

            // Update the counter every second
            var interval = setInterval(function() {
                var now = new Date().getTime();
                var timeRemaining = pastDateTime - now;

                // If the past date has not passed yet
                if (timeRemaining > 0) {
                    // Calculate days, hours, minutes, and seconds
                    var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
                    if (days > 14) {
                        document.getElementById('promotional').textContent = "Expired";
                    } else {
                        // Update the promotional element with the remaining time
                        document.getElementById('promotional').textContent = days + 'D ' + hours + 'H ' +
                            minutes +
                            'M ' + seconds + 'S';
                    }

                } else {
                    clearInterval(interval);
                    document.getElementById('promotional').textContent = 'Promotion Expired';
                }
            }, 1000); // Update every second
        })();
    </script>
@endsection
