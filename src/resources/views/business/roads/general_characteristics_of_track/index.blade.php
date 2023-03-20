@permission('index.inventory_roads')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('general_characteristics_of_track.title') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-automobile"></i> {{ trans('general_characteristics_of_track.title') }}
                    </h2>

                    <div class="col-md-12">
                        @permission('create.inventory_roads')
                        <a href="{{ route('create.inventory_roads') }}" class="btn btn-success ajaxify pull-right">
                            <i class="fa fa-plus"></i> {{ trans('general_characteristics_of_track.labels.create') }}
                        </a>
                        @endpermission
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped" id="budget_classifiers_tb">
                        <thead>
                        <tr>
                            <th>{{ trans('general_characteristics_of_track.labels.code') }}
                                <i role="button" data-toggle="tooltip" data-placement="top"
                                   data-original-title="{{ trans('general_characteristics_of_track.messages.info.codeInfo') }}"
                                   class="fa fa-info-circle blue"></i>
                            </th>
                            <th>{{ trans('general_characteristics_of_track.labels.province') }}</th>
                            <th>{{ trans('general_characteristics_of_track.labels.canton') }}</th>
                            <th>{{ trans('general_characteristics_of_track.labels.parish') }}</th>
                            <th>{{ trans('general_characteristics_of_track.labels.origin') }}</th>
                            <th>{{ trans('general_characteristics_of_track.labels.destiny') }}</th>
                            <th>{{ trans('general_characteristics_of_track.labels.longitude_initial') }}</th>
                            <th>{{ trans('general_characteristics_of_track.labels.longitude_finish') }}</th>
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
        let $table = $('#budget_classifiers_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.inventory_roads') !!}',
            columns: [
                {data: 'codigo', width: '10%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'prov', width: '20%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'parroquia', width: '10%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'canton', width: '10%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'origen', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'destino', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'longi', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'longf', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
