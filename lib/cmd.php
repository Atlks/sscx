<?php


function  exec_console ($cmd)
{

    require_once __DIR__ . "/iniAutoload.php";
    var_dump(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
    log23::info(__LINE__ . __METHOD__, "Arg", func_get_args());
    try {
        system($cmd);

    } catch (\Throwable $exception) {

        var_dump($exception);
        log23::err(__LINE__.__METHOD__, "arg", func_get_args());
        log23::err(__LINE__.__METHOD__, "e", $exception);

    }


}





//exec_console("php task1.php > o2223.log  ");
 //   echo 999;