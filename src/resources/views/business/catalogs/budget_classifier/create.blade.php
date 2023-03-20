@permission('create.budget_classifiers.module_configuration_catalogs')
@inject('BudgetClassifier', '\App\Models\Business\Catalogs\BudgetClassifier')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('budget_classifiers.title') }}
                <small>{{ trans('app.labels.catalogs') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.budget_classifiers.module_configuration_catalogs')
                <li>
                    <a class="ajaxify" href="{{ route('index.budget_classifiers.module_configuration_catalogs') }}">
                        @if (isset($entity))
                            @if(($entity->level + 1) > 3)
                                {{ trans('budget_classifiers.labels.level_default') }}
                            @else
                                {{ trans('budget_classifiers.labels.level_' . ($entity->level + 1)) }}
                            @endif
                        @else
                            {{ trans('budget_classifiers.labels.level_1') }}
                        @endif
                    </a>
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
                    <h2><i class="fa fa-inbox"></i>
                        @if (isset($entity))
                            @if(($entity->level + 1) > 3)
                                {{ trans('budget_classifiers.labels.new_default') }}
                            @else
                                {{ trans('budget_classifiers.labels.new', ['type' => trans('budget_classifiers.labels.level_' . ($entity->level + 1))]) }}
                            @endif
                        @else
                            {{ trans('budget_classifiers.labels.new', ['type' => trans('budget_classifiers.labels.level_1')]) }}
                        @endif
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.budget_classifiers.module_configuration_catalogs') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form role="form" action="{{ route('store.create.budget_classifiers.module_configuration_catalogs') }}" method="post"
                          class="form-horizontal form-label-left" id="budget_classifiers_create_fm" novalidate>

                        @csrf

                        @if(isset($entity))
                            <input type="hidden" name="parent_id" id="parent_id" value="{{ $entity->id }}"/>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    {{ trans('budget_classifiers.labels.parent') }} :
                                </label>

                                <label class="col-md-6 col-sm-6 col-xs-12 mt-3" style="font-weight: normal">{{ $entity->code . ' - ' . $entity->title }}</label>
                            </div>

                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">
                                {{ trans('budget_classifiers.labels.code') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="code" id="code" min="1" max="99"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       @if (isset($entity))
                                       @if(($entity->level + 1) > 2)
                                       maxlength="2"
                                       @else
                                       maxlength="1"
                                       @endif
                                       @if(($entity->level + 1) > 3)
                                       placeholder="{{ trans('budget_classifiers.placeholders.code_default') }}"
                                       @else
                                       placeholder="{{ trans('budget_classifiers.placeholders.code', ['type' => trans('budget_classifiers.labels.level_' . ($entity->level + 1))]) }}"
                                       @endif
                                       @else
                                       placeholder="{{ trans('budget_classifiers.placeholders.code', ['type' => trans('budget_classifiers.labels.level_1')]) }}"
                                       maxlength="1"
                                       @endif
                                       oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">
                                {{ trans('budget_classifiers.labels.title') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="title" id="title" maxlength="300"
                                          class="form-control col-md-7 col-sm-7 col-xs-12 vertical"
                                          @if (isset($entity))
                                          @if(($entity->level + 1) > 3)
                                          placeholder="{{ trans('budget_classifiers.placeholders.title_default') }}"
                                          @else
                                          placeholder="{{ trans('budget_classifiers.placeholders.title', ['type' => trans('budget_classifiers.labels.level_' . ($entity->level + 1))]) }}"
                                          @endif
                                          @else
                                          placeholder="{{ trans('budget_classifiers.placeholders.title', ['type' => trans('budget_classifiers.labels.level_1')]) }}"
                                        @endif></textarea>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                {{ trans('app.headers.description') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description" maxlength="1000" rows="5"
                                          class="form-control col-md-7 col-sm-7 col-xs-12 vertical"
                                          @if (isset($entity))
                                          @if(($entity->level + 1) > 3)
                                          placeholder="{{ trans('budget_classifiers.placeholders.description_default') }}"
                                          @else
                                          placeholder="{{ trans('budget_classifiers.placeholders.description', ['type' => trans('budget_classifiers.labels.level_' . ($entity->level + 1))]) }}"
                                          @endif
                                          @else
                                          placeholder="{{ trans('budget_classifiers.placeholders.description', ['type' => trans('budget_classifiers.labels.level_1')]) }}"
                                        @endif></textarea>
                            </div>
                        </div>

                        @if(isset($entity))
                            <input type="hidden" name="level" id="level" value="{{ $entity->level + 1 }}"/>
                        @endif

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.budget_classifiers.module_configuration_catalogs') }}" class="btn btn-info ajaxify">
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

        let $form = $('#budget_classifiers_create_fm');

        $validateDefaults.rules = {
            code: {
                required: true,
                onlyIntegers: true,
                @if (isset($entity))
                        @if(($entity->level + 1) > 2)
                maxlength: 2,
                minlength: 2,
                @else
                maxlength: 1,
                minlength: 1,
                @endif
                        @else
                maxlength: 1,
                minlength: 1,
                @endif
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'code',
                        fieldValue: () => {
                            let val = $('#code').val();
                            @if(isset($entity) and ($entity->level + 1)  == $BudgetClassifier::LEVEL_2)
                                val = '{{ $entity->code }}' + val;
                            @endif
                            return val;
                        },
                        model: 'App\\Models\\Business\\Catalogs\\BudgetClassifier',
                        filter: {
                            parent_id: '{{ isset($entity) ? $entity->id : null }}',
                            level: '{{ isset($entity->level) ? $entity->level + 1 : 1 }}'
                        }
                    }
                }
            },
            title: {
                required: true,
                maxlength: 300,
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'title',
                        fieldValue: () => {
                            return $('#title').val();
                        },
                        model: 'App\\Models\\Business\\Catalogs\\BudgetClassifier',
                        filter: {
                            parent_id: '{{ isset($entity) ? $entity->id : null }}',
                            level: '{{ isset($entity->level) ? $entity->level + 1 : 1 }}'
                        }
                    }
                }
            },
            description: {
                required: true,
                maxlength: 1000,
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'description',
                        fieldValue: () => {
                            return $('#description').val();
                        },
                        model: 'App\\Models\\Business\\Catalogs\\BudgetClassifier',
                        filter: {
                            parent_id: '{{ isset($entity) ? $entity->id : null }}',
                            level: '{{ isset($entity->level) ? $entity->level + 1 : 1 }}'
                        }
                    }
                }
            }
        };

        $validateDefaults.messages = {
            code: {
                remote:
                        @if (isset($entity))
                                @if(($entity->level + 1) > 3)
                            '{!! trans('budget_classifiers.messages.validation.code_exists', ['type' => trans('budget_classifiers.labels.level_default')]) !!}'
                @else
                '{!! trans('budget_classifiers.messages.validation.code_exists', ['type' => trans('budget_classifiers.labels.level_' . ($entity->level + 1))]) !!}'
                        @endif
                                @else
                            '{!! trans('budget_classifiers.messages.validation.code_exists', ['type' => trans('budget_classifiers.labels.level_1')]) !!}'
                @endif


            },
            title: {
                remote:
                        @if (isset($entity))
                                @if(($entity->level + 1) > 3)
                            '{!! trans('budget_classifiers.messages.validation.title_exists', ['type' => trans('budget_classifiers.labels.level_default')]) !!}'
                @else
                '{!! trans('budget_classifiers.messages.validation.title_exists', ['type' => trans('budget_classifiers.labels.level_' . ($entity->level + 1))]) !!}'
                        @endif
                                @else
                            '{!! trans('budget_classifiers.messages.validation.title_exists', ['type' => trans('budget_classifiers.labels.level_1')]) !!}'
                @endif
            },
            description: {
                remote:
                        @if (isset($entity))
                                @if(($entity->level + 1) > 3)
                            '{!! trans('budget_classifiers.messages.validation.description_exists', ['type' => trans('budget_classifiers.labels.level_default')]) !!}'
                @else
                '{!! trans('budget_classifiers.messages.validation.description_exists', ['type' => trans('budget_classifiers.labels.level_' . ($entity->level + 1))]) !!}'
                        @endif
                                @else
                            '{!! trans('budget_classifiers.messages.validation.description_exists', ['type' => trans('budget_classifiers.labels.level_1')]) !!}'
                @endif
            }
        };

        $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);
    });
</script>

@else
    @include('errors.403')
    @endpermission