<?php
function str_getAmt_frmBetStr($str)
{
  try {
    $str = trim($str);
    //   $str = $msg['text'];
    if (preg_match('/(\d+)$/', $str, $match)) {
      $number = $match[0];
    }
    return $number;
  }catch (\Throwable $e)
  {

    log_errV3($e,$str,__METHOD__);
  }

}