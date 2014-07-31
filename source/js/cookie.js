function getCookie(objName) {
    var arrStr = document.cookie.split("; ");
    for (var i = 0; i < arrStr.length; i++) {
        var temp = arrStr[i].split("=");
        if (temp[0] = objName) {
            return unexcape(temp[1]);
        }
        return null;
    }
}
