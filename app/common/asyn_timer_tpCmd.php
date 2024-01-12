<?php

//  phpdbg -e   C:\modyfing\jbbot\app\common\asyn_timer_tpCmd.php

require_once __DIR__ . '/../../vendor/autoload.php';

//要执行的函数
//  todo 这里可以优化，直接导入tp库，调用async_timer_start
// todo 这个文件可以与 asyn timer合并，减少一个文件。
$_GET['s']='Gamelogic/timer_start_tp';

global $errdir;
$errdir=__DIR__."/../../runtime/";
$GLOBALS['errdir']=$errdir;

// 执行HTTP应用并响应
$http = (new think\App())->http;

$response = $http->run();

ob_start();

var_dump(222);

$response->send();

$http->end($response);
ob_end_clean();

