-- MySQL dump 10.13  Distrib 5.7.35, for Linux (x86_64)
--
-- Host: localhost    Database: admin_bingo_chevere
-- ------------------------------------------------------
-- Server version	5.7.35-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `campaign_user`
--

DROP TABLE IF EXISTS `campaign_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campaign_user_campaign_id_foreign` (`campaign_id`),
  KEY `campaign_user_user_id_foreign` (`user_id`),
  CONSTRAINT `campaign_user_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE,
  CONSTRAINT `campaign_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_user`
--

LOCK TABLES `campaign_user` WRITE;
/*!40000 ALTER TABLE `campaign_user` DISABLE KEYS */;
INSERT INTO `campaign_user` VALUES (1,1,2,NULL,NULL),(2,2,2,NULL,NULL),(3,3,6,NULL,NULL);
/*!40000 ALTER TABLE `campaign_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaigns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_design` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_central` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_register` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cant` int(11) NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaigns`
--

LOCK TABLES `campaigns` WRITE;
/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;
INSERT INTO `campaigns` VALUES (1,'NAVIDAD','NAVIDEÑO','1628635781_WhatsApp Image 2021-08-06 at 22.14.06.jpeg','','http://bingo.clients.rhino.pe/register?valores=2-1',79,'#fffbb9','#375719',1,'2021-08-10 22:49:41','2021-08-10 23:26:00'),(2,'HALLOWEEN','DISFRUTA Y CELEBRA','1628636906_WhatsApp Image 2021-08-06 at 22.14.06.jpeg','','http://bingo.clients.rhino.pe/register?valores=2-2',20,'#ff4d00',NULL,1,'2021-08-10 23:08:26','2021-08-10 23:08:26'),(3,'Bingo Show','bingo tottus','1628637074_WhatsApp Image 2021-08-06 at 22.14.06.jpeg','','http://bingo.clients.rhino.pe/register?valores=6-3',500,'#a7f698','#0f6119',1,'2021-08-10 23:11:14','2021-08-10 23:38:29');
/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cartons`
--

DROP TABLE IF EXISTS `cartons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fila1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fila2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fila3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fila4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fila5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cartons_user_id_foreign` (`user_id`),
  CONSTRAINT `cartons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartons`
--

LOCK TABLES `cartons` WRITE;
/*!40000 ALTER TABLE `cartons` DISABLE KEYS */;
INSERT INTO `cartons` VALUES (1,'11,18,42,58,70,BGCH-213','1,20,43,48,61,BGCH-213','2,29,36,51,63,BGCH-213','5,22,31,46,67,BGCH-213','14,17,39,47,74,BGCH-213',3,'2021-08-10 22:58:14','2021-08-10 22:58:14','BGCH-213','1','2'),(2,'7,29,34,47,61,BGCH-214','10,24,36,53,63,BGCH-214','15,19,43,52,62,BGCH-214','13,16,41,50,73,BGCH-214','2,25,38,54,69,BGCH-214',4,'2021-08-10 23:04:57','2021-08-10 23:04:57','BGCH-214','1','2'),(3,'1,20,40,56,73,BGCH-215','11,22,38,48,65,BGCH-215','10,26,31,49,75,BGCH-215','9,17,37,47,74,BGCH-215','15,24,33,53,71,BGCH-215',5,'2021-08-10 23:05:51','2021-08-10 23:05:51','BGCH-215','1','2'),(4,'7,19,35,56,72,BGCH-217','2,18,31,51,67,BGCH-217','3,23,34,54,61,BGCH-217','4,20,36,46,73,BGCH-217','10,21,38,48,66,BGCH-217',7,'2021-08-10 23:09:38','2021-08-10 23:09:38','BGCH-217','1','2'),(5,'7,22,32,50,71,BGCH-638','10,26,33,57,74,BGCH-638','3,24,45,56,66,BGCH-638','14,23,42,51,70,BGCH-638','4,28,43,48,63,BGCH-638',8,'2021-08-10 23:12:13','2021-08-10 23:12:13','BGCH-638','3','6'),(6,'8,26,32,58,71,BGCH-639','10,22,33,52,66,BGCH-639','9,29,37,57,74,BGCH-639','14,30,38,49,69,BGCH-639','7,23,42,55,70,BGCH-639',9,'2021-08-10 23:13:49','2021-08-10 23:13:49','BGCH-639','3','6'),(7,'8,21,44,47,64,BGCH-6310','13,18,36,50,74,BGCH-6310','6,22,38,53,61,BGCH-6310','9,20,42,59,75,BGCH-6310','7,29,43,49,71,BGCH-6310',10,'2021-08-10 23:26:16','2021-08-10 23:26:16','BGCH-6310','3','6');
/*!40000 ALTER TABLE `cartons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2021_07_14_213913_create_sessions_table',1),(7,'2021_07_14_214814_create_roles_table',1),(8,'2021_07_14_214920_create_role_user_table',1),(9,'2021_07_22_062846_create_campaigns_table',1),(10,'2021_07_22_065459_create_campaign_user_table',1),(11,'2021_08_07_012331_create_cartons_table',1),(12,'2021_08_10_190148_add_codigo_to_cartons',1),(13,'2021_08_10_191153_add_campaign_id_to_cartons',1),(14,'2021_08_10_191214_add_empresa_id_to_cartons',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,NULL,NULL),(2,2,2,NULL,NULL),(3,3,3,NULL,NULL),(4,3,4,NULL,NULL),(5,3,5,NULL,NULL),(6,2,6,NULL,NULL),(7,3,7,NULL,NULL),(8,3,8,NULL,NULL),(9,3,9,NULL,NULL),(10,3,10,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'superadmin','superadmin','2021-08-10 22:16:38','2021-08-10 22:16:38'),(2,'client','client','2021-08-10 22:16:38','2021-08-10 22:16:38'),(3,'user','user','2021-08-10 22:16:38','2021-08-10 22:16:38');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
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
INSERT INTO `sessions` VALUES ('6LOXbyykYLkHCsYp69pdHglGMII1nyTZepjnejol',NULL,'67.205.138.241','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGF1TkRxU1ExQ09zbjBzN1prRjQwcFJHYzZmaDFXbVlBS3VnaVNVSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9iaW5nby5jbGllbnRzLnJoaW5vLnBlIjt9fQ==',1628637272),('tiANbsKdB2nqiFRT0uPAzG8PFf6ORFBExQpdEyht',1,'67.205.138.241','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.2 Safari/605.1.15','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUzA5b21jdWpsRkhFc1JubGRKQnFFNE1QMWcxZlNldVN3MU5ScWRXZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9iaW5nby5jbGllbnRzLnJoaW5vLnBlL2FkbWluL2NsaWVudGVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJGYzV2VHMnRYdGxKckcwVm9uZVd6N2V5eGYwUzV4cnFyanNQOUl4SDRpYU1NcENlTmRWOU4uIjt9',1628638027),('VwDhj90kd9q0dO9H5FEhBuj5WRtCiNt7ShWPUxXS',10,'67.205.138.241','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNDV2eDJOeE5vYkdkTzhyVFFTS1d3VlFVdmJhbm1JQk5ySFRRa2U1dSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9iaW5nby5jbGllbnRzLnJoaW5vLnBlL2FkbWluL2NsaWVudGVzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRqMHJVWW5HNTk5WC5DSGY1Y3hDT0x1Q3ZuRG8ueGVHL2kuZnByRnNxNVNmbGQ2TlhoQWtGYSI7fQ==',1628643847);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `parent_id` int(11) DEFAULT NULL,
  `campania_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `logo_cliente` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_comercial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contacto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Alex Barbier','alex@gmail.com',NULL,'$2y$10$f3WeG2tXtlJrG0VoneWz7eyxf0S5xrqrjsP9IxH4iaMMpCeNdV9N.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'2021-08-10 22:16:38','2021-08-10 22:16:38'),(2,'QUIMICA SUIZA','alexbarbierbenites@gmail.com',NULL,'$2y$10$FP8q9.8aXnINff2.o17MMOT8NZE/D0ZMKMvjVdQm/rSm45IUE6lIO',NULL,NULL,1,NULL,NULL,NULL,NULL,1,'1628635735_LOGO-LAP-EXT-Small.jpg','QUIMICA SUIZA','20523887459','CLAUDIA','RRHH','987987743','2021-08-10 22:48:55','2021-08-10 22:48:55'),(3,'Lorena Fernandez','lore@alexbarbierb.com',NULL,'$2y$10$Qk8uNgTUHD.tByiDy/s.eOsRw9UQ/HMRvv/tOIln0E40xpuxFhx0K',NULL,NULL,2,1,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'2021-08-10 22:50:42','2021-08-10 22:50:42'),(4,'Fiorella Rondon','fiore@alexbarbierb.com',NULL,'$2y$10$SEwNOy00djb2IuhLMnTvfO3g0hJ3TAm/BLk9OWUz2kRTp7jZmZzZ2',NULL,NULL,2,1,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'2021-08-10 23:04:44','2021-08-10 23:04:44'),(5,'Pedro Vargas','ventas@alexbarbierb.com',NULL,'$2y$10$zmd2NeRUDy9.WiO26sGr9eBMXEo5Kii.hQZ21QwHSBysGdOopmz2C',NULL,NULL,2,1,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'2021-08-10 23:05:37','2021-08-10 23:05:37'),(6,'TOTTUS','INFO@TOTTUS.COM.PE',NULL,'$2y$10$2/tUU/.MXz3ZJCof61hN3O6A35zVK6ev5CXUgmFRQeME9lGkrhhwq',NULL,NULL,1,NULL,NULL,NULL,NULL,1,'1628636858_Taller Niños iconos-07.png','TOTTUS','20988863234','CARLOS','RRHH','988763453','2021-08-10 23:07:38','2021-08-10 23:07:38'),(7,'JESUS AVILA','VENTAS2@ALEXBARBIERB.COM',NULL,'$2y$10$JDBqzKc3YjUdjFjCprjrO.UNlOCNQYsJKkofA1Ymsv09or/l2OYRS',NULL,NULL,2,2,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'2021-08-10 23:09:11','2021-08-10 23:09:11'),(8,'Juan Carlos','carloscaverastegui@gmail.com',NULL,'$2y$10$FJJnF56H8Qz0p8p8Vz..2OjtBkdEWMe/YDM1m9Ucq7ypKDl6yMHXe',NULL,NULL,6,3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'2021-08-10 23:11:51','2021-08-10 23:11:51'),(9,'Cesar Huamancha','cesar-123@hotmail.com',NULL,'$2y$10$GiGa5xvnCdXaV8r6b2Ek/OpfxLDYJsoZZoOBMjeWv0hUcm8aK9.wu',NULL,NULL,6,3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'2021-08-10 23:13:36','2021-08-10 23:13:36'),(10,'Julio','julio@gmail.com',NULL,'$2y$10$j0rUYnG599X.CHf5cxCOLuCvnDo.xeG/i.fprFsq5Sfld6NXhAkFa',NULL,NULL,6,3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'2021-08-10 23:21:15','2021-08-10 23:21:15');
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

-- Dump completed on 2021-08-16  4:23:55
