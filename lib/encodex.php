<?php
namespace  encodex;


function encode_funName($funname)
{
    $fname=str_replace(".","_",$funname);
  return  trim( $fname) ;

}
