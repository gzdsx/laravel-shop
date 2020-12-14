import React from 'react';
import {Image, StyleSheet, Text, TouchableOpacity, View} from 'react-native';
import PropTypes from "prop-types";
import LinearGradient from "react-native-linear-gradient";

const ActionButton = ({text, iconSource, onPress = () => null}) => {
    const styles = {
        iconBox: {
            flex: 1,
            alignContent: 'center',
            alignItems: 'center',
            flexDirection: 'column',
            paddingTop: 5
        },
        iconTitle: {
            fontSize: 12,
            color: '#666',
            textAlign: 'center',
            marginTop: 3
        },
    };

    return (
        <TouchableOpacity activeOpacity={1} onPress={onPress} style={styles.iconBox}>
            <Image style={{
                tintColor: "#666",
                width: 22,
                height: 22,
                resizeMode: 'contain'
            }} source={iconSource}/>
            <Text style={styles.iconTitle}>{text}</Text>
        </TouchableOpacity>
    );
}

export default class GoodsActionBar extends React.Component {

    static propTypes = {
        onPressAddCart: PropTypes.func,
        onPressBuyNow: PropTypes.func,
        onViewShop: PropTypes.func,
        onAddCollection: PropTypes.func,
        onConnectKefu: PropTypes.func
    };
    static defaultProps = {
        onPressAddCart: () => null,
        onPressBuyNow: () => null,
        onViewShop: () => null,
        onAddCollection: () => null,
        onConnectKefu: () => null
    };

    render() {
        return (
            <View style={styles.bar}>
                <View style={styles.icons}>
                    <ActionButton
                        iconSource={require('../../../images/icon/star2.png')}
                        text={"收藏"}
                        onPress={this.props.onAddCollection}
                    />
                    <ActionButton
                        iconSource={require('../../../images/icon/kefu.png')}
                        text={"客服"}
                        onPress={this.props.onConnectKefu}
                    />
                </View>
                <View style={styles.buttons}>
                    <LinearGradient
                        colors={['#ffd01e', '#ff8917']}
                        start={{x: 0, y: 0}}
                        end={{x: 1, y: 0}}
                        style={[styles.linearGradient, {
                            borderTopLeftRadius: 20,
                            borderBottomLeftRadius: 20,
                        }]}
                    >
                        <TouchableOpacity
                            activeOpacity={1}
                            onPress={this.props.onPressAddCart}
                        >
                            <Text style={styles.buttonText}>加入购物车</Text>
                        </TouchableOpacity>
                    </LinearGradient>
                    <LinearGradient
                        colors={['#ff6034', '#ee0a24']}
                        start={{x: 0, y: 0}}
                        end={{x: 1, y: 0}}
                        style={[styles.linearGradient, {
                            borderTopRightRadius: 20,
                            borderBottomRightRadius: 20,
                        }]}
                    >
                        <TouchableOpacity
                            activeOpacity={1}
                            onPress={this.props.onPressBuyNow}
                        >
                            <Text style={styles.buttonText}>立即购买</Text>
                        </TouchableOpacity>
                    </LinearGradient>
                </View>
            </View>
        );
    }
}

const styles = StyleSheet.create({
    bar: {
        height: 50,
        backgroundColor: '#fff',
        borderTopWidth: 0.5,
        borderTopColor: '#e5e5e5',
        flexDirection: 'row',
    },
    icons: {
        flexDirection: 'row',
        height: 50,
        paddingLeft: 5,
        paddingRight: 5,
        flex: 1
    },
    buttons: {
        flex: 2,
        flexDirection: 'row',
        paddingRight: 5
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
        flexDirection: 'row'
    }
});
