<tr id="activity_row_{{ $element['id'] }}" class="activity_row treeview-item-unselected" activity_id="{{ $element['id'] }}" parent_row="component_row_{{ $element['component_id'] }}">
    @foreach($element as $key => $column)
        @if(!in_array($key, ['type', 'id', 'children', 'status', 'responsible', 'component_id', 'attachment']))
            <td class="{{ $key }}" id="activity_col_{{ $element['id'] }}_{{ $key }}">
                @switch($key)
                    @case('name')
                    <div class="ml-3">
                        @if(isset($element['children']) && $element['children']->count())
                            <i id="arrow_{{ $element['id'] }}_right" class="glyphicon glyphicon-chevron-right arrow_right mr-1" role="button"></i>
                            <i id="arrow_{{ $element['id'] }}_down" class="glyphicon glyphicon-chevron-down arrow_down mr-1" role="button"></i>
                        @endif
                        @if(isset($element['responsible']) && $element['responsible'])
                            (<label class="acronym" data-toggle="tooltip" data-placement="top" data-original-title="{{ $element['responsible']->fullName() }}">
                                {{ $element['responsible']->getAcronym() }}
                            </label>)
                        @endif
                        <strong>{{ $column }}</strong>
                    </div>
                    @break

                    @case('semaphore')
                    <div class="circle bg_{{ $column }}" data-toggle="tooltip" data-placement="top"
                         data-original-title="{{ trans('physical_progress.labels.activityStatus.' . $column) }}"></div>
                    @break

                    @default
                    <div id="activity_col_{{ $element['id'] }}_{{ $key }}">
                        <strong>{{ $column }}</strong>
                    </div>
                @endswitch
            </td>
        @endif
    @endforeach
    <td></td>
</tr>