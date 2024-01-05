<?php

try{
    \think\facade\Db::listen(function($sql, $runtime, $master) {
        // 进行监听处理
        if(str_contains($sql,"SHOW FULL COLUMNS"))
            return;
      //  echo $sql.PHP_EOL;
        log_info_toReqchain("","sql",$sql);
    });
}catch (\Throwable $e)
{

    log23:err(__FILE__,"e",$e);
}

