function setCookie (name, value) {
    document.cookie = name + "=" + escape (value);
}    
  
function getCookie (name) {
    var arg = name + "=";
    var argLength = arg.length;
    var cookieLength = document.cookie.length;
    var i = 0;
    while (i < cookieLength) 
    {
      var j = i + argLength;
      if (document.cookie.substring(i, j) == arg)
        return getCookieVal (j);
      i = document.cookie.indexOf(" ", i) + 1;
      if (i == 0)
        break; 
    }
    return null;
}
  
function getCookieVal (offset) {
    var endstr = document.cookie.indexOf (";", offset);
    if (endstr == -1) {
      endstr = document.cookie.length;
    }
    return unescape(document.cookie.substring(offset, endstr));
}      


