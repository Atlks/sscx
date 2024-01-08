<?php

use app\common\Player;


//require_once __DIR__ . "/../lib/arr.php";
require_once __DIR__ . "/../libBiz/zautoload.php";


//var_dump(__t739());;

function __t739() {


  $txt = "大单";
  $rzt = mb_strstr($txt, "单");
  if ($rzt)
    echo 111;
  require __DIR__ . '/../vendor/autoload.php';
  $GLOBALS['qihao'] = 221634;
  require_once __DIR__ . "/../libBiz/zautoload.php";
  require_once __DIR__ . "/../appSSC/fenpan.php";

// 应用初始化
  $console = (new \think\App())->console;
//$console->$catchExceptions=false;
  $console->call("calltpx");
 // $GLOBALS['特码球数字玩法_单球配额'] = 30000;

  $rows_shuzi = \think\Facade\Db::query("select * from setting where name='特码球数字玩法_单球配额' limit 1 ");
    $GLOBALS['特码球数字玩法_单球配额']=$rows_shuzi[0]['value'];
  $rows_dxds = \think\Facade\Db::query("select * from setting where name='特码球大小单双玩法_单球配额' limit 1 ");
    $GLOBALS['特码球大小单双玩法_单球配额']=$rows_dxds[0]['value'];


  $data = ['Tg_Id' => 879006550, 'FullName' => "", 'Test' => "", 'Balance' => 999999, 'BlockBetAmount' => 0, 'Total_Payouts' => 0];

  $playr = new Player($data);
  $qihao = 1802833500;

//  $uid=879006550;
//  $bet_str_arr_clr_spltMltSingle=['a/大/100'];
//  $ctrl=new app\common\Game2handlrLogic($uid);
//  $ctrl->lottery_no=18028335;
//  $rows524 = $ctrl->chkBallLmtBfBet_getSumBet($bet_str_arr_clr_spltMltSingle);

  // $rows524=
  $rows524 = $playr->getFrmBetRecordWhrUidStatLtrno($qihao);


  $rows524 = getSumBetFrmBetlogGrpbyWanfNcyo($rows524, ['a/1/10000','a/大/300000']);
// array_where($rows524, "玩法", "特码球大小单双玩法");
  foreach ($rows524 as $r) {
    if (strstr($r['玩法'], "特码球数字玩法")) {
      if ($r['sum'] > $GLOBALS['特码球数字玩法_单球配额'])
        return "超出单球投注限制" . $GLOBALS['特码球数字玩法_单球配额'] . ",  " . $r['wefaNcyo'];

    }else if (strstr($r['玩法'], "特码球大小单双玩法")) {
      if ($r['sum'] > $GLOBALS['特码球大小单双玩法_单球配额'])
        return "超出单球投注限制" . $GLOBALS['特码球大小单双玩法_单球配额'] . ",  " . $r['wefaNcyo'];

    }
  }


}


/** 计算单球总和  grpby  玩法_qiuqiu
 * @param array $bet_str_arr_clr_spltMltSingle
 * @return array
 */
function getSumBetFrmBetlogGrpbyWanfNcyo($rows524, array $bet_str_arr_clr_spltMltSingle): array {

  $rows524 = array_toStndMode($rows524, function ($row) {
    $t = [];
    $t['Bet'] = $row['Bet'] / 100;
    $t['BetContent'] = $row['BetContent'];
    return $t;
  });
  $rows524 = array_merge($rows524, toStndBetRcd($bet_str_arr_clr_spltMltSingle));
//  $rows524 = getSumBetFrmBetlogGrpbyWanfNcyo_part2($rows524);
  ///**
// * @param $rows524
// * @return array
// */
//function getSumBetFrmBetlogGrpbyWanfNcyo_part2($rows524): array {


  //where 特码球 玩法
  $rows524 = array_filterx($rows524, function ($row) {
    if (startWithArrchar($row['BetContent'], "abcde"))
      return true;
  });
  $rows524 = array_map(function ($row) {
    $row['球'] = explode("/", $row['BetContent'])[0];
    if (isStrContainArr($row['BetContent'], "大小单双"))
      $row['玩法'] = "特码球大小单双玩法";
    else
      $row['玩法'] = "特码球数字玩法";

    $row['球球与玩法'] = $row['球'] . "__" . $row['玩法'];
    return $row;

  }, $rows524);

  $rows524 = grpbyV2($rows524, ['球', '玩法'], function ($coll, $grpbyColVal) {
    return ["wefaNcyo" => $grpbyColVal, '玩法' => $grpbyColVal,
      "sum" => array_sum_col("Bet", $coll)
    ];
  });
  return $rows524;
}


function toStndBetRcd($bet_str_arr_clr_spltMltSingle) {
  $a = array_map(function ($betstr) {
    $t = [];
    // $money = GetAmt_frmBetStr($betstr);
    $t['Bet'] = str_getAmt_frmBetStr($betstr);
    $t['BetContent'] = $betstr;
    return $t;

  }, $bet_str_arr_clr_spltMltSingle);
  return $a;
}
