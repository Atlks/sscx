<?php


use app\model\LotteryLog;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use app\model\Setting;
use think\view\driver\Php;
use app\common\Logs;
use function libspc\log_err;
require_once __DIR__ . "/../libBiz/zautoload.php";
// _test734825();

function _test734825() {
  echo "_test734825";
  require __DIR__ . '/../vendor/autoload.php';
  $GLOBALS['qihao']=18028335;
  require_once __DIR__ . "/../libBiz/zautoload.php";

  require_once __DIR__ . "/fenpan.php";

// 应用初始化
  $console = (new \think\App())->console;
//$console->$catchExceptions=false;
  $console->call("calltpx");


  fenpan_benqiBetPlyr();
}


function fenpan_stop_event() {
  log_enterMethV2(__METHOD__,func_get_args(),$GLOBALS['mainlg']);
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

    if(file_exists("c:/sendBotMsgDisable"))
    {
      logV3(__METHOD__,"\n\n","mainCycle");

      logV3(__METHOD__,$text,"mainCycle");

    }else {
      sendmessageBotNConsole($text);
    }
  } catch (\Throwable $e) {
    log_err($e,__METHOD__);
  }


  fenpan_benqiBetPlyr();

  // bot_sendMsg($msg, $GLOBALS['BOT_TOKEN'], $GLOBALS['chat_id']);
  // sendmessageBotNConsole($text);

  //---------------------------------点击官方开奖-----------

  try {
    //  $text = $text . "开奖区块号 ：[$kaijBlknum](https://tronscan.org/#/block/$kaijBlknum)";
    //
    $kaijBlknum = $GLOBALS['kaijBlknum'];
    $text = "第" . $lottery_no . "期 [点击官方开奖](https://tronscan.org/#/block/$kaijBlknum)";
    // sendmessageBotNConsole($text);

    print_r($text);
    if(file_exists("c:/sendBotMsgDisable"))
    {
      logV3(__METHOD__,$text,"mainCycle");

    }else {

      $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
      $bot->sendmessage($GLOBALS['chat_id'], $text, "MarkdownV2", true);

    }

  } catch (\Throwable $e) {
    log_err($e,__METHOD__);
  }

  $set = Setting::find(3);
  $set->value = 1;
  $set->save();
 // \think\facade\Db::close();
  logV3(__METHOD__,"updt setting set gamerstt=1",$GLOBALS['mainlg']);
   // log_vardumpRetval(__METHOD__,"",$GLOBALS['mainlg']);

  log_vardumpRetval(__METHOD__,"",$GLOBALS['mainlg']);

}


/**调用本期下注玩家
 * @return void
 */
function fenpan_benqiBetPlyr() {
  log_enterMethV2(__METHOD__,func_get_args(),$GLOBALS['mainlg']);

   require_once __DIR__."/../app/common/betstr.php";
  //-----------------本期下注玩家
      $lottery_no=$GLOBALS['qihao'];
  require_once __DIR__ . "/../libBiz/fenpan_toLib.php";
  try {
    //获取随机拖数据并融合为arr
    $records_db = \app\common\Logs::getBetRecordByLotteryNoGrpbyU($lottery_no);
    $rows=rdmRcds_ssc(5);
    $GLOBALS['$rowsTo']=$rows;
    $records= arr_merg_ssc($rows,$records_db);

    $text = "--------本期下注玩家---------" . "\r\n";
    \think\facade\Log::info($text);
    $sum = 0;
    foreach ($records as $k => $v) {

      try {
        // array_push($bet_lst_echo_arr,  \echox\getBetContxEcHo($value['text']));

      //$echo = betstrx__format_echo_ex($v['betNoAmt'] . "99");
        $echo =  format_echo_bencyiBetLst($v['betNoAmt'] . "99");

        $echo_a = explode(" ", $echo);
        $money = $v['Bet'] / 100;
        $betNmoney = $echo_a[0] . " " . +$money;
        //  \betstr\format_echo_ex();
        $text = $text . $v['UserName'] . "【" . $v['UserId'] . "】" . $betNmoney . "\r\n";
        $sum += $v['Bet'];
      } catch (\Throwable $e) {
        log_err($e,__METHOD__);
      }


    }
    echo $text . PHP_EOL;
    $msg = $text;

    \think\facade\Log::info($msg);
    //  $msg = str_replace("-", "\-", $text);  //  tlgrm txt encode prblm  BCS is markdown mode
//    var_dump($text);
    if(file_exists("c:/sendBotMsgDisable"))
    {
      logV3(__METHOD__,"\n\n","mainCycle");

      logV3(__METHOD__,$text,"mainCycle");

    }else {
      sendMsgEx($GLOBALS['chat_id'], $msg);
    }
  } catch (\Throwable $e) {
    require_once __DIR__ . "/../lib/logx.php";
    \log_errV2($e,__METHOD__);

  }

  log_vardumpRetval(__METHOD__,"",$GLOBALS['mainlg']);

}
