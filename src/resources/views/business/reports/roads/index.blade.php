@permission('index.inventory_roads_report')

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
                    <i class="fa fa-list-alt"></i> {{ trans('reports/roads/roads_reports.title') }}
                </h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="row">
                    <div class="col-lg-9 col-md-10 col-sm-11 col-xs-12">
                        <div class="x_content mb-4" id="roads_reports">

                            @permission('index.inventory_roads.inventory_roads_report')
                            <div class="x_title mb-4">
                                <h2>
                                    <a href="{{ route('index.inventory_roads.inventory_roads_report') }}" class="ajaxify">
                                        {{ trans('reports/roads/roads_reports.labels.inventory_roads') }}
                                    </a>
                                </h2>
                                <div class="clearfix"></div>
                            </div>
                            @endpermission

                            @permission('index.cantonal_road_length.inventory_roads_report')
                            <div class="x_title mb-4">
                                <h2>
                                    <a href="{{ route('index.cantonal_road_length.inventory_roads_report') }}" class="ajaxify">
                                        {{ trans('reports/roads/roads_reports.labels.cantonal_road_length') }}
                                    </a>
                                </h2>
                                <div class="clearfix"></div>
                            </div>
                            @endpermission

                            @permission('index.cantonal_road_status.inventory_roads_report')
                            <div class="x_title mb-4">
                                <h2>
                                    <a href="{{ route('index.cantonal_road_status.inventory_roads_report') }}" class="ajaxify">
                                        {{ trans('reports/roads/roads_reports.labels.cantonal_road_status') }}
                                    </a>
                                </h2>
                                <div class="clearfix"></div>
                            </div>
                            @endpermission

                            @permission('index.cantonal_road_total.inventory_roads_report')
                            <div class="x_title mb-4">
                                <h2>
                                    <a href="{{ route('index.cantonal_road_total.inventory_roads_report') }}" class="ajaxify">
                                        {{ trans('reports/roads/roads_reports.labels.cantonal_road_total_length') }}
                                    </a>
                                </h2>
                                <div class="clearfix"></div>
                            </div>
                            @endpermission

                            @permission('index.cantonal_road_general_status.inventory_roads_report')
                            <div class="x_title mb-4">
                                <h2>
                                    <a href="{{ route('index.cantonal_road_general_status.inventory_roads_report') }}" class="ajaxify">
                                        {{ trans('reports/roads/roads_reports.labels.cantonal_road_general_status') }}
                                    </a>
                                </h2>
                                <div class="clearfix"></div>
                            </div>
                            @endpermission
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission