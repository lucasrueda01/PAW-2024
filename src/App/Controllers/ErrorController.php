<?php

namespace Paw\App\Controllers;

class ErrorController {

    public string $viewsDir;
    public array $menu;

    public function __construct(){
        $this->viewsDir = __DIR__ . '/../views/';

        $this->menu = [
            [
                'href' => '/',
                'name' => 'Home'
            ],
            [
                'href' => '/about',
                'name' => 'Quienes Somos'
            ],
            [
                'href' => '/services',
                'name' => 'Servicios'
            ],
            [
                'href' => '/contact',
                'name' => 'Contactos'
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