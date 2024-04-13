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

    public function noticias() {
        $titulo = "PAW POWER | NOTICIAS" ;
        require $this->viewsDir. 'noticias.view.php';
    }

    public function about() 
    {
        $titulo = 'Nosotros';
        $main = 'Pagina sobre Nosotros';
        require $this->viewsDir. 'about.view.php';            
    }
    public function contact($procesado= false)  
    {
        $titulo = 'Contactos';
        $main = 'Formas de Contacto';        
        require $this->viewsDir. 'contact.view.php';            
    }

    public function contactProccess()
    { 
        $formulario = $_POST;
        $this->contact(true);
        
    }

    public function services() 
    {
        $titulo = 'Servicios';
        $main = 'Pagina de Servicios';            
        require $this->viewsDir. 'services.view.php';            
    }

}
