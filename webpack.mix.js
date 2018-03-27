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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles('./node_modules/vue-event-calendar/dist/style.css', 'public/css/calendar.css');


//.styles('./node_modules/vue2-animate/dist/vue2-animate.min.css', 'public/css/animate.css');
//
// let tailwindcss = require('tailwindcss');
//
// mix.js('resources/assets/js/app.js', 'public/js');
// mix.sass('resources/assets/sass/app.scss', 'public/css')
//     .options({
//         processCssUrls: false,
//         postCss: [ tailwindcss('./tailwind.js') ],
//     });
