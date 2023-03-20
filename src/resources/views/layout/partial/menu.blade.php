@if(is_array($menu))

<li>
    <a href="{{ (array_key_exists('slug', $menu)) ? route($menu['slug']) : 'javascript:;' }}"
        class="{{ (array_key_exists('slug', $menu)) ? 'ajaxify' : '' }}">

        @if (array_key_exists('icon', $menu))
            <i class="fa fa-{{$menu['icon']}}"></i>
        @endif

        {{ $menu['label'] }}

        @if(array_key_exists('children', $menu))
            <span class="fa fa-chevron-down"></span>
        @endif
    </a>

    @if(array_key_exists('children', $menu))
        <ul class="nav child_menu">
            @each('layout.partial.menu', $menu['children'], 'menu')
        </ul>
    @endif
</li>

@endif