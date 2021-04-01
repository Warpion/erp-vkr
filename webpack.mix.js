const mix = require('laravel-mix');

require('laravel-mix-clean-css');

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

mix.disableNotifications();

mix.sass('resources/scss/style.scss', 'styles')
    .cleanCss({
        level: 2,
    });

mix.js([
    'resources/js/script.js',
], 'public/js/script.js');


mix.browserSync('erp.loc');

