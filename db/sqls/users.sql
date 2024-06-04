CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tipo` enum('cliente','empleado') COLLATE utf8mb4_unicode_ci DEFAULT 'cliente',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
/*
-- Query: SELECT * FROM `mvc-paw-power`.users
LIMIT 0, 1000

-- Date: 2024-06-04 07:22
*/
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (1,'john_doe','john@example.com','$2y$10$P.GNl0XnhkXHTsaQj.PsWut35ngBu3lTX/iWxjJEQFC6UjtBVWGcS','2024-05-25 22:47:05','2024-05-25 22:47:05','cliente');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (2,'jane_doe','jane@example.com','$2y$10$X.SEyrWcsFVsK/uo3h9k8O5pLL6Rhw2TVh2hXkzVYGqa7iF5Vtnau','2024-05-25 22:47:05','2024-05-25 22:47:05','cliente');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (3,'alice','alice@example.com','$2y$10$F6HrcrJIev4nsZyIE9fjveq7OBCsTQ49ajagWDCE16EZxPg.yy9Ea','2024-05-25 22:47:05','2024-05-25 22:47:05','cliente');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (4,'bob','bob@example.com','$2y$10$Yni780RBQtsLbnKQ8N1jEeH4GTRElm0gNA35ymEQf3X3091i1CAam','2024-05-25 22:47:05','2024-05-25 22:47:05','cliente');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (7,'dante','dante@gmail.com','$2y$10$xqaR245ARera/XaPNxR3Mu2m61nWWeLdYVrhw2nW2zS1pSEN59IX2','2024-05-25 23:45:09','2024-05-25 23:45:09','cliente');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (11,'pato','patricia@gmail.com','$2y$10$gx87fAjZye3K2Z5DZU0L/.M2IfgURKeYMv7/DyPYpp7iXg4wF1Gwi','2024-05-26 00:00:16','2024-05-26 00:00:16','cliente');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (13,'giovanna','giovanna@gmail.com','$2y$10$OkXOsd94buAWQQL0p5TXFuyy0c.vWS0RvnaYK3jiBE2Vk0GjBLCzG','2024-05-26 00:03:25','2024-05-26 00:03:25','cliente');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (14,'cliente1',NULL,'$2y$10$.YUdw6jGwyEnZNJBkG.MZejZKrtxtJPxn7nwoGurx16/UheUmRFQK','2024-05-26 02:22:32','2024-05-26 02:22:32','cliente');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (15,'cliente2',NULL,'$2y$10$Fy4dZ5NA0gbe.rb/1qM.mOJK8kyHvqCYlLYjxBcBZlVMy6oGC5UBW','2024-05-26 02:22:33','2024-05-26 02:22:33','cliente');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (16,'empleado1',NULL,'$2y$10$FYILfUbQZAWnHel.gTxXmenyWj9rG4qq/2cXHR2gy6FAGYwFDVoq2','2024-05-26 02:22:33','2024-05-26 02:22:33','empleado');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (17,'empleado2',NULL,'$2y$10$9VRbVfKFWfWOUGCsuJgXIeOifXgmCSOnf2SKImrkSsx8a.gP2DoBS','2024-05-26 02:22:33','2024-05-26 02:22:33','empleado');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (18,'juan','juanmannat@gmail.com','$2y$10$gL4gZSaDFr8M991oYQL4uOoEmog9aG8mEeQMtXCH2xp/zPGIPHbNS','2024-05-27 00:12:03','2024-05-27 00:12:57','empleado');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (19,'cliente1',NULL,'$2y$10$usNLDXe.0Bm0aHvtWHldA.nBRPHi6SHBk285.gMIusLwbTVcijAEi','2024-06-02 02:13:20','2024-06-02 02:13:20','cliente');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (20,'cliente2',NULL,'$2y$10$btGaiHFVM5pwhF.QD9MBVuvkjRUcG3ZiB9StCOMQzNh14Ugbtzyx6','2024-06-02 02:13:20','2024-06-02 02:13:20','cliente');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (21,'empleado1',NULL,'$2y$10$.cEwwCCjUJOuZRSxBBRB3.W266sIYJvsHFb0zM4XGj9oiwUIkd4Cy','2024-06-02 02:13:20','2024-06-02 02:13:20','empleado');
INSERT INTO `` (`id`,`username`,`email`,`password`,`created_at`,`updated_at`,`tipo`) VALUES (22,'empleado2',NULL,'$2y$10$ZctJtMGnuOnvejKyfLTRw.B/A5hVab/mufiSLa8R3x/QFsY/12A/u','2024-06-02 02:13:20','2024-06-02 02:13:20','empleado');
