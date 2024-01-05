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

require_once __DIR__ . '/../../vendor/autoload.php';

//$_GET['s']='Handle2/index';

global $errdir;
$errdir=__DIR__."/../../runtime/";


 //$_GET['s']='Gamelogic/push';   //invalid request:Gamelogic/push

//$_GET['c']='Gamelogic';
//$_GET['a']='push';
//  "method not exists:app\controller\Index->index()
//$_SERVER['PATH_INFO']='/push_ssc';   //router mode


 $_GET['s']='Gamelogic/push_ssc';
 $_GET['id']=1;

// 执行HTTP应用并响应
$http = (new App())->http;
$response = $http->run();


//$gm=new \app\common\Gamelogic();
//$gm->push(123);

// 执行HTTP应用并响应

$response->send();

$http->end($response);



