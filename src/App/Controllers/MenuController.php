<?php

namespace Paw\App\Controllers;

use Exception;
use Paw\App\Utils\Verificador;
use Paw\App\Utils\Uploader;

use Paw\Core\Controller;
use Paw\App\Models\PlatosCollection;
use Paw\App\Models\Plato;
use Paw\App\Controllers\UsuarioController;

class MenuController extends Controller
{
    const IdIMG_URL = 2;
    public ?string $modelName = PlatosCollection::class;

    public Verificador $verificador;
    public Uploader $uploader;
    public $usuario;
    
    public function __construct()
    {

        parent::__construct();

        $this->uploader = new Uploader;

        $this->verificador = new Verificador;
        $this->usuario = new UsuarioController();
        list($this->menuPerfil, $this->menuEmpleado) = $this->usuario->adjustMenuForSession($this->menuPerfil, $this->menuEmpleado);        
    }

    public function nuestroMenu()
    {       
        global $log;
    
        $titulo = "PAW POWER | MENU";
        $platos = $this->model->getAll();
        $log->info("(nuestroMenu) this->model: ", [$this->model]);
    
        // Verificar si el formato solicitado es CSV
        if (!is_null($this->request->get('export')) && $this->request->get('export') === 'csv') {
            $log->info("generar csv", [$request->get('format'), $_GET]);
            $this->model->exportToCsv($platos);
            exit; // Asegurarse de que no haya salida adicional
        } else {
            require $this->viewsDir . 'nuestro_menu.view.php';
        }
    }

    public function getPlatosInCart()
    {
        global $log;
            
        $lista_platos = [];

        // Verificar si la variable lista_encoded está presente en la solicitud GET
        if (!is_null($this->request->get('lista_encoded'))) {
        //     // Decodificar el JSON
            $lista_platos_ids = json_decode($this->request->get('lista_encoded'));
            
            $log->info("lista_platos_ids: ",[$lista_platos_ids]);
            // Iterar sobre cada ID de plato en la lista
            foreach ($lista_platos_ids as $platoData) {
                $platoId = $platoData->id; // Obtener el ID del plato
                $cantidad = $platoData->cantidad; // Obtener la cantidad del plato                
                // Obtener los datos del plato
                list($resultado, $plato) = $this->model->get($platoId);
        
                // Verificar si hubo un error al obtener los datos del plato
                if (!isset($resultado['error'])) {
                    // Agregar los datos del plato a la lista
                    $lista_platos[] = $plato->fields;
                }
            }
        }
        $response_json = json_encode($lista_platos);
        $log->info("response_json: ",[$response_json]);
        // Enviar la respuesta
        header('Content-Type: application/json');
        echo $response_json;
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
        $platoId = $this->request->get('id');
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
            $error = "Error: " . $e->getMessage();
            
            require $this->viewsDir . 'errors/not-found.view.php';
        }
        
    }
    public function verDetalle()
    {
        global $log;
        $platoId = $this->request->get('id');
        list($resultado, $plato) = $this->model->get($platoId);
        $log->info("PLATO: ",[$plato]);
        $titulo = "Plato";
        require $this->viewsDir . 'empleado/plato.show.view.php';
    }

    public function new()
    {
        global $log;

        $titulo = 'PAW POWER | NUEVO PLATO';
        
        $devMode = (int)$this->request->get('devMode');

        if ($devMode !== 1)
        {
            $log->info("verificando inicio de sesion - devMode = " . ($devMode !== 1));
            // Verificar si hay sesión iniciada
            if (!$this->usuario->isUserLoggedIn()) {
                $resultado = [
                    "success" => false,
                    "message" => "Debe iniciar sesión."
                ];
                $log->info("Intento de reserva sin sesión iniciada.");
                require $this->viewsDir . 'inicio_sesion.view.php';
                return;
            }        
        }

        if ($this->request->method() == 'GET') {
            require $this->viewsDir . 'empleado/plato.new.view.php';
        } elseif ($this->request->method() == 'POST') {

            try {

                $newPlato = new Plato(
                    [
                        'nombre_plato' => $this->request->get('nombre_plato'),
                        'ingredientes' => $this->request->get('ingredientes'),
                        'tipo_plato' => $this->request->get('tipo_plato'),
                        'precio' => $this->request->get('precio'),
                    ]
                );

                $newPlato->setQueryBuilder($this->getQb());

                $uploader = new Uploader;

                $resultado = $uploader->verificar_imagen($_FILES, $newPlato);

                if (!$resultado['exito']) {
                    throw new Exception("Error al subir la imagen del plato: " . $resultado['description']);
                }
                list($resultado, $idPlato) = $this->model->insert($newPlato);
                if (!$resultado) {
                    throw new Exception("Faltan datos para crear el objeto Plato.");
                } else {
                    // $platos = $this->model->getAll();
                    if(!is_null($this->request->get('devMode'))){
                        echo "Inserciones realizadas con exito..";
                    }
                    header('Location: /plato/verDetalle?id='.$idPlato);
                    exit();
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
