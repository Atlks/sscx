<?php
$a = 1;
$aa = 2;
$aa2 = 222;

require_once __DIR__ . "/dbg_consl.php";
function f1($prm_trson_into_fun)
{
    $varInFun = 99;


    $varInFun = 100;
    breakStopHere(__METHOD__,func_get_args(), __LINE__, get_defined_vars(),__FILE__);
    echo $prm_trson_into_fun;
}

f1(664);
