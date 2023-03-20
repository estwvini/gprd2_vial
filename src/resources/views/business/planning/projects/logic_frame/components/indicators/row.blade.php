@foreach($indicators as $indicator)
    <tr>
        <td>{{ $indicator->name }}</td>
        <td>{{ $indicator->base_line }}</td>
        <td>{{ $indicator->goal }}</td>
        <td>{{ $indicator->source }}</td>
        <td>
            <a href="{{ route($urlEditComponentIndicator, ['indicatorId' => $indicator->id]) }}" class="btn btn-xs btn-primary ajaxify" role="button"
               data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.labels.edit') }}">
                <i class="fa fa-edit"></i>
            </a>

            @if($addOrDelete)
                <a href="{{ route($urlDeleteComponentIndicator, ['indicatorId' => $indicator->id]) }}"
                   class="btn btn-xs btn-danger delete_activity_indicator"
                   role="button"
                   data-ajaxify="#indicators_activity_list"
                   data-method="get"
                   data-toggle="tooltip"
                   data-placement="top"
                   data-confirm="true"
                   data-original-title="{{ trans('app.labels.delete') }}">
                    <i class="fa fa-trash"></i>
                </a>
            @endif

            <a href="{{ route($urlShowComponentIndicator, ['componentId' => $indicator->id]) }}"
               data-ajaxify="#edit_area" class="btn btn-xs btn-primary ajaxify" role="button"
               data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('components.labels.show_indicator') }}">
                <i class="fa fa-search"></i>
            </a>
        </td>
    </tr>
@endforeach