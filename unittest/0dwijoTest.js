const fs = require('fs');
const { exec, execSync } = require('child_process');

// read contents of the file
var data = fs.readFileSync('betTrue.txt', 'UTF-8');

// split the contents by new line
var lines = data.split(/\r\n/);

// print all lines
lines.forEach((line) => {
    console.log(line);
    arr = line.split(",");
    betnum = arr[0];
    kaijnum = arr[1]; //encodeURIComponent
    cmd = "php   C:\\modyfing\\jbbot\\unittest/dwijyo.php " + (betnum) + " " + kaijnum;
    console.log(cmd)
    rzt = execSync(cmd).toString();
    rzt = rzt.split("\r\n").pop();
    console.log(rzt)
    if (rzt != "true")
        throw "err pandwe";



})

console.log(111)


// read contents of the file
data = fs.readFileSync('betFalse.txt', 'UTF-8');

// split the contents by new line
lines = data.split(/\r\n/);

// print all lines
lines.forEach((line2) => {
    line = (line2).trim();
    if (line == "")
        return;
    console.log(line);
    arr = line.split(",");
    betnum = arr[0];
    kaijnum = arr[1]; //encodeURIComponent
    cmd = "php   C:\\modyfing\\jbbot\\unittest/dwijyo.php " + (betnum) + " " + kaijnum;
    console.log(cmd)
    rzt = execSync(cmd).toString();
    console.log(rzt)
    if (rzt == "true")
        throw "err pandwe";
})