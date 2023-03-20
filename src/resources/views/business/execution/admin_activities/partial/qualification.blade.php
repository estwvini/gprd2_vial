@inject('AdminActivity', 'App\Models\Business\AdminActivity' )
<div>
    @switch($entity->qualification)
        @case($AdminActivity::QUALIFICATION_EXCELLENT)
        <small>{{trans('admin_activities.labels.qualification_'.$AdminActivity::QUALIFICATION_EXCELLENT) }}</small>
        @break
        @case($AdminActivity::QUALIFICATION_VERY_GOOD)
        <small> {{trans('admin_activities.labels.qualification_'.$AdminActivity::QUALIFICATION_VERY_GOOD)  }}</small>
        @break
        @case($AdminActivity::QUALIFICATION_SATISFACTORY)
        <small> {{ trans('admin_activities.labels.qualification_'.$AdminActivity::QUALIFICATION_SATISFACTORY)}}</small>
        @break
        @case($AdminActivity::QUALIFICATION_DEFICIENT)
        <small>{{ trans('admin_activities.labels.qualification_'.$AdminActivity::QUALIFICATION_DEFICIENT)  }}</small>
        @break
        @case($AdminActivity::QUALIFICATION_UNACCEPTABLE)
        <small> {{  trans('admin_activities.labels.qualification_'.$AdminActivity::QUALIFICATION_UNACCEPTABLE) }}</small>
        @break
    @endswitch
</div>
