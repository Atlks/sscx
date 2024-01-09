<?php
//  _test1112();
function  _test1112() {

  require __DIR__ . '/../vendor/autoload.php';
  require_once __DIR__ . "/../appSSC/zautoload.php";
  $GLOBALS['qihao']=221634;



// 应用初始化
  $console = (new \think\App())->console;
//$console->$catchExceptions=false;
  $console->call("calltpx");



  $betContext = "大单";//总和大100


//if 总和大小单双模式，转化为标准格式
//function convert_toStandmode_zonghe(string $betContext) {
//  return "总和"
//}
//if 总和大小单双模式，转化为标准格式
//  if (statWithx($betContext, "大小单双")) {
//    $betContext = "总和" . $betContext;
//    // $betContext=convert_toStandmode_zonghe($betContext);
//  }

  require_once __DIR__ . "/../libBiz/fenpan_toLib.php";
  $rows=rdmRcds_ssc(5);
  $GLOBALS['$rowsTo']=$rows;



  $a=[];$GLOBALS['kaij_num']=12345;
  var_dump(addToList_toDuijEchoList($a));

//var_dump(calcIncome_forTo($betContext, "12345", 100));


}

//function statWithx(string $betContext, $charArr) {
//  $str_a= str_splitX($betContext);
//  $a = str_splitX($charArr);
//  return in_array($str_a[0], $a);
//
//
//}

/**  添加拖列表到正式的列表
 * @param $a  正式列表
 * @return void
 */
function addToList_toDuijEchoList($a)
{
  log_enterMethV2(__METHOD__,func_get_args(),$GLOBALS['mainlg']);
  try{
    $rowsTo = $GLOBALS['$rowsTo'];

    foreach ($rowsTo as $r) {
      try{
        $uid = $r['UserId'];
        $uname = $r['UserName'];
        $betamt = $r['Bet'] / 100;
        $betContext = $r['BetContent'];



        $income= calcIncome_forTo($betContext, $GLOBALS['kaij_num'],$betamt);
        //
        $txt = "$uname [$uid]  下注金额:$betamt 盈亏: $income \r\n";
        // var_dump($txt);
        $a[] = $txt;
      }catch (Throwable $e)
      {
        log_errV2($e,__METHOD__);
      }

    }
    log_vardumpRetval(__METHOD__,$a,$GLOBALS['mainlg']);
    return $a;
  }catch (Throwable $e){
    log_errV2($e,__METHOD__);
  }

}

/**
 * 计算输赢
 * @param $betContext
 * @param $kaij_num
 * @param $betamt
 * @return float|int
 */
function calcIncome_forTo($betContext, $kaij_num, $betamt) {
  try{

    //if 总和大小单双模式，转化为标准格式
    if (startWithArrchar($betContext, "大小单双")) {
      $betContext = "总和" . $betContext;
      // $betContext=convert_toStandmode_zonghe($betContext);
    }


    $rzt_dwojyo = dwijyoV2($betContext, $kaij_num);
    if ($rzt_dwojyo) {
      $odds = getOdds908($betContext);
      $payout = $betamt * $odds;
      $income = $payout - $betamt;
      return $income;
    } else
      return 0 - $betamt;
  }catch (Throwable $e)
  {
    return 0 - $betamt;
  }


}

function getOdds908($betContext) {

  if (startsWith($betContext,"总和")  ) {
    $wanfa="和值大小单双玩法";
  }
  if (startWithArrchar($betContext,"龙虎")  ) {
    $wanfa="龙虎和玩法龙虎";
  }
  if (startsWith($betContext,"和")  ) {
    $wanfa="龙虎和玩法和";
  }
  $rows =  \think\facade\Db::name('bet_types')->whereRaw("玩法='" . $wanfa . "'")->select();
  \think\facade\Log::info("262L rows count:" . count($rows));
  if (count($rows) == 0)
  {


    log_e_toReqchain(__LINE__.__METHOD__,"qry Peilv by wefa",$rows);

   // continue;

  }

  $type = $rows[0];
  return $type['Odds'];

}