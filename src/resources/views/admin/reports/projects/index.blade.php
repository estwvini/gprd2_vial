@permission('index.projects.config_reports')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3> {{ trans('reports.config.projects.title') }}</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-users"></i> {{ trans('reports.config.projects.project_list') }}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped" id="users_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('reports.config.projects.full_cup') }}</th>
                            <th>{{ trans('reports.pac.project_name') }}</th>
                            <th>{{ trans('ditch.labels.estado') }}</th>
                            <th>{{ trans('app.headers.date_init') }}</th>
                            <th>{{ trans('app.headers.date_end') }}</th>
                            <th>{{ trans('projects.labels.responsibleUnit') }}</th>
                            <th>{{ trans('projects.labels.executingUnit') }}</th>
                            <th>{{ trans('projects.labels.leader') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

        var $dataTable = build_datatable($('#users_tb'), {
            ajax: '{!! route('data.index.projects.config_reports') !!}',
            columns: [
                {data: 'id', visible: false, width: '0', sortable: false, searchable: false},
                {data: 'full_cup', width: '10%', searchable: true},
                {data: 'name', width: '25%', searchable: true},
                {data: 'status', width: '10%', searchable: true, sortable: false, class: 'text-center'},
                {data: 'date_init', width: '10%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'date_end', width: '10%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'responsibleUnit', width: '10%', sortable: false, searchable: true},
                {data: 'executingUnit', width: '10%', sortable: false, searchable: true},
                {data: 'leader', width: '10%', sortable: false, searchable: true}
            ]
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission