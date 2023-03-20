@permission('modify.logic_frame.projects_review.plans_management')
@inject('ProjectFiscalYear', 'App\Models\Business\Planning\ProjectFiscalYear')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('projects.labels.logic_frame') }}
                <small>{{ trans('project_review.title') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right mb-0">
                <li>
                    @if($entity_status == $ProjectFiscalYear::STATUS_REVIEWED)
                        @permission('index.projects.plans_management')
                        <a class="ajaxify" href="{{ route('index.projects.plans_management') }}"> {{ trans('projects.title') }}</a>
                        @endpermission
                    @else
                        @permission('index.projects_review.plans_management')
                        <a class="ajaxify" href="{{ route('index.projects_review.plans_management') }}"> {{ trans('projects.title') }}</a>
                        @endpermission
                    @endif
                </li>
                <li class="active"> {{ trans('projects.labels.logic_frame') }}</li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <input type="hidden" value="logic_frame" name="action_type">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-product-hunt"></i> {{ trans('projects.labels.logicFrame') }} </h2>
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
            <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                <label class="control-label col-md-12 col-sm-12 col-xs-12">
                    <h5 class="h5-subtitle">{{ trans('projects.labels.project') }}: <span class="h5-subtitle">{{ $entity->cup }} - {{ $entity->name }}</span></h5>
                </label>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true" style="">
            <div class="panel-body">
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12 col-xs-6">
                        <label class="control-label" for="obj_pei">
                            {{ trans('projects.labels.obj_pei') }}:
                        </label>
                        <p>@isset($entity->subProgram){{ $entity->subProgram->parent->parent->code }}
                            - {{ $entity->subProgram->parent->parent->description }}@endisset</p>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label" for="program">
                            {{ trans('projects.labels.program') }}:
                        </label>
                        <p>@isset($entity->subProgram){{ $entity->subProgram->parent->code }} - {{ $entity->subProgram->parent->description }}@endisset</p>

                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label" for="sub_program">
                            {{ trans('projects.labels.sub_program') }}:
                        </label>
                        <p>@isset($entity->subProgram){{ $entity->subProgram->code }} - {{ $entity->subProgram->description }}@endisset
                        </p>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label" for="program">
                            {{ trans('projects.labels.project') }}:
                        </label>
                        <p>{{ $entity->cup }} - {{ $entity->name }}</p>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label" for="purpose">
                        {{ trans('projects.labels.purpose') }}
                    </label>
                    <textarea name="purpose" id="purpose" class="form-control disabledInputs"
                              placeholder="{{ trans('projects.placeholders.objective') }}">{{ $entity->purpose }}</textarea>
                </div>

                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label" for="assumption">
                        {{ trans('projects.labels.assumptions') }}
                    </label>
                    <textarea name="assumptions" id="assumptions" class="form-control disabledInputs"
                              placeholder="{{ trans('projects.placeholders.assumptions') }}">{{ $entity->assumptions }}</textarea>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>

        <div class="accordion row" role="tablist" aria-multiselectable="true">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="panel">
                    <a class="panel-heading collapsed" role="tab" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false">
                        <h4 class="panel-title">{{ trans('projects.labels.indicators_logical_frame') }}</h4>
                    </a>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-expanded="false" style="height: 0">
                        <div class="panel-body">

                            <div id="indicators_list">
                                @include('business.planning.project_review.full_indicator.index', ['indicators' => $entity->indicators])
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <a class="panel-heading collapsed" role="tab" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false">
                        <h4 class="panel-title">{{ trans('projects.labels.component') }}</h4>
                    </a>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-expanded="false" style="height: 0">
                        <div class="panel-body">
                            <div id="components_list">
                                @include('business.planning.project_review.logic_frame.components.index', ['components' => $entity->components()->get()])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12" id="edit_area">
            </div>
        </div>
        <div class="clearfix"></div>

        @if($entity_status == $ProjectFiscalYear::STATUS_REVIEWED)
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <a href="{{ route('index.projects.plans_management') }}" class="btn btn-info ajaxify">
                    <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                </a>
            </div>
        @else
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <a href="{{ route('index.projects_review.plans_management') }}" class="btn btn-info ajaxify">
                    <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                </a>
            </div>
        @endif
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

