<table>
    <thead>
    <tr>
        <th colspan="5"
            style="background-color: #1abb9c; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff">
            {{ trans('physical_progress.labels.date') . ' : ' . date('d/m/Y') }}
        </th>
    </tr>
    <tr>
        <th colspan="9"
            style="background-color: #FFFFFF; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff">
        </th>
        <th colspan="7"
            style="background-color: #1abb9c; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff; text-align: center;">
            {{ trans('reports.reforms_and_certifications.Schedule_of_activities') }}
        </th>
    </tr>
    <tr>
        <th style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.name_project') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.POA_Indicator') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.POA_Goal') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.description_of_the_beneficiaries') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.beneficiary_number') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.activity_coverage') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.code_and_name_of_the_place_where_the_activity_takes_place') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.project_components') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.activities') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.task') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.milestones') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.start_date') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.end_date') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.duration_days') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.importance') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.Weighing') }}</th>
    </tr>
    </thead>
    @foreach($rows['activities'] as $task)

        <tr>
            <th>{{ $task->activityProjectFiscalYear->component->project->name }}</th>
            <th></th>
            <th></th>
            <th>{{ $task->activityProjectFiscalYear->component->project->approval_criteria }}</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>{{ $task->activityProjectFiscalYear->code }}-{{ $task->activityProjectFiscalYear->name }} </th>
            @if($task->type== \App\Models\Business\Task::ELEMENT_TYPE['TASK'] )
                <th>{{ $task->name }}</th>
                <th></th>
            @else
                <th></th>
                <th>{{ $task->name }}</th>
            @endif
            <th>{{ $task->date_init }}</th>
            <th>{{ $task->date_end }}</th>
            <th>{{ $task->duration }}</th>
            <th>{{ $task->activityProjectFiscalYear->relevance }}</th>
            <th>{{ $task->weight_percentage }}</th>
        </tr>
    @endforeach
</table>

