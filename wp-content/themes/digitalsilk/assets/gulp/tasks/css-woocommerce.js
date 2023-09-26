const {
    src,
    dest,
} = require('gulp');

const gulpif = require('gulp-if');
const sourcemaps = require('gulp-sourcemaps');
const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const sass = require('gulp-sass')(require('sass'));
const autoPrefixer = require('gulp-autoprefixer');
const minify = require('gulp-clean-css');
const notifier = require('node-notifier');

const bs = require('browser-sync').get('DSMP');

// sass.compiler = require('sass');

const config = require('../../config');

/**
 * when we use gulp as return function, we dont need done() callback to signal completion
 * have two modes: production and development
 *
 * DEVELOPMENT:
 * uses: sourcemaps     we need to know where specific rule is in sass file
 * uses: sass           process sass files
 * uses: notify         write logs into console
 * uses: notifier       add logs to system notifications
 *
 * PRODUCTION:
 * uses: sass           process sass files
 * uses: autoprefixer   adds prefix to css rules
 * uses: notify         write logs into console
 * uses: notifier       add logs to system notifications
 */

const cssWoocommerce = () => {
    const source = `${config.root.dev}/${config.css.dev}/**/*.{scss,sass}`;
    const output = `${config.root.dist}/${config.css.dist}`;

    let isSuccess = true;
    const onError = function (err) {
        isSuccess = false;

        if (config.css.notifyError) {
            notifier.notify({
                title: 'Gulp Task Error',
                message: err.message,
                sound: config.css.notifySoundWarn,
                icon: ('assets/gulp/tasks/icons/warning-notification.png'),
            });
        }

        this.emit('end');
    };

    return src(source)
        .pipe(
            gulpif(!config.production, sourcemaps.init()),
        )
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>'),
        }))
        .pipe(sass({
            includePaths: ['./node_modules', 'node_modules/susy/sass'],
            // fiber: Fiber,
            outputStyle: 'expanded',
            sourceMap: true,
            errLogToConsole: true,
        }))
        .on('error', onError)
        .pipe(
            gulpif(
                config.production,
                autoPrefixer(),
            ),
        )
        .pipe(
            gulpif(
                config.production,
                minify({
                    keepSpecialComments: 0,
                }),
            ),
        )
        .pipe(
            gulpif(
                !config.production,
                sourcemaps.write(),
            ),
        )
        .pipe(dest(output))
        .pipe(bs.stream())
        .on('end', () => {
            if (isSuccess) {
                if (config.css.notifySuccess) {
                    notifier.notify({
                        title: 'GULP CSS Task',
                        message: 'CSS Generated',
                        sound: config.css.notifySound,
                        icon: ('assets/gulp/tasks/icons/success-notification.png'),
                    });
                }
            }

        });
};

module.exports = cssWoocommerce;
