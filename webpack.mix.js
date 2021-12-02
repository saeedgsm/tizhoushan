const mix = require('laravel-mix');

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


 // dev
//mix.js('resources/js/app.js','public/js/vue.js');
// prod
mix.js('resources/js/app.js','public/js/v0.1.122/vue.js');

