-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Dec 18, 2024 at 05:50 PM
-- Server version: 8.0.39
-- PHP Version: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codecrafters`
--

--
-- Dumping data for table `p3_transfer_vehiculo`
--

INSERT INTO `p3_transfer_vehiculo` (`id_vehiculo`, `descripcion`, `email_conductor`) VALUES
(1, 'Matricula T4874EMD', 'isabelgonzales@appuoc.edu'),
(2, 'Matricula K2453RFA', 'saraygutierrez@appuoc.edu'),
(3, 'Matricula L7637EHK', 'juansantos@appuoc.edu'),
(4, 'Matricula D1187HRY', 'mariamejia@appuoc.edu'),
(5, 'Matricula W9365GEW', 'rogeliofuster@appuoc.edu'),
(6, 'Matricula A0590KTD', 'antoniogamero@appuoc.edu');

--
-- Dumping data for table `p3_transfer_tipo_reserva`
--

INSERT INTO `p3_transfer_tipo_reserva` (`id_tipo_reserva`, `descripcion`) VALUES
(1, 'aeropuerto-hotel'),
(2, 'hotel-aeropuerto'),
(3, 'ida-y-vuelta');


--
-- Dumping data for table `p3_transfer_zona`
--

INSERT INTO `p3_transfer_zona` (`id_zona`, `descripcion`) VALUES
(1, 'Bosque'),
(2, 'Playa'),
(3, 'Montaña'),
(4, 'Cabañas'),
(5, 'Palmeras');
COMMIT;

--
-- Dumping data for table `p3_transfer_hotel`
--

INSERT INTO `p3_transfer_hotel` (`id_hotel`, `id_zona`, `comision`, `usuario`, `password`) VALUES
(1, 1, 5.50, 'Hotel de los bosques', NULL),
(2, 1, 3.50, 'Hotel escondido', '$2y$12$5QSli.mu77xWMBOQfJCIqOnIQOUU5XUIXw8VpC3DobGDMw8GSEQFW'),
(3, 2, 10.00, 'Resort Playa', '$2y$12$9IG5xnLaByMO85AogjHkr.D50l2O.xWlPquecYk5juVYpY5E8.f1e'),
(4, 3, 15.00, 'Pico montaña', NULL),
(5, 4, 10.00, 'Centro Isla', NULL),
(6, 5, 20.50, 'Casa Del Arbol', NULL);

--
-- Dumping data for table `p3_transfer_precio`
--

INSERT INTO `p3_transfer_precio` (`id_precio`, `id_vehiculo`, `id_hotel`, `precio`) VALUES
(1, 1, 1, 15.00),
(2, 2, 2, 25.00),
(3, 3, 3, 5.00),
(4, 4, 4, 10.50),
(5, 5, 5, 11.20),
(6, 6, 6, 23.00);



--
-- Dumping data for table `p3_transfer_viajero`
--

INSERT INTO `p3_transfer_viajero` (`id_viajero`, `nombre`, `apellido1`, `apellido2`, `direccion`, `codigo_postal`, `ciudad`, `pais`, `email`, `password`) VALUES
(1, 'Laura', 'Gonzales', 'Perez', 'Calle Gran Vía, 25', '28001', 'Madrid', 'España', 'laura.gonzalez@email.com', '$2y$12$52gn/FxDlEmDvV0tIKk/5.LZeSvH.NrRzUYagPTKN9akMnyW9ZoUq'),
(2, 'Juan', 'Rodriguez', 'Sanchez', 'Mexico', '10001', 'Ciudad de Mexico', 'Mexico', 'juan.rodriguez@email.com', '$2y$12$CupwbFNQcrG.bVzZcU5IrOaJPIqF8cQAU9A.2ERoZquR0vG26kRhG'),
(3, 'Maria', 'Lopez', 'Garcia', 'Calle Corrientes, 1200', '10100', 'Buenos Aires', 'Argentina', 'maria.lopez@email.com', '$2y$12$UbXRgqq3tKvYnlx1aGix0O/WVubbalhytMm3T35cPXoP8MhXTkhte'),
(4, 'Carlos', 'Martinez', 'Fernandez', '5th Avenue, 101', '12345', 'New York', 'Estados Unidos', 'carlos.martinez@email.com', '$2y$12$ZjgfWpBmXVOW6jJWx5gcRuHeYYzwZWuWCxe01tap/GXndWdKfobzu'),
(5, 'Maria', 'Perez', 'Morales', 'Avenida Libertador Bernardo OHiggins, 2500', '2000', 'Santiago', 'Chile', 'maria.perez@email.com', '$2y$12$Mhc8xZxFYMawToEBRmlDzuv0j.Lk.6qnhJ6PpCdvuEWnXiwg7VtLS');


--
-- Dumping data for table `p3_transfer_reserva`
--

INSERT INTO `p3_transfer_reserva` (`id_reserva`, `fecha_reserva`, `fecha_modificacion`, `id_tipo_reserva`, `localizador`, `email_cliente`, `num_viajeros`, `id_precio`, `fecha_entrada`, `hora_entrada`, `numero_vuelo_entrada`, `origen_vuelo_entrada`, `fecha_salida`, `hora_salida`, `numero_vuelo_salida`, `hora_recogida`, `id_viajero`, `id_hotel`) VALUES
(1, '2024-12-18 15:16:19', '2024-12-18 15:16:19', 1, 'UKYGH', 'laura.gonzalez@email.com', 3, 1, '2024-12-24', '10:00:00', 'ISLA312', 'Madrid', NULL, NULL, NULL, NULL, 1, NULL),
(2, '2024-12-18 15:19:30', '2024-12-18 15:19:30', 2, 'OSVWX', 'laura.gonzalez@email.com', 2, 2, NULL, NULL, NULL, NULL, '2024-12-24', '12:00:00', 'ISLA11', '15:00:00', 1, NULL),
(3, '2024-12-18 15:22:00', '2024-12-18 15:22:00', 3, 'OFBTY', 'laura.gonzalez@email.com', 2, 5, '2024-12-28', '12:00:00', 'ISLA10', 'Madrid', '2024-12-30', '20:20:00', 'ISLA40', '05:00:00', 1, NULL),
(4, '2024-12-18 16:04:37', '2024-12-18 16:04:37', 1, 'NPYXL', 'sofia.martinez@email.com', 2, 2, '2024-12-28', '15:30:00', 'ISLA111', 'Madrid', NULL, NULL, NULL, NULL, NULL, 2),
(5, '2024-12-18 16:07:42', '2024-12-18 16:07:42', 2, 'CRKHD', 'sofia.martinez@email.com', 3, 2, NULL, NULL, NULL, NULL, '2025-01-02', '15:30:00', 'ISLA123', '12:00:00', NULL, 2),
(6, '2024-12-18 16:08:44', '2024-12-18 16:08:44', 3, 'QEYWL', 'valentina.lopez@email.com', 3, 2, '2025-02-01', '12:22:00', 'ISLA500', 'Paris', '2025-02-12', '22:00:00', 'ISLA750', '15:30:00', NULL, 2),
(7, '2024-12-18 17:43:50', '2024-12-18 17:43:50', 3, 'PLHBZ', 'tomas.fernandez@email.com', 3, 2, '2025-01-01', '12:00:00', 'ISLA403', 'Londres', '2025-02-02', '10:10:00', 'ISLA501', '09:00:00', NULL, NULL),
(8, '2024-12-18 17:44:22', '2024-12-18 17:44:22', 1, 'UVNKL', 'tomas.fernandez@email.com', 2, 5, '2024-12-21', '12:00:00', 'ISLA90', 'Londres', NULL, NULL, NULL, NULL, NULL, NULL),
(9, '2024-12-18 17:45:00', '2024-12-18 17:45:00', 2, 'VIUHN', 'tomas.fernandez@email.com', 1, 2, NULL, NULL, NULL, NULL, '2024-12-22', '11:30:00', 'ISLA126', '08:30:00', NULL, NULL),
(10, '2024-12-18 17:46:29', '2024-12-18 17:46:29', 1, 'RNWFA', 'valentina.lopez@email.com', 2, 6, '2024-12-25', '10:00:00', 'ISL102', 'Miami', NULL, NULL, NULL, NULL, NULL, NULL);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
