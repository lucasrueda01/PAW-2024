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

    public function inicio_sesion() {
        $titulo = 'PAW POWER | SESION';
    
        global $request;
    
        if ($request->method() == 'POST') {
            $usuario = strtolower($request->get('username'));
            $contrasenia = $request->get('contrasenia');
            
            $usuarioAutenticado = $this->model->findByUsernameAndPassword($usuario, $contrasenia);
            
            if ($usuarioAutenticado) {
                echo("usuario autenticado");
                require $this->viewsDir . 'inicio_sesion.view.php';
            } else {
                $error = 'Usuario o contraseña incorrectos';
                echo($error);
                require $this->viewsDir . 'inicio_sesion.view.php';
            }
        }
    
        require $this->viewsDir . 'inicio_sesion.view.php';
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

    public function perfil() {
        $titulo = 'PAW POWER | PERFIL';
        require $this->viewsDir . 'mi_perfil.view.php';
    }

}
