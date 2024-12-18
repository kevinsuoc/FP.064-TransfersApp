-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Dec 18, 2024 at 01:45 PM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
