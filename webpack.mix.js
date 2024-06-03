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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .sourceMaps();

let v2_assets_dir = 'assets/';

mix.sass('resources/sass/style.scss', `public/${v2_assets_dir}/css`)
    .sass('resources/sass/media.scss', `public/${v2_assets_dir}/css`)
    .sass('resources/sass/chat.scss', `public/${v2_assets_dir}/css`)
    .sourceMaps().version();
