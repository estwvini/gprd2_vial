@role('developer')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('configuration.setting.title') }}
                <small>{{ trans('configuration.title') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                <li>
                    <a href="{{ route('index.settings.configuration') }}" class="ajaxify"> {{ trans('configuration.setting.title') }}</a>
                </li>

                <li class="active"> {{ trans('app.labels.edit') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-bars"></i> {{ trans('configuration.setting.labels.edit') }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.settings.configuration') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <form role="form" method="post" class="form-horizontal form-label-left" id="config_settings_update_fm" novalidate>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="key">
                                {{ trans('configuration.setting.labels.key') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="key" id="key" required
                                       class="form-control col-md-7 col-xs-12"
                                       value="{{ $entity->key }}" />
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                {{ trans('app.headers.description') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description"
                                          class="form-control col-md-7 col-sm-7 col-xs-12 vertical">{{ $entity->description }}</textarea>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                {{ trans('configuration.setting.labels.value') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="jsoneditor" style="border: 1px #C5C5C5 solid;"></div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.settings.configuration') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
                            <button type="submit" id="btnSubmit" class="btn btn-success">
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
        var $form = $('#config_settings_update_fm');

        var editor = new JSONEditor(document.getElementById('jsoneditor'), {
            history: true,
            mode: 'view',
            modes: ['view','form','tree','code'],
            schema: {
                type: 'object',
                properties: {
                    'allowed': {
                        type: 'boolean'
                    },
                    'label': {
                        type: 'string'
                    },
                    'inner': {
                        type: 'object'
                    }
                }
            }
        });

        editor.set({!! json_encode($entity->value) !!});

        $form.validate($validateDefaults);

        $('#btnSubmit').on('click', function (e) {
            e.preventDefault();

            pushRequest('{!! route('update.edit.settings.configuration', ['id' => $entity->id]) !!}', null, null, 'put', {
                _token: '{{ csrf_token() }}',
                key: $('#key').val(),
                description: $('#description').val(),
                value: JSON.stringify(editor.get())
            });
        });

    });
</script>

@else
    @include('errors.403')
@endrole