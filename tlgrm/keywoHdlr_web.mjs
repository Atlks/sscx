//c: \w\ jbbot > C: \phpstudy_pro\ Extensions\ php\ php7 .3 .4 nts\ php.exe think swoole //ink swoole//// 
//   https://api.telegram.org/bot5464498785:AAGtLv-M-RKgRoIh5G3XEfkdqkCPiVBB1NA/getUpdates
////////   npm install node-telegram-bot-api
//   npm install  ini
//   npm install  mysql
// execSynca大小100



//   node tlgrm/keywoHdlr.js
// node  C:\modyfing\jbbot\tlgrm\keywoHdlr.js
import { exec, execSync } from 'child_process';
import TelegramBot from 'node-telegram-bot-api';
import ini from 'ini';
import fs from "fs";
import fetch from "node-fetch"; //es6 mode
import mysql from 'mysql';
import path from "path" ;
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);

const __dirname = path.dirname(__filename);

let envFilePath = '../.env';

var connection=getConn(envFilePath);



connection.connect();
//token = "6510408569:AAHrrbsKgCvklwiFje_TKPF-ABMz0kdxn2c" // msg2025
var token = "";
connection.query('SELECT  * from setting where id=18  ', function(error, results, fields) {
    if (error) throw error;
    //  console.log(JSON.stringify(results));
    var  token = results[0].s_value
    console.log('The solution is: ', results[0].s_value);

    invoke_bot(token);
});
connection.end(); //要加不然唱起了回报个 conn close err。。。must add beir longt time
console.log(9999);


function getConn(envFilePath) {




    const iopath = path.join(__dirname, envFilePath); // 引用Pos.ini的相对地址
    const Info = ini.parse(fs.readFileSync(iopath, 'utf-8'));
    console.log(Info)


    var connection = mysql.createConnection({
        host: Info.database.hostname,
        user: Info.database.username,
        password: Info.database.password,
        database: Info.database.database
    });
    return connection;
}

function invoke_bot(token) {
    //6357469915: AAGyKxgsBJ4NmaazHG - 6 aiAuoodeT0gJmPA   //ssc2023 bot


    // Create a bot that uses 'polling' to fetch new updates
    const bot = new TelegramBot(token, { polling: true });



    // Listen for any kind of message. There are different kinds of
    // messages.
    bot.on('message', async (msg) => {
        var chatId = msg.chat.id;
        console.log(msg)
        // send a message to the chat acknowledging receipt of their message
        //  bot.sendMessage(chatId, 'Received your message');

        //  msgx(msg);
        var cmd = "node   tlgrm/msgHdl.js " + encodeURI(JSON.stringify(msg));
        var $phpexe = "php";
        // $tlghr_msg_hdl = " C:\\w\\jbbot\\tlgrmHdl_temacyo.php ";
        var filename = __dirname + "/../think";
        //  var   cmd = $phpexe + " " + filename + "    keywdReqHdlr  " + encodeURI(JSON.stringify(msg));


        var url = "http://localhost/msgHdl.php?msg=" + encodeURI(JSON.stringify(msg));
        console.log(url)
        var res = await fetch(url);  //这里不用担心，因为整体listener bot is async

        const headerDate = res.headers && res.headers.get('date') ? res.headers.get('date') : 'no response date';
        console.log('___Status Code:', res.status);
        console.log('___+Date in Response header:', headerDate);

        var rzt = await res.text();

        console.log(rzt)


        console.log(999)
    });
}