@foreach($components as $component)
    <tr>
        <td>{{ $component->name }}</td>
        <td>{{ $component->assumptions }}</td>
        <td>
            <div>
                <a href="{{ route('show.components.logic_frame.projects_review.plans_management', ['projectId' => $component->id]) }}"
                   data-ajaxify="#edit_area" class="btn btn-xs btn-primary ajaxify" role="button"
                   data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.labels.details') }}">
                    <i class="fa fa-search"></i>
                </a>

            </div>
        </td>
    </tr>
@endforeach