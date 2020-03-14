$(function () {
    function checkSubmit() {
        if($(".CheckBoxItem:checked").length > 0) $("#FrmCart").submit();
    }

    function settlement() {
        var totalCount = 0, totalFee = 0;
        $(".CheckBoxItem:checked").each(function () {
            var itemid   = $(this).val();
            var quantity = parseInt($("#quantity_"+itemid).val());
            var price    = parseFloat($("#price_"+itemid).val());
            totalCount+= quantity;
            totalFee+= price * quantity;
        });
        $("#totalCount").text(totalCount.toString());
        $("#totalFee").text(totalFee.toFixed(2));
    }

    $(document).on('click', function () {
        if($(".CheckBoxItem:checked").length > 0){
            $("#settleBtn").removeClass("btn-disabled").off('click').on('click', checkSubmit);
        }else {
            $("#settleBtn").addClass("btn-disabled").off('click');
        }
    });

    $("[rel=delete]").on('click', function () {
        var itemid = $(this).attr('data-id');
        DSXUI.showConfirm('删除确认', '确认要从购物车中移除此宝贝吗?', function () {
            $.ajax({
                url:'/cart/delete',
                data:{items:itemid},
                beforeSend:DSXUI.showSpinner,
                success:function (response) {
                    setTimeout(function () {
                        DSXUI.hideSpinner();
                        if (response.errcode) {
                            DSXUI.error(response.errmsg);
                        } else {
                            //$("#item-"+itemid).remove();
                            DSXUtil.reFresh();
                        }
                    }, 500);
                }
            });
        });
    });

    $(".decrease").on('click', function () {
        var itemid = $(this).attr('data-id');
        var quantity = $("#quantity_"+itemid).val();
        var price = $("#price_"+itemid).val();
        if (quantity <= 1) {
            return false;
        }else {
            quantity--;
            var simple_total = (price*quantity).toFixed(2);
            $("#quantity_"+itemid).val(quantity);
            $("#simple_total_"+itemid).text('￥'+simple_total);

            $.ajax({
                type:'POST',
                url:"/cart/update_quantity",
                data:{itemid:itemid, quantity:quantity},
                beforeSend:DSXUI.showSpinner,
                success:function (response) {
                    setTimeout(function () {
                        DSXUI.hideSpinner();
                        settlement();
                    }, 500);
                }
            });
        }
    });

    $(".increase").on('click', function () {
        var itemid = $(this).attr('data-id');
        var quantity = $("#quantity_"+itemid).val();
        var price = $("#price_"+itemid).val();

        quantity++;
        var simple_total = (price*quantity).toFixed(2);
        $("#quantity_"+itemid).val(quantity);
        $("#simple_total_"+itemid).text('￥'+simple_total);
        $.ajax({
            type:'POST',
            url:"/cart/update_quantity",
            data:{itemid:itemid, quantity:quantity},
            beforeSend:DSXUI.showSpinner,
            success:function (response) {
                setTimeout(function () {
                    DSXUI.hideSpinner();
                    settlement();
                }, 500);
            }
        });
    });

    $("#multiDelete").on('click', function () {
        if ($(".CheckBoxItem:checked").length > 0){
            var items = [];
            $(".CheckBoxItem:checked").each(function () {
                items.push($(this).val());
            });
            DSXUI.showConfirm('移除购物车','确认要从购物车中移除此宝贝吗？', function () {
                $.ajax({
                    url:"/cart/delete",
                    data:{items:items.join(',')},
                    beforeSend:DSXUI.showSpinner,
                    success:function (response) {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            if (response.errcode){
                                DSXUI.error(response.errmsg);
                            }else {
                                DSXUtil.reFresh();
                            }
                        }, 500);
                    }
                });
            });
        }
    });

    $("#moveToFavor").on('click', function () {
        if ($(".CheckBoxItem:checked").length > 0){
            var items = [];
            $(".CheckBoxItem:checked").each(function () {
                items.push($(this).val());
            });
            DSXUI.showConfirm('移除购物车','确认要将所选宝贝移入收藏夹吗?', function () {
                $.ajax({
                    url:"/cart/move_to_favor",
                    data:{items:items.join(',')},
                    beforeSend:DSXUI.showSpinner,
                    success:function (response) {
                        setTimeout(function () {
                            spinner.close();
                            if (response.errcode){
                                DSXUI.error(response.errmsg);
                            }else {
                                DSXUtil.reFresh();
                            }
                        }, 500);
                    }
                });
            });
        }
    });

    $(".groupCheckbox").on('click', function () {
        var target = $(this).attr('data-target');
        $(target).prop('checked', $(this).is(":checked"));
        settlement();
    });
    $(".checkall, .CheckBoxItem").on('click', settlement);
});
