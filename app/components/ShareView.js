import React from 'react';
import {Modal,View,Image,Text,TouchableOpacity} from 'react-native';
import PropTypes from 'prop-types';
import * as WeChat from 'react-native-wechat';

const ShareButton = ({style,onPress=()=>{}, source, text}) => (
    <TouchableOpacity activeOpacity={1} onPress={onPress}>
        <View
            style={{
                alignItems:'center',
                justifyContent:'center',
                padding:10,
                ...style
            }}
        >
            <Image
                source={source}
                style={{
                    width:50,
                    height:50,
                    borderRadius:25
                }}
            />
            <Text
                style={{
                    fontSize:14,
                    textAlign:'center',
                    marginTop:5,
                    color:'#333',
                }}
            >
                {text}
            </Text>
        </View>
    </TouchableOpacity>
);

export default class ShareView extends React.Component{
    static defaultProps = {
        show : false,
        shareMessage : {
            type:'news',
            title:null,
            description:null,
            thumbImage:null,
            webpageUrl:null
        }
    };

    static propTypes = {
        show : PropTypes.bool,
        style : PropTypes.object,
        shareMessage : PropTypes.object
    };

    constructor(props) {
        super(props);
        this.state = {
            show : false
        }
    }

    render() {
        const {style,shareMessage} = this.props;
        return (
            <Modal animationType="none" transparent={true} visible={this.state.show} onRequestClose={()=>{}}>
                <TouchableOpacity
                    activeOpacity={1}
                    onPress={()=>this.setState({show:false})}
                    style={{
                        backgroundColor:'rgba(0, 0, 0, 0.3)',
                        flex:1,
                        justifyContent:'center',
                        padding:20,
                        alignItems:'center',
                    }}
                >
                    <View
                        style={{
                            backgroundColor:'#fff',
                            borderRadius:6,
                            padding:20,
                            flexDirection:'row',
                            flexWrap:'wrap',
                            maxWidth:300,
                            ...style
                        }}
                    >
                        <ShareButton
                            source={require('../images/share/weixin.png')}
                            text={"微信好友"}
                            onPress={()=>{
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
                        <ShareButton
                            source={require('../images/share/pengyouquan.png')}
                            text={"微信朋友圈"}
                            onPress={()=>{
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
                </TouchableOpacity>
            </Modal>
        );
    }
}
