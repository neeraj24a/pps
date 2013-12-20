/*
Navicat MySQL Data Transfer

Source Server         : karari
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : mrp

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-07-09 07:15:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `sm_setting`
-- ----------------------------
DROP TABLE IF EXISTS `sm_setting`;
CREATE TABLE `sm_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rate` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `autosend` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uk` (`rate`,`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sm_setting
-- ----------------------------
INSERT INTO `sm_setting` VALUES ('1', '4', '1', '1');
