<?php

namespace Paw\Core;

use Paw\Core\Request;

class AuthMiddleware
{
    // '/pedidos/estado', 
    // '/pedidos/get-estado', 
    // '/pedidos/estado/modificar',
    public $rutasSoloEmpleado = ['/pedidos_entrantes', 
        '/gestion_lista_mesas',
        '/gestion_mesa',
        '/plato/new',
        '/plato/verDetalle'
    ];

    public function handle($path, $http_method)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();  // Inicia la sesión si no está iniciada
        }
        // Verificar si hay una sesión iniciada
        $sesionIniciada = isset($_SESSION['usuario']);
        
        // Si hay una sesión iniciada y se intenta acceder a /iniciar_sesion o /registrar_usuario, redirigir a /
        if ($sesionIniciada) {
            if(($path === '/iniciar_sesion' || $path === '/registrar_usuario')){
                $path = '/';
                $http_method = 'GET';
            }
            if($_SESSION['tipo'] == 'cliente' && in_array($path, $this->rutasSoloEmpleado) ){
                $path = '/not_found';
                $http_method = 'GET';
            }
        }     
        return [$path, $http_method];
    }
}