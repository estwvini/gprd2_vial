@permission('index.reports')
@inject('Plan', '\App\Models\Business\Plan')
<div class="page-title">
    <div class="title_left">
        <h3>{{ trans('app.labels.reports') }}</h3>
    </div>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <i class="fa fa-list-alt"></i> {{ trans('reports.labels.reports_list') }}
                </h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="dashboard-title title_left col-sm-12 col-xs-12">
                            <h3>
                                <a class="template-accordion" data-toggle="collapse" href="#planning">
                                    <i class="fa fa-plus pl-2 pr-2"></i>
                                    <i class="fa fa-minus hidden pl-2 pr-2"></i></a>
                                {{ trans('reports.labels.planning') }}
                            </h3>
                        </div>
                        <div class="x_content mb-4 collapse" id="planning">
                            @permission('index.ppi.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('index.ppi.reports') }}" class="ajaxify">
                                        {{ trans('reports.labels.reportPpi') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('annual_budget_planning.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('annual_budget_planning.reports') }}" class="ajaxify">
                                        {{ trans('reports.labels.annual_budget_planning') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('index.pndandpdot.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('index.pndandpdot.reports') }}" class="ajaxify">
                                        {{ trans('reports.labels.reportPDOTandPND') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('index.psandpnd.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('index.psandpnd.reports') }}" class="ajaxify">
                                        {{ trans('reports.labels.reportPNDandPS') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('index.pdotandpei.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('index.pdotandpei.reports') }}" class="ajaxify">
                                        {{ trans('reports.labels.reportPEIandPDOT') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('index.pac.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('view.index.pac.reports') }}" class="ajaxify">
                                        {{ trans('reports.pac.title') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('lotaip.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('lotaip.reports') }}" class="ajaxify">
                                        {{ trans('reports.lotaip.title') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('pei_structure_report.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('pei_structure_report.reports') }}" class="ajaxify">
                                        {{ trans('reports.pei_structure.title') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('sectorial_plans_matrix.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('sectorial_plans_matrix.reports') }}" class="ajaxify">
                                        {{ trans('reports.sectorial_plans.title') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('agreement_for_results.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('agreement_for_results.reports') }}" class="ajaxify">
                                        {{ trans('reports.agreement_for_results.title') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('index.executive_summary.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('index.executive_summary.reports') }}" class="ajaxify">
                                        {{ trans('reports.labels.reports_executive_summary') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('projects_repository.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('projects_repository.reports') }}" class="ajaxify">
                                        {{ trans('reports.labels.reports_projects_repository') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('incomes_expenses.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('incomes_expenses.reports') }}"
                                       class="ajaxify">
                                        {{ trans('reports.income_expense.title') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                        </div>

                        <div class="dashboard-title title_left col-sm-12 col-xs-12">
                            <h3>
                                <a class="template-accordion" data-toggle="collapse" href="#budget">
                                    <i class="fa fa-plus pl-2 pr-2"></i>
                                    <i class="fa fa-minus hidden pl-2 pr-2"></i>
                                </a>
                                {{ trans('reports.labels.budget') }}
                            </h3>
                        </div>
                        <div class="x_content mb-4 collapse" id="budget">
                            @permission('index.poa.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('view.index.poa.reports') }}" class="ajaxify">
                                        {{ trans('reports.poa.title_planning') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('budget_adjustment.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('budget_adjustment.reports') }}" class="ajaxify">
                                        {{ trans('reports.budget_adjustment.title') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('index.projects_activities.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('index.projects_activities.reports') }}" class="ajaxify">
                                        {{ trans('reports.project_activities_poa.title') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                        </div>

                        <div class="dashboard-title title_left col-sm-12 col-xs-12">
                            <h3>
                                <a class="template-accordion" data-toggle="collapse" href="#execution">
                                    <i class="fa fa-plus pl-2 pr-2"></i>
                                    <i class="fa fa-minus hidden pl-2 pr-2"></i>
                                </a>
                                {{ trans('reports.labels.execution') }}
                            </h3>
                        </div>
                        <div class="x_content mb-4 collapse" id="execution">
                            @permission('physical_advance.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('physical_advance.reports') }}" class="ajaxify">
                                        {{ trans('reports.physical_advance.title') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                            @permission('activities_quarterly_execution.reports')
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                <h2>
                                    <a href="{{ route('activities_quarterly_execution.reports') }}" class="ajaxify">
                                        {{ trans('reports.labels.activities_quarterly_execution') }}
                                    </a>
                                </h2>
                                <div class="ln_solid mb-0 mt-0"></div>
                            </div>
                            @endpermission
                        </div>

                        <div class="dashboard-title title_left col-sm-12 col-xs-12">
                            <h3>
                                <a class="template-accordion" data-toggle="collapse" href="#tracing">
                                    <i class="fa fa-plus pl-2 pr-2"></i>
                                    <i class="fa fa-minus hidden pl-2 pr-2"></i>
                                </a>
                                {{ trans('reports.labels.tracing') }}
                            </h3>
                        </div>
                        <div class="x_content mb-4 collapse" id="tracing">

                            <div class="dashboard-title title_left col-sm-12 col-xs-12">
                                <h3>
                                    <a class="template-accordion" data-toggle="collapse" href="#tracing_1">
                                        <i class="fa fa-plus pl-2 pr-2"></i>
                                        <i class="fa fa-minus hidden pl-2 pr-2"></i>
                                    </a>
                                    Planificación
                                </h3>
                            </div>
                            <div class="x_content mb-4 collapse" id="tracing_1">
                                @permission('index.indicators.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="#" id="indicator_export_excel">
                                            {{ trans('reports.indicators.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('poa_tracking_physical_and_budget.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('poa_tracking_physical_and_budget.reports') }}"
                                           class="ajaxify">
                                            {{ trans('reports.labels.poaPhysicalBudget') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.planning_execution_projects.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a role="button" href="{{ route('index.planning_execution_projects.reports') }}"
                                           class="ajaxify">
                                            {{ trans('reports.labels.planning_execution_projects') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.executive_progress_unit.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.executive_progress_unit.reports') }}" class="ajaxify">
                                            {{ trans('reports.executive_progress_unit.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.progress_investment_project.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.progress_investment_project.reports') }}" class="ajaxify">
                                            {{ trans('reports.progress_investment_project.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.executive_progress_project.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.executive_progress_project.reports') }}" class="ajaxify">
                                            {{ trans('reports.executive_progress_project.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.progress_investment_projects_executed_programmed2.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.progress_investment_projects_executed_programmed2.reports') }}"
                                           class="ajaxify">
                                            {{ trans('reports.progress_investment_projects_executed_programmed.title_by_date') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.progress_investment_projects_executed_programmed.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.progress_investment_projects_executed_programmed.reports') }}"
                                           class="ajaxify">
                                            {{ trans('reports.progress_investment_projects_executed_programmed.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.admin_activities_budget.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.admin_activities_budget.reports') }}" class="ajaxify">
                                            {{ trans('reports.admin_activities_budget.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.admin_activities.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.admin_activities.reports') }}" class="ajaxify">
                                            {{ trans('reports.admin_activities.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.admin_activities_responsible_unit.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.admin_activities_responsible_unit.reports') }}"
                                           class="ajaxify">
                                            {{ trans('reports.admin_activities_responsible_unit.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.project_admin_activities.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.project_admin_activities.reports') }}" class="ajaxify">
                                            {{ trans('reports.project_admin_activities.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.execution_projects.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.execution_projects.reports') }}" class="ajaxify">
                                            {{ trans('reports.labels.execution_projects') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.reforms_and_certifications.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.reforms_and_certifications.reports') }}" class="ajaxify">
                                            {{ trans('reports.reforms_and_certifications.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.risk_mitigation_plan.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.risk_mitigation_plan.reports') }}" class="ajaxify">
                                            {{ trans('reports.risk_mitigation_plan.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('index.task_milestone.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.task_milestone.reports') }}" class="ajaxify">
                                            {{ trans('reports.task_milestone.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                                @permission('ongoing_projects.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('ongoing_projects.reports') }}" class="ajaxify">
                                            {{ trans('reports.ongoing_projects.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                            </div>

                            <div class="dashboard-title title_left col-sm-12 col-xs-12">
                                <h3>
                                    <a class="template-accordion" data-toggle="collapse" href="#tracing_2">
                                        <i class="fa fa-plus pl-2 pr-2"></i>
                                        <i class="fa fa-minus hidden pl-2 pr-2"></i>
                                    </a>
                                    Presupuesto
                                </h3>
                            </div>
                            <div class="x_content mb-4 collapse" id="tracing_2">
                                @if(api_available())
                                    @permission('index.poa_tracking.reports')
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                        <h2>
                                            <a href="{{ route('index.poa_tracking.reports') }}" class="ajaxify">
                                                {{ trans('reports.poa.title_tracking') }}
                                            </a>
                                        </h2>
                                        <div class="ln_solid mb-0 mt-0"></div>
                                    </div>
                                    @endpermission
                                    @permission('index.planning_accrued.reports')
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                        <h2>
                                            <a href="{{ route('index.planning_accrued.reports') }}" class="ajaxify">
                                                {{ trans('reports.planning_accrued.title') }}
                                            </a>
                                        </h2>
                                        <div class="ln_solid mb-0 mt-0"></div>
                                    </div>
                                    @endpermission
                                    @permission('index.participatory_budget.reports')
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                        <h2>
                                            <a href="{{ route('index.participatory_budget.reports') }}" class="ajaxify">
                                                {{ trans('reports.participatory_budget.title') }}
                                            </a>
                                        </h2>
                                        <div class="ln_solid mb-0 mt-0"></div>
                                    </div>
                                    @endpermission
                                    @permission('budget_card.reports')
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                        <h2>
                                            <a href="{{ route('budget_card.reports') }}" class="ajaxify">
                                                {{ trans('reports.labels.budget_card') }}
                                            </a>
                                        </h2>
                                        <div class="ln_solid mb-0 mt-0"></div>
                                    </div>
                                    @endpermission
                                    @permission('index.budget_card_expenses.reports')
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                        <h2>
                                            <a href="{{ route('index.budget_card_expenses.reports') }}" class="ajaxify">
                                                {{ trans('reports.budget_card_expenses.title') }}
                                            </a>
                                        </h2>
                                        <div class="ln_solid mb-0 mt-0"></div>
                                    </div>
                                    @endpermission
                                @endif
                                @permission('incomes_expenses_execution.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('incomes_expenses_execution.reports') }}" class="ajaxify">
                                            {{ trans('reports.income_expense.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                            </div>

                            <div class="dashboard-title title_left col-sm-12 col-xs-12">
                                <h3>
                                    <a class="template-accordion" data-toggle="collapse" href="#tracing_3">
                                        <i class="fa fa-plus pl-2 pr-2"></i>
                                        <i class="fa fa-minus hidden pl-2 pr-2"></i>
                                    </a>
                                    PAC
                                </h3>
                            </div>
                            <div class="x_content mb-4 collapse" id="tracing_3">
                                @permission('index.pac_tracking.reports')
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
                                    <h2>
                                        <a href="{{ route('index.pac_tracking.reports') }}" class="ajaxify">
                                            {{ trans('reports.pac.title') }}
                                        </a>
                                    </h2>
                                    <div class="ln_solid mb-0 mt-0"></div>
                                </div>
                                @endpermission
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.template-accordion').on('click', (e) => {
        $(e.currentTarget).find('i').each((index, element) => {
            $(element).hasClass('hidden') ? $(element).removeClass('hidden') : $(element).addClass('hidden')
        })
    });

    $('#indicator_export_excel').on('click', (e) => {
        e.preventDefault();

        $.ajax({
            url: '{{ route('index.indicators.reports') }}',
            method: 'GET',
            beforeSend: () => {
                showLoading();
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: (response) => {
                let a = document.createElement('a');
                let url = window.URL.createObjectURL(response);
                a.href = url;
                a.download = '{{ trans('reports.indicators.title') }}';
                document.body.append(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            }
        }).always(() => {
            hideLoading();
        });
    });

</script>

@else
    @include('errors.403')
    @endpermission
