<?php
// 定义参数
define('ACCOUNT_ID', '263657865'); // your account ID
define('ACCESS_KEY','bgrveg5tmn-5511dfa5-8302a1ad-93781'); // your ACCESS_KEY
define('SECRET_KEY', 'f60b3a85-6d8c6c94-3dd1877d-b5430'); // your SECRET_KEY

include "lib.php";

//实例化类库
$req = new req();
// 获取account-id, 用来替换ACCOUNT_ID
//var_dump($req->get_account_accounts());
// 获取账户余额示例
// var_dump($req->get_balance());
$rzt=$req->get_tickers();
//连接本地的 Redis 服务
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
echo "Connection to server successfully";
//设置 redis 字符串数据

$rzt_txt=json_encode($rzt);

echo $rzt_txt;
$redis->set("tickers",   $rzt_txt );
$redis->set("ttt",  11);
// var_dump($req->get_tickers());

?>
