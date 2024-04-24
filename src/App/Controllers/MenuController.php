<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;

use Paw\Core\Controller;
use Paw\App\Models\PlatosCollection;

class MenuController extends Controller
{

    public ?string $modelName = PlatosCollection::class;

    public Verificador $verificador;

    public function __construct()
    {
        parent::__construct();

        $this->verificador = new Verificador;
    }

    public function nuestroMenu()
    {
        global $log;
        
        $titulo = "PAW POWER | MENU";
        $platos = $this->model->getAll();
        $log->info("(nuestroMenu) this->model: ",[$this->model]);        
        require $this->viewsDir . 'nuestro_menu.view.php';
    }

    public function promociones()
    {
        $titulo = "PAW POWER | PROMOCIONES";
        require $this->viewsDir . 'promociones.view.php';
    }    


}
