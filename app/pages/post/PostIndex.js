import React from 'react';
import ScrollableTabView, {ScrollableTabBar} from 'react-native-scrollable-tab-view';
import PostListComponent from "./components/PostListComponent";
import {ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";

class PostIndex extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            items: []
        }
    }

    render() {
        if (this.state.items === null || this.state.items.length === 0) {
            return null;
        }

        const contents = this.state.items.map((category) => {
            return <PostListComponent
                catid={category.catid}
                key={category.catid}
                tabLabel={category.name}
                onPressItem={(item) => {
                    this.props.navigation.navigate('PostDetail', {aid: item.aid});
                }}
            />;
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
                        paddingLeft: 0,
                        paddingRight: 0
                    }}
                />}
                tabBarBackgroundColor="#f8f8f8"
                tabBarActiveTextColor="#f40"
                tabBarInactiveTextColor="#222"
                tabBarUnderlineStyle={{
                    backgroundColor: '#f40',
                    height: 3,
                    bottom: -1
                }}
                tabBarTextStyle={{fontSize: 14}}
                style={{backgroundColor: '#f2f2f2'}}
            >
                {contents}
            </ScrollableTabView>
        );
    }


    componentDidMount() {
        const {navigation} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '发现',
            headerLeft: () => null
        });
        ApiClient.get('/post/category/getall').then(response => {
            //console.log(response);
            this.setState({
                items: response.result.items
            });
        });
    }

    renderContent = (catid) => {
        return <PostListComponent
            catid={catid}
            onPressItem={(item) => {
                this.props.navigation.navigate('PostDetail', {aid: item.aid});
            }}
        />;
    }
}

export default PostIndex;
