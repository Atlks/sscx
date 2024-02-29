<?php

// tpuse.php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/../lib/ex.php";
loadErrHdr();



require_once __DIR__ . "/../config/console.php";
imptTplib();

// composer update topthink/framework
var_dump(9999);
$rows_dxds = \think\facade\Db::query("select * from db1.t1  ");
// $rows_dxds = \think\facade\Db::query("select 1 as c1 from db1.t1  ");
var_dump($rows_dxds);

$rzt=\think\facade\Db::execute("update db1.t1 set c1='000' ");
var_dump($rzt);

var_dump($rows_dxds[0]['c1']);



































