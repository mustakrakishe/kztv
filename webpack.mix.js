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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

mix.scripts([
        'resources/js/functions/views/devices.js',
        'resources/js/handlers/views/devices/device.js',
        'resources/js/listeners/views/devices.js'
    ], 'public/js/scenarios/devices.js')
    .version();

mix.postCss('resources/css/devices.css', 'public/css');
mix.postCss('resources/css/welcome.css', 'public/css');