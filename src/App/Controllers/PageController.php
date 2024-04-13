<?php

namespace Paw\App\Controllers;

class PageController {

    public string $viewsDir;
    public array $menu;

    public function __construct(){
        $this->viewsDir = __DIR__ . '/../views/';

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

    public function index() 
    {
        $titulo = "PAW POWER | HOME" ;
        require $this->viewsDir. 'index.view.php';
    }

    public function nuestroMenu() 
    {
        $titulo = "PAW POWER | MENU" ;
        require $this->viewsDir. 'nuestro_menu.view.php';
    }

    public function promociones() {
        $titulo = "PAW POWER | PROMOCIONES" ;
        require $this->viewsDir. 'promociones.view.php';
    }

    public function sucursales() {
        $titulo = "PAW POWER | SUCURSALES" ;
        require $this->viewsDir. 'sucursales.view.php';
    }

    public function noticias() {
        $titulo = "PAW POWER | NOTICIAS" ;
        require $this->viewsDir. 'noticias.view.php';
    }



}
