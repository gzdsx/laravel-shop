import React from 'react';
import {
    View,
    FlatList,
    TouchableOpacity,
    NativeModules,
    Platform,
    Text,
    Image,
    StatusBar
} from 'react-native';
import {Ticon} from "react-native-gzdsx-elements";
import Video from "react-native-video";
import {ApiClient, Toast} from "../../utils";
import {Size} from "../../styles";

export default class VideoIndex extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            items: [],
            isPause: false, //控制播放器是否播放，下面的代码有解释一个列表只需要一个state控制，而不用数组
            current: 0,//表示当前item的索引，通过这个实现一个state控制全部的播放器,
        };
    }

    render(): React.ReactNode {
        const VIEWABILITY_CONFIG = {
            viewAreaCoveragePercentThreshold: 80,//item滑动80%部分才会到下一个
        };
        const {width, height} = Size.screenSize;
        const STATUSBAR_HEIGHT = Platform.OS === 'ios' ? 0 : NativeModules.StatusBarManager.HEIGHT;
        return (<View style={{flex: 1, backgroundColor: '#000'}}>
            <FlatList
                keyExtractor={(item) => item.id.toString()}
                data={this.state.items}
                renderItem={({item, index}) => {
                    return (
                        <TouchableOpacity
                            onPress={() => {
                                this.setState({
                                    isPause: !this.state.isPause,
                                })
                            }}
                            style={{width, height: height - STATUSBAR_HEIGHT}}
                            activeOpacity={1}
                        >
                            <Video
                                source={{uri: item.source}}
                                style={{flex: 1, backgroundColor: '#000'}}
                                repeat={true}
                                paused={index === this.state.current ? this.state.isPause : true}
                                resizeMode='contain'
                            />
                        </TouchableOpacity>
                    );
                }}
                viewabilityConfig={VIEWABILITY_CONFIG}
                pagingEnabled={true}
                horizontal={false}
                showsHorizontalScrollIndicator={false}
                onViewableItemsChanged={this.onViewableItemsChanged}
                getItemLayout={(data, index) => {
                    return {length: height, offset: height * index, index}
                }}
                ListEmptyComponent={() => (
                    <View style={{
                        flex: 1,
                        alignContent: 'center',
                        justifyContent: 'center',
                        flexDirection: 'column',
                        width,
                        height
                    }}>
                        <Text style={{color: '#fff', fontSize: 16, textAlign: 'center'}}>没有课播放的视频</Text>
                    </View>
                )}
            />
            {this.renderBottom()}
        </View>);
    }

    componentDidMount(): void {
        StatusBar.setHidden(true);
        this.props.navigation.setOptions({
            headerShown: false
        });
        this.props.navigation.addListener('beforeRemove', () => {
            StatusBar.setHidden(false);
            this.setState({isPause: true});
        });
        this.fetchData();
    }

    componentWillUnmount() {
        this.props.navigation.removeListener('beforeRemove');
    }

    fetchData = () => {
        ApiClient.get('/video/batchget').then(response => {
            let items = response.data.items;
            this.setState({
                isLoading: false,
                items
            });
        });
    };

    onViewableItemsChanged = ({viewableItems, changed}) => {
        //这个方法为了让state对应当前呈现在页面上的item的播放器的state
        //也就是只会有一个播放器播放，而不会每个item都播放
        //可以理解为，只要不是当前再页面上的item 它的状态就应该暂停
        //只有100%呈现再页面上的item（只会有一个）它的播放器是播放状态
        if (viewableItems.length === 1) {
            this.setState({
                current: viewableItems[0].index,
            });
        }
    };

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
                <TouchableOpacity
                    activeOpacity={1}
                    onPress={() => this.props.navigation.goBack()}
                >
                    <Ticon size={28} name={"back-light"} color={"#fff"}/>
                </TouchableOpacity>
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
                    onPress={() => {
                        this.props.navigation.navigate('RecordVideo');
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
                            vid: this.state.items[this.state.current].id
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
