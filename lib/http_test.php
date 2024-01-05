<?php


//require_once __DIR__."/iniAutoload.php";
//$GLOBALS['reqchain']="reqxxx";
//$GLOBALS['logdir']=__DIR__."/../runtime/";
//echo http_get_curl("https://www.google.com");
require_once "http.php";
require_once __DIR__."/log23.php";
require_once __DIR__."/logx.php";
//$t=http_get_curl("http://34.150.68.52:8080/user/login/submit?userName=test04&password=111111");
//$t=http_post("http://34.150.68.52:8080/user/login/submit","userName=test04&password=aaa111");

$url="http://34.150.68.52:8080/api/baccarat/gameinfo";
$tok="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjb2RlIjoidGVzdDA0IiwiYWRtaW5JZCI6MTk0MCwiZXhwIjoxNzAyMDMwMjU0fQ.tYHmlQQtnCiPzOOBBDjtzKjRmG0fWN6JjhWULfiDk-8";

$t=http_post($url,"tableNo=8&token=".$tok);

echo $t;

