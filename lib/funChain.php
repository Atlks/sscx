<?php


//set_error_handler("ex_hdlr");
////register_shutdown_function('ex_hdlr');
//
//set_exception_handler('ex_hdlr');

class funChain
{

    public $curRzt;

    function __construct($fistFunRzt)
    {
        $this->curRzt = $fistFunRzt;
    }

    function __invoke($fistFunRzt)
    {

        //  $curRzt = ;
        $this->curRzt = $fistFunRzt;
        // var_dump($x);
    }

    function __call($method, array $arguments)
        //__st  __call($method, array $arguments)
    {
        $this->curRzt;
//        ob_start();
//        var_dump($method);
        var_dump($arguments);
        $f = $arguments[0];
        $this->curRzt = $f($this->curRzt);
//        // \libspc\log_to_tp($arguments[0],$arguments[1],$arguments[2],$method);
//        ob_end_clean();
//        \libspc\log_phpV2($arguments[0],$arguments[1],$arguments[2],$method);
        return $this;

    }

    function nxt($f)
    {
        var_dump($f);
        return $this;
    }


}


//$funChain = new funChain(f1(1, 2));
////$funChain->nx(f2(2222))->nx(f3());
//
//
//$funChain->nx(function ($itm) {
//    f2($itm);
//})->nx((function ($itm) {
//    f3();
//}));


function ex_hdlr($exception)
{
    //  \think\facade\Log::info (  json_encode($exception) );
    // \libspc\log_err($exception,__METHOD__,$GLOBALS['$errdir'],"err");
    var_dump($exception);
}


function f1($p, $p2)
{
    var_dump(__METHOD__);
    var_dump($p);
    var_dump($p2);
    return 1;
}

function f2($p = 2)
{
    var_dump(__METHOD__);
    var_dump($p);
    return $p;
}

function f3()
{
    var_dump(3);
}


//  chainInvk(array("f1", array(11, 22), "f2", 333, "f3"));

foreachInvk(array(1, 2), array("f1", 11, "f2"));


//对操作数组顺序调用opas。。。方便dsl展开
function foreachInvk($arr, $ops)
{

    foreach ($arr as $itm_dt) {

        foreach ($ops as $k => $f) :
            if (is_array($f))
                continue;

            if (!function_exists($f)) {
                continue;
            }
            $fun_prm = getPrm($ops, $k + 1);
            if (!is_array($fun_prm))
                $fun_prm = array($fun_prm);
            array_unshift($fun_prm,$itm_dt);
            call_user_func_array($f, $fun_prm);

        endforeach;
    }


}


// call_user_func_array()

function chainInvk($prms)
{
    foreach ($prms as $k => $f) :
        if (is_array($f))
            continue;

        if (!function_exists($f)) {
            continue;
        }


        //execFun($f,$prms,$k);
        $fun_prm = getPrm($prms, $k + 1);

        // $f($fun_prm);

        if (!is_array($fun_prm))
            $fun_prm = array($fun_prm);
        call_user_func_array($f, $fun_prm);


    endforeach;


}

function getPrm($prms, int $k_next)
{
    $fun_prm = null;

    if ($k_next >= count($prms))
        return null; //already last fun no prm

    $prmOrNextfun = $prms[$k_next];
    if (function_existsx($prmOrNextfun)) {
        return null;   //last prm is fun,,so this fun no prm
    }


    return $prmOrNextfun;

}

function function_existsx($obj)
{
    if (is_array($obj))
        return false;

    return function_exists($obj);

}

function execFun($f, $prms, int $k)
{
    if (!function_exists($f)) {
        return $f;
    }

    $fun_prm = null;

    if (count($prms) > $k + 1) {
        $fun_prm = null;
    }

    $prmOrNextfun = $prms[$k + 1];
    if (function_exists($prmOrNextfun)) {
        $prmOrNextfun = null;
    }

    // if (is_array($prmOrNextfun)
    $f($prmOrNextfun);

}




