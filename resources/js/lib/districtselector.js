function DistrictSelector(optons) {
    var opts = $.extend({
        province: '',
        city: '',
        district: '',
        provinceSelector: '#province',
        citySelector: '#city',
        districtSelector: '#district',
        valueField: 'name'
    }, optons);
    var bindData = function (element, fid, defvalue, callback) {
        if (!fid) fid = 0;
        if (!defvalue) defvalue = 0;
        $.ajax({
            url: '/district/batchget?fid=' + fid,
            dataType: "json",
            success: function (response) {
                if (response.errcode) {
                    console.log(response);
                } else {
                    var optionHtml = '<option value="">请选择</option>';
                    $(response.items).each(function (i, data) {
                        var sel = defvalue == data[opts.valueField] ? ' selected="selected"' : '';
                        optionHtml += '<option value="' + data[opts.valueField] + '" idvalue="' + data.id + '"' + sel + '>' + data.name + '</option>';
                    });
                    $(element).html(optionHtml);
                    if (callback) callback();
                }
            }
        });
    };

    if ($(opts.provinceSelector).length > 0) {
        bindData(opts.provinceSelector, 0, opts.province, function () {
            if ($(opts.citySelector).length > 0) {
                $(opts.provinceSelector).on('change', function (e) {
                    var proid = $(this).find("option:selected").attr('idvalue');
                    if (proid > 0) {
                        bindData(opts.citySelector, proid, opts.city, function () {
                            if ($(opts.districtSelector).length > 0) {
                                $(opts.citySelector).on('change', function (e) {
                                    var cityid = $(this).find("option:selected").attr('idvalue');
                                    if (cityid > 0) {
                                        bindData(opts.districtSelector, cityid, opts.district);
                                    } else {
                                        $(opts.districtSelector).html('<option value="">请选择</option>');
                                    }
                                }).change();
                            }
                        });
                    } else {
                        $(opts.citySelector).html('<option value="">请选择</option>');
                        $(opts.districtSelector).html('<option value="">请选择</option>');
                    }
                }).change();
            }
        });
    }
}

module.exports = DistrictSelector;
