<?php

namespace app\common;

use app\common\Lottery;
use app\common\helper;
use app\common\Logs;
//   app\common\LotteryHash28
class LotteryHashSsc extends Lottery
{

    protected $api_url = "https://apilist.tronscanapi.com/api/block";
    protected $http_helper;
    public $data = false;
    protected $start = false;
    protected $last_opentime = 0;

    public function __construct()
    {
        $this->http_helper = new Helper();
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    // 获取最后彩期
    // 获取最后彩期
    public function get_last_no()
    {
        $log = Logs::get_last_lottery_log();
        $today = date("Y-m-d", time());
        $no = ""; //date("md", time());

        $tm = time();
        $apikey = parse_ini_file(__DIR__ . "/../../.env")['eth_api_key'];

        $url = "https://api.etherscan.io/api?module=block&action=getblocknobytime&timestamp=$tm&closest=before&apikey=$apikey";
        $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
        \think\facade\Log::info($lineNumStr);
        \think\facade\Log::info($url);
        $res = $this->http_helper->http_request($url);
        \think\facade\Log::info($res);
        $res = json_decode($res);
        $hash = $res->result + 12;
        $this->data = [
            'lottery_no' => $hash,
            'hash_no' => $hash,
        ];
        return $this->data;
    }

    function getLastBlkNum()
    {
        $tm = time();
        $apikey = parse_ini_file(__DIR__ . "/../../.env")['eth_api_key'];

        $url = "https://api.etherscan.io/api?module=block&action=getblocknobytime&timestamp=$tm&closest=before&apikey=$apikey";
        $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
        \think\facade\Log::info($lineNumStr);
        \think\facade\Log::info($url);
        $res = $this->http_helper->http_request($url);
        \think\facade\Log::info($res);
        $res = json_decode($res);
        if ($res == null)
            return null;
        return $res->result;
    }

    // 获取当前彩期
    public function get_current_noV3()
    {
      $logf_flag = "mainlg";
      log_enterMethV2(__METHOD__,func_get_args(), $logf_flag);
        \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
        //if this data ,ret true
        //  if (!$this->data) return false;

        while (true) {
            try {


              $url = "https://api.kzx71.vip/tron/next";
              logV3(__METHOD__,$url, $logf_flag);
              $txt=file_get_contents($url);
              log_Vardump(__METHOD__,"file_get_contents_ret",$txt, $logf_flag);

              $jsonobj=json_decode(  $txt,true);
                $qihao =  $jsonobj['data']['issue'];
                $GLOBALS['opentime']= $jsonobj['data']['openTime'];
                $GLOBALS['qihao']= $qihao;
              // $GLOBALS['kaijtime']=$kaijtime;
                $GLOBALS['kaijtime']=$jsonobj['data']['closeTime'];
                $GLOBALS['nextBlknum']=$jsonobj['data']['hash_no'];
              $GLOBALS['kaijBlknum']=$jsonobj['data']['hash_no'];
                //
//                var_dump($blknum);
//                // die();
                $blknum=$qihao ;
                 if(empty($blknum)) {
                    sleep(1);
                    continue;
                }
                if (!$blknum) {
                    sleep(1);
                    continue;
                } else if (strlen($blknum) < 5) {
                    sleep(1);
                    continue;
                }
//
                // $qihao = $blknum ;
//                var_dump($qihao);
                //   touzhu time 90s,, fenpe30s

                $this->data = [
                    'lottery_no' => $qihao,
                  //  'hash_no' => $qihao,
                  'hash_no' =>  $GLOBALS['nextBlknum'],
                    'closetime'=> $jsonobj['data']['closeTime']
                ];
                log_vardumpRetval(__METHOD__,$this->data,$logf_flag);
                return $this->data;
                //die();
                //return   $qihao;
            } catch (\Throwable $e) {
                $exception = $e;
                $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
                \think\facade\Log::error("----------------errrrr3---------------------------");
                \think\facade\Log::error("file_linenum:" . $exception->getFile() . ":" . $exception->getLine());
                \think\facade\Log::error("errmsg:" . $exception->getMessage());
                \think\facade\Log::error("errtraceStr:" . $exception->getTraceAsString());
                // var_dump($e);
            }

            sleep(1);
        }
    }



    public function get_current_noV2()
    {
        \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
        //if this data ,ret true
        //  if (!$this->data) return false;

        while (true) {
            try {
                $blknum = $this->getLastBlkNum();
                var_dump($blknum);
                // die();
                if (empty($blknum)) {
                    sleep(1);
                    continue;
                }
                if (!$blknum) {
                    sleep(1);
                    continue;
                } else if (strlen($blknum) < 5) {
                    sleep(1);
                    continue;
                }

                $qihao = $blknum + 12;
                var_dump($qihao);

                $this->data = [
                    'lottery_no' => $qihao,
                    'hash_no' => $qihao,
                ];
                return $this->data;
                //die();
                //return   $qihao;
            } catch (\Throwable $e) {
                $exception = $e;
                $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
                \think\facade\Log::error("----------------errrrr3---------------------------");
                \think\facade\Log::error("file_linenum:" . $exception->getFile() . ":" . $exception->getLine());
                \think\facade\Log::error("errmsg:" . $exception->getMessage());
                \think\facade\Log::error("errtraceStr:" . $exception->getTraceAsString());
                // var_dump($e);
            }

            sleep(1);
        }
    }


    // 获取当前彩期
    public function get_current_no()
    {
        //if this data ,ret true
        if (!$this->data) return false;


        $this->data['hash_no'] += 12;
        $this->data['lottery_no'] = $this->data['hash_no'];
        return $this->data;
    }
    // 开奖  blkModeApi
    public function drawV3($blkNum)
    {
      log_enterMethV2(__METHOD__,func_get_args(),$GLOBALS['mainlg']);
        \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
        var_dump($blkNum);
        $log_txt = __METHOD__ . json_encode(func_get_args());

        \think\facade\Log::info($log_txt);
        while (true) {
            try {
                $HexNum = dechex($blkNum);
                $apikey = parse_ini_file(__DIR__ . "/../../.env")['eth_api_key'];
               // $url = "https://api.etherscan.io/api?module=proxy&action=eth_getBlockByNumber&tag=0x$HexNum&boolean=false&apikey=$apikey";

              $url="https://api.kzx71.vip/tron/result?issue=".$blkNum;
              logV3(__METHOD__,$url,$GLOBALS['mainlg']);
              $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
                \think\facade\Log::info($lineNumStr);
                \think\facade\Log::info($url);
                $t = $this->http_helper->http_request($url);

              logV3(__METHOD__,"urlret=>".$t,$GLOBALS['mainlg']);


              \think\facade\Log::info($t);
                \think\facade\Log::debug($t);
                \think\facade\Log::notice($t);
                $json = json_decode($t, true);
                if ($json == null) {
                    sleep(1);
                    continue;
                } else if ($json['data'] == null) {
                    sleep(1);
                    continue;
                } else if ($json['data']['hash'] == null) {
                    sleep(1);
                    continue;
                }

              $hash = $json['data']['hash'];
                log_vardumpRetval(__METHOD__,$hash,$GLOBALS['mainlg']);
              return $hash;
            } catch (\Throwable $e) {
                $exception = $e;
                $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
                \think\facade\Log::error("----------------errrrr3---------------------------");
                \think\facade\Log::error("file_linenum:" . $exception->getFile() . ":" . $exception->getLine());
                \think\facade\Log::error("errmsg:" . $exception->getMessage());
                \think\facade\Log::error("errtraceStr:" . $exception->getTraceAsString());
                // var_dump($e);
            }

            sleep(1);
        }
    }

    // 开奖
    public function draw()
    {
        if (!$this->data) return false;
        while (true) {
            try {
                $HexNum = dechex($this->data['hash_no']);
                $apikey = parse_ini_file(__DIR__ . "/../../.env")['eth_api_key'];
                $url = "https://api.etherscan.io/api?module=proxy&action=eth_getBlockByNumber&tag=0x$HexNum&boolean=false&apikey=$apikey";
                $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
                \think\facade\Log::info($lineNumStr);
                \think\facade\Log::info($url);
                $t = $this->http_helper->http_request($url);
                \think\facade\Log::info($t);
                $json = json_decode($t, true);
                return  $json['result']['hash'];
            } catch (\Throwable $e) {
                $exception = $e;
                $lineNumStr = "  " . __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";
                \think\facade\Log::error("----------------errrrr4---------------------------");
                \think\facade\Log::error("file_linenum:" . $exception->getFile() . ":" . $exception->getLine());
                \think\facade\Log::error("errmsg:" . $exception->getMessage());
                \think\facade\Log::error("errtraceStr:" . $exception->getTraceAsString());
            }

            sleep(1);
        }
    }

    public function drawV2()
    {
        var_dump("drawV2");
        $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";

        \think\facade\Log::info($lineNumStr);

        \think\facade\Log::info(json_encode($this->data));

        \think\facade\Log::info("drawV2843");
        var_dump($this->data);
        if (!$this->data) return false;
        try {
            $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";

            \think\facade\Log::info($lineNumStr);
            \think\facade\Log::info("drawV2() hashno：" .  $this->data['hash_no']);
            $HexNum = dechex($this->data['hash_no']);
            $apikey = parse_ini_file(__DIR__ . "/../../.env")['eth_api_key'];
            $url = "https://api.etherscan.io/api?module=proxy&action=eth_getBlockByNumber&tag=0x$HexNum&boolean=false&apikey=$apikey";
            $lineNumStr = __FILE__ . ":" . __LINE__ . " f:" . __FUNCTION__ . " m:" . __METHOD__ . "  ";

            \think\facade\Log::info($lineNumStr);
            \think\facade\Log::info($url);
            var_dump($url);
            $t = file_get_contents($url);
            //  var_dump($t);
            \think\facade\Log::info($t);
            $json = json_decode($t, true);
            return  $json['result']['hash'];
        } catch (\Exception $e) {
            $dbgstr = $e->getMessage() . " " . $e->getFile() . ":" . $e->getLine();
            var_dump($dbgstr);
            \think\facade\Log::warning($dbgstr);
            $j_tx = json_encode($e, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            \think\facade\Log::warning($j_tx);
            trace($e->getMessage(), "debug");
            return false;
        }
    }
}
