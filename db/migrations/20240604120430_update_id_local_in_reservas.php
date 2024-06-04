<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UpdateIdLocalInReservas extends AbstractMigration
{
    public function up()
    {
        // Obtener el número total de registros en la tabla
        $totalRows = $this->fetchRow('SELECT COUNT(*) as count FROM reservas')['count'];

        // Dividir el total entre dos para actualizar la mitad
        $halfRows = (int)($totalRows / 2);

        // Actualizar la primera mitad con id_local = 1
        $this->execute('UPDATE reservas SET id_local = 1 WHERE id <= ' . $halfRows);

        // Actualizar la segunda mitad con id_local = 2
        $this->execute('UPDATE reservas SET id_local = 2 WHERE id > ' . $halfRows);
    }

    public function down()
    {
        // Revertir los cambios en caso de rollback
        $this->execute('UPDATE reservas SET id_local = NULL');
    }
}
