@permission('edit.cpc.module_configuration_catalogs')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('cpc.title') }}
                <small>{{ trans('app.labels.catalogs') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.cpc.module_configuration_catalogs')
                <li>
                    <a class="ajaxify" href="{{ route('index.cpc.module_configuration_catalogs') }}"> {{ trans('cpc.title') }}</a>
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
                    <h2><i class="fa fa-shopping-cart"></i> {{ trans('cpc.labels.update') }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.cpc.module_configuration_catalogs') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form role="form" action="{{ route('update.edit.cpc.module_configuration_catalogs', ['id' => $entity->id]) }}" method="post"
                          class="form-horizontal form-label-left" id="cpc_edit_fm" novalidate>

                        @method('PUT')
                        @csrf

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">
                                {{ trans('cpc.labels.code') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="code" id="code" maxlength="15" @if(count($entity->purchases)) disabled @endif
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                       value="{{ $entity->code }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                {{ trans('app.headers.description') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description" maxlength="300" rows="4"
                                          class="form-control vertical text-capitalize"
                                          onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);">{{ $entity->description }}</textarea>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.cpc.module_configuration_catalogs') }}" class="btn btn-info ajaxify">
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

        let $form = $('#cpc_edit_fm');

        $validateDefaults.rules = {
            code: {
                required: true,
                onlyIntegers: true,
                maxlength: 15,
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'code',
                        fieldValue: () => {
                            return $('#code').val();
                        },
                        model: 'App\\Models\\Business\\Catalogs\\CPC',
                        current: '{{ $entity->id }}'
                    }
                }
            },
            description: {
                required: true,
                maxlength: 300,
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'description',
                        fieldValue: () => {
                            return $('#description').val();
                        },
                        model: 'App\\Models\\Business\\Catalogs\\CPC',
                        current: '{{ $entity->id }}'
                    }
                }
            }
        };

        $validateDefaults.messages = {
            code: {
                remote: '{!! trans('cpc.messages.validation.code_exists') !!}'
            }
        };

        $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);
    });
</script>

@else
    @include('errors.403')
    @endpermission