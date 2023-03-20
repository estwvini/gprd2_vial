@permission('show.purchases.items.activities.projects_review.plans_management')

@inject('PublicPurchase', '\App\Models\Business\PublicPurchase')

<div class="modal-content" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> {{ trans('public_purchases.labels.show') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="form-horizontal form-label-left">
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
                        <select class="form-control select2 disabledInputs" id="cpc_id">
                            <option selected>{{ $purchase->cpcClassifier->description }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="regime_type">
                        {{ trans('public_purchases.labels.regime_type') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="form-control select2 disabledInputs" id="regime_type">
                            <option value="{{ $purchase->regime_type }}" selected>
                                {{ $purchase->regime_type }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hiring_type">
                        {{ trans('public_purchases.labels.hiring_type') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="form-control select2 disabledInputs" id="hiring_type">
                            <option value="{{ $purchase->hiring_type }}" selected>
                                {{ $purchase->hiring_type }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group" id="normalized_group" style="display: none">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        {{ trans('public_purchases.labels.product_type') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12 mt-2">
                        {{ trans('public_purchases.labels.normalized') }}:
                        <input type="radio" class="disabledInputs" name="normalized" value="1" @if($purchase->procedure->normalized == 1) checked @endif/>
                        {{ trans('public_purchases.labels.not_normalized') }}:
                        <input type="radio" class="disabledInputs" name="normalized" value="0" @if($purchase->procedure->normalized == 0) checked @endif/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="procedure">
                        {{ trans('public_purchases.labels.procedure') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="form-control disabledInputs" id="procedure">
                            <option selected>
                                {{ $purchase->procedure->name }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="measure_unit_id">
                        {{ trans('public_purchases.labels.measure_unit') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="form-control select2 disabledInputs" id="measure_unit_id">
                            <option selected>
                                {{ $purchase->measureUnit->name }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_international_fund">
                        {{ trans('public_purchases.labels.international_funds') }}
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="checkbox" id="is_international_fund" class="disabledInputs js-switch"
                               @if($purchase->is_international_fund) checked @endif/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount_no_vat">
                        {{ trans('public_purchases.labels.amount_no_vat') }}
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon warning">
                                <span class="fa fa-dollar"></span>
                            </span>
                            <input type="number" id="amount_no_vat" class="form-control disabledInputs" readonly value="{{ $purchase->amount }}">
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
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        $('.select2').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
            dropdownParent: $("#myModal")
        });

        $(".disabledInputs").prop('disabled', true);

        $('#amount_no_vat').number(true, 2);

        if ($('#regime_type').val() === '{{ $PublicPurchase::REGIME_COMMON }}' && ($('#hiring_type').val() === '{{ $PublicPurchase::HIRING_ASSET }}'
            || $('#hiring_type').val() === '{{ $PublicPurchase::HIRING_SERVICE }}')) {
            $('#normalized_group').show();
        } else {
            $('#normalized_group').hide();
        }

    });
</script>

@else
    @include('errors.403')
    @endpermission