<?php 

namespace Paw\App\Models;

use Paw\Core\Model;
use PDOException;

class Usuario extends Model
{
    /**
     * metodos que deberian estar para
     * autenticar usuario
     * debiera haber una consulta a la base de datos
     * usuario queryBuilder
     */

     public function findByUsernameAndPassword($username, $password)
     {
         $result = $this->queryBuilder->select('users', ['username' => $username]);
         
         var_dump($username);
         // Verificar si se encontró un usuario con ese nombre de usuario
         if ($result && count($result) > 0) {
             // Comparar la contraseña hasheada almacenada en la base de datos con la proporcionada
             $hashedPassword = $result[0]['password'];
             if (password_verify($password, $hashedPassword)) {
                 // Si las contraseñas coinciden, se devuelve el usuario encontrado
                 return $result[0];
             }
         }
         return null;
     }

     public function insert($table, $data)
     {
        global $log;
         try {
             // Llamar al método insert del QueryBuilder y devolver el resultado
             return $this->queryBuilder->insert($table, $data);
         } catch (PDOException $e) {
             // Capturar excepción y manejarla
             $log->error("error al registrar: ", ["Error al insertar datos en la tabla $table: " . $e->getMessage()]);
             return false; // O devuelve un valor que indique que hubo un error
         }
     }

}