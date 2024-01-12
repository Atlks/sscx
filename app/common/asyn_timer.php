<?php


// php   app/common/timer.php

//添加异步task
function swoole_timer_afterx($fun, $args, $delaytime_sec)
{
  try{
    $get_included_files553 = get_included_files();
    require_once __DIR__ . "/../../lib/iniAutoload.php";
    $get_included_files553 = get_included_files();
    require_once __DIR__ . "/../../lib/file.php";
    log23::Timerinfo(__LINE__.__METHOD__, "args", json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));


    $exeTime = $delaytime_sec + time();

    $nextFuncIvkTxt = asyn_build_async_task($fun, $args, $exeTime);
    $fil = sprintf("%s/../../pushmsg/%s_%s.txt", __DIR__, time(), rand());
    file_put_contentsx($fil, $nextFuncIvkTxt);

  }catch(\Throwable $ex){
    var_dump($ex);

  }


}

//构建异步task
function asyn_build_async_task($fun, mixed $arg1214, int $exeTime)
{
    log23::Timerinfo(__LINE__.__METHOD__, "args", json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));

    $obj = array("fun" => $fun, "args" => $arg1214, "exeTime" => $exeTime, "crt_time" => date("Y-m-d his"));
    $nextFuncIvkTxt = json_encode($obj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    return $nextFuncIvkTxt;
}

//任务执行
function async_timer_start()
{

    require_once __DIR__ . "/../../lib/iniAutoload.php";
    log23::Timerinfo(__METHOD__, "args", json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));


    try {
        $dir = sprintf("%s/../../pushmsg/", __DIR__);

        $list = scandir($dir);
//ob_start();
        var_dump($list);
        log23::Timerinfo(__METHOD__, "filelist", json_encode($list, JSON_UNESCAPED_UNICODE));

        $a = [];
        foreach ($list as $fil_basename):

            if (basename($fil_basename) == ".gitkeep" || basename($fil_basename) == "." || basename($fil_basename) == "..")
                continue;
            if ($fil_basename == "oked")
                continue;

            call_user_func_arrayx("asyn_item_task_process", array($fil_basename));
            // item_task_process($fil_basename);

        endforeach;
    } catch (\Exception $exception) {

        var_dump($exception);
        log23::Timererr(__METHOD__, "", __METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
        log23::Timererr(__METHOD__, "e", $exception);

    }
    var_dump(11);


}

//任务执行core  单个任务
function asyn_item_task_process($fil_basename)
{
    $allIncFile = get_included_files();
    require __DIR__ . "/../../lib/iniAutoload.php";
    $allIncFile = get_included_files();
    require_once __DIR__ . "/../../lib/file.php";
    require_once __DIR__ . "/../../lib/str.php";
    require_once __DIR__ . "/../../lib/fun.php";

    $dir = sprintf("%s/../../pushmsg/", __DIR__);



        $filpath = sprintf("%s%s", $dir, $fil_basename);
        $txt = file_get_contents($filpath);


        $task = json_decode($txt, true);
        $exe_tmstp = $task['exeTime'];


        if (time() > $exe_tmstp) {
            //move to oked mq
            $taskFinishDir = sprintf("%soked/", $dir);
            file_mov($filpath, $taskFinishDir);

            log23::Timerinfo(__METHOD__, "****************redy to exe,rd txt=>" . $txt);
            var_dump($fil_basename);
            var_dump($txt);
            $funx = $task['fun'];
            $fun123 = str_parseToFunExprs($funx);
            $args = $task['args'];
            call_user_func_arrayx($fun123, $args);
            // $cls->$meth($task);
        }



}



//try {
//    log23::Timerinfo(__METHOD__, "args", json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
//
//
//
//} catch (\Throwable $exception) {
//    // log23::Timererr(__METHOD__,$exception)
//    var_dump($exception);
//    log23::Timererr(__METHOD__, "", json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
//    log23::Timererr(__METHOD__, "e", $exception);
//    // \think\facade\Log::error(__METHOD__.json_encode(func_get_args(),JSON_UNESCAPED_UNICODE));
//
//
//}

////emhance log ex
//function call_user_func_arrayx(array $fun123, mixed $args)
//{
//    var_dump(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
//    log23::info(__LINE__ . __METHOD__, "Arg", func_get_args());
//    try {
//        call_user_func_array($fun123, $args);
//
//    } catch (\Throwable $exception) {
//
//        log23::err(__METHOD__, "arg", func_get_args());
//        log23::err(__METHOD__, "e", $exception);
//
//    }
//}
//
///**
// * @param mixed $funx
// * @return array
// */
//function str_parseToFunExprs(mixed $funx): array
//{
//    $arr = explode(".", $funx);
//    $classname = $arr[0];
//    $meth = $arr[1];
//
//    $fun123 = array(new $classname(), $meth);
//    return $fun123;
//}
//
///**
// * @param string $dir_oked
// * @param string $filpath
// * @param $fil_basename
// * @return void
// */
//function file_mov(string $filpath, string $dir_oked): void
//{
//    if (!file_exists($dir_oked))
//        mkdir($dir_oked);
//
//    $fil_basename=basename( $filpath);
//    rename($filpath, $dir_oked . $fil_basename);
//}

//   call_user_func(array($cls,$meth),$obj);
//                if($meth=="putUrl")
//                {
//                    $cls->putUrl   ( $obj);
//                }
