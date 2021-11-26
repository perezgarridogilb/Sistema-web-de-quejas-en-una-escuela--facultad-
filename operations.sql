-- Clean stage --

DROP PROCEDURE IF EXISTS delete_report;
DROP PROCEDURE IF EXISTS insert_old_password;
DROP PROCEDURE IF EXISTS update_password;
DROP PROCEDURE IF EXISTS insertPreviusKeys;

DROP TRIGGER IF EXISTS after_change_password;
DROP TRIGGER IF EXISTS before_delete_report;


-- Procedimiento que inserta una contraseña en el histoial --

DELIMITER //
  CREATE PROCEDURE insert_old_password(IN id_user INTEGER, IN password VARCHAR(64))
  BEGIN
    INSERT INTO previous_passwords(id_user, password) VALUES (id_user, password);
  END //
DELIMITER ;

-- Procedimiento que actualiza la contraseña y verifica los posibles estados de error --

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

-- Trigger que almacena la vieja contraseña cuando se realiza un cambio en ella --

DELIMITER //
  CREATE TRIGGER after_change_password
    AFTER UPDATE
    ON users
    FOR EACH ROW
      BEGIN
        IF new.password <> old.password THEN
          CALL insert_old_password(old.id_user, old.password);
        END IF;
      END//
DELIMITER ;


-- Trigger que elimina las imagenes relacionadas con un reporte antes de eliminarlo --

DELIMITER //
CREATE TRIGGER before_delete_report
    BEFORE DELETE ON reports
    FOR EACH row
    BEGIN
    DELETE FROM images WHERE id_report = old.id;
END//
DELIMITER ;

------------------------------------------

DELIMITER //
CREATE PROCEDURE `insertPreviusKeys` (IN `id_user` INTEGER, IN `password` VARCHAR(64))  BEGIN
    INSERT INTO previous_passwords(id, id_user, password) values (NULL, id_user, password);
END//
DELIMITER ;
