/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;

DROP TABLE IF EXISTS `pedido_produtos`;
CREATE TABLE `pedido_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_produtos_pedido_fk` (`pedido_id`),
  KEY `pedidos_produtos_produto_fk` (`produto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT '1',
  `info` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_user_fk` (`user_id`),
  KEY `pedidos_status_fk` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `info` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `status` VALUES (1,'Escolhendo Produtos');
INSERT INTO `status` VALUES (2,'Enviado');
INSERT INTO `status` VALUES (3,'Pedido Alterado');
INSERT INTO `status` VALUES (4,'Pedido Recebido');
INSERT INTO `status` VALUES (5,'Preparando o Pedido');
INSERT INTO `status` VALUES (6,'Saiu Para Entrega');
INSERT INTO `status` VALUES (7,'Entregue');
INSERT INTO `status` VALUES (8,'Cancelado');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT 'cliente',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `users` VALUES (1,'Sr. Val','(14) 99633 - 0891','Rua do hamburguer','10','Bacon','17516740','srval@hamburguer.com','81dc9bdb52d04dc20036dbd8313ed055','admin','2020-04-30 20:27:38','2020-04-30 20:27:38',NULL);

ALTER TABLE `pedido_produtos`
ADD CONSTRAINT `pedidos_produtos_pedido_fk` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
ADD CONSTRAINT `pedidos_produtos_produto_fk` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);

ALTER TABLE `pedidos`
ADD CONSTRAINT `pedidos_status_fk` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
