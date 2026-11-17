
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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(225) NOT NULL,
  `video_path` varchar(225) DEFAULT NULL,
  `image` varchar(225) DEFAULT NULL,
  `page` varchar(225) NOT NULL,
  `status` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactus` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(225) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `program` varchar(255) NOT NULL,
  `questions` varchar(225) DEFAULT NULL,
  `privacy` tinyint(1) NOT NULL DEFAULT 0,
  `page_name` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_modules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(225) DEFAULT NULL,
  `course_id` varchar(225) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(5) DEFAULT NULL,
  `ip` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(225) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_student` varchar(225) DEFAULT NULL,
  `duration` varchar(255) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  `certification` varchar(255) DEFAULT NULL,
  `internship` varchar(255) DEFAULT NULL,
  `overview` text NOT NULL,
  `structure` varchar(255) DEFAULT NULL,
  `bonus` text DEFAULT NULL,
  `international_internship` text DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `ip` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallary_category` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_views` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13290 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribed_user` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT 'Guest',
  `email` varchar(255) NOT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `user_userid` varchar(100) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_roleid` varchar(20) NOT NULL,
  `user_email_verifytoken` varchar(200) DEFAULT NULL,
  `user_email_verifystatus` enum('0','1') DEFAULT NULL COMMENT '1AS VERIFIED,0 AS REFUTE',
  `user_token` varchar(150) DEFAULT NULL,
  `user_token_status` enum('0','1') DEFAULT NULL,
  `user_admin_status` enum('0','1') NOT NULL,
  `role` enum('admin','subadmin','user') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_alumni` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(225) DEFAULT NULL,
  `insta` varchar(225) DEFAULT NULL,
  `facebook` varchar(225) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` int(5) DEFAULT NULL COMMENT '1=show,0=not show',
  `view_count` int(100) NOT NULL DEFAULT 1,
  `home` int(2) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_blog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `blog_short_desc` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `status` int(5) DEFAULT NULL COMMENT '1=show,0=not show',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `metatitle` text DEFAULT NULL,
  `metakeywords` text DEFAULT NULL,
  `metadesc` text DEFAULT NULL,
  `view_count` int(100) NOT NULL DEFAULT 1,
  `email_sent` int(2) DEFAULT 0,
  `img_alt` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_blog_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(255) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `alt_tag` varchar(255) DEFAULT NULL,
  `image_name` varchar(100) DEFAULT NULL,
  `status` int(5) DEFAULT NULL COMMENT '1=show,0=not show',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_chefeducators` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(225) DEFAULT NULL,
  `insta` varchar(225) DEFAULT NULL,
  `facebook` varchar(225) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` int(5) DEFAULT NULL COMMENT '1=show,0=not show',
  `view_count` int(100) NOT NULL DEFAULT 1,
  `home` int(2) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(225) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `title2` varchar(225) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `content2` text DEFAULT NULL,
  `status` int(2) DEFAULT 1,
  `ip` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(225) NOT NULL,
  `question` text NOT NULL,
  `answer` text DEFAULT NULL,
  `home` int(2) NOT NULL DEFAULT 0,
  `ip` varchar(225) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_gallery` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `category` varchar(250) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` int(5) DEFAULT NULL COMMENT '1=show,0=not show',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `view_count` int(100) DEFAULT 1,
  `home` int(2) DEFAULT NULL,
  `videourl` varchar(300) DEFAULT NULL,
  `caption` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_homeprogram` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(225) DEFAULT NULL,
  `slug` varchar(225) DEFAULT NULL,
  `image` varchar(225) DEFAULT NULL,
  `name` varchar(225) DEFAULT NULL,
  `duration` varchar(225) DEFAULT NULL,
  `order_by` int(5) DEFAULT NULL,
  `ip` varchar(225) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_homeslider` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `page` varchar(225) DEFAULT NULL,
  `order_by` int(2) DEFAULT 0,
  `status` int(5) DEFAULT 1 COMMENT '1=show,0=not show',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `caption` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_intcontent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(225) DEFAULT NULL,
  `content` text NOT NULL,
  `program_title` varchar(225) DEFAULT NULL,
  `students_title` varchar(225) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `url` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_intprogram` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(225) DEFAULT NULL,
  `slug` varchar(225) DEFAULT NULL,
  `image` varchar(225) DEFAULT NULL,
  `name` varchar(225) DEFAULT NULL,
  `duration` varchar(225) DEFAULT NULL,
  `order_by` int(5) DEFAULT NULL,
  `ip` varchar(225) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_intprogram_page` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `blog_short_desc` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `status` int(5) DEFAULT NULL COMMENT '1=show,0=not show',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `metatitle` text DEFAULT NULL,
  `metakeywords` text DEFAULT NULL,
  `metadesc` text DEFAULT NULL,
  `view_count` int(100) NOT NULL DEFAULT 1,
  `email_sent` int(2) DEFAULT 0,
  `img_alt` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_manage_banner` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(100) DEFAULT NULL,
  `heading1` text NOT NULL,
  `heading2` text DEFAULT NULL,
  `bannerimg` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `buttonName` varchar(100) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `featurs` text DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `status` varchar(5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `position` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniqueid` text NOT NULL,
  `title` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(225) DEFAULT NULL,
  `video_path` varchar(225) DEFAULT NULL,
  `pages` varchar(225) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pdf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(225) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `slug` varchar(225) DEFAULT NULL,
  `pdf_path` varchar(225) DEFAULT NULL,
  `image` varchar(225) DEFAULT NULL,
  `page` varchar(225) NOT NULL,
  `content` text DEFAULT NULL,
  `download_count` int(11) NOT NULL DEFAULT 0,
  `status` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_placementpartners` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` int(5) DEFAULT NULL COMMENT '1=show,0=not show',
  `home` int(2) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_seo` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `url_slug` text DEFAULT NULL,
  `page_name` varchar(200) DEFAULT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_desc` text DEFAULT NULL,
  `seo_keywords` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_supportingbrands` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` int(5) DEFAULT NULL COMMENT '1=show,0=not show',
  `home` int(2) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_testimonial` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `program` varchar(225) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` int(5) DEFAULT NULL COMMENT '1=show,0=not show',
  `view_count` int(100) NOT NULL DEFAULT 1,
  `home` int(2) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

