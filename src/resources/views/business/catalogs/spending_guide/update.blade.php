@permission('edit.spending_guide.module_configuration_catalogs')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('spending_guide.title') }}
                <small>{{ trans('app.labels.catalogs') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.spending_guide.module_configuration_catalogs')
                <li>
                    <a class="ajaxify" href="{{ route('index.spending_guide.module_configuration_catalogs') }}">
                        {{ trans('spending_guide.labels.level_' . $entity->level) }}
                    </a>
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
                    <h2><i class="fa fa-compass"></i>
                        {{ trans('spending_guide.labels.update', ['type' => trans('spending_guide.labels.level_' . $entity->level)]) }}
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.spending_guide.module_configuration_catalogs') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form role="form" action="{{ route('update.edit.spending_guide.module_configuration_catalogs', ['id' => $entity->id]) }}" method="post"
                          class="form-horizontal form-label-left" id="spending_guide_edit_fm" novalidate>

                        @method('PUT')
                        @csrf

                        <input type="hidden" name="parent_id" id="parent_id" value="{{ $entity->parent_id }}"/>

                        @if(isset($entity->parent_id))
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    {{ trans('spending_guide.labels.parent') }} :
                                </label>

                                <label class="control-label col-md-6 col-sm-6 col-xs-12"
                                       style="font-weight: normal; text-align: left;">{{ $entity->parent->code . ' - ' . $entity->parent->description }}</label>
                            </div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">
                                {{ trans('spending_guide.labels.code') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="code" id="code" min="1" max="99" maxlength="2" @if(!$updateCode) disabled @endif
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('spending_guide.placeholders.code', ['type' => trans('spending_guide.labels.level_' . $entity->level)]) }}"
                                       oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                       value="{{ $entity->code }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                {{ trans('app.headers.description') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description" maxlength="500"
                                          class="form-control col-md-7 col-sm-7 col-xs-12 vertical"
                                          placeholder="{{ trans('spending_guide.placeholders.description', ['type' => trans('spending_guide.labels.level_' . $entity->level)]) }}">{{ $entity->description }}</textarea>
                            </div>
                        </div>

                        <input type="hidden" name="level" id="level" value="{{ $entity->level }}"/>

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.spending_guide.module_configuration_catalogs') }}" class="btn btn-info ajaxify">
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

        let $form = $('#spending_guide_edit_fm');

        $validateDefaults.rules = {
            code: {
                required: true,
                onlyIntegers: true,
                minlength: 2,
                maxlength: 2,
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'code',
                        fieldValue: () => {
                            return $('#code').val();
                        },
                        model: 'App\\Models\\Business\\Catalogs\\SpendingGuide',
                        filter: {
                            parent_id: '{{ isset($entity->parent_id) ? $entity->parent_id : null }}',
                            level: '{{ $entity->level }}'
                        },
                        current: '{{ $entity->id }}'
                    }
                }
            },
            description: {
                required: true,
                maxlength: 500,
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'description',
                        fieldValue: () => {
                            return $('#description').val();
                        },
                        model: 'App\\Models\\Business\\Catalogs\\SpendingGuide',
                        filter: {
                            parent_id: '{{ isset($entity->parent_id) ? $entity->parent_id : null }}',
                            level: '{{ $entity->level }}'
                        },
                        current: '{{ $entity->id }}'
                    }
                }
            }
        };

        $validateDefaults.messages = {
            code: {
                remote: '{!! trans('spending_guide.messages.validation.code_exists', ['type' => trans('spending_guide.labels.level_' . $entity->level)]) !!}'
            },
            description: {
                remote: '{!! trans('spending_guide.messages.validation.description_exists', ['type' => trans('spending_guide.labels.level_' . $entity->level)]) !!}'
            }
        };

        $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);
    });
</script>

@else
    @include('errors.403')
    @endpermission