<?php


require_once __DIR__ . "/../lib/ex.php";

require_once __DIR__ . "/../lib/sys1011.php";
require_once __DIR__ . "/../lib/logx.php";
require_once __DIR__ . "/../lib/dsl.php";
require_once __DIR__ . "/../libBiz/toLib.php";


loadErrHdr();


call_inTpX("_main");

function _main() {
  rdmRcds(5);
  try {
    $rows = rdmRcds_ssc(2);
    $rows2 = [];// rdmRcds_ssc(1);
    $rs = array_merge($rows, $rows2);


    print_r($rs);
  } catch (\Throwable $e) {
    print_r($e);
  }


}