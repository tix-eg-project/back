<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <!-- Logo here -->
                <svg
                    width="25"
                    viewBox="0 0 25 42"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 ... "></path>
                    </defs>
                    <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                            <g id="Icon" transform="translate(27.000000, 15.000000)">
                                <mask id="mask-2" fill="white">
                                    <use xlink:href="#path-1"></use>
                                </mask>
                                <use fill="#696cff" xlink:href="#path-1"></use>
                            </g>
                        </g>
                    </g>
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Tix</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>{{ __('messages.dashboard') }}</div>
            </a>
        </li>

        <!-- Banner Link -->
        <li class="menu-item">
            <a href="{{ route('banners.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-image"></i>

                <div>{{ __('messages.banners') }}</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('advertisements.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-image"></i>

                <div>{{ __('messages.advertisements') }}</div>
            </a>
        </li>



        <!-- Add other menu items similarly -->
        @php
        $current = request()->route()->getName();
        $items = [

        ];
        @endphp

        @foreach($items as $item)
        <li class="menu-item">
            <a href="{{ route($item['route']) }}" class="{{ $current === $item['route'] ? 'active text-primary fw-bold' : '' }} menu-link">
                <i class="menu-icon tf-icons {{ $item['icon'] }}"></i>
                <div>{{ $item['label'] }}</div>
            </a>
        </li>
        @endforeach
    </ul>
</aside>
<!-- / Menu -->