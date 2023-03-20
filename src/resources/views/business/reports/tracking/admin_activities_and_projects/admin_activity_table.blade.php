<table class="table table-striped" id="admin_activities_tb">
    <thead>
    <tr>
        <th></th>
        <th>{{ trans('reports.project_admin_activities.admin.activity_name') }}</th>
        <th>{{ trans('reports.project_admin_activities.admin.assigned') }}</th>
        <th>{{ trans('reports.project_admin_activities.admin.date_init') }}</th>
        <th>{{ trans('reports.project_admin_activities.admin.date_end') }}</th>
        <th>{{ trans('reports.project_admin_activities.admin.status') }}</th>
        <th>{{ trans('reports.project_admin_activities.admin.attachment') }}</th>
        <th>{{ trans('reports.project_admin_activities.admin.description') }}</th>
    </tr>
    </thead>
</table>

<script>
    $(function () {
        build_datatable($('#admin_activities_tb'), {
            dom: '<l<t>ipr>',
            lengthMenu: [50, 75, 100],
            ajax: {
                url: '{!! route('data_admin_activity.index.project_admin_activities.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "filters": {
                            responsible_unit_id: $('#responsible_unit_id').val(),
                            assigned_user_id: $('#assigned_user_id').val(),
                            fiscal_year_id: '{{ $currentYearId }}',
                            date_init: $('#date_init').val(),
                            date_end: $('#date_end').val()
                        }
                    });
                }
            },
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'name', width: '30%'},
                {data: 'assigned_user_id', width: '10%'},
                {data: 'date_init', width: '10%', class: 'text-center'},
                {data: 'date_end', width: '10%', class: 'text-center'},
                {data: 'status', width: '5%'},
                {data: 'attachments', width: '5%'},
                {data: 'description', width: '30%'}
            ]
        });
    });
</script>