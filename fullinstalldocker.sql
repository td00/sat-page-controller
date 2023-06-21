CREATE DATABASE usertable;
CREATE USER 'usertable'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, INDEX, DROP, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES ON usertable.* TO 'usertable'@'localhost';
USE usertable;
CREATE TABLE `users` ( 
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NOT NULL ,
  `username` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `givenName` VARCHAR(255) NOT NULL DEFAULT '' ,
  `lastName` VARCHAR(255) NOT NULL DEFAULT '' ,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `activationcode` VARCHAR(255) NULL ,
  `activationcode_time` TIMESTAMP NULL ,
  `isadmin` VARCHAR(1) NULL ,
  `activated` VARCHAR(1) NOT NULL ,
  `passwordcode` VARCHAR(255) NULL ,
  `passwordcode_time` TIMESTAMP NULL ,
  `profilepicture` VARCHAR(255) NULL DEFAULT 'https://web.td00.de/woddle.gif' ,
  PRIMARY KEY (`id`), UNIQUE (`email`), UNIQUE (`username`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
