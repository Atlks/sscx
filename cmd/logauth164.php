<?php


while(true)
{



  $cmd="  chmod -R 777 /www/wwwroot/game.gq1sx.cc/runtime";
  echo $cmd;
  try {
    system($cmd);

  } catch (\Throwable $exception) {

    var_dump($exception);


  }

  sleep(300);

  // sleep(3); for test
  //call_user_func_arrayx("sleep",array(300));
  // sleep(60*5);
}