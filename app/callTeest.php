<?php
require_once __DIR__ . "/../lib/ex.php";

require_once __DIR__ . "/../lib/sys1011.php";
require_once __DIR__ . "/../lib/logx.php";
require_once __DIR__ . "/../lib/dsl.php";
require_once __DIR__ . "/../libBiz/toLib.php";


loadErrHdr();
require __DIR__ . '/../vendor/autoload.php';


// 应用初始化
$console = (new \think\App())->console;
//$console->$catchExceptions=false;
$console->call("calltpx");


var_dump(999);


$rows = \think\Facade\Db::query("select * from bet_record_to ORDER BY RAND11() limit 5");



