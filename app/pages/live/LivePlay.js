import React from 'react';
import {connect} from 'react-redux';
import {
    Image,
    Platform,
    TouchableOpacity,
    View,
    Text,
    StatusBar,
    FlatList,
    KeyboardAvoidingView
} from 'react-native';
import {LoadingView} from "react-native-dsxui";
import {ApiClient} from "../../utils";
import {Ticon} from "react-native-ticon";
import {CustomTextInput} from "../../components";
import {TXLive, TXPlayView} from "../../txlive";

class LivePlay extends React.Component {

    static navigationOptions = ({navigation}) => ({
        header: null,
    });

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            live: null,
            chatMessages: [],
            showKeyBoard: false
        };

        this.messageID = 0;
        this.scrollView = null;
    }


    render(): React.ReactNode {
        if (this.state.isLoading) return <LoadingView/>;

        return (
            <View style={{flex: 1}}>
                <TXPlayView style={{flex: 1, backgroundColor: '#000'}}/>
                {this.renderHeader()}
                {this.renderChats()}
                {this.renderBottom()}
                {this.renderKeyBoard()}
            </View>
        )
    }

    componentDidMount(): void {
        this.props.navigation.addListener('willBlur', () => {
            //clearTimeout(this.t);
            StatusBar.setHidden(false);
            TXLive.stopPlay();
        });

        this.props.navigation.addListener('willFocus', () => StatusBar.setHidden(true));
        const id = this.props.navigation.getParam('id', 0);
        ApiClient.get('/live/get', {id}).then(response => {
            const live = response.data.live;
            this.setState({
                live,
                isLoading: false
            }, () => {
                TXLive.startPlay(live.flv_url, 1);
                TXLive.isPlaying((event)=>{
                    console.log(event);
                });
            });
        });
    }

    fetchMessage = () => {
        const live_id = this.props.navigation.getParam('id', 0);
        ApiClient.get('/live/chat/get', {live_id}).then(response => {
            const message = response.data.message;
            if (message.id === this.messageID) {
                //return false;
            } else {
                this.messageID = message.id;
                let chatMessages = this.state.chatMessages;
                chatMessages.push(message);
                this.setState({chatMessages}, () => {
                    if (this.scrollView) {
                        this.scrollView.scrollToEnd({animated: true});
                    }
                });
            }
            this.t = setTimeout(this.fetchMessage, 1000);
        }).catch(reason => {
            console.log(reason);
        });
    };

    renderHeader = () => {
        return (
            <View style={{
                height: Platform.OS === 'ios' ? 64 : 44,
                paddingTop: Platform.OS === 'ios' ? 30 : 10,
                position: 'absolute',
                left: 0,
                top: 0,
                right: 0
            }}>
                <View style={{flexDirection: 'row', paddingLeft: 15, paddingRight: 15, height: 30}}>
                    <View style={{
                        marginRight: 20,
                        alignItems: 'center',
                        alignContent: 'center',
                        flexDirection: 'row'
                    }}>
                        <Image
                            source={{uri: this.state.live.user.avatar}}
                            style={{
                                width: 40,
                                height: 40,
                                borderRadius: 20,
                                marginRight: 10
                            }}
                        />
                        <Text style={{
                            fontSize: 14,
                            color: '#fff',
                        }} numberOfLines={2}>{this.state.live.title}</Text>
                    </View>
                    <View style={{
                        marginLeft: 20,
                        alignItems: 'center',
                        alignContent: 'center',
                        flex: 1
                    }}>
                    </View>
                    <TouchableOpacity
                        activeOpacity={1}
                    >
                        <Ticon name={"close-light"}
                               size={30}
                               color={"#fff"}
                               style={{marginTop: 1}}
                               onPress={() => {
                                   this.props.navigation.goBack();
                               }}/>
                    </TouchableOpacity>
                </View>
            </View>
        );
    };

    renderChats = () => {
        const {auth} = this.props;
        return (
            <View style={{
                position: 'absolute',
                left: 0,
                bottom: 55,
                right: 0,
                height: 200
            }}>
                <FlatList
                    keyExtractor={(item) => item.id.toString()}
                    data={this.state.chatMessages}
                    renderItem={({item, index}) => {
                        const username = auth.userinfo.uid == item.uid ? '我' : item.user.username;
                        return (
                            <View style={{
                                paddingTop: 5,
                                paddingBottom: 5,
                                paddingLeft: 30,
                                paddingRight: 30,
                                flexDirection: 'row'
                            }}>
                                <Text style={{color: '#17BFD7', fontSize: 14}}>{username}:</Text>
                                <Text style={{color: '#fff', fontSize: 14}}>{item.message}</Text>
                            </View>
                        )
                    }}
                    style={{
                        flex: 1
                    }}
                    ref={ref => {
                        this.scrollView = ref;
                    }}
                />
            </View>
        );
    };

    renderBottom = () => {
        return (
            <View style={{
                position: 'absolute',
                left: 0,
                right: 0,
                bottom: 0,
                height: 50,
                flexDirection: 'row',
                paddingLeft: 15,
                paddingRight: 15
            }}>
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
                <View style={{
                    width: 40,
                    height: 40,
                    borderRadius: 20,
                    backgroundColor: 'rgba(0,0,0,0.3)',
                    justifyContent: 'center',
                    alignItems: 'center'
                }}>
                    <Ticon name={"close-light"} size={20} color={"#fff"}
                           onPress={() => this.props.navigation.goBack()}/>
                </View>
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
                            <CustomTextInput
                                style={{
                                    flex: 1,
                                    height: 40,
                                    fontSize: 16
                                }}

                                placeholder={""}
                                autoFocus={true}
                                onSubmitEditing={(event) => {
                                    console.log(event.nativeEvent);
                                    if (event.nativeEvent.text) {
                                        ApiClient.post('/live/chat/send', {
                                            live_id: this.state.live.id,
                                            message: event.nativeEvent.text
                                        }).then(response => {
                                            console.log(response.data);
                                        });
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
}

const mapStateToProps = (store) => {
    return {
        auth: store.auth
    };
};

export default connect(mapStateToProps)(LivePlay);
