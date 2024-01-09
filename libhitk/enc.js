
try{
    global["json_decode"] = json_decode;
    global["json_encode"] = json_encode;
    global["md5"] = md5;
    global["strip_tagsx"] = strip_tagsx;
   // module.exports = {urlencode, md5};
}catch (e) {
    
}


global['hex2bin']=hex2bin
/**
 *
 * @param h
 * @returns {string}
 */
function hex2bin(h) {
    var s = ""
    for (ch99 of h) {
        s = s + hex2bin_single(ch99)
    }
    return s;
}

function hex2bin_single(h) {
    var x = h;//这是一个十六进制的字符串表示
    var y = parseInt(x, 16);//十六进制转为十进制
    var z = y.toString(2);//十进制转为2进制
    if (z.length == 3)
        return '0' + z
    if (z.length == 2)
        return '00' + z
    if (z.length == 1)
        return '000' + z
    if (z.length == 4)
        return z;
}

function hexToBinArr(hex) {
    if (!hex.match(/^[0-9a-fA-F]+$/)) {
        throw new Error('is not a hex string.');
    }
    if (hex.length % 2 !== 0) {
        hex = '0' + hex;
    }
    var bytes = [];
    for (var n = 0; n < hex.length; n += 2) {
        var code = parseInt(hex.substr(n, 2), 16)
        bytes.push(code);
    }
    return bytes;
}

//node  D:\wamp64\www\ossn\actions\sha256.js
var sha256=function sha256(ascii) {
    function rightRotate(value, amount) {
        return (value >>> amount) | (value << (32 - amount));
    };

    var mathPow = Math.pow;
    var maxWord = mathPow(2, 32);
    var lengthProperty = 'length'
    var i, j; // Used as a counter across the whole file
    var result = ''

    var words = [];
    var asciiBitLength = ascii[lengthProperty] * 8;

    //* caching results is optional - remove/add slash from front of this line to toggle
    // Initial hash value: first 32 bits of the fractional parts of the square roots of the first 8 primes
    // (we actually calculate the first 64, but extra values are just ignored)
    var hash = sha256.h = sha256.h || [];
    // Round constants: first 32 bits of the fractional parts of the cube roots of the first 64 primes
    var k = sha256.k = sha256.k || [];
    var primeCounter = k[lengthProperty];
    /*/
    var hash = [], k = [];
    var primeCounter = 0;
    //*/

    var isComposite = {};
    for (var candidate = 2; primeCounter < 64; candidate++) {
        if (!isComposite[candidate]) {
            for (i = 0; i < 313; i += candidate) {
                isComposite[i] = candidate;
            }
            hash[primeCounter] = (mathPow(candidate, .5) * maxWord) | 0;
            k[primeCounter++] = (mathPow(candidate, 1 / 3) * maxWord) | 0;
        }
    }

    ascii += '\x80' // Append Ƈ' bit (plus zero padding)
    while (ascii[lengthProperty] % 64 - 56) ascii += '\x00' // More zero padding
    for (i = 0; i < ascii[lengthProperty]; i++) {
        j = ascii.charCodeAt(i);
        if (j >> 8) return; // ASCII check: only accept characters in range 0-255
        words[i >> 2] |= j << ((3 - i) % 4) * 8;
    }
    words[words[lengthProperty]] = ((asciiBitLength / maxWord) | 0);
    words[words[lengthProperty]] = (asciiBitLength)

    // process each chunk
    for (j = 0; j < words[lengthProperty];) {
        var w = words.slice(j, j += 16); // The message is expanded into 64 words as part of the iteration
        var oldHash = hash;
        // This is now the undefinedworking hash", often labelled as variables a...g
        // (we have to truncate as well, otherwise extra entries at the end accumulate
        hash = hash.slice(0, 8);

        for (i = 0; i < 64; i++) {
            var i2 = i + j;
            // Expand the message into 64 words
            // Used below if
            var w15 = w[i - 15], w2 = w[i - 2];

            // Iterate
            var a = hash[0], e = hash[4];
            var temp1 = hash[7]
                + (rightRotate(e, 6) ^ rightRotate(e, 11) ^ rightRotate(e, 25)) // S1
                + ((e & hash[5]) ^ ((~e) & hash[6])) // ch
                + k[i]
                // Expand the message schedule if needed
                + (w[i] = (i < 16) ? w[i] : (
                        w[i - 16]
                        + (rightRotate(w15, 7) ^ rightRotate(w15, 18) ^ (w15 >>> 3)) // s0
                        + w[i - 7]
                        + (rightRotate(w2, 17) ^ rightRotate(w2, 19) ^ (w2 >>> 10)) // s1
                    ) | 0
                );
            // This is only used once, so *could* be moved below, but it only saves 4 bytes and makes things unreadble
            var temp2 = (rightRotate(a, 2) ^ rightRotate(a, 13) ^ rightRotate(a, 22)) // S0
                + ((a & hash[1]) ^ (a & hash[2]) ^ (hash[1] & hash[2])); // maj

            hash = [(temp1 + temp2) | 0].concat(hash); // We don't bother trimming off the extra ones, they're harmless as long as we're truncating when we do the slice()
            hash[4] = (hash[4] + temp1) | 0;
        }

        for (i = 0; i < 8; i++) {
            hash[i] = (hash[i] + oldHash[i]) | 0;
        }
    }

    for (i = 0; i < 8; i++) {
        for (j = 3; j + 1; j--) {
            var b = (hash[i] >> (j * 8)) & 255;
            result += ((b < 16) ? 0 : '') + b.toString(16);
        }
    }
    return result;
};



/**
 *
 * @param hex16_32CHAR_128NUMBER B IN
 * @returns {string}
 */
function sha256hashFromHex32bit(hex16) {
    //hex  9663a6b4b233d586ec723bd9b97ed61f
    // HEX编码（十六进制编码
    let ascii = hexToStr(hex16);
    return (sha256(ascii))
}

global['sha256hash']=sha256hash
/**
 *
 * @param a128numStr
 * @returns {string}
 */
function sha256hash(a128numStr) {
    //hex  9663a6b4b233d586ec723bd9b97ed61f
    // HEX编码（十六进制编码
    var hex16 = bin2hex(a128numStr);
//return (  sha256( hexToStr('179e5af5ef66e5da5049cd3de0258c5339a722094e0fdbbbe0e96f148ae80924') ))
    let ascii = hexToStr(hex16);
    return (sha256(ascii))
}


/**
 * hex to bytearr
 * @param hex
 * @returns {string}
 */
function hexToStr(hex) {
    let dataString = "";
    if (hex.length % 2 !== 0) {
        hex = '0' + hex;
    }
    const bytes = [];
    for (let n = 0; n < hex.length; n += 2) {
        //每次去2个 16进制数字，组成8bit ，然后转换为字节 ，字节数组》字符串
        const code = parseInt(hex.substr(n, 2), 16);
        dataString += String.fromCharCode(code);
    }
    return dataString;
}


//fun finish  sha256

/**
 *bin2  16进制表示法
 * @param s
 * @returns {string}
 */
function bin2hex(s) {
    let chars99 = '0123456789abcdef'
    let s99 = ""
    for (let i = 0; i < s.length - 3; i = i + 4) {

        //  console.log("cur idx:"+i)
        let cur4lenStr = s.substr(i, 4)
        // cur4lenStr  0010

        //  console.log(cur4lenStr)
// . charAt() 方法可返回指定位置的字符。 第一个字符位置为0
        //二进制数字前缀0b
        let pos = '0b' + cur4lenStr;
        let s1 = chars99.charAt(pos);
        s99 = s99 + s1;
        //  console.log( chars99.charAt('0b'+cur4lenStr))

    }
    return s99;

}


global['urlencode']=urlencode
function urlencode($prm) {
    return encodeURIComponent($prm)
}


global['md5']=md5
// 辅助函数
function md5(data) {
    var CryptoJS = require("crypto-js");
    return CryptoJS.MD5(data).toString();
}

//global["shangfen"]=shangfen;
function strip_tagsx($t) {
    $t = strip_tags($t);
    $t = removeBlankLines($t);
    return $t;
}

function strip_tags($t) {
    result = $t;
    //  var result = $t.replace(/<\/?.+?>/g,"")
    //result = $t.replace(/<\/?.+?>/g,"")   //cant replace img mlt line


    result = result.replace(/<style>[\s\S]*?<\/style>/igm, "")
    // var regex=/<style>[\s\S]*?<\/style>/ig;
    result = result.replace(/<\/?[^>]*>/img, "")

    //.replace(/ /g,"");
    return result;
}

function json_decode($s) {
    return JSON.parse($s)
}

/**
 * cant encode err   if err ,use json_encode_Err
 * @param $s
 * @returns {string}
 */
function json_encode($s) {
    return JSON.stringify($s, null, 2)
}


/**
 * json_encode_Err  json_encode_Err
 * @param e
 * @returns {string}
 */
function json_encode_Err(e)
{
//     e.stack1 = e?.stack  //bcs this two prpop cant to json encode
// // if(e.message)
//     e.msg1 = e?.message

    let eobj = {"e":e,"stack": e.stack, "msg": e.message}

    return json_encode(eobj)
}


global['json_encode_ErrRawErrObj']=json_encode_ErrRawErrObj
function json_encode_ErrRawErrObj(e)
{
    e.stack1 = e?.stack  //bcs this two prpop cant to json encode
// if(e.message)
    e.msg1 = e?.message



    return json_encode(e)
}


function  encodeShellCmd(rcd)
{

    // String ( JSON.stringify(rcd)  )
}