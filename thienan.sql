-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: thienandb
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `abouts`
--

DROP TABLE IF EXISTS `abouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `abouts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abouts`
--

LOCK TABLES `abouts` WRITE;
/*!40000 ALTER TABLE `abouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `abouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','manager','nanny','teacher','kitchen') COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_approve` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `note` text COLLATE utf8mb4_unicode_ci,
  `startdate` date NOT NULL,
  `classname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason_ban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accounts_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'Nguyễn Văn Admin','xuyenlt1test@gmail.com','$2y$12$uH1VNiKnShCPkcv4.3/kcO6pBc59X3FTRue/w1rnE6w0gwOAD4isK','0901234567','Tư Nghĩa- Quang Ngai','admin','avatars/1758466659_dog1.jpg',1,1,'Quản trị hệ thống','2022-01-01',NULL,NULL,'2025-09-16 19:30:32','2025-09-21 07:57:39'),(2,'Doan Thi Oanh','oanhld@gmail.com','$2y$12$uH1VNiKnShCPkcv4.3/kcO6pBc59X3FTRue/w1rnE6w0gwOAD4isK','0912345678','Hồ Chí Minh','manager','avatars/1758510559_dog1.jpg',1,1,'Quản lý phòng học','2023-03-15','TA002','Không hoàn thành công việc','2025-09-16 19:30:32','2025-09-30 22:07:00'),(3,'Phạm Văn Hai','teacher1@example.com','$2y$12$uH1VNiKnShCPkcv4.3/kcO6pBc59X3FTRue/w1rnE6w0gwOAD4isK','0923456789','Đà Nẵng','teacher','avatars/1758454448_nhim.jpg',1,1,'Giáo viên lớp A1','2023-09-01','TA002',NULL,'2025-09-16 19:30:32','2025-10-01 00:15:17'),(4,'Lê Thị Kitchen','kitchen1@example.com','$2y$12$ggYpsKrmg.pUwJxxy8aEyegmUkGL1/lHiPvpBtuyr0X9ZUCJGzO9K','0934567890','Hải Phòng','teacher','avatars/1759303753_cat1.jpg',1,1,'Nhân viên bếp','2023-06-10','TA001',NULL,'2025-09-16 19:30:32','2025-10-01 01:35:57'),(5,'Hoàng Thị Nanny','nanny1@example.com','$2y$12$O6UorJ9Fy/VPPjYh3IxN1.Go4vghbY6FGQF/gDlhGe8R9wYuRwePy','0945678901','Cần Thơ','teacher',NULL,1,1,'Trông trẻ lớp B2','2023-07-01','TA002',NULL,'2025-09-16 19:30:32','2025-09-30 22:08:03'),(6,'Xuyên Lê','sunylvane@gmail.com','$2y$12$OHtxhnYbCBBzXIqKAm3JoeTwo9p4qzL/I7Y1ejGXnSznccP2dTQv2','0963236247','Binh Tan','nanny',NULL,0,1,'ok good','2025-05-01','TA002',NULL,'2025-09-21 00:10:06','2025-10-01 00:31:58'),(9,'Duong Thi Cuc','sunylvane2@gmail.com','$2y$12$0w2aBNJs6QhkxR3BWiJlXuYPgEdb/OY70ykiNq79y3jCZ4xSsukuW','0963236247','Binh Chanh','manager','avatars/1758453903_cat1.jpg',1,1,'ok good','2025-09-26',NULL,NULL,'2025-09-21 04:25:03','2025-09-21 07:58:19'),(17,'Hồ Thị Cún','xuyenleit@gmail.com','$2y$12$uH1VNiKnShCPkcv4.3/kcO6pBc59X3FTRue/w1rnE6w0gwOAD4isK','0963236247','Binh Chanh','teacher','avatars/1758510284_dog1.jpg',1,0,'ok good','2025-09-26','TA002','Không hoàn thành công việc','2025-09-21 20:04:45','2025-10-01 00:17:42'),(18,'Tran Nhu Nhong','sunylvane3@gmail.com','$2y$12$pGJ5OR.Q/E1k2NFMrI3aZesEHlXL6wOhlTkvc.cbOuYPH69ANVRsi','0963236247','Binh Chanh','teacher',NULL,1,1,'ok good','2025-09-18','TA001',NULL,'2025-09-22 03:20:27','2025-10-01 00:17:36'),(19,'Xuyen Tuan Le','sunylvane5@gmail.com','$2y$12$cuoznq2Et9wmMBiOHFhkyeAaLqY4PJh0tGiNi4R7NsIN/Q1fvJmrO','0963236247','Binh Chanh','teacher',NULL,1,1,'ok','2025-09-27','TA002',NULL,'2025-09-22 03:23:02','2025-09-22 03:23:02');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `shortdes` text COLLATE utf8mb4_unicode_ci,
  `type` int NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,'Bé hào hứng với trò chơi chui qua vòng tròn tại Trường Mầm Non Thiên Ân ?','be-hao-hung-voi-tro-choi-chui-qua-vong-tron-tai-truong-mam-non-thien-an','/activities/1758598426.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p data-start=\"191\" data-end=\"465\">Trong bu&#7893;i ho&#7841;t &#273;&#7897;ng th&#7875; ch&#7845;t, s&acirc;n tr&#432;&#7901;ng Thi&ecirc;n &Acirc;n r&#7897;n r&agrave;ng ti&#7871;ng c&#432;&#7901;i khi c&aacute;c b&eacute; c&ugrave;ng nhau tham gia tr&ograve; ch&#417;i <strong data-start=\"301\" data-end=\"323\">chui qua v&ograve;ng tr&ograve;n</strong>. Nh&#7919;ng chi&#7871;c v&ograve;ng nhi&#7873;u m&agrave;u s&#7855;c &#273;&#432;&#7907;c x&#7871;p ngay ng&#7855;n, tr&#7903; th&agrave;nh &ldquo;ch&#432;&#7899;ng ng&#7841;i v&#7853;t&rdquo; nh&#7887; &#273;&#7875; c&aacute;c em th&#7917; th&aacute;ch s&#7921; nhanh nh&#7865;n v&agrave; kh&eacute;o l&eacute;o c&#7911;a m&igrave;nh.</p><p data-start=\"467\" data-end=\"762\">T&#7915;ng b&eacute; l&#7847;n l&#432;&#7907;t ti&#7871;n l&ecirc;n, ch&#259;m ch&uacute; quan s&aacute;t r&#7891;i kh&eacute;o l&eacute;o chui qua v&ograve;ng. C&oacute; em b&#432;&#7899;c &#273;i th&#7853;t nhanh, c&oacute; em ch&#7853;m r&atilde;i v&agrave; c&#7849;n th&#7853;n, nh&#432;ng ai c&#361;ng mang tr&ecirc;n g&#432;&#417;ng m&#7863;t n&#7909; c&#432;&#7901;i r&#7841;ng r&#7905; khi ho&agrave;n th&agrave;nh. Kh&ocirc;ng kh&iacute; c&#7893; v&#361;, ti&#7871;ng v&#7895; tay v&agrave; s&#7921; &#273;&#7897;ng vi&ecirc;n c&#7911;a b&#7841;n b&egrave;, th&#7847;y c&ocirc; c&agrave;ng khi&#7871;n tr&ograve; ch&#417;i th&ecirc;m s&ocirc;i &#273;&#7897;ng.</p><p data-start=\"764\" data-end=\"968\">Th&ocirc;ng qua ho&#7841;t &#273;&#7897;ng &#273;&#417;n gi&#7843;n n&agrave;y, c&aacute;c em kh&ocirc;ng ch&#7881; &#273;&#432;&#7907;c r&egrave;n luy&#7879;n th&#7875; ch&#7845;t, ph&aacute;t tri&#7875;n k&#7929; n&#259;ng v&#7853;n &#273;&#7897;ng to&agrave;n th&acirc;n, m&agrave; c&ograve;n h&#7885;c &#273;&#432;&#7907;c s&#7921; t&#7921; tin, tinh th&#7847;n thi &#273;ua l&agrave;nh m&#7841;nh v&agrave; ni&#7873;m vui chia s&#7867; c&ugrave;ng b&#7841;n b&egrave;.</p><p data-start=\"764\" data-end=\"968\"><img src=\"/activities/17585984260.jpeg\" data-filename=\"490454016_2233014337121344_7439078852995618097_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"764\" data-end=\"968\"><img src=\"/activities/17585984261.jpeg\" data-filename=\"490499493_2233014653787979_6951163982240510952_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"764\" data-end=\"968\"><img src=\"/activities/17585984262.jpeg\" data-filename=\"490679907_2233014697121308_5750199613103006106_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"764\" data-end=\"968\"><img src=\"/activities/17585984263.jpeg\" data-filename=\"490964407_2233014657121312_2879949992923175024_n.jpg\" style=\"width: 100%;\"><br></p><p>\r\n\r\n\r\n</p><p data-start=\"970\" data-end=\"1099\">&#128073; &#7902; Thi&ecirc;n &Acirc;n, m&#7895;i tr&ograve; ch&#417;i v&#7853;n &#273;&#7897;ng &#273;&#7873;u l&agrave; c&#417; h&#7897;i &#273;&#7875; tr&#7867; v&#7915;a r&egrave;n luy&#7879;n s&#7913;c kh&#7887;e, v&#7915;a t&iacute;ch l&#361;y nh&#7919;ng k&#7927; ni&#7879;m tu&#7893;i th&#417; th&#7853;t &#273;&#7865;p.</p></body></html>\n','Trong buổi hoạt động thể chất, sân trường Thiên Ân rộn ràng tiếng cười khi các bé cùng nhau tham gia trò chơi chui qua vòng tròn. Những chiếc vòng nhiều màu sắc được xếp ngay ngắn, trở thành “chướng ngại vật” nhỏ để các em thử thách sự nhanh nhẹn và khéo léo của mình.',2,1,'2025-09-15 01:31:46','2025-09-22 20:33:46'),(2,'Bé làm quen với những con số','be-lam-quen-voi-nhung-con-so','/activities/1758596072.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p data-start=\"214\" data-end=\"466\">T&#7841;i Tr&#432;&#7901;ng M&#7847;m Non Thi&ecirc;n &Acirc;n, m&#7895;i ho&#7841;t &#273;&#7897;ng h&#7885;c t&#7853;p &#273;&#7873;u &#273;&#432;&#7907;c thi&#7871;t k&#7871; v&#7899;i m&#7909;c ti&ecirc;u t&#7841;o ni&#7873;m vui v&agrave; s&#7921; h&#7913;ng kh&#7903;i cho tr&#7867;. Trong &#273;&oacute;, vi&#7879;c l&agrave;m quen v&#7899;i <strong data-start=\"362\" data-end=\"376\">c&aacute;c con s&#7889;</strong> l&agrave; m&#7897;t h&agrave;nh tr&igrave;nh th&uacute; v&#7883;, m&#7903; ra cho b&eacute; nh&#7919;ng tr&#7843;i nghi&#7879;m &#273;&#7847;u ti&ecirc;n v&#7873; th&#7871; gi&#7899;i to&aacute;n h&#7885;c.</p><p data-start=\"468\" data-end=\"556\">Thay v&igrave; h&#7885;c s&#7889; theo c&aacute;ch kh&ocirc; khan, c&aacute;c b&eacute; &#273;&#432;&#7907;c ti&#7871;p c&#7853;n qua nhi&#7873;u h&igrave;nh th&#7913;c phong ph&uacute;:</p><ul data-start=\"557\" data-end=\"997\">\r\n<li data-start=\"557\" data-end=\"663\">\r\n<p data-start=\"559\" data-end=\"663\"><strong data-start=\"559\" data-end=\"580\">Tr&ograve; ch&#417;i v&#7853;n &#273;&#7897;ng</strong>: &#273;&#7871;m b&#432;&#7899;c ch&acirc;n, chuy&#7873;n b&oacute;ng theo s&#7889; th&#7913; t&#7921;, gh&eacute;p nh&oacute;m b&#7841;n theo con s&#7889; c&ocirc; &#273;&#432;a ra.</p>\r\n</li>\r\n<li data-start=\"664\" data-end=\"764\">\r\n<p data-start=\"666\" data-end=\"764\"><strong data-start=\"666\" data-end=\"687\">&#272;&#7891; d&ugrave;ng tr&#7921;c quan</strong>: th&#7867; s&#7889;, kh&#7889;i h&igrave;nh, &#273;&#7891; ch&#417;i nhi&#7873;u m&agrave;u s&#7855;c gi&uacute;p b&eacute; d&#7877; h&igrave;nh dung v&agrave; ghi nh&#7899;.</p>\r\n</li>\r\n<li data-start=\"765\" data-end=\"878\">\r\n<p data-start=\"767\" data-end=\"878\"><strong data-start=\"767\" data-end=\"789\">&Acirc;m nh&#7841;c v&agrave; b&agrave;i h&aacute;t</strong>: nh&#7919;ng giai &#273;i&#7879;u vui nh&#7897;n k&#7871;t h&#7907;p v&#7899;i s&#7889; &#273;&#7871;m khi&#7871;n vi&#7879;c h&#7885;c tr&#7903; n&ecirc;n g&#7847;n g&#361;i, t&#7921; nhi&ecirc;n.</p>\r\n</li>\r\n<li data-start=\"879\" data-end=\"997\">\r\n<p data-start=\"881\" data-end=\"997\"><strong data-start=\"881\" data-end=\"899\">Ho&#7841;t &#273;&#7897;ng nh&oacute;m</strong>: b&eacute; c&ugrave;ng b&#7841;n trao &#273;&#7893;i, thi &#273;ua, c&#7893; v&#361; nhau, t&#7915; &#273;&oacute; ph&aacute;t tri&#7875;n th&ecirc;m k&#7929; n&#259;ng giao ti&#7871;p v&agrave; h&#7907;p t&aacute;c.</p>\r\n</li>\r\n</ul><p data-start=\"999\" data-end=\"1281\">Qua c&aacute;c ho&#7841;t &#273;&#7897;ng n&agrave;y, tr&#7867; kh&ocirc;ng ch&#7881; nh&#7853;n bi&#7871;t v&agrave; ghi nh&#7899; con s&#7889;, m&agrave; c&ograve;n r&egrave;n luy&#7879;n &#273;&#432;&#7907;c kh&#7843; n&#259;ng t&#432; duy logic, k&#7929; n&#259;ng quan s&aacute;t, s&#7921; t&#7853;p trung v&agrave; t&iacute;nh ki&ecirc;n nh&#7851;n. &#272;&#7863;c bi&#7879;t, c&aacute;c con s&#7889; d&#7847;n tr&#7903; th&agrave;nh &ldquo;ng&#432;&#7901;i b&#7841;n quen thu&#7897;c&rdquo;, gi&uacute;p b&eacute; t&#7921; tin h&#417;n khi b&#432;&#7899;c v&agrave;o giai &#273;o&#7841;n h&#7885;c t&#7853;p ti&#7871;p theo.</p><p data-start=\"999\" data-end=\"1281\" style=\"text-align: center; \"></p><p data-start=\"999\" data-end=\"1281\" style=\"text-align: center; \"></p><p data-start=\"999\" data-end=\"1281\" style=\"text-align: center; \"></p><p data-start=\"999\" data-end=\"1281\" style=\"text-align: center; \"><img src=\"/activities/17585960720.jpeg\" data-filename=\"486316712_2215698688852909_252854227061959434_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"999\" data-end=\"1281\" style=\"text-align: center; \"><img src=\"/activities/17585960721.jpeg\" data-filename=\"486354996_2215698692186242_1444611593184660367_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"999\" data-end=\"1281\" style=\"text-align: center; \"><img src=\"/activities/17585960722.jpeg\" data-filename=\"486477803_2215698655519579_1577544090866583155_n.jpg\" style=\"width: 100%;\"><br></p><p data-start=\"1283\" data-end=\"1524\">&#272;i&#7873;u m&agrave; Tr&#432;&#7901;ng M&#7847;m Non Thi&ecirc;n &Acirc;n lu&ocirc;n h&#432;&#7899;ng t&#7899;i ch&iacute;nh l&agrave; <strong data-start=\"1339\" data-end=\"1402\">x&acirc;y d&#7921;ng m&ocirc;i tr&#432;&#7901;ng h&#7885;c t&#7853;p an to&agrave;n, y&ecirc;u th&#432;&#417;ng v&agrave; s&aacute;ng t&#7841;o</strong>. M&#7895;i b&agrave;i h&#7885;c, d&ugrave; nh&#7887;, &#273;&#7873;u &#273;&#432;&#7907;c l&#7891;ng gh&eacute;p kh&eacute;o l&eacute;o &#273;&#7875; nu&ocirc;i d&#432;&#7905;ng s&#7921; t&ograve; m&ograve;, kh&aacute;t khao kh&aacute;m ph&aacute; v&agrave; ni&#7873;m vui h&#7885;c t&#7853;p &#7903; tr&#7867;.</p><p>\r\n\r\n\r\n\r\n\r\n</p><p data-start=\"1526\" data-end=\"1685\">&#128073; H&#7885;c con s&#7889; &#7903; Thi&ecirc;n &Acirc;n kh&ocirc;ng ch&#7881; &#273;&#417;n thu&#7847;n l&agrave; h&#7885;c to&aacute;n, m&agrave; c&ograve;n l&agrave; h&agrave;nh tr&igrave;nh gieo m&#7847;m cho t&#432; duy, c&#7843;m x&uacute;c v&agrave; s&#7921; t&#7921; tin c&#7911;a tr&#7867; trong nh&#7919;ng b&#432;&#7899;c &#273;i &#273;&#7847;u &#273;&#7901;i</p></body></html>\n','mỗi hoạt động học tập đều được thiết kế với mục tiêu tạo niềm vui và sự hứng khởi cho trẻ. Trong đó, việc làm quen với các con số là một hành trình thú vị,',1,1,'2025-09-15 01:31:46','2025-09-22 19:57:08'),(3,'Khám phá thế giới quanh ta','kham-pha-the-gioi-quanh-ta','/activities/1757925179.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p>Tr&#7867; t&igrave;m hi&#7875;u v&#7873; c&acirc;y c&#7889;i, &#273;&#7897;ng v&#7853;t v&agrave; m&ocirc;i tr&#432;&#7901;ng xung quanh.</p></body></html>\n','Bé học về thiên nhiên.',1,1,'2025-09-15 01:31:46','2025-09-15 01:32:59'),(4,'Các bé hóa thân thành “nông dân nhí” tại Trường Mầm Non Thiên Ân ??‍??‍?','cac-be-hoa-than-thanh-nong-dan-nhi-tai-truong-mam-non-thien-an','/activities/1758598155.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p data-start=\"227\" data-end=\"399\">M&#7897;t ng&agrave;y tr&#7843;i nghi&#7879;m th&#7853;t &#273;&#7863;c bi&#7879;t t&#7841;i Tr&#432;&#7901;ng M&#7847;m Non Thi&ecirc;n &Acirc;n, c&aacute;c b&eacute; &#273;&atilde; c&ugrave;ng nhau h&oacute;a th&acirc;n th&agrave;nh nh&#7919;ng &ldquo;n&ocirc;ng d&acirc;n nh&iacute;&rdquo; ch&#259;m s&oacute;c c&acirc;y xanh v&agrave; khu v&#432;&#7901;n nh&#7887; xinh c&#7911;a tr&#432;&#7901;ng.</p><p data-start=\"401\" data-end=\"546\">Trong b&#7897; trang ph&#7909;c gi&#7843;n d&#7883;, tay c&#7847;m b&igrave;nh t&#432;&#7899;i n&#432;&#7899;c, cu&#7889;c nh&#7887; v&agrave; nh&#7919;ng d&#7909;ng c&#7909; l&agrave;m v&#432;&#7901;n d&#7877; th&#432;&#417;ng, c&aacute;c em h&agrave;o h&#7913;ng th&#7921;c hi&#7879;n c&aacute;c c&ocirc;ng vi&#7879;c nh&#432;:</p><ul data-start=\"547\" data-end=\"693\">\r\n<li data-start=\"547\" data-end=\"576\">\r\n<p data-start=\"549\" data-end=\"576\">T&#432;&#7899;i n&#432;&#7899;c cho c&acirc;y xanh &#127807;</p>\r\n</li>\r\n<li data-start=\"577\" data-end=\"601\">\r\n<p data-start=\"579\" data-end=\"601\">Nh&#7893; c&#7887; v&agrave; x&#7899;i &#273;&#7845;t &#127793;</p>\r\n</li>\r\n<li data-start=\"602\" data-end=\"645\">\r\n<p data-start=\"604\" data-end=\"645\">Gieo h&#7841;t v&agrave; quan s&aacute;t c&acirc;y non m&#7885;c l&ecirc;n &#127803;</p>\r\n</li>\r\n<li data-start=\"646\" data-end=\"693\">\r\n<p data-start=\"648\" data-end=\"693\">Ch&#259;m s&oacute;c lu&#7889;ng rau v&agrave; hoa trong khu v&#432;&#7901;n &#127799;</p>\r\n</li>\r\n</ul><p data-start=\"695\" data-end=\"988\">Ho&#7841;t &#273;&#7897;ng n&agrave;y kh&ocirc;ng ch&#7881; mang &#273;&#7871;n cho tr&#7867; ni&#7873;m vui kh&aacute;m ph&aacute; thi&ecirc;n nhi&ecirc;n, m&agrave; c&ograve;n r&egrave;n luy&#7879;n s&#7921; ki&ecirc;n nh&#7851;n, tinh th&#7847;n tr&aacute;ch nhi&#7879;m v&agrave; t&igrave;nh y&ecirc;u v&#7899;i lao &#273;&#7897;ng. C&aacute;c b&eacute; &#273;&#432;&#7907;c h&#7885;c c&aacute;ch tr&acirc;n tr&#7885;ng c&ocirc;ng s&#7913;c &#273;&#7875; t&#7841;o ra m&#7897;t khu v&#432;&#7901;n xanh t&#432;&#417;i, t&#7915; &#273;&oacute; nu&ocirc;i d&#432;&#7905;ng t&igrave;nh y&ecirc;u m&ocirc;i tr&#432;&#7901;ng v&agrave; th&oacute;i quen s&#7889;ng l&agrave;nh m&#7841;nh.</p><p data-start=\"990\" data-end=\"1171\">Ti&#7871;ng c&#432;&#7901;i gi&ograve;n gi&atilde;, &aacute;nh m&#7855;t th&iacute;ch th&uacute; v&agrave; ni&#7873;m vui khi th&#7845;y c&acirc;y c&#7889;i m&igrave;nh ch&#259;m s&oacute;c ng&agrave;y c&agrave;ng xanh t&#7889;t &ndash; t&#7845;t c&#7843; &#273;&atilde; t&#7841;o n&ecirc;n m&#7897;t k&#7927; ni&#7879;m &#273;&aacute;ng nh&#7899; cho tu&#7893;i th&#417; c&#7911;a c&aacute;c em t&#7841;i Thi&ecirc;n &Acirc;n.</p><p data-start=\"990\" data-end=\"1171\"><img src=\"/activities/17585981550.jpeg\" data-filename=\"492531538_2245516192537825_6238497671753766182_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"990\" data-end=\"1171\"><img src=\"/activities/17585981551.jpeg\" data-filename=\"493034947_2245516169204494_2670155037758184531_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"990\" data-end=\"1171\"><img src=\"/activities/17585981552.jpeg\" data-filename=\"492539694_2245516175871160_5400578055321297383_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"990\" data-end=\"1171\"><img src=\"/activities/17585981553.jpeg\" data-filename=\"493260782_2245516182537826_4580765090604247680_n.jpg\" style=\"width: 100%;\"><br></p><p>\r\n\r\n\r\n\r\n\r\n</p><p data-start=\"1173\" data-end=\"1305\">&#128073; &#7902; Thi&ecirc;n &Acirc;n, m&#7895;i tr&#7843;i nghi&#7879;m &#273;&#7873;u &#273;&#432;&#7907;c thi&#7871;t k&#7871; &#273;&#7875; tr&#7867; v&#7915;a h&#7885;c, v&#7915;a ch&#417;i, v&#7915;a kh&aacute;m ph&aacute; th&#7871; gi&#7899;i m&#7897;t c&aacute;ch t&#7921; nhi&ecirc;n v&agrave; &#273;&#7847;y &yacute; ngh&#297;a.</p></body></html>\n','Một ngày trải nghiệm thật đặc biệt tại Trường Mầm Non Thiên Ân, các bé đã cùng nhau hóa thân thành những “nông dân nhí” chăm sóc cây xanh và khu vườn nhỏ xinh của trường.',2,1,'2025-09-15 01:31:46','2025-09-22 20:29:15'),(5,'Hào hứng tham gia trò chơi nhảy bao bố tại Trường Mầm Non Thiên Ân','hao-hung-tham-gia-tro-choi-nhay-bao-bo-tai-truong-mam-non-thien-an','/activities/1758596480.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p data-start=\"260\" data-end=\"477\">Trong kh&ocirc;ng kh&iacute; vui t&#432;&#417;i c&#7911;a ho&#7841;t &#273;&#7897;ng ngo&#7841;i kh&oacute;a, c&aacute;c b&eacute; Tr&#432;&#7901;ng M&#7847;m Non Thi&ecirc;n &Acirc;n &#273;&atilde; c&oacute; m&#7897;t tr&#7843;i nghi&#7879;m &#273;&#7847;y h&#7913;ng kh&#7903;i v&#7899;i tr&ograve; ch&#417;i <strong data-start=\"391\" data-end=\"406\">nh&#7843;y bao b&#7889;</strong> &ndash; m&#7897;t ho&#7841;t &#273;&#7897;ng v&#7915;a mang t&iacute;nh gi&#7843;i tr&iacute;, v&#7915;a gi&uacute;p r&egrave;n luy&#7879;n th&#7875; ch&#7845;t.</p><p data-start=\"479\" data-end=\"737\">Nh&#7919;ng chi&#7871;c bao b&#7889; xinh x&#7855;n tr&#7903; th&agrave;nh &ldquo;ng&#432;&#7901;i b&#7841;n &#273;&#7891;ng h&agrave;nh&rdquo; &#273;&#7875; c&aacute;c b&eacute; th&#7917; th&aacute;ch s&#7921; nhanh nh&#7865;n, kh&eacute;o l&eacute;o v&agrave; tinh th&#7847;n ki&ecirc;n tr&igrave;. Tr&ograve; ch&#417;i kh&ocirc;ng ch&#7881; mang l&#7841;i ti&#7871;ng c&#432;&#7901;i gi&ograve;n gi&atilde;, m&agrave; c&ograve;n gi&uacute;p tr&#7867; ph&aacute;t tri&#7875;n kh&#7843; n&#259;ng v&#7853;n &#273;&#7897;ng, gi&#7919; th&#259;ng b&#7857;ng v&agrave; ph&#7889;i h&#7907;p c&#417; th&#7875;.</p><p data-start=\"739\" data-end=\"1014\">&#272;&#7863;c bi&#7879;t, &#273;&#7875; kh&iacute;ch l&#7879; tinh th&#7847;n thi &#273;ua, nh&agrave; tr&#432;&#7901;ng &#273;&atilde; chu&#7849;n b&#7883; nh&#7919;ng <strong data-start=\"809\" data-end=\"830\">ph&#7847;n qu&agrave; nh&#7887; xinh</strong> d&agrave;nh cho c&aacute;c b&eacute; chi&#7871;n th&#7855;ng. Ni&#7873;m vui kh&ocirc;ng ch&#7881; &#273;&#7871;n t&#7915; gi&#7843;i th&#432;&#7903;ng, m&agrave; c&ograve;n t&#7915; s&#7921; c&#7893; v&#361; nhi&#7879;t t&igrave;nh c&#7911;a b&#7841;n b&egrave;, s&#7921; &#273;&#7897;ng vi&ecirc;n c&#7911;a th&#7847;y c&ocirc; v&agrave; s&#7921; t&#7921; h&agrave;o khi c&aacute;c con ho&agrave;n th&agrave;nh th&#7917; th&aacute;ch.</p><p data-start=\"1016\" data-end=\"1198\">Ho&#7841;t &#273;&#7897;ng nh&#7843;y bao b&#7889; &#273;&atilde; tr&#7903; th&agrave;nh m&#7897;t k&#7927; ni&#7879;m &#273;&aacute;ng nh&#7899;, n&#417;i c&aacute;c b&eacute; v&#7915;a vui ch&#417;i, v&#7915;a r&egrave;n luy&#7879;n s&#7913;c kh&#7887;e, &#273;&#7891;ng th&#7901;i h&#7885;c &#273;&#432;&#7907;c tinh th&#7847;n &#273;o&agrave;n k&#7871;t, n&#7895; l&#7921;c v&agrave; t&#7921; tin th&#7875; hi&#7879;n b&#7843;n th&acirc;n.</p><p data-start=\"1016\" data-end=\"1198\"><img src=\"/activities/17585964800.jpeg\" data-filename=\"490356230_2233014600454651_6764923916021949334_n (1).jpg\" style=\"width: 100%;\"></p><p data-start=\"1016\" data-end=\"1198\"><img src=\"/activities/17585964801.jpeg\" data-filename=\"490368334_2233014637121314_7924543137122042525_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"1016\" data-end=\"1198\"><img src=\"/activities/17585964802.jpeg\" data-filename=\"490667908_2233014633787981_8889204928564855868_n.jpg\" style=\"width: 100%;\"><br></p><p>\r\n\r\n\r\n\r\n</p><p data-start=\"1200\" data-end=\"1346\">&#128073; T&#7841;i Thi&ecirc;n &Acirc;n, m&#7895;i ho&#7841;t &#273;&#7897;ng th&#7875; ch&#7845;t &#273;&#7873;u &#273;&#432;&#7907;c l&#7891;ng gh&eacute;p ni&#7873;m vui v&agrave; b&agrave;i h&#7885;c, gi&uacute;p tr&#7867; ph&aacute;t tri&#7875;n to&agrave;n di&#7879;n c&#7843; v&#7873; th&#7875; l&#7921;c, k&#7929; n&#259;ng v&agrave; c&#7843;m x&uacute;c.</p></body></html>\n','Trong không khí vui tươi của hoạt động ngoại khóa, các bé Trường Mầm Non Thiên Ân đã có một trải nghiệm đầy hứng khởi với trò chơi nhảy bao bố',2,1,'2025-09-15 01:31:46','2025-09-22 20:01:20'),(6,'Các bé hào hứng kỷ niệm ngày 30/4 – Giải phóng miền Nam, thống nhất đất nước','cac-be-hao-hung-ky-niem-ngay-304-giai-phong-mien-nam-thong-nhat-dat-nuoc','/activities/1758598638.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p data-start=\"279\" data-end=\"496\">Trong kh&ocirc;ng kh&iacute; vui t&#432;&#417;i v&agrave; t&#7921; h&agrave;o c&#7911;a nh&#7919;ng ng&agrave;y th&aacute;ng T&#432; l&#7883;ch s&#7917;, c&aacute;c b&eacute; Tr&#432;&#7901;ng M&#7847;m Non Thi&ecirc;n &Acirc;n &#273;&atilde; c&ugrave;ng nhau tham gia nhi&#7873;u ho&#7841;t &#273;&#7897;ng &yacute; ngh&#297;a &#273;&#7875; ch&agrave;o m&#7915;ng <strong data-start=\"437\" data-end=\"493\">ng&agrave;y 30/4 &ndash; Gi&#7843;i ph&oacute;ng mi&#7873;n Nam, th&#7889;ng nh&#7845;t &#273;&#7845;t n&#432;&#7899;c</strong>.</p><p data-start=\"498\" data-end=\"785\">V&#7899;i s&#7921; h&#432;&#7899;ng d&#7851;n c&#7911;a th&#7847;y c&ocirc;, c&aacute;c em &#273;&#432;&#7907;c nghe k&#7875; chuy&#7879;n v&#7873; &#273;&#7845;t n&#432;&#7899;c, xem tranh &#7843;nh l&aacute; c&#7901; &#273;&#7887; sao v&agrave;ng tung bay v&agrave; c&ugrave;ng nhau h&aacute;t vang nh&#7919;ng b&agrave;i h&aacute;t thi&#7871;u nhi v&#7873; T&#7893; qu&#7889;c. Nhi&#7873;u ho&#7841;t &#273;&#7897;ng s&aacute;ng t&#7841;o nh&#432; v&#7869; tranh, l&agrave;m c&#7901; nh&#7887;, hay bi&#7875;u di&#7877;n v&#259;n ngh&#7879; c&#361;ng gi&uacute;p c&aacute;c b&eacute; th&ecirc;m h&agrave;o h&#7913;ng v&agrave; g&#7855;n k&#7871;t.</p><p data-start=\"787\" data-end=\"968\">D&ugrave; c&ograve;n nh&#7887;, nh&#432;ng qua nh&#7919;ng ho&#7841;t &#273;&#7897;ng g&#7847;n g&#361;i n&agrave;y, tr&#7867; d&#7847;n h&igrave;nh th&agrave;nh t&igrave;nh y&ecirc;u qu&ecirc; h&#432;&#417;ng, ni&#7873;m t&#7921; h&agrave;o d&acirc;n t&#7897;c v&agrave; s&#7921; tr&acirc;n tr&#7885;ng nh&#7919;ng gi&aacute; tr&#7883; h&ograve;a b&igrave;nh m&agrave; th&#7871; h&#7879; cha anh &#273;&atilde; &#273;em l&#7841;i.</p><p>\r\n\r\n\r\n</p><p data-start=\"970\" data-end=\"1146\">&#128073; Ng&agrave;y 30/4 kh&ocirc;ng ch&#7881; l&agrave; ng&agrave;y l&#7883;ch s&#7917; tr&#7885;ng &#273;&#7841;i c&#7911;a d&acirc;n t&#7897;c, m&agrave; c&ograve;n l&agrave; c&#417; h&#7897;i &#273;&#7875; Thi&ecirc;n &Acirc;n gieo v&agrave;o l&ograve;ng tr&#7867; t&igrave;nh y&ecirc;u &#273;&#7845;t n&#432;&#7899;c, nu&ocirc;i d&#432;&#7905;ng tinh th&#7847;n &#273;o&agrave;n k&#7871;t v&agrave; l&ograve;ng bi&#7871;t &#417;n.</p><p data-start=\"970\" data-end=\"1146\"><img src=\"/activities/17585986380.jpeg\" data-filename=\"499425601_2266431407112970_2772933505002527738_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"970\" data-end=\"1146\"><img src=\"/activities/17585986381.jpeg\" data-filename=\"499603124_2266430660446378_2369604838782348737_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"970\" data-end=\"1146\"><img src=\"/activities/17585986382.jpeg\" data-filename=\"499714109_2266431663779611_1167682638605196311_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"970\" data-end=\"1146\"><img src=\"/activities/17585986383.jpeg\" data-filename=\"499896137_2266431517112959_476361596836976972_n.jpg\" style=\"width: 100%;\"><br></p></body></html>\n','Trong không khí vui tươi và tự hào của những ngày tháng Tư lịch sử, các bé Trường Mầm Non Thiên Ân đã cùng nhau tham gia nhiều hoạt động ý nghĩa để chào mừng ngày 30/4 – Giải phóng miền Nam, thống nhất đất nước.',2,1,'2025-09-15 01:31:46','2025-09-22 20:37:18'),(7,'Bé hào hứng với trò chơi “Nhanh tay lẹ tay” tại Trường Mầm Non Thiên Ân ⚡?','be-hao-hung-voi-tro-choi-nhanh-tay-le-tay-tai-truong-mam-non-thien-an','/activities/1758602670.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p data-start=\"182\" data-end=\"371\">Trong gi&#7901; v&#7853;n &#273;&#7897;ng t&#7841;i Tr&#432;&#7901;ng M&#7847;m Non Thi&ecirc;n &Acirc;n, c&aacute;c b&eacute; &#273;&atilde; r&#7845;t h&agrave;o h&#7913;ng tham gia tr&ograve; ch&#417;i <strong data-start=\"271\" data-end=\"293\">&ldquo;Nhanh tay l&#7865; tay&rdquo;</strong> &ndash; m&#7897;t ho&#7841;t &#273;&#7897;ng v&#7915;a vui nh&#7897;n, v&#7915;a gi&uacute;p r&egrave;n luy&#7879;n s&#7921; nhanh nh&#7865;n v&agrave; kh&eacute;o l&eacute;o.</p><p data-start=\"373\" data-end=\"665\">Tr&ograve; ch&#417;i s&#7917; d&#7909;ng nh&#7919;ng <strong data-start=\"396\" data-end=\"423\">v&ograve;ng tr&ograve;n nhi&#7873;u m&agrave;u s&#7855;c</strong> &#273;&#7863;t tr&ecirc;n b&agrave;n, b&ecirc;n trong l&agrave; nh&#7919;ng <strong data-start=\"457\" data-end=\"473\">qu&#7843; b&oacute;ng nh&#7887;</strong>. Nhi&#7879;m v&#7909; c&#7911;a c&aacute;c b&eacute; l&agrave; nhanh tay nh&#7863;t b&oacute;ng, di chuy&#7875;n v&agrave; &#273;&#7863;t &#273;&uacute;ng v&#7883; tr&iacute; theo y&ecirc;u c&#7847;u. V&#7899;i m&#7895;i l&#432;&#7907;t ch&#417;i, c&aacute;c em v&#7915;a luy&#7879;n k&#7929; n&#259;ng ph&#7889;i h&#7907;p tay &ndash; m&#7855;t, v&#7915;a r&egrave;n luy&#7879;n t&#7889;c &#273;&#7897; v&agrave; s&#7921; t&#7853;p trung.</p><p data-start=\"667\" data-end=\"845\">Kh&ocirc;ng kh&iacute; tr&ograve; ch&#417;i lu&ocirc;n tr&agrave;n &#273;&#7847;y ti&#7871;ng c&#432;&#7901;i, c&#7893; v&#361; v&agrave; tinh th&#7847;n thi &#273;ua vui v&#7867;. C&aacute;c b&eacute; r&#7845;t t&#7921; h&agrave;o khi ho&agrave;n th&agrave;nh th&#7917; th&aacute;ch v&agrave; nh&#7853;n &#273;&#432;&#7907;c s&#7921; &#273;&#7897;ng vi&ecirc;n t&#7915; b&#7841;n b&egrave; c&#361;ng nh&#432; c&ocirc; gi&aacute;o.</p><p>\r\n\r\n\r\n</p><p data-start=\"847\" data-end=\"1075\">&#128073; Tr&ograve; ch&#417;i &ldquo;Nhanh tay l&#7865; tay&rdquo; l&agrave; m&#7897;t ph&#7847;n trong chu&#7895;i ho&#7841;t &#273;&#7897;ng v&#7853;n &#273;&#7897;ng h&agrave;ng ng&agrave;y t&#7841;i Thi&ecirc;n &Acirc;n, gi&uacute;p tr&#7867; ph&aacute;t tri&#7875;n th&#7875; ch&#7845;t, k&#7929; n&#259;ng v&#7853;n &#273;&#7897;ng v&agrave; tinh th&#7847;n nhanh nh&#7865;n, n&#259;ng &#273;&#7897;ng t&#7915; nh&#7919;ng b&agrave;i h&#7885;c &#273;&#417;n gi&#7843;n nh&#432;ng &#273;&#7847;y h&#7913;ng kh&#7903;i.</p><p data-start=\"847\" data-end=\"1075\"><img src=\"/activities/17586026700.jpeg\" data-filename=\"514073562_2298654433890667_1850999074691146571_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"847\" data-end=\"1075\"><img src=\"/activities/17586026701.jpeg\" data-filename=\"514358047_2298653963890714_7014619403256804181_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"847\" data-end=\"1075\"><img src=\"/activities/17586026702.jpeg\" data-filename=\"513935323_2298654377224006_7122273424028187574_n.jpg\" style=\"width: 100%;\"><br></p></body></html>\n','Trong giờ vận động tại Trường Mầm Non Thiên Ân, các bé đã rất hào hứng tham gia trò chơi “Nhanh tay lẹ tay” – một hoạt động vừa vui nhộn, vừa giúp rèn luyện sự nhanh nhẹn và khéo léo.',3,1,'2025-09-15 01:31:46','2025-09-22 21:45:56'),(8,'Bé tập làm họa sĩ – Sáng tạo cùng màu sắc tại Trường Mầm Non Thiên Ân ?✨','be-tap-lam-hoa-si-sang-tao-cung-mau-sac-tai-truong-mam-non-thien-an','/activities/1758610269.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p data-start=\"180\" data-end=\"446\">T&#7841;i Tr&#432;&#7901;ng M&#7847;m Non Thi&ecirc;n &Acirc;n, c&aacute;c b&eacute; &#273;&atilde; c&oacute; m&#7897;t bu&#7893;i h&#7885;c v&ocirc; c&ugrave;ng th&uacute; v&#7883; khi tham gia ho&#7841;t &#273;&#7897;ng <strong data-start=\"273\" data-end=\"296\">&ldquo;B&eacute; t&#7853;p l&agrave;m h&#7885;a s&#297;&rdquo;</strong>. V&#7899;i c&#7885;, m&agrave;u n&#432;&#7899;c, gi&#7845;y v&#7869; v&agrave; b&agrave;n tay h&#7891;n nhi&ecirc;n, tr&#7867; &#273;&#432;&#7907;c t&#7921; do th&#7875; hi&#7879;n tr&iacute; t&#432;&#7903;ng t&#432;&#7907;ng v&agrave; c&#7843;m x&uacute;c c&#7911;a m&igrave;nh th&ocirc;ng qua nh&#7919;ng b&#7913;c tranh &#273;&#7847;y m&agrave;u s&#7855;c.</p><p data-start=\"448\" data-end=\"722\">Ho&#7841;t &#273;&#7897;ng kh&ocirc;ng ch&#7881; gi&uacute;p c&aacute;c b&eacute; r&egrave;n luy&#7879;n kh&#7843; n&#259;ng quan s&aacute;t, ph&#7889;i h&#7907;p tay &ndash; m&#7855;t m&agrave; c&ograve;n khuy&#7871;n kh&iacute;ch tr&#7867; ph&aacute;t tri&#7875;n <strong data-start=\"563\" data-end=\"582\">t&#432; duy s&aacute;ng t&#7841;o</strong>, s&#7921; ki&ecirc;n nh&#7851;n v&agrave; kh&#7843; n&#259;ng th&#7875; hi&#7879;n b&#7843;n th&acirc;n. M&#7895;i b&#7913;c tranh l&agrave; m&#7897;t c&acirc;u chuy&#7879;n nh&#7887;, m&#7897;t th&#7871; gi&#7899;i ri&ecirc;ng m&agrave; b&eacute; mu&#7889;n chia s&#7867; v&#7899;i c&ocirc; v&agrave; b&#7841;n b&egrave;.</p><p data-start=\"724\" data-end=\"955\">Ti&#7871;ng c&#432;&#7901;i, &aacute;nh m&#7855;t h&agrave;o h&#7913;ng v&agrave; ni&#7873;m t&#7921; h&agrave;o khi ho&agrave;n th&agrave;nh b&#7913;c tranh ch&iacute;nh l&agrave; minh ch&#7913;ng cho ni&#7873;m vui h&#7885;c t&#7853;p t&#7841;i Thi&ecirc;n &Acirc;n. C&aacute;c em &#273;&#432;&#7907;c kh&iacute;ch l&#7879; kh&aacute;m ph&aacute;, th&#7917; nghi&#7879;m m&agrave;u s&#7855;c m&#7899;i v&agrave; h&#7885;c c&aacute;ch tr&acirc;n tr&#7885;ng th&agrave;nh qu&#7843; lao &#273;&#7897;ng c&#7911;a m&igrave;nh.</p><p data-start=\"724\" data-end=\"955\"><img src=\"/activities/17586102690.jpeg\" data-filename=\"482083488_2203347563421355_1338138173564334552_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"724\" data-end=\"955\"><img src=\"/activities/17586102691.jpeg\" data-filename=\"482205446_2203347426754702_3988074472340937031_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"724\" data-end=\"955\"><img src=\"/activities/17586102692.jpeg\" data-filename=\"482245998_2203347806754664_2655841032800868286_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"724\" data-end=\"955\"><img src=\"/activities/17586102693.jpeg\" data-filename=\"482276574_2203347783421333_4894936764649788522_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"724\" data-end=\"955\"><img src=\"/activities/17586102694.jpeg\" data-filename=\"483563934_2203347896754655_6382007309235580547_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"724\" data-end=\"955\"><img src=\"/activities/17586102695.jpeg\" data-filename=\"483639075_2203347583421353_1861929391448702554_n.jpg\" style=\"width: 100%;\"><br></p><p>\r\n\r\n\r\n</p><p data-start=\"957\" data-end=\"1143\">&#128073; Ho&#7841;t &#273;&#7897;ng &ldquo;B&eacute; t&#7853;p l&agrave;m h&#7885;a s&#297;&rdquo; kh&ocirc;ng ch&#7881; l&agrave; gi&#7901; h&#7885;c m&#7929; thu&#7853;t, m&agrave; c&ograve;n l&agrave; h&agrave;nh tr&igrave;nh gieo m&#7847;m s&aacute;ng t&#7841;o, nu&ocirc;i d&#432;&#7905;ng ni&#7873;m y&ecirc;u th&iacute;ch ngh&#7879; thu&#7853;t v&agrave; s&#7921; t&#7921; tin c&#7911;a tr&#7867; t&#7915; nh&#7919;ng b&#432;&#7899;c &#273;&#7847;u &#273;&#7901;i.</p></body></html>\n','Tại Trường Mầm Non Thiên Ân, các bé đã có một buổi học vô cùng thú vị khi tham gia hoạt động “Bé tập làm họa sĩ”. Với cọ, màu nước, giấy vẽ và bàn tay hồn nhiên, trẻ được tự do thể hiện trí tưởng tượng và cảm xúc của mình thông qua những bức tranh đầy màu sắc.',3,1,'2025-09-15 01:31:46','2025-09-22 23:51:09'),(9,'Kiểm tra sức khỏe định kỳ – Chăm sóc toàn diện cho trẻ tại Trường Mầm Non Thiên Ân ??','kiem-tra-suc-khoe-dinh-ky-cham-soc-toan-dien-cho-tre-tai-truong-mam-non-thien-an','/activities/1758610524.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p data-start=\"217\" data-end=\"543\">T&#7841;i Tr&#432;&#7901;ng M&#7847;m Non Thi&ecirc;n &Acirc;n, vi&#7879;c <strong data-start=\"251\" data-end=\"280\">ki&#7875;m tra s&#7913;c kh&#7887;e &#273;&#7883;nh k&#7923;</strong> cho tr&#7867; &#273;&#432;&#7907;c t&#7893; ch&#7913;c th&#432;&#7901;ng xuy&ecirc;n nh&#7857;m &#273;&#7843;m b&#7843;o m&#7895;i b&eacute; lu&ocirc;n ph&aacute;t tri&#7875;n to&agrave;n di&#7879;n c&#7843; v&#7873; th&#7875; ch&#7845;t l&#7851;n tinh th&#7847;n. C&aacute;c bu&#7893;i ki&#7875;m tra bao g&#7891;m &#273;o chi&#7873;u cao, c&acirc;n n&#7863;ng, th&#7883; l&#7921;c, th&iacute;nh l&#7921;c v&agrave; ki&#7875;m tra t&#7893;ng qu&aacute;t s&#7913;c kh&#7887;e, d&#432;&#7899;i s&#7921; h&#432;&#7899;ng d&#7851;n c&#7911;a &#273;&#7897;i ng&#361; y t&#7871; chuy&ecirc;n nghi&#7879;p.</p><p data-start=\"545\" data-end=\"799\">Ho&#7841;t &#273;&#7897;ng n&agrave;y kh&ocirc;ng ch&#7881; gi&uacute;p ph&aacute;t hi&#7879;n s&#7899;m c&aacute;c v&#7845;n &#273;&#7873; s&#7913;c kh&#7887;e m&agrave; c&ograve;n gi&uacute;p ph&#7909; huynh y&ecirc;n t&acirc;m theo d&otilde;i s&#7921; ph&aacute;t tri&#7875;n c&#7911;a con. C&aacute;c b&eacute; &#273;&#432;&#7907;c tham gia trong kh&ocirc;ng kh&iacute; nh&#7865; nh&agrave;ng, th&acirc;n thi&#7879;n, gi&uacute;p c&aacute;c em c&#7843;m th&#7845;y tho&#7843;i m&aacute;i v&agrave; h&#7907;p t&aacute;c trong t&#7915;ng b&#432;&#7899;c ki&#7875;m tra.</p><p data-start=\"801\" data-end=\"965\">&#272;&#7891;ng th&#7901;i, nh&agrave; tr&#432;&#7901;ng k&#7871;t h&#7907;p t&#432; v&#7845;n dinh d&#432;&#7905;ng, h&#432;&#7899;ng d&#7851;n v&#7879; sinh c&aacute; nh&acirc;n v&agrave; c&aacute;c th&oacute;i quen s&#7889;ng l&agrave;nh m&#7841;nh, g&oacute;p ph&#7847;n x&acirc;y d&#7921;ng n&#7873;n t&#7843;ng s&#7913;c kh&#7887;e v&#7919;ng ch&#7855;c cho tr&#7867;.</p><p data-start=\"801\" data-end=\"965\"><img src=\"/activities/17586105240.jpeg\" data-filename=\"492470460_2246079135814864_7890342128650921253_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"801\" data-end=\"965\"><img src=\"/activities/17586105241.jpeg\" data-filename=\"492536924_2246079409148170_4647547145545015296_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"801\" data-end=\"965\"><img src=\"/activities/17586105242.jpeg\" data-filename=\"492901399_2246079469148164_1085477134794735770_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"801\" data-end=\"965\"><img src=\"/activities/17586105243.jpeg\" data-filename=\"493725149_2246079405814837_6647270443979374363_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"801\" data-end=\"965\"><img src=\"/activities/17586105244.jpeg\" data-filename=\"494058406_2246079295814848_33226460657088762_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"801\" data-end=\"965\"><img src=\"/activities/17586105245.jpeg\" data-filename=\"494074519_2246079179148193_972896520106421876_n.jpg\" style=\"width: 100%;\"><br></p><p>\r\n\r\n\r\n</p><p data-start=\"967\" data-end=\"1134\">&#128073; Ki&#7875;m tra s&#7913;c kh&#7887;e &#273;&#7883;nh k&#7923; t&#7841;i Thi&ecirc;n &Acirc;n l&agrave; m&#7897;t ph&#7847;n quan tr&#7885;ng trong ch&#432;&#417;ng tr&igrave;nh ch&#259;m s&oacute;c to&agrave;n di&#7879;n, &#273;&#7843;m b&#7843;o tr&#7867; ph&aacute;t tri&#7875;n an to&agrave;n, t&#7921; tin v&agrave; h&#7841;nh ph&uacute;c m&#7895;i ng&agrave;y.</p></body></html>\n','Tại Trường Mầm Non Thiên Ân, việc kiểm tra sức khỏe định kỳ cho trẻ được tổ chức thường xuyên nhằm đảm bảo mỗi bé luôn phát triển toàn diện cả về thể chất lẫn tinh thần. Các buổi kiểm tra bao gồm đo chiều cao, cân nặng, thị lực, thính lực và kiểm tra tổng quát sức khỏe, dưới sự hướng dẫn của đội ngũ y tế chuyên nghiệp.',3,1,'2025-09-15 01:31:46','2025-09-22 23:55:24'),(10,'Dinh dưỡng cho trẻ mầm non – Nền tảng phát triển toàn diện','dinh-duong-cho-tre-mam-non-nen-tang-phat-trien-toan-dien','/activities/1758618231.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p data-start=\"243\" data-end=\"581\">Dinh d&#432;&#7905;ng &#273;&oacute;ng vai tr&ograve; quan tr&#7885;ng trong vi&#7879;c gi&uacute;p tr&#7867; ph&aacute;t tri&#7875;n to&agrave;n di&#7879;n c&#7843; v&#7873; tr&iacute; tu&#7879;, th&#7875; ch&#7845;t v&agrave; c&#7843;m x&uacute;c. M&#7897;t ch&#7871; &#273;&#7897; &#259;n c&acirc;n b&#7857;ng, &#273;&#7847;y &#273;&#7911; vitamin, kho&aacute;ng ch&#7845;t, protein v&agrave; c&aacute;c d&#432;&#7905;ng ch&#7845;t thi&#7871;t y&#7871;u gi&uacute;p tr&#7867; t&#259;ng tr&#432;&#7903;ng x&#432;&#417;ng, r&#259;ng, h&#7879; mi&#7877;n d&#7883;ch kh&#7887;e m&#7841;nh, &#273;&#7891;ng th&#7901;i h&#7895; tr&#7907; ph&aacute;t tri&#7875;n tr&iacute; n&atilde;o v&agrave; kh&#7843; n&#259;ng t&#7853;p trung.</p><p data-start=\"243\" data-end=\"581\"><img src=\"/activities/17586182010.jpeg\" data-filename=\"119547126_1093497987739657_817819929981375789_n.jpg\" style=\"width: 100%;\"><br></p><p data-start=\"583\" data-end=\"955\">Vi&#7879;c x&acirc;y d&#7921;ng b&#7919;a &#259;n &#273;a d&#7841;ng, h&#7845;p d&#7851;n v&agrave; an to&agrave;n kh&ocirc;ng ch&#7881; cung c&#7845;p n&#259;ng l&#432;&#7907;ng cho c&aacute;c ho&#7841;t &#273;&#7897;ng h&#7885;c t&#7853;p, vui ch&#417;i m&agrave; c&ograve;n h&igrave;nh th&agrave;nh th&oacute;i quen &#259;n u&#7889;ng l&agrave;nh m&#7841;nh ngay t&#7915; nh&#7919;ng n&#259;m &#273;&#7847;u &#273;&#7901;i. Th&ocirc;ng qua th&#7921;c &#273;&#417;n phong ph&uacute; v&#7899;i rau c&#7911;, tr&aacute;i c&acirc;y, ng&#361; c&#7889;c v&agrave; c&aacute;c th&#7921;c ph&#7849;m gi&agrave;u dinh d&#432;&#7905;ng, tr&#7867; &#273;&#432;&#7907;c khuy&#7871;n kh&iacute;ch kh&aacute;m ph&aacute; h&#432;&#417;ng v&#7883; t&#7921; nhi&ecirc;n v&agrave; ph&aacute;t tri&#7875;n s&#7903; th&iacute;ch &#259;n u&#7889;ng t&iacute;ch c&#7921;c.</p><p data-start=\"583\" data-end=\"955\"><img src=\"/activities/17586182011.jpeg\" data-filename=\"500763403_2269427616813349_8171407877880133744_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"583\" data-end=\"955\"><img src=\"/activities/17586182012.jpeg\" data-filename=\"119172609_1093497944406328_5844569577012999653_n.jpg\" style=\"width: 100%;\"><br></p><p data-start=\"583\" data-end=\"955\"><br></p><p data-start=\"957\" data-end=\"1249\">B&ecirc;n c&#7841;nh vi&#7879;c cung c&#7845;p b&#7919;a &#259;n &#273;&#7847;y &#273;&#7911; d&#432;&#7905;ng ch&#7845;t, ph&#7909; huynh c&#361;ng &#273;&#432;&#7907;c h&#432;&#7899;ng d&#7851;n ki&#7871;n th&#7913;c v&#7873; dinh d&#432;&#7905;ng, gi&uacute;p &#273;&#7891;ng h&agrave;nh c&ugrave;ng con c&#7843; &#7903; nh&agrave; v&agrave; t&#7841;i tr&#432;&#7901;ng. Nh&#7919;ng bu&#7893;i trao &#273;&#7893;i n&agrave;y mang &#273;&#7871;n c&#417; h&#7897;i &#273;&#7875; tr&#7867; &#273;&#432;&#7907;c ch&#259;m s&oacute;c to&agrave;n di&#7879;n, t&#7915; vi&#7879;c h&#7885;c t&#7853;p, vui ch&#417;i &#273;&#7871;n ph&aacute;t tri&#7875;n s&#7913;c kh&#7887;e v&agrave; k&#7929; n&#259;ng s&#7889;ng.</p><p data-start=\"957\" data-end=\"1249\"><img src=\"/activities/17586182013.jpeg\" data-filename=\"117647495_1070206980068758_1861131845520382202_n.jpg\" style=\"width: 100%;\"><br></p><p>\r\n\r\n\r\n</p><p data-start=\"1251\" data-end=\"1507\">T&#7841;i Tr&#432;&#7901;ng M&#7847;m Non Thi&ecirc;n &Acirc;n, c&aacute;c b&eacute; tr&#7843;i nghi&#7879;m m&ocirc;i tr&#432;&#7901;ng h&#7885;c t&#7853;p an to&agrave;n v&agrave; s&aacute;ng t&#7841;o, n&#417;i dinh d&#432;&#7905;ng &#273;&#432;&#7907;c ch&uacute; tr&#7885;ng nh&#432;ng v&#7851;n gi&#7919; tr&#7885;n ni&#7873;m vui v&agrave; s&#7921; h&#7913;ng th&uacute; trong m&#7895;i b&#7919;a &#259;n, g&oacute;p ph&#7847;n h&igrave;nh th&agrave;nh th&oacute;i quen t&#7889;t v&agrave; n&#7873;n t&#7843;ng ph&aacute;t tri&#7875;n v&#7919;ng ch&#7855;c cho tr&#7867;.</p></body></html>\n','Dinh dưỡng đóng vai trò quan trọng trong việc giúp trẻ phát triển toàn diện cả về trí tuệ, thể chất và cảm xúc. Một chế độ ăn cân bằng, đầy đủ vitamin, khoáng chất, protein và các dưỡng chất thiết yếu giúp trẻ tăng trưởng xương, răng, hệ miễn dịch khỏe mạnh, đồng thời hỗ trợ phát triển trí não và khả năng tập trung.',4,1,'2025-09-15 01:31:46','2025-09-23 02:03:51'),(11,'Kỹ năng tự lập – Nền tảng cho sự phát triển toàn diện của trẻ','ky-nang-tu-lap-nen-tang-cho-su-phat-trien-toan-dien-cua-tre','/activities/1758618909.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p data-start=\"197\" data-end=\"504\">T&#7921; l&#7853;p l&agrave; m&#7897;t trong nh&#7919;ng k&#7929; n&#259;ng quan tr&#7885;ng gi&uacute;p tr&#7867; m&#7847;m non h&igrave;nh th&agrave;nh s&#7921; t&#7921; tin, kh&#7843; n&#259;ng quy&#7871;t &#273;&#7883;nh v&agrave; tr&aacute;ch nhi&#7879;m ngay t&#7915; nh&#7919;ng n&#259;m &#273;&#7847;u &#273;&#7901;i. T&#7841;i giai &#273;o&#7841;n n&agrave;y, vi&#7879;c r&egrave;n luy&#7879;n k&#7929; n&#259;ng t&#7921; l&#7853;p kh&ocirc;ng ch&#7881; gi&uacute;p tr&#7867; bi&#7871;t t&#7921; ch&#259;m s&oacute;c b&#7843;n th&acirc;n m&agrave; c&ograve;n t&#7841;o n&#7873;n t&#7843;ng cho s&#7921; ph&aacute;t tri&#7875;n tr&iacute; tu&#7879;, c&#7843;m x&uacute;c v&agrave; x&atilde; h&#7897;i.</p><p data-start=\"506\" data-end=\"595\">Trong m&ocirc;i tr&#432;&#7901;ng h&#7885;c t&#7853;p t&#7841;i m&#7847;m non, tr&#7867; &#273;&#432;&#7907;c khuy&#7871;n kh&iacute;ch tham gia c&aacute;c ho&#7841;t &#273;&#7897;ng nh&#432;:</p><ul data-start=\"596\" data-end=\"869\">\r\n<li data-start=\"596\" data-end=\"655\">\r\n<p data-start=\"598\" data-end=\"655\"><strong data-start=\"598\" data-end=\"653\">T&#7921; m&#7863;c qu&#7847;n &aacute;o, mang gi&agrave;y d&eacute;p, c&#7845;t &#273;&#7891; d&ugrave;ng c&aacute; nh&acirc;n.</strong></p>\r\n</li>\r\n<li data-start=\"656\" data-end=\"711\">\r\n<p data-start=\"658\" data-end=\"711\"><strong data-start=\"658\" data-end=\"709\">Chu&#7849;n b&#7883; b&agrave;n &#259;n, t&#7921; &#259;n u&#7889;ng v&agrave; d&#7885;n d&#7865;p sau b&#7919;a.</strong></p>\r\n</li>\r\n<li data-start=\"712\" data-end=\"783\">\r\n<p data-start=\"714\" data-end=\"783\"><strong data-start=\"714\" data-end=\"781\">Gi&uacute;p &#273;&#7905; b&#7841;n b&egrave;, chia s&#7867; &#273;&#7891; ch&#417;i v&agrave; tham gia c&ocirc;ng vi&#7879;c nh&oacute;m nh&#7887;.</strong></p>\r\n</li>\r\n<li data-start=\"784\" data-end=\"869\">\r\n<p data-start=\"786\" data-end=\"869\"><strong data-start=\"786\" data-end=\"867\">Qu&#7843;n l&yacute; &#273;&#7891; d&ugrave;ng h&#7885;c t&#7853;p v&agrave; th&#7921;c hi&#7879;n nhi&#7879;m v&#7909; &#273;&#417;n gi&#7843;n theo h&#432;&#7899;ng d&#7851;n c&#7911;a c&ocirc;.</strong></p><p data-start=\"786\" data-end=\"869\"><img src=\"/activities/17586189090.jpeg\" data-filename=\"486158472_2215696372186474_3346892960033836213_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"786\" data-end=\"869\"><img src=\"/activities/17586189091.jpeg\" data-filename=\"486442030_2215697542186357_841740595241805309_n.jpg\" style=\"width: 100%;\"><strong data-start=\"786\" data-end=\"867\"><br></strong></p>\r\n</li>\r\n</ul><p data-start=\"871\" data-end=\"1168\">Nh&#7919;ng ho&#7841;t &#273;&#7897;ng t&#432;&#7903;ng ch&#7915;ng &#273;&#417;n gi&#7843;n n&agrave;y gi&uacute;p tr&#7867; h&#7885;c c&aacute;ch <strong data-start=\"930\" data-end=\"950\">l&agrave;m vi&#7879;c &#273;&#7897;c l&#7853;p</strong>, r&egrave;n luy&#7879;n kh&#7843; n&#259;ng quan s&aacute;t, ph&#7889;i h&#7907;p tay &ndash; m&#7855;t, &#273;&#7891;ng th&#7901;i h&igrave;nh th&agrave;nh th&oacute;i quen t&#7889;t, t&iacute;nh k&#7927; lu&#7853;t v&agrave; tinh th&#7847;n tr&aacute;ch nhi&#7879;m. Khi tr&#7867; t&#7921; l&agrave;m &#273;&#432;&#7907;c nh&#7919;ng vi&#7879;c nh&#7887;, ni&#7873;m t&#7921; h&agrave;o v&agrave; s&#7921; t&#7921; tin s&#7869; &#273;&#432;&#7907;c nu&ocirc;i d&#432;&#7905;ng t&#7915;ng ng&agrave;y.</p><p data-start=\"1170\" data-end=\"1465\">Ph&#7909; huynh v&agrave; gi&aacute;o vi&ecirc;n &#273;&oacute;ng vai tr&ograve; &#273;&#7891;ng h&agrave;nh, h&#432;&#7899;ng d&#7851;n v&agrave; kh&iacute;ch l&#7879; tr&#7867; trong qu&aacute; tr&igrave;nh h&#7885;c t&#7921; l&#7853;p, gi&uacute;p tr&#7867; c&#7843;m th&#7845;y an to&agrave;n v&agrave; &#273;&#432;&#7907;c t&ocirc;n tr&#7885;ng. Qua &#273;&oacute;, tr&#7867; d&#7847;n h&igrave;nh th&agrave;nh k&#7929; n&#259;ng t&#7921; ch&#259;m s&oacute;c b&#7843;n th&acirc;n, bi&#7871;t t&#7921; quy&#7871;t &#273;&#7883;nh trong nh&#7919;ng vi&#7879;c nh&#7887; v&agrave; s&#7861;n s&agrave;ng &#273;&#7889;i m&#7863;t v&#7899;i th&#7917; th&aacute;ch trong cu&#7897;c s&#7889;ng.</p><p data-start=\"1170\" data-end=\"1465\"><img src=\"/activities/17586189092.jpeg\" data-filename=\"490454016_2233014337121344_7439078852995618097_n.jpg\" style=\"width: 100%;\"><br></p><p>\r\n\r\n\r\n\r\n\r\n</p><p data-start=\"1467\" data-end=\"1648\">&#128073; R&egrave;n luy&#7879;n k&#7929; n&#259;ng t&#7921; l&#7853;p t&#7915; s&#7899;m l&agrave; b&#432;&#7899;c &#273;&#7879;m quan tr&#7885;ng &#273;&#7875; tr&#7867; ph&aacute;t tri&#7875;n to&agrave;n di&#7879;n, t&#7921; tin kh&aacute;m ph&aacute; th&#7871; gi&#7899;i xung quanh v&agrave; chu&#7849;n b&#7883; cho nh&#7919;ng b&#432;&#7899;c &#273;i v&#7919;ng ch&#7855;c trong t&#432;&#417;ng lai.</p></body></html>\n','Tự lập là một trong những kỹ năng quan trọng giúp trẻ mầm non hình thành sự tự tin, khả năng quyết định và trách nhiệm ngay từ những năm đầu đời. Tại giai đoạn này, việc rèn luyện kỹ năng tự lập không chỉ giúp trẻ biết tự chăm sóc bản thân mà còn tạo nền tảng cho sự phát triển trí tuệ, cảm xúc và xã hội.',4,1,'2025-09-15 01:31:46','2025-09-23 02:15:09'),(12,'Xử lý khi trẻ khóc – Đồng hành và thấu hiểu cảm xúc của bé','xu-ly-khi-tre-khoc-dong-hanh-va-thau-hieu-cam-xuc-cua-be','/activities/1758619300.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p data-start=\"176\" data-end=\"516\">r&#7867; kh&oacute;c l&agrave; m&#7897;t c&aacute;ch t&#7921; nhi&ecirc;n &#273;&#7875; b&agrave;y t&#7887; c&#7843;m x&uacute;c, nhu c&#7847;u ho&#7863;c s&#7921; kh&ocirc;ng tho&#7843;i m&aacute;i. &#272;&#7889;i v&#7899;i tr&#7867; m&#7847;m non, kh&oacute;c c&oacute; th&#7875; xu&#7845;t ph&aacute;t t&#7915; nhi&#7873;u nguy&ecirc;n nh&acirc;n nh&#432;: m&#7879;t m&#7887;i, &#273;&oacute;i, s&#7907; h&atilde;i, kh&ocirc;ng quen m&ocirc;i tr&#432;&#7901;ng m&#7899;i, ho&#7863;c xung &#273;&#7897;t v&#7899;i b&#7841;n b&egrave;. Vi&#7879;c hi&#7875;u v&agrave; x&#7917; l&yacute; c&#7843;m x&uacute;c n&agrave;y m&#7897;t c&aacute;ch &#273;&uacute;ng &#273;&#7855;n s&#7869; gi&uacute;p tr&#7867; c&#7843;m th&#7845;y an to&agrave;n v&agrave; h&#7885;c c&aacute;ch t&#7921; &#273;i&#7873;u ch&#7881;nh c&#7843;m x&uacute;c.</p><h3 data-start=\"518\" data-end=\"562\">Nh&#7919;ng b&#432;&#7899;c n&ecirc;n th&#7921;c hi&#7879;n khi tr&#7867; kh&oacute;c:</h3><ol data-start=\"563\" data-end=\"1210\">\r\n<li data-start=\"563\" data-end=\"699\">\r\n<p data-start=\"566\" data-end=\"699\"><strong data-start=\"566\" data-end=\"593\">B&igrave;nh t&#297;nh v&agrave; l&#7855;ng nghe:</strong> Gi&#7919; th&aacute;i &#273;&#7897; d&#7883;u d&agrave;ng, tr&aacute;nh la m&#7855;ng. Vi&#7879;c b&igrave;nh t&#297;nh c&#7911;a ng&#432;&#7901;i l&#7899;n gi&uacute;p tr&#7867; nhanh ch&oacute;ng &#7893;n &#273;&#7883;nh c&#7843;m x&uacute;c.</p>\r\n</li>\r\n<li data-start=\"700\" data-end=\"822\">\r\n<p data-start=\"703\" data-end=\"822\"><strong data-start=\"703\" data-end=\"728\">X&aacute;c &#273;&#7883;nh nguy&ecirc;n nh&acirc;n:</strong> H&#7887;i nh&#7865; nh&agrave;ng ho&#7863;c quan s&aacute;t &#273;&#7875; hi&#7875;u tr&#7867; kh&oacute;c v&igrave; &#273;i&#7873;u g&igrave;: &#273;&oacute;i, m&#7879;t, s&#7907; h&atilde;i hay c&#7847;n s&#7921; ch&uacute; &yacute;.</p>\r\n</li>\r\n<li data-start=\"823\" data-end=\"931\">\r\n<p data-start=\"826\" data-end=\"931\"><strong data-start=\"826\" data-end=\"850\">&#272;&#7891;ng c&#7843;m v&agrave; tr&#7845;n an:</strong> &Ocirc;m, v&#7895; v&#7873; ho&#7863;c n&oacute;i nh&#7919;ng c&acirc;u an &#7911;i gi&uacute;p tr&#7867; c&#7843;m th&#7845;y &#273;&#432;&#7907;c quan t&acirc;m v&agrave; an to&agrave;n.</p>\r\n</li>\r\n<li data-start=\"932\" data-end=\"1069\">\r\n<p data-start=\"935\" data-end=\"1069\"><strong data-start=\"935\" data-end=\"962\">H&#432;&#7899;ng d&#7851;n tr&#7867; t&#7921; x&#7917; l&yacute;:</strong> Khi tr&#7867; &#273;&atilde; b&igrave;nh t&#297;nh, nh&#7865; nh&agrave;ng gi&#7843;i th&iacute;ch c&aacute;ch b&agrave;y t&#7887; c&#7843;m x&uacute;c ho&#7863;c c&ugrave;ng tr&#7867; t&igrave;m c&aacute;ch gi&#7843;i quy&#7871;t v&#7845;n &#273;&#7873;.</p>\r\n</li>\r\n<li data-start=\"1070\" data-end=\"1210\">\r\n<p data-start=\"1073\" data-end=\"1210\"><strong data-start=\"1073\" data-end=\"1105\">Theo d&otilde;i v&agrave; r&uacute;t kinh nghi&#7879;m:</strong> Ghi nh&#7853;n t&igrave;nh hu&#7889;ng &#273;&#7875; &#273;i&#7873;u ch&#7881;nh ho&#7841;t &#273;&#7897;ng, m&ocirc;i tr&#432;&#7901;ng ho&#7863;c ph&#432;&#417;ng ph&aacute;p ch&#259;m s&oacute;c ph&ugrave; h&#7907;p h&#417;n cho tr&#7867;.</p>\r\n</li>\r\n</ol><p data-start=\"1212\" data-end=\"1404\">Vi&#7879;c x&#7917; l&yacute; kh&eacute;o l&eacute;o nh&#7919;ng l&uacute;c tr&#7867; kh&oacute;c kh&ocirc;ng ch&#7881; gi&uacute;p tr&#7867; c&#7843;m th&#7845;y an to&agrave;n m&agrave; c&ograve;n <strong data-start=\"1294\" data-end=\"1353\">gi&uacute;p h&igrave;nh th&agrave;nh k&#7929; n&#259;ng nh&#7853;n bi&#7871;t v&agrave; &#273;i&#7873;u ch&#7881;nh c&#7843;m x&uacute;c</strong>, t&#7915; &#273;&oacute; t&#259;ng kh&#7843; n&#259;ng t&#7921; l&#7853;p v&agrave; giao ti&#7871;p x&atilde; h&#7897;i.</p><p>\r\n\r\n\r\n\r\n</p><p data-start=\"1406\" data-end=\"1572\">T&#7841;i Tr&#432;&#7901;ng M&#7847;m Non Thi&ecirc;n &Acirc;n, gi&aacute;o vi&ecirc;n lu&ocirc;n &#273;&#7891;ng h&agrave;nh c&ugrave;ng tr&#7867;, l&#7855;ng nghe v&agrave; t&ocirc;n tr&#7885;ng c&#7843;m x&uacute;c, gi&uacute;p c&aacute;c b&eacute; ph&aacute;t tri&#7875;n m&#7897;t c&aacute;ch t&#7921; nhi&ecirc;n, an to&agrave;n v&agrave; &#273;&#7847;y y&ecirc;u th&#432;&#417;ng.</p></body></html>\n','Trẻ khóc là một cách tự nhiên để bày tỏ cảm xúc, nhu cầu hoặc sự không thoải mái. Đối với trẻ mầm non, khóc có thể xuất phát từ nhiều nguyên nhân như: mệt mỏi, đói, sợ hãi, không quen môi trường mới, hoặc xung đột với bạn bè.',4,1,'2025-09-15 01:31:46','2025-09-23 02:21:40'),(13,'Bé Học Đàn1','be-hoc-dan1','/activities/1757988682.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p>ok1</p></body></html>\n','học đàn1',1,1,'2025-09-15 19:11:22','2025-09-22 02:56:01'),(14,'BÉ ĐÓN XUÂN ẤT TỴ 2025 TẠI MẦM NON THIÊN ÂN','be-don-xuan-at-ty-2025-tai-mam-non-thien-an','/activities/1759475569.jpg','<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body><p data-start=\"155\" data-end=\"412\">Kh&ocirc;ng kh&iacute; T&#7871;t &#273;&atilde; tr&agrave;n ng&#7853;p kh&#7855;p n&#417;i v&agrave; M&#7847;m Non <strong data-start=\"202\" data-end=\"214\">Thi&ecirc;n &Acirc;n</strong> c&#361;ng r&#7897;n r&agrave;ng s&#7855;c xu&acirc;n v&#7899;i nh&#7919;ng ti&#7871;ng c&#432;&#7901;i gi&ograve;n tan c&#7911;a c&aacute;c b&eacute;. S&aacute;ng nay, c&aacute;c thi&ecirc;n th&#7847;n nh&#7887; c&#7911;a ch&uacute;ng ta &#273;&atilde; c&ugrave;ng nhau tham gia ch&#432;&#417;ng tr&igrave;nh <strong data-start=\"357\" data-end=\"385\">&ldquo;B&eacute; &#273;&oacute;n Xu&acirc;n &#7844;t T&#7925; 2025&rdquo;</strong> &#273;&#7847;y m&agrave;u s&#7855;c v&agrave; ni&#7873;m vui.</p><p data-start=\"414\" data-end=\"721\">&#127881; C&aacute;c ho&#7841;t &#273;&#7897;ng n&#7893;i b&#7853;t c&#7911;a ch&#432;&#417;ng tr&igrave;nh:<br data-start=\"456\" data-end=\"459\">\r\n&#10024; B&eacute; c&ugrave;ng c&ocirc; trang tr&iacute; c&acirc;y mai, c&acirc;y &#273;&agrave;o v&agrave; g&oacute;c T&#7871;t.<br data-start=\"554\" data-end=\"557\">\r\n&#10024; C&aacute;c ti&#7871;t m&#7909;c v&#259;n ngh&#7879; ch&agrave;o xu&acirc;n r&#7921;c r&#7905;, &#273;&aacute;ng y&ecirc;u.<br data-start=\"608\" data-end=\"611\">&#10024; L&igrave; x&igrave; &#273;&#7847;u n&#259;m &ndash; g&#7917;i l&#7901;i ch&uacute;c t&#7889;t l&agrave;nh cho c&aacute;c b&eacute;.</p><p data-start=\"723\" data-end=\"966\">&#127775; Bu&#7893;i l&#7877; kh&ocirc;ng ch&#7881; mang &#273;&#7871;n cho c&aacute;c b&eacute; ni&#7873;m vui, m&agrave; c&ograve;n gi&uacute;p c&aacute;c con hi&#7875;u th&ecirc;m v&#7873; phong t&#7909;c &#273;&oacute;n T&#7871;t truy&#7873;n th&#7889;ng c&#7911;a d&acirc;n t&#7897;c. Nh&#7919;ng &aacute;nh m&#7855;t h&#7891;n nhi&ecirc;n, nh&#7919;ng n&#7909; c&#432;&#7901;i r&#7841;ng r&#7905; v&agrave; ti&#7871;ng v&#7895; tay gi&ograve;n gi&atilde; &#273;&atilde; l&agrave;m &#7845;m &aacute;p kh&ocirc;ng kh&iacute; xu&acirc;n t&#7841;i Thi&ecirc;n &Acirc;n.</p><p data-start=\"968\" data-end=\"1119\">&#128150; M&#7847;m Non Thi&ecirc;n &Acirc;n xin g&#7917;i l&#7901;i c&#7843;m &#417;n ch&acirc;n th&agrave;nh &#273;&#7871;n qu&yacute; ph&#7909; huynh &#273;&atilde; lu&ocirc;n &#273;&#7891;ng h&agrave;nh v&agrave; t&#7841;o &#273;i&#7873;u ki&#7879;n &#273;&#7875; c&aacute;c b&eacute; c&oacute; m&#7897;t m&ugrave;a xu&acirc;n tr&#7885;n v&#7865;n y&ecirc;u th&#432;&#417;ng.</p><p data-start=\"968\" data-end=\"1119\"><img src=\"/activities/17594755690.jpeg\" data-filename=\"491929372_2246337025789075_7648082915282921741_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"968\" data-end=\"1119\"><img src=\"/activities/17594755691.jpeg\" data-filename=\"492451386_2246337005789077_6996199511403680861_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"968\" data-end=\"1119\"><img src=\"/activities/17594755692.jpeg\" data-filename=\"492787891_2246337015789076_7998201927724700190_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"968\" data-end=\"1119\"><img src=\"/activities/17594755693.jpeg\" data-filename=\"493276798_2246337019122409_1845705042676135994_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"968\" data-end=\"1119\"><img src=\"/activities/17594755694.jpeg\" data-filename=\"493398050_2246355202453924_3116767331625167632_n.jpg\" style=\"width: 100%;\"></p><p data-start=\"968\" data-end=\"1119\"><img src=\"/activities/17594755695.jpeg\" data-filename=\"493678571_2246337049122406_4884991652284496789_n.jpg\" style=\"width: 100%;\"><br></p><p>\r\n\r\n\r\n\r\n</p><p data-start=\"1121\" data-end=\"1225\">&#127800; <strong data-start=\"1124\" data-end=\"1220\">Ch&uacute;c c&aacute;c con v&agrave; gia &#273;&igrave;nh m&#7897;t n&#259;m m&#7899;i &#7844;t T&#7925; 2025 an khang &ndash; th&#7883;nh v&#432;&#7907;ng &ndash; tr&agrave;n &#273;&#7847;y h&#7841;nh ph&uacute;c!</strong> &#127800;</p></body></html>\n','Không khí Tết đã tràn ngập khắp nơi và Mầm Non Thiên Ân cũng rộn ràng sắc xuân với những tiếng cười giòn tan của các bé. Sáng nay, các thiên thần nhỏ của chúng ta đã cùng nhau tham gia chương trình “Bé đón Xuân Ất Tỵ 2025” đầy màu sắc và niềm vui.',3,1,'2025-10-03 00:12:49','2025-10-03 00:12:49');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `teacher_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `classname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('present','absent') COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendances_student_id_foreign` (`student_id`),
  KEY `attendances_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendances_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` VALUES (1,2,17,'2025-09-22','TA002','present',NULL,'2025-09-21 20:30:50','2025-09-21 20:57:14'),(2,3,17,'2025-09-22','TA002','present','bé bị ốm','2025-09-21 20:30:50','2025-09-22 02:48:26'),(3,4,17,'2025-09-22','TA002','present',NULL,'2025-09-21 20:30:50','2025-09-21 20:30:50'),(4,2,17,'2025-09-21','TA002','present',NULL,'2025-09-20 20:30:50','2025-09-22 02:13:47'),(5,3,17,'2025-09-21','TA002','present','bé bị ốm','2025-09-20 20:30:50','2025-09-22 02:16:21'),(6,4,17,'2025-09-21','TA002','present',NULL,'2025-09-20 20:30:50','2025-09-20 20:30:50'),(7,2,17,'2025-09-20','TA002','absent','bé bị bệnh nên ở nhà','2025-09-19 20:30:50','2025-09-19 20:30:50'),(8,3,17,'2025-09-20','TA002','absent','bé bị ốm','2025-09-19 20:30:50','2025-09-19 20:36:43'),(9,4,17,'2025-09-20','TA002','present',NULL,'2025-09-19 20:30:50','2025-09-19 20:30:50'),(10,2,3,'2025-09-30','TA002','absent','Mẹ bé cho nghĩ','2025-09-30 06:01:28','2025-09-30 06:01:28'),(11,3,3,'2025-09-30','TA002','present',NULL,'2025-09-30 06:01:28','2025-09-30 06:01:28'),(12,4,3,'2025-09-30','TA002','present',NULL,'2025-09-30 06:01:28','2025-09-30 06:01:28');
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
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
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
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
-- Table structure for table `carausels`
--

DROP TABLE IF EXISTS `carausels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carausels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `page` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carausels`
--

LOCK TABLES `carausels` WRITE;
/*!40000 ALTER TABLE `carausels` DISABLE KEYS */;
INSERT INTO `carausels` VALUES (3,'Môi trường học tập an toàn, yêu thương và đầy cảm hứng','Trẻ học tập trong môi trường an toàn, yêu thương và đầy cảm hứng.\r\nVừa vui chơi, vừa phát triển trí tuệ, thể chất và năng khiếu','carausels/1758611341_BeautyPlus-Collage-2025-09-23T07_08_44.png',1,3,NULL,'2025-09-23 00:09:01'),(4,'Tuyển sinh năm học mới tại Trường Mầm Non Thiên Ân','Chào đón các bé đến trải nghiệm môi trường học tập an toàn, yêu thương và sáng tạo.\r\nHãy đăng ký ngay để trẻ được phát triển toàn diện về trí tuệ, thể chất và năng khiếu nghệ thuật.','carausels/1758615373_490906461_2234506683638776_6492662130714928228_n.jpg',1,4,NULL,'2025-09-23 01:16:13'),(5,'Các bé say mê học đàn piano','Khoảnh khắc các em nhỏ chăm chỉ rèn luyện năng khiếu âm nhạc qua những bài học piano đầy hứng thú.','carausels/1757921811_zYkSo5QgUgQJpyhk2-z68092796541535607a17bfddac3c1b3b591c077ed67c1.jpg',1,1,NULL,'2025-09-22 19:10:23'),(6,'Các em nhỏ hân hoan chào mừng ngày 30/4','Hình ảnh các bé vui tươi, phấn khởi tham gia hoạt động kỷ niệm ngày Giải phóng miền Nam, thống nhất đất nước 30/4.','carausels/1758592087_499714109_2266431663779611_1167682638605196311_n.jpg',1,1,'2025-09-22 18:48:07','2025-09-22 18:48:07'),(7,'Các bé trải nghiệm làm nông tại nông trại','các em nhỏ hào hứng tham quan nông trại, trực tiếp trải nghiệm công việc làm nông và khám phá thiên nhiên','carausels/1758593249_visit.png',1,1,'2025-09-22 19:07:29','2025-09-22 19:07:29'),(8,'Không khí rộn ràng đêm tiệc Giáng Sinh','các bạn cùng quây quần, vui vẻ tham dự bữa tiệc đón Giáng Sinh ấm áp và tràn ngập niềm vui.','carausels/1758593357_491302460_2246115982477846_1125488540047153146_n.jpg',1,1,'2025-09-22 19:09:17','2025-09-22 19:09:17'),(9,'Thông tin hữu ích dành cho phụ huynh – Trường Mầm Non Thiên Ân','Nơi phụ huynh dễ dàng theo dõi, tương tác và cùng nhà trường chăm sóc tốt nhất cho trẻ.','carausels/1758617608_BeautyPlus-Collage-2025-09-23T08_53_11.png',1,2,'2025-09-23 01:38:49','2025-09-23 01:53:45');
/*!40000 ALTER TABLE `carausels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_schedules`
--

DROP TABLE IF EXISTS `daily_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `daily_schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Thời gian ví dụ 07:30 - 08:00',
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Hoạt động',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_schedules`
--

LOCK TABLES `daily_schedules` WRITE;
/*!40000 ALTER TABLE `daily_schedules` DISABLE KEYS */;
INSERT INTO `daily_schedules` VALUES (1,'07:30 - 08:00','Đón trẻ, trò chuyện đầu ngày',0,'2025-09-15 01:39:59','2025-09-22 01:13:06'),(2,'08:00 - 08:30','Thể dục buổi sáng',1,'2025-09-15 01:39:59','2025-09-22 01:13:06'),(3,'08:30 - 09:00','Ăn sáng',2,'2025-09-15 01:39:59','2025-09-22 01:13:06'),(4,'09:00 - 10:00','Hoạt động học tập chính (Toán, Văn, Nhạc…)',3,'2025-09-15 01:39:59','2025-09-22 01:13:06'),(5,'10:00 - 10:30','Hoạt động vui chơi ngoài trời',4,'2025-09-15 01:39:59','2025-09-22 01:13:06'),(6,'10:30 - 11:00','Vệ sinh cá nhân, chuẩn bị ăn trưa',5,'2025-09-15 01:39:59','2025-09-22 01:13:06'),(7,'11:00 - 12:00','Ăn trưa',6,'2025-09-15 01:39:59','2025-09-22 01:13:06'),(8,'12:00 - 14:00','Ngủ trưa',7,'2025-09-15 01:39:59','2025-09-22 01:13:06'),(9,'14:00 - 14:30','Ăn xế (ăn nhẹ)',8,'2025-09-15 01:39:59','2025-09-22 01:13:06'),(10,'14:30 - 15:30','Hoạt động nghệ thuật, kỹ năng sống',9,'2025-09-15 01:39:59','2025-09-22 01:13:06'),(11,'15:30 - 16:00','Chơi tự do, hoạt động góc',10,'2025-09-15 01:39:59','2025-09-22 01:13:06'),(12,'16:00 - 17:00','Trả trẻ, trao đổi với phụ huynh',11,'2025-09-15 01:39:59','2025-09-22 01:13:06');
/*!40000 ALTER TABLE `daily_schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `education_contents`
--

DROP TABLE IF EXISTS `education_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `education_contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `education_contents`
--

LOCK TABLES `education_contents` WRITE;
/*!40000 ALTER TABLE `education_contents` DISABLE KEYS */;
INSERT INTO `education_contents` VALUES (1,'Trẻ được học tập và vui chơi trong môi trường an toàn, sáng tạo, giúp phát triển trí tuệ, thể chất và năng khiếu từ sớm.','education/main_1758611739.jpg','Trẻ được học tập và vui chơi trong môi trường an toàn, sáng tạo, giúp phát triển trí tuệ, thể chất và năng khiếu từ sớm.','Trẻ được học tập và vui chơi trong môi trường an toàn, sáng tạo, giúp phát triển trí tuệ, thể chất và năng khiếu từ sớm.','2025-09-15 01:45:52','2025-09-23 00:19:04'),(2,'Khám phá Ngôn ngữ','uploads/education/language_main.jpg','Bé học chữ cái và ngôn ngữ','Học chữ cái, phát triển khả năng đọc, nghe, kể chuyện và giao tiếp.','2025-09-15 01:45:52','2025-09-15 01:45:52'),(3,'Khám phá Nghệ thuật','uploads/education/art_main.jpg','Tô màu, vẽ tranh, ca hát','Khơi gợi sự sáng tạo, thẩm mỹ và cảm thụ nghệ thuật cho trẻ.','2025-09-15 01:45:52','2025-09-15 01:45:52');
/*!40000 ALTER TABLE `education_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `education_items`
--

DROP TABLE IF EXISTS `education_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `education_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `education_content_id` bigint unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `overlay_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `education_items_education_content_id_foreign` (`education_content_id`),
  CONSTRAINT `education_items_education_content_id_foreign` FOREIGN KEY (`education_content_id`) REFERENCES `education_contents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `education_items`
--

LOCK TABLES `education_items` WRITE;
/*!40000 ALTER TABLE `education_items` DISABLE KEYS */;
INSERT INTO `education_items` VALUES (1,1,'education/item_1758611739_0.jpg','Khám phá những sắc màu',1,'2025-09-15 01:48:13','2025-09-23 00:15:39'),(2,1,'education/item_1758611926_1.jpg','Khu vườn cho em',2,'2025-09-15 01:48:13','2025-09-23 00:18:46'),(3,2,'uploads/education/language1.jpg','Làm quen chữ cái',1,'2025-09-15 01:48:13','2025-09-15 01:48:13'),(4,2,'uploads/education/language2.jpg','Kể chuyện sáng tạo',2,'2025-09-15 01:48:13','2025-09-15 01:48:13'),(5,3,'uploads/education/art1.jpg','Tô màu sáng tạo',1,'2025-09-15 01:48:13','2025-09-15 01:48:13'),(6,3,'uploads/education/art2.jpg','Âm nhạc và nhảy múa',2,'2025-09-15 01:48:13','2025-09-15 01:48:13'),(7,1,'education/item_1757926324_2.jpg','Tiếng Anh cho bé',2,'2025-09-15 01:52:04','2025-09-15 01:52:04'),(8,1,'education/item_1757988834_3.jpg','bé học đàn',3,'2025-09-15 19:13:54','2025-09-15 19:13:54');
/*!40000 ALTER TABLE `education_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,'Chị Lan Anh','Phụ huynh bé An (5 tuổi)','/avatars/1758685577_487130501_2219264565162988_2847151671689204475_n.jpg','Tôi rất yên tâm khi gửi con đến trường, giáo viên tận tình và quan tâm các bé.',1,'2025-09-15 02:43:10','2025-09-23 20:46:17'),(2,'Chị Hoa','Phụ huynh bé Thảo (6 tuổi)','/avatars/1758685588_486949160_2219264531829658_3558728392217583326_n.jpg','Trường có nhiều hoạt động bổ ích, giúp bé tự tin và năng động hơn rất nhiều.',1,'2025-09-15 02:46:51','2025-09-23 20:46:28'),(3,'Chị Mai','Phụ huynh bé Linh (3 tuổi)','/avatars/1758685602_487150385_2219264558496322_4592201841055079926_n.jpg','Giáo viên thân thiện, bé nhanh chóng hòa nhập và ngày càng yêu thích đi học.',1,'2025-09-15 02:47:17','2025-09-23 20:46:42');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,'Khám phá thế giới tuổi thơ – Rèn luyện thể chất, nuôi dưỡng ước mơ','Tại Trường Mầm Non Thiên Ân, mỗi ngày là một hành trình khám phá mới.\r\nTrẻ được học tập, vui chơi, rèn luyện sức khỏe và phát huy năng khiếu trong môi trường an toàn, yêu thương.\r\nNơi những ước mơ đầu đời được nuôi dưỡng và tỏa sáng.','2025-09-15 02:05:28','2025-09-22 20:46:06');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_images`
--

DROP TABLE IF EXISTS `gallery_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gallery_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_images_gallery_id_foreign` (`gallery_id`),
  CONSTRAINT `gallery_images_gallery_id_foreign` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_images`
--

LOCK TABLES `gallery_images` WRITE;
/*!40000 ALTER TABLE `gallery_images` DISABLE KEYS */;
INSERT INTO `gallery_images` VALUES (11,1,'galleries/1758599166_68d217fee15bb.jpg','2025-09-22 20:46:06','2025-09-22 20:46:06'),(12,1,'galleries/1758599166_68d217fee34e9.jpg','2025-09-22 20:46:06','2025-09-22 20:46:06'),(13,1,'galleries/1758599402_68d218ea216be.jpg','2025-09-22 20:50:02','2025-09-22 20:50:02'),(15,1,'galleries/1758601607_68d221873c594.jpg','2025-09-22 21:26:47','2025-09-22 21:26:47');
/*!40000 ALTER TABLE `gallery_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `love_messages`
--

DROP TABLE IF EXISTS `love_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `love_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `love_messages`
--

LOCK TABLES `love_messages` WRITE;
/*!40000 ALTER TABLE `love_messages` DISABLE KEYS */;
INSERT INTO `love_messages` VALUES (1,'Bé Bảo (4 tuổi)','avatars/1758684361_492528350_2246336955789082_454088261064738393_n.jpg','Con chúc cô luôn vui vẻ và cười thật nhiều. Con ngoan để cô vui ạ!','2025-09-15 02:30:06','2025-09-23 20:26:01'),(2,'Bé An (4 tuổi)','avatars/1758684397_491356848_2246337099122401_5976323803724607861_n.jpg','Con cảm ơn cô đã dạy con nhiều bài hát hay. Con thương cô nhiều lắm ạ!','2025-09-15 02:30:19','2025-09-23 20:26:37'),(3,'Bé Linh (5 tuổi)','avatars/1758684432_492549109_2246337115789066_5123490506759031264_n.jpg','Con thích giờ kể chuyện của cô. Con mong ngày nào cũng được nghe cô kể nữa','2025-09-15 02:30:42','2025-09-23 20:27:12'),(4,'Bé Minh (6 tuổi)','avatars/1758684506_493541573_2246115899144521_2995436059105850820_n.jpg','Con hứa sẽ ngoan, ăn giỏi và nghe lời cô. Con yêu cô ạ!','2025-09-23 20:28:26','2025-09-23 20:28:26'),(5,'Bé Hân (4 tuổi)','avatars/1758684593_492363736_2246115989144512_5901319301454771976_n.jpg','Con thương ba mẹ nhiều lắm. Con sẽ ăn ngoan, ngủ ngoan, học giỏi.','2025-09-23 20:29:53','2025-09-23 20:29:53'),(6,'Bé Duy (5 tuổi)','avatars/1758684616_493699596_2246115922477852_834809868305866490_n.jpg','Con yêu ba mẹ nhiều như cái ôm thật to. Con sẽ cố gắng học giỏi để ba mẹ vui lòng','2025-09-23 20:30:16','2025-09-23 20:30:16'),(7,'Bé My (4 tuổi)','avatars/1758684639_492902593_2246115905811187_4105851871619161842_n.jpg','Con thích được đi chơi cùng ba mẹ. Con mong cuối tuần mình sẽ đi công viên ạ','2025-09-23 20:30:39','2025-09-23 20:30:39'),(8,'Bé Nam (5 tuổi)','avatars/1758684720_491358412_2246116052477839_7031266772683391251_n.jpg','Con cảm ơn ba mẹ đã đưa con đến trường. Con sẽ ngoan để ba mẹ vui.','2025-09-23 20:32:00','2025-09-23 20:32:00'),(9,'Bé Trâm (4 tuổi)','avatars/1758684753_493474481_2246115995811178_197388586448516359_n.jpg','Con chúc cô luôn khỏe để chơi với chúng con mỗi ngày','2025-09-23 20:32:33','2025-09-23 20:32:33'),(10,'Bé Ngọc (5 tuổi)','avatars/1758684986_491294731_2246114222478022_8461786497443725819_n.jpg','Con cảm ơn cô đã dạy con múa. Con thích múa cùng các bạn ạ','2025-09-23 20:34:15','2025-09-23 20:36:26'),(11,'Bé Lan (3 tuổi)','avatars/1758684906_491301052_2246116019144509_5490938337509161168_n.jpg','Con thương ba mẹ nhiều. Con sẽ ăn hết cơm để ba mẹ vui.','2025-09-23 20:35:06','2025-09-23 20:35:06'),(12,'Bé Phúc (4 tuổi)','avatars/1758684935_493275872_2246114109144700_4333783473376624463_n.jpg','Con cảm ơn cô đã dạy con vẽ. Con thích vẽ nhiều bức tranh đẹp tặng cô.','2025-09-23 20:35:35','2025-09-23 20:35:35');
/*!40000 ALTER TABLE `love_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `breakfast` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lunch` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `snack` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Thứ 2','Cháo thịt bằm, sữa tươi','Cơm, cá kho, canh rau cải','Bánh flan, nước cam',1,'2025-09-15 02:11:10','2025-09-15 02:11:10'),(2,'Thứ 3','Bún riêu cua, sữa đậu nành','Cơm, gà kho nấm, canh bí xanh','Chuối chín, sữa chua',2,'2025-09-15 02:11:10','2025-09-15 02:11:10'),(3,'Thứ 4','Xôi gấc, sữa Milo','Cơm, thịt heo xào đậu que, canh chua cá lóc','Táo, bánh quy',3,'2025-09-15 02:11:10','2025-09-15 02:11:10'),(4,'Thứ 5','Miến gà, sữa tươi','Cơm, trứng chiên thịt, canh cải ngọt','Dưa hấu, sữa chua uống',4,'2025-09-15 02:11:10','2025-09-15 02:11:10'),(5,'Thứ 6','Phở bò, sữa đậu nành','Cơm, cá chiên, canh rau dền','Bánh bông lan, sữa tươi',5,'2025-09-15 02:11:10','2025-09-15 02:11:10');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2025_09_06_071038_create_carausels_table',1),(2,'2025_09_06_073211_create_sessions_table',1),(3,'2025_09_07_023236_create_abouts_table',1),(4,'2025_09_07_111112_create_activities_table',2),(5,'2025_09_08_091641_create_special_features_table',2),(6,'2025_09_08_091657_create_special_feature_images_table',2),(7,'2025_09_08_091709_create_special_feature_subdes_table',2),(8,'2025_09_08_121858_create_galleries_table',2),(9,'2025_09_08_121911_create_gallery_images_table',2),(10,'2025_09_08_133428_create_programs_table',2),(11,'2025_09_09_023740_create_education_contents_table',2),(12,'2025_09_09_023755_create_education_items_table',2),(13,'2025_09_09_031124_create_daily_schedules_table',3),(14,'2025_09_09_081446_create_promotions_table',3),(15,'2025_09_09_084707_create_menus_table',4),(16,'2025_09_09_092103_create_parent_notices_table',4),(17,'2025_09_09_100520_create_feedback_table',4),(18,'2025_09_12_124139_create_love_messages_table',4),(19,'2025_09_12_143802_create_users_table',4),(20,'2025_09_16_005607_create_cache_table',5),(21,'2025_09_16_022815_create_tuitions_table',6),(22,'2025_09_16_064920_create_registrations_table',7),(23,'2025_09_16_082245_create_password_reset_tokens_table',8),(24,'2025_09_12_143802_create_accounts_table',9),(25,'2025_09_22_010030_create_students_table',10),(26,'2025_09_22_023653_create_attendances_table',11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parent_notices`
--

DROP TABLE IF EXISTS `parent_notices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parent_notices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parent_notices`
--

LOCK TABLES `parent_notices` WRITE;
/*!40000 ALTER TABLE `parent_notices` DISABLE KEYS */;
INSERT INTO `parent_notices` VALUES (1,'Thông báo nghỉ lễ 2/9',1,'Do điều kiện thời tiết không thuận lợi, nhà trường quyết định cho học sinh nghỉ học để đảm bảo an toàn. Mong phụ huynh theo dõi thông báo tiếp theo để nắm rõ lịch học bù','2025-09-15 02:12:30','2025-09-15 02:21:40'),(2,'Lịch họp phụ huynh đầu năm học',1,'Nhà trường trân trọng kính mời phụ huynh tham dự buổi họp phụ huynh đầu năm để trao đổi thông tin về kế hoạch học tập và các hoạt động trong năm học mới.','2025-09-15 02:12:38','2025-09-15 02:21:31'),(3,'Thông báo nghỉ học do thời tiết xấu',1,'Nhà trường xin thông báo lịch nghỉ lễ Quốc Khánh 2/9 cho toàn thể phụ huynh và học sinh. Kính mong phụ huynh sắp xếp thời gian sinh hoạt gia đình hợp lý.','2025-09-15 02:12:46','2025-09-15 02:21:21');
/*!40000 ALTER TABLE `parent_notices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `programs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programs`
--

LOCK TABLES `programs` WRITE;
/*!40000 ALTER TABLE `programs` DISABLE KEYS */;
INSERT INTO `programs` VALUES (1,'fa-solid fa-baby','Nhà trẻ (6 - 18 tháng)',1,'Chăm sóc và nuôi dưỡng trẻ nhỏ an toàn, giúp bé phát triển thể chất và giác quan.',NULL,NULL),(2,'fa-solid fa-child','Mẫu giáo bé (3 - 4 tuổi)',1,'Bé bắt đầu làm quen với các hoạt động học tập cơ bản và kỹ năng xã hội.',NULL,NULL),(3,'fa-solid fa-children','Mẫu giáo nhỡ (4 - 5 tuổi)',1,'Tăng cường khả năng sáng tạo, học chữ cái và con số đơn giản.',NULL,NULL),(4,'fa-solid fa-user-graduate','Mẫu giáo lớn (5 - 6 tuổi)',1,'Chuẩn bị hành trang kiến thức và kỹ năng trước khi vào lớp 1.',NULL,NULL),(5,'fa-solid fa-school','Chương trình tiền tiểu học',1,'Tập trung phát triển tư duy logic, làm quen với môi trường học tập tiểu học.',NULL,NULL),(6,'fa-solid fa-book','Chương trình học tập',2,'Giúp trẻ tiếp cận kiến thức cơ bản qua hình ảnh, trò chơi và câu chuyện.',NULL,NULL),(7,'fa-solid fa-music','Âm nhạc & Nghệ thuật',2,'Phát triển năng khiếu âm nhạc, khả năng biểu diễn và cảm thụ nghệ thuật.',NULL,NULL),(8,'fa-solid fa-basketball','Thể dục & Vận động',2,'Nâng cao sức khỏe thể chất qua các bài tập, trò chơi vận động ngoài trời.',NULL,NULL),(9,'fa-solid fa-earth-asia','Khám phá Khoa học & Thiên nhiên',2,'Khuyến khích trẻ tìm hiểu về thế giới xung quanh và phát triển tư duy khoa học.',NULL,NULL),(10,'fa-solid fa-handshake','Kỹ năng sống',2,'Trang bị cho trẻ những kỹ năng cơ bản trong giao tiếp, tự phục vụ và hợp tác.',NULL,NULL);
/*!40000 ALTER TABLE `programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotions`
--

LOCK TABLES `promotions` WRITE;
/*!40000 ALTER TABLE `promotions` DISABLE KEYS */;
INSERT INTO `promotions` VALUES (1,'? Đăng ký sớm – Nhận quà liền tay','Phụ huynh đăng ký nhập học trước ngày 30/9 sẽ nhận ngay quà tặng cho bé: balo, bình nước dễ thương và bộ dụng cụ học tập','promotions/1758614118_482276574_2203347783421333_4894936764649788522_n.jpg',1,1,'2025-09-15 02:33:38','2025-09-23 00:55:18'),(2,'? Ưu đãi cho 10 bé đầu tiên','10 bé đăng ký sớm nhất sẽ được giảm ngay 10% học phí tháng đầu tiên.','promotions/1757928840_zYkSo5QgUgQJpyhk0-z6809279644330b264c66c2b0d90111fae5695df6f2878.jpg',2,1,'2025-09-15 02:34:00','2025-09-15 02:34:00'),(3,'? Nhập học sớm – Nhận quà hấp dẫn!','Đăng ký nhập học sớm để nhận balo & bình nước với học phí ưu đãi!','promotions/1757992021_zYkSo5QgUgQJpyhk0-z6809279644330b264c66c2b0d90111fae5695df6f2878.jpg',3,1,'2025-09-15 20:07:01','2025-09-15 20:07:01');
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrations`
--

DROP TABLE IF EXISTS `registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `child_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint DEFAULT NULL,
  `result` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_result` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrations`
--

LOCK TABLES `registrations` WRITE;
/*!40000 ALTER TABLE `registrations` DISABLE KEYS */;
INSERT INTO `registrations` VALUES (1,'Đoàn Thị Oanh','0963236247','Sunny','nha-tre 12-36 tháng','Bé hay quậy',1,'0','ok good','2025-09-16 00:01:08','2025-09-16 00:29:08'),(2,'Trần Văn Hơi','0123456789','bé Hợi','mau-giao-nho','bé ngoan',1,'1','Bé nhập học vào ngày mai','2025-09-16 00:03:51','2025-09-16 00:25:55'),(3,'Trần Văn ơn','0963236247','bé Gia Mẫn','mau-giao-be','ok good',NULL,NULL,NULL,'2025-09-16 00:41:36','2025-09-16 00:41:36'),(4,'Lê Văn Mai','0963236247','Bé Sol','nha-tre','ok g',NULL,NULL,NULL,'2025-09-16 00:42:40','2025-09-16 00:42:40'),(5,'Trân Văn Tèo','0963236247','Bé Bình','mau-giao-be','ok',NULL,NULL,NULL,'2025-09-16 00:45:12','2025-09-16 00:45:12'),(6,'Trần Văn ơn1','0963236247','okok','nha-tre','ok',NULL,NULL,NULL,'2025-09-16 00:49:51','2025-09-16 00:49:51'),(7,'Trần Thị Nậm','0963236247','Bé Nậm','mau-giao-be','ok goopd',1,'1','ok good','2025-09-16 00:51:55','2025-10-01 01:08:47'),(8,'Tran Thi Pho','0963236247','Be Bo','nha-tre 12-36 tháng','ok good',1,'0','đang suy nghĩ thêm','2025-09-16 18:05:58','2025-10-01 00:57:04');
/*!40000 ALTER TABLE `registrations` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('WolcHph7nDMAEdoR8VRvNNisqLUcVGkavCkNaZAB',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZE1XTm5NV2NBbjZIM3BpY1BiandUSHRNZ2tWQnJVVWRKZzc3UFdwQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6OToiYXV0aF91c2VyIjtPOjE4OiJBcHBcTW9kZWxzXEFjY291bnQiOjMzOntzOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjg6ImFjY291bnRzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTk6InByZXZlbnRzTGF6eUxvYWRpbmciO2I6MDtzOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6MTY6e3M6MjoiaWQiO2k6MTtzOjg6ImZ1bGxuYW1lIjtzOjE5OiJOZ3V54buFbiBWxINuIEFkbWluIjtzOjU6ImVtYWlsIjtzOjIyOiJ4dXllbmx0MXRlc3RAZ21haWwuY29tIjtzOjg6InBhc3N3b3JkIjtzOjYwOiIkMnkkMTIkdUgxVk5pS25TaENQa2N2NC4zL2tjTzZwQmM1OVgzRlRSdWUvdzFybkU2dzBnd09BRDRpc0siO3M6NToicGhvbmUiO3M6MTA6IjA5MDEyMzQ1NjciO3M6NzoiYWRkcmVzcyI7czoyMjoiVMawIE5naMSpYS0gUXVhbmcgTmdhaSI7czo0OiJyb2xlIjtzOjU6ImFkbWluIjtzOjY6ImF2YXRhciI7czoyNzoiYXZhdGFycy8xNzU4NDY2NjU5X2RvZzEuanBnIjtzOjEzOiJhZG1pbl9hcHByb3ZlIjtpOjE7czo2OiJzdGF0dXMiO2k6MTtzOjQ6Im5vdGUiO3M6MjU6IlF14bqjbiB0cuG7iyBo4buHIHRo4buRbmciO3M6OToic3RhcnRkYXRlIjtzOjEwOiIyMDIyLTAxLTAxIjtzOjk6ImNsYXNzbmFtZSI7TjtzOjEwOiJyZWFzb25fYmFuIjtOO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDktMTcgMDI6MzA6MzIiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDktMjEgMTQ6NTc6MzkiO31zOjExOiIAKgBvcmlnaW5hbCI7YToxNjp7czoyOiJpZCI7aToxO3M6ODoiZnVsbG5hbWUiO3M6MTk6Ik5ndXnhu4VuIFbEg24gQWRtaW4iO3M6NToiZW1haWwiO3M6MjI6Inh1eWVubHQxdGVzdEBnbWFpbC5jb20iO3M6ODoicGFzc3dvcmQiO3M6NjA6IiQyeSQxMiR1SDFWTmlLblNoQ1BrY3Y0LjMva2NPNnBCYzU5WDNGVFJ1ZS93MXJuRTZ3MGd3T0FENGlzSyI7czo1OiJwaG9uZSI7czoxMDoiMDkwMTIzNDU2NyI7czo3OiJhZGRyZXNzIjtzOjIyOiJUxrAgTmdoxKlhLSBRdWFuZyBOZ2FpIjtzOjQ6InJvbGUiO3M6NToiYWRtaW4iO3M6NjoiYXZhdGFyIjtzOjI3OiJhdmF0YXJzLzE3NTg0NjY2NTlfZG9nMS5qcGciO3M6MTM6ImFkbWluX2FwcHJvdmUiO2k6MTtzOjY6InN0YXR1cyI7aToxO3M6NDoibm90ZSI7czoyNToiUXXhuqNuIHRy4buLIGjhu4cgdGjhu5FuZyI7czo5OiJzdGFydGRhdGUiO3M6MTA6IjIwMjItMDEtMDEiO3M6OToiY2xhc3NuYW1lIjtOO3M6MTA6InJlYXNvbl9iYW4iO047czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wOS0xNyAwMjozMDozMiI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wOS0yMSAxNDo1NzozOSI7fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6MTE6IgAqAHByZXZpb3VzIjthOjA6e31zOjg6IgAqAGNhc3RzIjthOjM6e3M6OToic3RhcnRkYXRlIjtzOjg6ImRhdGV0aW1lIjtzOjY6InN0YXR1cyI7czo3OiJib29sZWFuIjtzOjEzOiJhZG1pbl9hcHByb3ZlIjtzOjc6ImJvb2xlYW4iO31zOjE3OiIAKgBjbGFzc0Nhc3RDYWNoZSI7YTowOnt9czoyMToiACoAYXR0cmlidXRlQ2FzdENhY2hlIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6MDp7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MDp7fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6Mjc6IgAqAHJlbGF0aW9uQXV0b2xvYWRDYWxsYmFjayI7TjtzOjI2OiIAKgByZWxhdGlvbkF1dG9sb2FkQ29udGV4dCI7TjtzOjEwOiJ0aW1lc3RhbXBzIjtiOjE7czoxMzoidXNlc1VuaXF1ZUlkcyI7YjowO3M6OToiACoAaGlkZGVuIjthOjE6e2k6MDtzOjg6InBhc3N3b3JkIjt9czoxMDoiACoAdmlzaWJsZSI7YTowOnt9czoxMToiACoAZmlsbGFibGUiO2E6MTQ6e2k6MDtzOjU6ImVtYWlsIjtpOjE7czo4OiJwYXNzd29yZCI7aToyO3M6NDoicm9sZSI7aTozO3M6NjoiYXZhdGFyIjtpOjQ7czo3OiJhZGRyZXNzIjtpOjU7czoxMzoiYWRtaW5fYXBwcm92ZSI7aTo2O3M6OToic3RhcnRkYXRlIjtpOjc7czo4OiJmdWxsbmFtZSI7aTo4O3M6NToicGhvbmUiO2k6OTtzOjY6InN0YXR1cyI7aToxMDtzOjQ6Im5vdGUiO2k6MTE7czo5OiJzdGFydGRhdGUiO2k6MTI7czo5OiJjbGFzc25hbWUiO2k6MTM7czoxMDoicmVhc29uX2JhbiI7fXM6MTA6IgAqAGd1YXJkZWQiO2E6MTp7aTowO3M6MToiKiI7fX19',1759485900);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_feature_images`
--

DROP TABLE IF EXISTS `special_feature_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `special_feature_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `special_feature_id` bigint unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `special_feature_images_special_feature_id_foreign` (`special_feature_id`),
  CONSTRAINT `special_feature_images_special_feature_id_foreign` FOREIGN KEY (`special_feature_id`) REFERENCES `special_features` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_feature_images`
--

LOCK TABLES `special_feature_images` WRITE;
/*!40000 ALTER TABLE `special_feature_images` DISABLE KEYS */;
INSERT INTO `special_feature_images` VALUES (8,1,'special_features/1758594167_498300011_2266428483779929_8972561496204388864_n.jpg','2025-09-22 19:22:47','2025-09-22 19:22:47'),(9,1,'special_features/1758594243_493922665_2246876679068443_4902838180444464667_n.jpg','2025-09-22 19:24:03','2025-09-22 19:24:03'),(10,1,'special_features/1758594547_490368334_2233014637121314_7924543137122042525_n.jpg','2025-09-22 19:29:07','2025-09-22 19:29:07'),(11,1,'special_features/1758594547_493963348_2245957499160361_3758986924846571998_n.jpg','2025-09-22 19:29:07','2025-09-22 19:29:07');
/*!40000 ALTER TABLE `special_feature_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_feature_subdes`
--

DROP TABLE IF EXISTS `special_feature_subdes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `special_feature_subdes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `special_feature_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `special_feature_subdes_special_feature_id_foreign` (`special_feature_id`),
  CONSTRAINT `special_feature_subdes_special_feature_id_foreign` FOREIGN KEY (`special_feature_id`) REFERENCES `special_features` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_feature_subdes`
--

LOCK TABLES `special_feature_subdes` WRITE;
/*!40000 ALTER TABLE `special_feature_subdes` DISABLE KEYS */;
INSERT INTO `special_feature_subdes` VALUES (44,1,'Quan tâm và đồng hành','fa-solid fa-star','Trẻ được khích lệ, lắng nghe và hỗ trợ trong quá trình học tập, tạo điều kiện để các em phát triển tự nhiên và thoải mái.','2025-09-22 20:10:03','2025-09-22 20:10:03'),(45,1,'Rèn luyện thể chất chủ động','fa-solid fa-dumbbell','Trò chơi vận động và hoạt động thể thao phù hợp lứa tuổi phát triển sức bền, phối hợp vận động và thói quen sống khỏe','2025-09-22 20:10:03','2025-09-22 20:10:03'),(46,1,'Khơi dậy năng khiếu nghệ thuật','fa-solid fa-paint-brush','Hội họa, âm nhạc, múa và kịch khuyến khích trẻ thể hiện sáng tạo, rèn thẩm mỹ và nâng cao sự tự tin.','2025-09-22 20:10:03','2025-09-22 20:10:03'),(47,1,'Chương trình trải nghiệm phong phú','fa-solid fa-book','Hoạt động học qua chơi, thí nghiệm nhỏ và trò chuyện tương tác giúp trẻ phát triển tư duy, ngôn ngữ và kỹ năng xã hội.','2025-09-22 20:10:03','2025-09-22 20:10:03');
/*!40000 ALTER TABLE `special_feature_subdes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_features`
--

DROP TABLE IF EXISTS `special_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `special_features` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_features`
--

LOCK TABLES `special_features` WRITE;
/*!40000 ALTER TABLE `special_features` DISABLE KEYS */;
INSERT INTO `special_features` VALUES (1,'Nơi Trẻ Em Khám Phá, Học Hỏi Và Tỏa Sáng','Trường Mầm Non Thiên Ân mang đến một môi trường an toàn, yêu thương và sáng tạo, giúp trẻ phát triển toàn diện về trí tuệ, thể chất, cảm xúc và nghệ thuật.','2025-09-15 03:33:55','2025-09-22 19:22:47');
/*!40000 ALTER TABLE `special_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `classname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `bod` date DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_delete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Bé Bảo Ngọc','Oanh Đoàn','0963236247','CHỒI,LÁ','2025-09-04','students/1758504887.jpg','TA002',4,NULL,'Binh Chanh',1,'2025-09-21 18:34:47','2025-10-01 02:32:55',2,'Bé rất ngoan',0),(2,'Bé Gia Bảo','Đoàn Thị Phóng','0963236247','CHỒI,LÁ','2025-09-25','students/1758505294.jpg','TA002',4,'2025-09-30','Binh Chanh',1,'2025-09-21 18:41:34','2025-10-01 02:27:03',2,'Bé lì bà cố',0),(3,'Bé Hoàng Anh','Mai Văn Lựu','0963236247','CHỒI,LÁ','2025-09-24','students/1758506387.jpg','TA002',4,'2025-10-10','Binh Chanh',1,'2025-09-21 18:45:41','2025-10-01 02:27:14',2,'ngoan lắm',0),(4,'Bé Bảo Ngân','Xuyên Lê','0963236247','CHỒI,LÁ','2025-08-06','students/1758506057.jpg','TA002',3,'2025-10-03','Binh Chanh',0,'2025-09-21 18:54:17','2025-10-01 02:27:28',2,'bé hay khóc',0),(5,'Lê Văn Quân','Oanh Đoàn','0963236247','CHỒI,LÁ','2025-10-10','students/1759308726.jpg','TA002',22,NULL,'Binh Chanh',1,'2025-10-01 01:52:06','2025-10-01 02:58:05',0,'ok good',0),(6,'Trần Văn Ninh','Trần Thị Phạch','0963236247','CHỒI,LÁ','2025-10-23','students/1759309860.jpg','TA002',2,NULL,'Binh Chanh',1,'2025-10-01 02:11:00','2025-10-01 02:47:13',0,'ok good',1);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tuitions`
--

DROP TABLE IF EXISTS `tuitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tuitions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` int NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tuitions`
--

LOCK TABLES `tuitions` WRITE;
/*!40000 ALTER TABLE `tuitions` DISABLE KEYS */;
INSERT INTO `tuitions` VALUES (1,'Nhà trẻ',3000000,'Đã bao gồm ăn trưa','2025-09-15 19:42:17','2025-09-15 19:42:17'),(2,'Mẫu giáo bé',3300000,'Đã bao gồm ăn trưa','2025-09-15 19:42:57','2025-10-01 01:32:31'),(3,'Mẫu giáo nhỡ',3600000,'Có lớp tiếng Anh','2025-09-15 19:43:17','2025-10-01 01:31:03'),(4,'Mẫu giáo lớn',3800000,'Tăng cường kỹ năng tiền tiểu học','2025-09-15 19:43:32','2025-09-15 19:43:32');
/*!40000 ALTER TABLE `tuitions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-06 20:48:43
