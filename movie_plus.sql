-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-06-2021 a las 02:01:57
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `movie_plus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

DROP TABLE IF EXISTS `generos`;
CREATE TABLE IF NOT EXISTS `generos` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `genero` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `genero`) VALUES
(1, 'accion'),
(2, 'ciencia ficcion'),
(3, 'drama'),
(4, 'animacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

DROP TABLE IF EXISTS `peliculas`;
CREATE TABLE IF NOT EXISTS `peliculas` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `genero_id` int(45) NOT NULL,
  `director` varchar(45) NOT NULL,
  `anio_estreno` int(4) NOT NULL,
  `plan_id` int(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `titulo`, `genero_id`, `director`, `anio_estreno`, `plan_id`) VALUES
(1, 'Escape from New York', 1, 'John Carpenter', 1977, 1),
(2, 'Empire strike back', 2, 'irvin kershner', 1980, 2),
(4, 'coco', 4, 'adrian molina', 2017, 3),
(5, 'endgame', 1, 'hermanos russo', 2019, 2),
(14, 'baby driver', 1, 'edgar wright', 2017, 1),
(7, 'joker', 3, 'todd phillips', 2019, 2),
(15, 'Batman begins', 3, 'nolan', 2005, 1),
(9, 'El padrino 2', 3, 'francis  ford coppola', 1972, 2),
(16, 'Huye', 2, 'Jordan Peele', 2017, 2),
(17, 'Psicosis', 3, 'Alfred Hitchcock', 1960, 1),
(18, 'Mision imposible', 1, 'Brian De Palma', 1996, 3),
(19, 'Kings Man', 1, 'Matthew Vaughn', 2014, 3),
(20, 'Megamente', 4, 'Tom McGrath', 2010, 3),
(21, 'Alien', 2, 'Ridley Scott', 1979, 1),
(24, 'big fish', 3, 'tim burton', 2003, 3),
(25, 'big fish', 1, 'Francis  Ford Coppola', 2020, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

DROP TABLE IF EXISTS `planes`;
CREATE TABLE IF NOT EXISTS `planes` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `plan` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `plan`) VALUES
(1, 'basico'),
(2, 'premium'),
(3, 'familiar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `plan_id` int(45) NOT NULL,
  `pswd` varchar(100) NOT NULL,
  `permisos` varchar(45) NOT NULL,
  `vencimiento_subscripcion` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `plan_id`, `pswd`, `permisos`, `vencimiento_subscripcion`) VALUES
(8, 'usuario2', 'usuario2@gmail.com.ar', 2, '$2y$10$X6ZK2G2TnSiLYq6RXgBfnO6RJrilrUK29LOEh6EkmjdLzSxJUMlXa', 'usuario', '2021-06-24'),
(20, 'usuario1', 'usuario1@gmail.com.ar', 1, '$2y$10$PcCYyS5VbFsStlzJ6eUqAeqGLYkHWzMLNH.hsoJSuEuLOguW/aKz6', 'admin', '2021-06-24'),
(11, 'usuario3', 'usuario3@gmail.com.ar', 2, '$2y$10$qkNP/UOYyGT5z87RB5abg.Wo8fJtRlBMPCro1bmrIUDqoppvYjP0m', 'admin', '2021-06-24'),
(24, 'usuario4', 'usuario4@gmail.com.ar', 1, '$2y$10$u4h3ZCuntM2ukRLrY2OUD.fNQgahlnuXFjP5jWCN6dql5JuljLX5i', 'usuario', '2021-06-25'),
(25, 'usuario5', 'usuario5@gmail.com.ar', 1, '$2y$10$wy1E1xH10NN8Zv8JN6h0O.m8Zbm5NObBll2gaIR.LCmuuq14AdJRa', 'usuario', '2021-07-25');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
