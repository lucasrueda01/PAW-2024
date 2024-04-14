<?php

namespace Paw\App\Controllers;

class PageController
{

    public string $viewsDir;
    public string $viewsDirCliente;
    public array $menu;
    const ERROR_TIPO_NO_PERMITIDO = 'tipo_no_permitido';
    const ERROR_TAMANIO_NO_PERMITIDO = 'tamanio_no_permitido';
    const ERROR_AL_SUBIR_ARCHIVO = 'error al subir archivo';
    const ERROR_DE_CARGA = 'error de carga';
    const UPLOAD_COMPLETED = 'carga completada correctamente';


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
    
    public function varificar_imagen($archivo_imagen){
        // Verifica si el archivo se ha subido correctamente
        
        if (isset($archivo_imagen['imagen_plato']) && $archivo_imagen['imagen_plato']['error'] === UPLOAD_ERR_OK) {
            // Obtén información sobre el archivo subido
            $file = $archivo_imagen['imagen_plato'];
            $fileName = $file['name'];
            $fileType = $file['type'];
            $fileSize = $file['size'];
            $fileTmpName = $file['tmp_name'];
            
            // Verifica el tipo de archivo
            $allowedTypes = ['image/jpeg', 'image/png'];
            if (!in_array($fileType, $allowedTypes)) {
                return [
                    'error' => self::ERROR_TIPO_NO_PERMITIDO,
                    'description' => "El archivo debe ser una imagen JPEG o PNG."
                ];
            }
            
            // Verifica el tamaño del archivo (no mayor a 1 MB)
            $maxFileSize = 1 * 1024 * 1024; // 1 MB en bytes
            if ($fileSize > $maxFileSize) {
                return [
                    'error' => self::ERROR_TAMANIO_NO_PERMITIDO,
                    'description' => "El archivo no debe exceder 1 MB."
                ];
            }
            
            // Si todo es correcto, guarda el archivo en el servidor
            // Establece el directorio donde se guardará el archivo
            $uploadDirectory = 'uploads/';
            // Genera un nombre de archivo único para evitar colisiones
            $newFileName = uniqid() . '_' . basename($fileName);
            $uploadPath = $uploadDirectory . $newFileName;
            
            // Mueve el archivo del directorio temporal a su ubicación final
            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                return [
                    'exito' => self::UPLOAD_COMPLETED,
                    'description' => "El archivo se ha subido correctamente."
                ];                
            } else {
                return [
                    'error' => self::ERROR_AL_SUBIR_ARCHIVO,
                    'description' => "Hubo un problema al subir el archivo."
                ];                
            }
        } else {
            return [
                'error' => self::ERROR_DE_CARGA,
                'description' => "No se ha subido ningún archivo o ocurrió un error."
            ];            
        }        
    }

    public function datos_plato(){
        $formulario_plato = $_POST;

        $resultado = $this->varificar_imagen($_FILES);

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
