const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */


// html5shiv
mix.copy('node_modules/html5shiv/dist/html5shiv.min.js', 'public/vendor/html5shiv');
mix.copy('node_modules/html5shiv/dist/html5shiv-printshiv.min.js', 'public/vendor/html5shiv');

// respond.js
mix.copy('node_modules/respond.js/dest/respond.min.js', 'public/vendor/respond');

// gentelella
mix.copy('node_modules/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css', 'public/vendor/gentelella/vendors/bootstrap/dist/css');
mix.copy('node_modules/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css.map', 'public/vendor/gentelella/vendors/bootstrap/dist/css');
mix.copy('node_modules/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css', 'public/vendor/gentelella/vendors/malihu-custom-scrollbar-plugin');
mix.copy('node_modules/gentelella/vendors/nprogress/nprogress.css', 'public/vendor/gentelella/vendors/nprogress');
mix.copy('node_modules/gentelella/vendors/pnotify/dist/pnotify.css', 'public/vendor/gentelella/vendors/pnotify/dist');
mix.copy('node_modules/gentelella/vendors/pnotify/dist/pnotify.nonblock.css', 'public/vendor/gentelella/vendors/pnotify/dist');
mix.copy('node_modules/gentelella/vendors/pnotify/dist/pnotify.buttons.css', 'public/vendor/gentelella/vendors/pnotify/dist');
mix.copy('node_modules/gentelella/vendors/switchery/dist/switchery.min.css', 'public/vendor/gentelella/vendors/switchery/dist');
mix.copy('node_modules/gentelella/vendors/iCheck/skins/flat/green.css', 'public/vendor/gentelella/vendors/iCheck/skins/flat');
mix.copy('node_modules/gentelella/vendors/ion.rangeSlider/css/ion.rangeSlider.css', 'public/vendor/gentelella/vendors/ion.rangeSlider/css');
mix.copy('node_modules/gentelella/vendors/ion.rangeSlider/css/ion.rangeSlider.skinModern.css', 'public/vendor/gentelella/vendors/ion.rangeSlider/css');
mix.copy('node_modules/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css', 'public/vendor/gentelella/vendors/datatables.net-bs/css');
mix.copy('node_modules/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css', 'public/vendor/gentelella/vendors/datatables.net-responsive-bs/css');
mix.copy('node_modules/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css', 'public/vendor/gentelella/vendors/datatables.net-fixedheader-bs/css');
mix.copy('node_modules/gentelella/vendors/jQuery-Smart-Wizard/styles/smart_wizard.css', 'public/vendor/gentelella/vendors/jQuery-Smart-Wizard/styles');
mix.copy('node_modules/gentelella/vendors/dropzone/dist/min/dropzone.min.css', 'public/vendor/gentelella/vendors/dropzone/dist/min');
mix.copy('node_modules/gentelella/vendors/font-awesome/css/font-awesome.css.map', 'public/vendor/gentelella/vendors/font-awesome/css');
mix.copy('node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css', 'public/vendor/gentelella/vendors/bootstrap-daterangepicker');

mix.copy('node_modules/gentelella/build/css/custom.min.css', 'public/vendor/gentelella/css');

mix.copy('node_modules/gentelella/vendors/jquery/dist/jquery.min.js', 'public/vendor/gentelella/vendors/jquery/dist');
mix.copy('node_modules/gentelella/vendors/jquery/dist/jquery.min.map', 'public/vendor/gentelella/vendors/jquery/dist');
mix.copy('node_modules/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js', 'public/vendor/gentelella/vendors/bootstrap/dist/js');
mix.copy('node_modules/gentelella/vendors/moment/min/moment-with-locales.min.js', 'public/vendor/gentelella/vendors/moment/min');
mix.copy('node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js', 'public/vendor/gentelella/vendors/bootstrap-daterangepicker');
mix.copy('node_modules/gentelella/vendors/jquery-mousewheel/jquery.mousewheel.min.js', 'public/vendor/gentelella/vendors/jquery-mousewheel');
mix.copy('node_modules/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js', 'public/vendor/gentelella/vendors/malihu-custom-scrollbar-plugin');
mix.copy('node_modules/gentelella/vendors/nprogress/nprogress.js', 'public/vendor/gentelella/vendors/nprogress');
mix.copy('node_modules/gentelella/vendors/fastclick/lib/fastclick.js', 'public/vendor/gentelella/vendors/fastclick/lib');
mix.copy('node_modules/gentelella/vendors/pnotify/dist/pnotify.js', 'public/vendor/gentelella/vendors/pnotify/dist');
mix.copy('node_modules/gentelella/vendors/pnotify/dist/pnotify.nonblock.js', 'public/vendor/gentelella/vendors/pnotify/dist');
mix.copy('node_modules/gentelella/vendors/pnotify/dist/pnotify.buttons.js', 'public/vendor/gentelella/vendors/pnotify/dist');
mix.copy('node_modules/gentelella/vendors/switchery/dist/switchery.min.js', 'public/vendor/gentelella/vendors/switchery/dist');
mix.copy('node_modules/gentelella/vendors/iCheck/icheck.min.js', 'public/vendor/gentelella/vendors/iCheck');
mix.copy('node_modules/gentelella/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js', 'public/vendor/gentelella/vendors/jquery.inputmask/dist/min');
mix.copy('node_modules/gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js', 'public/vendor/gentelella/vendors/bootstrap-wysiwyg/js');
mix.copy('node_modules/gentelella/vendors/jquery.hotkeys', 'public/vendor/gentelella/vendors/jquery.hotkeys');
mix.copy('node_modules/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js', 'public/vendor/gentelella/vendors/datatables.net/js');
mix.copy('node_modules/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js', 'public/vendor/gentelella/vendors/datatables.net-bs/js');
mix.copy('node_modules/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js', 'public/vendor/gentelella/vendors/datatables.net-responsive/js');
mix.copy('node_modules/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js', 'public/vendor/gentelella/vendors/datatables.net-fixedheader/js');
mix.copy('node_modules/gentelella/vendors/jszip/dist/jszip.min.js', 'public/vendor/gentelella/vendors/jszip/dist');
mix.copy('node_modules/gentelella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js', 'public/vendor/gentelella/vendors/jQuery-Smart-Wizard/js');
mix.copy('node_modules/gentelella/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js', 'public/vendor/gentelella/vendors/jquery.inputmask/dist/min');
mix.copy('node_modules/gentelella/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js', 'public/vendor/gentelella/vendors/ion.rangeSlider/js');
mix.copy('node_modules/gentelella/vendors/jquery.easy-pie-chart/dist/jquery.easypiechart.js', 'public/vendor/gentelella/vendors/jquery.easy-pie-chart/dist');
mix.copy('node_modules/gentelella/vendors/gauge.js/dist/gauge.js', 'public/vendor/gentelella/vendors/gauge.js/dist');
mix.copy('node_modules/gentelella/vendors/echarts/dist/echarts.js', 'public/vendor/gentelella/vendors/echarts/dist');
mix.copy('node_modules/gentelella/vendors/dropzone/dist/min/dropzone.min.js', 'public/vendor/gentelella/vendors/dropzone/dist/min');

mix.copy('node_modules/gentelella/vendors/bootstrap/dist/fonts', 'public/vendor/gentelella/vendors/bootstrap/dist/fonts');


// bootstrap datetimepicker
mix.copy('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', 'public/vendor/eonasdan-bootstrap-datetimepicker/build/css');
mix.copy('node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 'public/vendor/eonasdan-bootstrap-datetimepicker/build/js');

//font-awesome
mix.copy('node_modules/font-awesome/css/font-awesome.min.css', 'public/vendor/font-awesome/css');
mix.copy('node_modules/font-awesome/css/font-awesome.css.map', 'public/vendor/font-awesome/css');
mix.copy('node_modules/font-awesome/fonts', 'public/vendor/font-awesome/fonts');

// jquery form
mix.copy('node_modules/jquery-form/dist/jquery.form.min.js', 'public/vendor/jquery-form');
mix.copy('node_modules/jquery-form/dist/jquery.form.min.js.map', 'public/vendor/jquery-form');

// jquery validations
mix.copy('node_modules/jquery-validation/dist/jquery.validate.min.js', 'public/vendor/jquery-validation');
mix.copy('node_modules/jquery-validation/dist/localization/messages_es.js', 'public/vendor/jquery-validation/localization');
mix.copy('node_modules/jquery-validation/dist/additional-methods.js', 'public/vendor/jquery-validation');

// json editor
mix.copy('node_modules/jsoneditor/dist/jsoneditor.min.css', 'public/vendor/jsoneditor');
mix.copy('node_modules/jsoneditor/dist/jsoneditor.min.js', 'public/vendor/jsoneditor');
mix.copy('node_modules/jsoneditor/dist/jsoneditor.js.map', 'public/vendor/jsoneditor');

// timepicker
mix.copy('node_modules/timepicker/jquery.timepicker.min.css', 'public/vendor/timepicker');
mix.copy('node_modules/timepicker/jquery.timepicker.min.js', 'public/vendor/timepicker');

// bootbox
mix.copy('node_modules/bootbox/bootbox.js', 'public/vendor/bootbox');

// fullcalendar
mix.copy('node_modules/fullcalendar/dist/fullcalendar.min.css', 'public/vendor/fullcalendar/dist');
mix.copy('node_modules/fullcalendar/dist/fullcalendar.min.js', 'public/vendor/fullcalendar/dist');
mix.copy('node_modules/fullcalendar/dist/locale/es.js', 'public/vendor/fullcalendar/dist/locale');

// select2
mix.copy('node_modules/select2/dist/css/select2.min.css', 'public/vendor/select2/dist/css/select2.min.css');
mix.copy('node_modules/select2/dist/js/select2.full.min.js', 'public/vendor/select2/dist/js');
mix.copy('node_modules/select2/dist/js/i18n/es.js', 'public/vendor/select2/dist/js/i18n');

// bootstrap-colorpicker
mix.copy('node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css', 'public/vendor/bootstrap-colorpicker/dist/css');
mix.copy('node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js', 'public/vendor/bootstrap-colorpicker/dist/js');

// knockout
mix.copy('node_modules/knockout/build/output/knockout-latest.js', 'public/vendor/knockout');
mix.copy('node_modules/knockout.validation/dist', 'public/vendor/knockout.validation');

// datatables.net-rowsgroup
mix.copy('resources/js/vendor/datatables-rowsgroup-2.0.0', 'public/vendor/datatables-rowsgroup-2.0.0');

// datatables.net-buttons
mix.copy('node_modules/datatables.net-buttons/js', 'public/vendor/datatables.net-buttons');
mix.copy('node_modules/datatables.net-rowgroup/js', 'public/vendor/datatables.net-rowgroup');

// jspdf
mix.copy('node_modules/jspdf/dist/jspdf.min.js', 'public/vendor/jspdf');

// jspdf-autotable
mix.copy('node_modules/jspdf-autotable/dist/jspdf.plugin.autotable.min.js', 'public/vendor/jspdf-autotable');

// images
mix.copy('resources/images', 'public/images');

// SlickGrid
mix.copy('node_modules/slickgrid/slick.grid.css', 'public/vendor/slickgrid');
mix.copy('node_modules/slickgrid/lib/jquery.event.drag-2.3.0.js', 'public/vendor/slickgrid/lib');
mix.copy('node_modules/slickgrid/slick.core.js', 'public/vendor/slickgrid');
mix.copy('node_modules/slickgrid/slick.grid.js', 'public/vendor/slickgrid');
mix.copy('node_modules/slickgrid/slick.formatters.js', 'public/vendor/slickgrid');
mix.copy('node_modules/slickgrid/slick.editors.js', 'public/vendor/slickgrid');
mix.copy('node_modules/slickgrid/slick.dataview.js', 'public/vendor/slickgrid');

// JsGantt
mix.copy('node_modules/jsgantt-improved/dist/jsgantt.css', 'public/vendor/jsgantt-improved/dist');
mix.copy('node_modules/jsgantt-improved/dist/jsgantt.js', 'public/vendor/jsgantt-improved/dist');

// Jquery Number
mix.copy('node_modules/jquery-number/jquery.number.min.js', 'public/vendor/jquery-number');

// Chart.js
mix.copy('node_modules/chart.js/dist/Chart.bundle.min.js', 'public/vendor/chart.js/dist');

// map Shapes
mix.copy('resources/js/vendor/shapes', 'public/vendor/shapes');

// Quill Editor
mix.copy('node_modules/quill/dist/quill.snow.css', 'public/vendor/quill');
mix.copy('node_modules/quill/dist/quill.js', 'public/vendor/quill');


mix.js('resources/js/app.js', 'public/js')
    .combine([
        'resources/js/gentelella.js',
        'resources/js/datatables.js',
        'resources/js/treeview.js',
        'resources/js/main.js',
        'resources/js/utils.js',
        'resources/js/slickgrid.js',
    ], 'public/js/main.js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import')
    ])
    .postCss('resources/css/login.css', 'public/css', [
        require('postcss-import')
    ])
    .postCss('resources/css/modules_index.css', 'public/css', [
        require('postcss-import')
    ])
    .postCss('resources/css/dashboard.css', 'public/css', [
        require('postcss-import')
    ])
    .postCss('resources/css/report_pdf.css', 'public/css', [
        require('postcss-import')
    ])
    .postCss('resources/css/theme.css', 'public/css', [
        require('postcss-import')
    ])
	.js('resources/js/api_osm.js', 'public/js');

if (mix.inProduction()) {
    mix.version();
}
