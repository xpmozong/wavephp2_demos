/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : enterprise

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-12 10:52:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `b_admin_log`
-- ----------------------------
DROP TABLE IF EXISTS `b_admin_log`;
CREATE TABLE `b_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(10) NOT NULL DEFAULT '' COMMENT '用户名',
  `query_uri` varchar(512) NOT NULL DEFAULT '' COMMENT '访问链接',
  `description` varchar(2000) NOT NULL DEFAULT '' COMMENT '操作描述',
  `parameters` text,
  `remark` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-成功 0-失败',
  `client_ip` char(15) NOT NULL DEFAULT '' COMMENT 'IP地址',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=631 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of b_admin_log
-- ----------------------------

-- ----------------------------
-- Table structure for `b_menus`
-- ----------------------------
DROP TABLE IF EXISTS `b_menus`;
CREATE TABLE `b_menus` (
  `menu_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `top_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级菜单',
  `menu_url` varchar(50) NOT NULL DEFAULT '' COMMENT '功能链接',
  `menu_name` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `menu_order` smallint(6) unsigned DEFAULT '0',
  `pclass` varchar(255) DEFAULT '' COMMENT '父class',
  `fastyle` varchar(255) DEFAULT NULL COMMENT '图标类型',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of b_menus
-- ----------------------------
INSERT INTO `b_menus` VALUES ('1', '0', '', '设置', '0', 'admin', 'fa-dashboard');
INSERT INTO `b_menus` VALUES ('2', '0', '', '后台管理', '1', 'manage', 'fa-list');
INSERT INTO `b_menus` VALUES ('5', '1', 'admin/index', '首页', '0', 'admin', 'fa-circle-o');
INSERT INTO `b_menus` VALUES ('6', '2', 'menus', '菜单管理', '0', 'manage', 'fa-circle-o');
INSERT INTO `b_menus` VALUES ('7', '2', 'groups', '权限组管理', '1', 'manage', 'fa-circle-o');
INSERT INTO `b_menus` VALUES ('8', '2', 'users', '账号管理', '2', 'manage', 'fa-circle-o');
INSERT INTO `b_menus` VALUES ('33', '2', 'logs', '系统日志', '3', 'manage', 'fa-circle-o');
INSERT INTO `b_menus` VALUES ('34', '0', '', '内容管理', '2', 'cms', 'fa-list');
INSERT INTO `b_menus` VALUES ('35', '34', 'frontmenu', '前台菜单', '0', 'cms', 'fa-circle-o');
INSERT INTO `b_menus` VALUES ('36', '34', 'categories', '文章分类', '1', 'cms', 'fa-circle-o');
INSERT INTO `b_menus` VALUES ('37', '34', 'articles', '文章管理', '2', 'cms', 'fa-circle-o');
INSERT INTO `b_menus` VALUES ('38', '34', 'portalpage', '页面管理', '3', 'cms', 'fa-circle-o');
INSERT INTO `b_menus` VALUES ('39', '34', 'links', '友情链接', '4', 'cms', 'fa-circle-o');

-- ----------------------------
-- Table structure for `b_users`
-- ----------------------------
DROP TABLE IF EXISTS `b_users`;
CREATE TABLE `b_users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `group_id` int(11) NOT NULL COMMENT '用户组ID',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '激活 0-否 1-是',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `add_date` datetime DEFAULT NULL COMMENT '添加日期',
  `last_login_date` datetime DEFAULT NULL COMMENT '最后登录日期',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_users
-- ----------------------------
INSERT INTO `b_users` VALUES ('1', 'admin', 'aec6f39178f278c8e071ec9237697c20', '1', '361131953@qq.com', '1', '', '2015-08-08 14:35:43', '2017-01-10 17:57:44');

-- ----------------------------
-- Table structure for `b_users_group`
-- ----------------------------
DROP TABLE IF EXISTS `b_users_group`;
CREATE TABLE `b_users_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `group_name` varchar(255) NOT NULL COMMENT '权限组名称',
  `group_state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：0-禁用 1-启用',
  `menu_ids` text,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of b_users_group
-- ----------------------------
INSERT INTO `b_users_group` VALUES ('1', '0', '超级管理员组', '1', '1,5,2,6,7,8,33,34,35,36,37,38,39', '');

-- ----------------------------
-- Table structure for `w_articles`
-- ----------------------------
DROP TABLE IF EXISTS `w_articles`;
CREATE TABLE `w_articles` (
  `aid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT '文章分类id',
  `add_date` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of w_articles
-- ----------------------------
INSERT INTO `w_articles` VALUES ('1', '是打发斯蒂芬是打发', '2', '2014-10-26 15:43:00');
INSERT INTO `w_articles` VALUES ('2', '是打发士大夫似的', '1', '2014-10-26 15:43:00');
INSERT INTO `w_articles` VALUES ('3', 'linux小结', '3', '2014-10-26 15:43:00');
INSERT INTO `w_articles` VALUES ('4', '阿士大夫士大夫', '1', '2014-10-26 15:43:00');
INSERT INTO `w_articles` VALUES ('5', '开始计划的副科级阿士大夫', '1', '2014-10-26 15:43:00');
INSERT INTO `w_articles` VALUES ('6', '间距为', '1', '2014-10-26 15:43:00');
INSERT INTO `w_articles` VALUES ('7', '色人体各瑞特人突然', '1', '2014-10-26 15:43:00');
INSERT INTO `w_articles` VALUES ('8', '测试', '1', '2017-01-05 18:35:21');

-- ----------------------------
-- Table structure for `w_articles_content`
-- ----------------------------
DROP TABLE IF EXISTS `w_articles_content`;
CREATE TABLE `w_articles_content` (
  `ac_id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL COMMENT '文章id',
  `content` longtext,
  `content2` longtext COMMENT '工作地点',
  PRIMARY KEY (`ac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of w_articles_content
-- ----------------------------
INSERT INTO `w_articles_content` VALUES ('24', '7', '&lt;p&gt;对分公司对分公司对分公司对分公司的风格sdfsdfsdf&lt;/p&gt;\r\n', null);
INSERT INTO `w_articles_content` VALUES ('25', '6', '&lt;p&gt;深深地发士大夫撒地方&lt;/p&gt;\r\n', null);
INSERT INTO `w_articles_content` VALUES ('26', '8', '&lt;p&gt;&amp;quot;是打发士大夫撒地方的&lt;/p&gt;\r\n', null);
INSERT INTO `w_articles_content` VALUES ('28', '5', '&lt;p&gt;是打发士大夫士大夫撒旦法师的分&lt;/p&gt;\r\n', null);
INSERT INTO `w_articles_content` VALUES ('29', '4', '&lt;p&gt;是打发是打发斯蒂芬斯蒂芬&lt;/p&gt;\r\n', null);
INSERT INTO `w_articles_content` VALUES ('30', '1', '&lt;p&gt;是打发是打发斯蒂芬斯蒂芬胜多负少&lt;/p&gt;\r\n\r\n&lt;p&gt;是短发撒旦法撒旦法水电费水电费&lt;/p&gt;\r\n\r\n&lt;p&gt;是短发撒旦法撒旦法水电费水电费&lt;/p&gt;\r\n', null);
INSERT INTO `w_articles_content` VALUES ('31', '3', '&lt;p&gt;是打发斯蒂芬斯蒂芬&lt;/p&gt;\r\n\r\n&lt;p&gt;是打发士大夫撒地方的分&lt;/p&gt;\r\n\r\n&lt;p&gt;士大夫士大夫撒分维吾尔&lt;/p&gt;\r\n', null);

-- ----------------------------
-- Table structure for `w_category`
-- ----------------------------
DROP TABLE IF EXISTS `w_category`;
CREATE TABLE `w_category` (
  `cid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cate_order` int(11) DEFAULT '0',
  `c_name` varchar(255) DEFAULT NULL COMMENT '分类名',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of w_category
-- ----------------------------
INSERT INTO `w_category` VALUES ('1', '0', '行业资讯');
INSERT INTO `w_category` VALUES ('2', '0', '企业动态');
INSERT INTO `w_category` VALUES ('3', '0', '技术文章');

-- ----------------------------
-- Table structure for `w_front_menus`
-- ----------------------------
DROP TABLE IF EXISTS `w_front_menus`;
CREATE TABLE `w_front_menus` (
  `menu_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `top_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级菜单',
  `url_id` varchar(20) DEFAULT NULL COMMENT '对应id',
  `menu_url` varchar(50) NOT NULL DEFAULT '' COMMENT '功能链接',
  `menu_name` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `menu_order` smallint(6) unsigned DEFAULT '0',
  `pclass` varchar(255) DEFAULT '' COMMENT '父class',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of w_front_menus
-- ----------------------------
INSERT INTO `w_front_menus` VALUES ('1', '0', '', '', '首页', '0', 'index');
INSERT INTO `w_front_menus` VALUES ('2', '0', '', '', '新闻动态', '1', 'cms');
INSERT INTO `w_front_menus` VALUES ('3', '0', '', '', '关于我们', '2', 'about');
INSERT INTO `w_front_menus` VALUES ('4', '2', 'c_1', 'category/index?cid=1', '行业资讯', '0', 'cms');
INSERT INTO `w_front_menus` VALUES ('5', '2', 'c_2', 'category/index?cid=2', '企业动态', '1', 'cms');
INSERT INTO `w_front_menus` VALUES ('6', '2', 'c_3', 'category/index?cid=3', '技术文章', '2', 'cms');
INSERT INTO `w_front_menus` VALUES ('7', '3', 'p_1', 'page/index?pid=1', '公司简介', '0', 'about');
INSERT INTO `w_front_menus` VALUES ('8', '3', 'p_2', 'page/index?pid=2', '加入我们', '1', 'about');
INSERT INTO `w_front_menus` VALUES ('9', '3', 'p_3', 'page/index?pid=3', '联系我们', '2', 'about');

-- ----------------------------
-- Table structure for `w_language`
-- ----------------------------
DROP TABLE IF EXISTS `w_language`;
CREATE TABLE `w_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '语言id',
  `lang_code` varchar(20) NOT NULL DEFAULT '' COMMENT '语言编码',
  `lang_key` varchar(50) NOT NULL COMMENT '翻译项',
  `lang_value` varchar(128) NOT NULL DEFAULT '' COMMENT '翻译内容',
  PRIMARY KEY (`id`),
  UNIQUE KEY `lang_index` (`lang_value`,`lang_code`,`lang_key`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='多语言翻译项';

-- ----------------------------
-- Records of w_language
-- ----------------------------
INSERT INTO `w_language` VALUES ('2', 'vi-vn', '1', 'Quản lý cổng');
INSERT INTO `w_language` VALUES ('1', 'zh-cn', '1', '平台管理');

-- ----------------------------
-- Table structure for `w_links`
-- ----------------------------
DROP TABLE IF EXISTS `w_links`;
CREATE TABLE `w_links` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of w_links
-- ----------------------------
INSERT INTO `w_links` VALUES ('1', 'http://www.baidu.com', '百度');
INSERT INTO `w_links` VALUES ('2', 'https://github.com', 'github');

-- ----------------------------
-- Table structure for `w_portalpage`
-- ----------------------------
DROP TABLE IF EXISTS `w_portalpage`;
CREATE TABLE `w_portalpage` (
  `pid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `content` longtext COMMENT '内容',
  `add_date` datetime DEFAULT NULL COMMENT '添加日期',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='内容表';

-- ----------------------------
-- Records of w_portalpage
-- ----------------------------
INSERT INTO `w_portalpage` VALUES ('1', '公司简介', '<p>是打发斯蒂芬多少</p>\r\n\r\n<p>类似的纠纷连卡时间的分开了就爱是打开了附件快乐时间的分开就暗示的客服就阿里开始的积分卡时间到了房间爱历史课大姐夫是理科的肌肤卡拉是大家分开了撒娇的副科级阿士大夫刻录机奥斯卡的飞机拉是看得见方腊时刻的肌肤凯立德了深刻的肌肤拉克是大家分开了就是打开了房间了深刻的激发了开始的减肥临时卡打飞机了凯撒的机房里卡时间的咖啡机</p>\r\n\r\n<p><img alt=\"\" src=\"http://127.0.0.1/enterprise/uploadfile/substance/201410/1414290969_11953.jpg\" style=\"height:531px; width:800px\" /></p>\r\n\r\n<p>暗示法师打发士大夫士大夫</p>\r\n\r\n<p>卡死了的看法开开开始的丰厚的健康的合法为客户发放啊是理科的肌肤哈就开始大富豪</p>\r\n\r\n<p>可是记得回复卡就是的回房间阿克苏的肌肤会卡就是的恢复健康阿卡时间的回复可就是的合法可是记得发货快接啊四大行结婚d</p>\r\n\r\n<p>是看得见回复卡就是的复活节</p>\r\n', '2017-01-10 16:14:15');
INSERT INTO `w_portalpage` VALUES ('2', '加入我们', '<p>电脑发士大夫士大夫还记得</p>\r\n\r\n<p>舍得放开撒娇的法律会计师打开</p>\r\n\r\n<p>是的激发了深刻的肌肤可拉萨的疯狂</p>\r\n\r\n<p>事登记法拉克时间的法律会计师打开</p>\r\n\r\n<p>实力的快件费卢卡斯的肌肤开始觉得</p>\r\n\r\n<p>哦对了房间里是卡的肌肤开始的减肥的减肥</p>\r\n\r\n<p><img alt=\"\" src=\"http://127.0.0.1/enterprise/uploadfile/substance/201410/1414301759_28039.jpg\" style=\"height:531px; width:800px\" /></p>\r\n\r\n<p>时间开房记录是卡机的付款了是的减肥了开始就爱的分开了</p>\r\n', '2017-01-10 16:14:18');
INSERT INTO `w_portalpage` VALUES ('3', '联系我们', '<p>历史的肌肤可就是的离开房间SD卡房间里是卡的积分</p>\r\n\r\n<p>实力的开发就是可怜的肌肤</p>\r\n\r\n<p>是打飞机阿士大夫就离开</p>\r\n\r\n<p><img alt=\"\" src=\"http://www.enterprise.com/data/upload/201701/5af12f658d6328ae2e8c3c99a2ed9e96.jpg\" style=\"height:531px; width:800px\" /></p>\r\n\r\n<p>离开是大家看法是理科的肌肤是打发</p>\r\n\r\n<p>是，的卡夫卡时间的方式见对方奥斯卡的房间爱时刻的肌肤开始的减肥阿斯兰的科技弗拉斯柯达复健科就暗示了对方可就是开的房间来看就是了打开房间爱死了肯德基阿斯兰的开发就爱是可怜的叫法是可怜的金风科技是咖啡机 暗示了对方即可</p>\r\n\r\n<p>是的发生的健康</p>\r\n\r\n<p>是打发了深刻的肌肤开始的减肥</p>\r\n', '2017-01-10 16:14:21');

-- ----------------------------
-- Table structure for `w_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `w_sessions`;
CREATE TABLE `w_sessions` (
  `session_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_expires` int(10) unsigned NOT NULL DEFAULT '0',
  `session_data` text,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of w_sessions
-- ----------------------------
INSERT INTO `w_sessions` VALUES ('48ptlpsosbijetbpq3grndida1', '1483692513', '');
