<div class="x_panel shadow">
    <div class="x_title">
        <h2 class="text-primary"><i class="fa fa-line-chart"></i>
            {{ trans('staff_meetings.labels.projects_status') }}
        </h2>
        <ul class="nav navbar-right panel_toolbox">
            <li style="float: right"><a class="collapse-link"><i style="color: #808285 !important;" class="fa fa-chevron-up"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h4>{{ trans('staff_meetings.labels.physical_progress') }}</h4>
                <div class="pie" style="--percentage:{{ $physicalProgress }};--main-color:#a56dd9; --w: 110px"> {{ $physicalProgress }}%</div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h4>{{ trans('staff_meetings.labels.budget_progress') }}</h4>
                <div class="pie" style="--percentage:{{ $budgetProgress }};--main-color:#15b943; --w: 110px"> {{ $budgetProgress }}%</div>
            </div>
        </div>
        @foreach($projects as $proj)
            <h4>{{ $proj->project->name }}</h4>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-6 text-center">
                    <div>
                        <span class="fw-b">{{ trans('staff_meetings.labels.physic') }}</span>
                    </div>
                    <div class="pie"
                         style="--percentage:{{ $proj->getProgress() }};--main-color:#a56dd9; --w: 50px; --border-thickness: 2px; --fs: 15px">{{ $proj->getProgress() }}%
                    </div>
                </div>
                <div class="col-md-4 col-sm-3 col-xs-6 text-center">
                    <div>
                        <span class="fw-b">{{ trans('staff_meetings.labels.budget') }}</span>
                    </div>
                    <div class="pie"
                         style="--percentage:{{ $proj->budgetProgress }};--main-color:#15b943;--w: 50px; --border-thickness: 2px; --fs: 15px">{{ $proj->budgetProgress }}%
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div>
                        <span class="fw-b">{{ trans('staff_meetings.labels.tasks') }}</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="circle bg_green m-0" style="border: 0"></div>
                        <span class="ml-3 fw-b">{{ trans('staff_meetings.labels.completed') }}:</span>
                        <span class="ml-3 fw-b">{{ $proj->getCompletedTasksCount() }}</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="circle bg_orange m-0" style="border: 0;"></div>
                        <span class="ml-3 fw-b">{{ trans('staff_meetings.labels.in_progress') }}:</span>
                        <span class="ml-3 fw-b">{{ $proj->getReviewTasksCount() }}</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="circle bg_red m-0" style="border: 0;"></div>
                        <span class="ml-3 fw-b">{{ trans('staff_meetings.labels.delayed') }}:</span>
                        <span class="ml-3 fw-b">{{ $proj->getDelayedTasksCount() }}</span>
                    </div>
                </div>
            </div>
            <div class="ln_solid"></div>
        @endforeach
    </div>
</div>

<script>
    $(() => {

    });
</script>