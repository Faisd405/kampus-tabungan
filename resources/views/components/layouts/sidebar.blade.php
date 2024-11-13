<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">Tabungan Siswa</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">TS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Home</li>
            <li>
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if (in_array(auth()->user()->role, ['admin', 'staff']))
                <li class="menu-header">Management</li>
                <li>
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="fas fa-user"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="menu-header">Datamaster</li>
                <li>
                    <a class="nav-link" href="{{ route('students.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <span>Siswa</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('saving-account.index') }}">
                        <i class="fas fa-money-bill"></i>
                        <span>Tabungan</span>
                    </a>
                </li>
                <li class="menu-header">Reports</li>
                <li>
                    <a class="nav-link" href="{{ route('reports.index') }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Reports</span>
                    </a>
                </li>
            @endif
        </ul>
    </aside>
</div>
