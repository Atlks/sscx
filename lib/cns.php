<?php

$t=file_get_contents("3500.txt");
$t=str_replace("\r\n","",$t);

echo json_encode($t);
$arr=explode("\r\n",$t);

foreach ($arr as $ch)
{

  echo $ch;
}



