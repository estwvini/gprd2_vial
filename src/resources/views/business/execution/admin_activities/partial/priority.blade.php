@inject('AdminActivity', 'App\Models\Business\AdminActivity' )
<div>
    @switch($entity->priority)
        @case($AdminActivity::PRIORITY_URGENT)
        <span><i class='red fa fa-bell w-10 text-center'></i> {{ trans('admin_activities.labels.priority_' . $AdminActivity::PRIORITY_URGENT) }}</span>
        @break
        @case($AdminActivity::PRIORITY_IMPORTANT)
        <span><i class='red fa fa-exclamation w-10 text-center'></i> {{ trans('admin_activities.labels.priority_' . $AdminActivity::PRIORITY_IMPORTANT) }}</span>
        @break
        @case($AdminActivity::PRIORITY_MEDIUM)
        <span><i class='green fa fa-minus w-10 text-center'></i> {{ trans('admin_activities.labels.priority_' . $AdminActivity::PRIORITY_MEDIUM) }}</span>
        @break
        @case($AdminActivity::PRIORITY_LOW)
        <span><i class='color-blue fa fa-long-arrow-down w-10 text-center'></i> {{ trans('admin_activities.labels.priority_' . $AdminActivity::PRIORITY_LOW) }}</span>
        @break
    @endswitch
</div>
