const lang = require('./lang');

function Dialog(content, settings) {
    var options = $.extend({
        title: lang.dialog,
        buttonCancelText: lang.cancel,
        buttonConfirmText: lang.confirm,
        beforeShow: function () {
        },
        afterShow: function () {
        },
        beforeClose: function () {
        },
        afterClose: function () {
        },
        afterLoaded: function () {
        },
        onCancel: function () {
        },
        onConfirm: function () {

        },
        fade: true,
        dragable: false,
        showButtons: true
    }, settings);

    this.id = options.id ? options.id : 'dialog_' + Dialog.__count++;
    var $this = this;
    var footer = '<div class="modal-footer">\n' +
        '      <button type="button" class="btn btn-secondary d-btn-cancel" role="button">' + options.buttonCancelText + '</button>\n' +
        '      <button type="button" class="btn btn-primary d-btn-confirm" role="button">' + options.buttonConfirmText + '</button>\n' +
        '</div>';
    var dialog = '<div class="modal' + (options.fade ? ' fade' : '') + '" tabindex="-1" role="dialog" id="' + this.id + '">\n' +
        '        <div class="modal-dialog modal-dialog-centered" role="document">\n' +
        '            <div class="modal-content">\n' +
        '                <div class="modal-header">\n' +
        '                    <h5 class="modal-title">' + options.title + '</h5>\n' +
        '                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">\n' +
        '                        <span aria-hidden="true">&times;</span>\n' +
        '                    </button>\n' +
        '                </div>\n' +
        '                <div class="modal-body">\n' + content + '</div>\n' +
        '               ' + (options.showButtons ? footer : '') +
        '            </div>\n' +
        '        </div>\n' +
        '</div>';
    $(document.body).append(dialog);
    var $modal = $("#" + this.id);
    this.close = function () {
        $modal.modal('hide');
    };
    if (options.style) $modal.find('.modal-dialog').css(options.style);
    $modal.on('show.bs.modal', function () {
        if (options.beforeShow) options.beforeShow($this);
    });
    $modal.on('shown.bs.modal', function () {
        if (options.afterShow) options.afterShow($this);
    });
    $modal.on('hide.bs.modal', function () {
        if (options.beforeClose) options.beforeClose($this);
    });
    $modal.on('hidden.bs.modal', function () {
        if (options.afterClose) options.afterClose($this);
        $modal.remove();
    });
    $modal.on('loaded.bs.modal', function () {
        if (options.afterLoaded) options.afterLoaded($this);
    });
    if (options.showFooter) {
        $modal.find('.d-btn-confirm').on('click', function () {
            if (options.onConfirm) options.onConfirm($this);
        });
        $modal.find('.d-btn-cancel').on('click', function () {
            if (options.onCancel) options.onCancel($this);
            $this.close();
        });
    }

    if (options.dragable) {
        var mouse = {x: 0, y: 0};

        function moveDialog(event) {
            var e = window.event || event;
            var top = parseInt($modal.css('top')) + (e.clientY - mouse.y);
            var left = parseInt($modal.css('left')) + (e.clientX - mouse.x);
            $modal.css({top: top, left: left});
            mouse.x = e.clientX;
            mouse.y = e.clientY;
        }

        $modal.find('.modal-header').on('mousedown', function (event) {
            var e = window.event || event;
            mouse.x = e.clientX;
            mouse.y = e.clientY;
            $(document).on('mousemove', moveDialog);
            $(this).css('cursor', 'move');
        });
        $(document).on('mouseup', function (event) {
            $(document).off('mousemove', moveDialog);
            $modal.find('.modal-header').css('cursor', 'default');
        });
    }
    $modal.modal();
}

Dialog.__count = 0;

module.exports = Dialog;
