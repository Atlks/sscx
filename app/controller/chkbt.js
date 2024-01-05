

$last_id = 0;  //offset

while (true) {

    $res = $bot->getUpdates($last_id, 100, 10, ["message", "callback_query"]);
    foreach ($res as $update) {



    }



}