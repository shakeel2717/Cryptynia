<ul class="nav">
    <li class="nav-item nav-category">Main</li>
    <li class="nav-item">
        <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Admin Dashboard</span>
        </a>
    </li>
    <li class="nav-item nav-category">Finance</li>
    <li class="nav-item">
        <a href="{{ route('admin.finance.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Add Balance</span>
        </a>
    </li>
    <li class="nav-item nav-category">Users Management</li>
    <li class="nav-item">
        <a href="{{ route('admin.history.users') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All Users</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.logs.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Users Logs</span>
        </a>
    </li>
    <li class="nav-item nav-category">Withdrawals</li>
    <li class="nav-item">
        <a href="{{ route('admin.withdraw.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Pending Withdrawals</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.deposit.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Pending Deposit</span>
        </a>
    </li>
    <li class="nav-item nav-category">All Statements</li>
    <li class="nav-item">
        <a href="{{ route('admin.history.roi') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All ROI</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.history.deposits') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All Deposits</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.history.withdrawals') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All Withdarawls</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.history.withdrawals.fees') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All Withdarawls Fees</span>
        </a>
    </li>
    <li class="nav-item nav-category">Website Settings</li>
    <li class="nav-item">
        <a href="{{ route('admin.history.plan.profit') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Edit Plan Profit</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.setting.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Website Settings</span>
        </a>
    </li>
    <li class="nav-item nav-category">KYC Manage</li>
    <li class="nav-item">
        <a href="{{ route('admin.history.kyc.all') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">All Kyc Request</span>
        </a>
    </li>
</ul>
