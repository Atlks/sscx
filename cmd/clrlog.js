const fs = require('fs');
const path = require('path');

function travel(dir, callback) {
    fs.readdirSync(dir).forEach((file) => {
        var pathname = path.join(dir, file)
        if (fs.statSync(pathname).isDirectory()) {
            travel(pathname, callback)
        } else {
            callback(pathname)
        }
    })
}


// node  tool/clrlog.js

rootdidr=__dirname + "/../runtime/";
travel(rootdidr, function (pathname) {
   // fs.mkdirSync(__dirname+"/beked/aaa/")
    console.log(pathname)
    let finfo = fs.statSync(pathname);
    console.log(finfo)
    //  finfo.mtimeMs
    basenm=path.basename(pathname);

    span = (Date.now() - finfo.mtimeMs) / 1000;   //sec
    gocyitime = 3600 * 24 * 2;
    // gocyitime = 3;
    console.log("span sec=>" + span);
    if (span > gocyitime) {
        if(!fs.existsSync(rootdidr+"/beked/"))
             fs.mkdirSync(rootdidr+"/beked/")
        fs.renameSync(pathname,  rootdidr+ "/beked/"+basenm+".bk.log");
        console.log(" mv file:"+pathname)
    }

    //  if()
    //console.log(finfo)

})


setInterval(function (){
    console.log( Date.now());
},1000)