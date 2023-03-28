@permission('index.vulnerability_climate_risk')
<div>
    <div class="clearfix"></div>

    <div class="row">                
        <div class="col-md-12 align-center custom-border-map">
                    <div class="row" id="map_shapes">
            </div>
        </div>
        <div class="clearfix"></div>                
    </div>
</div>

<script type="text/javascript">
        // Llamar a la vista de shapes
            let url = '{!! route("index.vulnerability_climate_risk") !!}';
            pushRequest(url, '#map_shapes', () => {
            }, 'GET', null, false);
</script>
@endpermission
