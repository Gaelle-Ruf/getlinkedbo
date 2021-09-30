-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `category` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1,	'bar',	'bar',	NULL,	NULL),
(2,	'boite de nuit',	'boite-de-nuit',	NULL,	NULL),
(3,	'club',	'club',	NULL,	NULL),
(4,	'restaurant',	'restaurant',	NULL,	NULL),
(5,	'salle des fêtes',	'salle-des-fetes',	NULL,	NULL),
(6,	'théâtre',	'theatre',	NULL,	NULL);

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` smallint(6) NOT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C71F7E88B` (`event_id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  CONSTRAINT `FK_9474526C71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `comment` (`id`, `comment`, `rate`, `created_at`, `updated_at`, `event_id`, `user_id`) VALUES
(2,	'oh lala trop bien ce concert !!!',	5,	'2021-09-27 09:59:07',	NULL,	11,	1);

DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3BAE0AA7A76ED395` (`user_id`),
  CONSTRAINT `FK_3BAE0AA7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `event` (`id`, `name`, `location`, `date`, `picture`, `description`, `price`, `duration`, `email`, `published_at`, `slug`, `created_at`, `updated_at`, `user_id`) VALUES
(1,	'Yesterdayland',	'Boom',	'2021-10-09 00:00:00',	'https://images.unsplash.com/photo-1520095972714-909e91b038e5?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel erat vel tortor fermentum malesuada. Nunc gravida elit ut eros.',	NULL,	NULL,	'yesterdayland@gmail.com',	NULL,	'yesterdayland',	'2021-09-23 09:37:06',	NULL,	1),
(2,	'Ulysse Music Festival',	'Paris',	'2021-10-16 00:00:00',	'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel erat vel tortor fermentum malesuada. Nunc gravida elit ut eros.',	NULL,	NULL,	'umf@gmail.com',	NULL,	'umf',	'2021-09-23 09:39:41',	NULL,	4),
(3,	'Klimax',	'Strasbourg',	'2021-10-23 00:00:00',	'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel erat vel tortor fermentum malesuada. Nunc gravida elit ut eros.',	NULL,	NULL,	'klimax@gmail.com',	NULL,	'klimax',	'2021-09-23 09:41:45',	NULL,	7),
(4,	'DEFKON',	'Nantes',	'2021-10-30 00:00:00',	'https://images.unsplash.com/photo-1506157786151-b8491531f063?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel erat vel tortor fermentum malesuada. Nunc gravida elit ut eros.',	NULL,	NULL,	'defkon@gmail.com',	NULL,	'defkon',	'2021-09-23 09:43:36',	NULL,	9),
(5,	'Mysterioland',	'Quevilly',	'2021-11-06 00:00:00',	'https://images.unsplash.com/photo-1533137098665-47ca60257cec?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel erat vel tortor fermentum malesuada. Nunc gravida elit ut eros.',	NULL,	NULL,	'mysterioland@gmail.com',	NULL,	'mysterioland',	'2021-09-23 09:46:36',	NULL,	13),
(6,	'Electraland',	'Chessy',	'2021-11-13 00:00:00',	'https://images.unsplash.com/photo-1505842465776-3b4953ca4f44?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel erat vel tortor fermentum malesuada. Nunc gravida elit ut eros.',	NULL,	NULL,	'electraland@gmail.com',	NULL,	'electraland',	'2021-09-23 09:49:30',	NULL,	15),
(7,	'Cuchella',	'Nice',	'2021-11-20 00:00:00',	'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel erat vel tortor fermentum malesuada. Nunc gravida elit ut eros.',	NULL,	NULL,	'cuchella@gmail.com',	NULL,	'cuchella',	'2021-09-23 09:52:07',	NULL,	16),
(8,	'Loullapalouza',	'Rouen',	'2021-11-27 00:00:00',	'https://images.unsplash.com/photo-1454908027598-28c44b1716c1?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel erat vel tortor fermentum malesuada. Nunc gravida elit ut eros.',	NULL,	NULL,	'loullapalouza@gmail.com',	NULL,	'loullapalouza',	'2021-09-23 09:54:31',	NULL,	18),
(9,	'O\'clock Music Festival',	'Bordeaux',	'2021-12-04 00:00:00',	'https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel erat vel tortor fermentum malesuada. Nunc gravida elit ut eros.',	NULL,	NULL,	'omf@gmail.com',	NULL,	'omf',	'2021-09-23 09:58:38',	NULL,	19),
(10,	'Ylusseland',	'Metz',	'2021-12-11 00:00:00',	'https://images.unsplash.com/photo-1582711012124-a56cf82307a0?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1240&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel erat vel tortor fermentum malesuada. Nunc gravida elit ut eros.',	NULL,	NULL,	'ylusseland@gmail.com',	NULL,	'ylusseland',	'2021-09-23 10:01:15',	NULL,	20),
(11,	'AnnecyBeach',	'Beach',	'2021-10-15 00:00:00',	'https://images.unsplash.com/photo-1520095972714-909e91b038e5?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel erat vel tortor fermentum malesuada. Nunc gravida elit ut eros.',	NULL,	NULL,	'annecybeach@gmail.com',	NULL,	'yesterdayland',	'2021-09-23 09:37:06',	NULL,	1),
(12,	'coucou',	'ici',	'2000-01-01 00:00:00',	'truc.png',	'desc',	1.00,	NULL,	'cazdazd@efe.com',	NULL,	NULL,	NULL,	NULL,	1),
(13,	'AnnecyBeach',	'Beach',	'2021-10-15 00:00:00',	'https://images.unsplash.com/photo-1520095972714-909e91b038e5?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel erat vel tortor fermentum malesuada. Nunc gravida elit ut eros.',	NULL,	NULL,	'annecybeach@gmail.com',	NULL,	'yesterdayland',	'2021-09-23 09:37:06',	NULL,	1);

DROP TABLE IF EXISTS `event_category`;
CREATE TABLE `event_category` (
  `event_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`event_id`,`category_id`),
  KEY `IDX_40A0F01171F7E88B` (`event_id`),
  KEY `IDX_40A0F01112469DE2` (`category_id`),
  CONSTRAINT `FK_40A0F01112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_40A0F01171F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `event_category` (`event_id`, `category_id`) VALUES
(1,	4);

DROP TABLE IF EXISTS `event_style`;
CREATE TABLE `event_style` (
  `event_id` int(11) NOT NULL,
  `style_id` int(11) NOT NULL,
  PRIMARY KEY (`event_id`,`style_id`),
  KEY `IDX_72A6094671F7E88B` (`event_id`),
  KEY `IDX_72A60946BACD6074` (`style_id`),
  CONSTRAINT `FK_72A6094671F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_72A60946BACD6074` FOREIGN KEY (`style_id`) REFERENCES `style` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `participation`;
CREATE TABLE `participation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AB55E24F71F7E88B` (`event_id`),
  KEY `IDX_AB55E24FA76ED395` (`user_id`),
  CONSTRAINT `FK_AB55E24F71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `FK_AB55E24FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `style`;
CREATE TABLE `style` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `style` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1,	'blues',	'blues',	NULL,	NULL),
(2,	'country',	'country',	NULL,	NULL),
(3,	'EDM',	'EDM',	NULL,	NULL),
(4,	'folk',	'folk',	NULL,	NULL),
(5,	'funk',	'funk',	NULL,	NULL),
(6,	'gospel',	'gospel',	NULL,	NULL),
(7,	'hip-hop',	'hip-hop',	NULL,	NULL),
(8,	'house',	'house',	NULL,	NULL),
(9,	'indie',	'indie',	NULL,	NULL),
(10,	'jazz',	'jazz',	NULL,	NULL),
(11,	'latine',	'latine',	NULL,	NULL),
(12,	'metal',	'metal',	NULL,	NULL),
(13,	'musique classique',	'musique-classique',	NULL,	NULL),
(14,	'musique du monde',	'musique-du-monde',	NULL,	NULL),
(15,	'pop',	'pop',	NULL,	NULL),
(16,	'pop-rock',	'pop-rock',	NULL,	NULL),
(17,	'punk',	'punk',	NULL,	NULL),
(18,	'rap',	'rap',	NULL,	NULL),
(19,	'reggae',	'reggae',	NULL,	NULL),
(20,	'rock',	'rock',	NULL,	NULL),
(21,	'Rnb',	'rnb',	NULL,	NULL),
(22,	'salsa',	'salsa',	NULL,	NULL),
(23,	'ska',	'ska',	NULL,	NULL),
(24,	'soul',	'soul',	NULL,	NULL),
(25,	'variété',	'variété',	NULL,	NULL);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule` date DEFAULT NULL,
  `nb_members` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `type`, `name`, `firstname`, `lastname`, `picture`, `description`, `schedule`, `nb_members`, `address`, `website`, `facebook`, `instagram`, `twitter`, `email`, `slug`, `created_at`, `updated_at`) VALUES
(1,	'organisateur',	'Pizza pépé',	'Jérémy',	'Payard',	'https://images.unsplash.com/photo-1513104890138-7c749659a591?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Bienvenue chez pizza pépé ! Tu veux manger les meilleurs pizzas de ta région ? Tu es au bon endroit !\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',	NULL,	NULL,	'Bayonne',	NULL,	NULL,	NULL,	NULL,	'pizzapepe@tropbon.fr',	'pizzapepe',	'2021-09-22 11:49:22',	NULL),
(2,	'artiste',	'SnoopDoggyDog',	'Snoopy',	'Doggy',	'https://images.unsplash.com/photo-1561037404-61cd46aa615b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed eleifend sapien. Integer egestas, magna tempor vulputate fringilla, libero purus consequat mauris, vitae pharetra eros lectus vitae turpis. Morbi laoreet tortor vitae dictum congue. Donec ultrices ante nisl, eu blandit odio maximus ut. Praesent in libero justo. Donec sed sem in nulla malesuada viverra. Maecenas varius, tortor non imperdiet aliquam, diam magna scelerisque eros, vel mattis elit nulla nec lorem. Praesent mi dui, tempus vitae lectus ut, sodales interdum dolor. Donec nec porta nisl. Vivamus efficitur eros vitae tortor finibus fermentum. Morbi suscipit lectus et urna commodo convallis.',	NULL,	1,	'Gueugnon',	NULL,	NULL,	NULL,	NULL,	'snoopdoggydog@gmail.com',	'snoopdoggydog',	'2021-09-22 11:54:00',	NULL),
(3,	'artiste',	'ACDC',	'Jack',	'Paul',	'https://cdn.pixabay.com/photo/2016/02/19/11/36/microphone-1209816_960_720.jpg',	'Le groupe ACDC Jack Paul est un groupe de Rock semi Love avec de la drill un incroyable groupe de musique nouvelle génération',	NULL,	4,	'Paris',	NULL,	NULL,	NULL,	NULL,	'JackPaulACDC@gmail.com',	'acdc',	'2021-09-22 11:54:07',	NULL),
(4,	'organisateur',	'La casa de mama',	'Jean',	'Paul',	'https://images.unsplash.com/photo-1574894709920-11b28e7367e3?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80',	'Hola amigos !\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n',	NULL,	NULL,	'Naples',	NULL,	NULL,	NULL,	NULL,	'lacasademama@miam.fr',	'la-casa-de-mama',	'2021-09-22 11:55:07',	NULL),
(5,	'artiste',	'KISS',	'Pierre',	'Jean',	'https://cdn.pixabay.com/photo/2017/01/18/17/14/girl-1990347_960_720.jpg',	'KISS et une artiste nouvelle génération qui parle de chanson d\'amour un peu tragique elle fait les tubes de l\'hivers tout les ans depuis bientôt 3ans ',	NULL,	1,	'Brésil',	NULL,	NULL,	NULL,	NULL,	'KISSPierre@gmail.com',	'kiss',	'2021-09-22 11:57:49',	NULL),
(6,	'artiste',	'David Guetto',	'David',	'Guetto',	'https://media.istockphoto.com/photos/party-dj-picture-id184936708',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quam nisi, congue ac varius quis, pharetra nec mauris. Suspendisse nec ullamcorper nisl, a tincidunt erat. Curabitur aliquam quam ipsum, non tincidunt ipsum pellentesque at.',	NULL,	1,	'Marseille',	NULL,	NULL,	NULL,	NULL,	'davidguetto@gmail.com',	'davidguetto',	'2021-09-22 11:58:17',	NULL),
(7,	'organisateur',	'Chateau rousseau',	'Guï',	'DeLaCroix',	'https://images.unsplash.com/photo-1618927517362-d7be957f4119?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=735&q=80',	'Château rousseau est un endroit d\'exception où vous pourrez déguster du F0F sur son lit de fabio.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',	NULL,	NULL,	'Fof Sur Mer',	NULL,	NULL,	NULL,	NULL,	'chateau@rousseau.riche',	'chateau-rousseau',	'2021-09-22 11:58:56',	NULL),
(8,	'artiste',	'Martin Garrix',	'Martin',	'Garrix',	'https://images.unsplash.com/photo-1493676304819-0d7a8d026dcf?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1074&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quam nisi, congue ac varius quis, pharetra nec mauris. Suspendisse nec ullamcorper nisl, a tincidunt erat. Curabitur aliquam quam ipsum, non tincidunt ipsum pellentesque at.',	NULL,	1,	'Lille',	NULL,	NULL,	NULL,	NULL,	'martingarrix@gmail.com',	'martingarrix',	'2021-09-22 12:00:37',	NULL),
(9,	'organisateur',	'Il était une fois',	'Joséphine',	'Ange-gardien',	'https://images.unsplash.com/photo-1510759591315-6425cba413fe?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Abracadabra tu n\'as plus de bras.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',	NULL,	NULL,	'Baguette Magique Les Bains',	NULL,	NULL,	NULL,	NULL,	'jojo@angedegarde.magie',	'il-etait-une-fois',	'2021-09-22 12:01:46',	NULL),
(10,	'artiste',	'MYDREAM',	'Michael',	'Scofield',	'https://cdn.pixabay.com/photo/2019/06/21/11/17/man-4289185_960_720.jpg',	'Micheal avait un rêve plus jeune après avoir faire un braquage durant son adolescence il c\'est retrouver en prison son rêve était en s\'évader, mais il est rester sage et à crée son groupe de musique en sortant avec son frère ',	NULL,	2,	' Chicago',	NULL,	NULL,	NULL,	NULL,	'MYDREAM@gmail.com',	'mydream',	'2021-09-22 12:02:22',	NULL),
(11,	'artiste',	'KART',	'Mario',	'Luigi',	'https://cdn.pixabay.com/photo/2016/07/30/20/39/mario-1557973_960_720.jpg',	'Kart est un groupe de 2 jeune italien qui on crée un tout nouveaux style de musique en partant de bruit de kart qui font la course sur des circuits arc-ciel ',	NULL,	2,	'Tokyo',	NULL,	NULL,	NULL,	NULL,	'KARTML@gmail.com',	'kart',	'2021-09-22 12:05:08',	NULL),
(12,	'artiste',	'Justin Bieber',	'Justin',	'Bieber',	'https://images.unsplash.com/photo-1453738773917-9c3eff1db985?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quam nisi, congue ac varius quis, pharetra nec mauris. Suspendisse nec ullamcorper nisl, a tincidunt erat. Curabitur aliquam quam ipsum, non tincidunt ipsum pellentesque at.',	NULL,	1,	'Toulouse',	NULL,	NULL,	NULL,	NULL,	'justinbieber@gmail.com',	'justinbieber',	'2021-09-22 12:02:47',	NULL),
(13,	'organisateur',	'La pinte sacré',	'Jaiplu',	'Soif',	'https://images.unsplash.com/photo-1441985969846-3e7c90531139?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Aller vient c\'est *burp* cool ici !\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',	NULL,	NULL,	'La pinte sur mer',	NULL,	NULL,	NULL,	NULL,	'la.pinte.sacre@biere.fr',	'la-pinte-sacre',	'2021-09-22 12:04:27',	NULL),
(14,	'artiste',	'Linkin Park',	'',	'',	'https://media.istockphoto.com/photos/rock-and-roll-picture-id161839324?s=612x612',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quam nisi, congue ac varius quis, pharetra nec mauris. Suspendisse nec ullamcorper nisl, a tincidunt erat. Curabitur aliquam quam ipsum, non tincidunt ipsum pellentesque at.',	NULL,	4,	'Nancy',	NULL,	NULL,	NULL,	NULL,	'linkinpark@gmail.com',	'linkinpark',	'2021-09-22 12:05:02',	NULL),
(15,	'organisateur',	'Camping paradis',	'Patrick',	'Slip',	'https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1170&q=80',	'Alors on attends pas Patrick ?\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',	NULL,	NULL,	'Biscarosse',	NULL,	NULL,	NULL,	NULL,	'camping@paradis.fr',	'camping-paradis',	'2021-09-22 12:06:19',	NULL),
(16,	'organisateur',	'Salle de fêtes de Niort',	'Pierre',	'Moulade',	'https://images.unsplash.com/photo-1417816491410-d61e1546e539?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1074&q=80',	'Il manque plus que toi ! (et les 500 autres...)\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',	NULL,	NULL,	'Niort',	NULL,	NULL,	NULL,	NULL,	'salle.des.fetes@niort.fr',	'salle-des-fetes-de-niort',	'2021-09-22 12:08:26',	NULL),
(17,	'artiste',	'Francky Vincent',	'Francky',	'Vincent',	'https://media.istockphoto.com/photos/robin-picture-id1129502429?s=612x612',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quam nisi, congue ac varius quis, pharetra nec mauris. Suspendisse nec ullamcorper nisl, a tincidunt erat. Curabitur aliquam quam ipsum, non tincidunt ipsum pellentesque at.',	NULL,	1,	'Paris',	NULL,	NULL,	NULL,	NULL,	'franckyvincent@gmail.com',	'franckyvincent',	'2021-09-22 12:09:01',	NULL),
(18,	'organisateur',	'Boardriders',	'Guillaume',	'Pirard',	'http://theparisianman.com/wp-content/uploads/2015/08/L1000903.jpg',	'Ride or die (tu peux aussi coder mais bon c\'est moins stylé comme phrase)\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',	NULL,	NULL,	'Bayonne',	NULL,	NULL,	NULL,	NULL,	'boardriders.guillaume@gmail.com',	'boardriders',	'2021-09-22 12:10:45',	NULL),
(19,	'organisateur',	'Le Royal Nathan Palace',	'Nathan',	'Louis',	'https://cdn.pixabay.com/photo/2014/07/21/19/20/lobby-398845_960_720.jpg',	'Le Royale Nathan Palace est un Palace de luxe ou on  peut ce détendre et passer d\'agréable moment nous invitons souvent des artistes pour venir aiguiller la journée des gens dans notre établissement',	NULL,	NULL,	'Monaco',	NULL,	NULL,	NULL,	NULL,	'Royalpalacemc@mc.com',	'royalnathanpalace',	'2021-09-22 12:10:49',	NULL),
(20,	'organisateur',	'The Garrison Tavern',	'Thomas',	'Shelby',	'https://media.istockphoto.com/photos/empty-restaurant-interior-picture-id1224771205?s=612x612',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam elementum, ex imperdiet iaculis consectetur, tellus magna bibendum lectus, a iaculis mi nisl et augue. Donec.',	NULL,	NULL,	'Birmingham',	NULL,	NULL,	NULL,	NULL,	'thomasshelby@gmail.com',	'the-garrison-tavern',	'2021-09-22 13:45:17',	NULL),
(21,	'Dieu',	'The Garrison Tavern',	'Thomas',	'Shelby',	'https://media.istockphoto.com/photos/empty-restaurant-interior-picture-id1224771205?s=612x612',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam elementum, ex imperdiet iaculis consectetur, tellus magna bibendum lectus, a iaculis mi nisl et augue. Donec.',	NULL,	NULL,	'Birmingham',	NULL,	NULL,	NULL,	NULL,	'thomasshelby@gmail.com',	'the-garrison-tavern',	'2021-09-22 13:45:17',	NULL),
(22,	'On ne sait pas',	'The Garrison Tavern',	'Thomas',	'Shelby',	'https://media.istockphoto.com/photos/empty-restaurant-interior-picture-id1224771205?s=612x612',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam elementum, ex imperdiet iaculis consectetur, tellus magna bibendum lectus, a iaculis mi nisl et augue. Donec.',	NULL,	NULL,	'Birmingham',	NULL,	NULL,	NULL,	NULL,	'thomasshelby@gmail.com',	'the-garrison-tavern',	'2021-09-22 13:45:17',	NULL),
(24,	'artist test',	'test',	'Raphael',	'Magnes',	'https://media.istockphoto.com/photos/empty-restaurant-interior-picture-id1224771205?s=612x612',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam elementum, ex imperdiet iaculis consectetur, tellus magna bibendum lectus, a iaculis mi nisl et augue. Donec.',	NULL,	NULL,	'Birmingham',	NULL,	NULL,	NULL,	NULL,	'thomasshelby@gmail.com',	'the-garrison-tavern',	'2021-09-22 13:45:17',	NULL),
(25,	'artist test 2',	'test',	'Gaelle',	'Ruf',	'https://media.istockphoto.com/photos/empty-restaurant-interior-picture-id1224771205?s=612x612',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam elementum, ex imperdiet iaculis consectetur, tellus magna bibendum lectus, a iaculis mi nisl et augue. Donec.',	NULL,	NULL,	'Birmingham',	NULL,	NULL,	NULL,	NULL,	'gaelleruf@gmail.com',	'gaelle-ruf',	'2021-09-22 13:45:17',	NULL);

DROP TABLE IF EXISTS `user_category`;
CREATE TABLE `user_category` (
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`category_id`),
  KEY `IDX_E6C1FDC1A76ED395` (`user_id`),
  KEY `IDX_E6C1FDC112469DE2` (`category_id`),
  CONSTRAINT `FK_E6C1FDC112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_E6C1FDC1A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_category` (`user_id`, `category_id`) VALUES
(1,	4);

DROP TABLE IF EXISTS `user_style`;
CREATE TABLE `user_style` (
  `user_id` int(11) NOT NULL,
  `style_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`style_id`),
  KEY `IDX_D17F4332A76ED395` (`user_id`),
  KEY `IDX_D17F4332BACD6074` (`style_id`),
  CONSTRAINT `FK_D17F4332A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D17F4332BACD6074` FOREIGN KEY (`style_id`) REFERENCES `style` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2021-09-27 15:02:10


