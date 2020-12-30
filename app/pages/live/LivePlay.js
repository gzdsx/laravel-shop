import React from 'react';
import {connect} from 'react-redux';
import {
    TouchableOpacity,
    View,
    Text,
    FlatList,
    KeyboardAvoidingView,
    NativeModules
} from 'react-native';
import {LoadingView, Ticon, TextField} from "react-native-gzdsx-elements";
import {NodePlayerView} from 'react-native-nodemediaclient';
import {Header} from 'react-native-elements';
import {ApiClient} from "../../utils";
import {Size, Styles} from "../../styles";

class LivePlay extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            live: {},
            messages: [],
            isLoading: true,
            showKeyBoard: false
        };

        this.messageID = 0;
        this.scrollView = null;
        this.vp = null;
    }

    render(): React.ReactNode {
        const {width, height} = Size.screenSize;
        const {live, isLoading} = this.state;
        const {navigation} = this.props;
        if (isLoading) return <LoadingView/>;

        return (
            <View style={{flex: 1, backgroundColor: '#fff'}}>
                <NodePlayerView
                    style={{width, height: width * 0.8, backgroundColor: '#000'}}
                    inputUrl={"rtmp://shop.gzdsx.cn/hls/" + live.stream_id}
                    scaleMode={"ScaleAspectFit"}
                    bufferTime={0}
                    maxBufferTime={0}
                    autoplay={true}
                    ref={vp => {
                        this.vp = vp;
                    }}
                    onStatus={(code, msg) => {
                        console.log(code + ':' + msg);
                    }}
                />
                <Text style={{padding: 15, fontSize: 14, color: '#333'}}>{live.title}</Text>
                {this.renderChats()}
                {this.renderBottom()}
                {this.renderKeyBoard()}
                <Header
                    leftComponent={
                        <TouchableOpacity
                            activeOpacity={1}
                            onPress={() => navigation.goBack()}
                            style={Styles.headerLeft}
                        >
                            <View style={{
                                backgroundColor: '#666',
                                borderRadius: 15,
                                width: 30,
                                height: 30,
                                alignItems: 'center',
                                justifyContent: 'center',
                                opacity: 0.6
                            }}>
                                <Ticon
                                    name={'back-light'}
                                    size={20}
                                    color={'#fff'}
                                />
                            </View>
                        </TouchableOpacity>
                    }
                    backgroundColor={"transparent"}
                    containerStyle={{
                        position: 'absolute',
                        left: 0,
                        top: NativeModules.StatusBarManager.HEIGHT,
                        borderBottomWidth: 0,
                    }}
                />
            </View>
        )
    }

    componentDidMount(): void {
        const {navigation, route,auth} = this.props;
        navigation.setOptions({
            headerShown: false
        });

        this.props.navigation.addListener('beforeRemove', () => {
            this.vp.stop();
        });

        if (!auth.isSignined){
            navigation.navigate('Signin');
        }

        const id = route.params?.id || 0;
        ApiClient.get('/live/get', {id}).then(response => {
            const live = response.data.live;
            this.setState({
                live,
                isLoading: false
            });
            //console.log(live);
        });
        this.initWebsocket();
    }

    componentWillUnmount() {
        this.props.navigation.removeListener('beforeRemove');
    }

    renderChats = () => {
        const {auth} = this.props;
        return (
            <FlatList
                keyExtractor={(item, index) => index.toString()}
                data={this.state.messages}
                renderItem={({item, index}) => {
                    return (
                        <Text>
                            <Text style={{color: '#17BFD7', fontSize: 14}}>{item.username}:</Text>
                            <Text style={{color: '#333', fontSize: 14}}>{item.message}</Text>
                        </Text>
                    )
                }}
                style={{flex:1}}
                ref={ref => {
                    this.scrollView = ref;
                }}
                contentInset={{top: 0, bottom: 30, left: 0, right: 0}}
                alwaysBounceHorizontal={false}
                contentContainerStyle={{
                    paddingLeft: 15,
                    paddingRight: 15
                }}
                showsHorizontalScrollIndicator={false}
                showsVerticalScrollIndicator={false}
            />
        );
    };

    renderBottom = () => {
        const {navigation} = this.props;
        return (
            <View style={{flexDirection: 'row', paddingHorizontal: 15, paddingVertical: 10}}>
                <TouchableOpacity
                    activeOpacity={1}
                    style={{
                        backgroundColor: 'rgba(0,0,0,0.3)',
                        height: 40,
                        borderRadius: 20,
                        flex: 1,
                        paddingLeft: 20,
                        justifyContent: 'center',
                        marginRight: 10
                    }}
                    onPress={() => {
                        this.setState({
                            showKeyBoard: true
                        });
                    }}
                >
                    <Text style={{fontSize: 16, color: '#fff'}}>说点什么吧...</Text>
                </TouchableOpacity>
                <TouchableOpacity
                    activeOpacity={1}
                    style={{
                        width: 40,
                        height: 40,
                        borderRadius: 20,
                        backgroundColor: 'rgba(0,0,0,0.3)',
                        justifyContent: 'center',
                        alignItems: 'center'
                    }}
                    onPress={() => {
                        navigation.goBack();
                    }}
                >
                    <Ticon
                        name={"close-light"}
                        size={20}
                        color={"#fff"}
                    />
                </TouchableOpacity>
            </View>
        )
    };

    renderKeyBoard = () => {
        return (
            <KeyboardAvoidingView
                behavior={"position"}
                style={{
                    position: 'absolute',
                    bottom: 0,
                    left: 0,
                    right: 0
                }}
            >
                {
                    this.state.showKeyBoard ?
                        <View style={{
                            paddingLeft: 10,
                            paddingRight: 10,
                            paddingTop: 5,
                            paddingBottom: 5,
                            backgroundColor: '#fff'
                        }}>
                            <TextField
                                style={{
                                    flex: 1,
                                    height: 40,
                                    fontSize: 16
                                }}

                                placeholder={""}
                                autoFocus={true}
                                onSubmitEditing={(event) => {
                                    if (event.nativeEvent.text) {
                                        this.sendMessage(event.nativeEvent.text);
                                    }
                                    this.setState({showKeyBoard: false});
                                }}
                            />
                        </View>
                        : null
                }
            </KeyboardAvoidingView>
        )
    }

    initWebsocket = () => {
        var _this = this;
        var tid = this.props.route.params?.id;
        var {uid, username} = this.props.auth.userinfo;
        var url = `ws://47.108.50.187:30001/vfrom=wx&tid=${tid}&uid=${uid}&username=${username}`;
        var websocket = new WebSocket(url);
        websocket.onopen = function (evt) {
            console.log("Connected to WebSocket server.");
            _this.sendMessage(username + '进入了直播间');
        };

        websocket.onclose = function (evt) {
            console.log("Disconnected");
        };

        websocket.onmessage = function (evt) {
            //console.log('Retrieved data from server: ' + evt.data);
            _this.state.messages.push(JSON.parse(evt.data));
            setTimeout(() => {
                if (_this.scrollView) _this.scrollView.scrollToEnd();
            }, 500);
        };

        websocket.onerror = function (evt, e) {
            console.log('Error occured: ' + evt.data);
        };
        this.websocket = websocket;
        setTimeout(() => {
            websocket.send('ping');
        }, 30000);
    }

    sendMessage(message) {
        const tid = this.props.route.params?.id;
        const {uid, username, avatar} = this.props.auth.userinfo;
        var data = {
            uid,
            username,
            avatar,
            message,
            tid
        }
        this.websocket.send(JSON.stringify(data));
    }
}

const mapStateToProps = (store) => {
    return {
        auth: store.auth
    };
};

export default connect(mapStateToProps)(LivePlay);
