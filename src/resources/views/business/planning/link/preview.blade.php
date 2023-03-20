@permission('preview.link.links.plans.plans_management')

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-link"></i> {{ trans('links.title') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <div class="x_title dashboard-title">
                <h2 class="align-center">{{ $childPlanName }}</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_panel info_panel_container">
                <div class="mb-3">
                    <b>{!! $route !!}</b>
                </div>

                <div class="mb-3">
                    <b>{{ trans('plan_elements.labels.INDICATOR') }}:</b> {{ $childIndicator->name }}
                </div>

                <div class="mb-3">
                    <span>{{ trans('links.messages.info.showGoal') }}</span>
                    <div class="mt-3 card">
                        <div class="card-header bg-info">
                            <span role="button" id="modal-goal" class="bg-info col-lg-12 col-md-12 col-sm-12 col-xs-12" data-toggle="collapse" data-target="#modal-goal-description" aria-expanded="true"
                                  aria-controls="modal-goal-description">
                                <i id="modal-arrow-right" class="glyphicon glyphicon-chevron-right"></i>
                                <i id="modal-arrow-down" class="glyphicon glyphicon-chevron-down"></i>
                                <b>{{ trans('plan_elements.labels.GOAL') }}</b>
                            </span>
                        </div>

                        <div id="modal-goal-description" class="collapse" aria-labelledby="goal">
                            <div class="card-body x_panel text-justify">
                                {{ $childIndicator->goal_description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="x_panel">
                <div class="x_title">
                    <h2 class="align-center">{{ trans('links.labels.links') }}</h2>

                    <div class="clearfix"></div>
                </div>
                <table class="table table-striped" id="links_tb">
                </table>
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"> {{ trans('app.labels.accept') }}</button>
    </div>
</div>

<script>
    $(() => {
        $('#modal-arrow-down').hide()

        $('#modal-goal').unbind('click');
        $('#modal-goal').click(() => {
            if ($('#modal-arrow-down').is(":visible")) {
                $('#modal-arrow-down').hide()
                $('#modal-arrow-right').show()
            } else {
                $('#modal-arrow-down').show()
                $('#modal-arrow-right').hide()
            }
        })

        build_datatable($('#links_tb'), {
            pageLength: 5,
            ordering: false,
            info: false,
            bLengthChange: false,
            ajax: '{!! route('loadtable.preview.link.links.plans.plans_management', ['parentIndicators' => $parentIndicators]) !!}',
            columns: [
                {data: 'id', visible: false, width: '0', sortable: false, searchable: false},
                {title: '{{ trans('links.labels.plan') }}', data: 'plan_name', width: '10%', searchable: true},
                {title: '{{ trans('links.labels.thrust') }}', data: 'thrust_code', width: '8%', searchable: false},
                {title: '{{ trans('links.labels.objective') }}', data: 'objective_code', width: '8%', searchable: false},
                {title: '{{ trans('links.labels.indicator') }}', data: 'name', width: '10%', searchable: true},
                {title: '{{ trans('links.labels.goal') }}', data: 'goal_description', width: '35%', searchable: true},
            ]
        }, (e) => {
            e.preventDefault();
        });
    })
</script>

@else
    @include('errors.403')
    @endpermission