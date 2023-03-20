<div class="row">
    <div class="col-md-12">
        @permission('edit.profile.projects.plans_management')
        <a class="btn btn-xs @if(isset($profile) and $profile) btn-success @else btn-primary @endif ajaxify"
           href="{{ route('edit.profile.projects.plans_management', ['id' => $entity->id]) }}">
            <i class="fa fa-dot-circle-o"></i> {{ trans('projects.actions.profile') }}
        </a>
        @endpermission
        @permission('modify.logic_frame.projects.plans_management')
        <a class="btn btn-xs @if(isset($logicFrame) and $logicFrame) btn-success @else btn-primary @endif ajaxify"
           href="{{ route('modify.logic_frame.projects.plans_management', ['id' => $entity->id]) }}">
            <i class="fa fa-file-text"></i> {{ trans('projects.actions.logic_frame') }}
        </a>
        @endpermission
        @permission('list.activities.projects.plans_management')
        <a class="btn btn-xs @if(isset($activity) and $activity) btn-success @else btn-primary @endif ajaxify"
           href="{{ route('list.activities.projects.plans_management', ['projectId' => $entity->id]) }}">
            <i class="fa fa-puzzle-piece"></i> {{ trans('projects.actions.activities') }}
        </a>
        @endpermission
        {{--        @permission('index.budget.projects.plans_management')--}}
        <a class="btn btn-xs @if(isset($budget) and $budget) btn-success @else btn-primary @endif ajaxify"
           href="{{ route('index.budget.projects.plans_management', ['projectFiscalYear' => $projectFiscalYear->id]) }}">
            <i class="fa fa-dollar"></i> {{ trans('projects.actions.budget') }}
        </a>
        {{--        @endpermission--}}
        @permission('index.schedule.projects.plans_management')
        <a class="btn btn-xs @if(isset($schedule) and $schedule) btn-success @else btn-primary @endif ajaxify"
           href="{{ route('index.schedule.projects.plans_management', ['id' => $entity->id]) }}">
            <i class="fa fa-calendar"></i> {{ trans('projects.actions.schedule') }}
        </a>
        @endpermission
        @permission('create.attachments.projects.plans_management')
        <a class="btn btn-xs btn-info ajaxify" href="{{ route('create.attachments.projects.plans_management', ['id' => $entity->id]) }}">
            <i class="fa fa-paperclip"></i> {{ trans('projects.actions.attachments') }}
        </a>
        @endpermission
        @if($entity->is_road)
            @permission('create_roads.attachments.projects.plans_management')
            <a class="btn btn-xs btn-info ajaxify" href="{{ route('create_roads.attachments.projects.plans_management', ['id' => $entity->id]) }}">
                <i class="fa fa-road"></i> {{ trans('projects.actions.attachments_roads') }}
            </a>
            @endpermission
        @endif
        @if($projectFiscalYear->rejections and count($projectFiscalYear->rejections))
            @permission('rejections_log.projects.plans_management')
            <a class="btn btn-xs btn-info ajaxify"
               href="{{ route('rejections_log.projects.plans_management', ['id' => $entity->id, 'project_fiscal_year_id' => $projectFiscalYear->id]) }}">
                <i class="fa fa-folder-open"></i> {{ trans('projects.actions.rejections') }}
            </a>
            @endpermission
        @endif
        @permission('status.projects.plans_management')
        <a class="btn btn-xs btn-warning ajaxify" id="btn-send" href="#">
            <i class="fa fa-send"></i> {{ trans('projects.actions.send') }}
        </a>
        @endpermission
    </div>
</div>

<script>
    $(() => {
        $('#btn-send').on('click', () => {
            pushRequest("{{ route('status.projects.plans_management', ['id' => $entity->id, 'project_fiscal_year_id' => $projectFiscalYear->id]) }}", null, null, 'PUT', {
                _token: '{{ csrf_token() }}'
            })
        })
    });
</script>