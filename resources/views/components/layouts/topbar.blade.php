<section class="topbar">
    <div class="w-100 d-flex justify-content-between align-items-center border-left border-light pr-2">
        <div class="p-2">
            <a class="btn btn-secondary" href="#">
                <i class="fas fa-fw fa-tablet-alt" data-bs-toggle="tooltip" data-bs-placement="bottom"
                title="Add New Asset"></i>
                <span class="badge badge-success badge-counter">+</span>
            </a>
        
            <a class="btn btn-secondary" href="#">
                <i class="fas fa-fw fa-tasks" data-bs-toggle="tooltip" data-bs-placement="bottom"
                title="Requests"></i>
                <span class="badge badge-danger badge-counter">7</span>
            </a>
        
            <a class="btn btn-secondary" href="#">
                <i class="fas fa-fw fa-folder" data-toggle="tooltip" data-placement="bottom"
                title="Documentation"></i>
                <span class="badge badge-primary badge-counter"><i class="fas fa-eye text-white"></i></span>
            </a>
        </div> 
        <div class="pr-4">
            <ul class="navbar-nav">
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle d-flex justify-content-center align-items-center" href="#" id="user_profile" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                        <span class="text-right" style="text-align: right; margin-right: 10px;">
                            <span
                                class="mr-2 d-none d-lg-block text-light small">{{ auth()->user()->fullname() ?? 'Nobody Knows'}}</span>
                            <span
                                class="mr-2 d-none d-lg-block text-gray-600 small">{{ auth()->user()->email ?? 'Nobody Knows'}}</span>
                        </span>
                        {{-- @if(auth()->user()->photo()->exists())
                            <img class="img-profile rounded-circle"
                                src="{{ asset(auth()->user()->photo->path) ?? asset('images/profile.png') }}">
                        @else  --}}
                            <img class="img-profile rounded-circle" src="{{ asset('images/profile.jpg') }}">
                        {{-- @endif --}}
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-light"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Edit
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul> 
        </div>
    </div>
</section>