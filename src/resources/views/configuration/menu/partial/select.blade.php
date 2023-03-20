<option value="{{ $menu->id }}" @if(isset($entity) && $entity->parent_id == $menu->id) selected @endif>
    @for($i = 0; $i < $level; $i++)
        --
    @endfor
     {{ $menu->label }}
</option>
@foreach($menu->children()->get() as $menu)
    @if(isset($entity))
        @include('configuration.menu.partial.select', ['entity' => $entity, 'menu' => $menu, 'level' => $level + 1])
    @else
        @include('configuration.menu.partial.select', ['menu' => $menu, 'level' => $level + 1])
    @endif
@endforeach