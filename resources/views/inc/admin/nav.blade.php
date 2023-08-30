<ul class="navbar-nav" id="navbar-nav">
    <li class="menu-title"><span data-key="t-menu">Overview</span></li>
    <li class="nav-item">
        <a href="{{ route('admin.dashboard.index') }}" class="nav-link menu-link">
            <i class="ph-calendar"></i>
            <span data-key="t-calendar">Admin Dashboard</span>
        </a>
    </li>

    <li class="menu-title"><span data-key="t-menu">Finance</span></li>
    <li class="nav-item">
        <a href="{{ route('admin.finance.index') }}" class="nav-link menu-link">
            <i class="ph-calendar"></i>
            <span data-key="t-calendar">Add Balance</span>
        </a>
    </li>

    <li class="menu-title"><span data-key="t-menu">Users Management</span></li>
    <li class="nav-item">
        <a href="{{ route('admin.history.users') }}" class="nav-link menu-link">
            <i class="ph-calendar"></i>
            <span data-key="t-calendar">All Users</span>
        </a>
    </li>
    <li class="menu-title"><span data-key="t-menu">Withdrawals</span></li>
    <li class="nav-item">
        <a href="{{ route('admin.withdraw.index') }}" class="nav-link menu-link">
            <i class="ph-calendar"></i>
            <span data-key="t-calendar">Pending Withdrawals</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.deposit.index') }}" class="nav-link menu-link">
            <i class="ph-calendar"></i>
            <span data-key="t-calendar">Pending Deposit</span>
        </a>
    </li>

    <li class="menu-title"><span data-key="t-menu">All Statements</span></li>
    <li class="nav-item">
        <a href="{{ route('admin.history.roi') }}" class="nav-link menu-link">
            <i class="ph-calendar"></i>
            <span data-key="t-calendar">All ROI</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.history.deposits') }}" class="nav-link menu-link">
            <i class="ph-calendar"></i>
            <span data-key="t-calendar">All Deposits</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.history.withdrawals') }}" class="nav-link menu-link">
            <i class="ph-calendar"></i>
            <span data-key="t-calendar">All Withdarawls</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.history.withdrawals.fees') }}" class="nav-link menu-link">
            <i class="ph-calendar"></i>
            <span data-key="t-calendar">All Withdarawls Fees</span>
        </a>
    </li>

    <li class="menu-title"><span data-key="t-menu">Website Settings</span></li>

    <li class="nav-item">
        <a href="{{ route('admin.history.plan.profit') }}" class="nav-link menu-link">
            <i class="ph-calendar"></i>
            <span data-key="t-calendar">Edit Plan Profit</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.setting.index') }}" class="nav-link menu-link">
            <i class="ph-calendar"></i>
            <span data-key="t-calendar">Website Settings</span>
        </a>
    </li>

    <li class="menu-title"><span data-key="t-menu">KYC Manage</span></li>

    <li class="nav-item">
        <a href="{{ route('admin.history.kyc.all') }}" class="nav-link menu-link">
            <i class="ph-calendar"></i>
            <span data-key="t-calendar">All Kyc Request</span>
        </a>
    </li>
</ul>
@include('inc.user.nav')
