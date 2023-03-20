@inject('AdminActivity', 'App\Models\Business\AdminActivity' )
<div>
    @if($entity->status == $AdminActivity::STATUS_COMPLETED)
        <span class="label label-success">{{ $entity->date_init }}</span>
    @elseif($entity->date_init and \Carbon\Carbon::parse($entity->date_init) < now())
        <span class="label label-warning">{{ $entity->date_init }}</span>
    @else
        <span class="label label-default">{{ $entity->date_init }}</span>
    @endif
</div>
