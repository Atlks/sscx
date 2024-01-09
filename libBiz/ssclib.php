<?php




/**
 * @param string $bettype_wefa
 * @return mixed
 */
function getOddsFrmGlbdt(string $bettype_wefa) {
  try{
    $rows = $GLOBALS['bet_types'];
    $row_slkted = array_filterx($rows, function ($row) use ($bettype_wefa) {


      if ($row['玩法'] == $bettype_wefa)
        return true;
    });
    $odds = $row_slkted[0]['Odds'];
    return $odds;
  }catch (\Throwable $e)
  {
    return  1.98;
  }

}

 // _test754();

function _test205() {


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
//$console->$catchExceptions=false;
  $console->call("calltpx");


  $rows = \think\facade\Db::query("select * from bet_types ORDER BY RAND()  ");

//  $rows=rdmRcds_ssc(5);
  print_r($rows);
}

//function rdmRcds($num) {
//
//  $rows = \think\Facade\Db::query("select * from bet_record_to ORDER BY RAND() limit $num");
//
//  return $rows;
//
//}