const webpack = require('webpack');

const webpackConfig = require('../../webpack.config');

const Log = require('./lib/logger');

const js = (done) => {
    webpack(webpackConfig, (err, stats) => {
        if (err) {
            new Log('Webpack', err).error();
        }

        new Log('Webpack', stats.toString({
            assets: true,
            chunks: false,
            chunkModules: false,
            colors: true,
            hash: false,
            timings: true,
            version: false,
        })).info();
        //console.log(stats);

        done();
    });
};

module.exports = js;