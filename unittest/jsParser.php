<?php


$txt = file_get_contents(__DIR__ . "/0befFmtChk.js");
//echo $txt;
$txt="var data = fs.readFileSync('betFmtChk.txt', 'UTF-8');";

/**
 * @param bool|string $txt
 * @return array
 */

$line_fnl = parseLines($txt);

foreach ($line_fnl as $line) {

  if (assignStmt($line)) {
    $arr = explode("=", $line);
    $var = $arr[0];
    $val = $arr[1];

    $funname = getFunname($val);
    $funArgs = getArgs($val);
    console_log(111);
  }
}


function parseLines(bool|string $txt): array {
  $line_fnl = [];
  $Lines = explode("\r\n", $txt);
  foreach ($Lines as $line) {

    $Lines448 = explode(";", $line);
    $line_fnl = array_merge($line_fnl, $Lines448);

  }
  $line_fnl = array_filter($line_fnl);
  return $line_fnl;
}


function assignStmt($line) {
  return str_contains($line, "=");
}


function getFunname(string $val) {
  $firstLeftBrk = strpos($val, "(");
  return substr($val, 0, $firstLeftBrk);

}


//var_dump(getArgs(" (aab) "));
function getArgs(string $val) {


  $firstLeftBrk = strpos($val, "(");
  $lastBrk = strpos($val, ")");
  return substr($val, $firstLeftBrk + 1, $lastBrk - $firstLeftBrk - 1);
}
