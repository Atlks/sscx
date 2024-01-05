<?php


function dsl__callFun($fun, $args) {
  include_once __DIR__ . "/iniAutoload.php";
  return call_user_func_arrayx($fun, $args);
}

// var_dump( substr("abcdef",3));
//var_dump( dsl__callFunUrlMode("fun=substr&args=abcdef,3"));
//var_dump(call_user_func_array("substr",array("abcde",3)))
;
function dsl__callFunUrlMode($url) {
  include_once __DIR__ . "/iniAutoload.php";
  $arr = urlQrystrToArr($url);
  $prms = $arr['args'];

  $arr_args = explode(",", $prms);
  //$arr_args[1]=3;
  include_once __DIR__ . "/iniAutoload.php";
  // xdebug_call_function()
  return call_user_func_arrayx($arr['fun'], $arr_args);
}

//var_dump(escapeshellarg("https://programmingdive.com/lambda?a=1"));
;

//var_dump(escapeshellarg( file_get_contents(__DIR__."/../test/wbhk.json")));
//var_dump(dsl__callFunCmdMode("substr  abcdef  2"));
//substr  abcdef  2
//fun1:
//substr( daf,2)
function dsl__callFunCmdMode($cmd) {
  include_once __DIR__ . "/iniAutoload.php";
  $arr = explode(" ", $cmd);
  $arr = array_filter($arr);
  $fun = $arr[0];


  $arr_args = array_slice($arr, 1);
  //$arr_args[1]=3;
  include_once __DIR__ . "/iniAutoload.php";
  // xdebug_call_function()
  return call_user_func_arrayx($fun, $arr_args);
}


function dsl__execSql_tp($fun) {

  include_once __DIR__ . "/iniAutoload.php";
   return dbx_execSql_tp($fun);

}


//console mode
function dsl__execShellCmd($cmd) {

  return call_user_func_arrayx("system", array($cmd));
}


function dsl__execJsFile($jsfile) {


  $cmd="node ".$jsfile;

  return call_user_func_arrayx("system", array($cmd));
}

function dsl__execPhpcode($cmd) {

  return call_user_func_arrayx("eval", array($cmd));
}

function dsl__execPhpfile($file) {
  $cmd="php ".$file;
  return call_user_func_arrayx("eval", array($cmd));
}
function dsl__execSql($sql) {

}


function dsl__http_get($url) {

  include_once __DIR__ . "/iniAutoload.php";
  return http_get($url);


}


//dsl__fileWrt("aaa","c:/aa/bb/t.txt");

function dsl__fileWrt($txt, $f) {
  include_once __DIR__ . "/iniAutoload.php";
  include_once __DIR__ . "/log23.php";
  return file_put_contentsx($f, $txt);

}

function dsl__fileRd($f) {
  include_once __DIR__ . "/iniAutoload.php";
  return file_put_contentsx($f);
}


function dsl__bot_sendMsg($chatid, $txt, $parsemode, $replyMsgID) {
  require_once __DIR__ . "/../vendor/telegram-bot/api/vendor/autoload.php";
  $bot = new \TelegramBot\Api\BotApi($GLOBALS['BOT_TOKEN']);
  // $bot->sendPhoto($GLOBALS['chat_id'], $cfile, $text, null, null, null, false, "MarkdownV2");
  return $bot->sendMessage($chatid, $txt, $parsemode, false, $replyMsgID);
}

