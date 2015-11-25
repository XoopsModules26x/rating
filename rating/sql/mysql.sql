#
# Table structure for table rating_modules
#
CREATE TABLE rating_modules (
  `id`       MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mid`      SMALLINT(5) UNSIGNED  NOT NULL DEFAULT '0',
  `page`     VARCHAR(255)          NOT NULL DEFAULT '',
  `title`    VARCHAR(255)          NOT NULL DEFAULT '',
  `status`   TINYINT(1) UNSIGNED   NOT NULL DEFAULT '0',
  `display`  TINYINT(1) UNSIGNED   NOT NULL DEFAULT '0',
  `nb_stars` TINYINT(1) UNSIGNED   NOT NULL DEFAULT '5',
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM;


#
# Table structure for table rating_user
#
CREATE TABLE rating_user (
  `id`        MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rating_id` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
  `item_id`   MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
  `uid`       INT(11)               NOT NULL,
  `rate`      INT(1)                NOT NULL,
  `date`      INT(11)               NOT NULL,
  `ip`        VARCHAR(60)           NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY uid (`uid`),
  KEY ip (`ip`)
)
  ENGINE = MyISAM;
