@extends('auth.layout')

@section('form')

    <form id="login_fm" role="form" action="{{ route('password.email') }}" method="post" class="form-horizontal">

        <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-3">
            <img src="{{ mix($logos['login_logo']) }}" class="img-responsive"
                 style="width: 100%"/>
        </div>

        @csrf

        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">

            <br>

            <div class="item form-group" style="margin-bottom: 20px">
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                    <input type="text" class="form-control" style="width: 85%; margin: auto; border-radius: 20px"
                           name="email" id="emal"
                           value="{{ old('email') }}" placeholder="{!! trans('users.user.placeholders.email') !!}">
                </div>

            </div>

            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <button class="btn btn-primary submit" style="margin-bottom: 20px; width: 85%; border-radius: 20px">
                    {{ trans('app.labels.Send_PasswordReset_Link') }}
                </button>
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

            $("#email").focus();

            $('#login_fm').validate({
                ignore: [],
                rules: {
                    email: {
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
