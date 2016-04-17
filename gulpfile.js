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
    mix.scripts(['/highlight.pack.js'], 'public/js/highlight.js')
        .scripts(['/vendor/jquery.js', '/vendor/modernizr.js', '/foundation.min.js', '/foundation/foundation.topbar.js'], 'public/js/app.js');



    mix.styles(['normalize.css', 'foundation.css', 'custom.css'], 'public/css/app.css')
        .styles(['highlight/github.css'], 'public/css/highlight.css');

    mix.version(['js/app.js', 'js/highlight.js', 'css/app.css', 'css/highlight.css']);
});
