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
    //     filename: '[name].[chunkhash:10].js',
    //     chunkFilename : '[name].[chunkhash:10].js'
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

// mix.js('resources/js/env-bootstrap.js', 'public/js');
// mix.js('resources/js/vue-bootstrap.js', 'public/js/lib');
// mix.js('resources/js/vue-components.js', 'public/js');

mix.js('resources/pages/h5/index.js', 'public/js/h5');
mix.js('resources/pages/h5/user.js', 'public/js/h5');
mix.js('resources/pages/h5/cart.js', 'public/js/h5');
mix.js('resources/pages/h5/catlog.js', 'public/js/h5');
mix.js('resources/pages/h5/item.js', 'public/js/h5');
mix.js('resources/pages/h5/sold.js', 'public/js/h5');

//后台
mix.js('resources/pages/admin/app.js', 'public/js/admin');
mix.js('resources/pages/user/app.js', 'public/js/user');
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
//less
// mix.less('resources/sass/vant.less', 'public/css/vendor');

