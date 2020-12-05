import React from 'react';
import {Modal, View, Text, TouchableOpacity, Animated, TouchableWithoutFeedback, ScrollView} from 'react-native';
import PropTypes from 'prop-types';
import {Ticon} from "react-native-gzdsx-elements";
import {Button, Image} from 'react-native-elements';
import {Toast} from "react-native-gzdsx-elements";
import {NumberControl} from "./NumberControl";
import {Colors, Size} from "../../../styles";

const H = Size.screenHeight * 0.70;

export default class SkuPannel extends React.Component {

    static propTypes = {
        show: PropTypes.bool,
        onSubmit: PropTypes.func
    };

    static defaultProps = {
        show: false,
        onSubmit: () => null
    };

    constructor(props) {
        super(props);
        this.state = {
            visible: props.show,
            bottom: new Animated.Value(-H),
            selectedProps: {},
            sku: {},
            disabled: true
        };
        this.quatity = 1;
        this.skuList = {};
        this.skuProps = [];
    }

    render() {
        const sku = this.state.sku;
        const {data} = this.props;
        return (
            <Modal
                visible={this.state.visible}
                onShow={this.show}
                transparent={true}
            >
                <TouchableOpacity
                    style={{flex: 1, backgroundColor: 'rgba(0,0,0,0.5)'}}
                    onPress={this.hide}
                    activeOpacity={1}
                >
                    <TouchableWithoutFeedback>
                        <Animated.View style={{
                            backgroundColor: '#fff',
                            position: 'absolute',
                            left: 0,
                            right: 0,
                            bottom: this.state.bottom,
                            height: H,
                        }}>
                            <View style={{flexDirection: 'row', padding: 15}}>
                                <Image
                                    source={{uri: data.thumb}}
                                    style={{
                                        width: 90,
                                        height: 90,
                                        borderRadius: 3,
                                        marginRight: 10,
                                    }}
                                />
                                <View style={{flex: 1, flexDirection: 'column'}}>
                                    <Text style={{
                                        color: '#f00',
                                        fontSize: 16,
                                        fontWeight: '600'
                                    }}>￥{sku.price}</Text>
                                    <Text style={{fontSize: 14, color: '#333', marginTop: 5}}>库存{sku.stock}件</Text>
                                    {
                                        sku.title ?
                                            <Text style={{
                                                fontSize: 14,
                                                color: '#333',
                                                marginTop: 5
                                            }}>已选择:{sku.title}</Text>
                                            : null
                                    }
                                </View>
                                <View>
                                    <Ticon name={"close-light"} size={25} color={"#666"} onPress={this.hide}/>
                                </View>
                            </View>
                            <ScrollView style={{
                                flex: 1,
                                borderTopWidth: 0.5,
                                borderTopColor: '#e5e5e5'
                            }}>
                                {this.renderAttrs()}
                                <View style={{
                                    flexDirection: 'row',
                                    padding: 15,
                                    borderBottomColor: '#e5e5e5',
                                    borderBottomWidth: 0.5,
                                }}>
                                    <Text style={{
                                        fontSize: 14,
                                        color: '#333',
                                        flex: 1,
                                        lineHeight: 30
                                    }}>购买数量</Text>
                                    <NumberControl maxValue={data.stock} onValueChange={(value) => {
                                        this.quatity = value;
                                    }}/>
                                </View>
                            </ScrollView>
                            <View style={{paddingTop: 10, paddingBottom: 10, paddingLeft: 20, paddingRight: 20}}>
                                <Button
                                    title={"确定"}
                                    buttonStyle={{height: 40, backgroundColor: Colors.primary}}
                                    onPress={() => {
                                        const sku = this.state.sku;
                                        const quantity = this.quatity;
                                        if (this.props.data.skus.length > 0) {
                                            if (sku.sku_id === undefined) {
                                                this.refs.toast.show('请选择产品型号');
                                                return false;
                                            }
                                        }

                                        if (this.props.onSubmit) {
                                            this.props.onSubmit(sku, quantity);
                                        }
                                    }}
                                    disabled={this.state.disabled}
                                    activeOpacity={0.8}
                                />
                            </View>
                        </Animated.View>
                    </TouchableWithoutFeedback>
                </TouchableOpacity>
                <Toast ref={"toast"}/>
            </Modal>
        );
    }

    componentDidMount() {
        const data = this.props.data;
        const skus = data.skus || [];
        this.setState({
            sku: {
                price: data.price,
                stock: data.stock
            }
        });

        skus.map((sku, idx) => {
            this.skuList[sku.properties] = sku;
        });

        if (skus.length === 0) {
            this.setState({disabled: false});
        }
    }

    UNSAFE_componentWillReceiveProps(nextProps: Readonly<P>, nextContext: any) {
        if (nextProps.show) {
            this.show();
        } else {
            this.hide();
        }
    }

    renderAttrs = () => {
        const attrs = this.props.data.attrs || [];
        if (attrs.length === 0) return null;
        let attrViews = attrs.map((attr, i) => {
            let valueViews = attr.attr_values.map((val, j) => {
                let selectedProps = this.state.selectedProps;
                let checked = selectedProps[i] === i + '-' + j;
                return (
                    <TouchableOpacity
                        key={i + '-' + j}
                        style={{
                            borderRadius: 5,
                            backgroundColor: checked ? '#f00' : '#f0f0f0',
                            marginRight: 10,
                        }}
                        onPress={() => {
                            selectedProps[i] = i + '-' + j;
                            this.setState({selectedProps});
                            this.skuProps[i] = val.attr_id;
                            this.setSku();
                        }}
                        activeOpacity={1}
                    >
                        <Text style={{
                            fontSize: 12,
                            paddingHorizontal: 10,
                            paddingVertical: 7,
                            color: checked ? '#fff' : '#666'
                        }}>{val.attr_value}</Text>
                    </TouchableOpacity>
                );
            });

            return (
                <View key={i.toString()} style={{marginBottom: 15}}>
                    <View style={{marginBottom: 10}}><Text
                        style={{fontSize: 16, fontWeight: '500'}}>{attr.attr_title}</Text></View>
                    <View style={{flexDirection: 'row'}}>{valueViews}</View>
                </View>
            )
        });

        return <View style={{
            paddingVertical: 10,
            paddingHorizontal: 15,
            borderBottomColor: '#e5e5e5',
            borderBottomWidth: 0.5
        }}>{attrViews}</View>;
    }

    show = () => {
        this.setState({
            visible: true
        }, () => {
            Animated.timing(this.state.bottom, {
                toValue: 0,
                duration: 200,
                useNativeDriver: false
            }).start(({finished}) => {
                if (finished) {

                }
            });
        });
    }

    hide = () => {
        Animated.timing(this.state.bottom, {
            toValue: -H,
            duration: 200,
            useNativeDriver: false
        }).start(({finished}) => {
            if (finished) {
                this.setState({
                    visible: false
                });
            }
        });
    }

    setSku = () => {
        if (this.skuProps.length === this.props.data.attrs.length) {
            let key = this.skuProps.reduce((a, b) => a + '-' + b);
            let sku = this.skuList[key];
            if (sku) {
                this.setState({sku, disabled: false});
            }
        }
    }
}
