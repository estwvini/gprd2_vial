<table class="table report-table">
    <thead>
    <tr>
        <th colspan="6" style="text-align: center; background-color: #B3B3B3; font-weight: bold; font-size: 18px; height: 30px">{{ trans('reports.project_admin_activities.title')
        }}</th>
    </tr>
    <tr>
        <th colspan="6"></th>
    </tr>
    <tr>
        <th style="background-color: #B3B3B3; font-weight: bold;">{{trans('reports.project_admin_activities.responsible_unit')}}</th>
        <th colspan="5">{{ $responsibleUnit ?? '' }}</th>
    </tr>
    <tr>
        <th style="background-color: #B3B3B3; font-weight: bold;">{{trans('reports.project_admin_activities.project.project_name')}}</th>
        <th colspan="5">{{ $project ?? '' }}</th>
    </tr>
    <tr>
        <th style="background-color: #B3B3B3; font-weight: bold;">{{trans('reports.project_admin_activities.admin.assigned')}}</th>
        <th colspan="5">{{ $responsible ?? '' }}</th>
    </tr>
    <tr>
        <th style="background-color: #B3B3B3; font-weight: bold;">{{trans('app.labels.date')}}</th>
        <th colspan="5">{{ now()->format('d-m-Y') }}</th>
    </tr>
    <tr>
        <th colspan="6"></th>
    </tr>
    <tr>
        <th style="background-color: #B3B3B3; font-weight: bold; text-align: center;" colspan="6">{{ trans('reports.project_admin_activities.projects_inv') }}</th>
    </tr>
    <tr>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px">{{ trans('reports.project_admin_activities.project.project_name') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px">{{ trans('reports.project_admin_activities.project.activity_name') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px">{{ trans('reports.project_admin_activities.project.assigned') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px">{{ trans('reports.project_admin_activities.project.progress_date') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px">{{ trans('reports.project_admin_activities.project.attachment') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px">{{ trans('reports.project_admin_activities.project.description') }}</th>
    </tr>
    </thead>
    @foreach($projects as $row)
        <tr>
            <td>{{ $row->project_name }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->responsible }}</td>
            <td>{{ $row->due_date }}</td>
            <td>{!! $row->attachments !!}</td>
            <td>{{ $row->description }}</td>

        </tr>
    @endforeach
</table>

<table class="table report-table">
    <thead>
    <tr>
        <th colspan="6"></th>
    </tr>
    <tr>
        <th colspan="6"></th>
    </tr>
    <tr>
        <th style="background-color: #B3B3B3; font-weight: bold; text-align: center;" colspan="6">{{ trans('reports.project_admin_activities.admin.activity_table_title') }}</th>
    </tr>
    <tr>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px">{{ trans('reports.project_admin_activities.admin.activity_name') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px">{{ trans('reports.project_admin_activities.admin.assigned') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px">{{ trans('reports.project_admin_activities.admin.updated_at') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px">{{ trans('reports.project_admin_activities.admin.status') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px">{{ trans('reports.project_admin_activities.admin.attachment') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px">{{ trans('reports.project_admin_activities.admin.description') }}</th>
    </tr>
    </thead>

    @foreach($activities as $row)
        <tr>
            <td>{!! $row->name !!}</td>
            <td>{{ $row->assigned_user_id }}</td>
            <td>{{ $row->updated_at }}</td>
            <td>{!! $row->status !!}</td>
            <td>{!! $row->attachments !!}</td>
            <td>{{ $row->description }}</td>
        </tr>
    @endforeach
</table>