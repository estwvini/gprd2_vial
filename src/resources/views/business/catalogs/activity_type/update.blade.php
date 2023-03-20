@permission('edit.activity_type.module_configuration_catalogs')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('activity_type.title') }}
                <small>{{ trans('app.labels.catalogs') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.activity_type.module_configuration_catalogs')
                <li>
                    <a class="ajaxify" href="{{ route('index.activity_type.module_configuration_catalogs') }}"> {{ trans('activity_type.title') }}</a>
                </li>
                @endpermission

                <li class="active"> {{ trans('app.labels.update') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-tasks"></i> {{ trans('activity_type.labels.update') }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.activity_type.module_configuration_catalogs') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-university"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form role="form" action="{{ route('update.edit.activity_type.module_configuration_catalogs', ['id' => $entity->id]) }}" method="post"
                          class="form-horizontal form-label-left" id="activity_type_edit_fm">

                        @method('PUT')
                        @csrf

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                {{ trans('activity_type.labels.name') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name" maxlength="256" class="form-control col-md-7 col-sm-7 col-xs-12"
                                       value="{{ $entity->name }}"/>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.activity_type.module_configuration_catalogs') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
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
    $(() => {

        let $form = $('#activity_type_edit_fm');

        $validateDefaults.rules = {
            name: {
                required: true,
                maxlength: 256,
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'name',
                        fieldValue: () => {
                            return $('#name').val();
                        },
                        model: '\\App\\Models\\Business\\Catalogs\\ActivityType',
                        current: '{{ $entity->id }}'
                    }
                }
            }
        };

        $validateDefaults.messages = {
            name: {
                remote: '{!! trans('activity_type.messages.validation.name_exists') !!}'
            }
        };

        $form.validate($.extend(false, $validateDefaults));
        $form.ajaxForm($.extend(false, $formAjaxDefaults));
    });
</script>

@else
    @include('errors.403')
    @endpermission