require('./bootstrap');

$(document).ready(function () {
    var $button = $('.admin-delete-form button');

    $button.on('click', function (e) {
        if ($button.data('confirm')) {
            if (!confirm($button.data('confirm'))) {
                e.preventDefault();
            }
        }
    });

    tinymce.init({
        skin_url: '/css/skins/ui/oxide',
        selector: "#tinymce",
        height: 300,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css',
        ],
    });
});
