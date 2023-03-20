<div class="row">

    <div class="x_title">
        <h2>{{ trans('shape.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
            @permission('create.shape.inventory_roads')
            <div class="col-md-12">
                <a href="{{ route('create.shape.inventory_roads', ['code' => $code]) }}"
                   class="btn btn-success ajaxify pull-right">
                    <i class="fa fa-plus"></i> {{ trans('shape.labels.create') }}
                </a>
            </div>
            @endpermission
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="shape_tb">
        <thead>
        <tr>
            <th></th>
            <th>{{ trans('shape.labels.shape') }}</th>
            <th>
                {{ trans('shape.labels.is_primary') }}
                <i role="button" data-toggle="tooltip" data-placement="top"
                   data-original-title="{{ trans('shape.messages.info.is_primary') }}"
                   class="fa fa-info-circle blue"></i>
            </th>
            <th>{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#shape_tb');
        let datatable = build_datatable($table, {
            ajax: '{!! route('data.index.shape.inventory_roads', ['code' => $code, 'show' => 0]) !!}',
            columns: [
                {data: 'codigo', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'name', width: '70%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'is_primary', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ]
        }, (e) => { // on enabled switch change

            e.preventDefault();

            let confirmMessage = $(e.currentTarget).is(':checked') ? '{{ trans('shape.messages.confirm.status_on') }}' : '{{ trans('shape.messages.confirm.status_off') }}';
            let element = $(e.currentTarget);

            confirmModal(confirmMessage, () => {

                let id = element.closest('tr').attr('id');

                let url = "{!! route('update.edit.shape.inventory_roads', ['gid' => '__ID__']) !!}";
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