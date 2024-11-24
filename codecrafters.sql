-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Oct 30, 2024 at 02:43 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `transfer_hotel`
--

CREATE TABLE `p3_transfer_hotel` (
  `id_hotel` int NOT NULL,
  `id_zona` int DEFAULT NULL,
  `Comision` int DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transfer_hotel`
--

INSERT INTO `p3_transfer_hotel` (`id_hotel`, `id_zona`, `Comision`, `usuario`, `password`) VALUES
(1, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_precios`
--

CREATE TABLE `p3_transfer_precios` (
  `id_precios` int NOT NULL,
  `id_vehiculo` int NOT NULL,
  `id_hotel` int NOT NULL,
  `Precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transfer_precios`
--

INSERT INTO `p3_transfer_precios` (`id_precios`, `id_vehiculo`, `id_hotel`, `Precio`) VALUES
(1, 1, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_reservas`
--

CREATE TABLE `p3_transfer_reservas` (
  `id_reserva` int NOT NULL,
  `localizador` varchar(100) NOT NULL,
  `id_hotel` int DEFAULT NULL COMMENT 'Es el hotel que realiza la reserva',
  `id_tipo_reserva` int NOT NULL,
  `email_cliente` varchar(50) NOT NULL,
  `fecha_reserva` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_destino` int NOT NULL,
  `fecha_entrada` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `numero_vuelo_entrada` varchar(50) NOT NULL,
  `origen_vuelo_entrada` varchar(50) NOT NULL,
  `hora_vuelo_salida` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_vuelo_salida` date NOT NULL,
  `num_viajeros` int NOT NULL,
  `id_vehiculo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_tipo_reserva`
--

CREATE TABLE `p3_transfer_tipo_reserva` (
  `id_tipo_reserva` int NOT NULL,
  `Descripción` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transfer_tipo_reserva`
--

INSERT INTO `p3_transfer_tipo_reserva` (`id_tipo_reserva`, `Descripción`) VALUES
(1, 'aeropuerto-hotel'),
(2, 'hotel-aeropuerto'),
(3, 'ida-y-vuelta');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_vehiculo`
--

CREATE TABLE `p3_transfer_vehiculo` (
  `id_vehiculo` int NOT NULL,
  `Descripción` varchar(100) NOT NULL,
  `email_conductor` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `p3_transfer_vehiculo`
--

INSERT INTO `p3_transfer_vehiculo` (`id_vehiculo`, `Descripción`, `email_conductor`, `password`) VALUES
(1, 'Un vehiculo', 'conductor@temp.uoc', '');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_viajeros`
--

CREATE TABLE `p3_transfer_viajeros` (
  `id_viajero` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `codigoPostal` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_zona`
--

CREATE TABLE `p3_transfer_zona` (
  `id_zona` int NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transfer_zona`
--

INSERT INTO `p3_transfer_zona` (`id_zona`, `descripcion`) VALUES
(1, 'Un bonito valle');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transfer_hotel`
--
ALTER TABLE `p3_transfer_hotel`
  ADD PRIMARY KEY (`id_hotel`),
  ADD KEY `FK_HOTEL_ZONA` (`id_zona`);

--
-- Indexes for table `transfer_precios`
--
ALTER TABLE `p3_transfer_precios`
  ADD PRIMARY KEY (`id_precios`),
  ADD KEY `FK_PRECIOS_HOTEL` (`id_hotel`),
  ADD KEY `FK_PRECIOS_VEHICULO` (`id_vehiculo`);

--
-- Indexes for table `transfer_reservas`
--
ALTER TABLE `p3_transfer_reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `FK_RESERVAS_DESTINO` (`id_destino`),
  ADD KEY `FK_RESERVAS_HOTEL` (`id_hotel`),
  ADD KEY `FK_RESERVAS_TIPO` (`id_tipo_reserva`),
  ADD KEY `FK_RESERVAS_VEHICULO` (`id_vehiculo`);

--
-- Indexes for table `transfer_tipo_reserva`
--
ALTER TABLE `p3_transfer_tipo_reserva`
  ADD PRIMARY KEY (`id_tipo_reserva`);

--
-- Indexes for table `transfer_vehiculo`
--
ALTER TABLE `p3_transfer_vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`);

--
-- Indexes for table `transfer_viajeros`
--
ALTER TABLE `p3_transfer_viajeros`
  ADD PRIMARY KEY (`id_viajero`);

--
-- Indexes for table `transfer_zona`
--
ALTER TABLE `p3_transfer_zona`
  ADD PRIMARY KEY (`id_zona`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transfer_hotel`
--
ALTER TABLE `p3_transfer_hotel`
  MODIFY `id_hotel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transfer_precios`
--
ALTER TABLE `p3_transfer_precios`
  MODIFY `id_precios` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transfer_reservas`
--
ALTER TABLE `p3_transfer_reservas`
  MODIFY `id_reserva` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer_tipo_reserva`
--
ALTER TABLE `p3_transfer_tipo_reserva`
  MODIFY `id_tipo_reserva` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transfer_vehiculo`
--
ALTER TABLE `p3_transfer_vehiculo`
  MODIFY `id_vehiculo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transfer_viajeros`
--
ALTER TABLE `p3_transfer_viajeros`
  MODIFY `id_viajero` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer_zona`
--
ALTER TABLE `p3_transfer_zona`
  MODIFY `id_zona` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transfer_hotel`
--
ALTER TABLE `p3_transfer_hotel`
  ADD CONSTRAINT `FK_HOTEL_ZONA` FOREIGN KEY (`id_zona`) REFERENCES `p3_transfer_zona` (`id_zona`);

--
-- Constraints for table `transfer_precios`
--
ALTER TABLE `p3_transfer_precios`
  ADD CONSTRAINT `FK_PRECIOS_HOTEL` FOREIGN KEY (`id_hotel`) REFERENCES `p3_transfer_hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_PRECIOS_VEHICULO` FOREIGN KEY (`id_vehiculo`) REFERENCES `p3_transfer_vehiculo` (`id_vehiculo`);

--
-- Constraints for table `transfer_reservas`
--
ALTER TABLE `p3_transfer_reservas`
  ADD CONSTRAINT `FK_RESERVAS_DESTINO` FOREIGN KEY (`id_destino`) REFERENCES `p3_transfer_hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_RESERVAS_HOTEL` FOREIGN KEY (`id_hotel`) REFERENCES `p3_transfer_hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_RESERVAS_TIPO` FOREIGN KEY (`id_tipo_reserva`) REFERENCES `p3_transfer_tipo_reserva` (`id_tipo_reserva`),
  ADD CONSTRAINT `FK_RESERVAS_VEHICULO` FOREIGN KEY (`id_vehiculo`) REFERENCES `p3_transfer_vehiculo` (`id_vehiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
