import React from 'react';
import {FlatList, Image, StatusBar, Text, TouchableOpacity, View} from 'react-native';
import {connect} from 'react-redux';
import {LoadingView, Ticon} from 'react-native-gzdsx-elements';
import {NodePlayerView} from 'react-native-nodemediaclient';
import {Colors, Size} from '../../styles';
import {ApiClient, Toast} from '../../utils';

class LiveIndex extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            items: [],
            isLoading: true,
        };
        this.vps = [];
    }

    render(): React.ReactNode {
        if (this.state.isLoading) return <LoadingView/>;

        const {width, height} = Size.screenSize;
        return (<View style={{flex: 1, backgroundColor: '#000'}}>
            <FlatList
                keyExtractor={(item) => item.id.toString()}
                data={this.state.items}
                renderItem={({item, index}) => {
                    return (
                        <NodePlayerView
                            style={{width, height, flex: 1}}
                            inputUrl={"rtmp://live.gzdsx.cn/push/" + item.stream_id}
                            scaleMode={"ScaleAspectFit"}
                            bufferTime={0}
                            maxBufferTime={0}
                            autoplay={false}
                            ref={vp => {
                                this.vps[index] = vp;
                            }}
                            onStatus={(code, msg) => {
                                console.log(code + ':' + msg);
                            }}
                        />
                    );
                }}
                viewabilityConfig={{
                    viewAreaCoveragePercentThreshold: 80,//item滑动80%部分才会到下一个
                }}
                pagingEnabled={true}
                horizontal={false}
                showsHorizontalScrollIndicator={false}
                showsVerticalScrollIndicator={false}
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
                        <Text style={{color: '#fff', fontSize: 16, textAlign: 'center'}}>当前没有直播内容</Text>
                    </View>
                )}
            />
            {this.renderBottom()}
        </View>);
    }

    componentDidMount(): void {
        this.props.navigation.setOptions({
            headerShown: false
        });
        this.props.navigation.addListener('beforeRemove', () => {
            this.vps.map((vp) => {
                vp.stop();
            });
        });
        StatusBar.setHidden(false);
        this.fetchData();
    }

    componentWillUnmount() {
        this.props.navigation.removeListener('beforeRemove');
    }

    fetchData = () => {
        ApiClient.get('/live/batchget').then(response => {
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
        console.log(viewableItems);
        if (viewableItems.length === 1) {
            const current = viewableItems[0].index;
            this.vps.map((vp, index) => {
                if (index === current) {
                    vp.start();
                } else {
                    vp.stop();
                }
            });
            this.setState({viewItem: viewableItems[0], current});
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

const mapStateToProps = (store) => {
    return {
        auth: store.auth,
    };
};

export default connect(mapStateToProps)(LiveIndex);
