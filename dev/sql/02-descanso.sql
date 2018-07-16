CREATE TABLE IF NOT EXISTS syslog.rh_descanso (
    clave CHAR(2) NOT NULL,
    descr VARCHAR(45) NOT NULL,
    valor INT UNSIGNED NOT NULL,
    abrevn VARCHAR(10),
    PRIMARY KEY(clave)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO syslog.rh_descanso (clave, descr, valor, abrevn) VALUES ('L', 'LUNES', 64, '1');
INSERT INTO syslog.rh_descanso (clave, descr, valor, abrevn) VALUES ('M', 'MARTES', 32, '2');
INSERT INTO syslog.rh_descanso (clave, descr, valor, abrevn) VALUES ('X', 'MIERCOLES', 16, '3');
INSERT INTO syslog.rh_descanso (clave, descr, valor, abrevn) VALUES ('J', 'JUEVES', 8, '4');
INSERT INTO syslog.rh_descanso (clave, descr, valor, abrevn) VALUES ('V', 'VIERNES', 4, '5');
INSERT INTO syslog.rh_descanso (clave, descr, valor, abrevn) VALUES ('S', 'SABADO', 2, '6');
INSERT INTO syslog.rh_descanso (clave, descr, valor, abrevn) VALUES ('D', 'DOMINGO', 1, '7');
INSERT INTO syslog.rh_descanso (clave, descr, valor, abrevn) VALUES ('SD', 'SAB. Y DOM.', 3, '6, 7');
