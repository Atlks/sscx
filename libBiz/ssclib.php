<?php

//ssc fun lib

//_test205745();

function _test205745() {

  $GLOBALS['mainlg']='mainlg';
  $txt="大单";
  $rzt= mb_strstr($txt,"单");
  if($rzt)
    echo 111;
  require __DIR__ . '/../vendor/autoload.php';
  $GLOBALS['qihao']=221634;
  require_once __DIR__ . "/../libBiz/zautoload.php";
  require_once __DIR__ . "/../appSSC/fenpan.php";

// 应用初始化
  $console = (new \think\App())->console;
// $console->catchExceptions=false;
  $console->call("calltpx");

  readBetTypesCfg744();
  $odds = getOddsFrmGlbdt("特码球玩法", $GLOBALS['bet_types734']);


//  $rows=rdmRcds_ssc(5);
  print_r($odds);
}

function readBetTypesCfg744() {
  log_enterMethV2(__METHOD__,func_get_args(),$GLOBALS['mainlg']);

  try {
    $sql = "select * from bet_types ORDER BY RAND()  ";
    logV3(__METHOD__,$sql,"mainlg");
    $rows = \think\facade\Db::query($sql);
    foreach ($rows as $r)
    {

    }
    $GLOBALS['bet_types734'] = $rows;
  } catch (Throwable $e) {
    log_errV2($e,__METHOD__);
  }

//  $rows_shuzi = \think\facade\Db::query("select * from setting where name='特码球数字玩法_单球配额' limit 1 ");
//  $GLOBALS['特码球数字玩法_单球配额']=$rows_shuzi[0]['value'];
//  $rows_dxds = \think\facade\Db::query("select * from setting where name='特码球大小单双玩法_单球配额' limit 1 ");
//  $GLOBALS['特码球大小单双玩法_单球配额']=$rows_dxds[0]['value'];


}




/**
 * @param string $bettype_wefa
 * @return mixed
 */
function getOddsFrmGlbdt(string $bettype_wefa) {
  try{
    $rows = $GLOBALS['bet_types734'];
    $row_slkted = array_filterx($rows, function ($row) use ($bettype_wefa) {


      if ($row['玩法'] == $bettype_wefa)
        return true;
    });
    $odds = $row_slkted[0]['Odds'];
    return $odds;
  }catch (\Throwable $e)
  {
    log_errV2($e,__METHOD__);
    return  1.98;
  }

}



//function rdmRcds($num) {
//
//  $rows = \think\Facade\Db::query("select * from bet_record_to ORDER BY RAND() limit $num");
//
//  return $rows;
//
//}