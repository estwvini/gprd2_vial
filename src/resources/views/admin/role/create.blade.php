@permission('create.roles')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('roles.title') }}
                <small>{{ trans('app.labels.administration') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.roles')
                <li>
                    <a class="ajaxify" href="{{ route('index.roles') }}"> {{ trans('roles.title') }}</a>
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
                    <h2><i class="fa fa-users"></i> {{ trans('roles.labels.create') }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.roles') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form role="form" action="{{ route('store.create.roles') }}" method="post"
                          class="form-horizontal form-label-left" id="roles_create_fm" novalidate>

                        @csrf

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                {{ trans('app.headers.name') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name" required
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('roles.labels.name') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                {{ trans('app.headers.description') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description"
                                          class="form-control col-md-7 col-sm-7 col-xs-12 vertical"
                                          placeholder="{{ trans('roles.labels.description') }}"></textarea>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="enabled">
                                {{ trans('app.headers.enabled') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="checkbox" name="enabled" id="enabled" class="js-switch" checked/>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.roles') }}" class="btn btn-info ajaxify">
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
    $(function () {
        var $form = $('#roles_create_fm');

        $validateDefaults.rules = {
            name: {
                required: true,
                minlength: 2,
                remote: {
                    url: "{!! route('checkname.create.roles') !!}",
                    data: {
                        username: function () {
                            return $("#name").val();
                        }
                    }
                }
            },
            description: {
                wordChecker: true
            }
        };

        $validateDefaults.messages = {
            name : {
                remote : '{!! trans('roles.messages.validation.role_exists') !!}'
            }
        };

        $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);
    });
</script>

@else
    @include('errors.403')
    @endpermission