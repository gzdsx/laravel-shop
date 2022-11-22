import React from 'react';
import {SafeAreaView, ScrollView, StyleSheet, Text, TouchableOpacity, View} from 'react-native';
import {Header, SearchBar} from "react-native-elements";
import Icon from "react-native-vector-icons/Entypo";
import {Colors, StatusBarStyles} from "../../styles";
import {useNavigation} from "@react-navigation/native";
import AsyncStorage from "@react-native-async-storage/async-storage";

const SearchHeader = (props) => {
    let [keywords, setKeywords] = React.useState('');
    let navigation = useNavigation();
    return (
        <Header
            backgroundColor={'#f2f2f2'}
            centerComponent={() => (
                <SearchBar
                    placeholderTextColor={"#666"}
                    placeholder={"输入关键字搜索"}
                    containerStyle={{
                        flex: 1,
                        padding: 0,
                        borderRadius: 20,
                        borderTopWidth: 0,
                        borderBottomWidth: 0,
                        paddingBottom: 0
                    }}
                    inputContainerStyle={{
                        backgroundColor: '#fff',
                        height: 34,
                        borderRadius: 20
                    }}

                    inputStyle={{
                        fontSize: 14,
                    }}
                    lightTheme={true}
                    returnKeyType={'search'}
                    returnKeyLabel={'搜索'}
                    value={keywords}
                    onChangeText={text => {
                        setKeywords(text);
                    }}
                    onSubmitEditing={props.onSubmit}
                    clearButtonMode={"while-editing"}
                    clearTextOnFocus={true}
                />
            )}
            centerContainerStyle={{flexDirection: "row", paddingHorizontal: 10}}
            leftContainerStyle={{flex: 0}}
            rightContainerStyle={{flex: 0}}
            containerStyle={{
                borderBottomColor: Colors.primary,
                borderBottomWidth: 0,
            }}
            leftComponent={
                <View style={{
                    alignItems: 'center',
                    justifyContent: 'center',
                    marginRight: 5,
                    flex: 1
                }}>
                    <Icon
                        name={'chevron-thin-left'}
                        color={'#666'}
                        size={22}
                        suppressHighlighting={true}
                        onPress={() => {
                            navigation.goBack();
                        }}
                    />
                </View>
            }
        >
        </Header>
    )
}

export default class Search extends React.Component {

    setNavigation() {
        let {keywords} = this.state;
        let {navigation, route} = this.props;
        navigation.setOptions({
            header: () => (
                <SearchHeader
                    onSubmit={event => {
                        let q = event.nativeEvent.text;
                        if (q) {
                            AsyncStorage.getItem('searchHistory').then((res) => {
                                let dataList = res ? JSON.parse(res) : [];
                                if (dataList.indexOf(q) === -1) {
                                    dataList.push(q);
                                    AsyncStorage.setItem('searchHistory', JSON.stringify(dataList));
                                }
                            });

                            navigation.navigate('product-list', {q});
                        }
                    }}
                />
            )
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            dataList: [],
            keywords: ''
        };
    }

    componentDidMount(): void {
        this.setNavigation();
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();

            AsyncStorage.getItem('searchHistory').then((res) => {
                let dataList = res ? JSON.parse(res) : [];
                this.setState({dataList});
            });
        });
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render(): React.ReactNode {
        let {dataList, keywords} = this.state;
        let {navigation} = this.props;
        return (
            <SafeAreaView style={{flex: 1, backgroundColor: '#fff'}}>
                <ScrollView style={styles.scrollView}>
                    <View style={styles.headerWrap}>
                        <Text style={styles.headerTitle}>搜索历史</Text>
                    </View>
                    <View style={styles.historyContainer}>
                        {
                            dataList.map((keyword, index) => (
                                <TouchableOpacity
                                    key={index.toString()}
                                    activeOpacity={1}
                                    style={styles.historyTouch}
                                    onPress={() => {
                                        navigation.navigate('product-list', {q: keyword});
                                    }}
                                >
                                    <Text style={styles.historyText}>{keyword}</Text>
                                </TouchableOpacity>
                            ))
                        }
                    </View>
                </ScrollView>
            </SafeAreaView>
        );
    }

}


const styles = StyleSheet.create({
    scrollView: {
        flex: 1,
        padding: 20
    },
    headerTitle: {
        fontSize: 16,
        fontWeight: '600',
        color: '#666'
    },
    headerWrap: {
        marginBottom: 10
    },
    historyContainer: {
        flexDirection: 'row',
        flexWrap: 'wrap'
    },
    historyTouch: {
        backgroundColor: '#f5f5f5',
        borderRadius: 15,
        paddingVertical: 5,
        paddingHorizontal: 10,
        marginRight: 15,
        marginBottom: 15
    },
    historyText: {
        fontSize: 14,
        color: '#666'
    }
})
