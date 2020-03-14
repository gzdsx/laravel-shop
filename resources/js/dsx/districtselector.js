function DistrictSelector(optons) {
    var opts = $.extend({
        province:'',
        city:'',
        district:'',
        province_selector:'#province',
        city_selector:'#city',
        district_selector:'#district',
        valueType:'name'
    }, optons);
    var bindData = function(element,fid, defvalue, callback){
        if(!fid) fid = 0;
        if(!defvalue) defvalue = 0;
        $.ajax({
            url:'/district/batchget?fid='+fid,
            dataType:"json",
            success: function(response){
                if(response.errcode){
                    console.log(response);
                }else {
                    var optionHtml = '<option value="">请选择</option>';
                    $(response.items).each(function(i, data) {
                        var val,sel;
                        if(opts.valueType === 'id') {
                            val = data.id;
                            sel = defvalue == data.id ? ' selected="selected"' : '';
                        }else {
                            val = data.name;
                            sel = defvalue == data.name ? ' selected="selected"' : '';
                        }
                        optionHtml+= '<option value="'+val+'" idvalue='+data.id+sel+'>'+data.name+'</option>';
                    });
                    $(element).html(optionHtml);
                    if(callback) callback();
                }
            }
        });
    };

    if($(opts.province_selector).length > 0) {
        bindData(opts.province_selector, 0, opts.province, function () {
            if($(opts.city_selector).length > 0){
                $(opts.province_selector).on('change', function(e){
                    var proid = $(this).find("option:selected").attr('idvalue');
                    if(proid > 0){
                        bindData(opts.city_selector, proid, opts.city, function () {
                            if($(opts.district_selector).length > 0){
                                $(opts.city_selector).on('change', function(e){
                                    var cityid = $(this).find("option:selected").attr('idvalue');
                                    if(cityid > 0) {
                                        bindData(opts.district_selector, cityid, opts.district);
                                    }else {
                                        $(opts.district_selector).html('<option value="">请选择</option>');
                                    }
                                }).change();
                            }
                        });
                    }else {
                        $(opts.city_selector).html('<option value="">请选择</option>');
                        $(opts.district_selector).html('<option value="">请选择</option>');
                    }
                }).change();
            }
        });
    }
}

module.exports = DistrictSelector;
