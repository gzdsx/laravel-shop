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
            reasons: [],
            images: [],
            order: {},
            items: [],
            shipping: {},
            expresses: [],
            loading: true
        };
    }


    render(): React.ReactNode {
        let {refund, items, order, images, shipping, reasons, expresses, loading} = this.state;
        if (loading) return <LoadingView/>;

        const {refund_amount, refund_reason, receive_state, shipping_fee} = refund;
        const expressOptions = expresses.map((express) => express.name).concat(['取消']);
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
                            <TableCell.Detail text={receive_state ? (receive_state === 1 ? '已收到货品' : '未收到货品') : "请选择"}/>
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
                                            this.setState({refund_amount: text});
                                        }}
                                        onBlur={(e) => {
                                            //console.log(e.nativeEvent);
                                            let text = e.nativeEvent.text;
                                            let reg = /^[0-9]+(.[0-9]{1,2})?$/; //非负浮点数
                                            if (reg.test(text)) {
                                                let value = parseFloat(text);
                                                if (value > this.totalAmount || value < 0.01) {
                                                    value = this.totalAmount;
                                                } else {
                                                    value = value.toFixed(2);
                                                }
                                                this.setState({refund_amount: value});
                                            } else {
                                                this.setState({refund_amount: this.totalAmount});
                                            }
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
                                    this.setState({refund_desc: text});
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
                    {refund.refund_state === 3 && this.renderShipping()}
                </ScrollView>
                <View style={{backgroundColor: '#fff', paddingHorizontal: 15, paddingVertical: 7}}>
                    <Button
                        title={"提交"}
                        buttonStyle={[ButtonStyles.primary, {borderRadius: 20}]}
                        onPress={this.submit}
                    />
                </View>
                <ActionSheet
                    ref={'as1'}
                    options={['已收到货品', '未收到货品', '取消']}
                    cancelButtonIndex={2}
                    onPress={(index) => {
                        if (index < 2) {
                            this.setState({receive_state: index + 1});
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
                <ActionSheet
                    ref={'as3'}
                    options={expressOptions}
                    cancelButtonIndex={expresses.length}
                    onPress={(index) => {
                        if (index < expresses.length) {
                            let express = expresses[index];
                            shipping.express_name = express.name;
                            shipping.express_code = express.code;
                            this.setState({shipping});
                        }
                    }}
                />
                <Toast ref={'toast'}/>
                <Spinner ref={'spinner'}/>
            </KeyboardAvoidingView>
        );
    }

    componentDidMount(): void {
        this.setNavigationOptions();

        ApiClient.get('/refundreason/getall').then(response => {
            let reasons = response.data.items.map((item) => item.title);
            this.setState({reasons});
        });

        ApiClient.get('/express/getall').then(response => {
            let expresses = response.data.items;
            this.setState({expresses});
        });

        let {refund_id} = this.props.route.params;
        ApiClient.get('/refund/get', {refund_id}).then(response => {
            //console.log(response.data);
            let {refund} = response.data;
            let {order, items, images, shipping, refund_amount, shipping_fee} = refund;
            this.totalAmount = refund_amount;
            this.setState({
                refund,
                order,
                items,
                images,
                shipping: {...shipping},
                refund_amount,
                shipping_fee,
                loading: false
            });
        });
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
                        source={{uri: item.thumb ? item.thumb : item.uri}}
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
        let {refund, order, items, shipping} = this.state;
        let {refund_id, refund_reason, refund_amount, refund_desc, receive_state, shipping_fee} = refund;
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

        this.refs.spinner.show('正在上传数据...');
        this.uploadImages().then(images => {
            ApiClient.post('/refund/save', {
                refund_id,
                refund,
                images,
                shipping
            }).then(response => {
                //console.log(response);
                this.refs.spinner.hide();
                this.props.navigation.replace('RefundDetail', {refund_id});
            }).catch(reason => {
                this.refs.spinner.hide();
            });
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
                images.push(response.data.image);
            } else {
                images.push(file);
            }
        }

        return new Promise(resolve => {
            resolve(images);
        });
    }

    renderShipping = () => {
        let {shipping} = this.state;
        return (
            <TableView>
                <TableCell touchAble={false}>
                    <Text style={{fontSize: 16, fontWeight: '700', color: '#000'}}>退货物流</Text>
                </TableCell>
                <TableCell onPress={() => {
                    this.refs.as3.show();
                }}>
                    <TableCell.Title title={"快递名称"} titleStyle={{fontSize: 14}}/>
                    <TableCell.Detail text={shipping.express_name ? shipping.express_name : "请选择"}/>
                    <TableCell.Accessory/>
                </TableCell>
                <TextField
                    defaultValue={shipping.express_no}
                    inputStyle={{
                        width: '100%',
                        fontSize: 14,
                        textAlign: 'right'
                    }}
                    inputContainerStyle={{height: 40, width: 300}}
                    style={{borderBottomWidth: 0, width: 60, paddingHorizontal: 15}}
                    keyboardType={'numeric'}
                    onChangeText={text => {
                        shipping.express_no = text;
                        this.setState({shipping});
                    }}
                    numberOfLines={1}
                    multiline={false}
                    label={"快递单号"}
                    labelStyle={{fontSize: 14}}
                    placeholder={"请填写快递单号"}
                />
            </TableView>
        )
    }
}
