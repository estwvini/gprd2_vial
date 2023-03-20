@permission('edit.profile.projects.plans_management')
@inject('ProjectFiscalYear', 'App\Models\Business\Planning\ProjectFiscalYear')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('projects.title') }}
                <small>{{ trans('project_review.title') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @if($entity_status == $ProjectFiscalYear::STATUS_REVIEWED)
                    @permission('index.projects.plans_management')
                    <li>
                        <a class="ajaxify" href="{{ route('index.projects.plans_management') }}"> {{ trans('projects.title') }}</a>
                    </li>
                    @endpermission
                @else
                    @permission('index.projects_review.plans_management')
                    <li>
                        <a class="ajaxify" href="{{ route('index.projects_review.plans_management') }}"> {{ trans('projects.title') }}</a>
                    </li>
                    @endpermission
                @endif
                <li class="active"> {{ trans('projects.labels.profile') }}</li>
            </ol>
        </div>
    </div>

    <div class="item form-group col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-12 col-sm-12 col-xs-12">
            <h5 class="h5-subtitle">{{ trans('projects.labels.project') }}: <span class="h5-subtitle">{{ $entity->cup }} - {{ $entity->name }}</span></h5>
        </label>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-product-hunt"></i> {{ trans('projects.labels.profile') }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            @if($entity_status == $ProjectFiscalYear::STATUS_REVIEWED)
                                <a href="{{ route('index.projects.plans_management') }}" class="btn btn-box-tool ajaxify">
                                    <i class="fa fa-times"></i>
                                </a>
                            @else
                                <a href="{{ route('index.projects_review.plans_management') }}" class="btn btn-box-tool ajaxify">
                                    <i class="fa fa-times"></i>
                                </a>
                            @endif
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-label-left">

                        @method('PUT')
                        @csrf
                        <input type="hidden" value="profile" name="action_type">

                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label" for="operational_goal_id">
                                    {{ trans('projects.labels.operational_goal') }}
                                </label>
                                <select class="form-control select2" id="operational_goal_id" name="operational_goal_id" disabled>
                                    <option value=""></option>
                                    @foreach($operationalGoals as $item)
                                        <option value="{{ $item->id }}" @if($item->id == $entity->operational_goal_id) selected @endif>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label" for="name">
                                    {{ trans('app.headers.name') }}
                                </label>
                                <input type="text" id="name" disabled
                                       class="form-control disabledInputs" value="{{ $entity->name ?? '' }}"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label" for="cup">
                                    {{ trans('projects.labels.cup') }}
                                </label>
                                <input type="text" id="cup" disabled
                                       class="form-control disabledInputs" value="{{ $entity->cup ?? '' }}"/>
                            </div>

                            <div class="form-group  col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label" for="initial_budget">
                                    {{ trans('projects.labels.initial_budget') }}
                                </label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="number" disabled id="initial_budget"
                                           class="form-control disabledInputs" value="{{ $entity->referential_budget ?? '' }}"/>
                                </div>
                            </div>

                            <div class="form-group  col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label" for="month_duration">
                                    {{ trans('projects.labels.month_duration') }}
                                </label>
                                <input type="text" id="month_duration" disabled class="form-control disabledInputs" value="{{ $entity->month_duration }}"/>
                            </div>

                            <div class="row">
                                <div class="form-group  col-md-3 col-sm-3 col-xs-12">
                                    <label class="control-label" for="execution_term">
                                        {{ trans('projects.labels.execution_term') }}
                                    </label>
                                    <input type="text" id="execution_term" disabled class="form-control disabledInputs" value="{{ $entity->execution_term }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label" for="created_at">
                                    {{ trans('projects.labels.registration_date') }}
                                </label>
                                <input type="text" id="created_at" disabled class="form-control disabledInputs" value="{{ formatDate($entity->created_at, 'd-m-Y') }}"/>
                            </div>

                            <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label" for="date_init">
                                    {{ trans('projects.labels.init_date') }}
                                </label>
                                <input type="text" id="date_init" disabled class="form-control disabledInputs" value="{{ formatDate($entity->date_init, 'd-m-Y') }}"/>
                            </div>

                            <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label" for="date_end">
                                    {{ trans('projects.labels.end_date') }}
                                </label>
                                <input type="text" id="date_end" disabled class="form-control disabledInputs" value="{{ formatDate($entity->date_end, 'd-m-Y') }}"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group  col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label" for="tir">
                                    {{ trans('projects.labels.tir') }}
                                </label>
                                <input type="text" id="tir" disabled class="form-control" value="{{ $entity->tir }}"/>
                            </div>

                            <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label" for="van">
                                    {{ trans('projects.labels.van') }}
                                </label>
                                <input type="text" id="van" disabled class="form-control" value="{{ $entity->van }}"/>
                            </div>

                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label" for="date_end">
                                    {{ trans('projects.labels.benefit_cost') }}
                                </label>
                                <textarea id="benefit_cost" disabled
                                          class="form-control">{{ $entity->benefit_cost }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label" for="description">
                                    {{ trans('app.headers.description') }}
                                </label>
                                <textarea name="description" id="description" class="form-control disabledInputs disabledInputs" disabled>{{ $entity->description ?? '' }}</textarea>
                            </div>

                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label" for="qualitative_benefit">
                                    {{ trans('projects.labels.qualitative_benefit') }} 
                                </label>
                                <textarea name="qualitative_benefit" id="qualitative_benefit" class="disabledInputs form-control" required
                                          placeholder="{{ trans('projects.placeholders.qualitative_benefit') }}">{{ $entity->qualitative_benefit ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label" for="responsibleUnit">
                                    {{ trans('projects.labels.responsibleUnit') }}
                                </label>
                                <input type="text" id="responsibleUnit" disabled class="form-control disabledInputs" value="{{ $entity->responsibleUnit->name }}"/>
                            </div>

                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label" for="requirements">
                                    {{ trans('projects.labels.requirements') }}
                                </label>
                                <textarea name="requirements" id="requirements" class="form-control disabledInputs"
                                          placeholder="{{ trans('projects.placeholders.requirements') }}">{{ $entity->requirements ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label" for="executing_unit_id">
                                    {{ trans('projects.labels.executingUnit') }} 
                                </label>
                                <select class="form-control select2 disabledInputs" id="executing_unit_id" name="executing_unit_id" required>
                                    @foreach($executingUnits as $eu)
                                        <option value="{{ $eu->id }}" @if($eu->id == $entity->executing_unit_id) selected @endif>
                                            {{ $eu->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label" for="leader_id">
                                    {{ trans('projects.labels.leader') }} 
                                </label>
                                <select class="form-control select2 disabledInputs" id="leader_id" required name="leader_id" @if(count($users) == 0) disabled @endif>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($leader && $user->id == $leader->id) selected @endif>
                                            {{ $user->fullName() }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label" for="product_description_service">
                                    {{ trans('projects.labels.product_description_service') }} 
                                </label>
                                <textarea name="product_description_service" id="product_description_service" class="form-control disabledInputs" required
                                          placeholder="{{ trans('projects.placeholders.product_description_service') }}">{{ $entity->product_description_service ?? '' }}</textarea>
                            </div>

                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label" for="approval_criteria">
                                    {{ trans('projects.labels.approval_criteria') }} 
                                </label>
                                <textarea name="approval_criteria" id="approval_criteria" class="form-control disabledInputs" required
                                          placeholder="{{ trans('projects.placeholders.approval_criteria') }}">{{ $entity->approval_criteria ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label" for="general_risks">
                                    {{ trans('projects.labels.general_risks') }} 
                                </label>
                                <textarea name="general_risks" id="general_risks" class="form-control disabledInputs" required
                                          placeholder="{{ trans('projects.placeholders.general_risks') }}">{{ $entity->general_risks ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        @if($entity_status == $ProjectFiscalYear::STATUS_REVIEWED)
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <a href= "{{ route('index.projects.plans_management') }}" class="btn btn-info ajaxify">
                                    <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                                </a>
                            </div>
                        @else
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <a href= "{{ route('index.projects_review.plans_management') }}" class="btn btn-info ajaxify">
                                    <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        $(".disabledInputs").prop('disabled', true);

    });
</script>

@else
    @include('errors.403')
    @endpermission