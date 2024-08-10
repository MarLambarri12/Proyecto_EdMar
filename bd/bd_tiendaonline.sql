-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2024 a las 07:09:29
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.1.16

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
CREATE DATABASE IF NOT EXISTS `bd_tiendaonline` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `usuario`, `sexo`, `fecha_nacimiento`, `email`, `pass`, `privilegio`) VALUES
(1, 'Edgar Adrián', 'Preciado', 'Naranjo', 'EdgarAd', 'Masculino', '1997-11-09', 'edgar_@gmail.com', '$2y$10$iDFHZ06gjrY9fEy8iaBg7O9fRZV.CxmIdr2F7w3x1acLmj9OKZhvq', 'Cliente'),
(2, 'María', 'Lambarri', 'Hernández', 'Mar', 'Femenino', '1997-12-07', 'mlambarri3@gmail.com', '$2y$10$borZuxhPyEsG59AjjAu1XOcYNz2YgfHj5E5XHXhYqOsBVqmnRXbdK', 'Cliente'),
(3, 'Matias', 'Almeyda', 'Lozano', 'matichiva', 'Masculino', '1995-08-05', 'mati@gmail.com', '$2y$10$IQe/QWFzDhPd2H5FMRM1KeD6c9n7nlV/.FVxZKx6g7dsU/VvBQIjG', 'Cliente'),
(5, 'María', 'Lambarri', 'Hernandez', 'Admin', 'Femenino', '1997-12-07', 'admin@gmail.com', '$2y$10$HaUBAizKuMQ9GTQwQHdT3OMsEJU3Pipmjg7QcJ52oyXRSoaV6Hxfy', 'Admin'),
(6, 'Brenda', 'Lambarri', 'Hernandez', 'Usuario', 'Femenino', '2018-02-01', 'usuario@gmail.com', '$2y$10$Z.ho81ucBjI53Wa/rF97f.ZhcsSo8g..5nPs8Fjmt3q4wlu8Ugb9e', 'Cliente'),
(9, 'Martina', 'Davalos', 'Peluche', 'martidp', 'Femenino', '2002-10-30', 'peluche@hotmail.com', '$2y$10$j7fuATCDSbhfOPhgHILNB.k.THmyF1RuAAV/EVjmG0iTyKS8R1u3O', 'Cliente');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
