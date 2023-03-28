#Construir los contenedores

docker compose --env-file=./src/.env build

#Ejecutar contenedores

docker compose --env-file=./src/.env up

#install npm
apt-get update && apt-get install -y npm
npm install
rm -rf node_modules && npm cache clean --force && npm install && npm run dev


#Ejecutar migracion a la bdd
php artisan migrate

#Ejecutar seeers a la bdd
php artisan db:seed --class=DatabaseTenantSeeder

#Crear MVC
php artisan make:controller "Business\Roads\Catalogs\CatalogController"

php artisan make:model "Business\Roads\Catalogs\Catalog"

php artisan make:view "Business\Roads\Catalogs\Catalog"

#Limpiar caché
php artisan route:clear
php artisan cache:clear
php artisan config:clear
php artisan config:cache

#Crear seeders
composer require orangehill/iseed
php artisan iseed road_catalog

ogr2ogr -f GeoJSON -lco COORDINATE_PRECISION=4 /var/www/html/public/shapes/shapes/info_ambiental.geojson /var/www/html/public/shapes/shapes/info_ambiental.shp --config SHAPE_RESTORE_SHX YES



ogr2ogr -f PostgreSQL PG:"dbname='tenant_1' host='pgsql' port='5432' user='postgres' password='postgres'" "alcantarilla.geojson" -nln gis.alcantarilla_shp -overwrite

ogr2ogr -f PostgreSQL PG:"dbname='tenant_1' host='pgsql' port='5432' user='postgres' password='postgres'" "caracteristicas_via.geojson" -nln gis.caracteristicas_via_shp -overwrite


select json_agg(feature) as feature from (
  select 
    (
      select row_to_json(d)
      from (
        select codigo,ecabez, ecuerpo, material, tipo
        from gis.alcantarilla_shp d
        where d.gid = s.gid limit 1
      ) d
    ) as properties,
	ST_AsGeoJSON(ST_SetSRID(wkb_geometry :: geometry,4326))::json As geometry
  from gis.alcantarilla_shp as s where s.ecabez = 'BUENO'
) as feature

select json_agg(feature) as feature from (
  select 
    (
      select row_to_json(d)
      from (
        select codigo, tipoterren, uso, poblaciin, viviendas, esenhori, esenvert, esuperf, origen, destino
        from gis.caracteristicas_via_shp d
        where d.gid = s.gid limit 1
      ) d
    ) as properties,
	ST_AsGeoJSON(ST_SetSRID(wkb_geometry :: geometry,4326))::json As geometry
  from gis.caracteristicas_via_shp as s where s.tipoterren = 'MONTANOSO'
) as feature

SELECT gis.sp_getalcantarilla('METALICA','CIRCULAR','REGULAR','BUENO')

 public function getSelectPrueba()
    {   
        return DB::select('SELECT gis."sp_getalcantarilla"(:material,:tipo,:ecabez,:ecuerpo) 
        as feature', ['material' => 'METALICA', 'tipo' => 'CIRCULAR', 'ecabez' => 'BUENO', 'ecuerpo' => 'BUENO' ]);  

    }   
	
SELECT jsonb_build_object(
    'type', 'FeatureCollection',
	'name', 'alcantarilla',
    'features', jsonb_agg(features.feature)
)
FROM (
  SELECT jsonb_build_object(
    'type',       'Feature',
    'geometry',   ST_AsGeoJSON(ST_SetSRID(wkb_geometry :: geometry,4326))::jsonB,
    'properties', json_build_object('codigo', codigo, 
			'ecabez', ecabez, 
			'ecuerpo', ecuerpo, 
			'material', material, 
			'tipo', tipo)
  ) AS feature
  FROM (SELECT codigo,ecabez,ecuerpo,material,tipo, wkb_geometry 
		FROM gis.alcantarilla_gj where material = 'METALICA' ) inputs) features;

 ogr2ogr -f PostgreSQL PG:"dbname='tenant_2' host='pgsql' port='5432' user='postgres' password='postgres'" "rx95p_altas.geojson" -nln sch_gis.rx95p_altas -overwrite
 
ogr2ogr -f PostgreSQL PG:"dbname='tenant_2' host='pgsql' port='5432' user='postgres' password='postgres'" "rx95p_histo.geojson" -nln sch_gis.rx95p_histo -overwrite
  
ogr2ogr -f PostgreSQL PG:"dbname='tenant_2' host='pgsql' port='5432' user='postgres' password='postgres'" "rx95p_medias.geojson" -nln sch_gis.rx95p_medias -overwrite

ogr2ogr -f PostgreSQL PG:"dbname='tenant_2' host='pgsql' port='5432' user='postgres' password='postgres'" "sdii_altas.geojson" -nln sch_gis.sdii_altas -overwrite

ogr2ogr -f PostgreSQL PG:"dbname='tenant_2' host='pgsql' port='5432' user='postgres' password='postgres'" "sdii_histo.geojson" -nln sch_gis.sdii_histo -overwrite

ogr2ogr -f PostgreSQL PG:"dbname='tenant_2' host='pgsql' port='5432' user='postgres' password='postgres'" "sdii_medias.geojson" -nln sch_gis.sdii_medias -overwrite

php artisan make:model "Business\Climatic\Risk"

