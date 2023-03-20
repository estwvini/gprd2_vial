<div class="nav_menu hidden-print">
    @if(!currentUser()->hasRole('developer'))
        <div class="row text-center position-relative">
            <h1 class="top_nav_title">{!! session()->get('module')->name !!}</h1>
        </div>
    @endif

    <nav class="position-relative position-relative" role="navigation">
        <div class="nav toggle">
            <a id="menu_toggle">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            @include('layout.partial.profile_button')
            @if(!currentUser()->hasRole('developer'))
                @include('layout.partial.modules_button')
            @endif
        </ul>
    </nav>
</div>