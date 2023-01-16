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

mix.js("resources/js/admin/admin.js", "public/js")
  .js("resources/js/admin/company/index.js", "public/js/admin/company")
  .js("resources/js/admin/company/create_update.js", "public/js/admin/company")
  .js("resources/js/admin/employe/index.js", "public/js/admin/employe")
  .js("resources/js/admin/employe/create_update.js", "public/js/admin/employe")
  .vue()
  .sass("resources/sass/admin/admin.scss", "public/css")
  .autoload({
    jquery: ["$", "window.jQuery", "jQuery"]
  })
  .webpackConfig({
    module: {
      rules: [
        {
          // Allow .scss files imported glob
          test: /\.scss/,
          loader: "import-glob-loader"
        }
      ]
    }
  })
  .sourceMaps(false);

if (mix.inProduction()) {
  mix.version();
}
