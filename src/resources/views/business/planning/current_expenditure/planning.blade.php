@permission('index.budget_planning.current_expenditure_elements.budget.plans_management')

<div>
    <div class="page-title height-auto pb-0">
        <div class="title_left">
            <h3>{{ trans('operational_activities.title') }}
                <small>{{ trans('app.labels.planning') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right mb-0">
                @permission('index.current_expenditure_elements.budget.plans_management')
                <li>
                    <a class="toggle-sidebar" href="#"> {{ trans('current_expenditure.title') }}</a>
                </li>
                @endpermission
                <li class="active"> {{ trans('app.labels.planning') }}</li>
            </ol>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 pt-0">
        <h5 class="h5-subtitle">{{ trans('activities.labels.sub_program') }}:
            <span class="h5-subtitle">{{ $subprogram->name }}</span>
        </h5>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-puzzle-piece"></i> {{ trans('app.labels.planning') }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="#" class="toggle-sidebar btn btn-box-tool">
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
                                    <td colspan="2">{{ $subprogram->fiscalYear->year }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.program') }}</td>
                                    <td>@isset($subprogram->parent)
                                            {{ $subprogram->parent->code }}
                                        @endisset</td>
                                    <td>@isset($subprogram->parent)
                                            {{ $subprogram->parent->name }}
                                        @endisset</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.sub_program') }}</td>
                                    <td>@isset($subprogram)
                                            {{ $subprogram->code }}
                                        @endisset</td>
                                    <td>@isset($subprogram)
                                            {{ $subprogram->name }}
                                        @endisset</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @include('business.planning.projects.activities.budget_planning', ['currentExpenditure' => true])
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

        $('.toggle-sidebar').click(function () {
            toggleSidebar()
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission
