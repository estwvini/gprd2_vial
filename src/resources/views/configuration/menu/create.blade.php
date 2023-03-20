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
                <li class="active"> {{ trans('app.labels.new') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-bars"></i> {{ trans('configuration.menu.labels.new') }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.menus.configuration') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <form role="form" action="{{ route('store.create.menus.configuration') }}" method="post"
                          class="form-horizontal form-label-left" id="config_menus_create_fm" novalidate>

                        @csrf

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent">
                                {{ trans('configuration.menu.headers.parent') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="select2_group form-control" name="parent_id" id="parent">
                                    <option value="">{{ trans('configuration.menu.labels.no_parent') }}</option>
                                    @foreach($parents as $parent)
                                        <optgroup label="{{ $parent->label }}">
                                            <option value="{{ $parent->id }}">-- {{ $parent->label }}</option>
                                            @foreach($parent->children()->get() as $menu)
                                                @include('configuration.menu.partial.select', ['menu' => $menu, 'level' => 2])
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="label">
                                {{ trans('configuration.menu.headers.label') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="label" id="label" required
                                       class="form-control col-md-7 col-xs-12"
                                       placeholder="{{ trans('configuration.menu.labels.label') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">
                                {{ trans('configuration.menu.headers.slug') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="slug" id="slug"
                                       class="form-control col-md-7 col-xs-12"
                                       placeholder="{{ trans('configuration.menu.labels.slug') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="icon">
                                {{ trans('configuration.menu.headers.icon') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="icon" id="icon"
                                       class="form-control col-md-7 col-xs-12"
                                       placeholder="{{ trans('configuration.menu.labels.icon') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="weight">
                                {{ trans('configuration.menu.headers.weight') }} <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="weight" id="weight" required
                                       class="form-control col-md-7 col-xs-12"
                                       placeholder="{{ trans('configuration.menu.labels.weight') }}"/>
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
                            <a href="{{ route('index.menus.configuration') }}" class="btn btn-info ajaxify">
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
        var $form = $('#config_menus_create_fm');

        $validateDefaults.rules ={
            label: {
                required: true,
                minlength: 2
            },
            weight: {
                required: true
            }
        };

        $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);

        // select parent
        $(".select2_group").select2({
            placeholder: "{{ html_entity_decode(trans('configuration.menu.headers.parent')) }}",
        });
    });
</script>

@else
    @include('errors.403')
@endrole