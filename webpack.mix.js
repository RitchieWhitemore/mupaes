const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.options({processCssUrls: false})
    .js('resources/admin/js/admin.js', 'public/js/admin')
    .sass('resources/admin/sass/admin.scss', 'public/css/admin')
    .version();

mix.copy('node_modules/tinymce/skins', 'public/css/skins');

mix.copy('node_modules/blueimp-file-upload/img/loading.gif', 'public/admin/css/img')
    .copy('node_modules/blueimp-file-upload/img/progressbar.gif', 'public/admin/css/img')
    .copy('node_modules/blueimp-file-upload/css/jquery.fileupload.css', 'public/admin/css/blueimp')
    .copy('node_modules/blueimp-file-upload/css/jquery.fileupload-ui.css', 'public/admin/css/blueimp')
    .copy('node_modules/blueimp-file-upload/css/jquery.fileupload-noscript.css', 'public/admin/css/blueimp')
    .copy('node_modules/blueimp-file-upload/css/jquery.fileupload-ui-noscript.css', 'public/admin/css/blueimp')
    .copy('node_modules/blueimp-file-upload/js/vendor/jquery.ui.widget.js', 'public/admin/js/blueimp/vendor')
    .copy('node_modules/blueimp-tmpl/js/tmpl.js', 'public/admin/js/blueimp')
    .copy('node_modules/blueimp-load-image/js/load-image.all.min.js', 'public/admin/js/blueimp')
    .copy('node_modules/blueimp-canvas-to-blob/js/canvas-to-blob.min.js', 'public/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.iframe-transport.js', 'public/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload.js', 'public/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload-process.js', 'public/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload-image.js', 'public/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload-audio.js', 'public/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload-video.js', 'public/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload-validate.js', 'public/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload-ui.js', 'public/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/cors/jquery.xdr-transport.js', 'public/admin/js/blueimp/cors');

