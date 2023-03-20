@permission('index.reviews')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('app/reviews.title') }}
                <small>{{ trans('app.labels.app_mobil') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <table class="table" id="reviews_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('app.labels.author') }}</th>
                            <th>{{ trans('app/reviews.labels.comment') }}</th>
                            <th>{{ trans('app.labels.qualify') }}</th>
                            <th>{{ trans('app/reviews.labels.subject') }}</th>
                            <th>{{ trans('app/reviews.labels.location') }}</th>
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
        let $dataTable = build_datatable($('#reviews_tb'), {
            ajax: '{!! route('data.index.reviews') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'author', width: '15%', sortable: true, searchable: true},
                {data: 'comment', width: '30%', sortable: true, searchable: true},
                {data: 'rating', width: '10%', sortable: true, searchable: true},
                {data: 'subject', width: '20%', sortable: true, searchable: true},
                {data: 'location', width: '15%', sortable: true, searchable: true},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ],
            "fnRowCallback": (nRow, data) => {
                if (data.replies.length > 1) {
                    $(nRow).addClass("selected");
                }
            },
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission