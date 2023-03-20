@permission('show.inventory_roads')
@inject('GeneralCharacteristicsOfTrack', '\App\Models\Business\Roads\GeneralCharacteristicsOfTrack')
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
                        <i class="fa fa-automobile"></i> {{ trans('general_characteristics_of_track.labels.road_graphic') }}
                    </h2>
                    <div class="col-md-12 align-center custom-border-map">

                        <button type="submit" id="loadMap"
                                class="btn btn-success">{{ trans('main_shape.labels.load_map') }}</button>

                        <div class="row" id="map_shapes_show">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="x_title">
                    <h2>
                        <i class="fa fa-automobile"></i> {{ trans('general_characteristics_of_track.labels.roads_components') }}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <hr>
                    <div class="col-xs-2">
                        <ul class="nav custom-nav">
                            <li class="active">
                                <a href="#general_characteristics_of_track"
                                   data-toggle="tab">{{ trans('general_characteristics_of_track.labels.details') }}</a>
                            </li>
                            @permission('index.sewer.inventory_roads')
                            <li>
                                <a href="#sewer" data-toggle="tab" id="sewer_tab">
                                    {{ trans('sewer.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.bridge.inventory_roads')
                            <li>
                                <a href="#bridge" data-toggle="tab" id="bridge_tab">
                                    {{ trans('bridge.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.ditch.inventory_roads')
                            <li>
                                <a href="#ditch" data-toggle="tab" id="ditch_tab">
                                    {{ trans('ditch.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.slope.inventory_roads')
                            <li>
                                <a href="#slope" data-toggle="tab" id="slope_tab">
                                    {{ trans('slope.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.signal_horizontal.inventory_roads')
                            <li>
                                <a href="#signal_horizontal" data-toggle="tab" id="signal_horizontal_tab">
                                    {{ trans('signal_horizontal.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.signal_vertical.inventory_roads')
                            <li>
                                <a href="#signal_vertical" data-toggle="tab" id="signal_vertical_tab">
                                    {{ trans('signal_vertical.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.traffic.inventory_roads')
                            <li>
                                <a href="#traffic" data-toggle="tab" id="traffic_tab">
                                    {{ trans('traffic.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.mines.inventory_roads')
                            <li>
                                <a href="#mines" data-toggle="tab" id="mines_tab">
                                    {{ trans('mines.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.intersection.inventory_roads')
                            <li>
                                <a href="#intersection" data-toggle="tab" id="intersection_tab">
                                    {{ trans('intersection.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.critical_point.inventory_roads')
                            <li>
                                <a href="#critical_point" data-toggle="tab" id="critical_point_tab">
                                    {{ trans('critical_point.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.conservation_needs.inventory_roads')
                            <li>
                                <a href="#conservation_needs" data-toggle="tab" id="conservation_needs_tab">
                                    {{ trans('conservation_needs.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.environmental_information.inventory_roads')
                            <li>
                                <a href="#environmental_information" data-toggle="tab"
                                   id="environmental_information_tab">
                                    {{ trans('environmental_information.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.production.inventory_roads')
                            <li>
                                <a href="#production" data-toggle="tab" id="production_tab">
                                    {{ trans('production.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.transportation_services.inventory_roads')
                            <li>
                                <a href="#transportation_services" data-toggle="tab" id="transportation_services_tab">
                                    {{ trans('transportation_services.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.social_information.inventory_roads')
                            <li>
                                <a href="#social_information" data-toggle="tab" id="social_information_tab">
                                    {{ trans('social_information.title') }}
                                </a>
                            </li>
                            @endpermission
                            @permission('index.shape.inventory_roads')
                            <li>
                                <a href="#shape" data-toggle="tab" id="shape_tab">
                                    {{ trans('shape.title') }}
                                </a>
                            </li>
                            @endpermission
                        </ul>
                    </div>
                    <div class="col-xs-10">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="general_characteristics_of_track">
                                <table class="table table-bordered detail-table">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <span class="label label-primary">{{ trans('general_characteristics_of_track.labels.code') }}</span>
                                        </td>
                                        <td>
                                            {{ $entity->codigo }} <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                                        </td>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.responsible') }}
                                        </td>
                                        <td>
                                            {{ $entity->respons }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.date') }}
                                        </td>
                                        <td>
                                            {{ $entity->fecha }}
                                        </td>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.province') }}
                                        </td>
                                        <td>
                                            {{ $entity->prov }}
                                        </td>
                                    </tr>
                                    <tr>
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
                                            <span class="label label-primary">{{ trans('general_characteristics_of_track.labels.number_road') }}</span>
                                        </td>
                                        <td>
                                            {{ $entity->numcamino }} <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                                        </td>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.type_interconnection') }}
                                        </td>
                                        <td>
                                            {{ $entity->tipointer }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="label label-primary">{{ trans('general_characteristics_of_track.labels.origin') }}</span>
                                        </td>
                                        <td>
                                            {{ $entity->origen }} <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                                        </td>
                                        <td>
                                            <span class="label label-primary">{{ trans('general_characteristics_of_track.labels.destiny') }}</span>
                                        </td>
                                        <td>
                                            {{ $entity->destino }} <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.settlement') }}
                                        </td>
                                        <td>
                                            {{ $entity->asentami }}
                                        </td>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.longitude_initial') }}
                                        </td>
                                        <td>
                                            {{ $entity->longi }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.latitude_initial') }}
                                        </td>
                                        <td>
                                            {{ $entity->lati }}
                                        </td>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.longitude_finish') }}
                                        </td>
                                        <td>
                                            {{ $entity->longf }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.latitude_finish') }}
                                        </td>
                                        <td>
                                            {{ $entity->latf }}
                                        </td>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.alternate') }}
                                        </td>
                                        <td>
                                            @if(strtoupper($entity->altermat) == $GeneralCharacteristicsOfTrack::STATUS_TRUE)
                                                {{ trans('general_characteristics_of_track.labels.yes') }}
                                            @else
                                                {{ trans('general_characteristics_of_track.labels.no') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.treatment_plant') }}
                                        </td>
                                        <td>
                                            @if(strtoupper($entity->planttr) == $GeneralCharacteristicsOfTrack::STATUS_TRUE)
                                                {{ trans('general_characteristics_of_track.labels.yes') }}
                                            @else
                                                {{ trans('general_characteristics_of_track.labels.no') }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.fill') }}
                                        </td>
                                        <td>
                                            @if(strtoupper($entity->relleno) == $GeneralCharacteristicsOfTrack::STATUS_TRUE)
                                                {{ trans('general_characteristics_of_track.labels.yes') }}
                                            @else
                                                {{ trans('general_characteristics_of_track.labels.no') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.social_projects') }}
                                        </td>
                                        <td>
                                            @if(strtoupper($entity->proysoc) == $GeneralCharacteristicsOfTrack::STATUS_TRUE)
                                                {{ trans('general_characteristics_of_track.labels.yes') }}
                                            @else
                                                {{ trans('general_characteristics_of_track.labels.no') }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.strategic_projects') }}
                                        </td>
                                        <td>
                                            @if(strtoupper($entity->proyest) == $GeneralCharacteristicsOfTrack::STATUS_TRUE)
                                                {{ trans('general_characteristics_of_track.labels.yes') }}
                                            @else
                                                {{ trans('general_characteristics_of_track.labels.no') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.national_security_projects') }}
                                        </td>
                                        <td>
                                            @if(strtoupper($entity->proyseg) == $GeneralCharacteristicsOfTrack::STATUS_TRUE)
                                                {{ trans('general_characteristics_of_track.labels.yes') }}
                                            @else
                                                {{ trans('general_characteristics_of_track.labels.no') }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.productive_projects') }}
                                        </td>
                                        <td>
                                            @if(strtoupper($entity->proypro) == $GeneralCharacteristicsOfTrack::STATUS_TRUE)
                                                {{ trans('general_characteristics_of_track.labels.yes') }}
                                            @else
                                                {{ trans('general_characteristics_of_track.labels.no') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="label label-primary">{{ trans('general_characteristics_of_track.labels.change_climatic') }}</span>
                                        </td>
                                        <td>
                                            {{ $entity->coclimati }} <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                                        </td>
                                        <td>
                                            {{ trans('general_characteristics_of_track.labels.gid') }}
                                        </td>
                                        <td>
                                            {{ $entity->gid }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            {{ trans('general_characteristics_of_track.labels.number_tram') }}
                                        </td>
                                        <td colspan="2">
                                            {{ $entity->num_tra }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            @permission('index.sewer.inventory_roads')
                            <div class="tab-pane fade" id="sewer">
                            </div>
                            @endpermission
                            @permission('index.bridge.inventory_roads')
                            <div class="tab-pane fade" id="bridge">
                            </div>
                            @endpermission
                            @permission('index.ditch.inventory_roads')
                            <div class="tab-pane fade" id="ditch">
                            </div>
                            @endpermission
                            @permission('index.slope.inventory_roads')
                            <div class="tab-pane fade" id="slope">
                            </div>
                            @endpermission
                            @permission('index.signal_horizontal.inventory_roads')
                            <div class="tab-pane fade" id="signal_horizontal">
                            </div>
                            @endpermission
                            @permission('index.signal_vertical.inventory_roads')
                            <div class="tab-pane fade" id="signal_vertical">
                            </div>
                            @endpermission
                            @permission('index.traffic.inventory_roads')
                            <div class="tab-pane fade" id="traffic">
                            </div>
                            @endpermission
                            @permission('index.mines.inventory_roads')
                            <div class="tab-pane fade" id="mines">
                            </div>
                            @endpermission
                            @permission('index.intersection.inventory_roads')
                            <div class="tab-pane fade" id="intersection">
                            </div>
                            @endpermission
                            @permission('index.critical_point.inventory_roads')
                            <div class="tab-pane fade" id="critical_point">
                            </div>
                            @endpermission
                            @permission('index.conservation_needs.inventory_roads')
                            <div class="tab-pane fade" id="conservation_needs">
                            </div>
                            @endpermission
                            @permission('index.environmental_information.inventory_roads')
                            <div class="tab-pane fade" id="environmental_information">
                            </div>
                            @endpermission
                            @permission('index.production.inventory_roads')
                            <div class="tab-pane fade" id="production">
                            </div>
                            @endpermission
                            @permission('index.transportation_services.inventory_roads')
                            <div class="tab-pane fade" id="transportation_services">
                            </div>
                            @endpermission
                            @permission('index.social_information.inventory_roads')
                            <div class="tab-pane fade" id="social_information">
                            </div>
                            @endpermission
                            @permission('index.shape.inventory_roads')
                            <div class="tab-pane" id="shape">
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
        $('#sewer_tab').on('click', (e) => {
            if (count_sewer_tab === 0) {
                count_sewer_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.sewer.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#sewer', null, null, null, false)
            }
        });
        let count_bridge_tab = 0;
        $('#bridge_tab').on('click', (e) => {
            if (count_bridge_tab === 0) {
                count_bridge_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.bridge.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#bridge', null, null, null, false)
            }
        });
        let count_ditch_tab = 0;
        $('#ditch_tab').on('click', (e) => {
            if (count_ditch_tab === 0) {
                count_ditch_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.ditch.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#ditch', null, null, null, false)
            }
        });
        let count_slope_tab = 0;
        $('#slope_tab').on('click', (e) => {
            if (count_slope_tab === 0) {
                count_slope_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.slope.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#slope', null, null, null, false)
            }
        });
        let count_signal_horizontal_tab = 0;
        $('#signal_horizontal_tab').on('click', (e) => {
            if (count_signal_horizontal_tab === 0) {
                count_signal_horizontal_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.signal_horizontal.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#signal_horizontal', null, null, null, false)
            }
        });
        let count_signal_vertical_tab = 0;
        $('#signal_vertical_tab').on('click', (e) => {
            if (count_signal_vertical_tab === 0) {
                count_signal_vertical_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.signal_vertical.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#signal_vertical', null, null, null, false)
            }
        });
        let count_traffic_tab = 0;
        $('#traffic_tab').on('click', (e) => {
            if (count_traffic_tab === 0) {
                count_traffic_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.traffic.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#traffic', null, null, null, false)
            }
        });
        let count_mines_tab = 0;
        $('#mines_tab').on('click', (e) => {
            if (count_mines_tab === 0) {
                count_mines_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.mines.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#mines', null, null, null, false)
            }
        });
        let count_intersection_tab = 0;
        $('#intersection_tab').on('click', (e) => {
            if (count_intersection_tab === 0) {
                count_intersection_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.intersection.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#intersection', null, null, null, false)
            }
        });
        let count_critical_point_tab = 0;
        $('#critical_point_tab').on('click', (e) => {
            if (count_critical_point_tab === 0) {
                count_critical_point_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.critical_point.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#critical_point', null, null, null, false)
            }
        });
        let count_conservation_needs_tab = 0;
        $('#conservation_needs_tab').on('click', (e) => {
            if (count_conservation_needs_tab === 0) {
                count_conservation_needs_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.conservation_needs.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#conservation_needs', null, null, null, false)
            }
        });
        let count_environmental_information_tab = 0;
        $('#environmental_information_tab').on('click', (e) => {
            if (count_environmental_information_tab === 0) {
                count_environmental_information_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.environmental_information.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#environmental_information', null, null, null, false)
            }
        });
        let count_production_tab = 0;
        $('#production_tab').on('click', (e) => {
            if (count_production_tab === 0) {
                count_production_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.production.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#production', null, null, null, false)
            }
        });
        let count_transportation_services_tab = 0;
        $('#transportation_services_tab').on('click', (e) => {
            if (count_transportation_services_tab === 0) {
                count_transportation_services_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.transportation_services.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#transportation_services', null, null, null, false)
            }
        });
        let count_social_information_tab = 0;
        $('#social_information_tab').on('click', (e) => {
            if (count_social_information_tab === 0) {
                count_social_information_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.social_information.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#social_information', null, null, null, false)
            }
        });
        let count_shape_tab = 0;
        $('#shape_tab').on('click', (e) => {
            if (count_shape_tab === 0) {
                count_shape_tab++;
                e.preventDefault();
                let url = '{!! route('index_show.index.shape.inventory_roads', ['code' => $entity->codigo]) !!}';
                pushRequest(url, '#shape', null, null, null, false)
            }
        });

        // Llamar a la vista de shapes
        $('#loadMap').on('click', (e) => {
            let url = '{!! route('shapes.index.inventory_roads', ['code' => $entity->codigo]) !!}';
            pushRequest(url, '#map_shapes_show', () => {
                $('#loadMap').hide();
            }, 'GET', null, false);
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
