@permission('create.purchases.items.activities.project.programmatic_structure.execution | create.purchases.items.operational_activities.current_expenditure_elements.programmatic_structure.execution')

@inject('PublicPurchase', '\App\Models\Business\PublicPurchase')
@inject('BudgetItem', '\App\Models\Business\BudgetItem')

<div class="modal-content" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> {{ trans('public_purchases.labels.create') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    @if(isset($activityType) && $activityType === $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)
      <form method="post" action="{{ route('store.create.purchases.items.operational_activities.current_expenditure_elements.programmatic_structure.execution', ['budgetItemId' => $budgetItem->id]) }}"
           class="form-horizontal form-label-left"
          id="public_purchase_create_fm" novalidate>
    @else
      <form method="post" action="{{ route('store.create.purchases.items.activities.project.programmatic_structure.execution', ['budgetItemId' => $budgetItem->id]) }}"
            class="form-horizontal form-label-left"
            id="public_purchase_create_fm" novalidate>
    @endif

        @csrf

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget_classifier_id">
                        {{ trans('public_purchases.labels.budget_item') }}
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <p class="pt-3 mb-0">{{ $budgetItem->budgetClassifier->full_code }} - {{ $budgetItem->budgetClassifier->title }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cpc_id">
                        {{ trans('public_purchases.labels.cpc') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="form-control" id="cpc_id" name="cpc_id" required>
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
                                <option value="{{ $regime }}">
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
                                <option value="{{ $purchaseType }}">
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
                        <input type="radio" class="" name="normalized" value="1"/>
                        {{ trans('public_purchases.labels.not_normalized') }}:
                        <input type="radio" class="" name="normalized" value="0"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="procedure">
                        {{ trans('public_purchases.labels.procedure') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="form-control" id="procedure" name="procedure_id" required>
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
                                <option value="{{ $unit->id }}">
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
                                      placeholder="{{ trans('public_purchases.labels.description') }}"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_international_fund">
                        {{ trans('public_purchases.labels.international_funds') }}
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12 mt-2">
                        <input type="checkbox" name="is_international_fund" id="is_international_fund" class="js-switch"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quantity">
                        {{ trans('public_purchases.labels.quantity') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" name="quantity" id="quantity" class="form-control" required min="{{ $PublicPurchase::MIN_ALLOWED_VALUE }}"
                               maxlength="16" max="{{ $PublicPurchase::MAX_ALLOWED_VALUE }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount_no_vat">
                        {{ trans('public_purchases.labels.amount_no_vat') }}
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <label class="mt-3">$ 0 </label>
                        <i role="button" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('public_purchases.labels.publicPurchaseValueTooltip') }}"
                           class="fa fa-info-circle blue"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">
                        {{ trans('public_purchases.labels.amount_vat') }}
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <label class="mt-3">$ 0 </label>
                        <i role="button" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('public_purchases.labels.publicPurchaseValueTooltip') }}"
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
        }).on('change', (e) => {
            validator.element(e.currentTarget);
        });

        let selectProcedure = $('#procedure').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
            dropdownParent: $("#myModal")
        }).on('change', (e) => {
            validator.element(e.currentTarget);
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

        $('input[type=radio][name=normalized]').on('change', () => {
            $('#procedure').html('');
            $('#procedure').append('<option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

            searchProcedures();
        });

        let routeProcedures;
        let routeCpc;
        @if(isset($activityType) && $activityType === $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)
            routeProcedures = '{{ route('search_procedures.purchases.items.operational_activities.current_expenditure_elements.programmatic_structure.execution') }}';
            routeCpc = '{{ route('cpc_search.purchases.items.operational_activities.current_expenditure_elements.programmatic_structure.execution') }}';
        @else
            routeProcedures = '{{ route('search_procedures.purchases.items.activities.project.programmatic_structure.execution') }}';
            routeCpc = '{{ route('cpc_search.purchases.items.activities.project.programmatic_structure.execution') }}';
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

        let $form = $('#public_purchase_create_fm');

        let budget_tb = $('#budget_items_tb').DataTable();
        let public_purchase_tb = $('#public_purchase_tb').DataTable();

        $form.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, null, () => {
                    $validateDefaults.rules = {};
                    $validateDefaults.messages = {};
                    $modal.modal('hide');
                    budget_tb.draw();
                    public_purchase_tb.draw();
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