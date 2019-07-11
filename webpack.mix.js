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

mix.js('resources/admin/js/app.js', 'public/admin/js')
    .js('resources/admin/js/main.js', 'public/admin/js')
    //.js('resources/front/js/app.js', 'public/front/js')
    .sass('resources/admin/sass/app.scss', 'public/admin/css')
    .sass('resources/admin/sass/icons.scss', 'public/admin/css');
    //.sass('resources/front/sass/app.scss', 'public/front/css');
