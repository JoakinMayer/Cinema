-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2017 a las 14:52:07
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cinema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `user` varchar(256) NOT NULL,
  `pass` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `user`, `pass`) VALUES
(1, 'admin', 'admin123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `id` int(11) NOT NULL,
  `categoria` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clasificacion`
--

INSERT INTO `clasificacion` (`id`, `categoria`, `descripcion`) VALUES
(1, 'TP', 'Apto para todo público'),
(2, 'DN', 'Dedicado para niños'),
(3, 'PG13', 'Se sugiere compañía de adultos para menores de 13'),
(4, 'PG18', 'Se sugiere compañía de adultos para menores de 18'),
(5, 'PA', 'Para adultos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complejos`
--

CREATE TABLE `complejos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `evaluacionSala` mediumtext NOT NULL,
  `sala2D` varchar(256) NOT NULL,
  `sala3D` varchar(256) NOT NULL,
  `sala4D` varchar(256) NOT NULL,
  `jubilados` varchar(256) NOT NULL,
  `promociones` mediumtext NOT NULL,
  `direccion` varchar(256) NOT NULL,
  `telefono` varchar(256) NOT NULL,
  `pantalla` varchar(256) NOT NULL,
  `aireAcondicionado` enum('si','no','','') NOT NULL,
  `cantidadButacas` int(11) NOT NULL,
  `sitioOficial` varchar(256) NOT NULL,
  `img` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `complejos`
--

INSERT INTO `complejos` (`id`, `nombre`, `evaluacionSala`, `sala2D`, `sala3D`, `sala4D`, `jubilados`, `promociones`, `direccion`, `telefono`, `pantalla`, `aireAcondicionado`, `cantidadButacas`, `sitioOficial`, `img`) VALUES
(1, 'Cinemateca 18', 'Sala reacondicionada. Cuenta en el hall con dispensador de refrescos. Atención del personal correcta. Baños en estado regular, suele no haber implementos higiénicos (papel, jabón). Los días lunes no hay función.', '$ 220', '', '', '', 'Socios de Cinemateca: $ 40 (solo estrenos)-Socio Espectacular, Antel y Suscriptores La Diaria 2x1-Tarjetas RedBROU: 50% de descuento.', '18 de Julio 1280 esq. Aquiles Lanza', '2900 9056', 'Grande', 'si', 800, 'http://www.cinemateca.org.uy/cinemateca18.html', 'cinemateca18.jpeg'),
(2, 'Grupocine Ejido', 'El complejo cuenta con tres salas, ubicadas en tres niveles (pisos) diferentes cada una. La mayor (arriba) tiene 195 localidades, la del medio cuenta con 142, y la más chica (la de abajo) con 109. En total son 446 localidades. Las tres salas están equipadas con proyección 3D. Atención del personal correcta. Baños en buen estado. Butacas con posavasos, poco espacio entre filas. Acceso por adelante, excepto en la del medio que es por atrás.', 'lunes a miércoles $ 230-jueves a domingo y feriados $ 290', 'lunes a miércoles $ 250-jueves a domingo y feriados $ 320', '', '(solo sala 2D)-lunes a miércoles $ 195-jueves a domingo y feriados $ 250', '', 'Ejido 1377', '2901 4242', 'Grande', 'si', 446, 'http://www.grupocine.com.uy/', 'grupocineejido.jpg'),
(3, 'Grupocine Punta Carretas', 'Las salas están ubicadas en el tercer nivel de Punta Carretas Shopping, al fondo de la Plaza de Comidas. Son tres salas que cuentan con 109, 83 y 89 butacas (totalizando 281). Las tres salas están equipadas con proyección 3D. Buena atención del personal. Butacas con respaldo alto y posavasos. Lamentablemente hay poco espacio entre las filas. Buenas proyección y sonido. Ingreso a la sala por adelante.', 'lunes a miércoles $ 230-jueves a domingo y feriados $ 290', 'lunes a miércoles $ 250-jueves a domingo y feriados $ 320', '', '(solo sala 2D)-lunes a miércoles $ 195-jueves a domingo y feriados $ 250', '', 'José Ellauri 350 nivel 3', ' 2901 4242', 'Mediana', 'si', 281, 'http://www.grupocine.com.uy/', 'grupocinepuntacarretas.jpg'),
(4, 'Grupocine Torre de los Profesionales', 'Salas muy confortables, ubicadas en la planta baja de la Torre de los Profesionales de Colonia y Yaguarón. Una de las salas cuenta con 140 butacas y la otra con 102 (totalizando 242 butacas). Ambas salas están equipadas con proyección digital 3D. Buena atención del personal. Butacas muy cómodas, con posa brazo removible (ideal para abrazar a la pareja). Excelentes proyección y sonido. Buena visibilidad desde casi toda la sala, sobre todo hacia atrás. Baños en buen estado', 'lunes a miércoles $ 230-jueves a domingo y feriados $ 290', 'lunes a miércoles $ 250-jueves a domingo y feriados $ 320', '', '(solo sala 2D)-lunes a miércoles $ 195-jueves a domingo y feriados $ 250', '', 'Colonia 1297 y Yaguarón', '2901 4242', 'Mediana', 'si', 240, 'http://www.grupocine.com.uy/', 'grupocinetorredelosprofesionales.jpg'),
(5, 'Life Cinemas 21', 'El complejo Casablanca se reinauguró totalmente renovado, sumándose al circuito Life Cinemas de Montevideo. Cuenta con tres salas - de 205, 131 y 100 butacas respectivamente - una de ellas equipada con proyección 3D. Se puede realizar compra de entradas por internet y por celular', 'Lunes a miércoles $ 250 - Jueves a domingos, feriados y funciones preestreno $ 310', 'Lunes a miércoles $ 250 - Jueves a domingos, feriados y funciones preestreno $ 310', '', 'Lunes a miércoles $ 220 - Jueves a domingos, feriado y funciones preestreno $ 270', '2x1 con tarjetas de débito y crédito del BROU, tarjetas de Scotiabank (todos los días), Antel (jueves viernes y sábados)', '21 de Setiembre 2838 casi José Ellauri', '2707 3037', 'Mediana', 'si', 436, 'https://www.lifecinemas.com.uy/', 'lifecinemas21.jpg'),
(6, 'Life Cinemas Alfabeta', 'El complejo cuenta con 5 salas (dos en planta baja, de 190 butacas cada una, y tres en primera planta, más pequeñas). Hay ascensor para acceder a la primera planta. Butacas con posavasos (única queja: poco espacio entre algunas filas). Buena proyección y sonido, aunque en algunas funciones se han presentado problemas de sonido y proyección. Muy buena visión desde cualquier parte de la sala, excepto las primeras filas. Buena atención del personal. Se puede realizar compra de entradas por internet y por celular ', 'Lunes a miércoles $ 250 - Jueves a domingos, feriados y funciones preestreno $ 310', 'Lunes a miércoles $ 250 - Jueves a domingos, feriados y funciones preestreno $ 310', '', 'Lunes a miércoles $ 220 - Jueves a domingos, feriado y funciones preestreno $ 270', '2x1 con tarjetas de débito y crédito del BROU, tarjetas de Scotiabank (todos los días), Antel (jueves viernes y sábados)', 'Miguel Barreiro 3231 esq. Berro', '2707 3037', 'Mediana', 'si', 500, 'https://www.lifecinemas.com.uy/', 'lifecinemasalfabeta.jpg'),
(7, 'Life Cinemas Punta Carretas', '', 'Lunes a miércoles $ 220 - Jueves a domingos, feriado y funciones preestreno $ 270', 'Lunes a miércoles $ 220 - Jueves a domingos, feriado y funciones preestreno $ 270', '', 'Lunes a miércoles $ 220 - Jueves a domingos, feriado y funciones preestreno $ 270', '2x1 con tarjetas de débito y crédito del BROU, tarjetas de Scotiabank (todos los días), Antel (jueves viernes y sábados)', 'José Ellauri 350 nivel 3 - Punta Carretas Shopping', '2707 3037', 'Mediana', 'si', 240, 'https://www.lifecinemas.com.uy/', 'lifecinemaspuntacarretas.jpg'),
(8, 'Movie Montevideo', 'El complejo consta de 10 salas de entre 100 y 302 butacas. Muy buena visión desde cualquier lugar de la sala, excepto las primeras filas. Buena atención del personal. Baños en muy buen estado. Butacas con posavasos y buena separación entre filas. Proyección excelente. Eso sí: sacar las entradas con tiempo (sobre todo los fines de semana) porque se agotan. Las entradas son numeradas.', 'Lunes a Miércoles $ 230 - Jueves a Domingos y Feriados $ 290', 'Lunes a Miércoles $ 250 - Jueves a Domingos y Feriados $ 320', '', ' Lunes a Miércoles $ 195 - Jueves a Domingos y Feriados $ 250', 'Menores de 3 años no pagan - Preestrenos: $ 320', 'Luis Alberto de Herrera 1290 - Montevideo Shopping nivel 2', '2900 3900', 'Grande', 'si', 1300, 'http://www.movie.com.uy/', 'moviemontevideo.jpg'),
(9, 'Movie Nuevocentro', '', 'Lunes a Miércoles $ 230 - Jueves a Domingos y Feriados $ 290', 'Lunes a Miércoles $ 250 - Jueves a Domingos y Feriados $ 320', '', ' Lunes a Miércoles $ 195 - Jueves a Domingos y Feriados $ 250', 'Menores de 3 años no pagan - Preestrenos: $ 320', 'Av. Luis Alberto de Herrera y Br. Artigas - Nuevocentro Shopping nivel 3', '2900 3900', 'Grande', 'si', 500, 'http://www.movie.com.uy/', 'movienuevocenter.jpg'),
(10, 'Movie Portones', 'El complejo consta de 7 salas de entre 166 y 298 butacas. Muy buena visión desde cualquier lugar de la sala, excepto las primeras filas. Buena atención del personal. Baños en buen estado. Butacas con posavasos y buena separación entre filas. Proyección excelente. Las entradas son numeradas.', 'Lunes a Miércoles $ 230 - Jueves a Domingos y Feriados $ 290', 'Lunes a Miércoles $ 250 - Jueves a Domingos y Feriados $ 320', 'Lunes a Miércoles $ 380 - Jueves a Domingos y Feriados $ 490 – Preestrenos: $ 490', ' Lunes a Miércoles $ 195 - Jueves a Domingos y Feriados $ 250', 'Menores de 3 años no pagan - Preestrenos: $ 320', 'Avenida Italia 5775 casi Bolivia - Portones Shopping', '2900 3900', 'Grande', 'si', 1000, 'http://www.movie.com.uy/', 'movieportones.jpg'),
(11, 'Movie Punta Carretas', 'El complejo consta de 5 salas de entre 97 y 266 butacas (totalizando 985). La más pequeña es la única con butacas con posabrazos rebatibles. Todas tienen posavasos y buena separación entre filas. Buena atención del personal. Baños en buen estado. Proyección excelente. Las entradas son numeradas.', 'Lunes a Miércoles $ 230 - Jueves a Domingos y Feriados $ 290', 'Lunes a Miércoles $ 250 - Jueves a Domingos y Feriados $ 320', '', ' Lunes a Miércoles $ 195 - Jueves a Domingos y Feriados $ 250', 'Menores de 3 años no pagan - Preestrenos: $ 320', ' José Ellauri 350 - Punta Carretas Shopping nivel 3', '2900 3900', 'Grande', 'si', 985, 'http://www.movie.com.uy/', 'moviepuntacarretas.jpg'),
(12, 'Opera', 'El complejo cuenta con dos salas, ubicadas en el mismo nivel. La sala 1 tiene una capacidad de 240 butacas y la sala 2 de 230 butacas. Ambas salas están equipadas con proyección 3D y sonido Dolby Digital. Atención del personal correcta. Baños en buen estado. Butacas sin posavasos. Acceso por adelante. Buena visión desde todas las butacas.', 'precio único $ 150', '', '', '', '', 'Av. 18 de Julio 1710 esq. Magallanes', '094 474194', 'Grande', 'si', 470, '', 'opera.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id` int(4) NOT NULL,
  `genero` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `icoName` varchar(256) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `genero`, `icoName`) VALUES
(1, 'Drama', 'drama'),
(2, 'Comedia', 'comedy'),
(3, 'Acción', 'action'),
(4, 'Ciencia Ficción', 'sci-fi'),
(5, 'Fantasía', 'fantasy'),
(6, 'Terror', 'terror'),
(7, 'Romance', 'romance'),
(8, 'Musical', 'musical'),
(9, 'Misterio', 'mystery'),
(11, 'Animación', 'animation'),
(12, 'Aventura', 'adventure'),
(13, 'Biografía', 'biography'),
(14, 'Crimen', 'crime'),
(15, 'Detective', 'detective'),
(16, 'Familia', 'family'),
(17, 'Historia', 'history'),
(18, 'Deporte', 'sport'),
(19, 'Thriller', 'thriller'),
(20, 'Guerra', 'war'),
(21, 'Western', 'western');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `idPelicula` int(11) NOT NULL,
  `complejo` varchar(256) NOT NULL,
  `tecnologia` varchar(256) NOT NULL,
  `idioma` varchar(256) NOT NULL,
  `horario` varchar(256) NOT NULL,
  `dias` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `idPelicula`, `complejo`, `tecnologia`, `idioma`, `horario`, `dias`) VALUES
(4, 2, 'Movie Punta Carretas', '2D', 'ESP', '21:50', 'Mon,Tue'),
(6, 2, 'Movie Montevideo', '2D', 'ESP', '19:05', 'Mon,Tue'),
(22, 4, 'Cinemateca 18', '2D', 'SUB', '18:00;19:30', 'Tue,Wed'),
(23, 4, 'Cinemateca 18', '2D', 'SUB', '20:55', 'Thu,Fri,Sat,Sun'),
(25, 6, 'Grupocine Ejido', '2D', 'ESP', '20:40;22:40', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(26, 1, 'Grupocine Torre de los Profesionales', '2D', 'SUB', '17:40;20:00', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(27, 1, 'Life Cinemas 21', '2D', 'SUB', '17:25', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(28, 1, 'Movie Montevideo', '2D', 'SUB', '14:25;16:10', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(29, 1, 'Movie Montevideo', '2D', 'ESP', '18:40;21:10', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(30, 1, 'Movie Nuevocentro', '2D', 'ESP', '19:55', 'Wed,Thu,Fri'),
(31, 1, 'Movie Portones', '2D', 'ESP', '14:40', 'Mon,Tue,Wed'),
(32, 1, 'Movie Portones', '2D', 'SUB', '17:10;1940;22:10', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(33, 1, 'Movie Punta Carretas', '2D', 'ESP', '14:40', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(34, 1, 'Movie Punta Carretas', '2D', 'SUB', '17:10;19:50;22:20', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(35, 6, 'Movie Montevideo', '2D', 'ESP', '19:40', 'Mon,Tue,Wed'),
(36, 6, 'Movie Montevideo', '2D', 'SUB', '22:40', 'Thu,Fri,Sat'),
(37, 7, 'Life Cinemas 21', '2D', 'SUB', '19:55', 'Mon,Tue,Wed'),
(38, 8, 'Grupocine Ejido', '2D', 'SUB', '20:10;22:30', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(39, 8, 'Life Cinemas Alfabeta', '2D', 'SUB', '19:55', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(40, 8, 'Life Cinemas Punta Carretas', '2D', 'ESP', '17:25;19:50', 'Mon,Tue,Wed,Fri,Sat,Sun'),
(41, 8, 'Movie Montevideo', '2D', 'ESP', '14:30', 'Mon,Tue,Wed,Sun'),
(42, 8, 'Movie Montevideo', '2D', 'SUB', '17:05;19:50;22:25', 'Thu,Fri,Sat,Sun'),
(43, 8, 'Movie Nuevocentro', '2D', 'ESP', '22:10', 'Mon,Tue,Wed'),
(44, 8, 'Movie Portones', '2D', 'ESP', '14:30', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(45, 8, 'Movie Portones', '2D', 'SUB', '17:00;19:30;22:05', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(46, 17, 'Grupocine Torre de los Profesionales', '2D', 'SUB', '16:30', 'Mon,Tue,Wed'),
(47, 17, 'Grupocine Torre de los Profesionales', '2D', 'SUB', '18:30;20:30', 'Thu,Fri,Sat,Sun'),
(49, 17, 'Life Cinemas Alfabeta', '2D', 'SUB', '18:00;20:10', 'Mon,Tue,Wed,Thu'),
(50, 17, 'Life Cinemas Alfabeta', '2D', 'SUB', '20:10;22:00', 'Thu,Fri,Sat,Sun'),
(51, 17, 'Movie Punta Carretas', '2D', 'SUB', '15:20;17:40', 'Mon,Tue,Wed'),
(52, 17, 'Movie Punta Carretas', '2D', 'SUB', '20:00;22:10', 'Thu,Fri,Sat,Sun'),
(53, 18, 'Grupocine Ejido', '3D', 'ESP', '15:30', 'Mon,Tue,Wed,Thu'),
(54, 18, 'Grupocine Punta Carretas', '3D', 'ESP', '18:10', 'Wed,Thu,Fri,Sat,Sun'),
(56, 18, 'Life Cinemas Punta Carretas', '3D', 'ESP', '15:35', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(57, 18, 'Movie Montevideo', '3D', 'ESP', '17:30', 'Mon,Tue,Wed,Thu'),
(58, 18, 'Movie Portones', '3D', 'ESP', '15:50', 'Thu,Fri,Sat,Sun'),
(59, 19, 'Grupocine Ejido', '2D', 'SUB', '17:40;22:20', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(60, 19, 'Life Cinemas 21', '2D', 'SUB', '22:30', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(61, 19, 'Life Cinemas Punta Carretas', '2D', 'SUB', '17:35 ;20:00;22:25', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(62, 19, 'Movie Montevideo', '2D', 'ESP', ' 14:35;17:20', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(63, 19, 'Movie Montevideo', '2D', 'SUB', ' 20:00 ;22:10', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(64, 19, 'Movie Nuevocentro', '2D', 'ESP', ' 19:30 ;22:00', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(65, 19, 'Movie Portones', '2D', 'ESP', ' 14:50 ;17:20', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(66, 19, 'Movie Portones', '2D', 'SUB', ' 19:50 ;22:20', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(67, 20, 'Life Cinemas Punta Carretas', '2D', 'ESP', ' 15:30', 'Mon,Tue,Wed,Thu'),
(68, 21, 'Grupocine Ejido', '2D', 'SUB', ' 22:10', 'Mon,Tue,Wed'),
(69, 22, 'Grupocine Ejido', '2D', 'ESP', '14:10 ;16:20 ;18:30', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(70, 22, 'Grupocine Punta Carretas', '2D', 'ESP', '14:00 ;16:10;18:20;20:30;22:20', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(71, 22, 'Movie Montevideo', '2D', 'ESP', ' 15:10;17:25;19:40', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(72, 22, 'Movie Montevideo', '2D', 'SUB', '22:00', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(73, 22, 'Movie Nuevocentro', '2D', 'ESP', '15:35;17:50;20:05;22:20', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun'),
(74, 22, 'Life Cinemas Punta Carretas', '2D', 'ESP', '15:35;17:50;20:05;22:20', 'Mon,Tue,Wed,Thu,Fri,Sat,Sun');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL,
  `idPelicula` int(11) NOT NULL,
  `ruta` varchar(256) NOT NULL,
  `alt` varchar(256) NOT NULL,
  `poster` enum('si','no','','') NOT NULL,
  `portada` enum('si','no','','') NOT NULL,
  `slider` enum('si','no','','') NOT NULL,
  `posicionSlider` int(11) NOT NULL,
  `fechaSubida` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `idPelicula`, `ruta`, `alt`, `poster`, `portada`, `slider`, `posicionSlider`, `fechaSubida`) VALUES
(1, 1, '1poster.jpg', 'poster extraordinario', 'si', 'no', 'no', 0, '2017-12-11 04:21:41'),
(2, 1, '1portada.jpg', 'portada de extraordinario', 'no', 'si', 'si', 2, '2017-12-11 00:26:55'),
(3, 2, '2poster.jpg', 'poster mama se fue de viaje', 'si', 'no', 'no', 0, '2017-12-11 04:36:52'),
(4, 2, '2portada.jpg', 'portada mama se fue de viaje', 'no', 'si', 'si', 4, '2017-12-11 04:36:52'),
(5, 0, '2017_12_11_00_43_11promo.jpg', 'promo pop', 'no', 'si', 'si', 3, '2017-12-11 00:43:11'),
(7, 4, '4poster.jpg', 'poster loving vicent', 'si', 'no', 'no', 0, '2017-12-12 08:35:50'),
(9, 6, '6poster.jpg', 'poster amityville', 'si', 'no', 'no', 0, '2017-12-12 08:44:42'),
(10, 7, '7poster.jpg', 'poster amor.com', 'si', 'no', 'no', 0, '2017-12-12 08:55:56'),
(11, 8, '8poster.jpg', 'poster asesinato en el medio oriente', 'si', 'no', 'no', 0, '2017-12-12 08:59:16'),
(12, 8, '8portada.jpg', 'portada asesinato en el expreso oriente', 'no', 'si', 'si', 1, '2017-12-12 09:02:48'),
(13, 17, '17poster.jpg', 'dos amores en paris', 'si', 'no', 'no', 0, '2017-12-13 14:07:52'),
(14, 18, '18poster.jpg', 'el hijo de pie grande', 'si', 'no', 'no', 0, '2017-12-13 14:14:07'),
(15, 19, '19poster.jpg', 'el implacable', 'si', 'no', 'no', 0, '2017-12-13 14:20:43'),
(16, 20, '20poster.jpg', 'el pequeño vampiro', 'si', 'no', 'no', 0, '2017-12-13 14:32:43'),
(17, 21, '21poster.jpg', 'geo tormenta', 'si', 'no', 'no', 0, '2017-12-13 14:36:07'),
(18, 22, '22poster.jpg', 'guerra de papas 2', 'si', 'no', 'no', 0, '2017-12-13 14:43:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `id` int(4) NOT NULL,
  `titulo` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `tituloOriginal` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `sinopsis` longtext COLLATE utf8_spanish_ci NOT NULL,
  `ano` int(4) NOT NULL,
  `pais` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `duracion` int(3) NOT NULL,
  `genero` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `fechaEstreno` date NOT NULL,
  `clasificacion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `elenco` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `puntuacion` float(10,1) NOT NULL,
  `sitioOficial` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `sitioImdb` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `idioma` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `trailer` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `archivado` enum('si','no','','') COLLATE utf8_spanish_ci NOT NULL,
  `modificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`id`, `titulo`, `tituloOriginal`, `sinopsis`, `ano`, `pais`, `duracion`, `genero`, `fechaEstreno`, `clasificacion`, `direccion`, `elenco`, `puntuacion`, `sitioOficial`, `sitioImdb`, `idioma`, `trailer`, `archivado`, `modificacion`) VALUES
(1, 'Extraordinario', 'Wonder', 'August Pullman (Jacob Tremblay) es un niño nacido con malformaciones faciales que, hasta ahora, le han impedido ir a la escuela. Auggie se convierte en el más improbable de los héroes cuando entra en quinto grado del colegio local, con el apoyo de sus padres (Julia Roberts y Owen Wilson). La compasión y la aceptación de sus nuevos compañeros y del resto de la comunidad serán puestos a prueba.', 2017, 'Estados Unidos', 113, 'Drama;', '2017-11-30', 'TP', 'Stephen Chbosky', 'Julia Roberts;Jacob Tremblay;Owen Wilson;Mandy Patinkin;Millie Davis;Izabela Vidovic', 8.1, 'http://wonder.movie/', 'http://www.imdb.com/title/tt2543472/', 'Inglés', 'https://www.youtube.com/watch?v=O_ubjGho2XI', 'no', '2017-12-12 05:08:15'),
(2, 'Mamá se fue de viaje', 'Mamá se fue de viaje', 'Víctor y Vera Garbor (Diego Peretti, Carla Peterson) llevan 20 años de casados y tienen cuatro hijos: Bruno, Lara, Tato y Luna. Absorbido por su actividad laboral, Víctor vive ajeno a la cotidianeidad de su mujer y de los chicos. Vera, agobiada por la vida doméstica, decide tomarse vacaciones de su familia. Y allí comienzan los problemas.', 2017, 'Argentina', 99, 'Comedia;Familia', '2017-09-14', 'TP', 'Ariel Winograd', 'Diego Peretti;Carla Peterson; Martín Piroyansky;Muriel Santa Ana;Pilar Gamboa ;Guillermo Arengo', 6.2, 'https://www.facebook.com/mamadeviajeOK/', 'http://www.imdb.com/title/tt6629064/', 'Español', 'https://www.youtube.com/watch?v=dBopvALCm2o', 'no', '2017-12-12 03:27:57'),
(4, 'Loving Vincent', 'Loving Vincent', '\"La verdad es que sólo podemos hacer que sean nuestros cuadros los que hablen\", afirmaba Vincent Van Gogh en su última carta. Y será precisamente a través de una recreación de sus obras y de las 800 cartas que escribió el pintor como conozcamos su vida y su misteriosa muerte. Primer largometraje compuesto por pinturas animadas, Loving Vincent es un film que homenajea el trabajo de uno de los grandes maestros de las artes plásticas.', 2017, 'Reino Unido;Polonia', 94, 'Animación;Drama', '2017-10-12', 'PG13', 'Dorota Kobiela ;Hugh Welchman', 'Douglas Booth ; Robert Gulaczyk;Saoirse Ronan ; Aidan Turner', 7.9, 'http://lovingvincent.com/', 'http://www.imdb.com/title/tt3262342/', 'Ingles', 'https://www.youtube.com/watch?&v=47h6pQ6StCk', 'si', '2017-12-12 04:56:25'),
(6, 'Amityville: el despertar', 'Amityville: The Awakening', 'Belle (Bella Thorne), su hermana pequeña y su hermano gemelo, que está en coma, se mudan a una nueva casa junto a su madre soltera Joan (Jennifer Jason Leigh). Pero cuando extraños fenómenos comienzan a ocurrir en la casa, incluyendo la milagrosa recuperación de su hermano, Belle comienza a sospechar que su madre no le ha contado todo y pronto descubre que se han mudado a la infame casa de Amityville, donde el pasado sucedió una terrible tragedia.', 2017, 'Estados Unidos', 85, 'Terror;', '2017-10-12', 'PG13', 'Franck Khalfoun', 'Jennifer Jason Leigh ;Bella Thorne;Mckenna Grace;Cameron Monaghan ,Thomas Mann ; Taylor Spreitler', 4.9, '#', 'http://www.imdb.com/title/tt1935897/', 'Ingles', 'https://www.youtube.com/watch?v=mJ3KGhqWffw', 'no', '2017-12-12 05:08:55'),
(7, 'Amor.com', 'Un profil pour deux', 'Pierre (Pierre Richard) es un viudo jubilado que lleva dos años sin salir de su casa. Un día descubre internet y sus ventajas gracias a Alex (Yaniss Lespert), un joven que su hija ha contratado para que le enseñe a usar una computadora. A través de una web de citas Pierre conoce a una estupenda chica joven, con la que arregla una cita. Pero Pierre ha puesto en su perfil que tiene 30 años de edad y una foto de Alex, por lo que ahora tiene que convencer a éste para que vaya a la cita en su lugar.', 2017, 'Francia;Bélgica;Alemania;Austria', 99, 'Comedia;Romance', '2017-11-02', 'PG13', 'Stéphane Robelin', 'Pierre Richard;Yaniss Lespert', 6.4, '#', 'http://www.imdb.com/title/tt4693612/', 'Frances', 'https://www.youtube.com/watch?v=1RAlWHSRkrI', 'no', '2017-12-12 04:56:22'),
(8, 'Asesinato en el Expreso de Oriente', 'Murder in the Orient Express', 'Lo que comienza como un espléndido viaje por tren a lo largo de Europa, se convierte de pronto en uno de los misterios más intrincados de resolver. Sobre novela de Agatha Christie, Asesinato en el Expreso de Oriente narra la historia de trece extraños varados en un tren, y todos son sospechosos de un crimen. El detective Hercule Poirot (Kenneth Branagh) luchará contra reloj para resolver el enigma antes de que el asesino vuelva a atacar.', 2017, 'Estados Unidos;Malta', 114, 'Misterio;Drama', '2017-12-09', 'PG13', 'Kenneth Branagh', 'Kenneth Branagh;Penélope Cruz; Willem Dafoe;Judi Dench;Johnny Depp ;Josh Gad;Derek Jacobi', 6.8, 'https://www.cluesareeverywhere.com/intl/mx', 'http://www.imdb.com/title/tt3402236/', 'Inglés', 'https://www.youtube.com/watch?v=GUHLzmB90iw', 'no', '2017-12-12 05:09:24'),
(17, 'Dos amores en París', 'L embarras du choix', 'La vida está hecha de pequeñas y grandes decisiones. El gran problema de Juliette (Alexandra Lamy) es que es totalmente incapaz de tomar la más mínima decisión. Incluso con 40 años, aún depende de su padre y de sus dos mejores amigas para que lo decidan todo en su nombre. Pero el día en que conoce a Paul y a Étienne, tan encantadores y diferentes uno del otro, Juliette empieza a darse cuenta que nadie podrá elegir por ella.', 2017, 'Francia', 95, 'Comedia;Romance', '2017-11-02', 'PG13', 'Éric Lavaine', 'Alexandra Lamy;Arnaud Ducret;Jamie Bamber ;Anne Marivin;Sabrina Ouazani', 5.4, 'http://www.imdb.com/title/tt6445396/', 'http://www.imdb.com/title/tt6445396/', 'Frances Ingles', 'https://www.youtube.com/watch?v=aNjOqTD7t3o', 'no', '2017-12-13 10:11:21'),
(18, 'El hijo de Piegrande', 'The son of Bigfoot', 'El joven Adam emprende una misión épica para intentar descubrir el misterio que esconde la desaparición de su padre, y descubre que su padre es nada menos que el legendario Piegrande. Adam se da cuenta de que él también está dotado de un ADN especial, con unos superpoderes que jamás hubiese imaginado.', 2017, 'Bélgica;Francia ', 92, 'Animación;Aventura', '2017-11-09', 'TP', 'Jeremy Degruson ;Ben Stassen', ' ', 6.2, ' ', 'http://www.imdb.com/title/tt5715410/', 'Inglés', 'https://www.youtube.com/watch?v=QZP4tOZh-Pc', 'no', '2017-12-13 10:16:21'),
(19, 'El implacable', 'The Foreigner', 'Jackie Chan interpreta al dueño de un humilde restaurante en el Barrio Chino de Londres. Cuando su hija es asesinada tras un atentado terrorista y siente que la justicia le falla, se ve obligado a ir más allá de sus límites morales y físicos para hallar a los responsables.', 2017, 'Reino Unido;Estados Unidos', 113, 'Acción;Thriller', '2017-12-07', 'TP', 'Martin Campbell', ' Jackie Chan;Pierce Brosnan;Michael McElhatton ;Rufus Jones ;Orla Brady ;Charlie Murphy', 7.2, ' ', 'http://www.imdb.com/title/tt1615160/', 'Inglés;Mandarin', 'https://www.youtube.com/watch?v=S8g9l_hItWU', 'no', '2017-12-13 10:24:33'),
(20, 'El pequeño vampiro', 'The Little Vampire', 'Rudolph es un chico de 13 años que además es vampiro. La vida del joven se complica ante la llegada de un prestigioso cazador de vampiros que comienza a perseguirles a él y al resto de su clan. Con la ayuda de Tony, su nuevo amigo mortal, intentará hacerle frente.', 2017, 'Holanda;Alemania;Reino Unido;Dinamarca', 83, '', '2017-10-26', 'TP', 'Richard Claus;Karsten Kiilerich', 'Rasmus Hardiker; Amy Saville,;Jim Carter', 5.1, 'http://www.cinemamanagementgroup.com/film/the-little-vampire/', ' http://www.imdb.com/title/tt4729560/', 'Inglés;Alemán', ' https://www.youtube.com/watch?v=J3RsKLAk9nc', 'no', '2017-12-13 10:33:02'),
(21, 'Geo-tormenta', 'Geostorm', 'Después de que una serie de desastres naturales sin precedentes amenazó al planeta, los líderes del mundo se unieron para crear una intrincada red de satélites que controlan el clima global y mantienen a la humanidad segura. Pero algo ha salido mal, y el sistema construido para proteger a la Tierra se está volviendo en su contra, en una carrera contra el tiempo para descubrir la amenaza real antes de que una Geo-tormenta arrase con todo y con todos.', 2017, 'Estados Unidos', 109, 'Acción;Ciencia Ficción', '2017-10-19', 'PG13', 'Dean Devlin', 'Gerard Butler,;Jim Sturgess; Abbie Cornish', 5.5, 'https://www.facebook.com/GeostormMovie', 'http://www.imdb.com/title/tt1981128/', 'Inglés;Español', 'https://www.youtube.com/watch?v=s9EqgIWXrhQ', 'no', '2017-12-13 10:36:27'),
(22, 'Guerra de papás 2', 'Daddys Home 2', 'Dusty (Mark Wahlberg) y Brad (Will Ferrell) se han unido para ofrecerle a sus hijos la Navidad perfecta. Pero sus planes se ponen a prueba cuando el papá gruñón de Dusty (Mel Gibson) y el papá ultra cariñoso y tierno de Brad (John Lithgow) llegan para convertir las fiestas en un completo caos.', 2017, 'Estados Unidos', 100, 'Comedia;', '2017-11-23', 'TP', 'Sean Anders', ' Will Ferrell,;Mark Wahlberg,;Mel Gibson', 6.2, 'http://www.guerradepapas.com/', 'http://www.imdb.com/title/tt5657846/', 'Inglés', 'https://www.youtube.com/watch?v=ee8aaZxLwaQ', 'si', '2017-12-13 10:50:27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `complejos`
--
ALTER TABLE `complejos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `complejos`
--
ALTER TABLE `complejos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
