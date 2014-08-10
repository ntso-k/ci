/*
* Table: WebApp
* Date: 2014-07-20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for web_app
-- ----------------------------
DROP TABLE IF EXISTS `web_app`;
CREATE TABLE `web_app` (
  `web_app_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `appname` varchar(255) NULL UNIQUE,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `remarks` varchar(255) NULL,
  `description` text NULL,
  `icon_uri` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`web_app_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
