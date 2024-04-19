<?php

namespace Paw\App\Controllers;

use Paw\App\Controllers\UploadController;
use Paw\App\Controllers\VerificadorController;

use Paw\App\Controllers\MenuMaster;

class PageController
{

    public string $viewsDir;
    public string $viewsDirCliente;
    public MenuMaster $menuMaster;
    public UploadController $uploadController;
    public VerificadorController $verificadorController;

    public function __construct()
    {
        $this->viewsDir = __DIR__ . '/../views/';
        $this->viewsDirCliente = __DIR__ . '/../views/cliente/';

        $this->menuMaster = new MenuMaster;

        $this->uploadController = new UploadController;

        $this->verificadorController = new VerificadorController;
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

    public function procesar_reserva_cliente()
    {
        $datosReserva = $_POST;
        $resultado = $this->verificadorController->verificarCampos($datosReserva);
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

        #SI LA SUBIDA ES EXITOSA MUESTRO VISTA DE EXITO SINO MUESTRO EL ERROR
        if (isset($resultado['exito'])) {
          require $this->viewsDir . 'empleado/plato_cargado.view.php';
        } else {
            require $this->viewsDir . 'empleado/nuevo_plato.view.php';
        }
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


