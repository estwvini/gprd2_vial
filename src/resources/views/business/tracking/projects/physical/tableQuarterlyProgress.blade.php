<table class="table report-table">
    <thead>
    <tr>
        <th colspan="5" style="background-color: #1abb9c; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff">
            {{ trans('physical_progress.labels.quarterlyProgress') . ': ' . $project->name }}
        </th>
    </tr>
    <tr>
        <th colspan="5" style="background-color: #1abb9c; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff">
            {{ trans('physical_progress.labels.date') . ' : ' . date('d/m/Y') }}
        </th>
    </tr>
    <tr>
        <th style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('physical_progress.labels.activity') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('physical_progress.labels.quarter1') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('physical_progress.labels.quarter2') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('physical_progress.labels.quarter3') }}</th>
        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('physical_progress.labels.quarter4') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($progressStructure as $activity)
        <tr>
            <td>{{ $activity['name'] }}</td>
            <td>{{ $activity['progress']['q1'] }} %</td>
            <td>{{ $activity['progress']['q2'] }} %</td>
            <td>{{ $activity['progress']['q3'] }} %</td>
            <td>{{ $activity['progress']['q4'] }} %</td>
        </tr>
    @endforeach
    <tr>
        <td style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('physical_progress.labels.cumulative') }}</td>
        <td style="text-align: center; background-color: #1abb9c; color: #ffffff; font-weight: bold">{{ number_format($cumulative['q1'], 2) }} %</td>
        <td style="text-align: center; background-color: #1abb9c; color: #ffffff; font-weight: bold">{{ number_format($cumulative['q2'], 2) }} %</td>
        <td style="text-align: center; background-color: #1abb9c; color: #ffffff; font-weight: bold">{{ number_format($cumulative['q3'], 2) }} %</td>
        <td style="text-align: center; background-color: #1abb9c; color: #ffffff; font-weight: bold">{{ number_format($cumulative['q4'], 2) }} %</td>
    </tr>
    </tbody>
</table>