@for ($i = 0; $i < $years + 1; $i++)
    <div class="item form-group">
        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="budgets">
            {{ trans('projects.labels.year') }} {{ isset($annualBudgets[$i]) ? $annualBudgets[$i]['year'] : ($i + 1) }} <span class="required
            text-danger">*</span>
        </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
            @if(!$inProgress || (isset($annualBudgets[$i]) && $annualBudgets[$i]['year'] > currentFiscalYear()->year))
                <div class="input-group">
                    <span class="input-group-addon warning">
                        <span class="fa fa-dollar"></span>
                     </span>
                    <input type="text" name="budgets[{{ $i }}]" id="budgets[{{ $i }}]" maxlength="16"
                           class="form-control col-md-7 col-sm-7 col-xs-12 mt-0" min="0"
                           value="{{ isset($annualBudgets[$i]) ? $annualBudgets[$i]['pivot']['referential_budget'] : (isset($values[$i]) ? $values[$i] : '') }}"
                    />
                </div>
            @else
                <label class="mt-2">$ {{ isset($annualBudgets[$i]) ? $annualBudgets[$i]['pivot']['referential_budget'] : (isset($values[$i]) ? $values[$i] : '') }}</label>
            @endif
        </div>
    </div>
@endfor

@for ($i = $years + 1; $i < $newYears + $years + 1; $i++)
    <div class="item form-group">
        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="budgets">
            {{ trans('projects.labels.year') }} {{ ($i + 1) }} <span class="required text-danger">*</span>
        </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="input-group">
                <span class="input-group-addon warning">
                    <span class="fa fa-dollar"></span>
                 </span>
                <input type="text" name="budgets[{{ $i }}]" id="budgets[{{ $i }}]" maxlength="16"
                       class="form-control col-md-7 col-sm-7 col-xs-12 mt-0" min="0"
                       value="{{ isset($values[$i]) ? $values[$i] : '' }}"
                />
            </div>
        </div>
    </div>
@endfor