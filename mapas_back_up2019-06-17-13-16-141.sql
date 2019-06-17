#
# TABLE STRUCTURE FOR: usuarios
#

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` smallint(5) unsigned NOT NULL,
  `username` varchar(30) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `nivel` smallint(5) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuarios` (`id`, `username`, `passwd`, `nivel`) VALUES (1, 'admin', '$2y$10$PIHCvwqQYdJ4sAalDX0IcuaG48hb.WEbsmoyZa7rt9syfnQr2t5Uq', 2);


