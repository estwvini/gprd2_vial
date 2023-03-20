@role('developer')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('configuration.permission.title') }}
                <small>{{ trans('app.labels.administration') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                <li><a href="{{ route('index.permissions.configuration') }}" class="ajaxify"> {{ trans('configuration.permission.title') }}</a></li>
                <li class="active"> {{ trans('app.labels.update') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-lock"></i> {{ trans('configuration.permission.labels.update') }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.permissions.configuration') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                        <li class="pull-right">
                            <a href="{{ route('show.permissions.configuration', ['id' => $entity->id]) }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-search-plus"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <strong>{{ trans('app.labels.attention') }}</strong>
                                {{ trans('configuration.permission.messages.warning.update') }}
                            </div>
                        </div>
                    </div>

                    <form role="form" action="{{ route('update.edit.permissions.configuration', ['id' => $entity->id]) }}" method="post"
                          class="form-horizontal form-label-left" id="config_permissions_update_fm" novalidate>

                        <input type="hidden" name="_method" value="put" />
                        @csrf

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                {{ trans('app.headers.name') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name" required
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       value="{{ $entity->name }}"
                                       placeholder="{{ trans('configuration.permission.labels.name') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label">
                                {{ trans('configuration.permission.headers.label') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="label" id="label" required
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       value="{{ $entity->label }}"
                                       placeholder="{{ trans('configuration.permission.labels.label') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                {{ trans('app.headers.description') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description"
                                          class="form-control col-md-7 col-sm-7 col-xs-12 vertical"
                                          placeholder="{{ trans('configuration.permission.labels.description') }}">{{ $entity->description }}</textarea>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.permissions.configuration') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('app.labels.update') }}
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
        var $form = $('#config_permissions_update_fm');

        $validateDefaults.rules = {
            name: {
                required: true,
                minlength: 2
            },
            label: {
                required: true,
                minlength: 2
            }
        };

        $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);
    });
</script>

@else
    @include('errors.403')
@endrole