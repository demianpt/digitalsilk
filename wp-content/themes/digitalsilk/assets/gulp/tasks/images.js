const {
    src,
    dest,
} = require('gulp');

const imagemin = require('gulp-imagemin');
const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const gulpnewer = require('gulp-newer');

const config = require('../../config');

/**
 * when we use gulp as return function, we dont need done() callback to signal completion
 * this case we need done();
 * uses: imagemin   for image processing
 * uses: newer      to check if there were file changes or not
 * TODO: add options to process webp, aif
 */

const images = (done) => {
    const source = `${config.root.dev}/${config.images.dev}${config.images.extensions}`;
    const output = `${config.root.dist}/${config.images.dist}`;

    src(source)
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>')
        }))
        .pipe(gulpnewer(output))
        .pipe(imagemin([
            imagemin.gifsicle({interlaced: true}),
            imagemin.mozjpeg({quality: 75, progressive: true}),
            imagemin.optipng({optimizationLevel: 5}),
            imagemin.svgo({
                plugins: [
                    { removeViewBox: false },
                    { cleanupIDs: false },
                ],
            }),
        ]))
        .pipe(dest(output));
    done();
};

module.exports = images;
