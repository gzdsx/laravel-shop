import React from 'react';
import {View} from 'react-native';
import {defaultNavigationConfigure} from "../../base/navconfig";
import ScrollableTabView, {ScrollableTabBar} from "react-native-scrollable-tab-view";
import {Colors, StatusBarStyles} from "../../styles";
import ProductSubscribe from "./subscribe/ProductSubscribe";
import ShopSubscribe from "./subscribe/ShopSubscribe";
import PostSubscribe from "./subscribe/PostSubscribe";

export default class Favorite extends React.Component {

    constructor(props) {
        super(props);
    }

    componentDidMount() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '我的收藏'
        });
        this.unsubsctibe = navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });
    }

    componentWillUnmount() {
        this.unsubsctibe();
    }

    render(): React.ReactNode {
        let {navigation} = this.props;
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
                <ProductSubscribe tabLabel={'商品'} navigation={navigation}/>
                <ShopSubscribe tabLabel={'店铺'} navigation={navigation}/>
                <PostSubscribe tabLabel={'文章'} navigation={navigation}/>
            </ScrollableTabView>
        )
    }
}
