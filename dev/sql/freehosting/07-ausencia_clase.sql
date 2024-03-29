CREATE TABLE IF NOT EXISTS id6146539_syslog.rh_ausencia_clase (
	clave CHAR(2) NOT NULL, 
	nombre VARCHAR(15) NOT NULL, 
	descr VARCHAR(50), 
	id_vacancia INT UNSIGNED NOT NULL, 
	PRIMARY KEY(clave), 
	INDEX FK_id_vacancia(id_vacancia ASC),
	CONSTRAINT FK_id_vacancia FOREIGN KEY (id_vacancia) REFERENCES id6146539_syslog.rh_vacancia(id) ON DELETE CASCADE ON UPDATE NO ACTION 
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO id6146539_syslog.rh_ausencia_clase (clave, nombre, descr, id_vacancia) VALUES ('AS', 'ASCENSO', 'ASCENSO', 1);
INSERT INTO id6146539_syslog.rh_ausencia_clase (clave, nombre, descr, id_vacancia) VALUES ('CA', 'CAPACITACION', 'CAPACITACION', 1);
INSERT INTO id6146539_syslog.rh_ausencia_clase (clave, nombre, descr, id_vacancia) VALUES ('CO', 'COMISION', 'COMISION', 1);
INSERT INTO id6146539_syslog.rh_ausencia_clase (clave, nombre, descr, id_vacancia) VALUES ('CR', 'CREACION', 'CREACION DE PLAZA', 3);
INSERT INTO id6146539_syslog.rh_ausencia_clase (clave, nombre, descr, id_vacancia) VALUES ('FA', 'FALTA', 'FALTA', 1);
INSERT INTO id6146539_syslog.rh_ausencia_clase (clave, nombre, descr, id_vacancia) VALUES ('ME', 'INCAPACIDAD', 'INCAPACIDAD MEDICA', 1);
INSERT INTO id6146539_syslog.rh_ausencia_clase (clave, nombre, descr, id_vacancia) VALUES ('PE', 'PERMISO', 'PERMISO', 1);
INSERT INTO id6146539_syslog.rh_ausencia_clase (clave, nombre, descr, id_vacancia) VALUES ('PM', 'PERMUTA', 'PERMUTA', 1);
INSERT INTO id6146539_syslog.rh_ausencia_clase (clave, nombre, descr, id_vacancia) VALUES ('RE', 'RENOVACION', 'RENOVACION DE PLAZA', 4);
INSERT INTO id6146539_syslog.rh_ausencia_clase (clave, nombre, descr, id_vacancia) VALUES ('SA', 'SANCION', 'SANCION', 1);
INSERT INTO id6146539_syslog.rh_ausencia_clase (clave, nombre, descr, id_vacancia) VALUES ('SS', 'SSINDICAL', 'SANCION SINDICAL', 1);
INSERT INTO id6146539_syslog.rh_ausencia_clase (clave, nombre, descr, id_vacancia) VALUES ('TE', 'TERMINACION', 'TERMINACION', 2);
INSERT INTO id6146539_syslog.rh_ausencia_clase (clave, nombre, descr, id_vacancia) VALUES ('VA', 'VACACIONES', 'VACACIONES', 1);

