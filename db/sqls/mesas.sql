CREATE TABLE `mesas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `local_id` int unsigned DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `local_id` (`local_id`),
  CONSTRAINT `mesas_ibfk_1` FOREIGN KEY (`local_id`) REFERENCES `locales` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*
-- Query: SELECT * FROM `mvc-paw-power`.mesas
LIMIT 0, 1000

-- Date: 2024-06-04 07:21
*/
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (1,1,'mesa-162');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (2,1,'mesa-161');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (3,1,'mesa-144');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (4,1,'mesa-143');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (5,1,'mesa-142');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (6,1,'mesa-141');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (7,1,'mesa-126');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (8,1,'mesa-125');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (9,1,'mesa-124');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (10,1,'mesa-123');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (11,1,'mesa-122');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (12,1,'mesa-121');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (13,1,'mesa-342');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (14,1,'mesa-341');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (15,1,'mesa-322');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (16,1,'mesa-321');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (17,1,'mesa-262');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (18,1,'mesa-261');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (19,1,'mesa-241');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (20,1,'mesa-223');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (21,1,'mesa-222');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (22,1,'mesa-221');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (23,2,'mesa-162');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (24,2,'mesa-161');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (25,2,'mesa-144');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (26,2,'mesa-143');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (27,2,'mesa-142');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (28,2,'mesa-141');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (29,2,'mesa-126');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (30,2,'mesa-125');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (31,2,'mesa-124');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (32,2,'mesa-123');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (33,2,'mesa-122');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (34,2,'mesa-121');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (35,2,'mesa-342');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (36,2,'mesa-341');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (37,2,'mesa-322');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (38,2,'mesa-321');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (39,2,'mesa-262');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (40,2,'mesa-261');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (41,2,'mesa-241');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (42,2,'mesa-223');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (43,2,'mesa-222');
INSERT INTO `` (`id`,`local_id`,`nombre`) VALUES (44,2,'mesa-221');
