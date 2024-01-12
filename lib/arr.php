<?php
function array_replace_lastone(&$arr911, $lastball) {
  array_pop($arr911);
  array_push($arr911,$lastball);
}
function getRowCells(int $rowIdx, array $colss, $f ): array {
  $a = [];

  if ($rowIdx == 4) {
    echo 2;
  }


  //gene row
  $colIdx = 1;
  foreach ($colss as $k => $col) {
    if ($rowIdx == 4 && $colIdx == 5)
      echo 3;
    //  echo "rowIdx" . $rowIdx . " colIdx" . $colIdx . "\r\n";
    if ($rowIdx >= count($col))
      break;
    $cell = $col[$rowIdx];
    if (!$cell)
      break;

    //todo biz code
    // $cell=$f($cell);

    $cell=$f($cell);



    array_push($a, $cell);
    $colIdx++;
  }


  return $a;
}



/**
 * @param $records
 * @return array
 */
function spltToCols($records, $perColRowsCnt): array {


  $colss = [];
  // $perColRowsCnt = 6;

  while (true) {
    $curCol = array_slice($records, 0, $perColRowsCnt);
    if (count($curCol) == 0)
      break;
    array_push($colss, $curCol);
    require_once __DIR__ . "/../lib/queue.php";
    array_removeElmt($records, 0, $perColRowsCnt);

  }
  return $colss;
}
function array_key713(string $string, $v_cell) {
  if (!array_key_exists($string, $v_cell))
    return "";

  return $v_cell[$string];
}

//print_r(testGrpby());;
function _testGrpby() {

  $rows524 = [["球" => 'a', "玩法" => "数字玩法", 'Bet' => 2],
    ["球" => 'b', "玩法" => "大小单双", 'Bet' => 3]];

  $rows524 = grpbyV3($rows524, ['球', '玩法'], function ($coll, $grpbyColVal) {
    return [
     // $grpbyColName => $grpbyColVal,
      '玩法' => $coll[0]['玩法'],
      '球' => $coll[0]['球'],
      "sum" => array_sum_col("Bet", $coll)
    ];
  });

  return $rows524;

}


function grpbyV3($rows,   $grpbyColss, $funSlkt) {

  $grpbyColName='cmbCols_'.join("_",$grpbyColss);
  $rows = array_map(function ($row) use ($grpbyColss,$grpbyColName) {
    $row[$grpbyColName] =join_cols_val($row,$grpbyColss) ;
    return $row;

  }, $rows);


  $rets=[];
  $grpbyColVals=arr_col_uniq($rows,$grpbyColName);

  foreach ($grpbyColVals as $grpbyColVal)
  {
    //  var_dump($grpbyColVal);
    $coll_whereGrpcol=array_where($rows,$grpbyColName,$grpbyColVal);
    $rets[]= $funSlkt($coll_whereGrpcol,$grpbyColVal);
  }
  return $rets;


}

function grpbyV2($rows,   $grpbyColss, $funSlkt) {


  $rows = array_map(function ($row) use ($grpbyColss) {
    $row['grpby_colss'] =join_cols_val($row,$grpbyColss) ;
    return $row;

  }, $rows);


  $rets=[];
  $grpbyColVals=arr_col_uniq($rows,'grpby_colss');

  foreach ($grpbyColVals as $grpbyColVal)
  {
    //  var_dump($grpbyColVal);
    $coll_whereGrpcol=array_where($rows,'grpby_colss',$grpbyColVal);
    $rets[]= $funSlkt($coll_whereGrpcol,$grpbyColVal);
  }
  return $rets;


}

function join_cols_val($row, $grpbyColss ) {

  $a=[];
   foreach ($grpbyColss as $c)
   {
     $a[]=$row[$c];
   }

   return join("__",$a);
  //$row['球'] ."__". $row['玩法']
}

//only one col
function grpby($rows, string $grpbyCol, $funSlkt) {
  $rets=[];
  $grpbyColVals=arr_col_uniq($rows,$grpbyCol);

  foreach ($grpbyColVals as $grpbyColVal)
  {
  //  var_dump($grpbyColVal);
    $coll_whereGrpcol=array_where($rows,$grpbyCol,$grpbyColVal);
    $rets[]= $funSlkt($coll_whereGrpcol,$grpbyColVal);
  }
  return $rets;


}

function arr_col_uniq($rows, string $grpbyCol) {
  $colsVal_arr=  array_column($rows,$grpbyCol);
  $colsVal_arr= array_unique ($colsVal_arr);
  return $colsVal_arr;
}

function array_where($rows, $col, $val) {
  return  array_filterx($rows,function ($row) use($col,$val){
    if($row[$col]==$val)
      return true;
  });
}



function array_sum_col($colName,array $a) {
  $records=  array_column($a, $colName);
  return array_sum($records);
}


function in_array_rxChk(string $txt, array $arr_fmt) {

  $fnl=false;
  foreach ($arr_fmt as $itm) {
    if (empty($itm))
      continue;

    $p = '/^' . $itm . '$/iu';
    if (preg_match($p, $txt)) {
      $fnl=true;
    }

  }
  return $fnl;
}

//$f=__DIR__."/../dbKaijSrc/kaijsrc.json";
//require_once "file.php";
//$json=file_get_contents_Asjson($f);
//$rows=array_filterx($json['data'],function ($row){
//    $gameRecord=$row['gameRecord'];
//
//  $find = "3$";
//  if(startwithV1252($gameRecord,$find))
//      return true;
//});
//echo count($rows);

function startwithV1252($str,$pattern) {
  return (strpos($str,$pattern) === 0 )? true:false ;
}

function  arr_select($f,$rows) {
  return array_map($f,$rows);

}

function  arr_where($arr,$f) {
  return array_filter_where($arr,$f);

}

function array_filter_where($arr,$f)
{

  $seltedRow = [];



  foreach ($arr as $k => $row) {
    if ($f($row))
    {
      $seltedRow[]=$row;

    }
  }
  return $seltedRow;
}


function array_filterx($arr,$f)
{

  $seltedRow = [];
//  array_filter($json['data'],  function ($row) use ($gameNo,$seltedRow) {
//
//    if ($row['gameNo']==$gameNo)
//    {
//      $seltedRow[]=$row;
//      return true;
//    }
//    //  return true;
//
//   // return  false;
//
//
//  });


  foreach ($arr as $k => $row) {
    if ($f($row))
    {
      $seltedRow[]=$row;

    }
  }
  return $seltedRow;
}




function array_toStndMode($rows524, Closure $param) {

  $a = [];
  foreach ($rows524 as $r) {
    $a[] = $param($r);
  }

  // $rows524 = array_map($param, $rows524);
  return $a;

}
