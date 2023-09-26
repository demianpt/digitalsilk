const {
    series,
    parallel,
} = require('gulp');

const {
    browserSync,
} = require('./tasks/browser-sync');

const config = require('../config');

/**
 * import each task as function
 */
const { cleanLight } = require('./tasks/clean');
const css = require('./tasks/css');
const cssWoocommerce = require('./tasks/css-woocommerce');
const js = require('./tasks/js');
const { watchFiles } = require('./watch');

/**
 * define default task, that will be dependant on environment
 * this config.production is set when running yarn build
 *
 * if config production, clean, and then run other tasks
 * otherwise run watchfiles and browsersync
 */

let lightTask;
if (config.production) {
    lightTask = series(
        cleanLight,
        parallel(cssWoocommerce, js),
    );
} else {
    lightTask = series(css, js, parallel(browserSync, watchFiles));
}

module.exports = lightTask;
