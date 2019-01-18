# Host: localhost  (Version: 5.5.53)
# Date: 2019-01-18 09:08:40
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "ims_snake_chatgroup"
#

DROP TABLE IF EXISTS `ims_snake_chatgroup`;
CREATE TABLE `ims_snake_chatgroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '群组id',
  `groupname` varchar(155) NOT NULL COMMENT '群组名称',
  `avatar` varchar(155) DEFAULT NULL COMMENT '群组头像',
  `owner_name` varchar(155) DEFAULT NULL COMMENT '群主名称',
  `owner_id` int(11) DEFAULT NULL COMMENT '群主id',
  `owner_avatar` varchar(155) DEFAULT NULL COMMENT '群主头像',
  `owner_sign` varchar(155) DEFAULT NULL COMMENT '群主签名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "ims_snake_chatgroup"
#

/*!40000 ALTER TABLE `ims_snake_chatgroup` DISABLE KEYS */;
INSERT INTO `ims_snake_chatgroup` VALUES (1,'123','/uploads/20190109/c83d6fd3983880b036bf9a92a7546643.png','马云',2,'http://tp4.sinaimg.cn/2145291155/180/5601307179/1','让天下没有难写的代码'),(2,'456','/uploads/20190109/6e1fdb2611323cd2db118d2d2d9c3110.png','马云',2,'http://tp4.sinaimg.cn/2145291155/180/5601307179/1','让天下没有难写的代码');
/*!40000 ALTER TABLE `ims_snake_chatgroup` ENABLE KEYS */;

#
# Structure for table "ims_snake_chatlog"
#

DROP TABLE IF EXISTS `ims_snake_chatlog`;
CREATE TABLE `ims_snake_chatlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromid` int(11) NOT NULL COMMENT '会话来源id',
  `fromname` varchar(155) NOT NULL DEFAULT '' COMMENT '消息来源用户名',
  `fromavatar` varchar(155) NOT NULL DEFAULT '' COMMENT '来源的用户头像',
  `content` text NOT NULL COMMENT '发送的内容',
  `timeline` int(10) NOT NULL COMMENT '记录时间',
  `type` tinyint(3) DEFAULT '0' COMMENT '聊天类型 0消息 1红包',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '群组id',
  `uids` text COMMENT '已读用户id',
  `number` int(11) NOT NULL DEFAULT '0' COMMENT '红包数量',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '红包状态',
  `packet` text COMMENT '领取人',
  `money` float(16,2) NOT NULL DEFAULT '0.00' COMMENT '红包金额',
  PRIMARY KEY (`id`),
  KEY `fromid` (`fromid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "ims_snake_chatlog"
#

/*!40000 ALTER TABLE `ims_snake_chatlog` DISABLE KEYS */;
INSERT INTO `ims_snake_chatlog` VALUES (1,1,'纸飞机','http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg','123',1547196115,0,1,'1,2,3',0,0,NULL,0.00),(2,1,'纸飞机','http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg','123',1547196116,0,1,'1,2,3',0,0,NULL,0.00),(3,1,'纸飞机','http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg','123',1547196117,0,1,'1,2,3',0,0,NULL,0.00),(4,1,'纸飞机','http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg','456',1547196119,0,1,'1,2,3',0,0,NULL,0.00),(5,1,'纸飞机','http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg','456',1547196540,0,1,'1,2,3',0,0,NULL,0.00),(6,1,'纸飞机','http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg','789',1547196546,0,1,'1,2,3',0,0,NULL,0.00),(7,2,'马云','http://tp4.sinaimg.cn/2145291155/180/5601307179/1','456',1547198189,0,1,'2,1,3',0,0,NULL,0.00),(8,2,'马云','http://tp4.sinaimg.cn/2145291155/180/5601307179/1','123',1547201535,0,1,'2,1,3',0,0,NULL,0.00),(9,1,'纸飞机','http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg','123',1547201645,0,1,'1,2,3',0,0,NULL,0.00),(10,2,'马云','http://tp4.sinaimg.cn/2145291155/180/5601307179/1','123',1547428322,0,1,',2,1,3',0,0,NULL,0.00),(11,2,'马云','http://tp4.sinaimg.cn/2145291155/180/5601307179/1','789',1547428574,0,1,',2,1,3',0,0,NULL,0.00),(12,2,'马云','http://tp4.sinaimg.cn/2145291155/180/5601307179/1','1236',1547429387,0,1,'2,1,3',0,0,NULL,0.00),(13,3,'罗玉凤','http://tp1.sinaimg.cn/1241679004/180/5743814375/0','987',1547430857,0,1,'3,2,1',0,0,NULL,0.00),(14,3,'罗玉凤','http://tp1.sinaimg.cn/1241679004/180/5743814375/0','你好',1547430929,0,1,'3,1,2',0,0,NULL,0.00),(15,2,'马云','http://tp4.sinaimg.cn/2145291155/180/5601307179/1','你好',1547430940,0,1,'2,1,3',0,0,NULL,0.00),(16,3,'罗玉凤','http://tp1.sinaimg.cn/1241679004/180/5743814375/0','123',1547432952,0,1,'3,1,2',0,0,NULL,0.00),(17,3,'罗玉凤','http://tp1.sinaimg.cn/1241679004/180/5743814375/0','456',1547432986,1,1,'3,2,1',5,0,',1,2,3',5.00),(18,3,'罗玉凤','http://tp1.sinaimg.cn/1241679004/180/5743814375/0','456',1547433360,1,1,'3,2,1',3,1,',2,3,1',5.00),(19,3,'罗玉凤','http://tp1.sinaimg.cn/1241679004/180/5743814375/0','123',1547433375,1,1,'3,2,1',2,1,',3,1',5.00);
/*!40000 ALTER TABLE `ims_snake_chatlog` ENABLE KEYS */;

#
# Structure for table "ims_snake_chatuser"
#

DROP TABLE IF EXISTS `ims_snake_chatuser`;
CREATE TABLE `ims_snake_chatuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(155) DEFAULT NULL COMMENT '用户昵称',
  `groupid` int(5) NOT NULL DEFAULT '1' COMMENT '所属的分组id',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像地址',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "ims_snake_chatuser"
#

/*!40000 ALTER TABLE `ims_snake_chatuser` DISABLE KEYS */;
INSERT INTO `ims_snake_chatuser` VALUES (1,'纸飞机',1,'http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg',1),(2,'马云',1,'http://tp4.sinaimg.cn/2145291155/180/5601307179/1',2),(3,'罗玉凤',1,'http://tp1.sinaimg.cn/1241679004/180/5743814375/0',3);
/*!40000 ALTER TABLE `ims_snake_chatuser` ENABLE KEYS */;

#
# Structure for table "ims_snake_groupdetail"
#

DROP TABLE IF EXISTS `ims_snake_groupdetail`;
CREATE TABLE `ims_snake_groupdetail` (
  `userid` int(11) NOT NULL,
  `username` varchar(155) NOT NULL,
  `useravatar` varchar(155) NOT NULL,
  `usersign` varchar(155) NOT NULL,
  `groupid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "ims_snake_groupdetail"
#

/*!40000 ALTER TABLE `ims_snake_groupdetail` DISABLE KEYS */;
INSERT INTO `ims_snake_groupdetail` VALUES (1,'纸飞机','http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg','在深邃的编码世界，做一枚轻盈的纸飞机',1),(2,'马云','http://tp4.sinaimg.cn/2145291155/180/5601307179/1','让天下没有难写的代码',1),(3,'罗玉凤','http://tp1.sinaimg.cn/1241679004/180/5743814375/0','在自己实力不济的时候，不要去相信什么媒体和记者。他们不是善良的人，有时候候他们的采访对当事人而言就是陷阱',1),(13,'前端大神','http://tp1.sinaimg.cn/1241679004/180/5743814375/0','前端就是这么牛',1),(16,'王鹏飞','/uploads/20181130/2b8e0bb617edf86ac7d1183bd72e972c.jpg','222',1),(17,'李四','/uploads/20181130/bf4d96194be7c9a364735c9008f3abe6.jpg','ddd',1),(1,'纸飞机','http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg','在深邃的编码世界，做一枚轻盈的纸飞机',2),(2,'马云','http://tp4.sinaimg.cn/2145291155/180/5601307179/1','让天下没有难写的代码',2),(13,'前端大神','http://tp1.sinaimg.cn/1241679004/180/5743814375/0','前端就是这么牛',2),(16,'王鹏飞','/uploads/20181130/2b8e0bb617edf86ac7d1183bd72e972c.jpg','222',2),(17,'李四','/uploads/20181130/bf4d96194be7c9a364735c9008f3abe6.jpg','ddd',2);
/*!40000 ALTER TABLE `ims_snake_groupdetail` ENABLE KEYS */;

#
# Structure for table "ims_snake_packet"
#

DROP TABLE IF EXISTS `ims_snake_packet`;
CREATE TABLE `ims_snake_packet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_id` int(11) NOT NULL DEFAULT '0' COMMENT '聊天记录id',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `nickname` varchar(255) DEFAULT NULL COMMENT '用户昵称',
  `avatar` varchar(255) DEFAULT NULL COMMENT '用户头像',
  `money` float(16,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `time` varchar(255) DEFAULT NULL COMMENT '领取时间',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否领取 0否 1是',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='红包';

#
# Data for table "ims_snake_packet"
#

/*!40000 ALTER TABLE `ims_snake_packet` DISABLE KEYS */;
INSERT INTO `ims_snake_packet` VALUES (1,17,2,'马云','http://tp4.sinaimg.cn/2145291155/180/5601307179/1',0.94,'1547449149',1),(2,17,3,'罗玉凤','http://tp1.sinaimg.cn/1241679004/180/5743814375/0',1.03,'1547449155',1),(3,17,1,'纸飞机','http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg',0.51,'1547449161',1),(4,17,NULL,NULL,NULL,1.58,NULL,0),(5,17,NULL,NULL,NULL,0.94,NULL,0),(6,18,2,'马云','http://tp4.sinaimg.cn/2145291155/180/5601307179/1',0.35,'1547457593',1),(7,18,3,'罗玉凤','http://tp1.sinaimg.cn/1241679004/180/5743814375/0',2.96,'1547458060',1),(8,18,1,'纸飞机','http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg',1.69,'1547458071',1),(9,19,3,'罗玉凤','http://tp1.sinaimg.cn/1241679004/180/5743814375/0',3.58,'1547458121',1),(10,19,1,'纸飞机','http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg',1.42,'1547458127',1);
/*!40000 ALTER TABLE `ims_snake_packet` ENABLE KEYS */;
