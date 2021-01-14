import React from 'react';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";
import ScrollableTabView, {ScrollableTabBar} from "react-native-scrollable-tab-view";
import ItemListComponent from "./components/ItemListComponent";

export default class ItemIndex extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '商品分类',
        })
    }

    constructor(props) {
        super(props);
        this.state = {
            categories: []
        };
    }


    render(): React.ReactNode {
        if (this.state.categories.length === 0) {
            return null;
        }

        const contents = this.state.categories.map((category) => {
            return <ItemListComponent
                catid={category.catid}
                key={category.catid}
                tabLabel={category.name}
                onPressItem={(item) => {
                    this.props.navigation.navigate('ItemDetail', {itemid: item.itemid});
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

    componentDidMount(): void {
        this.setNavigationOptions();
        ApiClient.get('/item/category/getall').then(response => {
            //console.log(response);
            this.setState({
                categories: response.data.items
            });
        });
    }
}
