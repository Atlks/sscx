<?php

require_once __DIR__."/../app/calltp.php";
require_once __DIR__."/../lib/calltpx.php";
// +----------------------------------------------------------------------
// | 控制台配置
// +----------------------------------------------------------------------
return [
    // 指令定义
    'commands' => [
        'runx' => 'app\main',
      'cmd_lhc' => 'app\commonLhc\CmdLhc',

      'swoole2' => 'app\common\mainx',
        'keywdReqHdlr' => 'app\common\keywdReqHdlr',
      'msgHdlrLhc' => 'app\common\msgHdlrLhc',

      'ssc_main' => 'app\common\mainx',
      'testx' => 'app\common\testCls',
      'calltp'=>'\calltp',
      'calltpx'=> '\calltpx', 'imptTP'=> '\calltpx',
        
    ],
];
