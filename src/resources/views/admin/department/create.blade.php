@permission('create.departments')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('departments.title') }}
                <small>{{ trans('app.labels.administration') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.departments')
                <li>
                    <a class="ajaxify" href="{{ route('index.departments') }}"> {{ trans('departments.title') }}</a>
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
                    <h2><i class="fa fa-sitemap"></i> {{ trans('departments.labels.new') }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.departments') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form role="form" action="{{ route('store.create.departments') }}" method="post"
                          class="form-horizontal form-label-left" id="departments_create_fm" novalidate>

                        @csrf
                        <input type="hidden" name="code" id="code" value="{{ $code }}"/>
                        @if( $code > 999)
                            <div class="alert alert-warning align-center" role="alert">
                                {{ trans('departments.messages.exceptions.max') }}
                            </div>
                        @else
                        <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="text-right col-md-3 col-sm-3 col-xs-12">
                                {{ trans('departments.labels.code') }}
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <label class="col-md-12 col-sm-12 col-xs-12" >
                                    {{ $code }}
                                </label>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                {{ trans('app.headers.name') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('departments.placeholders.name') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                {{ trans('app.headers.description') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description"
                                          class="form-control col-md-7 col-sm-7 col-xs-12 vertical"
                                          placeholder="{{ trans('departments.placeholders.description') }}"></textarea>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent_id">
                                {{ trans('departments.labels.parent_department') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <select class="form-control select2" id="parent_id" name="parent_id">
                                        <option value=""></option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-addon" id="clear-parent"><span
                                                class="glyphicon glyphicon-remove"></span></span>
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone_number">
                                {{ trans('departments.labels.phone_number') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="phone_number" id="phone_number" maxlength="10"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('departments.placeholders.phone_number') }}"/>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.departments') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                            </button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

        // initialize selects
        $('.select2').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
        });

        // remove parent
        $('#clear-parent').on('click', function (e) {
            $('#parent_id').val(null).trigger('change');
        });

        var $form = $('#departments_create_fm');

        $validateDefaults.rules = {
            name: {
                required: true,
                minlength: 3,
                maxlength: 200,
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'name',
                        fieldValue: function () {
                            return $("#name").val();
                        },
                        model: 'App\\Models\\Admin\\Department'
                    }
                }
            },
            description: {
                maxlength: 255
            },
            phone_number: {
                onlyIntegers: true,
                minlength: 7,
                maxlength: 10
            }
        };

        $validateDefaults.messages = {
            name: {
                remote: '{!! trans('departments.messages.validation.department_exists') !!}'
            }
        };

        $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);
    });
</script>

@else
    @include('errors.403')
    @endpermission