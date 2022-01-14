<sidebar class="sidebar-wrapper py-2">
    <div class="logo d-flex w-100 justify-content-center align-items-center mb-4">
            <img src="{{asset('images/pursuit-icon.svg')}}" width="100%" style="max-width: 100px;">
    </div>
    <nav class="">
        <ul class="navbar-nav accordion" id="accordionSidebar">
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt sidebar-icon"></i>
                    <span class="sidebar-title">Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-calendar-week sidebar-icon"></i>
                    <span class="sidebar-title">Availability</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa-fw fas fa-hard-hat sidebar-icon"></i>
                    <span class="sidebar-title">Shifts</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                   data-bs-target="#accessoryDD" aria-expanded="true"
                   aria-controls="accessoryDD">
                    <i class="fas fa-fw fa-users sidebar-icon" data-bs-toggle="tooltip" data-bs-placement="right"
                       title="Accessories"></i>
                    <span class="sidebar-title">Users</span>
                </a>
                <div id="accessoryDD" class="collapse p-0" aria-labelledby="accessoryTitle" data-bs-parent="#accordionSidebar">
                    <a class="collapse-item sub-link" href="#"><i
                            class="far fa-fw fa-circle text-secondary"></i> Add New User</a>
                    <a class="collapse-item sub-link" href="#"><i
                            class="far fa-circle text-secondary"></i> View All</a>
                </div>
                
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                   data-bs-target="#clientsDD" aria-expanded="true"
                   aria-controls="clientsDD">
                    <i class="fas fa-fw fa-briefcase sidebar-icon" data-bs-toggle="tooltip" data-bs-placement="right"
                       title="Clients"></i>
                    <span class="sidebar-title">Clients</span>
                </a>
                <div id="clientsDD" class="collapse p-0" aria-labelledby="clientsTitle" data-bs-parent="#accordionSidebar">
                    <a class="collapse-item sub-link" href="#"><i
                            class="far fa-fw fa-circle text-secondary"></i> User Settings</a>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt sidebar-icon"></i>
                    <span class="sidebar-title">Pages</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt sidebar-icon"></i>
                    <span class="sidebar-title">Posts</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                   data-bs-target="#settingsDD" aria-expanded="true"
                   aria-controls="settingsDD">
                    <i class="fas fa-fw fa-cog sidebar-icon" data-bs-toggle="tooltip" data-bs-placement="right"
                       title="Settings"></i>
                    <span class="sidebar-title">Settings</span>
                </a>
                <div id="settingsDD" class="collapse p-0" aria-labelledby="settingsTitle" data-bs-parent="#accordionSidebar">
                    <a class="collapse-item sub-link" href="#"><i
                            class="far fa-fw fa-circle text-secondary"></i> User Settings</a>
                </div>
            </li>
            
        </ul>
    </nav>
</sidebar>