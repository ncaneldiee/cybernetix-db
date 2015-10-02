CREATE DATABASE IF NOT EXISTS `cybernetix` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cybernetix`;

CREATE TABLE IF NOT EXISTS `app_account` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `confirm` int(1) NOT NULL DEFAULT '0',
    `confirm_token` varchar(255) NULL,
    `remember_token` varchar(255) NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    `deleted_at` datetime NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `app_account_amnesia` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `email` varchar(255) NOT NULL,
    `token` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `app_account_attempt` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `ip` varchar(255) NOT NULL,
    `count` int(11) NOT NULL DEFAULT '0',
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `app_role` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `description` text,
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `app_role_account` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `role_id` int(11) unsigned NOT NULL,
    `account_id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `role_id` (`role_id`),
    KEY `account_id` (`account_id`),
    FOREIGN KEY (`role_id`) REFERENCES `app_role` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`account_id`) REFERENCES `app_account` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `app_permission` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `description` text,
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `app_permission_role` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `permission_id` int(11) unsigned NOT NULL,
    `role_id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `permission_id` (`permission_id`),
    KEY `role_id` (`role_id`),
    FOREIGN KEY (`permission_id`) REFERENCES `app_permission` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`role_id`) REFERENCES `app_role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
