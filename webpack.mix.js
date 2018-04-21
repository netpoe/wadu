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

mix.js('resources/js/admin/orders/index.js', 'public/js')
   .sass('resources/sass/admin/orders/new.scss', 'public/css/admin/orders', {
    includePaths: ['node_modules']
   })
   .browserSync({
      proxy: 'localhost:8000'
    });
