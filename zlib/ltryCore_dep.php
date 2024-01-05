<?php
require_once __DIR__ . "/lotrySscV2.php";
require_once __DIR__."/../../lib/str.php";
require_once __DIR__."/../../lib/iniAutoload.php";
require_once __DIR__."/../../config/cfg.php";


//$wefa413 =\ltryCore:: getWefa("1.单.100");
//$wefa413=11;
class ltryCore{



   static function getWefa($bet_nums)
    {

        // $arr = http_query_toArr($GLOBALS['msgrex']);
        $arr = http_query_toArr($GLOBALS['msgrex']);
        foreach ($arr as $itm) {
            if (empty($itm))
                continue;

            $wefa=key($itm);
            $rx=current($itm);


            $p = '/^' . $rx . '$/iu';
            if (preg_match($p, $bet_nums)) {
                print_rx("     match.." . $p . " " . $bet_nums);
                return   $wefa;
            } else
                print_rx("   not match.." . $p . " " . $bet_nums);
        }
        //  return msgHdlrOther($bet_nums);
    }
}