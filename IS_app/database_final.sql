-- MySQL dump 10.13  Distrib 8.1.0, for macos13.3 (x86_64)
--
-- Host: localhost    Database: if0_35185317_db
-- ------------------------------------------------------
-- Server version	8.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

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

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linka`
--

DROP TABLE IF EXISTS `linka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `linka` (
  `id_linka` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cislo_linky` int unsigned NOT NULL,
  `vozidla_linky` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_linka`),
  UNIQUE KEY `linka_cislo_linky_unique` (`cislo_linky`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linka`
--

LOCK TABLES `linka` WRITE;
/*!40000 ALTER TABLE `linka` DISABLE KEYS */;
INSERT INTO `linka` VALUES (1,1,'Električka','2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,2,'Električka','2023-11-27 06:36:49','2023-11-27 06:36:49'),(3,47,'Autobus','2023-11-27 06:36:49','2023-11-27 06:36:49'),(4,62,'Autobus','2023-11-27 06:36:49','2023-11-27 06:36:49'),(5,32,'Trolejbus','2023-11-27 06:36:49','2023-11-27 06:36:49');
/*!40000 ALTER TABLE `linka` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_reset_tokens_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_10_22_000001_create_linka',1),(6,'2023_10_22_000002_create_trasa',1),(7,'2023_10_22_000003_create_zastavka',1),(8,'2023_10_22_000004_create_usek',1),(9,'2023_10_22_000005_create_vozidlo',1),(10,'2023_10_22_000006_create_uzivatel',1),(11,'2023_10_22_000007_create_planovany_spoj',1),(12,'2023_10_22_000008_create_udrzba',1),(13,'2023_10_22_000009_create_zaznam_udrzby',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

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

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

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

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

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

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planovany_spoj`
--

DROP TABLE IF EXISTS `planovany_spoj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planovany_spoj` (
  `id_plan_trasy` bigint unsigned NOT NULL AUTO_INCREMENT,
  `zaciatok_trasy` datetime DEFAULT NULL,
  `id_trasa` bigint unsigned NOT NULL,
  `id_vozidlo` bigint unsigned DEFAULT NULL,
  `id_uzivatel_dispecer` bigint unsigned DEFAULT NULL,
  `id_uzivatel_sofer` bigint unsigned DEFAULT NULL,
  `opakovanie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platny_do` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_plan_trasy`),
  KEY `planovany_spoj_id_trasa_foreign` (`id_trasa`),
  KEY `planovany_spoj_id_vozidlo_foreign` (`id_vozidlo`),
  KEY `planovany_spoj_id_uzivatel_dispecer_foreign` (`id_uzivatel_dispecer`),
  KEY `planovany_spoj_id_uzivatel_sofer_foreign` (`id_uzivatel_sofer`),
  CONSTRAINT `planovany_spoj_id_trasa_foreign` FOREIGN KEY (`id_trasa`) REFERENCES `trasa` (`id_trasa`),
  CONSTRAINT `planovany_spoj_id_uzivatel_dispecer_foreign` FOREIGN KEY (`id_uzivatel_dispecer`) REFERENCES `uzivatel` (`id_uzivatel`),
  CONSTRAINT `planovany_spoj_id_uzivatel_sofer_foreign` FOREIGN KEY (`id_uzivatel_sofer`) REFERENCES `uzivatel` (`id_uzivatel`),
  CONSTRAINT `planovany_spoj_id_vozidlo_foreign` FOREIGN KEY (`id_vozidlo`) REFERENCES `vozidlo` (`id_vozidlo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planovany_spoj`
--

LOCK TABLES `planovany_spoj` WRITE;
/*!40000 ALTER TABLE `planovany_spoj` DISABLE KEYS */;
INSERT INTO `planovany_spoj` VALUES (1,'2023-11-20 15:00:00',1,1,4,5,'Denne','2023-12-31 23:00:00','2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,'2023-11-10 16:00:00',2,2,4,5,'Denne','2023-12-31 23:00:00','2023-11-27 06:36:49','2023-11-27 06:36:49');
/*!40000 ALTER TABLE `planovany_spoj` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trasa`
--

DROP TABLE IF EXISTS `trasa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trasa` (
  `id_trasa` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meno_trasy` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_linka` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_trasa`),
  UNIQUE KEY `idTrasy_UNIQUE` (`id_trasa`),
  KEY `trasa_id_linka_foreign` (`id_linka`),
  CONSTRAINT `trasa_id_linka_foreign` FOREIGN KEY (`id_linka`) REFERENCES `linka` (`id_linka`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trasa`
--

LOCK TABLES `trasa` WRITE;
/*!40000 ALTER TABLE `trasa` DISABLE KEYS */;
INSERT INTO `trasa` VALUES (1,'Ečerova',1,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,'Řečkovice',1,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(3,'Modřice',2,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(4,'Stará osada',2,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(5,'Staré Černovice',3,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(6,'Hlavní nádraží',3,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(7,'Červený kopec',4,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(8,'Mendlovo náměstí',4,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(9,'Srbská',5,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(10,'Česká',5,'2023-11-27 06:36:49','2023-11-27 06:36:49');
/*!40000 ALTER TABLE `trasa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `udrzba`
--

DROP TABLE IF EXISTS `udrzba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `udrzba` (
  `id_udrzba` bigint unsigned NOT NULL AUTO_INCREMENT,
  `zaciatok_udrzby` datetime DEFAULT NULL,
  `id_vozidlo` bigint unsigned NOT NULL,
  `nazov_spravy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spz` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stav` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `popis` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_udrzba`),
  KEY `udrzba_id_vozidlo_foreign` (`id_vozidlo`),
  CONSTRAINT `udrzba_id_vozidlo_foreign` FOREIGN KEY (`id_vozidlo`) REFERENCES `vozidlo` (`id_vozidlo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `udrzba`
--

LOCK TABLES `udrzba` WRITE;
/*!40000 ALTER TABLE `udrzba` DISABLE KEYS */;
INSERT INTO `udrzba` VALUES (1,'2023-11-25 16:00:00',1,'Rozbité čelné sklo','7C25025','Priradená','Rozbité čelné sklo.','2023-11-27 06:36:49','2023-11-27 06:36:49');
/*!40000 ALTER TABLE `udrzba` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usek`
--

DROP TABLE IF EXISTS `usek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usek` (
  `poradie_useku` bigint unsigned NOT NULL,
  `id_zastavka_zaciatok` bigint unsigned NOT NULL,
  `id_zastavka_koniec` bigint unsigned NOT NULL,
  `dlzka_useku_km` bigint unsigned DEFAULT NULL,
  `cas_useku_minuty` bigint unsigned NOT NULL,
  `id_trasa` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`poradie_useku`,`id_zastavka_zaciatok`,`id_zastavka_koniec`,`id_trasa`),
  KEY `usek_id_zastavka_zaciatok_index` (`id_zastavka_zaciatok`),
  KEY `usek_id_zastavka_koniec_index` (`id_zastavka_koniec`),
  KEY `usek_id_trasa_index` (`id_trasa`),
  CONSTRAINT `usek_id_trasa_foreign` FOREIGN KEY (`id_trasa`) REFERENCES `trasa` (`id_trasa`),
  CONSTRAINT `usek_id_zastavka_koniec_foreign` FOREIGN KEY (`id_zastavka_koniec`) REFERENCES `zastavka` (`id_zastavka`),
  CONSTRAINT `usek_id_zastavka_zaciatok_foreign` FOREIGN KEY (`id_zastavka_zaciatok`) REFERENCES `zastavka` (`id_zastavka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usek`
--

LOCK TABLES `usek` WRITE;
/*!40000 ALTER TABLE `usek` DISABLE KEYS */;
INSERT INTO `usek` VALUES (1,1,2,2,6,1,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(1,5,17,2,6,5,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(1,6,20,2,5,7,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(1,10,9,3,6,2,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(1,11,12,2,4,3,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(1,16,15,5,10,4,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(1,19,18,1,3,6,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(1,20,6,2,5,8,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(1,21,22,2,6,9,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(1,24,23,1,4,10,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,2,3,2,8,1,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,9,8,3,6,2,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,12,5,2,8,3,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,15,14,1,3,4,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,17,18,2,4,5,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,18,17,2,4,6,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,22,23,1,4,9,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,23,22,1,4,10,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(3,3,4,1,3,1,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(3,5,13,2,6,3,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(3,8,7,3,5,2,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(3,14,13,1,3,4,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(3,17,5,2,6,6,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(3,18,19,1,3,5,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(3,22,21,2,6,10,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(3,23,24,1,4,9,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(4,4,5,1,6,1,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(4,7,6,2,6,2,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(4,13,5,2,6,4,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(4,13,14,1,3,3,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(5,5,6,2,7,1,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(5,5,12,2,8,4,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(5,6,5,2,7,2,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(5,14,15,1,3,3,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(6,5,4,1,6,2,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(6,6,7,2,6,1,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(6,12,11,2,4,4,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(6,15,16,5,10,3,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(7,4,3,1,3,2,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(7,7,8,3,5,1,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(8,3,2,2,8,2,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(8,8,9,3,6,1,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(9,2,1,2,6,2,'2023-11-27 06:36:49','2023-11-27 06:36:49'),(9,9,10,3,6,1,'2023-11-27 06:36:49','2023-11-27 06:36:49');
/*!40000 ALTER TABLE `usek` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uzivatel`
--

DROP TABLE IF EXISTS `uzivatel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uzivatel` (
  `id_uzivatel` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meno_uzivatela` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priezvisko_uzivatela` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_uzivatela` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heslo_uzivatela` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rola_uzivatela` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_uzivatel`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uzivatel`
--

LOCK TABLES `uzivatel` WRITE;
/*!40000 ALTER TABLE `uzivatel` DISABLE KEYS */;
INSERT INTO `uzivatel` VALUES (1,'Root','Account','root@dpmb.cz','$2y$10$gaD4oZnckmP4DbM31XLbRuZXF0erIT/KH3xomec6ulgVIFqHJd9fO','administrátor','2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,'Ján','Novák','jan.novak@gmail.com','$2y$10$5DP8idj7Bkvn7OlyJOds4.Uyi1CvZu3Y1Y5izOLuxSprmMZxxlNgC','správca','2023-11-27 06:36:49','2023-11-27 06:36:49'),(3,'Jozef','Dobrý','jozef.dobry@gmail.com','$2y$10$HxJ6G/JGRGeElHMQLhgFJ.aro3H4lOKMBKfjxMkRFg0ZC7xcOehf2','technik','2023-11-27 06:36:49','2023-11-27 06:36:49'),(4,'Anna','Neumannová','anna.neumannova@gmail.com','$2y$10$dlwT0zJdhFvHIbQhpFixeOPcERDFEY4U1LhrQLe8SDkbErHG0jocS','dispečer','2023-11-27 06:36:49','2023-11-27 06:36:49'),(5,'František','Novotný','frantisek.novotny@gmail.com','$2y$10$mAdYCp5W5I1eoUTclXhn2.SfhH78ULyJZjg5iOlihLoUj6LKzhh3u','vodič','2023-11-27 06:36:49','2023-11-27 06:36:49');
/*!40000 ALTER TABLE `uzivatel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vozidlo`
--

DROP TABLE IF EXISTS `vozidlo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vozidlo` (
  `id_vozidlo` bigint unsigned NOT NULL AUTO_INCREMENT,
  `spz` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nazov` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `druh_vozidla` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `znacka_vozidla` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_vozidlo`),
  UNIQUE KEY `vozidlo_spz_unique` (`spz`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vozidlo`
--

LOCK TABLES `vozidlo` WRITE;
/*!40000 ALTER TABLE `vozidlo` DISABLE KEYS */;
INSERT INTO `vozidlo` VALUES (1,'7C25025','Škoda 13T','Električka','Škoda','2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,'7C25026','Škoda 13T','Električka','Škoda','2023-11-27 06:36:49','2023-11-27 06:36:49'),(3,'7C25027','Iveco Urbanway 12M','Autobus','Iveco','2023-11-27 06:36:49','2023-11-27 06:36:49'),(4,'7C25028','Iveco Urbanway 12M','Autobus','Iveco','2023-11-27 06:36:49','2023-11-27 06:36:49'),(5,'7C25029','SOR TNS 12','Trolejbus','SOR','2023-11-27 06:36:49','2023-11-27 06:36:49'),(6,'7C25030','SOR TNS 12','Trolejbus','SOR','2023-11-27 06:36:49','2023-11-27 06:36:49');
/*!40000 ALTER TABLE `vozidlo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zastavka`
--

DROP TABLE IF EXISTS `zastavka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zastavka` (
  `id_zastavka` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meno_zastavky` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresa_zastavky` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_zastavka`),
  UNIQUE KEY `zastavka_meno_zastavky_unique` (`meno_zastavky`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zastavka`
--

LOCK TABLES `zastavka` WRITE;
/*!40000 ALTER TABLE `zastavka` DISABLE KEYS */;
INSERT INTO `zastavka` VALUES (1,'Řečkovice','621 00 Brno-Řečkovice a Mokrá Hora','2023-11-27 06:36:49','2023-11-27 06:36:49'),(2,'Semilasso','612 00 Brno-Královo Pole','2023-11-27 06:36:49','2023-11-27 06:36:49'),(3,'Pionýrska','602 00 Brno-Královo Pole','2023-11-27 06:36:49','2023-11-27 06:36:49'),(4,'Moravské náměstí','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(5,'Hlavní nádraží','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(6,'Mendlovo náměstí','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(7,'Pisárky','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(8,'Vozovna Komín','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(9,'Zoologická zahrada','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(10,'Ečerova','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(11,'Stará Osada','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(12,'Tkalcovská','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(13,'Poříčí','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(14,'Celní','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(15,'Ústřední hřbitov','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(16,'Modřice','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(17,'Tržní','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(18,'Faměrovo náměstí','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(19,'Staré Černovice','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(20,'Červený kopec','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(21,'Česká','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(22,'Botanická','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(23,'Slovanské náměstí','','2023-11-27 06:36:49','2023-11-27 06:36:49'),(24,'Srbská','','2023-11-27 06:36:49','2023-11-27 06:36:49');
/*!40000 ALTER TABLE `zastavka` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zaznam_udrzby`
--

DROP TABLE IF EXISTS `zaznam_udrzby`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zaznam_udrzby` (
  `id_udrzba` bigint unsigned NOT NULL,
  `id_uzivatel_technik` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_udrzba`,`id_uzivatel_technik`),
  KEY `zaznam_udrzby_id_udrzba_index` (`id_udrzba`),
  KEY `zaznam_udrzby_id_uzivatel_technik_index` (`id_uzivatel_technik`),
  CONSTRAINT `zaznam_udrzby_id_udrzba_foreign` FOREIGN KEY (`id_udrzba`) REFERENCES `udrzba` (`id_udrzba`),
  CONSTRAINT `zaznam_udrzby_id_uzivatel_technik_foreign` FOREIGN KEY (`id_uzivatel_technik`) REFERENCES `uzivatel` (`id_uzivatel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zaznam_udrzby`
--

LOCK TABLES `zaznam_udrzby` WRITE;
/*!40000 ALTER TABLE `zaznam_udrzby` DISABLE KEYS */;
INSERT INTO `zaznam_udrzby` VALUES (1,3,'2023-11-27 06:36:49','2023-11-27 06:36:49');
/*!40000 ALTER TABLE `zaznam_udrzby` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-27  8:38:16
