import React from 'react';
import {Modal, View, Image, Text, TouchableOpacity, Animated, TouchableWithoutFeedback} from 'react-native';
import {SafeFooter} from "./SafeView";

const ShareButton = ({style = {}, onPress = () => null, source, text}) => (
    <TouchableOpacity activeOpacity={1} onPress={onPress}>
        <View
            style={{
                alignItems: 'center',
                justifyContent: 'center',
                ...style
            }}
        >
            <Image
                source={source}
                style={{
                    width: 50,
                    height: 50,
                    borderRadius: 25
                }}
            />
            <Text
                style={{
                    fontSize: 14,
                    textAlign: 'center',
                    marginTop: 5,
                    color: '#333',
                }}
            >
                {text}
            </Text>
        </View>
    </TouchableOpacity>
);

const contentHeight = 150;

export default class ShareView extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            visible: false,
            bottom: new Animated.Value(-contentHeight)
        }
    }

    render() {
        const {style} = this.props;
        return (
            <Modal
                animationType="none"
                transparent={true}
                visible={this.state.visible}
            >
                <TouchableOpacity
                    activeOpacity={1}
                    onPress={this.hide}
                    style={{
                        flex: 1,
                        backgroundColor: 'rgba(0, 0, 0, 0.3)',
                        justifyContent: 'center',
                        alignItems: 'center',
                    }}
                >
                    <TouchableWithoutFeedback>
                        <Animated.View
                            style={{
                                backgroundColor: '#fff',
                                position: 'absolute',
                                left: 0,
                                right: 0,
                                bottom: this.state.bottom,
                                height: contentHeight,
                                ...style
                            }}
                        >
                            <View style={{flexDirection: 'row', paddingVertical: 15}}>
                                <View style={{flex: 1, flexDirection: 'row', justifyContent: 'center'}}>
                                    <ShareButton
                                        source={require('../images/share/weixin.png')}
                                        text={"微信好友"}
                                        onPress={() => {
                                            this.props.onPress && this.props.onPress('session');
                                        }}
                                    />
                                </View>
                                <View style={{flex: 1, flexDirection: 'row', justifyContent: 'center'}}>
                                    <ShareButton
                                        source={require('../images/share/pengyouquan.png')}
                                        text={"微信朋友圈"}
                                        onPress={() => {
                                            this.props.onPress && this.props.onPress('timeline');
                                        }}
                                    />
                                </View>
                            </View>
                            <SafeFooter/>
                        </Animated.View>
                    </TouchableWithoutFeedback>
                </TouchableOpacity>
            </Modal>
        );
    }

    show = () => {
        this.setState({visible: true}, () => {
            Animated.timing(this.state.bottom, {
                toValue: 0,
                duration: 200,
                useNativeDriver: false
            }).start();
        })
    }

    hide = () => {
        Animated.timing(this.state.bottom, {
            toValue: -contentHeight,
            duration: 150,
            useNativeDriver: false
        }).start(({finished}) => {
            if (finished) this.setState({visible: false});
        });
    }
}
