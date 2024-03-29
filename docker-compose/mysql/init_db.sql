/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `ema1s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ema1s` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `date` date NOT NULL,
  `nth_day` int NOT NULL,
  `nth_ema` int NOT NULL DEFAULT '1',
  `nth_popup` int NOT NULL DEFAULT '0',
  `popup_time` timestamp NULL DEFAULT NULL,
  `popup_time1` timestamp NULL DEFAULT NULL,
  `popup_time2` timestamp NULL DEFAULT NULL,
  `attempt_time` timestamp NULL DEFAULT NULL,
  `submit_time` timestamp NULL DEFAULT NULL,
  `time_taken` int DEFAULT NULL,
  `completed` int DEFAULT '8886',
  `1st_reminder` int DEFAULT '8886',
  `2nd_reminder` int DEFAULT '8888',
  `3rd_reminder` int DEFAULT '8888',
  `Q1` int DEFAULT NULL,
  `Q1_1` int DEFAULT '8888',
  `Q1_a` int DEFAULT '8888',
  `Q1_b` int DEFAULT '8888',
  `Q1_c` int DEFAULT '8888',
  `Q2_1a` int DEFAULT '8888',
  `Q2_1b` int DEFAULT '8888',
  `Q2_1c` int DEFAULT '8888',
  `Q2_1d` int DEFAULT '8888',
  `Q2_1e` int DEFAULT '8888',
  `Q2_2f` int DEFAULT '8888',
  `Q2_2g` int DEFAULT '8888',
  `Q2_2h` int DEFAULT '8888',
  `Q2_2i` int DEFAULT '8888',
  `Q2_2j` int DEFAULT '8888',
  `Q2_3k` int DEFAULT '8888',
  `Q2_3l` int DEFAULT '8888',
  `Q2_3m` int DEFAULT '8888',
  `Q2_3n` int DEFAULT '8888',
  `Q2_3o` int DEFAULT '8888',
  `Q3` int DEFAULT '8888',
  `Q3_a` int DEFAULT '8888',
  `Q3_aa` int DEFAULT '8888',
  `Q3_ab` int DEFAULT '8888',
  `Q3_ac` int DEFAULT '8888',
  `Q3_ad` int DEFAULT '8888',
  `Q3_ae` int DEFAULT '8888',
  `Q3_b` int DEFAULT '8888',
  `Q3_ba` int DEFAULT '8888',
  `Q3_bb` int DEFAULT '8888',
  `Q3_bc` int DEFAULT '8888',
  `Q3_bd` int DEFAULT '8888',
  `Q3_be` int DEFAULT '8888',
  `Q3_c` int DEFAULT '8888',
  `Q3_ca` int DEFAULT '8888',
  `Q3_cb` int DEFAULT '8888',
  `Q3_cc` int DEFAULT '8888',
  `Q3_cd` int DEFAULT '8888',
  `Q3_d` int DEFAULT '8888',
  `Q3_da` int DEFAULT '8888',
  `Q3_db` int DEFAULT '8888',
  `Q3_dc` int DEFAULT '8888',
  `Q3_dc_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q3_e` int DEFAULT '8888',
  `Q4` int DEFAULT '8888',
  `Q4_a` int DEFAULT '8888',
  `Q4_b` int DEFAULT '8888',
  `Q4_c` int DEFAULT '8888',
  `Q4_d` int DEFAULT '8888',
  `Q4_e` int DEFAULT '8888',
  `Q4_f` int DEFAULT '8888',
  `Q4_g` int DEFAULT '8888',
  `Q4_g_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q5` int DEFAULT '8888',
  `Q5_a` int DEFAULT '8888',
  `Q5_b` int DEFAULT '8888',
  `Q5_c` int DEFAULT '8888',
  `Q5_d` int DEFAULT '8888',
  `Q5_e` int DEFAULT '8888',
  `Q5_f` int DEFAULT '8888',
  `Q5_g` int DEFAULT '8888',
  `Q5_h` int DEFAULT '8888',
  `Q5_h_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q5_i` int DEFAULT '8888',
  `Q6` int DEFAULT '8888',
  `Q6_1` int DEFAULT '8888',
  `Q6_2` int DEFAULT '8888',
  `Q6_3` int DEFAULT '8888',
  `Q6_4` int DEFAULT '8888',
  `Q7` int DEFAULT '8888',
  `Q7_a` int DEFAULT '8888',
  `Q7_b` int DEFAULT '8888',
  `Q7_c` int DEFAULT '8888',
  `Q8_1a` int DEFAULT '8888',
  `Q8_1b` int DEFAULT '8888',
  `Q8_1c` int DEFAULT '8888',
  `Q8_1d` int DEFAULT '8888',
  `Q8_1e` int DEFAULT '8888',
  `Q8_2f` int DEFAULT '8888',
  `Q8_2g` int DEFAULT '8888',
  `Q8_2h` int DEFAULT '8888',
  `Q8_2i` int DEFAULT '8888',
  `Q8_2j` int DEFAULT '8888',
  `Q8_3k` int DEFAULT '8888',
  `Q8_3l` int DEFAULT '8888',
  `Q8_3m` int DEFAULT '8888',
  `Q8_3n` int DEFAULT '8888',
  `Q8_3o` int DEFAULT '8888',
  `Q9` int DEFAULT '8888',
  `Q9_a` int DEFAULT '8888',
  `Q9_aa` int DEFAULT '8888',
  `Q9_ab` int DEFAULT '8888',
  `Q9_ac` int DEFAULT '8888',
  `Q9_ad` int DEFAULT '8888',
  `Q9_ae` int DEFAULT '8888',
  `Q9_b` int DEFAULT '8888',
  `Q9_ba` int DEFAULT '8888',
  `Q9_bb` int DEFAULT '8888',
  `Q9_bc` int DEFAULT '8888',
  `Q9_bd` int DEFAULT '8888',
  `Q9_be` int DEFAULT '8888',
  `Q9_c` int DEFAULT '8888',
  `Q9_ca` int DEFAULT '8888',
  `Q9_cb` int DEFAULT '8888',
  `Q9_cc` int DEFAULT '8888',
  `Q9_cd` int DEFAULT '8888',
  `Q9_d` int DEFAULT '8888',
  `Q9_da` int DEFAULT '8888',
  `Q9_db` int DEFAULT '8888',
  `Q9_dc` int DEFAULT '8888',
  `Q9_dc_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q9_e` int DEFAULT '8888',
  `Q10` int DEFAULT '8888',
  `Q10_a` int DEFAULT '8888',
  `Q10_b` int DEFAULT '8888',
  `Q10_c` int DEFAULT '8888',
  `Q10_d` int DEFAULT '8888',
  `Q10_e` int DEFAULT '8888',
  `Q10_f` int DEFAULT '8888',
  `Q10_g` int DEFAULT '8888',
  `Q10_h` int DEFAULT '8888',
  `Q10_h_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q10_i` int DEFAULT '8888',
  `Q11` int DEFAULT '8888',
  `Q12` int DEFAULT '8888',
  `Q12_a` int DEFAULT '8888',
  `Q12_a_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_b` int DEFAULT '8888',
  `Q12_b_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_c` int DEFAULT '8888',
  `Q12_c_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_d` int DEFAULT '8888',
  `Q12_d_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_e` int DEFAULT '8888',
  `Q12_e_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_f` int DEFAULT '8888',
  `Q12_f_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_g` int DEFAULT '8888',
  `Q12_g_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_h` int DEFAULT '8888',
  `Q12_h_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_i` int DEFAULT '8888',
  `Q12_i_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q12_i_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_j` int DEFAULT '8888',
  `Q13` int DEFAULT '8888',
  `Q13_a` int DEFAULT '8888',
  `Q13_a_num` int DEFAULT '8886',
  `Q13_b` int DEFAULT '8888',
  `Q13_b_num` int DEFAULT '8886',
  `Q13_c` int DEFAULT '8888',
  `Q13_c_num` int DEFAULT '8886',
  `Q13_d` int DEFAULT '8888',
  `Q13_d_num` int DEFAULT '8886',
  `Q13_e` int DEFAULT '8888',
  `Q13_e_num` int DEFAULT '8886',
  `Q13_f` int DEFAULT '8888',
  `Q13_g` int DEFAULT '8888',
  `Q13_g_num` int DEFAULT '8886',
  `Q13_h` int DEFAULT '8888',
  `Q13_h_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q13_h_num` int DEFAULT '8886',
  `Q13_i` int DEFAULT '8888',
  `Q14` int DEFAULT '8888',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ema2s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ema2s` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `date` date NOT NULL,
  `nth_day` int NOT NULL,
  `nth_ema` int NOT NULL DEFAULT '2',
  `nth_popup` int NOT NULL DEFAULT '0',
  `popup_time` timestamp NULL DEFAULT NULL,
  `popup_time1` timestamp NULL DEFAULT NULL,
  `popup_time2` timestamp NULL DEFAULT NULL,
  `attempt_time` timestamp NULL DEFAULT NULL,
  `submit_time` timestamp NULL DEFAULT NULL,
  `time_taken` int DEFAULT NULL,
  `completed` int DEFAULT '8886',
  `1st_reminder` int DEFAULT '8886',
  `2nd_reminder` int DEFAULT '8888',
  `3rd_reminder` int DEFAULT '8888',
  `Q1` int DEFAULT NULL,
  `Q1_1` int DEFAULT '8888',
  `Q1_a` int DEFAULT '8888',
  `Q1_b` int DEFAULT '8888',
  `Q1_c` int DEFAULT '8888',
  `Q2_1a` int DEFAULT '8888',
  `Q2_1b` int DEFAULT '8888',
  `Q2_1c` int DEFAULT '8888',
  `Q2_1d` int DEFAULT '8888',
  `Q2_1e` int DEFAULT '8888',
  `Q2_2f` int DEFAULT '8888',
  `Q2_2g` int DEFAULT '8888',
  `Q2_2h` int DEFAULT '8888',
  `Q2_2i` int DEFAULT '8888',
  `Q2_2j` int DEFAULT '8888',
  `Q2_3k` int DEFAULT '8888',
  `Q2_3l` int DEFAULT '8888',
  `Q2_3m` int DEFAULT '8888',
  `Q2_3n` int DEFAULT '8888',
  `Q2_3o` int DEFAULT '8888',
  `Q3` int DEFAULT '8888',
  `Q3_a` int DEFAULT '8888',
  `Q3_aa` int DEFAULT '8888',
  `Q3_ab` int DEFAULT '8888',
  `Q3_ac` int DEFAULT '8888',
  `Q3_ad` int DEFAULT '8888',
  `Q3_ae` int DEFAULT '8888',
  `Q3_b` int DEFAULT '8888',
  `Q3_ba` int DEFAULT '8888',
  `Q3_bb` int DEFAULT '8888',
  `Q3_bc` int DEFAULT '8888',
  `Q3_bd` int DEFAULT '8888',
  `Q3_be` int DEFAULT '8888',
  `Q3_c` int DEFAULT '8888',
  `Q3_ca` int DEFAULT '8888',
  `Q3_cb` int DEFAULT '8888',
  `Q3_cc` int DEFAULT '8888',
  `Q3_cd` int DEFAULT '8888',
  `Q3_d` int DEFAULT '8888',
  `Q3_da` int DEFAULT '8888',
  `Q3_db` int DEFAULT '8888',
  `Q3_dc` int DEFAULT '8888',
  `Q3_dc_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q3_e` int DEFAULT '8888',
  `Q4` int DEFAULT '8888',
  `Q4_a` int DEFAULT '8888',
  `Q4_b` int DEFAULT '8888',
  `Q4_c` int DEFAULT '8888',
  `Q4_d` int DEFAULT '8888',
  `Q4_e` int DEFAULT '8888',
  `Q4_f` int DEFAULT '8888',
  `Q4_g` int DEFAULT '8888',
  `Q4_g_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q5` int DEFAULT '8888',
  `Q5_a` int DEFAULT '8888',
  `Q5_b` int DEFAULT '8888',
  `Q5_c` int DEFAULT '8888',
  `Q5_d` int DEFAULT '8888',
  `Q5_e` int DEFAULT '8888',
  `Q5_f` int DEFAULT '8888',
  `Q5_g` int DEFAULT '8888',
  `Q5_h` int DEFAULT '8888',
  `Q5_h_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q5_i` int DEFAULT '8888',
  `Q6` int DEFAULT '8888',
  `Q6_1` int DEFAULT '8888',
  `Q6_2` int DEFAULT '8888',
  `Q6_3` int DEFAULT '8888',
  `Q6_4` int DEFAULT '8888',
  `Q7` int DEFAULT '8888',
  `Q7_a` int DEFAULT '8888',
  `Q7_b` int DEFAULT '8888',
  `Q7_c` int DEFAULT '8888',
  `Q8_1a` int DEFAULT '8888',
  `Q8_1b` int DEFAULT '8888',
  `Q8_1c` int DEFAULT '8888',
  `Q8_1d` int DEFAULT '8888',
  `Q8_1e` int DEFAULT '8888',
  `Q8_2f` int DEFAULT '8888',
  `Q8_2g` int DEFAULT '8888',
  `Q8_2h` int DEFAULT '8888',
  `Q8_2i` int DEFAULT '8888',
  `Q8_2j` int DEFAULT '8888',
  `Q8_3k` int DEFAULT '8888',
  `Q8_3l` int DEFAULT '8888',
  `Q8_3m` int DEFAULT '8888',
  `Q8_3n` int DEFAULT '8888',
  `Q8_3o` int DEFAULT '8888',
  `Q9` int DEFAULT '8888',
  `Q9_a` int DEFAULT '8888',
  `Q9_aa` int DEFAULT '8888',
  `Q9_ab` int DEFAULT '8888',
  `Q9_ac` int DEFAULT '8888',
  `Q9_ad` int DEFAULT '8888',
  `Q9_ae` int DEFAULT '8888',
  `Q9_b` int DEFAULT '8888',
  `Q9_ba` int DEFAULT '8888',
  `Q9_bb` int DEFAULT '8888',
  `Q9_bc` int DEFAULT '8888',
  `Q9_bd` int DEFAULT '8888',
  `Q9_be` int DEFAULT '8888',
  `Q9_c` int DEFAULT '8888',
  `Q9_ca` int DEFAULT '8888',
  `Q9_cb` int DEFAULT '8888',
  `Q9_cc` int DEFAULT '8888',
  `Q9_cd` int DEFAULT '8888',
  `Q9_d` int DEFAULT '8888',
  `Q9_da` int DEFAULT '8888',
  `Q9_db` int DEFAULT '8888',
  `Q9_dc` int DEFAULT '8888',
  `Q9_dc_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q9_e` int DEFAULT '8888',
  `Q10` int DEFAULT '8888',
  `Q10_a` int DEFAULT '8888',
  `Q10_b` int DEFAULT '8888',
  `Q10_c` int DEFAULT '8888',
  `Q10_d` int DEFAULT '8888',
  `Q10_e` int DEFAULT '8888',
  `Q10_f` int DEFAULT '8888',
  `Q10_g` int DEFAULT '8888',
  `Q10_h` int DEFAULT '8888',
  `Q10_h_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q10_i` int DEFAULT '8888',
  `Q11` int DEFAULT '8888',
  `Q12` int DEFAULT '8888',
  `Q12_a` int DEFAULT '8888',
  `Q12_a_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_b` int DEFAULT '8888',
  `Q12_b_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_c` int DEFAULT '8888',
  `Q12_c_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_d` int DEFAULT '8888',
  `Q12_d_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_e` int DEFAULT '8888',
  `Q12_e_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_f` int DEFAULT '8888',
  `Q12_f_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_g` int DEFAULT '8888',
  `Q12_g_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_h` int DEFAULT '8888',
  `Q12_h_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_i` int DEFAULT '8888',
  `Q12_i_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q12_i_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_j` int DEFAULT '8888',
  `Q13` int DEFAULT '8888',
  `Q13_a` int DEFAULT '8888',
  `Q13_a_num` int DEFAULT '8886',
  `Q13_b` int DEFAULT '8888',
  `Q13_b_num` int DEFAULT '8886',
  `Q13_c` int DEFAULT '8888',
  `Q13_c_num` int DEFAULT '8886',
  `Q13_d` int DEFAULT '8888',
  `Q13_d_num` int DEFAULT '8886',
  `Q13_e` int DEFAULT '8888',
  `Q13_e_num` int DEFAULT '8886',
  `Q13_f` int DEFAULT '8888',
  `Q13_g` int DEFAULT '8888',
  `Q13_g_num` int DEFAULT '8886',
  `Q13_h` int DEFAULT '8888',
  `Q13_h_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q13_h_num` int DEFAULT '8886',
  `Q13_i` int DEFAULT '8888',
  `Q14` int DEFAULT '8888',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ema3s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ema3s` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `date` date NOT NULL,
  `nth_day` int NOT NULL,
  `nth_ema` int NOT NULL DEFAULT '3',
  `nth_popup` int NOT NULL DEFAULT '0',
  `popup_time` timestamp NULL DEFAULT NULL,
  `popup_time1` timestamp NULL DEFAULT NULL,
  `popup_time2` timestamp NULL DEFAULT NULL,
  `attempt_time` timestamp NULL DEFAULT NULL,
  `submit_time` timestamp NULL DEFAULT NULL,
  `time_taken` int DEFAULT NULL,
  `completed` int DEFAULT '8886',
  `1st_reminder` int DEFAULT '8886',
  `2nd_reminder` int DEFAULT '8888',
  `3rd_reminder` int DEFAULT '8888',
  `Q1` int DEFAULT NULL,
  `Q1_1` int DEFAULT '8888',
  `Q1_a` int DEFAULT '8888',
  `Q1_b` int DEFAULT '8888',
  `Q1_c` int DEFAULT '8888',
  `Q2_1a` int DEFAULT '8888',
  `Q2_1b` int DEFAULT '8888',
  `Q2_1c` int DEFAULT '8888',
  `Q2_1d` int DEFAULT '8888',
  `Q2_1e` int DEFAULT '8888',
  `Q2_2f` int DEFAULT '8888',
  `Q2_2g` int DEFAULT '8888',
  `Q2_2h` int DEFAULT '8888',
  `Q2_2i` int DEFAULT '8888',
  `Q2_2j` int DEFAULT '8888',
  `Q2_3k` int DEFAULT '8888',
  `Q2_3l` int DEFAULT '8888',
  `Q2_3m` int DEFAULT '8888',
  `Q2_3n` int DEFAULT '8888',
  `Q2_3o` int DEFAULT '8888',
  `Q3` int DEFAULT '8888',
  `Q3_a` int DEFAULT '8888',
  `Q3_aa` int DEFAULT '8888',
  `Q3_ab` int DEFAULT '8888',
  `Q3_ac` int DEFAULT '8888',
  `Q3_ad` int DEFAULT '8888',
  `Q3_ae` int DEFAULT '8888',
  `Q3_b` int DEFAULT '8888',
  `Q3_ba` int DEFAULT '8888',
  `Q3_bb` int DEFAULT '8888',
  `Q3_bc` int DEFAULT '8888',
  `Q3_bd` int DEFAULT '8888',
  `Q3_be` int DEFAULT '8888',
  `Q3_c` int DEFAULT '8888',
  `Q3_ca` int DEFAULT '8888',
  `Q3_cb` int DEFAULT '8888',
  `Q3_cc` int DEFAULT '8888',
  `Q3_cd` int DEFAULT '8888',
  `Q3_d` int DEFAULT '8888',
  `Q3_da` int DEFAULT '8888',
  `Q3_db` int DEFAULT '8888',
  `Q3_dc` int DEFAULT '8888',
  `Q3_dc_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q3_e` int DEFAULT '8888',
  `Q4` int DEFAULT '8888',
  `Q4_a` int DEFAULT '8888',
  `Q4_b` int DEFAULT '8888',
  `Q4_c` int DEFAULT '8888',
  `Q4_d` int DEFAULT '8888',
  `Q4_e` int DEFAULT '8888',
  `Q4_f` int DEFAULT '8888',
  `Q4_g` int DEFAULT '8888',
  `Q4_g_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q5` int DEFAULT '8888',
  `Q5_a` int DEFAULT '8888',
  `Q5_b` int DEFAULT '8888',
  `Q5_c` int DEFAULT '8888',
  `Q5_d` int DEFAULT '8888',
  `Q5_e` int DEFAULT '8888',
  `Q5_f` int DEFAULT '8888',
  `Q5_g` int DEFAULT '8888',
  `Q5_h` int DEFAULT '8888',
  `Q5_h_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q5_i` int DEFAULT '8888',
  `Q6` int DEFAULT '8888',
  `Q6_1` int DEFAULT '8888',
  `Q6_2` int DEFAULT '8888',
  `Q6_3` int DEFAULT '8888',
  `Q6_4` int DEFAULT '8888',
  `Q7` int DEFAULT '8888',
  `Q7_a` int DEFAULT '8888',
  `Q7_b` int DEFAULT '8888',
  `Q7_c` int DEFAULT '8888',
  `Q8_1a` int DEFAULT '8888',
  `Q8_1b` int DEFAULT '8888',
  `Q8_1c` int DEFAULT '8888',
  `Q8_1d` int DEFAULT '8888',
  `Q8_1e` int DEFAULT '8888',
  `Q8_2f` int DEFAULT '8888',
  `Q8_2g` int DEFAULT '8888',
  `Q8_2h` int DEFAULT '8888',
  `Q8_2i` int DEFAULT '8888',
  `Q8_2j` int DEFAULT '8888',
  `Q8_3k` int DEFAULT '8888',
  `Q8_3l` int DEFAULT '8888',
  `Q8_3m` int DEFAULT '8888',
  `Q8_3n` int DEFAULT '8888',
  `Q8_3o` int DEFAULT '8888',
  `Q9` int DEFAULT '8888',
  `Q9_a` int DEFAULT '8888',
  `Q9_aa` int DEFAULT '8888',
  `Q9_ab` int DEFAULT '8888',
  `Q9_ac` int DEFAULT '8888',
  `Q9_ad` int DEFAULT '8888',
  `Q9_ae` int DEFAULT '8888',
  `Q9_b` int DEFAULT '8888',
  `Q9_ba` int DEFAULT '8888',
  `Q9_bb` int DEFAULT '8888',
  `Q9_bc` int DEFAULT '8888',
  `Q9_bd` int DEFAULT '8888',
  `Q9_be` int DEFAULT '8888',
  `Q9_c` int DEFAULT '8888',
  `Q9_ca` int DEFAULT '8888',
  `Q9_cb` int DEFAULT '8888',
  `Q9_cc` int DEFAULT '8888',
  `Q9_cd` int DEFAULT '8888',
  `Q9_d` int DEFAULT '8888',
  `Q9_da` int DEFAULT '8888',
  `Q9_db` int DEFAULT '8888',
  `Q9_dc` int DEFAULT '8888',
  `Q9_dc_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q9_e` int DEFAULT '8888',
  `Q10` int DEFAULT '8888',
  `Q10_a` int DEFAULT '8888',
  `Q10_b` int DEFAULT '8888',
  `Q10_c` int DEFAULT '8888',
  `Q10_d` int DEFAULT '8888',
  `Q10_e` int DEFAULT '8888',
  `Q10_f` int DEFAULT '8888',
  `Q10_g` int DEFAULT '8888',
  `Q10_h` int DEFAULT '8888',
  `Q10_h_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q10_i` int DEFAULT '8888',
  `Q11` int DEFAULT '8888',
  `Q12` int DEFAULT '8888',
  `Q12_a` int DEFAULT '8888',
  `Q12_a_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_b` int DEFAULT '8888',
  `Q12_b_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_c` int DEFAULT '8888',
  `Q12_c_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_d` int DEFAULT '8888',
  `Q12_d_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_e` int DEFAULT '8888',
  `Q12_e_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_f` int DEFAULT '8888',
  `Q12_f_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_g` int DEFAULT '8888',
  `Q12_g_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_h` int DEFAULT '8888',
  `Q12_h_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_i` int DEFAULT '8888',
  `Q12_i_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q12_i_num` decimal(8,2) DEFAULT '8886.00',
  `Q12_j` int DEFAULT '8888',
  `Q13` int DEFAULT '8888',
  `Q13_a` int DEFAULT '8888',
  `Q13_a_num` int DEFAULT '8886',
  `Q13_b` int DEFAULT '8888',
  `Q13_b_num` int DEFAULT '8886',
  `Q13_c` int DEFAULT '8888',
  `Q13_c_num` int DEFAULT '8886',
  `Q13_d` int DEFAULT '8888',
  `Q13_d_num` int DEFAULT '8886',
  `Q13_e` int DEFAULT '8888',
  `Q13_e_num` int DEFAULT '8886',
  `Q13_f` int DEFAULT '8888',
  `Q13_g` int DEFAULT '8888',
  `Q13_g_num` int DEFAULT '8886',
  `Q13_h` int DEFAULT '8888',
  `Q13_h_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '8888',
  `Q13_h_num` int DEFAULT '8886',
  `Q13_i` int DEFAULT '8888',
  `Q14` int DEFAULT '8888',
  `Q15_a` int DEFAULT '8888',
  `Q15_b` int DEFAULT '8888',
  `Q15_c` int DEFAULT '8888',
  `Q15_d` int DEFAULT '8888',
  `Q15_e` int DEFAULT '8888',
  `Q15_f` int DEFAULT '8888',
  `Q15_g` int DEFAULT '8888',
  `Q15_h` int DEFAULT '8888',
  `Q15_i` int DEFAULT '8888',
  `Q15_j` int DEFAULT '8888',
  `Q15_k` int DEFAULT '8888',
  `Q15_l` int DEFAULT '8888',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `incentives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incentives` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `no_of_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `ema_1` int DEFAULT NULL,
  `ema_2` int DEFAULT NULL,
  `ema_3` int DEFAULT NULL,
  `valid_ema` int DEFAULT NULL,
  `incentive` int DEFAULT NULL,
  `complaince_rate` decimal(4,2) DEFAULT NULL,
  `additional_incentive` int DEFAULT NULL,
  `total_incentive` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `smokers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `smokers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `term` int NOT NULL,
  `startDate` timestamp NULL DEFAULT NULL,
  `endDate` timestamp NULL DEFAULT NULL,
  `prompt_ema` int NOT NULL DEFAULT '0',
  `response_ema` int NOT NULL DEFAULT '0',
  `non_response_ema` int NOT NULL DEFAULT '0',
  `future_ema` int NOT NULL DEFAULT '0',
  `response_rate` decimal(10,8) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `notification` int NOT NULL DEFAULT '1',
  `device_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `surveys` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `nth_day_current` int NOT NULL DEFAULT '0',
  `ema_completed_nth_day` int NOT NULL DEFAULT '0',
  `incentive_nth_day` int NOT NULL DEFAULT '0',
  `incentive_total` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `upload_photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upload_photos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `survey_number` int NOT NULL DEFAULT '0',
  `question_number` int NOT NULL DEFAULT '0',
  `photo_number` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `wake_times`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wake_times` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `date_of_change` timestamp NULL DEFAULT NULL,
  `old_wake` time DEFAULT NULL,
  `new_wake` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` VALUES (313,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` VALUES (314,'2021_10_05_152613_create_smokers_table',1);
INSERT INTO `migrations` VALUES (315,'2021_10_05_152853_create_users_table',1);
INSERT INTO `migrations` VALUES (316,'2021_10_22_090918_wake_times_table',1);
INSERT INTO `migrations` VALUES (317,'2021_10_26_105737_create_incentives_table',1);
INSERT INTO `migrations` VALUES (318,'2021_10_26_112908_create_ema1s_table',1);
INSERT INTO `migrations` VALUES (319,'2021_10_26_112928_create_ema2s_table',1);
INSERT INTO `migrations` VALUES (320,'2021_10_26_112942_create_ema3s_table',1);
INSERT INTO `migrations` VALUES (321,'2021_11_10_183234_create_failed_jobs_table',1);
INSERT INTO `migrations` VALUES (322,'2021_12_08_220609_create_surveys_table',1);
INSERT INTO `migrations` VALUES (323,'2022_08_24_234816_create_upload_photos_table',1);

