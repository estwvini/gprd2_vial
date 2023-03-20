@permission('index.subjects')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('app/subjects.title') }}
                <small>{{ trans('app.labels.app_mobil') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa fa-cubes"></i> {{ trans('app/subjects.labels.list') }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.subjects') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('app.labels.create') }}
                            </a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped" id="subjects_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('app.headers.name') }}</th>
                            <th>{{ trans('app.labels.responsible') }}</th>
                            <th></th>
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
        let $dataTable = build_datatable($('#subjects_tb'), {
            ajax: '{!! route('data.index.subjects') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'name', width: '60%', sortable: true, searchable: true},
                {data: 'responsible_id', width: '30%', sortable: true, searchable: true},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission