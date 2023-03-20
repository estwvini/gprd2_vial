@permission('index.plans.plans_management')

@inject('Plan', '\App\Models\Business\Plan')
@inject('PlanElement', '\App\Models\Business\PlanElement')

@include('business.planning.partials.justification.form', ['action' => trans('justifications.actions.delete'), 'form' => true])

<div class="page-title">
    <div class="col-md-11 col-sm-11 col-xs-11">
        <h3>{{ trans('plans.labels.plansManagement') }}
            <small>{{ trans('app.labels.planning') }}</small>
        </h3>
    </div>
</div>

<div class="dashboard-title title_left col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
    <h3 class="col-lg-3 col-md-3 col-sm-3 col-xs-3">{{ trans('plans.labels.'.$Plan::SCOPE_SUPRANATIONAL) }} </h3>
    <ul class="nav navbar-right">
        <li class="pull-right">
            <a href="{{ route('create.plans.plans_management', ['scope'=>$Plan::SCOPE_SUPRANATIONAL]) }}"
               class="ajaxify white">
                <i class="fa fa-plus"></i> {{ trans('plans.labels.create.'.$Plan::SCOPE_SUPRANATIONAL) }}
            </a>
        </li>
    </ul>
</div>

<div class="row m-4">
    @foreach(collect($plans)->where('scope', $Plan::SCOPE_SUPRANATIONAL) as $plan)
        @if($loop->first || (($loop->iteration - 1) % 2) === 0)
            <div class="row">
                @endif
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt-4">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ \Illuminate\Support\Str::limit($plan->name, 50, '...') }}</h2>
                            <ul class="nav navbar-right panel_toolbox">

                                <li class="pull-right">
                                    <a id="delete_plan_{{ $plan->id }}" data-toggle="tooltip" data-placement="top"
                                       data-original-title="@if($plan->type == $Plan::TYPE_ODS)
                               {{ trans('app.labels.archives') }}
                               @else
                               {{ trans('app.labels.delete') }}
                               @endif">
                                        <i class="fa @if($plan->type == $Plan::TYPE_ODS) fa-inbox green @else fa-trash text-danger @endif"></i>
                                    </a>
                                </li>
                                <li class="pull-right">
                                    <a data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.labels.edit') }}"
                                       class="ajaxify" href="{{ route('edit.plans.plans_management', ['id'=> $plan->id, 'element_type' => $PlanElement::TYPE_OBJECTIVE]) }}">
                                        <i class="fa fa-edit orange"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>

                        </div>
                        <div class="x_content">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h5>{{ trans('plan_elements.titles.OBJECTIVE') . ': ' . $plan->elements[$PlanElement::TYPE_OBJECTIVE] }}</h5>
                                    <h5>{{ trans('plan_elements.titles.INDICATORS') . ': ' . $plan->elements[$PlanElement::TYPE_INDICATOR] }}</h5>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mt-3">
                                    <i class="{{ $plan->completness }}"></i>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 noVerticalGap">
                                    <h5>{{ trans('plans.labels.objWithIndicators') . ': ' . $plan->elements['additionalInfo']['OBJECTIVES_WITH_INDICATORS'] }}</h5>
                                    @if($plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS'])
                                        <h5 class="red bold">{{ trans('plans.labels.objWithoutIndicators') . ': ' . $plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS'] }}</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(($loop->iteration % 2) === 0 || $loop->last)
            </div>
        @endif
    @endforeach
</div>

<div class="dashboard-title title_left col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3 class="col-lg-3 col-md-3 col-sm-3 col-xs-3">{{ trans('plans.labels.'.$Plan::SCOPE_NATIONAL) }} </h3>
    <ul class="nav navbar-right">
        <li class="pull-right">
            <a href="{{ route('create.plans.plans_management', ['scope'=>$Plan::SCOPE_NATIONAL]) }}"
               class="ajaxify white">
                <i class="fa fa-plus"></i> {{ trans('plans.labels.create.'.$Plan::SCOPE_NATIONAL) }}
            </a>
        </li>
    </ul>
</div>

<div class="row m-4">
    @foreach(collect($plans)->where('scope', $Plan::SCOPE_NATIONAL) as $plan)
        @if($loop->first || (($loop->iteration - 1) % 2) === 0)
            <div class="row">
                @endif
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt-4">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ \Illuminate\Support\Str::limit($plan->name, 50, '...') }}</h2>
                            <ul class="nav navbar-right panel_toolbox">

                                <li class="pull-right">
                                    <a id="delete_plan_{{ $plan->id }}" data-toggle="tooltip" data-placement="top"
                                       data-original-title="@if($plan->type == $Plan::TYPE_PND)
                               {{ trans('app.labels.archives') }}
                               @else
                               {{ trans('app.labels.delete') }}
                               @endif">
                                        <i class="fa @if($plan->type == $Plan::TYPE_PND) fa-inbox green @else fa-trash text-danger @endif"></i>
                                    </a>
                                </li>
                                <li class="pull-right">
                                    <a data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.labels.edit') }}"
                                       class="ajaxify" href="{{ route('edit.plans.plans_management', ['id'=> $plan->id, 'element_type' => $PlanElement::TYPE_THRUST]) }}">
                                        <i class="fa fa-edit orange"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>

                        </div>
                        <div class="x_content">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h5>{{ trans('plan_elements.titles.THRUST') . ': ' . $plan->elements[$PlanElement::TYPE_THRUST] }}</h5>
                                    <h5>{{ trans('plan_elements.titles.OBJECTIVE') . ': ' . $plan->elements[$PlanElement::TYPE_OBJECTIVE] }}</h5>
                                    <h5>{{ trans('plan_elements.titles.INDICATORS') . ': ' . $plan->elements[$PlanElement::TYPE_INDICATOR] }}</h5>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mt-3">
                                    <i class="{{ $plan->completness }}"></i>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 noVerticalGap">
                                    <h5>{{ trans('plans.labels.objWithIndicators') . ': ' . $plan->elements['additionalInfo']['OBJECTIVES_WITH_INDICATORS'] }}</h5>
                                    @if($plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS'])
                                        <h5 class="red bold">{{ trans('plans.labels.objWithoutIndicators') . ': ' . $plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS'] }}</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(($loop->iteration % 2) === 0 || $loop->last)
            </div>
        @endif
    @endforeach
</div>

<div class="dashboard-title title_left col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3 class="col-lg-3 col-md-3 col-sm-3 col-xs-3">{{ trans('plans.labels.' . $Plan::SCOPE_TERRITORIAL) }} </h3>
    <ul class="nav navbar-right ">
        <li class="pull-right">
            <a href="{{ route('create.plans.plans_management', ['scope'=>$Plan::SCOPE_TERRITORIAL]) }}"
               class="ajaxify white">
                <i class="fa fa-plus"></i> {{ trans('plans.labels.create.' . $Plan::SCOPE_TERRITORIAL) }}
            </a>
        </li>
    </ul>
</div>

<div class="row m-4">
    @foreach(collect($plans)->where('scope', $Plan::SCOPE_TERRITORIAL) as $plan)
        @if($loop->first || (($loop->iteration - 1) % 2) === 0)
            <div class="row">
                @endif
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt-4">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ \Illuminate\Support\Str::limit($plan->name, 50, '...') }}</h2>
                            <ul class="nav navbar-right panel_toolbox">

                                @if($plan->status != $Plan::STATUS_DRAFT)
                                    <li class="pull-right">
                                        <a data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.labels.link') }}"
                                           class="ajaxify"
                                           href="{{ route('plan.link.links.plans.plans_management', [
                                   'id' => $plan->id
                               ]) }}">
                                            <i class="fa fa-link blue"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="pull-right">
                                        <a id="verify_PDOT_{{ $plan->id }}" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('plans.labels.VERIFIED') }}"
                                           @if(isset($plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS']) && $plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS'] == 0)
                                               class="ajaxify"
                                           href="{{ route('approve.plans.plans_management', [
                                    'id' => $plan->id,
                                    'no_indicators' => $plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS'] ]) }}"
                                           @else
                                               class="notify"
                                            @endif>
                                            <i class="fa fa-check-square-o green"></i>
                                        </a>
                                    </li>
                                @endif

                                <li class="pull-right">
                                    <a id="delete_plan_{{ $plan->id }}" data-toggle="tooltip" data-placement="top"
                                       data-original-title="@if($plan->type == $Plan::TYPE_PDOT)
                               {{ trans('app.labels.archives') }}
                               @else
                               {{ trans('app.labels.delete') }}
                               @endif">
                                        <i class="fa @if($plan->type == $Plan::TYPE_PDOT) fa-inbox green @else fa-trash text-danger @endif"></i>
                                    </a>
                                </li>

                                <li class="pull-right">
                                    <a data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.labels.edit') }}"
                                       class="ajaxify"
                                       href="{{ route('edit.plans.plans_management', [
                                   'id' => $plan->id,
                                   'element_type' => $plan->type == $Plan::TYPE_PDOT ?
                                       $PlanElement::TYPE_THRUST :
                                       $PlanElement::TYPE_OBJECTIVE
                               ]) }}">
                                        <i class="fa fa-edit orange"></i>
                                    </a>
                                </li>

                            </ul>
                            <div class="clearfix"></div>

                        </div>
                        <div class="x_content">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    @if($plan->type == $Plan::TYPE_PDOT)
                                        <h5>{{ trans('plan_elements.titles.THRUST') . ': ' . $plan->elements[$PlanElement::TYPE_THRUST] }}</h5>
                                    @endif
                                    <h5>{{ trans('plan_elements.titles.OBJECTIVE') . ': ' . $plan->elements[$PlanElement::TYPE_OBJECTIVE] }}</h5>
                                    <h5>{{ trans('plan_elements.titles.INDICATORS') . ': ' . $plan->elements[$PlanElement::TYPE_INDICATOR] }}</h5>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mt-3">
                                    <i class="{{ $plan->completness }}"></i>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 noVerticalGap">
                                    <h5>{{ trans('plans.labels.objWithIndicators') . ': ' . $plan->elements['additionalInfo']['OBJECTIVES_WITH_INDICATORS'] }}</h5>

                                    @if($plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS'])
                                        <h5 class="red bold">{{ trans('plans.labels.objWithoutIndicators') . ': ' . $plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS'] }}</h5>
                                    @endif
                                    @if($plan->status != $Plan::STATUS_DRAFT)
                                        @if($plan->elements['additionalInfo']['NO_LINKED_INDICATORS'])
                                            <h5 class="red bold">{{ trans('plans.labels.noLinkedIndicators') . ': ' . $plan->elements['additionalInfo']['NO_LINKED_INDICATORS'] }}</h5>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(($loop->iteration % 2) === 0 || $loop->last)
            </div>
        @endif
    @endforeach
</div>

<div class="dashboard-title title_left col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3 class="col-lg-3 col-md-3 col-sm-3 col-xs-3">{{ trans('plans.labels.'.$Plan::SCOPE_INSTITUTIONAL) }} </h3>
    <ul class="nav navbar-right ">
        <li class="pull-right">
            <a id="createPEI" href="{{ route('create.plans.plans_management', ['scope'=>$Plan::SCOPE_INSTITUTIONAL]) }}" class="ajaxify white">
                <i class="fa fa-plus"></i> {{ trans('plans.labels.create.'.$Plan::SCOPE_INSTITUTIONAL) }}
            </a>
        </li>
    </ul>
</div>

<div class="row m-4">
    @foreach(collect($plans)->where('scope', $Plan::SCOPE_INSTITUTIONAL) as $plan)
        @if($loop->first || (($loop->iteration - 1) % 2) === 0)
            <div class="row">
                @endif
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt-4">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ \Illuminate\Support\Str::limit($plan->name, 50, '...') }}</h2>
                            <ul class="nav navbar-right panel_toolbox">

                                @if($plan->status != $Plan::STATUS_DRAFT)
                                    <li class="pull-right">
                                        <a data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.labels.link') }}"
                                           class="ajaxify"
                                           href="{{ route('plan.link.links.plans.plans_management', [
                                   'id'=> $plan->id
                               ]) }}">
                                            <i class="fa fa-link blue"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="pull-right">
                                        <a id="verify_PEI_{{ $plan->id }}" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('plans.labels.APPROVED') }}"
                                           @if(isset($plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS']) && $plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS'] == 0)
                                               class="ajaxify"
                                           href="{{ route('approve.plans.plans_management', [
                                    'id' => $plan->id,
                                    'no_indicators' => $plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS'],
                                    'projects' => $plan->elements[$PlanElement::TYPE_PROJECT] ]) }}"
                                           @else
                                               class="notify"
                                            @endif>
                                            <i class="fa fa-check-square-o green"></i>
                                        </a>
                                    </li>
                                @endif

                                <li class="pull-right">
                                    <a id="delete_plan_{{ $plan->id }}" data-toggle="tooltip" data-placement="top"
                                       data-original-title="@if($plan->type == $Plan::TYPE_PEI)
                               {{ trans('app.labels.archives') }}
                               @else
                               {{ trans('app.labels.delete') }}
                               @endif">
                                        <i class="fa @if($plan->type == $Plan::TYPE_PEI) fa-inbox green @else fa-trash text-danger @endif"></i>
                                    </a>
                                </li>
                                <li class="pull-right">
                                    <a data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.labels.edit') }}"
                                       class="ajaxify"
                                       href="{{ route('edit.plans.plans_management', [
                                   'id'=> $plan->id,
                                   'element_type' => $PlanElement::TYPE_OBJECTIVE
                               ]) }}">
                                        <i class="fa fa-edit orange"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>

                        </div>
                        <div class="x_content">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h5>{{ trans('plan_elements.titles.OBJECTIVE') . ': ' . $plan->elements[$PlanElement::TYPE_OBJECTIVE] }}</h5>
                                    <h5>{{ trans('plan_elements.titles.INDICATORS') . ': ' . $plan->elements[$PlanElement::TYPE_INDICATOR] }}</h5>
                                    <h5>{{ trans('plan_elements.titles.PROJECT') . ': ' . $plan->elements[$PlanElement::TYPE_PROJECT] }}</h5>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mt-3">
                                    <i class="{{ $plan->completness }}"></i>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 noVerticalGap">
                                    <h5>{{ trans('plans.labels.objWithIndicators') . ': ' . $plan->elements['additionalInfo']['OBJECTIVES_WITH_INDICATORS'] }}</h5>
                                    @if($plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS'])
                                        <h5 class="red bold">{{ trans('plans.labels.objWithoutIndicators') . ': ' . $plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS'] }}</h5>
                                    @endif
                                    @if($plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_PROJECTS'])
                                        <h5 class="red bold">{{ trans('plans.labels.objWithoutProjects') . ': ' . $plan->elements['additionalInfo']['OBJECTIVES_WITHOUT_PROJECTS'] }}</h5>
                                    @endif
                                    @if($plan->elements['additionalInfo']['PROGRAM_SUBPROGRAM_WITHOUT_PROJECTS'])
                                        <h5 class="red bold">{{ trans('plans.labels.programWithoutProjects') . ': ' . $plan->elements['additionalInfo']['PROGRAM_SUBPROGRAM_WITHOUT_PROJECTS'] }}</h5>
                                    @endif

                                    @if(!$plan->elements[$PlanElement::TYPE_PROJECT])
                                        <h5 class="red bold">{{ trans('plans.labels.planWithoutProjects') . ': ' . $plan->elements[$PlanElement::TYPE_PROJECT] }}</h5>
                                    @endif
                                    @if($plan->type == $Plan::TYPE_PEI)
                                        @if($plan->status != $Plan::STATUS_DRAFT)
                                            @if($plan->elements['additionalInfo']['NO_LINKED_INDICATORS'])
                                                <h5 class="red bold">{{ trans('plans.labels.noLinkedIndicators') . ': ' . $plan->elements['additionalInfo']['NO_LINKED_INDICATORS'] }}</h5>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(($loop->iteration % 2) === 0 || $loop->last)
            </div>
        @endif
    @endforeach
</div>

<script>
    $(() => {

        @foreach($plans as $plan)

        $('#delete_plan_{{ $plan->id }}').click(() => {

            let jsonData = {
                '_token': '{{ csrf_token() }}',
            };

            let confirmMessage = '{!! $plan->confirmMessage !!}';
            let url = '{!! route ('destroy.plans.plans_management', ['id' => $plan->id] ) !!}';

            let callback = (data = null, options = null) => {
                pushRequest(url, null, () => {
                }, 'post', data || jsonData, true, options);
            };

            @if(isJustifiable($plan))
            justificationModal(callback, jsonData, confirmMessage);
            @else
            confirmModal(confirmMessage, callback);
            @endif
        });

        @endforeach

        $('#createPEI').on('click', () => {
            if ($('#createPEI').hasClass('notify')) {
                notify('{{ trans('plans.messages.warning.planAlreadyExists') }}', 'warning', null);
            }
        })

        $('[id^=verify_PDOT_]').on('click', (e) => {
            if ($(e.currentTarget).hasClass('notify')) {
                notify('{{ trans('plans.messages.warning.approvalNotAllowed.' . $Plan::SCOPE_TERRITORIAL) }}', 'warning')
            }
        })

        $('[id^=verify_PEI_]').on('click', (e) => {
            if ($(e.currentTarget).hasClass('notify')) {
                notify('{{ trans('plans.messages.warning.approvalNotAllowed.' . $Plan::SCOPE_INSTITUTIONAL) }}', 'warning')
            }
        })

    });
</script>

@endpermission
