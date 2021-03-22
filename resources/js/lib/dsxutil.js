const DSXUtil = {
    mb_cutstr : function(str, maxlen, dot) {
        var len = 0;
        var ret = '';
        var ndot = !dot ? '...' : '';
        maxlen = maxlen - dot.length;
        for(var i = 0; i < str.length; i++) {
            len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset === 'utf-8' ? 3 : 2) : 1;
            if(len > maxlen) {
                ret += ndot;
                break;
            }
            ret += str.substr(i, 1);
        }
        return ret;
    },
    paramToJSON : function(str){
        if(!str) return;
        var json = {};
        var arr = str.split('&');
        $.each(arr,function(i,o){
            var arr2 = o.split('=');
            json[arr2[0]] = arr2[1] ? arr2[1] : '';
        });
        return json;
    },
    randomString : function (len) {
        len = len || 32;
        var $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        /****默认去掉了容易混淆的字符oOLl,9gq,Vv,Uu,I1****/
        var maxPos = $chars.length;
        var pwd = '';
        for (i = 0; i < len; i++) {
            pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
        }
        return pwd;
    },
    getQueryString : function(item){
        var svalue = location.search.match(new RegExp("[\?\&]" + item + "=([^\&]*)(\&?)","i"));
        return svalue ? svalue[1] : svalue;
    },
    /*
    * url 目标url
    * arg 需要替换的参数名称
    * arg_val 替换后的参数的值
    * return url 参数替换后的url
    */
    changeURLArg:function(url,arg,arg_val){
        var pattern=arg+'=([^&]*)';
        var replaceText=arg+'='+arg_val;
        if(url.match(pattern)){
            var tmp='/('+ arg+'=)([^&]*)/gi';
            tmp=url.replace(eval(tmp),replaceText);
            return tmp;
        }else{
            if(url.match('[\?]')){
                return url+'&'+replaceText;
            }else{
                return url+'?'+replaceText;
            }
        }
    },
    setCookie : function(name, value, expiresHours) {
        var cookieString = name + "=" + escape(value);
        //判断是否设置过期时间
        if(expiresHours > 0){
            var date = new Date();
            date.setTime(date.getTime() + expiresHours * 3600 * 1000);
            cookieString = cookieString + "; expires=" + date.toGMTString();
        }
        document.cookie = cookieString;
    },
    getCookie : function(strName){
        var strCookie = document.cookie.split("; ");
        for (var i=0; i < strCookie.length; i++) {
            var strCrumb = strCookie[i].split("=");
            if (strName === strCrumb[0]) {
                return strCrumb[1] ? unescape(strCrumb[1]) : null;
            }
        }
        return null;
    },
    reFresh:function(){
        if (window.location.reload){
            window.location.reload(true);
        } else {
            window.location = window.location.href;
        }
    },
    stopPropagation : function(event){
        var e = event || window.event;
        if(e.stopPropagation){
            e.stopPropagation();
        }else {
            e.cancelBubble = true;
        }
    }
};

module.exports = DSXUtil;
