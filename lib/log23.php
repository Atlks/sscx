<?php
require __DIR__ . '/../vendor/autoload.php';
//require  __DIR__."/iniAutoload.php";
  class log23
{
//    public function __construct($name)
//    {
//        echo 777;
//    }

   static function __callStatic($method, array $arguments)
   //__st  __call($method, array $arguments)
    {
        ob_start();
        var_dump($method);
        var_dump($arguments);
       // \libspc\log_to_tp($arguments[0],$arguments[1],$arguments[2],$method);
ob_end_clean();

        $varname = isset($arguments[1])?$arguments[1]:"";
        $varVal=isset($arguments[2])?$arguments[2]:"";


        \libspc\log_phpV2($arguments[0], $varname, $varVal,$method);
    }

    // 没啥鸟用  必须实例化对象先才可
    function __invoke($prm)
    {
        echo $prm;

    }

}

// $c= new log23();
//$c(66);
//log23::err23(__METHOD__,"obj123","dataxxx");
//log23::err215(__METHOD__,"obj123",new Exception("000"));