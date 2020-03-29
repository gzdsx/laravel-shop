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

mix.webpackConfig({
    resolve:{
        alias: {
            'vue-router$': 'vue-router/dist/vue-router.common.js'
        }
    }
});

mix.js('resources/h5/index.js', 'public/js/h5/')
    .js('resources/h5/item.js', 'public/js/h5/')
    .js('resources/h5/user.js', 'public/js/h5/')
    .js('resources/h5/cart.js', 'public/js/h5/')
    .js('resources/h5/catlog.js', 'public/js/h5/')
    .js('resources/h5/buynow.js', 'public/js/h5/')
    .js('resources/h5/address.js', 'public/js/h5/')
    //sass
    .sass('resources/sass/h5/index.scss', 'public/css/h5')
    //less
    //.less('resources/sass/vant.less','public/css/vendor');
