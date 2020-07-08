window._ = require('lodash');
window.Popper = require('popper.js').default;

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('select2/dist/js/select2.full');

    require('tinymce');
    require('tinymce/themes/silver');
    require('tinymce/plugins/paste');
    require('tinymce/plugins/advlist');
    require('tinymce/plugins/autolink');
    require('tinymce/plugins/lists');
    require('tinymce/plugins/link');
    require('tinymce/plugins/image');
    require('tinymce/plugins/charmap');
    require('tinymce/plugins/print');
    require('tinymce/plugins/preview');
    require('tinymce/plugins/anchor');
    require('tinymce/plugins/textcolor');
    require('tinymce/plugins/searchreplace');
    require('tinymce/plugins/visualblocks');
    require('tinymce/plugins/code');
    require('tinymce/plugins/fullscreen');
    require('tinymce/plugins/insertdatetime');
    require('tinymce/plugins/media');
    require('tinymce/plugins/table');
    require('tinymce/plugins/contextmenu');
    require('tinymce/plugins/code');
    require('tinymce/plugins/help');
    require('tinymce/plugins/wordcount');
} catch (e) {
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
