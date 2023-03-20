<table class="table report-table" id="tracking_project_tb">
    <thead>
    <tr>
        <th colspan="17" style="background-color: #1abb9c; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff">
            {{ trans('budget_project_tracking.title') . ': ' . $projectName }}
        </th>
    </tr>
    <tr>
        <th colspan="17" style="background-color: #1abb9c; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff">
            {{ trans('budget_project_tracking.labels.budget_execution_up') . ' ' . $date }}
        </th>
    </tr>
    <tr>
        <th rowspan="2"
            style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.activity') }}</th>
        <th rowspan="2"
            style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.budget_item') }}</th>
        <th rowspan="2"
            style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.encoded') }}</th>
        <th rowspan="2"
            style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.accrued') }}</th>
        <th rowspan="2"
            style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.budget_execution') }}</th>
        <th colspan="12" style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.accrued')
         }}</th>
    </tr>
    <tr>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.jan') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.feb') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.mar') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.apr') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.may') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.jun') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.jul') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.aug') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.sep') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.oct') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.nov') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.dec') }}</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($rows))
        @foreach($rows as $row)
            <tr>
                <td>{{ $row->activity }}</td>
                <td>{!! $row->budget_item !!}</td>
                <td>{{ $row->encoded }}</td>
                <td>{{ $row->accrued_aggregated }}</td>
                <td>{{ $row->budget_execution }}</td>
                <td>{{ $row->jan_accrued }}</td>
                <td>{{ $row->feb_accrued }}</td>
                <td>{{ $row->mar_accrued }}</td>
                <td>{{ $row->apr_accrued }}</td>
                <td>{{ $row->may_accrued }}</td>
                <td>{{ $row->jun_accrued }}</td>
                <td>{{ $row->jul_accrued }}</td>
                <td>{{ $row->aug_accrued }}</td>
                <td>{{ $row->sep_accrued }}</td>
                <td>{{ $row->oct_accrued }}</td>
                <td>{{ $row->nov_accrued }}</td>
                <td>{{ $row->dec_accrued }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>