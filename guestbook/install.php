<?php
OW::getDbo()->query('DROP TABLE IF EXISTS `' . OW_DB_PREFIX . 'guestbook`;
CREATE TABLE `' . OW_DB_PREFIX . 'guestbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `createStamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
');

OW::getLanguage()->importLangsFromDir(__DIR__ . DS . 'langs', true, true);