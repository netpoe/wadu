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

mix.webpackConfig({
  resolve: {
    alias: {
      '@js': path.resolve(__dirname, 'resources/assets/js')
    }
  }
});

mix.js('resources/js/admin/orders/index.js', 'public/js/admin/orders', {
    includePaths: ['node_modules', 'resources']
  })
  .js('resources/js/admin/orders/show.js', 'public/js/admin/orders', {
    includePaths: ['node_modules', 'resources']
  })
  .js('resources/js/front/menu/index.js', 'public/js/front/menu', {
    includePaths: ['node_modules', 'resources']
  })
  .sass('resources/sass/admin/orders/new.scss', 'public/css/admin/orders', {
    includePaths: ['node_modules', 'resources']
  })
  .sass('resources/sass/admin/orders/index.scss', 'public/css/admin/orders', {
    includePaths: ['node_modules', 'resources']
  })
  .sass('resources/sass/front/menu/index.scss', 'public/css/front/menu', {
    includePaths: ['node_modules', 'resources']
  })
  .sass('resources/sass/front/orders/shipping.scss', 'public/css/front/orders', {
    includePaths: ['node_modules', 'resources']
  })
  .sass('resources/sass/front/orders/checkout.scss', 'public/css/front/orders', {
    includePaths: ['node_modules', 'resources']
  })
  .browserSync({
    proxy: 'localhost:8000'
  });
