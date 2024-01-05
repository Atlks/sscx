<?php

//  phpdbg -e   C:\modyfing\jbbot\app\common\asyn_timer_tpCmd.php

require_once __DIR__ . '/../../vendor/autoload.php';


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

