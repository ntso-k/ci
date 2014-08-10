/*
* Table: Acount_App
* Date: 2014-08-07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for account_app
-- ----------------------------
DROP TABLE IF EXISTS `account_app`;
CREATE TABLE `account_app` (
  `account_id` int(10) unsigned NOT NULL,
  `app_id` int(10) unsigned NOT NULL,
  `add_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`account_id`, `app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
