<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Message Response Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default messages used by
    | the controller for response.
    |
    */

    'labels' => [       
        'new_document' => 'Nuevo Documento',
        'id' => 'Id',
        'code' => 'Código',
        'name' => 'Nombre',
        'description' => 'Descripción',
        'type' => 'Tipo',  
        'file' => 'Documento',    
        'document_type' => 'Tipo documento',
        'document_title' => 'Documentos',
        'technical' => 'Técnico',
        'lawful' => 'Legal',
        'document' => 'documento',
        'create_document' => 'Subir documento', 
        'update' => 'Actualizar documento',
        'edit' => 'Editar documento', 
        'listcatalog' => '--Seleccione Catálogo--',

    ],
    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el documento?',
            'create' => '¿Está seguro que desea crear el documento?',
            'update' => '¿Está seguro que desea actualizar el documento?'
        ],
        'success' => [            
            'document_created' => 'Documento cargado satisfactoriamente',
            'updated' => 'Documento actualizado satisfactoriamente',
            'delete' => 'Documento eliminado satisfactoriamente'
        ],
        'errors' => [
            'create_document' => 'Ha ocurrido un error al intentar cargar el documento',
            'only_pdf' => 'Solo se permite documentos en formato pdf',
            'size_file' => 'El tamaño maximo de subida es',
            'update' => 'Ha ocurrido un error al intentar actualizar el documento',
            'delete' => 'Ha ocurrido un error al intentar eliminar el documento'
        ],
        'validations' => [
            'create_uniqueName' => 'El nombre del documento ya existe'
        ]
    ]
];
