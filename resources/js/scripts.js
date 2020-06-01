$(document).ready(function () {
    $('.main-header__btn-menu').on('click', function (evt) {
        $(evt.currentTarget).toggleClass('main-header__btn-menu--close');
        $('.main-nav').toggleClass('main-nav--close');
        $('body').toggleClass('body__menu-open');
    });
});
