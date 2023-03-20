@foreach($components as $component)
    <tr>
        <td>{{ $component->name }}</td>
        <td>{{ $component->assumptions }}</td>
        <td>
            <div>
                <a href="{{ route($urlEditComponent, ['projectId' => $component->id]) }}"
                   data-ajaxify="#edit_area" class="btn btn-xs btn-primary ajaxify" role="button"
                   data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.labels.edit') }}">
                    <i class="fa fa-edit"></i>
                </a>
                @if(!$structureModule)
                    @if($addOrDelete)
                    <a href="{{ route($urlDeleteComponent, ['componentId' => $component->id]) }}"
                       class="btn btn-xs btn-danger action-delete"
                       role="button" data-ajaxify="#components_list"
                       data-method="get" data-toggle="tooltip"
                       data-placement="top" data-confirm="true"
                       data-original-title="{{ trans('app.labels.delete') }}">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a href="{{ route($urlCreateComponentIndicator, ['componentId' => $component->id]) }}"
                       data-ajaxify="#edit_area" class="btn btn-xs btn-success ajaxify" role="button"
                       data-toggle="tooltip" id="add_indicator_component" data-placement="top"
                       data-original-title="{{ trans('components.labels.create_indicator') }}">
                        <i class="fa fa-plus"></i>
                    </a>
                    @endif
                @endif

                <a href="{{ route($urlShowComponent, ['componentId' => $component->id]) }}"
                   data-ajaxify="#edit_area" data-method="put" class="btn btn-xs btn-primary ajaxify" role="button"
                   data-toggle="tooltip" data-placement="top"
                   data-original-title="{{ trans('components.labels.show_component') }}">
                    <i class="fa fa-search"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach

<script>
    $('#add_indicator_component').on('click', (e) => {
        $('#edit_area').empty();
    });
</script>