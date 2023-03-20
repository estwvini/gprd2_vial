
<div class="x_content">
    <div class="zindex-0 well-sm col-lg-6 col-md-9 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="x_content">
                <div id="osm_map" class="map" tabindex="0" style="width: 100%; height:100% ">    
                </div>   
                <div class="title_left">
                    <h5><b>Nota:</b></h5>
                </div> 
                <div id="legend-content" style="text-align: justify">
                    <span>Los datos censales (socio-económicos) del 2010 fueron levantados con base en una delimitación político-administrativa que no corresponde a la cartografía del CONALI sobre límites (año 2016). Por lo tanto, algunos datos pueden referirse a un territorio cuya extensión se ha visto modificada.</span>                                                                    
                </div>                      
            </div>
        </div>
    </div>
    <div class="zindex-0 well-sm col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form role="form" class="form-horizontal form-label-left">
                            @csrf
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coordX">
                                    {{ trans('climate_risk.labels.coordX') }} <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="coordX" id="coordX" maxlength="10" autocomplete="off"
                                             class="form-control col-md-7 col-sm-7 col-xs-12"/>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coordY">
                                    {{ trans('climate_risk.labels.coordY') }} <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">                                     
                                    <input type="text" name="coordY" id="coordY" maxlength="10" autocomplete="off"
                                            class="form-control col-md-7 col-sm-7 col-xs-12"/>
                                </div>
                            </div>                           
                            <div class="col-md-12 text-center">                        
                                <button id="locale_btn" class="btn btn-success">
                                    <i class="fa fa-check"></i> {{ trans('climate_risk.labels.locate') }}
                                </button> 
                            </div>
                        </form>                        
                    </div>
                    <div class="x_content">
                        <form role="form" class="form-horizontal form-label-left">
                            @csrf
                            <input type="hidden" name="dpa_r" id="dpa_r"/>
                            <input type="hidden" name="dpa_c" id="dpa_c"/>
                            <input type="hidden" name="dpa_p" id="dpa_p"/>
                            <input type="hidden" name="dpa_dr" id="dpa_dr"/>
                            <input type="hidden" name="dpa_dc" id="dpa_dc"/>
                            <input type="hidden" name="dpa_dp" id="dpa_dp"/>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="layerId">
                                    {{ trans('climate_risk.labels.layer') }} <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" id="layerId"> 
                                        <option value="rx95p">RX95P</option>
                                        <option value="sdii">SDII</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="typeId">
                                    {{ trans('climate_risk.labels.type') }} <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" id="typeId"> 
                                        <option value="altas">{{ trans('climate_risk.labels.high') }}</option>
                                        <option value="histo">{{ trans('climate_risk.labels.history') }}</option>
                                        <option value="medias">{{ trans('climate_risk.labels.half') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelId">
                                    {{ trans('climate_risk.labels.level') }} <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" id="levelId"> 
                                        <option value="1">{{ trans('climate_risk.labels.parish') }}</option>
                                        <option value="2">{{ trans('climate_risk.labels.canton') }}</option>
                                        <option value="3">{{ trans('climate_risk.labels.province') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button id="execute_btn" class="btn btn-success" disabled>
                                    <i class="fa fa-check"></i> {{ trans('climate_risk.labels.execute') }}
                                </button>
                                <button id="generate_btn" class="btn btn-success" disabled>
                                    <i class="fa fa-check"></i> {{ trans('climate_risk.labels.export') }}
                                    <a id="image-download" download="map.png"></a>
                                </button>                                  
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tile-stats">                                       
                    <div class="x_content">
                        <div id="legend-content" style="text-align: justify">
                            <span>MAPA DE RIESGO PRODUCCIÓN ANTE AMENZA - NORMAL</span>  
                            <p>
                                <span id="frmDatos:idTexto2">
                            De acuerdo con los mapas obtenidos del análisis de riesgo climático, que forman parte de los diagnósticos provinciales de cambio climático elaborados en el marco del proyecto Acción Provincial frente al Cambio Climático ejecutado por CONGOPE con el apoyo financiero de la Unión Europea. El área de influencia del proyecto se localiza en la provincia de , cantón ; donde el riesgo ante es .
                                </span>
                            </p>
                            <p>
                                <u>Periodos de análisis:</u>
                            </p>
                            <ul>
                                <li>Clima histórico: (1981-2015)</li>
                                <li>Escenario de emisiones futuras: (2011-2040)</li>
                            </ul>
                            <p>
                                <u>Escenarios futuros:</u>
                            </p>
                            <ul>
                                <li>Escenario de emisiones altas se refiere a la proyección de emisiones dada por el Grupo Intergubernamental de Expertos sobre el Cambio Climático (IPCC por sus siglas en inglés), trayectoria de concentración representativas de gases de efecto invernadero 8.5 (RCP 8.5 por siglas en inglés); el tope de las emisiones se daría después del año 2100 y con valores superiores a las 1000 ppm y la tendencia de las emisiones de CO2 equivalente tiende a incrementarse en una tasa muy alta a medida que transcurre el siglo XXI.</li>
                                <li>Escenario de emisiones medias se refiere a la proyección de emisiones dada por el Grupo Intergubernamental de Expertos sobre el Cambio Climático (IPCC por sus siglas en inglés), trayectoria de concentración representativas de gases de efecto invernadero 4.5 (RCP 4.5 por siglas en inglés), estima un valor tope concentraciones de CO2 aproximado de 480 ppm hacia el año 2050.</li>
                            </ul>                                                                  
                        </div>  
                    </div>    
                </div>
            </div>
        </div>            
    </div>
</div>
<script type="text/javascript" src="{{ asset('/js/api_osm.js') }}"></script> 

<script type="text/javascript">
    $('#osm_map').css("height", window.innerHeight-200);       
    $('#locale_btn').on('click', (e) => {                      
            if($("#coordX").val() == '')
                return false;
            if($("#coordY").val() == '')
                return false;  
            $("#levelId").val('1'); 
            $('#execute_btn').attr("disabled", true);                      
            e.preventDefault();
            $.ajax({
                url: '{{ route('locale.index.vulnerability_climate_risk') }}',
                method: 'GET',
                data: {
                    filters: {
                        layerId: $("#layerId").val(),
                        typeId: $('#typeId').val(),
                        coordX: $('#coordX').val(),
                        coordY: $('#coordY').val(),
                        levelId: $('#levelId').val(),
                    }
                },
                beforeSend: () => {
                    showLoading();
                },
                xhrFields: {
                    responseType: 'json'
                },
                success: (layers) => { 
                    console.log(layers);
                    layers.forEach(function(layer) {
                        $("#dpa_r").val(layer.dpa_r);   
                        $("#dpa_c").val(layer.dpa_c);    
                        $("#dpa_p").val(layer.dpa_p); 
                        $("#dpa_dr").val(layer.dpa_dr);   
                        $("#dpa_dc").val(layer.dpa_dc);    
                        $("#dpa_dp").val(layer.dpa_dp);    
                    });
                    $('#execute_btn').attr("disabled", false);
                    $('#generate_btn').attr("disabled", false);
                    api_osm.load_layer_risks(layers, $("#layerId").val() + "_" + $('#typeId').val(), $("#dpa_dr").val());                    
                }
            }).always(() => {
                hideLoading();
            });
    });
    $('#execute_btn').on('click', (e) => {       
            var level = $("#levelId").val();   
            var nameLayer =  $("#dpa_dr").val();                                
            if(level == 2)
            {
                nameLayer = $("#dpa_dc").val();
            } else if(level == 3)
            {
                nameLayer = $("#dpa_dp").val();
            }                
            e.preventDefault();
            $.ajax({
                url: '{{ route('execute.index.vulnerability_climate_risk') }}',
                method: 'GET',
                data: {
                    filters: {
                        layerId: $("#layerId").val(),
                        typeId: $('#typeId').val(),
                        dpa_r: $('#dpa_r').val(),
                        dpa_c: $('#dpa_c').val(),
                        dpa_p: $('#dpa_p').val(),
                        levelId: $('#levelId').val(),
                    }
                },
                beforeSend: () => {
                    showLoading();
                },
                xhrFields: {
                    responseType: 'json'
                },
                success: (layers) => {                   
                    console.log(layers);
                    api_osm.load_layer_risks(layers, $("#layerId").val() + "_" + $('#typeId').val(), nameLayer);                    
                }
            }).always(() => {
                hideLoading();
            });
    });
    $('#generate_btn').on('click', (e) => { 
        var level = $("#levelId").val();   
        var nameLayer =  $("#dpa_dr").val();                                
        if(level == 2)
        {
            nameLayer = $("#dpa_dc").val();
        } else if(level == 3)
        {
            nameLayer = $("#dpa_dp").val();
        }  
        //api_osm.generate_risks(nameLayer);
    });
    var api_osm = window.api_osm;
    api_osm.displayClimateRisk(-8667739.203023149, -245375.53102195481, 7);        
</script>

