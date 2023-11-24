-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 19-11-2022 a las 11:59:18
-- Versión del servidor: 10.8.2-MariaDB-1:10.8.2+maria~focal
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Log`
--

CREATE TABLE `Log` (
  `Descripcion` varchar(50) NOT NULL,
  `IP` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Log`
--

INSERT INTO `Log` (`Descripcion`, `IP`) VALUES
('Contraseña incorrecta,usuario con DNI  79045038H', '172.17.0.1'),
('Contraseña incorrecta,usuario con DNI  79045038H', '172.17.0.1'),
('Contraseña incorrecta,usuario con DNI  79045038H', '172.17.0.1'),
('Contraseña incorrecta,usuario con DNI  79045038H', '172.17.0.1'),
('Contraseña incorrecta,usuario con DNI 79045038H', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Contraseña incorrecta,usuario con DNI 79045038H', '172.17.0.1'),
('Contraseña incorrecta,usuario con DNI 79045038H', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Contraseña incorrecta,usuario con DNI 79045038H', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Contraseña incorrecta,usuario con DNI 79045038H', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Contraseña incorrecta,usuario con DNI 79045038H', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1'),
('Se ha iniciado sesión correctamente', '172.17.0.1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Perro`
--

CREATE TABLE `Movil` (
  `Modelo` varchar(20) NOT NULL,
  `Marca` varchar(20) NOT NULL,
  `Precio` int(3) NOT NULL,
  `Gama` varchar(20) NOT NULL,
  `SistemaOperativo` varchar(20) NOT NULL,
  `DNIDueño` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Perro`
--

INSERT INTO `Movil` (`Modelo`, `Marca`, `Precio`, `Gama`, `SistemaOperativo`, `DNIDueño`) VALUES
('iPhone15', 'Apple', 1000, 'Alta', 'IOS','79224746G'),
('iPhone8', 'Apple', 400, 'Media', 'IOS', '79224746G'),
('Galaxy Mini', 'Samsung', 40, 'Baja', 'Android','72231041R');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `Nombre` varchar(20) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Telefono` int(9) NOT NULL,
  `Fecha` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Contrasena` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`Nombre`, `DNI`, `Telefono`, `Fecha`, `Email`, `Contrasena`) VALUES
('Alain Pedrueza', '79224746G', 633501918, '2003-12-18', 'alainpedrueza@gmail.com', 'alain'),
('Aitor Gonzalo', '72231041R', 663655005, '2003-02-9', 'aitorgonzalo03@gmail.com', 'aitor');
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Perro`
--
ALTER TABLE `Movil`
  ADD PRIMARY KEY (`Modelo`,`DNIDueño`),
  ADD KEY `DNIDueñoYMovil` (`DNIDueño`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`DNI`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Perro`
--
ALTER TABLE `Movil`
  ADD CONSTRAINT `DNIDueñoYMovil` FOREIGN KEY (`DNIDueño`) REFERENCES `Usuario` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
