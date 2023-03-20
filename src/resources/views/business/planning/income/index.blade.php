@php use App\Models\Business\Planning\Income; @endphp
@permission('index.income.budget.plans_management|index.income.programmatic_structure.execution')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            @if($module === Income::MODULE['BUDGET'])
                <h3>{{ trans('income.title') }}</h3>
            @elseif($module === Income::MODULE['PROGRAMMATIC_STRUCTURE'])
                <h3>{{ trans('income.title_structure') }}</h3>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>

    @if($module === Income::MODULE['BUDGET'])
        <div class="row tile_count col-md-12 col-sm-12 col-xs-12" id="budget_summary">
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-dollar"></i> {{ trans('income.title') . ' - ' . trans('income.labels.fiscalYear') . ': ' . $fiscal_year}}
                    </h2>
                    <div class="text-right pull-right d-flex">

                        <a href="{{ route('import.index.income.budget.plans_management') }}" class="btn btn-default ajaxify">
                            <i class="fa fa-cloud-upload"></i> {{ trans('income.labels.import') }}</a>

                        <a href="{{ route('download.index.income.budget.plans_management') }}" class="btn btn-default">
                            <i class="fa fa-cloud-download"></i> {{ trans('income.labels.download') }}</a>

                        @if(isset($replicate) && $replicate)
                            <a href="{{ route('replicate.index.income.budget.plans_management') }}" class="btn btn-default ajaxify">{{ trans('income.labels.replicate') }}</a>
                        @endif

                        @permission('create.income.budget.plans_management|create.income.programmatic_structure.execution')
                        <a href="{{ $routes['create'] }}" class="btn btn-success ajaxify">
                            <i class="fa fa-plus"></i> {{ trans('income.labels.create') }}
                        </a>
                        @endpermission
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    @if(isset($failures) && $failures->isNotEmpty())
                        <table class="table table-error">
                            <tr class="bg-red-300 text-white fw-b">
                                <td>{{ trans('income.labels.row') }}</td>
                                <td>{{ trans('income.labels.column') }}</td>
                                <td>{{ trans('income.labels.errors') }}</td>
                            </tr>
                            @foreach($failures as $fail)
                                <tr class="bg-red-300 text-white">
                                    <td>{{ $fail->row() }}</td>
                                    <td>{{ $fail->attribute() }}</td>
                                    <td>
                                        <ul>
                                            @foreach($fail->errors() as $e)
                                                <li>
                                                    {{ $e }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                    <table class="table table-striped text-center" id="incomes_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('income.labels.code') }}
                                <i role="button" data-toggle="tooltip" data-placement="top"
                                   data-original-title="{{ trans('income.labels.codeTooltip') }}"
                                   class="fa fa-info-circle blue"></i>
                            </th>
                            <th>{{ trans('budget_classifiers.labels.title') }}</th>
                            <th>{{ trans('budget_classifiers.title') }}</th>
                            <th>{{ trans('income.labels.financingSource') }}</th>
                            <th>{{ trans('income.labels.distributor_name') }}</th>
                            <th>{{ trans('income.labels.institution') }}</th>
                            <th>{{ trans('income.labels.value') }}</th>
                            <th>{{ trans('app.labels.actions') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr id="tfoot-tr-1">
                            <th class="text-right" colspan="7">{{ trans('income.labels.subtotal') }}</th>
                            <th class="text-center" id="tfoot-th-subtotal"></th>
                            <th></th>
                        </tr>
                        <tr id="tfoot-tr-2">
                            <th class="text-right" colspan="7">{{ trans('income.labels.total') }}</th>
                            <th class="text-center" id="tfoot-th-total"></th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        let $table = $('#incomes_tb');
        build_datatable($table, {
            ajax: {
                url: '{!! $routes['data'] !!}',
                "dataSrc": (response) => {
                    if (response.exception !== '') {
                        notify(response.exception, 'warning')
                    }
                    return response.data;
                }
            },
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'code', width: '15%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'name', width: '20%', sortable: false, searchable: true, class: 'text-justify'},
                {data: 'budget_classifier', width: '10%', sortable: false, searchable: true},
                {data: 'financing_source', width: '5%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'distributor_name', width: '15%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'institution', width: '15%', sortable: false, searchable: true},
                {data: 'value', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ],
            footerCallback: function () {
                let api = this.api(), json = api.ajax.json();

                // Remove the formatting to get integer data for summation
                let intVal = (i) => {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // Total over this page
                let pageTotal = api
                    .column(7, {page: 'current'})
                    .data()
                    .reduce((a, b) => {
                        return parseFloat(intVal(a)) + parseFloat(intVal(b));
                    }, 0);

                // Update footer
                $('#tfoot-tr-1 #tfoot-th-subtotal').text(
                    pageTotal
                ).number(true, 2).text(`$ ${$('#tfoot-tr-1 #tfoot-th-subtotal').text()}`);

                $('#tfoot-tr-2 #tfoot-th-total').html(
                    '$ ' + (json.totalIncome !== undefined ? json.totalIncome : 0.00)
                );
                @if($module === Income::MODULE['BUDGET'])
                pushRequest('{{ route('load_budget_summary.income.budget.plans_management') }}', '#budget_summary', null, 'GET', {}, false)
                @endif
            }
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
