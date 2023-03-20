@if(count($shapes) || count($shapesDefault))

  <!-- shapes estilos -->
    <link href="{{ mix('vendor/shapes/page.css') }}" rel="stylesheet"/>

    <!-- vista del complemento visor de Shapes -->   

    <!-- cabecera del visor de Shapes -->
    <div class="page-header_">
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
                        <button id="execute_btn" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('shape.labels.execute') }}
                        </button>  
                </div>        
        </form>
    </div>

    <div id="osm_map" class="map" tabindex="0" style="width: 100%; height:100% ">    
    </div>   
   
    <script type="text/javascript" src="{{ asset('/js/api_osm.js') }}"></script>  

    <script type="text/javascript">
            
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

        $('#execute_btn').on('click', (e) => {
            if($("#shapeId").val() == '')
                return false;
            if($("#catId").val() == '')
                return false;
            e.preventDefault();
            $.ajax({
                url: '{{ route('shape_query.index.main_shape') }}',
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
                    console.log(shapes);
                    api_osm.cargar_shapes(shapes,api_osm.get_map(), $("#shapeId").val().substring(0, $("#shapeId").val().length-8));                    
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

@else
    {{ trans('shape.labels.not_data') }}
@endif
