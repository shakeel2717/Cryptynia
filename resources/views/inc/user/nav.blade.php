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
    <li class="nav-item nav-category">Package Plans</li>
    <li class="nav-item">
        <a href="{{ route('user.plan.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Activate Plan</span>
        </a>
    </li>
</ul>
