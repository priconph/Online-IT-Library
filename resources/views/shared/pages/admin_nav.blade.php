<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-danger elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('public/images/pricon_logo2.png') }}"
            alt="OITL"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">
            {{-- <i class="brand-image elevation-3 mt-2 fas fa-book-reader"></i> --}}
        <span class="brand-text font-weight-light">Online IT Library</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">ADMINISTRATOR</li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('user_management') }}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>User Management</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('list_of_workloads') }}" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>List of  Workloads</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>