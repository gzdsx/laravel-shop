try {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
} catch (e) {

}

require('jquery-form');
require('./lib/jquery-ui');
require('./lib/jquery-custom');
window._ = require('lodash');
window.Popper = require('popper.js').default;
window.Dialog = require('./lib/dialog');
window.Widget = require('./lib/widget');
window.Validator = require('./lib/validator');
window.DSXUI = require('./lib/dsxui');
window.DSXUtil = require('./lib/dsxutil');
window.DistrictSelector = require('./lib/districtselector');


$(function () {
    //全选
    $("[data-action=checkall]").on('click', function () {
        var target = $(this).attr('data-target');
        if (typeof (target) === 'undefined') {
            target = 'input.checkmark';
        }
        $(target).prop('checked', $(this).is(":checked"));
    });
    //异步加载图片
    $(".asyncload").each(function () {
        var self = this;
        var imgurl = $(this).attr('data-original');
        if (this.tagName.toLowerCase() === 'img') {
            $(this).attr("src", "/images/common/placeholder.png");
            $("<img/>").attr("src", imgurl).on('load', function () {
                $(self).attr('src', imgurl);
            });
        } else {
            $("<img/>").attr("src", imgurl).on('load', function () {
                $(self).css('background-image', 'url(' + imgurl + ')');
            });
        }
    });
    $("[data-action=refresh]").on('click', DSXUtil.reFresh);
});
