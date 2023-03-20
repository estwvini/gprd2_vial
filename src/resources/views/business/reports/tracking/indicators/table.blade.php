<table class="table report-table" id="poa_tb">
    <thead>
    <tr>
        <th colspan="1"
            style="text-align: center; background-color: #A9D08E; color: #0f0f0f; width: 20px ;height: 60px">{{ trans('indicators.labels.executing_unit') }}</th>
        <th colspan="1"
            style="text-align: center; background-color: #A9D08E; color: #0f0f0f; width: 20px ;height: 60px">{{ trans('indicators.labels.project') }}</th>
        <th colspan="1" style="text-align: center; background-color: #FFD966;
        color: #0f0f0f; width: 20px ;height: 60px">{{ trans('indicators.labels.component') }}</th>
        <th colspan="1" style="text-align: center; background-color: #FFD966;
        color: #0f0f0f; width: 20px ;height: 60px">{{ trans('indicators.labels.project_indicator') }}</th>
        <th colspan="1" style="text-align: center; background-color: #FFD966;
        color: #0f0f0f; width: 20px ;height: 60px">{{ trans('indicators.labels.planned_goal') }}</th>
        <th colspan="1" style="text-align: center; background-color: #FFD966;
        color: #0f0f0f; width: 20px ;height: 60px">{{ trans('indicators.labels.goal_executed') }}</th>
        <th colspan="1" style="text-align: center; background-color: #FFD966;
        color: #0f0f0f; width: 20px ;height: 60px">{{ trans('indicators.labels.execution_percentage') }}</th>
    </tr>
    </thead>
    @foreach($rows as $row)
        @foreach($row as $indicator)
            <tr>
                @if($indicator->indicatorable_type==\App\Models\Business\Project::class)
                    <td colspan="1">{{$indicator->indicatorable->executingUnit->name}}</td>
                    <td colspan="1">{{$indicator->indicatorable->name}}</td>
                    <td colspan="1"></td>
                @else
                    <td colspan="1">{{$indicator->indicatorable->project->executingUnit->name}}</td>
                    <td colspan="1">{{$indicator->indicatorable->project->name}}</td>
                    <td colspan="1">{{$indicator->indicatorable->name}}</td>
                @endif
                <td colspan="1">{{$indicator->name}}</td>
                <td colspan="1">{{$indicator->goalValue}}</td>
                <td colspan="1">{{$indicator->actualValue}}</td>
                @if($indicator->actualValue>0 && $indicator->goal>0 )
                    <td colspan="1">{{number_format(($indicator->percentage), 2)}}</td>
                @else
                    <td colspan="1">0</td>
                @endif
            </tr>
        @endforeach
    @endforeach
</table>