
<?php

//function betstrX__fmt_lhc($text) {
//
//
//}


function betstrX__fmt_lhc($txt) {
  $txt = str_replace("z", "庄", $txt);
  $txt = str_replace("x", "闲", $txt);
  return $txt;
}