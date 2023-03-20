<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProceduresSeeder extends Seeder
{
    public function run()
    {

        DB::table('procedures')->insert(array(
            0 =>
                array(
                    'hiring_type' => 'BIEN,SERVICIO',
                    'max' => null,
                    'min' => null,
                    'name' => 'CATÁLOGO ELECTRÓNICO',
                    'normalized' => 1,
                    'regime_type' => 'COMÚN',
                ),
            1 =>
                array(
                    'hiring_type' => 'BIEN,SERVICIO',
                    'max' => null,
                    'min' => 7105.88,
                    'name' => 'SUBASTA INVERSA ELECTRÓNICA',
                    'normalized' => 1,
                    'regime_type' => 'COMÚN',
                ),
            2 =>
                array(
                    'hiring_type' => 'BIEN,SERVICIO',
                    'max' => 7105.88,
                    'min' => null,
                    'name' => 'ÍNFIMA CUANTÍA',
                    'normalized' => 1,
                    'regime_type' => 'COMÚN',
                ),
            3 =>
                array(
                    'hiring_type' => 'BIEN,SERVICIO',
                    'max' => 71058.79,
                    'min' => null,
                    'name' => 'MENOR CUANTÍA',
                    'normalized' => 0,
                    'regime_type' => 'COMÚN',
                ),
            4 =>
                array(
                    'hiring_type' => 'BIEN,SERVICIO',
                    'max' => 532940.92,
                    'min' => 71058.79,
                    'name' => 'COTIZACIÓN',
                    'normalized' => 0,
                    'regime_type' => 'COMÚN',
                ),
            5 =>
                array(
                    'hiring_type' => 'BIEN,SERVICIO',
                    'max' => null,
                    'min' => 532940.92,
                    'name' => 'LICITACIÓN',
                    'normalized' => 0,
                    'regime_type' => 'COMÚN',
                ),
            6 =>
                array(
                    'hiring_type' => 'OBRA',
                    'max' => 248705.76,
                    'min' => null,
                    'name' => 'MENOR CUANTÍA',
                    'normalized' => null,
                    'regime_type' => 'COMÚN',
                ),
            7 =>
                array(
                    'hiring_type' => 'OBRA',
                    'max' => 1065881.83,
                    'min' => 248705.76,
                    'name' => 'COTIZACIÓN',
                    'normalized' => null,
                    'regime_type' => 'COMÚN',
                ),
            8 =>
                array(
                    'hiring_type' => 'OBRA',
                    'max' => null,
                    'min' => 1065881.83,
                    'name' => 'LICITACIÓN',
                    'normalized' => null,
                    'regime_type' => 'COMÚN',
                ),
            9 =>
                array(
                    'hiring_type' => 'CONSULTORÍA',
                    'max' => 71058.79,
                    'min' => null,
                    'name' => 'CONTRATACIÓN DIRECTA',
                    'normalized' => null,
                    'regime_type' => 'COMÚN',
                ),
            10 =>
                array(
                    'hiring_type' => 'CONSULTORÍA',
                    'max' => 532940.91,
                    'min' => 71058.8,
                    'name' => 'LISTA CORTA',
                    'normalized' => null,
                    'regime_type' => 'COMÚN',
                ),
            11 =>
                array(
                    'hiring_type' => 'CONSULTORÍA',
                    'max' => null,
                    'min' => 532940.92,
                    'name' => 'CONCURSO PÚBLICO',
                    'normalized' => null,
                    'regime_type' => 'COMÚN',
                ),
            12 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'COMUNICACION SOCIAL PROCESO DE SELECCIÓN',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            13 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'CONTRATACIONES DE INSTITUCIONES FINANCIERAS Y SEGUROS DEL ESTADO',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            14 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'EMPRESAS PUBLICAS MERCANTILES Y SUBSIDIARIAS SECTORES ESTRATEGICOS',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            15 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'OBRA ARTISTICA LITERARIA O CIENTIFICA',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            16 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'REPUESTOS O ACCESORIOS',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            17 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'BIENES Y SERVICIOS UNICOS',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            18 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'CONTRATOS ENTRE ENTIDADES PUBLICAS O SUBSIDIARIAS',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            19 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'ASESORIA Y PATROCINIO JURIDICO CONSULTAS PUNTUALES Y ESPECIFICAS',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            20 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'CONTRATACIONES CON EMPRESAS PUBLICAS INTERNACIONALES',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            21 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'TRANSPORTE DE CORREO INTERNO O INTERNACIONAL',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            22 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'ARRENDAMIENTO DE BIENES MUEBLES',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            23 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'ASESORIA Y PATROCINIO JURIDICO',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            24 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'SEGUROS',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            25 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'COMUNICACION SOCIAL CONTRATACION DIRECTA',
                    'normalized' => null,
                    'regime_type' => 'ESPECIAL',
                ),
            26 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'ADQUISICIÓN DE BIENES INMUEBLES',
                    'normalized' => null,
                    'regime_type' => 'PROCEDIMIENTOS ESPECIALES',
                ),
            27 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'ARRENDAMIENTO DE BIENES INMUEBLES',
                    'normalized' => null,
                    'regime_type' => 'PROCEDIMIENTOS ESPECIALES',
                ),
            28 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'FERIAS INCLUSIVAS',
                    'normalized' => null,
                    'regime_type' => 'PROCEDIMIENTOS ESPECIALES',
                ),
            29 =>
                array(
                    'hiring_type' => 'BIEN,OBRA,SERVICIO,CONSULTORÍA',
                    'max' => null,
                    'min' => null,
                    'name' => 'CONTRATACION INTEGRAL POR PRECIO FIJO',
                    'normalized' => null,
                    'regime_type' => 'PROCEDIMIENTOS ESPECIALES',
                ),
        ));


    }
}
