@extends('layout.dashboard')
@section('title')
    Welcome Back {{ auth()->user()->username }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Referral Commission Detail</h2>
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Level</th>
                                <th>Commission</th>
                                <th>Instant Withdrawals</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Direct</td>
                                <td>{{ site_option('direct_commission') }}%</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td>In-Direct Level 01</td>
                                <td>{{ site_option('in_direct_commission_1') }}%</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td>In-Direct Level 02</td>
                                <td>{{ site_option('in_direct_commission_2') }}%</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td>In-Direct Level 03</td>
                                <td>{{ site_option('in_direct_commission_3') }}%</td>
                                <td>Yes</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Earnings Report</h2>
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Level</th>
                                <th>Total Referrals</th>
                                <th>Earned Commission</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Direct</td>
                                <td>{{ auth()->user()->directReferrals->count() }}</td>
                                <td>{{ number_format(totalDirectCommission(auth()->user()->id), 2) }}%</td>
                            </tr>
                            <tr>
                                <td>In-Direct Level 01</td>
                                @php
                                    $indirectLevel = 0;
                                @endphp
                                @foreach (auth()->user()->indirectReferralsLevel1 as $directLevel)
                                    @php
                                        $indirectLevel += $directLevel->directReferrals->count();
                                    @endphp
                                @endforeach
                                <td>{{ $indirectLevel }}</td>
                                <td>{{ number_format(totalInDirectLevelCommission(auth()->user()->id, 'In-Direct Commission L01'), 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td>In-Direct Level 02</td>
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
                                <td>{{ $indirectLevel }}</td>
                                <td>{{ number_format(totalInDirectLevelCommission(auth()->user()->id, 'In-Direct Commission L02'), 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td>In-Direct Level 03</td>
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
                                <td>{{ $indirectLevel }}</td>
                                <td>{{ number_format(totalInDirectLevelCommission(auth()->user()->id, 'In-Direct Commission L03'), 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
