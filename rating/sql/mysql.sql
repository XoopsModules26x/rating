#
# Table structure for table rating_modules
#
CREATE TABLE rating_modules (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `mid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `page` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `nb_stars` tinyint(1) unsigned NOT NULL DEFAULT '5',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;


#
# Table structure for table rating_user
#
CREATE TABLE rating_user (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT, 
  `rating_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `item_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL,
  `rate` int(1) NOT NULL,
  `date` int(11) NOT NULL,
  `ip` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY uid (`uid`),
  KEY ip (`ip`)
) ENGINE=MyISAM;