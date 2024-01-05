<?php


while(true) {



  $dbms='mysql';     //数据库类型
  $host='localhost'; //数据库主机名
  $database = parse_ini_file(__DIR__ . "/../.env")['database'];
  $username= parse_ini_file(__DIR__ . "/../.env")['username'];
  $password= parse_ini_file(__DIR__ . "/../.env")['password'];
  $dsn="$dbms:host=$host;dbname=$database";


  try {
    $dbh = new PDO($dsn, $username, $password); //初始化一个PDO对象
    echo "连接成功<br/>";

    $count = $dbh->exec("update bet_record set `Status`=1  where status=0");
    var_dump("cnt=>".$count);
  } catch (\Throwable $e) {
      var_dump($e);
  }

  sleep(150/1);
}
