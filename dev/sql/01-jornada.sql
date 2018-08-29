CREATE TABLE IF NOT EXISTS syslog.rh_jornada (
    clave INT UNSIGNED NOT NULL COMMENT 'Clave de Jornada',
    descr VARCHAR(40) NOT NULL COMMENT 'Descripción',
    clave_texto CHAR(2) NOT NULL COMMENT 'Clave como text',
    PRIMARY KEY (clave)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO syslog.rh_jornada (clave, descr, clave_texto) VALUES (0, 'DIURNO', '00');
INSERT INTO syslog.rh_jornada (clave, descr, clave_texto) VALUES (1, 'TURNO CONTINUO', '01');
INSERT INTO syslog.rh_jornada (clave, descr, clave_texto) VALUES (2, 'RELEVO TURNO CONTINUO', '02');
INSERT INTO syslog.rh_jornada (clave, descr, clave_texto) VALUES (3, 'TURNO FIJO NOCTURNO', '03');
INSERT INTO syslog.rh_jornada (clave, descr, clave_texto) VALUES (4, 'TURNO DICONTINUO MIXTO', '04');
INSERT INTO syslog.rh_jornada (clave, descr, clave_texto) VALUES (5, 'RELEVO TURNO-DIURNO', '05');
INSERT INTO syslog.rh_jornada (clave, descr, clave_texto) VALUES (6, 'RELEVO DIURNO-TURNO', '06');
INSERT INTO syslog.rh_jornada (clave, descr, clave_texto) VALUES (7, 'TURNO FIJO DIURNO', '07');
INSERT INTO syslog.rh_jornada (clave, descr, clave_texto) VALUES (8, 'TURNO CONTINUO (5 DIAS)', '08');
INSERT INTO syslog.rh_jornada (clave, descr, clave_texto) VALUES (9, 'TURNO CONTINUO (4 HOMBRES/PUESTO)', '09');
