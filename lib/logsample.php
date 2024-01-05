<?php

//require_once __DIR__."/iniAutoload.php";
//$GLOBALS['reqchain']="reqxxx";
//$GLOBALS['logdir']=__DIR__."/../runtime/";
//echo http_get_curl("https://www.google.com");


function http_get_curl($url, $timeout = 3)
{
    //lign info no yiyi toomany blog..only log into reqchain log file is ok..
    log_enterMeth_reqchain(__LINE__ . __METHOD__, func_get_args()); //login to invchain
    log_enterMethinfo_toLiblog(__LINE__ . __METHOD__, func_get_args(),"httplib");

    var_dump(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));

    try {
        //create a new cURL resource
        $curl = curl_init();
// set URL and other appropriate options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, []);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl);
        var_dump($output);;
        curl_close($curl);
        log23::httplib(__LINE__ . __METHOD__,"curlrzt",$output);

        return $output;
    } catch (\Throwable $exception) {
        var_dump($exception);
        log_err_toReqChainLog($exception, __LINE__ . __METHOD__);

        //log to lib log  nnnn lib errlog
        log_err_toLibLog(__LINE__ . __METHOD__, $exception, "httplib");


        //log to glb err
        log_e_toGlbLog($exception, __LINE__ . __METHOD__, func_get_args());


    }


}



// enhance log n ex  n timeout retry
function http_get($url)
{
    \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
    //if this data ,ret true
    //  if (!$this->data) return false;
    $timeout = 0;
    while (true) {
        $timeout++;
        try {
            if ($timeout > 10)
                return "@timeout";

            return file_get_contents("https://api.kzx71.vip/getLastNo");


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
