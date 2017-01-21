-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2017 a las 22:05:49
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `recipes_demo`
--
CREATE DATABASE IF NOT EXISTS `recipes_demo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `recipes_demo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `ing_id` int(11) NOT NULL,
  `ing_name` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ingredient`
--

INSERT INTO `ingredient` (`ing_id`, `ing_name`) VALUES
(1, 'Lettuce'),
(2, 'Chicken'),
(3, 'Mushrooms'),
(4, 'Oven potatoes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
  `rec_id` int(11) NOT NULL,
  `rec_name` varchar(150) NOT NULL,
  `rec_photo` varchar(200) DEFAULT NULL,
  `rec_description` text NOT NULL,
  `rec_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rec_active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recipe`
--

INSERT INTO `recipe` (`rec_id`, `rec_name`, `rec_photo`, `rec_description`, `rec_created`, `rec_active`) VALUES
(1, 'Cesar Salad', '1.jpg', 'A great Caesar salad recipe gets its swagger from a great Caesar dressing recipe. Squeamish about raw egg yolks and anchovies? Sorry. Yolks are what give richness to the emulsion, while anchovies provide a briny blast (and that whole umami thing). This is part of BA''s Best, a collection of our essential recipes.', '2017-01-21 03:15:53', 1),
(2, 'Chef John''s Chicken Marsala', '2.jpg', 'Certain dishes have a special place in my heart and this is one of them. The first real restaurant job I had in San Francisco was at a small place called Ryan''s Cafe. It was run by a husband and wife team, Michael and Lenore Ryan. They were true ''foodies'' before that term had even been coined. This chicken Marsala dish was the most popular dish on the menu and the first one that I was taught', '2017-01-21 03:16:11', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recipe_ingredients`
--

DROP TABLE IF EXISTS `recipe_ingredients`;
CREATE TABLE IF NOT EXISTS `recipe_ingredients` (
  `rin_id` int(11) NOT NULL,
  `rin_rec_id` int(11) NOT NULL,
  `rin_ing_id` int(11) NOT NULL,
  `rin_quantity` decimal(9,2) NOT NULL,
  `rin_ume_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`rin_id`, `rin_rec_id`, `rin_ing_id`, `rin_quantity`, `rin_ume_id`) VALUES
(1, 1, 1, '50.00', 1),
(2, 1, 2, '500.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unit_measurement`
--

DROP TABLE IF EXISTS `unit_measurement`;
CREATE TABLE IF NOT EXISTS `unit_measurement` (
  `ume_id` int(11) NOT NULL,
  `ume_name` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `unit_measurement`
--

INSERT INTO `unit_measurement` (`ume_id`, `ume_name`) VALUES
(1, 'Grams'),
(2, 'Kilograms');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ing_id`);

--
-- Indices de la tabla `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`rec_id`);

--
-- Indices de la tabla `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`rin_id`);

--
-- Indices de la tabla `unit_measurement`
--
ALTER TABLE `unit_measurement`
  ADD PRIMARY KEY (`ume_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ing_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `recipe`
--
ALTER TABLE `recipe`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  MODIFY `rin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `unit_measurement`
--
ALTER TABLE `unit_measurement`
  MODIFY `ume_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
