<?php

  function dbx_execSql_tp($f) {

    log_enterMeth_reqchain(__METHOD__,func_get_args());
    log_enterMethinfo_toLiblog(__METHOD__,func_get_args(),"dblib");
    try {
      return $f();
    } catch (\Throwable $exception) {
      var_dump($exception->getMessage());
      log_err_toReqChainLog(__METHOD__,$exception);

      log_ex_toLibLog(__METHOD__,$exception,"dblib");

      log_e_toGlbLog($exception,__METHOD__,"");

    }
    return [];

  }


function dbx_execSql($sql,$conn) {

  try {
    return execSql($sql);
  } catch (\Throwable $exception) {
    var_dump($exception->getMessage());

  }

}