@permission('incomes_expenses.reports')
<div>
    <div class="page-title">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3>{{ trans('app.labels.reports') }}</h3>
            <h2>
                <i class="fa fa-list-alt"></i> {{ trans('reports.income_expense.title') }}
            </h2>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row tile_count col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-5ths col-sm-4 col-xs-12 tile_stats_count mt-3">
            <span class="count_top label label-warning"><i class="fa fa-usd"></i> {{ trans('reports.income_expense.incomes') }}</span>
            <div id="income" class="count adjustment-balance"></div>
        </div>
        <div class="col-md-5ths col-sm-4 col-xs-12 tile_stats_count mt-3">
            <span class="count_top label label-warning"><i class="fa fa-usd"></i> {{ trans('reports.income_expense.expenses') }}</span>
            <div id="expenses" class="count adjustment-balance"></div>
        </div>
        <div class="col-md-5ths col-sm-4 col-xs-12 tile_stats_count mt-3">
            <span class="count_top label label-danger"><i class="fa fa-usd"></i> {{ trans('reports.income_expense.diff') }}</span>
            <div id="balance" class="count text-danger adjustment-balance"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel col-md-12 col-sm-12 col-xs-12 mb-15">
                <div class="x_title">
                    <div class="text-right pull-right d-flex">
                        <label class="mt-3 mr-3" for="year">
                            {{ trans('reports.income_expense.year') }}
                        </label>
                        <select class="form-control" id="year">
                            @foreach($years as $year)
                                <option value="{{ $year->id }}" @if($year->year == $currentYear) selected @endif >{{ $year->year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content overflow-scroll" id="income_expense_table">

                </div>
            </div>
        </div>
    </div>
</div>

<footer class="navbar-default navbar-fixed-bottom text-center">
    <a id="cancelLinks" href="{{ route('index.reports') }}"
       class="btn btn-info ajaxify">{{ trans('app.labels.backward') }}
    </a>
</footer>

<script>
    $(() => {
        $('#year').select2({}).on('change', () => {
            query($('#year').val());
        });

        const query = (year) => {
            let url = '{{ route('data.incomes_expenses.reports', ['fiscalYearId' => '__ID__']) }}';
            url = url.replace('__ID__', year);
            pushRequest(url, '#income_expense_table', (response) => {
                $('#income').text(response.summary.incomes);
                $('#expenses').text(response.summary.expenses);
                $('#balance').text(response.summary.balance);
            }, 'get');
        };

        query($('#year').val());

    });
</script>

@else
    @include('errors.403')
    @endpermission