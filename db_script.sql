SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `users` (
  `id_user` int(11) PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `imagen` varchar(64) NOT NULL,
  `mail` varchar(64) NOT NULL UNIQUE,
  `password` varchar(64) NOT NULL,
  `usertype` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id_user`, `name`, `imagen`, `mail`, `password`, `usertype`) VALUES
(10, 'Gilberto Pérez Garrido', 'https://', 'betho6990@gmail.com', 'abc', 0),
(21, 'Israel Solís Ahuactzin', 'https://bit.ly/3zx63Rm', 'israel.flash@hotmail.com', 'abc', 1),
(22, 'Luis Alberto Zacarías Martínez', 'https://bit.ly/3nYuJAk', 'secarmesi@gmail.com', 'abc', 1),
(23, 'Marcos David García Marquez', 'https://bit.ly/3u3DNVn', 'abs14@outlook.es', 'abc', 1),
(25, 'Francisco Rodriguez Baeza', 'https://bit.ly/3nYBMcf', 'secarmesi1@gmail.com', 'abc', 1);


ALTER TABLE users ADD CONSTRAINT unique_email UNIQUE (mail);

CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d'),
  `modified_at` date NOT NULL DEFAULT date_format(current_timestamp(),'%Y-%m-%d'),
  PRIMARY KEY (`id`),
  KEY `fk_id_user` (`id_user`),
  CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
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
  CONSTRAINT `responses_fk_id_report` FOREIGN KEY (`id_report`) REFERENCES `reports` (`id`),
  CONSTRAINT `responses_fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  CONSTRAINT `not_empty_content` CHECK (trim(`content`) <> '')
);

CREATE TABLE `images` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_report` INT NOT NULL,
  image VARCHAR(255) NOT NULL,
  CONSTRAINT `images_fk_id_report` FOREIGN KEY (`id_report`) REFERENCES `reports` (`id`),
  CONSTRAINT `not_empty_image` CHECK(trim(`image`) <> '')
); 

-- Procedimiento almacenado para eliminar el reporte

CREATE PROCEDURE delete_report(id_report INTEGER)
    UPDATE SET is_deleted=true WHERE id=id_report;


-- Trigger que elimina las imagenes relacionadas con un reporte antes de eliminarlo

DELIMITER //
CREATE TRIGGER before_delete_report
BEFORE DELETE ON reports
FOR EACH row
BEGIN
DELETE FROM images WHERE id_report = old.id;
END;


drop procedure if exists insert_old_password;
drop procedure if exists update_password;

drop trigger if exists before_change_password;
drop table if exists previous_passwords;

create table previous_passwords(
  id INTEGER AUTO_INCREMENT PRIMARY KEY,
  id_user INTEGER NOT NULL,
  password VARCHAR(64) NOT NULL
);

DELIMITER //
  CREATE PROCEDURE insert_old_password(IN id_user INTEGER, IN password VARCHAR(64))
  BEGIN
    INSERT INTO previous_passwords(id_user, password) VALUES (id_user, password);
  END //
DELIMITER ;

DELIMITER //
  CREATE TRIGGER before_change_password
    BEFORE UPDATE
    ON users
    FOR EACH ROW
      BEGIN
        CALL insert_old_password(old.id_user, old.password);
      END//
DELIMITER ;

DELIMITER //
  CREATE PROCEDURE update_password(IN id_user INT, IN current_password VARCHAR(64), IN new_password VARCHAR(64), OUT error varchar(255))
    BEGIN
      SET error = '';

      IF NOT EXISTS (SELECT id_user FROM users WHERE id_user = id_user AND current_password = password) THEN
        -- password actual incorrecta
        SET error = 'Contraseña actual incorrecta.';
      ELSEIF EXISTS (SELECT id FROM previous_passwords as p WHERE p.id_user = id_user AND p.password = new_password) OR STRCMP(current_password, new_password) = 0 THEN
        -- password nueva igual a antigua
        SET error = 'La nueva contraseña concuerda con una anteriormente utilizada.';
      ELSE
        -- Actualizacion exitosa
        UPDATE users as u SET u.password = new_password WHERE u.id_user = id_user;
      END IF;

      select error;
    END //
DELIMITER ;

-- Add deleted_at field

ALTER TABLE reports ADD deleted_at DATETIME;