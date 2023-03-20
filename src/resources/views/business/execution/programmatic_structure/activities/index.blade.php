@permission('index.activities.project.programmatic_structure.execution')

<div>
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
                            <a href="{{ route('index.project.programmatic_structure.execution') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label col-md-6 col-sm-6 col-xs-6">
                            <h5 class="h5-subtitle">{{ trans('projects.labels.project') }}: <span class="h5-subtitle">{{ $project->cup }} - {{ $project->name }}</span></h5>
                        </label>
                        <ol class="breadcrumb pull-right">
                            <li class="active"> {{ trans('activities.title') }}</li>
                        </ol>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table class="table table-bordered detail-table">
                                <tbody>
                                <tr>
                                    <td class="w-20">{{ trans('activities.labels.exercise') }}</td>
                                    <td colspan="2">{{ $fiscalYear }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.objective_pei') }}</td>
                                    <td class="w-5">
                                        @isset($project->subProgram)
                                            {{ $project->subProgram->parent->parent->code }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($project->subProgram)
                                            {{ $project->subProgram->parent->parent->description }}
                                        @endisset
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.program') }}</td>
                                    <td>@isset($project->subProgram)
                                            {{ $project->subProgram->parent->code }}
                                        @endisset</td>
                                    <td>@isset($project->subProgram)
                                            {{ $project->subProgram->parent->description }}
                                        @endisset</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.sub_program') }}</td>
                                    <td>@isset($project->subProgram)
                                            {{ $project->subProgram->code }}
                                        @endisset</td>
                                    <td>@isset($project->subProgram)
                                            {{ $project->subProgram->description }}
                                        @endisset</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('activities.labels.project') }}</td>
                                    <td>{{ $project->cup }}</td>
                                    <td>{{ $project->name }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if(!$flag)
                        <div class="alert alert-warning align-center mb-5" role="alert">
                            {{ trans('projects.messages.errors.not_executing_unit') }}
                        </div>
                    @endif
                    <div id="activities">
                        <a href="{{ route('create.activities.project.programmatic_structure.execution', ['projectId' => $project->id]) }}"
                           class="btn btn-success ajaxify no-scroll-top pull-right url_button">
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
                                <th>{{ trans('activities.labels.encoded_value') }}</th>
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
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        let $table = $('#activities_tb');
        build_datatable($table, {
            ajax: {
                url: '{!! route('data.index.activities.project.programmatic_structure.execution', ['projectId' => $project->id, 'from_budget_adjustment' => (isset($from_budget_adjustment) ?
                        $from_budget_adjustment : 0) ]) !!}',
                "dataSrc": (response) => {
                    if (response.exception !== '') {
                        notify(response.exception, 'warning')
                    }
                    return response.data;
                }
            },
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
