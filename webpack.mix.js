const mix = require("laravel-mix");

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

mix.js(
    [
        "resources/js/app.js",
        "resources/assets/js/bootstrap.js",
        "resources/assets/js/bootstrap.min.js",
        "resources/assets/js/jquery.js",
        "resources/assets/js/metisMenu.js",
        "resources/assets/js/sb-admin-2.js",
        "resources/assets/js/scripts.js"
    ],
    "public/js"
).styles(
    [
        "resources/assets/css/blog-post.css",
        "resources/assets/css/bootstrap.css",
        "resources/assets/css/bootstrap.min.css",
        "resources/assets/css/font-awesome.css",
        "resources/assets/css/metisMenu.css",
        "resources/assets/css/sb-admin-2.css",
        "resources/assets/css/styles.css"
    ],
    "public/css/app.css"
);
// .sass("resources/sass/app.scss", "public/css")
