
--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `nombre`, `talle`, `genero`, `precio`, `marca`, `id_categoria`, `color`, `stock`, `descripcion`, `tipo_producto`, `dirigido_a`, `foto`, `descuento_id`, `created_at`, `updated_at`) VALUES
(1, 'Pelota de Voley amarilla y azul', NULL, 'U', 13000.00, 'Gold', 1, 'Amarillo', 10, NULL, 'accesorio', 'ambos', 'pelota-de-voley-gold-numero-5-amarilla-121040000330002-1.jpg', NULL, '2024-06-01 10:29:12', '2024-06-01 10:29:12'),
(2, 'Pelota de Fútbol rojo y azul', NULL, 'U', 20000.00, 'Otro', 1, 'Rojo', 13, NULL, 'accesorio', 'ambos', '1414-2.jpg', NULL, '2024-06-01 10:33:03', '2024-06-01 10:33:03'),
(3, 'Botines de futbol 11', NULL, 'U', 34350.00, 'Adidas', 1, 'Blanco', 10, NULL, 'calzado', 'adultos', 'ADHQ8944-1.JPG', NULL, '2024-06-01 10:34:38', '2024-06-01 10:34:38'),
(4, 'Botines de futbol 11 rosa adidas', NULL, 'F', 45320.00, 'Adidas', 1, 'Fuxia', 9, NULL, 'calzado', 'adultos', 'botines.JPG', NULL, '2024-06-01 10:36:56', '2024-06-01 10:36:56');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `articulo_calzado`
--

INSERT INTO `articulo_calzado` (`id`, `articulo_id`, `calzado_id`, `stocks`, `precio`, `created_at`, `updated_at`) VALUES
(1, 3, 13, 3, 34350.00, NULL, NULL),
(2, 3, 15, 2, 34350.00, NULL, NULL),
(3, 3, 18, 5, 34350.00, NULL, NULL),
(4, 4, 11, 3, 45320.00, NULL, NULL),
(5, 4, 17, 3, 45320.00, NULL, NULL),
(6, 4, 20, 3, 45320.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `articulo_deporte`
--

INSERT INTO `articulo_deporte` (`id`, `articulo_id`, `deporte_id`, `descuento_porcentaje`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 0.00, NULL, NULL),
(2, 1, 10, 0.00, NULL, NULL),
(3, 2, 4, 0.00, NULL, NULL),
(4, 2, 2, 0.00, NULL, NULL),
(5, 2, 3, 0.00, NULL, NULL),
(6, 2, 5, 0.00, NULL, NULL),
(7, 3, 4, 0.00, NULL, NULL),
(8, 3, 34, 0.00, NULL, NULL),
(9, 3, 2, 0.00, NULL, NULL),
(10, 3, 5, 0.00, NULL, NULL),
(11, 3, 39, 0.00, NULL, NULL),
(12, 4, 4, 0.00, NULL, NULL),
(13, 4, 2, 0.00, NULL, NULL),
(14, 4, 39, 0.00, NULL, NULL),
(15, 4, 3, 0.00, NULL, NULL);

