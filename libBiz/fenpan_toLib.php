<?php



 // _test754();

function _test754() {


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


  $rows=rdmRcds_ssc(5);
  print_r($rows);
}




//
//require_once __DIR__ . "/../lib/sys1011.php";
//require_once __DIR__ . "/../lib/logx.php";
//require_once __DIR__ . "/../lib/dsl.php";
function arr_merg_ssc($a, $a_tp_coll) {

  // $a=$a;
  foreach ($a_tp_coll as $k => $v) {
    try {
      $tmp = [];
      $tmp['betNoAmt'] = $v['betNoAmt'];
      $tmp['Bet'] = $v['Bet'];
      $tmp['UserName'] = $v['UserName'];
      $tmp['UserId'] = $v['UserId'];
     // $a = array_merge($a, $tmp);
      array_push($a,$tmp);
    } catch (\Throwable $e) {
    }

  }

  return $a;
}

function rdmRcds_ssc($num) {

  $records = rdmRcds($GLOBALS['to_amt'] );
  for ($i = 0; $i < count($records); $i++) {
    // foreach ($records as $k => &$v) {
    $v =& $records[$i];
    try {
      $v['UserName']="私聊玩家";
      $v['UserId']=showLastChs($v['UserId'],4);
      $v['betNoAmt'] = explode(" ", $v['BetContent'])[0];

      $txt=$v['BetContent'];
     if(  mb_strstr($txt,"单") )
       $v['BetContent']="单";
      if(  mb_strstr($txt,"双") )
        $v['BetContent']="双";
      if(  mb_strstr($txt,"和") )
        $v['BetContent']="和";

      $v['betNoAmt']=$v['BetContent'];


    } catch (\Throwable $e) {
      $v['betNoAmt'] = "大";
    }





//    print_r($v['betNoAmt']);
//    print_r($v['Bet']);
//    print_r($v['UserName']);
//    print_r($v['UserId']);
  }
  return $records;

}




function rdmRcds($num) {

  $rows = \think\Facade\Db::query("select * from bet_record_to ORDER BY RAND() limit $num");

  return $rows;

}