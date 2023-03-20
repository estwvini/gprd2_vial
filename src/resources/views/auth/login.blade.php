@extends('auth.layout')

@section('form')
    <form id="login_fm" role="form" action="{{ route('login') }}" method="post" class="form-horizontal">

        <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-3">
            <img src="{{ mix($logos['login_logo']) }}" class="img-responsive"
                 style="width: 100%"/>
        </div>

        @csrf

        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">

            <br>

            @if($timeout = session('session_time_out'))
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ $timeout }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="item form-group" style="margin-bottom: 20px">
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                    <input type="text" class="form-control" style="width: 85%; margin: auto; border-radius: 20px"
                           name="username" id="username"
                           value="{{ old('username') }}" placeholder="{!! trans('users.user.placeholders.username') !!}">
                </div>

            </div>

            <div class="item form-group" style="margin-bottom: 20px">
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                    <input type="password" class="form-control" name="password" id="password"
                           placeholder="{!! trans('users.user.placeholders.password') !!}"
                           style="width: 85%; margin: auto; border-radius: 20px">
                </div>
            </div>

            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <button class="btn btn-primary submit" style="margin-bottom: 20px; width: 85%; border-radius: 20px">
                    {{ trans('app.labels.login') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ trans('auth.forgot_password') }}
                    </a>
                @endif
                <div class="clearfix"></div>

                <div class="separator" style="width: 85%; margin: auto;">
                    <div class="clearfix"></div>
                    <br/>
                    <p>
                        <strong>&copy; @actualyear {{ $labels['footer'] }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('page_scripts')

    <script>
        $(function () {

            $("#username").focus();

            var stack_center = {
                "dir1": "down",
                "dir2": "right",

            };

            @if ($errors->has('username'))
            new PNotify({
                title: 'Error accediendo al sistema',
                type: 'error',
                text: '{{ $errors->first('username') }}',
                styling: 'bootstrap3',
                stack: stack_center,
                delay: 4000
            });

            @endif

            $('#login_fm').validate({
                ignore: [],
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    $('button[type="submit"]').prop('disabled', true);
                    form.submit();
                }
            });

            $('html').css('background-color', '#eee');
        });
    </script>
@endsection
