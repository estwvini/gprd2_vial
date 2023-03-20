<tr id="component_row_{{ $element['id'] }}" class="component_row" component_id="{{ $element['id'] }}">
    <td colspan="8" class="name">
        <div>
            @if(isset($element['children']) && $element['children']->count())
                <i id="arrow_{{ $element['id'] }}_right" class="glyphicon glyphicon-chevron-right arrow_right mr-1" role="button"></i>
                <i id="arrow_{{ $element['id'] }}_down" class="glyphicon glyphicon-chevron-down arrow_down mr-1" role="button"></i>
            @endif
            <strong>{{ $element['name'] }}</strong>
        </div>
    </td>
</tr>

<script>
    $(() => {

        /**
         * Agrega los eventos y acciones para contraer o expandir componentes
         */
        let addArrowEvents = () => {

            // Arrow buttons events
            @if(isset($element['children']) && !empty($element['children']))
            $(`.arrow_down`).on('click', (e) => {
                $(e.currentTarget).hide();
                $(e.currentTarget).siblings('.arrow_right').show();

                let id = $(e.currentTarget).parents('tr').attr('id')

                closeChildren(id)
            });

            $(`.arrow_right`).on('click', (e) => {
                $(e.currentTarget).hide();
                $(e.currentTarget).siblings('.arrow_down').show();

                let id = $(e.currentTarget).parents('tr').attr('id')

                openChildren(id)
            });
            @endif

        }

        /**
         * Contrae cada uno de los hijos de la estructura
         *
         * @param id
         */
        const closeChildren = (id) => {
            $(`tr[parent_row='${id}']`).each((index, element) => {

                $(element).find('.arrow_down').hide()
                $(element).find('.arrow_right').show()
                $(element).hide()

                closeChildren($(element).attr('id'))
            })
        }

        /**
         * Expande los hijos del nivel inmediato
         *
         * @param id
         */
        const openChildren = (id) => {
            $(`tr[parent_row='${id}']`).not('.task_hidden_buttons').not('.task_hidden_row').each((index, element) => {
                $(element).show()
            })
        }

        $('.arrow_right').hide();
        addArrowEvents();

    })

</script>