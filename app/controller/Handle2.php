<?php

declare(strict_types=1);

namespace app\controller;

use app\common\Player;
use think\exception\ValidateException;
use think\Request;
use app\model\Setting;
use app\model\BotWords;
use app\common\Game2handlrLogic as Game;
//use app\common\NNGame;
use app\model\Test;
use app\common\Logs;
use app\common\GameLogic;
use function libspc\log_err;

function var_dumpx()
{
}
//    \app\controller\Handle2
//  app\controller\Handle2.index()
class Handle2
{

    public function  betTest()
    {
        $gm=new \app\common\Game2handlrLogic();
      //  $gm->player=new Player(new \Date());
        $gm-> regex_betV2("abc大100");
        echo 100;
    }
    public $Bot_Token = "";


    public function msgRcv()
    {
        require __DIR__."/../../lib/iniAutoload.php";
        require_once __DIR__."/../../lib/log23.php";
        require_once __DIR__."/../../lib/iniTpSqlLsnr.php";


        $GLOBALS['reqchain']='msgRcv';
        \log_enterMeth(__METHOD__,func_get_args(),'msgRcv');


        $msg_txt=$_GET['msg'];
        \log23::msgRcv(__LINE__.__METHOD__," GET['msg'] ",$_GET['msg']);

        $json_t = urldecode($msg_txt);
        //  $json=json_decode( $name);
        \think\facade\Log::info("---------------- json_t ---------------------------");
        \think\facade\Log::info($json_t);
        var_dump($json_t);
        $json = json_decode($json_t, true);

        $ret = $this->processMessage($json);

        if (!isset($GLOBALS['bet_ret_prm']))
        {
            //include_once __DIR__."/../../lib/log23.php";
            \log23::msgRcv(__LINE__.__METHOD__,"","no set bet ret prm");

            return;
        }

        \log23::msgRcv(__LINE__.__METHOD__,"GLOBALS['bet_ret_prm']",$GLOBALS['bet_ret_prm']);

        $bet_ret_prmFmt = $GLOBALS['bet_ret_prm'];
        var_dump($bet_ret_prmFmt);
        $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
        \think\facade\Log::info(" bet_ret_prmFmt::");

        \think\facade\Log::info(json_encode($bet_ret_prmFmt, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        $urlprm = http_build_query($GLOBALS['bet_ret_prm']);
        \log23::msgRcv(__LINE__.__METHOD__,"urlprm",$urlprm);

        $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
        \think\facade\Log::info($lineNumStr);
        \think\facade\Log::info(" retRzt urlprm:" . $urlprm);

        require_once(__DIR__ . "/../../lib/tlgrmV2.php");
        $set = Setting::find(1);

        $GLOBALS['BOT_TOKEN'] = $set->s_value;
        $r = bot_sendmsg_reply_byQrystr($GLOBALS['BOT_TOKEN'], $urlprm);
        \log23::msgRcv(__LINE__.__METHOD__," bot_sendmsg_reply_byQrystr rzt",$r);
        \think\facade\Log::info("  " . $r);
        \think\facade\Log::info("-------------finish------");
        //     \think\facade\Log::info(  $ret );
      //  var_dump("97L");
die();

    }


  public function msghdl($frmNet) {
    try {
      $update = json_decode($frmNet, true);
      if (!$update)
        return;
      $message = $update["message"];
      if (!$message)
        return;

      $text = $message['text'];
      $chat_id = $message['chat']['id'];
      if ($text === "获取我的群信息") {
        $reply_text = "我的群 " . $message['chat']['title'] . " id: " . $chat_id;

        // $this->  $bot->sendMessage($chat_id, $reply_text);


        $set = Setting::find(1);

        $GLOBALS['BOT_TOKEN'] = $set->s_value;
        require_once(__DIR__ . "/../../lib/tlgrmV2.php");
        $r = sendmsg_reply_txt($reply_text, $GLOBALS['BOT_TOKEN'], $chat_id);
      }

    } catch (\Exception $e) {

    }


  }
    /**
     * 显示资源列表
     *    s=handle/processMessage
     * @return \think\Response
     */
  public function index() {
    ob_start();
    require_once __DIR__ . "/../../lib/iniAutoload.php";
    log_enterMeth_reqchainWzIniLgfilfrg(__METHOD__, func_get_args(), "wbhkReq");
    $updateId = 0;
    try {
      \think\facade\Log::betnotice(__METHOD__ . json_encode(func_get_args()));
      $frmNet = file_get_contents('php://input');
    $GLOBALS['phpinput1245']=$frmNet;

      if (isset($GLOBALS['testIpt']))
        $frmNet = $GLOBALS['testIpt'];

      $this->msghdl($frmNet);

      //   msghdl($frmNet);
      $msgFil = __DIR__ . "/../../zmsglg/" . date('Y-m-d H-i-s') . "_rcv" . rand() . ".json";
      file_put_contentsx($msgFil, $frmNet);
      log_info_toReqchain(__LINE__ . __METHOD__, "php_input", $frmNet);

      \think\facade\Log::betnotice($frmNet);
      $update = json_decode($frmNet, true);
      if (!$update) {
        log_info_toReqchain(__LINE__ . __METHOD__, "not updt,decode txt frmNext", $update);
        return false;
      }
      $updateId = $update['update_id'];
      $this->Bot_Token = Setting::find(1)->s_value;
      log_info_toReqchain(__LINE__ . __METHOD__, "Bot_Token", $this->Bot_Token);

      if (isset($update["message"])) {
        $msgobj = $update["message"];
        $msgid = $msgobj['message_id'];
        //---------------------start..
        // echo 11;
        $ret = $this->processMessage($update["message"]);
        if (!isset($GLOBALS['bet_ret_prm'])) {
          log_e_toReqchain(__LINE__ . __METHOD__, "not find ret prm,PHPinpt", $frmNet);

          \think\facade\Log::warning("no find ret prm,maybe rev by chkbot. so ret:".$frmNet);
          \think\facade\Log::betnotice("no find ret prm,maybe rev by chkbot. so ret:".$frmNet);
          \libspc\log_info_tp("no find ret prm,maybe rev by chkbot. so ret,oriinput:", $frmNet, __LINE__ . __METHOD__, "betnotice");
          die();
        }
        $parameters = $GLOBALS['bet_ret_prm'];
        $parameters["method"] = "sendMessage";
        $payload = json_encode($parameters);
        log_info_toReqchain(__LINE__ . __METHOD__, "payload", $payload);
        global $errdir;
        require_once __DIR__ . "/../../lib/logx.php";
        \libspc\log_info_tp("bet_ret_prm", $parameters, __LINE__.__METHOD__, "hdlrRevPayload");

        ob_end_clean();
        header('Content-Type: application/json');
        header('aaa: application/json');
        header('Content-Length:' . strlen($payload) + 0);
        echo $payload;
        die();
        return;
      } elseif (isset($update["callback_query"])) {


        return $this->processCallbackQuery($update["callback_query"]);
      }
    } catch (\Throwable $e) {

      try{
        //    var_dump(999);die();
        $data = [
          'chat_id' => $updateId,
          'name' => "网络钩子异常",
          'text' => $e->getFile() . ":" . $e->getLine() . " " . $e->getMessage(),
        ];
        Test::create($data);
        $exception = $e;
        global $errdir;
        require_once __DIR__ . "/../../lib/logx.php";
        log_err_toReqChainLog(__FILE__ . __METHOD__, $e);
        $lineNumStr = " m:" . __METHOD__ . "  " . __FILE__ . ":" . __LINE__ . PHP_EOL;
        \libspc\log_err($exception, $lineNumStr, $errdir, "emgc");
        \libspc\log_err_tp($exception, $lineNumStr, "emergency");

      } catch (\Throwable $exception) {
          log_err($exception,__LINE__.__METHOD__,$GLOBALS['errlog']);

      }

    }
  }

    /**
     * 
     *   $msgFil = __DIR__ . "/../../zmsglg/" . date('Y-m-d') . "_" . $msgid . ".json";
    if (file_exists($msgFil)) {
    //  file_put_contents($msgFil, "1123");
    \think\facade\Log::warning(" file exist:" . $msgFil);
    //   return;
    }

    file_put_contents($msgFil, $frmNet);

                //----------------------send msg
                require_once(__DIR__ . "/../../lib/tlgrmV2.php");
                \think\facade\Log::info($GLOBALS['bet_ret_prm']);
                $urlprm = http_build_query($GLOBALS['bet_ret_prm']);
                \think\facade\Log::info(" urlprm: $urlprm");


                $set = Setting::find(1);

                $GLOBALS['BOT_TOKEN'] = $set->s_value;
                //   $GLOBALS['BOT_TOKEN']
                //   $r = bot_sendmsg_reply_byQrystr(  $GLOBALS['BOT_TOKEN'], $urlprm);
                //  \think\facade\Log::info(" http bot ret: " . $r);
                \think\facade\Log::info("-------------finish------");
                //  die();
                return;
     */

    public function apiRequestWebhook($method, $parameters)
    {
        log_setReqChainLog_enterMeth(__METHOD__ ,func_get_args());
        \think\facade\Log::noticexx(__METHOD__ . json_encode(func_get_args()));
        if (!is_string($method)) {
            error_log("Method name must be a string\n");
            return false;
        }

        if (!$parameters) {
            $parameters = array();
        } else if (!is_array($parameters)) {
            error_log("Parameters must be an array\n");
            return false;
        }

        $parameters["method"] = $method;

        $payload = json_encode($parameters);
        //header('Content-Length:' . strlen($payload));
        //echo $payload;
        //   var_dumpx($parameters);
        //  var_dumpx(json($parameters));
        return json($parameters)->header(['Content-Length' => $payload]);
    }
    public function processMessageTest()
    {
        //   var_dumpx(999);
        $t = file_get_contents('C:\w\sdkprj\732.json');
        $j = json_decode($t, true);
        $ret =   $this->processMessage($j);
        $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
        var_dump($lineNumStr);
        var_dump($ret);

        \think\facade\Log::info($lineNumStr);
        //     \think\facade\Log::info(  $ret );
        var_dump("97L");
        //    var_dumpx(111);
    }


    //  C:\phpstudy_pro\Extensions\php\php8.0.2nts\php.exe C:\项目最新\jbbot\public\index2.php   Game2handlrLogic/testtype   

    //  C:\phpstudy_pro\Extensions\php\php8.0.2nts\php.exe C:\项目最新\jbbot\public\index2.php   handle2/processMessageTest
    //   C:\phpstudy_pro\Extensions\php\php8.0.2nts\php.exe C:\项目最新\jbbot\public\index2.php   handle2/gettypex
    //   C:\phpstudy_pro\Extensions\php\php8.0.2nts\php.exe C:\项目最新\jbbot\public\index2.php   handle2/testDrawV2
    //   C:\phpstudy_pro\Extensions\php\php8.0.2nts\php.exe C:\modyfing\jbbot\public\index2.php   handle2/testGenePic

    // C:\phpstudy_pro\Extensions\php\php8.0.2nts\php.exe C:\modyfing\jbbot\public\index2.php   handle2/testDraw

    //   C:\phpstudy_pro\Extensions\php\php8.0.2nts\php.exe C:\项目最新\jbbot\public\index2.php   handle2/testtype
    public function testGenePic()
    {
        $gmLgcSSc = new    \app\common\GameLogicSsc();
        $gmLgcSSc->SendTrendImage(5);
        // var_dump( $obj->draw());
        // var_dump( $obj->drawV2());
        echo  "public/trend.jpg";
    }

    public function testDraw2_getKaijnumFromEth()
    {
        $obj = new \app\common\LotteryHash28();

        $a['hash_no'] = 17811427;
        $obj->setData($a);
        // var_dump( $obj->draw());
        // var_dump( $obj->drawV2());
    }
    //   C:\phpstudy_pro\Extensions\php\php8.0.2nts\php.exe C:\modyfing\jbbot\public\index2.php   handle2/testDrawV2
    public function testDrawV2()
    {
        echo "@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@" . PHP_EOL;
        echo "@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@." . PHP_EOL;
        echo "@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@." . PHP_EOL;

        $gmLgcSSc = new    \app\common\GameLogicSsc();

        $data['hash_no'] = 17811427;
        $data['lottery_no'] = 17811427;
        $gmLgcSSc->lottery->setData($data);
        $gmLgcSSc->hash_no =   $data['hash_no'];
        $gmLgcSSc->lottery_no = $data['hash_no'];



        $gmLgcSSc->DrawLotteryV2("0xajfdklsjfl01690");
        //   $rows =  \think\Facade\Db::name('bet_types')->whereRaw("玩法='" . $wanfa . "'")->select();
        // $rows  = \app\model\BetTypes::where('玩法', "龙虎和玩法")->find()->toArray();
        $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
        //   \think\facade\Log::info($lineNumStr . " cnt row:" . count($rows));
    }
    //dep
    public function testDraw()
    {
        echo "@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@" . PHP_EOL;
        echo "@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@." . PHP_EOL;
        echo "@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@." . PHP_EOL;
        $data['hash_no'] = 17861938;
        $gmLgcSSc = new    \app\common\GameLogicSsc();
        $gmLgcSSc->lottery->setData($data);
        $gmLgcSSc->hash_no = $data['hash_no'];
        $gmLgcSSc->lottery_no = $data['hash_no'];



        $gmLgcSSc->DrawLottery();
        //   $rows =  \think\Facade\Db::name('bet_types')->whereRaw("玩法='" . $wanfa . "'")->select();
        // $rows  = \app\model\BetTypes::where('玩法', "龙虎和玩法")->find()->toArray();
        $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
        //   \think\facade\Log::info($lineNumStr . " cnt row:" . count($rows));
    }

    public function testtype()
    {
        //   $rows =  \think\Facade\Db::name('bet_types')->whereRaw("玩法='" . $wanfa . "'")->select();
        $rows  = \app\model\BetTypes::where('玩法', "龙虎和玩法")->find()->toArray();
        $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
        \think\facade\Log::info($lineNumStr . " cnt row:" . count($rows));
    }

    function gettypex()
    {

        file_put_contents("kkkk.log", 111, FILE_APPEND);
        //  var_dumpx(111);

        $rows =  \think\Facade\Db::name('bet_types00')->whereRaw("玩法='龙虎和玩法'")->select();
        // $rows=  \think\Db::query('select * from bet_typeds where 1=1');
        //$rows=  \think\Facade\Db::name('bet_types')->select();
        $rows =  \think\Facade\Db::name('bet_types')->whereRaw("玩法='龙虎和玩法'")->select();

        file_put_contents("351.json", json_encode($rows));
        //  var_dumpx($rows);
        //   var_dumpx($rows[0]['玩法']);
    }

    public function processMessage($message)
    {
        require_once __DIR__."/../../lib/iniTpSqlLsnr.php";
      require_once __DIR__."/../../lib/iniAutoload.php";
        log_setReqChainLog_enterMeth(__METHOD__ ,func_get_args());

\log23::tlgrmlib(json_encode($message) );
        \think\facade\Log::betnotice(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
        \think\facade\Log::debug(__METHOD__ . json_encode(func_get_args(),JSON_UNESCAPED_UNICODE));
        //  var_dump(__METHOD__ . json_encode(func_get_args()));
        //  var_dump( $this->Bot_Token);

        $bot = new \TelegramBot\Api\BotApi($this->Bot_Token);
        // process incoming message
        $message_id = $message['message_id'];
        $chat_id = $message['chat']['id'];
        //  var_dump( $message );
        //   var_dump( $chat_id );
        //  die();
        $user_id = $message['from']['id'];
        $data = Test::where('chat_id', $message_id)
            ->where('name', '小飞机漏发信息')    //  msg recv bu jcbot
            ->find();
        if ($data) {
           // $GLOBALS['bet_ret_prm']=[];
            return;
        }
        $data = [
            'chat_id' => $message_id,
            'name' => "网络钩子接收",
            'text' =>  $GLOBALS['phpinput1245']
        //file_get_contents('php://input'),
        ];
        Test::create($data);
        $user_name = '';
        if (isset($message['from']['username']))
            $user_name = $message['from']['username'];
        $full_name = '';
        if (isset($message['from']['first_name']))
            $full_name = $message['from']['first_name'];
        if (isset($message['from']['last_name']))
            $full_name = $full_name . $message['from']['last_name'];


        $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
        \think\facade\Log::info($lineNumStr);
        //  \think\facade\Log::info( $message['text']);

        if (isset($message['text'])) {
            $text = $message['text'];
            if ($text === "获取我的群信息") {
                $reply_text = "我的群 " . $message['chat']['title'] . " id: " . $chat_id;
                $params =
                    [
                        'chat_id' => $chat_id,
                        'text' => $reply_text,
                    ];
                return $this->apiRequestWebhook("sendMessage", $params);
                //$bot->sendMessage($chat_id, $reply_text);
            }
        }

      $grpid_inDb = Setting::find(2)->value;
      if ($chat_id != $grpid_inDb) {
            $msg=sprintf("grpid chk fail. curGrpid=%s grpidIndb=%s",$chat_id,$grpid_inDb );
            $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
            \think\facade\Log::info($lineNumStr);
            \think\facade\Log::info(" chat_id:" . $chat_id . " dbchtid:" . $grpid_inDb);
            \think\facade\Log::error($msg);
            throw new ValidateException($msg);
            return;
            /*
            $token = Setting::find(11)->s_value;
            $bot = new \TelegramBot\Api\BotApi($token);
            $ci = Setting::find(12)->value;
            $text = "接收到搞事信息\r\n信息id : $chat_id\r\n搞事人:$full_name,$user_name\r\n";
            if (isset($message['chat']['title']))
                $text = $text . "群名 : " . $message['chat']['title'] . "\r\n";
            if (isset($message['text']))
                $text = $text . "内容 : " . $message['text'];
            $bot->leaveChat($chat_id);
            */
            //$bot->sendMessage($ci, $text);


        }



        $game = new \app\common\Game2handlrLogic();
        try{
           // if (empty($game->getPlayer($user_id))) {
                $GLOBALS['cur_user']=$game->getPlayer($user_id);
                \think\facade\Log::betnotice("cur_user=>" . json_encode($GLOBALS['cur_user'], JSON_UNESCAPED_UNICODE));

         //   }

        }catch (\Exception $e){

            \think\facade\Log::error(__METHOD__.$e->getMessage());
        }



        $reply_text = "默认信息";
        if (!isset($message['text'])) {

          return;
        }
        // incoming text message
        $text = $message['text'];
        //  $cmd= ' return new '. parse_ini_file(__DIR__."/../../.env")['handle_game'].'();';
        //  var_dumpx($cmd);
        //  $game=  eval($cmd);


        //  $game   new app\common\GameSsc();
        var_dumpx($game);
        //------------------------crteaty player
        if (empty($game->getPlayer($user_id))) {
            $game->createPlayer($user_id, $full_name, $user_name);
        }

        try {
            $GLOBALS['cur_user'] = $game->getPlayer($user_id);
        } catch (\Exception $e) {
        }

        $game->receive($message_id);
        //start bet


        //-----------------------这里应该处理其他cmd和bet cmd
        $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
        \think\facade\Log::info($lineNumStr);
        \think\facade\Log::info(" game->player_exec()");
        $reply_text =  $game->player_exec($text, Setting::find(3)->value == 1);

        $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
        \think\facade\Log::info($lineNumStr);
        \think\facade\Log::info(" reply_text ::" . $reply_text);
        var_dumpx($reply_text);   //"下注命令错误"


     //---------------这里处理 猴急 后记
      // todo 这里貌似哦没用
        if (empty($reply_text)) {
          return;
        }
        // is have replyb text  then ret
        if ($game->sendTrend()) :
                \think\facade\Log::info("game->sendTrend");
                $cfile = new \CURLFile(app()->getRootPath() . "public/trend.jpg");
                $params = [
                    'chat_id' => $chat_id,
                    'photo' => $cfile,
                ];
                $bot->sendPhoto($chat_id, $cfile, null, null, $message_id);
                //$resp =  $this->apiRequestWebhook("sendPhoto", $params);
                //$resp->contentType("multipart/form-data");
             else :
                \think\facade\Log::info("game->sendTrend else");
                $keyboard = null;
                if ($game->action()) {
                    $keyboard_array = json_decode(BotWords::where('Id', 1)->find()->Button_Text);

                    \think\facade\Log::info("345pm");
                    $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
                    \think\facade\Log::info($lineNumStr);
                    \think\facade\Log::info(json_encode($keyboard_array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

                    $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup($keyboard_array);
                } else if ($game->keyboard) {
                    \think\facade\Log::info("345pm2");
                    $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
                    \think\facade\Log::info($lineNumStr);
                    \think\facade\Log::info(json_encode($game->keyboard, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                    $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup($game->keyboard);
                }
                //keyboard just menu list
                //    var_dumpx( $keyboard); //null
                $params =
                    [
                        'chat_id' => $chat_id,
                        'text' => $reply_text,
                        //'message_thread_id' => null,
                        'parse_mode' => is_null($game->parse_mode()) ? "" : $game->parse_mode(),
                        'disable_web_page_preview' => true,
                        'reply_to_message_id' => (int)$message_id,
                        'reply_markup' => is_null($keyboard) ? "" : $keyboard->toJson(),
                        'disable_notification' => false,
                    ];

                $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
                \think\facade\Log::info($lineNumStr);
                \think\facade\Log::info(json_encode($params));

                $curMethod = __CLASS__ . ":" . __FUNCTION__ . json_encode(func_get_args()) . " sa " . __FILE__ . ":" . __LINE__;
                \think\facade\Log::betnotice("at file:" . __FILE__ . ":" . __LINE__);
                \think\facade\Log::betnotice("at method:" . __CLASS__ . ":" . __FUNCTION__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
                \think\facade\Log::betnotice("ret params:" . json_encode($params));
                $GLOBALS['bet_ret_prm'] = $params;
              //  var_dump(21844);
                //$bot->sendMessage($chat_id, $reply_text, $game->parse_mode(), false, null, $message_id, $keyboard);
                return $this->apiRequestWebhook("sendMessage", $params);
           endif;


    }

  /** prcs btn cmd
   * @param $callback_query
   * @return false|\think\response\Json|void
   * @throws \think\db\exception\DataNotFoundException
   * @throws \think\db\exception\DbException
   * @throws \think\db\exception\ModelNotFoundException
   */
    private function processCallbackQuery($callback_query)
    {
      log_enterMethV2(__METHOD__,func_get_args(), "btncmd");
        $from = $callback_query['from']['id'];
        $func = $callback_query['data'];
        $data = Test::where('chat_id', $callback_query['id'])
            ->where('name', '小飞机漏发信息')
            ->find();
        if ($data) {
            return;
        }
        $data = [
            'chat_id' => $callback_query['id'],
            'name' => "网络钩子接收",
            'text' => file_get_contents('php://input'),
        ];
        Test::create($data);
        $res = "";
        if (!empty($func)) {
            $res = $this->$func($from);
            logV3(__METHOD__,"res=>".$res,"btncmd");
        }
        if (!empty($res)) {
        //  ob_end_clean();

          $parameters=[
            'callback_query_id' => $callback_query['id'],
            'text' => $res,
            'show_alert' => true,
          ];

          $parameters["method"] = "answerCallbackQuery";
          $payload = json_encode($parameters);

          ob_end_clean();
          header('Content-Type: application/json');
          header('aaa: application/json');
          header('Content-Length:' . strlen($payload) + 0);
          echo $payload;
          die();
          return;
            //$bot = new \TelegramBot\Api\BotApi($this->Bot_Token); 
            //$bot->answerCallbackQuery($callback_query['id'], $res, true);
//            return $this->apiRequestWebhook("answerCallbackQuery", [
//                'callback_query_id' => $callback_query['id'],
//                'text' => $res,
//                'show_alert' => true,
//            ]);
        }
    }

    private function query_balance($from)
    {
        $game = new Game($from);
        return $game->callBalance();
    }

    private function query_records($from)
    {
        $game = new Game($from);
        return $game->callLastRecord();
    }

    private function query_rebates($from)
    {
        $game = new Game($from);
        return $game->queryRollover();
    }


}
