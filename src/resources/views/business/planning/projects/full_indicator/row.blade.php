@foreach($indicators as $indicator)
    <tr>
        <td>{{ $indicator->name }}</td>
        <td>{{ $indicator->base_line }}</td>
        <td>{{ $indicator->goal }}</td>
        <td>{{ $indicator->source }}</td>
        <td>
            <a href="{{ route($urlEditFullIndicator, ['projectId' => $indicator->id]) }}" data-ajaxify="#edit_area" class="btn btn-xs btn-primary ajaxify" role="button"
               data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.labels.edit') }}">
                <i class="fa fa-edit"></i>
            </a>

            @if($addOrDelete)
                <a href="{{ route($urlDeleteFullIndicator, ['indicatorId' => $indicator->id]) }}"
                   class="btn btn-xs btn-danger action-indicator-delete"
                   role="button"
                   data-ajaxify="#indicators_list"
                   data-method="get"
                   data-toggle="tooltip"
                   data-placement="top"
                   data-confirm="true"
                   data-original-title="{{ trans('app.labels.delete') }}"
                   id="delete_indicator">
                    <i class="fa fa-trash"></i>
                </a>
            @endif

            <a href="{{ route($urlShowFullIndicator, ['indicatorId' => $indicator->id]) }}"
               data-ajaxify="#edit_area" class="btn btn-xs btn-primary ajaxify" role="button"
               data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('components.labels.show_indicator') }}">
                <i class="fa fa-search"></i>
            </a>
        </td>
    </tr>
@endforeach