const mix = require('laravel-mix');
if (mix.inProduction()) {
    mix.version();
}
mix.disableNotifications();

mix.webpackConfig({
    resolve: {
        alias: {
            'vue-router$': 'vue-router/dist/vue-router.common.js'
        }
    },
    // output: {
    //     publicPath: '/',
    //     filename: '[name].[chunkhash:20].js',
    //     chunkFilename : '[name].js?id=[chunkhash:20]'
    // }
});

mix.options({
    processCssUrls: false
});

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


// mix.js('resources/h5/base.js', 'public/js/h5/');
mix.js('resources/h5/index/index.js', 'public/js/h5/index');
mix.js('resources/h5/user/index.js', 'public/js/h5/user');
mix.js('resources/h5/item/index.js', 'public/js/h5/item');
mix.js('resources/h5/cart/index.js', 'public/js/h5/cart');
mix.js('resources/h5/catlog/index.js', 'public/js/h5/catlog');
mix.js('resources/h5/order/buynow/index.js', 'public/js/h5/order/buynow');
mix.js('resources/h5/order/confirm/index.js', 'public/js/h5/order/confirm');
mix.js('resources/h5/address/index.js', 'public/js/h5/address');
mix.js('resources/h5/trade/bought/index.js', 'public/js/h5/trade/bought');
mix.js('resources/h5/trade/order/index.js', 'public/js/h5/trade/order');
mix.js('resources/h5/trade/sold/order.js', 'public/js/h5/trade/sold');
// mix.js('resources/h5/feedback/index.js', 'public/js/h5/feedback');
mix.js('resources/h5/security/index.js', 'public/js/h5/security');
//sass
mix.sass('resources/sass/h5/index.scss', 'public/css/h5');
//less
// mix.less('resources/sass/vant.less', 'public/css/vendor');

