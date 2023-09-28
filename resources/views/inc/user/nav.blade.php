<ul class="nav">
    <li class="nav-item nav-category">Main</li>
    <li class="nav-item">
        <a href="{{ route('user.dashboard.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item nav-category">Finance</li>
    <li class="nav-item">
        <a href="{{ route('user.deposit.create') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Deposit</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.withdraw.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Withdrawal</span>
        </a>
    </li>
    <li class="nav-item nav-category">P2P Trading</li>
    <li class="nav-item">
        <a href="{{ route('user.exchange.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Buy Crypto</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.exchange.create') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Sell Crypto</span>
        </a>
    </li>
    <li class="nav-item nav-category">Package Plans</li>
    <li class="nav-item">
        <a href="{{ route('user.plan.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Activate Plan</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.plan.active') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">My Plans</span>
        </a>
    </li>
    <li class="nav-item nav-category">Referral Earnings</li>
    <li class="nav-item">
        <a href="{{ route('user.refer.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Referral Statement</span>
        </a>
    </li>
    <li class="nav-item nav-category">Account Statement</li>
    <li class="nav-item">
        <a href="{{ route('user.history.all') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Recent Transactions</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.history.deposits') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All Deposit</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.history.roi') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All Roi Transactions</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.history.withdrawals') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All Withdrawals</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.history.direct') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All Direct Transactions</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.history.indirect1') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All In-Direct L01</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.history.indirect2') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All In-Direct L02</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.history.indirect3') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All In-Direct L03</span>
        </a>
    </li>
    <li class="nav-item nav-category">Referrals Report</li>
    <li class="nav-item">
        <a href="{{ route('user.referrals.direct') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All Direct Referrals</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.referrals.level1') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All In-Direct L01</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.referrals.level2') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All In-Direct L02</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.referrals.level3') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All In-Direct L03</span>
        </a>
    </li>
    <li class="nav-item nav-category">Ranks & Rewards</li>
    <li class="nav-item">
        <a href="{{ route('user.ranks.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Direct Business Reward</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.team_ranks.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Teams Business Reward</span>
        </a>
    </li>
    <li class="nav-item nav-category">Account Settings</li>
    <li class="nav-item">
        <a href="{{ route('user.profile.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Profile Settings</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.kyc.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">KYC Verification</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.profile.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Change Password</span>
        </a>
    </li>
</ul>
