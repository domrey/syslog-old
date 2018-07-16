CREATE TABLE IF NOT EXISTS syslog.rh_ausencia_clase (
	clave CHAR(2) NOT NULL, 
	nombre VARCHAR(15) NOT NULL, 
	descr VARCHAR(50) NOT NULL, 
	id_vacancia INT UNSIGNED NOT NULL, 
	PRIMARY KEY(clave), 
	INDEX FK_id_vacancia (id_vacancia ASC),
	CONSTRAINT FK_id_vacancia 
		FOREIGN KEY id_vacancia 
		REFERENCES syslog.rh_vacancia(id) 
		ON DELETE CASCADE 
		ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;


