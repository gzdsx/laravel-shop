@extends('layouts.shop')

@section('content')
    <div class="area" id="app">
        <div class="sku-panel">
            <div class="sku-classify" v-for="(spec,index) in specs" :key="index">
                <div class="sku-classify-header">
                    <div class="sku-classify-attribute">型号分类:</div>
                    <div class="sku-classify-select">
                        <input type="text" class="form-control w200" :value="spec.name" @blur="onSpecBlur(event,spec)">
                    </div>
                    <div class="flex"></div>
                    <div class="iconfont icon-round_close_fill_light sku-classify-del" @click="delSpec(index)"></div>
                </div>
                <div class="sku-classify-content" v-if="spec.name">
                    <div class="sku-sort-types">
                        <div class="sku-type" v-for="(val,i) in spec.values" :key="i">
                            <div class="sku-type-value">
                                <input type="text" class="form-control w150" placeholder="请填写型号" :value="val.value"
                                       @blur="onTypeBlur(event,val)">
                            </div>
                            <div class="iconfont icon-round_close_fill_light sku-type-del"
                                 @click="delValue(spec,i)"></div>
                        </div>
                        <div class="sku-type-add" @click="addValue(spec)">
                            <span class="iconfont icon-add"></span>
                            <span>添加型号</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sku-operate-buttons" v-if="specs.length<3">
                <div class="btn btn-default" @click="addSpec">
                    <span class="iconfont icon-add"></span>
                    <span>添加型号分类</span>
                </div>
            </div>
            <div class="sku-table-wrapper" v-if="specNames.length>0">
                <table width="100%" class="sku-table">
                    <thead>
                    <tr>
                        <th v-for="(name,index) in specNames" :key="index">@{{ name }}</th>
                        <th class="col-170">
                            <div class="oneline">
                                <i class="star">*</i>
                                <span>价格</span>
                                <div class="flex">
                                    <input type="number" class="form-control" @blur="onPriceBlur">
                                </div>
                            </div>
                        </th>
                        <th class="col-170">
                            <div class="oneline">
                                <i class="star">*</i>
                                <span>库存</span>
                                <div class="flex">
                                    <input type="number" class="form-control" @blur="onStockBlur">
                                </div>
                            </div>
                        </th>
                        <th class="col-170">
                            <div class="oneline">
                                <span>编码</span>
                                <div class="flex">
                                    <input type="number" class="form-control" @blur="onCodeBlur">
                                </div>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(row,i) in skuRows">
                        <td v-for="(col,j) in row" :rowspan="rowSpans[j]" v-if="showColumn(i,j)">@{{ col.value }}</td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        //排列组合
        function combine(arr) {
            var r = [];
            (function f(t, a, n) {
                if (n === 0) return r.push(t);
                for (var i = 0; i < a[n - 1].length; i++) {
                    f(t.concat(a[n - 1][i]), a, n - 1);
                }
            })([], arr, arr.length);
            return r;
        }

        new Vue({
            el: '#app',
            data: {
                specs: [],
                specNames: [],
                rowSpans: [],
                showCount: [],
                skuList: [],
                skuRows: []
            },
            methods: {
                addSpec: function () {
                    if (this.specs.length < 3) {
                        this.specs.push({
                            id: 0,
                            name: null,
                            values: []
                        });
                    }
                },
                onSpecBlur: function (e, spec) {
                    spec.name = e.target.value;
                },
                addValue: function (spec) {
                    spec.values.push({
                        id: 0,
                        value: null
                    });
                },
                onTypeBlur: function (e, val) {
                    val.value = e.target.value;
                    this.renderTable();
                },
                delSpec: function (index) {
                    this.specs = this.specs.filter(function (sp, i) {
                        if (i !== index) return sp;
                    });
                    this.renderTable();
                },
                delValue: function (spec, index) {
                    spec.values = spec.values.filter(function (val, i) {
                        if (i !== index) return val;
                    });
                    this.renderTable();
                },
                renderTable: function () {
                    var rowCount = [];
                    var specNames = [];
                    var specValues = [];
                    this.specs.map(function (sp) {
                        if (sp.name) {
                            var values = [];
                            sp.values.map(function (val) {
                                if (val.value) {
                                    values.push(val);
                                }
                            });

                            if (values.length > 0) {
                                specNames.push(sp.name);
                                specValues.push(values);
                                rowCount.push(values.length);
                            }
                        }
                    });

                    var rowSpans = [];
                    var showCount = [];
                    for (var i = 0; i < rowCount.length; i++) {
                        var subRowCount = rowCount.slice(i + 1, rowCount.length);
                        rowSpans.push(subRowCount.reduce(function (a, b) {
                            return a * b;
                        }, 1));

                        var subAttrCount = rowCount.slice(0, i + 1);
                        const rowspanItem = subAttrCount.reduce(function (a, b) {
                            return a * b;
                        }, 1);
                        showCount.push(rowspanItem);
                    }
                    this.rowSpans = rowSpans;
                    this.showCount = showCount;
                    this.specNames = specNames;
                    this.skuRows = combine(specValues.reverse());
                    console.log(this.skuRows);
                },
                showColumn: function (row, col) {
                    const maxCount = this.showCount[this.showCount.length - 1]; // 最多行的一列（即最后一列）
                    if (col < this.showCount.length - 1 && row !== 0) {
                        // 在非第一行也不是最后一列只有在满足次条件才能显示
                        return row % (maxCount / this.showCount[col]) === 0;
                    } else {
                        // 第一行或最后一列都是直接显示即可
                        return true;
                    }
                },
                onPriceBlur: function (e) {

                },
                onStockBlur: function (e) {

                },
                onCodeBlur: function (e) {

                }
            },
            mounted: function () {

            }
        });
    </script>
@stop
