<?php







function breakStopHere($funname,$fun_args,$line,$vars_arr,$fil)
{
  ob_start();
    echo $funname."(".json_encode($fun_args,JSON_UNESCAPED_UNICODE) .") ".$fil.":". $line."\r\n";
   $var_loc1=11;
  //  $vars_arr = get_defined_vars();
    file_put_contents( "j634.json",json_encode($vars_arr ) );
//var_dump($vars_arr);


    $vars_arr_tojson=json_decode(  json_encode($vars_arr));

    $arr_loc=[];
    foreach ($vars_arr_tojson as $key => $value) {
        if (!str_starts_with ($key, "_"))
        {
            $arr_loc[$key]=$value;
            echo "$key=>$value\n";
        }

    }

    var_dump($arr_loc);
    $info=ob_get_contents();
    ob_end_flush(); //show scr
     file_put_contents("out727.txt.log",$info.PHP_EOL,FILE_APPEND);

    die();

}


// cant use arr filter ,bcs for only value ,cant not key..cant filter,,,can convt to json can for is ok ,can see key


//function clrSvrVar ($var) {
//
//    var_dump($var);
////    $key=key($var);
////    if (str_starts_with ($key, "_"))
////        return false;
//
//    // else if (startsWith($var, "msghdl"))
//    return true;
//}
//
//$vars_arr = array_filter($vars_arr, "clrSvrVar");


//var_dump($vars_arr);
//var_export(get_defined_vars());