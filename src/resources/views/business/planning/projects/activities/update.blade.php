<div class="modal-content" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> {{ trans('activities.labels.edit') }}</h4>
    </div>
    <div class="clearfix"></div>

    <form role="form" method="post" action="{{ route('update.edit.activities.projects.plans_management', ['id' => $entity->id]) }}"
          class="form-horizontal form-label-left" id="activity_update_fm" novalidate>
        <div class="x_content">

            @method('put')
            @csrf

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="component_id">
                    {{ trans('activities.labels.component') }} <span
                            class="required text-danger">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control select2" id="component_id"
                            name="component_id">
                        @foreach($components as $component)
                            <option value="{{ $component->id }}" @if($entity->component_id == $component->id) selected @endif>{{ $component->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">
                    {{ trans('activities.labels.code') }} <span class="text-danger">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="code" id="code" value="{{ $entity->code }}"
                           class="form-control col-md-7 col-sm-7 col-xs-12"/>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                    {{ trans('app.headers.name') }} <span class="text-danger">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="name" id="name" value="{{ $entity->name }}"
                           class="form-control col-md-7 col-sm-7 col-xs-12"/>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="area">
                    {{ trans('activities.labels.area') }} <span
                            class="required text-danger">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control select2 select2_area" id="area"
                            name="area_id">
                        @foreach($areas as $value)
                            <option value="{{ $value->id }}" @if($entity->area_id == $value->id) selected @endif>{{ $value->area }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="has_budget">
                    {{ trans('activities.labels.has_budget') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 15px">
                    @if($entity->budgetItems->count())
                        <input type="checkbox" class="js-switch" id="has_budget" checked disabled/>
                        <input type="hidden" name="has_budget" value="on">
                    @else
                        <input type="checkbox" name="has_budget" id="has_budget" class="js-switch"
                               @if($entity->has_budget) checked @endif/>
                    @endif
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <button class="btn btn-info" data-dismiss="modal">
                    <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    $(() => {

        $('.select2').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
            dropdownParent: $("#myModal")
        });

        let $form = $('#activity_update_fm');
        let id = "{{ $entity->project_fiscal_year_id }}";

        $form.validate($.extend(false, $validateDefaults, {
            rules: {
                code: {
                    required: true,
                    minlength: 3,
                    maxlength: 3,
                    digits: true,
                    remote: {
                        url: "{!! route('checkuniquefield') !!}",
                        data: {
                            fieldName: 'code',
                            fieldValue: () => {
                                return $('#code').val();
                            },
                            model: 'App\\Models\\Business\\Planning\\ActivityProjectFiscalYear',
                            current: '{{ $entity->id }}',
                            filter: {
                                project_fiscal_year_id: () => {
                                    return id;
                                }
                            }
                        }
                    }
                },
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 400
                },
                area_id: {
                    required: true
                },
                component_id: {
                    required: true
                }
            },
            messages: {
                code: {
                    remote: '{!! trans('activities.messages.validation.code_exists') !!}'
                }
            }
        }));

        let activities_tb = $('#activities_tb').DataTable();

        $form.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, null, () => {
                    $validateDefaults.rules = {};
                    $validateDefaults.messages = {};
                    $modal.modal('hide');
                    activities_tb.draw();
                });
            }
        }));
    });
</script>