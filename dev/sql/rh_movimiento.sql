CREATE TABLE IF NOT EXISTS syslog.rh_movimiento (
	clave_trab INT UNSIGNED NOT NULL, 
	id_plaza INT UNSIGNED NOT NULL, 
	id_ausencia_por INT UNSIGNED NOT NULL, 
	fec_inicio DATE NOT NULL, 
	fec_termino DATE  DEFAULT NULL, 
	tipo_mov ENUM ('TEMPORAL', 'DEFINITIVO') NOT NULL DEFAULT 'TEMPORAL', 
	descr TEXT DEFAULT NULL, 
	docs TEXT DEFAULT NULL, 
	motivo TEXT DEFAULT NULL, 
	referencia DEFAULT NULL, 
	ref_motivo TEXT DEFAULT NULL, 
	INDEX IDX_clave_trab(clave_trab ASC), 
	CONSTRAINT FK_clave_trab FOREIGN KEY (clave_trab) 
		REFERENCES syslog.rh_trab(clave) 
		ON DELETE CASCADE 
		ON UPDATE NO ACTION, 
	CONSTRAINT FK_id_plaza FOREIGN KEY (id_plaza) 
		REFERENCES syslog.rh_plaza(id) 
		ON DELETE CASCADE 
		ON UPDATE NO ACTION, 
	CONSTRAINT FK_id_ausencia_por FOREIGN KEY(id_ausencia_por) 
		REFERENCES syslog.rh_ausencia(id) 
		ON DELETE CASCADE 
		ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;


