-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2026 at 06:43 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_dispora_jatim_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `agency_profiles`
--

CREATE TABLE `agency_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_url` text COLLATE utf8mb4_unicode_ci,
  `status` enum('upcoming','ongoing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'upcoming',
  `clicks_count` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agendas`
--

INSERT INTO `agendas` (`id`, `user_id`, `title`, `slug`, `description`, `start_date`, `end_date`, `location`, `attachment_path`, `link_url`, `status`, `clicks_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'WFH 31 Juli 2026', 'wfh-31-juli-2026-1785123633', 'WFH Dispora Jatim', '2026-07-31 07:30:00', '2026-07-31 11:00:00', 'Daring (Zoom)', NULL, 'https://semestabangkom.id', 'upcoming', 1, '2026-07-26 20:40:33', '2026-09-01 00:53:54', NULL),
(2, 1, 'Rapat Finalisasi NOBAR Bola Gembira', 'rapat-finalisasi-nobar-bola-gembira-1785128738', 'Rapat Koordinasi dengan semua pihak berwenang', '2026-07-14 13:00:00', '2026-07-14 18:00:00', 'Daring (Zoom)', NULL, 'https://semestabangkom.id', 'completed', 0, '2026-07-26 22:05:38', '2026-07-26 22:05:38', NULL),
(3, 1, 'Nobar Final Bola Gembira', 'nobar-final-bola-gembira-1785128871', 'Nobar Final Bola Gembira Bersama gubernur Jawa Timur di Grahadi', '2026-07-20 00:05:00', '2026-07-20 07:00:00', 'Halaman Grahadi Jawa Timur', NULL, 'https://photos.google.com/share/AF1QipPJgqu5LeHn9X2YkBveAIN4Ucqe9G_1N2_Rp36B6lO6J4MT5bTmo53ymmVBtFdphg?key=VEJ2OHNrMjNqZ01wYm1zOUVNMHB2MW9raUxLd3V3', 'completed', 0, '2026-07-26 22:07:51', '2026-07-26 22:07:51', NULL),
(4, 1, 'Pelatihan Barista 2026 Angkatan I', 'pelatihan-barista-2026-angkatan-i-1785818240', 'Pelatihan Barista untuk Pemuda Pemudi Jawa Timur', '2026-08-03 07:00:00', '2026-08-04 18:00:00', 'BLK Malang', NULL, NULL, 'ongoing', 0, '2026-07-26 22:09:38', '2026-08-03 21:37:20', NULL),
(5, 1, 'Pelatihan Barista Angkatan II', 'pelatihan-barista-angkatan-ii-1785818296', 'Pelatihan Barista Angkatan II', '2026-08-05 08:00:00', '2026-08-06 19:00:00', 'BLK Malang', NULL, NULL, 'ongoing', 0, '2026-08-03 21:38:16', '2026-08-03 21:38:16', NULL),
(6, 1, 'Pelatihan Olahraga Pencak Silat', 'pelatihan-olahraga-pencak-silat-1787826895', 'Pelatihan Olahraga Pencak Silat', '2026-08-06 07:00:00', '2026-08-06 19:00:00', 'Bojonegoro', 'https://drive.google.com/drive/folders/14Cahc7--xpDpgMtr0KeqML5ANA9BtJ51', 'https://us06web.zoom.us/j/84423366510?pwd=TmLUBy5xCSRPzjbANDPuyysdqgaAh2.1', 'ongoing', 0, '2026-08-03 21:39:17', '2026-08-27 03:34:55', NULL),
(7, 1, 'WFH 28 Agustus 2026', 'wfh-28-agustus-2026-1787827557', 'WFH Dispora Jatim 28 Agustus 2026', '2026-08-28 08:00:00', '2026-08-28 11:30:00', 'Zoom', 'https://drive.google.com/drive/folders/14Cahc7--xpDpgMtr0KeqML5ANA9BtJ51', 'https://us06web.zoom.us/j/84423366510?pwd=TmLUBy5xCSRPzjbANDPuyysdqgaAh2.1', 'upcoming', 2, '2026-08-27 03:45:57', '2026-09-01 00:54:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `image_path`, `button_text`, `button_url`, `is_active`, `start_date`, `end_date`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Haornas 2026', 'Penghargaan untuk Pelaku Olahraga Berprestasi', 'announcements/DfjTPjnJ38oQDixfgpfTMRMrMrfn3N04B3Y9Bq8D.jpg', NULL, 'https://www.canva.com/design/DAHUG2RIHRE/Kq5GVWHwG2n2Ia7KV8pMuw/edit', 1, '2026-09-04', '2026-09-21', 1, '2026-09-03 20:23:17', '2026-09-03 20:23:17'),
(2, 'Nobar Final Piala Dunia 2026', 'Nonton Bareng Gubernur Di Grahadi Final Piala Dunia 2026', 'announcements/dogt0WmgB5YZoKRgXUp1z8lykEAax80Gb2Bv0dKZ.jpg', NULL, NULL, 1, '2026-09-04', '2026-09-07', 2, '2026-09-03 20:24:59', '2026-09-03 20:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint UNSIGNED DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('dispora-jawa-timur-cache-admin@dispora.jatim.go.id|127.0.0.1', 'i:1;', 1787795410),
('dispora-jawa-timur-cache-admin@dispora.jatim.go.id|127.0.0.1:timer', 'i:1787795410;', 1787795410);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'RENJA', 'renja', 'document', NULL, '2026-07-20 21:15:13', '2026-07-20 21:15:13'),
(2, 'RENSTRA', 'renstra', 'document', NULL, '2026-07-20 21:15:13', '2026-07-20 21:15:13'),
(3, 'LKJIP', 'lkjip', 'document', NULL, '2026-07-20 21:15:13', '2026-07-20 21:15:13'),
(4, 'PK', 'pk', 'document', NULL, '2026-07-20 21:15:13', '2026-07-20 21:15:13'),
(5, 'OLAHRAGA', 'olahraga', 'post', NULL, '2026-07-20 21:15:13', '2026-07-20 21:15:13'),
(6, 'KEPEMUDAAN', 'kepemudaan', 'post', NULL, '2026-07-20 21:15:13', '2026-07-20 21:15:13'),
(7, 'KEPRAMUKAAN', 'kepramukaan', 'post', NULL, '2026-07-20 21:15:13', '2026-07-20 21:15:13'),
(8, 'GUBERNUR', 'gubernur', 'post', NULL, '2026-07-20 21:15:13', '2026-07-20 21:15:13'),
(9, 'UMUM', 'umum', 'post', NULL, '2026-07-20 21:15:13', '2026-07-20 21:15:13'),
(10, 'REGULASI', 'regulasi', 'document', NULL, '2026-07-20 21:15:13', '2026-07-20 21:15:13'),
(11, 'DPA', 'dpa', 'document', NULL, '2026-08-31 18:51:08', '2026-08-31 18:51:08'),
(12, 'ASET', 'aset', 'document', NULL, '2026-08-31 18:51:08', '2026-08-31 18:51:08'),
(13, 'LRA', 'lra', 'document', NULL, '2026-08-31 18:51:08', '2026-08-31 18:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `connected_apps`
--

CREATE TABLE `connected_apps` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `connected_apps`
--

INSERT INTO `connected_apps` (`id`, `name`, `description`, `url_link`, `logo_path`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Majadigi Pemerintah Provinsi Jawa Timur', 'Platform layanan publik Digital Jawa Timur', 'https://majadigi.jatimprov.go.id/', 'connected_apps/1Ax7y092tEyLQccw83wkID5I9JcIEsj6kPbAUlhN.png', 1, 1, '2026-08-03 19:12:22', '2026-08-03 19:12:22'),
(2, 'SP4N-Lapor', 'Layanan Aspirasi dan Pengaduan Online Rakyat kepada instansi pemerintah berwenang', 'https://prod.lapor.go.id/', 'connected_apps/2wMQqu9AMMF40CnaoCZJrdRurqiRiXe4WxZBj1JE.png', 2, 1, '2026-08-03 19:20:32', '2026-08-03 19:20:32'),
(3, 'SPORTIF', 'Sistem Informasi Kepemudaan dan Olahraga Integratif (SPORTIF) Jawa Timur', 'https://sportif-dispora.jatimprov.go.id/', 'connected_apps/MmR1VJxuY06BpvfhNLAqIUPLCus3GGBgJL8peozz.png', 3, 1, '2026-08-03 19:28:32', '2026-08-03 20:23:57'),
(4, 'PPID Dispora Jawa Timur', 'Layanan Informasi Publik PPID', 'https://ppid.dispora.jatimprov.go.id/', 'connected_apps/p4wJKZKC9N8iRzNIqIV8L7GNeTpGwLxXTO9Ua1wK.jpg', 4, 1, '2026-08-03 19:29:48', '2026-08-03 19:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_type` enum('public','internal_only') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `download_count` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `category_id`, `title`, `description`, `file_path`, `file_type`, `file_size`, `access_type`, `download_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 'Renstra 2026', 'Percobaan Dokumen Renstra 2025-2026', 'private/documents/Gxx3qKQr6dym5EeD6pXrVe4oye1kxv4HCforBXMv.pdf', 'pdf', '2031860', 'public', 0, '2026-07-21 00:39:18', '2026-07-21 00:39:18', NULL),
(2, 1, 4, 'MOU Pemerintah Provinsi Jawa Timur dengan UNESA', 'MOU Pemerintah Provinsi Jawa Timur dengan UNESA', 'private/documents/JRp77AooQ4bWNtm3f31UGAjn1VVzV1vlQSw10cQC.pdf', 'pdf', '918020', 'public', 0, '2026-07-21 02:02:39', '2026-07-21 02:02:39', NULL),
(3, 1, 1, 'Renja Perubahan 2026', 'Detail Lengkap isi Renja yang telah mengalami perubahan di tahun 2026', 'private/documents/YnLaE7jXw9sHr7KwQWNj7GCwVMHtfwepQL1UKkqI.pdf', 'pdf', '2214540', 'public', 0, '2026-07-26 20:43:58', '2026-07-26 20:43:58', NULL),
(4, 1, 3, 'LKJIP 2025', 'Detail isi LKJIP tahun 2025', 'private/documents/zY9UlWwmZe0u7HrV3C0P2KtvMowwhrVNgNr5Z5Wd.pdf', 'pdf', '2607870', 'public', 0, '2026-07-26 20:46:47', '2026-07-26 20:46:47', NULL),
(5, 1, 1, 'RENJA 2025', 'Isi Detail Renja Dispora Jatim Tahun 2025', 'private/documents/dARKHxVfsjWl8kL9SpG2VnVXM0dx0ITspDYopNcv.pdf', 'pdf', '2902659', 'public', 0, '2026-07-26 20:48:51', '2026-07-26 20:48:51', NULL),
(6, 1, 10, 'PERATURAN GUBERNUR JAWA TIMUR NOMOR 72 TAHUN 2023', 'TENTANG KEDUDUKAN, SUSUNAN ORGANISASI, URAIAN TUGAS DAN FUNGSI SERTA TATA KERJA DINAS', 'private/documents/cJAX2HScIm2k0dSh3DB7ORvl2OEjA3GfwkKb24JC.pdf', 'pdf', '2397112', 'public', 0, '2026-08-03 21:23:41', '2026-08-03 21:23:41', NULL),
(7, 1, 10, 'KEPUTUSAN GUBERNUR JAWA TIMUR NOMOR  28 TAHUN 2022', 'TENTANG TUGAS KELOMPOK SUB-SUBSTANSI DAN TUGAS SUB-KOORDINATOR DI LINGKUNGAN DINAS KEPEMUDAAN DAN OLAHRAGA PROVINSI JAWA TIMUR', 'private/documents/gGxcoBjnRaXJzdxxiOQoxyKJ6WFHARNJJr5AQL7J.pdf', 'pdf', '177285', 'public', 0, '2026-08-03 21:25:05', '2026-08-03 21:25:05', NULL),
(8, 1, 10, 'KEPUTUSAN GUBERNUR JAWA TIMUR NOMOR 108 TAHUN 2025', 'TENTANG PEDOMAN KERJA DAN PELAKSANAAN TUGAS PEMERINTAH PROVINSI JAWA TIMUR', 'private/documents/7JBHfeN24jVR6gc3CURpAzhDqAQK0PXxdAlJImlo.pdf', 'pdf', '2040984', 'public', 0, '2026-08-03 21:28:42', '2026-08-03 21:28:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_03_065959_create_permission_tables', 1),
(5, '2026_06_09_041406_create_categories_table', 1),
(6, '2026_06_09_041407_create_posts_table', 1),
(7, '2026_06_09_041611_create_documents_table', 1),
(8, '2026_06_09_041649_create_audit_logs_table', 1),
(9, '2026_06_09_041945_create_agency_profiles_table', 1),
(10, '2026_06_09_043407_create_agendas_table', 1),
(11, '2026_06_24_082836_create_visitors_table', 2),
(12, '2026_07_27_025040_create_connected_apps_table', 3),
(13, '2026_07_27_025040_create_services_table', 3),
(14, '2026_07_27_025041_create_skm_data_table', 3),
(15, '2026_07_27_025041_create_social_media_table', 3),
(16, '2026_08_18_073956_create_officials_table', 4),
(17, '2024_10_01_000000_create_logos_table', 5),
(18, '2026_08_27_111914_add_clicks_count_to_agendas_table', 5),
(19, '2026_09_04_011640_create_venues_table', 6),
(20, '2026_09_04_015115_add_is_active_to_skm_data_table', 7),
(21, '2026_09_04_022226_create_official_logos_table', 8),
(22, '2026_09_04_030439_create_announcements_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`id`, `name`, `position`, `photo`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Dr. M. HADI WAWAN GUNTORO, S.STP., M.Si. CIPA', 'Kepala Dinas', 'officials/ZwGncHBBiSPFDMpDmtYA3zpLUfb9zSwNjwkhZ64m.webp', 1, '2026-08-18 01:17:58', '2026-08-18 01:47:21'),
(2, 'Dra. VITRI RAHMAWATI, M.Si.', 'Sekretaris Dinas', 'officials/bW9sWzHQB5faWTd7feDmkbedkqqtlGXRowZN11Xw.webp', 2, '2026-08-18 01:18:30', '2026-08-18 01:18:30'),
(3, 'A. WAHAB, S.T., M.Si.', 'Kepala Bidang Olahraga Prestasi', 'officials/OZkhMqgZFoLTtQ5HCoW1F1uTGx3GCHyr0PDO7uF4.jpg', 4, '2026-08-18 01:19:04', '2026-08-18 02:05:51'),
(4, 'AWAN WIDODO, S.E, MM', 'Kepala Bidang Kepemudaan', 'officials/Hlma67dhRQjKPflFSsQybU5To7bvVCIWQ8RWsuCB.jpg', 3, '2026-08-18 01:19:51', '2026-08-18 02:05:25'),
(5, 'CEPI SUKUR LAKSANA, S.H.,M.M.', 'Kepala Bidang Pembudayaan Olahraga', 'officials/SUQe7AUX9Z7SR4DgATOMMZi6XuDRX15MnUNGcVAV.jpg', 5, '2026-08-18 01:20:29', '2026-08-18 02:06:07'),
(6, 'KUNCAHAYANI KARTIKA WULAN, S.H., M.H.', 'Kepala Bidang Kepramukaan', 'officials/vURt1o5nM3ZOVg2rli4yK9Ft7JnPWccUVT8qpTRX.webp', 6, '2026-08-18 01:21:03', '2026-08-18 01:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `official_logos`
--

CREATE TABLE `official_logos` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `official_logos`
--

INSERT INTO `official_logos` (`id`, `title`, `description`, `image_path`, `file_path`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Logo Dispora', 'Logo Dispora Warna Putih', 'official_logos/images/xjhgjwV3hpLAP1OWfEbRFsrIwz04G4H1ge8HGXk4.png', 'official_logos/files/3rTZILOGleK0RCUlBP7qgmWntRLdSnMu5pSoMtOG.png', 1, 5, '2026-09-03 19:36:53', '2026-09-03 19:53:20'),
(2, 'Logo Dispora Hijau', 'Logo Dispora Warna Hijau', 'official_logos/images/1V5J0Eg3XeNZE9SBM6rtE1iyCEGAkDPrFJjyrcSE.jpg', 'official_logos/files/uu3VrDIDfgowO6bXsslqBT0US4lNVmHDATNyKe1y.jpg', 1, 2, '2026-09-03 19:37:33', '2026-09-03 19:53:51'),
(3, 'Logo Sportif Academy', 'Logo Sportif Academy untuk Logo kegiatan Pelatihan Olahraga yang diselenggarakan oleh DISPORA JATIM', 'official_logos/images/7VJCGgr5lArNbPMl2oAI3K0o6jLaaYOimaY1QrDP.png', 'official_logos/files/4rtqgAcRdNgOrm2JEuk0sn9i9TKGZ5ne4mhr2kq2.png', 1, 3, '2026-09-03 19:46:44', '2026-09-03 19:46:44'),
(4, 'Logo Champion Go To School', 'Logo untuk Kegiatan Pengenalan Olahraga ke Sekolah Sekolah', 'official_logos/images/qGvLOFrGTj2pH3dv86VjGEAy17QJgYbI61ZgZILp.png', 'official_logos/files/dkf87OjcY6uyFQdre6JTokm0BFLxAccY8Ta1Xpw8.png', 1, 4, '2026-09-03 19:49:41', '2026-09-03 19:49:41'),
(5, 'Logo Dispora Merah', 'Logo Dispora warna Merah', 'official_logos/images/1NHxxuwjACVzc836K9WSPgilv2JVHAzl2p564Px7.png', 'official_logos/files/igjz5ormgcW2JsX3PutQ7h5Vuw5I6dKCqjcJFqFa.png', 1, 1, '2026-09-03 19:53:00', '2026-09-03 19:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','published','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `views_count` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `slug`, `content`, `featured_image`, `status`, `views_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 8, 'Nobar Final Piala Dunia 2026', 'nobar-final-piala-dunia-2026-6a5f29ab125ef', '<h2><strong>​Gubernur Khofifah Nobar Final Piala Dunia Bersama Ribuan Masyarakat di Halaman Grahadi: Sepak Bola Jadi Penyatu Kebersamaan dan Sportivitas</strong></h2><p>​<strong>SURABAYA, 20 JULI 2026</strong> – Gubernur Jawa Timur Khofifah Indar Parawansa membaur bersama ribuan masyarakat dalam kegiatan Nonton Bareng (Nobar) Partai Final Piala Dunia 2026 yang mempertemukan Spanyol melawan Argentina di Halaman Gedung Negara Grahadi, Surabaya, Senin (20/7/2026) dini hari.</p><p>​Tak kurang dari <strong>4.000 </strong>masyarakat dari berbagai daerah di Jatim begitu antusias memadati lokasi acara setelah sebelumnya melakukan pendaftaran secara daring melalui Dispora Jatim. Kegiatan semarak ini diinisiasi oleh TVRI Jawa Timur berkolaborasi dengan Pemerintah Provinsi (Pemprov) Jawa Timur.</p><p>​Gubernur Khofifah bersama Kepala Perangkat Daerah dan jajaran Forkopimda yang hadir tampak duduk lesehan bersama warga menyaksikan pertandingan melalui layar lebar, menciptakan suasana akrab dan penuh kekeluargaan. Untuk semakin memeriahkan suasana, Gubernur Khofifah juga membagikan beragam doorprize menarik, mulai dari laptop, sepeda gunung, hingga kulkas. Antusiasme warga pun kian terasa dengan adanya sajian hiburan menarik hingga laga usai.</p><figure class=\"image\"><img src=\"http://localhost:8000/admin/files/posts/vmxtboMk7FRGjXzhjuRn6IGEQ45WIrMBcm5NR0GP.png\"></figure>', 'private/posts/RYN0LxOaDa03hXpnhgZzqj7aFAmCm1D1G7ih0wVR.png', 'published', 0, '2026-07-21 01:11:23', '2026-07-21 01:49:26', NULL),
(2, 1, 5, 'Haornas', 'haornas-6a66dbd2be956', '<p><strong>Jatim Sportiv Festival 2025: Sinergi Dispora Jatim dan UNESA Apresiasi Pahlawan Olahraga di Peringatan Haornas ke-42</strong></p><p><strong>SURABAYA</strong> – Dalam rangka memperingati Hari Olahraga Nasional (Haornas) ke-42 tahun 2025, Pemerintah Provinsi Jawa Timur melalui Dinas Kepemudaan dan Olahraga (Dispora Jatim) berkolaborasi dengan Universitas Negeri Surabaya (UNESA) menggelar perayaan akbar bertajuk Jatim Sportiv Festival 2025. Acara yang mengusung semangat \"Bersatu Menuju Prestasi Dunia\" ini diselenggarakan di Halaman Rektorat UNESA Kampus Lidah Wetan, Surabaya, pada 25 hingga 26 September 2025.</p><p>Salah satu agenda utama dalam perayaan ini adalah pemberian apresiasi tertinggi kepada para pelaku olahraga yang telah berprestasi maupun memberikan dampak signifikan bagi kemajuan olahraga di Provinsi Jawa Timur. Gubernur Jawa Timur, Khofifah Indar Parawansa, secara langsung menyerahkan penghargaan berupa piagam dan uang pembinaan kepada berbagai elemen penting dalam ekosistem olahraga. Penerima penghargaan tersebut meliputi para pembina olahraga, purna atlet, pelatih, wasit, guru pendidikan jasmani, hingga instansi dan badan usaha yang dinilai peduli terhadap perkembangan olahraga.</p><p>\"Festival olahraga bukan sekadar ajang hiburan semata, melainkan momentum strategis untuk membina atlet dan mengembangkan olahraga, mulai dari generasi muda hingga tingkat profesional,\" tegas Gubernur Khofifah saat membuka acara. Beliau juga menambahkan bahwa UNESA memiliki peran krusial sebagai inisiator karena episentrum <i>sport science</i> (ilmu keolahragaan) di Indonesia saat ini berada di kampus tersebut.</p><p>Sebagai bentuk komitmen penguatan ekosistem olahraga, kegiatan ini diwarnai dengan penandatanganan Nota Kesepahaman (MoU) antara Pemprov Jatim dan UNESA. Kerja sama strategis ini mencakup bidang pendidikan, pelatihan, penelitian, pengabdian masyarakat, serta pengembangan Sumber Daya Manusia (SDM) untuk memastikan peningkatan kualitas dan prestasi olahraga di Jawa Timur berjalan secara berkelanjutan.</p><p>Kepala Dispora Jatim, M. Hadi Wawan Guntoro, yang turut hadir dalam acara pembukaan, menegaskan bahwa Jatim Sportiv merupakan momentum krusial untuk memperkuat ekosistem olahraga daerah. Hal senada juga disampaikan oleh Rektor UNESA, Nurhasan, yang menyatakan bahwa komitmen kampusnya dalam ajang ini adalah untuk membumikan semangat olahraga sejak dini serta memperkuat kultur keolahragaan di tingkat regional dan nasional.</p>', 'private/posts/PUistveJG7Sdjx2gvMIBw8833kMKRfLIlXDgVGF1.jpg', 'published', 0, '2026-07-26 21:17:22', '2026-07-26 21:17:22', NULL),
(3, 1, 6, 'YC2 Barbershop Membangun Pemuda yang berkarya', 'yc2-barbershop-membangun-pemuda-yang-berkarya-6a66dd7ba16d9', '<p><strong>Wujudkan Pemuda Mandiri dan Berkarya, Dispora Jatim Sukses Gelar Pelatihan Barbershop di BLK Malang</strong></p><p><strong>MALANG</strong> – Sebagai wujud nyata komitmen dalam mencetak generasi muda yang mandiri dan memiliki daya saing ekonomi, Dinas Kepemudaan dan Olahraga (Dispora) Provinsi Jawa Timur melalui Bidang Kepemudaan sukses menyelenggarakan program \"Pelatihan Barbershop dan Kewirausahaan Pemuda\". Kegiatan pembekalan keterampilan pangkas rambut ini dipusatkan di Balai Latihan Kerja (BLK) Kota Malang dan diikuti oleh puluhan pemuda perwakilan dari berbagai kabupaten/kota di Jawa Timur.</p><p>Pelatihan ini dirancang komprehensif, tidak hanya berfokus pada keahlian teknis memotong rambut, tetapi juga membekali para peserta dengan manajemen bisnis dasar. Selama masa pelatihan, para peserta dilatih secara intensif oleh instruktur <i>barber</i> profesional. Mereka mempelajari berbagai teknik pangkas rambut kekinian seperti <i>fading</i>, <i>hair styling</i>, teknik pewarnaan, perawatan alat cukur, hingga etika memberikan pelayanan prima (<i>customer service</i>) kepada pelanggan.</p><p>Perwakilan dari Bidang Kepemudaan Dispora Jatim dalam sambutannya menyatakan bahwa industri <i>barbershop</i> saat ini berkembang pesat dan menjadi salah satu peluang usaha dengan perputaran ekonomi yang menjanjikan.</p><figure class=\"image\"><img style=\"aspect-ratio:1370/771;\" src=\"http://localhost:8000/admin/files/posts/i8lWXIMUULSp6y4BNA1x1vZlj5nqsaL4nTqFhid0.jpg\" width=\"1370\" height=\"771\"></figure><p>\"Tujuan utama dari kegiatan ini adalah membangun pemuda yang mandiri dan berkarya. Kita ingin mengubah <i>mindset</i> pemuda agar tidak sekadar mencari kerja, tetapi berani menciptakan lapangan kerja baru, minimal untuk dirinya sendiri. Kemandirian ekonomi berawal dari keberanian memulai, dan kami memfasilitasi langkah pertama mereka di sini,\" jelasnya.<br><br>Melalui pembinaan yang berkelanjutan dan tepat sasaran ini, Dispora Jatim berharap angka pengangguran di kalangan usia produktif dapat terus ditekan. Para alumni pelatihan dari BLK Malang ini diharapkan dapat segera kembali ke daerah asal mereka masing-masing, mulai berkarya, dan menjadi pengusaha <i>barbershop</i> muda yang sukses serta menginspirasi lingkungan sekitarnya.</p>', 'private/posts/g9lRJhA5tS0kjQZNX3zKzKGE1Wnxo6f9w0hIMV7O.jpg', 'published', 0, '2026-07-26 21:24:27', '2026-07-26 21:24:27', NULL),
(4, 1, 7, 'PENGUATAN KAPASITAS PRAMUKA DALAM PENYEDIAAN DATA DAN INFORMASI', 'penguatan-kapasitas-pramuka-dalam-penyediaan-data-dan-informasi-6a66debc2fad4', '<p><strong>Tingkatkan Kualitas Data dan Informasi, Dispora Jatim Gelar Penguatan Kapasitas SDM Pramuka di Malang</strong></p><p><strong>MALANG</strong> – Dalam era digitalisasi yang bergerak cepat, ketersediaan data yang akurat dan penyebaran informasi yang positif menjadi kunci utama dalam memajukan sebuah organisasi. Menyadari urgensi tersebut, Dinas Kepemudaan dan Olahraga (Dispora) Provinsi Jawa Timur berkolaborasi dengan Kwartir Daerah (Kwarda) Gerakan Pramuka Jatim menyelenggarakan kegiatan \"Penguatan Kapasitas SDM Pramuka\".</p><p>Fokus utama dari kegiatan ini adalah penguatan sumber daya manusia dalam penyediaan data dan informasi kepramukaan di tingkat provinsi. Agenda strategis ini dilaksanakan selama dua hari penuh, yakni pada tanggal 15 hingga 16 April, dengan mengambil lokasi di Kota Malang.</p><p>Kegiatan ini diikuti oleh perwakilan anggota Pramuka dan pengurus Pusat Informasi (Pusinfo) dari berbagai Kwartir Cabang (Kwarcab) se-Jawa Timur. Tujuan utamanya adalah membekali para kader Pramuka dengan keterampilan khusus untuk mengelola sistem informasi, mendokumentasikan setiap kegiatan secara profesional, serta menyajikan data kepramukaan yang valid, terstruktur, dan transparan.</p><p>Selama dua hari pelaksanaan di Malang, para peserta tidak hanya menerima paparan teori, tetapi juga dilatih secara praktik oleh para praktisi dan narasumber ahli. Materi yang diberikan sangat komprehensif, mulai dari manajemen basis data (pangkalan data keanggotaan dan potensi daerah), jurnalistik dasar untuk kehumasan, pemanfaatan media sosial sebagai sarana publikasi efektif, hingga manajemen krisis informasi.</p><p>Perwakilan penyelenggara dari Dispora Jatim menyampaikan bahwa Pramuka masa kini harus memiliki literasi digital yang kuat. \"Anggota Pramuka tidak hanya dituntut tangguh dan cakap saat berkegiatan di alam terbuka, tetapi juga harus adaptif terhadap teknologi. Penguatan kapasitas ini sangat penting agar setiap potensi, prestasi, dan kegiatan positif Pramuka di Jawa Timur dapat terdata dengan baik dan tersampaikan secara luas kepada masyarakat,\" jelasnya.</p><p>Pemilihan penyajian data yang rapi dan terintegrasi ini juga dinilai sangat krusial bagi pemerintah dan Kwarda Jatim. Dengan ketersediaan data yang presisi, perumusan kebijakan, evaluasi program, serta penyaluran bantuan pembinaan kepramukaan di masa mendatang dapat dilakukan dengan lebih terukur dan tepat sasaran.</p><figure class=\"image\"><img style=\"aspect-ratio:1157/771;\" src=\"http://localhost:8000/admin/files/posts/jtDecroUE39K8j0AnqJcdwGBeZqUAB4W5954K0c0.jpg\" width=\"1157\" height=\"771\"></figure><p>Melalui pelatihan intensif ini, diharapkan para peserta yang kembali ke daerahnya masing-masing dapat menjadi motor penggerak literasi digital di Kwarcab-nya. Mereka diproyeksikan menjadi ujung tombak kehumasan yang andal, memastikan Gerakan Pramuka Jawa Timur terus beradaptasi dengan zaman dan memberikan dampak yang semakin nyata bagi masyarakat.</p>', 'private/posts/1MIgSGXRKV8LogqE8epNQa1xxTb5572JzJIUej5A.jpg', 'published', 0, '2026-07-26 21:29:48', '2026-07-26 21:29:48', NULL),
(5, 1, 9, 'Musprov Perwosi Jawa Timur 2026', 'musprov-perwosi-jawa-timur-2026-6a66e150a4373', '<p><strong>Sinergi Bangun Olahraga Perempuan, Musprov Perwosi Jatim 2026 Sukses Digelar di Sidoarjo</strong></p><p><strong>SIDOARJO</strong> – Persatuan Wanita Olahraga Seluruh Indonesia (Perwosi) Provinsi Jawa Timur kembali menegaskan komitmennya dalam memajukan peran perempuan di kancah olahraga dan gaya hidup sehat. Hal ini diwujudkan melalui penyelenggaraan Musyawarah Provinsi (Musprov) Perwosi Jatim yang berlangsung sukses dan khidmat di Sidoarjo pada Sabtu, 20 Juni 2026.</p><p>Mengusung semangat kolaborasi dan pemberdayaan perempuan, forum musyawarah tertinggi di tingkat provinsi ini dihadiri oleh jajaran pengurus Perwosi dari berbagai kabupaten/kota se-Jawa Timur. Agenda utama Musprov tahun ini difokuskan pada evaluasi capaian program kerja sebelumnya, penyusunan strategi pembinaan olahraga yang lebih inklusif untuk periode mendatang, serta penguatan struktur organisasi.</p><p>Fokus utama Perwosi Jatim ke depan adalah mewujudkan keluarga dan masyarakat Jawa Timur yang bugar melalui peran aktif perempuan. Perempuan, khususnya para ibu, dinilai memiliki peran strategis sebagai motor penggerak kebiasaan hidup sehat dan gemar berolahraga, yang dimulai dari lingkup terkecil yakni keluarga. \"Perwosi bukan sekadar organisasi wanita biasa, tetapi wadah penggerak yang menginspirasi perempuan Jawa Timur untuk aktif berolahraga, sekaligus mendukung lahirnya bibit-bibit atlet berprestasi sejak usia dini,\" jelas Ketua Pengprov Perwosi Jawa Timur.</p><figure class=\"image\"><img style=\"aspect-ratio:1370/771;\" src=\"http://localhost:8000/admin/files/posts/YDuUijLaXAwtAJnjdzKUCdvfRU7ogF2qPodS2BCQ.jpg\" width=\"1370\" height=\"771\"></figure><p>Dinas Kepemudaan dan Olahraga (Dispora) Provinsi Jawa Timur yang turut hadir dan mengawal jalannya Musprov ini memberikan dukungan penuh terhadap langkah-langkah strategis Perwosi. Dispora Jatim memandang Perwosi sebagai mitra krusial pemerintah daerah dalam upaya meningkatkan Indeks Kebugaran Masyarakat (IKM) secara masif. Sinergi yang kuat antara Dispora dan Perwosi diyakini mampu menciptakan ekosistem keolahragaan yang aman, nyaman, dan ramah bagi perempuan serta anak.</p><p>Selain membahas program kerja, Musprov di Sidoarjo ini juga menjadi ajang konsolidasi untuk memastikan setiap program pembinaan yang dirancang selaras dengan visi pembangunan olahraga Pemprov Jatim menuju prestasi tingkat nasional hingga internasional.</p><p>Melalui hasil rumusan dan kesepakatan dalam Musprov 2026 ini, Perwosi Jatim bersiap untuk merealisasikan program-program kerja yang lebih inovatif, adaptif, dan berdampak langsung ke masyarakat. Ke depannya, kolaborasi yang semakin solid ini diharapkan terus memompa semangat olahraga di kalangan perempuan, sekaligus mengukuhkan Jawa Timur sebagai barometer pembinaan olahraga wanita terbaik di Indonesia.</p>', 'private/posts/jl9jixTwRSOhZZt41Fjz0bwudaRn4ZMrL1wYaiCL.jpg', 'published', 0, '2026-07-26 21:40:48', '2026-07-26 21:40:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2026-06-09 01:26:08', '2026-06-09 01:26:08'),
(2, 'Admin PPID', 'web', '2026-06-09 01:26:08', '2026-06-09 01:26:08'),
(3, 'Staf Dispora', 'web', '2026-06-09 01:26:08', '2026-06-09 01:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3cu87Gi3bb2GvZhaGTfcUxUn0yytFVJTs2XQGdx9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJud08xQWRtdDdGYmN3RHBjZVBQNmROeTJEVDJ0SGpEU2VhcjMzQkR3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9maWxlXC9wb3N0c1wvUllOMEx4T2FEYTAzaFhwbmhnWnpxajdhRkFtQ20xRDFHN2loMHdWUi5wbmciLCJyb3V0ZSI6InB1YmxpYy5maWxlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1790076358),
('D7ZQogG8KICIl05DyOqd35Cle8CuMDoaa9cqDPnF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ6amNBZmZXNlVLVWR3S3BMeGx0NkJYcGdNbzZiRXhzTkE5TFkzWEl5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1790049419),
('DczUvpQqB78Hr9w1FoCqoKxer8Bv5vesJZSNHF8Z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ5RzV3VmdERXhGcDlEeDhqemcwYUtHMk5JcUZVa0Fqc29xYUlaSmRRIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAyIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1790049460),
('ws9aB7LByeEdW3EsxgruHrXF2OBq5C5eKfgG4xup', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJmem1zempBSHdhQ3FCdWNMM0dNRDVxekNCVHVQWkJCTnlTaU1CV0ZLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1790058492);

-- --------------------------------------------------------

--
-- Table structure for table `skm_data`
--

CREATE TABLE `skm_data` (
  `id` bigint UNSIGNED NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index_value` decimal(5,2) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skm_data`
--

INSERT INTO `skm_data` (`id`, `year`, `period`, `index_value`, `category`, `document_path`, `is_published`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '2026', 'Triwulan I', '93.10', 'A (Baik)', NULL, 1, 0, '2026-08-03 19:07:56', '2026-09-03 18:44:43'),
(2, '2026', 'Triwulan II', '85.35', 'A (Baik)', NULL, 1, 0, '2026-09-03 18:32:38', '2026-09-03 18:45:49'),
(3, '2026', 'Semester I', '89.44', 'A (Baik)', NULL, 1, 1, '2026-09-03 18:45:22', '2026-09-03 18:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint UNSIGNED NOT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `platform`, `account_name`, `url`, `icon_class`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Youtube', '@disporajatim2025', 'https://www.youtube.com/@disporajatim2025', 'fa-brands fa-youtube', 1, '2026-08-03 20:05:53', '2026-08-03 20:05:53'),
(2, 'Instagram', '@dispora_jatim', 'https://www.instagram.com/dispora_jatim/', 'fa-brands fa-instagram', 1, '2026-08-03 20:06:18', '2026-08-03 20:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@dispora.jatimprov.go.id', '2026-06-09 01:26:08', '$2y$12$HdimAj7QZbcmKI9FSGRTJOHsqvkjTvG7zQhnKdcqEX68Y6pu6VV7O', '07Zr8QHixISeTjFgQ6kOVj9Am5YU5Y6aBrVxe9pEblxq08hZ4DZohhGcQ1eT', '2026-06-09 01:26:08', '2026-08-27 02:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `pic_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `name`, `image_path`, `short_description`, `description`, `pic_name`, `pic_phone`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Lapangan Jatim Seger', NULL, 'Fasilitas olahraga multifungsi untuk atlet dan masyarakat.', 'Lapangan Jatim Seger adalah fasilitas olahraga andalan Jawa Timur yang dirancang untuk mendukung berbagai aktivitas kebugaran, baik untuk atlet profesional maupun masyarakat umum.', 'Budi Santoso', '6281234567890', 1, 1, '2026-09-03 18:18:28', '2026-09-03 18:18:28'),
(2, 'Lapangan Badminton', NULL, 'Lapangan bulu tangkis standar nasional dengan pencahayaan optimal.', 'Fasilitas lapangan badminton dengan karpet standar BWF, pencahayaan LED yang tidak menyilaukan, dan sirkulasi udara yang baik. Cocok untuk latihan dan pertandingan resmi.', 'Rini Yulianti', '6281234567891', 1, 2, '2026-09-03 18:18:28', '2026-09-03 18:18:28'),
(3, 'Lapangan Tenis Meja', NULL, 'Arena tenis meja dalam ruangan dengan fasilitas lengkap.', 'Arena tenis meja yang dilengkapi dengan meja bersertifikat standar ITTF. Lantai anti-slip dan pencahayaan khusus dirancang untuk kenyamanan pemain.', 'Agus Pratama', '6281234567892', 1, 3, '2026-09-03 18:18:28', '2026-09-03 18:18:28'),
(4, 'Dojo Karate', NULL, 'Pusat pelatihan bela diri Karate Jawa Timur.', 'Dojo Karate resmi yang difasilitasi dengan matras tatami standar kompetisi. Digunakan sebagai pusat pemusatan latihan atlet Karate Jawa Timur.', 'Sensei Rahman', '6281234567893', 1, 4, '2026-09-03 18:18:28', '2026-09-03 18:18:28'),
(5, 'Dojo Judo', NULL, 'Fasilitas latihan Judo dengan matras berstandar internasional.', 'Dojo Judo yang aman dan nyaman, dilengkapi dengan sistem pegas di bawah matras untuk meminimalisir cedera saat bantingan.', 'Sensei Tari', '6281234567894', 1, 5, '2026-09-03 18:18:28', '2026-09-03 18:18:28'),
(6, 'Gelanggang Atletik', NULL, 'Lintasan lari sintetis dan arena lompat/lempar.', 'Gelanggang Atletik berstandar IAAF dengan lintasan lari berbahan tartan sintetis. Tersedia juga fasilitas untuk lompat jauh, lompat tinggi, dan tolak peluru.', 'Hendro Setiawan', '6281234567895', 1, 6, '2026-09-03 18:18:28', '2026-09-03 18:18:28'),
(7, 'Kolam Renang', NULL, 'Kolam renang ukuran olimpiade untuk pembinaan akuatik.', 'Kolam renang berukuran olimpiade (50 meter) dengan 10 lintasan. Dilengkapi dengan kolam loncat indah dan sistem penyaringan air otomatis.', 'Maya Sari', '6281234567896', 1, 7, '2026-09-03 18:18:28', '2026-09-03 18:18:28');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint UNSIGNED NOT NULL,
  `ip_address` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visit_date` date NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`, `visit_date`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-06-24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-24 01:38:49', '2026-06-24 01:38:49'),
(2, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-06-25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-24 21:07:55', '2026-06-24 21:07:55'),
(3, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-06-26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-26 01:49:57', '2026-06-26 01:49:57'),
(4, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-07-21', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-20 20:39:14', '2026-07-20 20:39:14'),
(5, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-07-27', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-26 19:38:23', '2026-07-26 19:38:23'),
(6, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-08-04', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-03 19:02:11', '2026-08-03 19:02:11'),
(7, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-08-18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 00:28:59', '2026-08-18 00:28:59'),
(8, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-08-19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 18:29:38', '2026-08-18 18:29:38'),
(9, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-08-24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-23 19:44:36', '2026-08-23 19:44:36'),
(10, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-08-26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-26 01:28:29', '2026-08-26 01:28:29'),
(11, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-08-27', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-26 17:58:32', '2026-08-26 17:58:32'),
(12, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-08-31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-08-31 04:02:21', '2026-08-31 04:02:21'),
(13, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-01', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-08-31 18:10:58', '2026-08-31 18:10:58'),
(14, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-04', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-03 18:05:05', '2026-09-03 18:05:05'),
(15, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-13 18:31:32', '2026-09-13 18:31:32'),
(16, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-21 20:23:38', '2026-09-21 20:23:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency_profiles`
--
ALTER TABLE `agency_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agency_profiles_key_unique` (`key`);

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agendas_slug_unique` (`slug`),
  ADD KEY `agendas_user_id_foreign` (`user_id`),
  ADD KEY `agendas_start_date_status_index` (`start_date`,`status`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `connected_apps`
--
ALTER TABLE `connected_apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_user_id_foreign` (`user_id`),
  ADD KEY `documents_category_id_foreign` (`category_id`),
  ADD KEY `documents_access_type_index` (`access_type`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

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
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `logos_type_unique` (`type`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `official_logos`
--
ALTER TABLE `official_logos`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_status_created_at_index` (`status`,`created_at`);

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
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `skm_data`
--
ALTER TABLE `skm_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `visitors_ip_address_visit_date_unique` (`ip_address`,`visit_date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agency_profiles`
--
ALTER TABLE `agency_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `connected_apps`
--
ALTER TABLE `connected_apps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `official_logos`
--
ALTER TABLE `official_logos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skm_data`
--
ALTER TABLE `skm_data`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agendas`
--
ALTER TABLE `agendas`
  ADD CONSTRAINT `agendas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
