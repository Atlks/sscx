<?php
$offset = 0;  //
while (true) {

  $res = $bot->getUpdates($last_id, 100, 10, ["message", "callback_query"]);
  foreach ($res as $update) :

    \think\facade\Log::chkbtInfo(json_encode($update, JSON_UNESCAPED_UNICODE));
    $offset = $update->getUpdateId();

    if(alreadyProcessByChkbot)
    {
      $offset += 1;
      continue;
    }

    chkbot_recv();
    sleep(1);  wait wbhk to recv
    chkWbhkRecv??
      if not ,sleep 2s
    reagianChkWbhkRcv??
      if not{
        小飞机漏发信息 了
        process...
      }
  endforeach;



  $last_id += 1;
}