CREATE TABLE `reservas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `mesa_id` int unsigned DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mesa_id` (`mesa_id`),
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`mesa_id`) REFERENCES `mesas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*
-- Query: SELECT * FROM `mvc-paw-power`.reservas
LIMIT 0, 1000

-- Date: 2024-06-04 07:20
*/
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (1,4,'2024-05-07','09:00:00','10:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (2,4,'2024-05-07','13:00:00','14:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (3,4,'2024-05-07','15:00:00','16:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (4,2,'2024-05-07','13:00:00','14:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (5,2,'2024-05-07','15:00:00','16:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (6,3,'2024-05-07','13:00:00','14:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (7,3,'2024-05-07','15:00:00','16:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (8,4,'2024-05-08','09:00:00','10:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (9,4,'2024-05-08','13:00:00','14:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (10,4,'2024-05-08','19:00:00','20:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (11,2,'2024-05-08','13:00:00','14:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (12,2,'2024-05-08','15:00:00','16:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (13,3,'2024-05-08','13:00:00','14:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (14,3,'2024-05-08','15:00:00','16:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (15,26,'2024-05-08','13:00:00','14:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (16,26,'2024-05-08','15:00:00','16:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (17,24,'2024-05-08','13:00:00','14:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (18,24,'2024-05-08','15:00:00','16:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (19,25,'2024-05-08','13:00:00','14:30:00');
INSERT INTO `` (`id`,`mesa_id`,`fecha`,`hora_inicio`,`hora_fin`) VALUES (20,25,'2024-05-08','15:00:00','16:30:00');
