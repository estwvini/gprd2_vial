@inject('AdminActivity', 'App\Models\Business\AdminActivity' )
<div>
    @if($entity->status == $AdminActivity::STATUS_COMPLETED)
        <span class="label label-success">{{ $entity->date_end }}</span>
    @elseif($entity->date_end and \Carbon\Carbon::parse($entity->date_end) > now())
        <span class="label label-default">{{ $entity->date_end }}</span>
    @else
        <span class="label label-danger">{{ $entity->date_end }}</span>
    @endif
</div>
