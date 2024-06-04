<?php 


$localId = 1;

$localData = [
    ['id' => 1, 'nombre_local' => 'local-avellaneda', 'ubicacion' => 'california 456']
];

$mesaData = [
    ['id' => 1,'nombre_mesa' => 'mesa-162', 'capacidad' => 6, 'local' => $localId],
    ['id' => 2,'nombre_mesa' => 'mesa-161', 'capacidad' => 6, 'local' => $localId],
    ['id' => 3,'nombre_mesa' => 'mesa-144', 'capacidad' => 4, 'local' => $localId],
    ['id' => 4,'nombre_mesa' => 'mesa-143', 'capacidad' => 4, 'local' => $localId],
    ['id' => 5,'nombre_mesa' => 'mesa-142', 'capacidad' => 4, 'local' => $localId],
    ['id' => 6,'nombre_mesa' => 'mesa-141', 'capacidad' => 4, 'local' => $localId],
    ['id' => 7,'nombre_mesa' => 'mesa-126', 'capacidad' => 2, 'local' => $localId],
    ['id' => 8,'nombre_mesa' => 'mesa-125', 'capacidad' => 2, 'local' => $localId],
    ['id' => 9,'nombre_mesa' => 'mesa-124', 'capacidad' => 2, 'local' => $localId],
    ['id' => 10,'nombre_mesa' => 'mesa-123', 'capacidad' => 2, 'local' => $localId],
    ['id' => 11,'nombre_mesa' => 'mesa-122', 'capacidad' => 2, 'local' => $localId],
    ['id' => 12,'nombre_mesa' => 'mesa-121', 'capacidad' => 2, 'local' => $localId],
    ['id' => 13,'nombre_mesa' => 'mesa-342', 'capacidad' => 4, 'local' => $localId],
    ['id' => 14,'nombre_mesa' => 'mesa-341', 'capacidad' => 4, 'local' => $localId],
    ['id' => 15,'nombre_mesa' => 'mesa-322', 'capacidad' => 2, 'local' => $localId],
    ['id' => 16,'nombre_mesa' => 'mesa-321', 'capacidad' => 2, 'local' => $localId],
    ['id' => 17,'nombre_mesa' => 'mesa-262', 'capacidad' => 6, 'local' => $localId],
    ['id' => 18,'nombre_mesa' => 'mesa-261', 'capacidad' => 6, 'local' => $localId],
    ['id' => 19,'nombre_mesa' => 'mesa-241', 'capacidad' => 4, 'local' => $localId],
    ['id' => 20,'nombre_mesa' => 'mesa-223', 'capacidad' => 2, 'local' => $localId],
    ['id' => 21,'nombre_mesa' => 'mesa-222', 'capacidad' => 2, 'local' => $localId],
    ['id' => 22,'nombre_mesa' => 'mesa-221', 'capacidad' => 2, 'local' => $localId]
];

date_default_timezone_set('America/Argentina/Buenos_Aires');

$currentDateTime = date('Y-m-d H:i:s');

// Calcular la fecha y hora final sumando 1 hora y 30 minutos a la fecha y hora actual
$finalDateTime = date('Y-m-d H:i:s', strtotime('+1 hour 30 minutes', strtotime($currentDateTime)));

$reservaData = [
    ['id' => 1,'id_local' => 1, 'id_mesa' => 1, 'fecha_hora_inicio' => $currentDateTime, 'fecha_hora_final' => $finalDateTime, 'ocupada' => true],
    ['id' => 2,'id_local' => 1, 'id_mesa' => 2, 'fecha_hora_inicio' => $currentDateTime, 'fecha_hora_final' => $finalDateTime, 'ocupada' => false],
    ['id' => 3,'id_local' => 1, 'id_mesa' => 3, 'fecha_hora_inicio' => $currentDateTime, 'fecha_hora_final' => $finalDateTime, 'ocupada' => true]
];