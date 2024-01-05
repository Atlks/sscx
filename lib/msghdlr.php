<?php



function msgDispchr($msg)
{
    // par php file ,get funchtion
}


function cyehose_bet_fullname($betnum)
{
    $betnum = str_replace("前", "前三", $betnum);
    $betnum = str_replace("后", "后三", $betnum);
    $betnum = str_replace("中", "中三", $betnum);
    $betnum = str_replace("豹", "豹子", $betnum);
    $betnum = str_replace("对", "对子", $betnum);
    $betnum = str_replace("顺", "顺子", $betnum);
    $betnum = str_replace("半", "半顺子", $betnum);
    $betnum = str_replace("杂", "杂六", $betnum);
    return $betnum;
}


function cyehose_bet_name($betnum)
{
    $betnum = str_replace("半顺子", "半|", $betnum);
    $betnum = str_replace("前三", "前", $betnum);
    $betnum = str_replace("后三", "后", $betnum);
    $betnum = str_replace("中三", "中", $betnum);
    $betnum = str_replace("豹子", "豹|", $betnum);
    $betnum = str_replace("对子", "对|", $betnum);

    $betnum = str_replace("杂六", "杂|", $betnum);
    $betnum = str_replace("顺子", "顺|", $betnum);

    return $betnum;
}

function msgHdlrTemacyoZuheMode($bet_nums)
{
    $rex = '[abcde][0123456789大小单双]+押\d+';
    $wefa_rex = '/^' . $rex . '$/iu';
    if (preg_match($wefa_rex, $bet_nums)) {
        //  print_rx("     match.." . $p . " " . $numb);
        //start process....
        //cancel even up trance...
        return   "特码球玩法组合模式";
    }
}

function msgHdlrTemacyoDasyaodeshwo($bet_nums)
{

    $rex = '[abcde]\/[大小单双]\/\d+';
    $wefa_rex = '/^' . $rex . '$/iu';
    if (preg_match($wefa_rex, $bet_nums)) {
        //  print_rx("     match.." . $p . " " . $numb);
        //start process....
        //cancel even up trance...
        return   "特码球大小单双玩法";
    } else if (preg_match('/^[abcde][大小单双]\d+$/iu', $bet_nums)) {
        //  print_rx("     match.." . $p . " " . $numb);
        //start process....
        //cancel even up trance...
        return   "特码球大小单双玩法";
    }
}


// 获取玩法
function msgHdlrOther($bet_nums)
{

    //  var_dump($bet_nums);
    $fltMsghdl =  function ($var)
    {

        if (startsWith($var, "msghdlrother"))
            return false;

        else if (startsWith($var, "msghdl"))
            return true;
    };
    $arr = get_defined_functions();
    $arr = $arr['user'];
    // var_dump($arr);

    $arr =  array_filter($arr,  $fltMsghdl);
    //var_dump($arr);

    foreach ($arr as $msghdl654) {
        //   var_dump($msghdl654);
        $wefa = $msghdl654($bet_nums);
        if ($wefa)
            return $wefa  ;
    }


}