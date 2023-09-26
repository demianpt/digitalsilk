const {
    series,
    parallel,
    watch,
} = require('gulp');

const bs = require('browser-sync').get('DSMP');
const { browserSync } = require('./tasks/browser-sync');

const config = require('../config');

/**
 * import each task as function
 */
const css = require('./tasks/css');
const js = require('./tasks/js');
const images = require('./tasks/images');
const sprite = require('./tasks/sprite');

/**
 * create glob for each task to watch
 */
const watchCss = `${config.root.dev}/${config.css.dev}`;
const watchJs = `${config.root.dev}/${config.js.dev}`;
const watchPhp = `${config.php.dist}${config.php.ext}`;
const watchImages = `${config.root.dev}/${config.images.dist}`;
const watchSprite = `${config.root.dev}/${config.sprite.dev}`;

// creating watch task that includes all tasks to watch for
const watchFiles = () => {

    watch(watchCss, series(css));
    watch(watchJs, series(js)).on('change', bs.reload);
    watch(watchImages, series(images)).on('change', bs.reload);
    watch(watchSprite, series(sprite)).on('change', bs.reload);

    if (config.php.watch) {
        watch(watchPhp).on('change', bs.reload);
    }
};

// run css, images, js, to compile first, then run watch files
const watchTask = series(css, images, js, sprite, parallel(browserSync, watchFiles));

// export watchfiles so it can be reused, and watchtask as watchtask
module.exports = {
    watchFiles,
    watchTask,
};
