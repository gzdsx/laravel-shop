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

// mix.js('resources/js/vue.js', 'public/lib/vue/vue-chunk.js');
// mix.js('resources/js/common.js', 'public/dist/common');

//h5
mix.js('resources/apps/h5/index.js', 'public/dist/h5');
//后台
mix.js('resources/apps/admin/app.js', 'public/dist/admin');
//sass
// mix.sass('resources/sass/bootstrap.scss', 'public/lib/bootstrap');
// mix.sass('resources/sass/element-ui.scss', 'public/lib/element');
mix.sass('resources/sass/admin/index.scss', 'public/dist/admin');
// mix.sass('resources/sass/admin/login.scss', 'public/dist/admin');
mix.sass('resources/sass/h5/index.scss', 'public/dist/h5');
mix.sass('resources/sass/errors/index.scss', 'public/dist/errors');
mix.sass('resources/sass/auth/index.scss', 'public/dist/auth');
mix.sass('resources/sass/post/index.scss', 'public/dist/post');
mix.sass('resources/sass/shop/index.scss', 'public/dist/shop');
mix.sass('resources/sass/live/index.scss', 'public/dist/live');
mix.sass('resources/sass/video/index.scss', 'public/dist/video');
mix.sass('resources/sass/user/index.scss', 'public/dist/user');

