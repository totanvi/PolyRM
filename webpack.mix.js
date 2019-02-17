let mix = require('laravel-mix');

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

//    .sass('resources/assets/sass/app.scss', 'public/css')
mix.autoload({
	jquery: ['$', 'window.jQuery', "jQuery", "window.$", "jquery", "window.jquery"]
});
//mix
// .js([
// 	'public/js/jquery-3.3.1.min.js',
// 	'public/js/plugins.js',
// 	'public/js/functions.js',
// 	'public/js/dropzone.js',
// 	'public/js/sweetalert.min.js',
// ], 'public/js/app.js')
// .js([
// 	'public/js/plugins/jquery.gmap.min.js',
// 	'public/js/map-addresses.js',
// 	'public/js/map-custom.js',
// ], 'public/js/map.js')
mix.styles([
	'public/css/font.css',
	'public/css/font-fileuploader.css',
	'public/css/jquery.fileuploader.min.css',
	'public/css/bootstrap.min.css',
	'public/css/external.css',
	'public/css/sweetalert2.min.css',
	'public/css/dropzone.min.css',
	'public/css/select2.min.css',
	'public/css/style.css',
	'public/css/mystyle.css',
], 'public/css/all.css')
mix.styles([
	'public/css/bootstrap.min.css',
	'public/fonts/font-awesome.min.css',
	'public/css/animate.css',
	'public/css/font-fileuploader.css',
	'public/css/jquery.fileuploader.min.css',
	'public/css/admin.css',
	'public/css/sweetalert2.min.css',
	'public/css/datatables.min.css',
	'public/css/select2.min.css',
	'public/css/mystyle.css',
], 'public/css/adminAll.css')
.browserSync('http://127.0.0.1:8000/')
.disableNotifications();
