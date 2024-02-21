-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 07-12-2023 a las 03:08:17
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `neve`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Clientes`
--

CREATE TABLE `Clientes` (
  `Cliente_ID` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Correo` varchar(255) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Clientes`
--

INSERT INTO `Clientes` (`Cliente_ID`, `Nombre`, `Telefono`, `Correo`, `Direccion`) VALUES
(1, 'Emilio', '4651541749', 'eg72979@gmail.com', 'Circuito viñedos #146'),
(2, 'Alex', '4651233212', 'hola@gmail.com', 'benito juarez 48'),
(3, 'Carlos', '5551234567', 'carlos@example.com', 'Avenida Principal #123'),
(4, 'Ana', '9876543210', 'ana@example.com', 'Calle Secundaria #789'),
(5, 'Juan', '6549873210', 'juan@example.com', 'Plaza Central #456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetallesVenta`
--

CREATE TABLE `DetallesVenta` (
  `Detalle_ID` int(11) NOT NULL,
  `Venta_ID` int(11) DEFAULT NULL,
  `Producto_ID` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Precio_Unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `DetallesVenta`
--

INSERT INTO `DetallesVenta` (`Detalle_ID`, `Venta_ID`, `Producto_ID`, `Cantidad`, `Precio_Unitario`) VALUES
(11, 1, 1, 3, '15.99'),
(12, 2, 2, 2, '24.99'),
(13, 3, 3, 5, '8.50'),
(14, 4, 4, 1, '49.99'),
(15, 5, 5, 4, '12.75');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Empleados`
--

CREATE TABLE `Empleados` (
  `Empleado_ID` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Correo` varchar(255) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Salario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Empleados`
--

INSERT INTO `Empleados` (`Empleado_ID`, `Nombre`, `Fecha_Nacimiento`, `Telefono`, `Correo`, `Direccion`, `Salario`) VALUES
(1, 'Ana García', '1980-05-15', '5551112233', 'ana@example.com', 'Calle Principal #456', '50000.00'),
(2, 'Pedro Sánchez', '1985-08-21', '5554445566', 'pedro@example.com', 'Avenida Central #789', '60000.00'),
(3, 'Sofía Ramírez', '1990-03-10', '5557778899', 'sofia@example.com', 'Calle Comercial #123', '55000.00'),
(4, 'Javier Torres', '1988-11-28', '5553334455', 'javier@example.com', 'Avenida Peatonal #456', '65000.00'),
(5, 'Carmen López', '1995-07-02', '5556667788', 'carmen@example.com', 'Plaza Principal #789', '70000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inventario`
--

CREATE TABLE `Inventario` (
  `Inventario_ID` int(11) NOT NULL,
  `Nombre_Inventario` varchar(255) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Fecha_UltimaAct` date DEFAULT NULL,
  `Proveedor_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Inventario`
--

INSERT INTO `Inventario` (`Inventario_ID`, `Nombre_Inventario`, `Cantidad`, `Fecha_UltimaAct`, `Proveedor_ID`) VALUES
(1, 'Inventario A', 100, '2023-01-01', 1),
(2, 'Inventario B', 150, '2023-01-02', 2),
(3, 'Inventario C', 200, '2023-01-03', 3),
(4, 'Inventario D', 120, '2023-01-04', 4),
(5, 'Inventario E', 180, '2023-01-05', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos`
--

CREATE TABLE `Productos` (
  `Producto_ID` int(11) NOT NULL,
  `Nombre_Producto` varchar(255) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Cantidad_Disponible` int(11) DEFAULT NULL,
  `Proveedor_ID` int(11) DEFAULT NULL,
  `Inventario_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Productos`
--

INSERT INTO `Productos` (`Producto_ID`, `Nombre_Producto`, `Descripcion`, `Precio`, `Cantidad_Disponible`, `Proveedor_ID`, `Inventario_ID`) VALUES
(1, 'Producto A', 'Descripción del Producto A', '25.00', 50, 1, 1),
(2, 'Producto B', 'Descripción del Producto B', '30.00', 75, 2, 2),
(3, 'Producto C', 'Descripción del Producto C', '20.00', 100, 3, 3),
(4, 'Producto D', 'Descripción del Producto D', '40.00', 60, 4, 4),
(5, 'Producto E', 'Descripción del Producto E', '15.00', 90, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proveedores`
--

CREATE TABLE `Proveedores` (
  `Proveedor_ID` int(11) NOT NULL,
  `Nombre_Empresa` varchar(255) DEFAULT NULL,
  `Contacto` varchar(255) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Correo` varchar(255) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Producto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Proveedores`
--

INSERT INTO `Proveedores` (`Proveedor_ID`, `Nombre_Empresa`, `Contacto`, `Telefono`, `Correo`, `Direccion`, `Producto`) VALUES
(1, 'Proveedor A', 'Juan Martínez', '5551112233', 'proveedorA@example.com', 'Calle Principal #456', 'Producto A'),
(2, 'Proveedor B', 'María Rodríguez', '5554445566', 'proveedorB@example.com', 'Avenida Central #789', 'Producto B'),
(3, 'Proveedor C', 'Carlos Gómez', '5557778899', 'proveedorC@example.com', 'Calle Comercial #123', 'Producto C'),
(4, 'Proveedor D', 'Sofía Torres', '5553334455', 'proveedorD@example.com', 'Avenida Peatonal #456', 'Producto D'),
(5, 'Proveedor E', 'Javier Sánchez', '5556667788', 'proveedorE@example.com', 'Plaza Principal #789', 'Producto E');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ventas`
--

CREATE TABLE `Ventas` (
  `Venta_ID` int(11) NOT NULL,
  `Cliente_ID` int(11) DEFAULT NULL,
  `Empleado_ID` int(11) DEFAULT NULL,
  `Fecha_Venta` date DEFAULT NULL,
  `Total_Ventas` decimal(10,2) DEFAULT NULL,
  `Metodo_Pago` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Ventas`
--

INSERT INTO `Ventas` (`Venta_ID`, `Cliente_ID`, `Empleado_ID`, `Fecha_Venta`, `Total_Ventas`, `Metodo_Pago`) VALUES
(1, 1, 1, '2023-01-01', '150.00', 'Tarjeta'),
(2, 2, 2, '2023-01-02', '200.00', 'Efectivo'),
(3, 3, 3, '2023-01-03', '120.00', 'Cheque'),
(4, 4, 4, '2023-01-04', '180.00', 'Transf'),
(5, 5, 5, '2023-01-05', '250.00', 'Tarjeta');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Clientes`
--
ALTER TABLE `Clientes`
  ADD PRIMARY KEY (`Cliente_ID`);

--
-- Indices de la tabla `DetallesVenta`
--
ALTER TABLE `DetallesVenta`
  ADD PRIMARY KEY (`Detalle_ID`),
  ADD KEY `Venta_ID` (`Venta_ID`),
  ADD KEY `Producto_ID` (`Producto_ID`);

--
-- Indices de la tabla `Empleados`
--
ALTER TABLE `Empleados`
  ADD PRIMARY KEY (`Empleado_ID`);

--
-- Indices de la tabla `Inventario`
--
ALTER TABLE `Inventario`
  ADD PRIMARY KEY (`Inventario_ID`),
  ADD KEY `Proveedor_ID` (`Proveedor_ID`);

--
-- Indices de la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`Producto_ID`),
  ADD KEY `Proveedor_ID` (`Proveedor_ID`),
  ADD KEY `Inventario_ID` (`Inventario_ID`);

--
-- Indices de la tabla `Proveedores`
--
ALTER TABLE `Proveedores`
  ADD PRIMARY KEY (`Proveedor_ID`);

--
-- Indices de la tabla `Ventas`
--
ALTER TABLE `Ventas`
  ADD PRIMARY KEY (`Venta_ID`),
  ADD KEY `Cliente_ID` (`Cliente_ID`),
  ADD KEY `Empleado_ID` (`Empleado_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Clientes`
--
ALTER TABLE `Clientes`
  MODIFY `Cliente_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `DetallesVenta`
--
ALTER TABLE `DetallesVenta`
  MODIFY `Detalle_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `Empleados`
--
ALTER TABLE `Empleados`
  MODIFY `Empleado_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Inventario`
--
ALTER TABLE `Inventario`
  MODIFY `Inventario_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Productos`
--
ALTER TABLE `Productos`
  MODIFY `Producto_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Proveedores`
--
ALTER TABLE `Proveedores`
  MODIFY `Proveedor_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Ventas`
--
ALTER TABLE `Ventas`
  MODIFY `Venta_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `DetallesVenta`
--
ALTER TABLE `DetallesVenta`
  ADD CONSTRAINT `detallesventa_ibfk_1` FOREIGN KEY (`Venta_ID`) REFERENCES `Ventas` (`Venta_ID`),
  ADD CONSTRAINT `detallesventa_ibfk_2` FOREIGN KEY (`Producto_ID`) REFERENCES `Productos` (`Producto_ID`);

--
-- Filtros para la tabla `Inventario`
--
ALTER TABLE `Inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`Proveedor_ID`) REFERENCES `Proveedores` (`Proveedor_ID`);

--
-- Filtros para la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`Proveedor_ID`) REFERENCES `Proveedores` (`Proveedor_ID`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`Inventario_ID`) REFERENCES `Inventario` (`Inventario_ID`);

--
-- Filtros para la tabla `Ventas`
--
ALTER TABLE `Ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`Cliente_ID`) REFERENCES `Clientes` (`Cliente_ID`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`Empleado_ID`) REFERENCES `Empleados` (`Empleado_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
