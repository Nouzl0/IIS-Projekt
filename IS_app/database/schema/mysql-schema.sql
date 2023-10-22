/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `linka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `linka` (
  `id_linka` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cislo_linky` int unsigned NOT NULL,
  `meno_linky` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_linka`),
  UNIQUE KEY `linka_cislo_linky_unique` (`cislo_linky`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `planovany_spoj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planovany_spoj` (
  `id_plan_trasy` bigint unsigned NOT NULL AUTO_INCREMENT,
  `zaciatok_trasy` datetime DEFAULT NULL,
  `id_trasa` bigint unsigned NOT NULL,
  `id_vozidlo` bigint unsigned NOT NULL,
  `id_uzivatel_dispecer` bigint unsigned NOT NULL,
  `id_uzivatel_sofer` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_plan_trasy`),
  KEY `planovany_spoj_id_trasa_foreign` (`id_trasa`),
  KEY `planovany_spoj_id_vozidlo_foreign` (`id_vozidlo`),
  KEY `planovany_spoj_id_uzivatel_dispecer_foreign` (`id_uzivatel_dispecer`),
  KEY `planovany_spoj_id_uzivatel_sofer_foreign` (`id_uzivatel_sofer`),
  CONSTRAINT `planovany_spoj_id_trasa_foreign` FOREIGN KEY (`id_trasa`) REFERENCES `trasa` (`id_linka`),
  CONSTRAINT `planovany_spoj_id_uzivatel_dispecer_foreign` FOREIGN KEY (`id_uzivatel_dispecer`) REFERENCES `uzivatel` (`id_uzivatel`),
  CONSTRAINT `planovany_spoj_id_uzivatel_sofer_foreign` FOREIGN KEY (`id_uzivatel_sofer`) REFERENCES `uzivatel` (`id_uzivatel`),
  CONSTRAINT `planovany_spoj_id_vozidlo_foreign` FOREIGN KEY (`id_vozidlo`) REFERENCES `vozidlo` (`id_vozidlo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `trasa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trasa` (
  `id_trasa` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meno_trasy` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_trasy` varchar(240) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_linka` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_trasa`),
  UNIQUE KEY `idTrasy_UNIQUE` (`id_trasa`),
  KEY `trasa_id_linka_foreign` (`id_linka`),
  CONSTRAINT `trasa_id_linka_foreign` FOREIGN KEY (`id_linka`) REFERENCES `linka` (`id_linka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `udrzba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `udrzba` (
  `id_udrzba` bigint unsigned NOT NULL AUTO_INCREMENT,
  `zaciatok_udrzby` datetime DEFAULT NULL,
  `id_vozidlo` bigint unsigned NOT NULL,
  `id_uzivatel_spravca` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_udrzba`),
  KEY `udrzba_id_vozidlo_foreign` (`id_vozidlo`),
  KEY `udrzba_id_uzivatel_spravca_foreign` (`id_uzivatel_spravca`),
  CONSTRAINT `udrzba_id_uzivatel_spravca_foreign` FOREIGN KEY (`id_uzivatel_spravca`) REFERENCES `uzivatel` (`id_uzivatel`),
  CONSTRAINT `udrzba_id_vozidlo_foreign` FOREIGN KEY (`id_vozidlo`) REFERENCES `vozidlo` (`id_vozidlo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `usek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usek` (
  `poradie_useku` int NOT NULL,
  `id_zastavka_zaciatok` bigint unsigned NOT NULL,
  `id_zastavka_koniec` bigint unsigned NOT NULL,
  `meno_useku` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dlzka_useku` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cas_useku` time NOT NULL,
  `usekcol` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_trasa` bigint unsigned NOT NULL,
  PRIMARY KEY (`poradie_useku`,`id_zastavka_zaciatok`,`id_zastavka_koniec`,`id_trasa`),
  UNIQUE KEY `id_usek_UNIQUE` (`meno_useku`),
  KEY `usek_id_zastavka_zaciatok_index` (`id_zastavka_zaciatok`),
  KEY `usek_id_zastavka_koniec_index` (`id_zastavka_koniec`),
  KEY `usek_id_trasa_index` (`id_trasa`),
  CONSTRAINT `usek_id_trasa_foreign` FOREIGN KEY (`id_trasa`) REFERENCES `trasa` (`id_trasa`),
  CONSTRAINT `usek_id_zastavka_koniec_foreign` FOREIGN KEY (`id_zastavka_koniec`) REFERENCES `zastavka` (`id_zastavka`),
  CONSTRAINT `usek_id_zastavka_zaciatok_foreign` FOREIGN KEY (`id_zastavka_zaciatok`) REFERENCES `zastavka` (`id_zastavka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `uzivatel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uzivatel` (
  `id_uzivatel` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meno_uzivatela` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priezvisko_uzivatela` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_cislo_uzivatela` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heslo_uzivatela` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rola_uzivatela` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_uzivatel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `vozidlo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vozidlo` (
  `id_vozidlo` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nazov` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `druh_vozidla` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `znacka_vozidla` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_vozidlo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `zastavka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zastavka` (
  `id_zastavka` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meno_zastavky` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresa_zastavky` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_zastavka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `zaznam_udrzby`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zaznam_udrzby` (
  `id_udrzba` bigint unsigned NOT NULL,
  `id_uzivatel_technik` bigint unsigned NOT NULL,
  PRIMARY KEY (`id_udrzba`,`id_uzivatel_technik`),
  KEY `zaznam_udrzby_id_udrzba_index` (`id_udrzba`),
  KEY `zaznam_udrzby_id_uzivatel_technik_index` (`id_uzivatel_technik`),
  CONSTRAINT `zaznam_udrzby_id_udrzba_foreign` FOREIGN KEY (`id_udrzba`) REFERENCES `udrzba` (`id_udrzba`),
  CONSTRAINT `zaznam_udrzby_id_uzivatel_technik_foreign` FOREIGN KEY (`id_uzivatel_technik`) REFERENCES `uzivatel` (`id_uzivatel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2014_10_12_100000_create_password_reset_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2014_10_12_100000_create_password_resets_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2023_10_22_000001_create_linka',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2023_10_22_000002_create_trasa',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2023_10_22_000003_create_zastavka',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2023_10_22_000004_create_usek',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2023_10_22_000005_create_vozidlo',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11,'2023_10_22_000006_create_uzivatel',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12,'2023_10_22_000007_create_planovany_spoj',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13,'2023_10_22_000008_create_udrzba',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14,'2023_10_22_000009_create_zaznam_udrzby',1);
