<?php




require __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../../lib/markdown.php';

//@msgbot2053bot
$GLOBALS['BOT_TOKEN'] = '6959066432:AAH9OgIspApiYStnaNyznl7mcJ_qPjBA7Fg';
$GLOBALS['chat_id'] = -4038077884;  //msgnode

$GLOBALS['kaijBlknum']=123;
$lottery_no=123;
$text = "第" . $lottery_no . "期开奖结果" . "\r\n";

//add open btn
$buttonTxt = file_get_contents(__DIR__ . "/../../db/button.json");
$buttonTxt=str_replace("\$kaijBlknum",$GLOBALS['kaijBlknum'],$buttonTxt);
$keyboard_array = json_decode($buttonTxt);
$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup($keyboard_array);




sendMsgEx706($GLOBALS['chat_id'], $text,$keyboard);



function sendMsgEx706(mixed $chat_id, string $text,$rplyMkp=null) {
  try {
    require_once __DIR__."/../../lib/logx.php";
    log_enterMethV2(__METHOD__,func_get_args(), "sendMsgEx706");
    $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
    $bot->sendmessage($chat_id, $text,null,false,null,null,$rplyMkp);
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
