const mix = require('laravel-mix');
if (mix.inProduction()) {
    mix.version();
    mix.webpackConfig({
        resolve: {
            alias: {
                'vue-router$': 'vue-router/dist/vue-router.common.js'
            }
        },
        // output: {
        //     publicPath: '/',
        //     filename: '[name].[chunkhash:10].js',
        //     chunkFilename : '[name].[chunkhash:10].js'
        // }
    });
}
mix.disableNotifications();
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

// mix.js('resources/js/vue.js', 'public/js/lib/vue-chunk.js');
// mix.js('resources/js/common.js', 'public/js/lib');

//h5
mix.js('resources/apps/h5/auth/signin.js', 'public/static/h5/auth');
mix.js('resources/apps/h5/auth/signup.js', 'public/static/h5/auth');
mix.js('resources/apps/h5/index/index.js', 'public/static/h5/index');
mix.js('resources/apps/h5/category/index.js', 'public/static/h5/category');
mix.js('resources/apps/h5/cart/index.js', 'public/static/h5/cart');
mix.js('resources/apps/h5/product/detail.js', 'public/static/h5/product');
mix.js('resources/apps/h5/product/search.js', 'public/static/h5/product');
mix.js('resources/apps/h5/order/buynow.js', 'public/static/h5/order');
mix.js('resources/apps/h5/order/confirm.js', 'public/static/h5/order');
mix.js('resources/apps/h5/sold/detail.js', 'public/static/h5/sold');
mix.js('resources/apps/h5/live/index.js', 'public/static/h5/live');
mix.js('resources/apps/h5/live/detail.js', 'public/static/h5/live');
mix.js('resources/apps/h5/video/index.js', 'public/static/h5/video');
mix.js('resources/apps/h5/user/index.js', 'public/static/h5/user');

//后台
mix.js('resources/apps/admin/app.js', 'public/static/admin');
//会员中心
mix.js('resources/apps/user/app.js', 'public/static/user');
//订单
mix.js('resources/apps/order/buynow.js', 'public/static/order');
mix.js('resources/apps/order/confirm.js', 'public/static/order');
mix.js('resources/apps/cart/app.js', 'public/static/cart');
//sass
// mix.sass('resources/sass/bootstrap.scss', 'public/css/vendor');
// mix.sass('resources/sass/element-ui.scss', 'public/css/vendor');
mix.sass('resources/sass/index/index.scss', 'public/css/index');
mix.sass('resources/sass/admin/index.scss', 'public/css/admin');
// mix.sass('resources/sass/admin/login.scss', 'public/css/admin');
mix.sass('resources/sass/h5/index.scss', 'public/css/h5');
mix.sass('resources/sass/errors/index.scss', 'public/css/errors');
mix.sass('resources/sass/auth/index.scss', 'public/css/auth');
mix.sass('resources/sass/user/index.scss', 'public/css/user');
mix.sass('resources/sass/order/index.scss', 'public/css/order');
mix.sass('resources/sass/cart/index.scss', 'public/css/cart');
mix.sass('resources/sass/post/index.scss', 'public/css/post');
mix.sass('resources/sass/shop/index.scss', 'public/css/shop');
mix.sass('resources/sass/live/index.scss', 'public/css/live');
mix.sass('resources/sass/video/index.scss', 'public/css/video');
mix.sass('resources/sass/page/index.scss', 'public/css/page');
//less
// mix.less('resources/sass/vant.less', 'public/css/vendor');

