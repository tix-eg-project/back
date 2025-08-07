<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- اللغة -->
            <li class="dropdown nav-item lh-1 me-3">
                <button class="dropdown-toggle bg-transparent border-0" data-bs-toggle="dropdown" aria-expanded="false"
                    aria-label="Language Menu">
                    <i class="fas fa-globe text-white"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('en') }}">English</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('ar') }}">Arabic</a></li>
                </ul>
            </li>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                @php
                    $user = auth()->guard('admin')->check()
                        ? auth()->guard('admin')->user()
                        : (auth()->guard('vendore')->check()
                            ? auth()->guard('vendore')->user()
                            : (auth()->check()
                                ? auth()->user()
                                : null));
                @endphp

                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if ($user && $user->image)
                            <img src="{{ asset($user->image) }}" alt="User Avatar" class="w-px-40 h-auto rounded-circle"
                                style="object-fit: cover;" />
                        @else
                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Default Avatar"
                                class="w-px-40 h-auto rounded-circle" style="object-fit: cover;" />
                        @endif
                    </div>
                </a>




                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">

                                <div class="flex-grow-1">
                                    @if ($user)
                                        <span class="fw-semibold d-block">{{ $user->name }}</span>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">{{ __('messages.My Profile') }}</span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item bg-transparent border-0">
                                <i class="bx bx-power-off me-2"></i>
                                {{ __('messages.LogOut') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
