<?php

namespace Paw\App\Controllers;

class PageController {

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

    public function index() 
    {
        $titulo = "PAW POWER | HOME" ;
        require $this->viewsDir. 'index.view.php';
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
