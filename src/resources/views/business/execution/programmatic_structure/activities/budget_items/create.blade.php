@if(currentUser()->can('create.items.operational_activities.current_expenditure_elements.programmatic_structure.execution'))

    @inject('BudgetItem', '\App\Models\Business\BudgetItem')

    <div class="modal-content" id="myModal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> {{ trans('budget_item.labels.create') }}
            </h4>
        </div>

        <div class="clearfix"></div>
        @if(isset($activityType) && $activityType === $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)
            <form method="post"
                  action="{{ route('store.create.items.operational_activities.current_expenditure_elements.programmatic_structure.execution', ['activityId' => $activity->id, 'activityType' => $activityType, 'module' => $BudgetItem::MODULE['PROGRAMMATIC_STRUCTURE']]) }}"
                  class="form-horizontal form-label-left" id="budget_item_create_fm">
        @else
            <form method="post" action="{{ route('store.create.items.activities.project.programmatic_structure.execution', ['activityId' => $activity->id, 'module' => $BudgetItem::MODULE['PROGRAMMATIC_STRUCTURE']]) }}"
                  class="form-horizontal form-label-left"
                  id="budget_item_create_fm" novalidate>
        @endif
            @csrf

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_content">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <table class="table table-bordered detail-table">
                                <tbody>
                                <tr>
                                    <td class="w-20">{{ trans('budget_item.labels.code') }}</td>
                                    <td colspan="2" class="text-center fs-l" id="budget_item_code"></td>
                                </tr>

                                @if(isset($activityType) && $activityType === $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)
                                    <tr>
                                        <td>{{ trans('budget_item.labels.area') }}</td>
                                        <td>@isset($activity->subprogram->parent->area) {{ $activity->subprogram->parent->area->code }} @endisset</td>
                                        <td>@isset($activity->subprogram->parent->area) {{ $activity->subprogram->parent->area->area }} @endisset</td>
                                    </tr>

                                    <tr>
                                        <td>{{ trans('budget_item.labels.program') }}</td>
                                        <td>@isset($activity->subprogram->parent) {{ $activity->subprogram->parent->code }} @endisset</td>
                                        <td>@isset($activity->subprogram->parent) {{ $activity->subprogram->parent->name }} @endisset</td>
                                    </tr>

                                    <tr>
                                        <td>{{ trans('budget_item.labels.sub_program') }}</td>
                                        <td>@isset($activity->subprogram) {{ $activity->subprogram->code }} @endisset</td>
                                        <td>@isset($activity->subprogram) {{ $activity->subprogram->name }} @endisset</td>
                                    </tr>

                                    <tr>
                                        <td>{{ trans('budget_item.labels.project') }}</td>
                                        <td>{{ trans('budget_item.labels.tbd_code') }}</td>
                                        <td>{{ trans('budget_item.labels.tbd_description') }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{ trans('budget_item.labels.executingUnit') }}</td>
                                        <td>@isset($activity->executingUnit) {{ $activity->executingUnit->code }} @endisset</td>
                                        <td>@isset($activity->executingUnit) {{ $activity->executingUnit->name }} @endisset</td>
                                    </tr>

                                    <tr>
                                        <td>{{ trans('budget_item.labels.activity') }}</td>
                                        <td>{{ $activity->code }}</td>
                                        <td>{{ $activity->name }}</td>
                                    </tr>

                                @else
                                    <tr>
                                        <td>{{ trans('budget_item.labels.area') }}</td>
                                        <td>@isset($activity->area) {{ $activity->area->code }} @endisset</td>
                                        <td>@isset($activity->area) {{ $activity->area->area }} @endisset</td>
                                    </tr>

                                    <tr>
                                        <td>{{ trans('budget_item.labels.program') }}</td>
                                        <td>@isset($activity->component->project->subprogram) {{ $activity->component->project->subprogram->parent->code }} @endisset</td>
                                        <td>@isset($activity->component->project->subprogram) {{ $activity->component->project->subprogram->parent->description }} @endisset</td>
                                    </tr>

                                    <tr>
                                        <td>{{ trans('budget_item.labels.sub_program') }}</td>
                                        <td>@isset($activity->component->project->subProgram) {{ $activity->component->project->subProgram->code }} @endisset</td>
                                        <td>@isset($activity->component->project->subProgram) {{ $activity->component->project->subProgram->description }} @endisset</td>
                                    </tr>

                                    <tr>
                                        <td>{{ trans('budget_item.labels.project') }}</td>
                                        <td>@isset($activity->component->project) {{ $activity->component->project->cup }} @endisset</td>
                                        <td>@isset($activity->component->project) {{ $activity->component->project->name}} @endisset</td>
                                    </tr>

                                    <tr>
                                        <td>{{ trans('budget_item.labels.executingUnit') }}</td>
                                        <td>@isset($activity->component->project->executingUnit) {{ $activity->component->project->executingUnit->code }} @endisset</td>
                                        <td>@isset($activity->component->project->executingUnit) {{ $activity->component->project->executingUnit->name }} @endisset</td>
                                    </tr>

                                    <tr>
                                        <td>{{ trans('budget_item.labels.activity') }}</td>
                                        <td>{{ $activity->code }}</td>
                                        <td>{{ $activity->name }}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="description">
                            {{ trans('budget_item.labels.description') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea name="description" id="description" class="form-control"
                                      placeholder="{{ trans('budget_item.labels.description') }}"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget_classifier_id">
                            {{ trans('budget_item.labels.budget_item') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control select2" id="budget_classifier_id" name="budget_classifier_id" required>
                                <option value=""></option>
                                @foreach($budgetClassifier as $item)
                                    <option value="{{ $item->id }}" data-code="{{ $item->full_code }}">
                                        {{ $item->full_code }} - {{ $item->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="name">
                            {{ trans('budget_item.labels.name') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea name="name" id="name" class="form-control"
                                      placeholder="{{ trans('budget_item.labels.name_default') }}"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="geographic_location_id">
                            {{ trans('budget_item.labels.geographic') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control select2" id="geographic_location_id" name="geographic_location_id" required>
                                <option value=""></option>
                                @foreach($geographicLocations as $location)
                                    <option value="{{ $location->id }}" data-code="{{ $location->getFullCode() }}">
                                        {{ $location->getFullCode() }} - {{ $location->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="financing_source_id">
                            {{ trans('budget_item.labels.source') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control select2" id="financing_source_id" name="financing_source_id" required>
                                <option value=""></option>
                                @foreach($financingSources as $source)
                                    <option value="{{ $source->id }}" data-code="{{ $source->code }}">
                                        {{ $source->code }} - {{ $source->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="guide_spending_id">
                            {{ trans('budget_item.labels.spending_guide') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control select2" id="guide_spending_id" name="guide_spending_id" required>
                                <option value=""></option>
                                @foreach($guideSpendings as $guideSpending)
                                    <option value="{{ $guideSpending->id }}" data-code="{{ $guideSpending->full_code }}">
                                        {{ $guideSpending->full_code }} - {{ $guideSpending->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="competence_id">
                            {{ trans('budget_item.labels.competence') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control select2" id="competence_id" name="competence_id" required>
                                <option value="">{{ trans('app.labels.select') }}</option>
                                @foreach($competences as $value)
                                    <option value="{{ $value->id }}" data-code="{{ $value->code }}">{{ $value->code }}-{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="institution_id">
                            {{ trans('budget_item.labels.institution') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control select2" name="institution_id" id="institution_id" data-width="100%">
                                <option value=""></option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" data-code="{{ $institution->cleanCode() }}">
                                        {{ $institution->code }} - {{ $institution->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="display: none;" id="div_loan_id">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="loan_id">
                            {{ trans('budget_item.labels.loan') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control select2" id="loan_id" name="loan_id">
                                <option value=""></option>
                                @foreach($loans as $loan)
                                    <option value="{{ $loan->id }}">
                                        {{ $loan->full_code }} - {{ $loan->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        @if(isset($activityType) && $activityType !== $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_participatory_budget">
                                {{ trans('budget_item.labels.participatory_budget') }}
                            </label>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input type="checkbox" name="is_participatory_budget" id="is_participatory_budget" class="js-switch"/>
                            </div>
                        @endif

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="is_public_purchase">
                            {{ trans('budget_item.labels.public_purchase') }}
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="checkbox" name="is_public_purchase" id="is_public_purchase" class="js-switch"/>
                        </div>
                    </div>

                    <div class="form-group" id="group_amount">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">
                            {{ trans('budget_item.labels.amount') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <label class="mt-3">$ 0 </label>
                            <i role="button" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('budget_item.labels.budgetItemValueTooltip') }}"
                               class="fa fa-info-circle blue"></i>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <button type="button" class="btn btn-info" data-dismiss="modal">
                        <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-success" id="btn_submit">
                        <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(() => {
            let budget_item_key = [];
            @if(isset($activityType) && $activityType === $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)
                budget_item_key = [
                @if($activity->subprogram->parent->area)'{{ $activity->subprogram->parent->area->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Área
                @if($activity->subprogram->parent)'{{ $activity->subprogram->parent->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Prog
                @if($activity->subprogram)'{{ $activity->subprogram->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Subp
                '{{ $BudgetItem::CODE_999 }}', // Proy
                @if($activity->executingUnit)'{{ $activity->executingUnit->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // UE
                @if($activity)'{{ $activity->code }}', @else '{{ $BudgetItem::CODE_000 }}', @endif // Act
                '{{ $BudgetItem::CODE_0 }}.{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}', // Nat.Grup.Subg.Ítem
                '{{ $BudgetItem::FUN }}', // Competencia
                '{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}', // OG.DG.CAT.SUB
                '{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}', // Prov.Cant.Parr
                '{{ $BudgetItem::CODE_000 }}', // Código fuente.
                '{{ $BudgetItem::CODE_9999999 }}', // Organismo.
            ];
            @else
                budget_item_key = [
                @if($activity->area)'{{ $activity->area->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Área
                @if($activity->component->project->subprogram)'{{ $activity->component->project->subprogram->parent->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Prog
                @if($activity->component->project->subprogram)'{{ $activity->component->project->subprogram->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Subp
                @if($activity->component->project)'{{ $activity->component->project->cup }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Proy
                @if($activity->component->project->executingUnit)'{{ $activity->component->project->executingUnit->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // UE
                @if($activity)'{{ $activity->code }}', @else '{{ $BudgetItem::CODE_000 }}', @endif // Act
                '{{ $BudgetItem::CODE_0 }}.{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}', // Nat.Grup.Subg.Ítem
                '{{ $BudgetItem::FUN }}', // Competencia
                '{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}', // OG.DG.CAT.SUB
                '{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}.{{ $BudgetItem::CODE_00 }}', // Prov.Cant.Parr
                '{{ $BudgetItem::CODE_000 }}', // Código fuente.
                '{{ $BudgetItem::CODE_9999999 }}', // Organismo.
            ];
            @endif

            $('#budget_item_code').html(budget_item_key.join('.'));

            $('#amount').number(true, 2);

            $('.select2').select2({
                placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
                dropdownParent: $("#myModal")
            }).on('change', (e) => {

                switch ($(e.currentTarget).attr('id')) {
                    case 'budget_classifier_id':
                        budget_item_key[6] = $(e.currentTarget).find(':selected').data('code');
                        $('#name').text($.trim($.trim($(e.currentTarget).find(':selected').text()).substring(12)));
                        break;
                    case 'geographic_location_id':
                        budget_item_key[9] = $(e.currentTarget).find(':selected').data('code');
                        break;
                    case 'financing_source_id':
                        budget_item_key[10] = $(e.currentTarget).find(':selected').data('code');
                        break;
                    case 'guide_spending_id':
                        budget_item_key[8] = $(e.currentTarget).find(':selected').data('code');
                        break;
                    case 'competence_id':
                        budget_item_key[7] = $(e.currentTarget).find(':selected').data('code');
                        break;
                    case 'institution_id':
                        budget_item_key[11] = $(e.currentTarget).find(':selected').data('code');
                        break;
                }

                $('#budget_item_code').html(budget_item_key.join('.'));

                validator.element(e.currentTarget);
            });

            $('#is_public_purchase').change((e) => {
                if (!$(e.currentTarget).is(':checked')) {
                    $('#group_amount').slideDown();
                    $('#amount').rules("add", {
                        required: true,
                        min: 0
                    });
                } else {
                    $('#group_amount').slideUp();
                    $('#amount').rules("remove", 'required');
                }
            });

            $('#institution_id').change((e) => {
                if ($('#institution_id').val()) {
                    $('#div_loan_id').show();
                } else {
                    $('#div_loan_id').hide();
                }
            });

            let $form = $('#budget_item_create_fm');

            let validator = $form.validate($.extend(false, $validateDefaults, {
                rules: {
                    amount: {
                        required: true,
                        min: 0
                    },
                    loan_id: {
                        required: () => {
                            return $('#institution_id').val() > 0;
                        }
                    },
                    description: {
                        maxlength: 500,
                        required: true
                    },
                    name: {
                        required: true
                    }
                }
            }));

            let budget_tb = $('#budget_items_tb').DataTable();

            $form.ajaxForm($.extend(false, $formAjaxDefaults, {
                success: (response) => {
                    processResponse(response, null, () => {
                        $validateDefaults.rules = {};
                        $validateDefaults.messages = {};
                        $modal.modal('hide');
                        budget_tb.draw();
                    });
                }
            }));

            $('#clear_institution_id').on('click', () => {
                $('#institution_id').val(null).trigger('change');
                $('#div_loan_id').hide();
                $('#loan_id').val(null).trigger('change');
            });
        });
    </script>

@else
    @include('errors.403')
@endif