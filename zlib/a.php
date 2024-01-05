<?php

require_once __DIR__."/autoloadx.php";
$xxx=get_included_files();
reqrOnce(__DIR__."/b.php")  ;
$xxx=get_included_files();

bf();
var_dump("a9999");


function af()
{
    var_dump("afff");
}