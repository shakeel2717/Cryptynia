@extends('layout.dashboard')
@section('title')
    Welcome Back {{ auth()->user()->username }}
@endsection
@section('content')
    @include('inc.user.p2p_sent')
    @include('inc.p2p_recieve')
    <div class="row">
        @include('inc.box', [
            'title' => 'Available Balance',
            'value' => number_format(balance(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Total Income',
            'value' => number_format(totalIncome(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Total Withdrawal',
            'value' => number_format(getAllWithdraw(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Today ROI',
            'value' => number_format(todayRoi(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Today Withdrawal',
            'value' => number_format(getTodayWithdraw(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Total ROI',
            'value' => number_format(totalRoi(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Total Direct Commission',
            'value' => number_format(totalDirectCommission(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Total ROI',
            'value' => number_format(totalRoi(auth()->user()->id), 2),
        ])
        @include('inc.box', [
            'title' => 'Total ROI',
            'value' => number_format(totalRoi(auth()->user()->id), 2),
        ])
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body mb-4">
                <h2 class="card-title">Recent Transactions</h2>
                @forelse (auth()->user()->transactions()->latest()->take(10)->get() as $transaction)
                    <div class="card shadow-lg mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h4 class="mb-2 {{ $transaction->sum ? 'text-success' : 'text-danger' }}">
                                        ${{ number_format($transaction->amount, 2) }}</h4>
                                    <h4 class="text-uppercase mb-0">{{ $transaction->type }}</h4>
                                    <p class="text-uppercase mb-0"><small>{{ $transaction->reference }}</small></p>
                                </div>
                                <div class="text-end">
                                    <h6 class="text-uppercase mb-2">{{ $transaction->created_at }}</h6>
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
            <div class="card card-body mb-4">
                <h2 class="card-title">All Active Packages</h2>
                @forelse (auth()->user()->userPlans()->latest()->take(10)->get() as $plan)
                    <div class="card shadow-lg mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h4 class="mb-2 {{ $plan->sum ? 'text-success' : 'text-danger' }}">
                                        ${{ number_format($plan->amount, 2) }}</h4>
                                    <h4 class="text-uppercase mb-0">{{ $plan->plan->name }}</h4>
                                </div>
                                <div class="text-end">
                                    <h6 class="text-uppercase mb-2">{{ $plan->created_at->diffForHumans() }}</h6>
                                    <h6 class="text-uppercase mb-0">{{ $plan->status ? 'Active' : 'Expired' }}
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
            <div class="card border border-5">
                <div class="card-body">
                    <h2 class="card-title">Refer Your Friends and Family and earn Commission</h2>
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <img src="{{ asset('assets/team.png') }}" alt="Teams">
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" id="referlink" class="form-control"
                                        placeholder="Recipient's username"
                                        value="{{ route('register', ['refer' => auth()->user()->username]) }}">
                                    <button class="btn btn-outline-secondary" onclick="copyToClipboard('referlink')"
                                        type="button" id="button-addon2">Copy Refer
                                        Link</button>
                                </div>
                                <div class="my-2">
                                    <p>Sharing is caring, and at CRYPTYNIA, we believe in rewarding your enthusiasm for our
                                        platform. By referring friends and family, you not only introduce them to a world of
                                        investment opportunities but also have the chance to earn more commissions. It's
                                        easy to get started – simply click the 'Copy' button to grab your unique referral
                                        link and share it with your network. Every successful referral means more potential
                                        for growth and additional income in your pocket. Join us in spreading the word about
                                        CRYPTYNIA and let's grow together while you earn more with every referral</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <h2 class="card-title">Total Direct Referrals</h2>
                                            <h2 class="text-end">{{ auth()->user()->directReferrals->count() }}</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <h2 class="card-title">In-Direct Level 1</h2>
                                            @php
                                                $indirectLevel = 0;
                                            @endphp
                                            @foreach (auth()->user()->indirectReferralsLevel1 as $directLevel)
                                                @php
                                                    $indirectLevel += $directLevel->directReferrals->count();
                                                @endphp
                                            @endforeach
                                            <h2 class="text-end">{{ $indirectLevel }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <h2 class="card-title">In-Direct Level 2</h2>
                                            @php
                                                $indirectLevel = 0;
                                            @endphp
                                            @foreach (auth()->user()->indirectReferralsLevel1 as $directLevel)
                                                @foreach ($directLevel->indirectReferralsLevel1 as $directLevel1)
                                                    @php
                                                        $indirectLevel += $directLevel1->directReferrals->count();
                                                    @endphp
                                                @endforeach
                                            @endforeach
                                            <h2 class="text-end">{{ $indirectLevel }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <h2 class="card-title">In-Direct Level 3</h2>
                                            @php
                                                $indirectLevel = 0;
                                            @endphp
                                            @foreach (auth()->user()->indirectReferralsLevel1 as $directLevel)
                                                @foreach ($directLevel->indirectReferralsLevel1 as $directLevel1)
                                                    @foreach ($directLevel1->indirectReferralsLevel1 as $directLevel2)
                                                        @php
                                                            $indirectLevel += $directLevel2->directReferrals->count();
                                                        @endphp
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                            <h2 class="text-end">{{ $indirectLevel }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        function copyToClipboard(elementId) {
            let element = document.getElementById(elementId);
            // copy this to clipboard
            element.select();
            document.execCommand("copy");
        }
    </script>
@endsection
