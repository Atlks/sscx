<?php

// 防止循环应用 avoid   for ref
function reqrOnce($filename)
{
    require_once $filename;
    return;

    global $InIncFiles;
    $xxx = get_included_files();
    $lev = "dbg104";
    $basename = strtolower(basename($filename));
    if (!file_exists($filename))
        return;

    //che  xunhwe ref
    if (InIncFiles($filename)) {

        error_log(__METHOD__ . "()  exist file alrdy inc:" . $filename . "\r\n", 3, __DIR__ . "/../runtime/$lev.log");
        return;
    }

    if ($GLOBALS['incfils'] == null)
        $GLOBALS['incfils'] = [];

    if (array_search($basename, $GLOBALS['incfils'])) {
        $lev = "dbg104";
        error_log(__METHOD__ . "() jude Glbs{incfils], exist file alrdy inc:" . $filename . "\r\n", 3, __DIR__ . "/../runtime/$lev.log");
        return;
    }


    //start inc
    error_log(__METHOD__ . "()    file inc:" . $filename . "\r\n", 3, __DIR__ . "/../runtime/$lev.log");
    require_once $filename;
    if( $GLOBALS['incfils'] ==null) $GLOBALS['incfils']=[];
    $GLOBALS['incfils'][] = $basename;
};


function InIncFiles (string $searchFile)
{
    $get_included_files553 = get_included_files();
    foreach ($get_included_files553 as $f1) {
        $basename2 = strtolower(basename($searchFile));
        $basename = strtolower(basename($f1));
        if ($basename2 == $basename) {

            return true;
        }

    }
    return false;
};

//function reqrOnce($filename)
//{
//    $basename = strtolower(basename($filename));
//    if (!file_exists($filename))
//        return;
//
//    //che  xunhwe ref
//    if (!InIncFiles($fname)) {
//        log23::autoload4(__METHOD__, "", $fname);
//
//        require_once $fname;
//        $get_included_files553 = get_included_files();
//    } else {
//        log23::autoload4(__METHOD__, " exist file inc:", $fname);
//    }
//}

 function iniAutoload820($libnames)
{
     global $reqrOnce, $InIncFiles;
    ob_start();

    $allIncFile = get_included_files();

    $logdir = __DIR__ . "/../../runtime/";
    $GLOBALS['logdir'] = $logdir;

//--------autoload  autoreq

//------------------auto load functions
   reqrOnce(__DIR__ . "/../app/common/betstr.php");
    $dirs307 = '/../../lib/,/../lib/,/lib/,/';
    $arr_dirs = explode(",", $dirs307);

    $arr_libs307 = explode(",", $libnames);
   reqrOnce(__DIR__ . "/autoloadx.php");
   reqrOnce(__DIR__ . "/log23.php");
    foreach ($arr_dirs as $dir) {
        foreach ($arr_libs307 as $libnm) {

            $fname = __DIR__ . $dir . $libnm . '.php';
            if (!file_exists($fname))
                continue;

            //che  xunhwe ref
            if ($InIncFiles($fname)) {
                log23::autoload4(__METHOD__, " exist file inc:", $fname);
                continue;
            }


            log23::autoload4(__METHOD__, "", $fname);
           reqrOnce($fname);


        }
    }

    spl_autoload_register(function ($class_name) {
        // var_dump($class_name);  //"ltrx"
        ob_start();
        if (file_exists(__DIR__ . "/../../lib/" . $class_name . '.php'))
            require_once __DIR__ . "/../../lib/" . $class_name . '.php';

        else if (file_exists(__DIR__ . "/../lib/" . $class_name . '.php'))
            require_once __DIR__ . "/../lib/" . $class_name . '.php';
        else if (file_exists(__DIR__ . "/lib/" . $class_name . '.php'))
            require_once __DIR__ . "/lib/" . $class_name . '.php';
        else if (file_exists(__DIR__ . "/" . $class_name . '.php'))
            require_once __DIR__ . "/" . $class_name . '.php';

        ob_end_clean();

    });

    ob_end_clean();

};


//function ini_autoload820xx($libnames)
//{
//
//// ******************  use age::   require __DIR__ . "/../lib/iniAutoload.php";
//    ob_start();
//
//    $allIncFile = get_included_files();
//    foreach (get_included_files() as $f1) {
//
//        $basename = basename($f1);
//
//
//    }
//    $logdir = __DIR__ . "/../../runtime/";
//    $GLOBALS['logdir'] = $logdir;
//    require_once __DIR__ . "/../config/cfg.php";
////--------autoload  autoreq
////$GLOBALS['refLib419']='strx';
//
////require_once __DIR__."/log23.php";
////  require_once __DIR__ . "/lotrySscV2.php";
//
////if(require_once )
////require_once __DIR__."/../app/common/betstr.php";
////------------------auto load functions
//    require_once __DIR__ . "/../app/common/betstr.php";
//    $dirs307 = '/../../lib/,/../lib/,/lib/,/';
//    $arr_dirs = explode(",", $dirs307);
//    // $libnames = "betstr,dwijyo,ex,json,kaijx,logx,ltrx,str,strcls,strx,tlgrmV2,betstr,encodex,lotrySscV2,log23";
//    $arr_libs307 = explode(",", $libnames);
//
////$key = array_search($GLOBALS['refLib419'], $arr_libs307);
////if ($key !== false) {
////    //  unset($arr_libs307[$key]);
////}
//
//    $get_included_files553 = get_included_files();
//
//    require_once __DIR__ . "/autoloadx.php";
//    foreach ($arr_dirs as $dir) {
//        foreach ($arr_libs307 as $libnm) {
//
//            $fname = __DIR__ . $dir . $libnm . '.php';
//            if (!file_exists($fname))
//                continue;
//
//            //che  xunhwe ref
//            if (!InIncFiles($fname)) {
//                log23::autoload4(__METHOD__, "", $fname);
//
//                require_once $fname;
//                $get_included_files553 = get_included_files();
//            } else {
//                log23::autoload4(__METHOD__, " exist file inc:", $fname);
//            }
//
//
//        }
//    }
//    ob_end_clean();
//
//}