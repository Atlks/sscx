<?php


use function libspc\log_err;

function sendmessageBotNConsole($msg)
{
  try {
    \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
    echo PHP_EOL;
    echo $msg;
    echo PHP_EOL;
    //  https://api.telegram.org/bot6426986117:AAFb3woph_1zOWFS5cO98XIFUPcj6GqvmXc/getUpdates
    // $bot_token = "6426986117:AAFb3woph_1zOWFS5cO98XIFUPcj6GqvmXc";  //sscNohk
    //  $chat_id = -1001903259578;
    //global $bot_token, $chat_id;
    bot_sendMsg($msg, $GLOBALS['BOT_TOKEN'], $GLOBALS['chat_id']);
  }catch (\Throwable $e){}

}


function bot_sendMsgTxtModeEx($msg, $bot_token, $chat_id)
{
  $i=0;
  $retryTime=0;
  while (true)
  {
    $retryTime++;

    if($retryTime>3)
      break;

    try {
      bot_sendMsgTxtMode($msg, $bot_token, $chat_id);
      break;
    }catch (\Throwable $e)
    {
      $i++;
      //bot_sendMsgTxtMode($msg, $bot_token, $chat_id);
      log_err($e,__METHOD__);
    }

  }

}

function bot_sendMsgTxtMode($msg, $bot_token, $chat_id)
{
  try{
    \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
    //  $rplmsgid = $json['message_id'];
    // $chat_id = $json['chat']['id'];
    //   $msg = $msg_tmplt;
    //   echo $url_tmp;
    echo PHP_EOL;
    echo PHP_EOL;
    //  reply_to_message_id=$rplmsgid&
    //  $msg = str_replace("-", "\-", $msg);
    //   urlencode  GBK与UTF-8之间的相互转码：iconv("gbk","utf-8","php中文待转字符");//把中文gbk编码转为utf8
    $url_tmp = "https://api.telegram.org/bot$bot_token/sendMessage?chat_id=$chat_id&text=" . rawurlencode($msg);
    echo $url_tmp;
    echo PHP_EOL;
    echo PHP_EOL;
    require_once  __DIR__ . "/iniAutoload.php";
    echo http_get_curl($url_tmp);
    echo PHP_EOL;
  }catch (\Throwable $e)
  {
        log_err($e,__METHOD__);
  }

}


function bot_sendMsgX(mixed $chat_id, string $text) {
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


// mkdown must encode some zhuanyiu. char
function bot_sendMsg($msg, $bot_token, $chat_id)
{
    require_once  __DIR__ . "/iniAutoload.php";
    //  $rplmsgid = $json['message_id'];
    // $chat_id = $json['chat']['id'];
    //   $msg = $msg_tmplt;
    //   echo $url_tmp;
    echo PHP_EOL;
    echo PHP_EOL;

    // $msg=str_replace("-","\-",$msg);  //TEXT MUST endcode as utf8
    //  reply_to_message_id=$rplmsgid&
    //   urlencode  GBK与UTF-8之间的相互转码：iconv("gbk","utf-8","php中文待转字符");//把中文gbk编码转为utf8
    require_once __DIR__ . "/../app/common/helper.php";


    $msg = str_replace("+", "\+", $msg);
    try {
        $msg = app\common\Helper::replace_markdown($msg);
    } catch (\Throwable $exception) {


        $linenum = "file_linenum:" . $exception->getFile() . ":" . $exception->getLine();
        $errmsg = "errmsg:" . $exception->getMessage();
        $errtraceStr = "errtraceStr:" . $exception->getTraceAsString();
        file_put_contents($GLOBALS['errdir'] . date('Y-m-d H') . "_lg142_tlgrmeHdlr_.log", $linenum . PHP_EOL, FILE_APPEND);
        file_put_contents($GLOBALS['errdir'] . date('Y-m-d H') . "_lg142_tlgrmeHdlr_.log", $errmsg . PHP_EOL, FILE_APPEND);
        file_put_contents($GLOBALS['errdir'] . date('Y-m-d H') . "_lg142_tlgrmeHdlr_.log", $errtraceStr . PHP_EOL, FILE_APPEND);


        //   $errdir = '/www/wwwroot/ssc.521ck.vip/app/controller/';
    }
    $msg = str_replace("+", "\+", $msg);

    $url_tmp = "https://api.telegram.org/bot$bot_token/sendMessage?parse_mode=MarkdownV2&chat_id=$chat_id&text=" . rawurlencode($msg);
    echo $url_tmp;
    echo PHP_EOL;
    echo PHP_EOL;
    echo http_get_curl($url_tmp);
    echo PHP_EOL;
}


function sendmsg_reply_txt($msg, $bot_token, $chat_id)
{
    //  $rplmsgid = $json['message_id'];
    // $chat_id = $json['chat']['id'];
    //   $msg = $msg_tmplt;
    //   echo $url_tmp;
    echo PHP_EOL;
    echo PHP_EOL;
    //  reply_to_message_id=$rplmsgid&
    $url_tmp = "https://api.telegram.org/bot$bot_token/sendMessage?chat_id=$chat_id&text=" . urlencode($msg);
    echo PHP_EOL;
    echo PHP_EOL;
    echo file_get_contents($url_tmp);
    echo PHP_EOL;
}

function sendmsg_reply($msg, $bot_token, $chat_id)
{
    //  $rplmsgid = $json['message_id'];
    // $chat_id = $json['chat']['id'];
    //   $msg = $msg_tmplt;
    //   echo $url_tmp;
    echo PHP_EOL;
    echo PHP_EOL;
    //  reply_to_message_id=$rplmsgid&
    $url_tmp = "https://api.telegram.org/bot$bot_token/sendMessage?parse_mode=MarkdownV2&chat_id=$chat_id&text=" . urlencode($msg);
    echo PHP_EOL;
    echo PHP_EOL;
    echo file_get_contents($url_tmp);
    echo PHP_EOL;
}


function bot_sendmsg_reply_byQrystr($bot_token, $Qrystr)
{
    log_enterMeth_reqchain(__LINE__ . __METHOD__, func_get_args()); //login to invchain
    log_enterMethinfo_toLiblog(__LINE__ . __METHOD__, func_get_args(), "tlgrmlib");

     $QrystrDecode=url_qrystrDecode($Qrystr);
  log_info_toLiblog(__LINE__ . __METHOD__,"QrystrDecode", $QrystrDecode,"tlgrmlib");



    var_dump(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));


    try {
        //  $rplmsgid = $json['message_id'];
        // $chat_id = $json['chat']['id'];
        //   $msg = $msg_tmplt;
        //   echo $url_tmp;
        echo PHP_EOL;
        echo PHP_EOL;
        //  reply_to_message_id=$rplmsgid&
        $url_tmp = "https://api.telegram.org/bot$bot_token/sendMessage?" . $Qrystr;
//        log_info_toReqchain(__LINE__ . __METHOD__,"url_tmp",$url_tmp);
//        log23::tlgrmlib(__LINE__ . __METHOD__,"url_tmp",$url_tmp);
//        echo $url_tmp;
        echo PHP_EOL;
        require_once __DIR__ . "/http.php";
        $r = http_get_curl($url_tmp);
         $r=decodeUnicode($r);
        echo "rzt:" . $r;
        echo PHP_EOL;


        // echo console,,  reqchian log,,,,liblog,, glblog
        var_dump($r);;

        log_info_toReqchain(__LINE__ . __METHOD__, "curlrzt", $r);
        log23::tlgrmlib(__LINE__ . __METHOD__, ">>>ret", $r);

        return $r;
    } catch (\Throwable $exception) {
        var_dump($exception);
        log_err_toReqChainLog($exception, __LINE__ . __METHOD__);

        //log to lib log  nnnn lib errlog
        log_err_toLibLog(__LINE__ . __METHOD__, $exception, "httplib");


        //log to glb err
        log_e_toGlbLog($exception, __LINE__ . __METHOD__, func_get_args());


    }

}



