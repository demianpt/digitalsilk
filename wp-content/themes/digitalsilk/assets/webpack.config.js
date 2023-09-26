const webpack = require('webpack');
const path = require('path');

const config = require('./config');
const WebpackBuildNotifierPlugin = require('webpack-build-notifier');

const JS_DEV = path.resolve(config.root.dev, config.js.dev);
const JS_DIST = path.resolve(config.root.dist, config.js.dist);

const webpackConfig = {
    mode: config.production ? 'production' : 'development',
    optimization: {
        minimize: config.production
    },
    context: JS_DEV,
    entry: {
        app: ['./index.js'],
        app_single: ['./js-single.js'],
        app_blog: ['./js-blog.js'],
        app_woocommerce: ['./js-woocommerce.js'],
        vendor: ['./vendor.js']
    },
    output: {
        path: JS_DIST,
        filename: '[name].js',
        publicPath: config.production ? '' : config.browserSync.proxy.publicPath,
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel-loader'
            },
        ],
    },
    resolve: {
        modules: [
            JS_DEV,
            'node_modules',
        ],
        extensions: ['.js', '.json'],
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery'
        })],

    externals: {
        'jquery': 'jQuery'
    }
};

/** Modifies webpackConfig depends on mode. */
if (config.production) {
    webpackConfig.plugins.push(
        new webpack.NoEmitOnErrorsPlugin(),
    );
} else {
    webpackConfig.devtool = 'inline-source-map';
    // webpackConfig.entry.app.unshift('webpack-hot-middleware/client?reload=true');
    webpackConfig.plugins.push(new webpack.HotModuleReplacementPlugin());
}
if (!config.production) {
    if (config.js.notifyShow) {
        webpackConfig.plugins.push(
            new WebpackBuildNotifierPlugin({
                title: "DSMP Project",
                suppressSuccess: true, // don't spam success notifications
                time: 500,
                successSound: config.js.notifySound,
                failureSound: config.js.notifySoundWarn
            })
        )
    }
}

module.exports = webpackConfig;
