<?php

namespace strspc;

//  php   lib/strx.phjp

//var_dump(http_parse_str("a=1&b=2")) ;

// http query to arr
function http_parse_str($str)
{
    //http build query
    parse_str($str, $arr);
    return $arr;
}

function clrSpace($content)
{
    $content = str_replace(" ", " ", $content);
    $content = str_replace(" ", " ", $content);
    $content = str_replace(" ", " ", $content);
    $content = str_replace('\u00a0', " ", $content);
    $content = str_replace("\\u00a0", "", $content);

    require_once __DIR__ . "/../../lib/logx.php";
    $content = str_replace(chr(194) . chr(160), ' ', $content);
    //  \libspc\log_info("251_614", "bet_str_arr", $content);


    $bet_str_arr = explode(" ", $content);
    return $content;
}
function convtCnSpace($content)
{
    $content = str_replace(" ", " ", $content);
    $content = str_replace(" ", " ", $content);
    $content = str_replace(" ", " ", $content);
    $content = str_replace('\u00a0', " ", $content);
    $content = str_replace("\\u00a0", "", $content);

    // require_once __DIR__ . "/../../lib/logx.php";
    $content = str_replace(chr(194) . chr(160), ' ', $content);
    //  \libspc\log_info("251_614", "bet_str_arr", $content);



    return  $content;
}

function spltBySpace($content)
{
    $content = str_replace(" ", " ", $content);
    $content = str_replace(" ", " ", $content);
    $content = str_replace(" ", " ", $content);
    $content = str_replace('\u00a0', " ", $content);
    $content = str_replace("\\u00a0", "", $content);

    // require_once __DIR__ . "/../../lib/logx.php";
    $content = str_replace(chr(194) . chr(160), ' ', $content);
    //  \libspc\log_info("251_614", "bet_str_arr", $content);


    $bet_str_arr = explode(" ", $content);
    $bet_str_arr_clr = array_filter($bet_str_arr);
    return $bet_str_arr_clr;
}

function getfirstchar($s0)
{

    $GLOBALS['getfirstchar_curchar'] = $s0;
    $fchar = ord($s0[0]);
    if ($fchar >= ord("A") and $fchar <= ord("z")) return strtoupper($s0[0]);

    if(is_numeric($s0))
        return $s0;
 if($s0==".")
     return $s0;
    $asc  = $s0;
    if (mb_strstr("半豹", $asc)) return "b";
    if (mb_strstr("大单对", $asc)) return "d";
    if (mb_strstr("小", $asc)) return "x";
    if (mb_strstr("龙六", $asc)) return "l";
    if (mb_strstr("玩", $asc)) return "w";
    if (mb_strstr("法", $asc)) return "f";
    if (mb_strstr("码模", $asc)) return "M";
    if (mb_strstr("球前", $asc)) return "q";
    if (mb_strstr("组值中子杂", $asc)) return "z";
    if (mb_strstr("和合虎后", $asc)) return "h";
    if (mb_strstr("式是双顺三", $asc)) return "s";

    if (strlen(mb_strstr("特", $asc)) > 0) return "T";


    if (mb_strstr("这", $asc)) return "z";

    return null;
}


//支持中文的splt ,,ori splt only eng
function str_splitX2($str)
{
    //support chinese char,,,,  str_split not spt chins char
    return  preg_split('/(?<!^)(?!$)/u', $str);
}
function pinyin1($zh)
{

    $GLOBALS['pinyin1_curstr'] = $zh;

    $ret = "";
    $arr = str_splitX2($zh);

    foreach ($arr as $char748) {

        $ret .= getfirstchar($char748);
    }
    $ret = strtolower($ret);
    return $ret;
}
//echo "这是中文字符串<br/>";
//echo pinyin1('这是中文字符串abc');
//var_dump(strlen ( mb_strstr( "特码球玩法abc组合模式","特"))) ;
//  php  lib/strx.php
//var_dump(getfirstchar("特"));
//var_dump(pinyin1("特"));

//var_dump(pinyin1("码"));

//var_dump(pinyin1("特码球玩法abc组合模式"));
