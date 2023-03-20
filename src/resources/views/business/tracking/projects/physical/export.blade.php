<table>
    <thead>
    <tr>
        <th colspan="10" style="text-align: center; background-color: #296CA5; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff">
            {{ $name }}
        </th>
    </tr>
    <tr>
        <th style="width: 400px; font-weight: bold; background-color: #296CA5; color: #ffffff">{{ trans('app.headers.name') }}</th>
        <th style="width: 200px; font-weight: bold; background-color: #296CA5; color: #ffffff">{{ trans('activities.labels.responsible') }}</th>
        <th style="width: 100px; font-weight: bold; background-color: #296CA5; color: #ffffff">{{ trans('physical_progress.labels.encoded') }}</th>
        <th style="width: 100px; font-weight: bold; background-color: #296CA5; color: #ffffff">{{ trans('physical_progress.labels.startDate') }}</th>
        <th style="width: 100px; font-weight: bold; background-color: #296CA5; color: #ffffff">{{ trans('physical_progress.labels.endDate') }}</th>
        <th style="width: 100px; font-weight: bold; background-color: #296CA5; color: #ffffff">{{ trans('physical_progress.labels.dueDate') }}</th>
        <th style="width: 100px; font-weight: bold; background-color: #296CA5; color: #ffffff">{{ trans('physical_progress.labels.attachmentDate') }}</th>
        <th style="width: 100px; font-weight: bold; background-color: #296CA5; color: #ffffff">{{ trans('physical_progress.labels.weight') }}</th>
        <th style="width: 100px; font-weight: bold; background-color: #296CA5; color: #ffffff">{{ trans('physical_progress.labels.progress') }}</th>
        <th style="width: 100px; font-weight: bold; background-color: #296CA5; color: #ffffff">{{ trans('physical_progress.labels.semaphore') }}</th>
    </tr>
    </thead>

    @foreach($rows as $component)
        @if(isset($component['children']) && $component['children']->count())
            <tr>
                <td colspan="10" style="background-color: #6AA1C4; color: #ffffff; font-weight: bold">{{ $component['name'] }}</td>
            </tr>
            @foreach($component['children'] as $activity)
                <tr>
                    <td style="background-color: lightblue; font-weight: bold">
                        {{ $activity['name'] }}
                    </td>
                    <td style="background-color: lightblue; font-weight: bold">
                        {{ $activity['responsible']->fullName() }}
                    </td>
                    <td style="background-color: lightblue; font-weight: bold">
                        {{ $activity['encoded'] }}
                    </td>
                    <td style="background-color: lightblue; font-weight: bold">
                        {{ $activity['date_init'] }}
                    </td>
                    <td style="background-color: lightblue; font-weight: bold">
                        {{ $activity['date_end'] }}
                    </td>
                    <td style="background-color: lightblue; font-weight: bold">
                        {{ $activity['due_date'] }}
                    </td>
                    <td style="background-color: lightblue; font-weight: bold">
                        {{ $activity['attachment_date'] }}
                    </td>
                    <td style="background-color: lightblue; font-weight: bold">
                        {{ $activity['weight'] }}
                    </td>
                    <td style="background-color: lightblue; font-weight: bold">
                        {{ $activity['c_progress'] }}
                    </td>
                    <td style="background-color: lightblue; font-weight: bold">
                        {{ trans('physical_progress.labels.activityStatus.' . $activity['semaphore']) }}
                    </td>
                </tr>
                @foreach($activity['children'] as $task)
                    <tr>
                        <td>
                            {{ $task['name'] }}
                        </td>
                        <td>
                            {{ $task['responsible']->fullName() }}
                        </td>
                        <td>
                            {{ $task['encoded'] }}
                        </td>
                        <td>
                            {{ $task['date_init'] }}
                        </td>
                        <td>
                            {{ $task['date_end'] }}
                        </td>
                        <td>
                            {{ $task['due_date'] ?? '' }}
                        </td>
                        <td>
                            {{ $task['attachment_date'] ?? '' }}
                        </td>
                        <td>
                            {{ $task['weight'] }}
                        </td>
                        <td>
                            {{ $task['c_progress'] }}
                        </td>
                        <td>
                            {{ trans('physical_progress.labels.activityStatus.' . $task['semaphore']) }}
                        </td>
                    </tr>
                @endforeach
            @endforeach
        @endif
    @endforeach

</table>

