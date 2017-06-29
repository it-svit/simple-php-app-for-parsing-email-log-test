DROP TABLE IF EXISTS `logs`;
DROP TABLE IF EXISTS `errors`;

CREATE TABLE `errors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `error_name_unique` (`name`)
) ENGINE=InnoDB;

CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `error_id` int(10) unsigned NOT NULL,
  `to` varchar(191) COLLATE utf8_general_ci NOT NULL,
  `ctladdr` varchar(191) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `errors_error_id_foreign` (`error_id`),
  CONSTRAINT `errors_error_id_foreign` FOREIGN KEY (`error_id`) REFERENCES `errors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB;