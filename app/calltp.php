<?php

use think\console\Command;
use think\console\Input;
use think\console\Output;

class calltp extends Command {
  protected function configure() {
    $this->setName('calltp')->setDescription('Here is the remark ');
  }

  protected function execute(Input $input, Output $output) {
    //$output->writeln("TestCommand:");
    $ret = call_user_func_array($GLOBALS['fun641'], $GLOBALS['prm641']);

    $GLOBALS['ret641'] = $ret;
    if ($GLOBALS['callbackFun'])
      $GLOBALS['callbackFun']($ret);
  }
}