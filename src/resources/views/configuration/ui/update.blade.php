@role('developer')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('configuration.ui.title') }}
                <small>{{ trans('configuration.title') }}</small>
            </h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-pencil"></i> {{ trans('configuration.ui.labels.edit') }}
                    </h2>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <form role="form" action="{{ route('update.edit.ui.configuration') }}" method="post"
                          class="form-horizontal form-label-left" id="config_ui_update_fm" novalidate>

                        @method('PUT')
                        @csrf

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="system_name">
                                {{ trans('configuration.ui.labels.system_name') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="system_name" id="system_name" required maxlength="50"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       value="{{ $labels['system_name'] }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="system_slogan">
                                {{ trans('configuration.ui.labels.system_slogan') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="system_slogan" id="system_slogan" required
                                          class="form-control col-md-7 col-sm-7 col-xs-12 vertical">{{ $labels['system_slogan'] }}</textarea>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="footer">
                                {{ trans('configuration.ui.labels.footer') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="footer" id="footer" required
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       value="{{ $labels['footer'] }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="color">
                                {{ trans('configuration.ui.labels.menu_color') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="picker_color" class="input-group colorpicker-component">
                                    <input type="text" name="color" id="color" required
                                           class="form-control col-md-7 col-xs-12"
                                           value="{{ $menuStyles['color'] }}" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="active_color">
                                {{ trans('configuration.ui.labels.menu_active_color') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="picker_active_color" class="input-group colorpicker-component">
                                    <input type="text" name="active_color" id="active_color" required
                                           class="form-control col-md-7 col-xs-12"
                                           value="{{ $menuStyles['active_color'] }}" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text_color">
                                {{ trans('configuration.ui.labels.text_color') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="picker_text_color" class="input-group colorpicker-component">
                                    <input type="text" name="text_color" id="text_color" required
                                           class="form-control col-md-7 col-xs-12"
                                           value="{{ $menuStyles['text_color'] }}" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="login_logo">
                                {{ trans('configuration.ui.labels.login_logo') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="login_logo" id="login_logo"
                                       class="form-control col-md-7 col-xs-12"
                                       accept="image/png, image/jpeg, image/jpg"
                                       onchange=" readLoginURL(this)"/>
                            </div>
                        </div>
                        <div class="item form-group text-center">
                            <img id="login_logo_preview" src="{{ $logos['login_logo'] }}" height="120" width="120">
                            <script>
                                function readLoginURL(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            var img = new Image;
                                            img.src = reader.result;

                                            if ($('#login_logo').val() !== null){
                                                $('#login_logo_preview')
                                                    .attr('src', e.target.result)
                                                    .width(128)
                                                    .height(128).show();

                                            }
                                        };

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }
                            </script>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menu_logo">
                                {{ trans('configuration.ui.labels.menu_logo') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="menu_logo" id="menu_logo"
                                       class="form-control col-md-7 col-xs-12"
                                       accept="image/png, image/jpeg, image/jpg"
                                       onchange=" readMenuURL(this)"/>
                            </div>
                        </div>
                        <div class="item form-group text-center">
                            <img id="menu_logo_preview" src="{{ $logos['menu_logo'] }}" height="120" width="120">
                            <script>
                                function readMenuURL(input) {

                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            var img = new Image;
                                            img.src = reader.result;

                                            if ($('#menu_logo').val() !== null){
                                                $('#menu_logo_preview')
                                                    .attr('src', e.target.result)
                                                    .width(128)
                                                    .height(128).show();

                                            }
                                        };

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }
                            </script>
                        </div>



                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        var $form = $('#config_ui_update_fm');

        $('#picker_color').colorpicker({
            color: '{{ $menuStyles['color'] }}',
            format: 'hex'
        });

        $('#picker_active_color').colorpicker({
            color: '{{ $menuStyles['active_color'] }}',
            format: 'hex'
        });

        $('#picker_text_color').colorpicker({
            color: '{{ $menuStyles['text_color'] }}',
            format: 'hex'
        });

        $form.validate($validateDefaults);

        var $ajaxDefaults = {
            dataType: 'json',

            beforeSubmit: function (formData, jqForm) {

                if (jqForm.valid()) {

                    showLoading();
                    return true;
                }

                return false;
            },

            success: function (response) {
                processResponse(response, '#main_content', function () {
                    $validateDefaults.rules = {};
                    $validateDefaults.messages = {};
                });
            },

            error: function (param1, param2, param3) {
                notify('Ha ocurrido un error al intentar realizar la transacci&#243;n', 'error', 'Error!');
                $validateDefaults.rules = {};
                $validateDefaults.messages = {};
                console.log(param3);
            },

            complete: function () {
                hideLoading();
                window.location.reload();
            }
        };

        $form.ajaxForm($ajaxDefaults);
    });
</script>

@else
    @include('errors.403')
@endrole