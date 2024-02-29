<?php


function loadErrHdr() {
  global $errdir;
  $errdir = __DIR__ . "/../runtime/";
  $GLOBALS['$errdir'] = $errdir;


  //  require_once __DIR__."/../lib/logx.php";

  ini_set('display_errors', 'on');
  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
  ini_set("log_errors", 1);
  ini_set("error_log", $errdir . date('Y-m-d H') . "lg142_errLog.txt");


  set_error_handler("error_handler142");
  set_exception_handler('ex_hdlr');
  register_shutdown_function('shutdown_hdlr');

}

require_once __DIR__ . "/../lib/logx.php";
function ex_hdlr($exception) {

  try {
    //  \think\facade\Log::info (  json_encode($exception) );
    \libspc\log_err($exception, __METHOD__, $GLOBALS['$errdir'], "err");
    var_dump($exception);

  } catch (\Exception $e) {
    var_dump($e);
  }
}


function error_handler142($errno, $message, $filename, $lineno) {
  //must try ,bcs runtimne log dir no auth maybe

  try {
    $ex229['errno'] = $errno;
    $ex229['message'] = $message;
    $ex229['filename'] = $filename;
    $ex229['lineno'] = $lineno;
    $j = json_encode($ex229);
    $timestmpt = date('mdHis');
    $j = $timestmpt . " " . $j;
    global $errdir;

    if (!file_exists($errdir))
      $errdir = __DIR__ . "/../runtime/";
    file_put_contents($errdir . date('Y-m-d H') . "lg142_errHdlr_.log", $j . PHP_EOL, FILE_APPEND);

    try {
      if (class_exists('\think\Facade'))
        if (class_exists('\think\facade\Log'))
          \think\facade\Log::error($j);
    } catch (\Exception $e) {
     // var_dump($e);

    }

    var_dump($j); //also echo throw
  } catch (\Throwable $e) {
    var_dump($e);
  }

  //  throw $j;
}

function shutdown_hdlr() {
  try {
    // print_r(error_get_last());
    //cant show echo ,bcs of ok also output
    //
    $errLast = error_get_last();
    // var_dump($errLast);
    if ($errLast) {

      if ($errLast['line'] == "")
        return;
      //    echo  PHP_EOL . PHP_EOL . "-----------shutdown echo--------------------" . PHP_EOL;
      global $errdir;
      $j = json_encode($errLast, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      $timestmpt = date('mdHis');
      $j = $timestmpt . " " . $j;

      file_put_contents($errdir . date('Y-m-d H') . "lg142_shtdwnHdlr_.log", $j . PHP_EOL, FILE_APPEND);
      //print_r(error_get_last());
      //     var_dump($errLast); //also echo throw
      try {
        if (class_exists('\think\facade\Log'))
          \think\facade\Log::info(json_encode($errLast));
      } catch (\Exception $e) {
      }

      //   echo  PHP_EOL . PHP_EOL . "-----------shutdown echo finish--------------------" . PHP_EOL;
      //   echo 'Script executed with finish....', PHP_EOL;
    }


  } catch (\Exception $e) {
    var_dump($e);
  }
}

//$format_echo_other2=function($bet_str)
//{
//    $rzt_true = str_delNum($bet_str);
//    $money = GetAmt_frmBetStr($bet_str);
//    return    $rzt_true+" "+ $money;
//};


//echo $format_echo_other2("a1.11");

/**
 *
 *
 *
 *
 * global $errdir;
 *
 * ini_set('display_errors', 'on');
 * error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
 * ini_set("log_errors", 1);
 * ini_set("error_log", $errdir . date('Y-m-d H') . "lg142_errLog.txt");
 *
 *
 * function test752()
 * {
 * return 1;
 * }
 *
 *
 *
 *
 * set_error_handler('error_handler142');  //this only for log dbg ,,,if local dbg ,,console dbg is more easy
 * register_shutdown_function('shutdown_hdlr');
 * set_exception_handler('ex_hdlr');
 *
 *
 * function ex_hdlr($exception)
 * {
 * //  \think\facade\Log::info (  json_encode($exception) );
 * var_dump($exception);
 * }
 *
 *
 * function error_handler142($errno, $message, $filename, $lineno)
 * {
 * $ex229['errno'] = $errno;
 * $ex229['message'] = $message;
 * $ex229['filename'] = $filename;
 * $ex229['lineno'] = $lineno;
 * $j = json_encode($ex229);
 * global $errdir;
 *
 * if (isset($GLOBALS['getfirstchar_curchar']))
 * $getfirstchar_curchar = $GLOBALS['getfirstchar_curchar'];
 * else
 * $getfirstchar_curchar = "";
 *
 * if (isset($GLOBALS['pinyin1_curstr']))
 * $pinyin1_curstr = $GLOBALS['pinyin1_curstr'];
 * else
 * $pinyin1_curstr = "";
 * $logtxt = "   getfirstchar_curchar:$getfirstchar_curchar, pinyin1_curstr:$pinyin1_curstr " . $j;
 * file_put_contents($errdir . date('Y-m-d H') . "lg142_errHdlr_.log",   $logtxt . PHP_EOL, FILE_APPEND);
 * var_dump($j); //also echo throw
 *
 *
 * }
 *
 * function shutdown_hdlr()
 * {
 * //cant show echo ,bcs of ok also output  ...not good for api output json mode. must no other output ,only json
 * // print_r(error_get_last());
 *
 * if (error_get_last()) {
 * echo  PHP_EOL . PHP_EOL . "-----------shutdown echo--------------------" . PHP_EOL;
 * global $errdir;
 * $j = json_encode(error_get_last(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
 * file_put_contents($errdir . date('Y-m-d H') . "lg142_shtdwnHdlr_.log",  $j . PHP_EOL, FILE_APPEND);
 * //print_r(error_get_last());
 * var_dump(error_get_last()); //also echo throw
 * echo  PHP_EOL . PHP_EOL . "-----------shutdown echo finish--------------------" . PHP_EOL;
 * echo 'Script executed with finish....', PHP_EOL;
 * }
 * }
 *
 */