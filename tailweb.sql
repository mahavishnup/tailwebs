-- Adminer 4.8.4 MySQL 8.0.37 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `tailwebs` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tailwebs`;

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
                            `uid` int NOT NULL AUTO_INCREMENT,
                            `name` varchar(191) DEFAULT NULL,
                            `subject` varchar(191) DEFAULT NULL,
                            `mark` bigint DEFAULT NULL,
                            PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `students` (`uid`, `name`, `subject`, `mark`) VALUES
                                                              (7,	'Sam',	'bio',	67),
                                                              (9,	'Kumar',	'Biology',	89),
                                                              (10,	'Sam',	'Math',	100);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `uid` int NOT NULL AUTO_INCREMENT,
                         `uname` varchar(191) DEFAULT NULL,
                         `upass` varchar(191) DEFAULT NULL,
                         PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`uid`, `uname`, `upass`) VALUES
    (1,	'teacher',	'$2y$10$nQk2FUnpU4Rfb5zqfHe/y.CKz0tla/3hYRco8goUip7/kgCA5Wqjy');

-- 2024-07-03 07:57:38