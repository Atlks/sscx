<?php

//$prm = $_SERVER['argv'][1];
//$cfgOptx = urldecode($prm);
//$GLOBALS['cfgOpt']=$cfgOptx;


//  php app/main_cmd.php
global $errdir;
$errdir = __DIR__."/../runtime"; $GLOBALS['errdir']=$errdir;
require_once __DIR__ . "/../lib/ex.php";
require_once __DIR__ . "/../lib/iniAutoload.php";

while (true) {
    try {

        $phpexe = "php";
        // $tlghr_msg_hdl = " C:\\w\\jbbot\\tlgrmHdl_temacyo.php ";
        $filename = __DIR__ . "/../think";
        //$filename = __DIR__ . "/ech.php";
        $cmd = $phpexe . " " . $filename . "    swoole2  ";  //$prm
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
