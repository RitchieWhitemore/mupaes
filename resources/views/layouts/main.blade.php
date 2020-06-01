<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
    <title>Laravel</title>

</head>
<body>
<header class="main-header">
    <div class="main-header__wrapper container">
        <div class="row no-gutters">
            <div class="col-6">
                <div class="main-header__logo-wrapper ">
                    <a href="/">
                        <img class="main-header__logo" src="/img/logo.png">
                    </a>
                </div>
            </div>
            <div class="col-6 d-flex flex-column">
                <button class="main-header__btn-menu ml-auto">
                    <div class="main-header__btn-menu-bar1"></div>
                    <div class="main-header__btn-menu-bar2"></div>
                    <div class="main-header__btn-menu-bar3"></div>
                </button>
                <p>
                    <a href="" class="main-header__phone">+7 (49244) <span>2-34-34</span></a>
                </p>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-6">
                <p>г. Александров, Красный переулок, д.8</p>
            </div>
            <div class="col-6">
                <p class="text-right">оперативно-диспетчерской служба</p>
            </div>
        </div>

        <nav class="col-12 main-nav main-nav--close">
            <ul class="main-nav__list">
                <li class="main-nav__item"><a href="" class="main-nav__link main-nav__link--active">Главная</a></li>
                <li class="main-nav__item"><a href="" class="main-nav__link">Информация</a></li>
                <li class="main-nav__item"><a href="" class="main-nav__link">Потребителям</a></li>
                <li class="main-nav__item"><a href="" class="main-nav__link">Закупки</a>
                    <ul class="main-nav__sub-list">
                        <li class="main-nav__item"><a href="" class="main-nav__link">Информация о закупочной
                                деятельности</a></li>
                        <li class="main-nav__item"><a href="" class="main-nav__link">Отчеты о закупках</a></li>
                        <li class="main-nav__item"><a href="" class="main-nav__link">Информация о закупках</a></li>
                    </ul>
                </li>
                <li class="main-nav__item"><a href="" class="main-nav__link">Контакты</a></li>
            </ul>
        </nav>
    </div>
</header>
<main>
    <div class="row">
        <section class="col-12">
            <h1 class="title">Муниципальное унитарное предприятие
                "Александровэлектросеть"
                Александровского района</h1>
            <div class="content">
                <p>12 сентября 1956 г. решением исполкома Александровского городского совета №332 было создано
                    предприятие
                    Александровская горэлектросеть. Зоной деятельности предприятия является город Александров.</p>

                <p>МУП "Александровэлектросеть" является электросетевой организацией, предназначенной для оказания услуг
                    по
                    передаче электрической энергии для промышленных предприятий, предприятий общественного назначения,
                    торговли
                    и населения города, и осуществляющей в установленном порядке технологическое присоединение
                    энергопринимающих
                    устройств (энергетических установок) юридических и физических лиц к электрическим сетям.</p>

                <p>Основные функциональные задачи предприятия - прием, переработка - трансформация (6/0,4кВ), передача
                    по своим
                    сетям электроэнергии, эксплуатация электрических сетей (воздушных и кабельных ЛЭП 6/0,4кВ) и
                    оборудования
                    распределительных пунктов и трансформаторных подстанций. </p>
                <img src="">
            </div>
        </section>
        <aside class="col-12">
            <section class="main-news">
                <h2>Новости и события</h2>
                <ul>
                    <li>
                        <h3>Ремонтные работы 12 декабря....</h3>
                        <p>В связи с проведением плановых ремонтных работ в ТП-155 и ТП-10 12 декабря будет отключена
                            подача...</p>
                    </li>
                    <li>
                        <h3>Ремонтные работы 12 декабря....</h3>
                        <p>В связи с проведением плановых ремонтных работ в ТП-155 и ТП-10 12 декабря будет отключена
                            подача...</p>
                    </li>
                    <li>
                        <h3>Ремонтные работы 12 декабря....</h3>
                        <p>В связи с проведением плановых ремонтных работ в ТП-155 и ТП-10 12 декабря будет отключена
                            подача...</p>
                    </li>
                    <li>
                        <h3>Ремонтные работы 12 декабря....</h3>
                        <p>В связи с проведением плановых ремонтных работ в ТП-155 и ТП-10 12 декабря будет отключена
                            подача...</p>
                    </li>
                </ul>
            </section>
        </aside>
    </div>
</main>
<footer>
    <div class="row">
        <div class="col-12">
            <ul class="footer-menu__list">
                <li>Главная</li>
                <li>Контакты</li>
                <li>Раскрытие информации</li>
                <li>Личный кабинет</li>
                <li>Галерея</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <p>г. Александров, Красный переулок, д.8</p>
        </div>
        <div class="col-6">
            <a href="" class="main-header__phone">+7 (49244) <span>2-34-34</span></a>
        </div>
    </div>
</footer>
<script src="/js/jquery.min.js"></script>
<script src="/js/scripts.js"></script>
</body>
</html>
