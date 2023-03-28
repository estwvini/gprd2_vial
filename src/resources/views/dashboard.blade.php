
<div>
    @if(!currentUser()->hasRole('developer'))
        @if(session()->get('module')->id == \App\Models\System\Module::MODULE_GXR)
            @include('dashboard.planning.index')
        @elseif(session()->get('module')->id == \App\Models\System\Module::MODULE_ROADS)
            @include('dashboard.roads.default_roads')
        @elseif(session()->get('module')->id == \App\Models\System\Module::MODULE_CONFIGURATION)
            @include('dashboard.configuration.landing')
        @elseif(session()->get('module')->id == \App\Models\System\Module::MODULE_APP)
            @include('dashboard.app.index')
		@elseif(session()->get('module')->id == \App\Models\System\Module::MODULE_LIBRARY)
            @include('dashboard.library.index')
        @elseif(session()->get('module')->id == \App\Models\System\Module::MODULE_CLIMATERISK)
            @include('dashboard.climaterisk.default_risks')    
        @else           
            @include('default_dashboard')
        @endif
    @endif
</div>

<script>
    $(() => {
        hideLoading();
    });
</script>
