@if(count($shapes) || count($shapesDefault))
<div>   
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-automobile"></i>
                        {{ trans('climate_risk.labels.province') }} {{ $gad["province_short_name"] }}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="x_panel">
                        <div class="x_content">    
                            <table align="center" style="width: 100%;">
                                <tbody>
                                    <tr style="width: 35;">
                                        <td>  
                                            <div class="form-group mx-sm-3 mb-2">
                                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="canton">
                                                    {{ trans('climate_risk.labels.canton') }}
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select class="form-control" name="canton" id="canton">
                                                        <option value="0">{{ trans('climate_risk.labels.all') }}</option>  
                                                        @foreach($cantons as $canton)
                                                            <option value="{{ $canton->dpa_canton }}">
                                                                {{ $canton->dpa_descan }}
                                                            </option>
                                                        @endforeach                                                                                          
                                                    </select>
                                                </div>      
                                            </div>                                                                                                                     
                                        </td>
                                        <td>
                                            <div class="form-group mx-sm-3 mb-2">                                                                                
                                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="parroquia">
                                                {{ trans('reports/roads/inventory_roads_report.labels.parish') }}
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select class="form-control" name="parroquia" id="parroquia" disabled>
                                                        <option value="0">{{ trans('climate_risk.labels.all') }}</option>     
                                                    </select>
                                                </div>
                                            
                                            </div>
                                        </td>                                    
                                        <td rowspan="2">                                        
                                            <button id="execute_btn" class="btn btn-success" >
                                                <i class="fa fa-check"></i> {{ trans('climate_risk.labels.execute') }}
                                            </button>
                                            <!--button id="generate_btn" class="btn btn-success" disabled>
                                                <i class="fa fa-check"></i> {{ trans('climate_risk.labels.export') }}
                                                <a id="image-download" download="map.png"></a>
                                            </button-->                                              
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 40%;"> 
                                            <div class="form-group mx-sm-3 mb-2">                                         
                                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="layerId">
                                                    {{ trans('climate_risk.labels.layer') }}
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select class="form-control select2" id="layerId"> 
                                                        <option value="rx95p">{{ trans('climate_risk.labels.rx95p') }}</option>
                                                        <option value="sdii">{{ trans('climate_risk.labels.sdii') }}</option>
                                                    </select>
                                                </div>  
                                            </div>                                           
                                        </td>
                                        <td style="width: 40%;">  
                                            <div class="form-group mx-sm-3 mb-2">
                                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="typeId">
                                                    {{ trans('climate_risk.labels.type') }}
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select class="form-control select2" id="typeId"> 
                                                        <option value="histo">{{ trans('climate_risk.labels.history') }}</option>
                                                        <option value="medias">{{ trans('climate_risk.labels.half') }}</option>
                                                        <option value="altas">{{ trans('climate_risk.labels.high') }}</option>                                        
                                                    </select>
                                                </div> 
                                            </div>                                                                                    
                                        </td>                                   
                                    </tr>
                                </tbody>
                            </table>                                                                                                              
                                <input type="hidden" name="dpa_code" id="dpa_code" value="{{ $gad['code'] }}"/>    
                                <input type="hidden" name="desc_pro" id="desc_pro" value="{{ $gad['province_short_name'] }}"/>                                                                                              
                        </div>       
                    </div>
                </div>
                <div class="tile-stats">
                    <div class="x_content">
                        <div class="page-header_" style="text-align: center;">
                            <form class="form-inline">
                                    <div class="form-group mx-sm-3 mb-2">
                                            <select class="form-control select2" id="shapeId"> 
                                                <option value="">{{ trans('shape.labels.listshape') }}</option> 
                                                @foreach($shapes as $shape)
                                                    <option value="{{ $shape->name }}">{{ ucfirst(substr($shape->name, 0, strlen($shape->name)-8)) }}</option>
                                                @endforeach                                                                               
                                            </select>
                                            <select class="form-control select2" id="catId">                                                              
                                            </select>
                                            <button id="query_btn" class="btn btn-success">
                                                    <i class="fa fa-check"></i> {{ trans('climate_risk.labels.query') }}
                                            </button>  
                                    </div>        
                            </form>
                        </div>
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
        </div>        
    </div> 
    
    <script type="text/javascript" src="{{ asset('/js/api_osm.js') }}"></script> 

    <script type="text/javascript">
        let canton = $('#canton').select2({
            placeholder: '{{ trans("climate_risk.labels.canton") }}'
        }).on('change', () => {
            parish.html('');
            parish.prop("disabled", true);
            parish.append('<option value="0">{{ trans("climate_risk.labels.all") }}</option>');

            let url = '{{ route("parishes.index.vulnerability_climate_risk", ["name" => "__NAME__"]) }}';
            url = url.replace('__NAME__', canton.val());

            pushRequest(url, null, (response) => {
                let opt = [];
                $.each($.parseJSON(response), (index, value) => {
                    opt.push({
                        id: value.dpa_parroq,
                        text: value.dpa_despar
                    });
                });
                if (opt.length > 0) {
                    parish.prop("disabled", false);
                }
                parish.select2({
                    data: opt
                });
            }, 'get', null, false)
        });

        let parish = $('#parroquia').select2({
            placeholder: '{{ trans("climate_risk.labels.all") }}'
        });

        $('#osm_map').css("height", window.innerHeight-200);      
        $("#shapeId").on('change', function(){
            $("#catId").html('');
            $("#catId").append('<option value="">{{ html_entity_decode(trans('hdm4.labels.listcatalog')) }}</option>');
            var capaName = $("#shapeId").val().substring(0, $("#shapeId").val().length-8);
            if(capaName == 'alcantarilla') 
            {                            
                $("#catId").append('<option value="tipo">Tipo</option>'+
                                  '<option value="material">Material</option>'+
                                  '<option value="ecabez">Estado</option>'+
                                  '<option value="ecuerpo">Cuerpo</option>');
                return;                  
            }
            if(capaName == 'caracteristicas_via') 
            {                            
                $("#catId").append('<option value="tipoterren">Tipo Terreno</option>'+
                                  '<option value="tsuperf">Tipo Superficie</option>'+
                                  '<option value="esuperf">Estado</option>'+
                                  '<option value="uso">Uso</option>'+
                                  '<option value="carriles">Carriles</option>'+
                                  '<option value="esenhori">Señal H.</option>'+
                                  '<option value="esenvert">Señal V.</option>');
                return;                  
            }
            if(capaName == 'puente') 
            {                            
                $("#catId").append('<option value="caparodad">Material Tablero</option>'+
                                  '<option value="protlater">Tipo Material</option>'+
                                  '<option value="estprot">Estado Protección</option>'+
                                  '<option value="evalinfr">Evaluación Infraestructura</option>'+
                                  '<option value="evalsupes">Evaluación Superestructura</option>');
                return;
            }
            if(capaName == 'cuneta' || capaName == 'sen_horizontal' || capaName == 'sen_vertical') 
            {                            
                $("#catId").append('<option value="lado">Lado</option>'+
                                  '<option value="estado">Estado</option>'+
                                  '<option value="tipo">Tipo</option>');
                return;                  
            }
            if(capaName == 'talud') 
            {                            
                $("#catId").append('<option value="estado">Estado</option>'+
                                  '<option value="tipo">Tipo</option>');
                return;
            }
            /*if(capaName == 'trafico') 
            {                            
                $("#catId").append('<option value="tipo_dia_codigo">Tipo Día</option>');
                return;
            }*/
            if(capaName == 'minas') 
            {                            
                $("#catId").append('<option value="tipo">Tipo</option>'+
                                  '<option value="fuente">Fuente</option>'+
                                  '<option value="material">Material</option>');
                return;                  
            }
            if(capaName == 'servicios_transporte' || capaName == 'punto_critico' || capaName == 'necesidades_conservacion') 
            {                            
                $("#catId").append('<option value="tipo">Tipo</option>');
                return;
            }
            if(capaName == 'produccion') 
            {                            
                $("#catId").append('<option value="sector">Sector</option>');
                return;
            }
            if(capaName == 'social') 
            {                            
                $("#catId").append('<option value="tipopob">Tipo Población</option>');
                return;
            }
        });

        $('#query_btn').on('click', (e) => {
            if($("#shapeId").val() == '')
                return false;
            if($("#catId").val() == '')
                return false;
            e.preventDefault();
            $.ajax({
                url: '{{ route("shape_query.index.vulnerability_climate_risk") }}',
                method: 'GET',
                data: {
                    filters: {
                        shape_id: $("#shapeId").val().substring(0, $("#shapeId").val().length-8),
                        cat_id: $('#catId').val(),
                    }
                },
                beforeSend: () => {
                    showLoading();
                },
                xhrFields: {
                    responseType: 'json'
                },
                success: (shapes) => {                     
                    api_osm.cargar_shapes(shapes,api_osm.get_map(), $("#shapeId").val().substring(0, $("#shapeId").val().length-8));                    
                }
            }).always(() => {
                hideLoading();
            });
        });
 
        $('#execute_btn').on('click', (e) => { 
                var level = 3;
                var zoom = 8;
                var dpacode = $("#dpa_code").val(); 
                var nameLayer =  $("#desc_pro").val(); 
                if($("#parroquia").val() != 0)
                {
                    level = 1;
                    zoom = 10;
                    dpacode = $("#parroquia").val();
                    nameLayer = $("#parroquia").select2('data')[0].text;
                } else if($("#canton").val() != 0)      
                {
                    level = 2;
                    zoom = 9;
                    dpacode = $("#canton").val();
                    nameLayer = $("#canton").select2('data')[0].text;
                }                     
                e.preventDefault();
                $.ajax({
                    url: '{{ route("execute.index.vulnerability_climate_risk") }}',
                    method: 'GET',
                    data: {
                        filters: {
                            layerId: $("#layerId").val(),
                            typeId: $('#typeId').val(),
                            dpa: dpacode,
                            levelId: level
                        }
                    },
                    beforeSend: () => {
                        showLoading();
                    },
                    xhrFields: {
                        responseType: 'json'
                    },
                    success: (layers) => {                                        
                        api_osm.load_layer_risks(layers, $("#layerId").val() + "_" + $('#typeId').val(), nameLayer, zoom);                    
                    }
                }).always(() => {
                    hideLoading();
                });
        });
        var shapes = <?php echo json_encode($shapes); ?>;	
        var shapeDefault = <?php echo json_encode($shapesDefault); ?>;	
        var codePrv = <?php echo json_encode($codePrv); ?>;	
        var api_osm = window.api_osm;
        api_osm.display(-8667739.203023149, -245375.53102195481, 7, shapes, shapeDefault, codePrv);               
    </script>
</div>          

@else
    {{ trans('shape.labels.not_data') }}
@endif
    

