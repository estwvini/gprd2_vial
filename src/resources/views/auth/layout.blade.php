@extends('layout.base')

@section('styles')
    <link href="{{ mix('vendor/font-awesome/css/font-awesome.min.css') }}"
          rel="stylesheet"/>
    <link href="{{ mix('vendor/font-awesome/css/font-awesome.css.map') }}"
          rel="stylesheet"/>

    <link href="{{ mix('vendor/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ mix('vendor/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css.map') }}"
          rel="stylesheet"/>

    <link href="{{ mix('vendor/gentelella/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet"/>

    <link href="{{ mix('vendor/gentelella/css/custom.min.css') }}" rel="stylesheet"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet"/>

    <link href="{{ mix('css/theme.css') }}" rel="stylesheet"/>

    <!-- Custom -->
    <link href="{{ mix('css/login.css') }}" rel="stylesheet"/>

@endsection

@push('body_classes') login-page @endpush

@section('body')
    <div>
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper" class="login_wrapper form d-flex justify-content-center align-items-center mt-0" style="max-width: none; background-color: #eee">
            <div id="login" style="background-color: white;">
                <section class="login_content">

                    @yield('form')

                </section>
                <div class="row">
                    <div class="col-md-2 col-sm-3 col-xs-12 col-md-offset-4 col-sm-offset-3 mt-3">
                        <img src="{{ mix('images/congope_1.png') }}" class="img-responsive"
                             style="width: 100%"/>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-12">
                        <img src="{{ mix('images/logo_bid.png') }}" class="img-responsive"
                             style="width: 100%"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('vendor/gentelella/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ mix('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ mix('vendor/jquery-validation/localization/messages_es.js') }}"></script>
    <script src="{{ mix('vendor/gentelella/vendors/pnotify/dist/pnotify.js') }}"></script>

    @yield('page_scripts')
@endsection
