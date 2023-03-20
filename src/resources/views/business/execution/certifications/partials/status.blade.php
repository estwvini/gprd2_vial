@inject('Certification', 'App\Models\Business\Certification' )
@switch($entity->status)
    @case($Certification::STATUS_DRAFT)
    <span class="label label-default"> {{ trans('certifications.labels.status_' . $Certification::STATUS_DRAFT) }}</span>
    @break
    @case($Certification::STATUS_TO_REVIEW)
    <span class="label label-info"> {{ trans('certifications.labels.status_' . $Certification::STATUS_TO_REVIEW) }}</span>
    @break
    @case($Certification::STATUS_REJECTED)
    <span class="label label-danger"> {{ trans('certifications.labels.status_' . $Certification::STATUS_REJECTED) }}</span>
    @break
    @case($Certification::STATUS_APPROVED)
    <span class="label label-success"> {{ trans('certifications.labels.status_' . $Certification::STATUS_APPROVED) }}</span>
    @break
    @case($Certification::STATUS_DIGITATED)
    <span class="label label-primary"> {{ trans('certifications.labels.status_' . $Certification::STATUS_DIGITATED) }}</span>
    @break
@endswitch
