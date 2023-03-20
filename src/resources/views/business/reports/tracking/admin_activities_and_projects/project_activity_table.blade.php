<table class="table table-striped" id="project_activities_tb">
    <thead>
    <tr>
        <th></th>
        <th>{{ trans('reports.project_admin_activities.project.project_name') }}</th>
        <th>{{ trans('reports.project_admin_activities.project.activity_name') }}</th>
        <th>{{ trans('reports.project_admin_activities.project.assigned') }}</th>
        <th>{{ trans('reports.project_admin_activities.project.progress_date') }}</th>
        <th>{{ trans('reports.project_admin_activities.project.attachment') }}</th>
        <th>{{ trans('reports.project_admin_activities.project.description') }}</th>
    </tr>
    </thead>
</table>

<script>
    $(function () {
        build_datatable($('#project_activities_tb'), {
            dom: '<l<t>ipr>',
            lengthMenu: [50, 75, 100],
            ajax: {
                url: '{!! route('data_project_activity.index.project_admin_activities.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "filters": {
                            responsible_unit_id: $('#responsible_unit_id').val(),
                            assigned_user_id: $('#assigned_user_id').val(),
                            fiscal_year_id: '{{ $currentYearId }}',
                            project_fiscal_year_id: $('#project_fiscal_year_id').val(),
                            date_init: $('#date_init').val(),
                            date_end: $('#date_end').val()
                        }
                    });
                }
            },
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'project_name', width: '20%'},
                {data: 'name', width: '30%'},
                {data: 'responsible', width: '10%'},
                {data: 'due_date', width: '5%', class: 'text-center'},
                {data: 'attachments', width: '5%'},
                {data: 'description', width: '30%'}
            ]
        });
    });
</script>