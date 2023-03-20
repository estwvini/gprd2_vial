@permission('index.prioritization_templates')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('prioritization_templates.title') }}
                <small>{{ trans('app.labels.projects') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-recycle"></i> {{ trans('prioritization_templates.title') }}
                    </h2>

                    @permission('create.prioritization_templates')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.prioritization_templates') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('prioritization_templates.labels.create') }}
                            </a>
                        </li>
                    </ul>
                    @endpermission

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped" id="templates_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('prioritization_templates.labels.fiscal_year') }}</th>
                            <th>{{ trans('prioritization_templates.labels.description') }}</th>
                            <th>{{ trans('prioritization_templates.labels.status') }}</th>
                            <th>{{ trans('prioritization_templates.labels.creation_date') }}</th>
                            <th>{{ trans('app.labels.actions') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        let $table = $('#templates_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.prioritization_templates') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'fiscal_year', width: '15%', sortable: true, searchable: true},
                {data: 'description', width: '30%', sortable: false, searchable: true},
                {data: 'status', width: '20%', sortable: false, searchable: true},
                {data: 'creation_date', width: '15%', sortable: false, searchable: false},
                {data: 'actions', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
