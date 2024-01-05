<?php

// php public/hd2test.php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

global $errdir;
$errdir = __DIR__."/../runtime"; $GLOBALS['errdir']=$errdir;
require_once __DIR__ . "/../lib/ex.php";
require_once __DIR__ . "/../lib/iniAutoload.php";

while (true) {
  try {


    $cmd = sprintf(" php  %s/hdlupdtChkbt_tpcmd.php ",__DIR__)  ;
    var_dump($cmd);
    //  exec($cmd);
    log23::zdbg11(__METHOD__,"cmd",$cmd);
    system($cmd);
    // echo   iconv("gbk","utf-8","php中文待转字符");//把中文gbk编码转为utf8
    //main_process();

  } catch (\Throwable $exception) {
    var_dump($exception);

    \libspc\log_err($exception,__METHOD__,$errdir);
  }
  usleep(500*1000);
}
