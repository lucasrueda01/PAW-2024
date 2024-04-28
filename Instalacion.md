### 1) INSTALACION DE MYSQL 

* Descargar e Instalar Mysql del siguiente (link)[https://dev.mysql.com/downloads/file/?id=526407].- 
* Copiar los variables de ambiente en el archivo `.env.example` en un nuevo archivo
    - `.env`
* Crear la tabla `mvc-paw-power`

### 2) INSTALACION DE PHINX 

- `curl -s https://getcomposer.org/installer | php`
- `php composer.phar require robmorgan/phinx`
Luego ejecutar `phinx` desde `vendor/bin/phinx`
- `vendor/bin/phinx migration `
* Ejecutar migrations: `phinx migrate -e development`

### 3) INSTALACION DE PHP: 

* Descargar php desde el siguiente [link](https://windows.php.net/downloads/releases/php-8.3.6-nts-Win32-vs16-x64.zip), 
    - descomprimir el archivo zip, y cambiar el nombre a `php`
    - mover la carpeta a `c:\\php`
    - agregar a las variables de entorno dicha ruta. 

#### 3.1) CONFIGURACION DEL ARCHIVO `php.ini`

* Descomentar las siguientes lineas en `php.ini`:
    - `extension=fileinfo`
    - `extension=pdo_mysql`
* Aumentar tamaño de upload_max_filesize a 10M
    - `upload_max_filesize = 10M`


### 4) INSTALACION DE COMPOSER

* Para sistemas Windows 
    - Descargar el instalador del siguiente (Enlace)[https://getcomposer.org/Composer-Setup.exe] 

### 5) Instalacion y Ejecucion del Proyecto

* Clonar el Proyecto git clone <https://github.com/lucasrueda01/PAW-2024.git>
* cd composer install
* cp .env.example .env # Editar el .env con los valores deseados
* Ejecutar migrations: `phinx migrate -e development`
* Crear la carpeta `public/uploads/` para el guardado de las imagenes. 
* Ejecutar `php -S localhost:8080 -t public/`

### 6) Instalacion de Ngrok 

- A efectos de presentar el sistema, se puede usar *ngrok*. Para su instalacion es necesario tener `chocolatey` incorporado en el sistema, el mismo se puede instalar siguiendo los pasos del (link de la pagina)[https://chocolatey.org/install]

* Instalar el ngrok del siguiente (link)[https://ngrok.com/download]
    - Loguearse en la pagina para obtener la llave
* Para su uso, ejecutar el siguiente comando `ngrok http 8080` 