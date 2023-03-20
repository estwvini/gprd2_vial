@inject('AdminActivity', 'App\Models\Business\AdminActivity' )
<div>
    @switch($entity->status)
        @case($AdminActivity::STATUS_DRAFT)
        <span><i class='fa fa-circle-o'></i> {{ trans('admin_activities.labels.status_' . $AdminActivity::STATUS_DRAFT) }}</span>
        @break
        @case($AdminActivity::STATUS_IN_PROGRESS)
        <span><i class='color-blue fa fa-adjust fa-rotate-90'></i> {{ trans('admin_activities.labels.status_' . $AdminActivity::STATUS_IN_PROGRESS) }}</span>
        @break
        @case($AdminActivity::STATUS_COMPLETED)
        <span><i class='green fa fa-check-circle'></i> {{ trans('admin_activities.labels.status_' . $AdminActivity::STATUS_COMPLETED) }}</span>
        @break
        @case($AdminActivity::STATUS_CANCELED)
        <span><i class='red fa fa-ban'></i> {{ trans('admin_activities.labels.status_' . $AdminActivity::STATUS_CANCELED) }}</span>
        @break
    @endswitch
</div>
