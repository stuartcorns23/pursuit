<section class="topbar">
    <div class="w-100 d-flex justify-content-between align-items-center border-left border-light pr-2">
        <a class="menuBtn btn btn-secondary d-inline-block d-xl-none" href="#">
            <i class="fas fa-fw fa-bars" data-bs-toggle="tooltip" data-bs-placement="bottom"
            title="Open Navigation"></i>
        </a>
        <div class="p-2 text-white d-none d-lg-inline">
            <a href="{{route('availability.create')}}" class="btn btn-sm btn-primary">Availability</a>
            <a href="{{route('shifts.index')}}" class="btn btn-sm btn-primary">My Shifts</a>
            <a href="{{ route('timesheets.index')}}" class="btn btn-sm btn-primary">My Timesheets</a>
        </div>
        <div class="p-2 d-inline d-xl-none">
            
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
                        <a class="dropdown-item" href="{{route('users.show', auth()->user()->id)}}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-light"></i>
                            My Profile
                        </a>
                        @can('admin', auth()->user())
                        <a class="dropdown-item disabled" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        @endcan
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul> 
        </div>
    </div>
</section>