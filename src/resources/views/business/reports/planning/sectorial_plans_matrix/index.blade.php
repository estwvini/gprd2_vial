@permission('sectorial_plans_matrix.reports')
<div class="page-title">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h3>{{ trans('app.labels.reports') }}</h3>
        <h2>
            <i class="fa fa-list-alt"></i> {{ trans('reports.sectorial_plans.title') }}
        </h2>
    </div>
</div>
<div class="clearfix"></div>

<div id="report" class="row mb-15">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                @permission('export.sectorial_plans_matrix.reports')
                <form role="form" action="{{ route('export.sectorial_plans_matrix.reports') }}" id="export_excel" method="get"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn pull-right pdf-export-button">
                                        <i class="fa fa-file-excel-o"></i>
                                        {{ trans('reports.export.excel') }}
                                    </button>
                                </span>
                        </div>
                    </div>
                </form>
                @endpermission

                <div class="clearfix"></div>
            </div>
            <div class="x_content overflow-scroll">

                @include('business.reports.planning.sectorial_plans_matrix.table')

            </div>
        </div>
    </div>
</div>

<footer class="navbar-default navbar-fixed-bottom text-center">
    <a id="cancelLinks" href="{{ route('index.reports') }}"
       class="btn btn-info ajaxify">{{ trans('app.labels.backward') }}
    </a>
</footer>

@else
    @include('errors.403')
    @endpermission