drop procedure if exists insert_old_password;
drop procedure if exists update_password;

drop trigger if exists before_change_password;
drop table if exists previous_passwords;

create table previous_passwords(
  id INTEGER AUTO_INCREMENT PRIMARY KEY,
  id_usuario INTEGER NOT NULL,
  password VARCHAR(64) NOT NULL
);

DELIMITER //
  CREATE PROCEDURE insert_old_password(IN id_usuario INTEGER, IN password VARCHAR(64))
  BEGIN
    INSERT INTO previous_passwords(id_usuario, password) VALUES (id_usuario, password);
  END //
DELIMITER ;

DELIMITER //
  CREATE TRIGGER before_change_password
    BEFORE UPDATE
    ON users
    FOR EACH ROW
      BEGIN
        CALL insert_old_password(old.id_usuario, old.contraseña);
      END//
DELIMITER ;

DELIMITER //
  CREATE PROCEDURE update_password(IN id_usuario INT, IN current_password VARCHAR(64), IN new_password VARCHAR(64), OUT error varchar(255))
    BEGIN
      SET error = '';

      IF NOT EXISTS (SELECT id_usuario FROM users WHERE id_usuario = id_usuario AND current_password = contraseña) THEN
        -- Contraseña actual incorrecta
        SET error = 'Contraseña actual incorrecta.';
      ELSEIF EXISTS (SELECT id FROM previous_passwords as p WHERE p.id_usuario = id_usuario AND p.password = new_password) OR STRCMP(current_password, new_password) = 0 THEN
        -- Contraseña nueva igual a antigua
        SET error = 'La nueva contraseña concuerda con una anteriormente utilizada';
      ELSE
        -- Actualizacion exitosa
        UPDATE users as u SET u.contraseña = new_password WHERE u.id_usuario = id_usuario;
      END IF;

      select error;
    END //
DELIMITER ;
