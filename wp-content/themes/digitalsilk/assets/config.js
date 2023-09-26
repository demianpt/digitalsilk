const path = require('path');

const { env } = process;
require('dotenv').config();

module.exports = {
  production: env.NODE_ENV === 'production',
  cleanFilesOutsideWorkingDir: env.CLEAN_FILES_OUTSIDE_WORKING_DIR === 'true',
  root: {
    dev: env.ROOT_DEV,
    dist: env.ROOT_DIST,
  },
  html: {
    dev: env.HTML_DEV,
    dist: env.HTML_DIST,
    parts: env.HTML_PARTS,
    run: env.HTML_RUN === 'false',
  },
  php: {
    dev: env.PHP_DEV,
    dist: env.PHP_DIST,
    parts: env.PHP_PARTS,
    run: env.PHP_RUN === 'false',
    watch: env.PHP_WATCH === 'true',
    ext: env.PHP_EXTENSIONS,
  },
  css: {
    dev: env.CSS_DEV,
    dist: env.CSS_DIST,
    extensions: env.CSS_EXTENTIONS,
    notifyError: env.NOTIFICATIONS_CSS_ERROR === 'true',
    notifySuccess: env.NOTIFICATIONS_CSS_SUCCESS === 'true',
    notifySound: env.NOTIFICATIONS_SOUND_OK === 'true',
    notifySoundWarn: env.NOTIFICATIONS_SOUND_WARN === 'true',
  },
  js: {
    dev: env.JS_DEV,
    dist: env.JS_DIST,
    notifyShow: env.NOTIFICATIONS_JS_SHOW === 'true',
    notifyError: env.NOTIFICATIONS_JS_ERROR === 'true',
    notifySuccess: env.NOTIFICATIONS_JS_SUCCESS === 'true',
    notifySound: env.NOTIFICATIONS_SOUND_OK === 'true',
    notifySoundWarn: env.NOTIFICATIONS_SOUND_WARN === 'true',
  },
  images: {
    dev: env.IMAGES_DEV,
    dist: env.IMAGES_DIST,
    extensions: env.IMAGES_EXTENTIONS,
  },
  sprite: {
    dev: env.SVG_SPRITE_DEV,
    dist: env.SVG_SPRITE_DIST,
  },
  fonts: {
    dev: env.FONTS_DEV,
    dist: env.FONTS_DIST,
    extensions: env.FONTS_EXTENTIONS,
  },
  static: {
    dev: env.STATIC_DEV,
    dist: env.STATIC_DIST,
  },
  critical: {
    jsondir: env.CRITICAL_PATH,
    jsonfile: env.CRITICAL_JSON,
    screenshots: env.CRITICAL_OPT_SS === 'true',
    width: env.CRITICAL_OPT_WIDTH,
    height: env.CRITICAL_OPT_HEIGHT,
    destdir: env.CRITICAL_OPT_DIR,
    srcfile: env.CRITICAL_OPT_CSS,
    fontface: env.CRITICAL_OPT_IGNORE_FONTFACE === 'true',
    aut: env.CRITICAL_AUTH_STAGING === 'true',
    autUser: env.CRITICAL_AUTH_U,
    autPass: env.CRITICAL_AUTH_P,
  },
  browserSync: {
    port: Number(8888),
    proxy: {
      target: 'http://localhost',
      publicPath: 'http://localhost:8888/onboarding/wp-content/themes/digitalsilk/assets/' || path.join('/', 'js'),
      files: [
        path.join('../assets/_dist', '*.php'),
      ],
    },
  },
};
