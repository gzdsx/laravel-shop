import React from 'react';
import {View, FlatList} from 'react-native';
import {defaultNavigationConfigure} from "../../base/navconfig";
import ScrollableTabView, {ScrollableTabBar} from "react-native-scrollable-tab-view";
import {Colors} from "../../styles";
import PostCollect from "./collect/PostCollect";
import VideoCollect from "./collect/VideoCollect";

export default class Favorite extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '我的收藏'
    });

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            items: []
        };
    }


    render(): React.ReactNode {
        return (
            <ScrollableTabView
                renderTabBar={() => <ScrollableTabBar
                    style={{
                        height: 44,
                        borderBottomWidth: 0.5,
                        backgroundColor: '#fff',
                        borderBottomColor: '#e0e0e0'
                    }}
                    tabStyle={{
                        paddingLeft: 5,
                        paddingRight: 5,
                        paddingTop: 15,
                        paddingBottom: 15
                    }}
                />}
                tabBarActiveTextColor={Colors.primary}
                tabBarInactiveTextColor="#222"
                tabBarUnderlineStyle={{
                    backgroundColor: Colors.primary,
                    height: 3,
                    bottom: -1
                }}
                tabBarTextStyle={{fontSize: 15}}
                initialPage={0}
                style={{
                    backgroundColor: '#f2f2f2'
                }}
            >
                <PostCollect tabLabel={"文章"} onPressItem={(item) => {
                    this.props.navigation.navigate('NewsDetail', {aid: item.aid});
                }}/>
                <VideoCollect tabLabel={"视频"} onPressItem={(item) => {
                    this.props.navigation.navigate('VideoDetail', {id: item.id});
                }}/>
                <View tabLabel={"动态"}/>
            </ScrollableTabView>
        )
    }
}
