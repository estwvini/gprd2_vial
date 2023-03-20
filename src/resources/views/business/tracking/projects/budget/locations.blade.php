<div class="modal-content" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> {{ trans('budget_item.labels.budget_locations') }}
        </h4>
    </div>
    <div class="modal-body">
        <table class="table table-bordered detail-table">
            <tbody>
            <tr>
                <td class="w-20">{{ trans('budget_item.labels.name') }}</td>
                <td class="fs-l">{{ $item->name }}</td>
            </tr>
            <tr>
                <td class="w-20">{{ trans('budget_item.labels.code') }}</td>
                <td class="fs-l">{{ $item->code }}</td>
            </tr>
            <tr>
                <td class="w-20">{{ trans('budget_project_tracking.labels.accrued') }}</td>
                <td class="fs-l">{{ number_format($item->total_accrued, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2" class="w-20 bg-grey">{{ trans('budget_item.labels.budget_locations') }}</td>
            </tr>
            @forelse($item->budgetByLocation() as $location)
                <tr>
                    <td class="w-20">{{ $location['location'] }}</td>
                    <td class="fs-l">{{ $location['amount'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="w-20 text-center text-danger">{{ trans('budget_project_tracking.messages.info.empty') }}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        @if(($item->total_accrued - $item->total_budget_location) > 0)
            <form method="post" action="{{ route('store.location.budget.progress.project_tracking.execution', ['id' => $item->id]) }}"
                  class="form-horizontal form-label-left"
                  id="budget_item_locations_fm" novalidate>

                @csrf

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location_id">
                        {{ trans('budget_item.labels.geographic') }} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-9 col-xs-12">
                        <select class="form-control select2" id="location_id" name="location_id" required>
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
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="description">
                        {{ trans('budget_item.labels.description') }}
                    </label>
                    <div class="col-md-9 col-xs-12">
                            <textarea name="description" id="description" class="form-control"
                                      placeholder="{{ trans('budget_item.labels.description') }}"></textarea>
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
                            <input type="text" name="amount" id="amount" class="form-control mt-0" min="{{ \App\Models\Business\BudgetItem::MIN_ALLOWED_VALUE }}"
                                   maxlength="16"
                                   max="{{ $max }}">
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div class="text-center text-success">
                <h4>{{ trans('budget_project_tracking.messages.info.total') }}</h4>
                <h3><i class="fa fa-dollar"></i> {{ number_format($item->total_budget_location, 2) }}</h3>
            </div>
        @endif
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">
            <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
        </button>
        @if(($item->total_accrued - $item->total_budget_location) > 0)
            <button type="submit" class="btn btn-success" id="btn_submit">
                <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
            </button>
        @endif
    </div>
</div>

<script>
    $(() => {


        $('#amount').number(true, 2);

        $('.select2').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
            dropdownParent: $("#myModal")
        });

        let $form = $('#budget_item_locations_fm');

        $form.validate($.extend(false, $validateDefaults, {
            rules: {
                amount: {
                    required: true,
                    min: 0,
                    max: {{ $max }}
                }
            }
        }));

        let budget_tb = $('#tracking_project_tb').DataTable();

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

        $("#btn_submit").click(function () {
            $form.submit(); // Submit the form
        });
    });
</script>
