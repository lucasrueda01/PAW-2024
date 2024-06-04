CREATE TABLE `locales` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora_apertura` time DEFAULT NULL,
  `hora_cierre` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*
-- Query: SELECT * FROM `mvc-paw-power`.locales
LIMIT 0, 1000

-- Date: 2024-06-04 07:21
*/
INSERT INTO `` (`id`,`nombre`,`hora_apertura`,`hora_cierre`) VALUES (1,'Local A','09:00:00','21:00:00');
INSERT INTO `` (`id`,`nombre`,`hora_apertura`,`hora_cierre`) VALUES (2,'Local B','09:00:00','21:00:00');
