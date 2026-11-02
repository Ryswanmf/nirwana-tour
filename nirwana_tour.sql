-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: nirwana_tour
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tour',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (11,'Wisata Domestik','wisata-domestik','tour','Wisata Domestik','2026-10-29 05:10:19','2026-10-29 05:10:19'),(12,'Study Tour','study-tour','tour','Study Tour','2026-10-29 05:19:18','2026-10-29 05:19:18'),(13,'Test Galeri Foto','test-galeri-foto','gallery',NULL,'2026-10-30 18:41:14','2026-10-30 18:41:14'),(14,'Tips Wisata','tips-wisata','article',NULL,'2026-10-30 20:04:14','2026-10-30 20:04:14'),(15,'Edukasi','edukasi','article',NULL,'2026-10-30 20:04:14','2026-10-30 20:04:14'),(16,'Kunjungan Industri','kunjungan-industri','article',NULL,'2026-10-30 20:20:48','2026-10-30 20:20:48');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
-- Table structure for table `fleets`
--

DROP TABLE IF EXISTS `fleets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fleets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facilities` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `flt_is_active_order_idx` (`is_active`,`order`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fleets`
--

LOCK TABLES `fleets` WRITE;
/*!40000 ALTER TABLE `fleets` DISABLE KEYS */;
INSERT INTO `fleets` VALUES (1,'Toyota HiAce Commuter / Premio','HiAce Microbus','14 - 15 Kursi','[\"AC Dingin Double Blower\", \"Reclining Seat Nyaman\", \"Audio Bluetooth & Mic Karaoke\", \"USB Fast Charging\", \"Kabin Bersih & Senyap\"]',NULL,1,1,'2026-10-26 22:57:57','2026-10-26 22:57:57'),(2,'Isuzu Elf Long Coaster','Elf Long','17 - 19 Kursi','[\"AC Ducting Tiap Baris\", \"Reclining Seats\", \"Bagasi Luas\", \"Audio Multimedia TV LED\", \"Suspensi Nyaman\"]',NULL,2,1,'2026-10-26 22:57:57','2026-10-26 22:57:57'),(3,'Medium Bus Executive Class','Medium Bus','31 - 35 Kursi','[\"Konfigurasi Seat 2-2\", \"Layar TV LED & Subwoofer\", \"Port USB Charger Tiap Kursi\", \"Dispenser Air Panas\", \"Bagasi Luas Bawah\"]',NULL,3,1,'2026-10-26 22:57:57','2026-10-26 22:57:57'),(4,'Big Bus HD / HDD Jetbus','Big Bus','45 - 50 Kursi','[\"Konfigurasi Seat 2-2 / 2-3\", \"Air Conditioner Denso Dingin\", \"Full Audio Karaoke & Mic\", \"Bantal & Selimut Trip Jauh\", \"Toilet Kabin (Opsional)\"]',NULL,4,1,'2026-10-26 22:57:57','2026-10-26 22:57:57'),(5,'Big Bus SHD Premium Mercedes-Benz','Big Bus SHD','48 - 50 Kursi','[\"Chassis Mercedes-Benz Air Suspension\", \"Kaca Ganda Double Glass\", \"Smoking Room & Toilet\", \"Legrest / Sandaran Kaki\", \"Wi-Fi Onboard\"]',NULL,5,1,'2026-10-26 22:57:57','2026-10-26 22:57:57');
/*!40000 ALTER TABLE `fleets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_items`
--

DROP TABLE IF EXISTS `gallery_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `order` int NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_items_category_id_foreign` (`category_id`),
  KEY `gi_media_type_order_idx` (`media_type`,`order`),
  KEY `gallery_items_is_featured_index` (`is_featured`),
  CONSTRAINT `gallery_items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_items`
--

LOCK TABLES `gallery_items` WRITE;
/*!40000 ALTER TABLE `gallery_items` DISABLE KEYS */;
INSERT INTO `gallery_items` VALUES (22,NULL,'Kunjungan Industri SMK N 1 RAMAN UTARA','video','gallery/tK5Y04l26M84oS9e6lMKFv62aX974O6B8L2v9Rkk.mp4',NULL,'Keluarga besar SMKN 1 Raman Utara siap melaksanakan perjalanan Kunjungan Industri ke Yogyakarta bersama Nirwana Tour & Travel.',0,1,'2026-10-30 19:09:01','2026-10-30 19:13:06'),(25,NULL,'SMKN1 Penawartama Road to Jakarta - Bandung bersama Nirwana tour & Travel','video','gallery/e2zuVtBekGL4ccwAelO7iVy3eQcvrfKz7CgqKIzg.mp4',NULL,'Pemberangkatan SMKN1 Penawartama Road to Jakarta - Bandung bersama Nirwana tour & Travel',0,1,'2026-10-30 19:12:31','2026-10-30 19:12:47'),(26,NULL,'TIM Kunjungan Industri SMK Negeri 1 Way Kenanga, Goes To Jakarta - Yogyakarta.','video','gallery/guCH0UTRAKuIMknUY3cil0pvOAssy5nGCO1fPJN2.mp4',NULL,'TIM Kunjungan Industri SMK Negeri 1 Way Kenanga, Goes To Jakarta - Yogyakarta.',0,0,'2026-10-30 19:14:25','2026-10-30 19:19:55'),(27,NULL,'Kunjungan industri SMKN1 Way Kenanga','video','gallery/SUWBYLiv6ssq3u59enawrfVaDRGXvckId5hfBFmI.mp4',NULL,'Kunjungan industri SMKN1 Way Kenanga road to jakarta - jogja bersama Nirwana Tour & Travel Bahagia sepenuh hati',0,1,'2026-10-30 19:15:47','2026-10-30 19:15:47'),(28,NULL,'Hari ini kita Goes To Jakarta-Bandung bersama SMK Negeri 1 Kotabumi ','video','gallery/x9njR3uOE2n1uowemMVTUfp4gvWh5LZmIH2Sf8Xx.mp4',NULL,'Hari ini kita Goes To Jakarta-Bandung bersama SMK Negeri 1 Kotabumi ',0,1,'2026-10-30 19:17:13','2026-10-30 19:18:42');
/*!40000 ALTER TABLE `gallery_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inquiries`
--

DROP TABLE IF EXISTS `inquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inquiries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tour_package_id` bigint unsigned DEFAULT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `participants` int NOT NULL DEFAULT '1',
  `fleet_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_price` bigint unsigned DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'website',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inquiries_tour_package_id_foreign` (`tour_package_id`),
  KEY `inq_status_idx` (`status`),
  CONSTRAINT `inquiries_tour_package_id_foreign` FOREIGN KEY (`tour_package_id`) REFERENCES `tour_packages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inquiries`
--

LOCK TABLES `inquiries` WRITE;
/*!40000 ALTER TABLE `inquiries` DISABLE KEYS */;
INSERT INTO `inquiries` VALUES (1,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-26 23:17:28','2026-10-26 23:17:28'),(2,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-26 23:18:43','2026-10-26 23:18:43'),(3,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-26 23:27:40','2026-10-26 23:27:40'),(4,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-26 23:28:03','2026-10-26 23:28:03'),(5,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 00:53:08','2026-10-27 00:53:08'),(6,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 01:07:51','2026-10-27 01:07:51'),(7,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 01:10:50','2026-10-27 01:10:50'),(8,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 01:20:58','2026-10-27 01:20:58'),(9,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 01:25:43','2026-10-27 01:25:43'),(10,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 01:28:15','2026-10-27 01:28:15'),(11,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 01:34:14','2026-10-27 01:34:14'),(12,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 04:38:35','2026-10-27 04:38:35'),(13,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 04:42:36','2026-10-27 04:42:36'),(14,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 04:46:25','2026-10-27 04:46:25'),(15,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 04:49:11','2026-10-27 04:49:11'),(16,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 04:52:04','2026-10-27 04:52:04'),(17,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 04:57:44','2026-10-27 04:57:44'),(18,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 05:07:11','2026-10-27 05:07:11'),(19,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 05:10:50','2026-10-27 05:10:50'),(20,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 05:12:55','2026-10-27 05:12:55'),(21,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 05:15:02','2026-10-27 05:15:02'),(22,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 05:17:33','2026-10-27 05:17:33'),(23,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 05:18:36','2026-10-27 05:18:36'),(24,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 05:29:08','2026-10-27 05:29:08'),(25,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 05:35:15','2026-10-27 05:35:15'),(26,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 05:41:38','2026-10-27 05:41:38'),(27,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 05:45:18','2026-10-27 05:45:18'),(28,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 05:50:12','2026-10-27 05:50:12'),(29,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 05:53:44','2026-10-27 05:53:44'),(30,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 05:57:23','2026-10-27 05:57:23'),(31,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 06:01:12','2026-10-27 06:01:12'),(32,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 06:06:10','2026-10-27 06:06:10'),(33,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 06:10:00','2026-10-27 06:10:00'),(34,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 06:18:02','2026-10-27 06:18:02'),(35,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 06:27:27','2026-10-27 06:27:27'),(36,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 06:34:25','2026-10-27 06:34:25'),(37,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 06:37:17','2026-10-27 06:37:17'),(38,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 06:39:51','2026-10-27 06:39:51'),(39,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 07:00:16','2026-10-27 07:00:16'),(40,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 07:11:12','2026-10-27 07:11:12'),(41,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 07:18:10','2026-10-27 07:18:10'),(42,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 07:35:43','2026-10-27 07:35:43'),(43,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 08:32:31','2026-10-27 08:32:31'),(44,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 08:36:32','2026-10-27 08:36:32'),(45,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 08:42:23','2026-10-27 08:42:23'),(46,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 08:45:55','2026-10-27 08:45:55'),(47,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 08:54:22','2026-10-27 08:54:22'),(48,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 09:00:44','2026-10-27 09:00:44'),(49,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 18:26:23','2026-10-27 18:26:23'),(50,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 18:36:29','2026-10-27 18:36:29'),(51,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 18:43:48','2026-10-27 18:43:48'),(52,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 18:49:59','2026-10-27 18:49:59'),(53,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 18:53:26','2026-10-27 18:53:26'),(54,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 19:00:57','2026-10-27 19:00:57'),(55,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 19:05:47','2026-10-27 19:05:47'),(56,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 19:12:28','2026-10-27 19:12:28'),(57,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 19:21:01','2026-10-27 19:21:01'),(58,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 19:27:56','2026-10-27 19:27:56'),(59,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 19:31:49','2026-10-27 19:31:49'),(60,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 19:35:14','2026-10-27 19:35:14'),(61,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 19:37:39','2026-10-27 19:37:39'),(62,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 20:05:17','2026-10-27 20:05:17'),(63,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 20:12:17','2026-10-27 20:12:17'),(64,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 20:18:30','2026-10-27 20:18:30'),(65,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 20:24:53','2026-10-27 20:24:53'),(66,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 20:33:13','2026-10-27 20:33:13'),(67,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 20:41:02','2026-10-27 20:41:02'),(68,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 20:42:08','2026-10-27 20:42:08'),(69,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 20:48:48','2026-10-27 20:48:48'),(70,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 20:52:27','2026-10-27 20:52:27'),(71,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 20:56:24','2026-10-27 20:56:24'),(72,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 21:28:56','2026-10-27 21:28:56'),(73,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 21:35:10','2026-10-27 21:35:10'),(74,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 21:38:05','2026-10-27 21:38:05'),(75,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 22:10:35','2026-10-27 22:10:35'),(76,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 22:14:15','2026-10-27 22:14:15'),(77,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 22:54:10','2026-10-27 22:54:10'),(78,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 22:59:23','2026-10-27 22:59:23'),(79,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 23:01:42','2026-10-27 23:01:42'),(80,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 23:08:51','2026-10-27 23:08:51'),(81,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 23:24:36','2026-10-27 23:24:36'),(82,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 23:34:34','2026-10-27 23:34:34'),(83,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-27 23:50:15','2026-10-27 23:50:15'),(84,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 04:30:27','2026-10-28 04:30:27'),(85,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 04:35:06','2026-10-28 04:35:06'),(86,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 04:44:12','2026-10-28 04:44:12'),(87,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 05:03:53','2026-10-28 05:03:53'),(88,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 05:33:25','2026-10-28 05:33:25'),(89,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 05:44:22','2026-10-28 05:44:22'),(90,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 05:45:09','2026-10-28 05:45:09'),(91,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 06:13:58','2026-10-28 06:13:58'),(92,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 06:21:48','2026-10-28 06:21:48'),(93,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 06:33:51','2026-10-28 06:33:51'),(94,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 06:41:39','2026-10-28 06:41:39'),(95,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 06:45:06','2026-10-28 06:45:06'),(96,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 06:51:34','2026-10-28 06:51:34'),(97,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 06:59:21','2026-10-28 06:59:21'),(98,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 07:04:59','2026-10-28 07:04:59'),(99,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 07:11:21','2026-10-28 07:11:21'),(100,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 07:12:24','2026-10-28 07:12:24'),(101,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 07:14:34','2026-10-28 07:14:34'),(102,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 07:17:52','2026-10-28 07:17:52'),(103,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 10:13:34','2026-10-28 10:13:34'),(104,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 18:18:42','2026-10-28 18:18:42'),(105,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 18:22:42','2026-10-28 18:22:42'),(106,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 18:49:26','2026-10-28 18:49:26'),(107,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 18:50:31','2026-10-28 18:50:31'),(108,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 19:06:30','2026-10-28 19:06:30'),(109,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 19:23:45','2026-10-28 19:23:45'),(110,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 19:29:56','2026-10-28 19:29:56'),(111,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 19:34:10','2026-10-28 19:34:10'),(112,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 19:39:04','2026-10-28 19:39:04'),(113,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 20:12:28','2026-10-28 20:12:28'),(114,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 20:13:06','2026-10-28 20:13:06'),(115,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 20:13:52','2026-10-28 20:13:52'),(116,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 22:08:08','2026-10-28 22:08:08'),(117,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 22:13:32','2026-10-28 22:13:32'),(118,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 22:31:15','2026-10-28 22:31:15'),(119,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 23:00:43','2026-10-28 23:00:43'),(120,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 23:02:37','2026-10-28 23:02:37'),(121,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-28 23:02:54','2026-10-28 23:02:54'),(122,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 23:03:31','2026-10-28 23:03:31'),(123,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-28 23:03:39','2026-10-28 23:03:39'),(124,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 23:04:47','2026-10-28 23:04:47'),(125,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-28 23:04:55','2026-10-28 23:04:55'),(126,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-28 23:49:22','2026-10-28 23:49:22'),(127,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-28 23:49:29','2026-10-28 23:49:29'),(128,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 01:18:20','2026-10-29 01:18:20'),(129,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 01:18:26','2026-10-29 01:18:26'),(130,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 01:33:16','2026-10-29 01:33:16'),(131,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 01:33:22','2026-10-29 01:33:22'),(132,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 01:38:19','2026-10-29 01:38:19'),(133,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 01:38:25','2026-10-29 01:38:25'),(134,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 01:42:54','2026-10-29 01:42:54'),(135,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 01:43:10','2026-10-29 01:43:10'),(136,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 01:52:21','2026-10-29 01:52:21'),(137,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 01:52:39','2026-10-29 01:52:39'),(138,'Budi Santoso','081234567890','budi@example.com',1,'Pulau Pahawang Snorkeling Paradise',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 02:41:17','2026-10-29 02:41:17'),(139,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 02:41:46','2026-10-29 02:41:46'),(140,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 03:01:18','2026-10-29 03:01:18'),(141,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 03:02:05','2026-10-29 03:02:05'),(142,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 03:08:17','2026-10-29 03:08:17'),(143,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 03:08:22','2026-10-29 03:08:22'),(144,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 03:08:58','2026-10-29 03:08:58'),(145,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 03:09:02','2026-10-29 03:09:02'),(146,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 03:16:23','2026-10-29 03:16:23'),(147,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 03:16:28','2026-10-29 03:16:28'),(148,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 03:37:20','2026-10-29 03:37:20'),(149,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 03:37:24','2026-10-29 03:37:24'),(150,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 03:38:02','2026-10-29 03:38:02'),(151,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 03:38:07','2026-10-29 03:38:07'),(152,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 03:50:25','2026-10-29 03:50:25'),(153,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 03:50:30','2026-10-29 03:50:30'),(154,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 03:51:22','2026-10-29 03:51:22'),(155,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 03:51:26','2026-10-29 03:51:26'),(156,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 03:51:53','2026-10-29 03:51:53'),(157,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 03:51:57','2026-10-29 03:51:57'),(158,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 04:02:53','2026-10-29 04:02:53'),(159,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 04:02:58','2026-10-29 04:02:58'),(160,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 04:03:49','2026-10-29 04:03:49'),(161,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 04:03:53','2026-10-29 04:03:53'),(162,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 04:04:05','2026-10-29 04:04:05'),(163,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 04:04:10','2026-10-29 04:04:10'),(164,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 04:13:15','2026-10-29 04:13:15'),(165,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 04:13:19','2026-10-29 04:13:19'),(166,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 04:40:01','2026-10-29 04:40:01'),(167,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 04:40:05','2026-10-29 04:40:05'),(168,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 04:45:56','2026-10-29 04:45:56'),(169,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 04:46:00','2026-10-29 04:46:00'),(170,'Budi Santoso','081234567890','budi@example.com',NULL,'Ekspedisi Vulkanik Krakatau',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 04:53:04','2026-10-29 04:53:04'),(171,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 04:53:08','2026-10-29 04:53:08'),(172,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 06:47:07','2026-10-29 06:47:07'),(173,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 06:47:55','2026-10-29 06:47:55'),(174,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 06:53:05','2026-10-29 06:53:05'),(175,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 06:53:41','2026-10-29 06:53:41'),(176,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 08:08:14','2026-10-29 08:08:14'),(177,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 08:08:50','2026-10-29 08:08:50'),(178,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 08:17:17','2026-10-29 08:17:17'),(179,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 08:17:55','2026-10-29 08:17:55'),(180,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 11:20:16','2026-10-29 11:20:16'),(181,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 11:21:08','2026-10-29 11:21:08'),(182,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-29 11:28:14','2026-10-29 11:28:14'),(183,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-29 11:29:03','2026-10-29 11:29:03'),(184,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 18:08:54','2026-10-30 18:08:54'),(185,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 18:09:53','2026-10-30 18:09:53'),(186,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 18:18:06','2026-10-30 18:18:06'),(187,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 18:18:58','2026-10-30 18:18:58'),(188,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 18:30:31','2026-10-30 18:30:31'),(189,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 18:31:50','2026-10-30 18:31:50'),(190,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 18:42:00','2026-10-30 18:42:00'),(191,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 18:42:07','2026-10-30 18:42:07'),(192,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 18:50:16','2026-10-30 18:50:16'),(193,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 18:50:22','2026-10-30 18:50:22'),(194,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 18:55:49','2026-10-30 18:55:49'),(195,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 18:55:57','2026-10-30 18:55:57'),(196,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 19:10:19','2026-10-30 19:10:19'),(197,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 19:10:24','2026-10-30 19:10:24'),(198,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 19:27:17','2026-10-30 19:27:17'),(199,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 19:28:05','2026-10-30 19:28:05'),(200,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 19:41:24','2026-10-30 19:41:24'),(201,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 19:42:19','2026-10-30 19:42:19'),(202,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 19:53:35','2026-10-30 19:53:35'),(203,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 19:54:10','2026-10-30 19:54:10'),(204,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 20:05:19','2026-10-30 20:05:19'),(205,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 20:05:25','2026-10-30 20:05:25'),(206,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 20:16:34','2026-10-30 20:16:34'),(207,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 20:16:41','2026-10-30 20:16:41'),(208,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 20:41:47','2026-10-30 20:41:47'),(209,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 20:41:59','2026-10-30 20:41:59'),(210,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 21:06:20','2026-10-30 21:06:20'),(211,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 21:06:30','2026-10-30 21:06:30'),(212,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-30 21:13:20','2026-10-30 21:13:20'),(213,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-30 21:13:30','2026-10-30 21:13:30'),(214,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-31 17:57:44','2026-10-31 17:57:44'),(215,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-31 17:58:41','2026-10-31 17:58:41'),(216,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-31 18:12:44','2026-10-31 18:12:44'),(217,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-31 18:13:36','2026-10-31 18:13:36'),(218,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-31 18:20:03','2026-10-31 18:20:03'),(219,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-31 18:20:31','2026-10-31 18:20:31'),(220,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-31 18:30:56','2026-10-31 18:30:56'),(221,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-31 18:31:39','2026-10-31 18:31:39'),(222,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-31 18:48:11','2026-10-31 18:48:11'),(223,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-31 18:48:56','2026-10-31 18:48:56'),(224,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-31 19:12:41','2026-10-31 19:12:41'),(225,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-31 19:13:07','2026-10-31 19:13:07'),(226,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-10-31 19:43:01','2026-10-31 19:43:01'),(227,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-10-31 19:43:38','2026-10-31 19:43:38'),(228,'Budi Santoso','081234567890','budi@example.com',1,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta',15,'Medium Bus',2500000,'Tes pemesanan rombongan dinas','pending','test_suite','2026-11-01 02:55:05','2026-11-01 02:55:05'),(229,'Siti Aminah','081298765432','siti@example.com',NULL,NULL,1,NULL,NULL,'Tanya ketersediaan trip rombongan','pending','website','2026-11-01 02:55:58','2026-11-01 02:55:58');
/*!40000 ALTER TABLE `inquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_27_055003_create_categories_table',1),(5,'2026_10_27_055004_create_tour_packages_table',1),(6,'2026_10_27_055006_create_services_table',1),(7,'2026_10_27_055007_create_fleets_table',1),(8,'2026_10_27_055009_create_partners_table',1),(9,'2026_10_27_055010_create_testimonials_table',1),(10,'2026_10_27_055012_create_gallery_items_table',1),(11,'2026_10_27_055013_create_posts_table',1),(12,'2026_10_27_055015_create_inquiries_table',1),(13,'2026_10_27_055016_create_site_settings_table',1),(14,'2026_10_29_051500_create_team_members_table',1),(15,'2026_10_29_053709_add_faqs_to_tour_packages_table',1),(16,'2026_10_29_100000_add_performance_indexes_to_tables',1),(17,'2026_10_29_110000_add_status_index_to_inquiries_table',1),(18,'2026_10_29_120000_seed_company_profile_site_settings',1),(19,'2026_10_31_020213_add_is_featured_to_gallery_items_table',1),(20,'2026_10_31_030000_add_is_featured_and_category_name_to_posts_table',1),(21,'2026_10_31_040000_add_gallery_images_to_posts_table',1),(22,'2026_11_01_023231_create_notifications_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('5fe93ed6-2121-4a15-9ca9-3f6f345436d4','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',1,'{\"actions\":[{\"name\":\"view\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Buka Testimoni\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":\"http:\\/\\/localhost:8000\\/admin\\/testimonials\\/62\\/edit\",\"view\":\"filament-actions::link-action\"}],\"body\":\"Ahmad Faisal memberikan ulasan bintang 5. Silakan verifikasi untuk ditampilkan di web.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-chat-bubble-bottom-center-text\",\"iconColor\":\"warning\",\"status\":null,\"title\":\"Testimoni Baru Perlu Moderasi!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2026-11-01 02:56:00','2026-11-01 02:56:00'),('74586899-e5b9-439b-90e7-a1834f9b80ed','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',1,'{\"actions\":[{\"name\":\"view\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Buka Detail\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":\"http:\\/\\/localhost:8000\\/admin\\/inquiries\\/228\\/edit\",\"view\":\"filament-actions::link-action\"}],\"body\":\"Budi Santoso mengirim konsultasi untuk Paket Wisata 5D2N Jakarta \\u2013 Bandung \\u2013 Yogyakarta (15 orang).\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-shopping-bag\",\"iconColor\":\"success\",\"status\":null,\"title\":\"Permintaan Pesanan Baru!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2026-11-01 02:55:05','2026-11-01 02:55:05'),('7be0e6c5-539b-4bb8-80d7-da6e9838b1dd','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',1,'{\"actions\":[{\"name\":\"view\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Buka Detail\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":\"http:\\/\\/localhost:8000\\/admin\\/inquiries\\/227\\/edit\",\"view\":\"filament-actions::link-action\"}],\"body\":\"Siti Aminah mengirim konsultasi untuk  (1 orang).\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-shopping-bag\",\"iconColor\":\"success\",\"status\":null,\"title\":\"Permintaan Pesanan Baru!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2026-10-31 19:43:38','2026-10-31 19:43:38'),('96dd8892-ad4f-486c-b439-4fa3b03b111e','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',1,'{\"actions\":[{\"name\":\"view\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Buka Testimoni\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":\"http:\\/\\/localhost:8000\\/admin\\/testimonials\\/61\\/edit\",\"view\":\"filament-actions::link-action\"}],\"body\":\"Ahmad Faisal memberikan ulasan bintang 5. Silakan verifikasi untuk ditampilkan di web.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-chat-bubble-bottom-center-text\",\"iconColor\":\"warning\",\"status\":null,\"title\":\"Testimoni Baru Perlu Moderasi!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2026-10-31 19:43:39','2026-10-31 19:43:39'),('9d67d0dc-2b24-4a66-8a0b-1022b504ef57','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',1,'{\"actions\":[{\"name\":\"view\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Buka Detail\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":\"http:\\/\\/localhost:8000\\/admin\\/inquiries\\/229\\/edit\",\"view\":\"filament-actions::link-action\"}],\"body\":\"Siti Aminah mengirim konsultasi untuk  (1 orang).\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-shopping-bag\",\"iconColor\":\"success\",\"status\":null,\"title\":\"Permintaan Pesanan Baru!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2026-11-01 02:55:58','2026-11-01 02:55:58'),('a573d8d9-33f2-4ff1-be3e-9cad4846a4e4','Filament\\Notifications\\DatabaseNotification','App\\Models\\User',1,'{\"actions\":[{\"name\":\"view\",\"color\":null,\"event\":null,\"eventData\":[],\"dispatchDirection\":false,\"dispatchToComponent\":null,\"extraAttributes\":[],\"icon\":null,\"iconPosition\":\"before\",\"iconSize\":null,\"isOutlined\":false,\"isDisabled\":false,\"label\":\"Buka Detail\",\"shouldClose\":false,\"shouldMarkAsRead\":false,\"shouldMarkAsUnread\":false,\"shouldOpenUrlInNewTab\":false,\"size\":\"sm\",\"tooltip\":null,\"url\":\"http:\\/\\/localhost:8000\\/admin\\/inquiries\\/226\\/edit\",\"view\":\"filament-actions::link-action\"}],\"body\":\"Budi Santoso mengirim konsultasi untuk Paket Wisata 5D2N Jakarta \\u2013 Bandung \\u2013 Yogyakarta (15 orang).\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-shopping-bag\",\"iconColor\":\"success\",\"status\":null,\"title\":\"Permintaan Pesanan Baru!\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}',NULL,'2026-10-31 19:43:02','2026-10-31 19:43:02');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prt_is_active_order_idx` (`is_active`,`order`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners` VALUES (1,'SMKN 1 WAY KENANGA','Instansi Pendidikan','partners/jlwnTzzhFVJwBcvZbQN6k9zYiSpurCHZd7FwlN5C.png',1,1,'2026-10-26 22:57:57','2026-10-29 01:57:00'),(11,'SMK & POLTEKKES FARMASI KESUMA BANGSA','Instansi Pendidikan','partners/8ev0lRn2LgHb9coVsnTzmoTTHLKzoV3Qpu28g3oL.jpg',2,1,'2026-10-29 04:54:40','2026-10-29 04:54:40'),(12,'SMKN 2 BANDAR LAMPUNG','Instansi Pendidikan','partners/MvHMoz76X2YJQyZopmwAHyCWvsSNEWdUqERXt6ww.webp',3,1,'2026-10-29 04:55:25','2026-10-29 04:55:25'),(13,'SMKN 1 PENAWARTAMA','Instansi Pendidikan','partners/ZAR8h0YqD0fvoOApybvPazA5McZtygOIAmIi3By3.webp',4,1,'2026-10-29 04:56:04','2026-10-29 04:56:04'),(14,'DWP KAB. MESUJI','Organisasi','partners/ZZbzmVm3cdCW6Qg0Tq45f47Nhr94yWRP4PvVXP9z.png',4,1,'2026-10-29 04:57:19','2026-10-29 04:57:19'),(15,'SMK PELITA MADANI','Instansi Pendidikan','partners/EhZgNTBCT8856lXxsv7O23HgtS9iCDxxmboELfGr.png',0,1,'2026-10-29 04:57:59','2026-10-29 04:57:59'),(16,'SMKN 1 BANDAR LAMPUNG','Instansi Pendidikan','partners/PgPnTdC1ZWaRZINvWfHXokxC2UIUiIW9Cl3d2dox.png',0,1,'2026-10-29 04:58:41','2026-10-29 04:58:41'),(17,'SMKN 7 BANDAR LAMPUNG','Instansi Pendidikan','partners/nakMaLocNFPIjPw7eNhXRFUosXr1GaewpTY3fWKq.webp',0,1,'2026-10-29 04:59:25','2026-10-29 04:59:25'),(18,'SMKN 1 WAY TENONG','Instansi Pendidikan','partners/yBOcM9RZB1Cy2vvnrIwV6iIUP8EjdZT0dUnivCR2.webp',0,1,'2026-10-29 04:59:45','2026-10-29 04:59:45'),(19,'SMKN 1 KOTA BUMI','Instansi Pendidikan','partners/mod0qldaUfmLBIkSm2ZOzZvVzA1kxgo5WglfuaEi.webp',0,1,'2026-10-29 05:00:23','2026-10-29 05:00:23'),(20,'SMKN 1 SUKOHARJO','Instansi Pendidikan','partners/ZncgnbvTxVFDgJ4aCliMH6LudL2Ecn8WwJlvStQZ.webp',0,1,'2026-10-29 05:00:40','2026-10-29 05:00:40'),(21,'SMKN 1 SIMPANG PEMATANG','Instansi Pendidikan','partners/SQakHhFgPzy9C1Y7EdHfWacbvtgOVBZTVjbaq7Ie.jpg',0,1,'2026-10-29 05:01:14','2026-10-29 05:01:14'),(22,'SMKN 2 TANJUNG RAYA','Instansi Pendidikan','partners/j3VNuKkjkEKDfVttMNBiqjBmvowo8rwhES8BUWlM.webp',0,1,'2026-10-29 05:01:30','2026-10-29 05:01:30'),(23,'SD IT AR RAUF BANDAR LAMPUNG','Instansi Pendidikan','partners/suyOZjFp6mucsPgWPjELc0DHzD3wskGtMJMnUQ17.png',0,1,'2026-10-29 05:03:05','2026-10-29 05:03:05'),(24,'SMKN 1 RAMAN UTARA','Instansi Pendidikan','partners/XsApi7gCU1g28TeBfTEg6Vc33PauZRcQeVwLwzuG.webp',0,1,'2026-10-29 05:03:53','2026-10-29 05:03:53'),(25,'SMKN 4 BANDAR LAMPUNG','Instansi Pendidikan','partners/kVT4nGgIe4mq9l82xqwjN7wgRlQ2uK0JNi4nbJli.webp',0,1,'2026-10-29 05:04:50','2026-10-29 05:04:50');
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_images` json DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tim Nirwana',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_category_id_foreign` (`category_id`),
  KEY `pst_is_pub_pub_at_idx` (`is_published`,`published_at`),
  KEY `posts_is_featured_index` (`is_featured`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,NULL,'Tips Wisata','5 Tips Snorkeling Aman dan Menyenangkan di Pulau Pahawang','5-tips-snorkeling-aman-di-pulau-pahawang','Panduan lengkap bagi pemula agar pengalaman snorkeling melihat terumbu karang dan nemo di Pahawang tetap aman, nyaman, dan ramah lingkungan.','Pulau Pahawang terkenal dengan keindahan terumbu karang dan taman ikannya. Sebelum menceburkan diri ke laut, berikut 5 tips penting yang perlu Anda perhatikan: 1. Selalu gunakan pelampung (life jacket) yang terkancing pas di badan. 2. Periksa masker snorkeling agar tidak bocor dan gunakan teknik defogging sederhana. 3. Jangan pernah menginjak atau memegang karang hidup. 4. Gunakan tabir surya (sunscreen) yang ramah terumbu karang (reef-safe). 5. Selalu ikuti arahan tour guide dan jangan berenang sendirian menjauhi kelompok kapal.','assets/images/destinasi/pahawang.jpg',NULL,'Tim Nirwana',1,1,'2026-10-23 06:19:29','2026-10-26 22:57:57','2026-10-28 06:19:29'),(2,NULL,'Panduan Wisata','Waktu Terbaik Menyaksikan Atraksi Lumba-lumba di Teluk Kiluan','waktu-terbaik-menyaksikan-lumba-lumba-teluk-kiluan','Ketahui jam dan musim paling pas untuk melihat ratusan lumba-lumba melompat bebas di perairan Samudera Hindia Teluk Kiluan.','Teluk Kiluan adalah salah satu titik pertemuan kawanan lumba-lumba terbesar di Indonesia. Waktu terbaik untuk memulai perjalanan jukung ke laut lepas adalah pukul 06.00 hingga 08.00 pagi saat laut masih tenang dan ikan-ikan kecil naik ke permukaan. Musim kemarau (April hingga Oktober) merupakan momen ideal dengan cuaca cerah dan ombak yang ramah.','assets/images/destinasi/kiluan.jpg',NULL,'Tim Nirwana',1,1,'2026-10-16 06:19:29','2026-10-26 22:57:57','2026-10-28 06:19:30'),(3,NULL,'Transportasi Bus','Panduan Lengkap Memilih Armada Bus Pariwisata untuk Rombongan Sekolah','panduan-memilih-bus-pariwisata-rombongan-sekolah','Faktor keselamatan, legalitas izin trayek, dan fasilitas yang wajib diperiksa pihak sekolah sebelum menyewa bus study tour.','Keselamatan siswa adalah prioritas utama setiap kegiatan study tour. Pastikan perusahaan otobus memiliki izin resmi SPIONAM Kemenhub, uji berkala KIR aktif, driver berpengalaman memiliki SIM resmi, serta fasilitas kenyamanan memadai seperti rem darurat, APAR, dan palu pemecah kaca.','assets/images/destinasi/jakarta-bandung.jpg',NULL,'Tim Nirwana',1,1,'2026-10-08 06:19:29','2026-10-26 22:57:57','2026-10-28 06:19:30'),(4,NULL,'Spot Foto','Eksotisme Karang Purba Pantai Gigi Hiu: Panduan dan Spot Foto Terbaik','eksotisme-karang-purba-pantai-gigi-hiu-panduan-spot-foto','Panduan lengkap berwisata ke tebing karang runcing nan magis Pantai Gigi Hiu Kelumbayan, mulai dari rute akses hingga waktu pasang surut terbaik.','Pantai Gigi Hiu di Kecamatan Kelumbayan, Tanggamus, dikenal sebagai salah satu lanskap alam paling dramatis di Indonesia. Gugusan tebing karang yang menjulang runcing bagaikan deretan gigi hiu purba menjadi daya tarik utama bagi fotografer dan pecinta petualangan. Untuk mencapai lokasi ini dengan aman, gunakan kendaraan berpenggerak 4x4 atau sewa pemandu lokal yang memahami jalur pesisir pantai. Momen terbaik berkunjung adalah saat matahari terbit (sunrise) atau senja menjelang terbenam, saat deburan ombak Samudera Hindia membentur batuan karang menghasilkan kabut air yang dramatis. Jangan lupa membawa alas kaki anti-selip dan kamera terlindung dari cipratan air asin.','assets/images/destinasi/gigi-hiu.jpg',NULL,'Tim Nirwana',1,0,'2026-10-26 06:19:29','2026-10-27 20:51:16','2026-10-28 06:19:30'),(5,NULL,'Study Tour','Paket Study Tour Edukasi ke Jogja & Bandung: Persiapan Matang untuk Sekolah','paket-study-tour-edukasi-jogja-bandung-persiapan-sekolah','Kiat menyusun agenda karya wisata edukatif untuk siswa sekolah ke Yogyakarta dan Bandung yang aman, berwawasan, dan sarat nilai sejarah.','Study tour sekolah adalah momen pembelajaran berharga di luar ruang kelas. Saat merencanakan perjalanan siswa ke destinasi edukatif seperti Candi Prambanan di Jogja atau Museum Geologi dan Saung Angklung Udjo di Bandung, ada beberapa hal krusial yang perlu dipersiapkan secara matang: 1. Penyusunan Lembar Kerja Siswa (LKPD) agar kunjungan memiliki target capaian edukatif yang jelas. 2. Pemilihan biro perjalanan wisata berizin resmi yang menyediakan asuransi perjalanan, tenaga medis pendamping, dan armada bus berstandar kelaikan jalan Kemenhub. 3. Manajemen jadwal istirahat yang seimbang agar kesehatan fisik siswa tetap terjaga selama perjalanan lintas pulau.','assets/images/destinasi/jogja.jpg',NULL,'Tim Nirwana',1,0,'2026-10-27 06:19:29','2026-10-27 20:51:16','2026-10-28 06:19:30'),(6,NULL,'Gathering','Tips Memilih Paket Outbound & Family Gathering Perusahaan di Lampung','tips-memilih-paket-outbound-family-gathering-perusahaan-lampung','Cara merancang acara gathering kantor dan team building di resort pesisir Lampung yang menyenangkan, kompak, dan berkesan untuk seluruh karyawan.','Gathering kantor merupakan investasi penting untuk menyegarkan pikiran karyawan sekaligus mempererat sinergi antardivisi. Kawasan pesisir Lampung menawarkan banyak pilihan resort tepi pantai yang sangat ideal untuk kegiatan outdoor team building, gala dinner malam keakraban, hingga fun games di atas pasir putih. Pastikan Anda memilih event organizer perjalanan yang menyediakan fasilitator fun games profesional, sound system memadai, perlengkapan medis darurat, serta dokumentasi foto dan video drone untuk mengabadikan momen kebersamaan perusahaan Anda.','assets/images/destinasi/krui.jpg',NULL,'Tim Nirwana',1,0,'2026-10-28 06:19:29','2026-10-27 20:51:16','2026-10-28 06:19:30'),(15,16,'Kunjungan Industri','Kunjungan Industri SMKN 1 Bandar Lampung - Nirwana Tour Travel Lampung','kunjungan-industri-smkn-1-bandar-lampung-nirwana-tour-travel-lampung','SMKN 1 Bandar Lampung memulai perjalanan Kunjungan Industri menuju Yogyakarta bersama Nirwana Tour & Travel. Perjalanan edukatif untuk menambah wawasan, memperluas pengalaman, dan menciptakan kenangan berkesan bagi para siswa.','<h1>ROAD TO JOGJAKARTA! ✨🚌</h1><p>Bismillah, perjalanan baru dimulai!</p><p>Nirwana Tour &amp; Travel kembali dipercaya menjadi mitra perjalanan dalam kegiatan <strong>Kunjungan Industri SMKN 1 Bandar Lampung menuju Yogyakarta</strong>.</p><p>Perjalanan ini bukan sekadar kegiatan wisata, tetapi juga menjadi kesempatan berharga bagi para siswa untuk menambah wawasan, memperluas pengalaman, serta mengenal lebih dekat dunia industri dan lingkungan pendidikan di luar daerah.</p><p>Dengan semangat dan antusiasme, seluruh peserta memulai perjalanan menuju Kota Yogyakarta, membawa harapan untuk mendapatkan pengalaman baru yang bermanfaat.</p><p>Kami dari Nirwana Tour &amp; Travel mengucapkan selamat menikmati perjalanan. Semoga seluruh rangkaian kegiatan berjalan dengan lancar, aman, nyaman, dan penuh cerita berkesan.</p><p><strong>Terima kasih kepada SMKN 1 Bandar Lampung atas kepercayaan yang telah diberikan kepada Nirwana Tour &amp; Travel.</strong></p><p>Sampai jumpa di Yogyakarta! 🤩</p><p><strong>Nirwana Tour &amp; Travel</strong><br>Partner Perjalanan Anda, Menuju Pengalaman Terbaik!</p><p><br></p>','posts/duIVtPJ9PaipVI0nffuVvnIFaJ82b9ztz4SKJ5Yr.png',NULL,'Admin Nirwana',1,1,'2026-10-31 03:12:34','2026-10-30 20:20:49','2026-10-30 20:20:49'),(21,16,'Kunjungan Industri','Belajar Membatik di Batik Benang Ratu Yogyakarta - SMK N 1 Bandar Lampung','belajar-membatik-di-batik-benang-ratu-yogyakarta-smk-n-1-bandar-lampung','Memasuki hari kedua Kunjungan Industri SMKN 1 Bandar Lampung di Yogyakarta, para siswa berkesempatan mengenal dan belajar proses membatik di Batik Benang Ratu. Pengalaman edukatif yang seru bersama Nirwana Tour & Travel.','<h1>DAY 2 ROAD TO JOGJA! 🚌✨</h1><p>Perjalanan berlanjut, pengalaman semakin bertambah! 💕</p><p>Memasuki hari kedua Kunjungan Industri SMKN 1 Bandar Lampung di Yogyakarta, kali ini para peserta mendapatkan pengalaman menarik dengan mengunjungi <strong>Batik Benang Ratu</strong>.</p><p>Tidak hanya berkunjung, para siswa juga berkesempatan mengenal lebih dekat budaya batik Indonesia dan belajar secara langsung mengenai proses pembuatan batik. Mulai dari mengenal motif hingga mencoba pengalaman membatik yang menjadi bagian dari warisan budaya Nusantara.</p><p>Kegiatan ini menjadi momen berharga untuk menambah wawasan, mengembangkan kreativitas, serta menumbuhkan rasa cinta terhadap budaya Indonesia.</p><p>Bersama <strong>Nirwana Tour &amp; Travel</strong>, setiap perjalanan bukan hanya tentang destinasi, tetapi juga tentang pengalaman, kebersamaan, dan cerita indah yang akan selalu dikenang.</p><p>Terima kasih kepada SMKN 1 Bandar Lampung atas kepercayaannya.</p><p><strong>Nirwana Tour &amp; Travel — Bahagia Sepenuh Hati!</strong> 💕❤️</p><p>#NirwanaTourTravel #RoadToJogja #KunjunganIndustri #SMKN1BandarLampung #BatikBenangRatu #WisataEdukasi #Jogjakarta</p><p><br></p>','posts/AdUNPwwlm1plbSJNvBQ5ZEgvhMJInBFr3CsVgQMv.jpg','[]','Admin Nirwana',1,1,'2026-10-30 20:45:14','2026-10-30 20:46:25','2026-10-31 19:22:16');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fa-solid fa-map-location-dot',
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `full_description` longtext COLLATE utf8mb4_unicode_ci,
  `features` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`),
  KEY `srv_is_active_order_idx` (`is_active`,`order`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Paket Wisata Domestik & Lampung','paket-wisata-domestik-lampung','fa-solid fa-umbrella-beach','Eksplorasi destinasi unggulan Lampung, Jawa, Bali, dan Lombok dengan pilihan trip private maupun open trip bersama keluarga dan sahabat.','Kami mengorganisir paket tour komprehensif mulai dari tiket destinasi, reservasi hotel, kapal penyeberangan, konsumsi kuliner khas, hingga pemandu wisata lokal berlisensi.','[\"Pilihan One Day Trip & Menginap\", \"Jadwal Fleksibel (Custom Itinerary)\", \"Harga All-In Tanpa Biaya Tersembunyi\", \"Dokumentasi Foto & Video Trip\"]',NULL,1,1,'2026-10-26 22:57:57','2026-10-26 22:57:57'),(2,'Study Tour & Field Trip Sekolah','study-tour-field-trip-sekolah','fa-solid fa-graduation-cap','Perjalanan edukatif interaktif untuk siswa TK, SD, SMP, SMA, dan mahasiswa dengan kurikulum pembelajaran luar kelas yang terarah dan aman.','Dirancang khusus untuk institusi pendidikan dengan prioritas keselamatan siswa, asuransi perjalanan, pendampingan tour leader berpengalaman, dan koordinasi instansi.','[\"Kunjungan Museum & Pusat Sains\", \"Konservasi Way Kambas & Edukasi Lingkungan\", \"Worksheet & Panduan Edukatif\", \"Gratis untuk Guru Pendamping (S&K Berlaku)\"]',NULL,2,1,'2026-10-26 22:57:57','2026-10-26 22:57:57'),(3,'Family Gathering & Corporate Event','family-gathering-corporate-event','fa-solid fa-users-gear','Program penguatan tim (outbound teambuilding), family gathering perusahaan, gala dinner, dan kunjungan kerja kedinasan yang berkesan.','Solusi lengkap bagi perusahaan, BUMN, perbankan, dan instansi pemerintah yang membutuhkan manajemen acara outbound, fun games, sound system, MC profesional, dan hadiah.','[\"Fasilitator Outbound Berpengalaman\", \"Spanduk & Kaos Seragam Trip\", \"Gala Dinner & Hiburan Musik\", \"Laporan Pertanggungjawaban & Faktur Pajak Resmi\"]',NULL,3,1,'2026-10-26 22:57:57','2026-10-26 22:57:57'),(4,'Sewa Bus & Transportasi Pariwisata','sewa-bus-transportasi-pariwisata','fa-solid fa-bus','Layanan carter armada pariwisata modern: Toyota HiAce, Elf Long, Medium Bus, hingga Big Bus Jetbus SHD dengan driver profesional dan ramah.','Pilihan armada transportasi terawat dengan uji kelayakan berkala (KIR), fasilitas pendingin AC super sejuk, audio karaoke, USB charger tiap bangku, dan reclining seat empuk.','[\"Armada Keluaran Terbaru\", \"Driver Berpengalaman & Paham Rute\", \"Asuransi Jasa Raharja\", \"Harga Sewa Kompetitif Termasuk BBM\"]',NULL,4,1,'2026-10-26 22:57:57','2026-10-26 22:57:57');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'site_name','Site Name','general','Nirwana Tour Lampung','2026-10-26 22:57:57','2026-10-26 22:57:57'),(2,'tagline','Tagline & Subjudul SEO Beranda','general','Biro Wisata, Paket Tour & Sewa Bus Terpercaya','2026-10-26 22:57:57','2026-10-31 18:28:35'),(3,'whatsapp_number','Nomor WhatsApp Resmi (Tombol Navbar & Chat)','general','628999999999','2026-10-26 22:57:57','2026-10-31 19:43:44'),(4,'phone','Phone','general','0822-6961-6188','2026-10-26 22:57:57','2026-10-27 07:24:25'),(5,'email','Email','general','info@nirwanatour.com','2026-10-26 22:57:57','2026-10-26 22:57:57'),(6,'address','Address','general','Jl. Pangeran Antasari No. 88, Kedamaian, Kota Bandar Lampung, Lampung 35122','2026-10-26 22:57:57','2026-10-26 22:57:57'),(7,'instagram','Instagram','general','https://www.instagram.com/nirwana_tourlampung/?utm_source=ig_web_button_share_sheet','2026-10-26 22:57:57','2026-10-27 07:24:25'),(8,'tiktok','Tiktok','general','https://www.tiktok.com/@nirwana_tour_travel?is_from_webapp=1&sender_device=pc','2026-10-26 22:57:57','2026-10-27 07:24:25'),(10,'youtube','Youtube','general','https://youtube.com/@nirwanatourlampung?si=ZMFi9b5dvpn0NKfr','2026-10-26 22:57:57','2026-10-27 08:35:35'),(11,'operating_hours','Operating Hours','general','Senin - Sabtu: 08:00 - 17:00 WIB','2026-10-26 22:57:57','2026-10-26 22:57:57'),(12,'hero_title','Hero Title','general','Jelajahi Dunia, Ciptakan Cerita','2026-10-26 22:57:57','2026-10-26 22:57:57'),(13,'hero_subtitle','Hero Subtitle','general','Biro perjalanan wisata resmi berizin di Bandar Lampung. Kami melayani paket tour Lampung, Jawa, Bali, study tour sekolah, family gathering kantor, dan sewa bus pariwisata eksekutif.','2026-10-26 22:57:57','2026-10-26 22:57:57'),(14,'about_company','Ringkasan Profil Perusahaan','about','Nirwana Tour Lampung adalah biro perjalanan wisata berizin resmi (TDUP & NIB) yang telah berpengalaman lebih dari 8 tahun mendampingi ribuan wisatawan lokal maupun nusantara mengeksplorasi keindahan alam dan budaya Indonesia dengan pelayanan standar V.I.P yang aman, nyaman, dan berkesan.','2026-10-26 22:57:57','2026-10-29 05:39:20'),(15,'google_analytics_id','Google Analytics Id','general','','2026-10-29 03:48:02','2026-11-01 02:56:07'),(16,'meta_pixel_id','Meta Pixel Id','general','','2026-10-29 03:48:02','2026-11-01 02:56:07'),(17,'google_site_verification','Google Site Verification','general','','2026-10-29 03:48:02','2026-11-01 02:56:07'),(18,'google_maps_review_url','Tautan Google Maps Review','social_proof','https://maps.google.com/?q=Nirwana+Tour+Lampung','2026-10-29 03:48:02','2026-10-29 03:48:02'),(19,'google_maps_rating','Rating Bintang Google Maps','social_proof','4.9','2026-10-29 03:48:02','2026-10-29 03:48:02'),(20,'google_maps_reviews_count','Jumlah Ulasan Google Maps','social_proof','250+','2026-10-29 03:48:02','2026-10-29 03:48:02'),(21,'owner_name','Nama Pemilik / Founder','about','Kiki M Alfin','2026-10-29 05:39:20','2026-10-29 05:39:20'),(22,'owner_role','Jabatan & Masa Berdiri','about','Pimpinan & Founder - Nirwana Tour Lampung • Sejak 2022','2026-10-29 05:39:20','2026-10-29 06:56:32'),(23,'owner_quote','Kutipan Sambutan Pemilik','about','Selamat datang di Nirwana Tour Lampung. Bagi kami, setiap perjalanan bukan sekadar mengantar Anda ke destinasi, melainkan sebuah amanah untuk menghadirkan rasa aman, kenyamanan prima, dan kenangan indah yang abadi bersama orang-orang tercinta.','2026-10-29 05:39:20','2026-10-29 05:39:20'),(24,'owner_photo','Foto Pemilik / Founder','about','settings/6DOr3906drwWiwa9KyQ71QGv1VMVZ5IRelfHqBDl.png','2026-10-29 05:39:20','2026-10-30 21:15:24'),(25,'about_description','Deskripsi Detail Profil Perusahaan','about','Dengan pengalaman lebih dari 8 tahun, kami telah melayani ribuan pelanggan mulai dari keluarga, sekolah, universitas, instansi pemerintahan, hingga BUMN & perusahaan swasta nasional. Setiap rencana perjalanan kami susun secara terstruktur dengan pemandu berlisensi dan armada transportasi pariwisata terawat.','2026-10-29 05:39:20','2026-10-29 05:39:20'),(26,'stat_years_count','Statistik: Tahun Pengalaman (Angka)','about','5','2026-10-29 05:39:20','2026-10-29 06:54:39'),(27,'stat_years_label','Statistik: Tahun Pengalaman (Label)','about','Tahun Pengalaman','2026-10-29 05:39:20','2026-10-29 05:39:20'),(28,'stat_trips_count','Statistik: Trip Terlaksana (Angka)','about','100+','2026-10-29 05:39:20','2026-10-29 06:54:01'),(29,'stat_trips_label','Statistik: Trip Terlaksana (Label)','about','Trip Terlaksana','2026-10-29 05:39:20','2026-10-29 05:39:20'),(30,'stat_satisfaction_count','Statistik: Kepuasan Pelanggan (Angka)','about','99','2026-10-29 05:39:20','2026-10-29 05:39:20'),(31,'stat_satisfaction_label','Statistik: Kepuasan Pelanggan (Label)','about','Kepuasan Pelanggan','2026-10-29 05:39:20','2026-10-29 05:39:20'),(32,'stat_legal_count','Statistik: Legalitas Resmi (Angka)','about','100+','2026-10-29 05:39:20','2026-10-29 06:52:16'),(33,'stat_legal_label','Statistik: Legalitas Resmi (Label)','about','Legalitas Resmi','2026-10-29 05:39:20','2026-10-29 05:39:20'),(34,'google_maps_embed_url','Google Maps Embed URL (Iframe)','general','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127118.81423406987!2d105.18788934440026!3d-5.419086111369344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40da4290c58e77%3A0xb696f5341cf60f4e!2sBandar%20Lampung%2C%20Kota%20Bandar%20Lampung%2C%20Lampung!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid','2026-10-31 18:03:51','2026-10-31 18:03:51');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_members`
--

LOCK TABLES `team_members` WRITE;
/*!40000 ALTER TABLE `team_members` DISABLE KEYS */;
INSERT INTO `team_members` VALUES (1,'Kiki M Alfin','Pimpinan & Founder Nirwana Tour Lampung','Direksi','team/atLGiTwngaGd1usxcK50lq5fXfnHnTxfVB57Uk9X.png',NULL,NULL,NULL,NULL,1,1,'2026-10-28 22:16:51','2026-10-30 19:07:37'),(2,'Tim Tour Leader & Guide','Head Tour Guide @ HPI Lampung','Operasional','assets/images/galeri/galeri-1.jpg',NULL,NULL,NULL,NULL,2,1,'2026-10-28 22:16:51','2026-10-28 22:16:51'),(3,'Koordinator Wisata Bahari','Marine Safety Specialist @ Teluk Lampung','Operasional','assets/images/galeri/galeri-3.jpg',NULL,NULL,NULL,NULL,3,1,'2026-10-28 22:16:51','2026-10-28 22:16:51'),(4,'Konsultan Wisata & Reservasi','Customer Care & Trip Planner @ Nirwana Tour','Layanan Pelanggan','assets/images/galeri/galeri-5.jpg',NULL,NULL,NULL,NULL,4,1,'2026-10-28 22:16:51','2026-10-28 22:16:51');
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` tinyint unsigned NOT NULL DEFAULT '5',
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trip_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tst_is_active_order_idx` (`is_active`,`order`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Drs. Hendra Setiawan, M.Pd.','SMA Negeri 2 Bandar Lampung','Wakil Kepala Sekolah Bidang Kesiswaan',5,'Study tour 180 siswa kami ke Yogyakarta dan Bandung berjalan sangat rapi, tepat waktu, dan aman. Driver bus sangat sabar dan tour leader Nirwana Tour sigap melayani kebutuhan siswa dari awal penyeberangan hingga pulang.',NULL,'Study Tour Jogja-Bandung 2025',1,1,'2026-10-26 22:57:57','2026-10-26 22:57:57'),(2,'Ratna Dewi Kusuma','Divisi HRD Bank Mandiri Area Lampung','Ketua Panitia Gathering',5,'Family gathering tahunan karyawan di Pulau Pahawang sangat sukses! Games outbound-nya seru, makanan seafood-nya melimpah dan segar, serta dokumentasi drone dan foto underwater-nya keren banget. Recommended!',NULL,'Company Gathering Pahawang',1,2,'2026-10-26 22:57:57','2026-10-26 22:57:57'),(3,'Budi Prasetyo, S.T.','Ikatan Alumni Universitas Lampung','Ketua Rombongan',5,'Pelayanan sewa bus pariwisatanya istimewa. Kondisi armada Big Bus Jetbus sangat bersih, AC dingin, dan suspensi empuk untuk perjalanan jauh ke Bromo-Malang. Tidak ada kendala teknis sama sekali.',NULL,'Reuni & Trip Bromo Malang',1,3,'2026-10-26 22:57:57','2026-10-26 22:57:57'),(4,'Siti Nurhaliza & Keluarga','Wisatawan Asal Palembang','Family Trip',5,'Pertama kali bawa anak-anak ke Teluk Kiluan melihat lumba-lumba liar. Pelayanannya sangat ramah, homestay bersih dan pemandunya sangat teliti menjaga keselamatan kami di laut.',NULL,'Private Trip Teluk Kiluan',1,4,'2026-10-26 22:57:57','2026-10-26 22:57:57'),(5,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-28 23:01:16','2026-10-28 23:01:16'),(6,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-28 23:01:37','2026-10-28 23:01:37'),(7,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-28 23:02:24','2026-10-28 23:02:24'),(8,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-28 23:02:58','2026-10-28 23:02:58'),(9,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-28 23:03:40','2026-10-28 23:03:40'),(10,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-28 23:04:57','2026-10-28 23:04:57'),(11,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-28 23:49:30','2026-10-28 23:49:30'),(12,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 01:18:27','2026-10-29 01:18:27'),(13,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 01:33:23','2026-10-29 01:33:23'),(14,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 01:38:25','2026-10-29 01:38:25'),(15,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 01:43:12','2026-10-29 01:43:12'),(16,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 01:52:40','2026-10-29 01:52:40'),(17,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 02:41:48','2026-10-29 02:41:48'),(18,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 03:02:06','2026-10-29 03:02:06'),(19,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 03:08:22','2026-10-29 03:08:22'),(20,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 03:09:03','2026-10-29 03:09:03'),(21,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 03:16:29','2026-10-29 03:16:29'),(22,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 03:37:25','2026-10-29 03:37:25'),(23,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 03:38:08','2026-10-29 03:38:08'),(24,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 03:50:30','2026-10-29 03:50:30'),(25,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 03:51:27','2026-10-29 03:51:27'),(26,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 03:51:58','2026-10-29 03:51:58'),(27,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 04:02:58','2026-10-29 04:02:58'),(28,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 04:03:54','2026-10-29 04:03:54'),(29,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 04:04:10','2026-10-29 04:04:10'),(30,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 04:13:20','2026-10-29 04:13:20'),(31,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 04:40:06','2026-10-29 04:40:06'),(32,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 04:46:01','2026-10-29 04:46:01'),(33,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 04:53:09','2026-10-29 04:53:09'),(34,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 06:47:57','2026-10-29 06:47:57'),(35,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 06:53:42','2026-10-29 06:53:42'),(36,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 08:08:51','2026-10-29 08:08:51'),(37,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 08:17:56','2026-10-29 08:17:56'),(38,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 11:21:10','2026-10-29 11:21:10'),(39,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-29 11:29:05','2026-10-29 11:29:05'),(40,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 18:09:54','2026-10-30 18:09:54'),(41,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 18:19:00','2026-10-30 18:19:00'),(42,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 18:31:53','2026-10-30 18:31:53'),(43,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 18:42:08','2026-10-30 18:42:08'),(44,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 18:50:23','2026-10-30 18:50:23'),(45,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 18:55:58','2026-10-30 18:55:58'),(46,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 19:10:25','2026-10-30 19:10:25'),(47,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 19:28:06','2026-10-30 19:28:06'),(48,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 19:42:21','2026-10-30 19:42:21'),(49,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 19:54:11','2026-10-30 19:54:11'),(50,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 20:05:25','2026-10-30 20:05:25'),(51,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 20:16:41','2026-10-30 20:16:41'),(52,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 20:42:00','2026-10-30 20:42:00'),(53,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 21:06:31','2026-10-30 21:06:31'),(54,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-30 21:13:32','2026-10-30 21:13:32'),(55,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-31 17:58:43','2026-10-31 17:58:43'),(56,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-31 18:13:38','2026-10-31 18:13:38'),(57,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-31 18:20:34','2026-10-31 18:20:34'),(58,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-31 18:31:40','2026-10-31 18:31:40'),(59,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-31 18:48:58','2026-10-31 18:48:58'),(60,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-31 19:13:08','2026-10-31 19:13:08'),(61,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-10-31 19:43:39','2026-10-31 19:43:39'),(62,'Ahmad Faisal','PT Mitra Sejahtera Lampung','Ketua Panitia Gathering',5,'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',NULL,'Family Gathering Pahawang 2D1N',0,99,'2026-11-01 02:56:00','2026-11-01 02:56:00');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_packages`
--

DROP TABLE IF EXISTS `tour_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour_packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_from` bigint unsigned NOT NULL DEFAULT '0',
  `duration_days` int NOT NULL DEFAULT '1',
  `duration_nights` int NOT NULL DEFAULT '0',
  `min_pax` int NOT NULL DEFAULT '1',
  `summary` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `itinerary` json DEFAULT NULL,
  `includes` json DEFAULT NULL,
  `excludes` json DEFAULT NULL,
  `faqs` json DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery` json DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tour_packages_slug_unique` (`slug`),
  KEY `tour_packages_category_id_foreign` (`category_id`),
  KEY `tp_is_active_order_idx` (`is_active`,`order`),
  KEY `tp_is_active_featured_idx` (`is_active`,`is_featured`),
  CONSTRAINT `tour_packages_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_packages`
--

LOCK TABLES `tour_packages` WRITE;
/*!40000 ALTER TABLE `tour_packages` DISABLE KEYS */;
INSERT INTO `tour_packages` VALUES (1,11,'Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta','paket-wisata-5d2n-jakarta-bandung-yogyakarta','Terfavorit','Jakarta, Bandung, Yogyakarta',2500000,5,2,30,'Jelajahi tiga destinasi populer Indonesia dalam satu perjalanan seru selama 5 hari 2 malam! Nikmati wisata ikonik Jakarta, keindahan alam dan kuliner Bandung, serta pesona budaya dan sejarah Yogyakarta dengan perjalanan yang nyaman bersama rombongan.','<h2>Paket Wisata 5D2N Jakarta – Bandung – Yogyakarta</h2><p>Nikmati pengalaman liburan yang berkesan dengan paket wisata 5 hari 2 malam menjelajahi tiga kota populer di Indonesia, yaitu Jakarta, Bandung, dan Yogyakarta. Paket ini dirancang untuk rombongan keluarga, perusahaan, sekolah, komunitas, maupun instansi yang ingin menikmati perjalanan wisata dengan beragam pilihan destinasi.</p><p>Perjalanan dimulai di Jakarta dengan mengunjungi ikon ibu kota, kawasan bersejarah, dan tempat wisata populer. Selanjutnya, perjalanan menuju Bandung untuk menikmati suasana kota yang sejuk, wisata alam, pusat oleh-oleh, dan kuliner khas Sunda.</p><p>Petualangan dilanjutkan ke Yogyakarta, kota yang terkenal dengan kekayaan budaya, warisan sejarah, kerajinan lokal, serta kuliner tradisionalnya. Anda dapat menikmati suasana Malioboro, mengunjungi kawasan Candi Prambanan, dan menjelajahi destinasi pilihan lainnya sesuai jadwal perjalanan.</p><p>Dengan pilihan destinasi yang beragam, paket ini menjadi alternatif liburan untuk menikmati wisata perkotaan, alam, belanja, kuliner, dan budaya dalam satu perjalanan.</p><p><strong>Keunggulan Paket:</strong></p><ul><li>Mengunjungi tiga kota populer dalam satu perjalanan.</li><li>Pilihan destinasi wisata sejarah, alam, budaya, dan belanja.</li><li>Cocok untuk rombongan sekolah, keluarga, perusahaan, dan komunitas.</li><li>Itinerary terjadwal untuk membantu perjalanan lebih terorganisasi.</li><li>Pilihan fasilitas transportasi, penginapan, dan konsumsi sesuai paket yang disepakati.</li></ul><p><strong>Informasi Paket:</strong></p><ul><li>Durasi perjalanan: 5 hari 2 malam.</li><li>Destinasi: Jakarta, Bandung, dan Yogyakarta.</li><li>Harga: Mulai dari Rp2.500.000 per orang (estimasi).</li><li>Jumlah peserta: Menyesuaikan ketentuan pemesanan.</li><li>Jadwal dan titik keberangkatan: Dikonfirmasi saat pemesanan.</li></ul><p><em>Catatan: Destinasi, hotel, transportasi, konsumsi, tiket masuk, dan rincian harga akhir menyesuaikan kesepakatan dengan penyedia jasa wisata.</em></p><p><br></p>','[{\"day\": 1, \"title\": \"Eksplorasi ibu kota\", \"activities\": \"Hari 1 — Wisata Jakarta\\n\\n- 07.00 — Berkumpul dan persiapan keberangkatan.\\n- 09.00 — Mengunjungi Monumen Nasional (Monas).\\n- 11.30 — Makan siang.\\n- 13.00 — Wisata Kota Tua Jakarta.\\n- 15.30 — Berbelanja atau menikmati kawasan wisata pilihan.\\n- 18.00 — Makan malam dan persiapan perjalanan berikutnya.\"}, {\"day\": \"2\", \"title\": \"Wisata Bandung Alam, kuliner, dan oleh-oleh\", \"activities\": \"Hari 2 — Wisata Bandung ,Alam, kuliner, dan oleh-oleh\\n- 06.00 — Perjalanan menuju Bandung.\\n- 09.00 — Mengunjungi kawasan wisata Lembang.\\n- 12.00 — Makan siang dengan kuliner khas Sunda.\\n- 13.30 — Wisata dan berfoto di destinasi pilihan.\\n- 16.00 — Berbelanja oleh-oleh khas Bandung.\\n- 19.00 — Makan malam dan istirahat.\"}, {\"day\": \"3\", \"title\": \"Menuju Yogyakarta Perjalanan dan wisata kota\", \"activities\": \"Hari 3 — Menuju Yogyakarta Perjalanan dan wisata kota\\n- 06.00 — Sarapan dan persiapan keberangkatan.\\n- 07.00 — Perjalanan menuju Yogyakarta.\\n- 12.00 — Istirahat dan makan siang.\\n- 15.00 — Mengunjungi kawasan pusat kota.\\n- 17.00 — Wisata belanja dan menikmati suasana Malioboro.\\n- 19.00 — Makan malam dan check-in penginapan jika termasuk paket.\"}, {\"day\": \"4\", \"title\": \"Wisata Budaya Yogyakarta Sejarah dan budaya\", \"activities\": \"Hari 4 — Wisata Budaya Yogyakarta Sejarah dan budaya\\n- 07.00 — Sarapan.\\n- 08.00 — Mengunjungi Candi Prambanan.\\n- 11.30 — Makan siang.\\n- 13.00 — Mengunjungi Keraton Yogyakarta atau destinasi budaya pilihan.\\n- 15.30 — Berburu oleh-oleh khas Yogyakarta.\\n- 18.00 — Makan malam dan persiapan perjalanan pulang.\"}, {\"day\": \"5\", \"title\": \"Perjalanan Pulang Penutupan perjalanan\", \"activities\": \"Hari 5 — Perjalanan Pulang Penutupan perjalanan\\n- 07.00 — Sarapan dan persiapan check-out.\\n- 08.00 — Waktu bebas atau kunjungan singkat jika memungkinkan.\\n- 10.00 — Persiapan perjalanan kembali.\\n- 12.00 — Makan siang sesuai pengaturan paket.\\n- 13.00 — Perjalanan menuju kota tujuan.\\n- Selesai — Trip berakhir sesuai titik pengantaran yang disepakati.\"}]','[\"Bus pariwisata ber-AC sesuai kapasitas rombongan\", \"Transportasi selama perjalanan sesuai itinerary\", \"Penginapan selama 2 malam sesuai ketentuan paket\", \"Makan sesuai jadwal dan kesepakatan\", \"Tour leader atau pemandu perjalanan\", \"Air mineral selama perjalanan jika disediakan\", \"Biaya parkir dan operasional kendaraan jika termasuk paket\", \"Dokumentasi perjalanan jika tersedia\"]','[\"Makanan dan minuman di luar ketentuan paket\", \"Biaya aktivitas tambahan\", \"Upgrade kamar atau fasilitas hotel\", \"Biaya tambahan akibat perubahan itinerary atau permintaan khusus\"]','[]','packages/iJr690U6Qukrjw5za7FUZRAne4hAlwt6cu5rNIlA.png',NULL,1,1,1,'2026-10-26 22:57:57','2026-10-29 05:25:37'),(10,12,'Paket Study Tour Sekolah 3D2N Jakarta – Bandung','paket-study-tour-sekolah-3d2n-jakarta-bandung','Favorit Sekolah','Jakarta dan Bandung',1850000,3,2,30,'Jadikan kegiatan belajar di luar kelas lebih menyenangkan melalui Paket Study Tour Sekolah 3 Hari 2 Malam ke Jakarta dan Bandung. Kunjungi destinasi edukasi, wisata sejarah, pusat ilmu pengetahuan, serta tempat wisata pilihan yang memberikan pengalaman belajar dan kebersamaan bagi siswa dan guru.','<h3>Paket Study Tour Sekolah 3D2N Jakarta – Bandung</h3><p>Wujudkan pengalaman belajar yang menyenangkan melalui Paket Study Tour Sekolah 3 Hari 2 Malam dengan destinasi Jakarta dan Bandung. Paket ini dirancang untuk mendukung kegiatan pembelajaran di luar kelas melalui kunjungan edukatif, pengenalan sejarah, ilmu pengetahuan, budaya, dan pengalaman sosial bagi siswa.</p><p>Di Jakarta, peserta dapat mengunjungi Monumen Nasional (Monas) untuk mengenal sejarah perjuangan bangsa serta destinasi edukasi pilihan lainnya. Perjalanan kemudian dilanjutkan ke Bandung, kota yang menawarkan beragam tempat wisata edukasi, suasana alam yang menarik, serta pusat oleh-oleh khas daerah.</p><p>Kegiatan study tour menjadi kesempatan bagi siswa untuk memperluas wawasan, melatih kemandirian, meningkatkan interaksi sosial, dan mempererat hubungan antara siswa dan guru.</p><p><strong>Keunggulan Paket:</strong></p><ul><li>Menggabungkan wisata edukasi dan rekreasi.</li><li>Cocok untuk SD, SMP, SMA/SMK, dan rombongan pendidikan.</li><li>Itinerary terjadwal untuk memudahkan koordinasi sekolah.</li><li>Transportasi rombongan sesuai kesepakatan.</li><li>Pilihan destinasi dapat disesuaikan dengan kebutuhan pembelajaran.</li></ul><p><strong>Informasi Paket:</strong></p><ul><li>Durasi perjalanan: 3 hari 2 malam.</li><li>Destinasi: Jakarta dan Bandung.</li><li>Harga mulai: Rp1.850.000 per orang.</li><li>Minimal peserta: 30 orang.</li><li>Keberangkatan: Menyesuaikan lokasi sekolah dan kesepakatan penyelenggara.</li></ul><p>Harga dan fasilitas akhir dikonfirmasi berdasarkan titik keberangkatan, jumlah peserta, pilihan penginapan, tiket masuk destinasi, dan kebutuhan pendampingan rombongan.</p><p><br></p>','[{\"day\": 1, \"title\": \"Wisata Edukasi Jakarta Sejarah dan wawasan kebangsaan\", \"activities\": \"Hari 1 — Wisata Edukasi Jakarta\\nSejarah dan wawasan kebangsaan\\n- 05.00 — Persiapan dan keberangkatan dari titik kumpul.\\n- 09.00 — Tiba di Jakarta dan istirahat.\\n- 10.00 — Kunjungan ke Monumen Nasional (Monas).\\n- 12.00 — Makan siang.\\n- 13.00 — Wisata Kota Tua Jakarta.\\n- 16.00 — Perjalanan menuju penginapan.\\n- 18.00 — Makan malam dan check-in hotel.\"}, {\"day\": \"2\", \"title\": \"Wisata Edukasi Bandung Ilmu pengetahuan dan rekreasi\", \"activities\": \"Hari 2 — Wisata Edukasi Bandung\\nIlmu pengetahuan dan rekreasi\\n- 06.00 — Sarapan dan persiapan.\\n- 07.00 — Check-out dan perjalanan menuju Bandung.\\n- 10.00 — Kunjungan ke Museum Geologi Bandung.\\n- 12.00 — Makan siang.\\n- 13.30 — Wisata edukasi atau rekreasi di destinasi pilihan.\\n- 16.00 — Belanja oleh-oleh khas Bandung.\\n- 18.00 — Makan malam dan check-in penginapan.\"}, {\"day\": \"3\", \"title\": \"Wisata Kota Bandung & Pulang Budaya, arsitektur, dan penutupan\", \"activities\": \"Hari 3 — Wisata Kota Bandung & Pulang\\nBudaya, arsitektur, dan penutupan\\n- 06.00 — Sarapan dan persiapan check-out.\\n- 08.00 — Kunjungan ke kawasan Gedung Sate untuk wisata luar atau kunjungan sesuai akses.\\n- 10.00 — Waktu belanja atau kunjungan singkat.\\n- 12.00 — Makan siang.\\n- 13.00 — Persiapan perjalanan pulang.\\n- Sore/malam — Tiba di titik pengantaran sesuai jarak dan kondisi perjalanan.\"}]','[\"Bus pariwisata ber-AC sesuai kapasitas rombongan\", \"Transportasi selama kegiatan sesuai itinerary\", \"Penginapan 2 malam sesuai ketentuan paket\", \"Makan sesuai jadwal yang disepakati\", \"Tour leader atau koordinator perjalanan\", \"Tiket masuk destinasi yang tercantum dalam paket\", \"Air mineral selama perjalanan jika disediaka\"]','[\"Transportasi dari rumah menuju titik keberangkatan\", \"Pengeluaran pribadi siswa dan pendamping\", \"Makanan dan minuman di luar jadwal paket\", \"Biaya aktivitas tambahan di luar itinerary\", \"Pembelian oleh-oleh\", \"Upgrade kamar dan fasilitas tambahan\", \"Tip pengemudi atau tour leader jika tidak tercakup\", \"Biaya tambahan akibat perubahan itinerary atau permintaan khusus\"]','[{\"answer\": \"Paket dapat disesuaikan untuk SD, SMP, SMA/SMK, maupun rombongan pendidikan lainnya.\", \"question\": \"1. Paket ini cocok untuk jenjang sekolah apa?\"}, {\"answer\": \"Estimasi harga mulai Rp1.850.000 per orang untuk rombongan minimal 30 peserta. Harga final perlu dikonfirmasi setelah fasilitas dan titik keberangkatan ditentukan.\", \"question\": \"2. Berapa harga paket study tour per siswa?\"}, {\"answer\": \"Ya. Jumlah guru dan pendamping perlu dimasukkan dalam perhitungan kapasitas bus, kamar, konsumsi, dan biaya paket.\", \"question\": \"3. Apakah guru dan pendamping dapat ikut?\"}, {\"answer\": \"Bisa. Destinasi dapat disesuaikan dengan tujuan pembelajaran, anggaran, dan waktu yang tersedia.\", \"question\": \"4. Apakah sekolah dapat memilih destinasi sendiri?\"}]','packages/tOd7FbPll9M87qpVcpne83gwdXOL82xN1MJsIDMz.png',NULL,1,1,2,'2026-10-29 05:24:47','2026-10-29 05:26:08'),(11,12,'Paket Wisata 6D2N Bromo – Malang','paket-wisata-6d2n-bromo-malang','Terfavorit','Bromo, Malang, Jawa Timur',3099994,6,2,30,'Jelajahi pesona Gunung Bromo dan keindahan Kota Malang dalam perjalanan wisata 6 hari 2 malam. Nikmati panorama matahari terbit, lautan pasir, kawah Bromo, udara sejuk pegunungan, wisata alam, serta destinasi rekreasi dan kuliner khas Jawa Timur dalam satu perjalanan berkesan.','<h2>Paket Wisata 6D2N Bromo – Malang</h2><p>Rasakan pengalaman liburan yang mengesankan melalui Paket Wisata 6 Hari 2 Malam Bromo – Malang. Paket ini menghadirkan perpaduan wisata alam, petualangan pegunungan, rekreasi keluarga, dan eksplorasi destinasi populer di Jawa Timur.</p><p>Perjalanan menawarkan kesempatan untuk menikmati keindahan Gunung Bromo, mulai dari panorama matahari terbit, hamparan lautan pasir, hingga pemandangan kawah yang menjadi daya tarik utama kawasan Taman Nasional Bromo Tengger Semeru.</p><p>Petualangan dilanjutkan dengan menjelajahi Kota Malang dan kawasan sekitarnya yang terkenal dengan udara sejuk, taman rekreasi, wisata alam, serta beragam kuliner khas. Peserta juga dapat menikmati suasana Kota Batu dan mengunjungi destinasi pilihan sesuai jadwal perjalanan.</p><p>Paket ini cocok untuk liburan keluarga, rombongan perusahaan, komunitas, maupun perjalanan bersama teman yang ingin menikmati keindahan alam dan wisata Jawa Timur.</p><p><strong>Keunggulan Paket:</strong></p><ul><li>Menjelajahi Gunung Bromo dan destinasi wisata Malang.</li><li>Menikmati panorama matahari terbit dan lautan pasir.</li><li>Pilihan wisata alam, rekreasi, dan kuliner.</li><li>Itinerary terjadwal untuk perjalanan yang lebih terorganisasi.</li><li>Cocok untuk rombongan dengan pilihan fasilitas sesuai kebutuhan.</li></ul><p><strong>Informasi Paket:</strong></p><ul><li>Durasi: 6 hari 2 malam.</li><li>Destinasi: Bromo, Malang, dan Batu.</li><li>Harga mulai: Rp2.750.000 per orang (estimasi).</li><li>Minimal peserta: 20 orang.</li><li>Jadwal dan titik keberangkatan: Menyesuaikan kesepakatan dengan penyedia wisata.</li></ul><p>Harga akhir, transportasi, akomodasi, tiket masuk, dan aktivitas wisata dikonfirmasi berdasarkan titik keberangkatan, jumlah peserta, serta fasilitas yang dipilih.</p><p><br></p>','[{\"day\": 1, \"title\": \"Hari 1 — Keberangkatan\", \"activities\": \"Hari 1 — Keberangkatan\\nPersiapan perjalanan wisata\\n- 06.00 — Berkumpul di titik keberangkatan.\\n- 07.00 — Persiapan dan pengarahan perjalanan.\\n- 08.00 — Memulai perjalanan menuju Jawa Timur.\\n- 12.00 — Istirahat dan makan siang.\\n- 18.00 — Makan malam dan melanjutkan perjalanan sesuai rute.\"}]','[\"Bus pariwisata ber-AC sesuai kapasitas peserta\", \"Penginapan 2 malam sesuai ketentuan paket\", \"Tour leader atau koordinator perjalanan\"]','[\"Makanan dan minuman di luar ketentuan paket\", \"Aktivitas tambahan di luar itinerary\"]','[{\"answer\": \"Harga estimasi mulai Rp2.750.000 per orang untuk rombongan minimal 20 peserta. Harga akhir bergantung pada titik keberangkatan, fasilitas, dan jumlah peserta.\", \"question\": \"1. Berapa harga Paket Wisata 6D2N Bromo – Malang?\"}]','packages/DO4AbnSzL9a8FS9pJWVVVpazh4Ursb1Yl7gSzsun.png',NULL,1,1,2,'2026-10-29 05:36:36','2026-10-29 05:36:36');
/*!40000 ALTER TABLE `tour_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Nirwana Tour','admin@nirwanatour.com','2026-10-26 22:57:57','$2y$12$35jsBsAoOrpCI/YCoeN5IuW1RHoEqxxwZARsoAjPiX79RD/AmXLo2',NULL,'2026-10-26 22:57:57','2026-10-26 22:57:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-01 17:28:34
