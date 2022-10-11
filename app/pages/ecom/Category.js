import React from 'react';
import {
    View,
    Text,
    TouchableOpacity,
    FlatList,
    ScrollView,
} from 'react-native';
import {LoadingView, Ticon} from "react-native-gzdsx-elements";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {Header} from "react-native-elements";
import {Utils, ApiClient} from "../../utils";
import {Colors, Size, HeaderStyles} from "../../styles";
import {SearchBar} from "../../components";

const viewItemWidth = (Size.screenWidth - 90) / 3;
const selected = {
    backgroundColor: '#fff',
    borderBottomWidth: 0.5,
    borderBottomColor: '#e5e5e5',
    borderTopWidth: 0.5,
    borderTopColor: '#e5e5e5',
};
const textSelected = {
    fontWeight: '600',
    color: '#ff0000'
};

export default class Category extends React.Component {
    setNavigationOptions = () => {
        const {navigation, route} = this.props;
        navigation.setOptions({
            header: () => (
                <Header
                    backgroundColor={Colors.primary}
                    centerComponent={() => (
                        <SearchBar
                            placeholderTextColor={"#666"}
                            placeholder={"猕猴桃,果酒,羊肉粉"}
                            containerStyle={{
                                backgroundColor: "transparent",
                                flex: 1,
                                padding: 0,
                                borderRadius: 10,
                                borderTopWidth: 0,
                                borderBottomWidth: 0,
                            }}
                            inputContainerStyle={{
                                backgroundColor: '#fefefe',
                                height: 34
                            }}

                            inputStyle={{
                                fontSize: 12,
                            }}
                            round={true}
                            lightTheme={true}
                            onSearch={(q) => {
                                navigation.navigate('ProductList', {q});
                            }}
                        />
                    )}
                    centerContainerStyle={{
                        flexDirection: "row"
                    }}
                    leftContainerStyle={{flex: 0}}
                    rightContainerStyle={{flex: 0}}
                    leftComponent={() => (
                        <TouchableOpacity
                            activeOpacity={1}
                            onPress={() => {
                                navigation.goBack();
                            }}
                            style={[HeaderStyles.headerLeft, {marginRight: 10, marginLeft: 0}]}
                        >
                            <Ticon name={'back-light'} color={"#fff"}/>
                        </TouchableOpacity>
                    )}
                >
                </Header>
            )
        });
    };

    constructor(props) {
        super(props);
        this.state = {
            items: [],
            category: {},
            isLoading: true,
            currentIndex: 0
        };
        this.scrollView = null;
    }

    componentDidMount() {
        this.setNavigationOptions();
        ApiClient.get('/ecom/product/category/list').then(response => {
            //console.log(response.result);
            const items = response.result.items;
            const category = items[0] || [];
            this.setState({
                items,
                category,
                isLoading: false
            });
        });
    }

    render() {
        if (this.state.isLoading) return <LoadingView/>;
        return (
            <View style={{flex: 1, flexDirection: 'row', backgroundColor: '#fff'}}>
                <View style={{
                    flex: 1,
                    width: 90,
                    maxWidth: 90,
                    backgroundColor: '#f0f0f0'
                }}>
                    <FlatList
                        data={this.state.items}
                        renderItem={({item, index}) => this.renderListItem(item, index)}
                        keyExtractor={(item) => item.catid.toString()}
                        style={{paddingTop: 10}}
                        showsHorizontalScrollIndicator={false}
                        showsVerticalScrollIndicator={false}
                    />
                </View>
                <ScrollView
                    style={{
                        flex: 1,
                        paddingTop: 15
                    }}
                    ref={(scrollView) => {
                        this.scrollView = scrollView;
                    }}
                >
                    {this.renderListView()}
                </ScrollView>
            </View>
        );
    }

    renderListItem = (category, index) => {
        return (
            <TouchableOpacity
                activeOpacity={1}
                style={[{
                    paddingTop: 15,
                    paddingBottom: 15,
                    paddingLeft: 10,
                    paddingRight: 10,
                }, this.state.currentIndex === index && selected]}
                onPress={() => {
                    this.setState({
                        category,
                        currentIndex: index
                    });
                }}
            >
                <Text style={[{
                    flex: 1,
                    textAlign: 'center',
                    fontSize: 14,
                    color: '#000',
                }, this.state.currentIndex === index && textSelected]} numberOfLines={1}>{category.name}</Text>
            </TouchableOpacity>
        );
    };

    renderListView = () => {
        const category = this.state.category;
        return (
            <View
                style={{marginBottom: 20}}
                key={category.catid.toString()}
            >
                <View style={{
                    paddingTop: 10,
                    paddingBottom: 10,
                }}>
                    <Text style={{fontSize: 14, fontWeight: '500', textAlign: 'center'}}>{category.name}</Text>
                </View>
                <View style={{
                    flexDirection: 'row',
                    flexWrap: 'wrap'
                }}>{this.renderListViewItems()}</View>
            </View>
        );
    };

    renderListViewItems = () => {
        return this.state.category.children.map((category) => {
            return (
                <TouchableOpacity
                    activeOpacity={1}
                    key={category.catid.toString()}
                    style={{
                        alignContent: 'center',
                        alignItems: 'center',
                        width: viewItemWidth,
                        paddingTop: 10,
                        paddingBottom: 10
                    }}
                    onPress={() => {
                        this.props.navigation.navigate('ProductList', {catid: category.catid, title: category.name});
                    }}
                >
                    <CacheImage
                        source={{uri: category.image || ''}}
                        style={{
                            width: 50,
                            height: 50
                        }}
                        loadingIndicator={() => <View/>}
                    />
                    <Text style={{
                        textAlign: 'center',
                        fontSize: 14,
                        color: '#333',
                        marginTop: 10
                    }}>{category.name}</Text>
                </TouchableOpacity>
            );
        });
    };
}
