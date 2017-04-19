/*
Navicat MySQL Data Transfer

Source Server         : bbs
Source Server Version : 50709
Source Host           : 192.168.175.16:3306
Source Database       : bbs

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2017-04-15 14:00:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ad
-- ----------------------------
DROP TABLE IF EXISTS `ad`;
CREATE TABLE `ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `adname` varchar(255) NOT NULL COMMENT '广告名称',
  `adpic` varchar(255) NOT NULL DEFAULT '/upload/ad/default.jpeg' COMMENT '广告图片',
  `adlink` varchar(255) NOT NULL COMMENT '广告跳转',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ad
-- ----------------------------
INSERT INTO `ad` VALUES ('1', '京东', '/uploads/ad/0652f4c4047e83741760b7a5ec2b7d65.jpg', 'www.jd.com');
INSERT INTO `ad` VALUES ('2', '天猫', '/uploads/ad/a2252adac6cc30cdd31ee3af619c8764.jpg', 'www.tmall.com');

-- ----------------------------
-- Table structure for cang
-- ----------------------------
DROP TABLE IF EXISTS `cang`;
CREATE TABLE `cang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '收藏用户的uid',
  `pid` char(11) NOT NULL COMMENT '当前id收藏过的帖子',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cang
-- ----------------------------
INSERT INTO `cang` VALUES ('10', '4', '1');
INSERT INTO `cang` VALUES ('22', '4', '16');
INSERT INTO `cang` VALUES ('18', '1', '15');
INSERT INTO `cang` VALUES ('17', '1', '12');
INSERT INTO `cang` VALUES ('11', '4', '10');
INSERT INTO `cang` VALUES ('19', '2', '16');
INSERT INTO `cang` VALUES ('20', '3', '16');
INSERT INTO `cang` VALUES ('21', '6', '16');

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '网站配置',
  `configtitle` varchar(255) NOT NULL COMMENT '网站标题',
  `open` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '是否维护',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', '论坛', 'n');

-- ----------------------------
-- Table structure for friendlink
-- ----------------------------
DROP TABLE IF EXISTS `friendlink`;
CREATE TABLE `friendlink` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '友情链接id',
  `fname` varchar(255) NOT NULL COMMENT '链接名',
  `flink` varchar(255) NOT NULL COMMENT '链接地址',
  `open` enum('n','y') NOT NULL DEFAULT 'y' COMMENT '是否开启显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friendlink
-- ----------------------------
INSERT INTO `friendlink` VALUES ('1', '百度', 'www.baidu.com', 'y');
INSERT INTO `friendlink` VALUES ('2', 'it兄弟连', 'www.lampbrother.net', 'y');

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '帖子id',
  `tid` int(11) unsigned NOT NULL COMMENT '板块id',
  `uid` int(11) unsigned NOT NULL COMMENT '发帖人id',
  `ptitle` varchar(255) NOT NULL COMMENT '帖子标题',
  `pcontent` longtext NOT NULL COMMENT '帖子内容',
  `pctime` int(255) NOT NULL DEFAULT '0' COMMENT '发帖时间',
  `click` int(255) NOT NULL DEFAULT '0' COMMENT '点击数',
  `elite` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '是否精华',
  `top` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '是否置顶',
  `recycle` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '是否回收站',
  `creply` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否可回复',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post
-- ----------------------------
INSERT INTO `post` VALUES ('1', '1', '4', '本栏须知：', '<p>我就嘿嘿嘿嘿嘿嘿嘿嘿嘿</p>', '1490173072', '40', 'n', 'y', 'n', '0');
INSERT INTO `post` VALUES ('2', '3', '3', '入吧前须知', '<p><span style=\"text-decoration: underline; border: 1px solid rgb(0, 0, 0);\"><em><strong>哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈</strong></em></span></p>', '1490173088', '17', 'y', 'y', 'n', '0');
INSERT INTO `post` VALUES ('3', '15', '2', '初识日本', '<div class=\"para\" style=\"font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 28px; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">日本', '1490173099', '8', 'y', 'y', 'y', '0');
INSERT INTO `post` VALUES ('4', '4', '5', '请填写标题', '<p><img src=\"http://img.baidu.com/hi/jx2/j_0002.gif\"/></p>', '1490173158', '8', 'n', 'n', 'n', '0');
INSERT INTO `post` VALUES ('5', '10', '5', '请填写标题', '<p><img src=\"http://img.baidu.com/hi/jx2/j_0005.gif\"/></p>', '1490173214', '1', 'n', 'n', 'n', '0');
INSERT INTO `post` VALUES ('6', '16', '5', '请填写标题', '<p><img src=\"http://img.baidu.com/hi/jx2/j_0013.gif\"/></p>', '1492174212', '3', 'n', 'n', 'n', '0');
INSERT INTO `post` VALUES ('7', '15', '2', '版规', '<p style=\"white-space: normal;\">本版块禁止膜蛤,开车,求资源等.只用于喜欢日本文化的朋友互相交流!!</p><p style=\"white-space: normal;\">(另,有需要可私聊管理员,1Tb硬盘饥渴难耐)</p><p><br/></p>', '1492174215', '11', 'y', 'y', 'n', '0');
INSERT INTO `post` VALUES ('8', '15', '2', '初识日本', '<div class=\"para\" style=\"font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 28px; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">日本', '1492174301', '4', 'n', 'n', 'y', '0');
INSERT INTO `post` VALUES ('9', '1', '6', '测试发帖', '<p>123</p>', '1490322084', '9', 'n', 'n', 'y', '0');
INSERT INTO `post` VALUES ('10', '1', '4', '测试收藏', '测试收藏<p><br/></p>', '1490326451', '9', 'n', 'n', 'n', '0');
INSERT INTO `post` VALUES ('11', '1', '1', '测试发帖', '<p>测试发帖<br/></p>', '1490326605', '2', 'n', 'n', 'n', '0');
INSERT INTO `post` VALUES ('12', '3', '1', '测试收藏', '测试收藏<p><br/></p>', '1490326654', '3', 'n', 'n', 'n', '0');
INSERT INTO `post` VALUES ('15', '14', '1', '7年不换车的人，是因为穷吗? 大神们帮忙分析。', '<p>网上流传一句话：7、8年都不换车，只有一个原因---穷。 是不是也要分情况来分析呢? <br/>　　我有个朋友，就是这个情况，大神们帮忙分析一下：<br/>　　三线城市，男，37岁，一辆国产车，大概是11万左右买的，自住房产一套，车开了七年了。家有双胞胎男孩。他和别人合伙开了个公司，主营电子产品、安防系统安装、网络安装等，公司是财府采购指定单位，还有其他一点副业偶尔赚点小钱。为人热情爽快，在生活的一些小开销方面，比较注重节省，经常参与一些打折抢红包的活动、团购活动，买东西也是要经过长时间选择 和比较才下手，即使是小商品也是这样。 穿着上比较体面讲究，倒不象抠门和拮据的人，也就是普通中产阶层的那些服装品牌吧，不是高端品牌。 他周围的朋友，许多换车很频繁，许多开豪车的，每次问他怎么还不换车，他就笑笑啥也不说，<br/><br/>　　这个人算是朋友里有点奇怪的人了，所以，有些好奇，<br/><br/>　　有阅历的朋友们，帮忙分析一下? 权当分析人性，再顺便学点东西吧。</p>', '1490328085', '2', 'n', 'n', 'n', '0');
INSERT INTO `post` VALUES ('16', '11', '1', '以后再也不用担心在办公室会饿了', '<p><span style=\"color: rgb(0, 0, 0); font-family: 宋体; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 28px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(238, 238, 238);\">因为我已经买了两大袋南方黑芝麻糊放在这里！！早上可以吃，中午可以吃，下午可以吃，加班还可以吃~总之，再也不用担心工作的时候肚子饿啦</span></p>', '1490328207', '16', 'y', 'y', 'n', '0');

-- ----------------------------
-- Table structure for reply
-- ----------------------------
DROP TABLE IF EXISTS `reply`;
CREATE TABLE `reply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '回复id',
  `pid` int(11) unsigned NOT NULL COMMENT '帖子id',
  `uid` int(11) unsigned NOT NULL COMMENT '回帖人id',
  `rcontent` varchar(255) NOT NULL COMMENT '回帖内容',
  `rctime` int(11) NOT NULL COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reply
-- ----------------------------
INSERT INTO `reply` VALUES ('1', '3', '4', '本宝宝第一个不服', '1492174213');
INSERT INTO `reply` VALUES ('2', '7', '4', '本宝宝要打死你！', '1492174310');
INSERT INTO `reply` VALUES ('3', '7', '3', '稳', '1492174321');
INSERT INTO `reply` VALUES ('4', '1', '4', '求关注！', '1492174378');
INSERT INTO `reply` VALUES ('5', '1', '3', '手动滑稽', '1492174382');
INSERT INTO `reply` VALUES ('6', '15', '1', '买不起咯', '1490328101');
INSERT INTO `reply` VALUES ('7', '16', '2', '两大袋南方黑芝麻糊？是多少小袋？按照你这个吃法，早上也吃中午也吃晚上还吃……我估计吃不了两周吧哈哈哈哈', '1490328262');
INSERT INTO `reply` VALUES ('8', '16', '3', '呀，我怎么就没想到买南方黑芝麻糊呢，南方黑芝麻糊每次吃一袋儿就行了。我每次都是买了大堆的零食备在办公室，结果不到一周就吃完了。', '1490328304');
INSERT INTO `reply` VALUES ('9', '16', '4', '嗯嗯，我也是买了南方黑芝麻糊备在办公室的，吃起来不仅方便，还特别抵饿呢。不过我每次都是买的小包装，吃完再买，因为南方黑芝麻糊的口味有好多，而且都很好吃~', '1490328347');
INSERT INTO `reply` VALUES ('10', '16', '5', '感觉太甜怎么办', '1490328383');
INSERT INTO `reply` VALUES ('11', '16', '6', '我觉得水果麦片泡牛奶更能填饱肚子', '1490328418');

-- ----------------------------
-- Table structure for type
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '板块id',
  `tname` varchar(255) NOT NULL COMMENT '板块名',
  `tlogo` varchar(255) NOT NULL COMMENT '板块LOGO',
  `tcontent` varchar(255) NOT NULL COMMENT '板块介绍',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type
-- ----------------------------
INSERT INTO `type` VALUES ('1', '电玩部落', '/uploads/logo/45c5569a827821c0eb56326928f31a0c.jpg', '汇集了各类电玩游戏资讯和内容(索尼大法好！)');
INSERT INTO `type` VALUES ('15', '日本の文化', '/uploads/logo/7c89d58a613a7508c01626b14aece5e3.png', '喜欢日本文化的小朋友来看看啦~~');
INSERT INTO `type` VALUES ('3', '康健', '/uploads/logo/fb2b6513d4a6b2192a44185db3ef8a18.jpg', '康健');
INSERT INTO `type` VALUES ('4', '闫润芝', '/uploads/logo/3f71237772dc85cb6874ff792486adf1.jpg', '闫润芝');
INSERT INTO `type` VALUES ('14', '汽车时代', '/uploads/logo/42e7d06e895213b247dc4b6c6cb68d19.jpg', '汇聚全国各地车友及汽车爱好者，分享汽车热点话题、购车养车经验、售后维权投诉等海量信息，举办各类线上线下活动');
INSERT INTO `type` VALUES ('7', '外星文明', '/uploads/logo/c29fefaa37fad707c08c2f6f558c98ec.png', '畅所欲言~');
INSERT INTO `type` VALUES ('9', '汤健', '/uploads/logo/38e6782b0701ca591b35fed2eb9881d4.png', '汤健1');
INSERT INTO `type` VALUES ('10', 'yrz', '/uploads/logo/640d9024fabf99a0e4706c8cc7d106de.jpg', 'yrz');
INSERT INTO `type` VALUES ('11', '食在当下', '/uploads/logo/96273857cf2dfccac8bf57e74e43e6be.png', '欢迎来到 食在天下 版块，热爱美食，热爱原产原味原生活。');
INSERT INTO `type` VALUES ('12', '生财之道', '/uploads/logo/3279b6b5dde83d0aef993493810b4b21.png', '不喜欢钱?');
INSERT INTO `type` VALUES ('13', '康', '/uploads/logo/066f14b13375e9897dc7d79141dc2977.jpg', '康');
INSERT INTO `type` VALUES ('16', 'yrzzzzzzzzz', '/uploads/logo/17f4a81313478fd3dd7b62eaa5d5696c.jpg', 'zzzzzzzz');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `auth` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '是否登录后台',
  `moderator` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '是否为版主',
  `status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '是否禁言',
  `lastlogin` int(255) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `shenqing` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '申请成为管理员状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'root', '123', 'y', 'n', '0', '1490326482', 'n');
INSERT INTO `user` VALUES ('2', 'wei', 'weiwei', 'y', 'n', '0', '1490328239', 'n');
INSERT INTO `user` VALUES ('3', 'kangjian', 'kangjian123', 'y', 'n', '0', '1490328290', 'n');
INSERT INTO `user` VALUES ('4', '763237005', 'tangjian', 'y', 'n', '0', '1490328451', 'n');
INSERT INTO `user` VALUES ('5', 'yrz_god', '15733773368', 'n', 'y', '0', '1490328365', 'n');
INSERT INTO `user` VALUES ('6', 'test', 'test123', 'n', 'n', '0', '1490328404', 'n');

-- ----------------------------
-- Table structure for userdetail
-- ----------------------------
DROP TABLE IF EXISTS `userdetail`;
CREATE TABLE `userdetail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `nickname` varchar(255) NOT NULL COMMENT '用户昵称',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `sex` enum('w','m') NOT NULL DEFAULT 'm' COMMENT '用户性别',
  `qq` int(10) DEFAULT NULL COMMENT 'QQ',
  `photo` char(255) NOT NULL DEFAULT '/uploads/user/default.jpg' COMMENT '头像',
  `content` varchar(255) NOT NULL COMMENT '自我介绍',
  `integral` int(255) NOT NULL COMMENT '积分',
  `vip` enum('y','n') NOT NULL DEFAULT 'n' COMMENT '是否会员',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userdetail
-- ----------------------------
INSERT INTO `userdetail` VALUES ('1', '1', '超级管理员', '1@qq.com', 'm', '123', '/uploads/user/default.jpg', '管理员不需要解释', '10064', 'y');
INSERT INTO `userdetail` VALUES ('2', '2', '小祖宗', 'eternal9421@126.com', 'm', '449196033', '/uploads/user/a3a3c2bd726fd085173e6fa58f02a631.jpg', '您的小祖宗已上线', '75', 'n');
INSERT INTO `userdetail` VALUES ('3', '3', 'sunny', '1142971329@qq.com', 'm', '1142971329', '/uploads/user/26f7233d7e95be16fd12edb93b8d3443.png', '~~~', '65', 'n');
INSERT INTO `userdetail` VALUES ('4', '4', '小萦绕', '763237005@qq.com', 'm', '763237005', '/uploads/user/28c2273be423826d4d7b732181097fe7.jpg', '我是闫大猹的大表哥！', '100', 'y');
INSERT INTO `userdetail` VALUES ('5', '5', '叫我队长', '15733773368@sina.cn', 'm', '1179931208', '/uploads/user/b41c00982a541cfe33fb4a5a2442bbfb.png', '', '75', 'n');
INSERT INTO `userdetail` VALUES ('6', '6', '', '123@qq.com', 'm', null, '/uploads/user/default.jpg', '', '35', 'n');
