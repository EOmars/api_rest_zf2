
create database escuela;

CREATE TABLE `t_alumnos` (
  `id_t_usuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `ap_paterno` varchar(80) DEFAULT NULL,
  `ap_materno` varchar(80) DEFAULT NULL,
  `activo` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_t_usuarios`)
) ENGINE=InnoDB;

insert into t_alumnos values (default,"John","Dow","Down",1);

CREATE TABLE `t_materias` (
  `id_t_materias` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `activo` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_t_materias`)
) ENGINE=InnoDB;

insert into t_materias values (default,'matematicas',1);
insert into t_materias values (default,'programacion I',1);
insert into t_materias values (default,'ingenieria de sofware',1);

CREATE TABLE `t_calificaciones` (
  `id_t_calificaciones` int(11) NOT NULL AUTO_INCREMENT,
  `id_t_materias` int(11) NOT NULL,
  `id_t_usuarios` int(11) NOT NULL,
  `calificacion` decimal(10,2) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`id_t_calificaciones`),
  KEY `id_t_materias` (`id_t_materias`),
  KEY `id_t_usuarios` (`id_t_usuarios`),
  CONSTRAINT `t_calificaciones_ibfk_1` FOREIGN KEY (`id_t_materias`) REFERENCES `t_materias` (`id_t_materias`),
  CONSTRAINT `t_calificaciones_ibfk_2` FOREIGN KEY (`id_t_usuarios`) REFERENCES `t_alumnos` (`id_t_usuarios`)
) ENGINE=InnoDB;
