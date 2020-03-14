/**
 * DSXUI
 */

let DSXUI = {
    message : function(settings){
        var opt = $.extend({
            type:'success',
            text:'操作完成'
        },settings);

        if(opt.type !== 'success' && opt.type !== 'error' && opt.type !== 'warning') opt.type = 'infomation';
        var icon;
        switch(opt.type) {
            case 'success':
                icon = '&#xe656;';
                break;
            case 'error':
                icon = '&#xe658;';
                break;
            case 'warning':
                icon = '&#xe662;';
                break;
            default : icon = '&#xe6e4;';
        }
        $("#dsxui-message-box").remove();
        var div = $('<div/>').addClass('dsxui-message-box').attr('id','dsxui-message-box');
        var con = $('<div/>').addClass('message-div message-'+opt.type).html('<div class="iconfont message-icon">'+icon+'</div><div class="message-text">'+opt.text+'</div>');
        div.html(con).appendTo(document.body).fadeIn('fast').center().css('top', '20%');
        if(opt.afterShow) opt.afterShow(div);
        setTimeout(function(){div.remove(); if(opt.afterClose) opt.afterClose(div);},2000);
    },
    success : function(text, callback){
        DSXUI.message({type:'success',text:text,afterClose:callback});
    },
    error : function(text,callback){
        DSXUI.message({type:'error',text:text,afterClose:callback});
    },
    warning : function(text,callback){
        DSXUI.message({type:'warning',text:text,afterClose:callback});
    },
    infomation : function(text,callback){
        DSXUI.message({type:'infomation',text:text,afterClose:callback});
    },
    confirm : function(selector,text,ok,cancel){
        $(selector).confirm({text:text,onConfirm:ok,onCancel:cancel});
    },
    showloading : function(text){
        text = text||'数据加载中...';
        if ($("#dsxui-loading-box").length > 0)
        {
            DSXUI.hideloading();
        }
        $("<div/>").addClass("dsxui-overlayer").attr('id', 'dsxui-loading-overlayer').appendTo(document.body);
        $('<div class="dsxui-loading-box" id="dsxui-loading-box"><span class="ico"></span>'+text+'</div>').appendTo(document.body).center();
    },
    hideloading : function () {
        $("#dsxui-loading-box").remove();
        $("#dsxui-loading-overlayer").remove();
    },
    showSpinner : function(){
        if ($("#dsxui-spinner-overlayer").length > 0)
        {
            DSXUI.hideSpinner();
        }
        $("<div/>").addClass("dsxui-overlayer").attr('id', 'dsxui-spinner-overlayer').appendTo(document.body);
        $('<div class="dsxui-spinner" id="dsxui-spinner"></div>').appendTo(document.body).center();
    },
    hideSpinner : function (cb) {
        $("#dsxui-spinner").remove();
        $("#dsxui-spinner-overlayer").remove();
        if (cb) cb();
    },
    showToast : function (text, duration, callback) {
        if (!duration) duration = 1500;
        if ($("#dsxui-toast").length > 0)
        {
            DSXUI.hideToast();
        }
        $("<div/>").addClass("dsxui-toast").attr('id', 'dsxui-toast')
            .append('<div class="dsxui-toast-content">'+text+'</div>')
            .appendTo(document.body).center();
        setTimeout(function () {
            DSXUI.hideToast();
            if (callback) callback();
        }, duration);
    },
    hideToast : function () {
        $("#dsxui-toast").remove();
    },
    dialog:function(settings){
        return new DSXDialog(settings);
    },
    showConfirm:function (message, callback, cancel) {
        if (!message) message = 'Confirm Message';
        var confirm = '<div class="modal fade" tabindex="-1" role="dialog" id="dsxui-confirm">\n' +
            '        <div class="modal-dialog modal-dialog-centered" role="document">\n' +
            '            <div class="modal-content">\n' +
            '                <div class="modal-body" style="font-size: 16px; padding: 20px;">'+ message +'</div>\n' +
            '                <div class="modal-footer">\n' +
            '                    <button type="button" class="btn btn-secondary d-btn-cancel">取消</button>\n' +
            '                    <button type="button" class="btn btn-primary d-btn-confirm">确认</button>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>';
        $(document.body).append(confirm);

        var $this = this;
        var $confirm = $("#dsxui-confirm");
        this.close = function () {
            $confirm.modal('hide');
        };
        $confirm.find('.d-btn-confirm').on('click', function () {
            $this.close();
            if (callback) setTimeout(callback, 500);
        });

        $confirm.find('.d-btn-cancel').on('click', function () {
            $this.close();
            if (cancel) setTimeout(cancel, 500);
        });
        $confirm.on('hidden.bs.modal', function () {
            $confirm.remove();
        });
        $confirm.modal({show:true});
    },

    showAlert : function(message, callback){
        if (!message) message = 'Alert Message';
        var alert = '<div class="modal fade" tabindex="-1" role="dialog" id="dsxui-alert">\n' +
            '        <div class="modal-dialog modal-dialog-centered" role="document">\n' +
            '            <div class="modal-content">\n' +
            '                <div class="modal-body text-center">\n'+ message +'</div>\n' +
            '                <div class="modal-footer" style="padding: 0;">\n' +
            '                    <button type="button" class="btn btn-lg w-100" data-dismiss="modal" style="padding: 12px 0; color: #147BFF; font-size: 15px;">确定</button>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>';
        $(document.body).append(alert);

        var $this = this;
        var $alert = $("#dsxui-alert");
        $alert.on('hidden.bs.modal', function () {
            $alert.remove();
            if (callback) callback();
        });
        $alert.modal();
    },
};

module.exports = DSXUI;
