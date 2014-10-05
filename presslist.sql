-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 03 Octobre 2014 à 10:59
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `africanpress_db_1`
--

-- --------------------------------------------------------

--
-- Structure de la table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `business_category`
--

CREATE TABLE IF NOT EXISTS `business_category` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'unique identifier',
  `cat_title` varchar(255) NOT NULL COMMENT 'category canonical title (Default)',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `business_category`
--

INSERT INTO `business_category` (`cat_id`, `cat_title`) VALUES
(5, 'Agriculture'),
(6, 'Art & Literature'),
(7, 'Banking & Financial Markets'),
(8, 'Business'),
(9, 'Culture & Tribes'),
(10, 'Automotive'),
(11, 'Education'),
(12, 'Environment & Sustainable Energy'),
(13, 'Gender'),
(14, 'Government'),
(15, 'Health'),
(16, 'Industry'),
(17, 'Infrastructure & Transport'),
(18, 'International Relations'),
(19, 'Internet & Media'),
(20, 'ICT'),
(21, 'Marketing Communications'),
(22, 'Military & Conflict'),
(23, 'Mining'),
(24, 'Oil & Gas'),
(25, 'Politics'),
(26, 'Religion'),
(27, 'Science'),
(28, 'Society'),
(29, 'Sports'),
(30, 'Sustainable Development & Aid'),
(31, 'Telecom'),
(32, 'Travel & Tourism'),
(33, 'Trade'),
(34, 'Music, Film, Fashion & Leasure');

-- --------------------------------------------------------

--
-- Structure de la table `channel`
--

CREATE TABLE IF NOT EXISTS `channel` (
  `channel_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'identifying key',
  `channel_title` varchar(255) NOT NULL COMMENT 'canonical title',
  `channel_category` char(2) DEFAULT NULL COMMENT '(''IN'',''NP'',''MG'',''RA'',''TV'') denotes channel main category',
  PRIMARY KEY (`channel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `channel`
--

INSERT INTO `channel` (`channel_id`, `channel_title`, `channel_category`) VALUES
(1, 'TV', 'TV'),
(2, 'Radio', 'RA'),
(3, 'Magazine', 'MG'),
(4, 'Newspaper', 'NP'),
(5, 'Internet', 'IN'),
(6, 'Blog', 'IN');

-- --------------------------------------------------------

--
-- Structure de la table `channel_translation`
--

CREATE TABLE IF NOT EXISTS `channel_translation` (
  `channel_id` int(10) NOT NULL COMMENT '(ref: channel)',
  `lang_iso` char(3) NOT NULL COMMENT '(ref: iso_country)',
  `channel_title` varchar(255) NOT NULL COMMENT 'translated title',
  PRIMARY KEY (`channel_id`),
  KEY `ang_iso` (`lang_iso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `columns_sync_oauth`
--

CREATE TABLE IF NOT EXISTS `columns_sync_oauth` (
  `platform_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '(ref: system_oauth)',
  `src_entity` varchar(255) NOT NULL COMMENT 'soc media field entity',
  `src_field_name` varchar(255) NOT NULL COMMENT 'soc media field name',
  `dest_entity` varchar(255) NOT NULL COMMENT 'â€˜contactâ€™ | â€˜companyâ€™',
  `dest_field_name` varchar(255) NOT NULL COMMENT 'contact field name',
  PRIMARY KEY (`platform_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `comp_id` int(10) NOT NULL AUTO_INCREMENT,
  `comp_group` int(8) DEFAULT NULL COMMENT 'indicates whether their contacts can be searched upon in the specific-Â­â€search',
  `comp_name` varchar(255) NOT NULL COMMENT 'descriptive name',
  `comp_address` varchar(255) DEFAULT NULL COMMENT 'address',
  `comp_address_nr` int(10) DEFAULT NULL COMMENT 'house number',
  `comp_address_nr_addon` varchar(255) DEFAULT NULL COMMENT 'house number addition',
  `comp_postal_code` varchar(255) DEFAULT NULL COMMENT 'postal code',
  `comp_city` varchar(255) DEFAULT NULL COMMENT 'city',
  `country_iso` smallint(3) unsigned zerofill DEFAULT NULL COMMENT '(ref: iso_country) ',
  `comp_pub_region` int(10) DEFAULT NULL COMMENT 'optional region id where publishing (ref: geo_region)',
  `comp_pub_country_iso` smallint(3) unsigned zerofill DEFAULT NULL COMMENT 'optional ISO-Â­â€3166 country code where publishing',
  `comp_pub_city` varchar(255) DEFAULT NULL COMMENT 'optional city name where publishing',
  `comp_phone` varchar(255) DEFAULT NULL COMMENT 'phone',
  `comp_fax` varchar(255) DEFAULT NULL COMMENT 'fax',
  `comp_email` varchar(255) NOT NULL COMMENT 'email',
  `comp_website` varchar(255) DEFAULT NULL COMMENT 'site URL',
  `comp_main_contact` int(10) DEFAULT NULL COMMENT '(ref: contact)',
  PRIMARY KEY (`comp_id`),
  KEY `country_iso` (`country_iso`),
  KEY `comp_pub_region` (`comp_pub_region`),
  KEY `comp_pub_country_iso` (`comp_pub_country_iso`),
  KEY `comp_main_contact` (`comp_main_contact`),
  KEY `comp_main_contact_2` (`comp_main_contact`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `company`
--

INSERT INTO `company` (`comp_id`, `comp_group`, `comp_name`, `comp_address`, `comp_address_nr`, `comp_address_nr_addon`, `comp_postal_code`, `comp_city`, `country_iso`, `comp_pub_region`, `comp_pub_country_iso`, `comp_pub_city`, `comp_phone`, `comp_fax`, `comp_email`, `comp_website`, `comp_main_contact`) VALUES
(1, NULL, 'Freelance', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(3, NULL, 'L''économiste', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int(10) NOT NULL AUTO_INCREMENT,
  `contact_email` varchar(255) NOT NULL,
  `contact_name_ini` varchar(255) DEFAULT NULL,
  `contact_name_first` varchar(255) NOT NULL,
  `contact_name_last` varchar(255) NOT NULL,
  `contact_gender` char(1) DEFAULT NULL,
  `contact_adress` varchar(255) DEFAULT NULL,
  `contact_address_nr` int(10) DEFAULT NULL,
  `contact_address_addon` varchar(255) DEFAULT NULL,
  `contact_iso_country` smallint(3) unsigned zerofill DEFAULT NULL,
  `contact_city` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `contact_website` varchar(255) DEFAULT NULL,
  `contact_tw` varchar(255) DEFAULT NULL,
  `contact_fb` varchar(255) DEFAULT NULL,
  `contact_go` varchar(255) DEFAULT NULL,
  `contact_yt` varchar(255) DEFAULT NULL,
  `contact_li` varchar(255) DEFAULT NULL,
  `contact_bio` mediumtext,
  `contact_is_imported` char(1) DEFAULT NULL,
  `contact_imported_src` varchar(255) DEFAULT NULL,
  `contact_status` char(1) DEFAULT NULL,
  `contact_login_pass` varchar(255) NOT NULL,
  `profile` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`contact_id`),
  KEY `contact_iso_country` (`contact_iso_country`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=229 ;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_email`, `contact_name_ini`, `contact_name_first`, `contact_name_last`, `contact_gender`, `contact_adress`, `contact_address_nr`, `contact_address_addon`, `contact_iso_country`, `contact_city`, `contact_phone`, `contact_website`, `contact_tw`, `contact_fb`, `contact_go`, `contact_yt`, `contact_li`, `contact_bio`, `contact_is_imported`, `contact_imported_src`, `contact_status`, `contact_login_pass`, `profile`, `status`) VALUES
(219, 'radhouane.walid@yahoo.fr', '', 'walidjournalist', 'walidjournalist name', 'M', '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '65c14e24fae87d3b2cfcfea49d63377e', 1, 1),
(220, 'walido_200@hotmail.com', '', 'walidjournalist2', 'walidjournalist2 name', 'M', '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '4b80e4144982a79667345fe863055a70', 1, 1),
(221, 'walido_2000@hotmail.com', '', 'walidjournalist2', 'walidjournalist2 name', 'M', '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '65c14e24fae87d3b2cfcfea49d63377e', 1, 1),
(222, 'walidjournalist@aa.com', '', 'walidjournalist', 'walidjournalist', 'M', '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '4b80e4144982a79667345fe863055a70', 1, 1),
(223, 'walidjournalist4@aa.com', '', 'walidjournalist', 'walidjournalist', 'M', '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '65c14e24fae87d3b2cfcfea49d63377e', 1, 1),
(224, 'walidjournalist5@yetgroup.com', '', 'walidjournalist5', 'walidjournalist5', 'M', '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '26453fb4a42469a0d8fe749b2c20e79a', 1, 1),
(226, 'walidjournalist6@aa.com', '', 'walidjournalist6', 'walidjournalist6', 'M', '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '65c14e24fae87d3b2cfcfea49d63377e', 1, 1),
(227, 'walidjournalist7@aa.com', '', 'walidjournalist7', 'walidjournalist7', 'M', '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '65c14e24fae87d3b2cfcfea49d63377e', 1, 1),
(228, 'walidjournalist8@aa.com', '', 'walidjournalist8', 'walidjournalist8', 'M', '', NULL, '', NULL, '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '5ce7281461585baf2967cb34180a974c', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contact_category`
--

CREATE TABLE IF NOT EXISTS `contact_category` (
  `contact_id` int(10) NOT NULL COMMENT 'company id (ref: contact)',
  `cat_id` int(10) NOT NULL COMMENT 'category id (ref: business_category)',
  PRIMARY KEY (`contact_id`,`cat_id`),
  KEY `fk_business_category` (`cat_id`),
  KEY `contact_id` (`contact_id`),
  KEY `cat_id` (`cat_id`),
  KEY `contact_id_2` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contact_category`
--

INSERT INTO `contact_category` (`contact_id`, `cat_id`) VALUES
(226, 5),
(227, 6),
(228, 6),
(224, 7),
(227, 8),
(228, 8),
(224, 10),
(228, 10),
(227, 11),
(226, 18),
(226, 20),
(226, 22);

-- --------------------------------------------------------

--
-- Structure de la table `contact_client_blacklist`
--

CREATE TABLE IF NOT EXISTS `contact_client_blacklist` (
  `contact_id` int(10) NOT NULL COMMENT 'company id (ref: contact)',
  `user_id` int(10) NOT NULL COMMENT 'user id (ref: user)',
  PRIMARY KEY (`contact_id`,`user_id`),
  KEY `fk_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contact_function`
--

CREATE TABLE IF NOT EXISTS `contact_function` (
  `company_id` int(10) NOT NULL DEFAULT '0' COMMENT 'company or NIL (ref: company)',
  `contact_id` int(10) NOT NULL COMMENT 'contact (ref: contact)',
  `function_id` int(10) NOT NULL COMMENT 'function (ref: function)',
  PRIMARY KEY (`company_id`,`contact_id`,`function_id`),
  KEY `fk_fn_cont` (`function_id`),
  KEY `fk_cont_fonct` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contact_function`
--

INSERT INTO `contact_function` (`company_id`, `contact_id`, `function_id`) VALUES
(1, 226, 5),
(1, 227, 5),
(3, 228, 6),
(1, 227, 7),
(3, 228, 8),
(1, 227, 9),
(3, 228, 9);

-- --------------------------------------------------------

--
-- Structure de la table `contact_geo_coverage`
--

CREATE TABLE IF NOT EXISTS `contact_geo_coverage` (
  `company_id` int(10) NOT NULL,
  `contact_id` int(10) NOT NULL,
  `geo_country_id` smallint(3) unsigned zerofill NOT NULL,
  PRIMARY KEY (`company_id`,`contact_id`,`geo_country_id`),
  KEY `geo_country_id` (`geo_country_id`),
  KEY `contact_id` (`contact_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contact_geo_coverage`
--

INSERT INTO `contact_geo_coverage` (`company_id`, `contact_id`, `geo_country_id`) VALUES
(1, 224, 012),
(1, 226, 012),
(1, 228, 012),
(1, 227, 024),
(1, 228, 024),
(1, 227, 072),
(1, 228, 072),
(1, 224, 108),
(1, 226, 108),
(1, 227, 108),
(1, 228, 108),
(1, 226, 120),
(1, 224, 132),
(1, 226, 140),
(1, 226, 148),
(1, 227, 174),
(1, 228, 174),
(1, 224, 178),
(1, 226, 178),
(1, 226, 180),
(1, 224, 204),
(1, 226, 226),
(1, 224, 231),
(1, 226, 231),
(1, 227, 231),
(1, 228, 231),
(1, 224, 232),
(1, 227, 232),
(1, 228, 232),
(1, 224, 262),
(1, 226, 262),
(1, 227, 262),
(1, 228, 262),
(1, 224, 266),
(1, 226, 266),
(1, 224, 270),
(1, 224, 288),
(1, 224, 324),
(1, 224, 384),
(1, 224, 404),
(1, 227, 404),
(1, 228, 404),
(1, 227, 426),
(1, 228, 426),
(1, 224, 430),
(1, 226, 434),
(1, 227, 450),
(1, 228, 450),
(1, 227, 454),
(1, 228, 454),
(1, 224, 466),
(1, 226, 478),
(1, 227, 480),
(1, 228, 480),
(1, 226, 504),
(1, 228, 504),
(1, 227, 508),
(1, 228, 508),
(1, 227, 516),
(1, 228, 516),
(1, 224, 562),
(1, 224, 566),
(1, 224, 624),
(1, 224, 646),
(1, 227, 646),
(1, 228, 646),
(1, 226, 678),
(1, 224, 686),
(1, 224, 690),
(1, 227, 690),
(1, 228, 690),
(1, 224, 694),
(1, 224, 706),
(1, 227, 706),
(1, 228, 706),
(1, 227, 710),
(1, 228, 710),
(1, 227, 716),
(1, 228, 716),
(1, 224, 728),
(1, 227, 728),
(1, 228, 728),
(1, 226, 729),
(1, 228, 729),
(1, 227, 748),
(1, 228, 748),
(1, 224, 768),
(1, 224, 788),
(1, 226, 788),
(1, 228, 788),
(1, 224, 800),
(1, 227, 800),
(1, 228, 800),
(1, 224, 818),
(1, 226, 818),
(1, 228, 818),
(1, 224, 834),
(1, 227, 834),
(1, 228, 834),
(1, 224, 854),
(1, 227, 894),
(1, 228, 894);

-- --------------------------------------------------------

--
-- Structure de la table `contact_language`
--

CREATE TABLE IF NOT EXISTS `contact_language` (
  `contact_id` int(10) NOT NULL DEFAULT '0' COMMENT 'contact id (ref: contact or NIL)',
  `lang_iso` char(3) NOT NULL COMMENT 'iso 639-Â­â€3 code ref for language (ref: iso_language)',
  PRIMARY KEY (`contact_id`,`lang_iso`),
  KEY `fk_iso_lang` (`lang_iso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contact_language`
--

INSERT INTO `contact_language` (`contact_id`, `lang_iso`) VALUES
(226, 'ara'),
(228, 'ara'),
(224, 'eng'),
(226, 'eng'),
(227, 'eng'),
(228, 'eng'),
(226, 'fra'),
(227, 'fra'),
(228, 'fra'),
(224, 'por'),
(226, 'por'),
(227, 'por'),
(228, 'por');

-- --------------------------------------------------------

--
-- Structure de la table `contact_oauth`
--

CREATE TABLE IF NOT EXISTS `contact_oauth` (
  `contact_id` int(10) NOT NULL COMMENT '(ref: contact)',
  `platform_id` int(10) NOT NULL COMMENT '(ref: system_outh)',
  `access_token` varchar(255) NOT NULL COMMENT 'last access token',
  `authorization_token` varchar(255) NOT NULL COMMENT 'authorization token',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'refresh date of token',
  PRIMARY KEY (`contact_id`,`platform_id`),
  KEY `fk_sysyrme_oauth` (`platform_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `continents`
--

CREATE TABLE IF NOT EXISTS `continents` (
  `code` char(2) NOT NULL COMMENT 'Continent code',
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `continents`
--

INSERT INTO `continents` (`code`, `name`) VALUES
('AF', 'Africa'),
('AN', 'Antarctica'),
('AS', 'Asia'),
('EU', 'Europe'),
('NA', 'North America'),
('OC', 'Oceania'),
('SA', 'South America');

-- --------------------------------------------------------

--
-- Structure de la table `credit`
--

CREATE TABLE IF NOT EXISTS `credit` (
  `credit_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'credit deal id',
  `credit_show` char(1) NOT NULL COMMENT 'show line in regular offer list (â€œYâ€,â€Nâ€). For internal use, select â€œNâ€',
  `credit_amount` int(10) DEFAULT NULL COMMENT 'amount in credits',
  `credit_price` decimal(11,0) NOT NULL COMMENT 'price',
  `credit_duration` int(10) NOT NULL COMMENT 'duration in days for purchase',
  `credit_notes` mediumtext NOT NULL COMMENT 'opt notes',
  PRIMARY KEY (`credit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `credit`
--

INSERT INTO `credit` (`credit_id`, `credit_show`, `credit_amount`, `credit_price`, `credit_duration`, `credit_notes`) VALUES
(14, 'N', NULL, '0', 0, ''),
(15, 'N', NULL, '0', 0, ''),
(16, 'N', NULL, '0', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `credit_history`
--

CREATE TABLE IF NOT EXISTS `credit_history` (
  `ch_id` bigint(19) NOT NULL AUTO_INCREMENT COMMENT 'charge_id (autonum)',
  `ch_user` int(10) NOT NULL COMMENT '(ref: user)',
  `ch_type` varchar(255) NOT NULL COMMENT 'RUNâ€™, â€˜MANUALâ€™',
  `ch_amount` int(10) NOT NULL COMMENT 'credit total +-Â­â€ amount',
  `ch_target_id` int(10) NOT NULL COMMENT '(ref: lists)',
  `ch_notes` varchar(255) DEFAULT NULL COMMENT 'opt. note or NIL',
  `ch_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'date of mutation',
  PRIMARY KEY (`ch_id`),
  KEY `ch_user` (`ch_user`),
  KEY `ch_target_id` (`ch_target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `credit_package`
--

CREATE TABLE IF NOT EXISTS `credit_package` (
  `credit_package_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'credit package id',
  `basic_credit_id` int(10) DEFAULT NULL COMMENT 'references basic amount, pricing and duration on first purchase (ref: credit)',
  `extention_credit_id` int(10) DEFAULT NULL COMMENT 'references basic amount, pricing and duration on extention purchase (ref: credit)',
  `package_title` varchar(255) NOT NULL COMMENT 'package canonical title',
  `package_rank` int(10) NOT NULL COMMENT 'denotes offer rank to split upgrades from downgrades',
  PRIMARY KEY (`credit_package_id`),
  UNIQUE KEY `extention_credit_id (1)` (`extention_credit_id`),
  KEY `basic_credit_id (1)` (`basic_credit_id`,`extention_credit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `credit_package`
--

INSERT INTO `credit_package` (`credit_package_id`, `basic_credit_id`, `extention_credit_id`, `package_title`, `package_rank`) VALUES
(12, 14, NULL, '', 0),
(13, 15, NULL, '', 0),
(14, 16, NULL, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `function`
--

CREATE TABLE IF NOT EXISTS `function` (
  `function_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'primary identifier',
  `function_title` varchar(255) NOT NULL COMMENT 'canonical title',
  PRIMARY KEY (`function_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `function`
--

INSERT INTO `function` (`function_id`, `function_title`) VALUES
(5, 'Journalist / reporter'),
(6, 'Editor in chief'),
(7, 'Company'),
(8, 'Freelancer'),
(9, 'Blogger'),
(10, 'Camera Men');

-- --------------------------------------------------------

--
-- Structure de la table `function_translation`
--

CREATE TABLE IF NOT EXISTS `function_translation` (
  `function_id` int(10) NOT NULL COMMENT 'function id (ref: function)',
  `lang_iso` char(3) NOT NULL COMMENT 'iso 639-Â­â€3 code for language (ref: iso_language)',
  `function_title` varchar(255) NOT NULL COMMENT 'translated function title',
  PRIMARY KEY (`function_id`,`lang_iso`),
  KEY `fk_fn_language` (`lang_iso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `geo_cluster`
--

CREATE TABLE IF NOT EXISTS `geo_cluster` (
  `geo_cluster_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'geographical cluster id',
  `cluster_name` varchar(255) NOT NULL COMMENT 'region canonical name',
  PRIMARY KEY (`geo_cluster_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `geo_region`
--

CREATE TABLE IF NOT EXISTS `geo_region` (
  `geo_region_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'geographical region id',
  `region_name` varchar(255) NOT NULL COMMENT 'region canonical name',
  PRIMARY KEY (`geo_region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `geo_region`
--

INSERT INTO `geo_region` (`geo_region_id`, `region_name`) VALUES
(1, 'East Africa'),
(2, 'Central Africa'),
(3, 'North Africa'),
(4, 'Southern Africa'),
(5, 'West Africa'),
(8, 'Southern America'),
(9, 'Northern America'),
(10, 'ASIA'),
(11, 'EUROPE'),
(12, 'EUROPEAN UNION'),
(14, 'OCEANIA');

-- --------------------------------------------------------

--
-- Structure de la table `geo_region_cluster`
--

CREATE TABLE IF NOT EXISTS `geo_region_cluster` (
  `geo_region_id` int(10) NOT NULL COMMENT 'geographical region id (ref: geo_region)',
  `geo_cluster_id` int(10) NOT NULL COMMENT 'geographical cluster id (ref: geo_cluster)',
  PRIMARY KEY (`geo_region_id`,`geo_cluster_id`),
  KEY `geo_region_id` (`geo_region_id`),
  KEY `geo_cluster_id` (`geo_cluster_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `iso_country`
--

CREATE TABLE IF NOT EXISTS `iso_country` (
  `country_iso` smallint(3) unsigned zerofill NOT NULL COMMENT 'iso - 3166 country number (ISO 3166-1 numeric)',
  `country_name` varchar(255) NOT NULL COMMENT 'ISO country name',
  `geo_region_id` int(10) DEFAULT NULL COMMENT 'geographical region for country',
  `continent_code` char(2) NOT NULL,
  PRIMARY KEY (`country_iso`),
  UNIQUE KEY `country_iso` (`country_iso`),
  KEY `continent_code` (`continent_code`),
  KEY `geo_region_id` (`geo_region_id`),
  KEY `geo_region_id_2` (`geo_region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `iso_country`
--

INSERT INTO `iso_country` (`country_iso`, `country_name`, `geo_region_id`, `continent_code`) VALUES
(004, 'Afghanistan', 10, 'AS'),
(008, 'Albania', 11, 'EU'),
(010, 'Antarctica', NULL, 'AN'),
(012, 'Algeria', 3, 'AF'),
(016, 'American Samoa', 14, 'OC'),
(020, 'Andorra', 11, 'EU'),
(024, 'Angola', 4, 'AF'),
(031, 'Azerbaijan', 10, 'AS'),
(032, 'Argentina', 8, 'SA'),
(036, 'Australia', 14, 'OC'),
(040, 'Austria', 12, 'EU'),
(050, 'Bangladesh', 10, 'AS'),
(051, 'Armenia', 10, 'AS'),
(056, 'Belgium', 12, 'EU'),
(060, 'Bermuda', 9, 'NA'),
(064, 'Bhutan', 10, 'AS'),
(068, 'Bolivia', 8, 'SA'),
(070, 'Bosnia and Herzegovina', 11, 'EU'),
(072, 'Botswana', 4, 'AF'),
(074, 'Bouvet Island (BouvetÃ¸ya)', NULL, 'AN'),
(076, 'Brazil', 8, 'SA'),
(086, 'British Indian Ocean Territory (Chagos Archipelago)', NULL, 'AS'),
(090, 'Solomon Islands', 14, 'OC'),
(096, 'Brunei Darussalam', 10, 'AS'),
(100, 'Bulgaria', 12, 'EU'),
(104, 'Myanmar', 10, 'AS'),
(108, 'Burundi', 1, 'AF'),
(112, 'Belarus', 11, 'EU'),
(116, 'Cambodia', 10, 'AS'),
(120, 'Cameroon', 2, 'AF'),
(124, 'Canada', 9, 'NA'),
(132, 'Cabo Verde', 5, 'AF'),
(140, 'Central African Republic', 2, 'AF'),
(144, 'Sri Lanka', NULL, 'AS'),
(148, 'Chad', 2, 'AF'),
(152, 'Chile', 8, 'SA'),
(156, 'China', 10, 'AS'),
(158, 'Taiwan', 10, 'AS'),
(162, 'Christmas Island', NULL, 'AS'),
(166, 'Cocos (Keeling) Islands', NULL, 'AS'),
(170, 'Colombia', 8, 'SA'),
(174, 'Comoros', 4, 'AF'),
(178, 'Congo Brazzaville\n', 2, 'AF'),
(180, 'Congo Kinshasa', 2, 'AF'),
(184, 'Cook Islands', NULL, 'OC'),
(191, 'Croatia', 11, 'EU'),
(196, 'Cyprus', 12, 'AS'),
(203, 'Czech Republic', 12, 'EU'),
(204, 'Benin', 5, 'AF'),
(208, 'Denmark', 12, 'EU'),
(218, 'Ecuador', 8, 'SA'),
(226, 'Equatorial Guinea', 2, 'AF'),
(231, 'Ethiopia', 1, 'AF'),
(232, 'Eritrea', 1, 'AF'),
(233, 'Estonia', 12, 'EU'),
(234, 'Faroe Islands', 11, 'EU'),
(238, 'Falkland Islands (Malvinas)', 8, 'SA'),
(239, 'South Georgia and the South Sandwich Islands', NULL, 'AN'),
(242, 'Fiji', 14, 'OC'),
(246, 'Finland', 12, 'EU'),
(248, 'Ã…land Islands', NULL, 'EU'),
(250, 'France', 12, 'EU'),
(254, 'French Guiana', 8, 'SA'),
(258, 'French Polynesia', 14, 'OC'),
(260, 'French Southern Territories', NULL, 'AN'),
(262, 'Djibouti', 1, 'AF'),
(266, 'Gabon', 2, 'AF'),
(268, 'Georgia', NULL, 'AS'),
(270, 'Gambia', 5, 'AF'),
(276, 'Germany', 12, 'EU'),
(288, 'Ghana', 5, 'AF'),
(292, 'Gibraltar', 11, 'EU'),
(296, 'Kiribati', 14, 'OC'),
(300, 'Greece', 12, 'EU'),
(304, 'Greenland', 9, 'NA'),
(316, 'Guam', NULL, 'OC'),
(324, 'Guinea', 5, 'AF'),
(328, 'Guyana', 8, 'SA'),
(334, 'Heard Island and McDonald Islands', NULL, 'AN'),
(336, 'Holy See (Vatican City State)', 11, 'EU'),
(344, 'Hong Kong', 10, 'AS'),
(348, 'Hungary', 12, 'EU'),
(352, 'Iceland', 11, 'EU'),
(356, 'India', 10, 'AS'),
(360, 'Indonesia', 10, 'AS'),
(372, 'Ireland', 12, 'EU'),
(380, 'Italy', 12, 'EU'),
(384, 'Cote d''Ivoire', 5, 'AF'),
(392, 'Japan', 10, 'AS'),
(398, 'Kazakhstan', 10, 'AS'),
(404, 'Kenya', 1, 'AF'),
(408, 'Korea', 10, 'AS'),
(410, 'Korea', 10, 'AS'),
(417, 'Kyrgyz Republic', NULL, 'AS'),
(418, 'Lao People''s Democratic Republic', 10, 'AS'),
(426, 'Lesotho', 4, 'AF'),
(428, 'Latvia', 12, 'EU'),
(430, 'Liberia', 5, 'AF'),
(434, 'Libya', 3, 'AF'),
(438, 'Liechtenstein', 11, 'EU'),
(440, 'Lithuania', 12, 'EU'),
(442, 'Luxembourg', 12, 'EU'),
(446, 'Macao', 10, 'AS'),
(450, 'Madagascar', 4, 'AF'),
(454, 'Malawi', 4, 'AF'),
(458, 'Malaysia', 10, 'AS'),
(462, 'Maldives', 10, 'AS'),
(466, 'Mali', 5, 'AF'),
(470, 'Malta', 12, 'EU'),
(478, 'Mauritania', 3, 'AF'),
(480, 'Mauritius', 4, 'AF'),
(492, 'Monaco', 11, 'EU'),
(496, 'Mongolia', 10, 'AS'),
(498, 'Moldova', 11, 'EU'),
(499, 'Montenegro', 11, 'EU'),
(504, 'Morocco', 3, 'AF'),
(508, 'Mozambique', 4, 'AF'),
(516, 'Namibia', 4, 'AF'),
(520, 'Nauru', NULL, 'OC'),
(524, 'Nepal', 10, 'AS'),
(528, 'Netherlands', 12, 'EU'),
(540, 'New Caledonia', 14, 'OC'),
(548, 'Vanuatu', 14, 'OC'),
(554, 'New Zealand', 14, 'OC'),
(562, 'Niger', 5, 'AF'),
(566, 'Nigeria', 5, 'AF'),
(570, 'Niue', NULL, 'OC'),
(574, 'Norfolk Island', NULL, 'OC'),
(578, 'Norway', 11, 'EU'),
(580, 'Northern Mariana Islands', NULL, 'OC'),
(581, 'United States Minor Outlying Islands', NULL, 'OC'),
(583, 'Micronesia', 14, 'OC'),
(584, 'Marshall Islands', 14, 'OC'),
(585, 'Palau', NULL, 'OC'),
(586, 'Pakistan', 10, 'AS'),
(598, 'Papua New Guinea', 14, 'OC'),
(600, 'Paraguay', 8, 'SA'),
(604, 'Peru', 8, 'SA'),
(608, 'Philippines', 10, 'AS'),
(612, 'Pitcairn Islands', NULL, 'OC'),
(616, 'Poland', 12, 'EU'),
(620, 'Portugal', 12, 'EU'),
(624, 'Guinea-Bissau', 5, 'AF'),
(626, 'Timor-Leste', 10, 'AS'),
(642, 'Romania', 12, 'EU'),
(643, 'Russian Federation', 11, 'EU'),
(646, 'Rwanda', 1, 'AF'),
(666, 'Saint Pierre and Miquelon', 9, 'NA'),
(674, 'San Marino', 11, 'EU'),
(678, 'Sao Tome and Principe', 2, 'AF'),
(686, 'Senegal', 5, 'AF'),
(688, 'Serbia', 11, 'EU'),
(690, 'Seychelles', 1, 'AF'),
(694, 'Sierra Leone', 5, 'AF'),
(702, 'Singapore', 10, 'AS'),
(703, 'Slovakia (Slovak Republic)', 12, 'EU'),
(704, 'Vietnam', 10, 'AS'),
(705, 'Slovenia', 12, 'EU'),
(706, 'Somalia', 1, 'AF'),
(710, 'South Africa', 4, 'AF'),
(716, 'Zimbabwe', 4, 'AF'),
(724, 'Spain', 12, 'EU'),
(728, 'South Sudan', 1, 'AF'),
(729, 'Sudan', 3, 'AF'),
(740, 'Suriname', 8, 'SA'),
(744, 'Svalbard & Jan Mayen Islands', 11, 'EU'),
(748, 'Swaziland', 4, 'AF'),
(752, 'Sweden', 12, 'EU'),
(756, 'Switzerland', 11, 'EU'),
(762, 'Tajikistan', 10, 'AS'),
(764, 'Thailand', 10, 'AS'),
(768, 'Togo', 5, 'AF'),
(772, 'Tokelau', NULL, 'OC'),
(776, 'Tonga', NULL, 'OC'),
(788, 'Tunisia', 3, 'AF'),
(792, 'Turkey', 11, 'AS'),
(795, 'Turkmenistan', 10, 'AS'),
(798, 'Tuvalu', NULL, 'OC'),
(800, 'Uganda', 1, 'AF'),
(804, 'Ukraine', 11, 'EU'),
(807, 'Macedonia', 11, 'EU'),
(818, 'Egypt', 3, 'AF'),
(826, 'United Kingdom of Great Britain & Northern Ireland', 11, 'EU'),
(831, 'Guernsey', 11, 'EU'),
(832, 'Jersey', 11, 'EU'),
(833, 'Isle of Man', 11, 'EU'),
(834, 'Tanzania', 1, 'AF'),
(840, 'United States of America', 9, 'NA'),
(854, 'Burkina Faso', 5, 'AF'),
(858, 'Uruguay', 8, 'SA'),
(860, 'Uzbekistan', 10, 'AS'),
(862, 'Venezuela', 8, 'SA'),
(876, 'Wallis and Futuna', NULL, 'OC'),
(882, 'Samoa', 14, 'OC'),
(894, 'Zambia', 4, 'AF');

-- --------------------------------------------------------

--
-- Structure de la table `iso_language`
--

CREATE TABLE IF NOT EXISTS `iso_language` (
  `lang_iso` char(3) NOT NULL DEFAULT '' COMMENT 'iso-Â­â€6393 code',
  `language` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'iso language description',
  `Native_language` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`lang_iso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `iso_language`
--

INSERT INTO `iso_language` (`lang_iso`, `language`, `Native_language`) VALUES
('ara', 'Arabic', 'Ø§Ù„Ø¹Ø±Ø¨ÙŠØ©'),
('eng', 'English', 'English'),
('fra', 'French', 'franÃ§ais'),
('por', 'Portuguese', 'PortuguÃªs');

-- --------------------------------------------------------

--
-- Structure de la table `list`
--

CREATE TABLE IF NOT EXISTS `list` (
  `list_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'list identifier',
  `list_user` int(10) NOT NULL COMMENT '(ref: user)',
  `list_name` varchar(255) NOT NULL COMMENT 'title of list',
  `ist_notes` mediumtext NOT NULL COMMENT 'optional notes',
  `list_added` int(32) NOT NULL,
  `list_modified` int(11) NOT NULL,
  PRIMARY KEY (`list_id`),
  KEY `list_user` (`list_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `list`
--

INSERT INTO `list` (`list_id`, `list_user`, `list_name`, `ist_notes`, `list_added`, `list_modified`) VALUES
(1, 225, 'list contact', '', 1411986330, 0);

-- --------------------------------------------------------

--
-- Structure de la table `list_contact`
--

CREATE TABLE IF NOT EXISTS `list_contact` (
  `list_id` int(10) NOT NULL COMMENT '(ref: list)',
  `contact_id` int(10) NOT NULL COMMENT '(ref: contact)',
  PRIMARY KEY (`list_id`,`contact_id`),
  KEY `fk_contact_id_list_contact` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `list_contact`
--

INSERT INTO `list_contact` (`list_id`, `contact_id`) VALUES
(1, 219),
(1, 221),
(1, 224);

-- --------------------------------------------------------

--
-- Structure de la table `mailing`
--

CREATE TABLE IF NOT EXISTS `mailing` (
  `mailing_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  PRIMARY KEY (`mailing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `mailing_file`
--

CREATE TABLE IF NOT EXISTS `mailing_file` (
  `mailing_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`mailing_id`,`file_id`),
  KEY `file_id` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `packaged_credit`
--

CREATE TABLE IF NOT EXISTS `packaged_credit` (
  `credit_package_id` int(10) NOT NULL COMMENT 'credit package id (ref: credit_package)',
  `credit_id` int(10) NOT NULL,
  PRIMARY KEY (`credit_package_id`),
  KEY `credit_id` (`credit_id`),
  KEY `credit_package_id` (`credit_package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `paypal_transactions`
--

CREATE TABLE IF NOT EXISTS `paypal_transactions` (
  `pp_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'unique identifier',
  `pp_pay_type` varchar(255) NOT NULL COMMENT 'payment type',
  `pp_txn_type` varchar(255) NOT NULL COMMENT 'taxation type',
  `pp_txn_id` varchar(255) NOT NULL COMMENT 'tax id? FIXME does this apply?',
  `pp_amount` decimal(10,0) NOT NULL COMMENT 'amount charged',
  `pp_tax` decimal(10,0) NOT NULL COMMENT 'tax amount',
  `pp_pay_status` varchar(255) NOT NULL COMMENT 'payment status',
  `pp_payer_email` varchar(255) NOT NULL COMMENT 'payer email',
  `pp_payer_id` varchar(255) NOT NULL COMMENT 'payer id',
  `pp_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'payment date',
  `pp_user_id` int(10) NOT NULL COMMENT '(ref: user)',
  `pp_item` varchar(255) NOT NULL COMMENT 'Item bought',
  `pp_text` text COMMENT 'opt. note or NIL',
  PRIMARY KEY (`pp_id`),
  KEY `pp_user_id` (`pp_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `press`
--

CREATE TABLE IF NOT EXISTS `press` (
  `press_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'identifier',
  `press_user` int(10) NOT NULL COMMENT '(ref: user)',
  `list_id` int(10) NOT NULL COMMENT '(ref: list)',
  `press_subject` varchar(255) NOT NULL COMMENT 'subject',
  `press_content` longtext NOT NULL COMMENT 'press release',
  `press_status` enum('D','Q','F','C','N') NOT NULL COMMENT 'â€˜Draftâ€™,â€™Queueâ€™ ,â€™Failedâ€™,â€™Completedâ€™',
  `press_contacts_mailed` int(10) NOT NULL COMMENT '# of contacts success',
  `press_contacts_failed` int(10) NOT NULL COMMENT '# of contacts failed',
  `press_date` timestamp NULL DEFAULT NULL COMMENT 'release date',
  `press_date_started` timestamp NULL DEFAULT NULL COMMENT 'mailing actually send out by batch',
  `press_date_completed` timestamp NULL DEFAULT NULL COMMENT 'mailing completed',
  `press_sender_name` varchar(255) NOT NULL COMMENT 'Sender name (copied)',
  `press_sender_email` varchar(255) NOT NULL COMMENT 'Sender email (copied)',
  `press_replyto_name` varchar(255) NOT NULL COMMENT 'Reply name (copied)',
  `press_replyto_email` varchar(255) NOT NULL COMMENT 'Reply email (copied)',
  `press_file_1` varchar(255) NOT NULL COMMENT 'attachment 1',
  `press_file_2` varchar(255) NOT NULL COMMENT 'attachment 2',
  `press_file_3` varchar(255) NOT NULL COMMENT 'attachment 3',
  `press_pub_abc` tinyint(3) NOT NULL COMMENT 'publish to abc',
  `press_pub_linkedin` tinyint(3) NOT NULL COMMENT 'publish to Linkedin *',
  `press_pub_facebook` tinyint(3) NOT NULL COMMENT 'publish to FaceBook *',
  `press_pub_twitter` tinyint(3) NOT NULL COMMENT 'publish to Twitter *',
  `hours` time NOT NULL,
  PRIMARY KEY (`press_id`),
  KEY `press_id` (`press_id`),
  KEY `list_id` (`list_id`),
  KEY `press_user` (`press_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `press`
--

INSERT INTO `press` (`press_id`, `press_user`, `list_id`, `press_subject`, `press_content`, `press_status`, `press_contacts_mailed`, `press_contacts_failed`, `press_date`, `press_date_started`, `press_date_completed`, `press_sender_name`, `press_sender_email`, `press_replyto_name`, `press_replyto_email`, `press_file_1`, `press_file_2`, `press_file_3`, `press_pub_abc`, `press_pub_linkedin`, `press_pub_facebook`, `press_pub_twitter`, `hours`) VALUES
(1, 225, 1, 'test', '<p>test press</p>', 'D', 0, 0, '2014-09-29 09:26:36', NULL, NULL, 'walidclient', 'walidclient@aa.com', 'walidclient', 'walidclient@aa.com', '', '', '', 0, 0, 0, 0, '00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `press_journalist`
--

CREATE TABLE IF NOT EXISTS `press_journalist` (
  `press_id` int(10) NOT NULL AUTO_INCREMENT,
  `contact_id` int(10) NOT NULL,
  `press_content` longtext NOT NULL,
  `press_subject` varchar(255) NOT NULL,
  `press_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `press_sender_name` varchar(255) NOT NULL,
  `press_user` int(10) NOT NULL,
  PRIMARY KEY (`press_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `press_run`
--

CREATE TABLE IF NOT EXISTS `press_run` (
  `press_run_id` int(10) NOT NULL AUTO_INCREMENT,
  `press_id` int(10) NOT NULL,
  `contact_id` int(10) NOT NULL,
  `mandrill_message_id` varchar(255) NOT NULL,
  `mandrill_status` varchar(255) NOT NULL,
  PRIMARY KEY (`press_run_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` int(11) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `displayName` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `webSiteURL` varchar(50) DEFAULT NULL,
  `profileURL` varchar(50) DEFAULT NULL,
  `photoURL` varchar(50) DEFAULT NULL,
  `description` mediumtext,
  `gender` varchar(50) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `birthDay` varchar(50) DEFAULT NULL,
  `birthMonth` varchar(50) DEFAULT NULL,
  `birthYear` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `emailVerified` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=230 ;

--
-- Contenu de la table `profiles`
--

INSERT INTO `profiles` (`user_id`, `identifier`, `lastname`, `displayName`, `firstname`, `webSiteURL`, `profileURL`, `photoURL`, `description`, `gender`, `language`, `age`, `birthDay`, `birthMonth`, `birthYear`, `email`, `emailVerified`, `phone`, `address`, `country`, `region`, `city`, `zip`) VALUES
(217, 2147483647, 'Radhouane', 'Walid Radhouane', 'Walid', '', 'https://www.facebook.com/app_scoped_user_id/102030', 'https://graph.facebook.com/10203032547707401/pictu', '', 'male', NULL, NULL, NULL, NULL, NULL, 'walido_20@hotmail.com', 'walido_20@hotmail.com', NULL, NULL, NULL, '', NULL, NULL),
(229, 1968397698, NULL, 'walidrad1', 'walid radhouane', NULL, 'http://twitter.com/walidrad1', 'http://abs.twimg.com/sticky/default_profile_images', '', NULL, NULL, NULL, NULL, NULL, NULL, 'radhouane.walid.m2@gmail.com', NULL, NULL, NULL, NULL, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `profiles_fields`
--

CREATE TABLE IF NOT EXISTS `profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `profiles_fields`
--

INSERT INTO `profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'First Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `role_channel`
--

CREATE TABLE IF NOT EXISTS `role_channel` (
  `company_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL,
  PRIMARY KEY (`company_id`,`contact_id`,`channel_id`),
  KEY `contact_id` (`contact_id`),
  KEY `channel_id` (`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `role_channel`
--

INSERT INTO `role_channel` (`company_id`, `contact_id`, `channel_id`) VALUES
(1, 224, 1),
(1, 224, 6),
(1, 226, 1),
(1, 226, 3),
(1, 226, 5),
(1, 227, 1),
(1, 227, 3),
(1, 227, 4),
(1, 228, 1),
(1, 228, 4),
(1, 228, 5),
(1, 228, 6);

-- --------------------------------------------------------

--
-- Structure de la table `system_oauth`
--

CREATE TABLE IF NOT EXISTS `system_oauth` (
  `system_oauth` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Defines platform',
  `platform_name` varchar(255) NOT NULL COMMENT 'LINKEDINâ€™, â€˜TWITTERâ€™,â€™FACEBOOKâ€™',
  `api_key` varchar(255) NOT NULL COMMENT 'string representation of public key',
  `api_secret` varchar(255) NOT NULL COMMENT 'string representation of secret key',
  PRIMARY KEY (`system_oauth`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `user_package_id` int(10) DEFAULT NULL COMMENT 'active user package (ref: user_package',
  `user_pass` varchar(255) NOT NULL COMMENT 'encoded password ',
  `user_credits` int(10) DEFAULT NULL COMMENT 'actual credits (default 0)',
  `user_registered` timestamp NULL DEFAULT NULL COMMENT 'register date',
  `user_verified` timestamp NULL DEFAULT NULL COMMENT 'verified on',
  `user_activity` timestamp NULL DEFAULT NULL COMMENT 'last activity',
  `user_deactivated` timestamp NULL DEFAULT NULL COMMENT 'deleted/deactivated on',
  `user_password_request` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'last request for new password',
  `user_email` varchar(255) NOT NULL COMMENT 'email for user',
  `porfile_initials` varchar(255) NOT NULL COMMENT 'initials',
  `porfile_name_first` varchar(255) NOT NULL COMMENT 'first name',
  `porfile_name_last` varchar(255) NOT NULL COMMENT 'last name',
  `porfile_address` varchar(255) DEFAULT NULL COMMENT 'street',
  `porfile_address_nr` int(10) DEFAULT NULL COMMENT 'street number',
  `porfile_address_addon` varchar(255) DEFAULT NULL COMMENT 'addon',
  `porfile_city` varchar(255) DEFAULT NULL COMMENT 'user city',
  `porfile_country` smallint(3) unsigned zerofill DEFAULT NULL COMMENT 'user country ISO id (ref iso_country',
  `porfile_phone` varchar(255) DEFAULT NULL COMMENT 'land phone',
  `porfile_mobile` varchar(255) DEFAULT NULL COMMENT 'mobile phone',
  `porfile_camp_name` varchar(255) DEFAULT NULL COMMENT 'company name',
  `porfile_camp_function` varchar(255) DEFAULT NULL COMMENT 'function',
  `porfile_camp_country` smallint(3) unsigned zerofill DEFAULT NULL COMMENT 'ISO country id (ref: iso_country',
  `porfile_camp_account` varchar(255) DEFAULT NULL COMMENT 'bank account number',
  `porfile_camp_email` varchar(255) DEFAULT NULL COMMENT 'email',
  `porfile_camp_website` varchar(255) DEFAULT NULL COMMENT 'site url',
  `porfile_coc` varchar(255) DEFAULT NULL COMMENT 'chamber of commerce id',
  `profile_remarks` mediumtext COMMENT 'general remarks',
  `usetting_sender_name` varchar(255) DEFAULT NULL COMMENT 'press sender name',
  `usetting_sender_email` varchar(255) DEFAULT NULL COMMENT 'press sender mail',
  `usetting_replyto_name` varchar(255) DEFAULT NULL COMMENT 'press replyto name',
  `usetting_replyto_email` varchar(255) DEFAULT NULL COMMENT 'press replyto mail',
  `usetting_bounce_email` varchar(255) DEFAULT NULL COMMENT 'press bounce mail',
  `profile` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `credittype` int(11) NOT NULL,
  `termofuse` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `porfile_camp_country` (`porfile_camp_country`),
  KEY `user_package_id` (`user_package_id`),
  KEY `porfile_country` (`porfile_country`),
  KEY `porfile_camp_country_2` (`porfile_camp_country`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=230 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `user_package_id`, `user_pass`, `user_credits`, `user_registered`, `user_verified`, `user_activity`, `user_deactivated`, `user_password_request`, `user_email`, `porfile_initials`, `porfile_name_first`, `porfile_name_last`, `porfile_address`, `porfile_address_nr`, `porfile_address_addon`, `porfile_city`, `porfile_country`, `porfile_phone`, `porfile_mobile`, `porfile_camp_name`, `porfile_camp_function`, `porfile_camp_country`, `porfile_camp_account`, `porfile_camp_email`, `porfile_camp_website`, `porfile_coc`, `profile_remarks`, `usetting_sender_name`, `usetting_sender_email`, `usetting_replyto_name`, `usetting_replyto_email`, `usetting_bounce_email`, `profile`, `status`, `credittype`, `termofuse`) VALUES
(217, NULL, '', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 'walido_20@hotmail.com', '', 'Walid', 'Radhouane', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, 0),
(225, NULL, '4b80e4144982a79667345fe863055a70', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 'walidclient@aa.com', '', 'walidclient', 'walidclient', '', NULL, '', '', 004, '646464', '', 'test', '', 068, NULL, 'walidclient@aa.com', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 2, 1),
(229, NULL, '', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 'radhouane.walid.m2@gmail.com', '', 'walid radhouane', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=231 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`) VALUES
(217, 'Walid Radhouane', '', 'walido_20@hotmail.com', '87d31ce3120b831bbf02fd7815615ab4', '2014-09-24 16:45:53', '0000-00-00 00:00:00', 0, 0),
(219, 'walidjournalist', '6b511b289b5161497fb84dec7d99b64a', 'radhouane.walid@yahoo.fr', 'e9a32d31cd84c9ca7437870569b97bbe', '2014-09-28 18:10:17', '0000-00-00 00:00:00', 0, 0),
(220, 'walidjournalist2', '6b511b289b5161497fb84dec7d99b64a', 'walido_200@hotmail.com', '5406133c2bfc0fa8588e2614cb93d1f3', '2014-09-28 18:28:00', '0000-00-00 00:00:00', 0, 0),
(221, 'walidjournalist20', '6b511b289b5161497fb84dec7d99b64a', 'walido_2000@hotmail.com', '0d5acf57142d4bcb5e840985beb1658e', '2014-09-28 18:43:29', '0000-00-00 00:00:00', 0, 0),
(222, 'walidjournalist3', '6b511b289b5161497fb84dec7d99b64a', 'walidjournalist@aa.com', 'c5ec97d942ce43bce8bae205443f5e70', '2014-09-28 18:53:56', '0000-00-00 00:00:00', 0, 0),
(223, 'walidjournalist4', '6b511b289b5161497fb84dec7d99b64a', 'walidjournalist4@aa.com', '2885f333606e14805dacd393a481960c', '2014-09-28 18:55:57', '0000-00-00 00:00:00', 0, 0),
(224, 'walidjournalist5', '6b511b289b5161497fb84dec7d99b64a', 'walidjournalist5@yetgroup.com', 'db6d8bf78d732903f29abe97024a87f7', '2014-09-29 09:53:04', '2014-10-03 08:14:53', 0, 1),
(225, 'walidclient', '6b511b289b5161497fb84dec7d99b64a', 'walidclient@aa.com', '7f2a87c5383c00d31d8558c7426df90a', '2014-09-29 10:24:04', '2014-09-29 09:24:43', 0, 1),
(226, 'walidjournalist6', '6b511b289b5161497fb84dec7d99b64a', 'walidjournalist6@aa.com', '1c7e45b17bda6aa7558be4324ce525c0', '2014-09-29 14:47:28', '2014-09-29 13:48:09', 0, 1),
(227, 'walidjournalist7', '6b511b289b5161497fb84dec7d99b64a', 'walidjournalist7@aa.com', '312fe57222d88a7e559e3d7dd167d99a', '2014-09-29 14:52:57', '0000-00-00 00:00:00', 0, 0),
(228, 'walidjournalist8', '6b511b289b5161497fb84dec7d99b64a', 'walidjournalist8@aa.com', 'fd38a0e6896fafb3e430cc84857f156b', '2014-09-29 14:59:04', '2014-09-30 11:03:07', 0, 1),
(229, 'walidrad1', '', 'radhouane.walid.m2@gmail.com', '22015d43993f2e3ab3d0e9494c0fdf1e', '2014-09-29 15:46:42', '0000-00-00 00:00:00', 0, 0),
(230, 'adminapl', 'f8450a97cc7e38e6d109425c87b41634', 'admin@apl.com', '71fc5d49b13d9502e376bfe4bdb95743', '2014-10-03 10:08:07', '0000-00-00 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_oauth`
--

CREATE TABLE IF NOT EXISTS `user_oauth` (
  `user_id` int(11) NOT NULL,
  `provider` varchar(45) NOT NULL,
  `identifier` varchar(64) NOT NULL,
  `profile_cache` text,
  `session_data` text,
  PRIMARY KEY (`provider`,`identifier`),
  UNIQUE KEY `unic_user_id_name` (`user_id`,`provider`),
  KEY `oauth_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user_oauth`
--

INSERT INTO `user_oauth` (`user_id`, `provider`, `identifier`, `profile_cache`, `session_data`) VALUES
(217, 'Facebook', '10203032547707401', 'a:22:{s:10:"identifier";s:17:"10203032547707401";s:10:"webSiteURL";s:0:"";s:10:"profileURL";s:62:"https://www.facebook.com/app_scoped_user_id/10203032547707401/";s:8:"photoURL";s:73:"https://graph.facebook.com/10203032547707401/picture?width=150&height=150";s:11:"displayName";s:15:"Walid Radhouane";s:11:"description";s:0:"";s:9:"firstName";s:5:"Walid";s:8:"lastName";s:9:"Radhouane";s:6:"gender";s:4:"male";s:8:"language";N;s:3:"age";N;s:8:"birthDay";N;s:10:"birthMonth";N;s:9:"birthYear";N;s:5:"email";s:21:"walido_20@hotmail.com";s:13:"emailVerified";s:21:"walido_20@hotmail.com";s:5:"phone";N;s:7:"address";N;s:7:"country";N;s:6:"region";s:0:"";s:4:"city";N;s:3:"zip";N;}', 'a:2:{s:35:"hauth_session.facebook.is_logged_in";s:4:"i:1;";s:41:"hauth_session.facebook.token.access_token";s:207:"s:198:"CAAGrZCWXM4XYBAMq78nI5hhpy5GoFTt3k4PnmDCgnXRd0k9dg6zFQZCOzBqfETz6aFHZAlUeyz5DrWeSnonNPiwGtX0XPPWuJNxHIwRlCDZAzx59LuKapZC1uyDhgOkwLZAMn4wZA1uVEXR1tigZA0HFc2gKbza1b1lhtvl5hpsJfTx3ftxa1myqNjz7mgPWLlIZD";";}'),
(229, 'Twitter', '1968397698', 'a:22:{s:10:"identifier";i:1968397698;s:10:"webSiteURL";N;s:10:"profileURL";s:28:"http://twitter.com/walidrad1";s:8:"photoURL";s:79:"http://abs.twimg.com/sticky/default_profile_images/default_profile_1_normal.png";s:11:"displayName";s:9:"walidrad1";s:11:"description";s:0:"";s:9:"firstName";s:15:"walid radhouane";s:8:"lastName";N;s:6:"gender";N;s:8:"language";N;s:3:"age";N;s:8:"birthDay";N;s:10:"birthMonth";N;s:9:"birthYear";N;s:5:"email";N;s:13:"emailVerified";N;s:5:"phone";N;s:7:"address";N;s:7:"country";N;s:6:"region";s:0:"";s:4:"city";N;s:3:"zip";N;}', 'a:3:{s:40:"hauth_session.twitter.token.access_token";s:58:"s:50:"1968397698-VwAD6LTwRH8P9GiW7qTQVtrWiresg0AjadMkuY8";";s:47:"hauth_session.twitter.token.access_token_secret";s:53:"s:45:"lHGMe4gHSBqzEe21loZO23oXhrpJRsQHxhimXkCrhZQ9j";";s:34:"hauth_session.twitter.is_logged_in";s:4:"i:1;";}');

-- --------------------------------------------------------

--
-- Structure de la table `user_package`
--

CREATE TABLE IF NOT EXISTS `user_package` (
  `user_id` int(10) NOT NULL COMMENT 'user_id',
  `credit_package_id` int(10) NOT NULL COMMENT 'package type id (ref: credit_package)',
  `voucher_code` int(10) DEFAULT NULL COMMENT 'voucher applied or NIL for no discount-Â­â€voucher',
  `utype_credits` int(10) DEFAULT NULL COMMENT 'current open amount in credits',
  `utype_expires` timestamp NULL DEFAULT NULL COMMENT 'expiry date of package',
  `utype_notes` mediumtext NOT NULL COMMENT 'opt. notes',
  PRIMARY KEY (`user_id`),
  KEY `credit_package_id` (`credit_package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user_package`
--

INSERT INTO `user_package` (`user_id`, `credit_package_id`, `voucher_code`, `utype_credits`, `utype_expires`, `utype_notes`) VALUES
(217, 12, NULL, NULL, NULL, ''),
(225, 13, NULL, NULL, NULL, ''),
(229, 14, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Structure de la table `web_menu`
--

CREATE TABLE IF NOT EXISTS `web_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_title_c` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_parent` int(11) DEFAULT NULL,
  `menu_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_header` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_header_c` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_order` int(11) DEFAULT NULL,
  `menu_type` enum('-','page_home','page_contact','news_overview','nl_signup','videos_overview','page_404','register','journalist_signup','press_overview') DEFAULT NULL,
  `menu_online` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Online',
  `menu_content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_lang_country` int(11) NOT NULL,
  `menu_lang_group` int(11) NOT NULL,
  `menu_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`menu_id`),
  KEY `language` (`menu_lang_country`,`menu_lang_group`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Created with Autoform 2009' AUTO_INCREMENT=34 ;

--
-- Contenu de la table `web_menu`
--

INSERT INTO `web_menu` (`menu_id`, `menu_title`, `menu_title_c`, `menu_parent`, `menu_path`, `menu_header`, `menu_header_c`, `menu_order`, `menu_type`, `menu_online`, `menu_content`, `menu_lang_country`, `menu_lang_group`, `menu_added`) VALUES
(1, 'Home', 'home', 0, NULL, 'The Africa Press List', 'the-africa-press-list', 10, 'page_home', 'Online', '<table border="0" cellpadding="0" cellspacing="0">\r\n	<tbody>\r\n		<tr>\r\n			<td valign="top" width="430">\r\n				<p>\r\n					As a fast growing young economy Africa often is compared with emerging markets like Brazil, India and Turkey. There are many parallels but also many differences. What can make Africa a complicated case is the fact that Africa is not one country but 54. How are you going to build your brand in 54 countries? How to conduct your media strategy? How can you get in contact with over 10,000 African journalists in a highly fragmented media landscape?<br />\r\n					<br />\r\n					Africa Business Communities has spent over three years getting connected with the African media. We have built relationships with thousands of African journalists resulting in the Africa Press List.</p>\r\n				<p>\r\n					<br />\r\n					The Africa Press List is a powerful and highly effective PR tool being fully interactive. Our clients get direct access to this online tool that enables them to conduct tailor made press release campaigns.<br />\r\n					<br />\r\n					So you send your press releases to English speaking newspaper journalists in Abuja, Nigeria, reporting on politics. Or to all French speaking journalists in Cameroun working for television, reporting on fashion. Or to all Portuguese journalists worldwide, reporting on African business. Well, it is all up to you.<br />\r\n					<br />\r\n					We offer our clients both annual subscription to the Africa Press List and pay-as-you-go. Please feel free to contact us with your request.<br />\r\n					<br />\r\n					&nbsp;</p>\r\n				<p>\r\n					<style>\r\n<!--{cke_protected}%3C!%2D%2D%7Bcke_protected%7D%253C!%252D%252D%257Bcke_protected%257D%25253C!%25252D%25252D%25257Bcke_protected%25257D%2525253C!%2525252D%2525252D%2525257Bcke_protected%2525257D%252525253C!%252525252D%252525252D%252525257Bcke_protected%252525257D%25252525253C!%25252525252D%25252525252D%25252525257Bcke_protected%25252525257D%2525252525253C!%2525252525252D%2525252525252D%2525252525257Bcke_protected%2525252525257D%252525252525253C!%252525252525252D%252525252525252D%252525252525257Bcke_protected%252525252525257D%25252525252525253C!%25252525252525252D%25252525252525252D%25252525252525257Bcke_protected%25252525252525257D%2525252525252525253C!%2525252525252525252D%2525252525252525252D%2525252525252525250A%2525252525252525252F*%25252525252525252520Font%25252525252525252520Definitions%25252525252525252520*%2525252525252525252F%2525252525252525250A%25252525252525252540font-face%2525252525252525250A%2525252525252525257Bfont-family%2525252525252525253AVerdana%2525252525252525253B%2525252525252525250Apanose-1%2525252525252525253A2%2525252525252525252011%252525252525252525206%252525252525252525204%252525252525252525203%252525252525252525205%252525252525252525204%252525252525252525204%252525252525252525202%252525252525252525204%2525252525252525253B%2525252525252525250Amso-font-charset%2525252525252525253A0%2525252525252525253B%2525252525252525250Amso-generic-font-family%2525252525252525253Aauto%2525252525252525253B%2525252525252525250Amso-font-pitch%2525252525252525253Avariable%2525252525252525253B%2525252525252525250Amso-font-signature%2525252525252525253A-1593833729%252525252525252525201073750107%2525252525252525252016%252525252525252525200%25252525252525252520415%252525252525252525200%2525252525252525253B%2525252525252525257D%2525252525252525250A%25252525252525252540font-face%2525252525252525250A%2525252525252525257Bfont-family%2525252525252525253A%25252525252525252522Cambria%25252525252525252520Math%25252525252525252522%2525252525252525253B%2525252525252525250Apanose-1%2525252525252525253A2%252525252525252525204%252525252525252525205%252525252525252525203%252525252525252525205%252525252525252525204%252525252525252525206%252525252525252525203%252525252525252525202%252525252525252525204%2525252525252525253B%2525252525252525250Amso-font-charset%2525252525252525253A0%2525252525252525253B%2525252525252525250Amso-generic-font-family%2525252525252525253Aauto%2525252525252525253B%2525252525252525250Amso-font-pitch%2525252525252525253Avariable%2525252525252525253B%2525252525252525250Amso-font-signature%2525252525252525253A-536870145%252525252525252525201107305727%252525252525252525200%252525252525252525200%25252525252525252520415%252525252525252525200%2525252525252525253B%2525252525252525257D%2525252525252525250A%2525252525252525252F*%25252525252525252520Style%25252525252525252520Definitions%25252525252525252520*%2525252525252525252F%2525252525252525250Ap.MsoNormal%2525252525252525252C%25252525252525252520li.MsoNormal%2525252525252525252C%25252525252525252520div.MsoNormal%2525252525252525250A%2525252525252525257Bmso-style-unhide%2525252525252525253Ano%2525252525252525253B%2525252525252525250Amso-style-qformat%2525252525252525253Ayes%2525252525252525253B%2525252525252525250Amso-style-parent%2525252525252525253A%25252525252525252522%25252525252525252522%2525252525252525253B%2525252525252525250Amargin%2525252525252525253A0cm%2525252525252525253B%2525252525252525250Amargin-bottom%2525252525252525253A.0001pt%2525252525252525253B%2525252525252525250Amso-pagination%2525252525252525253Awidow-orphan%2525252525252525253B%2525252525252525250Afont-size%2525252525252525253A9.0pt%2525252525252525253B%2525252525252525250Afont-family%2525252525252525253AVerdana%2525252525252525253B%2525252525252525250Amso-fareast-font-family%2525252525252525253A%25252525252525252522Times%25252525252525252520New%25252525252525252520Roman%25252525252525252522%2525252525252525253B%2525252525252525250Amso-bidi-font-family%2525252525252525253A%25252525252525252522Times%25252525252525252520New%25252525252525252520Roman%25252525252525252522%2525252525252525253B%2525252525252525250Amso-ansi-language%2525252525252525253AEN-US%2525252525252525253B%2525252525252525250Amso-fareast-language%2525252525252525253ANL%2525252525252525253B%2525252525252525257D%2525252525252525250Ap.MsoNormalIndent%2525252525252525252C%25252525252525252520li.MsoNormalIndent%2525252525252525252C%25252525252525252520div.MsoNormalIndent%2525252525252525250A%2525252525252525257Bmso-style-unhide%2525252525252525253Ano%2525252525252525253B%2525252525252525250Amargin-top%2525252525252525253A0cm%2525252525252525253B%2525252525252525250Amargin-right%2525252525252525253A0cm%2525252525252525253B%2525252525252525250Amargin-bottom%2525252525252525253A0cm%2525252525252525253B%2525252525252525250Amargin-left%2525252525252525253A35.4pt%2525252525252525253B%2525252525252525250Amargin-bottom%2525252525252525253A.0001pt%2525252525252525253B%2525252525252525250Amso-pagination%2525252525252525253Awidow-orphan%2525252525252525253B%2525252525252525250Afont-size%2525252525252525253A9.0pt%2525252525252525253B%2525252525252525250Afont-family%2525252525252525253AVerdana%2525252525252525253B%2525252525252525250Amso-fareast-font-family%2525252525252525253A%25252525252525252522Times%25252525252525252520New%25252525252525252520Roman%25252525252525252522%2525252525252525253B%2525252525252525250Amso-bidi-font-family%2525252525252525253A%25252525252525252522Times%25252525252525252520New%25252525252525252520Roman%25252525252525252522%2525252525252525253B%2525252525252525250Amso-ansi-language%2525252525252525253AEN-US%2525252525252525253B%2525252525252525250Amso-fareast-language%2525252525252525253ANL%2525252525252525253B%2525252525252525257D%2525252525252525250A.MsoChpDefault%2525252525252525250A%2525252525252525257Bmso-style-type%2525252525252525253Aexport-only%2525252525252525253B%2525252525252525250Amso-default-props%2525252525252525253Ayes%2525252525252525253B%2525252525252525250Afont-size%2525252525252525253A10.0pt%2525252525252525253B%2525252525252525250Amso-ansi-font-size%2525252525252525253A10.0pt%2525252525252525253B%2525252525252525250Amso-bidi-font-size%2525252525252525253A10.0pt%2525252525252525253B%2525252525252525257D%2525252525252525250A%25252525252525252540page%25252525252525252520WordSection1%2525252525252525250A%2525252525252525257Bsize%2525252525252525253A612.0pt%25252525252525252520792.0pt%2525252525252525253B%2525252525252525250Amargin%2525252525252525253A72.0pt%2525252525252525252090.0pt%2525252525252525252072.0pt%2525252525252525252090.0pt%2525252525252525253B%2525252525252525250Amso-header-margin%2525252525252525253A36.0pt%2525252525252525253B%2525252525252525250Amso-footer-margin%2525252525252525253A36.0pt%2525252525252525253B%2525252525252525250Amso-paper-source%2525252525252525253A0%2525252525252525253B%2525252525252525257D%2525252525252525250Adiv.WordSection1%2525252525252525250A%2525252525252525257Bpage%2525252525252525253AWordSection1%2525252525252525253B%2525252525252525257D%2525252525252525250A%2525252525252525252D%2525252525252525252D%2525252525252525253E%25252525252525252D%25252525252525252D%25252525252525253E%252525252525252D%252525252525252D%252525252525253E%2525252525252D%2525252525252D%2525252525253E%25252525252D%25252525252D%25252525253E%252525252D%252525252D%252525253E%2525252D%2525252D%2525253E%25252D%25252D%25253E%252D%252D%253E%2D%2D%3E--></style></p>\r\n				<hr />\r\n				Stay up to date with our newest development and services.<br />\r\n				You can also follow us on social media.<br />\r\n				<br />\r\n				<table border="0" width="190px">\r\n					<tbody>\r\n						<tr>\r\n							<td>\r\n								<a href="/en/p/newsletter.html"><img alt="" height="36" src="/uploads/button-newslettersignup.jpg" width="180" /></a></td>\r\n						</tr>\r\n					</tbody>\r\n				</table>\r\n				<p>\r\n					&nbsp;</p>\r\n			</td>\r\n			<td width="40">\r\n				&nbsp;</td>\r\n			<td valign="top" width="410">\r\n				<div style="width: 410px; height: 284px;">\r\n					{APL_SLIDESHOW}</div>\r\n				<h3>\r\n					&nbsp;</h3>\r\n				<h3>\r\n					A worldwide selection of journalists</h3>\r\n				<h4>\r\n					Working for the most prominent media reporting on Africa</h4>\r\n				<h3>\r\n					4 Languages</h3>\r\n				<h4>\r\n					English, French, Portuguese and Arabic</h4>\r\n				<h3>\r\n					6 Media Types</h3>\r\n				<h4>\r\n					Television, Radio, Newspapers, Magazines, Internet and Blogs</h4>\r\n				<h3>\r\n					30 Fields of interest</h3>\r\n				<h4>\r\n					In 54 African countries</h4>\r\n				<h1>\r\n					<span style="font-weight: bold;">Personal and direct contact with African journalists<br />\r\n					</span></h1>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 30, 1, '2011-08-28 11:51:27'),
(2, 'For Who?', 'for-who', 8, NULL, 'The African Press list is for the following companies', 'the-african-press-list-is-for-the-following-companies', 10, '-', 'Offline', '<p>\n	The Africa Press List wishes to provide an effective and efficient solution to international organizations and companies that want to reach an (press) audience that is African or has an interest in Africa.</p>\n<p>\n	For local companies or oganizations only active in some (or only one) country(ies) in Africa, The Africa Press List provides flexible local solutions at low costs.</p>\n<p>\n	If the following complies with your needs, we recommend you to sign-up.</p>\n<ul>\n	<li>\n		Social media integrated?</li>\n	<li>\n		You can personalize the search system in the database with own search terms</li>\n	<li>\n		More than 30 thematic categories to select journalists and media titles</li>\n	<li>\n		You can select entire Africa, regions, countries and cities</li>\n	<li>\n		Draft your own selection lists and keep these online available</li>\n	<li>\n		Keep a history of your press releases sent out</li>\n	<li>\n		You can make personal notes about the journalists or add contact details where only YOU have access to when using the &ldquo;Add Detail&rdquo; button.</li>\n	<li>\n		All press releases are published on the blog of Africa Business Communities and redistributed to the biggest Africa related Linkedin groups and twitter channels</li>\n</ul>\n<p>\n	The Africa Press List wishes to provide an effective and efficient solution to international organizations and companies that want to reach an (press) audience that is African or has an interest in Africa.</p>\n<p>\n	In a later phase, we will launch the Africa Press List for local companies or organizations only active in some or only one country(ies) in Africa. Herewith, the Africa Press List provides flexible local solutions at low costs.</p>\n<p>\n	<strong><a href="/en/p/newsletter.html">Click here</a></strong>&nbsp; to stay upto date with our newest development and services. You can also follow us on twitter, LinkedIn and Facebook.</p>\n', 30, 2, '2011-08-28 11:51:27'),
(4, 'News', 'news', 9, NULL, 'Africa Headline News', 'africa-headline-news', 10, 'news_overview', 'Offline', '<p>\r\n	Latest News Items sorted by date.</p>\r\n', 30, 4, '2011-08-28 11:51:27'),
(5, 'Newsletter', 'newsletter', 9, NULL, 'Africa Press List newsletter', 'africa-press-list-newsletter', 20, 'nl_signup', 'Online', '<p>\r\n	To stay up to date with our newest developments and services, please fill in the form [your name and email-address] below. You can also follow us on Twitter, LinkedIn and Facebook.</p>\r\n', 30, 5, '2011-08-28 11:51:27'),
(6, 'Demo', 'demo', 8, NULL, 'Watch our tutorial', 'watch-our-tutorial', 20, 'videos_overview', 'Offline', '<p>\r\n	<br />\r\n	<br />\r\n	<img alt="" src="/uploads/demo.jpg" /></p>\r\n', 30, 6, '2011-08-28 11:51:27'),
(7, '404 not found', '404-not-found', 0, NULL, 'This page cannot be found !', 'this-page-cannot-be-found', 70, 'page_404', 'Offline', '', 30, 7, '2011-08-28 11:51:27'),
(8, 'For who and how?', 'for-who-and-how', 0, NULL, 'Why the Africa Press List ?', 'why-the-africa-press-list', 20, '-', 'Online', '<table border="0" cellpadding="0" cellspacing="0" width="925">\r\n	<tbody>\r\n		<tr>\r\n			<td width="520">\r\n				<p>\r\n					The Africa Press List wishes to provide an effective and efficient solution to international organizations and companies that want to reach an (press) audience that is African or has an interest in Africa.</p>\r\n				<p>\r\n					If the following complies with your needs, we recommend you to sign-up.</p>\r\n				<ul>\r\n					<li>\r\n						Social media integrated press release campaigns</li>\r\n					<li>\r\n						You can personalize the search system in the database with own search terms</li>\r\n					<li>\r\n						More than 30 thematic categories to select journalists and media titles</li>\r\n					<li>\r\n						You can select entire Africa, regions, countries and cities</li>\r\n					<li>\r\n						Draft your own selection lists and keep these online available</li>\r\n					<li>\r\n						Keep a history of your press releases sent out</li>\r\n					<li>\r\n						All press releases are published on the blog of Africa Business Communities and redistributed to the biggest Africa related Linkedin groups and twitter channels</li>\r\n				</ul>\r\n				<p>\r\n					&nbsp;</p>\r\n				<p>\r\n					In a later phase, we will launch the Africa Press List for local companies or organizations only active in some or only one country(ies) in Africa. Herewith, the Africa Press List provides flexible local solutions at low costs.</p>\r\n				<p>\r\n					&nbsp;</p>\r\n				<hr />\r\n				<p>\r\n					Stay up to date with our newest development and services.<br />\r\n					You can also follow us on social media.</p>\r\n				<p>\r\n					<a href="/en/p/newsletter.html"><img alt="" height="36" src="/uploads/button-newslettersignup.jpg" width="180" /></a></p>\r\n			</td>\r\n			<td valign="top">\r\n				<p>\r\n					<a href="http://app.africapresslist.com/en/register.html"><img alt="" height="237" src="/uploads/addpressrel.jpg" width="406" /></a></p>\r\n				<p>\r\n					&nbsp;</p>\r\n				<p>\r\n					<a href="http://www.africapresslist.com/en/p/journalists.html"><img alt="" height="174" src="/uploads/registerjour.jpg" width="406" /></a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', 30, 8, '2011-08-28 14:23:24'),
(20, 'Contact us', 'contact-us', 9, NULL, 'Contact us', 'contact-us', 5, 'page_contact', 'Online', '<p>\r\n	Africa Business Communities has offices in&nbsp;Haarlem - The Netherlands&nbsp;and&nbsp;Accra - Ghana.<br />\r\n	<a href="http://www.africabusinesscommunities.com" target="_blank">www.africabusinesscommunities.com</a><br />\r\n	<br />\r\n	For more information on the services of Africa Business Communities, please contact our office &ndash; apl@africabusinesscommunities.nl or look at <br />\r\n\r\n	ShareTwitterFacebook<br />\r\n	<br />\r\n	Also see: <a href="/en/p/contact-info.html">Contact info</a></p>\r\n', 30, 3, '2011-08-28 19:08:36'),
(10, 'Journalists', 'journalists', 0, NULL, 'Add yourself as a Journalist', 'add-yourself-as-a-journalist', 60, '-', 'Online', '<p>\r\n	<img alt="" height="220" src="/uploads/APL.jpg" style="float:right" width="272" />You, being a journalist, freelancer, blogger or employed by a publisher, can register yourself with the Africa Press List. We will check your data and add you to the list. If you are included in our list, you will receive automatically targeted press releases from companies and organizations with a special interest in Africa. Furthermore, we will add you to the database through which interested companies can search for your services. It is nice if we can do some promotion for you in return.<br />\r\n	<br />\r\n	Please fill in your profile as complete as possible, that will help us both.</p>\r\n<p>\r\n	The Africa Press List is easy to use, but if certain things are not clear or you need guidance or assistance, please contact us by email.<br />\r\n	<br />\r\n	<a href="/en/p/freelancer.html?jour_type=Company"><img align="left" alt="" height="32" src="/uploads/register-bar.png" width="179" /></a><br />\r\n	&nbsp;</p>\r\n<hr />\r\n\r\n<table border="0" cellpadding="0" cellspacing="0" style="width: 885px;">\r\n	<tbody>\r\n		<tr>\r\n			<td valign="bottom" width="279">\r\n				<img align="bottom" alt="" height="88" src="/uploads/freelancer.jpg" width="274" /></td>\r\n			<td style="padding-left: 30px;" valign="bottom" width="279">\r\n				<img align="bottom" alt="" height="88" src="/uploads/publisher.jpg" width="274" /></td>\r\n			<td style="padding-left: 30px;" valign="bottom">\r\n				<img align="bottom" alt="" height="88" src="/uploads/blogger.jpg" width="274" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td valign="top">\r\n				<p>\r\n					As a freelancer, you can register yourself with the Africa Press List. We will check your data and add you to the list. If you are included in our list, you will receive automatically targeted press releases from companies and organizations with a special interest in Africa.</p>\r\n			</td>\r\n			<td style="padding-left: 30px;" valign="top">\r\n				<p>\r\n					As a journalist employed by a publisher, can register yourself with the Africa Press List. We will check your data and add you to the list. If you are included in our list, you will receive automatically targeted press releases from companies and organizations with a special interest in Africa.</p>\r\n			</td>\r\n			<td style="padding-left: 30px;" valign="top">\r\n				<p>\r\n					As a Blogger, you can register yourself with the Africa Press List. We will check your data and add you to the list. If you are included in our list, you will receive automatically targeted press releases from companies and organizations with a special interest in Africa.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="text-align: center;" valign="bottom">\r\n				<a href="/en/p/freelancer.html?jour_type=Company"><img align="left" alt="" height="32" src="/uploads/register-bar.png" width="179" /></a></td>\r\n			<td style="text-align: center; padding-left:30px;" valign="bottom">\r\n				<a href="/en/p/freelancer.html?jour_type=Company"><img align="left" alt="" height="32" src="/uploads/register-bar.png" width="179" /></a></td>\r\n			<td style="text-align: center; padding-left:30px;" valign="bottom">\r\n				<a href="/en/p/freelancer.html?jour_type=Company"><img align="left" alt="" height="32" src="/uploads/register-bar.png" width="179" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="text-align: center;">\r\n				<img alt="" height="12" src="/uploads/underline.png" width="268" /></td>\r\n			<td style="padding-left:30px; text-align: center;">\r\n				<img alt="" height="12" src="/uploads/underline.png" width="268" /></td>\r\n			<td style="padding-left:30px; text-align: center;">\r\n				<img alt="" height="12" src="/uploads/underline.png" width="268" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n<table border="0" cellpadding="0" cellspacing="0" style="width: 885px;">\r\n</table>\r\n', 30, 10, '2011-08-28 14:56:44'),
(17, 'Download Manual', 'download-manual', 8, NULL, 'How to use the African Press List', 'how-to-use-the-african-press-list_2', 40, '-', 'Offline', '<p>\r\n	You can Download our manual here or click here to print.<br />\r\n	<br />\r\n	&nbsp;</p>\r\n<h2>\r\n	Step 1</h2>\r\n<p>\r\n	jsdh kjlsd jsdkljf skldjf sdklfj sdkljf sdkljf sdklfj sdkljf skldfj</p>\r\n<hr />\r\n<h2>\r\n	Step 2</h2>\r\n<p>\r\n	jsdh kjlsd jsdkljf skldjf sdklfj sdkljf sdkljf sdklfj sdkljf skldfj</p>\r\n<hr />\r\n<h2>\r\n	Step 3</h2>\r\n<p>\r\n	jsdh kjlsd jsdkljf skldjf sdklfj sdkljf sdkljf sdklfj sdkljf skldfj</p>\r\n<hr />\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>', 30, 16, '2011-08-28 18:30:59'),
(11, 'Cost of Use old', 'cost-of-use-old', 0, NULL, 'What does it cost?', 'what-does-it-cost', 51, '-', 'Offline', '<p>\r\n	<img align="right" alt="" height="624" hspace="" src="/uploads/image.jpg" style="margin-left: 50px;" width="426" /></p>\r\n<h2>\r\n	An annual subscription</h2>\r\n<p>\r\n	We have priced the press release sent to any journalist by way of credits. We do this in order to avoid &ldquo;send all&rdquo; actions and promote the use of differentiated campaign lists. The annual subscription entitles you to 9,000 credits. Additional credits can be bought by subscribers at the lowest price, i.e. &euro;0.25 or USD 0.35.<br />\r\n	<br />\r\n	We also offer the possibility to use the Africa Press List for <b>single use</b>. You can buy credits according to the following scale with a minimum of &euro;350,00.&nbsp; If the total amount of credits exceeds the minimal administration fee, the administration fee can be deducted from this total amount. You can buy any number of credits you wish to.<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	<img alt="" height="145" src="/uploads/paypal_logo[1].jpg" width="180" /></p>\r\n', 30, 11, '2011-08-28 14:58:15'),
(12, 'Freelancer', 'freelancer', 10, NULL, 'Register as freelancer', 'register-as-freelancer', 10, 'journalist_signup', 'Offline', '<p>\r\n	<img alt="" src="/uploads/register.jpg" /></p>\r\n', 30, 12, '2011-08-28 15:00:52'),
(13, 'Register', 'register_2', 10, NULL, 'Register as Journalist, Freelancer, Blogger or Publisher', 'register-as-journalist-freelancer-blogger-or-publisher', 20, 'journalist_signup', 'Online', '<p>\r\n	<img alt="" src="/uploads/register.jpg" /></p>\r\n', 30, 13, '2011-08-28 15:01:28'),
(14, 'About Us', 'about-us', 0, NULL, 'About The African Press List', 'about-the-african-press-list', 65, '-', 'Online', '<p>\r\n	<img alt="" height="624" src="/uploads/image.jpg" style="float:right" width="426" />The Africa Press List is a service powered by Africa Business Communities.<br />\r\n	<br />\r\n	Africa Business Communities has spent over three years getting connected with the African media. We have built relationships with thousands of African journalists resulting in the Africa Press List.<br />\r\n	The Africa Press List is a powerful and highly effective PR tool being fully interactive with social media. <br />\r\n	<br />\r\n	Africa Business Communities is servicing companies and organizations operating on the continent.<br />\r\n	<br />\r\n	The social networks of Africa Business Communities are connecting over 100.000 business professionals worldwide with an interest in the continent Africa.</p>\r\n<h2>\r\n	Other services of <em><u><a href="http://www.africabusinesscommunities.com/" target="_blank">Africa Business Communities</a></u></em> include:</h2>\r\n<ul>\r\n	<li>\r\n		Market Research</li>\r\n	<li>\r\n		Lead Generation</li>\r\n	<li>\r\n		Recruitment</li>\r\n	<li>\r\n		Marketing and publishing</li>\r\n</ul>\r\n<p>\r\n	In addition to the Africa Press List we can develop and run your newsletters and websites. As a special service we can develop your own social network or integrate your existing social network in our network that will guarantee fast growth and presence of your brand in the African business community.</p>\r\n<p>\r\n	Stay up to date with our newest development and services.<br />\r\n	You can also follow us on social media.</p>\r\n<p>\r\n	<a href="/en/p/newsletter.html"><img alt="" height="36" src="/uploads/button-newslettersignup.jpg" width="180" /></a></p>\r\n', 30, 9, '2011-08-28 17:15:02'),
(15, 'Credits', 'credits', 11, NULL, 'Get Credits', 'get-credits', 10, '-', 'Offline', '<p>\r\n	<img align="right" alt="" height="145" src="/uploads/paypal_logo[1].jpg" width="180" />We accept all Credit cards. 100% Secure Payment by PayPal.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>', 30, 14, '2011-08-28 17:22:12'),
(16, 'Blogger', 'blogger', 10, NULL, 'Add your Blog to our Database', 'add-your-blog-to-our-database', 30, 'journalist_signup', 'Offline', '<p>\r\n	<img alt="" src="/uploads/register.jpg" /></p>\r\n', 30, 15, '2011-08-28 18:26:18'),
(18, 'Sign-Up Now!', 'sign-up-now', 0, NULL, 'Subscribe and create an account', 'subscribe-and-create-an-account', 45, 'register', 'Online', '', 30, 17, '2011-08-28 18:51:54'),
(19, 'Costs of Use', 'costs-of-use', 0, NULL, 'What does it cost?', 'what-does-it-cost_2', 40, '-', 'Online', '<table border="0" cellpadding="10" cellspacing="0" style="" width="100%">\r\n	<tbody>\r\n		<tr>\r\n			<td style="border-bottom:1px solid #d3d3d3;" valign="top" width="50%">\r\n				<div style="font-size:24px; color:#005581">\r\n					<b>Annual subscription</b></div>\r\n				<br />\r\n				<br />\r\n				<div style="font-size:14px;">\r\n					We have priced the press release sent to any journalist by way of credits. We do this in order to avoid &ldquo;send all&rdquo; actions and promote the use of differentiated campaign lists. The annual subscription entitles you to 9.000 credits. Additional credits can be bought by subscribers at the lowest price, i.e. &euro; 0.25 or USD 0.35.</div>\r\n			</td>\r\n			<td style="border-bottom:1px solid #d3d3d3;" valign="top" width="25%">\r\n				<div style="color:#005581; font-size:20px; vertical-align:text-top">\r\n					Access to <b>all</b> african<br />\r\n					countries<br />\r\n					<br />\r\n					<b>9000 credits included</b></div>\r\n				<br />\r\n				<div style="font-size:36px; color:#ff0000;">\r\n					<b>&euro; 1.950,00<br />\r\n					<br />\r\n					</b></div>\r\n				<br />\r\n				<a href="http://app.africapresslist.com/en/register.html"><img alt="" height="39" src="/uploads/signsup.png" width="183" /></a></td>\r\n			<td style="border-bottom: 1px solid rgb(211, 211, 211); text-align: center;" valign="top" width="25%">\r\n				<img alt="" height="265" src="/uploads/country-picture.jpg" width="225" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom:1px solid #d3d3d3;" valign="top" width="50%">\r\n				<div style="font-size:24px; color:#005581">\r\n					<b><br />\r\n					Starters Offer<br />\r\n					</b></div>\r\n				<br />\r\n				<br />\r\n				<div style="font-size:14px;">\r\n					We also have an offer for starters without having to take the full subscription. You can start using the Africa Press List for only &euro; 350, not limited in time. You get 1.000 credits with this option. One credit stands for one press release sent to one journalist. Accordingly, with these credits you can send one press release to 1.000 journalists, or 2 press releases to 500 journalists or 10 press releases to 100 journalists, etcetera.</div>\r\n			</td>\r\n			<td style="border-bottom:1px solid #d3d3d3;" valign="top" width="25%">\r\n				<div style="color: rgb(0, 85, 129); font-size: 20px; vertical-align: text-top;">\r\n					<br />\r\n					Access to <b>all</b> african<br />\r\n					countries</div>\r\n				<div style="color:#005581; font-size:20px; vertical-align:text-top">\r\n					<b><br />\r\n					1000 credits included</b></div>\r\n				<br />\r\n				<div style="font-size:36px; color:#ff0000;">\r\n					<b>&euro; 350,00<br />\r\n					<br />\r\n					</b></div>\r\n				<br />\r\n				<a href="http://app.africapresslist.com/en/register.html"><img alt="" height="39" src="/uploads/signsup(1).png" width="183" /></a></td>\r\n			<td style="border-bottom: 1px solid rgb(211, 211, 211); text-align: center;" valign="top" width="25%">\r\n				<br />\r\n				<img alt="" height="265" src="/uploads/country-picture.jpg" width="225" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 30, 18, '2011-08-28 19:05:53'),
(22, 'Subscriptions', 'subscriptions', 11, NULL, 'Yearly Subscripions', 'yearly-subscripions', 15, '-', 'Offline', '<p>\r\n	<img alt="" src="/uploads/packages.jpg" /></p>\r\n', 30, 20, '2011-08-28 19:38:01');
INSERT INTO `web_menu` (`menu_id`, `menu_title`, `menu_title_c`, `menu_parent`, `menu_path`, `menu_header`, `menu_header_c`, `menu_order`, `menu_type`, `menu_online`, `menu_content`, `menu_lang_country`, `menu_lang_group`, `menu_added`) VALUES
(23, 'Terms of Use', 'terms-of-use', NULL, NULL, 'Terms of Use', 'terms-of-use', 10, '-', 'Online', '<p>\r\n	1.&nbsp;&nbsp;&nbsp; Introduction to Africa Press List Terms of Use<br />\r\n	<br />\r\n	IMPORTANT - READ CAREFULLY: These &quot;Terms of Use&quot; (sometimes referred to as this &quot;Agreement&quot;) constitutes a legal agreement between you and Africa Business Communities B.V. a Netherlands limited liability company, (&quot;APL,&quot; &quot;we,&quot; or &quot;us&quot;). You are a customer (&quot;Member&quot;) (or will become a Member if you agree to our Terms of Use by clicking below). The &quot;Term&quot; is the time during which you are entitled to use our website to create and send out electronic newsletters and other digital content. If an individual purports, and has the legal authority, to sign these Terms of Use electronically on behalf of an employer or client, &quot;you&quot; refers to the employer or client. If not, &quot;you&quot; refers to the individual signing hereon. You are responsible for assuring that all the terms and conditions of this Agreement are complied with. By clicking the button to join APL, you will be agreeing to the terms of this Agreement. Furthermore, by clicking that button, after typing in your username, or other indication of your identity, you do confirm to us that typing in such indication of identity constitutes your &quot;signing&quot; of this Agreement for all purposes under applicable law. Any individual clicking the button on behalf of another individual or entity, listed as the Member above, does hereby represent and warrant that such agreement is being made with full authority.<br />\r\n	<br />\r\n	2.&nbsp;&nbsp;&nbsp; APL Terms of Use<br />\r\n	<br />\r\n	2.1.&nbsp;&nbsp;&nbsp; WARNINGS OF SERIOUS LEGAL CONSEQUENCES<br />\r\n	<br />\r\n	Warning: Under these Terms of Use, if you engage in certain conduct, such as violating laws that regulate sending out and the content of bulk email, try to take advantage of us in violation of our Terms of Use by taking such actions as using our servers to host images for your website, instead of just emails you send using APL, sending out emails created using APL through another service or failing to pay an amount you owe us, we will be entitled to collect from you the higher of a pre-set amount or a multiple of your charges for one year on an annualized basis (which is a reasonable pre-estimate of the actual damages we would likely suffer from such conduct) plus attorney fees. We offer very powerful tools at a very low price. In exchange we expect our customers to act with integrity and follow our rules in order to help us maintain our reputation as having customers who only send bulk email to people who have consented to receiving them or with whom they have had a relationship from earlier selling or licensing (or negotiating to sell or license) a product or service and to not otherwise abuse our system.<br />\r\n	<br />\r\n	2.2.&nbsp;&nbsp;&nbsp; General<br />\r\n	<br />\r\n	(Applies to All Members of APL)<br />\r\n	<br />\r\n	Who We Are : &quot;APL&quot; is a trade name of Africa Business Communities B.V., a Netherlands limited liability company, that owns and operates the website with the URL: http://www.Africapresslist.com (the &quot;Website&quot;).<br />\r\n	2.2.1.&nbsp;&nbsp;&nbsp; Purpose : <br />\r\n	The purpose of these Terms of Use (this &quot;Agreement&quot;) is to set forth the terms and conditions under which you are permitted to use our email/electronic newsletter creation, distribution and management system (the &quot;Services&quot;). Any press release&nbsp; sent out is regarded as email, including but not limited to any email newsletters, sent out using the Services, are referred to herein as an &quot;Email.&quot;<br />\r\n	<br />\r\n	2.2.2.&nbsp;&nbsp;&nbsp; Changes : <br />\r\n	We reserve the right to change any of the terms of this Agreement by posting the revised Terms of Use on our Website and/or by sending an email to the last email address you have given to us. Unless the Term is terminated within ten (10) days, this new Agreement will be effective immediately with respect to any continued or new use of the Services.<br />\r\n	<br />\r\n	2.2.3.&nbsp;&nbsp;&nbsp; Eligibility : <br />\r\n	We require that any Member be at least eighteen (18) years of age. By using the Services, you represent and warrant that you are at least eighteen (18) years of age and that your use of the Services does not violate any applicable law or regulation. Your uploads may be deleted and your subscription may be terminated without warning, if we have reason to believe you are under eighteen (18) years of age.<br />\r\n	<br />\r\n	2.3.&nbsp;&nbsp;&nbsp; Charges and Payments :<br />\r\n	2.3.1.&nbsp;&nbsp;&nbsp; Annual subscription<br />\r\n	Our charges for annual subscriptions are posted on our Website and may be changed from time-to-time. Payments are due for the full year for which any part of the year is included in the &quot;Term.&quot; Payments are due for any following year on the same date, or the closest date in the year, to the date of the year you signed up with us and made your first annual payment (the &quot;Pay Date&quot;).<br />\r\n	<br />\r\n	Whenever you increase the number of credits you are using or the number of credits that you are going to use so that you are at a more expensive level, we&nbsp; require you to pay the difference in advance before the next press release is sent out.<br />\r\n	<br />\r\n	2.3.2.&nbsp;&nbsp;&nbsp; Pay-as-You-Go-Plans or Single Use<br />\r\n	&nbsp;You may elect to buy &quot; Credits&quot; to use our Services, as explained on the &quot;Costs of Use&quot; page of our website, rather than sign up for an annual subscription. If you elect a &quot;Pay-as-You-Go Plan or Single Use,&quot; you will still be considered a &quot;Member&quot; and all the terms of this Agreement will still apply to you other than the requirement that you pay us annually.<br />\r\n	<br />\r\n	2.3.3.&nbsp;&nbsp;&nbsp; Refunds<br />\r\n	&nbsp;We are required to provide a refund only if we terminate our Services to you without cause before the end of a year for which you have paid. There is no other circumstance in which you will be entitled to a refund from us. We may, at our sole discretion, offer refunds in other situations subject to any Member seeking such refund applying for the refund in accordance with the requirements we post on the website, which may be changed from time to time.<br />\r\n	<br />\r\n	2.3.4.&nbsp;&nbsp;&nbsp; Term, Termination and Removal : <br />\r\n	Either party may terminate the Term of this Agreement at any time for any reason by providing Notice to the other party. We may suspend our Services to you at any time with or without cause. We will refund a pro rata portion of your annual prepayment or reimburse you for unused Credits if we terminate you without cause. We will not refund and/or reimburse you in such manner, if there is cause, such as your using our system to send bulk Emails in inappropriate way. Once terminated, we may remove any of your electronic newsletters or other emails and related data and files from our Website and any other storage. Additionally, if you do not log in to your account for 18 or more months, we may deem your account &quot;inactive&quot; and permanently delete your account and all data associated with it.<br />\r\n	2.4.&nbsp;&nbsp;&nbsp; Account and Password : <br />\r\n	You are responsible for maintaining the confidentiality of any account name and password provided to you. You are solely responsible for uses of any account provided to you, whether or not authorized by you. You agree to immediately notify us of any unauthorized use of any account of yours.<br />\r\n	<br />\r\n	2.5.&nbsp;&nbsp;&nbsp; Proprietary Rights Owned by Us : <br />\r\n	You acknowledge that we, or our suppliers, own all proprietary rights in the Website and the software used to provide the Services, including, but not limited to, any patents, trademarks, service marks and copyrights.<br />\r\n	<br />\r\n	2.6.&nbsp;&nbsp;&nbsp; Proprietary Rights Owned by You : <br />\r\n	You represent and warrant to us that you will not add or upload any content to the Website to create an electronic mailing, or for any other purpose unless you are the owner of all proprietary rights in that content (or have been given a valid license from the owner of the proprietary rights in such content) and have obtained releases for all related privacy and publicity rights.<br />\r\n	<br />\r\n	2.7.&nbsp;&nbsp;&nbsp; General Rules : <br />\r\n	You agree to the following:<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; You will not incorporate into your Email any text, photos, graphics or other content that is not created by you, not provided by us for you to incorporate into your Email or you are not otherwise permitted to use.<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; You will not post on the Website, including in any Emails created or sent using our Services, any misleading or incorrect name, address, email address, subject line or any other misleading or incorrect information.<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; You will not publish any material that contains sexually related text, photographs or other content, or content that is defamatory, obscene, indecent, threatening, abusive or hateful.<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; You will not share your password.<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; You will not attempt to decipher, decompile, disassemble or reverse engineer any of the software comprising or in any way used or downloaded from the Website.<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; You will not include in any Emails any material, including, but not limited to, text and graphics, the inclusion of which is in violation of any other party''s rights, including, but not limited to, copyrights and privacy and publicity rights.<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; You will not set up multiple accounts for any individual, organization or entity or in order to send substantially similar content unless you are part of a franchise.<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; You will not import or incorporate into any lists, emails or uploads to our servers any of the following information: Social Security Numbers, passwords, security credentials, or sensitive personal information of any kind.<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; You will not send transactional messages through APL unless you use our Simple Transactional Service or Mandrill.<br />\r\n	<br />\r\n	2.8.&nbsp;&nbsp;&nbsp; Anti-Spam and Abuse Related Rules : You agree to the following:<br />\r\n	You should only use APL to send press releases.<br />\r\n	<br />\r\n	If you add people to the list as provided by APL please note the following.<br />\r\n	<br />\r\n	Sending your first campaign to an old list? Many recipients won''t remember you, and will report for spamming. <br />\r\n	<br />\r\n	Clean your address&nbsp; list before you import. Take out any addresses older than 6 months. Bad addresses lead to bouncebacks. Too many bouncebacks, and ISPs block APL (and you). We''ll shut your account down if you import an old list that gets too many bounces.<br />\r\n	<br />\r\n	Don''t just import your entire Outlook Address Book. Export them into a spreadsheet, then take some time to clean out bad addresses (like Sales@Amazon, or Support@Comcast). If you import even one address by mistake, that person can get you blacklisted and shut down.<br />\r\n	<br />\r\n	Before importing any list into APL from your PR-list or any other database you maintain, understand our permission-lists-only rules. <br />\r\n	<br />\r\n	2.9.&nbsp;&nbsp;&nbsp; Prohibited Content and Industries<br />\r\n	Don''t use APL to send anything offensive, to promote anything illegal, or to harass anyone. You may not send:<br />\r\n	<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; Pornography or other sexually explicit Emails<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; Emails offering to sell illegal substances<br />\r\n	<br />\r\n	Also, there are some industries that send certain types of content that result in higher than normal bounce rates and abuse complaints, which in turn jeopardize the deliverability of our entire system. No offense intended, but because we must ensure the highest delivery rates possible for all our customers, we do not allow businesses that offer these types of services, products, or content:<br />\r\n	<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; Illegal goods or services<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; Escort and dating services<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; Gambling services, products or gambling education<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; Pornography or nudity in content<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; Adult novelty items or references in content<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; List brokers or List rental services<br />\r\n	<br />\r\n	Generally speaking, if you''re in an industry that is frequently associated with spam, you know who you are (it''s probably why you''re reading this far, right?). We make no judgments about your line of business, but we cannot afford to risk our deliverability<br />\r\n	<br />\r\n	2.10.&nbsp;&nbsp;&nbsp; Who Can Use APL<br />\r\n	If you do not meet these eligibility requirements, you may not use the APL service:<br />\r\n	<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; You must be at least 18 years of age, and be able to form legally binding contracts under applicable law.<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; You must complete the registration process and agree to the terms of this Agreement. All contact information you submit must be true, complete, and up to date.<br />\r\n	<br />\r\n	APL does reserve the right to refuse service or to terminate accounts for any user, and to change eligibility requirements at any time, in its sole discretion.<br />\r\n	<br />\r\n	2.11.&nbsp;&nbsp;&nbsp; Data Archival<br />\r\n	Our servers store tons of data. Occasionally, we need to archive and/or delete some of it to make room for new data, so that we don''t have to keep raising prices in order to afford more and more servers. Here are our data archiving rules:<br />\r\n	<br />\r\n	You may not use our bandwidth for anything other than your APL press release distribution. In this regard, you agree to the following:<br />\r\n	<br />\r\n	Unlike some other email marketing services, we provide image hosting for your press release distribution totally free. This doesn''t mean you can host images on our servers for other uses, like your website. If we detect that you''re using our hosting services for anything other than your email campaigns, we have the right to delete the image. Depending on your intent, we may even replace the image with something you don''t want to see.<br />\r\n	<br />\r\n	Not to build a campaign in APL, then send it using some other delivery tool. Yeah, we can see when that happens. If you do that we may, and reserve the right to, shut your account down, replace all images in your campaign, and redirect all hyperlinks to point somewhere else. You may not like the replacement images.<br />\r\n	<br />\r\n	2.12.&nbsp;&nbsp;&nbsp; Fees, Refunds, Account Suspensions, Etc.<br />\r\n	You agree:<br />\r\n	<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; APL reserves the right to change our fees at any time by posting a new fee structure to our Website and/or sending you a notification of the change by email.<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; If a user violates any of the terms of this Agreement, we reserve the right to cancel accounts, or bar access to accounts, without refund.<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; If, for some reason, we are unable to process your PayPal order, we will attempt to contact you by email and we will suspend usage of your account until your payment can be processed.<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; You agree to pay for all emails you send to your personal additions to mail lists from your account, even if messages are blocked by any third party (we have no control over your recipients'' email servers, ISP availability, personal spam filter settings, etc)<br />\r\n	&bull;&nbsp;&nbsp;&nbsp; For pay-as-you-go (prepaid) accounts, your email credits &quot;roll over&quot; and do not expire. However, if you do not log in to your account at least once for 18 months, your account (including all campaigns, lists, and other data) may be deleted permanently from our system.<br />\r\n	<br />\r\n	<br />\r\n	It''s in our best interest to keep our system clean, because our reputation and deliverability depends on it. <br />\r\n	So here''s what we do:<br />\r\n	<br />\r\n	2.12.1.&nbsp;&nbsp;&nbsp; Right to Review Email Campaigns<br />\r\n	We, including our employees and independent contractors, are permitted to copy and transmit copies of the content from your email campaigns to develop algorithms, heuristics and computer programs (&quot;Tools&quot;) to help us more efficiently spot problem accounts and to use such Tools, together with personal viewing by employees and or independent contractors, to uncover Members who violate either these Terms of Use or applicable law.<br />\r\n	<br />\r\n	<br />\r\n	2.12.2.&nbsp;&nbsp;&nbsp; Reporting Abuse<br />\r\n	We take abuse reports seriously at APL. If you''ve notice abuse that you think came from a APL user, we want to hear about it. <br />\r\n	<br />\r\n	If the campaign you received does not contain a CID, it didn''t come from APL. It was probably just spoofed to look like it came from APL (something that inevitably happens to everyone online). Learn more about spoofing.<br />\r\n	<br />\r\n	2.13.&nbsp;&nbsp;&nbsp; No Warranties : <br />\r\n	to the maximum extent permitted by law, the material on this website and the services (including all content, software, functions, services, materials and information made available herein or accessed by means hereof) are provided as is, without warranties of any kind, either express or implied, including but not limited to, warranties of merchantability and fitness for a particular purpose.<br />\r\n	<br />\r\n	2.13.1.&nbsp;&nbsp;&nbsp; Limitation of Liability : <br />\r\n	to the maximum extent permitted by law, you assume full responsibility and risk of loss resulting from your use of the website and the services including any downloads from the website. under no circumstances shall we or any of our employees or representatives be liable for any indirect, punitive, special or consequential damages even if we or any of our employees or representatives have been advised of the possibility of such damages. our total liability in any event is limited to the amount, if any, actually paid by you for use of the website and the services for the one month period ending on the date a claim is made and you hereby release us and our employees and representatives from any and all obligations, liabilities and claims in excess of this limitation.<br />\r\n	<br />\r\n	2.13.2.&nbsp;&nbsp;&nbsp; Indemnity : <br />\r\n	You agree to indemnify and hold us, and our directors, officers, employees and representatives, harmless from any and all losses (including, but not limited to, attorney fees) resulting from any claims not permitted under this Agreement due to a &quot;Limitation of Liability&quot; or other provision, that you assert, or may assert, based on or relating to your use, or the use of any individual using your password, of this Website or the Services. You further agree to indemnify and hold us, and our directors, officers, employees and representatives, harmless from any and all losses resulting from claims of third parties, including, but not limited to, attorney fees, that result in whole or in part from allegations of conduct by you that, if true, would constitute a violation by you, or any individual using your password, of any of the terms of this Agreement.<br />\r\n	<br />\r\n	2.13.3.&nbsp;&nbsp;&nbsp; Liquidated Damages : <br />\r\n	The parties agree that we may recover liquidated damages, in lieu of any other damages that may have been recoverable, for certain types of breaches of these Terms of Use, which we refer to as &quot;Abusive Conduct.&quot; Liquidated damages are being made available for specified situations in which proving the actual damages would likely be impossible. The liquidated damages are being set at a reasonable pre-estimate of the damages that would be incurred as a result of the particular type of breach. The particular type of breaches that constitute Abusive Conduct, and the liquidated damages for each type are as follows:<br />\r\n	<br />\r\n	Abusive Conduct&nbsp;&nbsp;&nbsp; Liquidated Damages<br />\r\n	(a) violations of provisions of this Agreement designed to protect APL from its users taking actions to use APL''s resources in a way not permitted hereunder such as using our Services to host images other than for Emails you send out using the Services such as for your website; or sending out any Emails created using the Services, other than via the Services. Four times the total of our then annual charges&nbsp; but not less than $5.000,-.<br />\r\n	(b) not paying an amount due within ten (10) days after a demand by us. Three times the total of our then annual charges&nbsp; but not less than $4.000 in addition to the sum owed<br />\r\n	<br />\r\n	2.13.4.&nbsp;&nbsp;&nbsp; Attorney Fees : <br />\r\n	In the event we file an action against you claiming you breached this Agreement and seeking to recover liquidated damage and/or other relief, and we prevail, we shall be entitled to recover reasonable attorney''s fees in addition to any damages or other relief which we may be awarded.<br />\r\n	Disclaimers : We disclaim and are not responsible for the behavior of any advertisers, linked websites or other users.<br />\r\n	<br />\r\n	&nbsp;<br />\r\n	2.14.&nbsp;&nbsp;&nbsp; Reporting Violations : <br />\r\n	If you become aware that any other person is violating any of the terms and conditions of this Website, please notify us immediately. If you believe that any person has posted material in violation of any copyrights that you may have, you may notify us in accordance with our Copyright Policy. If you believe that any user of this Website has posted materials in violation of any other rights that you may have, you may notify us in accordance with our Removal Policy.<br />\r\n	<br />\r\n	2.15.&nbsp;&nbsp;&nbsp; Assignments : <br />\r\n	You may not assign any of your rights hereunder. We may assign all rights to any other individual or entity at our discretion.<br />\r\n	<br />\r\n	2.16.&nbsp;&nbsp;&nbsp; Compliance With Law (general) : <br />\r\n	In using the Services, you agree that you will comply with all applicable laws.<br />\r\n	Applicable Law and Jurisdiction : This Agreement will be governed by the laws of the Netherlands. Except as otherwise provided in this Section below, each of the parties does hereby agree that any dispute related to this Agreement, any other agreement between the parties, the Privacy Policy or the Services, will be decided by the state and federal courts located in Amsterdam or Haarlem, The Netherlands and agrees that that party is subject to the jurisdiction of such courts in such locality. <br />\r\n	<br />\r\n	<br />\r\n	2.17.&nbsp;&nbsp;&nbsp; Compliance With Law (EEA) : <br />\r\n	<br />\r\n	(Applies to All Members to the extent they Use APL to Send Any Press release&nbsp; of Email to Residents of the European Economic Area (&quot;EEA&quot;) Which Is Composed of the Members of the European Union (&quot;EU&quot;) Together with Iceland, Norway and Liechtenstein)<br />\r\n	<br />\r\n	2.17.1.&nbsp;&nbsp;&nbsp; Warranties of Compliance<br />\r\n	You represent and warrant that in compiling your Email distribution list, sending Emails via the APL Services and collecting information as a result of individuals visiting your website or otherwise, with respect to your customers and potential customers who reside in the EEA, you:<br />\r\n	(a) Will have clearly described, and will continue to clearly describe, in writing how you intend to use any data collected, including for sending Emails if you obtain express consent from your customers and potential customers to use the data in that manner, and include an express consent to transfer the data to APL as part of this process, and otherwise comply with whatever privacy policy you have posted.<br />\r\n	(b) Represent and warrant that you have complied, and will comply, with all data protection and privacy laws and regulations applicable to the countries in which you are sending any form of email via APL including, for example, with respect to the United Kingdom, the Data Protection Act, and the regulations relating to the European Union Privacy and Electronic Communications Directive. In this regard, you represent and warrant that you have collected, stored, used and transferred all data relating to any individual in accordance with all data protection laws and regulations relating to the country in which such individual resides and obtained all necessary consents to enable APL to receive and process that data and forward communications to that individual on your behalf.<br />\r\n	<br />\r\n	You further agree to indemnify and hold us harmless from any losses, including attorney fees, resulting from your breach of any part of the foregoing warranties.<br />\r\n	<br />\r\n	(Additional Provisions Applicable to All Members)<br />\r\n	<br />\r\n	2.18.&nbsp;&nbsp;&nbsp; Miscellaneous<br />\r\n	2.18.1.&nbsp;&nbsp;&nbsp; Force Majeure : <br />\r\n	We shall not be held liable for any delay or failure in performance of any part of this Agreement from any cause beyond our control and without our fault or negligence, such as acts of God, acts of civil or military authority, then current laws and regulations and changes thereto, embargoes, epidemics, war, terrorist acts, riots, insurrections, fires, explosions, earthquakes, nuclear accidents, floods, strikes, power blackouts, volcanic action, other major environmental disturbances, unusually severe weather conditions, acts of hackers and other illegal activities of third parties, inability to secure products or services of other persons or transportation facilities, or acts or omissions of transportation or telecommunications common carriers or overloading or slow downs over the internet or any third party internet service providers.<br />\r\n	<br />\r\n	2.18.2.&nbsp;&nbsp;&nbsp; Survivability : <br />\r\n	The ownership and proprietary rights provisions set forth in this Agreement, and any other provisions that by their sense and context the parties intend to have survive, shall survive the termination of this Agreement for any reason.<br />\r\n	<br />\r\n	2.18.3.&nbsp;&nbsp;&nbsp; Severability : <br />\r\n	The unenforceability or invalidity of any term, provision, section or subsection of this Agreement shall not affect the validity or enforceability of any remaining terms, provisions, sections or subsections of this Agreement, but such remaining terms, provisions, sections or subsections shall be interpreted and construed in such a manner as to carry out fully the intention of the parties hereto.<br />\r\n	<br />\r\n	2.18.4.&nbsp;&nbsp;&nbsp; Interpretation : <br />\r\n	The fact of authorship by or at the behest of a party shall not affect the construction or interpretation of this Agreement.<br />\r\n	<br />\r\n	2.18.5.&nbsp;&nbsp;&nbsp; Amendments : <br />\r\n	No amendment or other change of this Agreement shall be effective except as either expressly permitted under these Terms of Use or agreed to in writing between the parties. Notwithstanding the foregoing, additional terms may be required for certain features of the Service (the &quot;Additional Terms.&quot;) The Additional Terms shall be considered incorporated into this Agreement at the time the feature is activated by you. Where there is a conflict between these Terms and the Additional Terms the Additional Terms shall control.<br />\r\n	<br />\r\n	No amendment or other change of this Agreement shall be effective unless and until the revised Agreement is posted by us on the Website.<br />\r\n	2.18.6.&nbsp;&nbsp;&nbsp; Privacy Policy : <br />\r\n	You agree that we may access, collect, use and disclose your information as set forth in our Privacy Policy. In this regard the terms of the Privacy Policy are to be treated as if they were added to and part of this Agreement and shall be binding on all parties hereto.<br />\r\n	<br />\r\n	2.18.7.&nbsp;&nbsp;&nbsp; Further Actions : <br />\r\n	You agree to execute any and all documents and take any other actions reasonably required to effectuate the purposes of this Agreement.<br />\r\n	<br />\r\n	2.18.8.&nbsp;&nbsp;&nbsp; Notification of Security Breach : <br />\r\n	<br />\r\n	In the event of a security breach that may affect you, or individuals listed on one or more of your Email distribution lists (each a &quot;List&quot;), we will notify you of the breach and provide a description. In the event we reasonably determine, and notify you, that it is necessary for all or part of such information to be forwarded on to individuals on one or more of your Lists, you will promptly forward such information to the individuals on such List or Lists.<br />\r\n	<br />\r\n	2.18.9.&nbsp;&nbsp;&nbsp; No Changes in Agreement at Request of Member : <br />\r\n	Because of our huge number of Members, we cannot, as a practical matter, change this Agreement for any one Member or group of Members. If we did that, keeping up with the changes alone would be a logistical nightmare. In addition one reason we are able to offer one of the most powerful press release distribution and management systems at a low price is that we are able to use this Agreement to reduce our financial risks.<br />\r\n	<br />\r\n	2.18.10.&nbsp;&nbsp;&nbsp; Entire Agreement : <br />\r\n	The terms of the Privacy Policy posted on this Website are incorporated by reference herein. This Agreement, including such policy which is incorporated by reference herein, embody the entire agreement and understanding of the parties, and supersedes all prior agreements, representations and understandings between the parties hereto, relating to the subject matter hereof.<br />\r\n	&nbsp;</p>\r\n', 30, 21, '2012-01-18 08:27:20'),
(26, 'Register', 'register', 8, NULL, 'Register with the Africa Press list', 'register-with-the-africa-press-list', 30, '-', 'Offline', '<p>\r\n	<img align="right" alt="" height="212" src="/uploads/signup-logo.png" width="267" />Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. ium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. <br />\r\n	<br />\r\n	Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet.</p>\r\n<p>\r\n	<br />\r\n	&nbsp;</p>\r\n<table border="0" cellpadding="0" cellspacing="0" style="width: 885px;">\r\n	<tbody>\r\n		<tr>\r\n			<td width="279">\r\n				<img align="bottom" alt="" height="74" src="/uploads/freelancer-icon.png" width="279" /></td>\r\n			<td style="padding-left: 30px;" width="279">\r\n				<img align="bottom" alt="" height="88" src="/uploads/publisher-icon.png" width="274" /></td>\r\n			<td style="padding-left: 30px;">\r\n				<img align="bottom" alt="" height="88" src="/uploads/blogger-icon.png" width="274" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</td>\r\n			<td style="padding-left: 30px;">\r\n				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</td>\r\n			<td style="padding-left: 30px;">\r\n				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="text-align: center;">\r\n				<p>\r\n					<br />\r\n					<a href="/en/p/freelancer.html?jour_type=Freelancer"><img align="" alt="" height="32" src="/uploads/register-bar.png" width="179" /></a></p>\r\n			</td>\r\n			<td style="text-align: center; padding-left:30px;">\r\n				<a href="/en/p/publisher.html?jour_type=Company"><img align="" alt="" height="32" src="/uploads/register-bar.png" width="179" /></a></td>\r\n			<td style="text-align: center; padding-left:30px;">\r\n				<a href="/en/p/blogger.html?jour_type=Blogger"><img align="" alt="" height="32" src="/uploads/register-bar.png" width="179" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="text-align: center;">\r\n				<img alt="" height="12" src="/uploads/underline.png" width="268" /></td>\r\n			<td style="padding-left:30px; text-align: center;">\r\n				<img alt="" height="12" src="/uploads/underline.png" width="268" /></td>\r\n			<td style="padding-left:30px; text-align: center;">\r\n				<img alt="" height="12" src="/uploads/underline.png" width="268" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 30, 23, '2012-02-22 13:22:55'),
(27, 'How to use', 'how-to-use', 8, NULL, 'How to use the Africa Press List', 'how-to-use-the-africa-press-list', 10, '-', 'Online', '<table border="0" cellpadding="0" cellspacing="0" style="width: 925px;">\r\n	<tbody>\r\n		<tr>\r\n			<td width="510px">\r\n				&nbsp;</td>\r\n			<td width="20px">\r\n				&nbsp;</td>\r\n			<td style="font-size:18px;" width="395px">\r\n				<br />\r\n				&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom-width: 1px; border-bottom-style: solid;" valign="top">\r\n				<h2>\r\n					<b>My dashboard</b></h2>\r\n				<p>\r\n					The My Dashboard page is your default landing page after you login to the Africa Press List.<br />\r\n					<br />\r\n					The dashboard page is divided into 4 blocks, from here you can start a search for contacts right away, or edit your personal or company information.<br />\r\n					The account statistics page will give you an overview of all your credits options.<br />\r\n					&nbsp;</p>\r\n			</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;">\r\n				&nbsp;</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;" valign="top">\r\n				<center>\r\n					My Dashboard</center>\r\n				<a href="/uploads/my_dashboard.jpg" target="_blank"><img alt="" height="229" src="/uploads/my_dashboard_small.jpg" width="395" /></a>\r\n				<p style="font-size:11px;">\r\n					Click on image to enlarge</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="510px">\r\n				<b><br />\r\n				</b><br />\r\n				&nbsp;</td>\r\n			<td width="20px">\r\n				&nbsp;</td>\r\n			<td style="font-size:18px;" width="395px">\r\n				&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom:solid 1px #c5c5c5;" valign="top">\r\n				<h2>\r\n					<b>Buy credits</b></h2>\r\n				<p>\r\n					Upgrade your account via PayPal, this will upgrade to a full Pan African Account <br />\r\n					( 1 year extension )</p>\r\n				<p>\r\n					Get credits, select the package you would like to buy, after clicking the buy credits button you will be redirected to PayPal.</p>\r\n				<p>\r\n					My financials will give you an overview of the credits used per mailing, as well as a total amount of credits spent.<br />\r\n					&nbsp;</p>\r\n			</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;">\r\n				&nbsp;</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;" valign="top">\r\n				<center>\r\n					Credits / Overview</center>\r\n				<a href="/uploads/1_1_buy_credits.jpg" target="_blank"><img alt="" height="229" src="/uploads/1_1_buy_credits_small.jpg" width="395" /></a>\r\n				<p style="font-size:11px;">\r\n					Click on image to enlarge</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="510px">\r\n				<b><br />\r\n				</b><br />\r\n				&nbsp;</td>\r\n			<td width="20px">\r\n				&nbsp;</td>\r\n			<td style="font-size:18px;" width="395px">\r\n				<br />\r\n				&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom:solid 1px #c5c5c5;" valign="top">\r\n				<h2>\r\n					<b>Search</b></h2>\r\n				<p>\r\n					The search function gives you the option to search by country, field of interest, language, region, position of journalists and mediatypes.<br />\r\n					<br />\r\n					After you click the search button you will be presented with the results of your search.<br />\r\n					<br />\r\n					The contacts in the search results are grouped under their respective companies or job types, this makes it easier to select, de-select, or later on edit groups of contacts.</p>\r\n				<p>\r\n					Now you have found your contacts, it''s time to organise them and group them into contact lists in the next step.<br />\r\n					&nbsp;</p>\r\n			</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;">\r\n				&nbsp;</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;" valign="top">\r\n				<center>\r\n					Search</center>\r\n				<a href="/uploads/1_search(1).jpg" target="_blank"><img alt="" height="229" src="/uploads/step1.jpg" width="395" /></a>\r\n				<p style="font-size:11px;">\r\n					Click on image to enlarge</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="510px">\r\n				<br />\r\n				&nbsp; <br />\r\n				&nbsp;</td>\r\n			<td width="20px">\r\n				&nbsp;</td>\r\n			<td style="font-size:18px;" width="395px">\r\n				<br />\r\n				&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom:solid 1px #c5c5c5;" valign="top">\r\n				<h2>\r\n					<b>Create contact list(s)</b></h2>\r\n				<p>\r\n					Contact lists help you to organise contacts by grouping them together. Making a specific contact list for your mailing, helps you in better targeting your audience.<br />\r\n					<br />\r\n					Creating contact lists is organising mail addresses for your convenience, it will not cost you credits and the system will not send them out unless you use these contact lists in a press release.<br />\r\n					<br />\r\n					<em>Example: You want to send out a mailing to all people working in sports who speak or publish in french.</em><br />\r\n					<br />\r\n					First you complete the search with those specific filters.<br />\r\n					category : Sports | language : French and leave the other filters as they are.</p>\r\n				<p>\r\n					When the search results show up you can select the people you would like to include in your list and then add them to a new contact list named &ldquo;Sports people French&rdquo; or something similar.<br />\r\n					<br />\r\n					The newly created contact list can be found by clicking on the my contact list button above the search options. You can later edit this contact list by adding or deleting people.<br />\r\n					<br />\r\n					Let''s examine the tools for creating a contact list.&nbsp;This screen shows the search result after a search, besides the search results a new toolbar shows up, this is where you create the contactlist(s).<br />\r\n					<br />\r\n					To free up some screen space, and make more room for the search results and contactlist creation you can hide the search options if you like.<br />\r\n					<br />\r\n					Now for the rest of the tools.&nbsp;This screen shows the various ways of selecting and filtering the search results.<br />\r\n					<br />\r\n					The checkboxes to the left of the category and names let you select an entire category of people or select individual contacts.</p>\r\n			</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;">\r\n				&nbsp;</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;" valign="top">\r\n				<center>\r\n					Search results</center>\r\n				<a href="/uploads/2_search_results.jpg" target="_blank"><img alt="" height="228" src="/uploads/step2.jpg" width="395" /></a>\r\n				<p style="font-size:11px;">\r\n					Click on image to enlarge</p>\r\n				<center>\r\n					Selection buttons</center>\r\n				<a href="/uploads/3_selection_buttons.jpg" target="_blank"><img alt="" height="228" src="/uploads/step3.jpg" width="395" /></a>\r\n				<p style="font-size:11px;">\r\n					Click on image to enlarge</p>\r\n				<center>\r\n					Create list</center>\r\n				<a href="/uploads/4_create_list.jpg" target="_blank"><img alt="" height="228" src="/uploads/step4.jpg" width="395" /></a>\r\n				<p style="font-size:11px;">\r\n					Click on image to enlarge</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="510px">\r\n				<b><br />\r\n				</b><br />\r\n				&nbsp;</td>\r\n			<td width="20px">\r\n				&nbsp;</td>\r\n			<td style="font-size:18px;" width="395px">\r\n				<br />\r\n				&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom:solid 1px #c5c5c5;" valign="top">\r\n				<h2>\r\n					<b>New press release</b></h2>\r\n				<p>\r\n					Sender and reply account settings<br />\r\n					Tips on how to write a successful press-release, <a href="/en/p/tips-to-write.html"><i>click here</i></a>.<br />\r\n					&nbsp;</p>\r\n			</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;">\r\n				&nbsp;</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;" valign="top">\r\n				&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="510px">\r\n				<p>\r\n					<strong><br />\r\n					</strong></p>\r\n				<p>\r\n					<strong><br />\r\n					<br />\r\n					</strong></p>\r\n			</td>\r\n			<td width="20px">\r\n				&nbsp;</td>\r\n			<td>\r\n				<br />\r\n				&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom-width: 1px; border-bottom-style: solid;" valign="top">\r\n				<h2>\r\n					<strong>My press release</strong></h2>\r\n				<p>\r\n					The &quot;My Press Release&quot; page gives you an overview of all your press releases, they are seperated into several statuses.<br />\r\n					<strong><br />\r\n					<u>New</u></strong><br />\r\n					Create a new press release<br />\r\n					<br />\r\n					<strong><u>Scheduled</u></strong><br />\r\n					All press releases waiting in queue that will be sent out on a specific date.<br />\r\n					<br />\r\n					<strong><u>Draft</u></strong><br />\r\n					All press releases that are not scheduled, waiting for further adjustments.&nbsp;You can edit a draft release by clicking on its name, you can then make edits and save it as a draft again, or change the publication type and send out the press release.<br />\r\n					<br />\r\n					<strong><u>Sent releases</u></strong><br />\r\n					Sent releases shows you a list of all sent releases with a status.<br />\r\n					<strong><u><br />\r\n					Status completed</u></strong><br />\r\n					The press release was sent out successfully, you can see the statistics of this release by clicking on the name.&nbsp;The newly opened page will show you when it was sent out, how many contacts where mailed and shows you a map of Africa with views per country.&nbsp;Here you can also download the press release as en .eml file.<br />\r\n					<strong><u><br />\r\n					Status failed</u></strong><br />\r\n					Something obviously went wrong sending this press release.&nbsp;Click on the name of the press release that failed to see more details about the error.&nbsp;Some errors are self explanatory for example:</p>\r\n				<ul>\r\n					<li>\r\n						failed (global_error: Zero contacts were mailed.)</li>\r\n				</ul>\r\n				<p>\r\n					This one can simply be solved by editing this release, including a contactlist with your press release, and then re-sending it.<br />\r\n					<br />\r\n					&nbsp;</p>\r\n			</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;">\r\n				&nbsp;</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;" valign="top">\r\n				<center>\r\n					My press release</center>\r\n				<a href="/uploads/3_1_my_pressrelease.jpg" target="_blank"><img alt="" height="228" src="/uploads/3_1_my_pressrelease-small.jpg" width="395" /></a>\r\n				<p style="font-size:11px;">\r\n					Click on image to enlarge</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom:solid 1px #c5c5c5;" valign="top">\r\n				<br />\r\n				For more complicated errors, further guidance or assistance <a href="/en/p/contact-us.html"><i>contact us here</i></a><br />\r\n				&nbsp;</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;" valign="top">\r\n				&nbsp;</td>\r\n			<td style="border-bottom:solid 1px #c5c5c5;" valign="top">\r\n				&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', 30, 24, '2012-02-23 12:47:08');
INSERT INTO `web_menu` (`menu_id`, `menu_title`, `menu_title_c`, `menu_parent`, `menu_path`, `menu_header`, `menu_header_c`, `menu_order`, `menu_type`, `menu_online`, `menu_content`, `menu_lang_country`, `menu_lang_group`, `menu_added`) VALUES
(28, 'Tips to write a press-release old', 'tips-to-write-a-press-release-old', 8, NULL, 'Tip to write a press-release', 'tip-to-write-a-press-release', 30, 'videos_overview', 'Offline', '<h2>\r\n	<strong>How to write a press-release<br />\r\n	<br />\r\n	</strong></h2>\r\n<table border="0" cellpadding="3" cellspacing="3" style="width: 100%;">\r\n	<tbody>\r\n		<tr>\r\n			<td style="border-bottom:solid 1px #000" width="66%">\r\n				<strong>Write the headline</strong>. <br />\r\n				It should be brief, clear and to the point: an ultra-compact version of the press releases key point.<br />\r\n				<br />\r\n				<ul>\r\n					<li>\r\n						News release headlines should have a &quot;grabber&quot; to attract readers, i.e., journalists, just as a newspaper headline is meant to grab readers. It may describe the latest achievement of an organization, a recent newsworthy event, a new product or service. For example, &quot;XYZ Co. enters strategic partnership with ABC Co. in India &amp; United States.&quot;<br />\r\n						&nbsp;</li>\r\n					<li>\r\n						Headlines are written in bold and are typically larger than the press release text. Conventional press release headlines are present-tense and exclude &quot;a&quot; and &quot;the&quot; as well as forms of the verb &quot;to be&quot; in certain contexts.<br />\r\n						&nbsp;</li>\r\n					<li>\r\n						The first word in the press release headline should be capitalized, as should all proper nouns. Most headline words appear in lower-case letters, although adding a stylized &quot;small caps&quot; style can create a more graphically news-attractive look and feel. Do not capitalize every word.<br />\r\n						&nbsp;</li>\r\n					<li>\r\n						The simplest method to arrive at the press release headline is to extract the most important keywords from your press release. Now from these keywords, try to frame a logical and attention-getting statement. Using keywords will give you better visibility in search engines, and it will be simpler for journalists and readers to get the idea of the press release content.</li>\r\n				</ul>\r\n			</td>\r\n			<td style="border:solid 1px #000">\r\n				<h1 style="text-align: center;">\r\n					&nbsp;STEP 1</h1>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom:solid 1px #000" width="66%">\r\n				<br />\r\n				<strong>Write the press release body copy. </strong><br />\r\n				The press release should be written as you want it to appear in a news story.<br />\r\n				<ul>\r\n					<li>\r\n						Start with the date and city in which the press release is originated. The city may be omitted if it will be confusing, for example if the release is written in New York about events in the company''s Chicago division.</li>\r\n					<li>\r\n						The lead, or first sentence, should grab the reader and say concisely what is happening. The next 1-2 sentences then expand upon the lead.</li>\r\n					<li>\r\n						The press release <b>body copy</b> should be compact. Avoid using very long sentences and paragraphs. Avoid repetition and over use of fancy language and jargon.</li>\r\n					<li>\r\n						A first paragraph (two to three sentences) must actually sum up the press release and the further content must elaborate it. In a fast-paced world, neither journalists nor other readers would read the entire press release if the start of the article didn''t generate interest.</li>\r\n					<li>\r\n						Deal with actual facts - events, products, services, people, targets, goals, plans, projects. Try to provide maximum use of concrete facts. A simple method for writing an effective press release is to make a list of following things:</li>\r\n				</ul>\r\n			</td>\r\n			<td style="border:solid 1px #000">\r\n				<h1 style="text-align: center;">\r\n					&nbsp;STEP 2</h1>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom:solid 1px #000" width="66%">\r\n				<p>\r\n					<br />\r\n					<strong>Communicate the 5 Ws and the H. </strong><br />\r\n					Who, what, when, where, why, and how. Then consider the points below if pertinent.<br />\r\n					&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <em>What is the actual news?<br />\r\n					&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Why this is news.<br />\r\n					&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; The people, products, items, dates and other things related with the news.<br />\r\n					&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; The purpose behind the news.<br />\r\n					&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Your company - the source of this news.</em><br />\r\n					&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <br />\r\n					Now from the points gathered, try to construct paragraphs and assemble them sequentially: The headline &gt; the summary or introduction of the news &gt; event or achievements &gt; product &gt; people &gt; again the concluding summary &gt; the company.<br />\r\n					<br />\r\n					The length of a press release should be no more than three pages. If you are sending a hard copy, text should be double-spaced.<br />\r\n					&nbsp;<br />\r\n					The more newsworthy you make the press release copy, the better the chances of it being selected by a journalist for reporting. Find out what &quot;newsworthy&quot; means to a given market and use it to hook the editor or reporter.</p>\r\n			</td>\r\n			<td style="border:solid 1px #000">\r\n				<h1 style="text-align: center;">\r\n					&nbsp;STEP 3</h1>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom:solid 1px #000" width="66%">\r\n				<strong>Include information about the company. </strong><br />\r\n				When a journalist picks up your press release for a story, he/she would logically have to mention the company in the news article. Journalists can then get the company information from this section.?<br />\r\n				&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <br />\r\n				<ul>\r\n					<li>\r\n						The title for this section should be - About XYZ_COMPANY</li>\r\n					<li>\r\n						After the title, use a paragraph or two to describe your company with 5/6 lines each. The text must describe your company, its core business and the business policy. Many businesses already have professionally written brochures, presentations, business plans, etc. - that introductory text can be put here.</li>\r\n					<li>\r\n						At the end of this section, point to your website. The link should be the exact and complete URL without any embedding so that, even if this page is printed, the link will be printed as it is. For example: <a class="external free" href="http://www.your_company_website.com/" rel="nofollow" title="http://www.your_company_website.com">http://www.your_company_website.com</a>. Companies which maintain a separate media page on their websites must point to that URL here. A media page typically has contact information and press kits.</li>\r\n				</ul>\r\n			</td>\r\n			<td style="border:solid 1px #000">\r\n				<h1 style="text-align: center;">\r\n					&nbsp;STEP 4</h1>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom:solid 1px #000" width="66%">\r\n				<strong>Tie it together. </strong><br />\r\n				Provide some extra information links that support your press release.</td>\r\n			<td style="border:solid 1px #000">\r\n				<h1 style="text-align: center;">\r\n					&nbsp;STEP 5</h1>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom:solid 1px #000" width="66%">\r\n				<strong>Add contact information.</strong><br />\r\n				If your press release is really newsworthy, journalists would surely like more information or would like to interview key people associated with it.?<br />\r\n				<br />\r\n				If you are comfortable with the idea of letting your key people be contacted directly by media, you can provide their contact details on the press release page itself. For example, in case of some innovation, you can provide the contact information of your engineering or research team for the media.<br />\r\n				Otherwise, you must provide the details of your media/PR department in the &quot;Contact&quot; section. If you do not have dedicated team for this function, you must appoint somebody who will act as a link between the media and your people.<br />\r\n				<br />\r\n				The contact details must be limited and specific only to the current press release. The contact details must include:<br />\r\n				&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <em>The Company''s Official Name<br />\r\n				<br />\r\n				&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Media Department''s official Name and Contact Person<br />\r\n				<br />\r\n				&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Office Address<br />\r\n				<br />\r\n				&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Telephone and fax Numbers with proper country/city codes and extension numbers<br />\r\n				<br />\r\n				&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Mobile Phone Number (optional)<br />\r\n				<br />\r\n				&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Timings of availability<br />\r\n				<br />\r\n				&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; E-mail Addresses<br />\r\n				<br />\r\n				&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Web site Address</em></td>\r\n			<td style="border:solid 1px #000">\r\n				<h1 style="text-align: center;">\r\n					&nbsp;STEP 6</h1>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="border-bottom:solid 1px #000" width="66%">\r\n				<b class="whb">Signal the end of the press release with three # symbols, centered directly underneath the last line of the release</b>. <br />\r\n				This is a journalistic standard.</td>\r\n			<td style="border:solid 1px #000">\r\n				<h1 style="text-align: center;">\r\n					&nbsp;STEP 7</h1>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	(source wikihow.com)<br />\r\n	&nbsp;</p>\r\n', 30, 22, '2012-03-07 12:33:11'),
(31, 'Tips to write', 'tips-to-write', 8, NULL, 'Tips to write a press-release', 'tips-to-write-a-press-release', 243, '-', 'Online', '<p>\r\n	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> <script src="http://code.jquery.com/jquery-latest.js"></script><style type="text/css">\r\n.stepList .stepFull { display: none; margin-bottom: 10px; font-size: 14px;}\r\n.stepList .stepTitle { cursor: pointer; margin-bottom: 10px; font-size: 14px;}\r\n.stepList { width: 600px; }\r\n.readmorebutton { font-style:italic; font-size: 11px; }\r\n</style></p>\r\n<table border="0" cellpadding="0" cellspacing="0" width="920">\r\n	<tbody>\r\n		<tr>\r\n			<td width="630px">\r\n				<ol class="stepList">\r\n					<li>\r\n						<div class="stepTitle">\r\n							<b>Write the headline</b> <br />\r\n							<div class="readmorebutton">\r\n								...read more</div>\r\n						</div>\r\n						<div class="stepFull">\r\n							It should be brief, clear and to the point: an ultra-compact version of the press releases key point.<br />\r\n							<br />\r\n							<ul>\r\n								<li>\r\n									News release headlines should have a &quot;grabber&quot; to attract readers, i.e., journalists, just as a newspaper headline is meant to grab readers. It may describe the latest achievement of an organization, a recent newsworthy event, a new product or service. For example, &quot;XYZ Co. enters strategic partnership with ABC Co. in India &amp; United States.&quot;<br />\r\n									&nbsp;</li>\r\n								<li>\r\n									Headlines are written in bold and are typically larger than the press release text. Conventional press release headlines are present-tense and exclude &quot;a&quot; and &quot;the&quot; as well as forms of the verb &quot;to be&quot; in certain contexts.<br />\r\n									&nbsp;</li>\r\n								<li>\r\n									The first word in the press release headline should be capitalized, as should all proper nouns. Most headline words appear in lower-case letters, although adding a stylized &quot;small caps&quot; style can create a more graphically news-attractive look and feel. Do not capitalize every word.<br />\r\n									&nbsp;</li>\r\n								<li>\r\n									The simplest method to arrive at the press release headline is to extract the most important keywords from your press release. Now from these keywords, try to frame a logical and attention-getting statement. Using keywords will give you better visibility in search engines, and it will be simpler for journalists and readers to get the idea of the press release content.<br />\r\n									&nbsp;</li>\r\n							</ul>\r\n						</div>\r\n					</li>\r\n					<li>\r\n						<div class="stepTitle">\r\n							<strong>Write the press release body copy</strong><br />\r\n							<div class="readmorebutton">\r\n								...read more</div>\r\n						</div>\r\n						<div class="stepFull">\r\n							The press release should be written as you want it to appear in a news story.<br />\r\n							<ul>\r\n								<li>\r\n									Start with the date and city in which the press release is originated. The city may be omitted if it will be confusing, for example if the release is written in New York about events in the company''s Chicago division.</li>\r\n								<li>\r\n									The lead, or first sentence, should grab the reader and say concisely what is happening. The next 1-2 sentences then expand upon the lead.</li>\r\n								<li>\r\n									The press release <b>body copy</b> should be compact. Avoid using very long sentences and paragraphs. Avoid repetition and over use of fancy language and jargon.</li>\r\n								<li>\r\n									A first paragraph (two to three sentences) must actually sum up the press release and the further content must elaborate it. In a fast-paced world, neither journalists nor other readers would read the entire press release if the start of the article didn''t generate interest.</li>\r\n								<li>\r\n									Deal with actual facts - events, products, services, people, targets, goals, plans, projects. Try to provide maximum use of concrete facts. A simple method for writing an effective press release is to make a list of following things:<br />\r\n									&nbsp;</li>\r\n							</ul>\r\n						</div>\r\n					</li>\r\n					<li>\r\n						<div class="stepTitle">\r\n							<strong>Communicate the 5 Ws and the H </strong><br />\r\n							<div class="readmorebutton">\r\n								...read more</div>\r\n						</div>\r\n						<div class="stepFull">\r\n							Who, what, when, where, why, and how. Then consider the points below if pertinent.<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <em>What is the actual news?<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Why this is news.<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; The people, products, items, dates and other things related with the news.<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; The purpose behind the news.<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Your company - the source of this news.</em><br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <br />\r\n							Now from the points gathered, try to construct paragraphs and assemble them sequentially: The headline &gt; the summary or introduction of the news &gt; event or achievements &gt; product &gt; people &gt; again the concluding summary &gt; the company.<br />\r\n							<br />\r\n							The length of a press release should be no more than three pages. If you are sending a hard copy, text should be double-spaced.<br />\r\n							&nbsp;<br />\r\n							The more newsworthy you make the press release copy, the better the chances of it being selected by a journalist for reporting. Find out what &quot;newsworthy&quot; means to a given market and use it to hook the editor or reporter.<br />\r\n							&nbsp;</div>\r\n					</li>\r\n					<li>\r\n						<div class="stepTitle">\r\n							<strong>Include information about the company </strong><br />\r\n							<div class="readmorebutton">\r\n								...read more</div>\r\n						</div>\r\n						<div class="stepFull">\r\n							When a journalist picks up your press release for a story, he/she would logically have to mention the company in the news article. Journalists can then get the company information from this section.?<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <br />\r\n							<ul>\r\n								<li>\r\n									The title for this section should be - About XYZ_COMPANY</li>\r\n								<li>\r\n									After the title, use a paragraph or two to describe your company with 5/6 lines each. The text must describe your company, its core business and the business policy. Many businesses already have professionally written brochures, presentations, business plans, etc. - that introductory text can be put here.</li>\r\n								<li>\r\n									At the end of this section, point to your website. The link should be the exact and complete URL without any embedding so that, even if this page is printed, the link will be printed as it is. For example: <a class="external free" href="http://www.your_company_website.com/" rel="nofollow" title="http://www.your_company_website.com">http://www.your_company_website.com</a>. Companies which maintain a separate media page on their websites must point to that URL here. A media page typically has contact information and press kits.<br />\r\n									&nbsp;</li>\r\n							</ul>\r\n						</div>\r\n					</li>\r\n					<li>\r\n						<div class="stepTitle">\r\n							<strong>Tie it together</strong><br />\r\n							<div class="readmorebutton">\r\n								...read more</div>\r\n						</div>\r\n						<div class="stepFull">\r\n							Provide some extra information links that support your press release.<br />\r\n							&nbsp;</div>\r\n					</li>\r\n					<li>\r\n						<div class="stepTitle">\r\n							<strong>Add contact information </strong><br />\r\n							<div class="readmorebutton">\r\n								...read more</div>\r\n						</div>\r\n						<div class="stepFull">\r\n							If your press release is really newsworthy, journalists would surely like more information or would like to interview key people associated with it.?<br />\r\n							<br />\r\n							If you are comfortable with the idea of letting your key people be contacted directly by media, you can provide their contact details on the press release page itself. For example, in case of some innovation, you can provide the contact information of your engineering or research team for the media.<br />\r\n							Otherwise, you must provide the details of your media/PR department in the &quot;Contact&quot; section. If you do not have dedicated team for this function, you must appoint somebody who will act as a link between the media and your people.<br />\r\n							<br />\r\n							The contact details must be limited and specific only to the current press release. The contact details must include:<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <em>The Company''s Official Name<br />\r\n							<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Media Department''s official Name and Contact Person<br />\r\n							<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Office Address<br />\r\n							<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Telephone and fax Numbers with proper country/city codes and extension numbers<br />\r\n							<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Mobile Phone Number (optional)<br />\r\n							<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Timings of availability<br />\r\n							<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; E-mail Addresses<br />\r\n							<br />\r\n							&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Web site Address</em><br />\r\n							&nbsp;</div>\r\n					</li>\r\n					<li>\r\n						<strong>Signal the end of the press release with three # symbols, <br />\r\n						centered directly underneath the last line of the release</strong></li>\r\n				</ol>\r\n			</td>\r\n			<td align="center" valign="top">\r\n				<img align="top" alt="" height="265" src="/uploads/country-picture(1).jpg" width="225" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<script type="text/javascript">\r\n\r\n$(".stepTitle").click(function(){\r\n$(this).next().slideToggle();\r\n$(this).find(".readmorebutton").toggle();\r\n});\r\n\r\n</script>', 30, 19, '2012-03-22 09:40:24'),
(32, 'Disclaimer', 'disclaimer', NULL, NULL, 'Disclaimer', 'disclaimer', 100, '-', 'Online', '<table border="0" cellpadding="0" cellspacing="0" width="925">\r\n	<tbody>\r\n		<tr>\r\n			<td width="650">\r\n				<p>\r\n					This Disclaimer is applicable to the use of the websites of Africa Press List (Africa Business Communities) hereinafter referred to as “APL”.<br />\r\n					<br />\r\n					<strong>About Using This Website</strong><br />\r\n					By using or accessing this website you are accepting all the terms of this disclaimer notice.  If you do not agree with anything in this notice you should not use or access this website.<br />\r\n					<br />\r\n					<br />\r\n					<strong>Warranties and Liability</strong><br />\r\n					While every effort is made to ensure that the content of this website is accurate, the website is provided on an “as is” basis APL makes no representations or warranties in relation to the accuracy or completeness of the information found on it.  While the content of this site is provided in good faith, we do not warrant that the information will be kept up to date, be true, accurate and not misleading, or that this site will always (or forever) be available for use.<br />\r\n					<br />\r\n					We do not warrant that the servers that make this website available will be error, virus or bug free and you accept that it is your responsibility to make adequate provision for protection against such threats.  We recommend scanning any files before downloading.<br />\r\n					<br />\r\n					In no event will APL be liable for any incidental, indirect, consequential, punitive or special damages of any kind, or any other damages whatsoever, including, without limitation, those resulting from loss of profit, loss of contracts, loss of reputation, goodwill, data, information, income, anticipated savings or business relationships, whether or not APL has been advised of the possibility of such damage, arising out of or in connection with the use of this website or any linked websites.<br />\r\n					<br />\r\n					<strong>Use of this Website</strong><br />\r\n					By using this website you agree to the exclusions and limitations of liability stated above and accept them as reasonable.  Do not use this website if you do not agree that they are reasonable.<br />\r\n					<br />\r\n					If any of the content of this disclaimer notice is found to be illegal, invalid or unenforceable under the applicable law, that will have no bearing on the enforceability of the rest of the disclaimer notice and the illegal, invalid or unenforceable part shall be amended to the minimum extent necessary to make it legal, valid and enforceable.<br />\r\n					<br />\r\n					All material on this website, including text and images, is protected by copyright law and such copyright is owned by APL unless credited otherwise. It may not be copied, reproduced, republished, downloaded, posted, distributed, broadcast or transmitted in any way without the copyright owner’s consent, except for your own personal, non-commercial use. <br />\r\n					<br />\r\n					Prior written consent of the copyright owner must be obtained for any other use of material<br />\r\n					<br />\r\n					No part of this site may be distributed or copied for any commercial purpose or financial gain.<br />\r\n					<br />\r\n					All intellectual property rights in relation to this website are reserved and owned by APL.<br />\r\n					<br />\r\n					<strong>Links to Other websites and Products</strong><br />\r\n					Links to other websites are provided for the convenience of users only and APL accepts no liability or responsibility for their content.  We are unable to provide any warranty regarding the accuracy or completeness or legitimacy of the content of such sites, or the reliability, quality or effectiveness of any products provided through external websites.  A link to an external site does not imply an endorsement of the views, information or products provided or held by such websites.<br />\r\n					<br />\r\n					<br />\r\n					<strong>Law and Jurisdiction</strong><br />\r\n					This disclaimer notice shall be interpreted and governed by Netherlands law, and any disputes in relation to it are subject to the jurisdiction of the courts in The Netherlands.<br />\r\n					<br />\r\n					<br />\r\n					<strong>Variations</strong><br />\r\n					We reserve the right to revise and amend this disclaimer notice from time to time and any revised version will be deemed to be applicable from the first date of publication on this website.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', 30, 25, '2012-04-02 07:17:37'),
(33, 'Press', 'press', 8, NULL, 'Press Releases', 'press-releases', 999, 'press_overview', 'Online', '', 30, 26, '2012-06-11 10:19:42');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `channel_translation`
--
ALTER TABLE `channel_translation`
  ADD CONSTRAINT `fk_channel_id_tran` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`channel_id`),
  ADD CONSTRAINT `fk_lang_iso` FOREIGN KEY (`lang_iso`) REFERENCES `iso_language` (`lang_iso`);

--
-- Contraintes pour la table `columns_sync_oauth`
--
ALTER TABLE `columns_sync_oauth`
  ADD CONSTRAINT `fk_systeme_oauth` FOREIGN KEY (`platform_id`) REFERENCES `system_oauth` (`system_oauth`);

--
-- Contraintes pour la table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `fk_comp_country` FOREIGN KEY (`country_iso`) REFERENCES `iso_country` (`country_iso`),
  ADD CONSTRAINT `fk_comp_country_pub` FOREIGN KEY (`comp_pub_country_iso`) REFERENCES `iso_country` (`country_iso`),
  ADD CONSTRAINT `fk_comp_region_pub` FOREIGN KEY (`comp_pub_region`) REFERENCES `geo_region` (`geo_region_id`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk_conact_iso_cont` FOREIGN KEY (`contact_iso_country`) REFERENCES `iso_country` (`country_iso`);

--
-- Contraintes pour la table `contact_category`
--
ALTER TABLE `contact_category`
  ADD CONSTRAINT `contact_category_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_category_ibfk_3` FOREIGN KEY (`cat_id`) REFERENCES `business_category` (`cat_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contact_client_blacklist`
--
ALTER TABLE `contact_client_blacklist`
  ADD CONSTRAINT `contact_client_blacklist_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_client_blacklist_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contact_function`
--
ALTER TABLE `contact_function`
  ADD CONSTRAINT `contact_function_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_function_ibfk_3` FOREIGN KEY (`function_id`) REFERENCES `function` (`function_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_function_ibfk_4` FOREIGN KEY (`company_id`) REFERENCES `company` (`comp_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contact_geo_coverage`
--
ALTER TABLE `contact_geo_coverage`
  ADD CONSTRAINT `contact_geo_coverage_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_geo_coverage_ibfk_3` FOREIGN KEY (`geo_country_id`) REFERENCES `iso_country` (`country_iso`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_geo_coverage_ibfk_4` FOREIGN KEY (`company_id`) REFERENCES `company` (`comp_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contact_language`
--
ALTER TABLE `contact_language`
  ADD CONSTRAINT `contact_language_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_language_ibfk_2` FOREIGN KEY (`lang_iso`) REFERENCES `iso_language` (`lang_iso`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contact_oauth`
--
ALTER TABLE `contact_oauth`
  ADD CONSTRAINT `fk_sysyrme_oauth` FOREIGN KEY (`platform_id`) REFERENCES `system_oauth` (`system_oauth`);

--
-- Contraintes pour la table `credit_history`
--
ALTER TABLE `credit_history`
  ADD CONSTRAINT `fk_credit_history_list` FOREIGN KEY (`ch_target_id`) REFERENCES `list` (`list_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_credit` FOREIGN KEY (`ch_user`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `credit_package`
--
ALTER TABLE `credit_package`
  ADD CONSTRAINT `fk_extention_credit_package` FOREIGN KEY (`extention_credit_id`) REFERENCES `credit` (`credit_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_list_credit_package` FOREIGN KEY (`basic_credit_id`) REFERENCES `credit` (`credit_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `function_translation`
--
ALTER TABLE `function_translation`
  ADD CONSTRAINT `fk_fn_language` FOREIGN KEY (`lang_iso`) REFERENCES `iso_language` (`lang_iso`),
  ADD CONSTRAINT `fk_function_id` FOREIGN KEY (`function_id`) REFERENCES `function` (`function_id`);

--
-- Contraintes pour la table `geo_region_cluster`
--
ALTER TABLE `geo_region_cluster`
  ADD CONSTRAINT `fk_geo_cluster` FOREIGN KEY (`geo_cluster_id`) REFERENCES `geo_cluster` (`geo_cluster_id`),
  ADD CONSTRAINT `fk_geo_region_id` FOREIGN KEY (`geo_region_id`) REFERENCES `geo_region` (`geo_region_id`);

--
-- Contraintes pour la table `iso_country`
--
ALTER TABLE `iso_country`
  ADD CONSTRAINT `fk_countries_continents` FOREIGN KEY (`continent_code`) REFERENCES `continents` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_countries_regions` FOREIGN KEY (`geo_region_id`) REFERENCES `geo_region` (`geo_region_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `list`
--
ALTER TABLE `list`
  ADD CONSTRAINT `fk_id_user_list` FOREIGN KEY (`list_user`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `list_contact`
--
ALTER TABLE `list_contact`
  ADD CONSTRAINT `list_contact_ibfk_2` FOREIGN KEY (`list_id`) REFERENCES `list` (`list_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_contact_ibfk_3` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `mailing_file`
--
ALTER TABLE `mailing_file`
  ADD CONSTRAINT `mailing_file_ibfk_1` FOREIGN KEY (`mailing_id`) REFERENCES `mailing` (`mailing_id`),
  ADD CONSTRAINT `mailing_file_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `mailing_file` (`mailing_id`);

--
-- Contraintes pour la table `packaged_credit`
--
ALTER TABLE `packaged_credit`
  ADD CONSTRAINT `fk_credit_package_credit` FOREIGN KEY (`credit_package_id`) REFERENCES `credit_package` (`credit_package_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `packaged_credit_ibfk_1` FOREIGN KEY (`credit_id`) REFERENCES `credit` (`credit_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paypal_transactions`
--
ALTER TABLE `paypal_transactions`
  ADD CONSTRAINT `fk_user_pp` FOREIGN KEY (`pp_user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `press`
--
ALTER TABLE `press`
  ADD CONSTRAINT `fk_list_id_press` FOREIGN KEY (`list_id`) REFERENCES `list` (`list_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id_press` FOREIGN KEY (`press_user`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rights`
--
ALTER TABLE `rights`
  ADD CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `role_channel`
--
ALTER TABLE `role_channel`
  ADD CONSTRAINT `role_channel_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_channel_ibfk_3` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`channel_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_channel_ibfk_4` FOREIGN KEY (`company_id`) REFERENCES `company` (`comp_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_camp_country` FOREIGN KEY (`porfile_camp_country`) REFERENCES `iso_country` (`country_iso`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_profil_country` FOREIGN KEY (`porfile_country`) REFERENCES `iso_country` (`country_iso`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_package_id` FOREIGN KEY (`user_package_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_package`
--
ALTER TABLE `user_package`
  ADD CONSTRAINT `fk_user_package` FOREIGN KEY (`credit_package_id`) REFERENCES `credit_package` (`credit_package_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
