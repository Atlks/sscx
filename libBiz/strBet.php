<?php


//  b/大/30
//var_dump(format_echo_bencyiBetLst("A/1/100"));;
//var_dump(format_echo_bencyiBetLst("A/大/100"));;

/*std fmt   a/1/100 a/大/100

 *龙100，虎200，和100，
 * 总和大100
 * 前三豹子100
 */

use function betstr\getAmt_frmBetStr;

function format_echo_bencyiBetLst($bet_str) {

  $bet_str=strtolower($bet_str);
  //tmq fmt exho
  $rx_fmtFun_map=['[abcde12345]\/[0123456789大小单双]\/\d+'=>'\betstr\format_echo_tmqms'];
  //a球数字1 100
  if (preg_match('/^[abcde12345]\/[0123456789]\/\d+$/iu', $bet_str)) {
    $arr = explode("/", $bet_str);
    $cyo_num = $arr[1];
    $cyo_num_rply = "数字" . $cyo_num;
    $money = $arr[2];
    return  $arr[0] . "球" . $cyo_num_rply . " " . $money;
  }

  //show a球大 100
  if (preg_match('/^[abcde12345]\/[大小单双]\/\d+$/iu', $bet_str)) {
    $arr = explode("/", $bet_str);
    $cyo_num = $arr[1];
    $money = $arr[2];
    return  $arr[0] . "球" . $cyo_num . " " . $money;
  }


//
//  $oddsMap = ["龙" => 1.98, "虎" => 1.98, "和" => 9.5,
//    "总和大" => 1.98, "总和小" => 1.98, "总和单" => 1.98, "总和双" => 1.98,
//    "前三豹子" => 70, "中三豹子" => 70, "后三豹子" => 70,
//    "前三对子" => 3.2, "中三对子" => 3.2, "后三对子" => 3.2,
//    "前三顺子" => 12, "中三顺子" => 12, "后三顺子" => 12,
//    "前三半顺" => 2.5, "中三半顺" => 2.5, "后三半顺" => 2.5,
//    "前三杂六" => 3.2, "中三杂六" => 3.2, "后三杂六" => 3.2
//  ];

  //str_format_other 总和和值模式 龙虎和和 前后三   目前已经和回显一致了无需定制了。。
  //return  format_echo_default( $bet_str);

  $rzt_true = str_delNum($bet_str);
//  if($rzt_true=="和")
//    $rzt_true="龙虎和";
  $money = GetAmt_frmBetStr($bet_str);
  return $rzt_true . " " . $money ;
  //. " 赔率:" . map_val($oddsMap, $rzt_true);

  //  \betstr\format_echo_($bet_str);

}



?>