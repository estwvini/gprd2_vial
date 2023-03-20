@extends('layout.base')

@section('styles')
    <link href="{{ mix('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/font-awesome/css/font-awesome.css.map') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/font-awesome/css/font-awesome.css.map') }}" rel="stylesheet"/>


    <link href="{{ mix('vendor/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet"/>

    <link href="{{ mix('vendor/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/nprogress/nprogress.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/ion.rangeSlider/css/ion.rangeSlider.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/ion.rangeSlider/css/ion.rangeSlider.skinModern.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet"/>

    <link href="{{ mix('vendor/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet"/>

    <link href="{{ mix('vendor/gentelella/vendors/jQuery-Smart-Wizard/styles/smart_wizard.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/jsoneditor/jsoneditor.min.css') }}" rel="stylesheet"/>

    <link href="{{ mix('vendor/timepicker/jquery.timepicker.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet"/>

    <!-- SlickGrid -->
    <link href="{{ mix('vendor/slickgrid/slick.grid.css') }}" rel="stylesheet"/>

    <!-- jsgantt improved -->
    <link href="{{ mix('vendor/jsgantt-improved/dist/jsgantt.css') }}" rel="stylesheet"/>

    <!-- Quill Editor -->
    <link href="{{ mix('vendor/quill/quill.snow.css') }}" rel="stylesheet"/>

    <link href="{{ mix('vendor/gentelella/css/custom.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet"/>
    <link href="{{ mix('css/theme.css') }}" rel="stylesheet"/>
    <link href="{{ mix('css/dashboard.css') }}" rel="stylesheet"/>
@endsection

@push('body_classes') nav-md @endpush

@section('body')
    <div class="container body">
        <!-- Main container -->
        <div class="main_container" id="main_container">
            <div class="col-md-3 left_col menu_fixed">
                @include('layout.left_col')
            </div>

            <div class="top_nav">
                @include('layout.top_nav')
            </div>

            <div class="right_col" role="main" id="main_content">
                <!-- Load by AJAX -->
            </div>


        </div>

        <!-- Loading spinner -->
        <div id="loading-spinner">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="padding-top: 10px;">
                    <i class="fa fa-spinner fa-spin" style="font-size: 5em;"></i>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- Logout form -->
        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;" autocomplete="off">
            @csrf
        </form>

        <!-- Util extra large modal -->
        <div id="util-modal-xl" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <!-- Load modal content by AJAX -->
            </div>
        </div>

        <!-- Util large modal -->
        <div id="util-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg @if(!session('changedPassword')) no-passwd @endif">
                <!-- Load modal content by AJAX -->
            </div>
        </div>

        <!-- Util small modal -->
        <div id="util-modal-sm" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <!-- Load modal content by AJAX -->
            </div>
        </div>

        <!-- Util standard modal -->
        <div id="util-modal-st" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Load modal content by AJAX -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('vendor/gentelella/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/jquery/dist/jquery.min.map') }}" type="application/json"></script>
    <script src="{{ mix('vendor/jquery-form/jquery.form.min.js') }}"></script>
    <script src="{{ mix('vendor/jquery-form/jquery.form.min.js.map') }}" type="application/json"></script>
    <script src="{{ mix('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ mix('vendor/jquery-validation/localization/messages_es.js') }}"></script>
    <script src="{{ mix('vendor/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ mix('vendor/jquery-number/jquery.number.min.js') }}"></script>

    <script src="{{ mix('vendor/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/moment/min/moment-with-locales.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ mix('vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="{{ mix('vendor/gentelella/vendors/jquery-mousewheel/jquery.mousewheel.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/nprogress/nprogress.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ mix('vendor/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ mix('vendor/select2/dist/js/i18n/es.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>

    <script src="{{ mix('vendor/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ mix('vendor/datatables.net-rowgroup/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ mix('vendor/datatables-rowsgroup-2.0.0/dataTables.rowsGroup.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ mix('vendor/datatables.net-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ mix('vendor/datatables.net-buttons/buttons.html5.js') }}"></script>

    <script src="{{ mix('vendor/timepicker/jquery.timepicker.min.js') }}"></script>

    <script src="{{ mix('vendor/gentelella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ mix('vendor/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ mix('vendor/fullcalendar/dist/locale/es.js') }}"></script>
    <script src="{{ mix('vendor/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/jquery.easy-pie-chart/dist/jquery.easypiechart.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/gauge.js/dist/gauge.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/echarts/dist/echarts.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/dropzone/dist/min/dropzone.min.js') }}"></script>

    <script src="{{ mix('vendor/jsoneditor/jsoneditor.min.js') }}"></script>
    <script src="{{ mix('vendor/jsoneditor/jsoneditor.js.map') }}" type="application/json"></script>

    <script src="{{ mix('vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>

    <script src="{{ mix('vendor/knockout/knockout-latest.js') }}"></script>
    <script src="{{ mix('vendor/knockout.validation/knockout.validation.js') }}"></script>

    <!-- PDF export -->
    <script src="{{ mix('vendor/jspdf/jspdf.min.js') }}"></script>
    <script src="{{ mix('vendor/jspdf-autotable/jspdf.plugin.autotable.min.js') }}"></script>

    <script src="{{ mix('vendor/bootbox/bootbox.js') }}"></script>

    <!-- SlickGrid -->
    <script src="{{ mix('vendor/slickgrid/lib/jquery.event.drag-2.3.0.js') }}"></script>
    <script src="{{ mix('vendor/slickgrid/slick.core.js') }}"></script>
    <script src="{{ mix('vendor/slickgrid/slick.grid.js') }}"></script>
    <script src="{{ mix('vendor/slickgrid/slick.formatters.js') }}"></script>
    <script src="{{ mix('vendor/slickgrid/slick.editors.js') }}"></script>
    <script src="{{ mix('vendor/slickgrid/slick.dataview.js') }}"></script>

    <!-- jsgantt improved -->
    <script src="{{ mix('vendor/jsgantt-improved/dist/jsgantt.js') }}"></script>

    <!-- Quill Editor -->
    <script src="{{ mix('vendor/quill/quill.js') }}"></script>

    <!-- amcharts -->
    <script src="//www.amcharts.com/lib/4/core.js"></script>
    <script src="//www.amcharts.com/lib/4/charts.js"></script>
    <script src="//www.amcharts.com/lib/4/themes/animated.js"></script>

    <script src="{{ mix('js/main.js') }}"></script>


@endsection
