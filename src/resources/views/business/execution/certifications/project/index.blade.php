<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <ul class="nav navbar-right panel_toolbox">
            <li class="pull-right">
                <a href="{{ route('create.projects.certifications.execution', ['projectId' => $projectId]) }}"
                   class="btn btn-box-tool ajaxify">
                    <i class="fa fa-plus"></i> {{ trans('certifications.labels.create') }}
                </a>
            </li>
        </ul>
        <table class="table click" id="certification_tb">
            <thead>
            <tr>
                <th></th>
                <th>{{ trans('certifications.labels.number') }}</th>
                <th>{{ trans('projects.labels.project') }}</th>
                <th>{{ trans('activities.labels.activity') }}</th>
                <th>{{ trans('app.headers.name') }}</th>
                <th>{{ trans('certifications.labels.topic') }}</th>
                <th>{{ trans('app.labels.date') }}</th>
                <th>{{ trans('certifications.labels.status') }}</th>
            </tr>
            </thead>
        </table>

        <script>
            $(() => {
                let $table = build_datatable($('#certification_tb'), {
                    ajax: {
                        url: '{!! route('data.index.projects.certifications.execution') !!}',
                        "data": (d) => {
                            return $.extend({}, d, {
                                project_id: '{{ $projectId ?? '' }}',
                            });
                        }
                    },
                    columns: [
                        {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                        {data: 'number', width: '10%', class: 'text-center', searchable: true},
                        {
                            data: 'project',
                            name: 'activity->projectFiscalYear->project->name',
                            width: '20%',
                            searchable: true
                        },
                        {data: 'activity', name: 'activity.name', width: '15%', searchable: true},
                        {data: 'name', width: '10%', searchable: true},
                        {data: 'topic', width: '20%', searchable: true},
                        {data: 'created_at', width: '10%', class: 'text-center', searchable: true},
                        {data: 'status', width: '10%', class: 'text-center', searchable: false},
                    ]
                });
                $('#certification_tb tbody').on('click', 'tr', (e) => {
                    let data = $table.row(e.currentTarget).data();
                    let url = '{{ route('edit.projects.certifications.execution', ['id' => '__ID__']) }}';
                    console.log(data['editable'])
                    if (!data['editable']) {
                        url = '{{ route('show.projects.certifications.execution', ['id' => '__ID__']) }}';
                    }
                    url = url.replace('__ID__', data['id']);
                    pushRequest(url);
                });
            });
        </script>
    </div>
</div>