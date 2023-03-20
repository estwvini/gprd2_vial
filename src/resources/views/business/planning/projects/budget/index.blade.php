<div class="page-title">
    <div class="title_left">
        <h3>{{ trans('projects.title') }}
            <small>{{ trans('app.labels.planning') }}</small>
        </h3>
    </div>
    <div class="title_right hidden-xs">
        <ol class="breadcrumb pull-right">
            @permission('index.projects.plans_management')
            <li>
                <a class="ajaxify" href="{{ route('index.projects.plans_management') }}"> {{ trans('projects.title') }}</a>
            </li>
            @endpermission
            <li class="active"> {{ trans('projects.labels.budget') }}</li>
        </ol>
    </div>
</div>

@include('business.planning.projects.partial.navigation')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <i class="fa fa-dollar"></i> {{ $entity->name }}
                </h2>
                <div class="text-right pull-right d-flex">

                    <a href="{{ route('create.index.budget.projects.plans_management', ['projectFiscalYear' => $projectFiscalYear->id]) }}"
                       class="btn btn-success ajaxify no-scroll-top pull-right url_button">
                        <i class="fa fa-plus"></i> {{ trans('budget_item.labels.new') }}
                    </a>

                    <a href="{{ route('import.index.budget.projects.plans_management', ['projectFiscalYear' => $projectFiscalYear->id]) }}"
                       class="btn btn-info ajaxify">
                        <i class="fa fa-cloud-upload"></i> {{ trans('projects.import.import') }}</a>

                    <a href="{{ route('download.index.budget.projects.plans_management', ['projectFiscalYear' => $projectFiscalYear->id]) }}" class="btn btn-info">
                        <i class="fa fa-cloud-download"></i> {{ trans('projects.import.download') }}</a>

                    @if($replicate)
                        <a href="{{ route('replicate.index.budget.projects.plans_management', ['projectFiscalYear' => $projectFiscalYear->id]) }}"
                           class="btn btn-warning ajaxify">
                            <i class="fa fa-copy"></i> {{ trans('budget_item.labels.replicate') }}</a>
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

                <table class="table h30" id="budget_tb">
                    <thead>
                    <tr>
                        <th></th>
                        <th>{{ trans('budget_item.labels.code') }}</th>
                        <th>{{ trans('budget_item.labels.name') }}</th>
                        <th>{{ trans('budget_item.labels.description') }}</th>
                        <th>{{ trans('budget_item.labels.activity') }}</th>
                        <th>{{ trans('budget_item.labels.amount') }}</th>
                        <th></th>
                    </tr>
                    </thead>


                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        build_datatable($('#budget_tb'), {
            lengthMenu: [25, 50, 75, 100],
            ajax: '{!! route('data.index.budget.projects.plans_management', ['projectFiscalYear' => $projectFiscalYear->id]) !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'code', width: '40%', class: 'text-center'},
                {data: 'name', width: '30%'},
                {data: 'description', width: '10%'},
                {data: 'activityProjectFiscalYear', width: '10%'},
                {data: 'amount', width: '10%', class: 'text-center'},
                {data: 'actions', width: '10%', class: 'text-center', sortable: false, searchable: false}
            ]
        });
    });
</script>