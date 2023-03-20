@permission('index.items.operational_activities.current_expenditure_elements.budget.plans_management')

<div>
    <div class="page-title height-auto pb-0">
        <div class="title_left">
            <h3>{{ trans('operational_activities.title') }}
                <small>{{ trans('current_expenditure.title') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right mb-0">
                @permission('index.current_expenditure_elements.budget.plans_management')
                <li>
                    <a href="#" class="toggle-sidebar"> {{ trans('current_expenditure.title') }}</a>
                </li>
                @endpermission

                <li class="active"> {{ trans('current_expenditure.labels.budget_items') }}</li>
            </ol>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 pt-0">
        <h5 class="h5-subtitle">{{ trans('current_expenditure.labels.OPERATIONAL_ACTIVITY') }}:
            <span class="h5-subtitle">{{ $activity->name }}</span>
        </h5>
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
                        @permission('index.current_expenditure_elements.budget.plans_management')
                        <li class="pull-right">
                            <a class="btn btn-box-tool toggle-sidebar">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                        @endpermission
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered detail-table">
                                <tbody>
                                <tr>
                                    <td class="w-20">{{ trans('current_expenditure.labels.exercise') }}</td>
                                    <td colspan="2">{{ $fiscalYear }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('operational_activities.labels.responsibleUnit') }}</td>
                                    <td class="w-5">
                                        @isset($activity->responsibleUnit)
                                            {{ $activity->responsibleUnit->code }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($activity->responsibleUnit)
                                            {{ $activity->responsibleUnit->name }}
                                        @endisset
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('operational_activities.labels.executingUnit') }}</td>
                                    <td>
                                        @isset($activity->executingUnit)
                                            {{ $activity->executingUnit->code }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($activity->executingUnit)
                                            {{ $activity->executingUnit->name }}
                                        @endisset
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('current_expenditure.labels.area') }}</td>
                                    <td>
                                        @isset($activity->subprogram->parent->area)
                                            {{ $activity->subprogram->parent->area->code }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($activity->subprogram->parent->area)
                                            {{ $activity->subprogram->parent->area->area }}
                                        @endisset
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-bordered detail-table">
                                <tbody>
                                <tr>
                                    <td class="w-20">{{ trans('current_expenditure.labels.OPERATIONAL_ACTIVITY') }}</td>
                                    <td class="w-5">{{ $activity->code }}</td>
                                    <td>{{ $activity->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.program') }}</td>
                                    <td>@isset($activity->subprogram->parent)
                                            {{ $activity->subprogram->parent->code }}
                                        @endisset</td>
                                    <td>@isset($activity->subprogram->parent)
                                            {{ $activity->subprogram->parent->name }}
                                        @endisset</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.sub_program') }}</td>
                                    <td>@isset($activity->subprogram)
                                            {{ $activity->subprogram->code }}
                                        @endisset</td>
                                    <td>@isset($activity->subprogram)
                                            {{ $activity->subprogram->name }}
                                        @endisset</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($percentCurrentExpensesControl > $percentage_of_control)
                        <div class="alert alert-warning align-center" role="alert" id="div_percentage_of_control">
                            {{ trans('budget_item.labels.expenses_higher', ['percent' => ($percentage_of_control * 100) . '%']) }}
                            <input type="hidden" id="percentage_of_control" value="{{ $percentage_of_control }}">
                            <input type="hidden" id="incomes" value="{{ $incomes }}">
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12" id="budget_items_list">
                            @include('business.planning.projects.activities.budget_items.index', ['activity' => $activity])
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

<script>

    $(() => {
        /**
         * Desplazar panel a la derecha y viceversa.
         */
        const toggleSidebar = () => {
            $('#sidebar-left').toggleClass('collapsed')

            $('#budget-items-area').empty()
            $('#load-area').empty()
            $('#budget-planning-area').empty()

            $('li').each((index, element) => {
                $(element).removeClass('treeview-item-selected')
            })
            $('i').each((index, element) => {
                $(element).removeClass('treeview-action-item-selected')
            })

            $('#sidebar-right').toggleClass('hidden')
            $('.page-title').toggleClass('hidden')
        }

        $('.toggle-sidebar').on('click', () => {
            toggleSidebar()
        })
    })
</script>

@else
    @include('errors.403')
    @endpermission
