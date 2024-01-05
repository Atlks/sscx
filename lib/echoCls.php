<?php

require __DIR__ . "/iniAutoload.php";
//var_dump( __DIR__."/lotryEcho.php");


//var_dump(\echoCls::getBetContxEcHo("a123押100"));
 //var_dump(\echoCls::getBetContxEcHo("大100"));
//var_dump(\echoCls::getBetContxEcHo("a大100"));
//var_dump(\echoCls::getBetContxEcHo("abc单100"));
//$rzt1140=\echoCls::getBetContxEcHo("a/1/1");
//$rzt1140=\echoCls::getBetContxEcHo("前豹100");

$rzt1140=1;
class echoCls
{


//    static function  hzdxdsms_msghdl($bet_str){
//
//        $bet_nomoney = str_delNum($bet_str);
//        $money = GetAmt_frmBetStr($bet_str);
//     return "总和".   $bet_nomoney   . "  $money.00";
//    }




   // static function
    //   \betstr\getWefa($bet_str);
    //  if (startsWith($wanfa, "龙虎和玩法")) {

    //和龙湖 echo


    // if (startsWith($wanfa, "前后三玩法")) {
//            $rzt_true = str_delNum($bet_str);
//            $rzt_fullname =\betstr\format_echo_cyehose($rzt_true);
//            \log23::debug4echo(__METHOD__," rzt", $rzt );
//          //  return    $rzt;
//            $money = GetAmt_frmBetStr($bet_str);
//            return    $rzt_fullname." ". $money."";
//
    //  } else

//    function cyehose_bet_fullname($betnum)
//    {
//        \think\facade\Log::debug(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
//        $betnum = str_replace("前", "前三", $betnum);
//        $betnum = str_replace("后", "后三", $betnum);
//        $betnum = str_replace("中", "中三", $betnum);
//        $betnum = str_replace("豹", "豹子", $betnum);
//        $betnum = str_replace("对", "对子", $betnum);
//        $betnum = str_replace("顺", "顺子", $betnum);
//        $betnum = str_replace("半", "半顺子", $betnum);
//        $betnum = str_replace("杂", "杂六", $betnum);
//        return $betnum;
//    }

// not use dep


    function getBetContxEcHo_temacyo_abcFmt($bet_str)
    {
        if (isset($GLOBALS['loggerFun'])) {
            $GLOBALS['loggerFun'](__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
        }

        var_dumpx120($bet_str);
        if (strstr($bet_str, '/'))
            $cyo_arr = explode("/", $bet_str);
        else
            $cyo_arr =  Str_splitX($bet_str);  //a 大 100
        // var_dump( $cyo_arr );
        $cyo_idex = $cyo_arr[0];
        $glb['$tozhu_arr'] = $cyo_arr;
        $glb['$cyo_idex'] = $cyo_idex;
        var_dumpx120($glb);

        $cyoName_arr = ['A', 'b', 'c', 'd', 'e'];
        var_dumpx120($cyo_idex);
        //  $cyoName = $cyoName_arr[$cyo_idex - 1];
        $cyo_num = $cyo_arr[1];

        $cyo_num_rply = "数字" . $cyo_num;
        if (!is_numeric($cyo_num))
            $cyo_num_rply = $cyo_num;   //大小单双


        $cyoName = $cyo_arr[0];
        $money = getAmt_frmBetStr340($bet_str);
        return     $cyoName . "球" . $cyo_num_rply . "  " .  $money  . ".00";
    }




    // php app/common/lotrySsc.php
    //var_dump(getBetContxEcHo_temacyo("a/1/200"));
    //var_dump(getBetContxEcHo_temacyo("a/大/200"));var_dump(getBetContxEcHo_temacyo("a小200"));
    // not use dep
//    function getBetContxEcHo_temacyo($bet_str)
//    {
//        if (isset($GLOBALS['loggerFun'])) {
//            $GLOBALS['loggerFun'](__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
//        }
//
//        $bet_str = trim($bet_str);
//
//        if (!preg_match("/^\d.*/iu", $bet_str))
//            return getBetContxEcHo_temacyo_abcFmt($bet_str);
//
//        var_dumpx($bet_str);
//        $cyo_arr = explode("/", $bet_str);
//        var_dump($cyo_arr);
//        $cyo_idex = $cyo_arr[0];
//        $glb['$tozhu_arr'] = $cyo_arr;
//        $glb['$cyo_idex'] = $cyo_idex;
//        var_dumpx($glb);
//
//        $cyoName_arr = ['A', 'b', 'c', 'd', 'e'];
//        var_dumpx($cyo_idex);
//        $cyoName = $cyoName_arr[$cyo_idex - 1];
//        $cyo_num = $cyo_arr[1];
//
//        $cyo_num_rply = "数字" . $cyo_num;
//        if (!is_numeric($cyo_num))
//            $cyo_num_rply = $cyo_num;   //大小单双
//
//        return     $cyoName . "球" . $cyo_num_rply . "  " . $cyo_arr[2] . ".00";
//    }
}
