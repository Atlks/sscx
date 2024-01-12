<?php



// php app/common/async_timer_starter.php

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
//    php public/HandleUpdates_core.php
//    php public/HandleUpdates.php
// [ 应用入口文件 ]  HandleUpdates/index
namespace think;

require __DIR__ . '/../../vendor/autoload.php';


require_once __DIR__."/../../lib/iniAutoload.php";

//异步任务执行 damon
while (true) {
    try {


        $filename = __DIR__ . "/asyn_timer_tpCmd.php";

        $cmd =  "php " . $filename . "       ";
        var_dump($cmd);

        system($cmd);


    } catch (\Throwable $exception) {
        var_dump($exception);


    }
    usleep(1000*1000);  //100ms
}



