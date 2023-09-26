**Gulp Webpack Starter** - fast and simple web development toolkit optimized for DS projects.
It uses Gulp task runner and Webpack bundler.
The starter perfectly fits building static HTML templates and speeding up WordPress theme development.
___

## Features

|Features|Description|
|------------------|-----------|
|CSS| [SASS](http://sass-lang.com/), [Autoprefixer](https://github.com/postcss/autoprefixer), [gulp-purgecss](https://www.npmjs.com/package/gulp-purgecss)|
|JS|[Webpack](https://webpack.js.org/), [Babel](http://babeljs.io/)|
|Live Reload|[BrowserSync](http://www.browsersync.io/), [Webpack Dev Middleware](https://github.com/webpack/webpack-dev-middleware), [Webpack Hot Middleware](https://github.com/glenjamin/webpack-hot-middleware)|
|Images| [gulp-imagemin](https://www.npmjs.com/package/gulp-imagemin)|
|SVG sprite| [gulp-svg-sprite](https://github.com/jkphl/gulp-svg-sprite)|

## Getting started

### Requirements

Make sure you have installed the following:
* [Node.js](https://nodejs.org/) (*Recommended to use Node.js >=14.16.1 and higher*)
* [yarn](https://yarnpkg.com/en/) or [npm](https://www.npmjs.com/) 
  (*yarn is a preferable way to compile assets*)

### 1. Setup .env

Copy `.env.default` to `.env` in the theme root folder

`cp .env.default .env`

DO NOT delete .env.default file.

##### Required

Set correct values to `BROWSER_SYNC_TARGET` and `BROWSER_SYNC_PUBLIC_PATH` variables.

- `BROWSER_SYNC_TARGET` - refers to the local domain name of your project
- `BROWSER_SYNC_PUBLIC_PATH` - refers to the relative pathname of the `app.js` in local environment.

### 2. Run command for:

```bash
yarn                // Install packages
yarn start          // Run development mode
yarn start:wc       // Run development mode for woocommerce websites
yarn build          // Compile assets in a production mode
yarn build:light    // Compile assets faster in a production mode (excluding images processing)
```

### Styleguide

Start a new project with creating a style guide page with using `/templates/template-styleguide.php` template.
There you can find default code snippets and live examples for the most used components and modules.

Feel free to remove modules you won't need for your project.
Adding your custom modules to the style guide will improve project maintenance in the future.

### SCSS/CSS

Since LibSass is now deprecated, Dart Sass is being used instead. Some old scss mixins might require syntax updates.

CSS Custom Properties (Variables) are being used by default instead of scss vars:

[ A Complete Guide to Custom Properties ](https://css-tricks.com/a-complete-guide-to-custom-properties/)

Start your theme styling with the following file:

`/assets/_src/sass/__core/settings/_settings-main.scss`

and proceed with all other settings files in the same folder


### Images

All images in the folder `_src/images/` will be optimized. Please do not forget to optimize images for better performance

### SVG Symbols Sprite

```
_src/images/svg-icons           // All SVG files in this folder will be generated into a sprite
```

SVG sprite will be added as an inline code at the top of each page.

Please use the following code to use an icon from a sprite:

```
<?php echo get_svg(array('icon' => 'icon_file_name', 'class' => 'icon_name__icon')); ?>
``` 

Read why [SVG `symbol` a Good Choice for Icons ](https://css-tricks.com/svg-symbol-good-choice-icons/)

### JS

Please follow the structure you find in `_src/js/index.js`

Try to avoid libraries with dependencies if you want to add some 3rd party script

Blog part has own set of scripts (`js-blog.js`)

#### Sliders, Tabs, Counters, Accordions:

You can find live examples on the styleguide page (`/templates/template-styleguide.php`)


#### Helpers:

- [Include Media](https://eduardoboucas.github.io/include-media/) for Media Queries
- [FlexboxGrid](http://flexboxgrid.com/): Bootstrap-like grid system `sass/__helpers/_flexboxgrid.scss`
- WebP support: body has class `.webp` or `.no-webp`


#### Scroll Animation (AOS)

[AOS animation library](https://michalsnik.github.io/aos/)

You can use this library for adding simple scroll animations to the page elements

#### Lazy Load (vanilla-lazyload)

[Lazy Load](https://github.com/verlok/vanilla-lazyload)

In order to make your content be loaded by LazyLoad, you must use some data- attributes instead of the actual attributes.

```
<img 
  alt="A lazy image" 
  class="lazy"
  data-src="lazy.jpg" 
/>
```


### License

Based on [gulp-webpack-starter](https://github.com/wwwebman/gulp-webpack-starter), modified by DigitalSilk dev team
MIT License
