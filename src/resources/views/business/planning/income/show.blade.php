@permission('show.income.budget.plans_management|show.income.programmatic_structure.execution')
<div id="myModal" class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-dollar"></i> {{ trans('income.labels.detail') }}
        </h4>
    </div>

    <div class="mt-5">
        <form role="form" action="" method=""
              class="form-horizontal form-label-left" id="income_show_fm" novalidate>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget_classifier_id">
                    {{ trans('income.labels.budgetClassifier') }}
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <select class="form-control" id="budget_classifier_id" name="budget_classifier_id" disabled>

                        @if($entity->budget_classifier)
                            <option value="">{{ $entity->budget_classifier->full_code }} - {{ $entity->budget_classifier->title }}</option>
                        @else
                            <option value=""></option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="financing_source_id">
                    {{ trans('income.labels.financingSource') }}
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <select class="form-control" id="financing_source_id" name="financing_source_id" disabled>
                        @if($entity->financing_source)
                            <option value="">{{ $entity->financing_source->code }} - {{ $entity->financing_source->description }}</option>
                        @else
                            <option value=""></option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="distributor_code">
                    {{ trans('income.labels.distributor') }} <span class="text-danger">*</span>
                </label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="distributor_code" disabled class="form-control"
                           placeholder="{{ trans('income.labels.code') }}" value="{{ $entity->distributor_code }}"/>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" id="distributor_name" disabled class="form-control"
                           placeholder="{{ trans('income.labels.distributor_name') }}" value="{{ $entity->distributor_name }}"/>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="institution_id">
                    {{ trans('income.labels.institution') }}
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <select class="form-control" id="institution_id" name="institution_id" disabled>
                        @if($entity->institution)
                            <option value="">{{ $entity->institution->code }} - {{ $entity->institution->name }}</option>
                        @else
                            <option value=""></option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="loan_id">
                    {{ trans('income.labels.loan') }}
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <select class="form-control" id="loan_id" name="loan_id" disabled>
                        @if($entity->loan)
                            <option value="">{{ $entity->loan->full_code }} - {{ $entity->loan->title }}</option>
                        @else
                            <option value=""></option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="justification">
                    {{ trans('income.labels.justification') }}
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                            <textarea type="text" name="justification" id="justification"
                                      class="form-control col-md-7 col-sm-7 col-xs-12" rows="4" maxlength="500" disabled>{{ $entity->justification }}</textarea>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="legal_base">
                    {{ trans('income.labels.legalBase') }}
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                            <textarea type="text" name="legal_base" id="legal_base"
                                      class="form-control col-md-7 col-sm-7 col-xs-12" rows="4" maxlength="500" disabled>{{ $entity->legal_base }}</textarea>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value">
                    {{ trans('income.labels.value') }}
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <div class="input-group">
                         <span class="input-group-addon warning">
                                <span class="fa fa-dollar"></span>
                            </span>
                        <input type="text" name="value" id="value"
                               class="form-control col-md-7 col-sm-7 col-xs-12" value="{{ $entity->value }}" disabled/>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('app.labels.close') }}</button>
            </div>

        </form>
    </div>
</div>

<script>
    $(() => {
        $('#value').number(true, 2)

        $('#institution_id').select2({
            placeholder: '{{ trans('income.labels.selectInstitution') }}',
            dropdownParent: $("#myModal")
        })

        $('#loan_id').select2({
            placeholder: '{{ trans('income.labels.selectLoan') }}',
            dropdownParent: $("#myModal")
        })

    });
</script>

@else
    @include('errors.403')
    @endpermission