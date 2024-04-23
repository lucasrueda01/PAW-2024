# Proyecto Paw

## Instalacion y Ejecucion (local)

* git clone <https://github.com/lucasrueda01/PAW-2024.git>
* cd composer install
* cp .env.example .env # Editar el .env con los valores deseados
* Ejecutar migrations: `phinx migrate -e development`
* Ejecutar nueva migracion: `phinx create migration_name`
* Ejecutar `php -S localhost:8080 -t public/`

LICENSE.md
CHANGELOG.md
CONTRIBUTION.md
AUTORES.md
<<<<<<< Updated upstream
=======

### Modificaciones:

* la carpeta `uploads/` quedo en la carpeta raiz del proyecto `PAW-2024/uploads/`
Esto significa que las imagenes no pueden ser accedidas desde el front, lo q significan, q 
se tienen que cargar desde el backend al momento de cargar la vista. 
>>>>>>> Stashed changes
