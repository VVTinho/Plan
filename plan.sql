/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50136
Source Host           : localhost:3306
Source Database       : plan

Target Server Type    : MYSQL
Target Server Version : 50136
File Encoding         : 65001

Date: 2013-11-24 16:47:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `receivedjson`
-- ----------------------------
DROP TABLE IF EXISTS `receivedjson`;
CREATE TABLE `receivedjson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=230 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of receivedjson
-- ----------------------------
