var elixir = require('laravel-elixir');
// require('./tasks/angular.task.js');
require('./tasks/bower.task.js');
// require('./tasks/ngHtml2Js.task.js');
require('laravel-elixir-livereload');

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
    .bower()
    // .angular('./angular/')
    // .ngHtml2Js('./angular/**/*.html')
    .sass('./resources/assets/sass/**/*.scss', 'public/css')
    .scripts(['translation.js', 'main.js'], 'public/js/app.js')
    .scripts(['map.js'], 'public/js/map.js')
    .scripts(['event.js'], 'public/js/event.js')
    .scripts(['admin.js'], 'public/js/admin.js')
    .livereload([
      'resources/views/**/*.php',
      'public/js/vendor.js',
      'public/js/app.js',
      'public/css/vendor.css',
      'public/css/app.css'
    ], {
      liveCSS: true
    });

  //uncomment this for gulp tdd
  //.phpUnit();
});
