const { exec, execSync } = require('child_process');

// node lib/exec.js
const args = process.argv.slice(2)
args[0]
msg = args[0];
//  $cmd = $phpexe . " " . $filename . "    keywdReqHdlr  " . urlencode(json_encode($msg));
$phpexe = "php";
// $tlghr_msg_hdl = " C:\\w\\jbbot\\tlgrmHdl_temacyo.php ";
filename = __dirname + "/../think";
cmd = $phpexe + " " + filename + "   keywdReqHdlr    " + msg;
console.log(cmd)
execSync(cmd)


console.log(999)