@extends('layouts.main')

@section('content')
    <div class="col-12">
        <h1 class="title text-center">Контакты</h1>
    </div>

    <div class="col-12 col-lg-6 mr-lg-5">
        <img src="/img/image.jpg" class="img-fluid">
    </div>
    <div class="col-12 col-lg-4">
        <ul class="contact__list">
            <li class="contact__title">Муниципальное унитарное предприятие
                "Александровэлектросеть" Александровского района
            </li>
            <li class="contact__address">601650, Владимирская область, г. Александров,
                Красный переулок, д.8
            </li>
            <li class="contact__phone"><a href="tel:+74924423430">(49244) 2-34-30</a><br>
                <a href="tel:+74924422736">(49244) 2-27-36</a></li>
            <li class="contact__email"><a href="mailto:mupaes@mail.ru" target="_blank">mupaes@mail.ru</a></li>
            <li class="contact__director">Директор: Николаев Юрий Владимирович</li>
            <li class="contact__time">Часы приема: четверг с 14:00 до 16:00</li>
        </ul>
    </div>
    <div class="col-12 map mt-lg-5">
        <iframe src="https://yandex.ru/map-widget/v1/-/CCQdnQqQXD" frameborder="0"
                allowfullscreen="true" style="position:relative;"></iframe>
    </div>
@endsection
