<?php

// php app/common/lgt.php

$msgid=1234;
$logf= __DIR__ . "/../../zmsglg/" .date('Y-m-d H')."".$msgid.".json";
if(file_exists($logf))
{
    file_put_contents($logf,"1123");
     echo "existttt";
     die();
}
echo 999;