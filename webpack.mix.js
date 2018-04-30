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

let js = [
  {src: 'resources/js/admin/orders/index.js', dest: 'public/js/admin/orders'},
  {src: 'resources/js/admin/orders/show.js', dest: 'public/js/admin/orders'},

  {src: 'resources/js/front/menu/index.js', dest: 'public/js/front/menu'},
];

let css = [
  {src: 'resources/sass/admin/orders/new.scss', dest: 'public/css/admin/orders'},
  {src: 'resources/sass/admin/orders/index.scss', dest: 'public/css/admin/orders'},

  {src: 'resources/sass/front/menu/index.scss', dest: 'public/css/front/menu'},
  {src: 'resources/sass/front/orders/shipping.scss', dest: 'public/css/front/orders'},
  {src: 'resources/sass/front/orders/checkout.scss', dest: 'public/css/front/orders'},
  {src: 'resources/sass/front/orders/pending.scss', dest: 'public/css/front/orders'},
];

js.forEach(item => {
  mix.js(item.src, item.dest, {
    includePaths: ['node_modules', 'resources']
  });
});

css.forEach(item => {
  mix.sass(item.src, item.dest, {
    includePaths: ['node_modules', 'resources']
  });
});

mix.browserSync({
    proxy: 'localhost:8000'
  });
