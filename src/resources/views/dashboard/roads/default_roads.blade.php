@permission('all_shapes.index.main_shape')
<div>
    <div id="page-title-id" class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('general_characteristics_of_track.title') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-automobile "></i> {{ trans('general_characteristics_of_track.labels.roads_province') }}
                    </h2>
                    <div class="col-md-12 align-center custom-border-map">

                        <button type="submit" id="loadMap" class="btn btn-success">{{ trans('main_shape.labels.load_map') }}</button>

                        <div class="row" id="map_shapes">
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
        // Llamar a la vista de shapes
        $('#loadMap').on('click', (e) => {
            let url = '{!! route('all_shapes.index.main_shape') !!}';
            pushRequest(url, '#map_shapes', () => {
                $('#loadMap').hide();
				$('#page-title-id').hide();
            }, 'GET', null, false);
        })
    });
</script>
@endpermission
