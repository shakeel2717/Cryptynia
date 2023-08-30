<ul class="navbar-nav" id="navbar-nav">
    @if (checkRewardAchieve(auth()->user()->id))
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mt-4">
                    <div class="position-relative m-2 overflow-hidden">
                        <img class="avatar-xl"
                            src="{{ asset('reward' . '/' . getAwardBadge(auth()->user()->id)) }}.png" alt="" class="w-25">
                    </div>
                    <div class="text-white text-uppercase mt-2">
                        {{ auth()->user()->fname . ' ' . auth()->user()->lname }}
                    </div>
                    <div class="text-white text-uppercase">{{ auth()->user()->status }}</div>
                </div>
            </div>
        </div>
    @endif
    <li class="menu-title"><span data-key="t-menu">Overview</span></li>
    <li class="nav-item">
        <a href="{{ route('user.dashboard.index') }}" class="nav-link menu-link">
            <i class="ph-gauge-light"></i>
            <span data-key="t-calendar">Dashboard</span>
        </a>
    </li>

    <li class="menu-title"><span data-key="t-menu">Finance</span></li>
    <li class="nav-item">
        <a href="{{ route('user.deposit.create') }}" class="nav-link menu-link">
            <i class="ph-wallet"></i>
            <span data-key="t-calendar">Deposit</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.withdraw.index') }}" class="nav-link menu-link">
            <i class="ph-wallet"></i>
            <span data-key="t-calendar">Withdrawal</span>
        </a>
    </li>

    <li class="menu-title"><span data-key="t-menu">Pacakge Plans</span></li>
    <li class="nav-item">
        <a href="{{ route('user.plan.index') }}" class="nav-link menu-link">
            <i class=" ph-currency-dollar"></i>
            <span data-key="t-calendar">Browse Plans</span>
        </a>
    </li>
    <li class="menu-title"><span data-key="t-menu">MY Tree</span></li>
    <li class="nav-item">
        <a href="{{ route('user.tree.show', ['tree' => auth()->user()->id]) }}" class="nav-link menu-link">
            <i class="ph-users-three"></i>
            <span data-key="t-calendar">Tree View</span>
        </a>
    </li>
    <li class="menu-title"><span data-key="t-menu">Statement</span></li>
    <li class="nav-item">
        <a href="{{ route('user.history.all') }}" class="nav-link menu-link">
            <i class="ph-file-text"></i>
            <span data-key="t-calendar">All Recent Transactions</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.history.deposits') }}" class="nav-link menu-link">
            <i class="ph-file-text"></i>
            <span data-key="t-calendar">All Deposits</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.history.roi') }}" class="nav-link menu-link">
            <i class="ph-file-text"></i>
            <span data-key="t-calendar">Daily ROI Transactions</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.history.withdrawals') }}" class="nav-link menu-link">
            <i class="ph-file-text"></i>
            <span data-key="t-calendar">All Withdrawals</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.history.direct') }}" class="nav-link menu-link">
            <i class="ph-file-text"></i>
            <span data-key="t-calendar">All Direct Commissions</span>
        </a>
    </li>
    <li class="menu-title"><span data-key="t-menu">Ranks & Rewards</span></li>
    <li class="nav-item border border-danger bg-white m-2 rounded">
        <a href="{{ route('user.ranks.index') }}" class="nav-link menu-link">
            <i class="ph-file-text"></i>
            <span data-key="t-calendar">Ranks & Rewards</span>
        </a>
    </li>

    <li class="menu-title"><span data-key="t-menu">Account Settings</span></li>
    <li class="nav-item">
        <a href="{{ route('user.profile.index') }}" class="nav-link menu-link">
            <i class="ph-user-circle-gear"></i>
            <span data-key="t-calendar">Profile Setting</span>
        </a>
    </li>
</ul>
