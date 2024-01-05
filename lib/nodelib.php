<?php


function fs_readFileSync($f,$code)
{
    return file_get_contents($f);
    
}


function ssplit(string $spltr)
{
    $a["fun"]="split";
    $a["prm"]=$spltr;
    return $a;
}

function s($data,   $ssplitOBj)
{
    if($ssplitOBj["fun"]=="split")
        return explode($ssplitOBj["prm"],$data);
}

function strx_split(  $spltr,$data)
{
   // return explode();
}

function     console_log($line)

{
    echo $line."\r\n";

}