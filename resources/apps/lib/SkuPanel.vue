<template>
    <div class="sku-panel">
        <div class="sku-classify" v-for="(attr,index) in tmpAttrList" :key="index">
            <div class="sku-classify-header">
                <div class="sku-classify-attribute">型号分类:</div>
                <div class="sku-classify-select">
                    <el-autocomplete
                            size="medium"
                            :value="attr.attr_title"
                            :fetch-suggestions="handleSearchAttrTitles"
                            @select="handleSelectAttrTitle"
                            @change="handleAttrChange"
                            @focus="handleAttrFocus($event,index)"
                    ></el-autocomplete>
                </div>
                <div class="flex"></div>
                <div class="iconfont icon-round_close_fill_light sku-classify-del" @click="handleDelAttr(index)"></div>
            </div>
            <div class="sku-classify-content" v-if="attr.attr_title">
                <div class="sku-sort-types">
                    <div class="sku-type" v-for="(val,idx) in attr.attr_values" :key="idx">
                        <div class="sku-type-value">
                            <el-autocomplete
                                    size="medium"
                                    :value="val.attr_value"
                                    :fetch-suggestions="handleSearchAttrValues"
                                    @select="handleSelectAttrValue"
                                    @change="handleValueChange"
                                    @focus="handleValueFocus($event,index,idx)"
                                    placeholder="请填写型号"
                            ></el-autocomplete>
                        </div>
                        <div class="iconfont icon-round_close_fill_light sku-type-del"
                             @click="handleDelValue(attr,idx)"></div>
                    </div>
                    <el-button type="text" size="medium" @click="handleAddValue(attr)" style="height: 36px;">
                        <span class="iconfont icon-add"></span>
                        <span>添加型号</span>
                    </el-button>
                </div>
            </div>
        </div>
        <div class="sku-operate-buttons" v-if="tmpAttrList.length<3">
            <el-button size="medium" @click="handleAddAttr">
                <span class="iconfont icon-add"></span>
                <span>添加型号分类</span>
            </el-button>
        </div>
        <div class="sku-table-wrapper" v-if="attrInfo.length>0">
            <table class="sku-table">
                <thead>
                <tr>
                    <th v-for="(title,index) in attrTitles" :key="index">{{ title }}</th>
                    <th class="col-170">
                        <div class="oneline">
                            <i class="star">*</i>
                            <span>价格</span>
                            <div class="flex">
                                <el-input size="medium" type="number" @blur="handleFillPrice"></el-input>
                            </div>
                        </div>
                    </th>
                    <th class="col-170">
                        <div class="oneline">
                            <i class="star">*</i>
                            <span>库存</span>
                            <div class="flex">
                                <el-input size="medium" type="number" @blur="handleFillStock"></el-input>
                            </div>
                        </div>
                    </th>
                    <th class="col-170">
                        <div class="oneline">
                            <span>编码</span>
                            <div class="flex">
                                <el-input size="medium" @blur="handleFillCode"></el-input>
                            </div>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(attr,i) in attrInfo">
                    <td
                            v-for="(col,j) in attrValues[i]"
                            :rowspan="rowSpans[j]"
                            v-if="showColumn(i,j)">
                        {{ col.attr_value }}
                    </td>
                    <td>
                        <el-input size="medium" type="number" v-model="attr.price"></el-input>
                    </td>
                    <td>
                        <el-input size="medium" type="number" v-model="attr.stock"></el-input>
                    </td>
                    <td>
                        <el-input size="medium" type="text" v-model="attr.code"></el-input>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SkuPanel",
        components: {},
        data: function () {
            return {
                attrList: [],
                attrInfo: [],
                tmpAttrList: [
                    // {
                    //     attr_title: '',
                    //     attr_values: []
                    // }
                ],
                attrTitles: [],
                attrValues: [],
                rowSpans: [],
                showCount: [],
                productAttrs: [],
                restaurants: [],
                editingInput: null,
                attrindex: 0,
                valueindex: 0
            }
        },
        props: {
            defaultAttrList: {
                type: Array,
                default: []
            },
            defaultAttrInfo: {
                type: Object,
                default: {}
            }
        },
        watch: {
            attrValues(val) {
                this.buildAttrInfo();
                this.handleAttrInfoChange();
            },
            tmpAttrList(val) {
                this.$emit('change', val);
                this.renderTable();
            },
            defaultAttrList(val) {
                //console.log(val);
                this.tmpAttrList = val;
            }
        },
        methods: {
            handleAddAttr: function () {
                if (this.tmpAttrList.length < 3) {
                    this.tmpAttrList.push({
                        attr_title: '',
                        attr_values: []
                    });
                    this.renderTable();
                }
            },
            handleDelAttr: function (index) {
                this.tmpAttrList.splice(index, 1);
                this.renderTable();
            },
            handleAttrChange: function (value) {
                //console.log('handleAttrChange');
                var attr = this.tmpAttrList[this.attrindex];
                if (value) {
                    if (value === attr.attr_title) return;
                    if (_.findIndex(this.tmpAttrList, (o) => o.attr_title === value) !== -1) {
                        this.editingInput.value = attr.attr_title;
                        this.$toast('不能添加相同的分类');
                        return;
                    }
                }
                attr.attr_title = value;
                this.renderTable();
            },
            handleAttrFocus: function (e, index) {
                this.attrindex = index;
                this.editingInput = e.target;
            },
            handleAddValue: function (attr) {
                attr.attr_values.push({
                    attr_id: 0,
                    attr_value: null
                });
                this.renderTable();
            },
            handleDelValue: function (attr, i) {
                attr.attr_values.splice(i, 1);
                this.renderTable();
            },
            handleValueChange: function (value) {
                //console.log('handleValueChange');
                var attr = this.tmpAttrList[this.attrindex];
                var attrvalue = attr.attr_values[this.valueindex];
                if (value) {
                    if (value === attrvalue.attr_value) return;
                    if (_.findIndex(attr.attr_values, (o) => o.attr_value === value) !== -1) {
                        this.editingInput.value = attrvalue.attr_value;
                        this.$toast('不能添加相同的型号');
                        return;
                    }


                    this.updateAttrs({
                        ...attr,
                        ...attrvalue,
                        attr_value: value
                    }, (d) => {
                        this.tmpAttrList[this.attrindex].attr_values[this.valueindex] = d.attr;
                        this.renderTable();
                    });
                }
            },
            handleValueFocus: function (e, i, j) {
                this.attrindex = i;
                this.valueindex = j;
                this.editingInput = e.target;
            },
            renderTable: function () {
                var rowCount = [];
                var attrTitles = [];
                var attrValues = [];
                var attrList = [];
                this.tmpAttrList.map(function (attr) {
                    if (attr.attr_title) {
                        var attr_values = [];
                        attr.attr_values.map(function (val) {
                            if (val.attr_id) attr_values.push({
                                ...val,
                                attr_title: attr.attr_title
                            });
                        });

                        if (attr_values.length > 0) {
                            attrTitles.push(attr.attr_title);
                            attrValues.push(attr_values);
                            rowCount.push(attr_values.length);
                            attrList.push({
                                ...attr,
                                attr_values
                            });
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
                this.attrTitles = attrTitles;
                this.attrList = attrList;
                if (attrValues.length > 0) {
                    this.attrValues = this.combine(attrValues.reverse());
                } else {
                    this.attrValues = [];
                }
                //console.log('attrValues');
                //console.log(attrValues);
            },
            buildAttrInfo: function () {
                var _this = this;
                var attrInfo = [];
                this.attrValues.map((row, i) => {
                    var title = row.map((r) => r.attr_title + ':' + r.attr_value).join(',');
                    var properties = row.map((r) => r.attr_id).join('-');
                    if (_this.defaultAttrInfo[properties]) {
                        attrInfo.push(_this.defaultAttrInfo[properties]);
                    } else {
                        attrInfo.push({
                            sku_id: 0,
                            price: '',
                            stock: '',
                            code: '',
                            image: '',
                            title,
                            properties
                        });
                    }
                });

                this.attrInfo = attrInfo;
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
            combine: function (arr) {
                var r = [];
                (function f(t, a, n) {
                    if (n === 0) return r.push(t);
                    for (var i = 0; i < a[n - 1].length; i++) {
                        f(t.concat(a[n - 1][i]), a, n - 1);
                    }
                })([], arr, arr.length);
                return r;
            },
            handleFillPrice: function (e) {
                this.attrInfo.forEach((attr) => {
                    attr.price = e.target.value;
                });
                this.handleAttrInfoChange();
            },
            handleFillStock: function (e) {
                this.attrInfo.forEach((attr) => {
                    attr.stock = e.target.value;
                });
                this.handleAttrInfoChange();
            },
            handleFillCode: function (e) {
                this.attrInfo.forEach((attr) => {
                    attr.code = e.target.value;
                });
                this.handleAttrInfoChange();
            },
            handleSearchAttrTitles(queryString, cb) {
                var _this = this;
                if (queryString == null) queryString = '';
                this.$get('/product/attrs/search?attr_title=' + queryString).then(response => {
                    var attrs = [];
                    response.result.items.map((a) => {
                        if (_.findIndex(_this.tmpAttrList, (o) => o.attr_title === a.attr_title) === -1) {
                            attrs.push({
                                ...a,
                                value: a.attr_title
                            });
                        }
                    });
                    cb(attrs);
                    // var results = queryString ? attrs.filter((res) => {
                    //     return (attrs.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
                    // }) : attrs;
                    // // 调用 callback 返回建议列表的数据
                    // cb(results);
                });
            },
            handleSearchAttrValues: function (queryString, cb) {
                var attr = this.tmpAttrList[this.attrindex];
                var attr_title = attr.attr_title;
                if (queryString == null) queryString = '';
                this.$get('/product/attrs/search?attr_title=' + attr_title + '&attr_value=' + queryString)
                    .then(response => {
                        var attrs = [];
                        response.result.items.map((v) => {
                            if (_.findIndex(attr.attr_values, (o) => o.attr_value === v.attr_value) === -1) {
                                attrs.push({
                                    ...v,
                                    value: v.attr_value
                                });
                            }
                        });
                        cb(attrs);
                    });
            },
            updateAttrs: function (params, cb) {
                this.$post('/product/attrs/update', params).then(response => {
                    if (cb) cb(response.result);
                });
            },
            handleSelectAttrTitle: function (attr) {
                this.tmpAttrList[this.attrindex].attr_title = attr.value;
                this.renderTable();
            },
            handleSelectAttrValue: function (val) {
                this.tmpAttrList[this.attrindex].attr_values[this.valueindex] = val;
                this.renderTable();
            },
            handleAttrInfoChange: function () {
                this.$emit('sku-change', {
                    skus: this.attrInfo,
                    attrs: this.attrList
                });
            }
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
