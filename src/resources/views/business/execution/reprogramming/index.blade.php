@permission('index.reprogramming.reforms_reprogramming.execution')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('reprogramming.title') }}
                <small>{{ trans('app.labels.execution') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    @if(!$checkPEI)
        <div class="alert alert-warning align-center" role="alert">
            {{ trans('indicator_tracking.messages.validations.noApprovedPEI') }}
        </div>
    @else
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            <i class="fa fa-refresh"></i> {{ trans('reprogramming.labels.list') }}
                        </h2>

                        @permission('create.reprogramming.reforms_reprogramming.execution')
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right">
                                <a href="{{ route('create.reprogramming.reforms_reprogramming.execution') }}" class="btn btn-box-tool ajaxify">
                                    <i class="fa fa-plus"></i> {{ trans('reprogramming.labels.create') }}
                                </a>
                            </li>
                        </ul>
                        @endpermission

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped" id="reprogramming_tb">
                            <thead>
                            <tr>
                                <th></th>
                                <th>{{ trans('reprogramming.labels.document') }}</th>
                                <th>{{ trans('app.headers.description') }}</th>
                                <th>{{ trans('reprogramming.labels.project') }}</th>
                                <th>{{ trans('app.headers.status') }}</th>
                                <th>{{ trans('reprogramming.labels.created_at') }}</th>
                                <th>{{ trans('reprogramming.labels.approved_at') }}</th>
                                <th>{{ trans('projects.labels.actions') }}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@if($checkPEI)
    <script>
        $(() => {
            let $table = $('#reprogramming_tb');
            build_datatable($table, {
                ajax: '{!! route('data.index.reprogramming.reforms_reprogramming.execution') !!}',
                columns: [
                    {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                    {data: 'code', width: '5%', class: 'text-center'},
                    {data: 'description', width: '40%'},
                    {data: 'project', name: 'projectFiscalYear.project.name', width: '20%'},
                    {data: 'status', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                    {data: 'created_at', width: '10%', class: 'text-center'},
                    {data: 'approved_date', width: '10%', class: 'text-center'},
                    {data: 'actions', width: '15%', sortable: false, searchable: false, class: 'text-center'}
                ]
            });
        });
    </script>
@endif

@else
    @include('errors.403')
    @endpermission
