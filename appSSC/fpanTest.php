<?php

require __DIR__ . '/../vendor/autoload.php';
$GLOBALS['qihao']=221634;
require_once __DIR__ . "/zautoload.php";
require_once __DIR__ . "/fenpan.php";

// 应用初始化
$console = (new \think\App())->console;
//$console->$catchExceptions=false;
$console->call("calltpx");


fenpan_benqiBetPlyr();