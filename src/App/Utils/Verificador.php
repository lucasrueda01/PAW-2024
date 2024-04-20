<?php

namespace Paw\App\Utils;

class Verificador
{
    public function verificarCampos(Array $datosReserva)
    {   
        $hay_campos_vacios = false;
        foreach ($datosReserva as $valorCampo) {
            // Verifica si el campo está vacío
            if (empty($valorCampo)) {
                // Si el campo está vacío, devuelve falso
                $hay_campos_vacios = true;
            }
        };
        return $hay_campos_vacios ? [
            'vacios' => false,
            'description' => 'Uno de los campos esta Vacio'
        ] : [
            'vacios' => true,
            'description' => 'Campos Completos',
            'resumen' => $datosReserva
        ];        
    }
}