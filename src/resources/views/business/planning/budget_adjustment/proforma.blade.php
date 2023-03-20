@permission('preview_proforma.budget_adjustment.budget.plans_management')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>
                {{ trans('budget_adjustment.title_small') }}
                <small>{{ trans('proforma.labels.preview_proforma') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                <li class="active">{{ trans('app.labels.budget') }}</li>

                <li>
                    @permission('index.budget_adjustment.budget.plans_management')
                    <a class="ajaxify" href="{{ route('index.budget_adjustment.budget.plans_management') }}"> {{ trans('budget_adjustment.title_small') }}</a>
                    @else
                    {{ trans('budget_adjustment.title_small') }}
                    @endpermission
                </li>

                <li class="active">{{ trans('proforma.labels.preview_proforma') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel mb-15">
                <div class="x_title">
                    <h2><i class="fa fa-list-alt"></i> {{ trans('proforma.title_year', ['year' => $fiscalYear]) }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.budget_adjustment.budget.plans_management') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                            @permission('export.preview_proforma.budget_adjustment')
                            <li class="pull-right">
                                <a id="export_pdf" class="btn ajaxify pdf-export-button">
                                    <i class="fa fa-file-pdf-o"></i>{{ trans('app.labels.export.pdf') }}
                                </a>
                            </li>
                            @endpermission
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table report-table" id="proforma_tb">
                        <thead>
                        <tr>
                            <th>{{ trans('proforma.labels.year') }}</th>
                            <th>{{ trans('proforma.labels.company_code') }}</th>
                            <th>{{ trans('proforma.labels.type') }}</th>
                            <th>{{ trans('proforma.labels.code') }}</th>
                            <th>{{ trans('proforma.labels.description') }}</th>
                            <th>{{ trans('proforma.labels.income_amount') }}</th>
                            <th>{{ trans('proforma.labels.expense_amount') }}</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
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
        build_datatable($('#proforma_tb'), {
            dom: 't',
            ajax: '{!! route('data.preview_proforma.budget_adjustment.budget.plans_management') !!}',
            paging: false,
            columns: [
                {data: 'year', width: '5%', sortable: false, searchable: false},
                {data: 'company_code', width: '5%', sortable: false, searchable: false},
                {data: 'type', width: '5%', sortable: false, searchable: false},
                {data: 'code', width: '30%', sortable: false, searchable: false},
                {data: 'description', width: '35%', sortable: false, searchable: false},
                {data: 'income_amount', width: '10%', sortable: false, searchable: false},
                {data: 'expense_amount', width: '10%', sortable: false, searchable: false}
            ],
            footerCallback: function ( row, data, start, end, display ) {
                let api = this.api(), json = api.ajax.json();

                // Update footer
                $(api.column(5).footer()).html(
                    '{{ trans('reports/planning/ppi.labels.footer.total') }}'.replace(':totalBudget', json.totalIncome)
                );
                $(api.column(6).footer()).html(
                    '{{ trans('reports/planning/ppi.labels.footer.total') }}'.replace(':totalBudget', json.totalExpense)
                );
            }
        });

        let logoBase64;

        imgToBase64('{{ mix('images/logo_login.png') }}', function(base64) {
            logoBase64 = base64;
        });

        $('#export_pdf').on('click', () => {
            let startYTable = 45, totalPagesExp = "{total_pages_count_string}";
            let doc = new jsPDF('l', 'mm', 'a4');

            doc.autoTable({
                html: '#proforma_tb',
                theme: 'grid',
                tableWidth: 'auto',
                headStyles: {
                    halign: 'center'
                },
                styles: {
                    overflow: 'linebreak',
                    cellWidth: 'auto',
                    valign: 'middle',
                    minCellWidth: 20
                },
                columnStyles: {
                    1: {cellWidth: 20},
                    3: {cellWidth: 100},
                    4: {cellWidth: 50}
                },
                showFoot: 'lastPage',
                didDrawPage: (data) => {
                    doc = setDocHeaderAndFooter(data, doc, logoBase64, '{{ trans('proforma.title_year', ['year' => $fiscalYear]) }}', totalPagesExp);
                },
                margin: {top: startYTable}
            });

            if (typeof doc.putTotalPages === 'function') {
                doc.putTotalPages(totalPagesExp);
            }

            doc.save('{{ trans('proforma.title') . " - $fiscalYear" }}' + '.pdf')
        })
    });
</script>

@else
    @include('errors.403')
@endpermission
