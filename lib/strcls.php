<?php

class strcls
{


    //检查字符串是否以特定的子字符串开头
  static  function startsWith($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }

    static  function contain($string, $needstr)
    {
        $len = strstr($string,$needstr);
        if( $len==false)
            return false;
        else
            return  true;
    }


}