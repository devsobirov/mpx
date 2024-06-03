<!DOCTYPE html>
<html lang="en" x-data="globalData">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MMOPIX v2</title>

    <link rel="stylesheet" href="assets/css/style.css?{{rand(1000, 9999)}}">
    <link rel="stylesheet" href="assets/css/media.css">

    <script defer src="{{asset('vendor/alpine/alpine.js')}}"></script>
</head>
<body>
    <header>
        <div class="container x-visible">
        <nav>
            <a class="logo" href="/">
                <img class="logo-lg" src="img/logo.svg" alt="MMOPIX">
                <img class="logo-sm" src="img/logo_short.png" alt="MMOPIX">
            </a>
            <div class="catalog btn light-btn" :class="isCatalogMenuOpen && 'expand'"  @click.outside="isCatalogMenuOpen = false">
                Catalog
            </div>

            <ul class="menu" :class="isMobileMenuOpen && 'expand'">
                <li><a href="#" class="nav-link">Новости</a></li>
                <li><a href="#" class="nav-link">Поддержка</a></li>
            </ul>
            <div class="actions">
                <div class="lang-menu">
                    <div class="locale-item">
                        <img src="{{asset("img/en.png")}}">
                        <span>ENG</span>
                        <x-svg.toggler></x-svg.toggler>
                    </div>
{{--                    @foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}
{{--                        @if ($localeCode !== app()->getLocale())--}}
{{--                            <a class="flex ai-center gap-10" rel="alternate" hreflang="{{ $localeCode }}" href="{{ \LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">--}}
{{--                                <img src="{{asset("img/$localeCode.png")}}" style="width: 24px;"> {{ ucfirst($properties['native']) }}--}}
{{--                            </a>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
                </div>
                <div class="icons-bar">
                    <div class="icon-box">
                        <x-svg.star></x-svg.star>
                        <span class="count">2</span>
                    </div>
                </div>
                <div class="account" @click="isAccoutMenuOpen = !isAccoutMenuOpen" @click.outside="isAccoutMenuOpen = !!0">
                    <div>Аккаунт</div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 6" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.47149 5.47141C5.21114 5.73176 4.78903 5.73176 4.52868 5.47141L0.528677 1.47141C0.268327 1.21106 0.268327 0.78895 0.528677 0.5286C0.789027 0.268251 1.21114 0.268251 1.47149 0.5286L5.00008 4.0572L8.52868 0.528601C8.78903 0.268251 9.21114 0.268251 9.47149 0.528601C9.73184 0.78895 9.73184 1.21106 9.47149 1.47141L5.47149 5.47141Z"/>
                    </svg>

                    <div class="submenu" :class="isAccoutMenuOpen && 'expand'" x-cloak="" x-show="false">
                        <ul>
                            <li> <a href="#">Настройки профиля</a> </li>
                            <li><a href="#" class="text-gray">Баланс <span class="text-white">123</span> ₽</a></li>
                            <li><a href="#">Ваши покупки</a></li>
                            <li><a href="#"></a>Чаты</li>
                            <li><a href="#" class="text-gray"></a>Выйти</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-toggler" @click="isMobileMenuOpen = !!1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" fill="none"  @click="isMobileMenuOpen = !isMobileMenuOpen">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 7.00016C3.5 6.35583 4.02233 5.8335 4.66667 5.8335H23.3333C23.9777 5.8335 24.5 6.35583 24.5 7.00016C24.5 7.6445 23.9777 8.16683 23.3333 8.16683H4.66667C4.02233 8.16683 3.5 7.6445 3.5 7.00016Z" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 14.0002C3.5 13.3558 4.02233 12.8335 4.66667 12.8335H23.3333C23.9777 12.8335 24.5 13.3558 24.5 14.0002C24.5 14.6445 23.9777 15.1668 23.3333 15.1668H4.66667C4.02233 15.1668 3.5 14.6445 3.5 14.0002Z" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 21.0002C3.5 20.3558 4.02233 19.8335 4.66667 19.8335H23.3333C23.9777 19.8335 24.5 20.3558 24.5 21.0002C24.5 21.6445 23.9777 22.1668 23.3333 22.1668H4.66667C4.02233 22.1668 3.5 21.6445 3.5 21.0002Z" />
                </svg>
            </div>
        </nav>
    </div>
    </header>

    <main>
        <div class="flex gap-10">
            <a href="#" class="action-button">
                Скидки
            </a>
            <a href="#" class="action-button">
                Скидки
            </a>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="inner">
                <div class="logo">
                    <img src="img/logo.png" alt="">
                    <p>Все права защищены © 2022</p>
                    <a href="#">Польз. согласшение</a>
                </div>

                <div class="links">
                    <h5>Клиенту</h5>
                    <ul class="menu">
                        <li><a href="#">О нас</a></li>
                        <li><a href="#">Новости и Блог</a></li>
                        <li><a href="#">Поставщикам</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Правила</a></li>

                    </ul>
                </div>

                <div class="links">
                    <h5>Контакты</h5>
                    <ul class="menu">
                        <li><a href="#">Канал в Telegram</a></li>
                        <li><a href="#">Youtube-канал</a></li>
                        <li><a href="#">Группа ВК</a></li>
                    </ul>
                </div>

                <div class="payment-info">
                    <h5>Способы оплаты</h5>
                    <img src="img/payments.png" alt="">
                </div>
            </div>
        </div>
    </footer>
<script>
    /**   Initializing Global Alpine Data & Methods */

    document.addEventListener('alpine:init', () => {

        Alpine.data('globalData', () => ({
            isCatalogMenuOpen: false,
            isMobileMenuOpen: false,
            isAccoutMenuOpen: false,
            isSearchMenuOpen: false,
            isNotificationsMenuOpen: false
        }))
    })
</script>
</body>
</html>
