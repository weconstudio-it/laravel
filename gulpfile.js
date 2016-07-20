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
    mix.sass('app.scss');

    mix.sass([
            '../../components/datatables-buttons/css/buttons.dataTables.scss',
            '../../components/datatables-buttons/css/buttons.bootstrap.scss',
            '../../components/datatables-fixedheader/css/fixedHeader.dataTables.scss',
            '../../components/datatables-fixedheader/css/fixedHeader.bootstrap.scss',
            '../../components/datatables-fixedheader/css/fixedHeader.jqueryui.scss',
            '../../components/datatables-select/css/select.dataTables.scss',
            '../../components/datatables-select/css/select.bootstrap.scss',
            '../../components/datatables-select/css/select.jqueryui.scss',
            '../../components/datatables-responsive/css/responsive.dataTables.scss',
            '../../components/datatables-responsive/css/responsive.bootstrap.scss',
            '../../components/datatables-responsive/css/responsive.jqueryui.scss'
        ],
        'public/css/datatables.css'
    );

    // basic CSS components
    mix.styles([
        '../../components/font-awesome/css/font-awesome.min.css',
        '../../components/datetimepicker/jquery.datetimepicker.css',
        '../../components/jquery.gritter/css/jquery.gritter.css',
        '../../components/fullcalendar/dist/fullcalendar.min.css',
        '../../components/chosen/chosen.css',
        '../../components/leaflet/dist/leaflet.css',
        '../../components/leaflet-geosearch/src/css/l.geosearch.css',
        '../../components/dropzone/dist/min/dropzone.min.css',
        '../../components/_mod/jqgrid/ui.jqgrid.css',
        '../../components/fuelux/dist/css/fuelux.min.css',
        '../../components/select2/dist/css/select2.min.css',
        '../../components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css'
    ], 'public/css/components-all.css');

    // basic CSS components - IE lte9 version
    mix.styles([
        '../ace/css/ace-part2.min.css'
    ], 'public/css/ie-lte9-all.css');

    // basic JS components
    mix.scripts([
        '../../components/jquery/jquery.min.js',
        '../../components/jquery-ui/jquery-ui.min.js',
        '../../components/bootstrap/dist/js/bootstrap.min.js',
        '../../components/jquery.gritter/js/jquery.gritter.min.js',
        '../../components/datetimepicker/build/jquery.datetimepicker.full.min.js',
        '../../components/moment/min/moment-with-locales.min.js',
        '../../components/fullcalendar/dist/fullcalendar.min.js',
        '../../components/jqGrid/js/jquery.jqGrid.min.js',
        '../../components/datatables/media/js/jquery.dataTables.min.js',
        '../../components/datatables/media/js/dataTables.bootstrap.min.js',
        //'../../components/pdfmake/build/pdfmake.min.js',
        //'../../components/pdfmake/build/vfs_fonts.js',
        '../../components/datatables-buttons/js/dataTables.buttons.js',
        '../../components/datatables-buttons/js/buttons.bootstrap.js',
        '../../components/datatables-buttons/js/buttons.colVis.js',
        '../../components/datatables-buttons/js/buttons.flash.js',
        '../../components/datatables-buttons/js/buttons.html5.js',
        '../../components/datatables-buttons/js/buttons.jqueryui.js',
        '../../components/datatables-buttons/js/buttons.print.js',
        '../../components/datatables-buttons/js/buttons.semanticui.js',
        '../../components/datatables-fixedheader/js/dataTables.fixedHeader.js',
        '../../components/datatables-select/js/dataTables.select.js',
        '../../components/datatables-responsive/js/dataTables.responsive.js',
        '../../components/datatables-responsive/js/responsive.bootstrap.js',
        '../../components/datatables-responsive/js/responsive.jqueryui.js',
        '../../components/chosen/chosen.jquery.js',
        '../../components/ajax-chosen/lib/ajax-chosen.min.js',
        '../../components/leaflet/dist/leaflet.js',
        '../../components/Leaflet.MakiMarkers/Leaflet.MakiMarkers.js',
        '../../components/leaflet-geosearch/src/js/l.control.geosearch.js',
        '../../components/leaflet-geosearch/src/js/l.geosearch.provider.google.js',
        '../../components/blockUI/jquery.blockUI.js',
        '../../components/dropzone/dist/min/dropzone.min.js',
        '../../components/_mod/fuelux/tree.js',
		'../../components/select2/dist/js/select2.full.min.js',
		'../../components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js'
    ], 'public/js/components-all.js');

    // it localization scripts
    mix.scripts([
        '../../components/fullcalendar/dist/lang/it.js',
        '../../components/jqGrid/js/i18n/grid.locale-it.js',
    ], 'public/js/it-all.js');

    // basic JS components - IE version
    mix.scripts([
        '../../components/jquery.1x/dist/jquery.min.js',
        '../../components/bootstrap/dist/js/bootstrap.min.js'
    ], 'public/js/ie-all.js');

    // basic JS components - IE lte 8 version
    mix.scripts([
        '../../components/html5shiv/dist/html5shiv.min.js',
        '../../components/respond/dest/respond.min.js'
    ], 'public/js/ie-lte8-all.js');

    // ACE CSS/JS components
    mix.copy('resources/assets/ace/css/*.css', 'public/css/');
    mix.copy('resources/assets/ace/js/*.js', 'public/js/');
    mix.copy('resources/components/font-awesome/fonts/*.*', 'public/fonts/');
    mix.copy('resources/components/datatables/media/images/*.*', 'public/images/');
    mix.copy('resources/assets/ace/fonts/*.*', 'public/fonts/');

    // LEAFLET
    //mix.copy('resources/components/leaflet/dist/images/*.*', 'public/imgs/leaflet/');

    // script applicazione
    mix.scriptsIn('resources/assets/js', 'public/js/custom-all.js');

    mix.version([
        'css/app.css',
        'js/custom-all.js'
    ]);
});
