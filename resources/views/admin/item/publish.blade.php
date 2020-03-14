@extends('layouts.admin')

@section('title', '发布宝贝')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('item')}}">
                <span class="btn btn-primary">商品列表</span>
            </a>
        </div>
        <h2>发布宝贝</h2>
    </div>
    <div class="content-div">
        <form method="post">
            @csrf
            <table cellspacing="0" cellpadding="0" width="100%" class="dsxui-formtable">
                <tbody>
                <tr>
                    <td class="cell-name" width="80">选择类目</td>
                    <td>
                        <div class="input-group w500">
                            <select class="custom-select" name="item[catid]">
                                <option disabled value="">请选择</option>
                                {!! $catlogOptions !!}
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="cell-name" width="80">宝贝名称</td>
                    <td><input title="" type="text" class="form-control w500" name="item[title]" value="{{$item->title}}"></td>
                </tr>
                <tr>
                    <td class="cell-name">宝贝卖点</td>
                    <td>
                        <textarea title="" class="form-control w500 h60" name="item[subtitle]">{{$item->subtitle}}</textarea>
                    </td>
                </tr>
                {{--<tr>--}}
                {{--<td class="cell-name">宝贝属性</td>--}}
                {{--<td>错误填写宝贝属性，可能会引起宝贝下架或搜索流量减少，影响您的正常销售，请认真准确填写！</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                {{--<td class="cell-name"></td>--}}
                {{--<td>--}}
                {{--<div class="props" id="props">--}}

                {{--</div>--}}
                {{--</td>--}}
                {{--</tr>--}}
                <tr>
                    <td class="cell-name">宝贝图片</td>
                    <td>第一张为宝贝主图，主图不能超过3MB,仅支持上传JPG格式的图片,拖拽图片可跟换顺序。</td>
                </tr>
                <tr>
                    <td class="cell-name"></td>
                    <td>
                        <div class="dsxui-uploader">
                            <ul class="dsxui-uploader-files" id="uploader-files">
                                @foreach ($item->images as $index=>$img)
                                    <li class="dsxui-uploader-file bg-cover" style="background-image:url({{$img->thumb}})">
                                        <input type="hidden" name="images[{{$index}}][id]" value="{{$img->id}}">
                                        <input type="hidden" name="images[{{$index}}][thumb]" value="{{$img->thumb}}">
                                        <input type="hidden" name="images[{{$index}}][image]" value="{{$img->image}}">
                                        <span class="iconfont icon-round_close_fill_light delete"></span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="dsxui-uploader-input" id="uploader-input">
                                <div class="iconfont icon-add_light"></div>
                            </div>
                        </div>
                    </td>
                </tr>
{{--                <tr>--}}
{{--                    <td class="cell-name">产品型号</td>--}}
{{--                    <td>--}}
{{--                        <div class="sku-wrapper">--}}
{{--                            <div class="sku-group" v-for="(attr,index) in selectedAttrs">--}}
{{--                                <div class="sku-name">--}}
{{--                                    <span>@{{ attr.attr_name }}</span>--}}
{{--                                    <a class="iconfont icon-round_close_fill_light delete" @click="delAttribute(attr)"></a>--}}
{{--                                </div>--}}
{{--                                <div class="sku-attr">--}}
{{--                                    <ul class="sku-attr-values">--}}
{{--                                        <li v-for="val in attr.values">--}}
{{--                                            <label>--}}
{{--                                                <input type="checkbox" v-model="val.checked" @change="buildSkuTable()">--}}
{{--                                                <span>@{{ val.value }}</span>--}}
{{--                                            </label>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                    <div class="add-sku-value">--}}
{{--                                        <span class="btn btn-link btn-sm" @click="addValue(attr,index)">+添加型号</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div style="padding: 15px;">--}}
{{--                                <div class="btn btn-default" @click="addAttribute()">添加型号分类</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr v-if="skuRows.length > 0">--}}
{{--                    <td class="cell-name">价格与库存</td>--}}
{{--                    <td>--}}
{{--                        <table class="sku-table" cellpadding="0" cellspacing="0" width="100%">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th v-for="name in propNames">@{{ name }}</th>--}}
{{--                                <th width="90">价格</th>--}}
{{--                                <th width="90">库存</th>--}}
{{--                                <th width="120">商品编码</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            <tr v-for="(row, i) in skuRows" :key="i">--}}
{{--                                <template v-for="(d, j) in row" :key="d.id">--}}
{{--                                    <td :rowspan="rowSpans[j]" v-if="i%rowSpans[j]==0 && rowSpans[j]>1">@{{ d.value }}</td>--}}
{{--                                    <td v-else-if="rowSpans[j]==1">@{{ d.value }}</td>--}}
{{--                                </template>--}}
{{--                                <td><input type="text" class="form-control" required v-model="skus[i].sku_price"></td>--}}
{{--                                <td><input type="text" class="form-control" required v-model="skus[i].sku_stock"></td>--}}
{{--                                <td><input type="text" class="form-control" required v-model="skus[i].sku_code"></td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </td>--}}
{{--                </tr>--}}
                <tr>
                    <td class="cell-name">一口价</td>
                    <td><input title="" type="text" class="form-control w100" name="item[price]" value="{{$item->price}}"></td>
                </tr>
                <tr>
                    <td class="cell-name">市场价</td>
                    <td><input title="" type="text" class="form-control w100" name="item[market_price]" value="{{$item->market_price}}"></td>
                </tr>
                <tr>
                    <td class="cell-name">库存数量</td>
                    <td><input title="" type="text" class="form-control w100" name="item[stock]" value="{{$item->stock}}"></td>
                </tr>
{{--                <tr>--}}
{{--                    <td class="cell-name">红包金额</td>--}}
{{--                    <td>--}}
{{--                        <input title="" type="text" class="form-control w100" name="item[redpack_amount]" value="{{$item->redpack_amount}}">--}}
{{--                        <p>通过好友分享链接进行交易后进行红包返现，金额必须在1-200之间</p>--}}
{{--                    </td>--}}
{{--                </tr>--}}
                <tr>
                    <td class="cell-name">宝贝详情</td>
                    <td>@include('common.editor', ['name'=>'content[content]','content' => $item->content['content'], 'params'=>[]])</td>
                </tr>
                <tr>
                    <td class="cell-name">运费模板</td>
                    <td>
                        <div class="input-group w300">
                            <select class="custom-select" name="item[freight_template]">
                                @foreach ($freightTemplates as $temp)
                                    <option value="{{$temp->template_id}}">{{$temp->template_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="cell-name">上架时间</td>
                    <td>
                        <label><input type="radio" name="item[on_sale]" value="1"{{$item->on_sale ? ' checked="checked"' : ''}}> <span>立即上架</span></label>
                        <label><input type="radio" name="item[on_sale]" value="0"{{!$item->on_sale ? ' checked="checked"' : ''}}> <span>存入仓库</span></label>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td width="80"></td>
                    <td><button type="submit" class="btn btn-primary btn-lg w200" @click="submit()">立即发布</button></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        (function () {
            var imageIndex = 0;
            var uploaderFiles = $("#uploader-files");
            var uploaderInput = $("#uploader-input");
            function checkCount() {
                if (uploaderFiles.find(".dsxui-uploader-file").length > 4){
                    uploaderInput.hide();
                }else{
                    uploaderInput.show();
                }
            }

            function bindDelHander(){
                uploaderFiles.find(".delete").on('click',function () {
                    $(this).parent().remove();
                    checkCount();
                });
            }

            uploaderInput.on('click',function () {
                Widget.showImagePicker(function (data) {
                    console.log(data);
                    //uploaderFiles.append('<p>1111</p>');
                    imageIndex--;
                    uploaderFiles.append(
                        '<li class="dsxui-uploader-file bg-cover" style="background-image:url('+data.thumb+')">\n' +
                        '   <input type="hidden" name="images['+imageIndex+'][id]" value="'+imageIndex+'">\n' +
                        '   <input type="hidden" name="images['+imageIndex+'][thumb]" value="'+data.thumb+'">\n' +
                        '   <input type="hidden" name="images['+imageIndex+'][image]" value="'+data.image+'">\n' +
                        '   <span class="iconfont icon-round_close_fill_light delete"></span>\n' +
                        '</li>');
                    checkCount();
                    bindDelHander();
                });
            });
            checkCount();
            bindDelHander();
            uploaderFiles.sortable();
        })();
    </script>
@stop
