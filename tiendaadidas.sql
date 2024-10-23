-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2024 a las 23:41:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendaadidas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `precio` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `Ventas_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `precio`, `cantidad`, `Ventas_id`, `producto_id`) VALUES
(3, 100, 2, 1, 1),
(4, 100, 3, 1, 4),
(5, 100, 4, 21, 4),
(6, 100, 4, 21, 3),
(7, 100, 4, 21, 2),
(8, 100, 4, 22, 4),
(9, 100, 4, 22, 3),
(10, 100, 4, 22, 2),
(11, 100, 4, 22, 5),
(12, 100, 4, 23, 4),
(13, 100, 4, 23, 3),
(14, 100, 4, 23, 2),
(15, 100, 4, 23, 5),
(16, 100, 4, 24, 4),
(17, 100, 4, 24, 3),
(18, 100, 4, 24, 2),
(19, 100, 4, 24, 5),
(20, 100, 4, 24, 6),
(21, 100, 4, 25, 4),
(22, 100, 4, 25, 3),
(23, 100, 4, 25, 2),
(24, 100, 4, 25, 5),
(25, 100, 4, 25, 6),
(26, 150, 50, 25, 1),
(27, 100, 99, 26, 3),
(28, 100, 99, 26, 2),
(29, 100, 99, 26, 4),
(30, 100, 98, 27, 3),
(31, 100, 98, 27, 4),
(32, 100, 98, 27, 2),
(33, 100, 2, 28, 4),
(34, 100, 2, 28, 3),
(35, 100, 2, 28, 2),
(36, 100, 1, 29, 6),
(37, 100, 1, 29, 4),
(38, 100, 1, 29, 3),
(39, 150, 1, 30, 1),
(40, 100, 1, 30, 2),
(41, 100, 1, 30, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `talla` varchar(10) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `talla`, `cantidad`, `imagen`) VALUES
(1, 'Adidas Superstar', 150.00, '31', 48, 'IMG/Zapatilla1.jpg'),
(2, 'Adidas Stan Smith', 100.00, '31', 94, 'IMG/Zapatilla2.jpg'),
(3, 'Adidas Gazelle', 100.00, '31', 93, 'IMG/Zapatilla3.jpg'),
(4, 'Adidas Ultraboots', 100.00, '31', 94, 'IMG/Zapatilla4.jpg'),
(5, 'Adidas Campus', 100.00, '31', 100, 'IMG/Zapatilla5.jpg'),
(6, 'Adidas Continental', 100.00, '31', 99, 'IMG/Zapatilla6.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `dni`, `contrasena`, `tipo_usuario`) VALUES
(4, 'fernan', 'flo', 'fernan@gmail.com', '77832282', '$2y$10$vA3mwBI94HaIaakOZYEsEu01Ta0psrb1hb6jLenS0Ajiru96FPmDK', 0),
(5, 'tony', 'stark', 'tony@gmail.com', '77378224', '$2y$10$eJJgdPMVqyjImTLI/tmtvOm9./3femlU4.bh6NoqP2njWHhwoKLZu', 0),
(6, 'take', 'xdxd', 'prueba@gmail.com', '76232131', '$2y$10$cnTHBsmlTdoDOJkqBzdLgOLPlr.wYgihIzXrNDe6/4z3qMnlxmboC', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `id_usuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `id_usuarios`) VALUES
(1, '2024-07-08', 5),
(21, '2024-07-09', 5),
(22, '2024-07-09', 5),
(23, '2024-07-09', 5),
(24, '2024-07-09', 5),
(25, '2024-07-09', 5),
(26, '2024-07-09', 5),
(27, '2024-07-09', 5),
(28, '2024-07-09', 5),
(29, '2024-07-10', 5),
(30, '2024-07-10', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Ventas_id` (`Ventas_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuarios` (`id_usuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`Ventas_id`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
