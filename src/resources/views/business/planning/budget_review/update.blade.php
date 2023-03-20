@inject('BudgetItem', '\App\Models\Business\BudgetItem')

<div class="modal-content" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> {{ trans('budget_item.labels.edit') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <form method="post" action="{{ route('update.edit.budget_review.plans_management', ['budgetItem' => $budgetItem->id]) }}" class="form-horizontal form-label-left"
          id="budget_item_update_fm" novalidate>

        @method('put')
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

                            @if($budgetItem->operationalActivity)
                                <tr>
                                    <td>{{ trans('budget_item.labels.area') }}</td>
                                    <td>@isset($budgetItem->operationalActivity->subprogram->parent->area) {{ $budgetItem->operationalActivity->subprogram->parent->area->code }} @endisset</td>
                                    <td>@isset($budgetItem->operationalActivity->subprogram->parent->area) {{ $budgetItem->operationalActivity->subprogram->parent->area->area }} @endisset</td>
                                </tr>

                                <tr>
                                    <td>{{ trans('budget_item.labels.program') }}</td>
                                    <td>@isset($budgetItem->operationalActivity->subprogram->parent) {{ $budgetItem->operationalActivity->subprogram->parent->code }} @endisset</td>
                                    <td>@isset($budgetItem->operationalActivity->subprogram->parent) {{ $budgetItem->operationalActivity->subprogram->parent->name }} @endisset</td>
                                </tr>

                                <tr>
                                    <td>{{ trans('budget_item.labels.sub_program') }}</td>
                                    <td>@isset($budgetItem->operationalActivity->subprogram) {{ $budgetItem->operationalActivity->subprogram->code }} @endisset</td>
                                    <td>@isset($budgetItem->operationalActivity->subprogram) {{ $budgetItem->operationalActivity->subprogram->name }} @endisset</td>
                                </tr>

                                <tr>
                                    <td>{{ trans('budget_item.labels.project') }}</td>
                                    <td>{{ trans('budget_item.labels.tbd_code') }}</td>
                                    <td>{{ trans('budget_item.labels.tbd_description') }}</td>
                                </tr>

                                <tr>
                                    <td>{{ trans('budget_item.labels.executingUnit') }}</td>
                                    <td>@isset($budgetItem->operationalActivity->executingUnit) {{ $budgetItem->operationalActivity->executingUnit->code }} @endisset</td>
                                    <td>@isset($budgetItem->operationalActivity->executingUnit) {{ $budgetItem->operationalActivity->executingUnit->name }} @endisset</td>
                                </tr>

                                <tr>
                                    <td>{{ trans('budget_item.labels.activity') }}</td>
                                    <td>{{ $budgetItem->operationalActivity->code }}</td>
                                    <td>{{ $budgetItem->operationalActivity->name }}</td>
                                </tr>

                            @else
                                <tr>
                                    <td>{{ trans('budget_item.labels.area') }}</td>
                                    <td>@isset($budgetItem->activityProjectFiscalYear->area) {{ $budgetItem->activityProjectFiscalYear->area->code }} @endisset</td>
                                    <td>@isset($budgetItem->activityProjectFiscalYear->area) {{ $budgetItem->activityProjectFiscalYear->area->area }} @endisset</td>
                                </tr>

                                <tr>
                                    <td>{{ trans('budget_item.labels.program') }}</td>
                                    <td>
                                        @isset($budgetItem->activityProjectFiscalYear->component->project->subprogram)
                                            {{ $budgetItem->activityProjectFiscalYear->component->project->subprogram->parent->code }}
                                        @endisset
                                    </td>
                                    <td>@isset($budgetItem->activityProjectFiscalYear->component->project->subprogram) {{ $budgetItem->activityProjectFiscalYear->component->project->subprogram->parent->description }} @endisset</td>
                                </tr>

                                <tr>
                                    <td>{{ trans('budget_item.labels.sub_program') }}</td>
                                    <td>@isset($budgetItem->activityProjectFiscalYear->component->project->subProgram) {{ $budgetItem->activityProjectFiscalYear->component->project->subProgram->code }} @endisset</td>
                                    <td>@isset($budgetItem->activityProjectFiscalYear->component->project->subProgram) {{ $budgetItem->activityProjectFiscalYear->component->project->subProgram->description }} @endisset</td>
                                </tr>

                                <tr>
                                    <td>{{ trans('budget_item.labels.project') }}</td>
                                    <td>@isset($budgetItem->activityProjectFiscalYear->component->project) {{ $budgetItem->activityProjectFiscalYear->component->project->cup }} @endisset</td>
                                    <td>@isset($budgetItem->activityProjectFiscalYear->component->project) {{ $budgetItem->activityProjectFiscalYear->component->project->name}} @endisset</td>
                                </tr>

                                <tr>
                                    <td>{{ trans('budget_item.labels.executingUnit') }}</td>
                                    <td>@isset($budgetItem->activityProjectFiscalYear->component->project->executingUnit) {{ $budgetItem->activityProjectFiscalYear->component->project->executingUnit->code }} @endisset</td>
                                    <td>@isset($budgetItem->activityProjectFiscalYear->component->project->executingUnit) {{ $budgetItem->activityProjectFiscalYear->component->project->executingUnit->name }} @endisset</td>
                                </tr>

                                <tr>
                                    <td>{{ trans('budget_item.labels.activity') }}</td>
                                    <td>{{ $budgetItem->activityProjectFiscalYear->code }}</td>
                                    <td>{{ $budgetItem->activityProjectFiscalYear->name }}</td>
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
                    <div class="col-md-9 col-xs-12">
                            <textarea name="description" id="description" class="form-control"
                                      placeholder="{{ trans('budget_item.labels.description') }}">{{ $budgetItem->description ?? '' }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget_classifier_id">
                        {{ trans('budget_item.labels.budget_item') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-9 col-xs-12">
                        <select class="form-control select2" id="budget_classifier_id" name="budget_classifier_id" required>
                            <option value=""></option>
                            @foreach($budgetClassifier as $item)
                                <option value="{{ $item->id }}" data-code="{{ $item->full_code }}" @if($item->id == $budgetItem->budget_classifier_id) selected @endif>
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
                    <div class="col-md-9 col-xs-12">
                        <textarea name="name" id="name" class="form-control"
                                  placeholder="{{ trans('budget_item.labels.name_default') }}">{{ $budgetItem->name }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="geographic_location_id">
                        {{ trans('budget_item.labels.geographic') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-9 col-xs-12">
                        <select class="form-control select2" id="geographic_location_id" name="geographic_location_id" required>
                            <option value=""></option>
                            @foreach($geographicLocations as $location)
                                <option value="{{ $location->id }}" data-code="{{ $location->getFullCode() }}"
                                        @if($location->id == $budgetItem->geographic_location_id) selected @endif>
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
                    <div class="col-md-9 col-xs-12">
                        <select class="form-control select2" id="financing_source_id" name="financing_source_id" required>
                            <option value=""></option>
                            @foreach($financingSources as $source)
                                <option value="{{ $source->id }}" data-code="{{ $source->code }}"
                                        @if($budgetItem->financing_source_id && $source->id == $budgetItem->financing_source_id) selected @endif>
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
                    <div class="col-md-9 col-xs-12">
                        <select class="form-control select2" id="guide_spending_id" name="guide_spending_id" required>
                            <option value=""></option>
                            @foreach($guideSpendings as $guideSpending)
                                <option value="{{ $guideSpending->id }}" data-code="{{ $guideSpending->full_code }}"
                                        @if($budgetItem->guide_spending_id && $guideSpending->id == $budgetItem->guide_spending_id) selected @endif>
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
                    <div class="col-md-9 col-xs-12">
                        <select class="form-control select2" id="competence_id" name="competence_id" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($competences as $value)
                                <option value="{{ $value->id }}" data-code="{{ $value->code }}"
                                        @if($budgetItem->competence_id && $value->id == $budgetItem->competence_id) selected @endif>
                                    {{ $value->code }}-{{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="institution_id">
                        {{ trans('budget_item.labels.institution') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-9 col-xs-12">
                        <select class="form-control select2" id="institution_id" name="institution_id" data-width="100%" required>
                            <option value=""></option>
                            @foreach($institutions as $institution)
                                <option value="{{ $institution->id }}" @if($institution->id == $budgetItem->institution_id) selected @endif
                                data-code="{{ $institution->cleanCode() }}">
                                    {{ $institution->code }} - {{ $institution->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="loan_id">
                        {{ trans('budget_item.labels.loan') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-9 col-xs-12">
                        <select class="form-control select2" id="loan_id" name="loan_id">
                            <option value=""></option>
                            @foreach($loans as $loan)
                                <option value="{{ $loan->id }}" @if($loan->id == $budgetItem->loan_id) selected @endif>
                                    {{ $loan->full_code }} - {{ $loan->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_participatory_budget">
                        {{ trans('budget_item.labels.participatory_budget') }}
                    </label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="checkbox" name="is_participatory_budget" id="is_participatory_budget" class="js-switch"
                               @if($budgetItem->is_participatory_budget) checked @endif/>
                    </div>

                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_public_purchase">
                        {{ trans('budget_item.labels.public_purchase') }}
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        @if($budgetItem->publicPurchases->count())
                            <input type="checkbox" class="js-switch" id="is_public_purchase" checked disabled/>
                            <input type="hidden" name="is_public_purchase" value="on">
                        @else
                            <input type="checkbox" name="is_public_purchase" id="is_public_purchase" class="js-switch"
                                   @if($budgetItem->is_public_purchase) checked @endif/>
                        @endif
                    </div>
                </div>

                <div class="form-group group_amount">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">
                        {{ trans('budget_item.labels.amount') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-9 col-xs-12">
                        <div class="input-group">
                             <span class="input-group-addon warning">
                                <span class="fa fa-dollar"></span>
                            </span>
                            <input type="text" name="amount" id="amount" class="form-control mt-0" value="{{ $budgetItem->amount }}" max="{{ $BudgetItem::MAX_ALLOWED_VALUE }}"
                                   maxlength="16">
                        </div>
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
        @if($budgetItem->operationalActivity)
            budget_item_key = [
            @if($budgetItem->operationalActivity->subprogram->parent->area)'{{ $budgetItem->operationalActivity->subprogram->parent->area->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Área
            @if($budgetItem->operationalActivity->subprogram->parent)'{{ $budgetItem->operationalActivity->subprogram->parent->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Prog
            @if($budgetItem->operationalActivity->subprogram)'{{ $budgetItem->operationalActivity->subprogram->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Subp
            '{{ $BudgetItem::CODE_999 }}', // Proy
            @if($budgetItem->operationalActivity->executingUnit)'{{ $budgetItem->operationalActivity->executingUnit->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // UE
            @if($budgetItem->operationalActivity)'{{ $budgetItem->operationalActivity->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Act
            '{{ $budgetItem->budgetClassifier->full_code }}', // Nat.Grup.Subg.Ítem
            '{{ $BudgetItem::FUN }}', // Competencia
            '{{ $budgetItem->spendingGuide ? $budgetItem->spendingGuide->full_code : $BudgetItem::CODE_999999}}', // OG.DG.CAT.SUB
            '{{ $budgetItem->geographicLocation->getFullCode() }}', // Prov.Cant.Parr
            '{{ $budgetItem->source ? $budgetItem->source->code : $BudgetItem::CODE_000 }}', // Código fuente.
            '{{ $budgetItem->institution ? $budgetItem->institution->cleanCode() : $BudgetItem::CODE_9999999 }}', // Organismo.
        ];
        @else
            budget_item_key = [
            @if($budgetItem->activityProjectFiscalYear->area)'{{ $budgetItem->activityProjectFiscalYear->area->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Área
            @if($budgetItem->activityProjectFiscalYear->component->project->subprogram)'{{ $budgetItem->activityProjectFiscalYear->component->project->subprogram->parent->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Prog
            @if($budgetItem->activityProjectFiscalYear->component->project->subprogram)'{{ $budgetItem->activityProjectFiscalYear->component->project->subprogram->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Subp
            @if($budgetItem->activityProjectFiscalYear->component->project)'{{ $budgetItem->activityProjectFiscalYear->component->project->cup }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // Proy
            @if($budgetItem->activityProjectFiscalYear->component->project->executingUnit)'{{ $budgetItem->activityProjectFiscalYear->component->project->executingUnit->code }}', @else '{{ $BudgetItem::CODE_00 }}', @endif // UE
            @if($budgetItem->activityProjectFiscalYear)'{{ $budgetItem->activityProjectFiscalYear->code }}', @else '{{ $BudgetItem::CODE_000 }}', @endif // Act
            '{{ $budgetItem->budgetClassifier->full_code }}', // Nat.Grup.Subg.Ítem
            @if($budgetItem->competence)'{{ $budgetItem->competence->code }}', @else '{{ $BudgetItem::FUN }}', @endif // Competencia
            '{{ $budgetItem->spendingGuide ? $budgetItem->spendingGuide->full_code : $BudgetItem::CODE_999999}}', // OG.DG.CAT.SUB
            '{{ $budgetItem->geographicLocation->getFullCode() }}', // Prov.Cant.Parr
            '{{ $budgetItem->source ? $budgetItem->source->code : $BudgetItem::CODE_000 }}', // Código fuente.
            '{{ $budgetItem->institution ? $budgetItem->institution->cleanCode() : $BudgetItem::CODE_9999999 }}', // Organismo.
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

        let $form = $('#budget_item_update_fm');

        let validator = $form.validate($.extend(false, $validateDefaults, {
            rules: {
                amount: {
                    required: true,
                    min: 0
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

        let budget_tb = $('#item_tb').DataTable();

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
    });
</script>