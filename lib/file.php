<?php
function file_mov(string $filpath, string $dir_oked): void
{
    if (!file_exists($dir_oked))
        mkdir($dir_oked);

    $fil_basename = basename($filpath);
    rename($filpath, $dir_oked . $fil_basename);
}


function file_get_contents_Arr(string $f) {

  return file($f);
}

function file_get_contents_Asjson($f) {
  $t=file_get_contents($f);
  $json = json_decode($t, true);
  return $json;
}
function file_put_contentsx($file, $dt, $flg = FILE_APPEND) {


  try {
    var_dump(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));


    log23::info(__LINE__ . __METHOD__, "Arg", func_get_args());

    //检查是否有该文件夹，如果没有就创建，并给予最高权限
    if (!file_exists(dirname($file)))
      mkdir(dirname($file), 0777, true);
    file_put_contents($file, $dt, $flg);
  } catch (\Throwable $exception) {
    try {
      var_dump($exception);
      log23::err(__LINE__ . __METHOD__, "arg", func_get_args());
      log23::err(__LINE__ . __METHOD__, "e", $exception);

    } catch (\Throwable $exception2) {
      var_dump($exception2);
    }

  }


}

function file_get_contentsx($file)
{
    var_dump(__METHOD__ . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE));
    log23::info(__LINE__ . __METHOD__, "Arg", func_get_args());
    try {
        file_get_contents($file);
    } catch (\Throwable $exception) {
        var_dump($exception);
        log23::err(__LINE__ . __METHOD__, "arg", func_get_args());
        log23::err(__LINE__ . __METHOD__, "e", $exception);

    }

}

//function file_mov(string $filpath, string $dir_oked): void
//{
//    if (!file_exists($dir_oked))
//        mkdir($dir_oked);
//
//    $fil_basename=basename( $filpath);
//    rename($filpath, $dir_oked . $fil_basename);
//}