CREATE TABLE IF NOT EXISTS id6533743_syslog.rh_ausencia_tipo (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	clave CHAR(3) NOT NULL, 
	nombre VARCHAR(15) NOT NULL, 
	descr VARCHAR(50) NOT NULL, 
	clave_clase CHAR(2) NOT NULL, 
	PRIMARY KEY(id), 
	INDEX IDX_CLAVE (clave ASC),
	CONSTRAINT FK_clave_clase FOREIGN KEY (clave_clase) REFERENCES id6533743_syslog.rh_ausencia_clase(clave) 
		ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;



INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('VAO', 'VACACIONES ORDINARIAS', 'VACACIONES ORDINARIAS', 'VA');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('VAE', 'VACACIONES EXTEMPORANEAS', 'VACACIONES EXTEMPORANEAS', 'VA');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('150', 'PERMISO ECONOMICO', 'PERMISO ECONOMICO', 'PE');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('147', 'PEREMISO RENUNCIABLE', 'PEREMISO RENUNCIABLE', 'PE');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('148', 'PERMISO 90 DIAS', 'PERMISO 90 DIAS', 'PE');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('149', 'PERMISO  6 AÑOS', 'PERMISO  6 AÑOS', 'PE');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('103', 'EXAMENES MEDICO', 'EXAMENES MEDICO', 'ME');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('104', 'ATENCION MEDICA', 'ATENCION MEDICA', 'ME');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('COA', 'COMISION ADMINISTRATIVA', 'COMISION ADMINISTRATIVA', 'CO');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('COS', 'COMISION SINDICAL', 'COMISION SINDICAL', 'CO');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('ASD', 'ASCENSO DEFINITIVO', 'ASCENSO DEFINITIVO', 'AS');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('AST', 'ASCENSO TEMPORAL', 'ASCENSO TEMPORAL', 'AS');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('JUB', 'JUBILACION', 'JUBILACION', 'TE');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('LIQ', 'LIQUIDACION', 'LIQUIDACION', 'TE');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('REC', 'DESPIDO', 'DESPIDO', 'TE');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('NEG', 'PERMISO NEGOCIADO', 'PERMISO NEGOCIADO', 'PE');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('119', 'ATENCION MEDICA FORANEA', 'ATENCION MEDICA FORANEA', 'ME');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('CAC', 'CAPACITACION CONTRACTUAL', 'CAPACITACION CONTRACTUAL', 'CA');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('CAP', 'CAPACITACION PROFESIONAL', 'CAPACITACION PROFESIONAL', 'CA');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('FI', 'FALTA INJUSTIFICADA', 'FALTA INJUSTIFICADA', 'FA');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('???', 'AUSENCIA DESCONOCIDA', 'AUSENCIA DESCONOCIDA', 'FA');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('SAA', 'SANCION ADMINISTRATIVA', 'SANCION ADMINISTRATIVA', 'SA');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('SAS', 'SANCION SINDICAL', 'SANCION SINDICAL', 'SA');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('VAJ', 'VACACIONES PRE-JUBILATORIAS', 'VACACIONES PRE-JUBILATORIAS', 'VA');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('DDP', 'DISPOSICION DE PERSONAL', 'DISPOSICION DE PERSONAL', 'FA');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('NUE', 'PLAZA NUEVA', 'PLAZA NUEVA', 'CR');
INSERT INTO id6533743_syslog.rh_ausencia_tipo (clave, nombre, descr, clave_clase) VALUES ('VEN', 'VENCIMIENTO DE PLAZA OD', 'VENCIMIENTO DE PLAZA OD', 'RE');
