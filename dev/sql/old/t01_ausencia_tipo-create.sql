CREATE TABLE IF NOT EXISTS syslong.t01_ausencia_tipo (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(25) NOT NULL,
    descr VARCHAR(80),
    clave_ausencia VARCHAR(2) NOT NULL,
    PRIMARY KEY(id),
    INDEX UNIQUE(nombre),
    CONSTRAINT fk_clave_ausencia(clave_ausencia)
        REFERENCES syslog.t01_ausencia_clave(clave)
        ON UPDATE CASCADA
        ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;
