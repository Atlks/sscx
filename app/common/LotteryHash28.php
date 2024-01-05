<?php

namespace app\common;

use app\common\Lottery;
use app\common\helper;
use app\common\Logs;
//   app\common\LotteryHash28
class LotteryHash28 extends Lottery
{

    protected $api_url = "https://api.kzx71.vip/getLastNo";
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
        //$url = "https://api.etherscan.io/api?module=block&action=getblocknobytime&timestamp=$tm&closest=before&apikey=VASRGU6XT768WSKI2VME6Z8ZK3GK5E3UDT";
        try {
            $res = file_get_contents($this->api_url);
            $res = json_decode($res, true);
            if (empty($res) || !isset($res['data'])) return false;
            $issue = $res['data']['issue'];
            $hash_no = $res['data']['hash_no'];
            $time = $res['data']['openTime'];
            $this->data = [
                'lottery_no' => $issue,
                'hash_no' => $hash_no,
                'opentime' => $time
            ];
            return $this->data;
        } catch (\Exception $e) {
            $dbgstr = $e->getMessage() . " " . $e->getFile() . ":" . $e->getLine();
            trace($dbgstr, "debug");
            return false;
        }
    }

    // 获取当前彩期
    public function get_current_no()
    {
        //if this data ,ret true
        try {
            if (!$this->data) return false;
            $res = file_get_contents($this->api_url);
            $res = json_decode($res, true);
            if (empty($res) || !isset($res['data'])) return false;
            $issue = $res['data']['issue'];
            $hash_no = $res['data']['hash_no'];
            $time = $res['data']['openTime'];
            if (intval($issue) > intval($this->data['lottery_no'])) {
                $this->data = [
                    'lottery_no' => $issue,
                    'hash_no' => $hash_no,
                    'opentime' => $time
                ];
                return $this->data;
            }
            return false;
        } catch (\Exception $e) {
            $dbgstr = $e->getMessage() . " " . $e->getFile() . ":" . $e->getLine();
            trace($dbgstr, "debug");
            return false;
        }
    }


    // 开奖
    public function draw()
    {
        if (!$this->data) return false;
        while (true) {
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
            sleep(1);
        }
    }

    public function drawV2()
    {
        var_dump("drawV2");
        \think\facade\Log::info("drawV2843");
        var_dump($this->data);
        if (!$this->data) return false;
        try {
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
