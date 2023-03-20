<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('road_capa_rodadura_puente', function (Blueprint $table) {
            $table->string('codigo', 5);
            $table->string('descrip', 120)->primary();
        });

        Schema::create('road_caracteristicas_generales_via_hdm4', function (Blueprint $table) {
            $table->integer('id_hdm4', true);
            $table->text('SECT_ID')->nullable();
            $table->text('SECT_NAME')->nullable();
            $table->text('LINK_ID')->nullable();
            $table->text('LINK_NAME')->nullable();
            $table->text('SPEED_FLOW')->nullable();
            $table->text('TRAF_FLOW')->nullable();
            $table->text('ACC_CLASS')->nullable();
            $table->text('ROAD_CLASS')->nullable();
            $table->text('CLIM_ZONE')->nullable();
            $table->text('SURF_CLASS')->nullable();
            $table->text('LENGTH')->nullable();
            $table->text('CWAY_WIDTH')->nullable();
            $table->text('SHLD_WIDTH')->nullable();
            $table->text('MT_AADT')->nullable();
            $table->text('NM_AADT')->nullable();
            $table->text('AADT_YEAR')->nullable();
            $table->text('DIRECTION')->nullable();
            $table->text('RF')->nullable();
            $table->text('NUM_RFS')->nullable();
            $table->text('SUPERELEV')->nullable();
            $table->text('CURVATURE')->nullable();
            $table->text('SIGM_ADRAL')->nullable();
            $table->text('SPEED_LIM')->nullable();
            $table->text('ENFORCEMNT')->nullable();
            $table->text('XNMT')->nullable();
            $table->text('XMT')->nullable();
            $table->text('XFRI')->nullable();
            $table->text('HSNEW')->nullable();
            $table->text('HSOLD')->nullable();
            $table->text('HBASE')->nullable();
            $table->text('RES_MODULU')->nullable();
            $table->text('REL_COMPCT')->nullable();
            $table->text('SNP_DERIVE')->nullable();
            $table->text('SN')->nullable();
            $table->text('CBR')->nullable();
            $table->text('SNP_DRY')->nullable();
            $table->text('D0')->nullable();
            $table->text('BENKEL_DEF')->nullable();
            $table->text('SURF_STREN')->nullable();
            $table->text('BASE_STREN')->nullable();
            $table->text('SUBB_STREN')->nullable();
            $table->text('HSUBBASE')->nullable();
            $table->text('SURF_THICK')->nullable();
            $table->text('SLAB_LENTH')->nullable();
            $table->text('BASE_THICK')->nullable();
            $table->text('BASE_MODUL')->nullable();
            $table->text('CNSTR_YEAR')->nullable();
            $table->text('SUBG_MATRL')->nullable();
            $table->text('COMPMETHOD')->nullable();
            $table->text('COND_YEAR')->nullable();
            $table->text('ROUGHNESS')->nullable();
            $table->text('CRACKS_ACA')->nullable();
            $table->text('CRACKS_ACW')->nullable();
            $table->text('CRACKS_ACT')->nullable();
            $table->text('RAVEL_AREA')->nullable();
            $table->text('PHOLE_NUM')->nullable();
            $table->text('EDGEBREAK')->nullable();
            $table->text('RUT_DEPTH')->nullable();
            $table->text('RUTDEPTH_SD')->nullable();
            $table->text('TEXT_DEPTH')->nullable();
            $table->text('SKIDRESIST')->nullable();
            $table->text('DRAIN_COND')->nullable();
            $table->text('FAULTING')->nullable();
            $table->text('SPALL_JNTS')->nullable();
            $table->text('CRACKSLABS')->nullable();
            $table->text('DETERCRACK')->nullable();
            $table->text('FAILURESKM')->nullable();
            $table->text('GRAV_THICK')->nullable();
            $table->text('LAST_CONST')->nullable();
            $table->text('LAST_SURF')->nullable();
            $table->text('LAST_PRVNT')->nullable();
            $table->text('LAST_REHAB')->nullable();
            $table->text('PREV_ACA')->nullable();
            $table->text('PREV_ACW')->nullable();
            $table->text('PREV_NCT')->nullable();
            $table->text('LASTGRAVEL')->nullable();
            $table->text('DRAIN_TYPE')->nullable();
            $table->text('ALTITUDE')->nullable();
            $table->text('SHOULDTYPE')->nullable();
            $table->text('WIDN_WIDTH')->nullable();
            $table->text('EDGEDRAINS')->nullable();
            $table->text('NMT_SEPAR')->nullable();
            $table->text('NMTLANES')->nullable();
            $table->text('ELANES')->nullable();
            $table->text('CALIB_ITEM')->nullable();
            $table->text('REPCOST')->nullable();
            $table->text('CONDBASED')->nullable();
            $table->text('INIROUGH')->nullable();
            $table->text('TERROUGH')->nullable();
            $table->text('RDFOSBGR_P')->nullable();
            $table->text('RDPVLA_PRR')->nullable();
            $table->text('FTCYCLE_PR')->nullable();
            $table->text('BRDGSTR_PR')->nullable();
            $table->text('TRFSGN_PRR')->nullable();
            $table->text('RDFOSBGR_R')->nullable();
            $table->text('RDPVLA_RES')->nullable();
            $table->text('FTCYCLE_RE')->nullable();
            $table->text('BRDGSTR_RE')->nullable();
            $table->text('TRFSGN_RES')->nullable();
            $table->text('RDFOSBGR_U')->nullable();
            $table->text('RDPVLA_USE')->nullable();
            $table->text('FTCYCLE_US')->nullable();
            $table->text('BRDGSTR_US')->nullable();
            $table->text('TRFSGN_USE')->nullable();
            $table->text('RDFOSBGR_A')->nullable();
            $table->text('RDPVLA_AGE')->nullable();
            $table->text('FTCYCLE_AG')->nullable();
            $table->text('BRDGSTR_AG')->nullable();
            $table->text('TRFSGN_AGE')->nullable();
            $table->text('COMPAGEYEA')->nullable();
            $table->text('USFLFEUNIT')->nullable();
            $table->text('ID')->nullable();
        });

        Schema::create('road_carriles', function (Blueprint $table) {
            $table->string('codigo', 5);
            $table->string('descrip', 50)->primary();
        });

        Schema::create('road_condiciones_climaticas', function (Blueprint $table) {
            $table->string('codigo', 5);
            $table->string('descrip', 50)->unique('condiciones_climaticas_descrip_uindex');
        });

        Schema::create('road_est_drenaje', function (Blueprint $table) {
            $table->integer('codigo')->default(0);
            $table->string('descrip', 120)->primary();
        });

        Schema::create('road_estado', function (Blueprint $table) {
            $table->string('codigo');
            $table->string('descripcion', 120)->primary();
        });

        Schema::create('road_fuente', function (Blueprint $table) {
            $table->string('codigo', 2);
            $table->string('descrip', 50)->unique('fuente_descrip_uindex');
        });

        Schema::create('road_humedad', function (Blueprint $table) {
            $table->integer('codigo')->primary();
            $table->string('descrip', 120)->nullable();
        });

        Schema::create('road_lado', function(Blueprint $table)
        {
            $table->string('codigo', 2);
            $table->string('descrip', 50)->unique('lado_descrip_uindex');
        });

        Schema::create('road_material_alcantarilla', function (Blueprint $table) {
            $table->string('codigo', 5);
            $table->string('descrip', 50)->unique('material_alcantarilla_descrip_uindex');
        });

        Schema::create('road_material_minas', function(Blueprint $table)
        {
            $table->string('codigo', 5);
            $table->string('descrip', 50)->unique('material_minas_descrip_uindex');
        });



        Schema::create('road_piso_climatico', function (Blueprint $table) {
            $table->integer('codigo');
            $table->string('descrip', 120)->primary();
        });



        Schema::create('road_protecciones_laterales', function (Blueprint $table) {
            $table->string('codigo', 5);
            $table->string('descrip', 120)->primary();
        });

        Schema::create('road_sector_productivo', function (Blueprint $table) {
            $table->string('codigo', 5);
            $table->string('descrip', 50)->unique('sector_productivo_descrip_uindex');
        });

        Schema::create('road_superficie_rodadura', function (Blueprint $table) {
            $table->integer('codigo');
            $table->string('descrip', 120)->primary();
        });

        Schema::create('road_tipo_alcantarilla', function (Blueprint $table) {
            $table->string('codigo', 3);
            $table->string('descrip', 50)->unique('tipo_alcantarilla_descrip_uindex');
        });

        Schema::create('road_tipo_cuneta', function (Blueprint $table) {
            $table->string('codigo', 2);
            $table->string('descrip', 50)->unique('tipo_cuneta_descrip_uindex');
        });

        Schema::create('road_tipo_dia', function (Blueprint $table) {
            $table->integer('codigo');
            $table->string('descrip', 120)->primary();
        });

        Schema::create('road_tipo_drenaje', function (Blueprint $table) {
            $table->integer('codigo');
            $table->string('descrip', 120)->primary();
        });

        Schema::create('road_tipo_firme', function (Blueprint $table) {
            $table->integer('codigo')->default(0);
            $table->string('descrip', 120)->primary();
        });

        Schema::create('road_tipo_interconexion', function (Blueprint $table) {
            $table->string('codigo', 2);
            $table->string('descrip', 120)->unique('tipo_interconexion_descrip_uindex');
        });

        Schema::create('road_tipo_material', function (Blueprint $table) {
            $table->integer('codigo');
            $table->string('descrip', 120)->unique('tipo_material_descrip_uindex');
        });

        Schema::create('road_tipo_minas', function (Blueprint $table) {
            $table->string('codigo', 5);
            $table->string('descrip', 50)->unique('tipo_minas_descrip_uindex');
        });

        Schema::create('road_tipo_necesidad_conservacion', function (Blueprint $table) {
            $table->string('codigo', 5);
            $table->string('descrip', 120)->unique('tipo_necesidad_conservacion_descrip_uindex');
        });

        Schema::create('road_tipo_poblacion', function (Blueprint $table) {
            $table->string('codigo', 3);
            $table->string('descrip', 50)->unique('tipo_poblacion_descrip_uindex');
        });

        Schema::create('road_tipo_punto_critico', function (Blueprint $table) {
            $table->string('codigo', 5);
            $table->string('descrip', 120)->primary();
        });

        Schema::create('road_tipo_senal_horizontal', function (Blueprint $table) {
            $table->string('codigo', 5);
            $table->string('descrip', 50)->primary();
        });

        Schema::create('road_tipo_senal_vertical', function (Blueprint $table) {
            $table->string('codigo', 3);
            $table->string('descripcion', 50)->unique('tipo_senal_vertical_descripcion_uindex');
        });

        Schema::create('road_tipo_servicio_asociado', function (Blueprint $table) {
            $table->string('codigo', 5);
            $table->string('descrip', 120)->primary();
        });

        Schema::create('road_tipo_superficie_rodadura', function (Blueprint $table) {
            $table->string('codigo', 5);
            $table->string('descrip', 50)->primary();
        });

        Schema::create('road_tipo_talud', function (Blueprint $table) {
            $table->string('codigo', 1);
            $table->string('descrip', 120)->primary();
        });

        Schema::create('road_tipo_terreno', function (Blueprint $table) {
            $table->string('codigo', 3);
            $table->string('descrip', 120)->unique('tipo_terreno_descrip_uindex');
        });

        Schema::create('road_tipo_vehiculo', function (Blueprint $table) {
            $table->integer('codigo');
            $table->string('descrip', 120)->unique('tipo_vehiculo_descrip_uindex');
        });

        Schema::create('road_uso_via', function (Blueprint $table) {
            $table->string('codigo', 5);
            $table->string('descrip', 50)->primary();
        });

        Schema::create('road_vehiculo_caracteristicas', function (Blueprint $table) {
            $table->increments('gid');
            $table->float('ocu_esp_fis', 10)->nullable()->default(0.00);
            $table->integer('num_ruedas')->nullable()->default(0);
            $table->integer('num_ejes')->nullable()->default(0);
            $table->float('reencaucha', 10)->nullable()->default(0.00);
            $table->float('utiliz_vehi', 10)->nullable()->default(0.00);
            $table->float('coste_reencau', 10)->nullable()->default(0.00);
            $table->integer('horas_trabaj')->nullable()->default(0);
            $table->float('vida_med', 10)->nullable()->default(0.00);
            $table->float('uso_privado', 10)->nullable()->default(0.00);
            $table->float('pasajeros', 10)->nullable()->default(0.00);
            $table->float('viajes', 10)->nullable()->default(0.00);
            $table->float('costo_nuevo', 10)->nullable()->default(0.00);
            $table->float('costo_neuma', 10)->nullable()->default(0.00);
            $table->float('combusti', 10)->nullable()->default(0.00);
            $table->float('aceite', 10)->nullable()->default(0.00);
            $table->float('mantenim', 10)->nullable()->default(0.00);
            $table->float('tripulacion', 10)->nullable()->default(0.00);
            $table->float('gastos_gen', 10)->nullable()->default(0.00);
            $table->float('interes_anu', 10)->nullable()->default(0.00);
            $table->float('val_tiemp_trabajo', 10)->nullable()->default(0.00);
            $table->float('val_tiemp_ocio', 10)->nullable()->default(0.00);
            $table->float('peso_bruto', 10)->nullable()->default(0.00);
            $table->float('horas_condu', 10)->nullable()->default(0.00);
            $table->float('km_condu', 10)->nullable()->default(0.00);
        });

        Schema::create('road_caracteristicas_generales_via', function (Blueprint $table) {
            $table->string('codigo', 13)->primary();
            $table->string('respons', 80)->nullable();
            $table->string('fecha', 12)->nullable();
            $table->string('prov')->nullable();
            $table->string('canton')->nullable();
            $table->string('parroquia')->nullable();
            $table->integer('numcamino')->nullable()->default(0);
            $table->string('tipointer', 120)->nullable();
            $table->string('origen', 120)->nullable();
            $table->string('destino', 120)->nullable();
            $table->string('asentami', 120)->nullable();
            $table->string('longi')->nullable()->default('0');
            $table->string('lati')->nullable()->default('0');
            $table->string('longf')->nullable()->default('0');
            $table->string('latf')->nullable()->default('0');
            $table->string('altermat')->nullable();
            $table->string('planttr')->nullable();
            $table->string('relleno')->nullable();
            $table->string('proysoc')->nullable();
            $table->string('proyest')->nullable();
            $table->string('proyseg')->nullable();
            $table->string('proypro')->nullable();
            $table->string('coclimati', 50)->nullable();
            $table->unsignedInteger('gid')->nullable()->index('gid');
            $table->integer('num_tra')->nullable()->default(0)->index('num_tra');

            $table->foreign('coclimati',
                'caracteristicas_generales_via_condiciones_climaticas_descrip_fk')->references('descrip')->on('road_condiciones_climaticas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipointer',
                'caracteristicas_generales_via_tipo_interconexion_descrip_fk')->references('descrip')->on('road_tipo_interconexion')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_caracteristicas_via', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('codigo', 13)->nullable();
            $table->string('origen', 120)->nullable();
            $table->string('destino', 120)->nullable();
            $table->string('tipoterreno', 120)->nullable();
            $table->string('lati')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->string('latf')->nullable()->default('0');
            $table->string('longf')->nullable()->default('0');
            $table->integer('Numerocamino')->nullable()->default(0);
            $table->integer('Numerosubcamino')->nullable()->default(0);
            $table->string('tsuperf', 50)->nullable();
            $table->string('esuperf', 120)->nullable();
            $table->string('longitud', 20)->nullable();
            $table->float('anchoca', 10)->nullable()->default(0.00);
            $table->float('anchovi', 10)->nullable()->default(0.00);
            $table->string('uso', 50)->nullable();
            $table->string('carriles', 50)->nullable();
            $table->float('velprom', 10)->nullable()->default(0.00);
            $table->integer('numcurv')->nullable()->default(0);
            $table->float('distvis', 10)->nullable()->default(0.00);
            $table->integer('numinters')->nullable()->default(0);
            $table->string('esenhori', 120)->nullable();
            $table->string('esenvert', 120)->nullable();
            $table->integer('nupuent')->nullable()->default(0);
            $table->string('observ', 180)->nullable();
            $table->string('imagen', 100)->nullable();
            $table->integer('numalcan')->nullable()->default(0);
            $table->integer('numminas')->nullable()->default(0);
            $table->integer('numpuntocri')->nullable()->default(0);
            $table->integer('numsen')->nullable()->default(0);
            $table->integer('numservicio')->nullable()->default(0);
            $table->integer('Población')->nullable()->default(0);
            $table->integer('Viviendas')->nullable()->default(0);
            $table->integer('numtalud')->nullable()->default(0);
            $table->integer('numasent')->nullable()->default(0);

            $table->foreign('codigo',
                'caracteristicas_via_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('carriles', 'caracteristicas_via_carriles_descrip_fk')->references('descrip')->on('road_carriles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('esuperf', 'caracteristicas_via_estado_descripcion_fk')->references('descripcion')->on('road_estado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('esenhori', 'caracteristicas_via_estado_descripcion_fk_2')->references('descripcion')->on('road_estado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('esenvert', 'caracteristicas_via_estado_descripcion_fk_3')->references('descripcion')->on('road_estado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tsuperf',
                'caracteristicas_via_tipo_superficie_rodadura_descrip_fk')->references('descrip')->on('road_tipo_superficie_rodadura')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipoterreno', 'caracteristicas_via_tipo_terreno_descrip_fk')->references('descrip')->on('road_tipo_terreno')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('uso', 'caracteristicas_via_uso_via_descrip_fk')->references('descrip')->on('road_uso_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_alcantarilla', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('tipo', 50)->nullable();
            $table->string('longitud', 20)->nullable();
            $table->string('material', 50)->nullable();
            $table->float('cuancho', 10)->nullable()->default(0.00);
            $table->float('cualto', 10)->nullable()->default(0.00);
            $table->float('cudiam', 10)->nullable()->default(0.00);
            $table->string('cabezales')->nullable();
            $table->string('ecabez', 120)->nullable();
            $table->string('ecuerpo', 120)->nullable();
            $table->string('lat')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->string('observ', 180)->nullable();
            $table->string('codigo', 13)->nullable();
            $table->string('imagen1', 100)->nullable();
            $table->string('imagen2', 100)->nullable();
            $table->string('imagen3', 100)->nullable();

            $table->foreign('codigo',
                'alcantarilla_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('ecabez', 'alcantarilla_estado_ecabez_descripcion_fk')->references('descripcion')->on('road_estado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('ecuerpo', 'alcantarilla_estado_ecuerpo_descripcion_fk')->references('descripcion')->on('road_estado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('material',
                'alcantarilla_material_alcantarilla_descrip_fk')->references('descrip')->on('road_material_alcantarilla')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo', 'alcantarilla_tipo_alcantarilla_descrip_fk')->references('descrip')->on('road_tipo_alcantarilla')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_cuneta', function (Blueprint $table) {
            $table->increments('gid')->unique('cuneta_gid_uindex');
            $table->string('lado', 50)->nullable();
            $table->string('estado', 120)->nullable();
            $table->string('tipo', 50)->nullable();
            $table->string('lati')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->string('latf')->nullable()->default('0');
            $table->string('longf')->nullable()->default('0');
            $table->string('observ', 180)->nullable();
            $table->string('codigo', 13)->nullable();

            $table->foreign('codigo',
                'cuneta_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('estado', 'cuneta_estado_descripcion_fk')->references('descripcion')->on('road_estado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('lado', 'cuneta_lado_descrip_fk')->references('descrip')->on('road_lado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo', 'cuneta_tipo_cuneta_descrip_fk')->references('descrip')->on('road_tipo_cuneta')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_evaluacion_HDM4', function (Blueprint $table) {
            $table->string('codigo', 13)->unique('evaluacion_HDM4_codigo_uindex');
            $table->string('analisis_eco', 150)->nullable();
            $table->string('tipo_terreno_codigo', 120)->nullable();
            $table->integer('rampas_pendientes')->nullable()->default(0);
            $table->float('curv_horiz_m', 10)->nullable()->default(0.00);
            $table->integer('ramp_asc_desc')->nullable()->default(0);
            $table->float('vel_disen', 10)->nullable()->default(0.00);
            $table->string('piso_climatico_codigo', 120)->nullable();
            $table->string('clase_camino_codigo', 120)->nullable();
            $table->string('sup_actual_cod', 120)->nullable()->default('0');
            $table->string('sup_fut_cod', 120)->nullable()->default('0');
            $table->string('tipo_firme_codigo', 120)->nullable();
            $table->integer('dias_lluviosos')->nullable()->default(0);
            $table->integer('dias_nolluviosos')->nullable()->default(0);
            $table->float('longitud', 10)->nullable()->default(0.00);
            $table->float('ancho_calz', 10)->nullable()->default(0.00);
            $table->float('ancho_esp', 10)->nullable()->default(0.00);
            $table->string('carriles')->nullable();
            $table->float('altitud', 10)->nullable()->default(0.00);
            $table->string('tipo_drenaje_codigo', 120)->nullable();
            $table->string('espesor', 50)->nullable();
            $table->string('tipo_material_codigo', 120)->nullable();
            $table->integer('ult_interv')->nullable()->default(0);
            $table->float('area_fisurad', 10)->nullable()->default(0.00);
            $table->float('iri', 10)->nullable()->default(0.00);
            $table->float('porc_despr', 10)->nullable()->default(0.00);
            $table->integer('baches')->nullable()->default(0);
            $table->float('deflexion', 10)->nullable()->default(0.00);
            $table->float('espe_grava', 10)->nullable()->default(0.00);
            $table->float('rozamiento', 10)->nullable()->default(0.00);
            $table->string('est_drenaje_codigo', 120)->nullable();
            $table->float('rotura_bord', 10)->nullable()->default(0.00);
            $table->float('cost_mant_rut', 10)->nullable()->default(0.00);
            $table->float('cost_mant_per', 10)->nullable()->default(0.00);
            $table->float('cost_mejoram', 10)->nullable()->default(0.00);
            $table->float('cost_construcc', 10)->nullable()->default(0.00);
            $table->float('monto_ref', 10)->nullable()->default(0.00);

            $table->foreign('codigo',
                'evaluacion_HDM4_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('est_drenaje_codigo', 'evaluacion_HDM4_est_drenaje_descrip_fk')->references('descrip')->on('road_est_drenaje')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('piso_climatico_codigo',
                'evaluacion_HDM4_piso_climatico_descrip_fk')->references('descrip')->on('road_piso_climatico')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('sup_actual_cod',
                'evaluacion_HDM4_superficie_rodadura_descrip_fk')->references('descrip')->on('road_superficie_rodadura')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('sup_fut_cod',
                'evaluacion_HDM4_superficie_rodadura_descrip_fk_2')->references('descrip')->on('road_superficie_rodadura')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo_drenaje_codigo',
                'evaluacion_HDM4_tipo_drenaje_descrip_fk')->references('descrip')->on('road_tipo_drenaje')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo_firme_codigo', 'evaluacion_HDM4_tipo_firme_descrip_fk')->references('descrip')->on('road_tipo_firme')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('clase_camino_codigo',
                'evaluacion_HDM4_tipo_interconexion_descrip_fk')->references('descrip')->on('road_tipo_interconexion')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo_material_codigo',
                'evaluacion_HDM4_tipo_material_descrip_fk')->references('descrip')->on('road_tipo_material')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo_terreno_codigo',
                'evaluacion_HDM4_tipo_terreno_descrip_fk')->references('descrip')->on('road_tipo_terreno')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_info_ambiental', function (Blueprint $table) {
            $table->string('codigo', 13)->primary();
            $table->string('participa')->nullable();
            $table->string('eval_riesg')->nullable();
            $table->string('riesg_pot')->nullable();
            $table->string('reserv_nat')->nullable();
            $table->string('pueb_indig')->nullable();
            $table->string('prot_cuenc')->nullable();
            $table->string('resforest')->nullable();
            $table->string('act_ambie')->nullable();

            $table->foreign('codigo',
                'info_ambiental_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_interseccion', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('lat')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->float('dist', 10)->nullable()->default(0.00);
            $table->string('descrip', 100)->nullable();
            $table->string('observ', 180)->nullable();
            $table->string('codigo', 13)->nullable();
            $table->string('imagen', 100)->nullable();

            $table->foreign('codigo',
                'interseccion_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_minas', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('tipo', 50)->nullable();
            $table->string('fuente', 50)->nullable();
            $table->string('material', 50)->nullable();
            $table->float('distan', 10)->nullable()->default(0.00);
            $table->string('lat')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->string('observ', 180)->nullable();
            $table->string('codigo', 13)->nullable();
            $table->string('imagen', 100)->nullable();

            $table->foreign('codigo',
                'minas_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('fuente', 'minas_fuente_descrip_fk')->references('descrip')->on('road_fuente')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('material', 'minas_material_minas_descrip_fk')->references('descrip')->on('road_material_minas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo', 'minas_tipo_minas_descrip_fk')->references('descrip')->on('road_tipo_minas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_necesidades_conservacion', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('tipo', 120)->nullable();
            $table->string('lat')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->string('observ', 180)->nullable();
            $table->string('codigo', 13)->nullable();
            $table->string('imagen', 100)->nullable()->index('imagen');

            $table->foreign('codigo',
                'necesidades_conservacion_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo',
                'necesidades_conservacion_tipo_necesidad_conservacion_descrip_fk')->references('descrip')->on('road_tipo_necesidad_conservacion')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_produccion', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('codigo', 13)->nullable();
            $table->string('sector', 50)->nullable();
            $table->string('prod1', 50)->nullable();
            $table->string('prod2', 50)->nullable();
            $table->string('prod3', 50)->nullable();
            $table->integer('vol1')->nullable()->default(0);
            $table->integer('vol2')->nullable()->default(0);
            $table->integer('vol3')->nullable()->default(0);
            $table->string('dest1', 80)->nullable();
            $table->string('dest2', 80)->nullable();
            $table->string('dest3', 80)->nullable();
            $table->string('val1', 50)->nullable();
            $table->string('val2', 50)->nullable();
            $table->string('val3', 50)->nullable();
            $table->string('flete1', 50)->nullable();
            $table->string('flete2', 50)->nullable();
            $table->string('flete3', 50)->nullable();
            $table->string('observ', 180)->nullable();

            $table->foreign('codigo',
                'produccion_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('sector', 'produccion_sector_productivo_descrip_fk')->references('descrip')->on('road_sector_productivo')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_puente', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('codp')->nullable();
            $table->string('nombre', 80)->nullable();
            $table->string('rioqueb', 100)->nullable();
            $table->string('caparodad', 120)->nullable();
            $table->float('galibo', 10)->nullable()->default(0.00);
            $table->float('ancho', 10)->nullable()->default(0.00);
            $table->float('anchotot', 10)->nullable()->default(0.00);
            $table->string('longitud', 20)->nullable();
            $table->string('protlater', 120)->nullable();
            $table->string('estprot', 120)->nullable();
            $table->string('evalinfr', 120)->nullable();
            $table->string('evalsupes', 120)->nullable();
            $table->integer('carga')->nullable()->default(0);
            $table->string('sencarga')->nullable();
            $table->string('lat')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->string('observ', 180)->nullable();
            $table->string('codigo', 13)->nullable()->index('codigo');
            $table->string('imagen1', 100)->nullable();
            $table->string('imagen2', 100)->nullable();
            $table->string('imagen3', 100)->nullable();
            $table->string('imagen4', 100)->nullable();
            $table->string('imagen5', 100)->nullable();

            $table->foreign('caparodad', 'puente_capa_rodadura_puente_descrip_fk')->references('descrip')->on('road_capa_rodadura_puente')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('codigo',
                'puente_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('estprot', 'puente_estado_descripcion_fk')->references('descripcion')->on('road_estado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('evalinfr', 'puente_estado_descripcion_fk_2')->references('descripcion')->on('road_estado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('evalsupes', 'puente_estado_descripcion_fk_3')->references('descripcion')->on('road_estado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('protlater',
                'puente_protecciones_laterales_descrip_fk')->references('descrip')->on('road_protecciones_laterales')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_punto_critico', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('tipo', 120)->nullable();
            $table->string('lat')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->string('observ', 180)->nullable();
            $table->string('codigo', 13)->nullable();
            $table->string('imagen', 100)->nullable();

            $table->foreign('codigo',
                'punto_critico_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo', 'punto_critico_tipo_punto_critico_descrip_fk')->references('descrip')->on('road_tipo_punto_critico')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_sen_horizontal', function (Blueprint $table) {
            $table->increments('gid')->unique('sen_horizontal_gid_uindex');
            $table->string('tipo', 50)->nullable();
            $table->string('estado', 120)->nullable();
            $table->string('lado', 50)->nullable();
            $table->string('lati')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->string('latf')->nullable()->default('0');
            $table->string('longf')->nullable()->default('0');
            $table->string('observ', 180)->nullable();
            $table->string('codigo', 13)->nullable();

            $table->foreign('codigo',
                'sen_horizontal_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('estado', 'sen_horizontal_estado_descripcion_fk')->references('descripcion')->on('road_estado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('lado', 'sen_horizontal_lado_descrip_fk')->references('descrip')->on('road_lado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo',
                'sen_horizontal_tipo_senal_horizontal_descrip_fk')->references('descrip')->on('road_tipo_senal_horizontal')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_sen_vertical', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('tipo', 50)->nullable();
            $table->string('estado', 120)->nullable();
            $table->string('lado', 50)->nullable();
            $table->string('lat')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->string('observ', 180)->nullable();
            $table->string('codigo', 13)->nullable();
            $table->string('imagen', 100)->nullable();

            $table->foreign('codigo',
                'sen_vertical_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('estado', 'sen_vertical_estado_descripcion_fk')->references('descripcion')->on('road_estado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('lado', 'sen_vertical_lado_descrip_fk')->references('descrip')->on('road_lado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo',
                'sen_vertical_tipo_senal_vertical_descripcion_fk')->references('descripcion')->on('road_tipo_senal_vertical')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_social', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('asent', 100)->nullable();
            $table->string('organ1', 120)->nullable();
            $table->string('organ2', 120)->nullable();
            $table->string('organ3', 120)->nullable();
            $table->string('tipopob', 50)->nullable();
            $table->integer('pobtot')->nullable()->default(0);
            $table->integer('vivienda')->nullable()->default(0);
            $table->string('lat')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->string('observ', 180)->nullable();
            $table->string('codigo', 13);
            $table->string('imagen', 100)->nullable();

            $table->foreign('codigo',
                'social_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipopob', 'social_tipo_poblacion_descrip_fk')->references('descrip')->on('road_tipo_poblacion')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_servicios_apoyo', function (Blueprint $table) {
            $table->integer('id')->index('id');
            $table->string('servicio', 25)->nullable();
            $table->integer('numero')->nullable()->default(0);
            $table->string('lat')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->unsignedInteger('gid')->primary();
            $table->string('imagen', 100)->nullable();

            $table->foreign('gid', 'servicios_apoyo_social_gid_fk')->references('gid')->on('road_social')->onUpdate('RESTRICT')->onDelete('RESTRICT');

        });

        Schema::create('road_servicios_transporte', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('tipo', 120)->nullable();
            $table->string('lat')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->string('observ', 180)->nullable();
            $table->string('codigo', 13)->nullable();
            $table->string('imagen', 100)->nullable();

            $table->foreign('codigo',
                'servicios_transporte_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo',
                'servicios_transporte_tipo_servicio_asociado_descrip_fk')->references('descrip')->on('road_tipo_servicio_asociado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_talud', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('tipo', 50)->nullable();
            $table->string('estado', 120)->nullable();
            $table->string('lat')->nullable()->default('0');
            $table->string('longi')->nullable()->default('0');
            $table->string('observ', 180)->nullable();
            $table->string('codigo', 13)->nullable();
            $table->string('imagen', 100)->nullable();

            $table->foreign('codigo',
                'talud_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('estado', 'talud_estado_descripcion_fk')->references('descripcion')->on('road_estado')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo', 'talud_tipo_talud_descrip_fk')->references('descrip')->on('road_tipo_talud')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_trafico', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('codigo', 13)->nullable();
            $table->integer('Numlivianos')->nullable()->default(0);
            $table->integer('Tranlivianos')->nullable()->default(0);
            $table->integer('Numbuses')->nullable()->default(0);
            $table->integer('Tranbuses')->nullable()->default(0);
            $table->integer('Num2ejes')->nullable()->default(0);
            $table->integer('Tran2ejes')->nullable()->default(0);
            $table->integer('Num3ejes')->nullable()->default(0);
            $table->integer('Tran3ejes')->nullable()->default(0);
            $table->integer('Num4ejes')->nullable()->default(0);
            $table->integer('Tran4ejes')->nullable()->default(0);
            $table->integer('Num5ejes')->nullable()->default(0);
            $table->integer('Tran5ejes')->nullable()->default(0);
            $table->integer('Total tráfico')->nullable()->default(0);
            $table->string('tipo_dia_codigo', 120)->nullable();
            $table->string('dias_semana', 120)->nullable();

            $table->foreign('codigo',
                'trafico_caracteristicas_generales_via_codigo_fk')->references('codigo')->on('road_caracteristicas_generales_via')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tipo_dia_codigo', 'trafico_tipo_dia_descrip_fk')->references('descrip')->on('road_tipo_dia')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('road_shape', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('codigo', 13)->nullable()->index();
            $table->string('name', 200)->nullable();
            $table->string('path', 200)->nullable();
            $table->string('extension', 50)->nullable();
            $table->boolean('is_primary')->default(false);
        });

        Schema::create('road_shape_principal', function (Blueprint $table) {
            $table->increments('gid');
            $table->string('name', 200)->nullable();
            $table->string('path', 200)->nullable();
            $table->string('extension', 50)->nullable();
            $table->boolean('is_primary')->default(false);
        });

        Schema::create('road_catalogo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('descrip', 120)->unique('catalogo_descrip_uindex');
            $table->integer('padre_id')->nullable();
            $table->foreign('padre_id',
                'catalogo_catalogo_padre_fk')->references('id')->on('road_catalogo')->onUpdate('RESTRICT')->onDelete('RESTRICT');          
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alcantarilla');
        Schema::dropIfExists('capa_rodadura_puente');
        Schema::dropIfExists('caracteristicas_generales_via_hdm4');
        Schema::dropIfExists('caracteristicas_generales_via');
        Schema::dropIfExists('caracteristicas_via');
        Schema::dropIfExists('carriles');
        Schema::dropIfExists('condiciones_climaticas');
        Schema::dropIfExists('cuneta');
        Schema::dropIfExists('est_drenaje');
        Schema::dropIfExists('estado');
        Schema::dropIfExists('evaluacion_HDM4');
        Schema::dropIfExists('fuente');
        Schema::dropIfExists('humedad');
        Schema::dropIfExists('info_ambiental');
        Schema::dropIfExists('interseccion');
        Schema::dropIfExists('lado');
        Schema::dropIfExists('material_alcantarilla');
        Schema::dropIfExists('material_minas');
        Schema::dropIfExists('minas');
        Schema::dropIfExists('necesidades_conservacion');
        Schema::dropIfExists('piso_climatico');
        Schema::dropIfExists('produccion');
        Schema::dropIfExists('protecciones_laterales');
        Schema::dropIfExists('puente');
        Schema::dropIfExists('punto_critico');
        Schema::dropIfExists('sector_productivo');
        Schema::dropIfExists('sen_horizontal');
        Schema::dropIfExists('sen_vertical');
        Schema::dropIfExists('servicios_apoyo');
        Schema::dropIfExists('servicios_transporte');
        Schema::dropIfExists('social');
        Schema::dropIfExists('superficie_rodadura');
        Schema::dropIfExists('talud');
        Schema::dropIfExists('tipo_alcantarilla');
        Schema::dropIfExists('tipo_cuneta');
        Schema::dropIfExists('tipo_dia');
        Schema::dropIfExists('tipo_drenaje');
        Schema::dropIfExists('tipo_firme');
        Schema::dropIfExists('tipo_interconexion');
        Schema::dropIfExists('tipo_material');
        Schema::dropIfExists('tipo_minas');
        Schema::dropIfExists('tipo_necesidad_conservacion');
        Schema::dropIfExists('tipo_poblacion');
        Schema::dropIfExists('tipo_punto_critico');
        Schema::dropIfExists('tipo_senal_horizontal');
        Schema::dropIfExists('tipo_senal_vertical');
        Schema::dropIfExists('tipo_superficie_rodadura');
        Schema::dropIfExists('tipo_talud');
        Schema::dropIfExists('tipo_terreno');
        Schema::dropIfExists('tipo_vehiculo');
        Schema::dropIfExists('trafico');
        Schema::dropIfExists('uso_via');
        Schema::dropIfExists('vehiculo_caracteristicas');
        Schema::dropIfExists('catalogo');
    }
};
