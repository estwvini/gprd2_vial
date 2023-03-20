<table class="table report-table">
    <thead>
    <tr>
        <th colspan="5"
            style="background-color: #1abb9c; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff">
            {{ trans('physical_progress.labels.date') . ' : ' . date('d/m/Y') }}
        </th>
    </tr>
    <tr>
        <th colspan="12"
            style="background-color: #FFFFFF; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff">
        </th>
        <th colspan="12"
            style="background-color: #1abb9c; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff; text-align: center;">
            {{ trans('reports.reforms_and_certifications.Budget_planning_schedule') }}
        </th>
    </tr>

    <tr>
        <th style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.name_project') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.POA_Indicator') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.POA_Goal') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.description_of_the_beneficiaries') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.beneficiary_number') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.activity_coverage') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.code_and_name_of_the_place_where_the_activity_takes_place') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.project_components') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.activities') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.budget_item') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.description_of_the_budget_line') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 20px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.total_amount') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.January') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.February') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.March') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.April') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.May') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.June') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.July') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.August') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.September') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.October') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.November') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('reports.reforms_and_certifications.December') }}</th>
    </tr>
    </thead>
    @foreach($rows['data'] as $entity)
        <tr>
            <td>{{$entity->activityProjectFiscalYear->component->project->name}} </td>
            <td></td>
            <td></td>
            <td>{{$entity->activityProjectFiscalYear->component->project->approval_criteria}} </td>
            <td></td>
            <td></td>
            <td>{{$entity->geographicLocation->getFullCode($entity->geographicLocation->code)}}
                -{{$entity->geographicLocation->description}}</td>
            <td>{{$entity->activityProjectFiscalYear->component->name}}</td>
            <td>{{$entity->activityProjectFiscalYear->name}}</td>
            <td>{{$entity->code}}</td>
            <td>{{$entity->description}}</td>
            <td>{{$entity->encoded}}</td>
            <td>{{$entity->jan}}</td>
            <td>{{$entity->feb}}</td>
            <td>{{$entity->mar}}</td>
            <td>{{$entity->apr}}</td>
            <td>{{$entity->may}}</td>
            <td>{{$entity->jun}}</td>
            <td>{{$entity->jul}}</td>
            <td>{{$entity->aug}}</td>
            <td>{{$entity->sep}}</td>
            <td>{{$entity->oct}}</td>
            <td>{{$entity->nov}}</td>
            <td>{{$entity->december}}</td>
        </tr>
    @endforeach


</table>

