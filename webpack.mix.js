const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
.sass('resources/sass/categories.scss', 'public/css')
.sass('resources/sass/questions.scss', 'public/css')
.sass('resources/sass/options.scss', 'public/css')
.sass('resources/sass/form.scss', 'public/css')
.sass('resources/sass/index.scss', 'public/css');
