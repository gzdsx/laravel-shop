import React from 'react';
import {View} from 'react-native';
import ScrollableTabView, {ScrollableTabBar} from 'react-native-scrollable-tab-view';
import {Colors, Styles} from "../../styles";
import PostListComponent from "../post/components/PostListComponent";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";
import {LoadingView} from "react-native-dsxui";

export default class NewsIndex extends React.Component {

    static options = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '校园资讯'
    });

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            catlogs: []
        };
    }


    render(): React.ReactNode {
        if (this.state.isLoading) return <LoadingView/>;
        let contents = this.state.catlogs.map((item,index)=>{
            return <PostListComponent catid={item.catid} onPressItem={this.onPressItem} tabLabel={item.name} key={index.toString()}/>
        });
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
                {contents}
            </ScrollableTabView>
        );
    }

    componentDidMount(): void {
        ApiClient.get('/post/catlog/batchget', {fid: 2}).then(response => {
            let catlogs = response.data.items;
            this.setState({
                isLoading: false,
                catlogs
            });
        });
    }

    onPressItem = (item) => {
        this.props.navigation.navigate('NewsDetail', {aid: item.aid});
    }
}
