@permission('index.main_shape')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('main_shape.title') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-automobile"></i> {{ trans('main_shape.title') }}
                    </h2>

                    <div class="col-md-12">
                        @permission('create.main_shape')
                        <a href="{{ route('create.main_shape') }}"
                           class="btn btn-success ajaxify pull-right">
                            <i class="fa fa-plus"></i> {{ trans('main_shape.labels.create') }}
                        </a>
                        @endpermission
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped" id="budget_classifiers_tb">
                        <thead>
                        <tr>
                            <th>{{ trans('main_shape.labels.name') }}</th>
                            <th>{{ trans('main_shape.labels.date') }}</th>
                            <th>{{ trans('main_shape.labels.user') }}</th>                           
                            <th>
                                {{ trans('main_shape.labels.is_primary') }}
                                <i role="button" data-toggle="tooltip" data-placement="top"
                                   data-original-title="{{ trans('main_shape.messages.info.is_primary') }}"
                                   class="fa fa-info-circle blue"></i>
                            </th>                            
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
        let datatable = build_datatable($table, {
            ajax: '{!! route('data.index.main_shape') !!}',
            columns: [
                {data: 'name', width: '40%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'fecha', width: '15%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'usuario', width: '15%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'is_primary', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ]
        }, (e) => { // on enabled switch change

            e.preventDefault();

            let confirmMessage = $(e.currentTarget).is(':checked') ? '{{ trans('main_shape.messages.confirm.status_on') }}' : '{{ trans('main_shape.messages.confirm.status_off') }}';
            let element = $(e.currentTarget);

            confirmModal(confirmMessage, () => {

                let id = element.closest('tr').attr('id');

                let url = "{!! route('update.edit.main_shape', ['id' => '__ID__']) !!}";
                url = url.replace('__ID__', id);

                pushRequest(url, null, () => {
                    datatable.draw();
                }, 'POST', {
                    _token: '{{ csrf_token() }}',
                    is_primary: $(e.currentTarget).is(':checked') ? 0 : 1
                });
            });
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
