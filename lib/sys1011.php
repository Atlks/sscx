<?php



function call_inTpX(string $f ) {

  require __DIR__ . '/../vendor/autoload.php';


  $GLOBALS['fun641'] = $f;
  $GLOBALS['prm641'] = [];
  $GLOBALS['callbackFun'] = function (){};

  // 应用初始化
  $console  = (new \think\App())->console;
 // $console->$catchExceptions=false;
  $console->run();
}


//call_inTp("main101", ["prm....123"], function ($ret) {
////  echo $ret;
//  //$GLOBALS['ret641'];
////  echo 99;
//});
function call_inTp(string $f, array $prm, Closure $retCall) {

  require __DIR__ . '/../vendor/autoload.php';


  $GLOBALS['fun641'] = $f;
  $GLOBALS['prm641'] = $prm;
  $GLOBALS['callbackFun'] = $retCall;

  // 应用初始化
  (new \think\App())->console->run();
}
