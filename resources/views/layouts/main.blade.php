<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
    <title>Laravel</title>

</head>
<body>
<header class="main-header">
    <div class="main-header__wrapper container">
        <div class="main-header__logo-wrapper ">
            <a href="/">
                <img class="main-header__logo" src="/img/logo.png">
            </a>
        </div>
        <p class="main-header__address">г. Александров, Красный переулок, д.8</p>
        <p class="main-header__phone">
            <a href="tel:+74924423434">+7 (49244) <span>2-34-34</span></a>
        </p>

        <p class="main-header__service text-right">оперативно-диспетчерской служба</p>

        <button class="main-header__btn-menu ml-auto">
            <div class="main-header__btn-menu-bar1"></div>
            <div class="main-header__btn-menu-bar2"></div>
            <div class="main-header__btn-menu-bar3"></div>
        </button>
    </div>
    <nav class="main-nav main-nav--close">
        <div class="container">
            <ul class="main-nav__list">
                <li class="main-nav__item"><a href="{{route('index')}}"
                                              class="main-nav__link {{Request::routeIs('index') ? 'main-nav__link--active' : ''}}">Главная</a>
                </li>
                <li class="main-nav__item"><a href="" class="main-nav__link">Информация<i class="fas fa-caret-down"></i></a>

                    <ul class="main-nav__sub-list">
                        <li class="main-nav__sub-item"><a href="" class="main-nav__link">Информация о закупочной
                                деятельности</a></li>
                        <li class="main-nav__sub-item"><a href="" class="main-nav__link">Отчеты о закупках</a></li>
                        <li class="main-nav__sub-item"><a href="" class="main-nav__link">Информация о закупках</a></li>
                    </ul>
                </li>
                <li class="main-nav__item"><a href="" class="main-nav__link">Потребителям</a></li>
                <li class="main-nav__item"><a class="main-nav__link">Закупки<i
                            class="fas fa-caret-down"></i></a>
                    <ul class="main-nav__sub-list">
                        <li class="main-nav__sub-item"><a href="{{route('information')}}"
                                                          class="main-nav__link {{Request::routeIs('information') ? 'main-nav__link--active' : ''}}">Информация
                                о закупочной
                                деятельности</a></li>
                        <li class="main-nav__sub-item"><a href="" class="main-nav__link">Отчеты о закупках</a></li>
                        <li class="main-nav__sub-item"><a href="" class="main-nav__link">Информация о закупках</a></li>
                    </ul>
                </li>
                <li class="main-nav__item"><a href="{{route('contacts')}}"
                                              class="main-nav__link {{Request::routeIs('contacts') ? 'main-nav__link--active' : ''}}">Контакты</a>
                </li>
            </ul>
        </div>

    </nav>
</header>
<main>
    <div class="row container no-gutters content-container">
        @yield('content')
    </div>
</main>
<footer class="main-footer">
    <div class="container no-gutters mb-3 m-lg-auto main-footer__container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <ul class="main-footer__menu-list">
                    <li><a href="">Главная</a></li>
                    <li><a href="">Контакты</a></li>
                    <li><a href="">Раскрытие информации</a></li>
                    <li><a href="">Личный кабинет</a></li>
                    <li><a href="">Галерея</a></li>
                </ul>
            </div>
            <div class="col-12 col-lg-6 main-footer__desktop-contact">
                <p class="main-footer__address">г. Александров, Красный переулок, д.8</p>
                <a tel="+74924423434" class="main-footer__phone">+7 (49244) <span>2-34-34</span></a>
            </div>
        </div>
        <div class="main-footer__mobile-contact row">
            <div class="col-6">
                <p class="main-footer__address">г. Александров, Красный переулок, д.8</p>
            </div>
            <div class="col-6 d-flex">
                <a tel="+74924423434" class="main-footer__phone">+7 (49244) <span>2-34-34</span></a>
            </div>
        </div>
    </div>
</footer>
<script src="/js/jquery.min.js"></script>
<script src="/js/scripts.js"></script>
</body>
</html>
