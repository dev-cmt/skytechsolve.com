-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2026 at 12:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skytechsolve_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `count` int(11) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `title`, `count`, `suffix`, `icon`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Happy Clients', 500, '+', NULL, 0, 'active', '2026-03-31 07:07:02', '2026-03-31 07:07:02'),
(2, 'Projects', 800, '+', NULL, 0, 'active', '2026-03-31 07:07:21', '2026-03-31 07:07:21'),
(3, 'Hard Workers', 12, NULL, NULL, 0, 'active', '2026-03-31 07:07:42', '2026-03-31 07:07:42'),
(4, 'Hours Of Support', 24, NULL, NULL, 0, 'active', '2026-03-31 07:07:57', '2026-03-31 07:07:57');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_type` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('published','scheduled','draft') NOT NULL DEFAULT 'draft',
  `published_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `category_id`, `title`, `slug`, `content`, `image_path`, `author_id`, `status`, `published_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 'Top 10 Web Design Trends in 2026', 'top-10-web-design-trends-in-2026', '<p>Discover the latest web design trends shaping the digital world in 2026. From minimalistic layouts to AI-powered interfaces, learn how to make your website modern, user-friendly, and SEO-optimized.</p>', 'uploads/blog-images/gemini-generated-image-lk6ig0lk6ig0lk6i_69cea37153181.png', 2, 'published', '2026-03-31 07:18:00', '2026-03-31 07:18:43', '2026-04-02 11:12:17', NULL),
(2, 3, 'How Mobile Apps Are Changing Business Growth', 'how-mobile-apps-are-changing-business-growth', '<p>Mobile apps are revolutionizing how businesses engage with customers. Learn how Android, iOS, and cross-platform apps can boost sales, improve user experience, and enhance brand loyalty.</p>', 'uploads/blog-images/gemini-generated-image-ohedbdohedbdohed_69ce51e0bd3d5.png', 2, 'published', '2026-04-02 05:23:00', '2026-04-02 05:24:16', '2026-04-02 05:24:16', NULL),
(3, 4, 'Benefits of ERP Solutions for Small and Medium Businesses', 'benefits-of-erp-solutions-for-small-and-medium-businesses', '<p>Explore how ERP software streamlines operations, manages inventory, accounting, and HR, and increases efficiency. See why SMEs are investing in ERP solutions to stay competitive.</p>', 'uploads/blog-images/multiple-image-slider-wordpress_69ce523e25eea.png', 2, 'published', '2026-04-02 11:26:00', '2026-04-02 05:25:50', '2026-04-02 05:26:07', NULL),
(4, 2, 'E-commerce Development: Boost Your Online Sales in 2026', 'e-commerce-development-boost-your-online-sales-in-2026', '<p>Building a high-performance eCommerce website is key to success. Learn about responsive design, payment integration, SEO strategies, and mobile optimization to grow your online business.</p>', 'uploads/blog-images/gemini-generated-image-pwe9v8pwe9v8pwe9_69ce52a111d35.png', 2, 'published', '2026-04-02 05:27:00', '2026-04-02 05:27:29', '2026-04-02 05:27:29', NULL),
(5, 17, 'Why SEO is Crucial for Every Business Website', 'why-seo-is-crucial-for-every-business-website', '<p>SEO drives organic traffic, improves search rankings, and increases conversions. Discover practical tips to optimize your website, from keyword research to mobile-friendly design.</p>', 'uploads/blog-images/multiple-image-slider-wordpress_69ce52ff05c40.png', 2, 'published', '2026-04-02 05:28:00', '2026-04-02 05:29:03', '2026-04-02 05:29:03', NULL),
(6, 17, 'Top Tools for Web Development Professionals', 'top-tools-for-web-development-professionals', '<p data-start=\"1677\" data-end=\"1852\">From coding frameworks to testing software, explore the essential tools web developers use in 2026 to create secure, fast, and responsive websites and apps.</p>', 'uploads/blog-images/multiple-image-slider-wordpress_69ce535ddb184.png', 2, 'published', '2026-04-02 05:30:00', '2026-04-02 05:30:37', '2026-04-02 05:30:37', NULL),
(7, 17, 'The Future of Digital Marketing in Bangladesh', 'the-future-of-digital-marketing-in-bangladesh', '<p>Learn how digital marketing strategies like social media, SEO, and content marketing are evolving in Bangladesh. Get tips to grow your brand and reach more customers online.</p>', 'uploads/blog-images/intro-img_69cea1a0216fd.jpg', 2, 'published', '2026-04-02 11:04:00', '2026-04-02 11:04:32', '2026-04-02 11:04:32', NULL),
(8, 3, 'How AI is Transforming Mobile App Development', 'how-ai-is-transforming-mobile-app-development', '<p>Artificial Intelligence is reshaping mobile apps. From chatbots to predictive analytics, discover how AI enhances user experience, automates tasks, and drives business growth.</p>', 'uploads/blog-images/video-img_69cea1fc9ba32.jpg', 2, 'published', '2026-04-02 11:05:00', '2026-04-02 11:06:04', '2026-04-02 11:06:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_post_tags`
--

CREATE TABLE `blog_post_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('skytechsolve-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:72:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"view sliders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:14:\"create sliders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:12:\"edit sliders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:14:\"delete sliders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:15:\"view categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:17:\"create categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:15:\"edit categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:17:\"delete categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:13:\"view features\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"create features\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:13:\"edit features\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:15:\"delete features\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:9:\"view tags\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:11:\"create tags\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:9:\"edit tags\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:11:\"delete tags\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:13:\"view services\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:15:\"create services\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:13:\"edit services\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:15:\"delete services\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:13:\"view projects\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:15:\"create projects\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:13:\"edit projects\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:15:\"delete projects\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:13:\"view products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:15:\"create products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:13:\"edit products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:15:\"delete products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:17:\"view testimonials\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:19:\"create testimonials\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:17:\"edit testimonials\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:19:\"delete testimonials\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:17:\"view achievements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:19:\"create achievements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:17:\"edit achievements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:19:\"delete achievements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:10:\"view teams\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:12:\"create teams\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:10:\"edit teams\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:12:\"delete teams\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:12:\"view clients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:14:\"create clients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:12:\"edit clients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:14:\"delete clients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:10:\"view blogs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:12:\"create blogs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:10:\"edit blogs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:12:\"delete blogs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:10:\"view sites\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:12:\"create sites\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:10:\"edit sites\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:12:\"delete sites\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:10:\"view users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:12:\"create users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:10:\"edit users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:12:\"delete users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:10:\"view roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:12:\"create roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:10:\"edit roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:12:\"delete roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:13:\"view settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:15:\"create settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:13:\"edit settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:15:\"delete settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:14:\"view dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:10:\"view story\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:13:\"view missions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:12:\"view contact\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:16:\"view submissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:8:\"view seo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:17:\"view page content\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:18:\"view developer api\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:10:\"superadmin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:8:\"customer\";s:1:\"c\";s:3:\"web\";}}}', 1776073897);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Custom Website Development', 'custom-website-development', NULL, 'active', '2026-03-31 07:01:17', '2026-04-02 02:57:08'),
(2, 'E-commerce Solutions', 'e-commerce-solutions', NULL, 'active', '2026-03-31 07:10:01', '2026-04-02 02:57:00'),
(3, 'Mobile App Development', 'mobile-app-development', NULL, 'active', '2026-03-31 07:10:12', '2026-04-02 02:56:50'),
(4, 'ERP Software', 'erp-software', NULL, 'active', '2026-03-31 07:10:24', '2026-04-02 02:56:36'),
(5, 'Web Application Development', 'web-application-development', NULL, 'active', '2026-04-02 02:57:18', '2026-04-02 02:57:18'),
(6, 'SaaS Solutions', 'saas-solutions', NULL, 'active', '2026-04-02 02:57:29', '2026-04-02 02:57:29'),
(7, 'CRM Software', 'crm-software', NULL, 'active', '2026-04-02 02:57:36', '2026-04-02 02:57:36'),
(8, 'POS System', 'pos-system', NULL, 'active', '2026-04-02 02:57:43', '2026-04-02 02:57:43'),
(9, 'Inventory Management System', 'inventory-management-system', NULL, 'active', '2026-04-02 02:57:50', '2026-04-02 02:57:50'),
(10, 'Accounting Software', 'accounting-software', NULL, 'active', '2026-04-02 02:57:59', '2026-04-02 02:57:59'),
(11, 'HRM Software', 'hrm-software', NULL, 'active', '2026-04-02 02:58:13', '2026-04-02 02:58:13'),
(12, 'School Management System', 'school-management-system', NULL, 'active', '2026-04-02 02:58:27', '2026-04-02 02:58:27'),
(13, 'Hospital Management System', 'hospital-management-system', NULL, 'active', '2026-04-02 02:58:37', '2026-04-02 02:58:37'),
(14, 'Booking System', 'booking-system', NULL, 'active', '2026-04-02 02:58:44', '2026-04-02 02:58:44'),
(15, 'API Development', 'api-development', NULL, 'active', '2026-04-02 02:58:50', '2026-04-02 02:58:50'),
(16, 'UI/UX Design', 'uiux-design', NULL, 'active', '2026-04-02 02:59:15', '2026-04-02 02:59:15'),
(17, 'Digital Marketing', 'digital-marketing', NULL, 'active', '2026-04-02 02:59:22', '2026-04-02 02:59:22'),
(18, 'Cloud Solutions', 'cloud-solutions', NULL, 'active', '2026-04-02 02:59:30', '2026-04-02 02:59:30'),
(19, 'Cyber Security', 'cyber-security', NULL, 'active', '2026-04-02 02:59:37', '2026-04-02 02:59:37'),
(20, 'Maintenance & Support', 'maintenance-support', NULL, 'active', '2026-04-02 02:59:43', '2026-04-02 02:59:43');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `logo`, `url`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Japan Bangladesh Ideas & Technologies Ltd.', 'uploads/clients/client-5_69d62a70c3b41.jpg', 'https://jbitl.net', 0, 1, '2026-03-31 07:19:46', '2026-04-08 20:14:20'),
(2, 'Interior Designers Association of Bangladesh', 'uploads/clients/client-0_69d605403f4f8.jpg', 'http://idab.com.bd', 0, 1, '2026-04-08 17:29:02', '2026-04-08 20:15:24'),
(3, 'BAFIITA', 'uploads/clients/client-4_69d60433cc990.jpg', 'https://bafiita.org.bd', 0, 1, '2026-04-08 17:30:59', '2026-04-08 17:35:42'),
(4, 'ICON ISL', 'uploads/clients/client-2_69d6044dcd118.jpg', 'https://iconisl.com.bd', 0, 1, '2026-04-08 17:31:25', '2026-04-08 17:31:25'),
(5, 'Flat Buy Sale BD', 'uploads/clients/client-1_69d604704b2b1.jpg', 'https://flatbuysalebd.com', 0, 1, '2026-04-08 17:32:00', '2026-04-08 17:32:00'),
(6, 'H & I Council', 'uploads/clients/client-3_69d604a1f1485.jpg', 'https://hic.com.bd', 0, 1, '2026-04-08 17:32:49', '2026-04-08 17:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_name` varchar(255) NOT NULL,
  `icon_class` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `feature_name`, `icon_class`, `status`, `created_at`, `updated_at`) VALUES
(1, 'User Management', NULL, 'active', '2026-03-31 07:01:35', '2026-04-02 03:03:35'),
(2, 'Authentication & Security', NULL, 'active', '2026-04-02 03:03:44', '2026-04-02 03:03:44'),
(3, 'Dashboard & Analytics', NULL, 'active', '2026-04-02 03:03:52', '2026-04-02 03:03:52'),
(4, 'Reporting System', NULL, 'active', '2026-04-02 03:03:59', '2026-04-02 03:03:59'),
(5, 'Notification System', NULL, 'active', '2026-04-02 03:04:08', '2026-04-02 03:04:08'),
(6, 'Multi-language Support', NULL, 'active', '2026-04-02 03:04:15', '2026-04-02 03:04:15'),
(7, 'Multi-user / Multi-tenant System', NULL, 'active', '2026-04-02 03:04:34', '2026-04-02 03:04:34'),
(8, 'Customer Management', NULL, 'active', '2026-04-02 03:04:49', '2026-04-02 03:04:49'),
(9, 'Order / Sales Management', NULL, 'active', '2026-04-02 03:04:56', '2026-04-02 03:04:56'),
(10, 'Inventory / Stock Management', NULL, 'active', '2026-04-02 03:05:02', '2026-04-02 03:05:02'),
(11, 'Billing & Invoicing', NULL, 'active', '2026-04-02 03:05:09', '2026-04-02 03:05:09'),
(12, 'Payment Gateway Integration', NULL, 'active', '2026-04-02 03:05:17', '2026-04-02 03:05:17'),
(13, 'Subscription & Plan Management', NULL, 'active', '2026-04-02 03:05:27', '2026-04-02 03:05:27'),
(14, 'Expense & Income Tracking', NULL, 'active', '2026-04-02 03:05:34', '2026-04-02 03:05:34'),
(15, 'API Integration', NULL, 'active', '2026-04-02 03:05:42', '2026-04-02 03:05:42'),
(16, 'Third-party Integration', NULL, 'active', '2026-04-02 03:05:50', '2026-04-02 03:05:50'),
(17, 'Cloud Storage Support', NULL, 'active', '2026-04-02 03:05:58', '2026-04-02 03:05:58'),
(18, 'Backup & Restore System', NULL, 'active', '2026-04-02 03:06:04', '2026-04-02 03:06:04'),
(19, 'Performance Optimization', NULL, 'active', '2026-04-02 03:06:11', '2026-04-02 03:06:11'),
(20, 'SEO Optimization', NULL, 'active', '2026-04-02 03:06:19', '2026-04-02 03:06:19'),
(21, 'Responsive Design', NULL, 'active', '2026-04-02 03:06:34', '2026-04-02 03:06:34'),
(22, 'Cross-platform Support', NULL, 'active', '2026-04-02 03:06:41', '2026-04-02 03:06:41'),
(23, 'User-friendly UI/UX', NULL, 'active', '2026-04-02 03:06:48', '2026-04-02 03:06:48'),
(24, 'Offline Mode', NULL, 'active', '2026-04-02 03:06:58', '2026-04-02 03:06:58'),
(25, 'Push Notifications', NULL, 'active', '2026-04-02 03:07:08', '2026-04-02 03:07:08'),
(26, 'Role-based Access Control', NULL, 'active', '2026-04-02 03:07:21', '2026-04-02 03:07:21'),
(27, 'Data Encryption & Security', NULL, 'active', '2026-04-02 03:07:28', '2026-04-02 03:07:28'),
(28, 'Activity Logs / Audit Trail', NULL, 'active', '2026-04-02 03:07:36', '2026-04-02 03:07:36'),
(29, 'AI / Automation Features', NULL, 'active', '2026-04-02 03:07:44', '2026-04-02 03:07:44'),
(30, 'Real-time Updates', NULL, 'active', '2026-04-02 03:07:53', '2026-04-02 03:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('image','video','document') NOT NULL DEFAULT 'image',
  `alt_text` varchar(255) DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_main` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `name`, `path`, `model_type`, `model_id`, `type`, `alt_text`, `size`, `sort_order`, `is_main`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'apps_69ce3627c3496.gif', 'uploads/apps-69ce3627c3496_69db674cef31a.gif', 'App\\Models\\Service', 1, 'image', 'Mobile App Development', 1764401, 0, 1, 2, '2026-04-12 09:35:08', '2026-04-12 09:35:08'),
(3, 'erp_69ce363ac8ab2.gif', 'uploads/erp-69ce363ac8ab2_69db6757f2289.gif', 'App\\Models\\Service', 3, 'image', 'ERP Solution & Hardware', 1544141, 0, 1, 2, '2026-04-12 09:35:19', '2026-04-12 09:35:19'),
(5, 'website_69ce41f8c46b9.gif', 'uploads/website-69ce41f8c46b9_69db67718d53a.gif', 'App\\Models\\Service', 2, 'image', 'Web Design & Development', 163667, 0, 1, 2, '2026-04-12 09:35:45', '2026-04-12 09:39:10'),
(6, 'gif_69ce4145a92ad.gif', 'uploads/gif-69ce4145a92ad_69db683e7c143.gif', 'App\\Models\\Service', 2, 'image', 'Web Design & Development', 60395, 0, 0, 2, '2026-04-12 09:39:10', '2026-04-12 09:39:10'),
(7, 'srpago-branddesign-gif-by-23-design_69ce4145a1b22.gif', 'uploads/srpago-branddesign-gif-by-23-design-69ce4145a1b22_69db683e7c9b8.gif', 'App\\Models\\Service', 2, 'image', 'Web Design & Development', 904925, 0, 0, 2, '2026-04-12 09:39:10', '2026-04-12 09:39:10'),
(8, 'webdevelopment_69ce380e3afe4.gif', 'uploads/webdevelopment-69ce380e3afe4_69db683e7d039.gif', 'App\\Models\\Service', 2, 'image', 'Web Design & Development', 311245, 0, 0, 2, '2026-04-12 09:39:10', '2026-04-12 09:39:10'),
(12, 'gif-1_69ce4145a0f1b.gif', 'uploads/gif-1-69ce4145a0f1b_69db6cba6ea34.gif', 'App\\Models\\Service', 4, 'image', 'E-commerce Development', 337834, 0, 1, 2, '2026-04-12 09:58:18', '2026-04-12 09:58:18'),
(13, 'demo6.jpeg', 'uploads/demo6_69db6d3508c16.jpeg', 'App\\Models\\Project', 1, 'image', 'IDAB', 498462, 0, 1, 2, '2026-04-12 10:00:21', '2026-04-12 10:00:34'),
(14, 'demo6-mobile.jpeg', 'uploads/demo6-mobile_69db6d42da084.jpeg', 'App\\Models\\Project', 1, 'image', 'IDAB', 162164, 0, 0, 2, '2026-04-12 10:00:34', '2026-04-12 10:00:34'),
(15, 'demo6.jpeg', 'uploads/demo6_69db6d42db116.jpeg', 'App\\Models\\Project', 1, 'image', 'IDAB', 498462, 0, 0, 2, '2026-04-12 10:00:34', '2026-04-12 10:00:34'),
(16, 'demo5-mobile.jpeg', 'uploads/demo5-mobile_69db6d5014ecc.jpeg', 'App\\Models\\Project', 2, 'image', 'Shop Sky Tech Solve', 156669, 0, 1, 2, '2026-04-12 10:00:48', '2026-04-12 10:00:48'),
(17, 'demo5.jpeg', 'uploads/demo5_69db6d50158d5.jpeg', 'App\\Models\\Project', 2, 'image', 'Shop Sky Tech Solve', 557853, 0, 0, 2, '2026-04-12 10:00:48', '2026-04-12 10:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '0001_01_01_000003_create_permission_tables', 1),
(6, '2025_01_11_000002_create_seos_table', 1),
(7, '2025_01_11_000003_create_pages_table', 1),
(9, '2025_01_11_202504_create_attachments_table', 1),
(10, '2025_08_26_060808_create_categories_table', 1),
(11, '2025_08_26_080422_create_features_table', 1),
(12, '2025_08_26_080426_create_tags_table', 1),
(13, '2025_08_27_060809_create_services_table', 1),
(14, '2025_08_27_060810_create_service_features_table', 1),
(15, '2025_08_31_050526_create_testimonials_table', 1),
(18, '2025_08_31_090108_create_stories_table', 1),
(19, '2025_08_31_101835_create_teams_table', 1),
(20, '2025_08_31_110639_create_missions_table', 1),
(21, '2025_08_31_190722_create_clients_table', 1),
(22, '2025_09_02_085107_create_achievements_table', 1),
(23, '2025_09_03_171314_create_projects_table', 1),
(24, '2025_09_12_234919_create_blog_posts_table', 1),
(25, '2025_09_12_234920_create_blog_comments_table', 1),
(26, '2025_09_12_235117_create_blog_post_tags_table', 1),
(27, '2026_03_30_051056_create_sites_table', 1),
(28, '2026_04_01_082751_create_sliders_table', 2),
(31, '2025_01_11_000001_create_settings_table', 5),
(33, '2026_04_03_170338_create_visitor_records_table', 6),
(35, '2025_01_11_202503_media_table', 7),
(36, '2025_08_31_081220_create_contacts_table', 7),
(37, '2025_08_31_081221_create_submissions_table', 7),
(38, '2026_04_07_204417_create_products_table', 7),
(39, '2026_04_07_204900_create_price_plans_table', 7),
(40, '2026_04_12_110230_add_show_in_menu_to_services_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `missions`
--

CREATE TABLE `missions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `mission_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`mission_items`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `missions`
--

INSERT INTO `missions` (`id`, `image_path`, `mission_items`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/mission/1724927882-66d04f8a6a0a5_69cce224186f0.png', '[{\"icon_class\":\"fa-solid fa-\",\"title\":\"sdfsd\",\"description\":\"fdsfdsf\",\"order\":\"1\",\"status\":\"active\"},{\"icon_class\":\"fa-solid fa-\",\"title\":\"sdfdsfds\",\"description\":\"sdfsdf\",\"order\":\"2\",\"status\":\"active\"}]', 1, '2026-04-01 03:15:16', '2026-04-01 03:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(1, 'home', 'home', '{\"slider\":{\"title\":\"TEAMWORK MAKES THE DREAM WORK\",\"sub_title\":\"WELCOME\",\"button_text\":\"Explore\",\"button_url\":\"https:\\/\\/skytechsolve.com\"},\"testimonial\":{\"title\":\"What Client Says s\",\"description\":\"<p><span style=\\\"font-size: 13.008px;\\\">Our clients trust us for our expertise and honesty. We deliver smart software solutions that help businesses grow, with a focus on quality, transparency, and long-term success.<\\/span><\\/p>\"}}', '2026-03-31 05:37:34', '2026-04-03 10:41:51'),
(2, 'about', 'about', '{\"header\":{\"title\":\"About Us\",\"subtitle\":\"The Interior speak for themselves\"},\"features_box1\":{\"title\":\"Perfect Design s\",\"sub_title\":\"A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.\"},\"features_box2\":{\"title\":\"Carefully Planned\",\"sub_title\":\"A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.\"},\"features_box3\":{\"title\":\"Smartly Execute\",\"sub_title\":\"A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.\"},\"process\":{\"step1\":{\"title\":\"excecution\",\"text\":\"When an unknown printer took a galley of type and scrambled it to make a book.\"},\"step2\":{\"title\":\"Concept\",\"text\":\"When an unknown printer took a galley of type and scrambled it to make a book.\"},\"step3\":{\"title\":\"Idea\",\"text\":\"When an unknown printer took a galley of type and scrambled it to make a book.\"},\"step4\":{\"title\":\"Design\",\"text\":\"When an unknown printer took a galley of type and scrambled it to make a book.\"}},\"video\":{\"title\":\"Campaign Video\",\"header\":\"We Give You The Best\",\"url\":\"https:\\/\\/www.youtube.com\\/watch?v=tA0iW19H_d4&list=RDtA0iW19H_d4&start_radio=1\",\"text\":\"Present all the speakers and participants in GenesisExpo`s beautiful layouts. Choose your favorite variant of layout and create your own. You can create also single speaker profile with all relevant information.\"}}', '2026-03-31 05:37:34', '2026-04-04 07:57:06'),
(3, 'teams', 'teams', '{\"header\":{\"title\":null,\"subtitle\":null},\"cta\":{\"title\":\"Join Our Passionate Team\",\"subtitle\":\"We are always looking for talented individuals to create amazing spaces together.\",\"button_text\":null,\"button_link\":null}}', '2026-03-31 12:33:02', '2026-04-04 07:16:49'),
(4, 'contact', 'contact', '{\"header\":{\"title\":\"Contact Us\",\"subtitle\":\"The Interior speak for themselves\"}}', '2026-03-31 12:33:05', '2026-04-03 09:54:54'),
(5, 'services', 'services', '{\"header\":{\"title\":\"Services\",\"subtitle\":\"The Interior speak for themselves\"},\"services_offer\":{\"title\":\"Special Offer\",\"header\":\"How to save money on repairs\",\"discount\":\"60%\",\"description\":\"Fill out the form to download a book with 10 tips\\r\\non how to save your money\"},\"services_content\":{\"title\":\"Our Specialization\",\"header\":\"Architectural Design\",\"description\":\"<p style=\\\"margin-right: 0px; margin-bottom: 30px; margin-left: 0px; padding: 0px; border: none; outline: none; font-size: 14px; line-height: 30px; color: rgb(119, 119, 119); position: relative; font-family: Arimo, sans-serif;\\\">Quality over quantity, so the saying goes. With so many concepts floating around the architectural profession, it can be difficult to keep up with all the ideas which you\\u2019re expected to know.<\\/p><p style=\\\"margin-right: 0px; margin-bottom: 30px; margin-left: 0px; padding: 0px; border: none; outline: none; font-size: 14px; line-height: 30px; color: rgb(119, 119, 119); position: relative; font-family: Arimo, sans-serif;\\\">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they.It has survived not only five centuries. When an unknown printer took a galley of type and scrambled it to make a type specimen book.<\\/p>\",\"button_text\":\"Read More\",\"button_link\":\"https:\\/\\/preview.themeforest.net\\/item\"}}', '2026-03-31 12:33:07', '2026-04-04 08:25:25'),
(6, 'projects', 'projects', NULL, '2026-03-31 12:33:10', '2026-03-31 12:32:55'),
(7, 'projects-video', 'projects-video', NULL, '2026-03-31 12:33:12', '2026-03-31 12:32:57'),
(8, 'blogs', 'blogs', NULL, '2026-03-31 12:33:15', '2026-03-31 12:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view sliders', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(2, 'create sliders', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(3, 'edit sliders', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(4, 'delete sliders', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(5, 'view categories', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(6, 'create categories', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(7, 'edit categories', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(8, 'delete categories', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(9, 'view features', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(10, 'create features', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(11, 'edit features', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(12, 'delete features', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(13, 'view tags', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(14, 'create tags', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(15, 'edit tags', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(16, 'delete tags', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(17, 'view services', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(18, 'create services', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(19, 'edit services', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(20, 'delete services', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(21, 'view projects', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(22, 'create projects', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(23, 'edit projects', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(24, 'delete projects', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(25, 'view products', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(26, 'create products', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(27, 'edit products', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(28, 'delete products', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(29, 'view testimonials', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(30, 'create testimonials', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(31, 'edit testimonials', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(32, 'delete testimonials', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(33, 'view achievements', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(34, 'create achievements', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(35, 'edit achievements', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(36, 'delete achievements', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(37, 'view teams', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(38, 'create teams', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(39, 'edit teams', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(40, 'delete teams', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(41, 'view clients', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(42, 'create clients', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(43, 'edit clients', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(44, 'delete clients', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(45, 'view blogs', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(46, 'create blogs', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(47, 'edit blogs', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(48, 'delete blogs', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(49, 'view sites', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(50, 'create sites', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(51, 'edit sites', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(52, 'delete sites', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(53, 'view users', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(54, 'create users', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(55, 'edit users', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(56, 'delete users', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(57, 'view roles', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(58, 'create roles', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(59, 'edit roles', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(60, 'delete roles', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(61, 'view settings', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(62, 'create settings', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(63, 'edit settings', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(64, 'delete settings', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(65, 'view dashboard', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(66, 'view story', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(67, 'view missions', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(68, 'view contact', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(69, 'view submissions', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(70, 'view seo', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(71, 'view page content', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(72, 'view developer api', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04');

-- --------------------------------------------------------

--
-- Table structure for table `price_plans`
--

CREATE TABLE `price_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `features` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `buy_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `tech_stack` varchar(255) DEFAULT NULL,
  `launch_year` year(4) DEFAULT NULL,
  `project_budget` decimal(15,2) DEFAULT NULL,
  `live_link` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `category_id`, `title`, `slug`, `description`, `client_name`, `location`, `tech_stack`, `launch_year`, `project_budget`, `live_link`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'IDAB', 'idab', 'IDAB recognized institute with 5 years\' experience', 'Walter Haney', 'Bangaldesh', 'Python, Java, Node.js, Ruby', '2022', 10000.00, 'https://skytechsolve.com', 1, '2026-03-31 07:14:59', '2026-04-04 09:32:13'),
(2, 2, 'Shop Sky Tech Solve', 'shop-sky-tech-solve', 'sfdsfdsf', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-03-31 07:16:18', '2026-03-31 07:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(2, 'admin', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04'),
(3, 'customer', 'web', '2026-04-12 09:51:04', '2026-04-12 09:51:04');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(55, 1),
(55, 2),
(56, 1),
(56, 2),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(59, 2),
(60, 1),
(60, 2),
(61, 1),
(61, 2),
(62, 1),
(62, 2),
(63, 1),
(63, 2),
(64, 1),
(64, 2),
(65, 1),
(65, 2),
(65, 3),
(66, 1),
(66, 2),
(67, 1),
(67, 2),
(68, 1),
(68, 2),
(69, 1),
(69, 2),
(70, 1),
(70, 2),
(71, 1),
(71, 2),
(72, 1),
(72, 2),
(72, 3);

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `canonical_url` varchar(255) DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` text DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `twitter_card` varchar(255) DEFAULT NULL,
  `robots` varchar(255) NOT NULL DEFAULT 'index, follow',
  `seoable_type` varchar(255) NOT NULL,
  `seoable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `meta_title`, `meta_description`, `meta_keywords`, `canonical_url`, `og_title`, `og_description`, `og_image`, `twitter_card`, `robots`, `seoable_type`, `seoable_id`, `created_at`, `updated_at`) VALUES
(1, 'Sky Tech Solve | Mobile App Development Company in Bangladesh', 'Mobile app development is the process of creating software for smartphones and tablets', 'mobile app development, app development company, android app development, ios app development, cross platform app, mobile application development Bangladesh, app development services, custom mobile apps, Sky Tech Solve', NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\Service', 1, '2026-03-31 07:03:22', '2026-04-12 09:35:08'),
(2, 'Sky Tech Solve | Web Design & Development Company in Bangladesh', 'Sky Tech Solve offers professional web design and development services in Bangladesh. Get SEO-friendly, responsive, and fast-loading websites, including custom business and eCommerce solutions to grow your online presence.', 'web design, web development, web design company in Bangladesh, SEO friendly website, responsive web design, ecommerce website development, custom website development, website design services, web development company, Sky Tech Solve', NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\Service', 2, '2026-03-31 07:04:48', '2026-04-12 09:39:10'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\Project', 1, '2026-03-31 07:14:59', '2026-04-12 10:00:34'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\Project', 2, '2026-03-31 07:16:18', '2026-04-12 10:00:48'),
(5, 'Top 10 Web Design Trends in 2026 | Sky Tech Solve', 'Explore the latest web design trends in 2026, including minimal layouts, AI-powered interfaces, and SEO-friendly designs to improve user experience.', 'web design trends, 2026 web design, responsive design, SEO web design, modern website design', NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\BlogPost', 1, '2026-03-31 07:18:43', '2026-04-02 11:12:17'),
(6, 'Consequatur minima', 'tesdf', 'tew', NULL, NULL, NULL, 'uploads/seo/gemini-generated-image-pwe9v8pwe9v8pwe9_69cd18c7d3951.png', NULL, 'index, follow', 'App\\Models\\Team', 1, '2026-04-01 07:08:16', '2026-04-01 07:08:23'),
(7, 'Sky Tech Solve | ERP Software Solution Company in Bangladesh', 'Sky Tech Solve offers advanced ERP software solutions in Bangladesh to manage inventory, accounts, HR, and business operations efficiently with secure and scalable systems.', 'ERP solution, ERP software Bangladesh, enterprise resource planning system, business management software, inventory management system, accounting ERP, HR management software, custom ERP development, Sky Tech Solve', NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\Service', 3, '2026-04-02 03:26:18', '2026-04-12 09:35:19'),
(8, 'Sky Tech Solve | eCommerce Website Development Company in Bangladesh', 'Sky Tech Solve provides professional eCommerce website development services in Bangladesh. Build secure, fast, and SEO-friendly online stores to grow your business and increase sales.', 'ecommerce development, ecommerce website Bangladesh, online store development, ecommerce website design, shopping website development, payment gateway integration, custom ecommerce solution, ecommerce company Bangladesh, Sky Tech Solve', NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\Service', 4, '2026-04-02 03:29:25', '2026-04-12 09:58:18'),
(9, 'How Mobile Apps Boost Business Growth | Sky Tech Solve', 'Discover how mobile apps for Android, iOS, and cross-platform solutions enhance sales, engagement, and brand loyalty for businesses.', 'mobile app development, business growth apps, Android apps, iOS apps, cross-platform apps', NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\BlogPost', 2, '2026-04-02 05:24:16', '2026-04-02 11:10:30'),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\BlogPost', 3, '2026-04-02 05:25:50', '2026-04-02 05:26:07'),
(11, 'eCommerce Development Services in 2026 | Sky Tech Solve', 'Build a high-performance eCommerce website with responsive design, SEO optimization, and secure payment integration to increase online sales.', 'ecommerce development, online store development, SEO ecommerce, responsive ecommerce website, payment gateway integration', NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\BlogPost', 4, '2026-04-02 05:27:29', '2026-04-02 11:09:51'),
(12, 'Why SEO is Important for Business Websites | Sky Tech Solve', 'Learn how SEO improves search rankings, drives organic traffic, and increases conversions for your business website effectively.', 'SEO for business, SEO website optimization, search engine ranking, organic traffic, SEO tips', NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\BlogPost', 5, '2026-04-02 05:29:03', '2026-04-02 11:09:20'),
(13, 'Top 10 Web Design Trends in 2026 | Sky Tech Solve', 'Explore the latest web design trends in 2026, including minimal layouts, AI-powered interfaces, and SEO-friendly designs to improve user experience.', 'web design trends, 2026 web design, responsive design, SEO web design, modern website design', NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\BlogPost', 6, '2026-04-02 05:30:37', '2026-04-02 11:03:20'),
(14, 'Future of Digital Marketing in Bangladesh | Sky Tech Solve', 'Discover evolving digital marketing strategies in Bangladesh, including SEO, social media, and content marketing to grow your brand online.', 'digital marketing Bangladesh, SEO Bangladesh, social media marketing, content marketing, online business growth', NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\BlogPost', 7, '2026-04-02 11:04:32', '2026-04-02 11:08:37'),
(15, 'AI in Mobile App Development | Sky Tech Solve', 'Learn how Artificial Intelligence is enhancing mobile apps with chatbots, predictive analytics, and automation to improve user experience.', 'AI in mobile apps, artificial intelligence apps, app development AI, AI-powered mobile apps, smart mobile applications', NULL, NULL, NULL, NULL, NULL, 'index, follow', 'App\\Models\\BlogPost', 8, '2026-04-02 11:06:04', '2026-04-02 11:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_menu` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `description`, `icon`, `sort_order`, `status`, `is_menu`, `created_at`, `updated_at`) VALUES
(1, 'Mobile App Development', 'mobile-app-development', 'Sky Tech Solve offers professional mobile app development services to build high-quality, user-friendly, and scalable applications. We specialize in creating Android apps, iOS apps, and cross-platform mobile applications tailored to your business needs.\r\n\r\nOur expert developers ensure fast performance, secure architecture, and modern UI/UX design to deliver seamless user experiences. Using the latest technologies and best practices, we help your business grow with powerful mobile solutions that engage users and increase conversions.', NULL, 2, 1, 0, '2026-03-31 07:03:22', '2026-04-02 04:25:37'),
(2, 'Web Design & Development', 'web-design-development', 'Sky Tech Solve is a leading web design and development company offering modern, responsive, and SEO-friendly website solutions. We specialize in custom website development, eCommerce website design, and scalable web applications tailored to your business needs.\r\n\r\nOur expert team delivers fast-loading, secure, and user-friendly websites using the latest technologies and SEO best practices. Sky Tech Solve helps improve your online presence, increase search engine rankings, and attract more customers in the competitive digital world.', NULL, 1, 1, 0, '2026-03-31 07:04:48', '2026-04-02 04:22:06'),
(3, 'ERP Solution & Hardware', 'erp-solution-hardware', 'Sky Tech Solve provides powerful ERP (Enterprise Resource Planning) solutions to streamline and automate your business operations. Our custom ERP systems help manage accounts, inventory, sales, HR, and reporting in one centralized platform.\r\n\r\nWe develop scalable, secure, and user-friendly ERP software tailored to your business needs. With real-time data insights, automation, and modern technology, our ERP solutions improve efficiency, reduce costs, and support smarter decision-making for business growth.', NULL, 3, 1, 0, '2026-04-02 03:26:18', '2026-04-02 04:26:27'),
(4, 'E-commerce Development', 'e-commerce-development', 'Sky Tech Solve offers professional eCommerce website development services to help businesses sell products online and efficiently. We build secure, scalable, and user-friendly online stores with modern design and smooth shopping experience.\r\n\r\nOur solutions include custom eCommerce websites, payment gateway integration, product management, and mobile-friendly design. With fast performance and SEO optimization, we help your online store attract more customers, increase sales, and grow your business in the digital marketplace.', NULL, 4, 1, 0, '2026-04-02 03:29:25', '2026-04-02 04:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `service_features`
--

CREATE TABLE `service_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `feature_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_features`
--

INSERT INTO `service_features` (`id`, `service_id`, `feature_id`, `created_at`, `updated_at`) VALUES
(3, 1, 2, NULL, NULL),
(4, 1, 3, NULL, NULL),
(5, 1, 4, NULL, NULL),
(6, 1, 5, NULL, NULL),
(7, 1, 6, NULL, NULL),
(8, 1, 7, NULL, NULL),
(9, 1, 8, NULL, NULL),
(10, 1, 9, NULL, NULL),
(11, 1, 10, NULL, NULL),
(12, 1, 11, NULL, NULL),
(13, 1, 12, NULL, NULL),
(14, 1, 13, NULL, NULL),
(15, 1, 14, NULL, NULL),
(16, 1, 15, NULL, NULL),
(17, 1, 16, NULL, NULL),
(18, 1, 17, NULL, NULL),
(19, 1, 19, NULL, NULL),
(20, 1, 20, NULL, NULL),
(21, 1, 21, NULL, NULL),
(22, 4, 1, NULL, NULL),
(23, 4, 2, NULL, NULL),
(24, 4, 3, NULL, NULL),
(25, 4, 4, NULL, NULL),
(26, 4, 5, NULL, NULL),
(27, 4, 6, NULL, NULL),
(28, 4, 8, NULL, NULL),
(29, 4, 9, NULL, NULL),
(30, 4, 12, NULL, NULL),
(31, 4, 16, NULL, NULL),
(32, 4, 17, NULL, NULL),
(33, 4, 20, NULL, NULL),
(34, 4, 26, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6Ky81x3B7iKmHNPFALCQazr0IVwlrhJtyyQ9iAPY', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRGoxR2V2RGx5ZmZXUGtGb0NhR0lRVFhOT0puVDFVaXNrZlRkc2VEMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly9sb2NhbGhvc3Qvc2t5dGVjaHNvbHZlLmNvbS9wdWJsaWMvcHJvamVjdHMiO3M6NToicm91dGUiO3M6MTQ6InByb2plY3RzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1775988061),
('8Vh8pJxL822EXxviGmK9EZQNffkJh3AEhCsE3afP', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTnNYQnhHZ2dPWHJqd2xneGxWWkE4OWs5SEloUXpteGYzeEk0UEVnYSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjUwOiJodHRwOi8vbG9jYWxob3N0L3NreXRlY2hzb2x2ZS5jb20vcHVibGljL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1775986276);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logo_dark` varchar(255) DEFAULT NULL,
  `logo_light` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email2` varchar(255) DEFAULT NULL,
  `alert_email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `map_url` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `copyright_text` text DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `telegram` varchar(255) DEFAULT NULL,
  `is_loading` tinyint(1) NOT NULL DEFAULT 1,
  `is_slider` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `logo`, `logo_dark`, `logo_light`, `favicon`, `phone`, `phone2`, `email`, `email2`, `alert_email`, `address`, `map_url`, `description`, `copyright_text`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`, `whatsapp`, `telegram`, `is_loading`, `is_slider`, `created_at`, `updated_at`) VALUES
(1, 'Sky Tech Solve', 'uploads/setting/1775131957_logo.png', 'uploads/setting/1775131957_black-logo.png', 'uploads/setting/1775135738_white-logo.png', 'uploads/setting/1775132005_favicon.png', '01577298633', '01909302126', 'skytechsolve@gmail.com', 'info@skytechsolve.com', 'motiur.cmt@gmail.com', 'Mirpur 10, Dhaka, Bangladesh', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15742.533782003527!2d90.3645132000699!3d23.80285485672554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0d33532b3fb%3A0x2b27b0c01cb2bc0d!2sMirpur-10%2C%20Dhaka!5e1!3m2!1sen!2sbd!4v1775049339603!5m2!1sen!2sbd', 'At Sky Tech Solve, we deliver smart ERP solutions, high-performing eCommerce websites, and custom software designed to accelerate your business growth in the digital world.', '<p>Copyright © 2026 <a href=\"https://skytechsolve.com\" class=\"text-white\">skytechsolve.com</a> All right reserved</p>', 'https://www.facebook.com/skytechsolve', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2026-04-01 07:21:14', '2026-04-06 08:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_up` tinyint(1) NOT NULL DEFAULT 1,
  `last_down_at` timestamp NULL DEFAULT NULL,
  `response_time_ms` int(11) DEFAULT NULL,
  `last_checked_at` timestamp NULL DEFAULT NULL,
  `alert_email` varchar(255) DEFAULT NULL,
  `is_down_notified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `user_id`, `name`, `url`, `is_up`, `last_down_at`, `response_time_ms`, `last_checked_at`, `alert_email`, `is_down_notified`, `created_at`, `updated_at`) VALUES
(1, 2, 'Cox\'s Bazar', 'https://skytechsolve.com', 1, NULL, NULL, NULL, 'motiur.cmt@gmail.com', 0, '2026-04-08 01:18:24', '2026-04-08 01:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `link_text` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `subtitle`, `link_text`, `link_url`, `image`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Web Development', 'Meke best quality website.', 'View', 'skytechsolve.com', 'uploads/sliders/1726697059-66eb4e639940d_69ccde362ef90.png', 1, 0, '2026-04-01 02:56:39', '2026-04-01 02:58:30'),
(2, 'Sit non et rerum lab', 'In excepteur reicien', 'Quis sunt impedit', 'Enim magna qui aut e', 'uploads/sliders/multiple-image-slider-wordpress_69ccfa7631fa4.png', 1, 80, '2026-04-01 04:59:02', '2026-04-01 04:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `title`, `content`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Our Story', '<div>\r\n    <p style=\"margin-bottom: 10px\">\r\n        <strong>Sky Tech Solve</strong>, established in 2023, is a fast-growing\r\n        <strong>software company</strong> delivering smart, scalable, and high-quality digital solutions.\r\n        We help businesses succeed with modern technology and creative ideas.\r\n    </p>\r\n\r\n    <p style=\"margin-bottom: 10px\">\r\n        We specialize in <strong>web development</strong>, <strong>custom software</strong>,\r\n        <strong>e-commerce solutions</strong>, and <strong>UI/UX design</strong>, turning ideas into\r\n        powerful digital products.\r\n    </p>\r\n\r\n    <p style=\"margin-bottom: 10px\">\r\n        Built on <strong>honesty</strong> and <strong>trust</strong>, we provide\r\n        <strong>full-time support</strong> and aim to grow as a <strong>top IT company in Bangladesh</strong>.\r\n    </p>\r\n</div>', NULL, 1, '2026-03-31 07:06:20', '2026-04-08 16:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `slug`, `position`, `bio`, `image`, `facebook`, `twitter`, `instagram`, `linkedin`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Motiur Rahman', 'motiur-rahman', 'Managing Director', NULL, 'uploads/team/gemini-generated-image-sdmsvqsdmsvqsdms_69cbcacb705f8.png', NULL, 'https://www.twitter.com/prodevslimited', 'https://www.instagram.com/prodevslimited', NULL, 0, 1, '2026-03-31 07:17:41', '2026-04-01 07:02:15');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `client_name`, `position`, `company`, `content`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Colin Gordon', 'Error ratione non qu', 'Roth Nielsen Associates', 'Explicabo Dolor ut blanditiis obcaecati error id in nisi sit sunt molestias nostrum impedit ex ut neque reiciendis', 'uploads/testimonials/20250617-172801-68ed56d1ae32c_69ce3eba72534.jpg', 1, '2026-03-31 07:24:47', '2026-04-02 04:02:34'),
(2, 'Paula Johnston', 'Doloribus quos ipsum', 'Townsend Paul Co', 'Repellendus Ad ipsam sed aute expedita in modi id perspiciatis duis deleniti', 'uploads/testimonials/1724929770-66d056ea4eb67_69ce3ed9cad46.jpg', 1, '2026-04-02 04:03:05', '2026-04-02 04:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `api_token` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `photo_path`, `api_token`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super@gmail.com', NULL, NULL, '$2y$12$mqXbpGXqDoX1eCDSxS62aua7Kc..yk.At/yWhjhO8wFS9VgWD/gtG', NULL, NULL, 1, NULL, '2026-03-31 05:37:33', '2026-03-31 05:37:33'),
(2, 'Admin User', 'admin@gmail.com', NULL, NULL, '$2y$12$LhK9A/5KAu1ln6G72ezlSu3C2axDwqRfW6p1rbTuCFTaThc4So/g6', NULL, NULL, 1, 'OBwnkXQ2FVbD8dt9xaTa68teLQfjMAMrel96S4piUGnPzD3gggA6pWZwp5zo', '2026-03-31 05:37:33', '2026-03-31 05:37:33'),
(3, 'Customer User', 'customer@gmail.com', NULL, NULL, '$2y$12$sVqquOUBNb7O/ZRjDqr//uo.LxJUvT/wqjG6YvLZv4k6nG1v.Y.0e', NULL, NULL, 1, NULL, '2026-03-31 05:37:34', '2026-03-31 05:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_records`
--

CREATE TABLE `visitor_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `visit_type` varchar(255) NOT NULL DEFAULT 'page',
  `referrer_url` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitor_records`
--

INSERT INTO `visitor_records` (`id`, `ip_address`, `user_agent`, `device_type`, `browser`, `platform`, `page_url`, `visit_type`, `referrer_url`, `country`, `city`, `latitude`, `longitude`, `session_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '182.44.67.97', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'China', 'Jinan', '36.6683', '117.021', 'tETZ6VswXTzMfPGJnRzFxFxUQC5TAWqsNYhJVUw9', NULL, '2026-04-07 15:55:39', '2026-04-07 15:55:39'),
(2, '43.130.3.120', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', 'tWVevIADPPsFjy7KJFI4oAJMxjwz9R9xe3yJcWyS', NULL, '2026-04-07 17:51:44', '2026-04-07 17:51:44'),
(3, '124.236.100.56', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'China', 'Xinchengpu', '38.2679', '114.683', 'Lj5NJ7PJb497NYkphsYrfRmRv1q2LZMi8TBfoYZ0', NULL, '2026-04-07 17:52:03', '2026-04-07 17:52:03'),
(4, '180.153.236.51', 'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0; 360Spider', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', 'https://www.skytechsolve.com/', 'China', 'Shanghai', '31.2304', '121.474', 'MAbx916OYimh3Twvz2tkjWY72IbvILp9jivKjSEc', NULL, '2026-04-07 18:40:44', '2026-04-07 18:40:44'),
(5, '116.204.151.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'TYaTVlDRQDUjJTwDdnWowle0PE3phylCC08rndxf', 2, '2026-04-07 19:06:06', '2026-04-07 19:06:06'),
(6, '116.204.151.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'TYaTVlDRQDUjJTwDdnWowle0PE3phylCC08rndxf', 2, '2026-04-07 19:06:21', '2026-04-07 19:06:21'),
(7, '170.106.192.3', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', 'JxdL26HN2pib7nw4yaRs0k5uzT5Aaf8o1KirO1Y6', NULL, '2026-04-07 19:12:27', '2026-04-07 19:12:27'),
(8, '116.204.151.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/visitors?visit_type=bot&type=unique', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'TYaTVlDRQDUjJTwDdnWowle0PE3phylCC08rndxf', 2, '2026-04-07 19:30:57', '2026-04-07 19:30:57'),
(9, '18.208.218.98', 'Mozilla/5.0 (compatible; DotBot/1.1; http://www.opensiteexplorer.org/dotbot, help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', 'ea5mvzFxhFkpqCbBrUSJA5elI6Ha0d5eMXFWmLxM', NULL, '2026-04-07 20:24:20', '2026-04-07 20:24:20'),
(10, '18.208.218.98', 'Mozilla/5.0 (compatible; DotBot/1.1; http://www.opensiteexplorer.org/dotbot, help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', 'GLkk9tmz2sD3kYuDwCI3XEUCOQfy9Uryoxhtx02P', NULL, '2026-04-07 20:34:38', '2026-04-07 20:34:38'),
(11, '18.208.218.98', 'Mozilla/5.0 (compatible; DotBot/1.1; http://www.opensiteexplorer.org/dotbot, help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/about-us', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', 'inuKHaZWNGemJlTGt4EYqcxHyi1isbTvb5NiGb3z', NULL, '2026-04-07 20:34:39', '2026-04-07 20:34:39'),
(12, '18.208.218.98', 'Mozilla/5.0 (compatible; DotBot/1.1; http://www.opensiteexplorer.org/dotbot, help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-list', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', 'J9GESUYvuJw6PM2qCP0YL1jyvjKh2b5OvsC82jma', NULL, '2026-04-07 20:34:40', '2026-04-07 20:34:40'),
(13, '18.208.218.98', 'Mozilla/5.0 (compatible; DotBot/1.1; http://www.opensiteexplorer.org/dotbot, help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/mobile-app-development', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', 'bP0sNth7XYlchko3CyVYAJPlPiY8HqfUycH0DlBh', NULL, '2026-04-07 20:34:40', '2026-04-07 20:34:40'),
(14, '18.208.218.98', 'Mozilla/5.0 (compatible; DotBot/1.1; http://www.opensiteexplorer.org/dotbot, help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/web-design-development', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', '6eyrUmAJAm22Bx0iLAdNFr1G4GpYUU3O6RTLLaSk', NULL, '2026-04-07 20:34:41', '2026-04-07 20:34:41'),
(15, '18.208.218.98', 'Mozilla/5.0 (compatible; DotBot/1.1; http://www.opensiteexplorer.org/dotbot, help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/erp-solution-hardware', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', 'VRl4SpxoELsNgRrqS77TIvReMoWf3LKaKLzJEboq', NULL, '2026-04-07 20:34:41', '2026-04-07 20:34:41'),
(16, '18.208.218.98', 'Mozilla/5.0 (compatible; DotBot/1.1; http://www.opensiteexplorer.org/dotbot, help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/e-commerce-development', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', 't4jzQQ7Uq5eFazk8a00LfeubCpk3DSxMkue8GMIN', NULL, '2026-04-07 20:34:42', '2026-04-07 20:34:42'),
(17, '18.208.218.98', 'Mozilla/5.0 (compatible; DotBot/1.1; http://www.opensiteexplorer.org/dotbot, help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/projects-list', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', 'HRQfEanF3Kam86c4V0ED1EG9p0Qb6aGgAKmjQ3bv', NULL, '2026-04-07 20:34:43', '2026-04-07 20:34:43'),
(18, '198.235.24.42', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Santa Clara', '37.3834', '-121.983', 'fLpWUQQXqk7Imz2WA4ieN6Z3bgOaGpPaKISPpIOr', NULL, '2026-04-07 20:52:24', '2026-04-07 20:52:24'),
(19, '54.39.182.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Canada', 'Beauharnois', '45.3161', '-73.8736', 'U0uFj9O6KwU7cM1SOla6DHR27kUUJ40sc2NVO8HO', NULL, '2026-04-07 21:07:12', '2026-04-07 21:07:12'),
(20, '54.39.190.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Canada', 'Beauharnois', '45.3161', '-73.8736', '4lpGLHOm1ZsJ37bLnYhFaSdq5N1tTggfjn6HE7Im', NULL, '2026-04-07 21:07:20', '2026-04-07 21:07:20'),
(21, '54.39.190.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Canada', 'Beauharnois', '45.3161', '-73.8736', 'sOmUtbbHxMCUCp6NLCv1TFfT0kthNFo74iRqbUxB', NULL, '2026-04-07 21:08:01', '2026-04-07 21:08:01'),
(22, '54.39.190.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Canada', 'Beauharnois', '45.3161', '-73.8736', 'aW6o4faAMMSn5cqUoVVxnt6rW0lii91ZIhAftEFn', NULL, '2026-04-07 21:10:04', '2026-04-07 21:10:04'),
(23, '54.39.190.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Canada', 'Beauharnois', '45.3161', '-73.8736', 'IjdmyV0cU5YCfxcIuQMRVuFBsytQ38w8mLVSEQcI', NULL, '2026-04-07 21:12:04', '2026-04-07 21:12:04'),
(24, '54.39.190.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Canada', 'Beauharnois', '45.3161', '-73.8736', '0U1S6hIR93WnGGuWJCYXZFR4ZbxTiXdV4ALHBHD0', NULL, '2026-04-07 21:22:13', '2026-04-07 21:22:13'),
(25, '54.39.190.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Canada', 'Beauharnois', '45.3161', '-73.8736', 'oy7TK9g39A5FAJVxswVNlCgDHbtokfLnUP38uTw0', NULL, '2026-04-07 21:42:14', '2026-04-07 21:42:14'),
(26, '91.134.37.108', 'python-httpx/0.27.2', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'France', 'Gravelines', '50.9871', '2.12554', 'M9EnbM8ig7Gca3V5Pfd3Z5Fn3CqBq47jSA1Eu8fG', NULL, '2026-04-07 21:59:38', '2026-04-07 21:59:38'),
(27, '54.39.190.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Canada', 'Beauharnois', '45.3161', '-73.8736', 'A8teZ3WzBsiZ9UsX5KeXX771YDfQRqi0HYzZTYVr', NULL, '2026-04-07 22:02:20', '2026-04-07 22:02:20'),
(28, '3.95.160.86', 'FAST-WebCrawler/3.8 (crawler at trd dot overture dot com; http://www.alltheweb.com/help/webmaster/crawler)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', 'b1IPHReY2LxUT7brZBCcZxa2NBARntWwAMTcqaYx', NULL, '2026-04-07 22:43:54', '2026-04-07 22:43:54'),
(29, '54.39.190.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Canada', 'Beauharnois', '45.3161', '-73.8736', 'd9MYJ1mtJcAeHWW3Bg6f2IkDxpXBxvaX7UI24NKc', NULL, '2026-04-07 23:02:04', '2026-04-07 23:02:04'),
(30, '43.135.211.148', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'Brazil', 'São Paulo', '-23.5475', '-46.6361', 'tmWlRvSYGNNoIUzPG97hRCFHYqZReDn3Cm8IrxGF', NULL, '2026-04-07 23:51:17', '2026-04-07 23:51:17'),
(31, '54.39.190.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Canada', 'Beauharnois', '45.3161', '-73.8736', 'uNYRwYFv1tgw28amgtSp7o1PGqbzM8bbJ67e20iY', NULL, '2026-04-08 01:02:15', '2026-04-08 01:02:15'),
(32, '45.91.85.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Chicago', '41.8719', '-87.6589', '4JrC5Nf7oyoMDpMdkSpkT2liVwUGoWN9LkdQdJZx', NULL, '2026-04-08 01:03:39', '2026-04-08 01:03:39'),
(33, '43.157.82.252', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'Germany', 'Frankfurt am Main', '50.1169', '8.6837', 'l2J8YAbrWQ7xV6Ijh87vqCWVV7EgPwAGJCUf0lUW', NULL, '2026-04-08 01:09:20', '2026-04-08 01:09:20'),
(34, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.794', '90.3831', '0iL4qBT3uKSTl71ZLRfIHdZKjN9Ebgcef5xgBODz', 2, '2026-04-08 01:17:01', '2026-04-08 01:17:01'),
(35, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.794', '90.3831', '0iL4qBT3uKSTl71ZLRfIHdZKjN9Ebgcef5xgBODz', 2, '2026-04-08 01:17:13', '2026-04-08 01:17:13'),
(36, '180.153.236.168', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0; 360Spider', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', NULL, 'China', 'Shanghai', '31.2304', '121.474', 'XWCrVn6Kt4ulbh0Pn0675KJQGIZnhP609gUE0pJG', NULL, '2026-04-08 02:44:23', '2026-04-08 02:44:23'),
(37, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.794', '90.3831', '0iL4qBT3uKSTl71ZLRfIHdZKjN9Ebgcef5xgBODz', 2, '2026-04-08 02:52:32', '2026-04-08 02:52:32'),
(38, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.794', '90.3831', '0iL4qBT3uKSTl71ZLRfIHdZKjN9Ebgcef5xgBODz', 2, '2026-04-08 02:54:28', '2026-04-08 02:54:28'),
(39, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.794', '90.3831', '0iL4qBT3uKSTl71ZLRfIHdZKjN9Ebgcef5xgBODz', 2, '2026-04-08 02:56:19', '2026-04-08 02:56:19'),
(40, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/about-us', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Dhaka', '23.794', '90.3831', '0iL4qBT3uKSTl71ZLRfIHdZKjN9Ebgcef5xgBODz', 2, '2026-04-08 02:56:32', '2026-04-08 02:56:32'),
(41, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/services-list', 'page', 'https://skytechsolve.com/about-us', 'Bangladesh', 'Dhaka', '23.794', '90.3831', '0iL4qBT3uKSTl71ZLRfIHdZKjN9Ebgcef5xgBODz', 2, '2026-04-08 02:56:37', '2026-04-08 02:56:37'),
(42, '74.7.243.231', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Atlanta', '33.7485', '-84.3871', '7prXsDOzXPjGhqXJLmmUyTUAG6fiZiWqn4ej1MYE', NULL, '2026-04-08 03:29:46', '2026-04-08 03:29:46'),
(43, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/projects-details/idab', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', 'xDPw0UiJJy6u2ppYEx2gOi2rhKYWZS6HuLNPym83', NULL, '2026-04-08 04:04:45', '2026-04-08 04:04:45'),
(44, '103.15.42.72', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://www.google.com/', 'Bangladesh', 'Dhaka', '23.7278', '90.4135', '6dPNNmcIWP2G1qdyF83tti5ZGbssiiNobQmcnI3f', NULL, '2026-04-08 04:24:26', '2026-04-08 04:24:26'),
(45, '165.101.132.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.7729', '90.3657', 'M1SzdM87jRvedY2N54RDKFYwFdbxAXVe1YRTI8sX', NULL, '2026-04-08 04:24:26', '2026-04-08 04:24:26'),
(46, '165.101.132.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.7729', '90.3657', 'FQCxCghe4634dNCVykvz1gIAwXMjYwkzP4p8jIQ3', 2, '2026-04-08 04:25:54', '2026-04-08 04:25:54'),
(47, '165.101.132.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/about-us', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Dhaka', '23.7729', '90.3657', 'FQCxCghe4634dNCVykvz1gIAwXMjYwkzP4p8jIQ3', 2, '2026-04-08 04:26:07', '2026-04-08 04:26:07'),
(48, '165.101.132.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/about-us', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Dhaka', '23.7729', '90.3657', 'FQCxCghe4634dNCVykvz1gIAwXMjYwkzP4p8jIQ3', 2, '2026-04-08 04:26:51', '2026-04-08 04:26:51'),
(49, '165.101.132.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/about-us', 'Bangladesh', 'Dhaka', '23.7729', '90.3657', 'FQCxCghe4634dNCVykvz1gIAwXMjYwkzP4p8jIQ3', 2, '2026-04-08 04:28:14', '2026-04-08 04:28:14'),
(50, '184.32.177.187', 'Mozilla/5.0 (compatible; wpbot/1.4; +https://forms.gle/ajBaxygz9jSR8p8G9)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Portland', '45.5235', '-122.676', '6StFxoDSJgylE0S2bgoy7kN5XUScNPRUJQ9muNRk', NULL, '2026-04-08 04:56:46', '2026-04-08 04:56:46'),
(51, '54.39.190.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Canada', 'Beauharnois', '45.3161', '-73.8736', 'IFQVO3WRXLqY4bQ8qHvBQMheBiZilmz1rSfIRPFs', NULL, '2026-04-08 05:02:03', '2026-04-08 05:02:03'),
(52, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/web-design-development', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', '8vIgEAhQMbXxgCWFBu3QXRvHCjZQpqMbHrl15HGC', NULL, '2026-04-08 05:31:52', '2026-04-08 05:31:52'),
(53, '109.123.253.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'France', 'Lauterbourg', '48.9742', '8.1851', '5y0pIs9BR7F6dCmBQjUuffR1IgVSeELsPDjdfVqz', NULL, '2026-04-08 05:54:39', '2026-04-08 05:54:39'),
(54, '149.88.18.20', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Ashburn', '39.0469', '-77.4903', 'TvuGUonMIta8MbEMo9lNzghWYzv9LDrlTJz1Ej0B', NULL, '2026-04-08 06:18:49', '2026-04-08 06:18:49'),
(55, '149.88.18.20', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com/contact-us', 'page', 'https://skytechsolve.com/', 'United States', 'Ashburn', '39.0469', '-77.4903', 'TvuGUonMIta8MbEMo9lNzghWYzv9LDrlTJz1Ej0B', NULL, '2026-04-08 06:19:21', '2026-04-08 06:19:21'),
(56, '43.135.182.43', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', '4RpEtHXQAh3IKH1sE0Le6vEcFMcRz8Kd8mQmuyTB', NULL, '2026-04-08 06:35:04', '2026-04-08 06:35:04'),
(57, '84.54.33.186', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Mac OS', 'https://skytechsolve.com', 'page', NULL, 'Germany', 'Frankfurt am Main', '50.1109', '8.68213', 'KU5jFufCPJT1pUfrxhpI668QeH7KwQUvwW3KEGQN', NULL, '2026-04-08 06:42:29', '2026-04-08 06:42:29'),
(58, '49.51.233.95', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', 'ADGRwjOwiFltQpDQ6VvWQxQJPa9EnXmnTBAqWcwr', NULL, '2026-04-08 07:54:38', '2026-04-08 07:54:38'),
(59, '182.44.67.97', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'China', 'Jinan', '36.6683', '117.021', 'cRMItOaHCLZKzNVQccqRm6qt6ig6LqhzOPCyPYdp', NULL, '2026-04-08 11:26:19', '2026-04-08 11:26:19'),
(60, '37.59.204.140', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'Rp9jsUloiLA8arstBKnIP0s8NYoFgmPOgHW4eiCB', NULL, '2026-04-08 11:56:00', '2026-04-08 11:56:00'),
(61, '54.39.190.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Canada', 'Beauharnois', '45.3161', '-73.8736', 'Y5vM1BCmFZJoQSKIRe6XAACUzeX5LJ7UgcQklyTG', NULL, '2026-04-08 13:02:14', '2026-04-08 13:02:14'),
(62, '116.204.151.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'B3er5H4rO268UbV92EgguHU32hzYbR9inWbn92ep', NULL, '2026-04-08 16:14:03', '2026-04-08 16:14:03'),
(63, '205.169.39.65', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Santa Clara', '37.3834', '-121.983', 'cNAJfwfJJqmsKauwIlVdSnEPsJKvWIIMRsjWNKuu', NULL, '2026-04-08 16:14:13', '2026-04-08 16:14:13'),
(64, '205.169.39.65', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.79 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Santa Clara', '37.3834', '-121.983', 'SDrYiiHWzP53EzYx5f57mhD7b8oyrEF6jQnbX7Zs', NULL, '2026-04-08 16:14:25', '2026-04-08 16:14:25'),
(65, '195.211.77.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Russia', 'Moscow', '55.7484', '37.6175', 'g3V7mIsv2F6H0o9DcI3YsNuLqLmpaZKamjBgbx13', NULL, '2026-04-08 16:21:11', '2026-04-08 16:21:11'),
(66, '116.204.151.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '6pY8qCLGbMJ4o1Ir7GZQV5Vk5OxqklBGQTcflmtE', 2, '2026-04-08 16:31:31', '2026-04-08 16:31:31'),
(67, '116.204.151.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '6pY8qCLGbMJ4o1Ir7GZQV5Vk5OxqklBGQTcflmtE', 2, '2026-04-08 16:34:28', '2026-04-08 16:34:28'),
(68, '3.208.208.90', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', 'lJE2GupkuqQctbKYbAF64N2UTRVRmJ5eiNnIkav9', NULL, '2026-04-08 16:36:20', '2026-04-08 16:36:20'),
(69, '116.204.151.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '6pY8qCLGbMJ4o1Ir7GZQV5Vk5OxqklBGQTcflmtE', 2, '2026-04-08 16:37:01', '2026-04-08 16:37:01'),
(70, '116.204.151.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '6pY8qCLGbMJ4o1Ir7GZQV5Vk5OxqklBGQTcflmtE', 2, '2026-04-08 16:38:07', '2026-04-08 16:38:07'),
(71, '116.204.151.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '6pY8qCLGbMJ4o1Ir7GZQV5Vk5OxqklBGQTcflmtE', 2, '2026-04-08 16:40:22', '2026-04-08 16:40:22'),
(72, '116.204.151.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '6pY8qCLGbMJ4o1Ir7GZQV5Vk5OxqklBGQTcflmtE', 2, '2026-04-08 16:40:52', '2026-04-08 16:40:52'),
(73, '116.204.151.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '6pY8qCLGbMJ4o1Ir7GZQV5Vk5OxqklBGQTcflmtE', 2, '2026-04-08 16:40:55', '2026-04-08 16:40:55'),
(74, '116.204.151.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '6pY8qCLGbMJ4o1Ir7GZQV5Vk5OxqklBGQTcflmtE', 2, '2026-04-08 16:43:24', '2026-04-08 16:43:24'),
(75, '116.204.151.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '6pY8qCLGbMJ4o1Ir7GZQV5Vk5OxqklBGQTcflmtE', 2, '2026-04-08 16:43:48', '2026-04-08 16:43:48'),
(76, '116.204.151.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '6pY8qCLGbMJ4o1Ir7GZQV5Vk5OxqklBGQTcflmtE', 2, '2026-04-08 17:35:57', '2026-04-08 17:35:57'),
(77, '116.204.151.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '6pY8qCLGbMJ4o1Ir7GZQV5Vk5OxqklBGQTcflmtE', 2, '2026-04-08 17:35:57', '2026-04-08 17:35:57'),
(78, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/top-tools-for-web-development-professionals', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', '1YxbUlJyJHX7CwF1TcvfDtIVyxgkQrk5Ggdv9nVi', NULL, '2026-04-08 17:46:51', '2026-04-08 17:46:51'),
(79, '180.153.236.44', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36; 360Spider', 'Mobile', 'Chrome', 'Linux', 'https://www.skytechsolve.com', 'page', 'https://www.skytechsolve.com/', 'China', 'Shanghai', '31.2304', '121.474', 'yZhnOJ7tBASTWMj8RKMB04ACIxcnvAPCfKVQEFNm', NULL, '2026-04-08 18:02:38', '2026-04-08 18:02:38'),
(80, '205.210.31.39', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com/', 'United States', 'Santa Clara', '37.3835', '-121.983', 'jWGWlz6CytccuB2Y9sXtZ624YkOTcuR11e036sIm', NULL, '2026-04-08 19:27:31', '2026-04-08 19:27:31'),
(81, '43.157.38.228', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'Germany', 'Frankfurt am Main', '50.1169', '8.6837', 'wlsq2iymxhZTmGgnDohd2VIH1wC8xYIxwnkdBoeW', NULL, '2026-04-08 19:48:45', '2026-04-08 19:48:45'),
(82, '34.53.214.12', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'Belgium', 'Brussels', '50.9009', '4.4855', 'iI2zBi9naWtBraymjCyvHNHysOgXh8rY2JeWDun9', NULL, '2026-04-08 20:24:04', '2026-04-08 20:24:04'),
(83, '43.153.54.14', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', 'c3qWsq1aPowARQMoPtNgysCpM2fGE4FsGz4DGiCv', NULL, '2026-04-08 21:02:38', '2026-04-08 21:02:38'),
(84, '198.235.24.228', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'Desktop', 'Unknown', 'Unknown', 'https://www.skytechsolve.com', 'page', NULL, 'United States', 'Santa Clara', '37.3834', '-121.983', 'ewV6UgQWrNy1O2vrpKt6Toiv5WEJCTl6vbrUDVI9', NULL, '2026-04-08 21:17:12', '2026-04-08 21:17:12'),
(85, '15.206.72.69', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com', 'page', NULL, 'India', 'Mumbai', '19.076', '72.8777', 'b8CCZhSo9Z6BDneWCGIM9tSuRerMl3871egoJ7ip', NULL, '2026-04-08 21:26:53', '2026-04-08 21:26:53'),
(86, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/teams', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', 'uquvtgXU0esRtFrj0ubz7SP1G6lt8eipfm44IXjm', NULL, '2026-04-08 21:37:03', '2026-04-08 21:37:03'),
(87, '54.86.115.253', 'RecordedFuture Global Inventory Crawler', 'Desktop', 'Unknown', 'Unknown', 'https://mail.skytechsolve.com', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', '86mOWaRhVGFVxhTIs8RxujpUjmEJiY2MahFL3igC', NULL, '2026-04-08 22:00:37', '2026-04-08 22:00:37'),
(88, '180.153.236.155', 'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0; 360Spider', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', 'https://www.skytechsolve.com/', 'China', 'Shanghai', '31.2304', '121.474', 'CLoaBucoJXvQruITG8XvGRVCoY6O6JHugZhyRcgY', NULL, '2026-04-08 22:01:46', '2026-04-08 22:01:46'),
(89, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/about-us', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', 'WErFynaWsqKkr6YFrJzbmkNvuW5DApwzRKix0SfM', NULL, '2026-04-08 22:25:43', '2026-04-08 22:25:43'),
(90, '180.110.203.108', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'China', 'Nanjing', '32.0607', '118.763', 'jlIXpnPz3OgCxzcUZiE3FGjH9klJK3jXhcf8Qh0e', NULL, '2026-04-09 00:43:29', '2026-04-09 00:43:29'),
(91, '165.232.88.164', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com', 'page', NULL, 'The Netherlands', 'Amsterdam', '52.352', '4.9392', '5JjZ7qP5mFtGnYnNNGVQnTfuqMJZHya5q0WdTljW', NULL, '2026-04-09 00:45:47', '2026-04-09 00:45:47'),
(92, '35.223.166.18', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'United States', 'Council Bluffs', '41.2619', '-95.8608', '80ZiEw9QVOEtdIYWkSH153o9ScwlIIi6TLariTso', NULL, '2026-04-09 01:04:34', '2026-04-09 01:04:34'),
(93, '103.42.52.74', 'WhatsApp/2.2607.106 W', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.794', '90.3831', '2c3JnQndxsC5qZG23aHkG4ZyjfekqOKc58UGqibS', NULL, '2026-04-09 01:11:00', '2026-04-09 01:11:00'),
(94, '103.42.52.74', 'WhatsApp/2.2607.106 W', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.794', '90.3831', 'HwxUvKrY7XkHfmfZpUTbvjy5WuO4uxlGylqFb1O2', NULL, '2026-04-09 01:11:01', '2026-04-09 01:11:01'),
(95, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.794', '90.3831', 'EyKB4M0Lg5NebCCCmg7G36Toe6pZlEdvZoaix2x5', NULL, '2026-04-09 01:21:16', '2026-04-09 01:21:16'),
(96, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/services-list', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Dhaka', '23.794', '90.3831', 'EyKB4M0Lg5NebCCCmg7G36Toe6pZlEdvZoaix2x5', NULL, '2026-04-09 01:23:35', '2026-04-09 01:23:35'),
(97, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/services-list', 'Bangladesh', 'Dhaka', '23.794', '90.3831', 'EyKB4M0Lg5NebCCCmg7G36Toe6pZlEdvZoaix2x5', NULL, '2026-04-09 01:32:59', '2026-04-09 01:32:59'),
(98, '43.163.95.253', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'Singapore', 'Singapore', '1.35208', '103.82', 'DiOS1kU0BJYW2Ac87wJQ8uSi1qJozfrZKOpO2uS0', NULL, '2026-04-09 01:52:15', '2026-04-09 01:52:15'),
(99, '193.186.4.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://www.google.com/', 'Bangladesh', 'Dhaka', '23.8103', '90.4125', 'ZPufkAPzzhNwZ2048v8b4jJvpMm6yILsejDLukvq', NULL, '2026-04-09 02:19:51', '2026-04-09 02:19:51'),
(100, '162.120.184.34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://www.google.com/', 'Bangladesh', 'Dhaka', '23.8103', '90.4125', '13PMjsgzQNQD8dzFoYCAZ0nC5Q27NdT4Bkvb1iQt', NULL, '2026-04-09 02:23:58', '2026-04-09 02:23:58'),
(101, '162.120.184.34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://www.google.com/', 'Bangladesh', 'Dhaka', '23.8103', '90.4125', 'Tw9nDo3IoO9nCF6u1Gn6PU844vwfqHEv3HnPJUXr', NULL, '2026-04-09 02:26:18', '2026-04-09 02:26:18'),
(102, '103.42.52.74', 'WhatsApp/2.2607.106 W', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.794', '90.3831', 'nowbSEQK6O1tPMX83IAXjbXFNcTm853k23U5Wsr6', NULL, '2026-04-09 02:27:26', '2026-04-09 02:27:26'),
(103, '165.101.132.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.7729', '90.3657', 'q9I9EcOwY3JPpVvhGFcj3h7o4kGznWw197P26Q5b', NULL, '2026-04-09 02:38:59', '2026-04-09 02:38:59'),
(104, '165.101.132.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Dhaka', '23.7729', '90.3657', 'q9I9EcOwY3JPpVvhGFcj3h7o4kGznWw197P26Q5b', NULL, '2026-04-09 02:39:11', '2026-04-09 02:39:11'),
(105, '165.101.132.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Dhaka', '23.7729', '90.3657', 'q9I9EcOwY3JPpVvhGFcj3h7o4kGznWw197P26Q5b', NULL, '2026-04-09 02:39:18', '2026-04-09 02:39:18'),
(106, '43.135.211.148', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'Brazil', 'São Paulo', '-23.5475', '-46.6361', 'wkVFfQ11iPLbL9qfW0fwF1W92wqWf8czOSqDR4wt', NULL, '2026-04-09 03:09:39', '2026-04-09 03:09:39'),
(107, '180.153.236.46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0; 360Spider', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', NULL, 'China', 'Shanghai', '31.2304', '121.474', 'La1vcaeSgiR8XaISl41xlhREbe8dtelhUMwX8XMg', NULL, '2026-04-09 03:12:50', '2026-04-09 03:12:50'),
(108, '165.101.132.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.7729', '90.3657', '4nOCazvSAogHK5buJMhS24jjLEmAQ0M2qkWQDaEz', 2, '2026-04-09 03:29:10', '2026-04-09 03:29:10'),
(109, '165.101.132.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/blogs-list', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Dhaka', '23.7729', '90.3657', '4nOCazvSAogHK5buJMhS24jjLEmAQ0M2qkWQDaEz', 2, '2026-04-09 03:29:16', '2026-04-09 03:29:16'),
(110, '165.101.132.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/about-us', 'page', 'https://skytechsolve.com/blogs-list', 'Bangladesh', 'Dhaka', '23.7729', '90.3657', '4nOCazvSAogHK5buJMhS24jjLEmAQ0M2qkWQDaEz', 2, '2026-04-09 03:29:46', '2026-04-09 03:29:46'),
(111, '165.101.132.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/teams', 'page', 'https://skytechsolve.com/about-us', 'Bangladesh', 'Dhaka', '23.7729', '90.3657', '4nOCazvSAogHK5buJMhS24jjLEmAQ0M2qkWQDaEz', 2, '2026-04-09 03:29:49', '2026-04-09 03:29:49'),
(112, '43.153.135.208', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/about-us', 'page', NULL, 'Japan', 'Tokyo', '35.6893', '139.6899', 'VaSCcUPZJ2PAMudQC0JvsOr9QceWr0A8oeawFuz6', NULL, '2026-04-09 03:34:55', '2026-04-09 03:34:55'),
(113, '49.51.243.95', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/services-details/web-design-development', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'GAhBJQbth65XXFgMMI22bM06rGP4EaaLsYwnBxOp', NULL, '2026-04-09 03:45:48', '2026-04-09 03:45:48'),
(114, '43.157.82.252', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/services-details/e-commerce-development', 'page', NULL, 'Germany', 'Frankfurt am Main', '50.1169', '8.6837', '7GzMr1mIqHoBc35w53AdvK8qk5bchr7SQLMvCRH3', NULL, '2026-04-09 03:55:28', '2026-04-09 03:55:28'),
(115, '43.130.9.111', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/blogs-list', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', '6quAjFT0BXpwblqX4KsLs46jteTNs8iHBsv7Dplp', NULL, '2026-04-09 04:05:41', '2026-04-09 04:05:41'),
(116, '66.249.70.192', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.7680.177 Mobile Safari/537.36 (compatible; GoogleOther)', 'Mobile', 'Chrome', 'Linux', 'https://skytechsolve.com/blogs-details/how-ai-is-transforming-mobile-app-development', 'page', NULL, 'United States', 'Mountain View', '37.4225', '-122.085', 'L0AvWXCsCc91zlYtOxSVUiZuo68U7GCrvlHW3b7v', NULL, '2026-04-09 04:09:23', '2026-04-09 04:09:23'),
(117, '43.158.91.71', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/projects-details/idab', 'page', NULL, 'Germany', 'Frankfurt am Main', '50.1169', '8.6837', 'tDr8LZMAtwwxpe6jcGGSnAns81GGfBkqmYBMOocZ', NULL, '2026-04-09 04:13:58', '2026-04-09 04:13:58'),
(118, '43.128.67.187', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/blogs-details/benefits-of-erp-solutions-for-small-and-medium-businesses', 'page', NULL, 'Singapore', 'Singapore', '1.35208', '103.82', '6f10YUzrmp4B0RSyciZv3EwdMdIxj7pm5LiE5Ulz', NULL, '2026-04-09 04:34:23', '2026-04-09 04:34:23'),
(119, '66.249.70.192', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.7680.177 Mobile Safari/537.36 (compatible; GoogleOther)', 'Mobile', 'Chrome', 'Linux', 'https://skytechsolve.com/blogs-details/the-future-of-digital-marketing-in-bangladesh', 'page', NULL, 'United States', 'Mountain View', '37.4225', '-122.085', 'IvCnIC5KyIxhpFafg9LvJfJWKkwbEtAfaA2HoVbr', NULL, '2026-04-09 04:40:10', '2026-04-09 04:40:10'),
(120, '43.156.109.53', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/services-details/$%7Bitem.link%7D', 'page', NULL, 'Singapore', 'Singapore', '1.35208', '103.82', 'swaaJF0VFsPdzxmTe1MCYpWzSpAkg5RzWWyddzTl', NULL, '2026-04-09 04:45:46', '2026-04-09 04:45:46'),
(121, '43.131.39.179', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/services-list', 'page', NULL, 'Germany', 'Frankfurt am Main', '50.1169', '8.6837', 'p5Wbq2B0vSmwyvKhreJnrE6UpogHLusdm61mq1I5', NULL, '2026-04-09 04:55:06', '2026-04-09 04:55:06'),
(122, '54.39.190.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Canada', 'Beauharnois', '45.3161', '-73.8736', 'MAGW4xM0A2bDEzuJGXAnF6l1l3M9l38Ac4ZrF5t4', NULL, '2026-04-09 05:02:19', '2026-04-09 05:02:19'),
(123, '43.130.228.73', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/services-details/erp-solution-hardware', 'page', NULL, 'Japan', 'Tokyo', '35.6893', '139.6899', 'Apzr2yZ0PAaI3K659cmc81mj7wobW9zRMQpkFV3B', NULL, '2026-04-09 05:05:20', '2026-04-09 05:05:20'),
(124, '185.191.127.188', 'Mozilla/5.0 (Linux; Android 13; M2101K6G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.5993.111 Mobile Safari/537.36', 'Mobile', 'Chrome', 'Linux', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'The Netherlands', 'Amsterdam', '52.3759', '4.8975', 'hYDli71G57ZecV9XaDnpzwkK5iMOkddv8hTg0RvW', NULL, '2026-04-09 05:30:38', '2026-04-09 05:30:38'),
(125, '43.130.72.40', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/contact-us', 'page', NULL, 'United States', 'Ashburn', '39.0469', '-77.4903', 'xkN4O7XefunIRcEU3vGTpfON51GR7dGaRchO1w75', NULL, '2026-04-09 05:37:07', '2026-04-09 05:37:07'),
(126, '43.164.197.209', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/services-details/mobile-app-development', 'page', NULL, 'Brazil', 'São Paulo', '-23.5475', '-46.6361', 'WhxhxQSQjMnvo4JlyVDFeHNZDrxwJLavBYUGHPwU', NULL, '2026-04-09 05:44:41', '2026-04-09 05:44:41'),
(127, '43.156.168.214', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/teams', 'page', NULL, 'Singapore', 'Singapore', '1.35208', '103.82', 'QqnTEnTSrvid1W0xF0VTV5T1QC7RKkO4g5GOsoJT', NULL, '2026-04-09 05:54:41', '2026-04-09 05:54:41'),
(128, '36.111.67.189', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'China', 'Hangzhou', '30.2656', '120.154', 'Hj6qTAmBrje7cIzeFVMZjEU190XgB3TnDFgmIbzC', NULL, '2026-04-09 07:04:16', '2026-04-09 07:04:16'),
(129, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/erp-solution-hardware', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', 'lgPVMyYQGQ77RURZHn8Z6FJ7xlJS9Qld6Mrzcy3m', NULL, '2026-04-09 08:48:56', '2026-04-09 08:48:56'),
(130, '180.153.236.84', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0; 360Spider', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', NULL, 'China', 'Shanghai', '31.2304', '121.474', '5aMMHL2qXbOAu6YwpWasGKWzGHRmjVoZeDApvEI5', NULL, '2026-04-09 09:15:58', '2026-04-09 09:15:58'),
(131, '101.33.80.42', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'South Korea', 'Seoul', '37.5614', '126.996', 'SUbIKd7XFpM8p0n5KKfTlr5z768iJKGi6RXkfaSx', NULL, '2026-04-09 09:41:02', '2026-04-09 09:41:02'),
(132, '43.153.122.30', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/teams', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'zjkwsmxDeYdUZQF0DeaRDxbeYjfNaIhqBtKWk65H', NULL, '2026-04-09 10:06:05', '2026-04-09 10:06:05'),
(133, '43.153.19.83', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/projects-details/idab', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'QiPcF0nrd1IQrZc55IMi75yBC8VvSBzdTdqp4kzN', NULL, '2026-04-09 10:35:14', '2026-04-09 10:35:14'),
(134, '43.166.142.76', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/services-list', 'page', NULL, 'United States', 'Ashburn', '39.0469', '-77.4903', '7hhsVUGmjfCjzfRIYcwLquKhYpf0gzs4txmqPJfZ', NULL, '2026-04-09 10:44:49', '2026-04-09 10:44:49');
INSERT INTO `visitor_records` (`id`, `ip_address`, `user_agent`, `device_type`, `browser`, `platform`, `page_url`, `visit_type`, `referrer_url`, `country`, `city`, `latitude`, `longitude`, `session_id`, `user_id`, `created_at`, `updated_at`) VALUES
(135, '43.130.57.76', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/projects-list', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'TjxLNt0L6C8W7uak6zryI27QjtBG9vjWnIQk1MuE', NULL, '2026-04-09 11:04:06', '2026-04-09 11:04:06'),
(136, '170.106.180.246', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', 'luzIbCeH6EJfvQaY3DaqFyNhSwBMN81EETW5GR7f', NULL, '2026-04-09 11:29:21', '2026-04-09 11:29:21'),
(137, '43.153.96.233', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/blogs-list', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'xtBEZJNgr6J4DIMPuxxqJPkBoxdLM29w5noRA6kv', NULL, '2026-04-09 11:34:35', '2026-04-09 11:34:35'),
(138, '49.51.243.156', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/about-us', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'YsYeUjNEeVgLEiTwWRKLgBZGHJlZu2DZQ31Fo323', NULL, '2026-04-09 11:44:37', '2026-04-09 11:44:37'),
(139, '170.106.148.137', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/services-details/web-design-development', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'lWZdBcDG6ksA8djKTlW1xnafPX8SFdh1gFi4fTFr', NULL, '2026-04-09 11:54:06', '2026-04-09 11:54:06'),
(140, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/projects-list', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', 'vAwbE0T0h9QBxTWZIgDVRXaj5YA7Tm0PJKTOZDsA', NULL, '2026-04-09 12:05:19', '2026-04-09 12:05:19'),
(141, '185.191.171.2', 'Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/top-tools-for-web-development-professionals', 'page', NULL, 'United States', 'Washington', '38.9072', '-77.0369', 'a1BkanIc27jH2eK38Pl3LR8aB8OgLIjVq6tD8tCh', NULL, '2026-04-09 12:18:19', '2026-04-09 12:18:19'),
(142, '43.130.47.33', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/blogs-details/e-commerce-development-boost-your-online-sales-in-2026', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'pgOC3rXdqUHYCkXvsKFrQAWXkxcZ7V6gRz7WbZ3v', NULL, '2026-04-09 12:34:41', '2026-04-09 12:34:41'),
(143, '170.106.140.110', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/contact-us', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'nunQWBiUzSyYfcZqpRcu7OatZA3zefGjYgSY58b0', NULL, '2026-04-09 12:42:03', '2026-04-09 12:42:03'),
(144, '5.39.1.237', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'zWCYlMXfT2j2DdDcGvlbS0hWcMQcT9RmyfVdI7Ib', NULL, '2026-04-09 12:47:53', '2026-04-09 12:47:53'),
(145, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/contact-us', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', '0K2zcu9aRusOmhDAa4qJVVVNEuJwEXIt7W09CLsL', NULL, '2026-04-09 13:36:57', '2026-04-09 13:36:57'),
(146, '124.236.100.56', 'Mozilla/5.0 (X11; Linux x86_64; rv:57.0) Gecko/20100101 Firefox/57.0', 'Desktop', 'Firefox', 'Linux', 'https://www.skytechsolve.com', 'page', NULL, 'China', 'Xinchengpu', '38.2679', '114.683', 'qUplHc5kR0Yki3PZKIOKDPBEIqCDsOWBPGZomyTi', NULL, '2026-04-09 14:16:38', '2026-04-09 14:16:38'),
(147, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-list', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', 'RnvHOHZflAZQS6Iw4Alt7LjURnmiUlWyOMcDcZE5', NULL, '2026-04-09 15:05:52', '2026-04-09 15:05:52'),
(148, '185.191.171.10', 'Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/top-10-web-design-trends-in-2026', 'page', NULL, 'United States', 'Washington', '38.9072', '-77.0369', 'GZ7VgV94gU45l8OX2oM9yTilyxYyEOCELxpGNBP3', NULL, '2026-04-09 15:15:31', '2026-04-09 15:15:31'),
(149, '180.153.236.176', 'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0; 360Spider', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', 'https://www.skytechsolve.com/', 'China', 'Shanghai', '31.2304', '121.474', 'vlRE8MnAO8WHxqFUuM0p0YTK4YFi1EeTHtE5533W', NULL, '2026-04-09 15:27:31', '2026-04-09 15:27:31'),
(150, '85.208.96.193', 'Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/how-mobile-apps-are-changing-business-growth', 'page', NULL, 'United States', 'Ashburn', '39.018', '-77.539', 'IwmMF3VNtOduaael4uJM228k2h5DRwDBAkWymueS', NULL, '2026-04-09 15:48:25', '2026-04-09 15:48:25'),
(151, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/benefits-of-erp-solutions-for-small-and-medium-businesses', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', '4TtoGw7bLstC3lL5jfwEB45q2HylDVwLTmIiAR4c', NULL, '2026-04-09 15:53:22', '2026-04-09 15:53:22'),
(152, '185.191.171.6', 'Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/teams-details/motiur-rahman', 'page', NULL, 'United States', 'Washington', '38.9072', '-77.0369', 'ZvdcthgLnWuniEXufX1nMf4byPVXGray7fi83VBv', NULL, '2026-04-09 16:03:29', '2026-04-09 16:03:29'),
(153, '43.130.3.120', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', '1RvxLsR2WjKwftLHg63CxEbECM4yLFXsRU8oZy0y', NULL, '2026-04-09 17:04:09', '2026-04-09 17:04:09'),
(154, '49.51.73.183', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/projects-details/shop-sky-tech-solve', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'eHha7oDpTlsjbwIjefMADo87gv8Hvj8pIAm6IP2H', NULL, '2026-04-09 17:37:50', '2026-04-09 17:37:50'),
(155, '43.153.10.13', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/projects-details/$%7Bitem.link%7D', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'qFYPhgghg0QM20TyUI6S6bed9cW0i4aBi6l7rP51', NULL, '2026-04-09 17:51:26', '2026-04-09 17:51:26'),
(156, '180.153.236.43', 'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0; 360Spider', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', 'https://www.skytechsolve.com/', 'China', 'Shanghai', '31.2304', '121.474', 'H31yRjQWCdr8MLAXMbzWE3MrfKBK6kOn3YPSEC2V', NULL, '2026-04-09 18:06:08', '2026-04-09 18:06:08'),
(157, '43.135.142.7', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', 'hCGxTRsB9jh3OxLjYOQedj79AUJsA7onsn3y8oNK', NULL, '2026-04-09 18:27:32', '2026-04-09 18:27:32'),
(158, '185.191.171.19', 'Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/why-seo-is-crucial-for-every-business-website', 'page', NULL, 'United States', 'Washington', '38.9072', '-77.0369', 'xsiIjZt0MrUtH2oRtoixVG1FdEhiINY0UzAVufvQ', NULL, '2026-04-09 18:41:26', '2026-04-09 18:41:26'),
(159, '85.208.96.199', 'Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/e-commerce-development-boost-your-online-sales-in-2026', 'page', NULL, 'United States', 'Ashburn', '39.018', '-77.539', 'itHcAyjw6M0GTx50YdSDL14xyLk3CGqxycoyIopE', NULL, '2026-04-09 18:47:28', '2026-04-09 18:47:28'),
(160, '20.203.172.210', NULL, 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/public/index.php', 'page', NULL, 'Switzerland', 'Zurich', '47.37204', '8.54094', 'ZiOvDeZANh6NXJdtbEmRjpNyr5JZgIq3hRWaTfsz', NULL, '2026-04-09 21:09:51', '2026-04-09 21:09:51'),
(161, '20.203.172.210', NULL, 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/public/index.php', 'page', NULL, 'Switzerland', 'Zurich', '47.37204', '8.54094', 'ZiOvDeZANh6NXJdtbEmRjpNyr5JZgIq3hRWaTfsz', NULL, '2026-04-09 21:09:54', '2026-04-09 21:09:54'),
(162, '180.153.236.114', 'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0; 360Spider', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', 'https://www.skytechsolve.com/', 'China', 'Shanghai', '31.2304', '121.474', 'HRK6sBeDvhffiv2ktn0aju2jQcPfSY0jXhiCYAfe', NULL, '2026-04-09 22:00:40', '2026-04-09 22:00:40'),
(163, '43.159.128.237', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', 'wdTGtVBgqJSz3PPo7x86OrnA0CYAwMnf4PoJ5llo', NULL, '2026-04-09 23:18:26', '2026-04-09 23:18:26'),
(164, '8.213.194.213', 'Go-http-client/1.1', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'Thailand', 'Bangkok', '13.7499', '100.517', 'hGn7IYjZyzTEOsrqPwLDeotEffvEdMNQKvsk7boH', NULL, '2026-04-09 23:28:28', '2026-04-09 23:28:28'),
(165, '5.133.192.173', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:123.0) Gecko/20100101 Firefox/123', 'Desktop', 'Firefox', 'Windows', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com/', 'Sweden', 'Stockholm', '59.3472', '18.0595', '5z3Tef2DOXfnRoyPETGCE9Y70ZKinEFLUHEiFw6Q', NULL, '2026-04-09 23:57:45', '2026-04-09 23:57:45'),
(166, '5.133.192.189', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:123.0) Gecko/20100101 Firefox/123', 'Desktop', 'Firefox', 'Windows', 'https://skytechsolve.com/blogs-details/benefits-of-erp-solutions-for-small-and-medium-businesses', 'page', NULL, 'Sweden', 'Stockholm', '59.3472', '18.0595', '1fubPFaAm9aAegd7in2ovDPgaCT70dBChqw6dbrB', NULL, '2026-04-09 23:57:45', '2026-04-09 23:57:45'),
(167, '185.6.10.201', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:123.0) Gecko/20100101 Firefox/123', 'Desktop', 'Firefox', 'Windows', 'https://skytechsolve.com/blogs-details/e-commerce-development-boost-your-online-sales-in-2026', 'page', NULL, 'Sweden', 'Stockholm', '59.3472', '18.0595', 'sgGycR2RWhJCjVqbgUXLMIdEI4OdaYICXCtOqatl', NULL, '2026-04-09 23:57:45', '2026-04-09 23:57:45'),
(168, '149.57.176.247', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com', 'page', NULL, 'United States', 'New York', '40.7127', '-74.0059', 'kW4LSFXjqrhawGmZqnO8j5F6mUYKjeVAFPgEtMsl', NULL, '2026-04-09 23:58:37', '2026-04-09 23:58:37'),
(169, '43.157.50.58', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'Germany', 'Frankfurt am Main', '50.1169', '8.6837', 'IJvtu31QRBmfDYTdjUL47SCfeyFJfJTahiYU0J6m', NULL, '2026-04-10 00:35:55', '2026-04-10 00:35:55'),
(170, '103.13.193.241', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', 'Mobile', 'Chrome', 'Linux', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'seGvLwBeoKQmBmHrtxiYJNLPTQ52NMN0utBdq8Ai', NULL, '2026-04-10 02:20:47', '2026-04-10 02:20:47'),
(171, '103.13.193.243', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', 'Mobile', 'Chrome', 'Linux', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'sBmcyoM37wQhHH1cfrkgGpr0dNVadqzUp5Ri8IzN', NULL, '2026-04-10 02:24:17', '2026-04-10 02:24:17'),
(172, '60.188.57.0', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'China', 'Hangzhou', '30.2943', '120.1663', 'n9OSvM1d6wQiEqWcZHAx24rcsty4kNptdJmvw708', NULL, '2026-04-10 02:56:51', '2026-04-10 02:56:51'),
(173, '84.246.85.11', '2ip bot/1.1 (+https://2ip.io)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'The Netherlands', 'Meppel', '52.6921', '6.19372', '1HE5L2XPbsyqXU4PAyAdQnUZnM68dfuPxUldiBhw', NULL, '2026-04-10 03:17:51', '2026-04-10 03:17:51'),
(174, '84.246.85.11', '2ip bot/1.1 (+https://2ip.io)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'The Netherlands', 'Meppel', '52.6921', '6.19372', 'USnexPobdZPiyEYgkeSnvzx7JO6Bt9R5oogpVSGv', NULL, '2026-04-10 03:17:52', '2026-04-10 03:17:52'),
(175, '84.246.85.11', '2ip bot/1.1 (+https://2ip.io)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'The Netherlands', 'Meppel', '52.6921', '6.19372', 'ea61nSScd6REVR1rtJnkiq85KCld66u9Bac5yWcz', NULL, '2026-04-10 03:17:52', '2026-04-10 03:17:52'),
(176, '23.95.96.140', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 15_7_3) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Safari/605.1.15', 'Desktop', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com/', 'United States', 'Buffalo', '42.8864', '-78.8784', 'RMOVnzy7dWCUse3JUAovbUXnpWan41HXwDa9ubta', NULL, '2026-04-10 03:42:24', '2026-04-10 03:42:24'),
(177, '180.153.236.44', 'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0; 360Spider', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/', 'China', 'Shanghai', '31.2304', '121.474', '4bkFxixyJSgleY4rQRKH3pclXzleQCR6VlRrQfqk', NULL, '2026-04-10 03:59:34', '2026-04-10 03:59:34'),
(178, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/how-ai-is-transforming-mobile-app-development', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', 'IFP9xkPYNaLQE8LRkM7SMQAhpYywbAzjaC3X7DYZ', NULL, '2026-04-10 04:02:29', '2026-04-10 04:02:29'),
(179, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.794', '90.3831', '7BaijfQxdCxhOE2Wg59aAhdjMzTHZSdDbZ470cAt', NULL, '2026-04-10 04:26:30', '2026-04-10 04:26:30'),
(180, '51.75.236.137', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/teams', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'AsYnVb2aHBzh078Q6MevgJehGyH01fyAjiU0bMsG', NULL, '2026-04-10 06:09:13', '2026-04-10 06:09:13'),
(181, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-list', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', '3bbzszEfLRBFZFYI3j9gAEQQoFiFGHPtmYFlcWQu', NULL, '2026-04-10 06:15:53', '2026-04-10 06:15:53'),
(182, '43.165.190.5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'Japan', 'Tokyo', '35.6893', '139.6899', 'UeTjQem17pJu85Vem0WKz4xMW5trTHIOdUyhue8e', NULL, '2026-04-10 06:17:01', '2026-04-10 06:17:01'),
(183, '116.212.132.63', 'Mozilla/5.0 (X11; Linux i686; rv:1.9.6.20) Gecko/ Firefox/3.6.8', 'Desktop', 'Firefox', 'Linux', 'https://skytechsolve.com', 'page', NULL, 'Cambodia', 'Phnom Penh', '11.5583', '104.9121', 't4SmOLWo095O6GEfNMvLew9oXsirGh8mpV5q6J2Z', NULL, '2026-04-10 06:45:16', '2026-04-10 06:45:16'),
(184, '162.62.132.25', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/services-details/mobile-app-development', 'page', NULL, 'Germany', 'Frankfurt am Main', '50.1169', '8.6837', '7wEJi0crP9pcOvlSVHhXADEojbw8nHbfLFJOKVF3', NULL, '2026-04-10 06:50:58', '2026-04-10 06:50:58'),
(185, '43.130.16.140', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/services-details/erp-solution-hardware', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'EfvCNgR62DfHsOK5VQW3VfZuZSGQRn1KlOZBT8hl', NULL, '2026-04-10 07:00:42', '2026-04-10 07:00:42'),
(186, '43.133.220.37', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/blogs-details/benefits-of-erp-solutions-for-small-and-medium-businesses', 'page', NULL, 'Japan', 'Tokyo', '35.6893', '139.6899', 'Q2paH0g2gen4orc7oQjcQ2YMNW5iZwMEXq7Y9aO7', NULL, '2026-04-10 07:19:52', '2026-04-10 07:19:52'),
(187, '43.134.73.5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/services-details/e-commerce-development', 'page', NULL, 'Singapore', 'Singapore', '1.35208', '103.82', 'yLGhqCZcPQDAa0A2tvxTQkup771vmqVD9pi8q8lQ', NULL, '2026-04-10 07:41:30', '2026-04-10 07:41:30'),
(188, '43.157.180.116', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'Brazil', 'São Paulo', '-23.5475', '-46.6361', 'h08IpIfq4mCHRokIRbhyw7rC1pQwkBVhAK5E6xX9', NULL, '2026-04-10 07:42:00', '2026-04-10 07:42:00'),
(189, '170.106.72.93', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/services-details/$%7Bitem.link%7D', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', '30bLShTIcwZpqZNZxdu1yIbQYTrtWikTt8ymOreO', NULL, '2026-04-10 07:50:29', '2026-04-10 07:50:29'),
(190, '37.59.204.154', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-list', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'GqIgkDsnKj4SLIBF5FSgAqEokubWzobIGZFFCJbP', NULL, '2026-04-10 08:10:23', '2026-04-10 08:10:23'),
(191, '36.41.75.167', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'China', 'Xincheng', '34.2649', '108.954', 'HhfSxc8r2Dz7XNzBQECO5LIZm1PWFW8R7utLPlhi', NULL, '2026-04-10 09:20:17', '2026-04-10 09:20:17'),
(192, '92.222.108.108', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/mobile-app-development', 'page', NULL, 'France', 'Paris', '48.8558', '2.3494', 'JdYTptaOs2jccpuoPbYdMZCuFYEp87GXvhO12t84', NULL, '2026-04-10 09:56:56', '2026-04-10 09:56:56'),
(193, '176.31.139.5', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/erp-solution-hardware', 'page', NULL, 'France', 'Roubaix', '50.6977', '3.1786', 'H84ys6ONcARw7JjNMz02BFytLBPTxrm7MUfD47hn', NULL, '2026-04-10 10:45:24', '2026-04-10 10:45:24'),
(194, '51.75.236.150', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/benefits-of-erp-solutions-for-small-and-medium-businesses', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'e5XcLGoPl4xVUaF5YYFOxIlsjTGE3ABkhOrfr3pV', NULL, '2026-04-10 12:07:09', '2026-04-10 12:07:09'),
(195, '5.39.109.170', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/e-commerce-development', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'mOu8CsGoBOgpMJhtRgX47bH7jQwfxTWPP3aWTFtH', NULL, '2026-04-10 12:34:18', '2026-04-10 12:34:18'),
(196, '37.59.204.132', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/projects-list', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'eGo5h13N7t2r72fSvZI7jYk4PYJ6ZJ0rRfj5801i', NULL, '2026-04-10 13:00:06', '2026-04-10 13:00:06'),
(197, '176.31.139.17', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-list', 'page', NULL, 'France', 'Roubaix', '50.6977', '3.1786', 'F5IjZiWRQO3fNdR1rf15zOtpdHO3dP1iCQN26gmD', NULL, '2026-04-10 13:12:36', '2026-04-10 13:12:36'),
(198, '134.209.197.70', 'Mozilla/5.0 (X11; Linux x86_64; rv:142.0) Gecko/20100101 Firefox/142.0', 'Desktop', 'Firefox', 'Linux', 'https://mail.skytechsolve.com', 'page', NULL, 'The Netherlands', 'Amsterdam', '52.352', '4.9392', 'VwPAsahmT74HcHdYcLi8cC500YQqcterX7HZkiYa', NULL, '2026-04-10 13:18:06', '2026-04-10 13:18:06'),
(199, '43.157.179.227', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'Brazil', 'São Paulo', '-23.5475', '-46.6361', 'wu18hXRCK8ZV77Cw65ndibOkDeKTyHNMlntScZEH', NULL, '2026-04-10 13:22:22', '2026-04-10 13:22:22'),
(200, '54.37.118.65', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/contact-us', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'OzePTcIJLRSKnTV2f25kAMttCdiUmo8tPqmY7lMi', NULL, '2026-04-10 13:24:39', '2026-04-10 13:24:39'),
(201, '92.222.104.217', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/how-ai-is-transforming-mobile-app-development', 'page', NULL, 'France', 'Paris', '48.8558', '2.3494', 'lKDm3IjtquRAriiXnLUWRrKMoYR5FDhsinLTvKCM', NULL, '2026-04-10 13:36:16', '2026-04-10 13:36:16'),
(202, '94.23.188.204', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/about-us', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', '6B47slbZ4ujap2SyoGZr0SkBRiPABoCe8JFirZZI', NULL, '2026-04-10 13:47:32', '2026-04-10 13:47:32'),
(203, '162.62.132.25', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'Germany', 'Frankfurt am Main', '50.1169', '8.6837', 'tCyx2jvs9UkiY98di5MYrhxx8g0xqlydQyH2viuf', NULL, '2026-04-10 14:48:39', '2026-04-10 14:48:39'),
(204, '129.226.213.145', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/projects-list', 'page', NULL, 'Singapore', 'Singapore', '1.35208', '103.82', 'PcDJFQ4twPilPgX2Wpcvk6EJejIg1GA1IH9QQmZr', NULL, '2026-04-10 15:42:02', '2026-04-10 15:42:02'),
(205, '43.135.148.92', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/projects-details/shop-sky-tech-solve', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'Ngj0AmoORwQy68yOtT3qtXFbuu2af8J0vfbE71V0', NULL, '2026-04-10 15:52:02', '2026-04-10 15:52:02'),
(206, '43.131.36.84', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/projects-details/$%7Bitem.link%7D', 'page', NULL, 'Germany', 'Frankfurt am Main', '50.1169', '8.6837', 's5niR9ly8WjmlnwYynBGQ0rCynmWSQvBlxGqzJ77', NULL, '2026-04-10 16:05:39', '2026-04-10 16:05:39'),
(207, '5.39.109.173', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'FqyAlQCtApxu5w0Rk8IeASwC8fwjdMqiQTJmo75I', NULL, '2026-04-10 16:55:00', '2026-04-10 16:55:00'),
(208, '98.95.152.161', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', 'RxYmneYJMZtJV0PLBV8VBezREtC7hiWslbIcLw0y', NULL, '2026-04-10 18:11:46', '2026-04-10 18:11:46'),
(209, '109.69.109.186', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:114.0) Gecko/20100101 Firefox/114.0', 'Desktop', 'Firefox', 'Linux', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'United Kingdom', 'City of London', '51.5164', '-0.093', 'f7ahYsrT4Ass0xI12wvzDT7FzSzkxBaTfsGmDKQq', NULL, '2026-04-10 18:16:36', '2026-04-10 18:16:36'),
(210, '91.132.115.102', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:114.0) Gecko/20100101 Firefox/114.0', 'Desktop', 'Firefox', 'Linux', 'https://skytechsolve.com/contact-us', 'page', 'http://skytechsolve.com', 'Poland', 'Warsaw', '52.2299', '21.0093', 'f7ahYsrT4Ass0xI12wvzDT7FzSzkxBaTfsGmDKQq', NULL, '2026-04-10 18:16:38', '2026-04-10 18:16:38'),
(211, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.794', '90.3831', 'cBrRUEyHD3wSCcc03ZFBxnIyhmPlc3xNwbOMuEIq', NULL, '2026-04-10 18:46:50', '2026-04-10 18:46:50'),
(212, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/about-us', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Dhaka', '23.794', '90.3831', 'cBrRUEyHD3wSCcc03ZFBxnIyhmPlc3xNwbOMuEIq', NULL, '2026-04-10 18:46:55', '2026-04-10 18:46:55'),
(213, '180.153.236.46', 'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0; 360Spider', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', 'https://www.skytechsolve.com/', 'China', 'Shanghai', '31.2304', '121.474', 'ANlK9DagM4i5BbvgcMiPJAb4vq4AQdYsWAD1brKm', NULL, '2026-04-10 19:10:32', '2026-04-10 19:10:32'),
(214, '34.11.151.9', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'United States', 'The Dalles', '45.5945', '-121.1786', 'XFzCEIF7TLO0bFBAdOQSIAPovM7Ibc3sL6LZx2E5', NULL, '2026-04-10 19:51:51', '2026-04-10 19:51:51'),
(215, '43.135.211.148', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'Brazil', 'São Paulo', '-23.5475', '-46.6361', 'rJOBR9n4hvYrzK5VeMLLpTEcPGPgKRBCTJaniuxk', NULL, '2026-04-10 20:10:49', '2026-04-10 20:10:49'),
(216, '54.154.231.201', 'Mozilla/5.0 (compatible; NetcraftSurveyAgent/1.0; +info@netcraft.com)', 'Desktop', 'Unknown', 'Unknown', 'https://mail.skytechsolve.com', 'page', NULL, 'Ireland', 'Dublin', '53.3498', '-6.26031', '0aLh4FmV8u0dKAWIUxyA7WOhjV57qBXBhiaJXuAa', NULL, '2026-04-10 20:13:18', '2026-04-10 20:13:18'),
(217, '13.212.92.202', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com', 'page', NULL, 'Singapore', 'Singapore', '1.28009', '103.851', 'qnfHoMqD9T26eTj5nXfgA9ixySyC8XQzIGgiNH0N', NULL, '2026-04-10 20:16:13', '2026-04-10 20:16:13'),
(218, '170.106.113.235', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', 'u7hQUKjHQrqMcPzzesOR3iiQIYqNvmAhKOVALg1X', NULL, '2026-04-10 21:29:04', '2026-04-10 21:29:04'),
(219, '18.201.31.171', 'Mozilla/5.0 (compatible; NetcraftSurveyAgent/1.0; +info@netcraft.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'Ireland', 'Dublin', '53.3498', '-6.26031', '0B5qfznQ8c1TuyJRc85EfgPExGghfQ4ikur4EsmA', NULL, '2026-04-10 21:37:03', '2026-04-10 21:37:03'),
(220, '198.235.24.145', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Santa Clara', '37.3834', '-121.983', 'dv0TIQ1spvoXmRLDmknaEPnRBTknSTElsPtvm96M', NULL, '2026-04-10 21:47:18', '2026-04-10 21:47:18'),
(221, '205.210.31.206', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'Desktop', 'Unknown', 'Unknown', 'https://www.skytechsolve.com', 'page', NULL, 'United States', 'Santa Clara', '37.3835', '-121.983', '1hXfj5mFxvU4xZkg3V7PGXaKLkKqg4TktClMVIyx', NULL, '2026-04-10 22:12:08', '2026-04-10 22:12:08'),
(222, '125.94.144.102', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'China', 'Shenzhen', '22.5455', '114.0683', 'fc1odf7I3oMzkm6XT0DMGHE1qlOk1ni6JdpUrA7a', NULL, '2026-04-10 22:32:43', '2026-04-10 22:32:43'),
(223, '209.38.138.214', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Santa Clara', '37.3931', '-121.962', 'HwpikkHw5AlLbvyLO7Z7fJnuL7HrnM0vOYUoku7x', NULL, '2026-04-10 22:37:59', '2026-04-10 22:37:59'),
(224, '52.207.18.114', 'CSSCheck/1.2.2', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', 'xLtW5FUK7TSbpTYKiQeymlRD3FAObezShEKGaNM3', NULL, '2026-04-10 23:08:52', '2026-04-10 23:08:52'),
(225, '180.153.236.234', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0; 360Spider', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', NULL, 'China', 'Shanghai', '31.2304', '121.474', 'HqQ5Yc6VSu0UUTqfvE6pbWhirDSSFEVEpxZnPRw3', NULL, '2026-04-11 00:26:01', '2026-04-11 00:26:01'),
(226, '180.153.236.143', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0; 360Spider', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', NULL, 'China', 'Shanghai', '31.2304', '121.474', 'Dprue0OtXBkPs4CoczziD0ABOEG7ZJOs9RnTFUnL', NULL, '2026-04-11 00:26:12', '2026-04-11 00:26:12'),
(227, '63.33.214.41', 'Mozilla/5.0 (compatible; NetcraftSurveyAgent/1.0; +info@netcraft.com)', 'Desktop', 'Unknown', 'Unknown', 'https://www.skytechsolve.com', 'page', NULL, 'Ireland', 'Dublin', '53.3498', '-6.26031', 'LnEpDpIzCl3krk0CNrV64oejBocNRQ2pVyiJCFGT', NULL, '2026-04-11 01:28:36', '2026-04-11 01:28:36'),
(228, '51.75.236.136', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/the-future-of-digital-marketing-in-bangladesh', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'SO8FVBbR3jAtZxlpmmv5Pd8NvQHe09h55EPnckKP', NULL, '2026-04-11 01:30:25', '2026-04-11 01:30:25'),
(229, '103.42.52.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Dhaka', '23.794', '90.3831', 'LASQAdxGWx1lSl8BpA7skCSbs3FqmFfSzEmiaUQD', NULL, '2026-04-11 01:54:24', '2026-04-11 01:54:24'),
(230, '136.115.10.175', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'United States', 'Council Bluffs', '41.2619', '-95.8608', 'qnhCAqwsHxEv2T7WjV0OOKxsNmph753ggv29lg7J', NULL, '2026-04-11 02:18:52', '2026-04-11 02:18:52'),
(231, '43.157.147.3', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'Brazil', 'São Paulo', '-23.5475', '-46.6361', 'CsTMVNhvq27zyajiSXVKRt1cyC4vjXJGXdSjYlRH', NULL, '2026-04-11 02:19:29', '2026-04-11 02:19:29'),
(232, '54.37.118.95', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/why-seo-is-crucial-for-every-business-website', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'eHKQTxIOlnrYVaXcmKfkDpXrais7aigyTh75NydC', NULL, '2026-04-11 02:24:00', '2026-04-11 02:24:00'),
(233, '94.23.188.218', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/top-tools-for-web-development-professionals', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'm5bhP4jgQXcaLeAcu0VbL1LzUd49xYMMD9hznlY0', NULL, '2026-04-11 03:21:00', '2026-04-11 03:21:00'),
(234, '5.133.192.187', 'Mozilla/5.0 (Linux; U; Android 13; sk-sk; Xiaomi 11T Pro Build/TKQ1.220829.002) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/112.0.5615.136 Mobile Safari/537.36 XiaoMi/MiuiBrowser/14.4.0-g', 'Mobile', 'Chrome', 'Linux', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com/', 'Sweden', 'Stockholm', '59.3472', '18.0595', 'w3mI8KKg69uoxPqGx3oRiAPdhVhZogs6YXLXaAbR', NULL, '2026-04-11 03:49:26', '2026-04-11 03:49:26'),
(235, '36.41.75.167', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'China', 'Xincheng', '34.2649', '108.954', 'eSPWfNQnKQvPlP88Z9pQ1XZHPn41Hysd7aXhC8tu', NULL, '2026-04-11 05:12:02', '2026-04-11 05:12:02'),
(236, '170.106.192.3', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', 'BZ75ST5pNc3xECum31PXqLu2bWnqrHFswkHWsjaB', NULL, '2026-04-11 05:25:05', '2026-04-11 05:25:05'),
(237, '149.57.191.45', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com', 'page', NULL, 'United States', 'New York', '40.7127', '-74.0059', 'ewx0hFJyPBwJBZeO6Fw9hHRcRvjIg8BQU51t3xPl', NULL, '2026-04-11 07:24:52', '2026-04-11 07:24:52'),
(238, '37.59.204.133', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/e-commerce-development-boost-your-online-sales-in-2026', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'SDHgy8MAmYU9STVppCI0lrEQ49E2uV0oF9n6eAvW', NULL, '2026-04-11 07:39:47', '2026-04-11 07:39:47'),
(239, '152.44.106.59', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com/blogs-list', 'page', NULL, 'United States', 'San Francisco', '37.7749', '-122.419', '2PtaXrzIZMdCTiQzGBiN2rW3yAAREvcRHDEb3rA5', NULL, '2026-04-11 07:54:16', '2026-04-11 07:54:16'),
(240, '139.180.230.5', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com/blogs-details/how-ai-is-transforming-mobile-app-development', 'page', NULL, 'United States', 'New York', '40.7128', '-74.006', '0LkaTieD59Ar2IpK3lyqR6VmKqknpMPucEqw5FWK', NULL, '2026-04-11 08:25:24', '2026-04-11 08:25:24'),
(241, '162.244.144.16', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com/blogs-details/top-10-web-design-trends-in-2026', 'page', NULL, 'United States', 'Los Angeles', '34.0549', '-118.243', 'peM7ELnpx8ubOsArjZatsiDgjQe1eVL35Obn1Mjj', NULL, '2026-04-11 08:25:24', '2026-04-11 08:25:24'),
(242, '168.91.46.121', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com/blogs-details/the-future-of-digital-marketing-in-bangladesh', 'page', NULL, 'United States', 'San Francisco', '37.7749', '-122.419', 'VwfHzxTBXtar6jADMdogptplTbpGnHndRkWvdKlg', NULL, '2026-04-11 08:25:24', '2026-04-11 08:25:24'),
(243, '147.53.118.110', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com/blogs-details/e-commerce-development-boost-your-online-sales-in-2026', 'page', NULL, 'United States', 'Buffalo', '42.8864', '-78.8784', 'Cm62lkhrfHCiwzyFINbMuYdlmbesrnACtGud6YPx', NULL, '2026-04-11 08:25:26', '2026-04-11 08:25:26'),
(244, '199.250.188.3', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com/blogs-details/top-tools-for-web-development-professionals', 'page', NULL, 'United States', 'Los Angeles', '34.0549', '-118.243', 'klVKImAjbMyAcBIpME0A0O3lzD6Gle3joeb22gvi', NULL, '2026-04-11 08:25:29', '2026-04-11 08:25:29'),
(245, '207.182.31.85', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com/blogs-details/how-mobile-apps-are-changing-business-growth', 'page', NULL, 'United States', 'Los Angeles', '34.0549', '-118.243', 'NNVPVO6Vj3LIK1tPNPaQrjk36kxXWU8zKvCryQBf', NULL, '2026-04-11 08:25:30', '2026-04-11 08:25:30'),
(246, '149.57.191.124', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com/blogs-details/why-seo-is-crucial-for-every-business-website', 'page', NULL, 'United States', 'New York', '40.7127', '-74.0059', 'kR7SWy3vpei2DcR0DqN60vPtEEzzWArbGUaRXwsp', NULL, '2026-04-11 08:25:31', '2026-04-11 08:25:31'),
(247, '149.57.191.211', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Linux', 'https://skytechsolve.com/blogs-details/benefits-of-erp-solutions-for-small-and-medium-businesses', 'page', NULL, 'United States', 'New York', '40.7127', '-74.0059', 'mM0Jqres3LMqZ41zlYYWL0rD5uaPjDJKQLSP4uqM', NULL, '2026-04-11 08:25:41', '2026-04-11 08:25:41'),
(248, '54.37.118.66', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/projects-details/idab', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'Bdb3NgnQM0cgf10CcjO0AFPkCIcq7IA46D9tCwu3', NULL, '2026-04-11 09:44:52', '2026-04-11 09:44:52'),
(249, '5.39.1.231', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/projects-details/shop-sky-tech-solve', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'pQcmjj5E40eycg8unRLU5FwF001bWJhxYio8kFst', NULL, '2026-04-11 10:09:25', '2026-04-11 10:09:25'),
(250, '49.234.192.248', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'China', 'Shanghai', '31.2222', '121.4581', 'qbRncARro5yvcXZGmJsVWARkimgu3SV1wbOk4qCo', NULL, '2026-04-11 11:21:40', '2026-04-11 11:21:40'),
(251, '180.153.236.180', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0; 360Spider', 'Desktop', 'Chrome', 'Windows', 'https://www.skytechsolve.com', 'page', NULL, 'China', 'Shanghai', '31.2304', '121.474', 'HFHP6wHRNaKwKwec9h38RKH8LfIV5A8RsVv6RmCD', NULL, '2026-04-11 13:17:05', '2026-04-11 13:17:05'),
(252, '3.233.59.216', 'RecordedFuture Global Inventory Crawler', 'Desktop', 'Unknown', 'Unknown', 'https://www.skytechsolve.com', 'page', NULL, 'United States', 'Ashburn', '39.0438', '-77.4874', 'RUaAwKlCGEPYqk3KqV0n4WNxlDR4b3ZNtTEndWfX', NULL, '2026-04-11 15:05:12', '2026-04-11 15:05:12'),
(253, '43.159.143.139', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', 'VpZRmmnPm4Ydaycf8BU8JwtJN4km0tJHizZJTBKo', NULL, '2026-04-11 15:15:09', '2026-04-11 15:15:09'),
(254, '193.186.4.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://www.google.com/', 'Bangladesh', 'Dhaka', '23.8103', '90.4125', 'Ju3mzz1VKiMRMAIgP2vZwjjCExeWnQcS1259BTG0', NULL, '2026-04-11 15:35:00', '2026-04-11 15:35:00'),
(255, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://www.google.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'Xk5BhGS09izybH1WEV0D3ssYewbFdkPn13M8DoFX', NULL, '2026-04-11 15:35:00', '2026-04-11 15:35:00'),
(256, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/teams', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'Xk5BhGS09izybH1WEV0D3ssYewbFdkPn13M8DoFX', NULL, '2026-04-11 15:35:13', '2026-04-11 15:35:13'),
(257, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/teams', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'Xk5BhGS09izybH1WEV0D3ssYewbFdkPn13M8DoFX', NULL, '2026-04-11 15:35:16', '2026-04-11 15:35:16'),
(258, '43.250.82.233', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/teams', 'page', 'https://www.google.com/', 'Bangladesh', 'Dhaka', '23.7104', '90.4074', 'uh5ztMU2TdIFzzbzo6OxSy2lnjt0OMamxvthjkLu', NULL, '2026-04-11 15:35:19', '2026-04-11 15:35:19'),
(259, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'Xk5BhGS09izybH1WEV0D3ssYewbFdkPn13M8DoFX', NULL, '2026-04-11 15:35:37', '2026-04-11 15:35:37'),
(260, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/about-us', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'Xk5BhGS09izybH1WEV0D3ssYewbFdkPn13M8DoFX', NULL, '2026-04-11 15:35:39', '2026-04-11 15:35:39'),
(261, '72.14.201.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://www.google.com/', 'Bangladesh', 'Dhaka', '23.8103', '90.4125', 'FSY01T3qbRCy3MX1G6UfbkMyU8GrHigBrb0hrJcp', NULL, '2026-04-11 15:39:56', '2026-04-11 15:39:56'),
(262, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://www.google.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:44:05', '2026-04-11 15:44:05'),
(263, '162.120.184.35', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://www.google.com/', 'Bangladesh', 'Dhaka', '23.8103', '90.4125', '0z7n4dac0Z096qTFeTsaXLV2Q1Bd6ky6kSYSsE0h', NULL, '2026-04-11 15:44:06', '2026-04-11 15:44:06'),
(264, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:44:50', '2026-04-11 15:44:50'),
(265, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/services-details/mobile-app-development', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:44:55', '2026-04-11 15:44:55'),
(266, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/services-list', 'page', 'https://skytechsolve.com/services-details/mobile-app-development', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:44:56', '2026-04-11 15:44:56');
INSERT INTO `visitor_records` (`id`, `ip_address`, `user_agent`, `device_type`, `browser`, `platform`, `page_url`, `visit_type`, `referrer_url`, `country`, `city`, `latitude`, `longitude`, `session_id`, `user_id`, `created_at`, `updated_at`) VALUES
(267, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/projects-list', 'page', 'https://skytechsolve.com/services-list', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:44:59', '2026-04-11 15:44:59'),
(268, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/teams', 'page', 'https://skytechsolve.com/projects-list', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:45:03', '2026-04-11 15:45:03'),
(269, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/teams', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:45:06', '2026-04-11 15:45:06'),
(270, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/projects-list', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:45:13', '2026-04-11 15:45:13'),
(271, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/projects-details/idab', 'page', 'https://skytechsolve.com/projects-list', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:45:22', '2026-04-11 15:45:22'),
(272, '103.15.42.70', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/projects-details/idab', 'page', 'https://www.google.com/', 'Bangladesh', 'Dhaka', '23.7278', '90.4135', 'Y8KxnJytFYfxBwRk48Z6BF7DXeXYThNmEAAOks6J', NULL, '2026-04-11 15:45:27', '2026-04-11 15:45:27'),
(273, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/projects-details/idab', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:45:39', '2026-04-11 15:45:39'),
(274, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/services-list', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:46:51', '2026-04-11 15:46:51'),
(275, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/services-list', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:46:52', '2026-04-11 15:46:52'),
(276, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/teams', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:47:00', '2026-04-11 15:47:00'),
(277, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/blogs-list', 'page', 'https://skytechsolve.com/teams', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:47:01', '2026-04-11 15:47:01'),
(278, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/contact-us', 'page', 'https://skytechsolve.com/blogs-list', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:47:02', '2026-04-11 15:47:02'),
(279, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/contact-us', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:47:04', '2026-04-11 15:47:04'),
(280, '162.120.184.34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://www.google.com/', 'Bangladesh', 'Dhaka', '23.8103', '90.4125', 'xkGwFwTsIY5pYhh8uEDaGPJuT5BivuluyeV5Kbd7', NULL, '2026-04-11 15:49:10', '2026-04-11 15:49:10'),
(281, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'OFr8fb55DDf3JIm53sO1QDYmHm7BPGsf8OoDM7bu', 2, '2026-04-11 15:49:14', '2026-04-11 15:49:14'),
(282, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://www.google.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'OFr8fb55DDf3JIm53sO1QDYmHm7BPGsf8OoDM7bu', 2, '2026-04-11 15:49:34', '2026-04-11 15:49:34'),
(283, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', 'OFr8fb55DDf3JIm53sO1QDYmHm7BPGsf8OoDM7bu', 2, '2026-04-11 15:49:44', '2026-04-11 15:49:44'),
(284, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/contact-us', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:03', '2026-04-11 15:52:03'),
(285, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/about-us', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:03', '2026-04-11 15:52:03'),
(286, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/projects-list', 'page', 'https://skytechsolve.com/about-us', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:05', '2026-04-11 15:52:05'),
(287, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/teams', 'page', 'https://skytechsolve.com/projects-list', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:07', '2026-04-11 15:52:07'),
(288, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/blogs-list', 'page', 'https://skytechsolve.com/teams', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:26', '2026-04-11 15:52:26'),
(289, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/contact-us', 'page', 'https://skytechsolve.com/blogs-list', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:29', '2026-04-11 15:52:29'),
(290, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/projects-list', 'page', 'https://skytechsolve.com/contact-us', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:30', '2026-04-11 15:52:30'),
(291, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/services-details/web-design-development', 'page', 'https://skytechsolve.com/projects-list', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:32', '2026-04-11 15:52:32'),
(292, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/services-details/mobile-app-development', 'page', 'https://skytechsolve.com/services-details/web-design-development', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:34', '2026-04-11 15:52:34'),
(293, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/services-details/e-commerce-development', 'page', 'https://skytechsolve.com/services-details/mobile-app-development', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:36', '2026-04-11 15:52:36'),
(294, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/services-details/web-design-development', 'page', 'https://skytechsolve.com/services-details/e-commerce-development', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:38', '2026-04-11 15:52:38'),
(295, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/services-list', 'page', 'https://skytechsolve.com/services-details/web-design-development', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:50', '2026-04-11 15:52:50'),
(296, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/services-details/web-design-development', 'page', 'https://skytechsolve.com/services-list', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:55', '2026-04-11 15:52:55'),
(297, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/services-details/web-design-development', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:57', '2026-04-11 15:52:57'),
(298, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/about-us', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:52:58', '2026-04-11 15:52:58'),
(299, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/about-us', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:53:07', '2026-04-11 15:53:07'),
(300, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:53:09', '2026-04-11 15:53:09'),
(301, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/blogs-list', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:53:10', '2026-04-11 15:53:10'),
(302, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/blogs-details/top-10-web-design-trends-in-2026', 'page', 'https://skytechsolve.com/blogs-list', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:53:15', '2026-04-11 15:53:15'),
(303, '116.204.151.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/blogs-details/top-10-web-design-trends-in-2026', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '7PwwQyslzmR7kRPK7el8rv3oxJbESYk64o5Be8fu', NULL, '2026-04-11 15:53:26', '2026-04-11 15:53:26'),
(304, '74.7.227.188', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', 'https://seu.skytechsolve.com', 'United States', 'Atlanta', '33.7485', '-84.3871', 'AHanjgU44tB1SpVkb1uOprKk5GiUAv5JzPtOHQ8W', NULL, '2026-04-11 16:25:10', '2026-04-11 16:25:10'),
(305, '74.7.227.188', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/teams', 'page', 'https://skytechsolve.com/', 'United States', 'Atlanta', '33.7485', '-84.3871', 'AHanjgU44tB1SpVkb1uOprKk5GiUAv5JzPtOHQ8W', NULL, '2026-04-11 16:25:31', '2026-04-11 16:25:31'),
(306, '74.7.227.188', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/about-us', 'page', 'https://skytechsolve.com/', 'United States', 'Atlanta', '33.7485', '-84.3871', 'AHanjgU44tB1SpVkb1uOprKk5GiUAv5JzPtOHQ8W', NULL, '2026-04-11 16:25:41', '2026-04-11 16:25:41'),
(307, '74.7.227.188', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/benefits-of-erp-solutions-for-small-and-medium-businesses', 'page', 'https://skytechsolve.com/', 'United States', 'Atlanta', '33.7485', '-84.3871', 'AHanjgU44tB1SpVkb1uOprKk5GiUAv5JzPtOHQ8W', NULL, '2026-04-11 16:25:42', '2026-04-11 16:25:42'),
(308, '74.7.227.188', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/web-design-development', 'page', 'https://skytechsolve.com/', 'United States', 'Atlanta', '33.7485', '-84.3871', 'AHanjgU44tB1SpVkb1uOprKk5GiUAv5JzPtOHQ8W', NULL, '2026-04-11 16:25:45', '2026-04-11 16:25:45'),
(309, '74.7.227.188', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/e-commerce-development', 'page', 'https://skytechsolve.com/', 'United States', 'Atlanta', '33.7485', '-84.3871', 'AHanjgU44tB1SpVkb1uOprKk5GiUAv5JzPtOHQ8W', NULL, '2026-04-11 16:25:45', '2026-04-11 16:25:45'),
(310, '74.7.227.188', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/projects-list', 'page', 'https://skytechsolve.com/', 'United States', 'Atlanta', '33.7485', '-84.3871', 'AHanjgU44tB1SpVkb1uOprKk5GiUAv5JzPtOHQ8W', NULL, '2026-04-11 16:25:46', '2026-04-11 16:25:46'),
(311, '74.7.227.188', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/erp-solution-hardware', 'page', 'https://skytechsolve.com/', 'United States', 'Atlanta', '33.7485', '-84.3871', 'AHanjgU44tB1SpVkb1uOprKk5GiUAv5JzPtOHQ8W', NULL, '2026-04-11 16:25:47', '2026-04-11 16:25:47'),
(312, '74.7.227.188', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/projects-details/shop-sky-tech-solve', 'page', 'https://skytechsolve.com/', 'United States', 'Atlanta', '33.7485', '-84.3871', 'AHanjgU44tB1SpVkb1uOprKk5GiUAv5JzPtOHQ8W', NULL, '2026-04-11 16:25:47', '2026-04-11 16:25:47'),
(313, '74.7.227.188', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-list', 'page', 'https://skytechsolve.com/', 'United States', 'Atlanta', '33.7485', '-84.3871', 'AHanjgU44tB1SpVkb1uOprKk5GiUAv5JzPtOHQ8W', NULL, '2026-04-11 16:25:48', '2026-04-11 16:25:48'),
(314, '74.7.227.188', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-list', 'page', 'https://skytechsolve.com/', 'United States', 'Atlanta', '33.7485', '-84.3871', 'AHanjgU44tB1SpVkb1uOprKk5GiUAv5JzPtOHQ8W', NULL, '2026-04-11 16:25:48', '2026-04-11 16:25:48'),
(315, '74.7.227.188', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/projects-details/idab', 'page', 'https://skytechsolve.com/', 'United States', 'Atlanta', '33.7485', '-84.3871', 'AHanjgU44tB1SpVkb1uOprKk5GiUAv5JzPtOHQ8W', NULL, '2026-04-11 16:25:51', '2026-04-11 16:25:51'),
(316, '74.7.227.188', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/contact-us', 'page', 'https://skytechsolve.com/', 'United States', 'Atlanta', '33.7485', '-84.3871', 'AHanjgU44tB1SpVkb1uOprKk5GiUAv5JzPtOHQ8W', NULL, '2026-04-11 16:26:03', '2026-04-11 16:26:03'),
(317, '89.124.106.82', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'The Netherlands', 'Amsterdam', '52.3759', '4.8975', 'RTLemhKFqXWCzhq0nOARsn6KmpTbB9mLqTf3xpXe', NULL, '2026-04-11 16:53:20', '2026-04-11 16:53:20'),
(318, '43.131.45.213', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'Germany', 'Frankfurt am Main', '50.1169', '8.6837', 'dsFHaVBWHRCe1ZbjuFJhOxIru3qDHaoULWZbCGNf', NULL, '2026-04-11 16:59:54', '2026-04-11 16:59:54'),
(319, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/mobile-app-development', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', 'Qf2sgdJC3mokEqrmk3P633gEHa8ntO0MmkVflrWE', NULL, '2026-04-11 17:39:09', '2026-04-11 17:39:09'),
(320, '182.44.8.254', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'China', 'Jinan', '36.6683', '117.021', 'iuu1VhFdlrIk2NFF9DbvvoI2jlWphJJHInEhcaO8', NULL, '2026-04-11 17:46:06', '2026-04-11 17:46:06'),
(321, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/services-details/e-commerce-development', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', '95DI6zw3bUcAyLyVVEr8xgPtUiOLAOGuygaIPxdS', NULL, '2026-04-11 18:24:29', '2026-04-11 18:24:29'),
(322, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/projects-details/shop-sky-tech-solve', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', '9lwEAdsTlevBXflvaddWzobOz3lteyAc94mmPdgm', NULL, '2026-04-11 18:24:48', '2026-04-11 18:24:48'),
(323, '37.140.254.178', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/138.0', 'Desktop', 'Firefox', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Switzerland', 'Zurich', '47.3643', '8.5437', '6hICCUNiXliqSip99gIl2uJ0yFGn3niMOX3Y0keu', NULL, '2026-04-11 21:46:47', '2026-04-11 21:46:47'),
(324, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/top-tools-for-web-development-professionals', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', '8hT2r07aMAF1qolRpc8754XYuNyALwhk67EmT8KE', NULL, '2026-04-11 22:11:25', '2026-04-11 22:11:25'),
(325, '43.167.232.38', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'Japan', 'Tokyo', '35.6893', '139.6899', '8C3hFKS824TEtoPYtblm8PcwHK8BZnQy7uxlQxE5', NULL, '2026-04-11 23:03:20', '2026-04-11 23:03:20'),
(326, '198.235.24.48', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'Desktop', 'Unknown', 'Unknown', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com/', 'United States', 'Santa Clara', '37.3834', '-121.983', 'ZCtikHU5cNaoKcUsmyDtcRg9kiARN7tcua8uAXUb', NULL, '2026-04-12 00:07:38', '2026-04-12 00:07:38'),
(327, '43.130.26.3', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', 'rL0jRrrZSwvKVM8hzAgs7gG0g3DLei7vvNFhHu0K', NULL, '2026-04-12 00:25:22', '2026-04-12 00:25:22'),
(328, '175.6.217.4', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'China', 'Qingyuan', '28.1142', '112.983', 'GeAaqIG12oZhBp0FGFg3BqqIlIn0g4MKNSJcyVZn', NULL, '2026-04-12 00:43:07', '2026-04-12 00:43:07'),
(329, '92.222.104.202', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com', 'page', NULL, 'France', 'Paris', '48.8558', '2.3494', 'iyOva6iy6bjSsDPa5yHLI3zD0KYJiekSrhY2dZhf', NULL, '2026-04-12 01:14:24', '2026-04-12 01:14:24'),
(330, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/teams', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', 'J0ouBbWvy2dW0pXK155WgRZM67x6cfro8XoE5pUq', NULL, '2026-04-12 02:17:33', '2026-04-12 02:17:33'),
(331, '143.244.57.123', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'France', 'Paris', '48.8558', '2.3494', 'obGnADppQmn2gUHZ113EroVQQlhhI1OWDDbaihGM', NULL, '2026-04-12 02:26:31', '2026-04-12 02:26:31'),
(332, '143.244.57.123', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'France', 'Paris', '48.8558', '2.3494', 'obGnADppQmn2gUHZ113EroVQQlhhI1OWDDbaihGM', NULL, '2026-04-12 02:26:32', '2026-04-12 02:26:32'),
(333, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/about-us', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', 'rmCnVZ5fneNHCMohzW1M90nCJVAq71TeEfEroEZl', NULL, '2026-04-12 03:06:07', '2026-04-12 03:06:07'),
(334, '34.174.163.33', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Mac OS', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Dallas', '32.7766', '-96.7969', 't3DXYkqX23Tqw0XWKzi8h1gEKluM9Woa5g8AxdwN', NULL, '2026-04-12 03:23:47', '2026-04-12 03:23:47'),
(335, '34.174.163.33', 'Mozilla/5.0 (X11; Linux x86_64; rv:131.0) Gecko/20100101 Firefox/131.0', 'Desktop', 'Firefox', 'Linux', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Dallas', '32.7766', '-96.7969', 'hCVjjlborvpNwTHjuFkXMiJZbSpMZvq1SoHqTrkm', NULL, '2026-04-12 03:23:52', '2026-04-12 03:23:52'),
(336, '34.174.163.33', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Mac OS', 'https://skytechsolve.com', 'page', NULL, 'United States', 'Dallas', '32.7766', '-96.7969', 'et6zIXM3ClvYW63HtcEYGsIdCpfW9TtO7RY0SLjA', NULL, '2026-04-12 03:24:03', '2026-04-12 03:24:03'),
(337, '27.147.237.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '8FNwWS7dvTACntYGUTqfUSG8RX3XkAKJ2PkGZWpI', NULL, '2026-04-12 03:54:09', '2026-04-12 03:54:09'),
(338, '27.147.237.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/services-list', 'page', 'https://skytechsolve.com/', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '8FNwWS7dvTACntYGUTqfUSG8RX3XkAKJ2PkGZWpI', NULL, '2026-04-12 03:55:15', '2026-04-12 03:55:15'),
(339, '27.147.237.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/projects-list', 'page', 'https://skytechsolve.com/services-list', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '8FNwWS7dvTACntYGUTqfUSG8RX3XkAKJ2PkGZWpI', NULL, '2026-04-12 03:55:17', '2026-04-12 03:55:17'),
(340, '27.147.237.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/projects-details/idab', 'page', 'https://skytechsolve.com/projects-list', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '8FNwWS7dvTACntYGUTqfUSG8RX3XkAKJ2PkGZWpI', NULL, '2026-04-12 03:55:26', '2026-04-12 03:55:26'),
(341, '27.147.237.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', 'https://skytechsolve.com/projects-details/idab', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '8FNwWS7dvTACntYGUTqfUSG8RX3XkAKJ2PkGZWpI', NULL, '2026-04-12 03:55:35', '2026-04-12 03:55:35'),
(342, '27.147.237.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com/teams', 'page', 'https://skytechsolve.com/projects-details/idab', 'Bangladesh', 'Kafrul', '23.7882', '90.3736', '8FNwWS7dvTACntYGUTqfUSG8RX3XkAKJ2PkGZWpI', NULL, '2026-04-12 03:55:39', '2026-04-12 03:55:39'),
(343, '185.191.127.188', 'Mozilla/5.0 (Linux; Android 13; 2201117TG) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.6045.193 Mobile Safari/537.36', 'Mobile', 'Chrome', 'Linux', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'The Netherlands', 'Amsterdam', '52.3759', '4.8975', 'yaPTnP23lculCTUoltKE8bWXo1zMbZ8KHMsurzIM', NULL, '2026-04-12 05:32:48', '2026-04-12 05:32:48'),
(344, '195.178.110.155', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Andorra', 'Andorra la Vella', '42.5063', '1.52184', 'rskxxiI42OCuayb2LmD6flTlIXjmRTO3BMMQsK61', NULL, '2026-04-12 06:17:03', '2026-04-12 06:17:03'),
(345, '5.39.1.245', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/top-10-web-design-trends-in-2026', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', 'LSQPt06gH91mwHfelTzUf1cNQb8D5XndKXTu306F', NULL, '2026-04-12 07:37:09', '2026-04-12 07:37:09'),
(346, '170.106.180.246', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com', 'page', 'http://www.skytechsolve.com', 'United States', 'Santa Clara', '37.353', '-121.9544', 'wFRSt0DVhYiRblePRJoJaZROG8ICgXSCTTOPl8ga', NULL, '2026-04-12 07:57:55', '2026-04-12 07:57:55'),
(347, '43.133.253.253', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/blogs-details/the-future-of-digital-marketing-in-bangladesh', 'page', NULL, 'South Korea', 'Seoul', '37.5658', '126.978', 'LBKUGfENdcILUha9CmiS8vuOCcGgGhcoYTtT2CEp', NULL, '2026-04-12 08:23:13', '2026-04-12 08:23:13'),
(348, '43.166.244.251', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://www.skytechsolve.com/blogs-details/how-ai-is-transforming-mobile-app-development', 'page', NULL, 'United States', 'Ashburn', '39.0469', '-77.4903', 'ScuFlbSK5kiqXyznLciYKXnO5EVL1LlHzkEErt54', NULL, '2026-04-12 08:43:29', '2026-04-12 08:43:29'),
(349, '51.68.247.210', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/how-mobile-apps-are-changing-business-growth', 'page', NULL, 'France', 'Roubaix', '50.6927', '3.17785', '3Va2PnWGaRfBR1qmD53fCbrsCOSVlGXKMuFlFlGf', NULL, '2026-04-12 08:45:15', '2026-04-12 08:45:15'),
(350, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/how-mobile-apps-are-changing-business-growth', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', '5muoeb83asCebqCdWX17SdPpwZ5VAyfdD875sgRZ', NULL, '2026-04-12 08:56:17', '2026-04-12 08:56:17'),
(351, '43.155.188.157', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'South Korea', 'Seoul', '37.5658', '126.978', 'NTVrtAx9Tr4GEYHyCjtZOVqAMCtPiCe15P0edwVz', NULL, '2026-04-12 10:02:15', '2026-04-12 10:02:15'),
(352, '195.178.110.133', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Andorra', 'Andorra la Vella', '42.5063', '1.52184', 'AWpyWf6NrtlRWVkbcpHmmTMwRPw95aV96lfvlNtf', NULL, '2026-04-12 10:10:41', '2026-04-12 10:10:41'),
(353, '216.244.66.246', 'Mozilla/5.0 (compatible; DotBot/1.2; +https://opensiteexplorer.org/dotbot; help@moz.com)', 'Desktop', 'Unknown', 'Unknown', 'https://skytechsolve.com/blogs-details/the-future-of-digital-marketing-in-bangladesh', 'page', NULL, 'United States', 'Tukwila', '47.4932', '-122.294', 'WJCqrw2Fd2PWcCMhF8LyLqNXXELm0cabZhPYfcV1', NULL, '2026-04-12 10:25:46', '2026-04-12 10:25:46'),
(354, '170.106.140.110', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/blogs-details/the-future-of-digital-marketing-in-bangladesh', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'XYz171mlFJGYVxu4tpMr7BWdsOjf2xyunv7MezrC', NULL, '2026-04-12 10:27:34', '2026-04-12 10:27:34'),
(355, '43.158.91.71', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/blogs-details/how-ai-is-transforming-mobile-app-development', 'page', NULL, 'Germany', 'Frankfurt am Main', '50.1169', '8.6837', 'oQZA03qqh07d6Gp0nxFne69CeIB9veeoXXtvrjhG', NULL, '2026-04-12 10:46:20', '2026-04-12 10:46:20'),
(356, '64.89.163.208', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Germany', 'Frankfurt am Main', '50.1109', '8.68213', 'AmFwWcCWcL9m0in6vQzWyMQRVNcM25wej1TVBIOR', NULL, '2026-04-12 11:28:41', '2026-04-12 11:28:41'),
(357, '64.89.163.208', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'https://skytechsolve.com', 'page', NULL, 'Germany', 'Frankfurt am Main', '50.1109', '8.68213', 'AmFwWcCWcL9m0in6vQzWyMQRVNcM25wej1TVBIOR', NULL, '2026-04-12 11:28:43', '2026-04-12 11:28:43'),
(358, '43.153.27.244', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com/blogs-details/top-10-web-design-trends-in-2026', 'page', NULL, 'United States', 'Santa Clara', '37.353', '-121.9544', 'Fxp7KX9krICCCvvPQO0QPJ5k8daymcmJjnCjD6dd', NULL, '2026-04-12 12:16:05', '2026-04-12 12:16:05'),
(359, '49.234.192.248', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'Mobile', 'Safari', 'Mac OS', 'https://skytechsolve.com', 'page', 'http://skytechsolve.com', 'China', 'Shanghai', '31.2222', '121.4581', 'hgFR1KjMFI5x235tOsrRgVW2otgCjJs0W6ZJkzWz', NULL, '2026-04-12 13:26:00', '2026-04-12 13:26:00'),
(360, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'http://localhost/skytechsolve.com/public', 'page', NULL, 'Localhost', 'Localhost', NULL, NULL, 'rH8PjIcTaIUCf3cm6az33EZG4bTTbtZ61IeyuQYQ', NULL, '2026-04-12 08:05:45', '2026-04-12 08:05:45'),
(361, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'http://localhost/skytechsolve.com/public', 'page', 'http://localhost/skytechsolve.com/public/', 'Localhost', 'Localhost', NULL, NULL, 'rH8PjIcTaIUCf3cm6az33EZG4bTTbtZ61IeyuQYQ', NULL, '2026-04-12 08:05:48', '2026-04-12 08:05:48'),
(362, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'http://localhost/skytechsolve.com/public', 'page', 'http://localhost/skytechsolve.com/public/', 'Localhost', 'Localhost', NULL, NULL, 'rH8PjIcTaIUCf3cm6az33EZG4bTTbtZ61IeyuQYQ', NULL, '2026-04-12 08:05:54', '2026-04-12 08:05:54'),
(363, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'http://localhost/skytechsolve.com/public', 'page', 'http://localhost/skytechsolve.com/public/', 'Localhost', 'Localhost', NULL, NULL, 'rH8PjIcTaIUCf3cm6az33EZG4bTTbtZ61IeyuQYQ', NULL, '2026-04-12 08:05:57', '2026-04-12 08:05:57'),
(364, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'http://localhost/skytechsolve.com/public', 'page', NULL, 'Localhost', 'Localhost', NULL, NULL, 'rH8PjIcTaIUCf3cm6az33EZG4bTTbtZ61IeyuQYQ', NULL, '2026-04-12 09:17:27', '2026-04-12 09:17:27'),
(365, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'http://localhost/skytechsolve.com/public', 'page', NULL, 'Localhost', 'Localhost', NULL, NULL, '6Ky81x3B7iKmHNPFALCQazr0IVwlrhJtyyQ9iAPY', 2, '2026-04-12 09:17:52', '2026-04-12 09:17:52'),
(366, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'http://localhost/skytechsolve.com/public', 'page', NULL, 'Localhost', 'Localhost', NULL, NULL, '6Ky81x3B7iKmHNPFALCQazr0IVwlrhJtyyQ9iAPY', 2, '2026-04-12 09:36:10', '2026-04-12 09:36:10'),
(367, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'http://localhost/skytechsolve.com/public', 'page', NULL, 'Localhost', 'Localhost', NULL, NULL, '6Ky81x3B7iKmHNPFALCQazr0IVwlrhJtyyQ9iAPY', 2, '2026-04-12 09:36:10', '2026-04-12 09:36:10'),
(368, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'http://localhost/skytechsolve.com/public', 'page', NULL, 'Localhost', 'Localhost', NULL, NULL, '6Ky81x3B7iKmHNPFALCQazr0IVwlrhJtyyQ9iAPY', 2, '2026-04-12 09:55:39', '2026-04-12 09:55:39'),
(369, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows', 'http://localhost/skytechsolve.com/public', 'page', NULL, 'Localhost', 'Localhost', NULL, NULL, '6Ky81x3B7iKmHNPFALCQazr0IVwlrhJtyyQ9iAPY', 2, '2026-04-12 09:55:40', '2026-04-12 09:55:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_parent_type_parent_id_index` (`parent_type`,`parent_id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_comments_blog_post_id_foreign` (`blog_post_id`),
  ADD KEY `blog_comments_user_id_foreign` (`user_id`),
  ADD KEY `blog_comments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_posts_slug_unique` (`slug`),
  ADD KEY `blog_posts_category_id_foreign` (`category_id`),
  ADD KEY `blog_posts_author_id_index` (`author_id`),
  ADD KEY `blog_posts_title_index` (`title`);

--
-- Indexes for table `blog_post_tags`
--
ALTER TABLE `blog_post_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_post_tags_blog_post_id_foreign` (`blog_post_id`),
  ADD KEY `blog_post_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_created_by_foreign` (`created_by`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_type_sort_order_index` (`type`,`sort_order`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `price_plans`
--
ALTER TABLE `price_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_plans_product_id_foreign` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_slug_unique` (`slug`),
  ADD KEY `projects_category_id_foreign` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seos_seoable_type_seoable_id_index` (`seoable_type`,`seoable_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`);

--
-- Indexes for table `service_features`
--
ALTER TABLE `service_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_features_service_id_foreign` (`service_id`),
  ADD KEY `service_features_feature_id_foreign` (`feature_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sites_user_id_foreign` (`user_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_name_unique` (`name`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visitor_records`
--
ALTER TABLE `visitor_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_records_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blog_post_tags`
--
ALTER TABLE `blog_post_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `missions`
--
ALTER TABLE `missions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `price_plans`
--
ALTER TABLE `price_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_features`
--
ALTER TABLE `service_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visitor_records`
--
ALTER TABLE `visitor_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD CONSTRAINT `blog_comments_blog_post_id_foreign` FOREIGN KEY (`blog_post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `blog_comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_post_tags`
--
ALTER TABLE `blog_post_tags`
  ADD CONSTRAINT `blog_post_tags_blog_post_id_foreign` FOREIGN KEY (`blog_post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_post_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `price_plans`
--
ALTER TABLE `price_plans`
  ADD CONSTRAINT `price_plans_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_features`
--
ALTER TABLE `service_features`
  ADD CONSTRAINT `service_features_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_features_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sites`
--
ALTER TABLE `sites`
  ADD CONSTRAINT `sites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visitor_records`
--
ALTER TABLE `visitor_records`
  ADD CONSTRAINT `visitor_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
