import React from 'react';
import ScrollableTabView, {ScrollableTabBar} from 'react-native-scrollable-tab-view';
import PostListComponent from "./components/PostListComponent";
import {ApiClient} from "../../utils";
import {lightNavigationConfigure} from "../../base/navconfig";
import {LoadingView} from "react-native-gzdsx-elements";
import {Colors, StatusBarStyles} from "../../styles";
import {SafeAreaView, Text, TouchableOpacity} from "react-native";

class PostIndex extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            dataList: [],
            loading: true
        }
    }

    fetchData = ()=>{
        ApiClient.get('/post/category.getList').then(response => {
            //console.log(response);
            this.setState({
                dataList: response.result.items,
                loading: false
            });
        });
    }

    componentDidMount() {
        const {navigation} = this.props;
        this.unsubscribe = navigation.addListener('focus', () => {
            StatusBarStyles.setToLightStyle();
            this.fetchData();
        });

        navigation.setOptions({
            ...lightNavigationConfigure(navigation),
            headerTitle: '发现',
            headerLeft: () => null,
            //headerShown: false
        });
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render() {
        let {loading, dataList} = this.state;
        if (loading) return <LoadingView/>;
        return (
            <SafeAreaView style={{flex: 1, backgroundColor: Colors.primary}}>
                <ScrollableTabView
                    renderTabBar={() => (
                        <ScrollableTabBar
                            style={{
                                borderBottomWidth: 0.5,
                                borderBottomColor: '#e0e0e0',
                                backgroundColor: '#fff',
                            }}
                            tabsContainerStyle={{paddingHorizontal: 5}}
                            renderTab={(name, page, isTabActive, onPressHandler, onLayoutHandler) => {
                                let color = isTabActive ? '#f00' : '#333';
                                let fontWeight = isTabActive ? 'bold' : '400';
                                return (
                                    <TouchableOpacity
                                        key={`${name}_${page}`}
                                        activeOpacity={1}
                                        onPress={() => onPressHandler(page)}
                                        onLayout={onLayoutHandler}
                                        style={{
                                            alignItems: 'center',
                                            justifyContent: 'center',
                                            marginHorizontal: 8
                                        }}
                                    >
                                        <Text style={{
                                            fontSize: 16,
                                            color,
                                            fontWeight
                                        }}>{name}</Text>
                                    </TouchableOpacity>
                                )
                            }}
                        />
                    )}
                    style={{backgroundColor: '#f5f5f5'}}
                    tabBarUnderlineStyle={{
                        backgroundColor: '#f00',
                        height: 3
                    }}
                >
                    {
                        dataList.map((cate, index) => (
                            <PostListComponent
                                key={index.toString()}
                                cate_id={cate.cate_id}
                                tabLabel={cate.cate_name}
                                navigation={this.props.navigation}
                            />
                        ))
                    }
                </ScrollableTabView>
            </SafeAreaView>
        );
    }
}

export default PostIndex;
