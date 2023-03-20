@permission('get_indicator_info.link.links.plans.plans_management')
@inject('Plan', \App\Models\Business\Plan)

<div class="info_panel_container">
    <div class="x_panel" id="info_panel">
        <div class="mb-3">
            <b>{!! $route !!}</b>
        </div>

        <div class="mb-3">
            <b>{{ trans('plan_elements.labels.INDICATOR') }}:</b> {{ $indicator->name }}
        </div>

        <div class="mb-3">
            <span>{{ trans('links.messages.info.showGoal') }}</span>
            <div class="mt-3 card">
                <div class="card-header">
                    <span role="button" id="goal" class="bg-info col-lg-12 col-md-12 col-sm-12 col-xs-12" data-toggle="collapse" data-target="#goal-description"
                          aria-expanded="true" aria-controls="goal-description">
                        <i id="arrow-right" class="glyphicon glyphicon-chevron-right"></i>
                        <i id="arrow-down" class="glyphicon glyphicon-chevron-down"></i>
                        <b>{{ trans('plan_elements.labels.GOAL') }}</b>
                    </span>
                </div>

                <div id="goal-description" class="collapse" aria-labelledby="goal">
                    <div class="card-body x_panel text-justify">
                        {{ $indicator->goal_description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="plansSelector" class="mt-2 x_panel">
    <div class="mb-5">
        <h5>{{ trans('links.messages.info.selectPlan') }}</h5>
    </div>

    @if(empty($availablePlans))
        <div class="alert alert-warning align-center" role="alert">
            {{ trans('links.messages.info.noAvailablePlans') }}
        </div>
    @else
        @foreach( $availablePlans as $plan )
            <div plan-id="{{ $plan['id'] }}" class="availablePlans btn btn-default col-lg-3 col-md-3 col-sm-3 col-xs-12 ml-5 mb-5">
                @if($plan['type'] === $Plan::TYPE_SECTORAL)
                    <h1 class="align-center">{{ trans('plans.labels.' . $Plan::TYPE_SECTORAL) }}</h1>
                @else
                    <h1 class="align-center">{{ $plan['name'] }}</h1>
                @endif
                <div class="align-center col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    @if($plan['type'] === $Plan::TYPE_SECTORAL)
                        <h5>{{ $plan['name'] }}</h5>
                    @else
                        <h5>{{ trans('plans.description.' . $plan['type']) }}</h5>
                    @endif

                </div>
            </div>
        @endForeach
    @endif
</div>

<div id="loadLinks" class="mt-2 x_panel">

</div>

<script>
    $(() => {
        $('#arrow-down').hide()
        $('#loadLinks').hide()

        $('#cancelIndex').hide()
        $('#cancelLinks').show()

        $('#goal').click(() => {
            if ($('#arrow-down').is(":visible")) {
                $('#arrow-down').hide()
                $('#arrow-right').show()
            } else {
                $('#arrow-down').show()
                $('#arrow-right').hide()
            }
        })

        $('.availablePlans').each((index, element) => {
            $(element).click(() => {
                $('#plansSelector').slideUp()
                $('#backButton').attr('page', 2)
                pushRequest('{!! route('load.plan.link.links.plans.plans_management') !!}', '#loadLinks', () => {
                    $('#loadLinks').slideDown()
                }, 'GET', {
                    '_token': '{{ csrf_token() }}',
                    'indicatorId': {{ $indicator->id }},
                    'planId': $(element).attr('plan-id'),
                    'objectiveId': {{ $objectiveId }},
                    'childPlanName': '{{ $childPlanName }}'
                });

            })
        })


    })
</script>

@endpermission