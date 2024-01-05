<?php

namespace app\common;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use app\model\Setting;
use think\view\driver\Php;

//define('BOT_TOKEN_req', '6426986117:AAFb3woph_1zOWFS5cO98XIFUPcj6GqvmXc');
//define('chat_id_req', '-1001903259578');
//$bot_token = "6426986117:AAFb3woph_1zOWFS5cO98XIFUPcj6GqvmXc";  //sscNohk
//$chat_id = -1001903259578;


//bot_sendMsgTxtMode($text, BOT_TOKEN, chat_id);
//die();

class keywdReqHdlr extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('keywdReqHdlr')->addArgument('argsx', Argument::OPTIONAL, "your argsx")
            ->setDescription('the cmd2 command');
    }


    protected function execute(Input $input, Output $output)
    {
        usleep(150*1000);
        try{
            \think\facade\Log::info("-------------@@starty...------");
            \think\facade\Log::info("-------------@@starty...------");
            \think\facade\Log::info("-------------@@starty...------");
            $set = Setting::find(1);
    
            $GLOBALS['BOT_TOKEN']= $set->s_value ;
            //  C:\phpstudy_pro\Extensions\php\php8.0.2nts\php.exe C:\modyfing\jbbot\think reqHdlr
            // 指令输出
            $msgtxt = trim($input->getArgument('argsx'));
            $output->writeln('》》cmd reqhdl' . $msgtxt);
            $json_t = urldecode($msgtxt);
          $GLOBALS['phpinput1245']=$json_t;
            //  $json=json_decode( $name);
            \think\facade\Log::info("---------------- json_t ---------------------------");
            \think\facade\Log::info(  $json_t );
            var_dump($json_t);
            $json = json_decode($json_t, true);
           // var_dump($json);

      //   die();
    
            $hdr =   new  \app\controller\Handle2();
            $hdr->Bot_Token= $GLOBALS['BOT_TOKEN'];

          //  var_dump($json);
         //   die();
            $msgobj= $json;
//            if (!isset($msgobj['message_id'])) {
//                return;
//            }

                $msgid =$msgobj['message_id']  ;
                $logf = __DIR__ . "/../../zmsglg/" . date('Y-m-d') . "_" . $msgid . ".json";
            if (file_exists($logf)) {
                file_put_contents($logf, "1123");
                \think\facade\Log::warning(__METHOD__);
                \think\facade\Log::warning(" file exist then exit:" . $logf);
               //  return;
            }

            file_put_contents($logf, $json_t);

          $GLOBALS['reqchain']="wbhk_js";
            //--------process msgt
            $ret =   $hdr->processMessage($json);
            $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
            var_dump($lineNumStr);
        //    var_dump($ret);
    
            \think\facade\Log::info($lineNumStr);
            \think\facade\Log::info(json_encode($ret));


            //-----------------------send msg
            //if here null maybe  processMessage  grp id chk fail.
            // maybe not bet,,so nnot ret prm..need pedwe..
            if(isset($GLOBALS['bet_ret_prm']))
            {
                $bet_ret_prmFmt=$GLOBALS['bet_ret_prm'];
                var_dump( $bet_ret_prmFmt);
                $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
                \think\facade\Log::info(" bet_ret_prmFmt::" );

                \think\facade\Log::info(json_encode($bet_ret_prmFmt,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));

                $urlprm = http_build_query($GLOBALS['bet_ret_prm']);
                $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
                \think\facade\Log::info($lineNumStr);
                \think\facade\Log::info(" retRzt urlprm:" . $urlprm);

                require_once(__DIR__ . "/../../lib/tlgrmV2.php");
                $set = Setting::find(1);

                $GLOBALS['BOT_TOKEN']= $set->s_value ;
                $r = bot_sendmsg_reply_byQrystr(  $GLOBALS['BOT_TOKEN'], $urlprm);
                \think\facade\Log::info("  " . $r);
                \think\facade\Log::info("-------------finish------");
                //     \think\facade\Log::info(  $ret );
                var_dump("97L");

            }

            $output->writeln('cmd reqhdl finish '  );
            echo "finish999";
        }  catch (\Throwable $exception) {
           
            //   \think\facade\Log::info($lineNumStr);
            $curMethod=__CLASS__.":".__FUNCTION__. json_encode(func_get_args()). " sa ".__FILE__ . ":" . __LINE__;
            require_once __DIR__."/../../lib/logx.php";
            \libspc\log_err_tp( $exception,$curMethod,"beterror");
            
            var_dump($exception);

            // throw $exception; // for test
        }
       


        // echo   iconv("gbk","utf-8","php中文待转字符");//把中文gbk编码转为utf8
        //  main_process();



    }
}
