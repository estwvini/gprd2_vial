<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-product-hunt"></i> {{ trans('projects.labels.editLogicFrame') }}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right">
                        <a href="{{ $urlBack }}" class="btn btn-box-tool ajaxify">
                            <i class="fa fa-times"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true" style="">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12 col-xs-6">
                            <label class="control-label" for="obj_pei">
                                {{ trans('projects.labels.obj_pei') }}:
                            </label>
                            <p>@isset($entity->subProgram)
                                    {{ $entity->subProgram->parent->parent->code }}
                                    - {{ $entity->subProgram->parent->parent->description }}
                                @endisset</p>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="program">
                                {{ trans('projects.labels.program') }}:
                            </label>
                            <p>@isset($entity->subProgram)
                                    {{ $entity->subProgram->parent->code }} - {{ $entity->subProgram->parent->description }}
                                @endisset</p>

                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="sub_program">
                                {{ trans('projects.labels.sub_program') }}:
                            </label>
                            <p>@isset($entity->subProgram)
                                    {{ $entity->subProgram->code }} - {{ $entity->subProgram->description }}
                                @endisset
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
            </div>

            <div class="accordion row" role="tablist" aria-multiselectable="true">
                <div class="col-md-6 col-sm-6 col-xs-12">

                    <form role="form" action="{{ $url }}" method="post" id="projects_objective_fm">

                        @method('PUT')
                        @csrf
                        <input type="hidden" value="logic_frame" name="action_type">
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label" for="purpose">
                                    {{ trans('projects.labels.purpose') }}
                                </label>
                                <textarea name="purpose" id="purpose" class="form-control"
                                          placeholder="{{ trans('projects.placeholders.objective') }}">{{ $entity->purpose }}</textarea>
                            </div>

                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label" for="assumptions">
                                    {{ trans('projects.labels.assumptions') }}
                                </label>
                                <textarea name="assumptions" id="assumptions" class="form-control"
                                          placeholder="{{ trans('projects.placeholders.assumptions') }}">{{ $entity->assumptions }}</textarea>
                            </div>
                        </div>

                        @if(!$structureModule)
                            <div class="panel">
                                <a class="panel-heading collapsed" role="tab" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false">
                                    <h4 class="panel-title">{{ trans('projects.labels.indicators_logical_frame') }}</h4>
                                </a>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-expanded="false" style="height: 0">
                                    <div class="panel-body">
                                        @if($addOrDelete)
                                            <a href="{{ route($urlCreateFullIndicator, ['projectId' => $entity->id]) }}" data-ajaxify="#edit_area"
                                               class="btn btn-xs btn-success ajaxify pull-right">
                                                <i class="fa fa-plus"></i></a>
                                        @endif
                                        <div id="indicators_list">
                                            @include('business.planning.projects.full_indicator.index', ['indicators' => $entity->indicators])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="panel">
                            <a class="panel-heading collapsed" role="tab" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false">
                                <h4 class="panel-title">{{ trans('projects.labels.component') }}</h4>
                            </a>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-expanded="false" style="height: 0">
                                <div class="panel-body">
                                    @if($addOrDelete)
                                        <a href="{{ $urlCreateComponent }}" data-ajaxify="#edit_area"
                                           class="btn btn-xs btn-success ajaxify pull-right">
                                            <i class="fa fa-plus"></i></a>
                                    @endif
                                    <div id="components_list">
                                        @include('business.planning.projects.logic_frame.components.index', ['components' => $entity->components()->get(), 'structureModule' => $structureModule])
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ $urlBack }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12" id="edit_area">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        let $form = $('#projects_objective_fm');
        $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);
    });
</script>
