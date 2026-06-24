-- -----------------------------------------------------------------------------
-- Tabla: clientes_promociones
-- -----------------------------------------------------------------------------
-- Registros generados desde el formulario público de registro de clientes
-- (campaña promocional / novedades de Yamaha). Es una tabla NUEVA e
-- independiente: NO reemplaza ni modifica la tabla `clientes` usada por ventas.
--
-- Convención del proyecto (sin SoftDeletes de Laravel):
--   * activo   -> 1 activo / 0 inactivo
--   * borrado  -> 0 vigente / 1 eliminado
--
-- Importar en la base de datos definida en .env (bd_yamaha_cotizations).
-- -----------------------------------------------------------------------------

SET @saved_cs_client = @@character_set_client;
SET character_set_client = utf8mb4;

CREATE TABLE IF NOT EXISTS `clientes_promociones` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(50) NOT NULL,
  `numero_documento` varchar(25) NOT NULL,
  `nombres_apellidos` varchar(255) NOT NULL,
  `celular` varchar(25) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `acepta_privacidad` tinyint NOT NULL DEFAULT '0',
  `acepta_promociones` tinyint NOT NULL DEFAULT '0',
  `activo` tinyint DEFAULT '1',
  `borrado` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_cp_numero_documento` (`numero_documento`),
  KEY `indx_cp_correo` (`correo`),
  KEY `indx_cp_celular` (`celular`),
  KEY `indx_cp_activo` (`activo`),
  KEY `indx_cp_borrado` (`borrado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

SET character_set_client = @saved_cs_client;
