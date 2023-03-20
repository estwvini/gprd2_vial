@permission('index.sectoral.tracking')
<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>
                {{ trans('plans.title_sectoral_tracking') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    @if($plans->count())
        <div id="sectoralPlans" class="x_title">
            <div class="row">
                <div class="form-horizontal">
                    <div class="col-md-5 col-sm-5 col-xs-5">
                        <label class="col-sm-4 control-label text-right" for="sectoralPlanId">
                            {{ trans('plans.labels.sectorial_plan') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <select class="form-control" name="sectoralPlanId" id="sectoralPlanId">
                                <option></option>
                                @foreach($plans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div id="objectives" class="x_content"></div>
    @else
        <div class="alert alert-warning align-center" role="alert">
            {{ trans('plans.messages.exceptions.plans_not_found') }}
        </div>
    @endif
</div>

<script>
    $(() => {
        let sectoralPlanSelect = $('#sectoralPlanId');
        sectoralPlanSelect.select2({
            placeholder: '{{ trans('plans.placeholders.selectPlan') }}'
        });

        sectoralPlanSelect.on('change', () => {
            let url = '{{ route('data.index.sectoral.tracking') }}';
            pushRequest(url, $('#objectives'), () => {
            }, null, {
                id: sectoralPlanSelect.val()
            });
        });
    });
</script>
@else
    @include('errors.403')
    @endpermission
