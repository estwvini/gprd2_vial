@permission('all_shapes.index.main_shape')
<div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-automobile "></i> {{ trans('general_characteristics_of_track.labels.roads_province') }}
                    </h2>
                    <div class="col-md-12 align-center custom-border-map">
                             <div class="row" id="map_shapes">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
        // Llamar a la vista de shapes
            let url = '{!! route('all_shapes.index.main_shape') !!}';
            pushRequest(url, '#map_shapes', () => {
            }, 'GET', null, false);
</script>
@endpermission
