<?php 

namespace Paw\App\Controllers;

class MenuMaster {

    public array $menu;
    public array $menuEmpleado;
    public array $menuPerfil;

    public function __construct(){
        
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
    }

}