@extends('auth.layout')


@section('form')

    <form id="reset_password_fm" role="form" action="{{ route('password.update') }}" method="post" class="form-horizontal">

        <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-3">
            <img src="{{ mix($logos['login_logo']) }}" class="img-responsive"
                 style="width: 100%"/>
        </div>

        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            @endif

            <br>
            <h4>Ingrese su nueva contraseña</h4>
            <div class="item form-group" style="margin-bottom: 20px">
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                    <input type="password" class="form-control" name="password" id="password"
                           placeholder="{!! trans('users.user.placeholders.password') !!}"
                           style="width: 85%; margin: auto; border-radius: 20px">
                    <div>
                        <i id="minlength" class="fa fa-times text-danger" aria-hidden="true">{{ trans('users.user.labels.minlength') }}</i>
                    </div>
                    <div>
                        <i id="maxlength" class="fa fa-times text-danger" aria-hidden="true">{{ trans('users.user.labels.maxlength') }}</i>
                    </div>
                    <div>
                        <i id="wordLowercase" class="fa fa-times text-danger" aria-hidden="true">{{ trans('users.user.labels.wordLowercase') }}</i>
                    </div>
                    <div>
                        <i id="wordUppercase" class="fa fa-times text-danger" aria-hidden="true">{{ trans('users.user.labels.wordUppercase') }}</i>
                    </div>
                    <div>
                        <i id="wordOneNumber" class="fa fa-times text-danger" aria-hidden="true">{{ trans('users.user.labels.wordOneNumber') }}</i>
                    </div>
                    <div>
                        <i id="wordOneSpecialChar" class="fa fa-times text-danger" aria-hidden="true">{{ trans('users.user.labels.wordOneSpecialChar') }}</i>
                    </div>
                </div>
            </div>

            <div class="item form-group" style="margin-bottom: 20px">
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                    <input type="password" class="form-control" name="password_confirmation" id="password-confirm"
                           placeholder="{!! trans('users.user.placeholders.password_confirm') !!}"
                           style="width: 85%; margin: auto; border-radius: 20px">
                </div>
            </div>

            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <button class="btn btn-primary submit" style="margin-bottom: 20px; width: 85%; border-radius: 20px">
                    {{ trans('app.labels.accept') }}
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

            $("#password").focus();
            var $form = $('#reset_password_fm');

            var $validateDefaults = {
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
                },
                rules: {
                    password: {
                        required: true,
                        maxlength: 20,
                        minlength: 6,
                        wordLowercase: true,
                        wordUppercase: true,
                        wordOneNumber: true,
                        wordOneSpecialChar: true
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        maxlength: '',
                        minlength: '',
                        wordLowercase: '',
                        wordUppercase: '',
                        wordOneNumber: '',
                        wordOneSpecialChar: ''
                    },
                    password_confirm: {
                        equalTo: '{!! trans('users.user.messages.validation.password_check') !!}'
                    }
                }
            };

            $.validator.addMethod("wordLowercase", function (value) {
                if (value !== '') {
                    const input = /[a-z]/;
                    return input.test(value);
                } else
                    return true;
            }, 'Por favor, ingresa al menos una letra minúscula');

            $.validator.addMethod("wordUppercase", function (value) {
                if (value !== '') {
                    const input = /[A-Z]/;
                    return input.test(value);
                } else
                    return true;
            }, 'Por favor, ingresa al menos una letra Mayúscula');

            $.validator.addMethod("wordOneNumber", function (value) {
                if (value !== '') {
                    const input = /\d+/;
                    return input.test(value);
                } else
                    return true;
            }, 'Por favor, ingresa al menos un número');

            $.validator.addMethod("wordOneSpecialChar", function (value) {
                if (value !== '') {
                    var special = '[!,@,#,$,%,^,&,*,?,_,~]';
                    var specialCharRE = new RegExp(special);
                    return specialCharRE.test(value);
                } else
                    return true;
            }, 'Por favor, ingresa al menos un caracter especial');

            $.validator.prototype.ruleValidationStatus = function (element) {
                element = $(element)[0];
                let rules = $(element).rules();
                let errors = {};
                for (let method in rules) {
                    let rule = {method: method, parameters: rules[method]};
                    try {
                        var result = $.validator.methods[method].call(this, element.value.replace(/\r/g, ""), element, rule.parameters);

                        errors[rule.method] = result;

                    } catch (e) {
                        console.log(e);
                    }
                }
                return errors;
            };

            let validator = $form.validate($validateDefaults);
            $('#password').on('keyup', () => {
                validator.element($("#password", $form));
                let rules = validator.ruleValidationStatus("#password");
                if ($('#password').val()) {
                    for (let rule in rules) {
                        $("#" + rule).removeClass(rules[rule] ? "fa-times text-danger" : "fa-check text-success");
                        $("#" + rule).addClass(rules[rule] ? "fa-check text-success" : "fa-times text-danger");
                    }
                } else {
                    for (let rule in rules) {
                        $("#" + rule).removeClass("fa-check text-success");
                        $("#" + rule).addClass("fa-times text-danger");
                    }
                }
            });

            $('html').css('background-color', '#eee');
        });
    </script>
@endsection
