<?php

namespace app\commonLhc;

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



class CmdLhc extends Command {
  protected function configure() {
    // 指令配置   php C:\modyfing\jbbot\think    swoole2  sscx
    $this->setName('cmd2')
      ->addArgument('cfgOpt', Argument::OPTIONAL, "cfgOpt name")
      ->setDescription('the cmd2 command');
  }


  protected function execute(Input $input, Output $output) {
    require_once __DIR__ . "/../../lib/iniAutoload.php";
//        require_once __DIR__ . "/../../lib/log23.php";
//        require_once __DIR__ . "/../../lib/logx.php";
    if ($input->getArgument('cfgOpt')) {
      $cfgOpt = trim($input->getArgument('cfgOpt'));
      $cfgOpt = urldecode($cfgOpt);
      \log23::zdbg11(__METHOD__, "cmdopt", $cfgOpt);
      $GLOBALS['cfgOpt'] = $cfgOpt;
      //  \think\facade\Log::dbg11("cfgopt=》".$cfgOpt);
    }


    \think\facade\Log::info('这是一个自定义日志类型');
    //   die();
    // 指令输出
    $output->writeln('cmd2');
   // while (true) {
      try {
        \think\facade\Log::noticexx('这是一个自定义日志类型');

        // echo   iconv("gbk","utf-8","php中文待转字符");//把中文gbk编码转为utf8
        main_processLhc();
      } catch (\Throwable $exception) {
        $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
        //   \think\facade\Log::info($lineNumStr);
        \think\facade\Log::error("----------------errrrr2---------------------------");
        \think\facade\Log::error("file_linenum:" . $exception->getFile() . ":" . $exception->getLine());
        \think\facade\Log::error("errmsg:" . $exception->getMessage());
        \think\facade\Log::error("errtraceStr:" . $exception->getTraceAsString());
        var_dump($exception);

        // throw $exception; // for test
      }
      usleep(50 * 1000);
    //  break;
   // }
  }
}


if (!class_exists("mainx")) {


}

global $lottery_no;   // ="glb no";
static $lottery_no = "...";
$lottery_no = "...";
$alltimeCycle = 120; //sec
$GLOBALS['alltimeCycle'] = 120;


function main_processLhc() {
  \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
  global $lottery_no;
  $lottery_no = 111;
  // var_dump(  $lottery_no);die();
  global $bot_token;
  var_dump($bot_token);
  var_dump($GLOBALS['bot_token']);
  //var_dump(BOT_TOKEN);
  $set = Setting::find(1);
  $GLOBALS['BOT_TOKEN'] = $set->s_value;
  $GLOBALS['chat_id'] = Setting::find(2)->value;

  //todo to head
  $GLOBALS['BOT_TOKEN']="6959066432:AAH9OgIspApiYStnaNyznl7mcJ_qPjBA7Fg";
  $GLOBALS['chat_id']=-4038077884;

  var_dump($GLOBALS['BOT_TOKEN']);
  var_dump($GLOBALS['chat_id']); //die();
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


function startBetEvt() {
  //// 更新状态开放投注  must close here lst for open b cs secury
  $set = Setting::find(3);
  $set->value = 1;   //1 just close bet
  $set->save();
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
  $log = LotteryLog::create(array(

    'No' => $lottery_no,
    'Hash' => $GLOBALS['kaijBlknum'],
  ));


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
  $cfile = new \CURLFile(app()->getRootPath() . "public/static/start.jpg");
  $bot->sendPhoto($GLOBALS['chat_id'], $cfile, $text, null, null, null, false, "MarkdownV2");
  //    $bot->sendMessage(chatid,txt,parsemode,replyMsgID)
  //// 更新状态开放投注
  $set = Setting::find(3);
  $set->value = 0;
  $set->save();
  \think\facade\Db::close();
}

function fenpan_wanrning_event() {

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
  bot_sendMsgTxtMode($text, $GLOBALS['BOT_TOKEN'], $GLOBALS['chat_id']);
  //  $bot->sendmessage($chat_id, $text);
}


function fenpan_stop_event() {
  dsl__execSql_tp(function () {
    $set = Setting::find(3);
    $set->value = 1;
    $set->save();
  });


  global $lottery_no;

  $stop_bet_time = Setting::find(8)->value; //10*1000;
  $stop_bet_time_sec = $stop_bet_time / 1000;    //  20s
  //  $stop_bet_time_sec = 3;
  // 1133期停止下注==20秒后开奖
  $stop_bet_str = "console:" . $lottery_no . "期停止下注==" . $stop_bet_time / 1000 . "秒后开奖\n";
  // sendmessage841($stop_bet_str);
  var_dump(' $stop_bet_time_sec:' . $stop_bet_time_sec);


  //-----------------停止下注提示
  try {
    \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
    $bot_words = \app\model\BotWords::where('Id', 1)->find();
    $words = $bot_words->StopBet_Notice;
    $text = $words;
    echo $text . PHP_EOL;
    sendmessageBotNConsole($text);
  } catch (\Throwable $e) {
  }

  global $lottery_no;
  try {
    $records = \app\common\Logs::getBetRecordByLotteryNoGrpbyU($lottery_no);
    $text = "--------本期下注玩家---------" . "\r\n";
    \think\facade\Log::info($text);
    $sum = 0;
    foreach ($records as $k => $v) {

      try {
        // array_push($bet_lst_echo_arr,  \echox\getBetContxEcHo($value['text']));

        $echo = betstrx__format_echo_ex($v['betNoAmt'] . "99");
        $bet = explode(" ", $echo);
        $money = $v['Bet'] / 100;
        $betNmoney = $bet[0] . " " . +$money;
        //  \betstr\format_echo_ex();
        $text = $text . $v['UserName'] . "【" . $v['UserId'] . "】" . $betNmoney . "\r\n";
        $sum += $v['Bet'];
      } catch (\Throwable $e) {
      }


    }
    echo $text . PHP_EOL;
    $msg = $text;

    \think\facade\Log::info($msg);
    //  $msg = str_replace("-", "\-", $text);  //  tlgrm txt encode prblm  BCS is markdown mode
    sendMsgEx($GLOBALS['chat_id'], $msg);
  } catch (\Throwable $e) {
  }

  // bot_sendMsg($msg, $GLOBALS['BOT_TOKEN'], $GLOBALS['chat_id']);
  // sendmessageBotNConsole($text);

  //---------------------------------点击官方开奖-----------

  try {
    $text = "第" . $lottery_no . "期 [点击官方开奖](https://etherscan.io/block/" . $GLOBALS['kaijBlknum'] . ")";
    // sendmessageBotNConsole($text);

    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendmessage($GLOBALS['chat_id'], $text, "MarkdownV2", true);
    // public function StopBet()

  } catch (\Throwable $e) {

  }

  $set = Setting::find(3);
  $set->value = 1;
  $set->save();
  \think\facade\Db::close();
}

//require  __DIR__ . "/../../lib/iniAutoload.php";
function kaij_draw_evt() {
  $draw_str = "console:" . $GLOBALS['qihao'] . "期开奖中..console";
  //  sendmessage841($draw_str);
  \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
  require_once __DIR__ . "/lotrySscV2.php";

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


    sendMsgEx($GLOBALS['chat_id'], $text);
  } catch (\Throwable $e) {
  }


  $gmLgcSSc = new   \app\common\GameLogicSsc();  //comm/gamelogc
  // $gl->lottery_no = $lottery_no;

  //--------------------show kaj rzt
  try {
    $data['hash_no'] = $lottery_no;
    $data['lottery_no'] = $lottery_no;
    $gmLgcSSc->lottery->setData($data);
    $gmLgcSSc->hash_no = $lottery_no;
    $gmLgcSSc->lottery_no = $lottery_no;


    $echoTxt = $gmLgcSSc->DrawLotteryV2($blkHash);    // if finish chg stat to next..
    bot_sendMsgTxtModeEx($echoTxt, $GLOBALS['BOT_TOKEN'], $GLOBALS['chat_id']);

  } catch (\Throwable $e) {
    log_err($e,__METHOD__);
  }

//------------------ gene pic rzt
  SendPicRzt($gmLgcSSc);

  \think\facade\Db::close();
  $show_str = "console:" . $lottery_no . "期开奖完毕==开始下注 \r\n";
  //  sendmessage841($show_str);
  // $gl->DrawLottery();
}

/**
 * @param GameLogicSsc $gmLgcSSc
 * @return void
 * @throws \TelegramBot\Api\Exception
 * @throws \TelegramBot\Api\InvalidArgumentException
 */
function SendPicRzt(GameLogicSsc $gmLgcSSc): void {
  try {
    $gmLgcSSc->SendTrendImage(20); // 生成图片
    $cfile = new \CURLFile(app()->getRootPath() . "public/trend.jpg");
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendPhoto($GLOBALS['chat_id'], $cfile);
  } catch (\Throwable $e) {

  }

}

function sendMsgEx(mixed $chat_id, string $text) {
  try {
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendmessage($GLOBALS['chat_id'], $text);
  } catch (\Throwable $e) {
    try {
      $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
      $bot->sendmessage($GLOBALS['chat_id'], $text);
    } catch (\Throwable $e) {
      try {
        $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
        $bot->sendmessage($GLOBALS['chat_id'], $text);
      }   catch (\Throwable $e) {
        log_err($e ,__METHOD__);
      }
  }

  }

}


if (!function_exists("main_process")) {
}
