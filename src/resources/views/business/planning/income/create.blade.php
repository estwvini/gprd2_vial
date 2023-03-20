@permission('create.income.budget.plans_management|create.income.programmatic_structure.execution')
@inject('Income', '\App\Models\Business\Planning\Income')

<div id="myModal" class="modal-content">
    <div class="modal-header">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h2><i class="fa fa-dollar"></i> {{ trans('income.labels.new') }}</h2>
        </div>
        <div class="col-md-1 col-sm-1 col-xs-1">
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <button type="button" class="close mt-2" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div class="mt-5">
        <form role="form" action="{{ $routes['store'] }}" method="post"
              class="form-horizontal form-label-left" id="income_create_fm" novalidate>

            @csrf

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget_classifier_id">
                    {{ trans('income.labels.budgetClassifier') }} <span class="text-danger">*</span>
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <select class="form-control" id="budget_classifier_id" name="budget_classifier_id">
                        <option value=""></option>
                        @foreach($budgetClassifiers as $budgetClassifier)
                            <option value="{{ $budgetClassifier->id }}">{{ $budgetClassifier->full_code }} - {{ $budgetClassifier->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="financing_source_id">
                    {{ trans('income.labels.financingSource') }} <span class="text-danger">*</span>
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <select class="form-control" id="financing_source_id" name="financing_source_id">
                        <option value=""></option>
                        @foreach($financingSources as $financingSource)
                            <option value="{{ $financingSource->id }}">{{ $financingSource->code }} - {{ $financingSource->description }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="distributor_code">
                    {{ trans('income.labels.distributor') }} <span class="text-danger">*</span>
                </label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" name="distributor_code" id="distributor_code" maxlength="2" autocomplete="off" class="form-control"
                           placeholder="{{ trans('income.labels.code') }}"/>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" name="distributor_name" id="distributor_name" maxlength="200" autocomplete="off" class="form-control"
                           placeholder="{{ trans('income.labels.distributor_name') }}"/>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="institution_id">
                    {{ trans('income.labels.institution') }} <span class="text-danger">*</span>
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <select class="form-control" id="institution_id" name="institution_id" required>
                        <option value=""></option>
                        @foreach($institutions as $institution)
                            <option value="{{ $institution->id }}">{{ $institution->code }} - {{ $institution->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="loan_id">
                    {{ trans('income.labels.loan') }}
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <div class="input-group">
                        <select class="form-control select2" id="loan_id" name="loan_id">
                            <option value=""></option>
                            @foreach($loans as $loan)
                                <option value="{{ $loan->id }}">{{ $loan->full_code }} - {{ $loan->title }}</option>
                            @endforeach
                        </select>
                        <span class="input-group-addon clear-selection"
                              data-toggle="tooltip"
                              data-placement="right"
                              data-original-title="{{ trans('app.labels.clear_selection') }}">
                        <span class="glyphicon glyphicon-erase"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="justification">
                    {{ trans('income.labels.justification') }}
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <textarea type="text" name="justification" id="justification" class="form-control col-md-7 col-sm-7 col-xs-12" rows="4" maxlength="500"></textarea>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="legal_base">
                    {{ trans('income.labels.legalBase') }}
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <textarea type="text" name="legal_base" id="legal_base" class="form-control col-md-7 col-sm-7 col-xs-12" rows="4" maxlength="500"></textarea>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value">
                    {{ trans('income.labels.value') }} @if($module === $Income::MODULE['BUDGET'])
                        <span class="text-danger">*</span>
                    @endif
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    @if($module === $Income::MODULE['BUDGET'])
                        <div class="input-group">
                             <span class="input-group-addon warning">
                                <span class="fa fa-dollar"></span>
                            </span>
                            <input type="text" name="value" id="value" maxlength="16" autocomplete="off"
                                   class="form-control col-md-7 col-sm-7 col-xs-12 mt-0"/>
                        </div>
                    @else
                        <label class="mt-3">$ 0 </label>
                        <i role="button" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('income.labels.incomeValueTooltip') }}"
                           class="fa fa-info-circle blue"></i>
                    @endif
                </div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.save') }}</button>
            </div>

        </form>
    </div>
</div>

<script>
    $(() => {

        let $form = $('#income_create_fm');

        $('#value').number(true, 2);
        $('#value').on('focusin', (e) => {
            $(e.currentTarget).attr('maxlength', 16)
        });

        $validateDefaults.rules = {
            budget_classifier_id: {
                required: true
            },
            financing_source_id: {
                required: true,
            },
            institution_id: {
                required: true,
            },
            value: {
                required: true,
                min: 0,
                max: {{ $Income::MAX_ALLOWED_VALUE }}
            },
            distributor_code: {
                required: true,
                minlength: 2,
                maxlength: 2
            },
            distributor_name: {
                required: true,
                maxlength: 200
            }
        };

        $validateDefaults.messages = {
            value: {
                max: '{{ trans('income.messages.validation.max_value') }}'
            }
        };

        let validator = $form.validate($.extend(false, $validateDefaults));

        $('#budget_classifier_id').select2({
            placeholder: '{{ trans('income.labels.selectBudgetClassifier') }}',
            dropdownParent: $("#myModal")
        });

        $('#financing_source_id').select2({
            placeholder: '{{ trans('income.labels.selectFinancingSource') }}',
            dropdownParent: $("#myModal")
        });

        $('#institution_id').select2({
            placeholder: '{{ trans('income.labels.selectInstitution') }}',
            dropdownParent: $("#myModal")
        });

        $('#loan_id').select2({
            placeholder: '{{ trans('income.labels.selectLoan') }}',
            dropdownParent: $("#myModal")
        });

        $('select').on('change', (e) => {
            validator.element(e.currentTarget);
        });

        // Initialize clear selection buttons
        $('.input-group').each((index, element) => {
            let criterionSelect = $(element).find('select');
            let criterionClearButton = $(element).find('span.input-group-addon');

            criterionClearButton.on('click', () => {
                criterionSelect.val(null).trigger('change')
            })
        });

        let datatable = $('#incomes_tb').DataTable();

        $form.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, null, () => {
                    $validateDefaults.rules = {};
                    $validateDefaults.messages = {};
                    $modal.modal('hide');
                    datatable.draw();
                });
            }
        }));
    });
</script>

@else
    @include('errors.403')
    @endpermission
