CREATE TABLE IF NOT EXISTS `gimnasio_usuarios` (
  `id`              INT NOT NULL AUTO_INCREMENT,

  `apellido`      VARCHAR(64) DEFAULT NULL,
  `nombre`          VARCHAR(64) DEFAULT NULL,
  `telefono`        VARCHAR(32) DEFAULT NULL,
  `correo`          VARCHAR(120) DEFAULT NULL,

  `log_correo`      VARCHAR(120) DEFAULT NULL,
  `log_pass`        VARCHAR(32) DEFAULT NULL,

  `validado`        INT DEFAULT NULL,
  `tipo`            INT DEFAULT 2,

  `estado`          INT DEFAULT NULL,
  `creado`          DATETIME DEFAULT NULL,
  `actualizado`     DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `gimnasio_planes` (
  `id`              INT NOT NULL AUTO_INCREMENT,

  `nombre`          VARCHAR(64) DEFAULT NULL,
  `periodo`         INT DEFAULT NULL,
  `precio`          FLOAT(10,2) DEFAULT NULL,

  `estado`          INT DEFAULT NULL,
  `creado`          DATETIME DEFAULT NULL,
  `actualizado`     DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `gimnasio_usuarios_membresia` (
  `id`              INT NOT NULL AUTO_INCREMENT,

  `usuario_cliente_id`      INT NOT NULL,
  `plan_id`         INT NOT NULL,
  `fecha_inicio`    DATE DEFAULT NULL,
  `pago`            INT DEFAULT NULL,

  `estado`          INT DEFAULT NULL,
  `creado`          DATETIME DEFAULT NULL,
  `actualizado_usuario_id` INT DEFAULT NULL,
  `actualizado`     DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `gimnasio_usuarios` ADD `identificacion` VARCHAR(12) DEFAULT NULL AFTER `id`;
ALTER TABLE `gimnasio_usuarios` ADD `apodo` VARCHAR(32) DEFAULT NULL AFTER `nombre`;

ALTER TABLE `gimnasio_usuarios` ADD `direccion` TEXT DEFAULT NULL AFTER `telefono`;

-- 13/05/2020
CREATE TABLE IF NOT EXISTS `gimnasio_usuarios_membresia_historial` (
  `id`              INT NOT NULL AUTO_INCREMENT,

  `membresia_id`   INT NOT NULL,
  `accion`         INT NOT NULL,

  `estado`          INT DEFAULT NULL,
  `creado`          DATETIME DEFAULT NULL,
  `actualizado_usuario_id` INT DEFAULT NULL,
  `actualizado`     DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;





-- Ejemplo de prueba

-- CREATE TABLE IF NOT EXISTS `tabla_nombre` (
--   `columna`    VARCHAR(64) DEFAULT NULL,
--   `columna`    DECIMAL(10,2) DEFAULT NULL,
--   `columna`    DATETIME DEFAULT NULL,
--   PRIMARY KEY (`id`),
--   FOREIGN KEY (`columna_id`) REFERENCES `tabla_nombre_referencia`(`id`)
-- ) ENGINE = InnoDB;