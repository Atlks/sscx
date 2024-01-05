<?php


// php test/dwijyo.php 虎100 12345
namespace think;

//ob_start();

require __DIR__ . '/../vendor/autoload.php';
$bet = urldecode($_SERVER['argv'][1]);
//$kaijnum = $_SERVER['argv'][2];
//$param = urldecode($fname);
//  a/单/100 11690
require __DIR__ . "/../lib/iniAutoload.php";
//require_once __DIR__ . "/../app/common/lotrySscV2.php";


// 执行HTTP应用并响应
//$http = (new App())->http;
//
//$response = $http->run();

//new App();


$bet_str_arr_clr_spltMltSingle = \betstr\split_decode_split($bet);
var_dump($bet);
echo $bet."\r\n";
//ob_end_clean();
echo json_encodex($bet_str_arr_clr_spltMltSingle);
\log23::fmtChkUnitest(__METHOD__, $bet, $bet_str_arr_clr_spltMltSingle);



 
