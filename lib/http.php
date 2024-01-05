<?php

//require_once __DIR__."/iniAutoload.php";
//$GLOBALS['reqchain']="reqxxx";
//$GLOBALS['logdir']=__DIR__."/../runtime/";
//echo http_get_curl("https://www.google.com");


/**
 * @param $url string
 * @param $prm
 * @return false|string
 */
function http_post(string $url, $prm)
{
  var_dump(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => $prm,
    ),
  );

  $context  = stream_context_create($options);

  $file_get_contents = file_get_contents($url, false, $context);
  var_dump($file_get_contents);
  return $file_get_contents;
}



function http_get_curl($url, $timeout = 3) {
  //lign info no yiyi toomany blog..only log into reqchain log file is ok..
  log_enterMeth_reqchain(__LINE__ . __METHOD__, func_get_args()); //login to invchain
  log_enterMethinfo_toLiblog(__LINE__ . __METHOD__, func_get_args(), "httplib");

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


    log_info_toReqchain(__LINE__ . __METHOD__, "curlrzt", $output);
    log23::httplib(__LINE__ . __METHOD__, "curlrzt", $output);

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


// todo maybe need two ways httpget
// enhance log n ex  n timeout retry
function http_get($url) {

  log_enterMeth_reqchain(__LINE__ . __METHOD__, func_get_args()); //login to invchain
  log_enterMethinfo_toLiblog(__LINE__ . __METHOD__, func_get_args(), "httplib");

  \think\facade\Log::notice(__METHOD__ . json_encode(func_get_args()));
  //if this data ,ret true
  //  if (!$this->data) return false;
  $timeout = 0;
  $i = 0;
  while (true) {
    $i++;
    if ($i > 5)
      break;
    $timeout++;
    if ($timeout > 10)
      new think\exception\HttpException("timeout,url:".$url);
     // return "@timeout";


    try {


      //"https://api.kzx71.vip/getLastNo"
      return file_get_contents($url);


    } catch (\Throwable $e) {
      $exception = $e;
      log_err_toReqChainLog(__METHOD__,$exception);
      //log to lib log  nnnn lib errlog
      log_err_toLibLog(__LINE__ . __METHOD__, $exception, "httplib");


      //log to glb err
      log_e_toGlbLog($exception, __LINE__ . __METHOD__, func_get_args());

      var_dump($e);
    }

    sleep(1);
  }
}
