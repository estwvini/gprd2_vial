<div class="row" id="model">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ trans('components.labels.create') }}</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form role="form" method="post"
                      action="{{ $urlStoreComponent }}"
                      class="form-horizontal form-label-left" id="component_create_fm" novalidate>

                    @csrf

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                            {{ trans('app.headers.name') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name" id="name"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="assumptions">
                            {{ trans('components.labels.assumptions') }}
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="assumptions" id="assumptions"
                                      class="form-control col-md-7 col-sm-7 col-xs-12"></textarea>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <button class="btn btn-info" id="cancel_component">
                            <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        let $form = $('#component_create_fm');

        $form.validate($.extend(false, $validateDefaults, {
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                    maxlength: 500
                }
            }
        }));
        $form.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, '#components_list', () => {
                    $validateDefaults.rules = {};
                    $validateDefaults.messages = {};
                    $('#edit_area').empty();
                });
            }
        }));

        $('#cancel_component').on('click', () => {
            $('#edit_area').empty();
        });
    });
</script>