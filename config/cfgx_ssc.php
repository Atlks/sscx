<?php


//  格式转换模式  单注识别  方便转换标准fmt


//

// 更具标准stand bet to echo
// dep[大小单双]\d+=和值大小单双模式 &  & dep[前中后][豹对顺半杂]\d+=前后三玩法
$rx_echo = " [abcde12345]\/[0123456789大小单双]\/\d+=特码球模式 ";
$GLOBALS['rx_echo'] = $rx_echo;


//MAP....---------------格式转换模式
//  BETSTR,standFmtr
$fmtr_re=['\d+\/\d+'=>"ZonheNmbrStndFmtr"];
$GLOBALS['$fmtr_re_map']=$fmtr_re;


// map------------单注stnd格式=》 玩法（赔率id）

$bet_peilv_map=['[abcde12345]\/\d\/\d+'=>"特码球玩法",
  '[abcde12345]\/[大小单双]\/\d+'=> '特码球大小单双玩法'];
$GLOBALS['bet_peilv_map']=$bet_peilv_map;


//  standFmtr,wanfa-odds(betstr type)
//..1234567890...abcd00
//----------****************单注2模式rx---------- for peilv huocyv
$wefa_rex = ' 特码球玩法=[abcde12345]\/\d\/\d+';     //   a/1/100   分割模式 标准模式    1/1/100   a.1.100
$wefa_rex = $wefa_rex . ' &特码球大小单双玩法=[abcde12345]\/[大小单双]\/\d+';    //  a/大/100 分割模式 标准模式    1/大/100  a.大.100
$wefa_rex = $wefa_rex . '&和值大小单双玩法=总和[大小单双]\d+';
$wefa_rex = $wefa_rex . "&龙虎和玩法龙虎=[龙虎]\d+&龙虎和玩法和=和\d+";
$wefa_rex = $wefa_rex . '&前后三玩法豹子=[前中后]三豹子\d+&前后三玩法顺子=[前中后]三顺子\d+';
$wefa_rex = $wefa_rex . '&前后三玩法对子=[前中后]三对子\d+&前后三玩法半顺=[前中后]三半顺\d+&前后三玩法杂六=[前中后]三杂六\d+';
//$wefa_rex = $wefa_rex . '&和值总和玩法=总和\d+\/\d+';
$GLOBALS['msgrex'] = $wefa_rex;


//-------------------组合模式rx and easy mode...   点|押|操|草|.]
//    [12345]\/[\d大小单双]\/[\d]   >>  a/1/100
$wefa_rex_zuhe = '特码球玩法组合模式=[abcde][0123456789大小单双]+\/\d+';   // a123押100    a123/100  a大小/100
$wefa_rex_zuhe .= '&特码球玩法_abc1.200_组合模式=[abcde]+\d\/\d+';  /// abc1/100 abc1押100   a1/100    a1.100
$wefa_rex_zuhe .= '&特码球玩法_ab_大_100_组合模式=[12345abcde]+[大小单双]\d+';  //  a大100  模式   abc大100  1单200 模式   123单100

$wefa_rex_zuhe .= '&特码球玩法_a_大小_100_组合模式= [12345abcde][大小单双]+\d+ ';  //   a大小单双100   1大小100    1大100
$wefa_rex_zuhe .= ' & 前后三玩法_豹子_对子_顺子_杂六 = [前中后][豹对顺半杂]\d+  ';
$wefa_rex_zuhe .= '&和值大小单双玩法_dx100=[大小单双]+\d+';   //大小100  hzdxdswf_dx100


//$wefa_rex_zuhe .= ' & 特码球玩法_11_100_模式= [12345]\d\/\d+  ';   //   11/100
$GLOBALS['msgrex_zuhe'] = $wefa_rex_zuhe . "&" . $wefa_rex;


//--------------not impt use
////$wefa_rex_zuhe .=  ' & 前后三玩法_豹子_对子_顺子_杂六 = [前中后][]\d+  ';
////$wefa_rex_zuhe .=  ' & 前后三玩法_豹子_对子_顺子_杂六 = [前中后]三[豹对顺]子\d+  ';
//-------------------------------already have
//& [abcde12345]+[大小单双]\d+ = 特码球大小单双玩法_ab12大_模式    already have
//      a/1/100模式   a.1.100模式     1.1.100模式
//$wefa_rex_zuhe .=   ' & 特码球大小单双玩法_a大100_模式=[abcde12345]+[大小单双]\d+ ';  // a大100 abc大100   already have

//？？？
//$wefa_rex_zuhe .=     '  &  特码球玩法_1_syego_大_模式 = \d\/[0123456789大小单双]\/\d+  ';   //  1/1/100   1/单/100   already have

//   $wefa_rex222 .=    ' &特码球玩法abc组合模式 = [12345abcde]+[大小单双]\d+';   //abc大100  already have
// [abcde12345][大小单双]+\d+ = 特码球大小单双玩法_a大小_模式 &    // a大小单双100  already have
//$arr_new =array_merge($wefa_rex_zuhe,$wefa_rex222,$wefa_rex);


//------------------只有三个对外接口  投注输入格式化接口同一个格式化，玩法计算为了获取赔率，回显输出格式化  ，开将接口 兑奖接口
//统一格式化

if (!function_exists("betstrX__split_convert_decode")) {
    function betstrX__split_convert_decode($bet_str_arr_clr)
    {
        return \betstr\split_decode_split($bet_str_arr_clr);
    }


// $bet_nums  单注标准格式


    function betstrX__parse_getWefa($bet_nums)
    {
        return \betstr\getWefa($bet_nums);
    }


    function betstrX__format_echo_ex($text)
    {
        return \betstr\format_echo_ex($text);
    }


    function betstrX__format_echo_grpbyBet($betNoAmt, $amt)
    {
        $echo = \betstr\format_echo_ex($betNoAmt . "99");
        $bet = explode(" ", $echo);
        $money = $amt / 100;
        $betNmoney = $bet[0] . " " . +$money;

        return $betNmoney;
    }


// 开奖结果格式化输出

    function betstrX__convert_kaij_echo_ex($result_text)
    {
        return \betstr\convert_kaij_echo_ex($result_text);
    }


//对讲

    function betstrX__compare_dwijyo($betContext, $kaij_num)
    {
        return dwijyo($betContext, $kaij_num);
    }

}


