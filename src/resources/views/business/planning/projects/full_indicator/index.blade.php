<table class="table default-table" id="indicator_tb">
    <thead>
    <tr>
        <th width="30%">{{ trans('app.headers.name') }}</th>
        <th width="10%">{{ trans('plan_indicators.labels.base_line') }}</th>
        <th width="20%">{{ trans('plan_indicators.labels.goal') }}</th>
        <th width="25%">{{ trans('plan_indicators.labels.source') }}</th>
        <th width="10%">{{ trans('app.labels.actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @if(count($indicators) > 0)
        @include('business.planning.projects.full_indicator.row', ['indicators' => $indicators])
    @else
        @include('business.planning.projects.partial.empty', ['message' => trans('projects.messages.validation.table_empty_message'), 'span'=> 6])
    @endif
    </tbody>
</table>
<script>
    $(() => {

        $('.action-indicator-delete', '#indicator_tb').on('click', (e) => {
            e.preventDefault();
            let action = $(e.currentTarget);
            let url = action.attr('href');
            if (!url)
                return;

            let confirm = action.attr('data-confirm');
            if (confirm)
                confirmModal("{{ trans('indicators.messages.confirm.delete') }}", () => {
                    pushRequest(url, action.attr('data-ajaxify'), null, action.attr('data-method'), {'_token': '{{ csrf_token() }}'});
                    $('#edit_area').empty();
                });
            else
                pushRequest(url, action.attr('data-ajaxify'), null, action.attr('data-method'), {'_token': '{{ csrf_token() }}'});
        });

    });
</script>