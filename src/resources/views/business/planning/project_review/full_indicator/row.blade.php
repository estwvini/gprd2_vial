@foreach($indicators as $indicator)
    <tr>
        <td>{{ $indicator->name }}</td>
        <td>{{ $indicator->base_line }}</td>
        <td>{{ $indicator->goal }}</td>
        <td>{{ $indicator->source }}</td>
        <td>
            <a href="{{ route('show.full_indicator.projects_review.plans_management', ['projectId' => $indicator->id]) }}" data-ajaxify="#edit_area" class="btn btn-xs btn-primary ajaxify" role="button"
               data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.labels.details') }}">
                <i class="fa  fa-search"></i>
            </a>

        </td>
    </tr>
@endforeach