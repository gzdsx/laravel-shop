import React from 'react';
import {Text, TouchableOpacity, View} from 'react-native';
import PropTypes from 'prop-types';
import {Toast} from "react-native-gzdsx-elements";
import OrderProcessor from "../../utils/OrderProcessor";
import PickerView from "../../components/PickerView";

const ActionButton = ({title, show = true, onPress = () => null}) => {
    return (
        <TouchableOpacity
            activeOpacity={1}
            style={{
                paddingHorizontal: 12,
                borderRadius: 10,
                borderWidth: 0.5,
                borderColor: '#ccc',
                marginLeft: 10,
                display: show ? 'flex' : 'none'
            }}
            onPress={onPress}
        >
            <Text style={{
                flex: 1,
                color: '#333',
                fontSize: 12,
                textAlign: 'center',
                lineHeight: 28,
                height: 28
            }}>
                {title}
            </Text>
        </TouchableOpacity>
    );
};

class OrderActionBar extends React.Component {

    render(): React.ReactNode {
        const {style, order, children, reasons} = this.props;
        const {order_id} = order;
        return (
            <View style={{
                padding: 10,
                flexDirection: 'row',
                alignContent: 'flex-end',
                ...style
            }}>
                <View style={{flex: 1}}/>
                {children}
                <ActionButton
                    title={"取消订单"}
                    show={order.order_state === 0}
                    onPress={() => {
                        PickerView.init({
                            pickerData: reasons,
                            onPickerConfirm: data => {
                                OrderProcessor.cancel(order_id, data[0]).then(() => {
                                    this.props.onCancel && this.props.onCancel();
                                }).catch(reason => {
                                    Toast.fail(reason.errMsg);
                                });
                            }
                        });
                        PickerView.show();
                    }}
                />
                <ActionButton
                    title={"查看物流"}
                    show={order.shipping_state}
                    onPress={() => this.props.onExpress(order)}
                />
                <ActionButton
                    title={"支付"}
                    show={order.order_state === 0}
                    onPress={() => {
                        OrderProcessor.pay(order_id, 1).then(() => {
                            this.props.onPaySucceed && this.props.onPaySucceed(order);
                        }).catch(reason => {
                            console.log(reason);
                            this.props.onPayFailed && this.props.onPayFailed(reason);
                        });
                    }}
                />
                <ActionButton
                    title={"提醒卖家发货"}
                    show={order.order_state === 1}
                    onPress={() => {
                        OrderProcessor.notice(order_id).then(() => {
                            Toast.success('已成功提醒卖家发货');
                            this.props.onNotice(order);
                        }).catch(reason => {

                        });
                    }}
                />
                <ActionButton
                    title={"确认收货"}
                    show={order.order_state === 2}
                    onPress={() => {
                        OrderProcessor.confirm(order_id).then(response => {
                            this.props.onConfirm(order)
                        }).catch(reason => {
                            console.log(reason);
                        });
                    }}
                />
                <ActionButton
                    title={"评价"}
                    show={order.receive_state === 1 && order.buyer_rate === 0}
                    onPress={() => this.props.onRate(order)}
                />
                <ActionButton
                    title={"删除订单"}
                    show={order.cancel_state}
                    onPress={() => {
                        OrderProcessor.delete(order_id).then(() => {
                            this.props.onDelete(order);
                        }).catch(reason => {

                        });
                    }}
                />
            </View>
        );
    }
}

OrderActionBar.propTypes = {
    style: PropTypes.object,
    order: PropTypes.object,
    reasons: PropTypes.array,
    onCancel: PropTypes.func,
    //onRefund: PropTypes.func,
    onExpress: PropTypes.func,
    onPay: PropTypes.func,
    onNotice: PropTypes.func,
    onConfirm: PropTypes.func,
    onRate: PropTypes.func,
    onDelete: PropTypes.func
}

OrderActionBar.defaultProps = {
    style: {},
    order: {},
    reasons: [],
    onCancel: () => null,
    //onRefund: () => null,
    onExpress: () => null,
    onPay: () => null,
    onNotice: () => null,
    onConfirm: () => null,
    onRate: () => null,
    onDelete: () => null,
}

export default OrderActionBar;
