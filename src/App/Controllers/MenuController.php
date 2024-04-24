<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;
use Paw\App\Utils\Uploader;

use Paw\Core\Controller;
use Paw\App\Models\PlatosCollection;
use Paw\App\Models\Plato;

class MenuController extends Controller
{

    public ?string $modelName = PlatosCollection::class;

    public Verificador $verificador;
    public Uploader $uploader;

    public function __construct()
    {
        parent::__construct();

        $this->uploader = new Uploader;

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

    public function index()
    {
        global $log;
        $titulo = "Platos";
        $platos = $this->model->getAll();
        $log->info("(index) this->model: ",[$this->model]);
        require $this->viewsDir . 'platos.index.view.php';
    }

    public function get()
    {   
        global $request;
        $platoId = $request->get('id');
        list($resultado, $plato) = $this->model->get($platoId);
        $titulo = "Plato";        
        require $this->viewsDir . 'empleado/plato.show.view.php';
    }   
        
    public function new(){
        $titulo = 'PAW POWER | NUEVO PLATO';
        require $this->viewsDir . 'empleado/plato.new.view.php';
    }

    public function insert(){

        global $log;

        $resultado = $this->uploader->verificar_imagen($_FILES, $_POST);    

        $log->info("resultado:", [$resultado]);

        #SI LA SUBIDA ES EXITOSA MUESTRO VISTA DE EXITO SINO MUESTRO EL ERROR
        if (isset($resultado['exito']) && $resultado['exito']) {
            
            global $request;
            global $log;

            $newPlato = [
                'nombre_plato' => $request->get('nombre_plato'),
                'ingredientes' => $request->get('ingredientes'),
                'tipo_plato' => $request->get('tipo_plato'),
                'precio' => $request->get('precio'),
                'path_img' => $resultado['nombreArchivo'],    
            ];
            
            $resultado = $this->verificador->verificarCamposVacios($newPlato, Plato::getFieldsRequires());

            if($resultado['exito']){

                if ($this->model->insert($newPlato)){
                    $platos = $this->model->getAll();
                    require $this->viewsDir . 'nuestro_menu.view.php';
                }else{
                    require $this->viewsDir . 'empleado/nuevo_plato.view.php';
                }
            }else{

                require $this->viewsDir . 'empleado/nuevo_plato.view.php';
            }

        } else {
            require $this->viewsDir . 'empleado/nuevo_plato.view.php';   
        }
    }    

    public function edit()
    {

    }


}
