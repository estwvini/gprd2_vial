@permission('index.faqs')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('app/faqs.title') }}
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
                        <i class="fa fa fa-tasks"></i> {{ trans('app/faqs.labels.list') }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.faqs') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('app.labels.create') }}
                            </a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped" id="faqs_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('app/faqs.labels.title') }}</th>
                            <th>{{ trans('app.headers.description') }}</th>
                            <th>{{ trans('app/faqs.labels.publish') }}</th>
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
        let $dataTable = build_datatable($('#faqs_tb'), {
            ajax: '{!! route('data.index.faqs') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'title', width: '20%', sortable: true, searchable: true},
                {data: 'description', width: '60%', sortable: true, searchable: true},
                {data: 'publish', width: '10%', sortable: false, searchable: false},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        }, function (e) { // on enabled switch change

            e.preventDefault();

            let confirmMessage = $(this).is(':checked') ? '{!! trans('app/faqs.messages.confirm.publish_on')  !!}' : '{!! trans('app/faqs.messages.confirm.publish_off')  !!}';

            let element = $(this);

            confirmModal(confirmMessage, function () {

                let id = element.closest('tr').attr('id');

                let url = "{!! route('publish.faqs', ['faq' => '__ID__']) !!}";
                url = url.replace('__ID__', id);

                pushRequest(url, null, function () {
                    $dataTable.draw();
                }, 'put', {
                    _token: '{{ csrf_token() }}'
                });
            });
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
