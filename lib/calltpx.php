<?php



use think\console\Command;
use think\console\Input;
use think\console\Output;

class calltpx extends Command {
  protected function configure() {
    $this->setName('calltp2')->setDescription('Here is the remark ');
  }

  protected function execute(Input $input, Output $output) {
    //$output->writeln("TestCommand:");
    var_dump(111);
  }
}