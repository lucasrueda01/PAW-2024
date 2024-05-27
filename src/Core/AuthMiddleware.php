<?php

namespace Paw\Core;

use Paw\Core\Request;

class AuthMiddleware
{
    public function handle($path, $http_method)
    {

        // Verificar si hay una sesión iniciada
        $sesionIniciada = isset($_SESSION['usuario']);
        
        // Si hay una sesión iniciada y se intenta acceder a /iniciar_sesion o /registrar_usuario, redirigir a /
        if ($sesionIniciada && ($path === '/iniciar_sesion' || $path === '/registrar_usuario')) {
            $path = '/';
            $http_method = 'GET';
        }     
        return [$path, $http_method];
    }
}