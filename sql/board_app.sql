/*
* Table: board_app
* Date: 2014-08-07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for board_app
-- ----------------------------
DROP TABLE IF EXISTS `board_app`;
CREATE TABLE `board_app` (
  `board_id` int(10) unsigned NOT NULL,
  `web_app_id` int(10) unsigned NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`board_id`, `web_app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
