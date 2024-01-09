<?php



$a=['a','b','c','d','e'];

foreach ($a as $v)
{
  for($i=1;$i<10;$i++)
  {
        $wf_fx=$v.$i;

    $sql="insert bet_types set display='特码球',
 regex='\d\/\d\/\d+',bet_min=1000,bet_max=1000000,bet_max_total=1000000,
  odds=9.5,玩法='特码球@wffx@';";
    $sql=  str_replace('@wffx@',$wf_fx,$sql);
    echo $sql.PHP_EOL;

  }
}
