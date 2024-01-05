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

// [ 应用入口文件 ]  HandleUpdates/index
namespace think;

require __DIR__ . '/../../vendor/autoload.php';

//  s=TCtrolor/UnqT
$_GET['s']='TCtrolor/UnqT';
$GLOBALS['testIpt']=file_get_contents(__DIR__."/../test/wbhk.json");

global $errdir;
$errdir=__DIR__."/../runtime/";

// 执行HTTP应用并响应
$http = (new App())->http;

$response = $http->run();

$response->send();

$http->end($response);
