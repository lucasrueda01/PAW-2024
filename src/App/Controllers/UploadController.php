<?php

namespace Paw\App\Controllers;

class UploadController 
{
    public string $path_promociones = '/';
    const ERROR_TIPO_NO_PERMITIDO = 'tipo_no_permitido';
    const ERROR_TAMANIO_NO_PERMITIDO = 'tamanio_no_permitido';
    const ERROR_AL_SUBIR_ARCHIVO = 'error al subir archivo';
    const ERROR_DE_CARGA = 'error de carga';
    const UPLOAD_COMPLETED = 'carga completada correctamente';
    const UPLOADDIRECTORY = 'uploads/';


    public function verificar_imagen($archivo_imagen, $datos_plato){
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

            // Genera un nombre de archivo único para evitar colisiones
            $newFileName = uniqid() . '_' . basename($fileName);
            $uploadPath = self::UPLOADDIRECTORY . $newFileName;
            
            // Mueve el archivo del directorio temporal a su ubicación final
            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                return [
                    'exito' => self::UPLOAD_COMPLETED,
                    'description' => "El archivo se ha subido correctamente.",
                    'path_imagen' => $uploadPath,
                    'nombre_comida' => $datos_plato['nombre_plato'],
                    'ingredientes_comida' => $datos_plato['ingredientes']
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

}