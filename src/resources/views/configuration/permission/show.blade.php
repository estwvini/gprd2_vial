@role('developer')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('configuration.permission.title') }}
                <small>{{ trans('configuration.title') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                <li><a href="{{ route('index.permissions.configuration') }}" class="ajaxify"> {{ trans('configuration.permission.title') }}</a></li>
                <li class="active"> {{ trans('app.labels.details') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-lock"></i> {{ trans('configuration.permission.labels.details') }}: {{ $entity->label }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.permissions.configuration') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                        <li class="pull-right">
                            <a href="javascript:" id="config_permissions_delete_btn" class="btn btn-box-tool">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                        </li>
                        <li class="pull-right">
                            <a href="{{ route('edit.permissions.configuration', ['id' => $entity->id]) }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-edit"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="config_permissions_tabs" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#tab_content1" role="tab" id="details_tab" data-toggle="tab" aria-expanded="true">
                                    <i class="fa fa-info-circle"></i> {{ trans('app.labels.details') }}
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#tab_content2" role="tab" id="actions_tab" data-toggle="tab" aria-expanded="true">
                                    <i class="fa fa-unlock-alt"></i> {{ trans('app.labels.actions') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div id="config_permissions_tabs_content" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="details_tab">
                            <dl class="dl-horizontal">
                                <dt>{{ trans('app.headers.name') }}</dt>
                                <dd>{{ $entity->name }}</dd>

                                <dt>{{ trans('configuration.permission.headers.label') }}</dt>
                                <dd>{{ $entity->label }}</dd>

                                <dt>{{ trans('app.headers.description') }}</dt>
                                <dd>{{ $entity->description }}</dd>
                            </dl>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="actions_tab">
                            <div id="jsoneditor"></div>

                            <div class="ln_solid"></div>
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <button id="config_permissions_save_btn" class="btn btn-success">
                                    <i class="fa fa-check"></i> {{ trans('app.labels.update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
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

        editor.set({!! json_encode($entity->slug) !!});

        $('#config_permissions_save_btn').on('click', function (e) {
            e.preventDefault();

            pushRequest('{!! route('update.edit.permissions.configuration', ['id' => $entity->id]) !!}', null, null, 'put', {
                _token: '{{ csrf_token() }}',
                slug: JSON.stringify(editor.get())
            });
        });

        $('#config_permissions_delete_btn').on('click', function (e) {
            e.preventDefault();

            if (confirm('{{ html_entity_decode(trans('configuration.permission.messages.confirm.delete')) }}')) {
                pushRequest('{!! route('destroy.permissions.configuration', ['id' => $entity->id]) !!}', null, null, 'delete', {
                    _token: '{{ csrf_token() }}'
                });
            }
        });

    });
</script>

@else
    @include('errors.403')
@endrole