@permission('list.activities.projects_review.plans_management')
@inject('ProjectFiscalYear', 'App\Models\Business\Planning\ProjectFiscalYear')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('activities.title') }}
                <small>{{ trans('project_review.title') }}</small>
            </h3>
        </div>
    </div>
    <div class="title_right hidden-xs">
        <ol class="breadcrumb pull-right">

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


            <li class="active"> {{ trans('activities.title') }}</li>
        </ol>
    </div>

    <div class="item form-group col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-12 col-sm-12 col-xs-12">
            <h5 class="h5-subtitle">{{ trans('projects.labels.project') }}: <span class="h5-subtitle">{{ $project->cup }} - {{ $project->name }}</span></h5>
        </label>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-tasks"></i> {{ trans('activities.title') }}
                    </h2>
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
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered detail-table">
                                <tbody>
                                <tr>
                                    <td class="w-20">{{ trans('activities.labels.exercise') }}</td>
                                    <td colspan="2">{{ $fiscalYear }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.objective_pei') }}</td>
                                    <td class="w-5">
                                        @isset($project->subProgram) {{ $project->subProgram->parent->parent->code }} @endisset
                                    </td>
                                    <td>
                                        @isset($project->subProgram) {{ $project->subProgram->parent->parent->description }} @endisset
                                    </td>
                                </tr>
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
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div style="text-align: center; margin-bottom: 17px">
                                          <span id="chart" class="chart" data-percent="">
                                              <span class="percent"></span>
                                          </span>
                                    </div>
                                    <h3 class="text-center">{{ trans('activities.labels.budget') }} {{ $fiscalYear }}</h3>
                                    <div class="divider"></div>
                                    <p class="text-center">{{ trans('activities.labels.planned_approved') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        <li class="list-group-item text-center">
                                            <h4 class="list-group-item-heading">{{ trans('activities.labels.approved') }}</h4>
                                            <p class="list-group-item-text" style="font-size: 20px">$ <span id="referential_budget">{{ $referential_budget }}</span></p>
                                        </li>
                                        <li class="list-group-item text-center">
                                            <h4 class="list-group-item-heading">{{ trans('activities.labels.planned') }}</h4>
                                            <p class="list-group-item-text green" style="font-size: 20px" id="planned_budget"></p>
                                        </li>
                                        <li class="list-group-item text-center">
                                            <h4 class="list-group-item-heading">{{ trans('activities.labels.difference') }}</h4>
                                            <p class="list-group-item-text orange" style="font-size: 20px" id="difference_budget"></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel">
                        <ul class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#activities" id="activities-tab" role="tab" data-toggle="tab" aria-expanded="true">{{ trans('activities.title') }}</a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#budget-planning" role="tab" id="budget-planning-tab" data-toggle="tab" aria-expanded="false">Presupuesto</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="activities">
                                <table class="table table-striped" id="activities_tb">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ trans('activities.labels.code') }}</th>
                                        <th>{{ trans('app.headers.name') }}</th>
                                        <th>{{ trans('activities.labels.budget') }}</th>
                                        <th>{{ trans('activities.labels.initial_value') }}</th>
                                        <th>{{ trans('app.labels.actions') }}</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr id="tfoot-tr-1">
                                        <th class="text-right" colspan="4">{{ trans('app.labels.footer_subtotal') }}</th>
                                        <th class="text-center" id="tfoot-th-subtotal"></th>
                                        <th></th>
                                    </tr>
                                    <tr id="tfoot-tr-2">
                                        <th class="text-right" colspan="4">{{ trans('app.labels.footer_total') }}</th>
                                        <th class="text-center" id="tfoot-th-total"></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="budget-planning">
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('business.planning.project_review.activities.budget_planning')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
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

<script>
    $(() => {
        let $table = $('#activities_tb');
        $(".disabledInputs").prop('disabled', true);

        /**
         * Actualiza gráfica y resumen del presupuesto
         */
        const updatePlannedBudget = (planned_budget) => {
            let referential_budget = parseFloat('{{ $referential_budget }}');
            let difference = referential_budget - planned_budget;
            $('#planned_budget').text(planned_budget).number(true, 2).text('$ ' + $('#planned_budget').text());
            $('#difference_budget').text(difference).number(true, 2).text('$ ' + $('#difference_budget').text());

            if (referential_budget > 0) {
                chart.update(planned_budget * 100 / referential_budget);
            } else {
                chart.update(0.00)
            }
        };

        $('#chart').easyPieChart({
            easing: "easeOutElastic",
            delay: 3e3,
            barColor: "#26B99A",
            trackColor: "#fff",
            scaleColor: !1,
            lineWidth: 20,
            trackWidth: 16,
            lineCap: "butt",
            onStep: function (a, b, c) { // No ES6
                $(this.el).find(".percent").text(c.toFixed(2))
            }
        });

        let chart = $('#chart').data('easyPieChart');

        build_datatable($table, {
            ajax: '{!! route('data.list.activities.projects_review.plans_management', ['projectId' => $project->id]) !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'code', width: '10%'},
                {data: 'name', width: '55%'},
                {data: 'has_budget', width: '10%'},
                {data: 'amount', width: '15%', class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ],
            footerCallback: function () {
                let api = this.api(), json = api.ajax.json();

                // Remove the formatting to get numeric data for summation
                let numericVal = (i) => {

                    if (typeof i === 'string') {
                        i = i.replace(/[\£,]/g, '') * 1;
                    }
                    // check if number is valid.
                    if (Number.isNaN(i)) {
                        return 0;
                    }
                    return i;
                };

                // Current page total
                let pageTotal = api
                    .column(4, {page: 'current'})
                    .data()
                    .reduce((a, b) => {
                        return parseFloat(numericVal(a)) + parseFloat(numericVal(b));
                    }, 0);

                // Update footer
                $('#tfoot-tr-1 #tfoot-th-subtotal').text(
                    pageTotal
                ).number(true, 2).text(`$ ${$('#tfoot-tr-1 #tfoot-th-subtotal').text()}`);
                $('#tfoot-tr-2 #tfoot-th-total').html(
                    '$ ' + (json.totalAmount !== undefined ? json.totalAmount : 0.00)
                );
                updatePlannedBudget(json.totalAmount !== undefined ? parseFloat(json.totalAmount.replace(/,/g, '')) : 0.00);
            }
        });
        $('#referential_budget').number(true, 2);
    });
</script>

@else
    @include('errors.403')
    @endpermission