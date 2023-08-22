let mix = require('laravel-mix');
mix.options({processCssUrls: false});

if (mix.inProduction()) {
  mix.version();
}

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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css')
//    .version();
mix.sass('resources/assets/scss/app.scss', 'public/css/app.css');
mix.sass('resources/assets/scss/components/error.scss', 'public/css/error.css');

mix.sass('resources/assets/scss/pages/terms_of_service.scss', 'public/css/acknowledgement.css');