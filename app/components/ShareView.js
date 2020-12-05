import React from 'react';
import {Modal, View, Image, Text, TouchableOpacity, Animated, TouchableWithoutFeedback} from 'react-native';
import PropTypes from 'prop-types';
import * as WeChat from 'react-native-wechat';

const ShareButton = ({
                         style, onPress = () => {
    }, source, text
                     }) => (
    <TouchableOpacity activeOpacity={1} onPress={onPress}>
        <View
            style={{
                alignItems: 'center',
                justifyContent: 'center',
                padding: 10,
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

const contentHeight = 100;

export default class ShareView extends React.Component {
    static defaultProps = {
        show: false,
        shareMessage: {
            type: 'news',
            title: null,
            description: null,
            thumbImage: null,
            webpageUrl: null
        }
    };

    static propTypes = {
        show: PropTypes.bool,
        style: PropTypes.object,
        shareMessage: PropTypes.object
    };

    constructor(props) {
        super(props);
        this.state = {
            visible: props.show,
            bottom: new Animated.Value(-contentHeight)
        }
    }

    render() {
        const {style, shareMessage} = this.props;
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
                        backgroundColor: 'rgba(0, 0, 0, 0.3)',
                        flex: 1,
                        justifyContent: 'center',
                        padding: 20,
                        alignItems: 'center',
                    }}
                >
                    <TouchableWithoutFeedback>
                        <Animated.View
                            style={{
                                backgroundColor: '#fff',
                                flexDirection: 'row',
                                paddingVertical: 5,
                                position: 'absolute',
                                left: 0,
                                right: 0,
                                bottom: this.state.bottom,
                                ...style
                            }}
                        >
                            <View style={{flex: 1, flexDirection: 'row', justifyContent: 'center'}}>
                                <ShareButton
                                    source={require('../images/share/weixin.png')}
                                    text={"微信好友"}
                                    onPress={() => {
                                        try {
                                            WeChat.shareToSession(shareMessage);
                                        } catch (e) {
                                            if (e instanceof WeChat.WechatError) {
                                                console.error(e.stack);
                                            } else {
                                                throw e;
                                            }
                                        }
                                    }}
                                />
                            </View>
                            <View style={{flex: 1, flexDirection: 'row', justifyContent: 'center'}}>
                                <ShareButton
                                    source={require('../images/share/pengyouquan.png')}
                                    text={"微信朋友圈"}
                                    onPress={() => {
                                        try {
                                            WeChat.shareToTimeline(shareMessage);
                                        } catch (e) {
                                            if (e instanceof WeChat.WechatError) {
                                                console.error(e.stack);
                                            } else {
                                                throw e;
                                            }
                                        }
                                    }}
                                />
                            </View>
                        </Animated.View>
                    </TouchableWithoutFeedback>
                </TouchableOpacity>
            </Modal>
        );
    }

    UNSAFE_componentWillReceiveProps(nextProps: Readonly<P>, nextContext: any) {
        if (nextProps.show) {
            this.show();
        } else {
            this.hide();
        }
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
            duration: 200,
            useNativeDriver: false
        }).start(({finished}) => {
            if (finished) this.setState({visible: false});
        });
    }
}
