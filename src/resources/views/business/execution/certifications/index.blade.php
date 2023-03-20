<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('certifications.title') }}</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
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
                                url: '{!! route('data.index.certifications.execution') !!}',
                                "data": (d) => {
                                    return $.extend({}, d, {
                                        status: ['{{ \App\Models\Business\Certification::STATUS_TO_REVIEW }}','{{ \App\Models\Business\Certification::STATUS_APPROVED }}'],
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
                            let url = '{{ route('show_poa.certifications.execution', ['id' => '__ID__']) }}'
                            url = url.replace('__ID__', data['id']);
                            pushRequest(url);
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</div>
