<?php

//主循环的主函数

//todo 分拆evt  ，，splt evt, bettime adjst optmz

//cfg L306   开奖区块号
//L209   drawV3($blkNum)
//L72  get_current_noV3()
//  php C:\0prj\sscbot\cmd/../appSSC/main_ssc.php    calltp

//cmd prm  calltp
use app\model\LotteryLog;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use app\model\Setting;
use think\view\driver\Php;

use function libspc\log_err;


//   C:\phpstudy_pro\Extensions\php\php8.0.2nts\php.exe C:\modyfing\jbbot\think swoole2
global $BOT_TOKEN;

global $chat_id;
//$bot_token = "6426986117:AAFb3woph_1zOWFS5cO98XIFUPcj6GqvmXc";  //sscNohk
//$chat_id = -1001903259578;
global $lottery_no;   // ="glb no";
static $lottery_no = "...";
$lottery_no = "...";
$alltimeCycle = 120; //sec
$GLOBALS['alltimeCycle'] = 120;

//todo 可以合并到 zautoload 加载基础类库
require_once __DIR__ . "/../libBiz/zautoload.php";
require_once __DIR__ . "/../lib/tlgrmV2.php";
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/fenpan.php";


// 应用初始化导入tp类库
$console = (new \think\App())->console;
//$console->$catchExceptions=false;
$console->call("imptTP");



//_test9352156();
_main();

function _test9352156() {


  require __DIR__ . '/../vendor/autoload.php';
  $GLOBALS['qihao'] = 221634;
  require_once __DIR__ . "/../libBiz/zautoload.php";
  require_once __DIR__ . "/../appSSC/fenpan.php";

// 应用初始化
  $console = (new \think\App())->console;
//$console->$catchExceptions=false;
  $console->call("calltpx");

  readBetTypesCfg();
  $bettype_wefa = "前后三玩法豹子";

  $odds = getOddsFrmGlbdt($bettype_wefa);
  print_r($odds);
}




function _main() {
  $GLOBALS['mainlg']="mainlg";
  log_enterMethV2(__METHOD__,func_get_args(),$GLOBALS['mainlg']);

 // readBetTypesCfg744();

  \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
  global $lottery_no;
  $lottery_no = 111;
  // var_dump(  $lottery_no);die();
  global $bot_token;
  print_r($bot_token);
  print_r($GLOBALS['bot_token']);
  //var_dump(BOT_TOKEN);
  $set = Setting::find(1);
  $GLOBALS['BOT_TOKEN'] = $set->s_value;
  $GLOBALS['chat_id'] = Setting::find(2)->value;
  print_r($GLOBALS['BOT_TOKEN']);
  print_r($GLOBALS['chat_id']); //die();
  //  bot_sendMsg("----",BOT_TOKEN,chat_id);die();
  $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
  \think\facade\Log::info($lineNumStr);
  $bot_words = \app\model\BotWords::where('Id', 1)->find();
  global $lottery_no;
  // $lottery_no = 1133;
  echo "-------------------------开始投注----60s" . PHP_EOL;
  startBetEvt();
  // $GLOBALS['kaijtime']
  // touzhu ,60then  warning  ,30 then stop  ,,30then kaij
  list($alltimeCycle, $bet_time_sec_ramain_adjust) = getBettimeRemain();   // $bet_time:105000     105s   1分40s

  //todo 这里chekAgain 可以合并到getBettimeRemain
  sleep($bet_time_sec_ramain_adjust);

  //------------------------warning bet time
  fenpan_wanrning_event();

  $waring_time_sec_remain = getWarningBetTimeRemain();

  sleep($waring_time_sec_remain);

  //-----------------------------封盘时间 stop evet
  fenpan_stop_event();
  $delay_to_statrt_Kaijyo_sec = $stop_remain_time_sec = getStopRemaintime();
  // $delay_to_statrt_Kaijyo_sec=chkRemainTime($delay_to_statrt_Kaijyo_sec);
  sleep($delay_to_statrt_Kaijyo_sec);
  //---------------------开奖流程
  kaij_draw_evt();
  log_vardumpRetval(__METHOD__,"", $GLOBALS['mainlg']);
}

//function readBetTypesCfg() {
//  log_enterMethV2(__METHOD__,func_get_args(),$GLOBALS['mainlg']);
//
//  try {
//    $sql = "select * from bet_types ORDER BY RAND()  ";
//   logV3(__METHOD__,$sql,"mainlg");
//    $rows = \think\facade\Db::query($sql);
//    foreach ($rows as $r)
//    {
//
//    }
//    $GLOBALS['bet_types734'] = $rows;
//  } catch (Throwable $e) {
//    log_errV2($e,__METHOD__);
//  }
//
////  $rows_shuzi = \think\facade\Db::query("select * from setting where name='特码球数字玩法_单球配额' limit 1 ");
////  $GLOBALS['特码球数字玩法_单球配额']=$rows_shuzi[0]['value'];
////  $rows_dxds = \think\facade\Db::query("select * from setting where name='特码球大小单双玩法_单球配额' limit 1 ");
////  $GLOBALS['特码球大小单双玩法_单球配额']=$rows_dxds[0]['value'];
//
//
//}
//

function startBetEvt() {

 // $logf_flag = "mainlg";
  log_enterMethV2(__METHOD__,func_get_args(),$GLOBALS['mainlg']);
  //// 更新状态开放投注  must close here lst for open b cs secury
  $set = Setting::find(3);
  $set->value = 1;   //1 just close bet
  $set->save();
  logV3(__METHOD__,"updt Setting set 游戏状态=1","mainlg");
  \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
  //-------------------- start bet

  global $lottery_no;
  $ltr = new \app\common\LotteryHashSsc();
  $qiohao_data = $ltr->get_current_noV3();
  $lottery_no = $qiohao_data['lottery_no'];

  //$lottery_no="19005195";


  $kaijtime = $qiohao_data ['closetime'];
  //   touzhu time 90s,, fenpe30s
  $GLOBALS['kaijtime'] = $kaijtime;


  $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
  //   \think\facade\Log::info($lineNumStr);
  \think\facade\Log::info(" get_current_noV2: " . $lottery_no);


  $today = date("Y-m-d", time());
  //准确性保障 添加unqidx must。。。  ALTER TABLE `jbdb`.`lottery_log`   //ADD UNIQUE INDEX `no_unq`(`No`);
//  $log = \app\common\Logs::addLotteryLog($today, $lottery_no, $GLOBALS['kaijBlknum']);

  try {
    $jiangqiDt = array(

      'No' => $lottery_no,
      'Hash' => $GLOBALS['kaijBlknum'],
    );
    $log = LotteryLog::create($jiangqiDt);

  logV3(__METHOD__,"insert LotteryLog".json_encodex($jiangqiDt),$GLOBALS['mainlg']);
//   var_dump($log);
    $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
    //   \think\facade\Log::info($lineNumStr);
    \think\facade\Log::info("add new lotry qihao " . $lineNumStr);
    \think\facade\Log::info(json_encode($log));
  } catch (\Throwable $e) {

    log_errV3($e,$jiangqiDt,__METHOD__,null,"tt319.log",$GLOBALS['mainlg']);

  }


  //--------------------start bet
  $text = $lottery_no . "期 开始下注!\r\n";

  //----------add start info
  $bot_words = \app\model\BotWords::where('Id', 1)->find();
  $words = $bot_words->Start_Bet;
  $text = $text . $words;

//  $startinfo=file_get_contents(__DIR__."/../../db/startInfo.md");
////$text = \app\common\Helper::replace_markdown($text);
//  require_once __DIR__ . '/../../lib/markdown.php';
//
//  $text = $text . $startinfo;
  //end


  $elapsed = Setting::find(6)->value + Setting::find(7)->value;
  $stop_time = date("Y-m-d H:i:s", $kaijtime - 30);
  $text = $text . "\n\n封盘时间：$stop_time\n";
  $elapsed += Setting::find(8)->value;
  $draw_time = date("Y-m-d H:i:s", $kaijtime);
  $text = $text . "开奖时间：$draw_time\n";
  //$text = \app\common\Helper::replace_markdown($text);
  require_once __DIR__ . '/../lib/markdown.php';
  $text = \encodeMkdwn($text);
  //for safe hide kaijblk
  $kaijBlknum = $GLOBALS['kaijBlknum'];
  $text = $text . "开奖区块号 ：[$kaijBlknum](https://tronscan.org/#/block/$kaijBlknum)";
  echo $text . PHP_EOL;

  $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
  //   \think\facade\Log::info($lineNumStr);
  \think\facade\Log::info($lineNumStr);
  \think\facade\Log::info($text);
  //sendmessageBotNConsole($text);

  logV3(__METHOD__, $text, $GLOBALS['mainlg']);
  if (file_exists("c:/sendBotMsgDisable")) {
    logV3(__METHOD__, "\n\n", "mainCycle");
    logV3(__METHOD__, $text, "mainCycle");

  } else {
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $cfile = new \CURLFile(app()->getRootPath() . "public/static/start.jpg");
    $bot->sendPhoto($GLOBALS['chat_id'], $cfile, $text, null, null, null, false, "MarkdownV2");
    //    $bot->sendMessage(chatid,txt,parsemode,replyMsgID)

  }
  //// 更新状态开放投注
  $set = Setting::find(3);
  $set->value = 0;
  $set->save();
  logV3(__METHOD__, "updt Setting set 游戏状态=0", $GLOBALS['mainlg']);
  log_vardumpRetval(__METHOD__,"",$GLOBALS['mainlg']);
  // \think\facade\Db::close();
}


//Not suit for stop evet
function chkRemainTime_forBet(mixed $bet_time_sec_ramain_adjust) {
  if (time() - 15 > $GLOBALS['kaijtime'])
    return 0;
  else return $bet_time_sec_ramain_adjust;


}

function getStopRemaintime() {


  $bet_time = Setting::find(6)->value; //1*60*1000;
  $bet_time_sec = $bet_time / 1000;


  $waring_time = Setting::find(7)->value; //30*1000;
  $waring_time_sec = $waring_time / 1000;


  $all_bet_time = $bet_time_sec + $waring_time_sec;


  global $lottery_no;
  $stop_bet_time = Setting::find(8)->value; //10*1000;
  $stop_bet_time_sec = $stop_bet_time / 1000;    //  20s
  $delay_to_statrt_Kaijyo_sec = $stop_bet_time_sec;

  $nowCntTime = $all_bet_time + $stop_bet_time_sec;

  $allPasstime = time() - $GLOBALS['opentime'];

  $remainTime = $nowCntTime - $allPasstime;


  $remainTime_adjst = $remainTime > 0 ? $remainTime : 0;

  return $remainTime_adjst;


}

/**
 * @return array
 * @throws \think\db\exception\DataNotFoundException
 * @throws \think\db\exception\DbException
 * @throws \think\db\exception\ModelNotFoundException
 */
function getBettimeRemain(): array {
  $bet_time = Setting::find(6)->value; //1*60*1000;
  $bet_time_sec = $bet_time / 1000;

  global $alltimeCycle;
  $countdown_time_sec = $GLOBALS['kaijtime'] - time();// if countdown_time_sec120s,so the bettime60s
  //if countdown_time_sec 100s,so bettime 60-(120-countdown_time_sec)
  $passtime = ($alltimeCycle - $countdown_time_sec);
  $bet_time_sec_ramain = $bet_time_sec - $passtime;
  $bet_time_sec_ramain_adjust = $bet_time_sec_ramain > 0 ? $bet_time_sec_ramain : 0;

  $bet_time_sec_ramain_adjust = chkRemainTime_forBet($bet_time_sec_ramain_adjust);

  //  $bet_time_sec = 10;
  var_dump(' $bet_time_sec:' . $bet_time_sec_ramain_adjust);

  return array($alltimeCycle, $bet_time_sec_ramain_adjust);
}

function getWarningBetTimeRemain() {


  $bet_time = Setting::find(6)->value; //1*60*1000;
  $bet_time_sec = $bet_time / 1000;


  $waring_time = Setting::find(7)->value; //30*1000;
  $waring_time_sec = $waring_time / 1000;


  $all_bet_time = $bet_time_sec + $waring_time_sec;


  $countdown_time_sec = $GLOBALS['kaijtime'] - time();// if countdown_time_sec120s,so the bettime60s
  //if countdown_time_sec 100s,so bettime 60-(120-countdown_time_sec)
  $passtime = ($GLOBALS['alltimeCycle'] - $countdown_time_sec);

  $all_bet_time_remain = $all_bet_time - $passtime;


  $bet_time_sec_ramain_adjust = $all_bet_time_remain > 0 ? $all_bet_time_remain : 0;
  $waring_time_sec_remain = chkRemainTime_forBet($bet_time_sec_ramain_adjust);
  return $bet_time_sec_ramain_adjust;


}

//废弃fun  startBetEvtDep

function startBetEvtDep() {
  //// 更新状态开放投注  must close here lst for open b cs secury
//  $set = Setting::find(3);
//  $set->value = 0;
//  $set->save();
  \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
  //-------------------- start bet
  $cfile = new \CURLFile(app()->getRootPath() . "public/static/start.jpg");
  global $lottery_no;
  $ltr = new \app\common\LotteryHashSsc();
  $qiohao_data = $ltr->get_current_noV3();
  $lottery_no = $qiohao_data['lottery_no'];


  $kaijtime = $qiohao_data ['closetime'];
  //   touzhu time 90s,, fenpe30s
  $GLOBALS['kaijtime'] = $kaijtime;


  $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
  //   \think\facade\Log::info($lineNumStr);
  \think\facade\Log::info(" get_current_noV2: " . $lottery_no);


  $today = date("Y-m-d", time());
  $log = \app\common\Logs::addLotteryLog($today, $lottery_no, $GLOBALS['kaijBlknum']);


  var_dump($log);
  $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
  //   \think\facade\Log::info($lineNumStr);
  \think\facade\Log::info("add new lotry qihao " . $lineNumStr);
  \think\facade\Log::info(json_encode($log));

  //--------------------start bet
  $text = $lottery_no . "期 开始下注!\r\n";

  $bot_words = \app\model\BotWords::where('Id', 1)->find();
  $words = $bot_words->Start_Bet;
  $text = $text . $words;

  $elapsed = Setting::find(6)->value + Setting::find(7)->value;
  $stop_time = date("Y-m-d H:i:s", $kaijtime - 30);
  $text = $text . "\n\n封盘时间：$stop_time\n";
  $elapsed += Setting::find(8)->value;
  $draw_time = date("Y-m-d H:i:s", $kaijtime);
  $text = $text . "开奖时间：$draw_time\n";
  $text = \app\common\Helper::replace_markdown($text);
  //for safe hide kaijblk
  $text = $text . "开奖区块号 ：[" . $GLOBALS['kaijBlknum'] . "](https://etherscan.io/block/" . $GLOBALS['kaijBlknum'] . ")";
  echo $text . PHP_EOL;

  $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
  //   \think\facade\Log::info($lineNumStr);
  \think\facade\Log::info($lineNumStr);
  \think\facade\Log::info($text);
  //sendmessageBotNConsole($text);

  $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
  $bot->sendPhoto($GLOBALS['chat_id'], $cfile, $text, null, null, null, false, "MarkdownV2");
  //    $bot->sendMessage(chatid,txt,parsemode,replyMsgID)
  //// 更新状态开放投注
  $set = Setting::find(3);
  $set->value = 0;
  $set->save();
 // \think\facade\Db::close();
}

function fenpan_wanrning_event() {
  log_enterMethV2(__METHOD__,func_get_args(),$GLOBALS['mainlg']);

  $waring_time = Setting::find(7)->value; //30*1000;
  $waring_time_sec = $waring_time / 1000;


  \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
  $bot_words = \app\model\BotWords::where('Id', 1)->find();
  // $waring_time_sec = 5;
  // 1133期还有50秒停止下注
  global $lottery_no;
  $waring_str = "console:" . $lottery_no . "期还有" . $waring_time_sec . "秒停止下注\r\n";
  // sendmessage841($waring_str);
  var_dump(' $waring_time_sec:' . $waring_time_sec);  ///   $waring_time_sec:50
  $words = $bot_words->StopBet_Waring;
  $text = $words;

  echo $text . PHP_EOL;

  if (file_exists("c:/sendBotMsgDisable")) {
    logV3(__METHOD__, "\n\n", "mainCycle");

    logV3(__METHOD__, $text, "mainCycle");

  } else {
    bot_sendMsgTxtMode($text, $GLOBALS['BOT_TOKEN'], $GLOBALS['chat_id']);
    //  $bot->sendmessage($chat_id, $text);
  }
  log_vardumpRetval(__METHOD__,"",$GLOBALS['mainlg']);

}

// 开奖过程
//require  __DIR__ . "/../../lib/iniAutoload.php";
function kaij_draw_evt() {
  log_enterMethV2(__METHOD__,func_get_args(),$GLOBALS['mainlg']);
  $draw_str = "console:" . $GLOBALS['qihao'] . "期开奖中..console";
  //  sendmessage841($draw_str);
  \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
  require_once __DIR__ . "/../app/common/lotrySscV2.php";

  global $lottery_no;
  //--------------get kaijnum  show kaij str

  try {
    $ltr = new \app\common\LotteryHashSsc();
    $blkHash = $ltr->drawV3($GLOBALS['kaijBlknum']);
    var_dump($blkHash);
    $text = "第" . $lottery_no . "期开奖结果" . "\r\n";
    $kaij_num = getKaijNumFromBlkhash($blkHash);
    $text = $text . betstrX__convert_kaij_echo_ex($kaij_num);// ();
    $text = $text . PHP_EOL . "本期区块号码:" . $GLOBALS['kaijBlknum'] . "\r\n"
      . "本期哈希值:\r\n" . $blkHash . "\r\n";
    //  sendmessage841($text);
    //  $text .= $this->result . "\r\n";

    print_r($text);
    if (file_exists("c:/sendBotMsgDisable")) {
      logV3(__METHOD__, "\n\n", "mainCycle");

      logV3(__METHOD__, $text, "mainCycle");

    } else {

      //add open btn
      $buttonTxt = file_get_contents(__DIR__ . "/../db/button.json");
      $buttonTxt = str_replace("\$kaijBlknum", $GLOBALS['kaijBlknum'], $buttonTxt);
      $keyboard_array = json_decode($buttonTxt);
      $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup($keyboard_array);


      sendMsgEx706($GLOBALS['chat_id'], $text, $keyboard);
    }
  } catch (\Throwable $e) {
    log_err($e, __METHOD__);
  }


  $gmLgcSSc = new   \app\common\GameLogicSsc();  //comm/gamelogc
  // $gl->lottery_no = $lottery_no;

  //--------------------show kaj rzt
  //=====本期中奖名单======
  try {
    $data['hash_no'] = $lottery_no;
    $data['lottery_no'] = $lottery_no;
    $gmLgcSSc->lottery->setData($data);
    $gmLgcSSc->hash_no = $lottery_no;
    $gmLgcSSc->lottery_no = $lottery_no;


    $echoTxt = $gmLgcSSc->DrawLotteryV2($blkHash);    // if finish chg stat to next..
    // print_r($echoTxt);
    if (file_exists("c:/sendBotMsgDisable")) {
      logV3(__METHOD__, "\n\n", "mainCycle");

      logV3(__METHOD__, $echoTxt, "mainCycle");

    } else {
      bot_sendMsgTxtModeEx($echoTxt, $GLOBALS['BOT_TOKEN'], $GLOBALS['chat_id']);
    }
  } catch (\Throwable $e) {
    log_err($e, __METHOD__);
  }

//------------------ gene pic rzt
  if (file_exists("c:/sendBotMsgDisable")) {
    logV3(__METHOD__, "\n\n", "mainCycle");

    logV3(__METHOD__, "SendPicRzt....", "mainCycle");

  } else {
    SendPicRzt($gmLgcSSc);
  }

 // \think\facade\Db::close();
  $show_str = "console:" . $lottery_no . "期开奖完毕==开始下注 \r\n";
  //  sendmessage841($show_str);
  // $gl->DrawLottery();
  log_vardumpRetval(__METHOD__,"",$GLOBALS['mainlg']);

}
//todo move to tlgrm lib
/**
 * @param GameLogicSsc $gmLgcSSc
 * @return void
 * @throws \TelegramBot\Api\Exception
 * @throws \TelegramBot\Api\InvalidArgumentException
 */
function SendPicRzt(  $gmLgcSSc): void {
  log_enterMethV2(__METHOD__,func_get_args(),$GLOBALS['mainlg']);
  try {
    $gmLgcSSc->SendTrendImage(20); // 生成图片
    $cfile = new \CURLFile(app()->getRootPath() . "public/trend.jpg");
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendPhoto($GLOBALS['chat_id'], $cfile);
  } catch (\Throwable $e) {
    log_err($e, __METHOD__);
  }

}

//todo move to tlgrm lib
function sendMsgEx(mixed $chat_id, string $text, $rplyMkp = null) {
  log_enterMethV2(__METHOD__,func_get_args(),$GLOBALS['mainlg']);

  try {
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendmessage($GLOBALS['chat_id'], $text, null, false, null, null, $rplyMkp);
  } catch (\Throwable $e) {
    try {
      $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
      $bot->sendmessage($GLOBALS['chat_id'], $text);
    } catch (\Throwable $e) {
      try {
        $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
        $bot->sendmessage($GLOBALS['chat_id'], $text);
      } catch (\Throwable $e) {
        log_err($e, __METHOD__);
      }
    }

  }

}
//todo move to tlgrm lib

function sendMsgEx706(mixed $chat_id, string $text, $rplyMkp = null) {
  log_enterMethV2(__METHOD__,func_get_args(),$GLOBALS['mainlg']);
  try {
    require_once __DIR__ . "/../lib/logx.php";
    log_enterMethV2(__METHOD__, func_get_args(), "sendMsgEx706");
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendmessage($chat_id, $text, null, false, null, null, $rplyMkp);
  } catch (\Throwable $e) {
    try {
      log_err($e, __METHOD__);
      $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
      $bot->sendmessage($GLOBALS['chat_id'], $text);
    } catch (\Throwable $e) {
      try {
        $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
        $bot->sendmessage($GLOBALS['chat_id'], $text);
      } catch (\Throwable $e) {
        log_err($e, __METHOD__);
      }
    }

  }

}


if (!function_exists("main_process")) {
}
