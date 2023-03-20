@role('developer')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('configuration.menu.title') }}
                <small>{{ trans('configuration.title') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                <li><a href="{{ route('index.menus.configuration') }}" class="ajaxify"> {{ trans('configuration.menu.title') }}</a></li>
                <li class="active"> {{ trans('app.labels.details') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-menu"></i> {{ trans('configuration.menu.labels.details') }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.menus.configuration') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>

                        <li class="pull-right">
                            <a href="{{ route('destroy.menus.configuration', ['id' => $entity->id]) }}" id="config_menus_delete_btn">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                        </li>

                        <li class="pull-right">
                            <a href="{{ route('edit.menus.configuration', ['id' => $entity->id ]) }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <dl class="dl-horizontal">

                        <dt>{{ trans('configuration.menu.headers.label') }}</dt>
                        <dd>{{ $entity->label or '-' }}</dd>

                        @if ($entity->parent)
                        <dt>{{ trans('configuration.menu.headers.parent') }}</dt>
                        <dd>{{ $entity->parent->label }}</dd>
                        @endif

                        <dt>{{ trans('configuration.menu.headers.slug') }}</dt>
                        <dd>{{ $entity->slug or '-' }}</dd>

                        <dt>{{ trans('configuration.menu.headers.icon') }}</dt>
                        <dd>{{ $entity->icon or '-' }}</dd>

                        <dt>{{ trans('configuration.menu.headers.weight') }}</dt>
                        <dd>{{ $entity->weight or '-' }}</dd>

                        <dt>{{ trans('app.headers.enabled') }}</dt>
                        <dd>
                            <input type='checkbox' class='js-switch' id="config_menus_enabled_switch" @if ($entity->enabled) checked @endif />
                        </dd>

                    </dl>

                    <div class="ln_solid"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <a href="{{ route('index.menus.configuration') }}" class="btn btn-info ajaxify">
                            <i class="fa fa-times"></i> {{ trans('app.labels.exit') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

        $('#config_menus_delete_btn').on('click', function (e) {
            e.preventDefault();

            if (confirm('{{ html_entity_decode(trans('configuration.menu.messages.confirm.delete')) }}')) {
                pushRequest(
                    '{!! route('destroy.menus.configuration', ['id' => $entity->id]) !!}',
                    null,
                    null,
                    'delete',
                    {
                        _token: '{{ csrf_token() }}'
                    }
                );
            }
        });

        $('#config_menus_enabled_switch').on('change', function (e) {
            e.preventDefault();
            pushRequest(
                '{!! route('status.menus.configuration', ['id' => $entity->id]) !!}',
                null,
                null,
                'put',
                {
                    _token: '{{ csrf_token() }}'
                }
            );
        });

    });
</script>

@else
    @include('errors.403')
@endrole