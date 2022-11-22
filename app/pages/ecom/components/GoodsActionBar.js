import React from 'react';
import {StyleSheet, Text, TouchableOpacity, View, Linking} from 'react-native';
import PropTypes from "prop-types";
import LinearGradient from "react-native-linear-gradient";
import Icon from "react-native-vector-icons/AntDesign";
import ImageIcon from "../../../components/ImageIcon";
import {ApiClient} from "../../../utils";
import {Toast} from "react-native-gzdsx-elements";
import {SafeFooter} from "../../../components/SafeView";
import {Colors} from "../../../styles";

export default class GoodsActionBar extends React.Component {

    static propTypes = {
        onPressAddCart: PropTypes.func,
        onPressBuyNow: PropTypes.func,
    };

    static defaultProps = {
        onPressAddCart: () => null,
        onPressBuyNow: () => null,
    };

    constructor() {
        super();
        this.state = {
            subscribe: false
        }
    }

    querySubscribe = () => {
        let itemid = this.props.product;
        ApiClient.post('/ecom/product.subscribe.query', {itemid}).then(response => {
            //console.log(response.result);
            let {subscribe} = response.result;
            this.setState({subscribe});
        }).catch(reason => {
            console.log(reason);
        });
    }

    toggleSubscribe = () => {
        let {itemid} = this.props.product;
        ApiClient.post('/ecom/product.subscribe.toggle', {itemid}).then(response => {
            //console.log(response);
            if (response.result.attached.length) {
                Toast.success('添加收藏成功');
                this.setState({subscribe: true});
            } else {
                Toast.success('取消收藏成功');
                this.setState({subscribe: false});
            }
        }).catch(reason => {
            Toast.fail(reason.errMsg);
        });
    }

    componentDidMount() {
        this.querySubscribe();
    }

    render() {
        let {product, navigation} = this.props;
        let name = this.state.subscribe ? 'star' : 'staro';
        let color = this.state.subscribe ? Colors.primary : '#666';
        return (
            <View style={styles.container}>
                <View style={styles.bar}>
                    <View style={styles.icons}>
                        <TouchableOpacity
                            activeOpacity={1}
                            style={styles.actionTouch}
                            onPress={() => {
                                navigation && navigation.navigate('shop-detail', {shop_id: product.shop_id});
                            }}
                        >
                            <ImageIcon
                                source={require('../../../images/icon/shop.png')}
                                size={23}
                                color={"#666"}
                            />
                            <Text style={styles.actionText}>店铺</Text>
                        </TouchableOpacity>
                        <TouchableOpacity
                            activeOpacity={1}
                            style={styles.actionTouch}
                            onPress={this.toggleSubscribe}
                        >
                            <Icon name={name} size={23} color={color}/>
                            <Text style={styles.actionText}>收藏</Text>
                        </TouchableOpacity>
                        <TouchableOpacity
                            activeOpacity={1}
                            style={styles.actionTouch}
                            onPress={() => {
                                Linking.openURL('tel:18685849696');
                            }}
                        >
                            <Icon name={"message1"} size={20} color={"#666"}/>
                            <Text style={styles.actionText}>客服</Text>
                        </TouchableOpacity>
                    </View>
                    <View style={styles.buttons}>
                        <TouchableOpacity
                            activeOpacity={1}
                            onPress={this.props.onPressAddCart}
                            style={styles.button}
                        >
                            <LinearGradient
                                colors={['#ffd01e', '#ff8917']}
                                start={{x: 0, y: 0}}
                                end={{x: 1, y: 0}}
                                style={[styles.linearGradient, {
                                    borderTopLeftRadius: 20,
                                    borderBottomLeftRadius: 20,
                                }]}
                            >
                                <Text style={styles.buttonText}>加入购物车</Text>
                            </LinearGradient>
                        </TouchableOpacity>
                        <TouchableOpacity
                            activeOpacity={1}
                            onPress={this.props.onPressBuyNow}
                            style={styles.button}
                        >
                            <LinearGradient
                                colors={['#ff6034', '#ee0a24']}
                                start={{x: 0, y: 0}}
                                end={{x: 1, y: 0}}
                                style={[styles.linearGradient, {
                                    borderTopRightRadius: 20,
                                    borderBottomRightRadius: 20,
                                }]}
                            >
                                <Text style={styles.buttonText}>立即购买</Text>
                            </LinearGradient>
                        </TouchableOpacity>
                    </View>
                </View>
                <SafeFooter/>
            </View>
        );
    }
}

const styles = StyleSheet.create({
    container: {
        backgroundColor: '#fff',
        borderTopWidth: 0.5,
        borderTopColor: '#e5e5e5',
    },
    bar: {
        height: 50,
        flexDirection: 'row',
    },
    icons: {
        flex: 1,
        flexDirection: 'row',
        paddingHorizontal: 5
    },
    buttons: {
        flexDirection: 'row',
        paddingRight: 5,
        flex: 2
    },
    button: {
        flex: 1,
        flexDirection: 'row'
    },
    buttonText: {
        fontSize: 14,
        color: '#fff',
        textAlignVertical: 'center',
        fontWeight: '500',
    },
    linearGradient: {
        alignItems: 'center',
        justifyContent: 'center',
        alignSelf: 'center',
        height: 40,
        borderWidth: 0,
        backgroundColor: '#000',
        padding: 0,
        margin: 0,
        flex: 1,
    },
    actionTouch: {
        alignItems: 'center',
        justifyContent: 'center',
        flex: 1
    },
    actionText: {
        fontSize: 12,
        color: '#666',
        textAlign: 'center',
        marginTop: 2
    }
});
