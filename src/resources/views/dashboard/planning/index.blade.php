@permission('project_dashboard.control_panel')
<!-- Nav tabs -->
<ul class="md nav nav-tabs" role="tablist" style="display: inline-block" id="my-tabs">
    @if(api_available())
        <li role="presentation" class="active">
            <a href="#table" aria-controls="table" role="tab" data-toggle="tab">{{ trans('dashboard.budget.title') }}</a>
        </li>
        <li role="presentation">
            <a href="#projects" aria-controls="projects" role="tab" data-toggle="tab">{{ trans('dashboard.project.title') }}</a>
        </li>
    @endif
    <li role="presentation" @if(!api_available()) class="active" @endif>
        <a href="#administrative" aria-controls="administrative" role="tab" data-toggle="tab">{{ trans('dashboard.admin.title') }}</a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    @if(api_available())
        <div role="tabpanel" class="tab-pane active" id="table">
            @include('dashboard.planning.components.budget.index')
        </div>
        <div role="tabpanel" class="tab-pane" id="projects">
            @include('dashboard.planning.components.projects.index')
        </div>
    @endif
    <div role="tabpanel" class="tab-pane @if(!api_available()) active @endif" id="administrative">
        @include('dashboard.planning.components.administrative.index')
    </div>
</div>
@else
    @include('default_dashboard')
    @endpermission
