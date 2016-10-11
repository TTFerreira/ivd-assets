var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
  mix.styles([
    'custom.css',
    'bootstrap.css',
    'AdminLTE.min.css',
    'skin-blue.min.css',
    'toastr.min.css',
    'plugins/iCheck/square/blue.css',
    'plugins/select2/select2.min.css',
    'plugins/datatables/dataTables.bootstrap.css',
    'buttons.dataTables.1.1.2.min.css'
  ])
    .scripts([
      'bootstrap.min.js',
      'app.min.js',
      'toastr.min.js',
      'plugins/select2/select2.full.min.js',
      'plugins/datatables/jquery.dataTables.min.js',
      'plugins/datatables/dataTables.bootstrap.min.js',
      'plugins/datatables/extensions/TableTools/js/dataTables.tableTools.js',
      'plugins/slimScroll/jquery.slimscroll.min.js',
      'dataTables.buttons.min.js',
      'buttons.html5.min.js',
      'jszip.min.js'
  ]);
});
