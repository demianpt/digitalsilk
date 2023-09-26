const {
    src,
    dest,
} = require('gulp');

const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const gulpsprite = require('gulp-svg-sprite');

const config = require('../../config');

const svgSpriteConfig = {
/*    shape: {
        spacing: {
            padding: 2,
        },
        dimension: {
            maxWidth: 32,
            maxHeight: 32,
        },
    },*/
    mode: {
        css: {
/*            dimensions: true,
            common: 'icon',
            layout: 'vertical',
            prefix: '.icon-',*/
            bust: false,
            dest: './',
            sprite: 'svg-sprite.svg',
            render: {
                css: true,
            },
        },
        symbol: {
            dest: 'sprite',
            inline: true,
            sprite: 'sprite-symbol.svg.php',
            example: true,
        },
        transform: [{
            svgo: {
                plugins: [
                    { removeViewBox: false },
                    { removeUselessStrokeAndFill: false },
                    { cleanupIDs: false },
                    { mergePaths: false },
                    { removeUnknownsAndDefaults: false },
                ],
            },
        }],
        svg: {
            xmlDeclaration: false,
            doctypeDeclaration: false,
            namespaceIDs: false,
        },

    },
};

/**
 * when we use gulp as return function, we dont need done() callback to signal completion
 * uses: gulp svg sprite    for generating sprite file defined in config above
 * uses: newer              to check if there were file changes or not
 */
const sprite = () => {
    const source = `${config.root.dev}/${config.sprite.dev}/*.svg`;
    const output = `${config.root.dist}/${config.sprite.dist}`;

    return src(source)
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>'),
        }))
        .pipe(gulpsprite(svgSpriteConfig))
        .pipe(dest(output));
};

module.exports = sprite;
