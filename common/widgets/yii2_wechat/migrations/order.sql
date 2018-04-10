/*
Navicat MySQL Data Transfer

Source Server         : 测试服务器
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : zqdc_db

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2018-04-03 10:50:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `trade_type` varchar(50) NOT NULL COMMENT '交易类型',
  `total_fee` int(11) NOT NULL DEFAULT '0' COMMENT '订单金额',
  `transaction_id` varchar(32) NOT NULL DEFAULT '0' COMMENT '微信支付订单号',
  `out_trade_no` varchar(32) NOT NULL DEFAULT '0' COMMENT '商户订单号',
  `created_at` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0' COMMENT '0,1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
