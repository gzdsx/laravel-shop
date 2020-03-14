import $ from 'jquery';
import Vue from 'vue';

window.Popper = require('popper.js').default;
try {
    window.$ = window.jQuery = $;
    window.$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    require('bootstrap');
    require('./lib/jquery-ui');
    require('./lib/jquery.form');
    require('./dsx/jquery-misc');
} catch (e) {

}

window.Vue = Vue;
window.DSXDialog = require('./dsx/dsxdialog');
window.DSXUI = require('./dsx/dsxui');
window.DSXValidate = require('./dsx/dsxvalidate');
window.DSXUtil = require('./dsx/dsxutil');
window.DistrictSelector = require('./dsx/districtselector');
window.Widget = require('./dsx/widget');

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
