function onBridgeReady(settings) {
    /*
     {
     "appId" : "$signature[appid]", //公众号名称,由商户传入
     "timeStamp":" $signature[timestamp]", //时间戳,自 1970 年以来的秒数
     "nonceStr" : "$signature[noncestr]", //随机串
     "package" : "prepay_id=$signature[prepayid]",
     "signType" : "MD5", //微信签名方式:
     "paySign" : "$signature[sign]" //微信签名
     }
     */
    var option = $.extend({
        params:{},
        success:function(){},
        cancel:function(){},
        fail:function(){}
    },settings);
    WeixinJSBridge.invoke('getBrandWCPayRequest',option.params,function(res){
        //alert(res.err_msg);
        if(res.err_msg === "get_brand_wcpay_request:ok" ) {
            if(option.success){
                option.success(res);
            }
        }
        if(res.err_msg === "get_brand_wcpay_request:cancel" ) {
            if(option.cancel){
                option.cancel(res);
            }
        }
        if(res.err_msg === "get_brand_wcpay_request:fail" ) {
            if(option.fail){
                option.fail(res);
            }
        }
        // 使用以上方式判断前端返回,微信团队郑重提示:res.err_msg 将在用户支付成功后返
        //回 ok,但幵丌保证它绝对可靠。
    });
}
function callPay(settings) {
    if (typeof WeixinJSBridge === "undefined") {
        if (document.addEventListener) {
            document.addEventListener('WeixinJSBridgeReady', function(){
                onBridgeReady(settings);
            },false);
        } else if (document.attachEvent) {
            document.attachEvent('WeixinJSBridgeReady', function(){
                onBridgeReady(settings);
            });
            document.attachEvent('onWeixinJSBridgeReady', function(){
                onBridgeReady(settings);
            });
        }
    } else {
        onBridgeReady(settings);
    }
}

function onDocumentReachBottom(callback) {
    $(window).scroll(function() {
        var totalheight = parseFloat($(window).height()) + parseFloat($(document).scrollTop());
        if ($(document).height() <= totalheight){
            if (callback) callback();
        }
    });
}
