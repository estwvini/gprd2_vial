@permission('incomes_expenses_execution.reports')
<div>
    <div class="page-title">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3>{{ trans('app.labels.reports') }}</h3>
            <h2>
                <i class="fa fa-list-alt"></i> {{ trans('reports.income_expense_execution.title') }}
            </h2>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row tile_count col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-5ths col-sm-4 col-xs-12 tile_stats_count mt-3">
            <span class="count_top label label-warning"><i class="fa fa-usd"></i> {{ trans('reports.income_expense_execution.incomes') }}</span>
            <div id="income" class="count adjustment-balance">{{ number_format($incomes, 2) }}</div>
        </div>
        <div class="col-md-5ths col-sm-4 col-xs-12 tile_stats_count mt-3">
            <span class="count_top label label-warning"><i class="fa fa-usd"></i> {{ trans('reports.income_expense_execution.expenses') }}</span>
            <div id="expenses" class="count adjustment-balance">{{ number_format($expenses, 2) }}</div>
        </div>
        <div class="col-md-5ths col-sm-4 col-xs-12 tile_stats_count mt-3">
            <span class="count_top label label-danger"><i class="fa fa-usd"></i> {{ trans('reports.income_expense_execution.diff') }}</span>
            <div id="balance" class="count text-danger adjustment-balance">{{ number_format($incomes - $expenses, 2)  }}</div>
        </div>
    </div>

    <div class="row">
        <div class="x_content overflow-scroll" id="income_expense_table">
            <table class="table report-table">
                <thead>
                <tr>
                    <th>{{ trans('reports.income_expense_execution.source') }}</th>
                    <th class="text-center">{{ trans('reports.income_expense_execution.incomes') }}</th>
                    <th class="text-center">{{ trans('reports.income_expense_execution.expenses') }}</th>
                    <th class="text-center">{{ trans('reports.income_expense_execution.diff') }}</th>
                </tr>
                </thead>
                @foreach($sources as $source)
                    <tr id="source_row_{{ $source->codigo }}" class="@if($source->diff != 0) bg-danger @else bg-success @endif">
                        <td>
                            <div>
                                @if(isset($source->budgetItems) && $source->budgetItems->count())
                                    <i id="arrow_{{ $source->codigo }}_right" class="glyphicon glyphicon-chevron-right arrow_right mr-1" role="button"></i>
                                    <i id="arrow_{{ $source->codigo }}_down" class="glyphicon glyphicon-chevron-down arrow_down mr-1" role="button"></i>
                                @endif
                                <strong>{{ $source->codigo }} - {{ $source->category }}</strong>
                            </div>
                        </td>
                        <td class="text-center">{{ number_format($source->codificado, 2) }}</td>
                        <td class="text-center">{{ number_format($source->totalExpenses, 2) }}</td>
                        <td class="text-center">{{ $source->diff }}</td>
                    </tr>
                    @if(isset($source->budgetItems) && $source->budgetItems->count())
                        @foreach($source->budgetItems as $item)
                            <tr parent_row="source_row_{{ $source->codigo }}">
                                <td colspan="2">
                                    <div class="ml-5">
                                        <strong>{{ $item->codigo }}</strong> <br/> {{ $item->category }}
                                    </div>
                                </td>
                                <td class="text-center">{{ number_format($item->codificado, 2) }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </table>
        </div>
    </div>
</div>

<footer class="navbar-default navbar-fixed-bottom text-center">
    <a id="cancelLinks" href="{{ route('index.reports') }}"
       class="btn btn-info ajaxify">{{ trans('app.labels.backward') }}
    </a>
</footer>

<script>
    $(() => {
        /**
         * Agrega los eventos y acciones para contraer o expandir componentes
         */
        let addArrowEvents = () => {

            // Arrow buttons events
            $(`.arrow_down`).on('click', (e) => {
                $(e.currentTarget).hide();
                $(e.currentTarget).siblings('.arrow_right').show();

                let id = $(e.currentTarget).parents('tr').attr('id');

                closeChildren(id)
            });

            $(`.arrow_right`).on('click', (e) => {
                $(e.currentTarget).hide();
                $(e.currentTarget).siblings('.arrow_down').show();

                let id = $(e.currentTarget).parents('tr').attr('id');

                openChildren(id)
            });

        };

        /**
         * Contrae cada uno de los hijos de la estructura
         *
         * @param id
         */
        const closeChildren = (id) => {
            $(`tr[parent_row='${id}']`).each((index, element) => {
                $(element).find('.arrow_down').hide();
                $(element).find('.arrow_right').show();
                $(element).hide();
            })
        };

        /**
         * Expande los hijos del nivel inmediato
         *
         * @param id
         */
        const openChildren = (id) => {
            $(`tr[parent_row='${id}']`).each((index, element) => {
                $(element).show();
            })
        };

        $('.arrow_right').hide();
        addArrowEvents();
    });
</script>

@else
    @include('errors.403')
    @endpermission