<template>
    <div class="sku-panel">
        <div class="sku-classify" v-for="(attr,index) in tmpAttrList" :key="index">
            <div class="sku-classify-header">
                <div class="sku-classify-attribute">型号分类:</div>
                <div class="sku-classify-select">
                    <el-autocomplete
                            size="medium"
                            value-key="attr_title"
                            :value="attr.attr_title"
                            :fetch-suggestions="onSearchAttrTitles"
                            @select="onSelectAttrTitle"
                            @change="onAttrChange"
                            @focus="onAttrFocus($event,index)"
                    ></el-autocomplete>
                </div>
                <div class="flex"></div>
                <div class="iconfont icon-round_close_fill_light sku-classify-del" @click="onDelAttr(index)"></div>
            </div>
            <div class="sku-classify-content" v-if="attr.attr_title">
                <div class="sku-sort-types">
                    <div class="sku-type" v-for="(val,idx) in attr.attr_values" :key="idx">
                        <div class="sku-type-value">
                            <el-autocomplete
                                    size="medium"
                                    value-key="attr_value"
                                    :value="val.attr_value"
                                    :fetch-suggestions="onSearchAttrValues"
                                    @select="onSelectAttrValue"
                                    @change="onValueChange"
                                    @focus="onValueFocus($event,index,idx)"
                                    placeholder="请填写型号"
                            ></el-autocomplete>
                        </div>
                        <div class="iconfont icon-round_close_fill_light sku-type-del"
                             @click="onDelValue(attr,idx)"></div>
                    </div>
                    <el-button type="text" size="medium" @click="onAddValue(attr)" style="height: 36px;">
                        <span class="iconfont icon-add"></span>
                        <span>添加型号</span>
                    </el-button>
                </div>
            </div>
        </div>
        <div class="sku-operate-buttons" v-if="tmpAttrList.length<3">
            <el-button size="medium" @click="onAddAttr">
                <span class="iconfont icon-add"></span>
                <span>添加型号分类</span>
            </el-button>
        </div>
        <div class="sku-table-wrapper" v-if="attrInfo.length>0">
            <table class="sku-table">
                <thead>
                <tr>
                    <th v-for="(title,index) in attrTitles" :key="index">{{ title }}</th>
                    <th class="col-120">
                        <div class="h-title">
                            <i class="star">*</i>
                            <span>价格</span>
                        </div>
                        <div class="h-input">
                            <el-input size="small" type="number" @blur="onFillPrice"></el-input>
                        </div>
                    </th>
                    <th class="col-120" v-if="pinable">
                        <div class="h-title">
                            <i class="star">*</i>
                            <span>拼团价</span>
                        </div>
                        <div class="h-input">
                            <el-input size="small" type="number" @blur="onFillPinPrice"></el-input>
                        </div>
                    </th>
                    <th class="col-120">
                        <div class="h-title">
                            <i class="star">*</i>
                            <span>库存</span>
                        </div>
                        <div class="h-input">
                            <el-input size="small" type="number" @blur="onFillStock"></el-input>
                        </div>
                    </th>
                    <th class="col-120">
                        <div class="h-title">
                            <span>编码</span>
                        </div>
                        <div class="h-input">
                            <el-input size="small" @blur="onFillCode"></el-input>
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
                        <el-input size="small" type="number" v-model="attr.price"></el-input>
                    </td>
                    <td v-if="pinable">
                        <el-input size="small" type="number" v-model="attr.pin_price"></el-input>
                    </td>
                    <td>
                        <el-input size="small" type="number" v-model="attr.stock"></el-input>
                    </td>
                    <td>
                        <el-input size="small" type="text" v-model="attr.code"></el-input>
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
        data() {
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
                editingInput: null,
                attrindex: 0,
                valueindex: 0,
                originalAttrList: []
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
            },
            shop_id: {
                type: Number,
                default: 0
            },
            pinable: {
                type: Boolean,
                default: false
            }
        },
        watch: {
            attrValues(val) {
                this.buildAttrInfo();
                this.onAttrInfoChange();
            },
            tmpAttrList(val) {
                this.renderTable();
                this.onAttrInfoChange();
            },
            defaultAttrList(val) {
                //console.log(val);
                this.tmpAttrList = val;
            }
        },
        methods: {
            onAddAttr() {
                if (this.tmpAttrList.length < 3) {
                    this.tmpAttrList.push({
                        attr_title: '',
                        attr_values: []
                    });
                    this.renderTable();
                }
            },
            onDelAttr(index) {
                this.tmpAttrList.splice(index, 1);
                this.renderTable();
            },
            onAttrChange(value) {
                //console.log('handleAttrChange');
                var attr = this.tmpAttrList[this.attrindex];
                if (value) {
                    if (value === attr.attr_title) return;

                    if (_.findIndex(this.tmpAttrList, (o) => o.attr_title === value) !== -1) {
                        this.editingInput.value = attr.attr_title;
                        this.$showToast('不能添加相同的分类');
                        return;
                    }

                    if (_.findIndex(this.originalAttrList, (o) => o.attr_title === value) === -1) {
                        this.$post('/ecom/product.attr.save', {attr: {attr_title: value}}).then(() => {
                            this.fetchAttrList();
                        });
                    }
                }
                attr.attr_title = value;
                this.renderTable();
            },
            onAttrFocus(e, index) {
                this.attrindex = index;
                this.editingInput = e.target;
            },
            onAddValue(attr) {
                attr.attr_values.push({
                    attr_id: 0,
                    attr_value: null
                });
                this.renderTable();
            },
            onDelValue(attr, i) {
                attr.attr_values.splice(i, 1);
                this.renderTable();
            },
            onValueChange(value) {
                //console.log('handleValueChange');
                var attr = this.tmpAttrList[this.attrindex];
                var val = attr.attr_values[this.valueindex];
                if (value) {
                    if (value === val.attr_value) return;

                    if (_.findIndex(attr.attr_values, (o) => o.attr_value === value) !== -1) {
                        this.editingInput.value = val.attr_value;
                        this.$showToast('不能添加相同的型号');
                        return false;
                    }

                    this.$post('/ecom/product.attr.updateAttrValue', {
                        attr_title: attr.attr_title,
                        attr_value: value
                    }).then((response) => {
                        this.tmpAttrList[this.attrindex].attr_values[this.valueindex] = response.result;
                        this.fetchAttrList();
                        this.renderTable();
                    });
                }
            },
            onValueFocus(e, i, j) {
                this.attrindex = i;
                this.valueindex = j;
                this.editingInput = e.target;
            },
            renderTable() {
                var rowCount = [];
                var attrTitles = [];
                var attrValues = [];
                var attrList = [];
                this.tmpAttrList.map(function (attr) {
                    if (attr.attr_title) {
                        var attr_values = [];
                        attr.attr_values.map(function (val) {
                            if (val.attr_id) attr_values.push(val);
                        });

                        if (attr_values.length > 0) {
                            attrTitles.push(attr.attr_title);
                            attrValues.push(attr_values);
                            rowCount.push(attr_values.length);
                            attrList.push({
                                attr_title: attr.attr_title,
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
            buildAttrInfo() {
                var attrInfo = [];
                this.attrValues.map((row, i) => {
                    var title = row.map((r) => r.attr_value).join(',');
                    var properties = row.map((r) => r.attr_id).join('-');
                    if (this.defaultAttrInfo[properties]) {
                        attrInfo.push(this.defaultAttrInfo[properties]);
                    } else {
                        attrInfo.push({
                            sku_id: 0,
                            price: '',
                            pin_price: '',
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
            showColumn(row, col) {
                const maxCount = this.showCount[this.showCount.length - 1]; // 最多行的一列（即最后一列）
                if (col < this.showCount.length - 1 && row !== 0) {
                    // 在非第一行也不是最后一列只有在满足次条件才能显示
                    return row % (maxCount / this.showCount[col]) === 0;
                } else {
                    // 第一行或最后一列都是直接显示即可
                    return true;
                }
            },
            combine(arr) {
                var r = [];
                (function f(t, a, n) {
                    if (n === 0) return r.push(t);
                    for (var i = 0; i < a[n - 1].length; i++) {
                        f(t.concat(a[n - 1][i]), a, n - 1);
                    }
                })([], arr, arr.length);
                return r;
            },
            onFillPrice(e) {
                this.attrInfo.forEach((attr) => {
                    attr.price = e.target.value;
                });
                this.onAttrInfoChange();
            },
            onFillPinPrice(e) {
                this.attrInfo.forEach((attr) => {
                    attr.pin_price = e.target.value;
                });
                this.onAttrInfoChange();
            },
            onFillStock(e) {
                this.attrInfo.forEach((attr) => {
                    attr.stock = e.target.value;
                });
                this.onAttrInfoChange();
            },
            onFillCode(e) {
                this.attrInfo.forEach((attr) => {
                    attr.code = e.target.value;
                });
                this.onAttrInfoChange();
            },
            onSearchAttrTitles(queryString, cb) {
                var results = [];
                var tmps = this.tmpAttrList.map((attr) => {
                    return attr.attr_title;
                });

                this.originalAttrList.map((attr) => {
                    if (tmps.indexOf(attr.attr_title) === -1) {
                        results.push(attr);
                    }
                });

                cb(results);
            },
            onSearchAttrValues(queryString, cb) {
                var attr = this.tmpAttrList[this.attrindex];
                var tmps = attr.attr_values.map((v) => {
                    return v.attr_value;
                });

                var values = [];
                this.originalAttrList.map((item) => {
                    if (item.attr_title === attr.attr_title) {
                        values = item.attr_values;
                    }
                });

                var results = [];
                values.map((v) => {
                    if (tmps.indexOf(v.attr_value) === -1) {
                        results.push(v);
                    }
                });

                cb(results);
            },
            onSelectAttrTitle(attr) {
                //console.log(attr);
                this.tmpAttrList[this.attrindex].attr_title = attr.attr_title;
                this.renderTable();
            },
            onSelectAttrValue(val) {
                this.tmpAttrList[this.attrindex].attr_values[this.valueindex] = val;
                this.renderTable();
            },
            onAttrInfoChange() {
                this.$emit('change', {
                    skus: this.attrInfo,
                    attrs: this.attrList
                });
            },
            fetchAttrList() {
                let {shop_id} = this;
                this.$get('/ecom/product.attr.getList', {shop_id}).then(response => {
                    this.originalAttrList = response.result.items;
                    //this.renderTable();
                });
            }
        },
        mounted() {
            this.tmpAttrList = this.defaultAttrList;
            this.fetchAttrList();
        }
    }
</script>

<style scoped>

</style>
