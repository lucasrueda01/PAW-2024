<?php

namespace Paw\App\Controllers;

class ErrorController {

    public string $viewsDir;
    public array $menu;

    public function __construct(){
        $this->viewsDir = __DIR__ . '/../views/errors/';

        $this->menu = [
            [
                'href' => '/nuestro_menu',
                'name' => 'MENU'
            ],
            [
                'href' => '/promociones',
                'name' => 'PROMOS'
            ],
            [
                'href' => '/sucursales',
                'name' => 'SUCURSALES'
            ],
            [
                'href' => '/noticias',
                'name' => 'NOTICIAS'
            ],
            [
                'href' => '/pedir',
                'name' => 'PEDIR'
            ],
            [
                'href' => '/reservar_cliente',
                'name' => 'RESERVAR'
            ]
        ];
        
    }
    
    public function notFound() {
        http_response_code(404);
        $titulo = 'Page Not Found';
        $main = 'Page Not Found';
        require $this->viewsDir. 'not-found.view.php';
    }
    
    public function internalError() {
        http_response_code(500);
        $titulo = 'Internal Error';
        $main = 'Internal Server Error';
        require $this->viewsDir. 'internal-error.view.php';
    }

    
}