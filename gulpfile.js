var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
        .sass('app.scss')
        .sass(['admin.scss'], 'public/css/admin.css')
        .styles(['highlight/vs.css'], 'public/css/highlight.css')
        .scripts('highlight.pack.js', 'public/js/highlight.js')
        .scripts(['bootstrap.js', 'bootstrap-sprockets.js'], 'public/js/admin.js')
        .version(['js/admin.js', 'css/app.css', 'js/highlight.js', 'css/highlight.css', 'css/admin.css']);

    //mix.styles(['normalize.css', 'foundation.css', 'custom.css'], 'public/css/app.css')
    //    .styles(['highlight/github.css'], 'public/css/highlight.css');
    //
    //mix.version(['js/app.js', 'js/highlight.js', 'css/app.css', 'css/highlight.css']);
});
