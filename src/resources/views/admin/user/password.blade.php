@permission('password.users')

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-key"></i> {{ trans('users.user.title_change_password') }}</h4>
    </div>

    <form id="change_password_fm" class="form-horizontal" role="form" method="POST"
          action="{{ route('update.password.users') }}" autocomplete="off" novalidate>

        @csrf
        @method('PUT')
        <input type="hidden" name="changed_password" value="on">
        <input type="hidden" name="user_id" value="{{ $entity->id }}">

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="password">
                            {{ trans('users.user.labels.password') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="password" name="password" id="password"
                                   class="form-control col-md-7 col-xs-12"
                                   placeholder="{{ trans('users.user.placeholders.password') }}"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="password_confirm">
                            {{ trans('users.user.labels.password_confirm') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="password" name="password_confirm" id="password_confirm"
                                   class="form-control col-md-7 col-xs-12"
                                   placeholder="{{ trans('users.user.placeholders.password_confirm') }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-info ajaxify" data-dismiss="modal"> {{ trans('app.labels.cancel') }}</button>
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
                minlength: 6
            },
            password_confirm: {
                required: true,
                maxlength: 20,
                equalTo: "#password"
            }
        };

        $validateDefaults.messages = {
            password_confirm : {
                equalTo : '{!! trans('users.user.messages.validation.password_check') !!}'
            }
        };

        $form.validate($validateDefaults);

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
    });
</script>

@else
    @include('errors.403')
    @endpermission