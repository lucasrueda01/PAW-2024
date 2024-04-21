<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;
use Paw\App\Utils\Uploader;

use Paw\App\Models\PlatosCollection;

use Paw\Core\Controller;

class PlatoController extends Controller
{

    public Uploader $uploader;
    public Verificador $verificador;
    public ?string $modelName = PlatosCollection::class;

    public function __construct()
    {
        parent::__construct();

        $this->uploader = new Uploader;

        $this->verificador = new Verificador;
    }

    public function index()
    {
        $titulo = "Platos";
        $platos = $this->model->getAll();
        require $this->viewsDir . 'platos.index.view.php';
    }

    public function get()
    {   
        global $request;
        $platoId = $request->get('id');
        $plato = $this->model->get($platoId);
        $titulo = "Plato";        
        require $this->viewsDir . 'plato.show.view.php';
    }   
    
    public function edit()
    {

    }

    public function set()
    {

    }
    
    public function nuevo_plato(){
        $titulo = 'PAW POWER | NUEVO PLATO';
        require $this->viewsDir . 'empleado/nuevo_plato.view.php';
    }
    

    public function datos_plato(){

        $resultado = $this->uploader->verificar_imagen($_FILES, $_POST);    

        #SI LA SUBIDA ES EXITOSA MUESTRO VISTA DE EXITO SINO MUESTRO EL ERROR
        if (isset($resultado['exito'])) {
          require $this->viewsDir . 'empleado/plato_cargado.view.php';
        } else {
            require $this->viewsDir . 'empleado/nuevo_plato.view.php';
        }
    }    
}