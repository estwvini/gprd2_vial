@permission('edit_components.inventory_roads')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('general_characteristics_of_track.title') }}
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.inventory_roads')
                <li>
                    <a class="ajaxify"
                       href="{{ route('index.inventory_roads') }}"> {{ trans('general_characteristics_of_track.title') }}</a>
                </li>
                @endpermission

                <li class="active"> {{ trans('general_characteristics_of_track.labels.roads_components') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-automobile"></i> {{ trans('general_characteristics_of_track.labels.roads_components') }}
                    </h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <table class="table table-bordered detail-table">
                            <tbody>
                            <tr>
                                <td>
                                    {{ trans('general_characteristics_of_track.labels.code') }}
                                </td>
                                <td>
                                    {{ $entity->codigo }}
                                </td>
                                <td>
                                    {{ trans('general_characteristics_of_track.labels.province') }}
                                </td>
                                <td>
                                    {{ $entity->prov }}
                                </td>
                                <td>
                                    {{ trans('general_characteristics_of_track.labels.canton') }}
                                </td>
                                <td>
                                    {{ $entity->canton }}
                                </td>
                                <td>
                                    {{ trans('general_characteristics_of_track.labels.parish') }}
                                </td>
                                <td>
                                    {{ $entity->parroquia }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ trans('general_characteristics_of_track.labels.origin') }}
                                </td>
                                <td>
                                    {{ $entity->origen }}
                                </td>
                                <td>
                                    {{ trans('general_characteristics_of_track.labels.destiny') }}
                                </td>
                                <td>
                                    {{ $entity->destino }}
                                </td>
                                <td>
                                    {{ trans('general_characteristics_of_track.labels.longitude_initial') }}
                                </td>
                                <td>
                                    {{ $entity->longi }}
                                </td>
                                <td>
                                    {{ trans('general_characteristics_of_track.labels.longitude_finish') }}
                                </td>
                                <td>
                                    {{ $entity->longf }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="col-xs-2">
                        <ul class="nav custom-nav">
                            @permission('index.characteristics_of_track.inventory_roads')
                            <li role="presentation" @if(isset($sewer) || isset($bridge) || isset($ditch) || isset($slope) ||
                                isset($signal_horizontal) || isset($signal_vertical) || isset($traffic) || isset($mines) ||
                                isset($intersection) || isset($critical_point) || isset($conservation_needs) ||
                                isset($environmental_information) || isset($production) || isset($transportation_services) ||
                                isset($social_information) || isset($shape)) @else class="active" @endif>
                                <a href="#characteristics_of_track" data-toggle="tab">
                                    {{ trans('characteristics_of_track.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.sewer.inventory_roads')
                            <li role="presentation" @if(isset($sewer)) class="active" @endif>
                                <a href="#sewer" id="sewer_tab" data-toggle="tab" role="tab">
                                    {{ trans('sewer.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.bridge.inventory_roads')
                            <li role="presentation" @if(isset($bridge)) class="active" @endif>
                                <a href="#bridge" id="bridge_tab" data-toggle="tab" role="tab">
                                    {{ trans('bridge.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.ditch.inventory_roads')
                            <li role="presentation" @if(isset($ditch)) class="active" @endif>
                                <a href="#ditch" id="ditch_tab" data-toggle="tab" role="tab">
                                    {{ trans('ditch.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.slope.inventory_roads')
                            <li role="presentation" @if(isset($slope)) class="active" @endif>
                                <a href="#slope" id="slope_tab" data-toggle="tab" role="tab">
                                    {{ trans('slope.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.signal_vertical.inventory_roads')
                            <li role="presentation" @if(isset($signal_vertical)) class="active" @endif>
                                <a href="#signal_vertical" id="signal_vertical_tab" data-toggle="tab" role="tab">
                                    {{ trans('signal_vertical.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.signal_horizontal.inventory_roads')
                            <li role="presentation" @if(isset($signal_horizontal)) class="active" @endif>
                                <a href="#signal_horizontal" id="signal_horizontal_tab" data-toggle="tab" role="tab">
                                    {{ trans('signal_horizontal.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.traffic.inventory_roads')
                            <li role="presentation" @if(isset($traffic)) class="active" @endif>
                                <a href="#traffic" id="traffic_tab" data-toggle="tab" role="tab">
                                    {{ trans('traffic.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.mines.inventory_roads')
                            <li role="presentation" @if(isset($mines)) class="active" @endif>
                                <a href="#mines" id="mines_tab" data-toggle="tab" role="tab">
                                    {{ trans('mines.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.intersection.inventory_roads')
                            <li role="presentation" @if(isset($intersection)) class="active" @endif>
                                <a href="#intersection" id="intersection_tab" data-toggle="tab" role="tab">
                                    {{ trans('intersection.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.critical_point.inventory_roads')
                            <li role="presentation" @if(isset($critical_point)) class="active" @endif>
                                <a href="#critical_point" id="critical_point_tab" data-toggle="tab" role="tab">
                                    {{ trans('critical_point.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.conservation_needs.inventory_roads')
                            <li role="presentation" @if(isset($conservation_needs)) class="active" @endif>
                                <a href="#conservation_needs" id="conservation_needs_tab" data-toggle="tab" role="tab">
                                    {{ trans('conservation_needs.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.environmental_information.inventory_roads')
                            <li role="presentation" @if(isset($environmental_information)) class="active" @endif>
                                <a href="#environmental_information" id="environmental_information_tab" data-toggle="tab" role="tab">
                                    {{ trans('environmental_information.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.production.inventory_roads')
                            <li role="presentation" @if(isset($production)) class="active" @endif>
                                <a href="#production" id="production_tab" data-toggle="tab" role="tab">
                                    {{ trans('production.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.transportation_services.inventory_roads')
                            <li role="presentation" @if(isset($transportation_services)) class="active" @endif>
                                <a href="#transportation_services" id="transportation_services_tab" data-toggle="tab" role="tab">
                                    {{ trans('transportation_services.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.social_information.inventory_roads')
                            <li role="presentation" @if(isset($social_information)) class="active" @endif>
                                <a href="#social_information" id="social_information_tab" data-toggle="tab" role="tab">
                                    {{ trans('social_information.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.shape.inventory_roads')
                            <li @if(isset($shape)) class="active" @endif>
                                <a href="#shape" data-toggle="tab" id="shape_tab">
                                    {{ trans('shape.title') }}
                                </a>
                            </li>
                            @endpermission
                        </ul>
                    </div>
                    <div class="col-xs-10">
                        <div class="tab-content">
                            @permission('index.characteristics_of_track.inventory_roads')
                            <div class="tab-pane fade @if(isset($sewer) || isset($bridge) || isset($ditch) ||
                                isset($slope) || isset($signal_horizontal) || isset($signal_vertical) || isset($traffic) ||
                                isset($mines) || isset($intersection) || isset($critical_point) || isset($conservation_needs) ||
                                isset($environmental_information) || isset($production) || isset($transportation_services) ||
                                isset($social_information) || isset($shape)) @else active in @endif"
                                 id="characteristics_of_track">
                                @include('business.roads.characteristics_of_track.index')
                            </div>
                            @endpermission
                            @permission('index.sewer.inventory_roads')
                            <div class="tab-pane fade @if(isset($sewer)) active in @endif" id="sewer">
                            </div>
                            @endpermission
                            @permission('index.bridge.inventory_roads')
                            <div class="tab-pane fade @if(isset($bridge)) active in @endif" id="bridge">
                            </div>
                            @endpermission
                            @permission('index.ditch.inventory_roads')
                            <div class="tab-pane fade @if(isset($ditch)) active in @endif" id="ditch">
                            </div>
                            @endpermission
                            @permission('index.slope.inventory_roads')
                            <div class="tab-pane fade @if(isset($slope)) active in @endif" id="slope">
                            </div>
                            @endpermission
                            @permission('index.signal_horizontal.inventory_roads')
                            <div class="tab-pane fade @if(isset($signal_horizontal)) active in @endif" id="signal_horizontal">
                            </div>
                            @endpermission
                            @permission('index.signal_vertical.inventory_roads')
                            <div class="tab-pane fade @if(isset($signal_vertical)) active in @endif" id="signal_vertical">
                            </div>
                            @endpermission
                            @permission('index.traffic.inventory_roads')
                            <div class="tab-pane fade @if(isset($traffic)) active in @endif" id="traffic">
                            </div>
                            @endpermission
                            @permission('index.mines.inventory_roads')
                            <div class="tab-pane fade @if(isset($mines)) active in @endif" id="mines">
                            </div>
                            @endpermission
                            @permission('index.intersection.inventory_roads')
                            <div class="tab-pane fade @if(isset($intersection)) active in @endif" id="intersection">
                            </div>
                            @endpermission
                            @permission('index.critical_point.inventory_roads')
                            <div class="tab-pane fade @if(isset($critical_point)) active in @endif" id="critical_point">
                            </div>
                            @endpermission
                            @permission('index.conservation_needs.inventory_roads')
                            <div class="tab-pane fade @if(isset($conservation_needs)) active in @endif" id="conservation_needs">
                            </div>
                            @endpermission
                            @permission('index.environmental_information.inventory_roads')
                            <div class="tab-pane fade @if(isset($environmental_information)) active in @endif"
                                 id="environmental_information">
                            </div>
                            @endpermission
                            @permission('index.production.inventory_roads')
                            <div class="tab-pane fade @if(isset($production)) active in @endif" id="production">
                            </div>
                            @endpermission
                            @permission('index.transportation_services.inventory_roads')
                            <div class="tab-pane fade @if(isset($transportation_services)) active in @endif"
                                 id="transportation_services">
                            </div>
                            @endpermission
                            @permission('index.social_information.inventory_roads')
                            <div class="tab-pane fade @if(isset($social_information)) active in @endif"
                                 id="social_information">
                            </div>
                            @endpermission
                            @permission('index.shape.inventory_roads')
                            <div class="tab-pane @if(isset($shape)) active in @endif" id="shape">
                            </div>
                            @endpermission
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        let count_sewer_tab = 0;
        let count_bridge_tab = 0;
        let count_ditch_tab = 0;
        let count_slope_tab = 0;
        let count_signal_horizontal_tab = 0;
        let count_signal_vertical_tab = 0;
        let count_traffic_tab = 0;
        let count_mines_tab = 0;
        let count_intersection_tab = 0;
        let count_critical_point_tab = 0;
        let count_conservation_needs_tab = 0;
        let count_environmental_information_tab = 0;
        let count_production_tab = 0;
        let count_transportation_services_tab = 0;
        let count_social_information_tab = 0;
        let count_shape_tab = 0;

        @if(isset($sewer))
            count_sewer_tab = 1;
        let url = '{!! route('index.sewer.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#sewer', null, null, null, false);
        @endif
            @if(isset($bridge))
            count_bridge_tab = 1;
        let url = '{!! route('index.bridge.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#bridge', null, null, null, false);
        @endif
            @if(isset($ditch))
            count_ditch_tab = 1;
        let url = '{!! route('index.ditch.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#ditch', null, null, null, false);
        @endif
            @if(isset($slope))
            count_slope_tab = 1;
        let url = '{!! route('index.slope.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#slope', null, null, null, false);
        @endif
            @if(isset($signal_horizontal))
            count_signal_horizontal_tab = 1;
        let url = '{!! route('index.signal_horizontal.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#signal_horizontal', null, null, null, false);
        @endif
            @if(isset($signal_vertical))
            count_signal_vertical_tab = 1;
        let url = '{!! route('index.signal_vertical.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#signal_vertical', null, null, null, false);
        @endif
            @if(isset($traffic))
            count_traffic_tab = 1;
        let url = '{!! route('index.traffic.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#traffic', null, null, null, false);
        @endif
            @if(isset($mines))
            count_mines_tab = 1;
        let url = '{!! route('index.mines.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#mines', null, null, null, false);
        @endif
            @if(isset($intersection))
            count_intersection_tab = 1;
        let url = '{!! route('index.intersection.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#intersection', null, null, null, false);
        @endif
            @if(isset($critical_point))
            count_critical_point_tab = 1;
        let url = '{!! route('index.critical_point.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#critical_point', null, null, null, false);
        @endif
            @if(isset($conservation_needs))
            count_conservation_needs_tab = 1;
        let url = '{!! route('index.conservation_needs.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#conservation_needs', null, null, null, false);
        @endif
            @if(isset($environmental_information))
            count_environmental_information_tab = 1;
        let url = '{!! route('index.environmental_information.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#environmental_information', null, null, null, false);
        @endif
            @if(isset($production))
            count_production_tab = 1;
        let url = '{!! route('index.production.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#production', null, null, null, false);
        @endif
            @if(isset($transportation_services))
            count_transportation_services_tab = 1;
        let url = '{!! route('index.transportation_services.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#transportation_services', null, null, null, false);
        @endif
            @if(isset($social_information))
            count_social_information_tab = 1;
        let url = '{!! route('index.social_information.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#social_information', null, null, null, false);
        @endif
            @if(isset($shape))
            count_shape_tab = 1;
        let url = '{!! route('index.shape.inventory_roads', ['code' => $entity->codigo]) !!}';
        pushRequest(url, '#shape', null, null, null, false);
        @endif

        $('#sewer_tab').on('click', (e) => {
            if (count_sewer_tab === 0) {
                count_sewer_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.sewer.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#sewer', null, null, null, false)
            }
        });

        $('#bridge_tab').on('click', (e) => {
            if (count_bridge_tab === 0) {
                count_bridge_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.bridge.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#bridge', null, null, null, false)
            }
        });

        $('#ditch_tab').on('click', (e) => {
            if (count_ditch_tab === 0) {
                count_ditch_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.ditch.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#ditch', null, null, null, false)
            }
        });

        $('#slope_tab').on('click', (e) => {
            if (count_slope_tab === 0) {
                count_slope_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.slope.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#slope', null, null, null, false)
            }
        });

        $('#signal_horizontal_tab').on('click', (e) => {
            if (count_signal_horizontal_tab === 0) {
                count_signal_horizontal_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.signal_horizontal.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#signal_horizontal', null, null, null, false)
            }
        });

        $('#signal_vertical_tab').on('click', (e) => {
            if (count_signal_vertical_tab === 0) {
                count_signal_vertical_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.signal_vertical.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#signal_vertical', null, null, null, false)
            }
        });

        $('#traffic_tab').on('click', (e) => {
            if (count_traffic_tab === 0) {
                count_traffic_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.traffic.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#traffic', null, null, null, false)
            }
        });

        $('#mines_tab').on('click', (e) => {
            if (count_mines_tab === 0) {
                count_mines_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.mines.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#mines', null, null, null, false)
            }
        });

        $('#intersection_tab').on('click', (e) => {
            if (count_intersection_tab === 0) {
                count_intersection_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.intersection.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#intersection', null, null, null, false)
            }
        });

        $('#critical_point_tab').on('click', (e) => {
            if (count_critical_point_tab === 0) {
                count_critical_point_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.critical_point.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#critical_point', null, null, null, false)
            }
        });

        $('#conservation_needs_tab').on('click', (e) => {
            if (count_conservation_needs_tab === 0) {
                count_conservation_needs_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.conservation_needs.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#conservation_needs', null, null, null, false)
            }
        });

        $('#environmental_information_tab').on('click', (e) => {
            if (count_environmental_information_tab === 0) {
                count_environmental_information_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.environmental_information.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#environmental_information', null, null, null, false)
            }
        });

        $('#production_tab').on('click', (e) => {
            if (count_production_tab === 0) {
                count_production_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.production.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#production', null, null, null, false)
            }
        });

        $('#transportation_services_tab').on('click', (e) => {
            if (count_transportation_services_tab === 0) {
                count_transportation_services_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.transportation_services.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#transportation_services', null, null, null, false)
            }
        });

        $('#social_information_tab').on('click', (e) => {
            if (count_social_information_tab === 0) {
                count_social_information_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.social_information.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#social_information', null, null, null, false)
            }
        });

        $('#shape_tab').on('click', (e) => {
            if (count_shape_tab === 0) {
                count_shape_tab = 1;
                e.preventDefault();
                let url = '{!! route('index.shape.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#shape', null, null, null, false)
            }
        });

    });
</script>

@else
    @include('errors.403')
    @endpermission
