<?php


//   config/console.php



class imptTp1129 extends think\console\Command {
    protected function configure() {
        $this->setName('calltp2')->setDescription('Here is the remark ');
    }

    protected function execute(think\console\Input $input, think\console\Output $output) {
        //$output->writeln("TestCommand:");
        var_dump(111);
    }
}


// +----------------------------------------------------------------------
// | 控制台配置
// +----------------------------------------------------------------------
return [
    // 指令定义
    'commands' => [


        'keywdReqHdlr' => 'app\common\keywdReqHdlr',
      'msgHdlrLhc' => 'app\common\msgHdlrLhc',




        'imptTp'=> '\imptTp1129',

        
    ],
];
