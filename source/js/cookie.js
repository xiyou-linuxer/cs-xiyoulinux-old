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

function set_cookie(name, value, expire) {
    var exp = new Date();
    exp.setTime(exp.getTime() + expire);
    document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
}
