-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 24, 2026 at 05:54 PM
-- Server version: 11.8.8-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u482908474_kk`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_table`
--

CREATE TABLE `device_table` (
  `id` int(11) NOT NULL,
  `token` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fos_user_table`
--

CREATE TABLE `fos_user_table` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_canonical` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_canonical` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `emailo` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `token` longtext DEFAULT NULL,
  `image` longtext NOT NULL,
  `trusted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_table`
--

CREATE TABLE `gallery_table` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medias_gallerys_table`
--

CREATE TABLE `medias_gallerys_table` (
  `gallery_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_table`
--

CREATE TABLE `media_table` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packs_categories_table`
--

CREATE TABLE `packs_categories_table` (
  `pack_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packs_table`
--

CREATE TABLE `packs_table` (
  `id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `publisheremail` varchar(255) DEFAULT NULL,
  `publisherwebsite` varchar(255) DEFAULT NULL,
  `privacypolicywebsite` varchar(255) DEFAULT NULL,
  `licenseagreementwebsite` varchar(255) DEFAULT NULL,
  `tags` longtext DEFAULT NULL,
  `size` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `review` tinyint(1) NOT NULL,
  `premium` tinyint(1) NOT NULL,
  `animated` tinyint(1) NOT NULL,
  `downloads` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `whatsapp` tinyint(1) NOT NULL DEFAULT 1,
  `signalapp` tinyint(1) NOT NULL,
  `telegram` tinyint(1) NOT NULL,
  `signalurl` varchar(255) DEFAULT NULL,
  `telegramurl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packs_tags_table`
--

CREATE TABLE `packs_tags_table` (
  `pack_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rate_table`
--

CREATE TABLE `rate_table` (
  `id` int(11) NOT NULL,
  `pack_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings_table`
--

CREATE TABLE `settings_table` (
  `id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `appname` varchar(255) DEFAULT NULL,
  `appdescription` longtext DEFAULT NULL,
  `googleplay` longtext DEFAULT NULL,
  `privacypolicy` longtext DEFAULT NULL,
  `firebasekey` varchar(255) DEFAULT NULL,
  `rewardedadmobid` varchar(255) DEFAULT NULL,
  `banneradmobid` varchar(255) DEFAULT NULL,
  `bannerfacebookid` varchar(255) DEFAULT NULL,
  `nativebannerfacebookid` varchar(255) DEFAULT NULL,
  `bannertype` varchar(255) DEFAULT NULL,
  `nativeadmobid` varchar(255) DEFAULT NULL,
  `nativefacebookid` varchar(255) DEFAULT NULL,
  `nativeitem` int(11) DEFAULT NULL,
  `nativetype` varchar(255) DEFAULT NULL,
  `interstitialadmobid` varchar(255) DEFAULT NULL,
  `interstitialfacebookid` varchar(255) DEFAULT NULL,
  `interstitialtype` varchar(255) DEFAULT NULL,
  `interstitialclick` int(11) DEFAULT NULL,
  `publisherid` varchar(255) DEFAULT NULL,
  `appid` varchar(255) DEFAULT NULL,
  `rewardedtype` varchar(255) DEFAULT NULL,
  `bannermaxid` varchar(255) DEFAULT NULL,
  `bannerapplovinid` varchar(255) DEFAULT NULL,
  `bannerunityid` varchar(255) DEFAULT NULL,
  `bannerorder` varchar(255) DEFAULT NULL,
  `nativemaxid` varchar(255) DEFAULT NULL,
  `nativeorder` varchar(255) DEFAULT NULL,
  `interstitialmaxid` varchar(255) DEFAULT NULL,
  `interstitialapplovinid` varchar(255) DEFAULT NULL,
  `interstitialunityid` varchar(255) DEFAULT NULL,
  `interstitialorder` varchar(255) DEFAULT NULL,
  `rewardedmaxid` varchar(255) DEFAULT NULL,
  `rewardedapplovinid` varchar(255) DEFAULT NULL,
  `rewardedfacebookid` varchar(255) DEFAULT NULL,
  `rewardedunityid` varchar(255) DEFAULT NULL,
  `rewardedorder` varchar(255) DEFAULT NULL,
  `unitygameid` varchar(255) DEFAULT NULL,
  `adfallback` varchar(255) DEFAULT NULL,
  `adtimeout` int(11) DEFAULT NULL,
  `vungleappid` varchar(255) DEFAULT NULL,
  `inmobiaccountid` varchar(255) DEFAULT NULL,
  `bannervungleid` varchar(255) DEFAULT NULL,
  `bannerinmobiid` varchar(255) DEFAULT NULL,
  `interstitialvungleid` varchar(255) DEFAULT NULL,
  `interstitialinmobiid` varchar(255) DEFAULT NULL,
  `rewardedvungleid` varchar(255) DEFAULT NULL,
  `rewardedinmobiid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slide_table`
--

CREATE TABLE `slide_table` (
  `id` int(11) NOT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stickers_table`
--

CREATE TABLE `stickers_table` (
  `id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `emojis` longtext NOT NULL,
  `size` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_table`
--

CREATE TABLE `support_table` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags_table`
--

CREATE TABLE `tags_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `search` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_followers`
--

CREATE TABLE `user_followers` (
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `version_table`
--

CREATE TABLE `version_table` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `features` longtext NOT NULL,
  `code` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1E1AC00FEA9FDD75` (`media_id`);

--
-- Indexes for table `device_table`
--
ALTER TABLE `device_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fos_user_table`
--
ALTER TABLE `fos_user_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C3D4D4BD92FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_C3D4D4BDA0D96FBF` (`email_canonical`);

--
-- Indexes for table `gallery_table`
--
ALTER TABLE `gallery_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medias_gallerys_table`
--
ALTER TABLE `medias_gallerys_table`
  ADD PRIMARY KEY (`gallery_id`,`media_id`),
  ADD KEY `IDX_CC965DCE4E7AF8F` (`gallery_id`),
  ADD KEY `IDX_CC965DCEEA9FDD75` (`media_id`);

--
-- Indexes for table `media_table`
--
ALTER TABLE `media_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packs_categories_table`
--
ALTER TABLE `packs_categories_table`
  ADD PRIMARY KEY (`pack_id`,`category_id`),
  ADD KEY `IDX_4FC04AFD1919B217` (`pack_id`),
  ADD KEY `IDX_4FC04AFD12469DE2` (`category_id`);

--
-- Indexes for table `packs_table`
--
ALTER TABLE `packs_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_53BC8512EA9FDD75` (`media_id`),
  ADD KEY `IDX_53BC8512A76ED395` (`user_id`);

--
-- Indexes for table `packs_tags_table`
--
ALTER TABLE `packs_tags_table`
  ADD PRIMARY KEY (`pack_id`,`tag_id`),
  ADD KEY `IDX_17CBC2C61919B217` (`pack_id`),
  ADD KEY `IDX_17CBC2C6BAD26311` (`tag_id`);

--
-- Indexes for table `rate_table`
--
ALTER TABLE `rate_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_666996651919B217` (`pack_id`),
  ADD KEY `IDX_66699665A76ED395` (`user_id`);

--
-- Indexes for table `settings_table`
--
ALTER TABLE `settings_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4EF0C90FEA9FDD75` (`media_id`);

--
-- Indexes for table `slide_table`
--
ALTER TABLE `slide_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_77A059652B36786B` (`title`),
  ADD KEY `IDX_77A059651919B217` (`pack_id`),
  ADD KEY `IDX_77A0596512469DE2` (`category_id`),
  ADD KEY `IDX_77A05965EA9FDD75` (`media_id`);

--
-- Indexes for table `stickers_table`
--
ALTER TABLE `stickers_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_80E0FAA5EA9FDD75` (`media_id`),
  ADD KEY `IDX_80E0FAA51919B217` (`pack_id`);

--
-- Indexes for table `support_table`
--
ALTER TABLE `support_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags_table`
--
ALTER TABLE `tags_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_followers`
--
ALTER TABLE `user_followers`
  ADD PRIMARY KEY (`user_id`,`follower_id`),
  ADD KEY `IDX_84E87043A76ED395` (`user_id`),
  ADD KEY `IDX_84E87043AC24F853` (`follower_id`);

--
-- Indexes for table `version_table`
--
ALTER TABLE `version_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_table`
--
ALTER TABLE `device_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fos_user_table`
--
ALTER TABLE `fos_user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_table`
--
ALTER TABLE `gallery_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_table`
--
ALTER TABLE `media_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packs_table`
--
ALTER TABLE `packs_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rate_table`
--
ALTER TABLE `rate_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings_table`
--
ALTER TABLE `settings_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slide_table`
--
ALTER TABLE `slide_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stickers_table`
--
ALTER TABLE `stickers_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_table`
--
ALTER TABLE `support_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags_table`
--
ALTER TABLE `tags_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `version_table`
--
ALTER TABLE `version_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_table`
--
ALTER TABLE `category_table`
  ADD CONSTRAINT `FK_1E1AC00FEA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media_table` (`id`);

--
-- Constraints for table `medias_gallerys_table`
--
ALTER TABLE `medias_gallerys_table`
  ADD CONSTRAINT `FK_CC965DCE4E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery_table` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CC965DCEEA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media_table` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `packs_categories_table`
--
ALTER TABLE `packs_categories_table`
  ADD CONSTRAINT `FK_4FC04AFD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category_table` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4FC04AFD1919B217` FOREIGN KEY (`pack_id`) REFERENCES `packs_table` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `packs_table`
--
ALTER TABLE `packs_table`
  ADD CONSTRAINT `FK_53BC8512A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user_table` (`id`),
  ADD CONSTRAINT `FK_53BC8512EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media_table` (`id`);

--
-- Constraints for table `packs_tags_table`
--
ALTER TABLE `packs_tags_table`
  ADD CONSTRAINT `FK_17CBC2C61919B217` FOREIGN KEY (`pack_id`) REFERENCES `packs_table` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_17CBC2C6BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tags_table` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rate_table`
--
ALTER TABLE `rate_table`
  ADD CONSTRAINT `FK_666996651919B217` FOREIGN KEY (`pack_id`) REFERENCES `packs_table` (`id`),
  ADD CONSTRAINT `FK_66699665A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user_table` (`id`);

--
-- Constraints for table `settings_table`
--
ALTER TABLE `settings_table`
  ADD CONSTRAINT `FK_4EF0C90FEA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media_table` (`id`);

--
-- Constraints for table `slide_table`
--
ALTER TABLE `slide_table`
  ADD CONSTRAINT `FK_77A0596512469DE2` FOREIGN KEY (`category_id`) REFERENCES `category_table` (`id`),
  ADD CONSTRAINT `FK_77A059651919B217` FOREIGN KEY (`pack_id`) REFERENCES `packs_table` (`id`),
  ADD CONSTRAINT `FK_77A05965EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media_table` (`id`);

--
-- Constraints for table `stickers_table`
--
ALTER TABLE `stickers_table`
  ADD CONSTRAINT `FK_80E0FAA51919B217` FOREIGN KEY (`pack_id`) REFERENCES `packs_table` (`id`),
  ADD CONSTRAINT `FK_80E0FAA5EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media_table` (`id`);

--
-- Constraints for table `user_followers`
--
ALTER TABLE `user_followers`
  ADD CONSTRAINT `FK_84E87043A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user_table` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_84E87043AC24F853` FOREIGN KEY (`follower_id`) REFERENCES `fos_user_table` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
