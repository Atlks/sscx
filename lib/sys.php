<?php
namespace sysx;

// 清理无用的头输出
function clr(){

    ob_start();

    // ......

    ob_end_clean();
}



