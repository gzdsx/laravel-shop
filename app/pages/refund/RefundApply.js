import React from 'react';
import {Image, ImageBackground, KeyboardAvoidingView, ScrollView, Text, TouchableOpacity, View} from 'react-native';
import {LoadingView, Spinner, TableCell, TableView, TextField, Toast} from "react-native-gzdsx-elements";
import {CacheImage} from "react-native-gzdsx-cache-image";
import ActionSheet from "react-native-actionsheet";
import ImagePicker from 'react-native-image-picker';
import {Button} from "react-native-elements";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";
import {ButtonStyles} from "../../styles/ButtonStyles";
import {isAndroid} from "../../base/constants";

export default class RefundApply extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '申请退款',
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            refund: {},
            order: {},
            items: [],
            images: [],
            reasons: [],
            loading: true
        };
    }

    componentDidMount(): void {
        this.setNavigationOptions();
        let {items, order_id, refund_id} = this.props.route.params;
        let data = {};
        if (refund_id) {
            data = {refund_id};
        } else {
            data = {
                order_id,
                suborders: items.map((item) => item.sub_order_id)
            };
        }
        ApiClient.post('/refund/apply', data).then(response => {
            //console.log(response.result);
            let {refund} = response.result;
            let {order, items, images} = refund;
            this.totalAmount = refund.refund_amount;
            this.setState({
                refund,
                order,
                items,
                images,
                loading: false
            });
        });

        ApiClient.get('/refundreason/getall').then(response => {
            let reasons = response.result.items.map((item) => item.title);
            this.setState({reasons});
        });
    }

    render(): React.ReactNode {
        const {loading, refund, images, reasons} = this.state;
        const {refund_amount, refund_reason, receive_state, shipping_fee} = refund;
        if (loading) return <LoadingView/>;
        return (
            <KeyboardAvoidingView style={{flex: 1}} behavior={isAndroid ? "height" : "padding"}>
                <ScrollView style={{flex: 1}}>
                    <TableView>
                        {this.renderItems()}
                    </TableView>
                    <TableView>
                        <TableCell touchAble={false}>
                            <Text style={{fontSize: 16, fontWeight: '700', color: '#000'}}>退款信息</Text>
                        </TableCell>
                        <TableCell onPress={() => {
                            this.refs.as1.show();
                        }}>
                            <TableCell.Title title={"货物状态"} titleStyle={{fontSize: 14}}/>
                            <TableCell.Detail text={receive_state ? (receive_state === 1 ? '已收到货' : '未收到货') : "请选择"}/>
                            <TableCell.Accessory/>
                        </TableCell>
                        <TableCell onPress={() => {
                            this.refs.as2.show();
                        }}>
                            <TableCell.Title title={"退款原因"} titleStyle={{fontSize: 14}}/>
                            <TableCell.Detail text={refund_reason ? refund_reason : "请选择"}/>
                            <TableCell.Accessory/>
                        </TableCell>
                        <TableCell touchAble={false}>
                            <TableCell.Content>
                                <View style={{flexDirection: 'row'}}>
                                    <View style={{alignContent: 'center', justifyContent: 'center', flex: 1}}>
                                        <Text style={{fontSize: 14, color: '#000'}}>退款金额</Text>
                                    </View>
                                    <TextField
                                        defaultValue={refund_amount.toString()}
                                        inputStyle={{
                                            color: '#f40',
                                            fontWeight: '700',
                                            textAlign: 'right'
                                        }}
                                        style={{borderBottomWidth: 0, width: 80, paddingVertical: 0}}
                                        keyboardType={'numeric'}
                                        onChangeText={text => {
                                            refund.refund_amount = text;
                                            this.setState({refund});
                                        }}
                                        onBlur={(e) => {
                                            //console.log(e.nativeEvent);
                                            let value = e.nativeEvent.text;
                                            let reg = /^[0-9]+(.[0-9]{1,2})?$/; //非负浮点数
                                            if (reg.test(value)) {
                                                value = parseFloat(value);
                                                if (value > this.totalAmount || value < 0.01) {
                                                    value = this.totalAmount;
                                                } else {
                                                    value = value.toFixed(2);
                                                }
                                            } else {
                                                value = this.totalAmount;
                                            }
                                            refund.refund_amount = value;
                                            this.setState({refund});
                                        }}
                                        numberOfLines={1}
                                        multiline={false}
                                    />
                                </View>
                                <TableCell.SubTitle
                                    title={"可修改，最多" + refund_amount + '，含发货邮费￥' + shipping_fee}
                                    style={{marginTop: 10}}
                                    titleStyle={{color: '#999', fontSize: 12}}/>
                            </TableCell.Content>
                        </TableCell>
                    </TableView>
                    <TableView>
                        <TableCell touchAble={false}>
                            <Text style={{fontSize: 16, fontWeight: '700', color: '#000'}}>补充描述和凭证</Text>
                        </TableCell>
                        <TableCell touchAble={false} style={{borderBottomWidth: 0}}>
                            <TextField
                                placeholder={"补充描述，有助于商家更好的处理售后问题"}
                                multiline={true}
                                inputStyle={{textAlignVertical: 'top', height: 50, fontSize: 14}}
                                style={{borderBottomWidth: 0, backgroundColor: '#fefefe'}}
                                onChangeText={text => {
                                    refund.refund_desc = text;
                                    this.setState({refund});
                                }}
                            />
                        </TableCell>
                        <TableCell touchAble={false} style={{borderBottomWidth: 0}}>
                            {this.renderImages()}
                            {
                                images.length < 3 ?
                                    <TouchableOpacity
                                        activeOpacity={1}
                                        style={{width: 80, height: 80}}
                                        onPress={this.pickImage}
                                    >
                                        <ImageBackground
                                            source={require('../../images/icon/si-glyph-square-dashed.png')}
                                            style={{
                                                width: 80,
                                                height: 80,
                                                justifyContent: 'center',
                                                alignItems: 'center',
                                                paddingHorizontal: 10
                                            }}
                                            imageStyle={{tintColor: '#ccc'}}
                                        >
                                            <Image
                                                source={require('../../images/icon/camera.png')}
                                                style={{
                                                    width: 30,
                                                    height: 30,
                                                    tintColor: '#ccc',
                                                }}
                                            />
                                            <Text
                                                style={{
                                                    fontSize: 10,
                                                    color: '#aaa',
                                                    textAlign: 'center'
                                                }}>上传凭证,最多3张</Text>
                                        </ImageBackground>
                                    </TouchableOpacity>
                                    : null
                            }
                        </TableCell>
                    </TableView>
                </ScrollView>
                <View style={{backgroundColor: '#fff', paddingHorizontal: 15, paddingVertical: 7}}>
                    <Button title={"提交"} buttonStyle={[ButtonStyles.primary, {borderRadius: 20}]}
                            onPress={this.submit}/>
                </View>
                <ActionSheet
                    ref={'as1'}
                    options={['已收到货', '未收到货', '取消']}
                    cancelButtonIndex={2}
                    onPress={(index) => {
                        if (index < 2) {
                            refund.receive_state = index + 1;
                            this.setState({refund});
                        }
                    }}
                />
                <ActionSheet
                    ref={'as2'}
                    options={reasons.concat(['取消'])}
                    cancelButtonIndex={reasons.length}
                    onPress={(index) => {
                        if (index < reasons.length) {
                            refund.refund_reason = reasons[index];
                            this.setState({refund});
                        }
                    }}
                />
                <Toast ref={'toast'}/>
                <Spinner ref={'spinner'}/>
            </KeyboardAvoidingView>
        );
    }

    renderItems = () => {
        let {items} = this.state;
        let contents = items.map((item, index) => {
            return (
                <View style={{
                    padding: 15,
                    flexDirection: 'row'
                }} key={index.toString()}>
                    <CacheImage source={{uri: item.thumb}} style={{
                        width: 80,
                        height: 80,
                        borderRadius: 3,
                        marginRight: 10
                    }}/>
                    <View style={{flex: 1, flexDirection: 'column'}}>
                        <Text style={{fontSize: 14, color: '#333'}}>{item.title}</Text>
                        <View style={{flex: 1}}>
                            <Text style={{fontSize: 12, color: '#777'}}>{item.sku_title}</Text>
                        </View>
                        <View style={{flexDirection: 'row'}}>
                            <Text style={{fontSize: 14, color: '#333', flex: 1}}>￥{item.price}</Text>
                            <Text style={{fontSize: 14, color: '#333'}}>x{item.quantity}</Text>
                        </View>
                    </View>
                </View>
            );
        })

        return <View>{contents}</View>;
    }

    renderImages = () => {
        let {images} = this.state;
        let contents = images.map((item, index) => {
            return (
                <View key={index.toString()} style={{
                    width: 80,
                    height: 80,
                    justifyContent: 'center',
                    alignItems: 'center',
                    marginRight: 15
                }}>
                    <Image
                        source={{uri: item.uri ? item.uri : item.thumb}}
                        style={{
                            width: 80,
                            height: 80,
                        }}
                    />
                    <TouchableOpacity
                        activeOpacity={1}
                        style={{
                            position: 'absolute',
                            top: -8,
                            right: -8
                        }}
                        onPress={() => {
                            images.splice(index, 1);
                            this.setState({images});
                        }}
                    >
                        <Image source={require('../../images/icon/close_round.png')} style={{width: 20, height: 20}}/>
                    </TouchableOpacity>
                </View>
            )
        });
        return <View style={{flexDirection: 'row'}}>{contents}</View>;
    }

    pickImage = () => {
        ImagePicker.showImagePicker({
            title: '选择照片来源',
            cancelButtonTitle: '取消',
            takePhotoButtonTitle: '拍照',
            chooseFromLibraryButtonTitle: '相册',
            maxWidth: 2000,
            mediaType: 'photo'
        }, res => {
            //console.log(res);
            if (res.uri) {
                this.state.images.push(res);
                this.setState({images: this.state.images});
            }
        });
    }

    submit = async () => {
        let {refund_type} = this.props.route.params;
        let {refund, images, items} = this.state;
        let {refund_id, order_id, refund_reason, refund_amount, receive_state, shipping_fee} = refund;
        if (!receive_state) {
            this.refs.toast.show('请选择货物状态');
            return false;
        }

        if (!refund_reason) {
            this.refs.toast.show('请选择退货理由');
            return false;
        }

        if (refund_amount > this.totalAmount) {
            this.refs.toast.show('退款金额不能大于+' + this.totalAmount);
            return false;
        }

        if (refund_amount < 0.01) {
            this.refs.toast.show('退款金额不能小于0.01');
            return false;
        }

        refund.refund_type = refund_type;
        this.refs.spinner.show('正在上传数据...');
        this.uploadImages().then(images => {
            let data = {};
            if (refund_id) {
                data = {
                    refund_id,
                    refund,
                    images
                };
                ApiClient.post('/refund/save', data).then(response => {
                    //console.log(response);
                    this.refs.spinner.hide();
                    this.props.navigation.replace('RefundDetail', {refund_id});
                }).catch(reason => {
                    this.refs.spinner.hide();
                });
            } else {
                data = {
                    refund,
                    order_id,
                    images,
                    suborders: items.map((item) => item.sub_order_id)
                }
                ApiClient.post('/refund/create', data).then(response => {
                    //console.log(response);
                    this.refs.spinner.hide();
                    const {refund_id} = response.result.refund;
                    this.props.navigation.replace('RefundDetail', {refund_id});
                }).catch(reason => {
                    this.refs.spinner.hide();
                });
            }
        });
    }

    uploadImages = async () => {
        let images = [];
        for (let file of this.state.images) {
            if (file.uri) {
                let response = await ApiClient.upload('/material/uploadimg', {
                    uri: file.uri,
                    name: file.fileName || file.uri.substring(file.uri.lastIndexOf('/'))
                });
                images.push(response.result.image);
            } else {
                images.push(file);
            }
        }

        return new Promise(resolve => {
            resolve(images);
        });
    }
}
