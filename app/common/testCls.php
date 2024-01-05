<?php

namespace app\common;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use app\model\Setting;
use think\view\driver\Php;

//   C:\phpstudy_pro\Extensions\php\php8.0.2nts\php.exe C:\modyfing\jbbot\think swoole2 

function testKaij()
{
 //   saD
  echo "@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@" . PHP_EOL;
  echo "@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@." . PHP_EOL;
  echo "@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@." . PHP_EOL;

  $gmLgcSSc = new    \app\common\GameLogicSsc();

  $data['hash_no'] = 17870669;
  $data['lottery_no'] = 17870669;
  $gmLgcSSc->lottery->setData($data);
  $gmLgcSSc->hash_no =   $data['hash_no'];
  $gmLgcSSc->lottery_no = $data['hash_no'];

  global $lottery_no;
  $lottery_no = 17890257;
  //kaij_draw_evt();
  echo 999;

  // var_dump($gmLgcSSc->DrawLotteryV2("0xajfdklsjfl91690"))  ;
}


function painTest()
{
  $gmLgcSSc = new   \app\common\GameLogicSsc();
  $gmLgcSSc->SendTrendImage(13);
  //  imagepng($img, app()->getRootPath() . "public/trend.jpg");
}
class testCls extends Command
{
  protected function configure()
  {
    // 指令配置
    $this->setName('testClsNm')
      ->setDescription('the cmd2 command');
  }

  protected function execute(Input $input, Output $output)
  {

      $json_t=file_get_contents(__DIR__."/../../db/req.json");
      $json = json_decode($json_t, true);


      $hdr =   new  \app\controller\Handle2();
      $hdr->Bot_Token= $GLOBALS['BOT_TOKEN'];
      $ret =   $hdr->processMessage($json);


      die();
//  //    select sum(bet),sum(payout),sum(bet)-sum(payout) as income
//  //    from betrecord where lotterno=xxx group by userid

      $lotteryno=17954621;
      $rows =  \think\facade\Db::name('bet_record')->where('lotteryno', '=', $lotteryno)
          ->field(' username,userid,sum(bet) bet,sum(payout) payout,sum(bet)-sum(payout) as income')
          ->group('userid,username')
          ->select();

      die();

      painTest();
      die();
   //   $rzt717= lotrySpltrCls::msgHdlr("a123操200");
    //  $rzt717= lotrySpltrCls::msgHdlr("1小100");
  //    $rzt717= lotrySpltrCls::msgHdlr("abc小100");
      $rzt717= lotrySpltrCls::msgHdlr("123小100");
//$rzt717= lotrySpltrCls::tmqwfabc1200zhms("abc1.200");
      $rzt717=1;

      die();


    
    \think\facade\Log::betnotice("aa哇哇哇叫123");
    \think\facade\Log::info("aa哇哇哇叫123");
    die();


    require_once __DIR__ . "/../../lib/strx.php";
     $bet_str_arr_clr = \strspc\spltBySpace("aaa bbb");
  
    //$bet_str_arr_clr =\extend\spltBySpace("aaa bbb");
    var_dump(   $bet_str_arr_clr);
    die();
 

    testKaij();
    die();
    // 指令输出
    //  $output->writeln('cmd2');
    $gmLgcSSc = new   \app\common\GameLogicSsc();  //comm/gamelogc
    //  $gmLgcSSc->SendTrendImage(7); // 生成图片
    //  $cfile = new \CURLFile(app()->getRootPath() . "public/trend.jpg");
    echo 000;

    $qihao = 17875980;

    $gmLgcSSc = new   \app\common\GameLogicSsc();  //comm/gamelogc
    var_dump($gmLgcSSc->calcIncome(17875980));
    die();

    $rows =  \think\facade\Db::name('bet_record')->where('lotteryno', '=', 17875980)->select();
    var_dump($rows);
    //  var_dump( $rows[0]['UserName']);
    foreach ($rows as $row) {
      $betamt = $row['Bet'] / 100;

      var_dump($row['Payout'] / 100);
      var_dump($betamt);
      $payout = $row['Payout'];
      var_dump($row['Payout'] / 100 - $betamt);
      $income = $row['Payout'] / 100 -  $betamt;
      $uid = $row['UserId'];
      $uname = $row['UserName'];
      $txt = "$uname [$uid] 下注金额:$betamt 盈亏: $income \r\n";
      var_dump($txt);
      $a[] = $txt;
    }

    var_dump($a);
  }
}
