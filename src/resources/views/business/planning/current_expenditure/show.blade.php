@permission('show.current_expenditure_elements.budget.plans_management')
@inject('CurrentExpenditureElement', '\App\Models\Business\Planning\CurrentExpenditureElement')

<div class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('current_expenditure.labels.details', ['element' => trans('current_expenditure.labels.' . $entity->type)]) }}</h2>

        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <form role="form" class="form-horizontal form-label-left" id="currentExpenditureElementFormCreate" novalidate>

                    <div class="pb-4">{!! $route !!}</div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_code">
                            {{ trans('current_expenditure.labels.code') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input disabled name="element_code" id="element_code"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   value="{{ $entity->code }}"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_name">
                            {{ trans('current_expenditure.labels.name', ['element' => trans('current_expenditure.labels.' . $entity->type)]) }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input disabled name="element_name" id="element_name"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   value="{{ $entity->name }}"/>
                        </div>
                    </div>

                    @if($entity->type === $CurrentExpenditureElement::TYPE_PROGRAM)
                        <div class="item form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="area_id">
                                {{ trans('operational_activities.labels.responsibleUnit') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <select disabled class="form-control select2" id="area_id" name="area_id">
                                    <option value=""></option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}" @if($area->id === $entity->area_id) selected @endif>{{ $area->code . ' ' . $area->area }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="pull-right">
                        <button id="acceptBtn" type="button" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.accept') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(() => {

        // Initialize selects
        $('.select2').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        })

        $('#acceptBtn').click(() => {
            $('#load-area').empty()

            $('li').each((index, element) => {
                $(element).removeClass('treeview-item-selected')
            })
            $('i').each((index, element) => {
                $(element).removeClass('treeview-action-item-selected')
            })
        })
    })

</script>

@else
    @include('errors.403')
@endpermission