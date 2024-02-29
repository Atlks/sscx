<?php



$filename = "db1.zip";



$zip = new ZipArchive();

$zip->open($filename);

$zip->deleteName('row1.json');  //删除src.zip压缩包里面的 log.txt文件

$zip->close();


//updt