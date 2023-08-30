
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `contact_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_forms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `contact_forms` WRITE;
/*!40000 ALTER TABLE `contact_forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_forms` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `freeze_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `freeze_transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `freeze_transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `freeze_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `freeze_transactions` WRITE;
/*!40000 ALTER TABLE `freeze_transactions` DISABLE KEYS */;
INSERT INTO `freeze_transactions` VALUES (1,1,'Freeze Balance',120,'2023-08-09 12:35:01','2023-08-09 12:35:01'),(2,1,'Freeze Balance',1420,'2023-08-09 12:35:01','2023-08-09 12:35:01');
/*!40000 ALTER TABLE `freeze_transactions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_07_27_120945_create_posts_table',1),(6,'2023_07_27_140922_create_newslatters_table',1),(7,'2023_07_28_083431_create_contact_forms_table',1),(8,'2023_08_01_130509_create_withdraws_table',1),(9,'2023_08_01_133107_create_wallets_table',1),(10,'2023_08_01_141107_create_options_table',1),(11,'2023_08_01_180256_create_plans_table',1),(12,'2023_08_01_185431_create_user_plans_table',1),(13,'2023_08_01_194253_create_transactions_table',1),(14,'2023_08_02_121152_create_tids_table',1),(15,'2023_08_02_200340_create_plan_profits_table',1),(16,'2023_08_03_181148_create_freeze_transactions_table',1),(17,'2023_08_05_192158_create_rewards_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `newslatters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newslatters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `newslatters_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `newslatters` WRITE;
/*!40000 ALTER TABLE `newslatters` DISABLE KEYS */;
/*!40000 ALTER TABLE `newslatters` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,'min_deposit','10','2023-08-09 11:52:40','2023-08-09 11:52:40'),(2,'deposit_fees','1','2023-08-09 11:52:40','2023-08-09 11:52:40'),(3,'withdraw_fees','5','2023-08-09 11:52:40','2023-08-09 11:52:40'),(4,'networkCap','3','2023-08-09 11:52:40','2023-08-09 11:52:40'),(5,'rewards_auto','1','2023-08-09 11:52:40','2023-08-09 11:52:40'),(6,'freeze_transaction_duration','-15','2023-08-09 11:52:40','2023-08-09 11:52:40'),(7,'daily_roi_network_x','2','2023-08-09 11:52:40','2023-08-09 11:52:40');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `plan_profits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan_profits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` bigint(20) unsigned NOT NULL,
  `profit` double NOT NULL,
  `direct_commission` double NOT NULL,
  `binary_commission` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plan_profits_plan_id_foreign` (`plan_id`),
  CONSTRAINT `plan_profits_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `plan_profits` WRITE;
/*!40000 ALTER TABLE `plan_profits` DISABLE KEYS */;
INSERT INTO `plan_profits` VALUES (1,1,0.75,10,7,'2023-08-09 11:52:39','2023-08-09 11:52:39'),(2,2,1,12,10,'2023-08-09 11:52:39','2023-08-09 11:52:39'),(3,3,1,15,12,'2023-08-09 11:52:40','2023-08-09 11:52:40');
/*!40000 ALTER TABLE `plan_profits` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `min_price` double NOT NULL,
  `max_price` double NOT NULL,
  `min_profit` double NOT NULL,
  `max_profit` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,'Silver Package',25,499,0.75,1,1,'2023-08-09 11:52:39','2023-08-09 11:52:39'),(2,'Gold Package',500,9999,1,1.25,1,'2023-08-09 11:52:39','2023-08-09 11:52:39'),(3,'Diamond Package',10000,1000000,1,1.5,1,'2023-08-09 11:52:40','2023-08-09 11:52:40');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `body` longtext NOT NULL,
  `img` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'The Basics of Forex Trading: A Beginner\'s Guide','In this introductory blog post, we cover the fundamental concepts of forex trading, making it an ideal starting point for newcomers to the world of currency trading. From understanding forex markets and currency pairs to learning how to read forex quotes and execute trades, this guide will provide beginners with the essential knowledge and terminology to embark on their forex trading journey confidently.',NULL,'2023-08-09 11:52:40','2023-08-09 11:52:40'),(2,'Mastering Technical Analysis for Forex Trading','Technical analysis is a powerful tool in the arsenal of successful forex traders. This blog post delves into the world of technical analysis, exploring popular indicators, chart patterns, and price action techniques that help identify trends, entry and exit points, and potential market reversals. Whether you\'re a seasoned trader or a beginner, this comprehensive guide will equip you with the skills to interpret charts and make well-informed trading decisions based on technical insights.',NULL,'2023-08-09 11:52:40','2023-08-09 11:52:40'),(3,'Risk Management: Safeguarding Your Forex Investments','Risk management is the backbone of profitable forex trading. This post emphasizes the significance of implementing a robust risk management strategy to protect your capital and maintain steady growth. We delve into position sizing, setting stop-loss orders, and understanding leverage, empowering traders to minimize potential losses and optimize risk-to-reward ratios. Learn how to stay disciplined, protect your investments, and preserve your trading account for sustained success in the dynamic forex market.',NULL,'2023-08-09 11:52:40','2023-08-09 11:52:40');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `rewards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rewards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `business` double NOT NULL,
  `reward` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `rewards` WRITE;
/*!40000 ALTER TABLE `rewards` DISABLE KEYS */;
INSERT INTO `rewards` VALUES (1,'PROMINENCE',3000,200,'2023-08-09 11:52:40','2023-08-09 11:52:40'),(2,'EMPYREAN',10000,500,'2023-08-09 11:52:40','2023-08-09 11:52:40'),(3,'PINNACLE',25000,1000,'2023-08-09 11:52:40','2023-08-09 11:52:40'),(4,'ELITE',50000,2000,'2023-08-09 11:52:40','2023-08-09 11:52:40'),(5,'APEX',100000,5000,'2023-08-09 11:52:40','2023-08-09 11:52:40'),(6,'SOVEREIGN',250000,10000,'2023-08-09 11:52:40','2023-08-09 11:52:40'),(7,'LUMINARY',500000,20000,'2023-08-09 11:52:40','2023-08-09 11:52:40'),(8,'ECHELON',3000000,50000,'2023-08-09 11:52:40','2023-08-09 11:52:40'),(9,'SUPREME',10000000,100000,'2023-08-09 11:52:40','2023-08-09 11:52:40');
/*!40000 ALTER TABLE `rewards` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `tids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tids` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `hash_id` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tids_hash_id_unique` (`hash_id`),
  KEY `tids_user_id_foreign` (`user_id`),
  CONSTRAINT `tids_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tids` WRITE;
/*!40000 ALTER TABLE `tids` DISABLE KEYS */;
/*!40000 ALTER TABLE `tids` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `reference` text DEFAULT NULL,
  `sum` tinyint(1) NOT NULL,
  `withdraw_id` bigint(20) unsigned DEFAULT NULL,
  `user_plan_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  KEY `transactions_withdraw_id_foreign` (`withdraw_id`),
  KEY `transactions_user_plan_id_foreign` (`user_plan_id`),
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transactions_user_plan_id_foreign` FOREIGN KEY (`user_plan_id`) REFERENCES `user_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transactions_withdraw_id_foreign` FOREIGN KEY (`withdraw_id`) REFERENCES `withdraws` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,2,'Deposit',1000,1,'Admin Action',1,NULL,NULL,'2023-08-09 11:53:07','2023-08-09 11:53:07'),(2,1,'Deposit',1000,1,'Admin Action',1,NULL,NULL,'2023-08-09 11:57:40','2023-08-09 11:57:40'),(3,1,'Plan Active',1000,1,'Plan: Gold Package Activated',0,NULL,NULL,'2023-08-09 11:57:49','2023-08-09 11:57:49'),(4,2,'Deposit',12000,1,'Admin Action',1,NULL,NULL,'2023-08-09 12:34:04','2023-08-09 12:34:04'),(5,3,'Deposit',13000,1,'Admin Action',1,NULL,NULL,'2023-08-09 12:34:40','2023-08-09 12:34:40'),(6,2,'Plan Active',13000,1,'Plan: Diamond Package Activated',0,NULL,NULL,'2023-08-09 12:34:50','2023-08-09 12:34:50'),(7,1,'Direct Commission',1560,1,'Direct Commision from: test1',1,NULL,1,'2023-08-09 12:34:50','2023-08-09 12:34:50'),(8,3,'Plan Active',13000,1,'Plan: Diamond Package Activated',0,NULL,NULL,'2023-08-09 12:35:01','2023-08-09 12:35:01'),(9,1,'Direct Commission',1560,1,'Direct Commision from: test2',1,NULL,1,'2023-08-09 12:35:01','2023-08-09 12:35:01'),(10,1,'Freeze Balance',120,1,'User Balance Freezed',0,NULL,NULL,'2023-08-09 12:35:01','2023-08-09 12:35:01'),(11,1,'Binary Commission',1300,1,'Binary Matching Commission From: test2, Phone: 34563453434, Sponser: admin',1,NULL,1,'2023-08-09 12:35:01','2023-08-09 12:35:01'),(12,1,'Freeze Balance',1420,1,'User Balance Freezed',0,NULL,NULL,'2023-08-09 12:35:01','2023-08-09 12:35:01');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `user_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `plan_id` bigint(20) unsigned NOT NULL,
  `amount` double NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_plans_user_id_foreign` (`user_id`),
  KEY `user_plans_plan_id_foreign` (`plan_id`),
  CONSTRAINT `user_plans_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_plans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `user_plans` WRITE;
/*!40000 ALTER TABLE `user_plans` DISABLE KEYS */;
INSERT INTO `user_plans` VALUES (1,1,2,1000,'active','2023-08-09 11:57:49','2023-08-09 11:57:49'),(2,2,3,13000,'active','2023-08-09 12:34:50','2023-08-09 12:34:50'),(3,3,3,13000,'active','2023-08-09 12:35:01','2023-08-09 12:35:01');
/*!40000 ALTER TABLE `user_plans` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `refer` varchar(255) NOT NULL DEFAULT 'default',
  `position` varchar(255) NOT NULL DEFAULT 'left',
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `left_user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Team Spillover Left Refers',
  `right_user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Team Spillover Right Refers',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `binary_match` double NOT NULL DEFAULT 0,
  `networker` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_mobile_unique` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin','admin@test.com','03001212123','Pakistan','$2y$10$JMXPNcKh9C5jdxa6nN6SPO0XpIk1ZARwEpOyc5nMmenR4l7rXvjk.','default','left','active',2,3,'2023-08-09 11:52:39','admin',13000,0,NULL,'2023-08-09 11:52:39','2023-08-09 12:35:01'),(2,'test1','test1','test1@gmail.com','32323232323','asdf','$2y$10$pFVuy2oSlF9bHdqUwC9tcuKuao3De4dSQBlRKDT1nvqadjL02IkdG','admin','left','active',NULL,NULL,NULL,'user',0,0,NULL,'2023-08-09 11:52:55','2023-08-09 12:34:50'),(3,'test2','test2','test2@gmail.com','34563453434','Pakistan','$2y$10$TULNQmHlY4FE.C2haO8bcewH2UzOximR.YfAeVOaGrgS2C6JEkpiK','admin','right','active',NULL,NULL,NULL,'user',0,0,NULL,'2023-08-09 12:34:23','2023-08-09 12:35:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `symbol` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `fees` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (1,'USDT','Tether','kwejrlwjer2l3kj4l2j34ljl','usdt.png','1',1,'2023-08-09 11:52:40','2023-08-09 11:52:40'),(2,'BTC','Bitcoin','kwejrlwjer2l3kj4l2j34ljl','bitcoin.png','1',1,'2023-08-09 11:52:40','2023-08-09 11:52:40'),(3,'TRX','TRON','kwejrlwjer2l3kj4l2j34ljl','trx.png','1',1,'2023-08-09 11:52:40','2023-08-09 11:52:40');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `withdraws`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `withdraws` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `amount` double NOT NULL,
  `wallet` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `withdraws_user_id_foreign` (`user_id`),
  CONSTRAINT `withdraws_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `withdraws` WRITE;
/*!40000 ALTER TABLE `withdraws` DISABLE KEYS */;
/*!40000 ALTER TABLE `withdraws` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

