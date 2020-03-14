var Mall = {
    showAjaxLogin : function (callback) {
        DSXUI.dialog({
            title:'登录粗耕',
            showFooter:false,
            style:{
                width:'450px',
                height:'365px'
            },
            content:'<iframe scrolling="no" frameborder="0" style="width: 100%; height: 460px;" src="/ajaxlogin"></iframe>',
            afterShow:function (dlg) {
                window.afterLogin = function (data) {
                    dlg.close();
                    if (callback) callback(data);
                }
            }
        });
    },
    addToCart : function(itemid, quantity, callback) {
        if (window.userStatus.uid && window.userStatus.username) {
            $.ajax({
                type:'POST',
                url:'/cart/add',
                data:{itemid:itemid,quantity:quantity},
                success:function (response) {
                    if (response.errcode) {
                        DSXUI.error(response.errmsg);
                    } else {
                        DSXUI.success('已成功加入购物车');
                        if (callback) callback(response);
                    }
                }
            });
        } else {
            this.showAjaxLogin(function () {
                DSXUI.reFresh();
            });
        }
    },
    addToCollection : function (dataid, datatype) {
        if (window.userStatus.isLoggedIn) {
            $.ajax({
                type:'POST',
                url:'/collection/add',
                data:{dataid:dataid,datatype:datatype},
                success:function (response) {
                    if (response.errcode) {
                        DSXUI.error(response.errmsg);
                    } else {
                        DSXUI.success('已成功加入收藏夹');
                        if (callback) callback(response);
                    }
                }
            });
        } else {
            this.showAjaxLogin(function () {
                DSXUI.reFresh();
            });
        }
    }
};
