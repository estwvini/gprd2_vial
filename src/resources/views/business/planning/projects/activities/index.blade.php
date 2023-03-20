@permission('list.activities.projects.plans_management|list.activities.projects.budget_adjustment.budget.plans_management')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('activities.title') }}
                <small>{{ trans('app.labels.planning') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                @if(!isset($from_budget_adjustment))
                    @permission('index.projects.plans_management')
                    <li>
                        <a class="ajaxify" href="{{ route('index.projects.plans_management') }}"> {{ trans('projects.title') }}</a>
                    </li>
                    @endpermission
                @else
                    @permission('index.budget_adjustment.budget.plans_management')
                    <li>
                        <a class="ajaxify" href="{{ route('index.budget_adjustment.budget.plans_management') }}"> {{ trans('budget_adjustment.title') }}</a>
                    </li>
                    @endpermission
                @endif

                <li class="active"> {{ trans('activities.title') }}</li>
            </ol>
        </div>
    </div>

    @includeWhen(!isset($from_budget_adjustment) || $from_budget_adjustment, 'business.planning.projects.partial.navigation')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-tasks"></i> {{ trans('activities.title') }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            @if(!isset($from_budget_adjustment))
                                <a href="{{ route('index.projects.plans_management') }}" class="btn btn-box-tool ajaxify">
                                    <i class="fa fa-times"></i>
                                </a>
                            @else
                                <a href="{{ route('index.budget_adjustment.budget.plans_management') }}" class="btn btn-box-tool ajaxify">
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
                                        @isset($entity->subProgram)
                                            {{ $entity->subProgram->parent->parent->code }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($entity->subProgram)
                                            {{ $entity->subProgram->parent->parent->description }}
                                        @endisset
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.program') }}</td>
                                    <td>@isset($entity->subProgram)
                                            {{ $entity->subProgram->parent->code }}
                                        @endisset</td>
                                    <td>@isset($entity->subProgram)
                                            {{ $entity->subProgram->parent->description }}
                                        @endisset</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.sub_program') }}</td>
                                    <td>@isset($entity->subProgram)
                                            {{ $entity->subProgram->code }}
                                        @endisset</td>
                                    <td>@isset($entity->subProgram)
                                            {{ $entity->subProgram->description }}
                                        @endisset</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.project') }}</td>
                                    <td>{{ $entity->cup }}</td>
                                    <td>{{ $entity->name }}</td>
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
                    @if(!$flag)
                        <div class="alert alert-warning align-center mb-5" role="alert">
                            {{ trans('projects.messages.errors.not_executing_unit') }}
                        </div>
                    @endif
                    <div role="tabpanel">
                        <ul class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#activities" id="activities-tab" role="tab" data-toggle="tab" aria-expanded="true">{{ trans('activities.title') }}</a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#budget-planning" role="tab" id="budget-planning-tab" data-toggle="tab" aria-expanded="false">Planificación Presupuestaria</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="activities">
                                <a href="{{ route('create.activities.projects.plans_management', ['projectId' => $entity->id]) }}"
                                   class="btn btn-success ajaxify pull-right url_button">
                                    <i class="fa fa-plus"></i> {{ trans('activities.labels.create') }}
                                </a>
                                <table class="table table-striped" id="activities_tb">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ trans('activities.labels.code') }}</th>
                                        <th>{{ trans('activities.labels.component') }}</th>
                                        <th>{{ trans('app.headers.name') }}</th>
                                        <th>{{ trans('activities.labels.area') }}</th>
                                        <th>{{ trans('activities.labels.budget') }}</th>
                                        <th>{{ trans('activities.labels.initial_value') }}</th>
                                        <th>{{ trans('app.labels.actions') }}</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr id="tfoot-tr-1">
                                        <th class="text-right" colspan="6">{{ trans('app.labels.footer_subtotal') }}</th>
                                        <th class="text-center" id="tfoot-th-subtotal"></th>
                                        <th></th>
                                    </tr>
                                    <tr id="tfoot-tr-2">
                                        <th class="text-right" colspan="6">{{ trans('app.labels.footer_total') }}</th>
                                        <th class="text-center" id="tfoot-th-total"></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="budget-planning">
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('business.planning.projects.activities.budget_planning')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        let $table = build_datatable($('#activities_tb'), {
            ajax: '{!! route('data.list.activities.projects.plans_management', ['projectId' => $entity->id, 'from_budget_adjustment' => (isset($from_budget_adjustment) ?
            $from_budget_adjustment : 0) ]) !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'component', visible: false, sortable: false, searchable: false},
                {data: 'code', width: '10%', sortable: false, class: 'text-center'},
                {data: 'name', width: '40%', sortable: false},
                {data: 'area', width: '15%', sortable: false, class: 'text-center'},
                {data: 'has_budget', width: '10%', sortable: false, class: 'text-center'},
                {data: 'amount', width: '15%', sortable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ],
            rowGroup: {
                startRender: (rows, group) => {
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

                    let tr = $('<tr/>').append('<td colspan="4">' + group + '</td>');

                    // calculate activity(group) subtotals for all numeric columns
                    let subTotal = rows
                        .data()
                        .pluck($table.settings()[0].aoColumns[6].data)
                        .reduce((a, b) => {
                            return parseFloat(numericVal(a)) + parseFloat(numericVal(b));
                        }, 0);
                    tr.append('<td class="text-center text-success">' + '$ ' + $.number(subTotal, 2) + '</td>');
                    tr.append('<td></td>');

                    return tr;
                },
                dataSrc: 'component'
            },
            footerCallback: function () {
                let api = this.api(), json = api.ajax.json();

                // Remove the formatting to get numeric data for summation
                let numericVal = (i) => {

                    if (typeof i === 'string') {
                        i = i.replace(/[\$,]/g, '') * 1;
                    }
                    // check if number is valid.
                    if (Number.isNaN(i)) {
                        return 0;
                    }
                    return i;
                };

                // Current page total
                let pageTotal = api
                    .column(6, {page: 'current'})
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
            }
        });

        $('#referential_budget').number(true, 2);
    });
</script>

@else
    @include('errors.403')
    @endpermission
