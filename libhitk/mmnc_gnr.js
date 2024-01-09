require("./enc")
require("./mmnc")
var ini = require('ini');
const {readFileSync,writeFileSync,appendFileSync} = require("fs");
var config = ini.parse(readFileSync('c:/aa/cfg.json', 'utf-8'));
basewd=config.bswd // f
offst=1;
slt=config.st
let i=1;
// for(let i=1;i<10;i++)
// {
//     console.log("\r\n\r\n\r\n---------------\r\n")
//     const s=basewd+i+slt;
//     console.log(s)
//     const hx=md5(s)
//     console.log(hx)
//     const mmnc= geneMmncCrpt(hx)
//     console.log(mmnc)
//
//     var {readFileSync,writeFileSync,appendFileSync} = require("fs");
//     writeFileSync("xx.log","111");
// }

setInterval(()=>{

   if(i>40)
       process.exit(0);
    console.log("\r\n\r\n\r\n---------------\r\n")
    const s=basewd+i+slt;
    console.log(s)
    const hx=md5(s)
    console.log(hx)
    const mmnc= geneMmncCrpt(hx)
    console.log(mmnc)

    i++
},100)

// setTimeout(()=>{
//
//
//
//
// },5000);


// console.log(mmnc)