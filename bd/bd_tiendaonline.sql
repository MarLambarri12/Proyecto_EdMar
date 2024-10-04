-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1

-- Tiempo de generación: 23-08-2024 a las 00:30:17

-- Tiempo de generación: 04-10-2024 a las 08:21:30
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


-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'Electrónica'),
(2, 'Moda y Ropa'),
(3, 'Hogar y Jardín'),
(4, 'Salud y Belleza'),
(5, 'Alimentos y Bebidas'),
(6, 'Deportes'),
(7, 'Juguetes'),
(8, 'Libros y Papelería'),
(9, 'Mascotas'),
(10, 'Oficina y papelería'),
(21, 'Salud y belleza'),
(36, 'Tecnología'),
(38, 'Dispositivos inteligentes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos_y_computo`
--

DROP TABLE IF EXISTS `dispositivos_y_computo`;
CREATE TABLE IF NOT EXISTS `dispositivos_y_computo` (
  `id_dispositivos` int(11) NOT NULL AUTO_INCREMENT,
  `id_subcategoria` int(11) DEFAULT NULL,
  `Marca` varchar(40) NOT NULL,
  `capacidad_almacenamiento` varchar(20) DEFAULT NULL,
  `memoria_RAM` varchar(20) DEFAULT NULL,
  `procesador` varchar(20) DEFAULT NULL,
  `pulgadas_pantalla` varchar(20) DEFAULT NULL,
  `conectividad` varchar(30) DEFAULT NULL,
  `sistema_operativo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_dispositivos`),
  KEY `id_subcategoria` (`id_subcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas_afi`
--

DROP TABLE IF EXISTS `empresas_afi`;
CREATE TABLE IF NOT EXISTS `empresas_afi` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(50) NOT NULL,
  `RFC` varchar(10) NOT NULL,
  `Localizacion` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresas_afi`
--

INSERT INTO `empresas_afi` (`id_empresa`, `nombre_empresa`, `RFC`, `Localizacion`, `Email`, `Telefono`) VALUES
(3, 'Pirma Sport', 'MSJ940418T', 'Purísima del Rincón, Guanajuato', 'onlinepirma@gmail.com', '01-490-607'),
(8, 'Arcelor', 'COPJD65432', 'lazaro', 'mh7388592@gmail.com', '7531538286');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `id_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `ruta_imagen` varchar(50) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha_subida` date DEFAULT NULL,
  PRIMARY KEY (`id_imagen`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id_imagen`, `ruta_imagen`, `nombre`, `fecha_subida`) VALUES
(4, 'C:/xampp/htdocs/Proyecto_EdMar/sistema/img/logo1-r', 'logo1-removebg-preview.png', '2024-09-12'),
(5, '../../archivosimagen.jpg', 'imagen.jpg', '2024-09-12'),
(6, '../../archivos/clic.gif', 'clic.gif', '2024-09-13'),
(7, '../../archivos/clic.gif', 'clic.gif', '2024-09-13'),
(8, '../../archivos/Logo1.png', 'Logo1.png', '2024-09-25'),
(9, '../../archivos/Logo1.png', 'Logo1.png', '2024-09-25'),
(10, '../../archivos/tabla.jpg', 'tabla.jpg', '2024-09-25'),
(11, '../../archivos/logo1-removebg-preview.png', 'logo1-removebg-preview.png', '2024-09-25'),
(12, '../../archivos/estado.JPG', 'estado.JPG', '2024-10-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id_productos` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) DEFAULT NULL,
  `id_subcategoria` int(11) DEFAULT NULL,
  `id_imagen` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_productos`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_subcategoria` (`id_subcategoria`),
  KEY `id_imagen` (`id_imagen`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_productos`, `id_categoria`, `id_subcategoria`, `id_imagen`, `descripcion`, `precio`) VALUES
(10, 38, 13, 6, 'color Verde', '990.00'),
(11, 38, 19, 7, 'Lg', '0.00'),
(12, 1, 6, 8, 'Moderno luces rojas', '8630.00'),
(13, 1, 6, 9, 'General', '6500.00'),
(14, 1, 6, 10, 'otro', '6280.00'),
(15, 1, 6, 11, 'otro 2', '5942.00'),
(16, 1, 6, 12, 'Nuevo modelo', '15.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representanteempresa`
--

DROP TABLE IF EXISTS `representanteempresa`;
CREATE TABLE IF NOT EXISTS `representanteempresa` (
  `id_repre` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `fecha_nac` date NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `id_empresa` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_repre`),
  KEY `id_empresa` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

DROP TABLE IF EXISTS `subcategorias`;
CREATE TABLE IF NOT EXISTS `subcategorias` (
  `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) DEFAULT NULL,
  `nombre_subcategoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_subcategoria`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id_subcategoria`, `id_categoria`, `nombre_subcategoria`) VALUES
(6, 1, 'Refrigerador'),
(7, 2, 'Faldas'),
(8, 2, 'Maletas de Viaje'),
(9, 21, 'Labiales'),
(11, 38, 'Celulares'),
(13, 38, 'Computadoras'),
(14, 36, 'Accesorios para celulares'),
(15, 2, 'Zapatos'),
(16, 36, 'Accesorios para computadoras'),
(17, 36, 'Camaras'),
(18, 36, 'Audifonos'),
(19, 38, 'Tablets'),
(20, 21, 'Maquillaje'),
(21, 21, 'Cuidado del cabello'),
(22, 4, 'Cuidado de la piel'),
(23, 4, 'Perfumes'),
(24, 3, 'Salud');

-- --------------------------------------------------------

--
>>>>>>> Stashed changes
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

) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4;
>>>>>>> Stashed changes

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `usuario`, `sexo`, `fecha_nacimiento`, `email`, `pass`, `privilegio`) VALUES

(85, 'Feliciano', 'Lambarri', 'Mata', 'user123', 'Femenino', '2024-07-12', 'usuario45@gmail.com', '', 'Admin'),
(91, 'Brenda', 'Lambarri', 'Hernandez', 'user', 'Femenino', '2024-07-11', 'mlambarri324@gmail.com', '', 'Cliente'),
(92, 'Andrea', 'Hernandez', 'Hernandez', 'user', 'Femenino', '2024-07-11', 'ejemplo463@gmail.com', '$2y$10$fv29/rGc2ep5M3hEK1HRi.HwGvON34U00tyU7Lul8LudbmN6KRvuG', 'Admin'),
(93, 'Valeria', 'Montero', 'Andrade', 'Admin', 'Femenino', '2024-08-08', 'mlambarr0i3@gmail.com', '$2y$10$Jkt4nEPxyN5sdXmXRveZVeCEhTmHT2.VsZfdoSIPWL5wjld0cYz0i', 'Admin');

(85, 'Feliciano', 'Lambarri', 'Mata', 'Usuario14', 'Femenino', '2024-07-12', 'usuario45@gmail.com', '', 'Cliente'),
(92, 'Andrea', 'Hernandez', 'Hernandez', 'user', 'Femenino', '2024-07-11', 'ejemplo463@gmail.com', '$2y$10$fv29/rGc2ep5M3hEK1HRi.HwGvON34U00tyU7Lul8LudbmN6KRvuG', 'Admin'),
(93, 'Valeria', 'Montero', 'Andrade', 'Admin', 'Femenino', '2024-08-08', 'mlambarri3u@gmail.com', '', 'Admin'),
(98, 'Feliciano', 'Hernandez', 'Garcia', 'user', 'Indeciso', '2024-07-12', 'gfgjfd@gmail.com', '$2y$10$0e2PBGR8nx.YFevgieoV9.NfH6APiLC0T8X8yNA/b36/B1Ha6GnE.', 'Admin');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dispositivos_y_computo`
--
ALTER TABLE `dispositivos_y_computo`
  ADD CONSTRAINT `dispositivos_y_computo_ibfk_1` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id_subcategoria`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id_subcategoria`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id_imagen`);

--
-- Filtros para la tabla `representanteempresa`
--
ALTER TABLE `representanteempresa`
  ADD CONSTRAINT `representanteempresa_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresas_afi` (`id_empresa`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
>>>>>>> Stashed changes
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
