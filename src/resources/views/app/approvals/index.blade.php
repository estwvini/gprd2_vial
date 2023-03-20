@permission('approvals.reviews')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('app/reviews.labels.approval_title') }}
                <small>{{ trans('app.labels.app_mobil') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row mb-4">
                        <div class="form-group col-md-3">
                            <label class="control-label" for="status">
                                {{ trans('app.headers.status') }}
                            </label>
                            <input type="checkbox" name="status" id="status" class="js-switch"/>
                            {{ trans('activities.labels.approved') }}
                        </div>
                    </div>
                    <div class="row" id="bulk-actions" style="display: none;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <button id="approve_btn" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('project_review.labels.approve') }}
                            </button>
                            <span class="action-cnt"></span>
                            <script>
                                $(() => {
                                    $('#approve_btn').on('click', (e) => {
                                        e.preventDefault();
                                        let $table = $('#reviews_tb');
                                        let checked = $table.find("input[name='table_records']:checked");
                                        let ids = [];
                                        checked.each(function () {
                                            let id = $(this).closest('tr').attr('id');
                                            ids.push(id);
                                        });
                                        $('#checkbox').prop("checked", false);

                                        confirmModal("{{ trans('app/reviews.messages.confirm.approve') }}", () => {
                                            pushRequest('{!! route('approve.approvals.reviews') !!}', null, function () {
                                                $table.DataTable().draw();
                                            }, 'put', {
                                                _token: '{{ csrf_token() }}',
                                                ids: ids
                                            });
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <table class="table" id="reviews_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>
                                <input type="checkbox" id="checkbox" class="bulk check-all" title="{{ trans('app.labels.select_all') }}"/>
                            </th>
                            <th>{{ trans('app.labels.author') }}</th>
                            <th>{{ trans('app/reviews.labels.reply') }}</th>
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
            ajax: {
                url: '{!! route('data.approvals.reviews') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        status: $('input[type=checkbox][name=status]:checked').val(),
                    });
                }
            },
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'bulk_action', width: '3%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'author', width: '15%', sortable: true, searchable: true},
                {data: 'comment', width: '30%', sortable: true, searchable: true},
                {data: 'parent_comment', width: '30%', sortable: true, searchable: true},
                {data: 'rating', width: '10%', sortable: true, searchable: true},
                {data: 'subject', width: '20%', sortable: true, searchable: true},
                {data: 'location', width: '15%', sortable: true, searchable: true},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ],
            fnRowCallback: (nRow, aData) => {
                if (aData.approved === 1) {
                    $(nRow).addClass('tr-status');
                }
            },
        });
        $('#status').on('change', () => {
            $dataTable.draw();
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission