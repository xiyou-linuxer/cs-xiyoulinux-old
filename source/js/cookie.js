function get_cookie(name) {
    var arr = document.cookie.split("; ");
    for (var i = 0; i < arr.length; i++) {
        var temp = arr[i].split("=");
        if (temp[0] == name) {
            return unescape(temp[1]);
        }
    }
    return null;
}

function set_cookie(name, value) {
    var exp = new Date();
    exp.setTime(exp.getTime() + 10*60*1000);
    document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
}
