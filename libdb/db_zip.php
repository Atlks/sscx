<?php

//dep

$path_data_item = "d:/row3.json";
$map=array(
    "name" => "bar",
    "id" => 33,
);
file_put_contents($path_data_item,json_encode($map));







$filename = "db1.zip";
$zip = new ZipArchive();
$zip -> open($filename, ZipArchive::CREATE);  //打开压缩包
//$zip -> addFile($path_data_item, basename($path_data_item));  //向压缩包中添加文件
$zip->addFromString('row3.txt', json_encode($map));


//--------add rcd2
$path_data_item = "d:/row2.json";
$map=array(
    "name" => "bar22",
    "id" => 22,
);
file_put_contents($path_data_item,json_encode($map));
$zip -> addFile($path_data_item, basename($path_data_item));  //向压缩包中添加文件


$zip -> close(); //关闭压缩包