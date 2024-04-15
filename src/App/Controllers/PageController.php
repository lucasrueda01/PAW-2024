<?php

namespace Paw\App\Controllers;

use Paw\App\Controllers\ImagenController;


class PageController
{

    public string $viewsDir;
    public string $viewsDirCliente;
    public array $menu;
    public ImagenController $imgController;


    public function __construct()
    {
        $this->viewsDir = __DIR__ . '/../views/';
        $this->viewsDirCliente = __DIR__ . '/../views/cliente/';

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
            ],
            [
                'href' => '/nuevo_plato',
                'name' => 'NUEVO PLATO'
            ]
        ];

        $this->imgController = new ImagenController;
    }

    public function index()
    {
        $titulo = "PAW POWER | HOME";
        require $this->viewsDir . 'index.view.php';
    }

    public function nuestroMenu()
    {
        $titulo = "PAW POWER | MENU";
        require $this->viewsDir . 'nuestro_menu.view.php';
    }

    public function promociones()
    {
        $titulo = "PAW POWER | PROMOCIONES";
        require $this->viewsDir . 'promociones.view.php';
    }

    public function sucursales()
    {
        $titulo = "PAW POWER | SUCURSALES";
        require $this->viewsDir . 'sucursales.view.php';
    }

    public function noticias()
    {
        $titulo = "PAW POWER | NOTICIAS";
        require $this->viewsDir . 'noticias.view.php';
    }

    public function pedir()
    {
        $titulo = 'PAW POWER | PEDIR';
        require $this->viewsDirCliente . 'pedir.view.php';
    }

    public function sobre_nosotros()
    {
        $titulo = 'PAW POWER | SOBRE_NOSOTROS';
        require $this->viewsDir . 'sobre_nosotros.view.php';
    }
    public function reservar_cliente()
    {
        $titulo = 'PAW POWER | RESERVAR CLIENTE';
        require $this->viewsDirCliente . 'reservar_cliente.view.php';
    }
    public function unete_al_equipo()
    {
        $titulo = 'PAW POWER | UNETE AL EQUIPO';
        require $this->viewsDir . 'unete_al_equipo.view.php';
    }
    
    public function nuevo_plato(){
        $titulo = 'PAW POWER | NUEVO PLATO';
        require $this->viewsDirCliente . 'nuevo_plato.view.php';
    }
    

    public function datos_plato(){
    
        $resultado = $this->imgController->varificar_imagen($_FILES, $_POST);

        require $this->viewsDirCliente . 'nuevo_plato.view.php';
    }

    public function gestion_lista_mesas()
    {
        $titulo = 'PAW POWER | GESTION MESAS';
        require $this->viewsDir . 'empleado/gestion_lista_mesas.view.php';
    }
    public function gestion_mesa()
    {
        $titulo = 'PAW POWER | GESTION MESA';
        require $this->viewsDir . 'empleado/gestion_mesa.view.php';
    }
    public function pedidos_entrantes()
    {
        $titulo = 'PAW POWER | PEDIDOS';
        require $this->viewsDir . 'empleado/pedidos_entrantes.view.php';
    }
}
