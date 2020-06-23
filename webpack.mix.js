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
    .js('resources/js/scripts.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copyDirectory('resources/img', 'public/img')
    .copyDirectory('node_modules/bootstrap/dist/css', 'public/css')
    .copy('node_modules/jquery/dist/jquery.min.js', 'public/js')
    .options({processCssUrls: false})
    .version();

/*
mix.copy('resources/fonts/!*', 'public/fonts')
    .copy('resources/img/!*', 'public/img')
    .copy('node_modules/bootstrap/dist/css/!*', 'public/css');
*/

mix.js('resources/admin/js/admin.js', 'public/assets/admin/js')
    .sass('resources/admin/sass/admin.scss', 'public/assets/admin/css')
    .options({processCssUrls: false})
    .version();

/*mix.copy('node_modules/tinymce/skins', 'public/css/skins');

mix.copy('node_modules/blueimp-file-upload/img/loading.gif', 'public/assets/admin/css/img')
    .copy('node_modules/blueimp-file-upload/img/progressbar.gif', 'public/assets/admin/css/img')
    .copy('node_modules/blueimp-file-upload/css/jquery.fileupload.css', 'public/assets/admin/css/blueimp')
    .copy('node_modules/blueimp-file-upload/css/jquery.fileupload-ui.css', 'public/assets/admin/css/blueimp')
    .copy('node_modules/blueimp-file-upload/css/jquery.fileupload-noscript.css', 'public/assets/admin/css/blueimp')
    .copy('node_modules/blueimp-file-upload/css/jquery.fileupload-ui-noscript.css', 'public/assets/admin/css/blueimp')
    .copy('node_modules/blueimp-file-upload/js/vendor/jquery.ui.widget.js', 'public/assets/admin/js/blueimp/vendor')
    .copy('node_modules/blueimp-tmpl/js/tmpl.js', 'public/assets/admin/js/blueimp')
    .copy('node_modules/blueimp-load-image/js/load-image.all.min.js', 'public/assets/admin/js/blueimp')
    .copy('node_modules/blueimp-canvas-to-blob/js/canvas-to-blob.min.js', 'public/assets/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.iframe-transport.js', 'public/assets/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload.js', 'public/assets/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload-process.js', 'public/assets/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload-image.js', 'public/assets/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload-audio.js', 'public/assets/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload-video.js', 'public/assets/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload-validate.js', 'public/assets/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/jquery.fileupload-ui.js', 'public/assets/admin/js/blueimp')
    .copy('node_modules/blueimp-file-upload/js/cors/jquery.xdr-transport.js', 'public/assets/admin/js/blueimp/cors');*/

mix.browserSync('mupaes.loc');
