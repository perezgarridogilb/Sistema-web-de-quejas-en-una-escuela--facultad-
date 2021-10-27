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
        SET error = 'password actual incorrecta.';
      ELSEIF EXISTS (SELECT id FROM previous_passwords as p WHERE p.id_user = id_user AND p.password = new_password) OR STRCMP(current_password, new_password) = 0 THEN
        -- password nueva igual a antigua
        SET error = 'La nueva password concuerda con una anteriormente utilizada';
      ELSE
        -- Actualizacion exitosa
        UPDATE users as u SET u.password = new_password WHERE u.id_user = id_user;
      END IF;

      select error;
    END //
DELIMITER ;

-- Add deleted_at field

ALTER TABLE reports ADD deleted_at DATETIME;