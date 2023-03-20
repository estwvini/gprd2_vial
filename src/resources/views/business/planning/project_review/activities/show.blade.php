@permission('items.activities.projects_review.plans_management')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('activities.title') }}
                <small>{{ trans('project_review.title') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                @permission('index.projects_review.plans_management')
                <li>
                    <a class="ajaxify" href="{{ route('index.projects_review.plans_management') }}"> {{ trans('projects.title') }}</a>
                </li>
                @endpermission

                @permission('list.activities.projects_review.plans_management')
                <li>
                    <a class="ajaxify" href="{{ route('list.activities.projects_review.plans_management', ['projectId' => $project->id]) }}"> {{ trans('activities.title') }}</a>
                </li>
                @endpermission

                <li class="active"> {{ trans('activities.labels.budget_items') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-money"></i> {{ trans('activities.labels.budget_items') }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('list.activities.projects_review.plans_management', ['projectId' => $project->id]) }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered detail-table">
                                <tbody>
                                <tr>
                                    <td class="w-20">{{ trans('activities.labels.exercise') }}</td>
                                    <td colspan="2">{{ $fiscalYear }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.responsibleUnit') }}</td>
                                    <td class="w-5">
                                        @isset($project->responsibleUnit) {{ $project->responsibleUnit->code }} @endisset
                                    </td>
                                    <td>
                                        @isset($project->responsibleUnit) {{ $project->responsibleUnit->name }} @endisset
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.executingUnit') }}</td>
                                    <td>
                                        @isset($project->executingUnit) {{ $project->executingUnit->code }} @endisset
                                    </td>
                                    <td>
                                        @isset($project->executingUnit) {{ $project->executingUnit->name }} @endisset
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.area') }}</td>
                                    <td>
                                        @isset($activity->area) {{ $activity->area->code }} @endisset
                                    </td>
                                    <td>
                                        @isset($activity->area) {{ $activity->area->area }} @endisset
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-20">{{ trans('activities.labels.objective_pei') }}</td>
                                    <td class="w-5">
                                        @isset($project->subProgram) {{ $project->subProgram->parent->parent->code }} @endisset
                                    </td>
                                    <td>
                                        @isset($project->subProgram) {{ $project->subProgram->parent->parent->description }} @endisset
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-bordered detail-table">
                                <tbody>
                                <tr>
                                    <td>{{ trans('activities.labels.program') }}</td>
                                    <td>@isset($project->subProgram) {{ $project->subProgram->parent->code }} @endisset</td>
                                    <td>@isset($project->subProgram) {{ $project->subProgram->parent->description }} @endisset</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.sub_program') }}</td>
                                    <td>@isset($project->subProgram) {{ $project->subProgram->code }} @endisset</td>
                                    <td>@isset($project->subProgram) {{ $project->subProgram->description }} @endisset</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.project') }}</td>
                                    <td>{{ $project->cup }}</td>
                                    <td>{{ $project->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.activity') }}</td>
                                    <td>{{ $activity->code }}</td>
                                    <td>{{ $activity->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.approved') }}</td>
                                    <td colspan="2">$ {{ $referentialBudget }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.planned') }}</td>
                                    <td colspan="2" class="green" id="planningBudget">$ {{ $planningBudget }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.difference') }}</td>
                                    <td colspan="2" class="orange" id="difference">$ {{ $difference }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" id="budget_items_list">
                            @include('business.planning.project_review.activities.budget_items.index', ['activity' => $activity])
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12" id="public_purchases_list">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission