# Proyecto Paw


## Instalacion y Ejecucion (local)

* git clone <url-repo>
* cd composer install
* cp .env.example .env # Editar el .env con los valores deseados
* Ejecutar migrations: `phinx migrate -e development`
* Ejecutar nueva migracion: `phinx create migration_name`
* Ejecutar php -S localhost:8080 -t public/

LICENSE.md
CHANGELOG.md
CONTRIBUTION.md
AUTORES.md