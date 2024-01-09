<?php

namespace libspc {






  function log_dbg_php($method_linenum, $msg, $obj) {
    log_php($method_linenum, $msg, $obj, "dbg");
  }

  function get_variable_name(&$var333, $scopeVarArr = NULL) {
    if (NULL == $scopeVarArr) {
      $scopeVarArr = $GLOBALS;
    }
    $tmp = $var333;
    $var = "tmp_exists_" . mt_rand();
    // $name = array_search($var, $scope, TRUE);
    $name = array_search($var333, $scopeVarArr);
    $var333 = $tmp;
    return $name;
  }

  $var11 = 34567;
//var_dump(get_variable_name( $var11,get_defined_vars()));

// [kka:12] 0821051358 vrr==>11
//log_phpV2(__LINE__."kka",get_variable_name( $var11,get_defined_vars()),$var11,"lev413");
  /*
   * @auther atlks
   * @
   * */
  function log_phpV2($method_linenum, $varname, $varobj, $filFrg = "info") {//log_err

    try {
      if (is_object($varobj) && get_class($varobj) == "Exception") {
        log_err($varobj, $method_linenum, $filFrg);
        return;
      }
      if (is_object($varobj) || is_array($varobj))
        $varobj = json_encode($varobj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      if (is_bool($varobj))
        $varobj = $varobj ? "TRUE" : "FALSE";

      if (is_null($varobj))
        $varobj = "@@@null";
      $logf = __DIR__ . "/../runtime/" . date('Y-m-d') . "_$filFrg.log";
      $logtxt = sprintf("%s [%s] %s=>%s", date('mdHis'), $method_linenum, $varname, $varobj);
      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);


    } catch (\Throwable $e) {
      var_dump($e);
    }
  }

//    if (is_array($obj) == "Exception") {
//        log_err($obj, $method_linenum, $lev);
//        return;
//    }
// file_put_contents($logf,   $logtxt , FILE_APPEND);
//   file_put_contents($logf,   $linenum_magicNum . PHP_EOL, FILE_APPEND);
//  varname is xxx
//  var_dump( $datamsg);//  var_dump( $datamsg);DIE();

  /*
   * @deprecated
   * @deprecated
   *@todo  todoxxxmsgn
   * */
  function log_php($method_linenum, $msg, $obj, $lev = "info") {

    try {
      $logdir = __DIR__ . "/../runtime/";
      $datamsg = $obj;
      if (is_object($obj) || is_array($obj)) {
        $datamsg = json_encode($obj, JSON_UNESCAPED_UNICODE);
      } else if (is_bool($obj)) {
        if ($obj)
          $datamsg = "TRUE";
        else
          $datamsg = "FALSE";
        //  var_dump( $datamsg);DIE();
      }
      //  var_dump( $datamsg);
      $logf = $logdir . date('Y-m-d') . "_lg142_$lev.log";
      $logtxt = $method_linenum;

      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);
      //   file_put_contents($logf,   $linenum_magicNum . PHP_EOL, FILE_APPEND);
      //  varname is xxx
      $logtxt = $msg . " =>" . $datamsg;

      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);


    } catch (\Throwable $e) {
      var_dump($e);
    }
  }

  function log_info_php($method_linenum, $msg, $obj, $lev = "info") {

    try {
      $logdir = __DIR__ . "/../runtime/";
      $datamsg = $obj;
      if (is_object($obj) || is_array($obj)) {
        $datamsg = json_encode($obj, JSON_UNESCAPED_UNICODE);
      } else if (is_bool($obj)) {
        if ($obj)
          $datamsg = "TRUE";
        else
          $datamsg = "FALSE";
        //  var_dump( $datamsg);DIE();
      }
      // var_dump( $datamsg);
      $logf = $logdir . date('Y-m-d') . "_$lev lg142_.log";
      $logtxt = $method_linenum;

      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);
      //   file_put_contents($logf,   $linenum_magicNum . PHP_EOL, FILE_APPEND);
      //  varname is xxx
      $logtxt = $msg . " is:" . $datamsg;
      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);


    } catch (\Throwable $e) {
      var_dump($e);
    }
  }

  function log_to_tp($msg, $obj, $linenum, $lev = "info") {
    try {

      \think\facade\Log::$lev($linenum);
      \think\facade\Log::$lev($msg . " is : " . json_encode($obj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    } catch (\Throwable $e) {
      var_dump($e);
    }

  }

  function log_info_tp($var, $obj, $linenum, $fileFrg = "info") {

    try {
      if (class_exists('\think\facade\Log')) {
        \think\facade\Log::$fileFrg($linenum);
        \think\facade\Log::$fileFrg($var . " is : " . json_encode($obj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
      }


    } catch (\Throwable $e) {
      var_dump($e);
    }

  }

  function log_err($exception, $hdrName_method_linenum, $logdir = __DIR__ . "/../runtime/", $lev = "err") {
    try {
      if (!file_exists($logdir))
        $logdir = __DIR__ . "/../runtime/";

      $logf = $logdir . date('Y-m-d H') . "_$lev.log";
      $timestmpt = date('mdHis');
      $logtxt = $timestmpt . "----------------Hdrname:$hdrName_method_linenum ex_cathr---------------------------";

      //   $logtxt = sprintf("%s [%s] %s=>%s", date('mdHis'), $meth, $varname, $varobj);

      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);
      //   file_put_contents($logf,   $linenum_magicNum . PHP_EOL, FILE_APPEND);
      $logtxt = $timestmpt . "errmsg:" . $exception->getMessage();
      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);
      $logtxt = $timestmpt . "ex file_linenum:" . $exception->getFile() . ":" . $exception->getLine();
      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);

      $logtxt = $timestmpt . "errtraceStr:" . $exception->getTraceAsString();
      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);

    } catch (\Throwable $e) {
      var_dump($e);
    }

    // file_put_contents($logdir . date('Y-m-d H') . "_lg142_$hdrName catch.log",  json_encode($GLOBALS['bet_ret_prm']) . PHP_EOL, FILE_APPEND);
  }

  function log_err_tp($exception, $hdrName_method_linenum, $lev = "err") {

    try {
      \think\facade\Log::$lev("----------------errInMethod:$hdrName_method_linenum ex_cathr---------------------------");
      \think\facade\Log::$lev("errmsg:" . $exception->getMessage());
      \think\facade\Log::$lev("file_linenum:" . $exception->getFile() . ":" . $exception->getLine());
      //   \think\facade\Log::error("errtrace:".$exception->getTrace());
      \think\facade\Log::$lev("errtraceStr:" . $exception->getTraceAsString());
      \think\facade\Log::$lev("----------------errrrr finish---------------------------");


    } catch (\Throwable $e) {
      var_dump($e);
    }
  }

  function log_errImpt_tp($exception, $hdrName_method_linenum, $lev = "err") {
    \think\facade\Log::critical("----------------Hdrname:$hdrName_method_linenum ex_cathr---------------------------");
    \think\facade\Log::emergency("errmsg:" . $exception->getMessage());
    \think\facade\Log::emergency("file_linenum:" . $exception->getFile() . ":" . $exception->getLine());
    //   \think\facade\Log::error("errtrace:".$exception->getTrace());
    \think\facade\Log::emergency("errtraceStr:" . $exception->getTraceAsString());
    \think\facade\Log::emergency("----------------errrrr finish---------------------------");
  }

}

namespace {

  use function libspc\log_err;

  function log_errV3($exception, $prmdt, $hdrName_method_linenum, $logdir = __DIR__ . "/../runtime/", $lev = "err") {
    try {
      if (!file_exists($logdir))
        $logdir = __DIR__ . "/../runtime/";

      $logf = $logdir . date('Y-m-d H') . "_$lev.log";
      $timestmpt = date('mdHis');




      $logtxt = $timestmpt . "----------------Hdrname:$hdrName_method_linenum ex_cathr---------------------------";

      //   $logtxt = sprintf("%s [%s] %s=>%s", date('mdHis'), $meth, $varname, $varobj);

      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);
      //   file_put_contents($logf,   $linenum_magicNum . PHP_EOL, FILE_APPEND);
      $logtxt = $timestmpt . "errmsg:" . $exception->getMessage();
      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);
      $logtxt = $timestmpt . "ex file_linenum:" . $exception->getFile() . ":" . $exception->getLine();
      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);


      $logtxt = $timestmpt . "prmdt:" .json_encode($prmdt,JSON_UNESCAPED_UNICODE);
      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);



      $logtxt = $timestmpt . "errtraceStr:" . $exception->getTraceAsString();
      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);

    } catch (\Throwable $e) {
      var_dump($e);
    }

    // file_put_contents($logdir . date('Y-m-d H') . "_lg142_$hdrName catch.log",  json_encode($GLOBALS['bet_ret_prm']) . PHP_EOL, FILE_APPEND);
  }



  function log_errV2($exception, $hdrName_method_linenum, $logdir = __DIR__ . "/../runtime/", $lev = "err") {
    try {
      if (!file_exists($logdir))
        $logdir = __DIR__ . "/../runtime/";

      $logf = $logdir . date('Y-m-d H') . "_$lev.log";
      $timestmpt = date('mdHis');
      $logtxt = $timestmpt . "----------------Hdrname:$hdrName_method_linenum ex_cathr---------------------------";

      //   $logtxt = sprintf("%s [%s] %s=>%s", date('mdHis'), $meth, $varname, $varobj);

      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);
      //   file_put_contents($logf,   $linenum_magicNum . PHP_EOL, FILE_APPEND);
      $logtxt = $timestmpt . "errmsg:" . $exception->getMessage();
      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);
      $logtxt = $timestmpt . "ex file_linenum:" . $exception->getFile() . ":" . $exception->getLine();
      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);

      $logtxt = $timestmpt . "errtraceStr:" . $exception->getTraceAsString();
      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);

    } catch (\Throwable $e) {
      var_dump($e);
    }

    // file_put_contents($logdir . date('Y-m-d H') . "_lg142_$hdrName catch.log",  json_encode($GLOBALS['bet_ret_prm']) . PHP_EOL, FILE_APPEND);
  }


  function log_e_toReqchain($meth, $varname, $varobj) {

    try {
      //also log info reqchn
      log_info_toReqchain($meth, $varname, $varobj);
      $filFrg = isset($GLOBALS['reqchain']) ? $GLOBALS['reqchain'] : "defchain";
      $filFrg = $filFrg . "_ERR";
      if (isset($filFrg)) {

//        if (is_object($varobj) && get_class($varobj) == "Exception") {
//          log_err($varobj, $meth, $filFrg);
//          return;
//        }
        if (is_object($varobj) || is_array($varobj))
          $varobj = json_encode($varobj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        if (is_bool($varobj))
          $varobj = $varobj ? "TRUE" : "FALSE";
        $logf = __DIR__ . "/../runtime/" . date('Y-m-d') . "_$filFrg.log";
        $logtxt = sprintf("%s [%s] %s=>%s", date('mdHis'), $meth, $varname, $varobj);
        //  file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);

        $logf = __DIR__ . "/../runtime/" . date('Y-m-d') . "_$filFrg.log";
        error_log($logtxt . PHP_EOL, 3, $logf);
      }

    } catch (\Throwable $exception) {

      var_dump($exception);

      //  \think\facade\Log::$GLOBALS['reqchain'](__METHOD__ .);


    }
  }


  function log_info_toReqchain($LineFun, $varname, $varobj) {
    if (is_array($LineFun))  //oo invk
      $LineFun = json_encode($LineFun);
    // var_dump($meth." ".$varname);

    try {

      $filFrg = isset($GLOBALS['reqchain']) ? $GLOBALS['reqchain'] : "defchain";
      if (isset($filFrg)) {

        if (is_object($varobj) && get_class($varobj) == "Exception") {
          log_err($varobj, $LineFun, $filFrg);
          return;
        }

        $val_txt = $varobj;
        if (is_object($varobj) || is_array($varobj))
          $val_txt = json_encode($varobj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        if (is_bool($varobj))
          $val_txt = $varobj ? "TRUE" : "FALSE";

        if (is_null($val_txt))
          $val_txt = "@@@null";

        if (!is_string($val_txt)) {
//var_dump($varobj);
        }

        $msg=sprintf("%s=>%s",$varname, $val_txt);
        //statnd msg tmplt

        $logtxt = sprintf("%s [%s] %s \r\n", date('mdHis'), $LineFun,$msg );

        log_rcd($logtxt);
        //  error_log($logtxt, 3, $logf);
      }

    } catch (\Throwable $exception) {

      var_dump($exception);

      //  \think\facade\Log::$GLOBALS['reqchain'](__METHOD__ .);


    }
  }

  /**
   * @param mixed $meth
   * @param $varname
   * @param mixed $val_txt
   * @return void
   */
  function log_rcd($logtxt): void {


      if(!isset($GLOBALS['funIvk']))
        if(isset($GLOBALS['reqchain']))
           $GLOBALS['funIvk']=$GLOBALS['reqchain'];


    $funIvk = isset($GLOBALS['funIvk']) ? $GLOBALS['funIvk'] : "defUnknow";
    $reqid = isset($GLOBALS['reqid']) ? $GLOBALS['reqid'] : "defreqid";
    $logf = __DIR__ . "/../runtime/" . $funIvk . "/".date("md")."/";
    $logf .= $reqid . ".log";


    //  file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);
    echo $logtxt;
    //  dsl__fileWrt($logtxt,$logf);
    if(!file_exists(dirname($logf)))
       mkdir(dirname($logf), 0777, true);
    file_put_contents($logf, $logtxt, FILE_APPEND);
  }


  function log_info_toLiblog(string $meth, string $varname, $varObj, $filFrg) {
    log23::$filFrg($meth, $varname, $varObj);
  }

  function log_enterMethinfo_toLiblog(string $meth, array $func_get_args, $filFrg) {
    log23::$filFrg("######" . $meth, "args", $func_get_args);
  }

  function log_e_toGlbLog(Throwable|Exception $exception, string $meth, array $func_get_args) {

    log23::err($meth, "arg", $func_get_args);
    log23::err($meth, "e", $exception);

  }

  function log_ex_toLibLog(string $meth, Throwable|Exception $exception, $filFrg_libname) {
    log23::$filFrg_libname($meth, "e", $exception);
    $errFlg = $filFrg_libname . " ERR";
    log23::$errFlg($meth, "e", $exception);
  }

  function log_err_toLibLog(string $meth, Throwable|Exception $exception, $filFrg) {
    log23::$filFrg($meth, "e", $exception);
    $errFlg = $filFrg . " ERR";
    log23::$errFlg($meth, "e", $exception);
  }


  function log_enterMeth_reqchain(string $meth, $args, $logf_flag = "info") {
    var_dump(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));

    // if($GLOBALS['reqchain'])

    if ($logf_flag != "info")
      $GLOBALS['reqchain'] = $logf_flag;

    log_setReqChainLog_enterMeth($meth, $args);

  }


  function log_enterMeth_reqchainWzIniLgfilfrg(string $meth, $args, $logf_flag) {

    $args_txt = json_encode($args, JSON_UNESCAPED_UNICODE);

    $msg = $meth . $args_txt;

    $str = "***" . $msg . PHP_EOL;
    //echo $str;

    if ($logf_flag != "info")
      $GLOBALS['reqchain'] = $logf_flag;

    log_setReqChainLog_enterMeth($meth, $args);

  }


  //dep bcs ivnk too dep
  function log_enterMeth(string $meth, $args, $logf_flag = "info") {

    if ($logf_flag != "info")
      $GLOBALS['reqchain'] = $logf_flag;

    log_setReqChainLog_enterMeth($meth, $args);

  }

  function log_ex_toReqChainLog(string $meth, $ex) {
    try {
      if (!set($GLOBALS['logdir']))
        $GLOBALS['logdir'] = __DIR__ . "/../runtime/";

      if (!set($GLOBALS['reqchain']))
        $reqchainName = "defReqChain";
      else
        $reqchainName = $GLOBALS['reqchain'];

      // to reqchain log,,and regcvhaing err log
      \libspc\log_err($ex, $meth, $GLOBALS['logdir'], $reqchainName);
      \libspc\log_err($ex, $meth, $GLOBALS['logdir'], $reqchainName . " ERR");

    } catch (\Throwable $exception) {

      var_dump($exception);

      //  \think\facade\Log::$GLOBALS['reqchain'](__METHOD__ .);


    }


  }


  function log_err_toReqChainLog(string $meth, $ex) {
    try {


      if (!isset($GLOBALS['logdir']))
        $GLOBALS['logdir'] = __DIR__ . "/../runtime/";

      if (!file_exists($GLOBALS['logdir']))
        $GLOBALS['logdir'] = __DIR__ . "/../runtime/";

      if (!isset($GLOBALS['reqchain']))
        $reqchainName = "defReqChain";
      else
        $reqchainName = $GLOBALS['reqchain'];

      // to reqchain log,,and regcvhaing err log
      \libspc\log_err($ex, $meth, $GLOBALS['logdir'], $reqchainName);
      \libspc\log_err($ex, $meth, $GLOBALS['logdir'], $reqchainName . " ERR");

    } catch (\Throwable $exception) {

      var_dump($exception);

      //  \think\facade\Log::$GLOBALS['reqchain'](__METHOD__ .);


    }


  }

  function log_ReqChainLog_err(string $meth, $ex) {
    try {
      \libspc\log_err($ex, $meth, $GLOBALS['logdir'], $GLOBALS['reqchain']);


    } catch (\Throwable $exception) {

      var_dump($exception);

      //  \think\facade\Log::$GLOBALS['reqchain'](__METHOD__ .);


    }

  }



  function log_vardumpRetval($method_linenum,$varobj,$filFrg = "info")
  {
    try {
      if (is_object($varobj) && get_class($varobj) == "Exception") {
        log_err($varobj, $method_linenum, $filFrg);
        return;
      }
      if (is_object($varobj) || is_array($varobj))
        $varobj = json_encode($varobj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      if (is_bool($varobj))
        $varobj = $varobj ? "TRUE" : "FALSE";

      if (is_null($varobj))
        $varobj = "@@@null";
      $logf = __DIR__ . "/../runtime/" . date('Y-m-d') . "_$filFrg.log";
      $logtxt = sprintf("%s <<<<<ENDFUN [%s] <<<ret:%s", date('mdHis'), $method_linenum, $varobj);
      file_put_contents($logf, $logtxt . PHP_EOL. PHP_EOL. PHP_EOL, FILE_APPEND);


    } catch (\Throwable $e) {
      var_dump($e);
    }

  }
  function log_Vardump($method_linenum, $varname, $varobj, $filFrg = "info") {//log_err

    try {
      if (is_object($varobj) && get_class($varobj) == "Exception") {
        log_err($varobj, $method_linenum, $filFrg);
        return;
      }
      if (is_object($varobj) || is_array($varobj))
        $varobj = json_encode($varobj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      if (is_bool($varobj))
        $varobj = $varobj ? "TRUE" : "FALSE";

      if (is_null($varobj))
        $varobj = "@@@null";
      $logf = __DIR__ . "/../runtime/" . date('Y-m-d') . "_$filFrg.log";
      $logtxt = sprintf("%s [%s] %s=>%s", date('mdHis'), $method_linenum, $varname, $varobj);
      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);


    } catch (\Throwable $e) {
      var_dump($e);
    }
  }

  function logV3($method_linenum, $msg, $filFrg = "info") {//log_err

    try {

      $logf = __DIR__ . "/../runtime/" . date('Y-m-d') . "_$filFrg.log";
      // time [meth()] msg
      $logtxt = sprintf("%s [%s():] %s", date('mdHis'), $method_linenum, $msg);

      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);


    } catch (\Throwable $e) {
      var_dump($e);
    }
  }

  function log_setReqChainLog_enterMeth($LineFun, $args) {


    try {
     if(is_array($LineFun))
       $LineFun=json_encode($LineFun);


      $args_txt = json_encode($args, JSON_UNESCAPED_UNICODE);

     // $msg=sprintf("%s%s",$LineFun, $args_txt);
      //statnd msg tmplt

      $logtxt = sprintf("%s ***%s%s \r\n", date('mdHis'), $LineFun,$args_txt );

      log_rcd($logtxt);


    } catch (\Throwable $exception) {

      var_dump($exception);


    }
//        if(isset($GLOBALS['reqchain']))
//            \think\facade\Log::$GLOBALS['reqchain'](__METHOD__ . json_encode($args, JSON_UNESCAPED_UNICODE));

  }





  function log_enterMethV2(string $LineNFun, $args, $logf_flag = "info") {

    // var_dump(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
    if ($logf_flag != "info")
      $GLOBALS['reqchain'] = $logf_flag;

    try {
      if(is_array($LineNFun))
        $LineNFun=json_encode($LineNFun);


      $args_txt = json_encode($args, JSON_UNESCAPED_UNICODE);

      // $msg=sprintf("%s%s",$LineFun, $args_txt);
      //statnd msg tmplt
      // time >>  fun(((  args )))
      $logtxt = sprintf("\r\n\r\n%s !**FUN %s((( %s )))", date('mdHis'), $LineNFun,$args_txt );
      $logf = __DIR__ . "/../runtime/" . date('Y-m-d') . "_$logf_flag.log";

      file_put_contents($logf, $logtxt . PHP_EOL, FILE_APPEND);



    } catch (\Throwable $exception) {

      var_dump($exception);


    }

  }






  //end fun






}



