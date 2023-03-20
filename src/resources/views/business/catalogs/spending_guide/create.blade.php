@permission('create.spending_guide.module_configuration_catalogs')

@inject('SpendingGuide', '\App\Models\Business\Catalogs\SpendingGuide')

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
                        @if (isset($entity))
                            {{ trans('spending_guide.labels.level_' . ($entity->level + 1)) }}
                        @else
                            {{ trans('spending_guide.labels.level_1') }}
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
                    <h2><i class="fa fa-compass"></i>
                        @if (isset($entity))
                            {{ trans('spending_guide.labels.new', ['type' => trans('spending_guide.labels.level_' . ($entity->level + 1))]) }}
                        @else
                            {{ trans('spending_guide.labels.new', ['type' => trans('spending_guide.labels.level_1')]) }}
                        @endif
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.spending_guide.module_configuration_catalogs') }}"
                               class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form role="form" action="{{ route('store.create.spending_guide.module_configuration_catalogs') }}"
                          method="post"
                          class="form-horizontal form-label-left" id="spending_guide_create_fm" novalidate>

                        @csrf

                        @if(isset($entity))
                            <input type="hidden" name="parent_id" id="parent_id" value="{{ $entity->id }}"/>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    {{ trans('spending_guide.labels.parent') }} :
                                </label>

                                <label class="control-label col-md-6 col-sm-6 col-xs-12"
                                       style="font-weight: normal; text-align: left;">{{ $entity->code . ' - ' . $entity->description }}</label>
                            </div>
                        @else
                            <input type="hidden" name="parent_id" id="parent_id" value=""/>

                        @endif

                        <div class="row" id="div_type">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">
                                    {{ trans('spending_guide.labels.type') }} <span class="text-danger"> *</span>
                                </label>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="type" id="type">
                                        <option></option>
                                        @foreach($types as $key => $value)
                                            <option value="{{ $key }}"
                                                    @if($key ==1) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div id='all'>
                            <div class="row" id="div_orientation">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="orientation">
                                        {{ trans('spending_guide.labels.level_1') }}<span class="text-danger"> *</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control select2" id="orientation">
                                            <option></option>
                                            @foreach($orientations as $obj)
                                                <option value="{{ $obj->id }}">
                                                    {{ $obj->code }} - {{ $obj->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="div_addressing">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addressing">
                                        {{ trans('spending_guide.labels.level_2') }}<span class="text-danger"> *</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control select2" name="addressing" id="addressing">
                                            <option></option>
                                            @foreach($addressings as $obj)
                                                <option value="{{ $obj->id }}">
                                                    {{ $obj->code }} - {{ $obj->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="div_category">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">
                                        {{ trans('spending_guide.labels.level_3') }}<span class="text-danger"> *</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control select2" name="category" id="category">
                                            <option></option>
                                            @foreach($categories as $obj)
                                                <option value="{{ $obj->id }}">
                                                    {{ $obj->code }} - {{ $obj->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">
                                {{ trans('spending_guide.labels.code') }} <span class="text-danger"> *</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="code" id="code" min="1" max="99" maxlength="2"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       @if (isset($entity))
                                       placeholder="{{ trans('spending_guide.placeholders.code', ['type' => trans('spending_guide.labels.level_' . ($entity->level + 1))]) }}"
                                       @else
                                       placeholder="{{ trans('spending_guide.placeholders.simple_code') }}"
                                       @endif
                                       oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                {{ trans('spending_guide.labels.name') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description" maxlength="500"
                                          class="form-control col-md-7 col-sm-7 col-xs-12 vertical"
                                          @if (isset($entity))
                                          placeholder="{{ trans('spending_guide.placeholders.name', ['type' => trans('spending_guide.labels.level_' . ($entity->level + 1))]) }}"
                                          @else
                                          placeholder="{{ trans('spending_guide.placeholders.name') }}"
                                        @endif></textarea>
                            </div>
                        </div>

                        @if(isset($entity))
                            <input type="hidden" name="level" id="level" value="{{ $entity->level + 1 }}"/>
                        @else
                            <input type="hidden" name="level" id="level" value="1"/>
                        @endif

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.spending_guide.module_configuration_catalogs') }}"
                               class="btn btn-info ajaxify">
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

        let $form = $('#spending_guide_create_fm');

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
                            parent_id: '{{ isset($entity) ? $entity->id : null }}',
                            level: '{{ isset($entity->level) ? ($entity->level + 1) : 1 }}'
                        }
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
                            parent_id: '{{ isset($entity) ? $entity->id : null }}',
                            level: '{{ isset($entity->level) ? ($entity->level + 1) : 1 }}'
                        }
                    }
                }
            }
        };

        $validateDefaults.messages = {
            code: {
                remote: '{{ trans('spending_guide.messages.validation.code_exists_general') }}'
            },
            description: {
                remote: '{{ trans('spending_guide.messages.validation.description_exists_general') }}'
            }
        };

        let selectType = $('#type').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {

            selectOrientation.html('');
            selectOrientation.prop("disabled", true);
            selectOrientation.append('<option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

            selectAddressing.html('');
            selectAddressing.prop("disabled", true);
            selectAddressing.append('<option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

            selectCategory.html('');
            selectCategory.prop("disabled", true);
            selectCategory.append('<option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

            let url = '{{ route('level.create.spending_guide.module_configuration_catalogs', ['level'=> '0']) }}';
            if (selectType.val() == {{ $SpendingGuide::LEVEL_4 }} || selectType.val() == {{ $SpendingGuide::LEVEL_3 }} || selectType.val() == {{ $SpendingGuide::LEVEL_2 }}) {
                url = url.replace('0', '1');
            }
            $('#level').val(selectType.val());

            pushRequest(url, null, (response) => {
                let opt = [];

                $.each(response, function (index, value) {
                    opt.push({
                        id: value.id,
                        text: value.code + ' - ' + value.description
                    });
                });

                if (selectType.val() == {{ $SpendingGuide::LEVEL_1 }}) {
                    $('#div_orientation').hide();
                    $('#div_addressing').hide();
                    $('#div_category').hide();
                    $('#parent_id').val(null);
                }

                if (selectType.val() == {{ $SpendingGuide::LEVEL_2 }}) {
                    $('#div_orientation').show();
                    $('#div_addressing').hide();
                    $('#div_category').hide();

                    selectOrientation.select2({
                        data: opt
                    });
                    selectOrientation.prop("disabled", false);
                    $("#orientation").rules("add", {
                        required: true
                    });
                }

                if (selectType.val() == {{ $SpendingGuide::LEVEL_3 }}) {
                    $('#div_orientation').show();
                    $('#div_addressing').show();
                    $('#div_category').hide();

                    selectOrientation.select2({
                        data: opt
                    });
                    selectOrientation.prop("disabled", false);
                    $("#orientation").rules("add", {
                        required: true
                    });
                }

                if (selectType.val() == {{ $SpendingGuide::LEVEL_4 }}) {
                    $('#div_orientation').show();
                    $('#div_addressing').show();
                    $('#div_category').show();

                    selectOrientation.select2({
                        data: opt
                    });
                    selectOrientation.prop("disabled", false);
                    $("#orientation").rules("add", {
                        required: true
                    });
                }

                addRules();

            }, 'get', null, false)
        });

        let selectOrientation = $('#orientation').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {

            $('#parent_id').val(selectOrientation.val());
            selectAddressing.html('');
            selectAddressing.prop("disabled", true);
            selectAddressing.append('<option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

            if (selectOrientation.val() && selectType.val() == {{ $SpendingGuide::LEVEL_3 }} || selectType.val() == {{ $SpendingGuide::LEVEL_4 }}) {

                addRules();

                let url = '{{ route('children.create.spending_guide.module_configuration_catalogs', ['id'=> '__ID__']) }}';
                url = url.replace('__ID__', selectOrientation.val());

                pushRequest(url, null, (response) => {
                    let opt = [];
                    $.each(response, function (index, value) {
                        opt.push({
                            id: value.id,
                            text: value.code + ' - ' + value.description
                        });
                    });
                    selectAddressing.select2({
                        data: opt
                    });
                    selectAddressing.prop("disabled", false);
                    $("#addressing").rules("add", {
                        required: true
                    });
                }, 'get', null, false)
            } else if (selectType.val() == {{ $SpendingGuide::LEVEL_2 }}) {
                addRules();
            }
        });

        let selectAddressing = $('#addressing').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {
            $('#parent_id').val(selectAddressing.val());
            selectCategory.html('');
            selectCategory.prop("disabled", true);
            selectCategory.append('<option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');
            if (selectAddressing.val() && selectType.val() == {{ $SpendingGuide::LEVEL_4 }}) {
                addRules();

                let url = '{{ route('children.create.spending_guide.module_configuration_catalogs', ['id'=> '__ID__']) }}';
                url = url.replace('__ID__', selectAddressing.val());

                pushRequest(url, null, (response) => {
                    let opt = [];
                    $.each(response, function (index, value) {
                        opt.push({
                            id: value.id,
                            text: value.code + ' - ' + value.description
                        });
                    });
                    selectCategory.select2({
                        data: opt
                    });
                    selectCategory.prop("disabled", false);
                    $("#category").rules("add", {
                        required: true
                    });
                }, 'get', null, false)
            } else if (selectType.val() == {{ $SpendingGuide::LEVEL_3 }}) {
                addRules();
            }
            addRules();
        });

        let selectCategory = $('#category').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {
            $('#parent_id').val(selectCategory.val());
            addRules();
        });

        let addRules = () => {

            $("#code", $form).rules('remove', 'remote');
            $("#code", $form).rules("add", {
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'code',
                        fieldValue: () => {
                            return $('#code').val();
                        },
                        model: 'App\\Models\\Business\\Catalogs\\SpendingGuide',
                        filter: {
                            parent_id: () => {
                                return $('#parent_id').val()
                            },
                            level: () => {
                                return $('#level').val();
                            }
                        }
                    }
                }
            });
            validator.element($("#code", $form));

            $("#description", $form).rules('remove', 'remote');
            $("#description", $form).rules("add", {
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'description',
                        fieldValue: () => {
                            return $('#description').val();
                        },
                        model: 'App\\Models\\Business\\Catalogs\\SpendingGuide',
                        filter: {
                            parent_id: () => {
                                return $('#parent_id').val()
                            },
                            level: () => {
                                return $('#level').val();
                            }
                        }
                    }
                }
            });
            validator.element($("#description", $form));
        };

        @if(isset($entity))
            $('#div_type').hide();
            $('#all').hide();
        @else
            $('#div_type').show();
            $('#div_orientation').hide();
            $('#div_addressing').hide();
            $('#div_category').hide();
        @endif

        let validator = $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);
    });
</script>

@else
    @include('errors.403')
    @endpermission