-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2017 a las 14:26:18
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `discografica_test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `totalPrice` int(11) DEFAULT NULL,
  `detailId` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `state` varchar(9) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `userName` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `userStreet` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `userId`, `totalPrice`, `detailId`, `date`, `state`, `userName`, `userStreet`) VALUES
(1, 5, 85, 2, '2016-08-12', 'entregado', 'Prue Minney', '772 Trailsway Way'),
(2, 5, 53, NULL, '0000-00-00', 'visto', 'Marta McGerraghty', '3 Chive Avenue'),
(3, 5, 60, NULL, '0000-00-00', 'entregado', 'Eddie Branscomb', '33275 Graceland Plaza'),
(4, 5, 51, NULL, '0000-00-00', 'entregado', 'Yvonne Tschierse', '4 Butternut Crossing'),
(5, 5, 70, NULL, '0000-00-00', 'entregado', 'Luciano Bedbury', '13 Warbler Road');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `short_description` text COLLATE utf8_spanish2_ci,
  `description` text COLLATE utf8_spanish2_ci,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `type` varchar(6) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `order_detail`
--

INSERT INTO `order_detail` (`id`, `orderId`, `name`, `short_description`, `description`, `quantity`, `price`, `type`) VALUES
(1, 1, 'molestie nibh in', 'Cras in purus eu magna vulputate luctus.', 'Phasellus in felis. Donec semper sapien a libero.', 6, 408, 'CD'),
(2, 2, 'proin leo', 'Etiam faucibus cursus urna.', 'Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.', 10, 134, 'DVD'),
(3, 1, 'felis eu sapien', 'Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo.', 'Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.', 1, 222, 'DVD'),
(4, 4, 'donec semper sapien', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam.', 'Suspendisse potenti. Cras in purus eu magna vulputate luctus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', 9, 411, 'DVD'),
(5, 5, 'venenatis lacinia aenean', 'Morbi non quam nec dui luctus rutrum.', 'Nulla tellus. In sagittis dui vel nisl. Duis ac nibh.', 6, 486, 'DVD'),
(6, 1, 'porttitor pede', 'Integer ac neque.', 'Ut at dolor quis odio consequat varius. Integer ac leo. Pellentesque ultrices mattis odio.', 3, 286, 'DVD'),
(7, 3, 'praesent blandit lacinia', 'Nulla ut erat id mauris vulputate elementum.', 'Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.', 5, 368, 'CD'),
(8, 2, 'ac tellus', 'Nunc purus. Phasellus in felis.', 'Integer ac neque. Duis bibendum. Morbi non quam nec dui luctus rutrum.', 1, 277, 'CD'),
(9, 4, 'eget nunc', 'Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.', 'Donec posuere metus vitae ipsum.', 3, 181, 'CD'),
(10, 3, 'rhoncus sed vestibulum', 'Suspendisse potenti.', 'Proin leo odio, porttitor id, consequat in, consequat ut, nulla.', 5, 315, 'CD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `short_description` text COLLATE utf8_spanish2_ci,
  `description` text COLLATE utf8_spanish2_ci,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `type` varchar(6) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `band` text COLLATE utf8_spanish2_ci,
  `image1` text COLLATE utf8_spanish2_ci,
  `image2` text COLLATE utf8_spanish2_ci,
  `image3` text COLLATE utf8_spanish2_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `short_description`, `description`, `quantity`, `price`, `type`, `band`, `image1`, `image2`, `image3`) VALUES
(1, 'Carter', 'Phasellus id sapien in sapien iaculis congue.', 'Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.', 209, 206, 'DVD', 'volutpat dui', '[{},{},{}]', '', ''),
(2, 'Prissie', 'Nullam varius.', 'Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.', 29, 200, 'DVD', 'cum sociis natoque', '[{},{},{}]', '', ''),
(3, 'Jennine', 'Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.', 'Sed ante. Vivamus tortor. Duis mattis egestas metus.', 268, 362, 'DVD', 'sollicitudin', '[{},{},{}]', '', ''),
(4, 'Taylor', 'In sagittis dui vel nisl.', 'Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.', 237, 321, 'CD', 'lacinia sapien', '[{},{},{}]', '', ''),
(5, 'Jobye', 'Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh. Quisque id justo sit amet sapien dignissim vestibulum.', 'Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.', 263, 284, 'vinilo', 'diam id', 'http://localhost/personaSlim/uploads/2727-large.jpg', '', ''),
(6, 'Xylina', 'Pellentesque at nulla. Suspendisse potenti.', 'Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.', 90, 295, 'remera', 'quisque', '[{},{},{}]', '', ''),
(7, 'Sophie', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi.', 'Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.', 172, 99, 'remera', 'orci mauris lacinia', '[{},{},{}]', '', ''),
(8, 'Rene', 'Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.', 'Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.', 97, 209, 'DVD', 'vel sem sed', '[{},{},{}]', '', ''),
(9, 'Jeniece', 'Cras non velit nec nisi vulputate nonummy.', 'Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.', 235, 57, 'vinilo', 'tristique', 'http://localhost/personaSlim/uploads/54-large.jpg', '', ''),
(10, 'Berny', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam.', 'Phasellus in felis. Donec semper sapien a libero. Nam dui.', 2, 389, 'vinilo', 'nulla pede ullamcorper', 'http://localhost/personaSlim/uploads/60-large.jpg', '', ''),
(11, 'Cloris', 'Morbi a ipsum.', 'Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', 253, 346, 'CD', 'nulla', 'http://localhost/personaSlim/uploads/62-large.jpg', '', ''),
(12, 'Ludwig', 'Suspendisse ornare consequat lectus.', 'In congue. Etiam justo. Etiam pretium iaculis justo.', 125, 247, 'remera', 'suspendisse potenti', 'http://localhost/personaSlim/uploads/6489-large_default.jpg', '', ''),
(13, 'Zachariah', 'Suspendisse ornare consequat lectus.', 'Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.', 10, 283, 'DVD', 'proin eu mi', 'http://dummyimage.com/250x250.png/dddddd/000000', '', ''),
(14, 'Dev', 'Fusce consequat.', 'Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.', 220, 60, 'vinilo', 'semper', 'http://dummyimage.com/250x250.png/ff4444/ffffff', 'http://dummyimage.com/250x250.png/dddddd/000000', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAA'),
(15, 'Roting Christ - AEALO - CD METAL BOX', 'style black metal, detailed style dark black metal', 'Limited box set including album + bonus DVD in 4-panel digipack, belt buckle, leather bracelet, XL t-shirt (the tag by misprint says XXL, but it is XL as advertised) and a car sticker!', 263, 850, 'vinilo', 'diam id', 'http://localhost/personaslim/uploads/2727-large.jpg', 'http://localhost/personaslim/uploads/2728-large.jpg', 'http://localhost/personaslim/uploads/2729-large.jpg'),
(16, 'Tren Loco - Sabaton - CD', 'Sabaton - CD', NULL, 50, 120, 'CD', 'Tren Loco', 'http://localhost/personaSlim/ws1/../uploads/img-20170709-59629d0dcf2e8.jpg', 'http://localhost/personaSlim/ws1/../uploads/img-20170709-59629d0e402d9.jpg', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
