<?php

namespace Paw\App\Controllers;

class VerificadorController
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
            'error' => 'Campos Vacios',
            'description' => 'Uno de los campos esta Vacio'
        ] : [
            'exito' => 'Procesado con Exito',
            'description' => 'La reserva se Proceso con Exito!',
            'resumen' => $datosReserva
        ];        
    }
}