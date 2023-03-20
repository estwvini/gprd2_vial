@php use Carbon\Carbon; @endphp
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-key"></i> {{ trans('app.labels.change_fiscal_year_modal') }}</h4>
    </div>

    <form id="change_fiscal_year_fm" class="form-horizontal" role="form" method="POST"
          action="{{ route('update.change_fiscal_year.users') }}" autocomplete="off" novalidate>

        @csrf
        <input type="hidden" name="year" value="on">

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="planning">
                            {{ trans('app.labels.fiscal_year_planning') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <select name="planning" id="planning" class="form-control">
                                <option value=""></option>
                                @foreach($fiscalYearPlan as $year)
                                    <option value="{{ $year->year }}"
                                            @if((session()->has('fiscalYearPlanning') && session()->get('fiscalYearPlanning') == $year->year)
                                            || ($year->year == Carbon::now()->addYear()->year)) selected @endif> {{ $year->year }} </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="execution">
                            {{ trans('app.labels.fiscal_year_execution') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <select name="execution" id="execution" class="form-control">
                                <option value=""></option>
                                @foreach($fiscalYearExec as $year)
                                    <option value="{{ $year->year }}" @if((session()->has('fiscalYearExecution')
                                    && session()->get('fiscalYearExecution') == $year->year)
                                    || ($year->year == Carbon::now()->year)) selected @endif> {{ $year->year }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-info ajaxify" data-dismiss="modal"> {{ trans('app.labels.cancel') }}</button>
            <button type="submit" class="btn btn-success"> {{ trans('app.labels.accept') }}</button>
        </div>
    </form>
</div>

<script>
    $(function () {
        var $form = $('#change_fiscal_year_fm');

        $validateDefaults.rules = {
            planning: {
                required: true
            },
            execution: {
                required: true
            }
        };

        $.validator.prototype.ruleValidationStatus = function (element) {
            element = $(element)[0];
            let rules = $(element).rules();
            let errors = {};
            for (let method in rules) {
                let rule = {method: method, parameters: rules[method]};
                try {
                    var result = $.validator.methods[method].call(this, element.value.replace(/\r/g, ""), element, rule.parameters);

                    errors[rule.method] = result;

                } catch (e) {
                    console.log(e);
                }
            }
            return errors;
        };

        $form.ajaxForm({
            beforeSubmit: function () {
                showLoading();
            },
            success: function (response) {
                processResponse(response, null, function () {
                    $('.no-passwd', $modal).removeClass('no-passwd');
                    $modal.removeAttr('data-backdrop');
                    $modal.removeAttr('data-keyboard');
                    $modal.modal('hide');
                });
            },
            error: function (param1, param2, param3) {
                notify(param3, 'error', 'Error!');
            },
            complete: function () {
                hideLoading();
            }
        });
    })
    ;
</script>
