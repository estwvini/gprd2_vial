<tr id="activity_row_{{ $element['id'] }}" class="activity_row treeview-item-unselected" activity_id="{{ $element['id'] }}" parent_row="component_row_{{ $element['component_id'] }}">
    @foreach($element as $key => $column)
        @if(!in_array($key, ['type', 'id','responsible_id','weight', 'children', 'component_id', 'affected']))
            <td class="{{ $key }}" id="activity_col_{{ $element['id'] }}_{{ $key }}">
                @if($key == 'name')
                    <div class="ml-3">
                        <i id="arrow_{{ $element['id'] }}_right" class="glyphicon glyphicon-chevron-right arrow_right mr-1" role="button"></i>
                        <i id="arrow_{{ $element['id'] }}_down" class="glyphicon glyphicon-chevron-down arrow_down mr-1" role="button"></i>
                        <strong>{{ $column }}</strong>
                    </div>
                @else

                    @if($key == 'weight_percentage')
                        <div id="activity_col_{{ $element['id'] }}_{{ $key }}" class="final_weights">
                            <strong>{{ $column . ' %' }}</strong>
                        </div>
                        <div id="activity_col_temp_{{ $element['id'] }}_{{ $key }}" class="temp_weights">

                        </div>
                    @else
                        <div id="activity_col_{{ $element['id'] }}_{{ $key }}">
                            <strong>{{ ($key == 'budget' ? '$ ' : '') . $column }}</strong>
                        </div>
                    @endif

                @endif
            </td>
        @endif
    @endforeach
</tr>