<table class="table default-table" id="component_tb">
    <thead>
    <tr>
        <th width="40%">{{ trans('app.headers.name') }}</th>
        <th width="40%">{{ trans('projects.labels.assumptions') }}</th>
        <th width="20%">{{ trans('app.labels.actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @if(count($components) > 0)
        @include('business.planning.projects.logic_frame.components.row', ['components' => $components, 'structureModule' => $structureModule])
    @else
        @include('business.planning.projects.partial.empty', ['message' => trans('projects.messages.validation.table_empty_message'), 'span'=> 4])
    @endif
    </tbody>
</table>

<script>
    $(() => {

        $('.action-delete', '#component_tb').on('click', (e) => {
            e.preventDefault();
            let action = $(e.currentTarget);
            let url = action.attr('href');
            if (!url)
                return;

            let confirm = action.attr('data-confirm');
            if (confirm)
                confirmModal("{{ trans('components.messages.confirm.delete') }}", () => {
                    pushRequest(url, action.attr('data-ajaxify'), null, action.attr('data-method'), {'_token': '{{ csrf_token() }}'});
                    $('#edit_area').empty();
                });
            else
                pushRequest(url, action.attr('data-ajaxify'), null, action.attr('data-method'), {'_token': '{{ csrf_token() }}'});
        });

    });
</script>