<?php




$list = scandir(__DIR__ . "/req/");
//ob_start();
var_dump($list);


$a = [];
foreach ($list as $fil)
{
    if(basename($fil)==".gitkeep" || basename($fil)=="." || basename($fil)=="..")
        continue;
    var_dump($fil);

 $ftime=   filemtime($fil);
 $span=time() - $ftime;

 if( $span >55)

 {
     rename(__DIR__."/req/".$fil,__DIR__."/reqPrced/".$fil);
 }


}

var_dump($a);