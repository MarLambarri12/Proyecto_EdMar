-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-08-2024 a las 00:30:17
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_tiendaonline`
--
CREATE DATABASE IF NOT EXISTS `bd_tiendaonline` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_tiendaonline`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `sexo` enum('Masculino','Femenino','Indeciso') NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `privilegio` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `usuario`, `sexo`, `fecha_nacimiento`, `email`, `pass`, `privilegio`) VALUES
(85, 'Feliciano', 'Lambarri', 'Mata', 'user123', 'Femenino', '2024-07-12', 'usuario45@gmail.com', '', 'Admin'),
(91, 'Brenda', 'Lambarri', 'Hernandez', 'user', 'Femenino', '2024-07-11', 'mlambarri324@gmail.com', '', 'Cliente'),
(92, 'Andrea', 'Hernandez', 'Hernandez', 'user', 'Femenino', '2024-07-11', 'ejemplo463@gmail.com', '$2y$10$fv29/rGc2ep5M3hEK1HRi.HwGvON34U00tyU7Lul8LudbmN6KRvuG', 'Admin'),
(93, 'Valeria', 'Montero', 'Andrade', 'Admin', 'Femenino', '2024-08-08', 'mlambarr0i3@gmail.com', '$2y$10$Jkt4nEPxyN5sdXmXRveZVeCEhTmHT2.VsZfdoSIPWL5wjld0cYz0i', 'Admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
