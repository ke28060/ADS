-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 06-11-2023 a las 16:09:50
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `sistema`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `privilegios`
-- 

CREATE TABLE `privilegios` (
  `idPrivilegio` int(11) NOT NULL auto_increment,
  `labelPrivilegio` varchar(30) NOT NULL,
  `pathPrivilegio` varchar(200) NOT NULL,
  `iconPrivilegio` varchar(50) NOT NULL,
  `namePrivilegio` varchar(30) NOT NULL,
  PRIMARY KEY  (`idPrivilegio`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `privilegios`
-- 

INSERT INTO `privilegios` VALUES (1, 'emitir boleta', '../salesModule/indexEmitirBoleta', 'emitirboleta.png', 'emitirBoleta');
INSERT INTO `privilegios` VALUES (2, 'emitir proforma', '../salesModule/indexEmitirProforma', 'emitirProforma.png', 'emitirProforma');
INSERT INTO `privilegios` VALUES (3, 'registrar despacho', '../salesModule/indexRegistrarDespacho', 'registrarDespacho.png', 'registrarDespacho');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios`
-- 

CREATE TABLE `usuarios` (
  `login` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `pregunta` varchar(50) NOT NULL,
  `respuesta` varchar(30) NOT NULL,
  PRIMARY KEY  (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `usuarios`
-- 

INSERT INTO `usuarios` VALUES ('gato', '12345', 1, 'como se llama mi mascota', 'boby');
INSERT INTO `usuarios` VALUES ('perro', '987654', 1, 'como se llama mi abuela', 'kity');
INSERT INTO `usuarios` VALUES ('rata', '12345', 1, 'como me gusta el queso', 'frito');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuariosprivilegios`
-- 

CREATE TABLE `usuariosprivilegios` (
  `idPrivilegio` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  PRIMARY KEY  (`idPrivilegio`,`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `usuariosprivilegios`
-- 

INSERT INTO `usuariosprivilegios` VALUES (1, 'gato');
INSERT INTO `usuariosprivilegios` VALUES (1, 'perro');
INSERT INTO `usuariosprivilegios` VALUES (1, 'rata');
INSERT INTO `usuariosprivilegios` VALUES (2, 'gato');
INSERT INTO `usuariosprivilegios` VALUES (2, 'perro');
INSERT INTO `usuariosprivilegios` VALUES (3, 'gato');
