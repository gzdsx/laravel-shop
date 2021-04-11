import React from 'react';
import {FlatList, NativeModules, Platform, TouchableOpacity, View} from 'react-native';
import {Size} from "../../styles";
import Video from "react-native-video";
import {ApiClient} from "../../utils";

export default class VideoListComponent extends React.Component {

    static defaultProps = {
        catid: 0,
        onPressItem: () => null
    };

    constructor(props) {
        super(props);
        this.state = {
            items: [],
            isPause: true, //控制播放器是否播放，下面的代码有解释一个列表只需要一个state控制，而不用数组
            current: 0,//表示当前item的索引，通过这个实现一个state控制全部的播放器,
            isLoading: true,
        };
    }

    render(): React.ReactNode {
        const VIEWABILITY_CONFIG = {
            viewAreaCoveragePercentThreshold: 80,//item滑动80%部分才会到下一个
        };
        const {width, height} = Size.screenSize;
        const STATUSBAR_HEIGHT = Platform.OS === 'ios' ? 0 : NativeModules.StatusBarManager.HEIGHT;
        return (
            <FlatList
                keyExtractor={(item) => item.id.toString()}
                data={this.state.items}
                renderItem={({item, index}) => {
                    return (<View style={{width, height: height - STATUSBAR_HEIGHT}}>
                        <Video
                            source={{uri: item.sourceurl}}
                            style={{flex: 1, backgroundColor: '#000'}}
                            repeat={true}
                            paused={index === this.state.current ? this.state.isPause : true}
                            resizeMode='contain'
                            poster={item.image}
                        />
                        <TouchableOpacity
                            onPress={() => {
                                this.setState({
                                    isPause: !this.state.isPause,
                                })
                            }}
                            style={{flex: 1, position: 'absolute', width, height: height - STATUSBAR_HEIGHT}}
                        >
                        </TouchableOpacity>
                    </View>);
                }}
                viewabilityConfig={VIEWABILITY_CONFIG}
                pagingEnabled={true}
                horizontal={false}
                showsHorizontalScrollIndicator={false}
                onViewableItemsChanged={this.onViewableItemsChanged}
                getItemLayout={(data, index) => {
                    return {length: height, offset: height * index, index}
                }}
            />
        );
    }

    componentDidMount(): void {
        this.fetchData();
    }

    fetchData = () => {
        const catid = this.props.catid;
        ApiClient.get('/video/batchget', {catid}).then(response => {
            let items = response.result.items;
            this.setState({
                items,
                isLoading: false
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
}
