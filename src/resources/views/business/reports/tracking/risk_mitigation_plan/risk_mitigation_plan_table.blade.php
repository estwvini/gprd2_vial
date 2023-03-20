<table class="table report-table" id="poa_tb">
    <thead>
    <tr>
        <th colspan="20"
            style="text-align: center; background-color: #B3B3B3; font-weight: bold; font-size: 18px; height: 30px">{{ trans('reports.risk_mitigation_plan.title') }}</th>
    </tr>
    <tr>
        <th colspan="20"></th>
    </tr>
    <tr>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.risk_mitigation_plan.full_cup') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.risk_mitigation_plan.project_name') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.risk_mitigation_plan.responsibleUnit') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.risk_mitigation_plan.general_risk') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.risk_mitigation_plan.project_purpose') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.risk_mitigation_plan.project_assumption') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.risk_mitigation_plan.component') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.risk_mitigation_plan.component_assumption') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.risk_mitigation_plan.indicators') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.risk_mitigation_plan.goals') }}</th>
    </tr>
    </thead>
    @foreach($rows as $entity)
        <tr>
            <td colspan="2" style="height: 100px">{{ $entity->project->full_cup }}</td>
            <td colspan="2" style="height: 100px">{{ $entity->project->name }}</td>
            <td colspan="2" style="height: 100px">{{ $entity->responsibleUnit }}</td>
            <td colspan="2" style="height: 100px">{{ $entity->project->general_risks }}</td>
            <td colspan="2" style="height: 100px">{{ $entity->project->purpose }}</td>
            <td colspan="2" style="height: 100px">{{ $entity->project->assumptions }}</td>
            <td colspan="2" style="height: 100px">{{ $entity->name }}</td>
            <td colspan="2" style="height: 100px">{{ $entity->assumptions }}</td>
            <td colspan="2" style="height: 100px">{{ $entity->indicator_name }}</td>
            <td colspan="2" style="height: 100px">{{ $entity->goal_description }}</td>
        </tr>
    @endforeach
</table>