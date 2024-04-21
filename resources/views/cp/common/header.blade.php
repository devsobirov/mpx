<header id="header">

    <div class="width-limiter flex ai-center">
        <a id="brand" href="{{ route('cp.home') }}">
            <img src="{{asset('/img/logo.svg?v=1')}}" height="40">
        </a>
        @php $currentUser = Auth::user(); @endphp
        <nav id="main-menu">
            <div class="main-menu__item">
                <a href="/" class="main-menu__item" style="padding: 0; margin: 0;">{{ __('menu.home') }}</a>

                <nav class="main-menu__item-submenu">
{{--                    <a href="{{ route('web.blog', [], false) }}" class="main-menu__submenu-item">{{ __('menu.news') }}</a>--}}
                </nav>
            </div>
            <div class="main-menu__item">
                {{ __('menu.settings') }}
                <nav class="main-menu__item-submenu"></nav>
            </div>
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
        <div class="main-menu__item ml-1">
            @php $currentLocale = \LaravelLocalization::getCurrentLocale(); @endphp
            <a class="flex jc-center ai-center" style="text-decoration: none" rel="alternate" hreflang="{{ $currentLocale }}" href="{{ \LaravelLocalization::getLocalizedURL($currentLocale, null, [], true) }}">
                <strong>{{ strtoupper($currentLocale) }}</strong> <img src="{{asset("img/$currentLocale.png")}}" style="padding-left: .5rem;width: 35px; box-sizing: border-box;display: inline-block;">
            </a>

            <nav class="main-menu__item-submenu" style="width: 5rem; left: 100%">
                @foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if($currentLocale != $localeCode)
                        <a class="main-menu__submenu-item flex jc-center ai-center" rel="alternate" hreflang="{{ $localeCode }}" href="{{ \LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ strtoupper($localeCode) }} <img src="{{asset("img/$localeCode.png")}}" style="padding-left: .5rem;width: 35px; box-sizing: border-box;display: inline-block;">
                        </a>
                    @endif
                @endforeach
            </nav>
        </div>
    </div>
</header>



