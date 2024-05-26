<?php

namespace Paw\App\Controllers;

use PDOException;

use Paw\App\Models\Usuario;
use Paw\App\Utils\Verificador;
use Paw\Core\Controller;

class UsuarioController extends Controller
{

    public Verificador $verificador;
    public ?string $modelName = Usuario::class;

    public function __construct()
    {
        parent::__construct();

        $this->verificador = new Verificador;

    }

    public function adjustMenuForSession($menuPerfil, $menuEmpleado) {
        if (isset($_SESSION['usuario'])) {
            // Si hay una sesión iniciada, quitar las opciones de iniciar y registrar
            $menuPerfil = array_filter($menuPerfil, function ($item) {
                return !in_array($item['href'], ['/iniciar_sesion', '/registrar_usuario']);
            });
            // Si el usuario es de tipo "cliente", eliminar el menú de empleado
            if ($_SESSION['tipo'] === 'cliente') {
                $menuEmpleado = [];
            }
        }
        return [$menuPerfil, $menuEmpleado];
    }


    public function inicio_sesion() {
        $titulo = 'PAW POWER | SESION';
    
        global $request;
    
        if ($request->method() == 'POST') {
            $usuario = strtolower($request->get('username'));
            $contrasenia = $request->get('contrasenia');
            
            $usuarioAutenticado = $this->model->findByUsernameAndPassword($usuario, $contrasenia);
            
            if ($usuarioAutenticado) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();  // Inicia la sesión si no está iniciada
                }
                // Guardar los datos del usuario en la sesión
                $_SESSION['usuario'] = $usuarioAutenticado['username'];
                $_SESSION['tipo'] = $usuarioAutenticado['tipo'];

                // Redirigir al usuario a la página principal
                header('Location: /');
                exit();
            } else {
                $resultado['error'] = 'Usuario o contraseña incorrectos';
                require $this->viewsDir . 'inicio_sesion.view.php';
            }
        }else{
            require $this->viewsDir . 'inicio_sesion.view.php';
        }
    
    }

    public function registrar_usuario() {
        $titulo = 'PAW POWER | REGISTRO';
    
        global $request, $log;
    
        if ($request->method() == 'POST') {
            // Obtener los datos del formulario
            $email = $request->get('email');
            $nombre = $request->get('nombre');
            $contrasenia = $request->get('password');
            $contrasenia_repetida = $request->get('password_repetida');
            
            // Verificar si las contraseñas coinciden
            if ($contrasenia !== $contrasenia_repetida) {
                $resultado['error'] = 'Las contraseñas no coinciden';
                require $this->viewsDir . 'registrar_usuario.view.php';
            }
    
            try {
                // Crear un nuevo usuario
                $nuevoUsuario = [
                    'email' => $email,
                    'username' => $nombre,
                    'password' => password_hash($contrasenia, PASSWORD_DEFAULT), // Hashear la contraseña con salt
                ];   
                
                // Insertar el nuevo usuario en la base de datos
                list($idUsuario, $resultado) = $this->model->insert('users', $nuevoUsuario);
                
                if ($resultado) {
                    $log->info("registro exitoso del usuario {$nombre}");
                    $resultado = [];
                    $resultado['exito'] = "registro exitoso del usuario {$nombre}";
                    require $this->viewsDir . 'registrar_usuario.view.php';
                } else {
                    $error = 'Error al registrar el usuario';
                    $log->error("error: ", [$error]);
                    $resultado['error'] = $error;
                    require $this->viewsDir . 'registrar_usuario.view.php';
                }
            } catch (PDOException $e) {

                $log->error("error: ", ["Error al registrar el usuario: " . $e->getMessage()]);
                
                // Mostrar un mensaje de error genérico al usuario
                $error = 'Error al registrar el usuario';
                $resultado['error'] = "Error al registrar el usuario: " . $e->getMessage();
                require $this->viewsDir . 'registrar_usuario.view.php';
            }
        }else{
            require $this->viewsDir . 'registrar_usuario.view.php';
        }
    }

    public function cerrar_sesion() {
        // Iniciar la sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Destruir todas las variables de sesión
        $_SESSION = [];

        // Si se desea destruir la sesión completamente, también se deben eliminar las cookies de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión
        session_destroy();

        // Redirigir al usuario a la página principal
        header('Location: /');
        exit();
    }

    public function perfil() {
        $titulo = 'PAW POWER | PERFIL';
        require $this->viewsDir . 'mi_perfil.view.php';
    }

}
