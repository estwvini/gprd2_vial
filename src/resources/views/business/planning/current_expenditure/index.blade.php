@permission('index.current_expenditure_elements.budget.plans_management')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('current_expenditure.title') }}
                <small>{{ trans('app.labels.budget') }}</small>
            </h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12 sidebar" id="sidebar-left">

            <div class="row tile_count col-md-12 col-sm-12 col-xs-12" id="budget_summary">

            </div>

            <div class="x_panel well-lg">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-cart-arrow-down"></i> {{ trans('current_expenditure.title') . ' - ' . trans('current_expenditure.labels.fiscal_year', ['fiscalYear' => $fiscalYear]) }}
                    </h2>
                    <div class="text-right pull-right d-flex">

                        <a href="{{ route('load.import.current_expenditure_elements.budget.plans_management') }}" class="btn btn-info ajaxify">
                            <i class="fa fa-cloud-upload"></i> {{ trans('current_expenditure.labels.import') }}</a>

                        <a href="{{ route('download.current_expenditure_elements.budget.plans_management') }}" class="btn btn-info">
                            <i class="fa fa-cloud-download"></i> {{ trans('current_expenditure.labels.download') }}</a>

                        @if(isset($replicate) && $replicate)
                            <a href="{{ route('replicate.current_expenditure_elements.budget.plans_management') }}"
                               class="btn btn-sm btn-warning ajaxify">
                                <i class="fa fa-copy"></i>{{ trans('current_expenditure.labels.replicate') }}</a>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(isset($failures) && $failures->isNotEmpty())
                        <table class="table table-error">
                            <tr class="bg-red-300 text-white fw-b">
                                <td>{{ trans('income.labels.row') }}</td>
                                <td>{{ trans('income.labels.column') }}</td>
                                <td>{{ trans('income.labels.errors') }}</td>
                            </tr>
                            @foreach($failures as $fail)
                                <tr class="bg-red-300 text-white">
                                    <td>{{ $fail->row() }}</td>
                                    <td>{{ $fail->attribute() }}</td>
                                    <td>
                                        <ul>
                                            @foreach($fail->errors() as $e)
                                                <li>
                                                    {{ $e }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                    <div id="load-tree" class="col-lg-5 col-md-5 col-sm-5 col-xs-10 mt-3 pl-0"></div>
                    <div id="load-area" class="col-lg-7 col-md-7 col-sm-7 col-xs-10 mt-3 p-0"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 sidebar collapsed hidden" id="sidebar-right">
            <div id="budget-items-area" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
            <div id="budget-planning-area" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
        </div>
    </div>

</div>

<script>
    $(() => {
        // Load tree structure
        const url = '{!! route('loadstructure.current_expenditure_elements.budget.plans_management') !!}'
        pushRequest(url, '#load-tree', null, 'GET', {'_token': '{!! csrf_token() !!}'});

        pushRequest('{{ route('load_budget_summary.current_expenditure_elements.budget.plans_management') }}', '#budget_summary', null, 'GET', {}, false)
    });
</script>

@else
    @include('errors.403')
    @endpermission
