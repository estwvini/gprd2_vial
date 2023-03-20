@extends('layout.base')

@section('styles')
    <link href="{{ mix('vendor/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css.map') }}"
          rel="stylesheet"/>

    <link href="{{ mix('vendor/gentelella/css/custom.min.css') }}" rel="stylesheet"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet"/>

    <!-- Custom -->
    <link href="{{ mix('css/modules_index.css') }}" rel="stylesheet"/>

    <!-- Spinner -->
    <link href="{{ mix('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/font-awesome/css/font-awesome.css.map') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/nprogress/nprogress.css') }}" rel="stylesheet"/>

    <!-- Notifications -->
    <link href="{{ mix('vendor/gentelella/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet"/>

@endsection

@section('body')
    <div id="wrapper" class="d-flex justify-content-center modules-main">
        <div class="row align-center modules-background">

            <div class="d-flex align-items-center justify-content-between">
                <span></span>
                <h3>{{ trans('app.labels.modules') }}</h3>
                <div class="text-right">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="modules-logout">{{ trans('app.labels.logout') }}</button>
                    </form>
                </div>
            </div>

            <table class="table mt-3">
                <tr>
                    @foreach($modules as $module)
                        <td class="d-inline-grid ml-3 mr-3">
                            <a href="{{ route('index.app', ['module' => $module]) }}">
                                <img src="{{ mix($module->image) }}" class="clickable-image"/>
                            </a>
                            <h3 class="pt-3">{{ $module->name }}</h3>
                        </td>
                    @endforeach
                </tr>
            </table>

            <div class="separator col-md-10 col-sm-10 col-xs-10 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
                <p><strong>&copy; @actualyear {{ $labels['footer'] }}</strong></p>
            </div>

            <!-- Util large modal -->
            <div id="util-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg @if(!session('changedPassword')) no-passwd @endif">
                    <!-- Load modal content by AJAX -->
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

        </div>
    </div>
@endsection

@section('scripts')

    <script src="{{ mix('vendor/gentelella/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/jquery/dist/jquery.min.map') }}" type="application/json"></script>
    <script src="{{ mix('vendor/jquery-form/jquery.form.min.js') }}"></script>
    <script src="{{ mix('vendor/jquery-form/jquery.form.min.js.map') }}" type="application/json"></script>
    <script src="{{ mix('vendor/jquery-validation/jquery.validate.min.js') }}"></script>

    <script src="{{ mix('vendor/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/nprogress/nprogress.js') }}"></script>

    <script src="{{ mix('vendor/gentelella/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>

    <script src="{{ mix('js/main.js') }}"></script>

    <script>
        $(() => {
            @if(session('changedPassword'))
            hideLoading();
            @endif
        });
    </script>

@endsection
