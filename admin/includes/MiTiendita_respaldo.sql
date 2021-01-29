

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `urlImagen` text NOT NULL,
  `urlImagen2` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCli` varchar(30) NOT NULL,
  `ApellidoP_Cli` varchar(30) DEFAULT NULL,
  `ApellidoM_Cli` varchar(30) DEFAULT NULL,
  `CorreoUsuario` varchar(100) NOT NULL,
  `Contrasena` varchar(60) NOT NULL,
  `Saldo` float DEFAULT 0,
  `fotoCliente` text DEFAULT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO clientes VALUES("1","Ray","Garcia","Gonzalez","ray_garcia@mitiendita.com","$2y$12$wCLUljpa1T5gT9Cs3/fonuKaDnKtGCWcOc8t2KWlB03cJxW5e9D8q","0","store.png");
INSERT INTO clientes VALUES("2","Jonathan","Gomez","Alvarez","jonn@hotmail.com","$2y$12$JsJ2HMs.0EiO4nsf3zb4GetujZUYFVB1X2et1fkAtaxnTSY/K3yn6","0","");



CREATE TABLE `contacto` (
  `idComentario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Contacto` varchar(30) NOT NULL,
  `Apellidos_Contacto` varchar(50) NOT NULL,
  `Correo_c` varchar(100) NOT NULL,
  `Comentario` text NOT NULL,
  PRIMARY KEY (`idComentario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `detalleventas` (
  `idVenta` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `Precio` float NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `ClienteTemp` int(11) NOT NULL,
  PRIMARY KEY (`idVenta`,`idProducto`,`ClienteTemp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO detalleventas VALUES("1","29","5499","1","9999");
INSERT INTO detalleventas VALUES("1","31","2999","1","9999");
INSERT INTO detalleventas VALUES("2","26","17999","1","9999");
INSERT INTO detalleventas VALUES("9999","1","22","1","1");



CREATE TABLE `gastos` (
  `idGasto` int(11) NOT NULL AUTO_INCREMENT,
  `MotivoGasto` varchar(100) NOT NULL,
  `MontoGasto` float NOT NULL,
  `FechaGasto` text NOT NULL,
  PRIMARY KEY (`idGasto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO gastos VALUES("1","Pago a Proveedores","10000","28/06/2020");



CREATE TABLE `opinionproducto` (
  `idOpinion` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `Opinion` text NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`idOpinion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO opinionproducto VALUES("1","1","26","Excelente producto!!!","2020-06-29");
INSERT INTO opinionproducto VALUES("2","1","31","Buen telefono celular!!","2021-01-17");



CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `NombreProducto` varchar(100) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Precio` float NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Descrip` text DEFAULT NULL,
  `fotoProducto` text DEFAULT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

INSERT INTO productos VALUES("1","Aceite Capullo","Canasta Basica","22","9","Aceite para cocinar Capullo, presentación de 1 Litro","Aceite-capullo.png");
INSERT INTO productos VALUES("2","Atun Dolores","Canasta Basica","18","100","Aceite marca Dolores en Agua, presentación en lata","Atun Dolores.jpg");
INSERT INTO productos VALUES("3","Chicharos y Zanahoria Herdez","Canasta Basica","6","100","Chicharos con Zanahoria presentación en Lata marca herdez","Chicharo-Zanahoria-Herdez.jpg");
INSERT INTO productos VALUES("4","Coca-Cola 2.5Lts","Canasta Basica","30","200","Coca-Cola presentación no retornable de 2.5 Litros","Coca-Cola-2.5lts.jpg");
INSERT INTO productos VALUES("5","Harina Hotcakes","Canasta Basica","12","40","Harina para preparar hotcakes marca gamesa, no incluye maple","harina-hotcakes-gamesa.jpg");
INSERT INTO productos VALUES("6","Nescafe Clasico","Canasta Basica","45","30","Nestcafe Clasico presentación de 225Gramos, soluble","Nescafe-clasico.png");
INSERT INTO productos VALUES("7","Sal La Fina","Canasta Basica","8","50","Sal La Fina, presentación de 1 Kilogramo, en oferta","Sal-la-fina.jpg");
INSERT INTO productos VALUES("8","Axion Liquido","Aseo del Hogar","12","30","Jabon axion en presentación liquida de 500ml, muy economico","Axion-liquido.jpg");
INSERT INTO productos VALUES("9","Cloralex 1Lt","Aseo del Hogar","15","20","Botella de Cloro, marca cloralex, presentación de 1 Litro","Cloralex.jpg");
INSERT INTO productos VALUES("10","Fabuloso","Aseo del Hogar","16","30","Fabuloso presentación 1 Litro, varios aromas (Lavanda, Frutas,etc)","fabuloso.jpg");
INSERT INTO productos VALUES("11","Jabon Foca","Aseo del Hogar","18","20","Jabon Foca, en presentación en polvo, 1 kilogramo","jabon-foca.jpg");
INSERT INTO productos VALUES("12","Jabon Zote","Aseo del Hogar","14","50","Jabon Zote en presentaciones Rosa y Blanco","Jabon-Zote.jpg");
INSERT INTO productos VALUES("13","Suavitel","Aseo del Hogar","18","60","Suavitel facil planchado, presentación de 1 litro, varios aromas","Suavitel.png");
INSERT INTO productos VALUES("14","Camisa Negra","Ropa","99","20","Bonita camisa negra con estampado de lobo","Camisa-elegante.png");
INSERT INTO productos VALUES("15","Gorra","Ropa","150","15","Bonita gorra marca Adidas, muy economica","Gorra-adidas.png");
INSERT INTO productos VALUES("16","Converse","Ropa","599","20","Bonitos tenis marca Converse, varios colores y tallas","home-converse-all-star-blancas.jpg");
INSERT INTO productos VALUES("17","Jersey Futbol","Ropa","499","10","Bonito Jersey de la seleccion mexicana de futbol 2020","Jersey-seleccion-mexico.png");
INSERT INTO productos VALUES("18","Playera Adidas","Ropa","400","10","Hermosa playera marca adidas, muy durable y economica","Playera-Adidas.png");
INSERT INTO productos VALUES("19","Tenis Jordan","Ropa","1250","5","Hermosos tenis jordan, edición limitada, pocas piezas","tenis-air-jordan-1-rebel-xx-chicagojpg.jpg");
INSERT INTO productos VALUES("20","Estufa Mabe","Electrodomesticos","2389","5","Preciosa estufa marca Mabel, muy economica","Estufa-Mabel.jpg");
INSERT INTO productos VALUES("21","Lavadora Whirlpool","Electrodomesticos","4000","10","Bonita lavadora Whirpool , soporte hasta 20Kg","Lavadora-whirlpool.png");
INSERT INTO productos VALUES("22","Licuadora","Electrodomesticos","899","10","Bonita licuadora marca Oster, 5 velocidades","Licuadora-oster.png");
INSERT INTO productos VALUES("23","Lavadora Mabe","Electrodomesticos","5199","5","Hermosa lavadora de la marca Mabe 18Kg, pocas piezas","Mabe-Lavadora-20-kg.jpg");
INSERT INTO productos VALUES("24","Refrigerador Panasonic","Electrodomesticos","4999","10","Bonito refrigerador economico marca panasonic","Refrigerador-panasonic.png");
INSERT INTO productos VALUES("25","Refrigerador Samsung","Electrodomesticos","5199","6","Hermoso refrigerador inteligente marca Samsung, edicion especial","Refrigerador-samnsung.png");
INSERT INTO productos VALUES("26","Acer Nitro 5","Tecnologia","17999","4","Poderosa Laptop Acer Nitro, Intel i5 9na Gen, 16 GB RAM, 512 SSD","Acer-Nitro-5.png");
INSERT INTO productos VALUES("27","Multifuncional Epson","Tecnologia","2490","10","Multifuncional marca Epson, muy economica, incluye 4 cartuchos de tinta","EPSON-ECOTANK-L3150.jpg");
INSERT INTO productos VALUES("28","HP Pavilon 15","Tecnologia","16999","5","Hermosa Laptop Pavilon, SSD 256 GB, 16 GB RAM; i7 8va Generacion, Nvidia GTX 1050Ti","Hp-pavilion-15.png");
INSERT INTO productos VALUES("29","Oppo Reno 4","Tecnologia","5499","4","Poderoso Celular marca Oppo, Camara Trasera de 24MP, Frontal 12MP, Procesador Snapdragon 660","OPPO-Reno-4.png");
INSERT INTO productos VALUES("30","Samsung A20s","Tecnologia","8999","4","Hermoso Samsung A20s, Triple Camara trasera, Pantalla SuperAMOLED.","Samsung-A20s.png");
INSERT INTO productos VALUES("31","Xiaomi Redmi 8 Global","Tecnologia","2999","4","Hermoso Xiaomi Redmi 8 Global, promocion de $3,999 a solo $2,999, pocas piezas","Xiaomi-redmi-8-global.png");



CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `NombreUs` varchar(20) NOT NULL,
  `ApellidoP_Us` varchar(25) DEFAULT NULL,
  `ApellidoM_Us` varchar(25) DEFAULT NULL,
  `fotoUsuario` text DEFAULT NULL,
  `Usuario` varchar(20) NOT NULL,
  `TipoUsuario` varchar(20) NOT NULL,
  `Contrasena` varchar(60) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO usuarios VALUES("1","Ray","Garcia","Gonzalez","tec.png","ray","Administrador","$2y$12$wCLUljpa1T5gT9Cs3/fonuKaDnKtGCWcOc8t2KWlB03cJxW5e9D8q");
INSERT INTO usuarios VALUES("2","admin","","","ArK.png","admin","Administrador","$2y$12$BL4wOm0iIlQA0FK.BQbmteTMzekwvZ8bzhQ5Ncj4RwY31rXLGvwsO");
INSERT INTO usuarios VALUES("5","holi","holi","holi","","pruebas","Administrador","$2y$12$sL72aYOaUJRS4oJIk.goBe9VduLbSKc/82uRp3KTELuLEq9QgdOi.");



CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `FechaVenta` date NOT NULL,
  `totalVenta` float NOT NULL,
  PRIMARY KEY (`idVenta`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO ventas VALUES("1","1","2020-06-26","8498");
INSERT INTO ventas VALUES("2","1","2020-06-27","17999");

