-- COMPSET MARIA DB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `compset`;
CREATE DATABASE `compset` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `compset`;

/*-------------------------------------------------------------------------------------------------*/
/*ENTITIES TABLES*/
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `identification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,/*nickname or email or etc*/
  `passwordHash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `createdBy` bigint(20) unsigned NOT NULL DEFAULT '1',
  `updatedAt` datetime NOT NULL, /*automatic (on update)*/
  `updatedBy` bigint(20) unsigned NOT NULL DEFAULT '1',
  `isDelete` bit(1) NOT NULL DEFAULT b'0',
  `isHidden` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  /*unique for soft-delete:*/
  UNIQUE KEY `identification_id` (`identification`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `createdBy` bigint(20) unsigned NOT NULL DEFAULT '1',
  `updateAt` datetime NOT NULL,
  `updatedBy` bigint(20) unsigned NOT NULL DEFAULT '1',
  `isDelete` bit(1) NOT NULL DEFAULT b'0',
  `isHidden` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  /*unique for soft-delete:*/
  UNIQUE KEY `name` (`name`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `createdBy` bigint(20) unsigned NOT NULL DEFAULT '1',
  `updateAt` datetime NOT NULL,
  `updatedBy` bigint(20) unsigned NOT NULL DEFAULT '1',
  `isDelete` bit(1) NOT NULL DEFAULT b'0',
  `isHidden` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  /*unique for soft-delete:*/
  UNIQUE KEY `name` (`name`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `actions`;
CREATE TABLE `actions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `createdBy` bigint(20) unsigned NOT NULL DEFAULT '1',
  `updateAt` datetime NOT NULL,
  `updatedBy` bigint(20) unsigned NOT NULL DEFAULT '1',
  `isDelete` bit(1) NOT NULL DEFAULT b'0',
  `isHidden` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  /*unique for soft-delete:*/
  UNIQUE KEY `name` (`name`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `tokenHash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updateAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*-------------------------------------------------------------------------------------------------*/
/*RELATIONS TABLES*/
DROP TABLE IF EXISTS `usersHasGroups`;
CREATE TABLE `usersHasGroups` (
  `usersId` bigint(20) unsigned NOT NULL,
  `groupsId` bigint(20) unsigned NOT NULL,
  KEY `usersId` (`usersId`),
  KEY `groupsId` (`groupsId`),
  CONSTRAINT `usersHasGroups_ibfk_1` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`),
  CONSTRAINT `usersHasGroups_ibfk_2` FOREIGN KEY (`groupsId`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `groupsHasRoles`;
CREATE TABLE `groupsHasRoles` (
  `groupsId` bigint(20) unsigned NOT NULL,
  `rolesId` bigint(20) unsigned NOT NULL,
  KEY `groupsId` (`groupsId`),
  KEY `rolesId` (`rolesId`),
  CONSTRAINT `groupsHasRoles_ibfk_1` FOREIGN KEY (`groupsId`) REFERENCES `groups` (`id`),
  CONSTRAINT `groupsHasRoles_ibfk_2` FOREIGN KEY (`rolesId`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `rolesHasActions`;
CREATE TABLE `rolesHasActions` (
  `rolesId` bigint(20) unsigned NOT NULL,
  `actionsId` bigint(20) unsigned NOT NULL,
  KEY `rolesId` (`rolesId`),
  KEY `actionsId` (`actionsId`),
  CONSTRAINT `rolesHasActions_ibfk_1` FOREIGN KEY (`rolesId`) REFERENCES `roles` (`id`),
  CONSTRAINT `rolesHasActions_ibfk_2` FOREIGN KEY (`actionsId`) REFERENCES `actions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;