
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `freeze_transactions` WRITE;
/*!40000 ALTER TABLE `freeze_transactions` DISABLE KEYS */;
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
INSERT INTO `options` VALUES (1,'min_deposit','10','2023-08-09 14:03:58','2023-08-09 14:03:58'),(2,'deposit_fees','1','2023-08-09 14:03:58','2023-08-09 14:03:58'),(3,'withdraw_fees','5','2023-08-09 14:03:58','2023-08-09 14:03:58'),(4,'networkCap','3','2023-08-09 14:03:58','2023-08-09 14:03:58'),(5,'rewards_auto','1','2023-08-09 14:03:58','2023-08-09 14:03:58'),(6,'freeze_transaction_duration','-15','2023-08-09 14:03:58','2023-08-09 14:03:58'),(7,'daily_roi_network_x','2','2023-08-09 14:03:58','2023-08-09 14:03:58');
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
INSERT INTO `plan_profits` VALUES (1,1,0.75,10,7,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(2,2,1,12,10,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(3,3,1,15,12,'2023-08-09 14:03:58','2023-08-09 14:03:58');
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
INSERT INTO `plans` VALUES (1,'Silver Package',25,499,0.75,1,1,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(2,'Gold Package',500,9999,1,1.25,1,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(3,'Diamond Package',10000,1000000,1,1.5,1,'2023-08-09 14:03:58','2023-08-09 14:03:58');
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
INSERT INTO `posts` VALUES (1,'The Basics of Forex Trading: A Beginner\'s Guide','In this introductory blog post, we cover the fundamental concepts of forex trading, making it an ideal starting point for newcomers to the world of currency trading. From understanding forex markets and currency pairs to learning how to read forex quotes and execute trades, this guide will provide beginners with the essential knowledge and terminology to embark on their forex trading journey confidently.',NULL,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(2,'Mastering Technical Analysis for Forex Trading','Technical analysis is a powerful tool in the arsenal of successful forex traders. This blog post delves into the world of technical analysis, exploring popular indicators, chart patterns, and price action techniques that help identify trends, entry and exit points, and potential market reversals. Whether you\'re a seasoned trader or a beginner, this comprehensive guide will equip you with the skills to interpret charts and make well-informed trading decisions based on technical insights.',NULL,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(3,'Risk Management: Safeguarding Your Forex Investments','Risk management is the backbone of profitable forex trading. This post emphasizes the significance of implementing a robust risk management strategy to protect your capital and maintain steady growth. We delve into position sizing, setting stop-loss orders, and understanding leverage, empowering traders to minimize potential losses and optimize risk-to-reward ratios. Learn how to stay disciplined, protect your investments, and preserve your trading account for sustained success in the dynamic forex market.',NULL,'2023-08-09 14:03:58','2023-08-09 14:03:58');
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
INSERT INTO `rewards` VALUES (1,'PROMINENCE',3000,200,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(2,'EMPYREAN',10000,500,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(3,'PINNACLE',25000,1000,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(4,'ELITE',50000,2000,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(5,'APEX',100000,5000,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(6,'SOVEREIGN',250000,10000,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(7,'LUMINARY',500000,20000,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(8,'ECHELON',3000000,50000,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(9,'SUPREME',10000000,100000,'2023-08-09 14:03:58','2023-08-09 14:03:58');
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,1,'Deposit',1000,1,'Admin Action',1,NULL,NULL,'2023-08-09 15:51:58','2023-08-09 15:51:58'),(2,2,'Deposit',1000,1,'Admin Action',1,NULL,NULL,'2023-08-09 15:52:05','2023-08-09 15:52:05'),(3,3,'Deposit',1000,1,'Admin Action',1,NULL,NULL,'2023-08-09 15:52:11','2023-08-09 15:52:11'),(4,4,'Deposit',1000,1,'Admin Action',1,NULL,NULL,'2023-08-09 15:52:18','2023-08-09 15:52:18'),(5,5,'Deposit',1000,1,'Admin Action',1,NULL,NULL,'2023-08-09 15:52:29','2023-08-09 15:52:29'),(6,1,'Plan Active',1000,1,'Plan: Gold Package Activated',0,NULL,NULL,'2023-08-09 15:52:55','2023-08-09 15:52:55'),(7,2,'Plan Active',1000,1,'Plan: Gold Package Activated',0,NULL,NULL,'2023-08-09 15:52:59','2023-08-09 15:52:59'),(8,1,'Direct Commission',120,1,'Direct Commision from: test1',1,NULL,1,'2023-08-09 15:52:59','2023-08-09 15:52:59'),(9,3,'Plan Active',1000,1,'Plan: Gold Package Activated',0,NULL,NULL,'2023-08-09 15:53:03','2023-08-09 15:53:03'),(10,1,'Direct Commission',120,1,'Direct Commision from: test2',1,NULL,1,'2023-08-09 15:53:03','2023-08-09 15:53:03'),(11,1,'Binary Commission',100,1,'Binary Matching Commission From: test2, Phone: 21235465645, Sponser: admin',1,NULL,1,'2023-08-09 15:53:03','2023-08-09 15:53:03'),(12,4,'Plan Active',1000,1,'Plan: Gold Package Activated',0,NULL,NULL,'2023-08-09 15:53:08','2023-08-09 15:53:08'),(13,1,'Direct Commission',120,1,'Direct Commision from: test3',1,NULL,1,'2023-08-09 15:53:08','2023-08-09 15:53:08'),(14,5,'Plan Active',1000,1,'Plan: Gold Package Activated',0,NULL,NULL,'2023-08-09 15:54:09','2023-08-09 15:54:09'),(15,2,'Direct Commission',120,1,'Direct Commision from: test4',1,NULL,2,'2023-08-09 15:54:09','2023-08-09 15:54:09'),(16,6,'Deposit',1000,1,'Admin Action',1,NULL,NULL,'2023-08-09 15:54:51','2023-08-09 15:54:51'),(17,6,'Plan Active',1000,1,'Plan: Gold Package Activated',0,NULL,NULL,'2023-08-09 15:54:59','2023-08-09 15:54:59'),(18,1,'Direct Commission',120,1,'Direct Commision from: test5',1,NULL,1,'2023-08-09 15:54:59','2023-08-09 15:54:59'),(19,7,'Deposit',1000,1,'Admin Action',1,NULL,NULL,'2023-08-09 15:56:00','2023-08-09 15:56:00'),(20,7,'Plan Active',1000,1,'Plan: Gold Package Activated',0,NULL,NULL,'2023-08-09 15:56:08','2023-08-09 15:56:08'),(21,1,'Direct Commission',120,1,'Direct Commision from: test6',1,NULL,1,'2023-08-09 15:56:08','2023-08-09 15:56:08'),(22,1,'Binary Commission',100,1,'Binary Matching Commission From: test6, Phone: 45345444444, Sponser: admin',1,NULL,1,'2023-08-09 15:56:08','2023-08-09 15:56:08'),(23,8,'Deposit',1000,1,'Admin Action',1,NULL,NULL,'2023-08-09 16:01:54','2023-08-09 16:01:54'),(24,8,'Plan Active',1000,1,'Plan: Gold Package Activated',0,NULL,NULL,'2023-08-09 16:01:59','2023-08-09 16:01:59'),(25,3,'Direct Commission',120,1,'Direct Commision from: test7',1,NULL,3,'2023-08-09 16:01:59','2023-08-09 16:01:59'),(26,9,'Deposit',1000,1,'Admin Action',1,NULL,NULL,'2023-08-09 16:03:04','2023-08-09 16:03:04'),(27,9,'Plan Active',1000,1,'Plan: Gold Package Activated',0,NULL,NULL,'2023-08-09 16:03:11','2023-08-09 16:03:11'),(28,3,'Direct Commission',120,1,'Direct Commision from: test8',1,NULL,3,'2023-08-09 16:03:11','2023-08-09 16:03:11'),(29,3,'Binary Commission',100,1,'Binary Matching Commission From: test8, Phone: 03043212487, Sponser: test2',1,NULL,3,'2023-08-09 16:03:11','2023-08-09 16:03:11'),(30,1,'Binary Commission',200,1,'Binary Matching Commission From: test8, Phone: 03043212487, Sponser: test2',1,NULL,1,'2023-08-09 16:03:11','2023-08-09 16:03:11');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `user_plans` WRITE;
/*!40000 ALTER TABLE `user_plans` DISABLE KEYS */;
INSERT INTO `user_plans` VALUES (1,1,2,1000,'active','2023-08-09 15:52:55','2023-08-09 15:52:55'),(2,2,2,1000,'active','2023-08-09 15:52:59','2023-08-09 15:52:59'),(3,3,2,1000,'active','2023-08-09 15:53:03','2023-08-09 15:53:03'),(4,4,2,1000,'active','2023-08-09 15:53:08','2023-08-09 15:53:08'),(5,5,2,1000,'active','2023-08-09 15:54:09','2023-08-09 15:54:09'),(6,6,2,1000,'active','2023-08-09 15:54:59','2023-08-09 15:54:59'),(7,7,2,1000,'active','2023-08-09 15:56:08','2023-08-09 15:56:08'),(8,8,2,1000,'active','2023-08-09 16:01:59','2023-08-09 16:01:59'),(9,9,2,1000,'active','2023-08-09 16:03:11','2023-08-09 16:03:11');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin','admin@test.com','03001212123','Pakistan','$2y$10$5yxHfYD2FgVC7U.NIWgzteGi32kWe2F1At2ArejkEvO8dcFDQDgty','default','left','active',2,3,'2023-08-09 14:03:58','admin',4000,0,NULL,'2023-08-09 14:03:58','2023-08-09 16:03:11'),(2,'test1','test1','test1@gmail.com','13132131321','asdf','$2y$10$MP7bxiIKuH4CWYBAjt0DE.LFkh/6mIZKDx67MpY8yfCjuGHVCR.2a','admin','left','active',4,NULL,NULL,'user',0,0,NULL,'2023-08-09 14:04:19','2023-08-09 15:52:59'),(3,'test2','test2','test2@gmail.com','21235465645','sadf','$2y$10$ItU59T23Ig0db6MWAyLDeO2IQ1yz1wiUrrbcc2H/9VeVWugKKudlW','admin','right','active',9,7,NULL,'user',1000,0,NULL,'2023-08-09 14:04:30','2023-08-09 16:03:11'),(4,'test3','test3','test3@gmail.com','12316498797','sadf','$2y$10$3UKrykCEcpvrvgMe0tFHV.GRcRscrHVxw/FraMtHrN0QcdkVmTwL.','admin','left','active',5,NULL,NULL,'user',0,0,NULL,'2023-08-09 14:04:45','2023-08-09 15:53:08'),(5,'test4','test4','test4@gmail.com','12316547987','asf','$2y$10$I2bMld3yFH61.cxLq50QL.AJhrA4cHFozM3ZpuOi6Oftc0aunvI9a','test1','left','active',6,NULL,NULL,'user',0,0,NULL,'2023-08-09 14:05:09','2023-08-09 15:54:40'),(6,'test5','test5','test5@gmail.com','45363523452','LKJLS','$2y$10$bEOxuocJSm6QKxqbfVhkUOgUpFguYipN8gSYt5mTMJsXe0ftBSAs2','admin','left','active',NULL,NULL,NULL,'user',0,0,NULL,'2023-08-09 15:54:40','2023-08-09 15:54:59'),(7,'test6','test6','test6@gmail.com','45345444444','sdf','$2y$10$HPkDtAhxt2zxpkw34ydUt.f.23u4KiosIQ3bJQ5h4waQHxVLyPSw.','admin','right','active',NULL,8,NULL,'user',0,0,NULL,'2023-08-09 15:55:48','2023-08-09 16:01:48'),(8,'test7','test7','test7@gmail.com','01321231655','Pakistan','$2y$10$ENNxNog9SSyJDsg92iKCtOuek7oh4nF9tprQTxk6DWgxSoorZzYHq','test2','right','active',NULL,NULL,NULL,'user',0,0,NULL,'2023-08-09 16:01:48','2023-08-09 16:01:59'),(9,'test8','test8','test8@gmail.com','03043212487','asdfasdf','$2y$10$tZ6vX0rFBxzmIvsS7WcnWubldXIfka7ZovCp0xK3RsluEjWnMZQQq','test2','left','active',NULL,NULL,NULL,'user',0,0,NULL,'2023-08-09 16:02:50','2023-08-09 16:03:11');
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
INSERT INTO `wallets` VALUES (1,'USDT','Tether','kwejrlwjer2l3kj4l2j34ljl','usdt.png','1',1,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(2,'BTC','Bitcoin','kwejrlwjer2l3kj4l2j34ljl','bitcoin.png','1',1,'2023-08-09 14:03:58','2023-08-09 14:03:58'),(3,'TRX','TRON','kwejrlwjer2l3kj4l2j34ljl','trx.png','1',1,'2023-08-09 14:03:58','2023-08-09 14:03:58');
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

