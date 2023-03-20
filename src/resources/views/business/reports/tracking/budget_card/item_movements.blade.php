@permission('account.budget_card.reports')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('app.labels.reports') }}</h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                <li>
                    <a class="ajaxify" href="{{ route('budget_card.reports') }}"> {{ trans('reports.budget_card.title') }}</a>
                </li>
                <li class="active"> {{ trans('reports.budget_card.movements.title') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel mb-15">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-list-alt"></i> {{ trans('reports.budget_card.movements.title') }}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content mb-15">
                    <div class="row">
                        <div class="col-md-12 text-center fw-b mb-2" style="color: #00537f; font-size: larger;">
                            {{ trim($account->cuenta) }} - {{ strtoupper($account->nom_cue) }}
                        </div>
                    </div>
                    <table class="table report-table" id="budget_items_movements">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('reports.budget_card.movements.date') }}</th>
                            <th>{{ trans('reports.budget_card.movements.voucher') }}</th>
                            <th>{{ trans('reports.budget_card.movements.description') }}</th>
                            <th>{{ trans('reports.budget_card.assigned') }}</th>
                            <th>{{ trans('reports.budget_card.reform') }}</th>
                            <th>{{ trans('reports.budget_card.encoded') }}</th>
                            <th>{{ trans('reports.budget_card.committed') }}</th>
                            <th>{{ trans('reports.budget_card.accrued') }}</th>
                            <th>{{ trans('reports.budget_card.by_committed') }}</th>
                            <th>{{ trans('reports.budget_card.by_accrued') }}</th>
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
        let datatable = build_datatable($('#budget_items_movements'), {
            dom: '<t>ir',
            ajax: {
                url: '{!! route('data.account.budget_card.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        year: '{{ $year }}',
                        account: '{{ trim($account->cuenta) }}'
                    });
                },
                "dataSrc": function (response) {
                    if (response.exception !== '') {
                        notify(response.exception, 'warning')
                    }
                    return response.data;
                }
            },
            paging: false,
            responsive: false,
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false},
                {data: 'date', width: '5%', sortable: false},
                {data: 'voucher', width: '5%', sortable: false},
                {data: 'description', width: '30%', sortable: false},
                {data: 'assigned', width: '7%', sortable: false, searchable: false, class: "text-center"},
                {data: 'reform', width: '7%', sortable: false, searchable: false, class: "text-center"},
                {data: 'encoded', width: '7%', sortable: false, searchable: false, class: "text-center"},
                {data: 'committed', width: '7%', sortable: false, searchable: false, class: "text-center"},
                {data: 'accrued', width: '7%', sortable: false, searchable: false, class: "text-center"},
                {data: 'for_compromising', width: '7%', sortable: false, searchable: false, class: "text-center"},
                {data: 'to_accrued', width: '7%', sortable: false, searchable: false, class: "text-center"},
            ]
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission