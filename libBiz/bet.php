<?php

use app\common\Player;


//require_once __DIR__ . "/../lib/arr.php";
require_once __DIR__ . "/../libBiz/zautoload.php";

//var_dump(__t739539_ctrlrmode());;//c trlr
//  var_dump(__t739());;

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

  $rows_shuzi = \think\facade\Db::query("select * from setting where name='特码球数字玩法_单球配额' limit 1 ");
  $GLOBALS['特码球数字玩法_单球配额'] = $rows_shuzi[0]['value'];
  $rows_dxds = \think\facade\Db::query("select * from setting where name='特码球大小单双玩法_单球配额' limit 1 ");
  $GLOBALS['特码球大小单双玩法_单球配额'] = $rows_dxds[0]['value'];


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


  $rows524 = getSumBetFrmBetlogGrpbyAqiuDa($rows524, ['a/1/200', 'a/1/10000', 'a/小/30000', 'a/单/30000']);
  print_r($rows524);
  log_Vardump(__METHOD__, "rowL53", $rows524, "");
  // array_where($rows524, "玩法", "特码球大小单双玩法");
  foreach ($rows524 as $r) {
    if (strstr($r['玩法'], "特码球数字玩法")) {
      if ($r['sum'] > $GLOBALS['特码球数字玩法_单球配额'])
        return "超出单球投注限制" . $GLOBALS['特码球数字玩法_单球配额'] . ",  " . $r['球-号码'];

    } else if (strstr($r['玩法'], "特码球大小单双玩法")) {
      if ($r['sum'] > $GLOBALS['特码球大小单双玩法_单球配额'])
        return "超出单球投注限制" . $GLOBALS['特码球大小单双玩法_单球配额'] . ",  " . $r['球-号码'];

    }
  }


}

//c trlr
function __t739539_ctrlrmode() {


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

  $rows_shuzi = \think\facade\Db::query("select * from setting where name='特码球数字玩法_单球配额' limit 1 ");
  $GLOBALS['特码球数字玩法_单球配额'] = $rows_shuzi[0]['value'];
  $rows_dxds = \think\facade\Db::query("select * from setting where name='特码球大小单双玩法_单球配额' limit 1 ");
  $GLOBALS['特码球大小单双玩法_单球配额'] = $rows_dxds[0]['value'];


  $data = ['Tg_Id' => 879006550, 'FullName' => "", 'Test' => "", 'Balance' => 999999, 'BlockBetAmount' => 0, 'Total_Payouts' => 0];

  $playr = new Player($data);
  $qihao = 1802833500;

  $uid = 879006550;
  $bet_str_arr_clr_spltMltSingle = ['a/大/100', 'a/小/100', 'a/大/30000'];
  $ctrl = new app\common\Game2handlrLogic($uid);
  $ctrl->lottery_no = 18028335;
  list($tmq_numLmt, $dxdsLimt, $rows524) = getSumbetFrm_BtlgTblNinptRws_GrpbyAqiuDa_prmMlt($playr, $qihao, $bet_str_arr_clr_spltMltSingle);

  print_r($rows524);
  log_Vardump(__METHOD__, "rowsL107", $rows524, "chkbf816");
  // array_where($rows524, "玩法", "特码球大小单双玩法");
  foreach ($rows524 as $r) {
    if (strstr($r['玩法'], "特码球数字玩法")) {
      if ($r['sum'] > $tmq_numLmt)
        return "超出单球投注限制" . $tmq_numLmt . ",  " . $r['球-号码'];

    } else if (strstr($r['玩法'], "特码球大小单双玩法")) {
      if ($r['sum'] > $dxdsLimt)
        return "超出单球投注限制" . $dxdsLimt . ",  " . $r['球-号码'];

    }
  }


}


/**
 * @param array $bet_str_arr_clr_spltMltSingle
 * @return array
 */
function getSumbetFrm_BtlgTblNinptRws_GrpbyAqiuDa_prmMlt($plyrObj, $lottery_no, array $bet_str_arr_clr_spltMltSingle): array {
  //log_enterMethV2(__METHOD__,);
  log_enterMethV2(__METHOD__, func_get_args(), $GLOBALS['btlg']);

  $rows_shuzi = \think\facade\Db::query("select * from setting where name='特码球数字玩法_单球配额' limit 1 ");
  $tmq_numLmt = $rows_shuzi[0]['value'];
  $rows_dxds = \think\facade\Db::query("select * from setting where name='特码球大小单双玩法_单球配额' limit 1 ");
  $dxdsLimt = $rows_dxds[0]['value'];
  $GLOBALS['特码球大小单双玩法_单球配额'] = $rows_dxds[0]['value'];
  require_once __DIR__ . "/../libBiz/zautoload.php";
  require_once __DIR__ . "/../libBiz/bet.php";
  $rows524 = $plyrObj->getFrmBetRecordWhrUidStatLtrno($lottery_no);
  $rows524 = arr_mgr_dbarrNbetstrArr($rows524, $bet_str_arr_clr_spltMltSingle);

  $rows524 = getSumBetFrmBetlogGrpbyAqiuDa($rows524);
  $array = array($tmq_numLmt, $dxdsLimt, $rows524);
   log_vardumpRetval(__METHOD__,$array,'btlg');
  return $array;
}

/** 计算单球总和  grpby  玩法_qiuqiu
 * @param array $bet_str_arr_clr_spltMltSingle
 * @return array
 */
function getSumBetFrmBetlogGrpbyAqiuDa($rows524): array {

  log_enterMethV2(__METHOD__, func_get_args(), $GLOBALS['btlg']);

 // print_r($rows524);
  //where 特码球 玩法
  $rows524 = array_filterx($rows524, function ($row) {
    if (startWithArrchar($row['BetContent'], "abcde"))
      return true;
  });
  print_r($rows524);
  $rows524 = array_map(function ($row) {
    $row['球'] = explode("/", $row['BetContent'])[0];
    $row['号码'] = explode("/", $row['BetContent'])[1];
    $row['球-号码'] = $row['球'] . '球' . $row['号码'];
    if (isStrContainArr($row['BetContent'], "大小单双"))
      $row['玩法'] = "特码球大小单双玩法";
    else
      $row['玩法'] = "特码球数字玩法";

    //  $row['球球与玩法'] = $row['球'] . "__" . $row['玩法'];
    return $row;

  }, $rows524);
  print_r($rows524);
  $rows524 = grpbyV3($rows524, ['球', '号码'], function ($coll, $grpbyColVal) {
    return ["wefaNcyo" => $grpbyColVal,
      '玩法' => $coll[0]['玩法'],
      '球-号码' => $coll[0]['球-号码'],
      "sum" => array_sum_col("Bet", $coll)
    ];
  });
  // log_Vardump(__METHOD__,"rowsL175",$rows524,"chkbf816");
  log_vardumpRetval(__METHOD__, $rows524, "chkbf816");
  log_vardumpRetval(__METHOD__, $rows524, "btlg");
  return $rows524;
}

/**
 * @param $rows524
 * @param array $bet_str_arr_clr_spltMltSingle
 * @return mixed
 */
function arr_mgr_dbarrNbetstrArr($rows524, array $bet_str_arr_clr_spltMltSingle) {

  log_enterMethV2(__METHOD__, func_get_args(), $GLOBALS['btlg']);

  $rows524 = array_toStndMode($rows524, function ($row) {
    $t = [];
    $t['Bet'] = $row['Bet'] / 100;
    $t['BetContent'] = strtolower($row['BetContent']);
    return $t;
  });
  $rows524 = array_merge($rows524, toStndBetRcdArrFrmBetstrArr($bet_str_arr_clr_spltMltSingle));
  log_vardumpRetval(__METHOD__,$rows524,'btlg');

  return $rows524;
}

//todo
//  isEmpty	是否为空
//toArray	转换为数组
function toStndBetRcdArrFrmBetstrArr($bet_str_arr_clr_spltMltSingle) {
  $a = array_map(function ($betstr) {
    $t = [];
    // $money = GetAmt_frmBetStr($betstr);
    $t['Bet'] = str_getAmt_frmBetStr($betstr);
    $t['BetContent'] = $betstr;
    return $t;

  }, $bet_str_arr_clr_spltMltSingle);
  return $a;
}
