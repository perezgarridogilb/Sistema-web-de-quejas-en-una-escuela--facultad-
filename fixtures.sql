DELETE FROM users;

INSERT INTO `users` (`id_user`, `name`, `image`, `mail`, `password`, `usertype`, `activate`, `token`, `token_password`, `password_request`) VALUES
(NULL, 'Gilberto Pérez Garrido', NULL, 'betho6990@gmail.com', 'abc', 0, 1, '', '', 0),
(NULL, 'Francisco Perez', NULL, 'francisco@gmail.com', 'abc', 0, 1, '', NULL, 0),
(NULL, 'Roberto Martinez', NULL, 'roberto@hotmail.com.mx', 'abc', 0, 1, '', NULL, 0),
(NULL, 'Francisco Rodríguez Baeza', NULL, 'frodriguez@gmail.com', 'abc', 0, 1, '', NULL, 0),

(NULL, 'Israel Solís Ahuactzin', NULL, 'israel.flash@hotmail.com', 'abc', 1, 1, '', NULL, 0),
(NULL, 'Luis Alberto Zacarías Martínez', NULL, 'secarmesi@gmail.com', 'abc', 1, 1, '', NULL, 0),
(NULL, 'Marcos David García Marquez', NULL, 'abs14@outlook.es', 'abd', 1, 1, '', NULL, 0),
(NULL, 'Francisco Rodríguez Baeza', NULL, 'secarmesi14@gmail.com', 'abc', 1, 1, '', NULL, 0);

INSERT INTO `reports` (`id`, `id_user`, `title`, `content`, `created_at`, `modified_at`) VALUES
(NULL, (SELECT id_user FROM users WHERE mail = 'betho6990@gmail.com'), 'Sin clase', 'El profesor no viene toda la semana', '2021-11-14', '2021-11-21'),
(NULL, (SELECT id_user FROM users WHERE mail = 'francisco@gmail.com'), 'Mi profesor es vulgar', 'El profesor es muy vulgar a la hora de revisar debido a que agrede verbalmente cuando tenemos algunos errores', '2021-10-21', '2021-11-07'),
(NULL, (SELECT id_user FROM users WHERE mail = 'roberto@hotmail.com.mx'), 'La profesora de Programación I me acosa', 'La profesora de Programación I con NRC: 7214 hizo un grupo de WhatsApp y me envía mensajes por la noche diciéndome que sueña conmigo', '2021-10-21', '2021-11-07'),
(NULL, (SELECT id_user FROM users WHERE mail = 'frodriguez@gmail.com'), 'Agua', 'Los bebederos de la facultad llevan una semana sin agua', '2021-10-21', '2021-10-14');
