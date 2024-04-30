<?php

namespace Paw\App\Controllers;

use Exception;
use Paw\App\Utils\Verificador;
use Paw\App\Utils\Uploader;

use Paw\Core\Controller;
use Paw\App\Models\PlatosCollection;
use Paw\App\Models\Plato;
use Paw\Core\Model;

class MenuController extends Controller
{
    const IdIMG_URL = 2;
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
        $log->info("(nuestroMenu) this->model: ", [$this->model]);
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
        $log->info("(index) this->model: ", [$this->model]);
        require $this->viewsDir . 'platos.index.view.php';
    }

    public function get()
    {
        global $request;
        $platoId = $request->get('id');
        list($resultado, $plato) = $this->model->get($platoId);
        
        try {
            $imagenPlato = @file_get_contents(Uploader::UPLOADDIRECTORY.$plato->getPathImg());
        
            if ($imagenPlato === false) {
                // Si file_get_contents devuelve false, significa que no se pudo leer la imagen
                throw new Exception("No se pudo leer la imagen del plato: ". Uploader::UPLOADDIRECTORY.$plato->getPathImg());
            }
        
            header("Content-type: image/".$plato->getTypeImg());
            echo($imagenPlato);
        } catch (Exception $e) {
            // Manejo de la excepción
            global $router;

            $error = "Error: " . $e->getMessage();
            
            require $this->viewsDir . 'errors/not-found.view.php';
        }
        
    }
    public function verDetalle()
    {
        global $request;
        $platoId = $request->get('id');
        list($resultado, $plato) = $this->model->get($platoId);
        $titulo = "Plato";
        require $this->viewsDir . 'empleado/plato.show.view.php';
    }

    public function new()
    {
        global $request;
        global $router;
        global $log;
        $titulo = 'PAW POWER | NUEVO PLATO';


        if ($request->method() == 'GET') {
            require $this->viewsDir . 'empleado/plato.new.view.php';
        } elseif ($request->method() == 'POST') {

            try {

                $newPlato = new Plato(
                    [
                        'nombre_plato' => $request->get('nombre_plato'),
                        'ingredientes' => $request->get('ingredientes'),
                        'tipo_plato' => $request->get('tipo_plato'),
                        'precio' => $request->get('precio'),
                    ]
                );

                $newPlato->setQueryBuilder($this->getQb());

                $uploader = new Uploader;

                $resultado = $uploader->verificar_imagen($_FILES, $newPlato);

                if (!$resultado['exito']) {
                    throw new Exception("Error al subir la imagen del plato: " . $resultado['description']);
                }

                if (!$this->model->insert($newPlato)) {
                    throw new Exception("Faltan datos para crear el objeto Plato.");
                } else {
                    $platos = $this->model->getAll();
                    require $this->viewsDirEmpleado . 'plato_cargado.view.php';
                }
            } catch (Exception $e) {

                $verificador_campos = [
                    'exito' => false,
                    'description' => "Error al crear el objeto Plato: " . $e->getMessage()
                ];
                require $this->viewsDir . 'empleado/plato.new.view.php';
            }
        }
    }

    public function insert()
    {
    }

    public function edit()
    {
    }
}
