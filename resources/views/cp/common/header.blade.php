<header id="header">

    <div class="width-limiter flex ai-center">
        <a id="brand" href="{{ route('cp.home') }}">
            <img src="{{asset('/img/logo.svg?v=1')}}" height="40">
        </a>
        @php $currentUser = Auth::user(); @endphp
        <nav id="main-menu">
            <div class="main-menu__item">
                <a href="/" class="main-menu__item" style="padding: 0; margin: 0;">{{ __('menu.home') }}</a>
            </div>
            <div class="main-menu__item">
                <a href="{{route('cp.products.index')}}" class="main-menu__item" style="padding: 0; margin: 0 1rem;">Игры</a>
            </div>
            <nav class="main-menu__item-submenu">
                Has sub menu
                <a href="#" class="main-menu__submenu-item">{{ __('menu.news') }}</a>
                <a href="#" class="main-menu__submenu-item">{{ __('menu.news') }}</a>
            </nav>
        </nav>

        <div class="ml-auto"></div>

        <a href="#" class="button_outline icon-button" onmouseenter="expandAnimation(event)">
            <span class="expandable" data-content="{{ __('menu.profile') }}"></span>
            <svg class="header-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </a>

        <form action="{{ route('logout', [], false) }}" method="POST" class="ml-1">
            @csrf
            <button type="submit" class="button_outline icon-button" onmouseenter="expandAnimation(event)">
                <span class="expandable" data-content="{{ __('auth.logout') }}"></span>
                <svg class="header-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>
        </form>
    </div>
</header>



