CREATE TABLE IF NOT EXISTS syslog.t01_descanso (
    clave varchar(2) NOT NULL,
    descr VARCHAR(45) NOT NULL,
    valor INTEGER UNSIGNED NOT NULL,
    abrevn VARCHAR(10),
    PRIMARY KEY(clave)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
