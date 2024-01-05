/*
 Navicat Premium Data Transfer

 Source Server         : locx
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : jbdb

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 23/08/2023 14:51:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bot_words
-- ----------------------------
DROP TABLE IF EXISTS `bot_words`;
CREATE TABLE `bot_words`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识符',
  `Withdraw_Failed` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '下分审核失败',
  `Withdraw_Success` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '下分审核通过',
  `Withdraw_Finish` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '下分申请成功',
  `StopBet_Waring` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '封盘警告提示',
  `Recharge_Tips` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '上分公告',
  `Recharge_Success` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '上分审核通过',
  `Recharge_Failed` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '上分审核拒绝',
  `Recharge_Finish` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '上分申请成功',
  `StopBet_Notice` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '封盘公告',
  `Button_Text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '通用按键配置文本',
  `Bet_Failed` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '下注余额不足',
  `Start_Bet` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '开始下注提示',
  `Recharge_Error` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '上分余额不足',
  `Update_Date` timestamp NULL DEFAULT NULL COMMENT '修改日期',
  PRIMARY KEY (`Id`) USING BTREE,
  INDEX `Id`(`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bot_words
-- ----------------------------
INSERT INTO `bot_words` VALUES (1, '【id】【换行】用户名：【用户】【换行】您的下分申请被拒绝，详情请联系：@wpcw88', 'ID  【id】【换行】用户名：【用户】【换行】金额：【金额】【换行】 恭喜老板下分成功，请注意查收！', 'ID 【id】【换行】 用户名： 【用户】【换行】您的下分申请提交成功， 老板，您的下分申请已收到，期间请勿重复提交！', '>>>>>>> 提醒 <<<<<<<\n封盘剩余30秒！\n千3流水自由返水 群里输入返水两字即可返当前流水 ！！！\n全宇宙最火爆pc群，秒杀一切担保，千万美金下分无忧 无任何理由借口不下分 欢迎?各路大神来爆庄!\n\n本群不接水军 禁止水军一律卡分!', '上分唯一汇旺：`99618`（名称：金贝PC网盘）    唯一上分地址TRC：   `TUFP31Co6ppUjLPksTF7hmkstUE2jHx6LZ`   （点击地址自动复制）  唯一客服号 @wpkf66  唯一财务号 @wpcw88', 'ID： 【id】【换行】用户名：【用户】【换行】金额：【金额】【换行】您当前余额：【余额】【换行】恭喜老板上分成功！', '【id】【换行】用户名：【用户】【换行】您的上分申请被拒绝，查询不到充值记录！', 'ID 【id】【换行】用户名：【用户】【换行】您上分申请提交成功   请勿重复\r\n审核通过后会第一时间上分！', '⛔️下注结束，全体禁言停止下注！\n⚠️下注结束出现编辑 分数清0！\n⚠️多次下注等于叠加下注/加注！\n⚠️一切以机器人与系统录入为准，无争议！\n—— —— —— —— —— —— —— ——\n‼️主动私聊的都是骗子‼️\n‼️认准官方管理账号ID‼️\n‼️切勿相信私发的信息‼️\n—— —— —— —— —— —— —— ——', '[[{\"text\": \"查看余额\",\"callback_data\": \"query_balance\"},{\"text\": \"最近投注\",\"callback_data\": \"query_records\"}],[{\"text\": \"查看流水\",\"callback_data\": \"query_rebates\"},{\"text\": \"联系财务\",\"url\": \"https://t.me/wpcw88\"}],[{\"text\": \"?金貝集团·博彩官方频道?\",\"url\": \"https://t.me/jbpc28\"}]]', '你的余额不足', '——————————————————\r\n开始下注\r\na/b/金额\r\naa/bb/金额', '上分余额不足', '2023-04-08 19:12:16');

SET FOREIGN_KEY_CHECKS = 1;
