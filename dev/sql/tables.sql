use syslog;
CREATE TABLE IF NOT EXISTS t01_trabs (
    id int UNSIGNED NOT NULL,
    nombre VARCHAR(45) NOT NULL,
    ap_pat VARCHAR(45) NOT NULL,
    ap_mat VARCHAR(45),
    apodo VARCHAR(35),
    activo tinyint unsigned not null,
    fec_nac DATE,
    fec_cat DATE,
    fec_ingreso DATE,
    fec_depto DATE,
    fec_planta DATE,
    curp VARCHAR(18),
    rfc VARCHAR(13),
    calle_no VARCHAR(30),
    colonia VARCHAR(25),
    municipio VARCHAR(35),
    entidad_fed VARCHAR(35),
    pais VARCHAR(25),
    nacionalidad VARCHAR(40),
    edo_civil VARCHAR(30),
    sexo ENUM('H', 'M') NOT NULL,
    telefono VARCHAR(18),
    email VARCHAR(128),
    sit_cont ENUM('P', 'T') NOT NULL,
    sit_sind ENUM('S', 'C') NOT NULL,
    PRIMARY KEY (id),
    UNIQUE INDEX nombre_UNIQUE (nombre),
    UNIQUE INDEX ap_pat_UNIQUE (ap_pat)
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8;


