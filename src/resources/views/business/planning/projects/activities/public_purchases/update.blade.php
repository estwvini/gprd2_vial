@permission('modify.purchases.items.activities.projects.plans_management | modify.purchases.items.operational_activities.current_expenditure_elements.budget.plans_management')

@inject('PublicPurchase', '\App\Models\Business\PublicPurchase')
@inject('BudgetItem', '\App\Models\Business\BudgetItem')

<div class="modal-content" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> {{ trans('public_purchases.labels.edit') }}
        </h4>
    </div>

    <div class="clearfix"></div>
    @if(isset($activityType) && $activityType === $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)
        <form method="post" action="{{ route('update.modify.purchases.items.operational_activities.current_expenditure_elements.budget.plans_management', ['purchaseId' =>
        $purchase->id]) }}" class="form-horizontal form-label-left"
          id="public_purchase_update_fm" novalidate>
    @else
        <form method="post" action="{{ route('update.modify.purchases.items.activities.projects.plans_management', ['purchaseId' => $purchase->id]) }}" class="form-horizontal form-label-left"
              id="public_purchase_update_fm" novalidate>
    @endif

        @method('put')
        @csrf

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget_classifier_id">
                        {{ trans('public_purchases.labels.budget_item') }}
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <p class="pt-3 mb-0">{{ $purchase->budgetItem->budgetClassifier->full_code }} - {{ $purchase->budgetItem->budgetClassifier->title }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cpc_id">
                        {{ trans('public_purchases.labels.cpc') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="form-control select2" id="cpc_id" name="cpc_id" required>
                            <option value="{{ $purchase->cpc_id }}" selected>{{ $purchase->cpcClassifier->description }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="regime_type">
                        {{ trans('public_purchases.labels.regime_type') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="form-control" id="regime_type" name="regime_type" required>
                            <option value=""></option>
                            @foreach($PublicPurchase::REGIME_TYPES as $regime)
                                <option value="{{ $regime }}" @if($regime == $purchase->regime_type) selected @endif>
                                    {{ $regime }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hiring_type">
                        {{ trans('public_purchases.labels.hiring_type') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="form-control" id="hiring_type" name="hiring_type" required>
                            <option value=""></option>
                            @foreach($PublicPurchase::HIRING_TYPES as $purchaseType)
                                <option value="{{ $purchaseType }}" @if($purchaseType == $purchase->hiring_type) selected @endif>
                                    {{ $purchaseType }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group" id="normalized_group" style="display: none">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        {{ trans('public_purchases.labels.product_type') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12 mt-2">
                        {{ trans('public_purchases.labels.normalized') }}:
                        <input type="radio" class="" name="normalized" value="1" @if($purchase->procedure->normalized == 1) checked @endif/>
                        {{ trans('public_purchases.labels.not_normalized') }}:
                        <input type="radio" class="" name="normalized" value="0" @if($purchase->procedure->normalized == 0) checked @endif/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="procedure">
                        {{ trans('public_purchases.labels.procedure') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="form-control" id="procedure" name="procedure_id" required>
                            @foreach($procedures as $procedure)
                                <option value="{{ $procedure->id }}" @if($procedure->id == $purchase->procedure_id) selected @endif>
                                    {{ $procedure->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="measure_unit_id">
                        {{ trans('public_purchases.labels.measure_unit') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="form-control select2" id="measure_unit_id" name="measure_unit_id" required>
                            <option value=""></option>
                            @foreach($measureUnits as $unit)
                                <option value="{{ $unit->id }}" @if($unit->id == $purchase->measure_unit_id) selected @endif>
                                    {{ $unit->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="description">
                        {{ trans('public_purchases.labels.description') }}
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                            <textarea name="description" id="description" class="form-control"
                                      placeholder="{{ trans('public_purchases.labels.description') }}">{{ $purchase->description ?? '' }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 pt-1" for="c1">
                        {{ trans('public_purchases.labels.c1') }}
                    </label>
                    <div class="col-md-1">
                        <input type="checkbox" name="c1" id="c1" class="js-switch" @if($purchase->c1 == 'S') checked @endif/>
                    </div>

                    <label class="control-label col-md-1 pt-1" for="c2">
                        {{ trans('public_purchases.labels.c2') }}
                    </label>
                    <div class="col-md-1">
                        <input type="checkbox" name="c2" id="c2" class="js-switch" @if($purchase->c2 == 'S') checked @endif/>
                    </div>

                    <label class="control-label col-md-1 pt-1" for="c3">
                        {{ trans('public_purchases.labels.c3') }}
                    </label>
                    <div class="col-md-1">
                        <input type="checkbox" name="c3" id="c3" class="js-switch" @if($purchase->c3 == 'S') checked @endif/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_international_fund">
                        {{ trans('public_purchases.labels.international_funds') }}
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="checkbox" name="is_international_fund" id="is_international_fund" class="js-switch"
                               @if($purchase->is_international_fund) checked @endif/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quantity">
                        {{ trans('public_purchases.labels.quantity') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" name="quantity" id="quantity" class="form-control" required min="{{ $PublicPurchase::MIN_ALLOWED_VALUE }}"
                               maxlength="16" max="{{ $PublicPurchase::MAX_ALLOWED_VALUE }}" value="{{ $purchase->quantity }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apply_vat">
                        {{ trans('public_purchases.labels.apply_vat') }}
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12 mt-2">
                        <input type="checkbox" id="apply_vat" class="js-switch" @if($purchase->amount_no_vat != $purchase->amount) checked @endif/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">
                        {{ trans('public_purchases.labels.amount_vat') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="input-group">
                             <span class="input-group-addon warning">
                                <span class="fa fa-dollar"></span>
                            </span>
                            <input type="text" name="amount" id="amount" class="form-control mt-0" required value="{{ $purchase->amount }}"
                                   min="{{ $PublicPurchase::MIN_ALLOWED_VALUE }}" maxlength="16" max="{{ $PublicPurchase::MAX_ALLOWED_VALUE }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount_no_vat">
                        {{ trans('public_purchases.labels.amount_no_vat') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="input-group">
                             <span class="input-group-addon warning">
                                <span class="fa fa-dollar"></span>
                            </span>
                            <input type="text" name="amount_no_vat" id="amount_no_vat" class="form-control mt-0" value="{{ $purchase->amount_no_vat }}" required readonly>
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

        $('.select2').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
            dropdownParent: $("#myModal")
        }).on('change', (e) => {
            validator.element(e.currentTarget);
        });

        let selectProcedure = $('#procedure').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
            dropdownParent: $("#myModal")
        }).on('change', (e) => {
            {{--validator.element(e.currentTarget);--}}
            {{--$("#amount_no_vat", $form).rules('remove', 'min');--}}
            {{--$("#amount_no_vat", $form).rules('remove', 'max');--}}

            {{--if ($('#procedure').find(':selected').data('min')) {--}}
            {{--    $("#amount_no_vat", $form).rules('add', {min: $('#procedure').find(':selected').data('min')});--}}
            {{--} else {--}}
            {{--    $("#amount_no_vat", $form).rules('add', {min: '{{ $PublicPurchase::MIN_ALLOWED_VALUE }}'});--}}
            {{--}--}}

            {{--if ($('#procedure').find(':selected').data('max')) {--}}
            {{--    $("#amount_no_vat", $form).rules('add', {max: $('#procedure').find(':selected').data('max')});--}}
            {{--} else {--}}
            {{--    $("#amount_no_vat", $form).rules('add', {max: '{{ $PublicPurchase::MAX_ALLOWED_VALUE }}'});--}}
            {{--}--}}
            {{--validator.element($("#amount_no_vat", $form));--}}
        });

        $('#regime_type, #hiring_type').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
            dropdownParent: $("#myModal")
        }).on('change', (e) => {
            validator.element(e.currentTarget);

            $('#procedure').html('');
            $('#procedure').append('<option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

            if ($('#regime_type').val() === '{{ $PublicPurchase::REGIME_COMMON }}' && ($('#hiring_type').val() === '{{ $PublicPurchase::HIRING_ASSET }}'
                || $('#hiring_type').val() === '{{ $PublicPurchase::HIRING_SERVICE }}')) {

                $('#normalized_group').show();

                if ($("input[name='normalized']:checked").val()) {
                    searchProcedures();
                }
            } else {
                $('#normalized_group').hide();
                $('input[type=radio][name=normalized]').prop('checked', false);
                if ($('#regime_type').val() != 0 && $('#hiring_type').val() != 0) {
                    searchProcedures();
                }
            }
        });

        if ($('#regime_type').val() === '{{ $PublicPurchase::REGIME_COMMON }}' && ($('#hiring_type').val() === '{{ $PublicPurchase::HIRING_ASSET }}'
            || $('#hiring_type').val() === '{{ $PublicPurchase::HIRING_SERVICE }}')) {
            $('#normalized_group').show();
        } else {
            $('#normalized_group').hide();
        }

        $('input[type=radio][name=normalized]').on('change', () => {

            $('#procedure').html('');
            $('#procedure').append('<option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

            searchProcedures();
        });

        let routeProcedures;
        let routeCpc;
        @if(isset($activityType) && $activityType === $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)
            routeProcedures = '{{ route('search_procedures.purchases.items.operational_activities.current_expenditure_elements.budget.plans_management') }}';
            routeCpc = '{{ route('cpc_search.purchases.items.operational_activities.current_expenditure_elements.budget.plans_management') }}';
        @else
            routeProcedures = '{{ route('search_procedures.purchases.items.activities.projects.plans_management') }}';
            routeCpc = '{{ route('cpc_search.purchases.items.activities.projects.plans_management') }}';
        @endif

        /**
         * Buscar procedimientos de compras públicas
         */
        let searchProcedures = () => {
            pushRequest(routeProcedures, null, (response) => {
                $.each(response, (index, value) => {
                    $('#procedure').append("<option value=" + value.id + " data-min=" + value.min + " data-max=" + value.max + ">" + value.name + "</option>");
                });
                selectProcedure.select2({});
            }, 'get', {
                regime_type: $('#regime_type').val(),
                hiring_type: $('#hiring_type').val(),
                normalized: $("input[name='normalized']:checked").val()
            }, false);
        };

        $('#cpc_id').select2({
            ajax: {
                url: routeCpc,
                dataType: 'json',
                delay: 100,
                cache: true,
                data: function (params) {
                    return {
                        q: params.term,
                        itemId: '{{ $budgetItem->id }}'
                    };
                },
                processResults: (data) => {
                    return {
                        results: data
                    };
                }
            },
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
            dropdownParent: $("#myModal"),
        }).on('change', (e) => {
            validator.element(e.currentTarget);
        });

        $('#amount').number(true, 2);
        $('#amount_no_vat').number(true, 2);

        $('#amount').on('keyup', () => {
            if ($('#apply_vat').prop('checked')) {
                $('#amount_no_vat').val($('#amount').val() / parseFloat('{{ $vat }}'));
            } else {
                $('#amount_no_vat').val($('#amount').val());
            }
        });

        $('#apply_vat').on('change', () => {
            $('#amount_no_vat').keyup();
        });

        let $form = $('#public_purchase_update_fm');

        let public_purchase_tb = $('#public_purchase_tb').DataTable();

        $form.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, null, () => {
                    $validateDefaults.rules = {};
                    $validateDefaults.messages = {};
                    $modal.modal('hide');
                    public_purchase_tb.draw();

                    @if(isset($activityType) && $activityType === $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)
                    pushRequest('{{ route('load_budget_summary.current_expenditure_elements.budget.plans_management') }}', '#budget_summary', null, 'GET', {}, false)
                    @endif
                });
            }
        }));

        let validator = $form.validate($.extend(false, $validateDefaults, {
            rules: {
                description: {
                    maxlength: 200
                }
            }
        }));
    });
</script>

@else
    @include('errors.403')
    @endpermission