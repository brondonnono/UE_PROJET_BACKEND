-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour euProjet
CREATE DATABASE IF NOT EXISTS `euProjet` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `euProjet`;

-- Listage de la structure de la table euProjet. candidate
CREATE TABLE IF NOT EXISTS `candidate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employe_id` int(10) unsigned NOT NULL,
  `offre_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `candidate_employe_id_foreign` (`employe_id`),
  KEY `candidate_offre_id_foreign` (`offre_id`),
  CONSTRAINT `candidate_employe_id_foreign` FOREIGN KEY (`employe_id`) REFERENCES `employes` (`id`),
  CONSTRAINT `candidate_offre_id_foreign` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table euProjet.candidate : ~0 rows (environ)
/*!40000 ALTER TABLE `candidate` DISABLE KEYS */;
/*!40000 ALTER TABLE `candidate` ENABLE KEYS */;

-- Listage de la structure de la table euProjet. competences
CREATE TABLE IF NOT EXISTS `competences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table euProjet.competences : ~0 rows (environ)
/*!40000 ALTER TABLE `competences` DISABLE KEYS */;
INSERT INTO `competences` (`id`, `label`, `experience`, `created_at`, `updated_at`) VALUES
	(1, 'DEVELOPPEUR LARAVEL', '3', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(2, 'DEVELOPPEUR ANGULAR', '3', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(3, 'DEVELOPPEUR SPRINGBOOT', '3', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(4, 'DEVELOPPEUR FULLSTACK', '5', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(5, 'DEVELOPPEUR SPRINGBOOT', '3', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(6, 'WEB DESIGNER', '3', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(7, 'WEB MASTER', '4', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(8, 'INFOGRAPHE', '5', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(9, 'UI DESIGNER', '2', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(10, 'UI DESIGNER', '2', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(11, 'UI DESIGNER', '2', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(12, 'Développeur Frontend Mobile', '4', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(13, 'Développeur Backend Mobile', '6', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(14, 'Développeur Mobile', '5', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(15, 'Comptable générale', '7', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(16, 'Comptable  Matière', '5', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(17, 'Ingénieur Mecatronicien', '8', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(18, 'Electricien Automobile', '3', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(19, 'Expert Comptable', '9', '2022-05-03 08:47:52', '2022-05-03 08:47:53'),
	(20, 'Assistant Comptable', '2', '2022-05-03 08:47:52', '2022-05-03 08:47:53');
/*!40000 ALTER TABLE `competences` ENABLE KEYS */;

-- Listage de la structure de la table euProjet. employes
CREATE TABLE IF NOT EXISTS `employes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateNais` timestamp NOT NULL,
  `formations` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `competences` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `villeResidence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employes_user_id_foreign` (`user_id`),
  CONSTRAINT `employes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table euProjet.employes : ~5 rows (environ)
/*!40000 ALTER TABLE `employes` DISABLE KEYS */;
INSERT INTO `employes` (`id`, `user_id`, `nom`, `sexe`, `DateNais`, `formations`, `competences`, `villeResidence`, `cv`, `avatar`, `created_at`, `updated_at`) VALUES
	(1, 2, 'macbook', 'M', '2000-01-01 00:00:00', 'bepc;probatoire TI;baccalaureat TI;licence en informatique generale;master en science des données', 'angular;laravel;springBoot;sql;react;ionic;vuejs;css;bootstrap;python', 'Yaounde', 'http://localhost:8000/cv/CV-wilfried-2022-02-04-1904632276_1651413998.pdf', 'http://localhost:8000/avatars/me-2090222157_1651442113.png', '2022-03-31 11:03:57', '2022-05-01 21:55:14'),
	(2, 11, 'Kevine Ngadjeu', 'F', '2000-01-01 00:00:00', 'Ingenieur Agronome', 'Ingenieur_Agricole', 'Dschang', 'http://localhost:8000/cv/CV_Comptable-1731422801_1651414767.docx', 'http://localhost:8000/avatars/kev-1794326445_1651414651.JPG', '2022-03-31 11:03:57', '2022-05-01 14:19:28'),
	(3, 13, 'client3', 'F', '2000-01-01 00:00:00', 'probatoire;bepc', 'react;sql;laravel', 'yaounde', 'C:\\Users\\SCOFIELD\\Downloads\\CV wilfried-old.pdf', 'http://localhost:8000/avatars/profil.png', '2022-03-31 11:03:57', '2022-03-31 11:03:57'),
	(4, 12, 'client2', 'F', '2000-01-01 00:00:00', 'bepc', 'react;bootstrap', 'yaounde', 'C:\\Users\\SCOFIELD\\Downloads\\CV wilfried-old.pdf', 'http://localhost:8000/avatars/profil.png', '2022-03-31 11:03:57', '2022-03-31 11:03:57'),
	(5, 23, 'DschangaiBoy', 'M', '1998-04-13 12:18:49', 'bepc;bac+5', 'Ingenieur_Agricole', 'yaounde', 'C:\\Users\\SCOFIELD\\Downloads\\CV wilfried-old.pdf', 'http://localhost:8000/avatars/profil.png', '2022-04-13 12:20:06', '2022-04-13 12:20:10');
/*!40000 ALTER TABLE `employes` ENABLE KEYS */;

-- Listage de la structure de la table euProjet. employeurs
CREATE TABLE IF NOT EXISTS `employeurs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Secteur_activité` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://localhost:8000/avatars/employeur.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employeurs_user_id_foreign` (`user_id`),
  CONSTRAINT `employeurs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table euProjet.employeurs : ~0 rows (environ)
/*!40000 ALTER TABLE `employeurs` DISABLE KEYS */;
INSERT INTO `employeurs` (`id`, `user_id`, `nom`, `description`, `Secteur_activité`, `ville`, `avatar`, `created_at`, `updated_at`) VALUES
	(1, 1, 'goStartup', 'Entreprise spécialisé dans le developpement d\'application de web,mobile et desktop', 'Informatique', 'yaounde', 'http://localhost:8000/avatars/19.png', '2022-03-31 11:02:46', '2022-03-31 11:02:46'),
	(2, 3, 'SAFIVS SA', 'Société Africaine de Fabrication', 'Agroalimentaire', 'yaounde', 'http://localhost:8000/avatars/employeur.png', '2022-03-31 15:23:24', '2022-03-31 15:23:33'),
	(3, 10, 'KRMA', 'KRMA est une jeune entreprise de gestion des risques spécialisée dans les risques agricoles et financiers. Basée au quartier Bastos de Yaoundé, l’entreprise accompagne ses clients dans la prévention, le suivi et le pilotage des risques liés à leurs activités agricoles et/ou financières.', 'Agriculture', 'Yaoundé', 'http://localhost:8000/avatars/employeur.png', '2022-03-31 16:00:22', '2022-03-31 16:00:23'),
	(4, 9, 'IKWEN', 'ikwen is an internet company located in Yaoundé. We are providing B2B Cloud solutions and also B2C products.', 'Informatique, SSII, Internet', 'yaounde', 'http://localhost:8000/avatars/8-1428650190_1651442089.jpg', '2022-03-31 16:02:11', '2022-03-31 16:02:12'),
	(5, 7, 'DORCAS TECHNOLOGIES', 'Entreprise spécialisé dans le debogage des applications mobile et desktop', 'Informatique', 'Douala', 'http://localhost:8000/avatars/6-222639188_1651442078.png', '2022-03-31 11:02:46', '2022-03-31 11:02:46'),
	(6, 5, 'BUSINESSONE SARL', 'Societe Camerounaise de trading', 'CryptoMonnaie', 'Douala', 'http://localhost:8000/avatars/employeur.png', '2022-03-31 15:23:24', '2022-03-31 15:23:33'),
	(7, 6, 'ALPHOSA', 'Centre de formation en conduite automobile categorie A(moto) et B(voiture 4 roues) ', 'Formation automobile', 'Buea', 'http://localhost:8000/avatars/employeur.png', '2022-03-31 15:23:24', '2022-03-31 15:23:33'),
	(8, 4, 'AFRICASHORE', 'Maison de publication et edition de livre(roman,etc...)', 'Edition', 'Dschang', 'http://localhost:8000/avatars/employeur.png', '2022-03-31 15:23:24', '2022-03-31 15:23:33'),
	(9, 8, 'KOUHSI', 'Societe à Responsabilités Limités ayant pour principal fonction les impressions de toutes natures et infographie et serigraphie generale', 'Infographie,Serigraphie', 'Dschang', 'http://localhost:8000/avatars/2-970134264_1651442044.png', '2022-03-31 15:23:24', '2022-03-31 15:23:33');
/*!40000 ALTER TABLE `employeurs` ENABLE KEYS */;

-- Listage de la structure de la table euProjet. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Listage des données de la table euProjet.failed_jobs : ~0 rows (environ)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage de la structure de la table euProjet. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table euProjet.migrations : ~10 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_03_17_180030_create_employeurs_table', 1),
	(6, '2022_03_17_200030_create_offre_table', 1),
	(7, '2022_03_17_280010_create_employes_table', 1),
	(8, '2022_04_11_232147_create_competences_table', 1),
	(9, '2022_04_16_005941_candidate', 1),
	(10, '2022_04_16_010016_offer_rejected', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table euProjet. offerrejected
CREATE TABLE IF NOT EXISTS `offerrejected` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employe_id` int(10) unsigned NOT NULL,
  `offre_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offerrejected_employe_id_foreign` (`employe_id`),
  KEY `offerrejected_offre_id_foreign` (`offre_id`),
  CONSTRAINT `offerrejected_employe_id_foreign` FOREIGN KEY (`employe_id`) REFERENCES `employes` (`id`),
  CONSTRAINT `offerrejected_offre_id_foreign` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table euProjet.offerrejected : ~0 rows (environ)
/*!40000 ALTER TABLE `offerrejected` DISABLE KEYS */;
/*!40000 ALTER TABLE `offerrejected` ENABLE KEYS */;

-- Listage de la structure de la table euProjet. offres
CREATE TABLE IF NOT EXISTS `offres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeur_id` int(10) unsigned NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateExpiration` timestamp NOT NULL,
  `posteVise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `competencesRequises` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `typeOffre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offres_employeur_id_foreign` (`employeur_id`),
  CONSTRAINT `offres_employeur_id_foreign` FOREIGN KEY (`employeur_id`) REFERENCES `employeurs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table euProjet.offres : ~0 rows (environ)
/*!40000 ALTER TABLE `offres` DISABLE KEYS */;
INSERT INTO `offres` (`id`, `employeur_id`, `libelle`, `description`, `dateExpiration`, `posteVise`, `competencesRequises`, `typeOffre`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Recherche d\'un developpeur web fullstack', 'developpeur web a temps plein', '2022-04-09 12:22:00', 'Developpeur web fullstack', 'angular;laravel;sql', 'temps plein', '2022-03-31 11:10:55', '2022-03-31 11:10:55'),
	(2, 9, 'Recherche d\'un web designer', 'web designer temps plein', '2022-04-19 14:42:04', 'web designer', 'css;bootstrap;sass;scss', 'temps plein', '2022-03-31 14:42:46', '2022-03-31 14:43:08'),
	(3, 2, 'Chef Produit', 'Sous la responsabilité du responsable marketing, le Chef Produit aura pour mission :', '2022-05-10 00:00:00', 'Chef Produit', 'chefProduit;commercial;caissier', 'temps plein', '2022-03-31 15:26:05', '2022-03-31 15:26:07'),
	(4, 3, 'Expert des Risques Agricoles', 'Le candidat sera rattaché à la Division des Risques Agricoles et aura pour principales missions :', '2022-02-21 16:03:13', 'Expert des Risques Agricoles', 'Ingenieur_Agricole;Expert_Risques_Agricole', 'temps plein', '2022-03-31 16:03:50', '2022-03-31 16:03:56'),
	(5, 4, 'Développeurs web frontend', 'Développeurs web frontend', '2023-03-31 16:05:53', 'Développeurs web frontend', 'angular;react;vuejs', 'temps partiel', '2022-03-31 16:06:53', '2022-03-31 16:06:54'),
	(6, 5, 'Recherche d\'un WebDesigner', 'Nous avons activement besoin d\'un WebDesigner pour un contrat de type CDI dans la ville de Yaoundé', '2022-05-19 00:00:00', 'WebDesigner', 'css;scss;sass;bootstrap', 'temps plein', '2022-04-16 00:50:52', '2022-04-16 00:50:52');
/*!40000 ALTER TABLE `offres` ENABLE KEYS */;

-- Listage de la structure de la table euProjet. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table euProjet.password_resets : ~0 rows (environ)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage de la structure de la table euProjet. personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table euProjet.personal_access_tokens : ~73 rows (environ)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', 'b36727b98026e5fd01c96ada82c714fc09a1ea3d70792b04eab0505643260160', '["*"]', NULL, '2022-03-28 16:51:05', '2022-03-28 16:51:05'),
	(5, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', 'f1d9f2cd5b90921f2471b5cd7dbd29048ace797b12a000d591ddb4b9878e15ce', '["*"]', NULL, '2022-03-28 17:02:27', '2022-03-28 17:02:27'),
	(6, 'App\\Models\\User', 3, 'book237@gmail.com_Token', 'cb291f1386223fbaf898e13eca4c9d5c925e07b2194719b3790e21f4ea06ee8d', '["*"]', NULL, '2022-03-31 10:48:55', '2022-03-31 10:48:55'),
	(8, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', 'a6235e9d49fe78d138eb35b91fa7f14da3f2322df3c7e18b1076160a3195e442', '["*"]', NULL, '2022-03-31 14:42:06', '2022-03-31 14:42:06'),
	(9, 'App\\Models\\User', 4, 'africashore@gmail.cm_Token', 'dc844dbcc5f08a11f72dfe9e826b4ae37ac40afe3588d96c3c6e7dc2b0e292b4', '["*"]', NULL, '2022-03-31 14:53:56', '2022-03-31 14:53:56'),
	(10, 'App\\Models\\User', 5, 'BUSINESSONE@gmail.cm_Token', '4e141dab29408533da1181c5fd22a54651b401db1187d22ce244709cb992a788', '["*"]', NULL, '2022-03-31 14:54:51', '2022-03-31 14:54:51'),
	(11, 'App\\Models\\User', 6, 'ALPHOSA@gmail.cm_Token', 'b047683e66e2220d04c39ee471288d390f48c0ae0568ec58612c4fe1ed924d84', '["*"]', NULL, '2022-03-31 14:55:39', '2022-03-31 14:55:39'),
	(12, 'App\\Models\\User', 7, 'DORCASTECHNOLOGIES@gmail.cm_Token', '4f9badf0466bf5f707758365cc3e933aeea71f5c3b5395ee9a5573f531f513c5', '["*"]', NULL, '2022-03-31 14:56:17', '2022-03-31 14:56:17'),
	(13, 'App\\Models\\User', 8, 'KOUHSI@gmail.cm_Token', '09dab19b002e7a8be4508296734826bda5bf2582829581e608199875a2eaa1ca', '["*"]', NULL, '2022-03-31 14:56:36', '2022-03-31 14:56:36'),
	(14, 'App\\Models\\User', 9, 'IKWEN@gmail.cm_Token', 'e99b1ddc69aa4158536168c98ec6e779089fb4481141c9ad27cdcb1ba263559e', '["*"]', NULL, '2022-03-31 14:57:02', '2022-03-31 14:57:02'),
	(15, 'App\\Models\\User', 10, 'KRMA@gmail.cm_Token', 'ba7dad8ae4f6898dd93c83a578ac1247e60e9dc3506b1918802ec427f01dfde6', '["*"]', NULL, '2022-03-31 14:57:29', '2022-03-31 14:57:29'),
	(16, 'App\\Models\\User', 11, 'client@gmail.cm_Token', 'f5ec0e9dfa2d7884f827e6241d69b414fc5467f7bdcf44b8fb4713ae70d6e108', '["*"]', NULL, '2022-03-31 14:58:26', '2022-03-31 14:58:26'),
	(17, 'App\\Models\\User', 12, 'client2@gmail.cm_Token', 'e8cb5ac03479ce411e1ca82d284dc422441ebeede47319173d3e50b3f36ff9ec', '["*"]', NULL, '2022-03-31 14:58:38', '2022-03-31 14:58:38'),
	(18, 'App\\Models\\User', 13, 'client3@gmail.cm_Token', '0f31a47a3c96b7ebfc638193c7b004e452b2d1e83693a03c3c1f1606082d3af8', '["*"]', NULL, '2022-03-31 14:58:44', '2022-03-31 14:58:44'),
	(19, 'App\\Models\\User', 14, 'client4@gmail.cm_Token', '9c79477de50ea4e692b077093fe2c9ebe629916c9f561f0851c3b82e2ff51d8a', '["*"]', NULL, '2022-03-31 14:58:50', '2022-03-31 14:58:50'),
	(20, 'App\\Models\\User', 15, 'client5@gmail.cm_Token', '51950567d0f8134b0855bf852cfbdb897ee2effb803b9869bcb7e569a563157b', '["*"]', NULL, '2022-03-31 14:59:00', '2022-03-31 14:59:00'),
	(21, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', 'f8fb26f8430df6edae812bc9ba93efc4c5d9f884d2323dca4c8ddda61d3624c3', '["*"]', NULL, '2022-04-06 14:01:29', '2022-04-06 14:01:29'),
	(25, 'App\\Models\\User', 16, 'client10@gmail.cm_Token', '2171f7f06d78aaf2d6b78c3d51d300d236b98766042ddf1426bab1d6891537bf', '["*"]', NULL, '2022-04-06 14:15:29', '2022-04-06 14:15:29'),
	(27, 'App\\Models\\User', 17, 'client23@dm.cm_Token', '2d8d4bd98389788e7dea441394421a5029890368ea95983634d3aa30fed1c38a', '["*"]', NULL, '2022-04-06 15:42:00', '2022-04-06 15:42:00'),
	(28, 'App\\Models\\User', 18, 'brondon@gmail.com_Token', '4cfcd62c3874fb28630fbf715d4ddd918410cc79d736b1b230ab0e297049f2e4', '["*"]', NULL, '2022-04-06 15:46:38', '2022-04-06 15:46:38'),
	(29, 'App\\Models\\User', 19, 'brondon@gmail.com_Token', 'f7fc1d4c55e853d21bbda011b249209b0724623f7d247c08ede4e39cb1201fab', '["*"]', NULL, '2022-04-06 15:48:19', '2022-04-06 15:48:19'),
	(30, 'App\\Models\\User', 19, 'brondon@gmail.com_Token', '95f646ede2969efb51664f371798deabd946b81b56b94e59f32d5a09e555dd7e', '["*"]', NULL, '2022-04-06 15:48:35', '2022-04-06 15:48:35'),
	(31, 'App\\Models\\User', 19, 'brondon@gmail.com_Token', 'dbb248e57ac96a0a98d63c6a330f3294e3caf0b2d6603a5be9678e0a5c11ea73', '["*"]', NULL, '2022-04-06 15:49:33', '2022-04-06 15:49:33'),
	(32, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', '49852854a207f3f1fe55bbb261007ce9b3d738120babc88d9e18d5f2a5a12d4a', '["*"]', NULL, '2022-04-07 05:47:36', '2022-04-07 05:47:36'),
	(33, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', '300f9ef4adcfb5bdf37cd6127c84c975b9b1deb450a57f0489cf2dd26de7136d', '["*"]', NULL, '2022-04-07 07:50:38', '2022-04-07 07:50:38'),
	(34, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', '209d723072e0daf74e36ed221cb1fc85f1eb95d2560950fc3b4c3cad07a8e4c0', '["*"]', NULL, '2022-04-07 08:05:01', '2022-04-07 08:05:01'),
	(35, 'App\\Models\\User', 20, 'client11@gmail.cm_Token', '5f9c10bb33fd5fc80c66c27fa0c313941aa6a82f12ee98a193cd5e59b87ccae4', '["*"]', NULL, '2022-04-07 08:51:50', '2022-04-07 08:51:50'),
	(37, 'App\\Models\\User', 22, 'client12@gmail.cm_Token', 'a89e21af6478576adf49ad75c07b8c78c0fef837fe946b14c9c2b660a17a23f0', '["*"]', NULL, '2022-04-07 08:54:54', '2022-04-07 08:54:54'),
	(38, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', '5836564601ab348086a34d51ff77640eeea501643ca2c50e77ff48ebb47c7c8d', '["*"]', NULL, '2022-04-07 11:46:51', '2022-04-07 11:46:51'),
	(39, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', '4cacbe05202d2ba9ceb408b89f5ec856b7faa3c78a38e476211351b6cca2b88c', '["*"]', NULL, '2022-04-07 11:47:03', '2022-04-07 11:47:03'),
	(40, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', '0686e4e0b58d9d03761d148de2d3d1e5703ddaab040bf3bffbcfb17bb51861ae', '["*"]', NULL, '2022-04-07 11:47:31', '2022-04-07 11:47:31'),
	(41, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', 'e2f88a58a91657e5139d1e09a1fcebcb67064f1d0767860ba2025d70cf672f92', '["*"]', NULL, '2022-04-07 11:48:02', '2022-04-07 11:48:02'),
	(42, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', '777aa1f424e2769d4fecb5c61315d20b19671a0601478724661fe2b6af20e6ed', '["*"]', NULL, '2022-04-07 11:49:21', '2022-04-07 11:49:21'),
	(43, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', '69d785503c2f74f08d58905e42f424f0f753a2e21fe33dffce127d3fe1c89413', '["*"]', NULL, '2022-04-07 11:50:49', '2022-04-07 11:50:49'),
	(44, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', '93e79aa4ba3e838a11ce4fd576d14d6f52446b832280975e0a92fccbd466e0dc', '["*"]', NULL, '2022-04-07 11:51:37', '2022-04-07 11:51:37'),
	(45, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', '062a1d78014a37c49a725b880a7fe4c286431ee9663ff87ebc42e2100c395a47', '["*"]', NULL, '2022-04-07 11:52:45', '2022-04-07 11:52:45'),
	(46, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', 'e26b043fcd569c8e0dfee32710683d3b7f58701391e7fe60aa1c52f9b4b542c0', '["*"]', NULL, '2022-04-07 11:53:12', '2022-04-07 11:53:12'),
	(47, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', '3303b0a193f0aa9d6aa4a4741fe14b62e1e374fb80b7a3b4d0afcd2e7af82904', '["*"]', NULL, '2022-04-07 11:54:46', '2022-04-07 11:54:46'),
	(48, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', 'f80c84d0f25d709ce4999b0be0430f0fa59a634ebc39dbf7d87ff641e20cde84', '["*"]', NULL, '2022-04-07 11:55:19', '2022-04-07 11:55:19'),
	(49, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', '503361d3f174d1d39d297ef1eb6d2f2c326297c615efa41713ad3c0c0aef8951', '["*"]', NULL, '2022-04-07 11:55:37', '2022-04-07 11:55:37'),
	(50, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', 'ac619e5615e83134eb5ddd6e6caaa0603cbae7908ccb2dea07a493c2978e7376', '["*"]', NULL, '2022-04-07 12:13:13', '2022-04-07 12:13:13'),
	(51, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', 'c7e52a6764cdeef3e6971b81fb964c2f923125a2344317ea26b864c1fec6f97f', '["*"]', NULL, '2022-04-07 12:15:00', '2022-04-07 12:15:00'),
	(52, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', '63e284ad659b4bc2b173e3f505207ba20efcf16d4b4a8fdc774bbadb47f534dd', '["*"]', NULL, '2022-04-07 12:22:52', '2022-04-07 12:22:52'),
	(53, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', 'e8825419e210d7df09df378ab7b0f6f582792e47c21fa5993fa74db498669393', '["*"]', NULL, '2022-04-07 12:22:53', '2022-04-07 12:22:53'),
	(54, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', 'a64fb68d2d9f3f5bac4ce52afd772feb30139c2ad063ea3db20e096b9ed74f1f', '["*"]', NULL, '2022-04-07 12:22:54', '2022-04-07 12:22:54'),
	(55, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', '4e3083d9ac4618bebd432fec930d58f237ebac0f07d21f314ccc0437142209c9', '["*"]', NULL, '2022-04-07 12:24:54', '2022-04-07 12:24:54'),
	(56, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', '8682a7f3e873a4eb44d4a0d963b2ddaed6921e7e22de33156668bf1b24d63853', '["*"]', NULL, '2022-04-07 12:51:48', '2022-04-07 12:51:48'),
	(57, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', 'e0ab150cffe760d583975d80b47ccc06660d737365bbdeae2f1066e04a87d5c7', '["*"]', NULL, '2022-04-07 12:59:36', '2022-04-07 12:59:36'),
	(58, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', '8eb29c0330c74119efc2aa4f70b9dfe6e693ced91405f1b96ea1c91c74596d17', '["*"]', NULL, '2022-04-07 13:02:45', '2022-04-07 13:02:45'),
	(59, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', '5773c03684de34dc2f382e57d6625ed03bcc322ab411d936725c1933c25790a7', '["*"]', NULL, '2022-04-07 14:58:02', '2022-04-07 14:58:02'),
	(60, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', 'bf56e3acb6c019dbe42e1c92d0038258b628695de185a9483f0969a4794b1f82', '["*"]', NULL, '2022-04-07 14:58:29', '2022-04-07 14:58:29'),
	(61, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', '05febf6e79170852d682d9db47be824af6fd9d0ad93e1b692b511e1d2fcfe68e', '["*"]', NULL, '2022-04-07 15:02:47', '2022-04-07 15:02:47'),
	(62, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', 'b0e5830376eae496cdcfd23ace8e2065e7d2a2845e76f03eba2f3b3787d38e48', '["*"]', NULL, '2022-04-07 15:03:14', '2022-04-07 15:03:14'),
	(63, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', 'bfe8f4cf3484eb8d3dc936b8c5fbd3776e6e768f81564af64e4a5a2189f5618f', '["*"]', NULL, '2022-04-10 15:08:42', '2022-04-10 15:08:42'),
	(64, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', 'bf02f1e45dfd4e7211ca7d25a3f92fbc97f2d34d1a3044a714f1fb9dfabb4f3c', '["*"]', NULL, '2022-04-10 15:19:01', '2022-04-10 15:19:01'),
	(65, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', 'c0f9a20c52c8612aa0a40e51b5d0fdd1f39d95c88c5a8bcae4e8b33d30f50ed5', '["*"]', NULL, '2022-04-10 15:20:48', '2022-04-10 15:20:48'),
	(66, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', 'd7e44a02491ec740a6adb42d140b424e5e6e10d6b7899889fa66c9cfd2890245', '["*"]', NULL, '2022-04-10 15:45:55', '2022-04-10 15:45:55'),
	(67, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', '98eda505f935fe9aa2eac966f528626983c8eb4a08e2dc36f3812f8d435b7455', '["*"]', NULL, '2022-04-10 20:56:28', '2022-04-10 20:56:28'),
	(68, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', '023050c1c54840d60d3c2d85fffb732d36d245209fb153dae75784315a2dce19', '["*"]', NULL, '2022-04-10 21:36:59', '2022-04-10 21:36:59'),
	(69, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', 'ee6107a48bb93d19e8ed42a897afe817a5c964416c0c01948086ce6bf798a3a6', '["*"]', NULL, '2022-04-10 21:40:08', '2022-04-10 21:40:08'),
	(70, 'App\\Models\\User', 23, 'asd@asw.cm_Token', '58fa8263018094f7b59f92fe448e2ce6349ec39a3c9184aa10b79d8ef2784a34', '["*"]', NULL, '2022-04-10 21:57:16', '2022-04-10 21:57:16'),
	(71, 'App\\Models\\User', 23, 'asd@asw.cm_Token', '886f371888322dfe2f5a9a6e61d7dc5868f92bf0d648f1ed6b0199ed1088699e', '["*"]', NULL, '2022-04-10 22:11:11', '2022-04-10 22:11:11'),
	(72, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', '3a5721394d48d32b881eba03a6c23f94caced3dd841825929d54cb22828447c1', '["*"]', NULL, '2022-04-10 23:25:16', '2022-04-10 23:25:16'),
	(73, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', '1e4868eef2f2543ac554d0dc06055c1bab160c9ca0adf5f45b22f6125604475d', '["*"]', NULL, '2022-04-10 23:26:26', '2022-04-10 23:26:26'),
	(74, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', 'd9e64ca184d417345a878281a25b346b8bef2bfe6a9b89258f3aec68d4c8cfab', '["*"]', NULL, '2022-04-10 23:31:35', '2022-04-10 23:31:35'),
	(75, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', '186ad7fa2b90e4aa918dc9f2e56665a12c618c1575c6455372a7c3879963ece1', '["*"]', NULL, '2022-04-10 23:32:34', '2022-04-10 23:32:34'),
	(76, 'App\\Models\\User', 2, 'brondonnono@gmail.com_Token', '54f29018ac0b258a3dcfc7b1db701ddaf99d7d5046b37c7dba97fe7b74e07fe5', '["*"]', NULL, '2022-04-10 23:43:24', '2022-04-10 23:43:24'),
	(77, 'App\\Models\\User', 1, 'brondonnono3@gmail.com_Token', 'b2202640581e4438ab9fbb205398e2a6fe448f6ed2af9b7b315c81e6fbc3979f', '["*"]', NULL, '2022-04-11 11:03:44', '2022-04-11 11:03:44'),
	(78, 'App\\Models\\User', 4, 'africashore@gmail.cm_Token', '8586e5f8594a2b674a6e9ffe8ad4999ae203eaaf0be8fc3088083fc57f0e705a', '["*"]', NULL, '2022-04-11 17:10:18', '2022-04-11 17:10:18'),
	(79, 'App\\Models\\User', 19, 'brondon@gmail.com_Token', 'bdb2be83dac2b34536eb7b750f4b62a892c20ea6ae8473bbd1b172e271088d3d', '["*"]', NULL, '2022-04-11 17:11:33', '2022-04-11 17:11:33'),
	(80, 'App\\Models\\User', 19, 'brondon@gmail.com_Token', '4fb69becd84b1edb5dd013ac3b05a63d4757cd3ed98ed03b2672f35f7b23edff', '["*"]', NULL, '2022-04-11 17:12:30', '2022-04-11 17:12:30'),
	(81, 'App\\Models\\User', 19, 'brondon@gmail.com_Token', '852098b55aff0244cb181a18f33dbbd297e06dd9cf07946bbdf963d92ff14d58', '["*"]', NULL, '2022-04-11 19:31:31', '2022-04-11 19:31:31'),
	(82, 'App\\Models\\User', 19, 'brondon@gmail.com_Token', '9c01a55bcbf1c56b99568a01f7068a0403eefb306b2294d05d9e754e7dbf4f33', '["*"]', NULL, '2022-04-11 22:24:58', '2022-04-11 22:24:58');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Listage de la structure de la table euProjet. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table euProjet.users : ~41 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `type`) VALUES
	(1, 'scofieldNetwork', 'brondonnono3@gmail.com', NULL, '$2y$10$v22regYtHgYe44omxlao8uGJERnrCQ3HQ7MgkbSbac0XJ/KoOBbPS', NULL, '2022-03-28 16:47:36', '2022-03-28 16:47:36', 'employeur'),
	(2, 'macbook', 'brondonnono@gmail.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2022-03-28 16:51:04', '2022-03-28 16:51:04', 'employe'),
	(3, 'book', 'book237@gmail.com', NULL, '$2y$10$JaW79pwae60HGxDfjO4/Fe0vtFN2ouP08IXScmeRZ2dWJIiWXjzwy', NULL, '2022-03-31 10:48:54', '2022-03-31 10:48:54', 'employeur'),
	(4, 'AFRICASHORE', 'africashore@gmail.cm', NULL, '$2y$10$EFjoyXmy/fzDrstmA0OVbufpht8wXAc5SQoCSxvMhHUPWdAe16/YS', NULL, '2022-03-31 14:53:56', '2022-03-31 14:53:56', 'employeur'),
	(5, 'BUSINESSONE SARL', 'BUSINESSONE@gmail.cm', NULL, '$2y$10$czwd0.UZvq5XVdEtBd6VCuYakuT.lyGC7q.N8bOfDo83HrtyPGGYy', NULL, '2022-03-31 14:54:51', '2022-03-31 14:54:51', 'employeur'),
	(6, 'ALPHOSA', 'ALPHOSA@gmail.cm', NULL, '$2y$10$NLQXOksrNW/GAKOP6xpDt.fL/zQN371nWbO/a7BV1.mrL2IACLJOC', NULL, '2022-03-31 14:55:39', '2022-03-31 14:55:39', 'employeur'),
	(7, 'DORCAS TECHNOLOGIES', 'DORCASTECHNOLOGIES@gmail.cm', NULL, '$2y$10$Suj5mmmNWZYLDMNE92ZExedrNPYC7TLsb5H27UsaHcpheyWnDmbZq', NULL, '2022-03-31 14:56:17', '2022-03-31 14:56:17', 'employeur'),
	(8, 'KOUHSI', 'KOUHSI@gmail.cm', NULL, '$2y$10$IO5FM1SU93gSnJVgw14MfuZ.YgONFipsAJWhfHDL9CrfFnryyCW7e', NULL, '2022-03-31 14:56:35', '2022-03-31 14:56:35', 'employeur'),
	(9, 'IKWEN', 'IKWEN@gmail.cm', NULL, '$2y$10$P4yrg2v0aDw00gLC5E..yujXOt3i8hO1vWlCcNgGY9EsBHM878FgK', NULL, '2022-03-31 14:57:02', '2022-03-31 14:57:02', 'employeur'),
	(10, 'KRMA', 'KRMA@gmail.cm', NULL, '$2y$10$HHagoNYo24a9ADyqENqoRuDZKlhQ.xAIMG2cWLDN1h9CoKaSXOc1m', NULL, '2022-03-31 14:57:29', '2022-03-31 14:57:29', 'employeur'),
	(11, 'Kevine Ngadjeu', 'client@gmail.cm', NULL, '$2y$10$pCGLvhtHedSVnu.1Ev6NWeg2E7590UhazCQsU17LiylRUaxAWCgIu', NULL, '2022-03-31 14:58:26', '2022-03-31 14:58:26', 'employe'),
	(12, 'client2', 'client2@gmail.cm', NULL, '$2y$10$i/6TVuiLz75QASr.w3rKb.a75ASb4cVoIF/3dnh5uHjq5t44f7zHS', NULL, '2022-03-31 14:58:38', '2022-03-31 14:58:38', 'employe'),
	(13, 'client3', 'client3@gmail.cm', NULL, '$2y$10$jydoe32v.ZDiLi6DQKVcBe6VxRQfoLLniNtjRb.rfn7VwsRUUpHI.', NULL, '2022-03-31 14:58:44', '2022-03-31 14:58:44', 'employe'),
	(14, 'client4', 'client4@gmail.cm', NULL, '$2y$10$LEgPpT65mLXmr/JZuvTu3e95fr.PzozdRQ/VDWpjbVCL18TTSfIai', NULL, '2022-03-31 14:58:50', '2022-03-31 14:58:50', 'employe'),
	(15, 'client5', 'client5@gmail.cm', NULL, '$2y$10$m2yhYzn80Cnz8agYl2IeGeSKY5t1Twvn50J090aG6/PgqJjEPuyv6', NULL, '2022-03-31 14:59:00', '2022-03-31 14:59:00', 'employe'),
	(16, 'client10', 'client10@gmail.cm', NULL, '$2y$10$91lyQ06bN88/ni2h3xtiy.AxbUjciwarFd3ZmQXtmPGwbShjukDp2', NULL, '2022-04-06 14:15:29', '2022-04-06 14:15:29', 'employe'),
	(19, 'brondon', 'brondon@gmail.com', NULL, '$2y$10$zE3/jZcYvTWsl4QZfxsSm.GWuvG6Yb.YzeGBjZjB2oErjJYYiGboC', NULL, '2022-04-06 15:48:19', '2022-04-06 15:48:19', 'employe'),
	(20, 'client11', 'client11@gmail.cm', NULL, '$2y$10$Iz5/kfLygW9hteZuW84kvOL5BVuHWOeIAM4WWL3g/xRSsAphdpRye', NULL, '2022-04-07 08:51:50', '2022-04-07 08:51:50', 'employe'),
	(22, 'client12', 'client12@gmail.cm', NULL, '$2y$10$/KcKFQScVNdOtDPbfHgno.jKOeWNgP59rFMYSLUq8/3uPW7EPrYxq', NULL, '2022-04-07 08:54:54', '2022-04-07 08:54:54', 'employe'),
	(23, 'DchangaiBoy', 'employe1@gmail.cm', NULL, '$2y$10$HS7yhUBm6w5/OzywF6cf.utZSWfVOzcgQLs10OcqvhVVNX6b490aW', NULL, '2022-04-13 11:17:06', '2022-04-13 11:17:06', 'employe'),
	(24, 'Yami', 'yami@clover.cm', NULL, '$2y$10$BMb1NWZH6hjNlyK.QQF46u.NQbR.MfUDyjedQ.ncBRqMzhYViiYm.', NULL, '2022-04-20 16:19:10', '2022-04-20 16:19:10', 'employe'),
	(25, '﻿LISA', 'tarsha.r.hawks@mailinator.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2022-05-02 19:43:49', '2022-04-02 19:44:11', 'employeur'),
	(26, 'Lloyd Lee', 'brandon.a.oberlander@spambob.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2022-05-02 19:43:52', '2022-05-02 19:44:13', 'employeur'),
	(27, 'Courtney Langford', 'gail.d.fields@mailinator.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2022-04-02 19:43:53', '2022-05-02 19:44:14', 'employeur'),
	(28, 'Kathy Martin', 'cecily.p.skinner@pookmail.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2022-03-02 19:43:56', '2022-05-02 19:44:15', 'employeur'),
	(29, 'Helen Banker', 'brook.j.whitworth@pookmail.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2022-04-02 19:43:58', '2022-05-02 19:44:16', 'employeur'),
	(30, 'Frances Washington', 'kelly.e.avendano@spambob.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2022-03-02 19:43:59', '2022-05-02 19:44:17', 'employeur'),
	(31, 'Scott Mccoy', 'luis.e.erlandson@spambob.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2022-02-02 19:44:01', '2022-05-02 19:44:18', 'employeur'),
	(32, 'Robert Kelly', 'annie.j.hays@pookmail.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2022-04-02 19:44:03', '2022-05-02 19:44:19', 'employeur'),
	(33, 'David Lynch', 'walter.e.carr@dodgit.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2022-04-02 19:44:06', '2022-05-02 19:44:08', 'employeur'),
	(34, 'Gene Fugate', 'thomas.e.corley@pookmail.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2021-05-02 19:44:56', '2022-05-02 19:44:20', 'employeur'),
	(35, 'Pearl White', 'mandy.j.holland@spambob.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2021-05-02 19:44:57', '2022-05-02 19:44:21', 'employeur'),
	(36, 'Mary Wheat', 'marion.c.baker@pookmail.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2021-05-02 19:44:59', '2022-05-02 19:44:22', 'employeur'),
	(37, 'Andrew Justice', 'margaret.f.perry@pookmail.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2021-05-02 19:45:00', '2022-05-02 19:44:22', 'employeur'),
	(38, 'Beatrice Armijo', 'raymond.g.west@trashymail.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2021-05-02 19:45:02', '2022-05-02 19:44:23', 'employeur'),
	(39, 'Carrie Morton', 'wendy.r.jameson@pookmail.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2021-05-02 19:45:03', '2022-05-02 19:44:24', 'employeur'),
	(40, 'Larry Jensen', 'teresa.b.smith@trashymail.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2021-05-02 19:45:04', '2022-05-02 19:44:25', 'employeur'),
	(41, 'Kathryn Burton', 'elise.g.watkins@trashymail.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2021-04-02 19:45:10', '2022-05-02 19:44:25', 'employeur'),
	(42, 'Robert Norris', 'ila.j.westgate@trashymail.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2021-04-02 19:45:14', '2022-05-02 19:44:26', 'employeur'),
	(43, 'Deanna Chappell', 'nancy.s.quinn@dodgit.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2022-04-02 19:45:17', '2022-05-02 19:44:27', 'employeur'),
	(44, 'Elnora Calloway', 'bailey.m.alonzo@spambob.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2021-02-28 18:45:19', '2022-05-02 19:44:27', 'employeur'),
	(45, 'Stacy Smith', 'clifford.z.martinez@trashymail.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2021-05-02 19:44:52', '2022-05-02 19:44:28', 'employeur'),
	(46, 'Robin Pelfrey', 'leslie.d.bartels@mailinator.com', NULL, '$2y$10$etuL5t8LUgt3W8ImdDd2ZeVdgbsuAL5SLyqMmlV7rNpQlCpF1ik.W', NULL, '2021-05-02 19:44:45', '2022-05-02 19:44:29', 'employeur');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
