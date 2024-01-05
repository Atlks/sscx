<?php

namespace app\common;

use function ltrspltr\mltBet_msghdl;
use function ltrspltr\msgHdlr;
require_once __DIR__ . "/../../app/common/betstr.php";
require __DIR__ . "/../../lib/iniAutoload.php";
require_once __DIR__."/../../lib/str.php";
 
require_once __DIR__."/../../config/cfg.php";

// a123.200

//$rzt717= lotrySpltrCls::msgHdlr("12345");
//$rzt717= lotrySpltrCls::msgHdlr("a1234.200");
//$rzt717= lotrySpltrCls::msgHdlr("1.1.100 1.单.100");
//$rzt717= lotrySpltrCls::msgHdlr("abc1.200");
 //$rzt717= lotrySpltrCls::msgHdlr("a8.200");

//$rzt717= lotrySpltrCls::msgHdlr("a123操200");
//$rzt717= lotrySpltrCls::msgHdlr("a大小单双.100");
//
////$rzt717= lotrySpltrCls::tmqwfabc1200zhms("abc1.200");
//$rzt717=1;
class lotrySpltrCls
{

    //abc1.200 mode    tmqwf_abc1_200_zhms_msghdl





//可以抓取 stand bet ,,and fuza bet ....if mlt bet ,,cant
    static function msgHdlr($bet_str)
    {
                return  \betstr\split_decode_splitx($bet_str);

    }

    static function mltBet_msghdl($betstr)
    {
        return  \betstr\mltBet_msghdl($betstr);
    }
//\xdebug_start_code_coverage();

//var_dump(tmqwfabczhms_msghdl(" abc大100"));
//var_dump(tmqwfabczhms_msghdl(" abc小100"));

//var_dump(\xdebug_get_code_coverage());
//特码求abc模式    abc大100   abc大100


    /**
     * depx
     * @param $betstr
     * @return false|int
     */


//    function msgHdlr22($bet_str_arr_clr)
//    {
//        //   var_dump( $bet_str_arr_clr);
//        $a = [];
//        foreach ($bet_str_arr_clr as $betstr) {
//
//            $bet_wefa =    GetWefa($betstr);
//            if ($bet_wefa == '特码球玩法组合模式') {
//                $tmp =  spltSingleArrFrmTemacyoZuheMod($betstr);
//                //  var_dump( $tmp);
//                $a =   array_merge($a, $tmp);
//            } else
//                $a[] = $betstr;
//        }
//        return $a;
//    }


//    static  function tmqwfzhms_msghdl_dep($betstr)
//    {
//        $a = [];
//        $cyoNam = str_split($betstr)[0];
//
//        $ya_pos = self::getYa_pos($betstr);
//        //  var_dump( $ya_pos );
//        $strlen525 = mb_strlen($betstr);
//        //  var_dump(mb_strlen($betstr));  //9 is ok...  a123呀100 len is 8 also ok
//
//        //  var_dump("yapos is :$ya_pos strlen is:$strlen525 " );
//        $sublen = mb_strlen($betstr) - $ya_pos;
//        //   var_dump(" sublen:$sublen");
//        $bet_nums = mb_substr($betstr, 1, $ya_pos - 1);
//        //   var_dump($bet_nums );
//        $betNumaArr = str_split($bet_nums);
//        foreach ($betNumaArr as $betnum) {
//
//            $a[] = $cyoNam . "/" . $betnum . "/" . \ltrx::getAmt_frmBetStr($betstr);
//        }
//
//        //chick chongfu
//
//        if (count($a) != count(array_unique($a))) {
//            // echo '该数组有重复值';
//
//            \libspc\log_info_tp("投注内容拆分计算结果:",$a,__METHOD__,"betnotice");
//            throw    new \Exception('000000816123,bet_txt_dulip,投注内容有重复');
//        }
//
//        return $a;
//    }
//

}