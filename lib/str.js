
function   strval($numVar){

    return ""+$numVar+"";
}

global['sprintf']=sprintf
function sprintf() {
    let args = arguments, string = args[0];
    for (let i = 1; i < args.length; i++) {
        let item = arguments[i];
        string = string.replace('%s', item);
    }
    return string;
}

