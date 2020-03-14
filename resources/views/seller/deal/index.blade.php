@extends('layouts.seller')

@section('title', '交易设置')

@section('content')
    <div class="console-title">
        <h2>交易设置</h2>
    </div>
    <div class="ds-list">
        <div class="cell-title">
            <div class="cell-column column-1">功能</div>
            <div class="cell-column column-2">状态</div>
            <div class="cell-column column-3">说明</div>
            <div class="cell-column column-4">操作</div>
        </div>
        <div class="cell-row">
            <div class="cell-column column-1">减库存方式</div>
            <div class="cell-column column-2" v-if="shop.reduce_type==1">拍下减库存</div>
            <div class="cell-column column-2" v-else>付款减库存</div>
            <div class="cell-column column-3">
                <p>拍下减库存--建议库存充足的店家使用;</p>
                <p>付款减库存--库存紧张、需要防止被占用的店家;</p>
            </div>
            <div class="cell-column column-4">
                <a href="javascript:;" v-on:click="showReduceType">修改</a>
            </div>
        </div>
        <div class="cell-row">
            <div class="cell-column column-1">七天退货保障</div>
            <div class="cell-column column-2">
                <div v-if="shop.seven_day_return">
                    <span class="iconfont icon-check-circle-fill opened"></span>
                    <span>已开通</span>
                </div>
                <div v-else>
                    <span class="iconfont icon-minus-circle-fill closed"></span>
                    <span>未开通</span>
                </div>
            </div>
            <div class="cell-column column-3">
                <p>开通后支持买家7天退货，提升买家信任度</p>
            </div>
            <div class="cell-column column-4">
                <a href="{{seller_url('deal/day')}}">详情</a>
            </div>
        </div>
        <div class="cell-row">
            <div class="cell-column column-1">退货地址设置</div>
            <div class="cell-column column-2">
                <div>
                    <span class="iconfont icon-minus-circle-fill"></span>
                    <span>未设置</span>
                </div>
            </div>
            <div class="cell-column column-3">
                <p>设置默认退货地址，买家申请退货，若您超时未及时处理将通知买家把货物退回至该地址，避免资金损失</p>
            </div>
            <div class="cell-column column-4">
                <a>设置</a>
            </div>
        </div>
        <div class="cell-row">
            <div class="cell-column column-1">退款自动增加库存</div>
            <div class="cell-column column-2">
                <div>
                    <span class="iconfont icon-minus-circle-fill"></span>
                    <span>未设置</span>
                </div>
            </div>
            <div class="cell-column column-3">
                <p>开启后，待发货状态，若产生全额退款，库存自动增加，节省库存维护成本</p>
            </div>
            <div class="cell-column column-4">
                <a>设置</a>
            </div>
        </div>
    </div>
    <!--reduceType Modal -->
    <div class="modal-backdrop fade show" v-if="showModal"></div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="reduceTypeModalTitle" :class="{'show':showModal}">
        <div class="modal-dialog modal-dialog-centered w700" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reduceTypeModalTitle">减库存方式</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ds-option">
                        <div class="ds-option-radio">
                            <input type="radio" class="radio" name="reduce_type" value="1" v-model="reduce_type">
                        </div>
                        <div class="ds-option-content">
                            <div class="t1">拍下减库存</div>
                            <div class="t2">（家拍下商品,库存数量就相应减少，24小时后仍未付款，恢复库存数量）</div>
                            <div class="t2">
                                <div class="lb">好处：</div>
                                <div class="flex">保证买家只要拍下宝贝，就一定能买到。</div>
                            </div>
                            <div class="t2">
                                <div class="lb">坏处：</div>
                                <div class="flex">
                                    <p>1.在库存紧张时，买家拍下之后不付款，会影响其他买家购买；</p>
                                    <p>2.可能有人恶意占用库存，给店家造成损失；</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ds-option">
                        <div class="ds-option-radio">
                            <input type="radio" class="radio" name="reduce_type" value="2" v-model="reduce_type">
                        </div>
                        <div class="ds-option-content">
                            <div class="t1">付款减库存</div>
                            <div class="t2">（买家拍下商品，先预扣库存，如果15分钟内付款则减去库存；如果超过15分钟未付款，则释放库存）</div>
                            <div class="t2">
                                <div class="lb">好处：</div>
                                <div class="flex">库存不会被长时间占用，当库存紧张时，真正想买的客户有更多机会买到宝贝。</div>
                            </div>
                            <div class="t2">
                                <div class="lb">坏处：</div>
                                <div class="flex">
                                    可能出现超卖，最后一个库存被多个客户同时付款，就需要店家和客户协商解决。
                                    微店会通过短信和订单详情页提醒的方式通知店家和客户。
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w90" @click="hideModal">取消</button>
                    <button type="button" class="btn btn-danger w90" @click="setReduceType">确定</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script src="{{asset('js/seller/deal_setting.js?'.time())}}" type="application/javascript"></script>
@stop
