import Feature from 'ol/Feature.js';
import 'ol/ol.css';
import 'ol-layerswitcher/dist/ol-layerswitcher.css';
import {Map, View} from 'ol';
import {OSM, Vector as VectorSource} from 'ol/source.js';
import {Group as LayerGroup, Tile as TileLayer, Vector as VectorLayer} from 'ol/layer.js';
import {Circle} from 'ol/geom.js'
import GeoJSON from 'ol/format/GeoJSON.js';
import {Control, defaults as defaultControls} from 'ol/control.js';
import LayerSwitcher from 'ol-layerswitcher';
import { BaseLayerOptions, GroupLayerOptions } from 'ol-layerswitcher';
import {Circle as CircleStyle, Fill, Stroke, Style} from 'ol/style.js';
import Overlay from 'ol/Overlay.js';

let map;
let layerSwitcher;

var api_osm = {                       

		
    display: function (x, y, z, shapes, shapeDefault, codeprv ) {        	

		var container = document.createElement('div');
		container.className = "ol-popup";
		var content = document.createElement('div');
		var closer = document.createElement('a');
		closer.href = "#";
		closer.className = "ol-popup-closer";
		container.appendChild(closer);
		container.appendChild(content);
		var extend = [];
		
		
		const overlay = new Overlay({
		  element: container,
		  autoPan: {
			animation: {
			  duration: 250,
			},
		  },
		});
		
		closer.onclick = function () {
		  overlay.setPosition(undefined);
		  closer.blur();
		  return false;
		};
		
		const overlayGroup = new LayerGroup({
			title: 'Shapes',
			fold: 'open',
			layers: []
		});
		
		shapeDefault.forEach(function(shape) {					
			const layerP =  new VectorLayer({
				title: shape.name.charAt(0).toUpperCase() + shape.name.substring(1, shape.name.length-8),
				visible: true,
				source: new VectorSource({
					url: '../'+ shape.shape,
					format: new GeoJSON({ featureProjection: "EPSG:4326" })
				})
			});
			
			overlayGroup.getLayers().push(layerP);	
		});		
	
		const arrayColors = ['grey', 'aquamarine', 'blue', 'red', 'yellow', 'magenta', 'brown', 'black', 'orange', 'pink', 'green', 'gold', 'purple',  'cyan', 'indigo', 'coral', 'crimson', 'lime', 'maroon', 'olive', 'orchid', 'plum', 'salmon', 'turquoise', 'violet'];
		const styleCache = {};		

		shapes.forEach(function(shape) {

			const layer =  new VectorLayer({					
					title:  shape.name.charAt(0).toUpperCase() + shape.name.substring(1, shape.name.length-8),
					visible: false,
					source:  new VectorSource({
								url: '../'+ shape.shape,
								format: new GeoJSON({ featureProjection: "EPSG:4326" }),
								distance: parseInt(40, 10),
								minDistance: parseInt(20, 10),	
							}),
					style: function (feature) {	
							let style = styleCache[shape.name];	
							if (!style) {	
								
								var rand = Math.floor(Math.random()*arrayColors.length);	
								var color = arrayColors[rand];								
								console.info(color);
								if (feature.getGeometry().getType() == 'Point'){									
									style = new Style({
										image:  new CircleStyle({
											radius: 3,
											fill: new Fill({color: color}),
											stroke: new Stroke({color: color, width: 2}),
											}),
									});									
								} else if (feature.getGeometry().getType() == 'MultiLineString'){								
									style = new Style({
										stroke: new Stroke({
										  color: color,
										  width: 3,
										}),
									});	
								}	
								styleCache[shape.name] = style;							
							}													
							return style;
					},					
				  });
			overlayGroup.getLayers().push(layer);	
		});
		
		const view = new View({
		  center: [x, y],
		  zoom: z,
		});
		
	    map = new Map({
		  target: 'osm_map',
		  layers: [     			  			 
			   new TileLayer({
			  	 title: 'OSM',
			  	 type: 'base',
			  	 visible: true,
			  	 source: new OSM(),
				 opacity: 0.8
			   }),	
			   new VectorLayer({
				  title: 'RedVialEstatal', 
				  source: new VectorSource({
					 url: '../prvkml/redvialestatal.geojson',
					 format: new GeoJSON()
				  }),
				  style: new Style({
							stroke: new Stroke({
							  color: 'blue',
							  width: 1,
							}),
				  }),
	  		   }),				   
			   new VectorLayer({
                 source: new VectorSource({
					 url: '../prvkml/' + codeprv + '.geojson',
					 format: new GeoJSON()
				  }),
				 style: function (feature) {	
						if(extend.length == 0){
							extend = feature.getGeometry().extent_;		
							map.getView().fit(extend);
						}		
						return new Style({
							stroke: new Stroke({
							  color: 'red',
							  width: 2,
							}),
						});									
					},
				  opacity: 0.5	
			  }),
			  overlayGroup
		  ],
		  overlays: [overlay],
		  view: view,
		});

		layerSwitcher = new LayerSwitcher({
		  tipLabel: 'Leyenda',
		  activationMode: 'click',
		  startActive: true,
          groupSelectStyle: 'children'
		});
		
		map.addControl(layerSwitcher);			
		
		const arrayProps = ['codigo', 'tipo', 'material', 'ecabez', 'ecuerpo', 'idcorredor', 'sector', 'prod1', 'prod2', 'prod3', 'dest1', 'estado', 'lado', 'carriles', 'origen',  'destino', 'esenhori', 'esenvert', 'esuperf', 'longitud', 'tipoterren', 'tsuperf', 'uso', 'pobtot', 'tipopob', 'vivienda', 'caparodad', 'estprot', 'evalinfr', 'evalsupes', 'nombre', 'protlater', 'rioqueb', 'participa', 'pueb_indig', 'reserv_nat', 'resforest', 'riesg_pot', 'eval_riesg', 'provincia', 'clase_via', 'CODIGO_jul', 'ADMINISTRA', 'ANCHO_CA_1', 'DISTANCIA', 'ESTADO_NOV', 'LONGUITU_1', 'NUMERO_D_1', 'TIPO_DE__1', 'TRAMO_JuLi'];
		
		map.on('singleclick', function (evt) {
			let namelayer;
		    var feature = map.forEachFeatureAtPixel(evt.pixel,
			  function(feature, layer) {
				namelayer = layer.get('title');			    
				return feature;
			});
			if (feature) {
				if(feature.getGeometry().getType() == 'Point' || feature.getGeometry().getType() == 'MultiLineString')
				{						
					var coord = evt.coordinate;
					const parName = namelayer.split('(');
					content.innerHTML  = '<h4><center>' + parName[0] + '</center></h4>';
					arrayProps.forEach(function(property) {
						if ( feature.get(property) != undefined)
						{
							content.innerHTML  += "<b>" + property.charAt(0).toUpperCase() + property.slice(1) + ": </b>" + feature.get(property) + "<br/>";	
						}
					});										
					overlay.setPosition(coord);				
					console.info(feature.getProperties());
				}
			}			
		});
		
		
		
		map.on('pointermove', function(evt) {
			var feature = map.forEachFeatureAtPixel(evt.pixel,
			function(feature, layer) {
				map.getTargetElement().style.cursor = '';  
				return feature;
			});
			if (feature) {
				if(feature.getGeometry().getType() == 'Point' || feature.getGeometry().getType() == 'MultiLineString')
				{
					map.getTargetElement().style.cursor = 'pointer';
				}
			}	
			else
			{
				map.getTargetElement().style.cursor = '';  
			}		
		});

	},
	
	cargar_shapes: function (shapes, map, title) {
		const arrayColors = ['grey', 'aquamarine', 'blue', 'red', 'yellow', 'magenta', 'brown', 'black', 'orange', 'pink', 'green', 'gold', 'purple',  'cyan', 'indigo', 'coral', 'crimson', 'lime', 'maroon', 'olive', 'orchid', 'plum', 'salmon', 'turquoise', 'violet'];
		const styleCache = {};
				
		const overlayGroup = new LayerGroup({
			title: 'Query ' + title.charAt(0).toUpperCase() + title.substring(1),
			fold: 'open',
			layers: []
		});
		
		shapes.forEach(function(shape) {

			const source = new VectorSource({
				url: '../'+ shape.shape,
				format: new GeoJSON({ featureProjection: "EPSG:4326" }),
				distance: parseInt(40, 10),
				minDistance: parseInt(20, 10),	
			});
			
			const parShape = shape.name.split('-');
			
			const layer =  new VectorLayer({					
					title:  parShape[1].charAt(0).toUpperCase() + parShape[1].substring(1) +' '+ parShape[2].substring(0,parShape[2].length-8) + ' (' + shape.porcent + '%)',
					visible: true,
					source: source,
					style: function (feature) {	
							let style = styleCache[shape.name];								
							if (!style) {	
								map.getView().fit(source.getExtent());
								var rand = Math.floor(Math.random()*arrayColors.length);	
								var color = arrayColors[rand];								
								console.info(color);
								if (feature.getGeometry().getType() == 'Point'){									
									style = new Style({
										image:  new CircleStyle({
											radius: 3,
											fill: new Fill({color: color}),
											stroke: new Stroke({color: color, width: 2}),
											}),
									});									
								} else if (feature.getGeometry().getType() == 'MultiLineString'){								
									style = new Style({
										stroke: new Stroke({
										  color: color,
										  width: 3,
										}),
									});	
								}	
								styleCache[shape.name] = style;							
							}													
							return style;
					}									
				  });
			overlayGroup.getLayers().push(layer);	
		});		
		var layerR = null;
		map.getLayers().forEach(layer => {
		  if (layer.get('title') && layer.get('title').substring(0,5) == 'Query'){
			 layerR = layer;
		  }
		});
		map.removeLayer(layerR);
		map.addLayer(overlayGroup);	
		
		layerSwitcher.renderPanel();
		//map.getLayers().insertAt(0, vector);
	},
                               
	get_map: function () { 
		return map;
	},		
	
	load_layer_risks: function (shapes, groupname, layername, zoom) {		
		const styleCache = {};		
		const overlayGroup = new LayerGroup({
			title: groupname.toUpperCase(),
			fold: 'open',
			layers: []
		});
		
		shapes.forEach(function(shape) {			
			const source = new VectorSource({
				url: '../'+ shape.path,
				format: new GeoJSON({ featureProjection: "EPSG:4326" }),
				distance: parseInt(40, 10),
				minDistance: parseInt(20, 10),	
			});
						
			const layer =  new VectorLayer({					
					title:  layername.toUpperCase(),
					visible: true,
					source: source,
					style: function (feature) {	
							let color = feature.get('color');
							let style = styleCache[color];	
							//console.info());
							if (!style) {	
								map.getView().fit(source.getExtent());	
								map.getView().setZoom(zoom);	
								style = new Style({
									fill: new Fill({color: color}),
									stroke: new Stroke({
									  color: 'rgba(0,0,0,1)'									 
									}),
								});									
								styleCache[color] = style;							
							}													
							return style;
					},
					opacity: 0.6		
			});
			overlayGroup.getLayers().push(layer);				
		});		
		var layerR = null;
		map.getLayers().forEach(layer => {		
		  if (layer.get('title') && (layer.get('title').substring(0,4) == 'RX95' || layer.get('title').substring(0,4) == 'SDII')){
			  layerR = layer;			  
		  }
		});
		
		map.removeLayer(layerR);
		map.getLayers().insertAt(1, overlayGroup);
		
		if(map.getControls().getLength() == 4) //controla que no se agreguen mas veces el mismo control
		{
			var element = document.createElement('div');
			element.className = 'ol-panel-2';
			element.innerHTML = "<table><caption><b>Leyenda</b></caption><tr><td><div class='legend-gray'/></td><td>Nulo</td></tr><tr><td><div class='legend-cane'/></td><td>Más bajo</td></tr><tr><td><div class='legend-green'/></td><td>Bajo</td></tr><tr><td><div class='legend-yellow'/></td><td>Moderado</td></tr><tr><td><div class='legend-orange'/></td><td>Alto</td></tr><tr><td><div class='legend-red'/></td><td>Más alto</td></tr></table>";

			var controlPanel = new Control({
				element: element
			});
			map.addControl(controlPanel);
		}	
		layerSwitcher.renderPanel();
	},
	
	
};                               
window.api_osm = api_osm;   