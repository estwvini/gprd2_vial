@permission('create.institution.module_configuration_catalogs')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('institution.title') }}
                <small>{{ trans('app.labels.catalogs') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.institution.module_configuration_catalogs')
                <li>
                    <a class="ajaxify" href="{{ route('index.institution.module_configuration_catalogs') }}"> {{ trans('institution.title') }}</a>
                </li>
                @endpermission

                <li class="active"> {{ trans('app.labels.new') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-university"></i> {{ trans('institution.labels.new') }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.institution.module_configuration_catalogs') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-university"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form role="form" action="{{ route('store.create.institution.module_configuration_catalogs') }}" method="post"
                          class="form-horizontal form-label-left" id="institution_create_fm">

                        @csrf

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">
                                {{ trans('institution.labels.code') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="code" id="code" data-inputmask="'mask': '999-9999'" class="form-control col-md-7 col-sm-7 col-xs-12"/>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-2 pl-0">
                                <i role="button" data-toggle="tooltip" data-placement="right"
                                   data-original-title="{{ trans('institution.messages.info.code') }}"
                                   class="fa fa-info-circle fa-tooltip blue"></i>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                {{ trans('institution.labels.name') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name" maxlength="256" class="form-control col-md-7 col-sm-7 col-xs-12"/>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.institution.module_configuration_catalogs') }}" class="btn btn-info ajaxify">
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

        $("#code").inputmask();

        $("#code").focusout(() => {

            let aux = $("#code").val();
            aux = aux.replace(/_/g, '0');
            $("#code").val(aux);
        });

        let $form = $('#institution_create_fm');

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
                        model: '\\App\\Models\\Business\\Catalogs\\Institution'
                    }
                }
            },
            code: {
                required: true,
                maxlength: 8,
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'code',
                        fieldValue: () => {
                            return $('#code').val();
                        },
                        model: '\\App\\Models\\Business\\Catalogs\\Institution',

                    }
                }
            }

        };

        $validateDefaults.messages = {
            name: {
                remote: '{!! trans('institution.messages.validation.name_exists') !!}'
            },
            code: {
                remote: '{!! trans('institution.messages.validation.code_exists') !!}'
            }
        };

        $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);
    });
</script>

@else
    @include('errors.403')
    @endpermission