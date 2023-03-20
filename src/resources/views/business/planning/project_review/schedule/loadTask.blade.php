<tr id="task_row_{{ $element['id'] }}" class="task_activity_{{ $element['activity_id'] }} task_row" task_id="{{ $element['id'] }}" type="{{ $element['type'] }}"
    parent_row="activity_row_{{ $element['activity_id'] }}">
    @foreach($element as $key => $column)
        @if(!in_array($key, ['type', 'id', 'activity_id', 'responsible_id', 'weight', 'editable']))
            <td class="{{ $key }}" id="task_col_{{ $element['id'] }}_{{ $key }}">
                @if($key == 'name')
                    <div class="ml-5">
                        <strong>{{ $column }}</strong>
                    </div>
                @else
                    @if($key == 'weight_percentage')
                        <div id="task_col_{{ $element['id'] }}_{{ $key }}" class="final_weights">
                            <strong>{{ $column . ' %' }}</strong>
                        </div>
                        <div id="task_col_temp_{{ $element['id'] }}_{{ $key }}" class="temp_weights">

                        </div>
                    @else
                        <div id="task_col_{{ $element['id'] }}_{{ $key }}">
                            <strong>{{ $column }}</strong>
                        </div>
                    @endif
                @endif
            </td>
        @endif
    @endforeach
</tr>