-- Clean state ---

DROP TABLE IF EXISTS images CASCADE;
DROP TABLE IF EXISTS likes CASCADE;
DROP TABLE IF EXISTS responses CASCADE;
DROP TABLE IF EXISTS previous_passwords CASCADE;
DROP TABLE IF EXISTS reports CASCADE;
DROP TABLE IF EXISTS users CASCADE;

CREATE TABLE `users` (
  `id_user` int(11) PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `image` varchar(64) NULL,
  `mail` varchar(64) NOT NULL UNIQUE,
  `password` varchar(64) NOT NULL,
  `usertype` int(1) NOT NULL,
  `activate` int(11) NOT NULL DEFAULT 0,
  `token` varchar(40) NOT NULL,
  `token_password` varchar(100) DEFAULT NULL,
  `password_request` int(11) DEFAULT 0
);

CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d'),
  `modified_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d'),
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_user` (`id_user`),
  CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `not_empty_title` CHECK (trim(`title`) <> ''),
  CONSTRAINT `not_empty_content` CHECK (trim(`content`) <> '')
);

CREATE TABLE `responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_report` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d'),
  `modified_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d'),
  PRIMARY KEY (`id`),
  KEY `responses_fk_id_report` (`id_report`),
  KEY `responses_fk_id_user` (`id_user`),
  CONSTRAINT `responses_fk_id_report` FOREIGN KEY (`id_report`) REFERENCES `reports` (`id`) ON DELETE CASCADE,
  CONSTRAINT `responses_fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `not_empty_content` CHECK (trim(`content`) <> '')
);

CREATE TABLE `images` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_report` INT NOT NULL,
  image VARCHAR(255) NOT NULL,
  CONSTRAINT `images_fk_id_report` FOREIGN KEY (`id_report`) REFERENCES `reports` (`id`) ON DELETE CASCADE,
  CONSTRAINT `not_empty_image` CHECK(trim(`image`) <> '')
);

CREATE TABLE `likes` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_report` INT NOT NULL,
  `id_user` INT NOT NULL,
  CONSTRAINT `likes_fk_id_report` FOREIGN KEY (`id_report`) REFERENCES `reports` (`id`) ON DELETE CASCADE,
  CONSTRAINT `likes_fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
);

create table previous_passwords(
  id INTEGER AUTO_INCREMENT PRIMARY KEY,
  id_user INTEGER NOT NULL,
  password VARCHAR(64) NOT NULL
);
