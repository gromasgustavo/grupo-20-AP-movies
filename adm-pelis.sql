-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2024 a las 18:44:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `adm-pelis`
--
CREATE DATABASE IF NOT EXISTS `adm-pelis` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `adm-pelis`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id_pelicula` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `fechaLanzamiento` date NOT NULL,
  `genero` varchar(255) NOT NULL,
  `duracion` varchar(10) NOT NULL,
  `director` varchar(255) NOT NULL,
  `reparto` varchar(255) NOT NULL,
  `sinopsis` text NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id_pelicula`, `titulo`, `fechaLanzamiento`, `genero`, `duracion`, `director`, `reparto`, `sinopsis`, `imagen`) VALUES
(1, 'El Padrino', '1972-03-15', 'drama', '177m', 'Francis Ford Coppola', 'Marlon Brando\r\n                        Al Pacino\r\n                        Robert Duvall\r\n                        James Caan\r\n                        Richard Castellano\r\n                        Diane Keaton', 'Don Vito Corleone es el respetado y temido jefe de una de las cinco familias de la mafia de\r\n                        Nueva York en los años 40. El hombre tiene cuatro hijos: Connie, Sonny, Fredo y Michael, que no\r\n                        quiere saber nada de los negocios sucios de su padre. Cuando otro capo, Sollozzo, intenta\r\n                        asesinar a Corleone, empieza una cruenta lucha entre los distintos clanes.', 'imagen.jpg'),
(2, 'El Padrino', '1972-03-15', 'drama', '177m', 'Francis Ford Coppola', 'Marlon Brando, Al Pacino, Robert Duvall, James Caan, Richard Castellano, Diane Keaton', 'Don Vito Corleone es el respetado y temido jefe de una de las cinco familias de la mafia de Nueva York en los años 40. El hombre tiene cuatro hijos: Connie, Sonny, Fredo y Michael, que no quiere saber nada de los negocios sucios de su padre. Cuando otro capo, Sollozzo, intenta asesinar a Corleone, empieza una cruenta lucha entre los distintos clanes.', 'imagen.jpg'),
(3, 'Super Mario bros', '2023-05-04', 'aventura', '92m', 'Aaron Horvath, Michael Jelenic', 'Chris Pratt, Anya Taylor-Joy, Charlie Day, Jack Black, Keegan-Michael Key, Seth Rogen, Fred Armisen, Sebastian Maniscalco, Kevin Michael Richardson, Charles Martinet', 'Dos hermanos plomeros, Mario y Luigi, caen por las alcantarillas y llegan a un mundo subterráneo mágico en el que deben enfrentarse al malvado Bowser para rescatar a la princesa Peach, quien ha sido forzada a aceptar casarse con él.', 'imagen.jpg'),
(4, 'Mutant ghost wargirl', '2022-06-04', 'drama', '71m', 'Binjie Liu', 'Zhenzhen Cui, Ziheng Guo, Mingxuan Li, Beige Liu, Mou Feng-Bin, Miya Muqi, Na Shang, Hu Qing Yun, Yunzhen Zeng', 'Wu Qingqing es un agente de la Alianza de Seguridad Internacional (para combatir el crimen mutante) y recibe la orden de infiltrarse en el Hospital Plástico Medusa para recopilar evidencia de la investigación secreta sobre el fluido de inducción genética por parte de su consorcio directo para crear luchadores mutantes. Wu Qingqing se infiltra con éxito, pero se ve obligado a inyectar un fluido de inducción genética.', 'imagen.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id_pelicula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
