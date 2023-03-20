<div class="modal-content">
    <div class="modal-header">
        @if(session('changedPassword'))
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
            </button>
        @endif
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-key"></i> {{ trans('users.user.title_change_password') }}</h4>
    </div>

    <form id="change_password_fm" class="form-horizontal" role="form" method="POST"
          action="{{ route('update.password.profile') }}" autocomplete="off" novalidate>

        @csrf
        <input type="hidden" name="changed_password" value="on">

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="password">
                            {{ trans('users.user.labels.password') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="password" name="password" id="password" required
                                   class="form-control col-md-7 col-xs-12"
                                   placeholder="{{ trans('users.user.placeholders.password') }}"/>

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

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="password_confirm">
                            {{ trans('users.user.labels.password_confirm') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="password" name="password_confirm" id="password_confirm" required
                                   class="form-control col-md-7 col-xs-12"
                                   placeholder="{{ trans('users.user.placeholders.password_confirm') }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            @if(session('changedPassword'))
                <button type="button" class="btn btn-info ajaxify" data-dismiss="modal"> {{ trans('app.labels.cancel') }}</button>
            @endif
            <button type="submit" class="btn btn-success"> {{ trans('app.labels.accept') }}</button>
        </div>
    </form>
</div>

<script>
    $(function () {
        var $form = $('#change_password_fm');

        $validateDefaults.rules = {
            password: {
                required: true,
                maxlength: 20,
                minlength: 6,
                wordLowercase: true,
                wordUppercase: true,
                wordOneNumber: true,
                wordOneSpecialChar: true
            },
            password_confirm: {
                required: true,
                equalTo: "#password"
            }
        };

        $validateDefaults.messages = {
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
        };

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

        $form.ajaxForm({
            beforeSubmit: function () {
                showLoading();
            },
            success: function (response) {
                processResponse(response, null, function () {
                    $('.no-passwd', $modal).removeClass('no-passwd');
                    $modal.removeAttr('data-backdrop');
                    $modal.removeAttr('data-keyboard');
                    $modal.modal('hide');
                });
            },
            error: function (param1, param2, param3) {
                notify(param3, 'error', 'Error!');
            },
            complete: function () {
                hideLoading();
            }
        });
    })
    ;
</script>

