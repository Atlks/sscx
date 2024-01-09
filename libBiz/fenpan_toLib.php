<?php



  //  _test212434();

function _test212434() {


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


  $rows = rdmRcds_ssc(5);


//  $rows=[
//    ["betNoAmt"=>"大","Bet"=>1],
//    ["betNoAmt"=>"大","Bet"=>5],
//    ["betNoAmt"=>"小","Bet"=>1]
//  ];
//  //select bettype,cont()，sum(bet)  from xxx grpby bettype
//  $rows = grpby($rows, "betNoAmt",
//    function ($coll, $grpbyColVal) {
//      return ["betNoAmt" => $grpbyColVal,
//        "cnt" => count($coll),
//        "sum" => array_sum_col("Bet", $coll)
//      ];
//    }
//
//  );
  print_r($rows);
}





// 融合托的数据和数据库数据
//todo
//  isEmpty	是否为空
//$a_tp_coll.toArray	转换为数组
function arr_merg_ssc($a, $a_tp_coll) {

  // $a=$a;
  foreach ($a_tp_coll as $k => $v) {
    try {
    //  var_dump( ($v) );
   //   var_dump(json_encodex($v) );
      $tmp = [];
      $tmp['betNoAmt'] = $v['betNoAmt'];
      $tmp['Bet'] = $v['Bet'];
      $tmp['UserName'] = '私聊玩家';
        //$v['UserName'];
      $tmp['UserId'] = showLastChs($v['UserId'],4);
      //  、、$v['UserId'];
     // $a = array_merge($a, $tmp);
      array_push($a,$tmp);
    } catch (\Throwable $e) {
    }

  }

  return $a;
}

/**随机获取托数据
 * @param $num
 * @return mixed
 */
function rdmRcds_ssc($num) {

  $rdmNmbr = rand($GLOBALS['to_amt_min'], $GLOBALS['to_amt_max']);
// $records = rdmRcds(/$rdmNmbr);

  $records = \think\facade\Db::query("select * from bet_record_to ORDER BY RAND() limit $rdmNmbr");


  for ($i = 0; $i < count($records); $i++) {
    // foreach ($records as $k => &$v) {
    $v =& $records[$i];
    try {
      $v['UserName']="私聊玩家";
      $v['UserId']=showLastChs($v['UserId'],4);
      $v['betNoAmt'] = explode(" ", $v['BetContent'])[0];

      $txt=$v['BetContent'];
      $txt=str_replace("极","", $txt);
      $txt=strtolower($txt);
      if(startWithArrchar($txt,"abcde"))
      {
        //特码球
        $v['betNoAmt']=str_delLastNum($v['BetContent'] ) ;
        continue;
      }
      if(  mb_strstr($txt,"单") )
       $v['BetContent']="总和单".$v['Bet']/100;
     else if(  mb_strstr($txt,"双") )
        $v['BetContent']="总和双".$v['Bet']/100;

     else  if(  mb_strstr($txt,"大") )
        $v['BetContent']="总和大".$v['Bet']/100;
     else  if(  mb_strstr($txt,"小") )
        $v['BetContent']="总和小".$v['Bet']/100;

     else  if(  mb_strstr($txt,"和") )
        $v['BetContent']="和".$v['Bet']/100;


      $v['betNoAmt']=str_delLastNumV2($v['BetContent'],$v['BetContent']) ;


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




//function rdmRcds($num) {
//
//
//  return $rows;
//
//}