<?php
//
//namespace echox_dep;
//
//
////function getBetContxEcHo($bet_str)
////{
////    require_once __DIR__."/lotrySscV2.php";
////    $rzt =  $bet_str;
////    \think\facade\Log::debug(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
////    // \think\facade\Log::betnotice ("at file:". __FILE__ . ":" . __LINE__ );
////    $wanfa = getWefa($bet_str);
////    if ($wanfa == "特码球玩法" || $wanfa == "特码球大小单双玩法") {
////        $rzt = getBetContxEcHo_temacyo($bet_str);
////    } else if (startsWith($wanfa, "前后三玩法")) {
////        $rzt = str_delNum($bet_str);
////        $rzt = cyehose_bet_fullname($bet_str);
////    } else{
////        $rzt =  $bet_str;
////    }
////
////    \think\facade\Log::debug($rzt);
////    return   $rzt;
////}
//
//function cyehose_bet_fullname($betnum)
//{
//    \think\facade\Log::debug(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
//    $betnum = str_replace("前", "前三", $betnum);
//    $betnum = str_replace("后", "后三", $betnum);
//    $betnum = str_replace("中", "中三", $betnum);
//    $betnum = str_replace("豹", "豹子", $betnum);
//    $betnum = str_replace("对", "对子", $betnum);
//    $betnum = str_replace("顺", "顺子", $betnum);
//    $betnum = str_replace("半", "半顺子", $betnum);
//    $betnum = str_replace("杂", "杂六", $betnum);
//    return $betnum;
//}
//
//
//function getBetContxEcHo_temacyo_abcFmt($bet_str)
//{
//    if (isset($GLOBALS['loggerFun'])) {
//        $GLOBALS['loggerFun'](__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
//    }
//
//    var_dumpx($bet_str);
//    if (strstr($bet_str, '/'))
//        $cyo_arr = explode("/", $bet_str);
//    else
//        $cyo_arr =  Str_splitX($bet_str);  //a 大 100
//    // var_dump( $cyo_arr );
//    $cyo_idex = $cyo_arr[0];
//    $glb['$tozhu_arr'] = $cyo_arr;
//    $glb['$cyo_idex'] = $cyo_idex;
//    var_dumpx($glb);
//
//    $cyoName_arr = ['A', 'b', 'c', 'd', 'e'];
//    var_dumpx($cyo_idex);
//    //  $cyoName = $cyoName_arr[$cyo_idex - 1];
//    $cyo_num = $cyo_arr[1];
//
//    $cyo_num_rply = "数字" . $cyo_num;
//    if (!is_numeric($cyo_num))
//        $cyo_num_rply = $cyo_num;   //大小单双
//
//
//    $cyoName = $cyo_arr[0];
//    $money = GetAmt_frmBetStr($bet_str);
//    return     $cyoName . "球" . $cyo_num_rply . "  " .  $money  . ".00";
//}
//
//// php app/common/lotrySsc.php
////var_dump(getBetContxEcHo_temacyo("a/1/200"));
////var_dump(getBetContxEcHo_temacyo("a/大/200"));var_dump(getBetContxEcHo_temacyo("a小200"));
//function getBetContxEcHo_temacyo($bet_str)
//{
//    if (isset($GLOBALS['loggerFun'])) {
//        $GLOBALS['loggerFun'](__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
//    }
//
//    $bet_str = trim($bet_str);
//
//    if (!preg_match("/^\d.*/iu", $bet_str))
//        return getBetContxEcHo_temacyo_abcFmt($bet_str);
//
//    var_dumpx($bet_str);
//    $cyo_arr = explode("/", $bet_str);
//    var_dump($cyo_arr);
//    $cyo_idex = $cyo_arr[0];
//    $glb['$tozhu_arr'] = $cyo_arr;
//    $glb['$cyo_idex'] = $cyo_idex;
//    var_dumpx($glb);
//
//    $cyoName_arr = ['A', 'b', 'c', 'd', 'e'];
//    var_dumpx($cyo_idex);
//    $cyoName = $cyoName_arr[$cyo_idex - 1];
//    $cyo_num = $cyo_arr[1];
//
//    $cyo_num_rply = "数字" . $cyo_num;
//    if (!is_numeric($cyo_num))
//        $cyo_num_rply = $cyo_num;   //大小单双
//
//    return     $cyoName . "球" . $cyo_num_rply . "  " . $cyo_arr[2] . ".00";
//}
//
//
