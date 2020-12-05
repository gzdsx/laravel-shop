import React from 'react';
import {Image, NativeModules, Platform, TouchableOpacity, View} from 'react-native';
import Video from 'react-native-video';
import {Ticon, LoadingView} from "react-native-gzdsx-elements";
import {ApiClient, Toast} from "../../utils";
import {Size} from "../../styles";

export default class VideoDetail extends React.Component {

    static navigationOptions = ({navigation}) => ({
        header: null
    });

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            video: null,
            isPause: false
        };
    }


    render(): React.ReactNode {
        const video = this.state.video;
        const {width, height} = Size.screenSize;
        const STATUSBAR_HEIGHT = Platform.OS === 'ios' ? 0 : NativeModules.StatusBarManager.HEIGHT;
        if (this.state.isLoading) return <LoadingView/>;
        return (
            <View style={{flex: 1}}>
                <TouchableOpacity
                    activeOpacity={1}
                    onPress={() => {
                        this.setState({
                            isPause: !this.state.isPause,
                        });
                    }}
                    style={{flex: 1, width, height: height - STATUSBAR_HEIGHT}}
                >
                    <Video
                        source={{uri: video.sourceurl}}
                        style={{flex: 1, backgroundColor: '#000'}}
                        repeat={true}
                        paused={this.state.isPause}
                        resizeMode='contain'
                        poster={video.image}
                    />
                </TouchableOpacity>
                {this.renderBottom()}
            </View>
        );
    }

    componentDidMount(): void {
        ApiClient.get('/video/get', {id: this.props.navigation.getParam('id', 0)}).then(response => {
            const video = response.data.video;
            this.setState({
                video,
                isLoading: false
            })
        }).catch(reason => {

        });
    }

    renderBottom = () => {
        return (
            <View style={{
                flexDirection: 'row',
                position: 'absolute',
                left: 0,
                right: 0,
                bottom: 0,
                paddingLeft: 20,
                paddingRight: 20,
                paddingBottom: 15
            }}>
                <Ticon size={28} name={"back-light"} color={"#fff"} onPress={() => this.props.navigation.goBack()}/>
                <View style={{flex: 1}}/>
                <TouchableOpacity
                    activeOpacity={1}
                    style={{
                        width: 40,
                        height: 30,
                        backgroundColor: '#efefef',
                        borderRadius: 5,
                        alignItems: 'center',
                        justifyContent: 'center'
                    }}
                >
                    <Image
                        source={require('../../images/common/add.png')}
                        style={{
                            width: 20,
                            height: 20
                        }}
                    />
                </TouchableOpacity>
                <View style={{flex: 1}}/>
                <TouchableOpacity
                    activeOpacity={1}
                    onPress={() => {
                        ApiClient.post('/video/collect/add', {
                            vid: this.state.video.id
                        }).then(response => {
                            Toast.show('视频收藏成功');
                        }).catch(reason => {
                            console.log(reason);
                        });
                    }}
                >
                    <Image
                        source={require('../../images/common/favorite.png')}
                        style={{
                            width: 30,
                            height: 30,
                            tintColor: '#fff'
                        }}
                    />
                </TouchableOpacity>
            </View>
        );
    }
}
