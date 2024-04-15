<?php

namespace Paw\App\Controllers;

use Paw\App\Controllers\UploadController;


class PageController
{

    public string $viewsDir;
    public string $viewsDirCliente;
    public array $menu;
    public array $menuEmpleado;
    public array $menuPerfil;
    public UploadController $uploadController;


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
            ]
        ];

        $this->menuEmpleado = [
            [
                'href' => '/gestion_lista_mesas',
                'name' => 'GESTION MESAS'
            ],
            [
                'href' => '/gestion_mesa',
                'name' => 'GESTION MESA'
            ],
            [
                'href' => '/pedidos_entrantes',
                'name' => 'PEDIDOS ENTRANTES'
            ],
            [
                'href' => '/nuevo_plato',
                'name' => 'NUEVO PLATO'
            ],
        ];

        $this->menuPerfil = [
            [
                'href' => '/perfil_usuario',
                'name' => 'Mi Perfil'
            ],
            [
                'href' => '/iniciar_sesion',
                'name' => 'Iniciar Sesion'
            ],
            [
                'href' => '/registrar_usuario',
                'name' => 'Registrar Usuario Sesion'
            ],
            [
                'href' => '/cerrar_sesion',
                'name' => 'Cerrar Sesion'
            ]
        ];

        $this->uploadController = new UploadController;
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
        require $this->viewsDir . 'empleado/nuevo_plato.view.php';
    }
    

    public function datos_plato(){

        $resultado = $this->uploadController->verificar_imagen($_FILES, $_POST);

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

    public function inicio_sesion() {
        $titulo = 'PAW POWER | SESION';
        require $this->viewsDir . 'inicio_sesion.view.php';

    }
    public function registrar_usuario() {
        $titulo = 'PAW POWER | REGISTRO';
        require $this->viewsDir . 'registrar_usuario.view.php';
    }

    public function perfil() {
        $titulo = 'PAW POWER | PERFIL';
        require $this->viewsDir . 'mi_perfil.view.php';
    }

}


