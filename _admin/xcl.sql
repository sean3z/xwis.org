/*
Navicat MySQL Data Transfer

Source Server         : xwis.org
Source Server Version : 50141
Source Host           : xwis.org:3306
Source Database       : xcl

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2017-01-15 14:14:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `xcl_clans`
-- ----------------------------
DROP TABLE IF EXISTS `xcl_clans`;
CREATE TABLE `xcl_clans` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `founder_pid` int(11) NOT NULL DEFAULT '0' COMMENT 'Player Id, Founder',
  `lid` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2700 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Records of xcl_clans
-- ----------------------------
INSERT INTO `xcl_clans` VALUES ('1', 'gaffap', '0', '8', '1412550010');
INSERT INTO `xcl_clans` VALUES ('2', 'oke', '0', '8', '1412550010');
INSERT INTO `xcl_clans` VALUES ('3', 'jinsu', '0', '8', '1412550010');
INSERT INTO `xcl_clans` VALUES ('4', 'hhmm', '0', '8', '1412550010');
INSERT INTO `xcl_clans` VALUES ('5', 'looool', '0', '8', '1412552405');
INSERT INTO `xcl_clans` VALUES ('6', 'lovmat', '0', '8', '1412558406');
INSERT INTO `xcl_clans` VALUES ('7', '2kingz', '0', '8', '1412558406');
INSERT INTO `xcl_clans` VALUES ('8', 'sixty9', '0', '8', '1412561707');
INSERT INTO `xcl_clans` VALUES ('9', 'sexith', '0', '7', '1412598305');

-- ----------------------------
-- Table structure for `xcl_clans_ladder`
-- ----------------------------
DROP TABLE IF EXISTS `xcl_clans_ladder`;
CREATE TABLE `xcl_clans_ladder` (
  `cid` int(11) NOT NULL,
  `win_count` int(11) NOT NULL DEFAULT '0',
  `loss_count` int(11) NOT NULL DEFAULT '0',
  `games_count` int(11) NOT NULL DEFAULT '0',
  `dc_count` int(11) NOT NULL DEFAULT '0',
  `oos_count` int(11) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '0',
  `mtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xcl_clans_ladder
-- ----------------------------
INSERT INTO `xcl_clans_ladder` VALUES ('57', '73', '110', '183', '0', '0', '1040', '1477140720');
INSERT INTO `xcl_clans_ladder` VALUES ('58', '1', '4', '5', '0', '0', '39', '1425474360');
INSERT INTO `xcl_clans_ladder` VALUES ('59', '123', '171', '294', '0', '0', '1489', '1483220940');
INSERT INTO `xcl_clans_ladder` VALUES ('60', '0', '0', '0', '0', '0', '0', '1412224020');
INSERT INTO `xcl_clans_ladder` VALUES ('61', '0', '0', '0', '0', '0', '0', '1413389400');
INSERT INTO `xcl_clans_ladder` VALUES ('62', '0', '0', '0', '0', '0', '0', '1412187900');
INSERT INTO `xcl_clans_ladder` VALUES ('63', '0', '0', '0', '0', '0', '0', '1413269760');
INSERT INTO `xcl_clans_ladder` VALUES ('64', '1', '4', '5', '0', '0', '45', '1446853860');
INSERT INTO `xcl_clans_ladder` VALUES ('65', '0', '0', '0', '0', '0', '0', '1419802920');
INSERT INTO `xcl_clans_ladder` VALUES ('66', '0', '0', '0', '0', '0', '0', '1412440380');
INSERT INTO `xcl_clans_ladder` VALUES ('67', '0', '0', '0', '0', '0', '0', '1412393220');
INSERT INTO `xcl_clans_ladder` VALUES ('68', '0', '0', '0', '0', '0', '0', '1424310000');
INSERT INTO `xcl_clans_ladder` VALUES ('69', '0', '0', '0', '0', '0', '0', '1412320560');
INSERT INTO `xcl_clans_ladder` VALUES ('70', '366', '117', '483', '0', '0', '5382', '1481969820');
INSERT INTO `xcl_clans_ladder` VALUES ('71', '0', '0', '0', '0', '0', '0', '1412372400');
INSERT INTO `xcl_clans_ladder` VALUES ('72', '0', '6', '6', '0', '0', '0', '1432422480');
INSERT INTO `xcl_clans_ladder` VALUES ('73', '0', '0', '0', '0', '0', '0', '1412331960');
INSERT INTO `xcl_clans_ladder` VALUES ('74', '135', '41', '176', '0', '0', '2142', '1459463760');
INSERT INTO `xcl_clans_ladder` VALUES ('75', '53', '47', '100', '0', '0', '581', '1456778520');

-- ----------------------------
-- Table structure for `xcl_clans_players`
-- ----------------------------
DROP TABLE IF EXISTS `xcl_clans_players`;
CREATE TABLE `xcl_clans_players` (
  `cid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  UNIQUE KEY `cid` (`cid`,`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xcl_clans_players
-- ----------------------------
INSERT INTO `xcl_clans_players` VALUES ('1', '1033');
INSERT INTO `xcl_clans_players` VALUES ('1', '1046');
INSERT INTO `xcl_clans_players` VALUES ('1', '1050');
INSERT INTO `xcl_clans_players` VALUES ('1', '1258');
INSERT INTO `xcl_clans_players` VALUES ('2', '1033');
INSERT INTO `xcl_clans_players` VALUES ('2', '1047');
INSERT INTO `xcl_clans_players` VALUES ('3', '242');
INSERT INTO `xcl_clans_players` VALUES ('3', '1046');

-- ----------------------------
-- Table structure for `xcl_countries`
-- ----------------------------
DROP TABLE IF EXISTS `xcl_countries`;
CREATE TABLE `xcl_countries` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`fid`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of xcl_countries
-- ----------------------------
INSERT INTO `xcl_countries` VALUES ('1', 'GDI');
INSERT INTO `xcl_countries` VALUES ('2', 'Nod');
INSERT INTO `xcl_countries` VALUES ('3', 'America');
INSERT INTO `xcl_countries` VALUES ('4', 'Iraq');
INSERT INTO `xcl_countries` VALUES ('5', 'France');
INSERT INTO `xcl_countries` VALUES ('6', 'Korea');
INSERT INTO `xcl_countries` VALUES ('7', 'Germany');
INSERT INTO `xcl_countries` VALUES ('8', 'Libya');
INSERT INTO `xcl_countries` VALUES ('9', 'Great Britain');
INSERT INTO `xcl_countries` VALUES ('10', 'Russia');
INSERT INTO `xcl_countries` VALUES ('11', 'Cuba');
INSERT INTO `xcl_countries` VALUES ('12', 'Yuri');
INSERT INTO `xcl_countries` VALUES ('13', '?');
INSERT INTO `xcl_countries` VALUES ('14', '');

-- ----------------------------
-- Table structure for `xcl_games`
-- ----------------------------
DROP TABLE IF EXISTS `xcl_games`;
CREATE TABLE `xcl_games` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL COMMENT 'Ladder Id',
  `mid` int(11) NOT NULL COMMENT 'Map Id',
  `dura` int(11) NOT NULL DEFAULT '0' COMMENT 'Game Duration',
  `ws_gid` int(11) NOT NULL DEFAULT '0' COMMENT 'Westwood Game Id',
  `xcl_gid` int(11) NOT NULL DEFAULT '0',
  `afps` int(1) NOT NULL DEFAULT '69' COMMENT 'Average FPS',
  `crat` tinyint(4) NOT NULL DEFAULT '-1' COMMENT 'Crates FLAG',
  `oosy` int(1) NOT NULL DEFAULT '0' COMMENT 'Out of Sync FLAG',
  `mtime` int(11) NOT NULL COMMENT 'Modified time',
  PRIMARY KEY (`gid`),
  KEY `ws_gid` (`ws_gid`)
) ENGINE=MyISAM AUTO_INCREMENT=383573 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xcl_games
-- ----------------------------
INSERT INTO `xcl_games` VALUES ('1', '4', '222', '593', '1423791591', '67', '59', '0', '0', '1425173940');
INSERT INTO `xcl_games` VALUES ('2', '6', '2199', '1283', '1423791227', '4', '43', '0', '0', '1425168300');
INSERT INTO `xcl_games` VALUES ('3', '3', '259', '206', '1423791615', '68', '59', '0', '0', '1425173940');
INSERT INTO `xcl_games` VALUES ('4', '6', '860', '574', '1423791315', '8', '43', '1', '1', '1425168960');
INSERT INTO `xcl_games` VALUES ('5', '3', '50', '67', '1423791631', '69', '56', '0', '0', '1425174000');
INSERT INTO `xcl_games` VALUES ('6', '6', '94', '1618', '1423791255', '9', '52', '1', '0', '1425169020');
INSERT INTO `xcl_games` VALUES ('7', '3', '53', '144', '1423791639', '70', '58', '0', '0', '1425174180');
INSERT INTO `xcl_games` VALUES ('8', '6', '1792', '216', '1423791343', '10', '35', '1', '0', '1425169200');
INSERT INTO `xcl_games` VALUES ('9', '6', '95', '5186', '1423791067', '24', '26', '1', '0', '1425170400');
INSERT INTO `xcl_games` VALUES ('10', '4', '62', '1840', '1423791539', '71', '35', '0', '0', '1425174300');
INSERT INTO `xcl_games` VALUES ('11', '6', '770', '2949', '1423791263', '25', '31', '1', '0', '1425170460');
INSERT INTO `xcl_games` VALUES ('12', '3', '54', '350', '1423791643', '72', '58', '0', '1', '1425174420');
INSERT INTO `xcl_games` VALUES ('13', '6', '896', '2349', '1423791319', '30', '43', '1', '0', '1425170760');
INSERT INTO `xcl_games` VALUES ('14', '3', '247', '90', '1423791659', '73', '57', '0', '0', '1425174420');

-- ----------------------------
-- Table structure for `xcl_games_players`
-- ----------------------------
DROP TABLE IF EXISTS `xcl_games_players`;
CREATE TABLE `xcl_games_players` (
  `gid` int(11) NOT NULL DEFAULT '0',
  `pid` int(11) NOT NULL DEFAULT '0',
  `cmp` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Result. Player Won FLAG',
  `col` tinyint(11) NOT NULL DEFAULT '0' COMMENT 'Player color',
  `cty` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Player country',
  `pc` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Player points change',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT 'Clan Id',
  `inb` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Infantry Built',
  `unb` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Units Built',
  `plb` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Planes Built',
  `blb` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Buildings Built',
  `inl` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Infantry Left',
  `unl` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Units Left',
  `pll` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Planes Left',
  `bll` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Buildings Left',
  `ink` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Infantry Killed',
  `unk` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Units Killed',
  `plk` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Planes Killed',
  `blk` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Buildings Killed',
  `blc` smallint(11) NOT NULL DEFAULT '0' COMMENT 'Buildings Captured',
  `ipa` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0' COMMENT 'Serial Id',
  KEY `pid` (`pid`),
  KEY `cid` (`cid`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xcl_games_players
-- ----------------------------
INSERT INTO `xcl_games_players` VALUES ('1', '8983', '1', '8', '3', '35', '0', '67', '49', '8', '24', '20', '34', '0', '20', '33', '29', '4', '8', '4', '0', '0');
INSERT INTO `xcl_games_players` VALUES ('2', '7585', '1', '4', '9', '0', '0', '49', '59', '5', '40', '16', '35', '14', '33', '59', '32', '0', '33', '1', '0', '0');
INSERT INTO `xcl_games_players` VALUES ('1', '466', '0', '7', '6', '3', '0', '39', '38', '6', '13', '0', '0', '0', '0', '43', '14', '0', '3', '1', '0', '0');
INSERT INTO `xcl_games_players` VALUES ('2', '7611', '1', '5', '4', '0', '0', '52', '15', '0', '33', '38', '7', '4', '27', '11', '6', '0', '0', '2', '0', '0');
INSERT INTO `xcl_games_players` VALUES ('4', '7585', '1', '2', '5', '0', '0', '34', '19', '0', '36', '15', '5', '0', '29', '49', '17', '0', '0', '1', '0', '0');
INSERT INTO `xcl_games_players` VALUES ('3', '14', '1', '7', '3', '32', '0', '19', '17', '1', '14', '16', '10', '0', '11', '15', '2', '0', '0', '3', '0', '0');
INSERT INTO `xcl_games_players` VALUES ('4', '7611', '1', '5', '10', '0', '0', '28', '12', '0', '15', '0', '3', '0', '0', '13', '4', '0', '0', '0', '0', '0');
INSERT INTO `xcl_games_players` VALUES ('3', '6055', '0', '6', '3', '0', '0', '17', '10', '1', '10', '0', '0', '0', '0', '2', '4', '0', '1', '0', '0', '0');
INSERT INTO `xcl_games_players` VALUES ('5', '8976', '1', '3', '4', '32', '0', '8', '2', '0', '5', '7', '1', '0', '5', '5', '0', '0', '0', '1', '0', '0');

-- ----------------------------
-- Table structure for `xcl_hof`
-- ----------------------------
DROP TABLE IF EXISTS `xcl_hof`;
CREATE TABLE `xcl_hof` (
  `rank` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `lid` int(11) NOT NULL,
  `month` int(11) NOT NULL DEFAULT '0',
  `year` int(11) NOT NULL DEFAULT '0',
  KEY `lid` (`lid`),
  KEY `date` (`month`,`year`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xcl_hof
-- ----------------------------
INSERT INTO `xcl_hof` VALUES ('1', '2090', null, '3', '8', '2014');
INSERT INTO `xcl_hof` VALUES ('2', '2091', null, '3', '8', '2014');
INSERT INTO `xcl_hof` VALUES ('3', '2092', null, '3', '8', '2014');
INSERT INTO `xcl_hof` VALUES ('4', '2093', null, '3', '8', '2014');
INSERT INTO `xcl_hof` VALUES ('5', '2094', null, '3', '8', '2014');
INSERT INTO `xcl_hof` VALUES ('6', '198', null, '3', '8', '2014');
INSERT INTO `xcl_hof` VALUES ('7', '302', null, '3', '8', '2014');
INSERT INTO `xcl_hof` VALUES ('8', '2095', null, '3', '8', '2014');
INSERT INTO `xcl_hof` VALUES ('9', '2096', null, '3', '8', '2014');
INSERT INTO `xcl_hof` VALUES ('10', '2097', null, '3', '8', '2014');
INSERT INTO `xcl_hof` VALUES ('1', null, '103', '8', '8', '2014');
INSERT INTO `xcl_hof` VALUES ('2', null, '7', '8', '8', '2014');
INSERT INTO `xcl_hof` VALUES ('3', null, '95', '8', '8', '2014');
INSERT INTO `xcl_hof` VALUES ('4', null, '104', '8', '8', '2014');

-- ----------------------------
-- Table structure for `xcl_ladders`
-- ----------------------------
DROP TABLE IF EXISTS `xcl_ladders`;
CREATE TABLE `xcl_ladders` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xcl_ladders
-- ----------------------------
INSERT INTO `xcl_ladders` VALUES ('1', 'Tiberian Sun');
INSERT INTO `xcl_ladders` VALUES ('2', 'Tiberian Sun FFG');
INSERT INTO `xcl_ladders` VALUES ('3', 'Red Alert 2');
INSERT INTO `xcl_ladders` VALUES ('4', 'Red Alert 2 FFG');
INSERT INTO `xcl_ladders` VALUES ('5', 'Yuri\'s Revenge');
INSERT INTO `xcl_ladders` VALUES ('6', 'Yuri\'s Regenge FFG');
INSERT INTO `xcl_ladders` VALUES ('7', 'Tiberian Sun Clan');
INSERT INTO `xcl_ladders` VALUES ('8', 'Red Alert 2 Clan');
INSERT INTO `xcl_ladders` VALUES ('9', 'Yuri\'s Revenge Clan');

-- ----------------------------
-- Table structure for `xcl_maps`
-- ----------------------------
DROP TABLE IF EXISTS `xcl_maps`;
CREATE TABLE `xcl_maps` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lid` int(11) NOT NULL,
  PRIMARY KEY (`mid`),
  UNIQUE KEY `name` (`name`,`lid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3959 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xcl_maps
-- ----------------------------
INSERT INTO `xcl_maps` VALUES ('1', 'conf4reg.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('2', 'cof871~1.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('3', 'conf6reg.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('4', 'viscla~2.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('5', 'warlor1.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('6', 'viscat~2.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('7', 'copyof~1.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('8', '77viscla.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('9', 'seiger.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('10', 'bbg8_org.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('11', 'gow3v3~1.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('12', 'gow2014.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('13', 'egi4con4.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('14', 'viscre~1.mpr', '2');
INSERT INTO `xcl_maps` VALUES ('15', 'ccdomi~1.mpr', '2');


-- ----------------------------
-- Table structure for `xcl_players`
-- ----------------------------
DROP TABLE IF EXISTS `xcl_players`;
CREATE TABLE `xcl_players` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(9) NOT NULL,
  `win_count` int(11) NOT NULL DEFAULT '0',
  `loss_count` int(11) NOT NULL DEFAULT '0',
  `games_count` int(11) NOT NULL DEFAULT '0',
  `dc_count` int(11) NOT NULL DEFAULT '0',
  `oos_count` int(11) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '0',
  `countries` int(11) NOT NULL DEFAULT '0',
  `lid` int(11) NOT NULL COMMENT 'Ladder Id',
  `mtime` int(11) NOT NULL COMMENT 'Modified time',
  PRIMARY KEY (`pid`),
  UNIQUE KEY `name` (`name`,`lid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=26875 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xcl_players
-- ----------------------------
INSERT INTO `xcl_players` VALUES ('1', 'cicapazz', '163', '300', '463', '0', '29', '-36', '0', '4', '1454433060');
INSERT INTO `xcl_players` VALUES ('2', 'elderguru', '222', '189', '411', '0', '35', '2340', '0', '4', '1484492280');
INSERT INTO `xcl_players` VALUES ('3', 'aimee77', '2183', '683', '2866', '0', '15', '15421', '0', '4', '1483048800');
INSERT INTO `xcl_players` VALUES ('4', 'grufus', '0', '0', '0', '0', '0', '0', '0', '4', '1422031860');
INSERT INTO `xcl_players` VALUES ('5', 'genzyme66', '2179', '689', '2868', '0', '18', '12138', '0', '4', '1483048800');
INSERT INTO `xcl_players` VALUES ('6', 'harry99', '1243', '956', '2199', '0', '159', '1753', '0', '4', '1484353080');
INSERT INTO `xcl_players` VALUES ('7', 'cr3ative', '28', '21', '49', '0', '1', '593', '0', '4', '1462389480');
INSERT INTO `xcl_players` VALUES ('8', 'ovk1gee', '44', '37', '81', '0', '2', '846', '0', '4', '1471525020');
INSERT INTO `xcl_players` VALUES ('9', 'frequenzy', '240', '146', '386', '0', '12', '3249', '0', '4', '1478554020');
INSERT INTO `xcl_players` VALUES ('10', 'traumatic', '34', '37', '71', '0', '3', '512', '0', '4', '1449274920');
INSERT INTO `xcl_players` VALUES ('11', 'ge0rge', '0', '0', '0', '0', '0', '0', '0', '8', '1417567980');
INSERT INTO `xcl_players` VALUES ('12', 'gracefull', '0', '0', '0', '0', '0', '0', '0', '8', '1417333680');
INSERT INTO `xcl_players` VALUES ('13', 'olopeaker', '15', '18', '33', '0', '1', '357', '0', '3', '1480087320');
INSERT INTO `xcl_players` VALUES ('14', 'jacksonaa', '3', '8', '11', '0', '0', '79', '0', '3', '1446917520');
INSERT INTO `xcl_players` VALUES ('15', 'blackspin', '1506', '1104', '2610', '0', '64', '8567', '0', '4', '1468429740');

-- ----------------------------
-- Table structure for `xcl_screenshots`
-- ----------------------------
DROP TABLE IF EXISTS `xcl_screenshots`;
CREATE TABLE `xcl_screenshots` (
  `gid` int(11) NOT NULL,
  `ssid` int(11) NOT NULL COMMENT 'XWIS Screenshot ID',
  `pid` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `ssid` (`gid`,`ssid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xcl_screenshots
-- ----------------------------
INSERT INTO `xcl_screenshots` VALUES ('1', '5821576', '0');
INSERT INTO `xcl_screenshots` VALUES ('1', '5821575', '0');
INSERT INTO `xcl_screenshots` VALUES ('1', '5821574', '0');
INSERT INTO `xcl_screenshots` VALUES ('1', '5821573', '0');
INSERT INTO `xcl_screenshots` VALUES ('1', '5821572', '0');
INSERT INTO `xcl_screenshots` VALUES ('1', '5821571', '0');
INSERT INTO `xcl_screenshots` VALUES ('1', '5821570', '0');
INSERT INTO `xcl_screenshots` VALUES ('1', '5821569', '0');
INSERT INTO `xcl_screenshots` VALUES ('1', '5821568', '0');
INSERT INTO `xcl_screenshots` VALUES ('1', '5821567', '0');

-- ----------------------------
-- Procedure structure for `GameByWS_GID`
-- ----------------------------
DROP PROCEDURE IF EXISTS `GameByWS_GID`;
DELIMITER ;;
CREATE DEFINER=`sean`@`%` PROCEDURE `GameByWS_GID`(IN `ws_gid` int)
BEGIN
select g.ws_gid,
p.name,
IF(s.cmp > 0, 'Won', 'Lost') as Resolution,
s.cmp,
s.col,
s.cty,
s.cid,
cl.name as clan,
s.pc as PointsChanged,
c.name as Country,
s.inb as InfantryBuilt,
s.unb as UnitsBuilt,
s.plb as PlanesBuilt,
s.blb as BuildingsBuilt,
s.inl as InfantryLeft,
s.unl as UnitsLeft,
s.pll as PlanesLeft,
s.bll as BuildingsLeft,
s.ink as InfantryKilled,
s.unk as UnitsKilled,
s.plk as PlanesKilled,
s.blk as BuildingsKilled,
s.blc as BuildingsCaptured
from xcl_games_players s
inner join xcl_players p USING(pid)
inner join xcl_countries c ON c.fid = s.cty
inner join xcl_games g USING(gid)
left join xcl_clans cl USING(cid)
where g.ws_gid = ws_gid;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `xcl_ladder_reset`
-- ----------------------------
DROP PROCEDURE IF EXISTS `xcl_ladder_reset`;
DELIMITER ;;
CREATE DEFINER=`sean`@`%` PROCEDURE `xcl_ladder_reset`()
BEGIN
  #Routine body goes here...
update xcl_players set win_count = 0, loss_count = 0, games_count = 0, dc_count = 0, oos_count = 0, points = 0;
update xcl_clans_ladder set win_count = 0, loss_count = 0, games_count = 0, dc_count = 0, oos_count = 0, points = 0;
truncate xcl_games;
truncate xcl_games_players;
END
;;
DELIMITER ;
