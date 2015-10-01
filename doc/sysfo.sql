CREATE DATABASE IF NOT EXISTS `cybernetix` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cybernetix`;

CREATE TABLE IF NOT EXISTS `sysfo_group` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `key` int(2) unsigned zerofill DEFAULT '00',
    `name` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sysfo_member` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `group_id` int(11) unsigned NOT NULL,
    `key` int(3) unsigned zerofill DEFAULT '001',
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NULL,
    `phone` varchar(255) NULL,
    `image` varchar(255) NULL DEFAULT 'default.jpg',
    `gender` enum('f', 'm') NOT NULL DEFAULT 'm',
    `address` text,
    `status` int(1) unsigned NOT NULL DEFAULT '2' COMMENT '0 = expelled or resigned member, 1 = inactive member, 2 = active member, 3 = outstanding member, 4 = honorary member',
    PRIMARY KEY (`id`),
    KEY `group_id` (`group_id`),
    FOREIGN KEY (`group_id`) REFERENCES `sysfo_group` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sysfo_unit` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `description` text,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sysfo_unit_member` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `unit_id` int(11) unsigned NOT NULL,
    `member_id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `member_id` (`member_id`),
    KEY `unit_id` (`unit_id`),
    FOREIGN KEY (`member_id`) REFERENCES `sysfo_member` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`unit_id`) REFERENCES `sysfo_unit` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sysfo_employee` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `employee_id` int(11) unsigned DEFAULT NULL,
    `name` varchar(255) NOT NULL,
    `description` text,
    `lane` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 = command, 1 = coordination',
    `sort` int(11) unsigned NOT NULL DEFAULT '0',
    `status` int(1) unsigned NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `employee_id` (`employee_id`),
    FOREIGN KEY (`employee_id`) REFERENCES `sysfo_employee` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sysfo_management` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `tenure` varchar(255) NOT NULL,
    `vision` text,
    `mission` text,
    `status` int(1) unsigned NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sysfo_management_log` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `management_id` int(11) unsigned NOT NULL,
    `employee_id` int(11) unsigned NOT NULL,
    `member_id` int(11) unsigned NOT NULL,
    `description` text,
    `status` int(1) unsigned NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `management_id` (`management_id`),
    KEY `employee_id` (`employee_id`),
    KEY `member_id` (`member_id`),
    FOREIGN KEY (`management_id`) REFERENCES `sysfo_management` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`employee_id`) REFERENCES `sysfo_employee` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`member_id`) REFERENCES `sysfo_member` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELIMITER $$;
    DROP TRIGGER IF EXISTS `group_key`;
    CREATE TRIGGER `group_key` BEFORE INSERT ON `sysfo_group`
    FOR EACH ROW
    BEGIN
        SET NEW.key = (SELECT MAX(`key`) FROM `sysfo_group`) + 1;

        IF NEW.key IS NULL THEN
           SET NEW.key = 00;
        END IF;
    END$$
DELIMITER ;

DELIMITER $$;
    DROP TRIGGER IF EXISTS `member_key`;
    CREATE TRIGGER `member_key` BEFORE INSERT ON `sysfo_member`
    FOR EACH ROW
    BEGIN
        SET NEW.key = (
            SELECT MAX(`m`.`key`) FROM `sysfo_member` AS `m`
            LEFT JOIN `sysfo_group` AS `g` ON `m`.`group_id` = `g`.`id`
            WHERE `m`.`group_id` = NEW.group_id
        ) + 1;

        IF NEW.key IS NULL THEN
           SET NEW.key = 001;
        END IF;
    END$$
DELIMITER ;

DELIMITER $$;
    DROP TRIGGER IF EXISTS `management_status`;
    CREATE TRIGGER `management_status` AFTER UPDATE ON `sysfo_management`
    FOR EACH ROW
    BEGIN
        UPDATE `sysfo_management_log`
        SET `status` = NEW.status
        WHERE `management_id` = NEW.id;
    END$$
DELIMITER ;
