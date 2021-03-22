const lang = require('./lang');
const Widget = {
    //图片选择器
    showImagePicker: function (callback) {
        return new Dialog(
            '<div style="height: 510px; position: relative;">' +
            '<iframe src="/material/imagepicker" frameborder="0" style="width: 100%; height: 100%; position: absolute;">' +
            '</div>',
            {
                style: {
                    'width': '780px',
                    'max-width': '780px'
                },
                title: lang.imageDialogTitle,
                fade: false,
                dragable: false,
                showButtons: false,
                afterShow: function (dlg) {
                    window.onPickedImage = function (response) {
                        dlg.close();
                        if (callback) callback(response);
                    }
                },
                afterClose: function () {
                    window.onPickedImage = null;
                }
            }
        );
    },
    showMapView: function (defaults, callback) {
        var currentPos = {lng: 0, lat: 0};
        var url = '/map/picker?showmap=true';
        if (defaults.address) {
            url += '&address=' + defaults.address;
        }
        if (defaults.location) {
            url += '&location=' + defaults.location.join(',');
            currentPos = {
                lng: defaults.location[0],
                lat: defaults.location[1]
            }
        }
        return new Dialog(
            '<iframe scrolling="no" frameborder="0" style="width: 100%; height: 400px;" src="' + url + '"></iframe>'
            ,
            {
                style: {
                    'width': '700px',
                    'max-width': '700px'
                },
                title: '定图定位',
                fade: false,
                dragable: false,
                afterShow: function (dlg) {
                    window.onLocationDidChanged = function (position) {
                        currentPos = position;
                    }
                },
                afterClose: function () {
                    window.onLocationDidChanged = null;
                },
                onConfirm: function (dlg) {
                    dlg.close();
                    if (callback) callback(currentPos);
                }
            }
        );
    },

    showAddressForm: function (address_id, callback) {
        var url = '/user/address/frame';
        if (address_id) url += '?address_id=' + address_id;
        return new Dialog(
            '<iframe scrolling="no" frameborder="0" style="width: 100%; height: 400px;" src="' + url + '"></iframe>'
            ,
            {
                style: {
                    'width': '700px',
                    'max-width': '700px'
                },
                title: address_id ? '编辑地址' : '添加地址',
                fade: false,
                dragable: false,
                showButtons: false,
                afterShow: function (dlg) {
                    window.afterSaveAddress = function (address) {
                        dlg.close();
                        if (callback) callback(address);
                    }
                },
                afterClose: function () {
                    window.afterSaveAddress = null;
                }
            });
    }
};

module.exports = Widget;
