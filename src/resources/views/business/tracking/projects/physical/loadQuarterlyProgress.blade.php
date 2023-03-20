@permission('load_quarterly_progress.physical.progress.project_tracking.execution')

@inject('ProjectFiscalYear', '\App\Models\Business\Planning\ProjectFiscalYear')

<div class="row header-schedule">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <table class="table table-bordered detail-table">
            <tbody>
            <tr>
                <td class="w-25">{{ trans('projects.labels.project') }}</td>
                <td colspan="2">{{ $project->name }}</td>
            </tr>
            <tr>
                <td class="w-25">{{ trans('projects.labels.init_date') }}</td>
                <td colspan="2">{{ $project->date_init }}</td>
            </tr>
            <tr>
                <td class="w-25">{{ trans('projects.labels.end_date') }}</td>
                <td colspan="2">{{ $project->date_end }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 text-center">
        <div class="col-md-6 col-sm-6 col-xs-6 mt-4">
            <div class="col-md-12 col-sm-12 col-xs-12 div-flex">
                <div class="p-1 div-child-flex">
                    <h1 class="m-0">{{ $projectProgress }} %</h1>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 mt-3">
                <h4>{{ trans('physical_progress.labels.currentProgress') }}</h4>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 mt-4">
            <div class="col-md-12 col-sm-12 col-xs-12 div-flex">
                <div class="pull-left p-1 div-child-flex">
                    <div class="circle_big bg_red @if($semaphore === $ProjectFiscalYear::SEMAPHORE['DELAYED']) o-1 @else o-02 @endif" data-toggle="tooltip" data-placement="top"
                         data-original-title="{{ trans('physical_progress.labels.delayed') }}"></div>
                </div>
                <div class="pull-left p-1 div-child-flex">
                    <div class="circle_big bg_orange @if($semaphore === $ProjectFiscalYear::SEMAPHORE['AT_RISK']) o-1 @else o-02 @endif" data-toggle="tooltip" data-placement="top"
                         data-original-title="{{ trans('physical_progress.labels.atRisk') }}"></div>
                </div>
                <div class="pull-left p-1 div-child-flex">
                    <div class="circle_big bg_green @if($semaphore === $ProjectFiscalYear::SEMAPHORE['ONGOING']) o-1 @else o-02 @endif" data-toggle="tooltip" data-placement="top"
                         data-original-title="{{ trans('physical_progress.labels.ongoing') }}"></div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 mt-3">
                <h4>{{ trans('physical_progress.labels.currentStatus') }}</h4>
            </div>
        </div>
    </div>
</div>
@if( $progressStructure->count() )
    <div class="row">
        @permission('export.load_quarterly_progress.physical.progress.project_tracking.execution')
        <button id="export_excel" class="btn pull-right pdf-export-button">
            <i class="fa fa-file-excel-o"></i>
            {{ trans('reports.export.excel') }}
        </button>
        @endpermission
    </div>
    <table class="schedule-table col-md-12 col-sm-12 col-xs-12">
        <thead>
        <tr>
            <th width="35%">{{ trans('physical_progress.labels.activity') }}</th>
            <th width="13%">{{ trans('physical_progress.labels.encoded') }}</th>
            <th width="13%">{{ trans('physical_progress.labels.quarter1') }}</th>
            <th width="13%">{{ trans('physical_progress.labels.quarter2') }}</th>
            <th width="13%">{{ trans('physical_progress.labels.quarter3') }}</th>
            <th width="13%">{{ trans('physical_progress.labels.quarter4') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($progressStructure as $activity)
            <tr>
                <td><strong>{{ $activity['name'] }}</strong></td>
                <td>${{ $activity['encoded'] }}</td>
                <td>{{ $activity['progress']['q1'] }} %</td>
                <td>{{ $activity['progress']['q2'] }} %</td>
                <td>{{ $activity['progress']['q3'] }} %</td>
                <td>{{ $activity['progress']['q4'] }} %</td>
            </tr>
        @endforeach
        <tr class="cumulative-row">
            <td><strong>{{ trans('physical_progress.labels.cumulative') }}</strong></td>
            <td><strong>--</strong></td>
            <td><strong>{{ number_format($cumulative['q1'], 2) }} %</strong></td>
            <td><strong>{{ number_format($cumulative['q2'], 2) }} %</strong></td>
            <td><strong>{{ number_format($cumulative['q3'], 2) }} %</strong></td>
            <td><strong>{{ number_format($cumulative['q4'], 2) }} %</strong></td>
        </tr>
        </tbody>
    </table>

    <script>
        $(() => {
            $('#export_excel').on('click', (e) => {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('export.load_quarterly_progress.physical.progress.project_tracking.execution') }}',
                    method: 'GET',
                    data: {
                        project_id: '{{ $project->id }}'
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    beforeSend: () => {
                        showLoading();
                    },
                    success: (response) => {
                        let a = document.createElement('a');
                        let url = window.URL.createObjectURL(response);
                        a.href = url;
                        a.download = '{{ trans('physical_progress.labels.file_name') }}';
                        document.body.append(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    }
                }).always(() => {
                    hideLoading();
                }).fail(function () {
                    hideLoading();
                });
            });
        });
    </script>

@else
    <div class="alert alert-warning align-center" role="alert">
        {{ trans('physical_progress.messages.warning.no_info_schedule') }}
    </div>
@endif

@else
    @include('errors.403')
    @endpermission