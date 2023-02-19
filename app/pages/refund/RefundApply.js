import React from 'react';
import {
    Image,
    ScrollView,
    StyleSheet,
    Text,
    TouchableOpacity,
    View
} from 'react-native';
import {LoadingView, Spinner, Toast} from "react-native-gzdsx-elements";
import FastImage from "react-native-fast-image";
import ActionSheet from "react-native-actionsheet";
import {launchImageLibrary, launchCamera} from 'react-native-image-picker';
import {Button, ListItem, Input} from "react-native-elements";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";
import {ButtonStyles} from "../../styles";
import {SafeFooter} from "../../components/SafeView";
import {KeyboardAwareScrollView} from "react-native-keyboard-aware-scroll-view";

export default class RefundApply extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '申请退款',
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            trade: {},
            items: [],
            images: [],
            reasons: [],
            loading: true,
            total_fee: 0,
            refund_amount: 0,
            refund_reason: '',
            refund_desc: '',
            goods_state: 0,
        };
    }

    componentDidMount(): void {
        this.setNavigationOptions();
        let {trade_id, refund_id} = this.props.route.params;
        if (refund_id) {
            ApiClient.get('/trade/refund.getInfo', {refund_id}).then(response => {
                let {refund, trade, order} = response.result;
                let {images, refund_amount, refund_reason, refund_desc, goods_state} = refund;
                let {total_fee} = trade;
                this.setState({
                    order,
                    trade,
                    images,
                    refund_amount,
                    refund_reason,
                    refund_desc,
                    goods_state,
                    total_fee,
                    loading: false
                });
            });
        } else {
            ApiClient.get('/trade/refund.getTradeDetail', {trade_id}).then(response => {
                let {order, trade} = response.result;
                this.setState({
                    order,
                    trade,
                    refund_amount: trade.total_fee,
                    total_fee: trade.total_fee,
                    loading: false
                });
            });
        }

        ApiClient.get('/trade/refund.getReasonList').then(response => {
            let reasons = response.result.items.map((item) => item.title).concat('取消');
            this.setState({reasons});
        });
    }

    render(): React.ReactNode {
        let {loading, order, images, reasons, refund_amount, refund_reason, refund_desc, goods_state, total_fee} = this.state;
        if (loading) return <LoadingView/>;
        return (
            <View style={{flex: 1}}>
                <ScrollView style={{flex: 1}}>
                    <KeyboardAwareScrollView>
                        <View style={styles.section}>
                            {this.renderGoods()}
                        </View>
                        <View style={styles.section}>
                            <ListItem>
                                <ListItem.Title style={styles.sectionHeader}>退款信息</ListItem.Title>
                            </ListItem>
                            <ListItem
                                onPress={() => this.as1.show()}
                            >
                                <ListItem.Content>
                                    <ListItem.Title style={styles.title}>货物状态</ListItem.Title>
                                </ListItem.Content>
                                <ListItem.Subtitle
                                    style={styles.subTitle}>{goods_state ? '已收到货' : '未收到货'}</ListItem.Subtitle>
                                <ListItem.Chevron/>
                            </ListItem>
                            <ListItem
                                onPress={() => this.as2.show()}
                            >
                                <ListItem.Content>
                                    <ListItem.Title style={styles.title}>退款原因</ListItem.Title>
                                </ListItem.Content>
                                <ListItem.Subtitle
                                    style={styles.subTitle}>{refund_reason ? refund_reason : "请选择"}</ListItem.Subtitle>
                                <ListItem.Chevron/>
                            </ListItem>
                            <ListItem>
                                <ListItem.Content>
                                    <ListItem.Title style={styles.title}>退款金额</ListItem.Title>
                                </ListItem.Content>
                                <ListItem.Input
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
                                        let value = e.nativeEvent.text;
                                        let reg = /^[0-9]+(.[0-9]{1,2})?$/; //非负浮点数
                                        if (reg.test(value)) {
                                            value = parseFloat(value);
                                            if (value > total_fee || value < 0.01) {
                                                value = total_fee;
                                            } else {
                                                value = value.toFixed(2);
                                            }
                                        } else {
                                            value = total_fee;
                                        }
                                        this.setState({refund_amount: value});
                                    }}
                                    numberOfLines={1}
                                    multiline={false}
                                />
                            </ListItem>
                            <ListItem>
                                <Text style={{
                                    fontSize: 12,
                                    color: '#838383'
                                }}>{"可修改，最多￥" + refund_amount + '，含发货邮费￥' + order.shipping_fee}</Text>
                            </ListItem>
                        </View>

                        <View style={styles.section}>
                            <ListItem>
                                <ListItem.Title style={styles.sectionHeader}>补充描述和凭证</ListItem.Title>
                            </ListItem>
                            <ListItem>
                                <Input
                                    placeholder={"补充描述，有助于商家更好的处理售后问题"}
                                    multiline={true}
                                    onChangeText={text => {
                                        this.setState({refund_desc: text});
                                    }}
                                    containerStyle={{
                                        paddingHorizontal: 0,
                                        paddingVertical: 0
                                    }}
                                    inputContainerStyle={{
                                        borderBottomColor: '#e5e5e5'
                                    }}
                                    inputStyle={{
                                        fontSize: 16,
                                        height: 120,
                                        textAlignVertical: 'top',
                                    }}
                                    renderErrorMessage={false}
                                    defaultValue={refund_desc}
                                />
                            </ListItem>
                            <ListItem>
                                {this.renderImages()}
                                {
                                    images.length < 3 ?
                                        <TouchableOpacity
                                            activeOpacity={1}
                                            style={{width: 80, height: 80}}
                                            onPress={() => this.as3.show()}
                                        >
                                            <Image
                                                source={require('../../images/icon/si-glyph-square-dashed.png')}
                                                style={{
                                                    width: 80,
                                                    height: 80,
                                                    tintColor: '#ccc',
                                                    resizeMode: 'stretch',
                                                }}
                                            />
                                            <View style={{
                                                position: 'absolute',
                                                alignItems: 'center',
                                                justifyContent: 'center',
                                                padding: 10
                                            }}>
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
                                            </View>
                                        </TouchableOpacity>
                                        : null
                                }
                            </ListItem>
                        </View>
                    </KeyboardAwareScrollView>
                </ScrollView>
                <View style={{backgroundColor: '#fff', paddingHorizontal: 15, paddingVertical: 7}}>
                    <Button
                        title={"提交"}
                        buttonStyle={ButtonStyles.primary}
                        onPress={this.submit}/>
                    <SafeFooter/>
                </View>
                <ActionSheet
                    ref={o => this.as1 = o}
                    options={['未收到货', '已收到货', '取消']}
                    cancelButtonIndex={2}
                    onPress={(index) => {
                        if (index < 2) {
                            this.setState({goods_state: index});
                        }
                    }}
                />
                <ActionSheet
                    ref={o => this.as2 = o}
                    options={reasons}
                    cancelButtonIndex={reasons.length - 1}
                    onPress={(index) => {
                        if (index < reasons.length) {
                            refund_reason = reasons[index];
                            this.setState({refund_reason});
                        }
                    }}
                />
                <ActionSheet
                    ref={o => this.as3 = o}
                    options={['拍照', '从相册选择', '取消']}
                    cancelButtonIndex={2}
                    onPress={(index) => {
                        if (index === 0) {
                            this._launchCamera();
                        }

                        if (index === 1) {
                            this._lauchImageLibrary();
                        }
                    }}
                />
            </View>
        );
    }

    renderGoods = () => {
        let {trade} = this.state;
        return (
            <ListItem>
                <FastImage
                    source={{uri: trade.image}}
                    style={{
                        width: 80,
                        height: 80,
                        borderRadius: 3,
                        marginRight: 10
                    }}/>
                <ListItem.Content>
                    <Text style={{fontSize: 14, color: '#333'}}>{trade.title}</Text>
                    <View style={{flex: 1}}>
                        <Text style={{fontSize: 12, color: '#777'}}>{trade.sku_title}</Text>
                    </View>
                    <View style={{flexDirection: 'row'}}>
                        <Text style={{fontSize: 14, color: '#333', flex: 1}}>￥{trade.price}</Text>
                        <Text style={{fontSize: 14, color: '#333'}}>x{trade.quantity}</Text>
                    </View>
                </ListItem.Content>
            </ListItem>
        )
    }

    renderImages = () => {
        let {images} = this.state;
        return images.map((item, index) => (
            <View key={index.toString()} style={{
                width: 80,
                height: 80,
                justifyContent: 'center',
                alignItems: 'center'
            }}>
                <FastImage
                    source={{uri: item.uri ? item.uri : item.thumb}}
                    style={{
                        width: 80,
                        height: 80,
                        resizeMode: 'cover'
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
        ));
    }

    _launchCamera = () => {
        let {images} = this.state;
        launchCamera({
            saveToPhotos: true,
            cameraType: 'back'
        }, response => {
            //console.log(response);
            if (response.errorCode || response.didCancel) {
                return false;
            }

            for (let file of response.assets) {
                if (images.length < 3) {
                    images = images.concat(file);
                    this.setState({images});
                }
            }
        })
    }

    _lauchImageLibrary = () => {
        let {images} = this.state;
        launchImageLibrary({
            maxWidth: 1000,
            maxHeight: 1000,
            mediaType: 'photo',
            quality: 0.8,
            selectionLimit: 3 - images.length
        }, response => {
            if (response.errorCode || response.didCancel) {
                return false;
            }

            for (let file of response.assets) {
                if (images.length < 3) {
                    images = images.concat(file);
                    this.setState({images});
                }
            }
        });
    }

    uploadImages = async () => {
        let images = [];
        for (let file of this.state.images) {
            if (file.uri) {
                let response = await ApiClient.upload('/common/material.upload?type=image', {
                    uri: file.uri,
                    name: file.fileName || file.uri.substring(file.uri.lastIndexOf('/'))
                });
                images.push(response.result);
            } else {
                images.push(file);
            }
        }

        return new Promise(resolve => {
            resolve(images);
        });
    }

    submit = async () => {
        let {refund_type, trade_id, refund_id} = this.props.route.params;
        let {images, total_fee, shipping_fee, refund_desc, refund_reason, refund_amount, goods_state} = this.state;
        if (!refund_reason) {
            Toast.fail('请选择退货理由');
            return false;
        }

        if (refund_amount > total_fee) {
            Toast.fail('退款金额不能大于+' + total_fee);
            return false;
        }

        if (refund_amount < 0.01) {
            Toast.fail('退款金额不能小于0.01');
            return false;
        }

        Spinner.show('正在上传数据...');
        this.uploadImages().then(images => {
            let data = {};
            if (refund_id) {
                ApiClient.post('/trade/refund.update', {
                    refund_id,
                    refund_reason,
                    refund_amount,
                    refund_desc,
                    goods_state,
                    images
                }).then(response => {
                    Spinner.hide();
                    this.props.navigation.replace('refund-detail', {refund_id});
                }).catch(reason => {
                    console.log(reason);
                    Spinner.hide();
                });
            } else {
                ApiClient.post('/trade/refund.create', {
                    trade_id,
                    refund_amount,
                    refund_reason,
                    refund_type,
                    refund_desc,
                    goods_state
                }).then(response => {
                    //console.log(response);
                    Spinner.hide();
                    const {refund_id} = response.result;
                    this.props.navigation.replace('refund-detail', {refund_id});
                }).catch(reason => {
                    super.hide();
                });
            }
        });
    }
}


const styles = StyleSheet.create({
    section: {
        marginBottom: 10
    },
    sectionHeader: {
        fontSize: 18,
        fontWeight: '600'
    },
    title: {
        fontSize: 16
    },
    subTitle: {
        fontSize: 14
    }
})
