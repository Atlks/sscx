


<?php
$GLOBALS['reqchain']="rcv125";
include "logx.php";
\log_setReqChainLog_enterMeth("METH",123);


$curMethod=__CLASS__.":".__FUNCTION__. json_encode(func_get_args()). " sa ".__FILE__ . ":" . __LINE__;
            require_once __DIR__."/../../lib/logx.php";
            \libspc\log_err_tp( $exception,$curMethod,"beterror");





login info  impinfo   主要流程dsl


每个method 后记录执行的method。。。  __FUNCTION__. json_encode(func_get_args())



记录log info的时候，linnume单独一行，不如可能参数太多记录不下。。记录的meth也要加上前导说名，不然可能于fun()混淆。。输出info数据结果要加上title head 说明

            $curMethod=__CLASS__.":".__FUNCTION__. json_encode(func_get_args()). " sa ".__FILE__ . ":" . __LINE__;
            \think\facade\Log::betnotice ("at file:". __FILE__ . ":" . __LINE__ );
            \think\facade\Log::betnotice ( "at method:".__CLASS__.":".__FUNCTION__. json_encode(func_get_args()) );
            \think\facade\Log::betnotice("ret params:" .json_encode($params));