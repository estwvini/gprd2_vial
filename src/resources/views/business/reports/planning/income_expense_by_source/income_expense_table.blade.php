<table class="table report-table">
    <thead>
    <tr>
        <th>{{ trans('reports.income_expense.source') }}</th>
        <th class="text-center">{{ trans('reports.income_expense.incomes') }}</th>
        <th class="text-center">{{ trans('reports.income_expense.expenses') }}</th>
        <th class="text-center">{{ trans('reports.income_expense.diff') }}</th>
    </tr>
    </thead>
    @foreach($sources as $source)
        <tr id="source_row_{{ $source->id }}" class="@if($source->diff != 0) bg-danger @else bg-success @endif">
            <td>
                <div>
                    @if(isset($source->budgetItems) && $source->budgetItems->count())
                        <i id="arrow_{{ $source->id }}_right" class="glyphicon glyphicon-chevron-right arrow_right mr-1" role="button"></i>
                        <i id="arrow_{{ $source->id }}_down" class="glyphicon glyphicon-chevron-down arrow_down mr-1" role="button"></i>
                    @endif
                    <strong>{{ $source->code }} - {{ $source->description }}</strong>
                </div>
            </td>
            <td class="text-center">{{ number_format($source->totalIncomes, 2) }}</td>
            <td class="text-center">{{ number_format($source->totalExpenses, 2) }}</td>
            <td class="text-center">{{ $source->diff }}</td>
        </tr>
        @if(isset($source->budgetItems) && $source->budgetItems->count())
            @foreach($source->budgetItems as $item)
                <tr parent_row="source_row_{{ $source->id }}">
                    <td colspan="2">
                        <div class="ml-5">
                            <strong>{{ $item->code }}</strong> <br/> {{ $item->budgetClassifier->title }}
                        </div>
                    </td>
                    <td class="text-center">{{ number_format($item->amount, 2) }}</td>
                    <td></td>
                </tr>
            @endforeach
        @endif
    @endforeach
</table>

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
    })
</script>