import React from 'react';
import {connect} from 'react-redux';
import {
    Platform,
    View,
    TouchableOpacity,
    Image,
    Text,
    Alert,
    StatusBar,
    InteractionManager,
    FlatList, KeyboardAvoidingView
} from 'react-native';
import {Ticon} from "react-native-ticon";
import ImagePicker from 'react-native-image-picker';
import {Spinner} from "react-native-dsxui";
import {CustomButton, CustomTextInput} from "../../components";
import {ApiClient, Toast, Utils} from "../../utils";
import {Size} from "../../styles";
import {TXPush, TXPushView} from "../../txlive";


class LivePush extends React.Component {

    static navigationOptions = ({navigation}) => ({
        header: null
    });

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            types: [],
            type: null,
            image: null,
            title: null,
            oriImage: null,
            isPushing: false,
            showForm: true,
            showTypes: false,
            chatMessages: [],
            live: null,
            showKeyBoard: false
        };
    }


    render(): React.ReactNode {
        return (
            <View style={{flex: 1, backgroundColor: '#000'}}>
                <TXPushView style={{flex: 1}}/>
                <Spinner show={this.state.uploading}/>
            </View>
        );
    }

    componentDidMount(): void {
        this.props.navigation.addListener('willFocus', () => StatusBar.setHidden(true));
        this.props.navigation.addListener('willBlur', () => StatusBar.setHidden(false));

        InteractionManager.runAfterInteractions(() => {
            TXPush.startPreview();
            TXPush.startPush("rtmp://livepush.gzdsx.cn/live/16ec03b00f8?txSecret=a53ad5da6bfe49a737859e8c2301c028&txTime=5DE4011E");
        });
    }

    fetchMessage = () => {
        const live_id = this.state.live.id;
        ApiClient.get('/live/chat/get', {live_id}).then(response => {
            const message = response.result.message;
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

    fetchData = async () => {
        let response = await ApiClient.get('/live/mylive');
        const live = response.result.live;

        response = await ApiClient.get('/live/type/batchget');
        const types = response.result.items;

        if (live) {
            const {title, image, type} = live;
            this.setState({
                isLoading: false,
                types,
                type,
                title,
                image,
                live
            });
        } else {
            this.setState({
                isLoading: false,
                types
            });
        }
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
                    }}>
                        <Ticon name={"close-light"}
                               size={30}
                               color={"#fff"}
                               style={{marginTop: 1}}
                               onPress={() => {
                                   if (this.state.isPushing) {
                                       Alert.alert(null, '你确定要退出直播吗', [
                                           {text: '取消'},
                                           {
                                               text: '确定', onPress: () => {
                                                   ZegoLive.stopPushing();
                                                   this.setState({
                                                       isPushing: false
                                                   }, () => {
                                                       this.props.navigation.goBack();
                                                   });
                                               }
                                           },
                                       ]);
                                   } else {
                                       this.props.navigation.goBack();
                                   }

                               }}/>
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
                        <Image source={require('../../images/common/camera_flip.png')}
                               style={{width: 30, height: 30, tintColor: '#fff'}}/>
                    </TouchableOpacity>
                </View>
            </View>
        );
    };

    renderForm = () => {
        return (
            <View style={{position: 'absolute', top: Size.screenHeight * 0.2, left: 30, right: 30}}>
                <View style={{flexDirection: 'row'}}>
                    <TouchableOpacity
                        activeOpacity={1}
                        style={{
                            width: 80,
                            height: 80,
                            marginRight: 15
                        }}
                        onPress={this.pickImage}
                    >
                        {
                            this.state.image ?
                                <Image
                                    source={{uri: this.state.image}}
                                    style={{
                                        width: 80,
                                        height: 80
                                    }}
                                />
                                :
                                <Image
                                    source={require('../../images/common/add_image.png')}
                                    style={{
                                        width: 80,
                                        height: 80,
                                        tintColor: '#fff'
                                    }}
                                />
                        }
                        <Text style={{fontSize: 14, color: '#fff', marginTop: 5, textAlign: 'center'}}>更换海报</Text>
                    </TouchableOpacity>
                    <View style={{flex: 1}}>
                        <TouchableOpacity
                            activeOpacity={1}
                            style={{
                                paddingBottom: 10
                            }}
                            onPress={() => {
                                this.setState({
                                    showTypes: true
                                })
                            }}
                        >
                            <Text style={{
                                fontSize: 14,
                                color: '#fff'
                            }}>{this.state.type ? this.state.type.typename : '选择直播频道>>'}</Text>
                        </TouchableOpacity>
                        <View style={{flex: 1}}>
                            <CustomTextInput
                                placeholder={"请填写直播间名称"}
                                placeholderTextColor={"#fff"}
                                multiline={true}
                                blurOnSubmit={true}
                                style={{
                                    fontSize: 18,
                                    color: '#fff',
                                    height: 60
                                }}
                                onChangeText={(text) => {
                                    this.setState({title: text});
                                }}
                                value={this.state.title}
                            />
                        </View>
                    </View>
                </View>

                <View style={{marginTop: 180}}>
                    <CustomButton type={"primary"} text={"开始直播"} onPress={this.submit}/>
                </View>
            </View>
        )
    };

    renderTypes = () => {
        let contents = this.state.types.map((item, index) => {
            return (
                <TouchableOpacity
                    activeOpacity={1}
                    style={{
                        padding: 10,
                        marginLeft: 5,
                        marginRight: 5,
                        marginBottom: 10,
                        borderColor: '#ccc',
                        borderRadius: 10,
                        borderWidth: 0.5
                    }}
                    key={index.toString()}
                    onPress={() => {
                        this.setState({
                            type: item,
                            showTypes: false
                        });
                    }}
                >
                    <Text style={{fontSize: 16}}>{item.typename}</Text>
                </TouchableOpacity>
            )
        });

        return (
            <View style={{
                position: 'absolute',
                left: 30,
                right: 30,
                height: 300,
                top: (Size.screenHeight - 300) / 2,
                backgroundColor: '#fff',
                borderRadius: 10
            }}>
                <View style={{
                    flexDirection: 'row',
                    padding: 15,
                    backgroundColor: '#f2f2f2',
                    borderTopLeftRadius: 10,
                    borderTopRightRadius: 10
                }}>
                    <Text style={{fontSize: 16, color: '#222', flex: 1}}>选择直播频道</Text>
                    <Ticon
                        name={"close-light"}
                        color={"#222"}
                        size={28}
                        onPress={() => {
                            this.setState({
                                showTypes: false
                            })
                        }}
                    />
                </View>
                <View style={{padding: 10, flexDirection: 'row', flexWrap: 'wrap'}}>
                    {contents}
                </View>
            </View>
        )
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
                <TouchableOpacity
                    style={{
                        width: 40,
                        height: 40,
                        borderRadius: 20,
                        backgroundColor: 'rgba(0,0,0,0.3)',
                        justifyContent: 'center',
                        alignItems: 'center'
                    }}
                    activeOpacity={1}
                    onPress={() => {
                        this.setState({
                            showForm: !this.state.showForm
                        });
                    }}
                >
                    <Image
                        source={require('../../images/common/settings.png')}
                        style={{
                            width: 26,
                            height: 26,
                            tintColor: '#fff'
                        }}
                    />
                </TouchableOpacity>
            </View>
        )
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
                                    //console.log(event.nativeEvent);
                                    if (event.nativeEvent.text) {
                                        ApiClient.post('/live/chat/send', {
                                            live_id: this.state.live.id,
                                            message: event.nativeEvent.text
                                        }).then(response => {
                                            console.log(response.result);
                                        });
                                    }
                                    this.setState({showKeyBoard: false});
                                }}
                            />
                        </View>
                        : null
                }
            </KeyboardAvoidingView>
        );
    };

    pickImage = () => {
        Utils.setStatusBarStyle();
        ImagePicker.showImagePicker({
            title: null,
            takePhotoButtonTitle: '拍照',
            chooseFromLibraryButtonTitle: '从相册选择',
            cancelButtonTitle: '取消',
            maxWidth: 1200,
            maxHeight: 1200,
            tintColor: '#333'
        }, response => {
            Utils.setStatusBarStyle('light');
            if (response.didCancel || response.error) {
                return false;
            }
            //console.log(response);
            this.setState({
                oriImage: response,
                image: response.uri
            });
        });
    };

    submit = () => {
        const {title, type, image} = this.state;
        if (!type) {
            Toast.show('请选择直播频道');
            return false;
        }
        if (!title) {
            Toast.show('请输入直播间名称');
            return false;
        }

        this.uploadFiles().then(() => {
            const {image} = this.state;
            if (!image) {
                Toast.show('请选择直播海报');
                return false;
            }
            ApiClient.post('/live/save', {title, image, typeid: type.typeid}).then(response => {
                const live = response.result.live;
                this.setState({
                    title: live.title,
                    image: live.image,
                    type: live.type,
                    showForm: false,
                    isPushing: true,
                    live
                }, () => {
                    this.fetchMessage();
                    if (this.state.isPushing) {
                        this.setState({
                            showForm: false
                        });
                    } else {
                        this.setState({
                            showForm: false,
                            isPushing: true
                        });
                        ZegoLive.startPushingStream({
                            roomID: live.uid.toString(),
                            roomTitle: live.title.toString(),
                            streamID: live.uid.toString(),
                        });
                    }
                });
            });
        });
    };

    uploadFiles = async () => {
        const oriImage = this.state.oriImage;
        if (oriImage) {
            this.setState({uploading: true});
            let response = await ApiClient.upload('/material/upload_img', {
                uri: oriImage.uri,
                name: oriImage.fileName
            });
            this.setState({
                image: response.result.image.image,
                uploading: false
            });
        }

        return new Promise((resolve => {
            resolve();
        }));
    }
}

const mapStateToProps = (store) => {
    return {
        auth: store.auth
    };
};

export default connect(mapStateToProps)(LivePush);
