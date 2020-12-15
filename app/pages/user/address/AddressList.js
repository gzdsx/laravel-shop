import React from 'react';
import {FlatList, View, Text, TouchableOpacity, Alert} from 'react-native';
import {LoadingView, Ticon, CheckBox} from "react-native-gzdsx-elements";
import {Utils, ApiClient} from "../../../utils";
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {Colors} from "../../../styles";

const ActionButton = ({name, text, color = "#666", onPress = () => null}) => {
    return (
        <TouchableOpacity activeOpacity={1} onPress={onPress}>
            <View style={{flexDirection: 'row'}}>
                <Ticon name={name} size={20} color={color}/>
                <Text style={{
                    fontSize: 12,
                    color: '#333',
                    lineHeight: 20,
                    marginLeft: 3
                }}>{text}</Text>
            </View>
        </TouchableOpacity>
    );
};

export default class AddressList extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            isRefreshing: false,
            items: []
        };
    }

    render() {
        if (this.state.isLoading) return <LoadingView/>;
        return (
            <View style={{flex: 1}}>
                <FlatList
                    data={this.state.items}
                    renderItem={this.renderItem}
                    keyExtractor={(item) => item.address_id.toString()}
                    ItemSeparatorComponent={() => <View style={{height: 10}}/>}
                    refreshing={this.state.isRefreshing}
                    onRefresh={() => {
                        this.setState({isRefreshing: true});
                        setTimeout(() => this.fetchData(), 500);
                    }}
                />
                <View style={{
                    backgroundColor: '#fff',
                    padding: 10
                }}>
                    <TouchableOpacity
                        style={{
                            backgroundColor: '#FC461E',
                            borderRadius: 20,
                            overflow: 'hidden'
                        }}
                        activeOpacity={0.9}
                        onPress={() => {
                            this.props.navigation.navigate('AddressEdit');
                        }}
                    >
                        <Text style={{
                            fontSize: 16,
                            color: '#fff',
                            padding: 13,
                            textAlign: 'center',
                            textAlignVertical: 'center'
                        }}>添加新地址</Text>
                    </TouchableOpacity>
                </View>
            </View>
        );
    }

    componentDidMount() {
        const {navigation} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '管理收货地址',
        });
        navigation.addListener('focus',this.fetchData);
    }

    componentWillUnmount() {
        this.props.navigation.removeListener('focus');
    }

    fetchData = () => {
        ApiClient.get('/address/batchget').then(response => {
            this.setState({
                isLoading: false,
                isRefreshing: false,
                items: response.data.items
            });
        });
    };

    renderItem = ({item, index}) => {
        const address = item;
        return (
            <View>
                <TouchableOpacity
                    activeOpacity={1}
                    onPress={() => {
                        const callback = this.props.route.params?.callback;
                        if (typeof callback === 'function') {
                            callback(address);
                            this.props.navigation.goBack();
                        }
                    }}
                    style={{
                        backgroundColor: '#fff',
                        borderBottomColor: '#e5e5e5',
                        borderBottomWidth: 0.5,
                        paddingHorizontal: 12,
                        paddingVertical: 15
                    }}>
                    <View style={{flexDirection: 'row'}}>
                        <Text style={{
                            fontSize: 16,
                            color: '#333',
                            flex: 1
                        }}>{address.name}</Text>
                        <Text style={{
                            fontSize: 16,
                            color: '#333',
                        }}>{address.tel}</Text>
                    </View>
                    <Text style={{
                        marginTop: 5,
                        fontSize: 14,
                        color: '#333'
                    }} numberOfLines={2}>
                        {address.full_address}
                    </Text>
                </TouchableOpacity>
                <View style={{
                    padding: 10,
                    flexDirection: 'row',
                    backgroundColor: '#fff'
                }}>
                    <CheckBox
                        size={20}
                        checked={address.isdefault === 1}
                        title={"设为默认"}
                        titleStyle={{fontSize: 12}}
                        onPress={() => {
                            const {address_id} = address;
                            ApiClient.post('/address/setdefault', {address_id}).then(response => {
                                this.fetchData();
                            });
                        }}
                    />
                    <View style={{flex: 1}}/>
                    <View style={{flexDirection: 'row'}}>
                        <ActionButton name={"edit-light"} text={"编辑"} onPress={() => {
                            const {address_id} = address;
                            this.props.navigation.navigate('AddressEdit', {address_id});
                        }}/>
                        <View style={{width: 5}}/>
                        <ActionButton name={"delete-light"} text={"删除"} onPress={() => {
                            this.deleteAddress(address.address_id, index);
                        }}/>
                    </View>
                </View>
            </View>
        );
    };

    deleteAddress = (address_id, index) => {
        Alert.alert(null, '确认要删除此地址吗?', [
            {
                text: '取消', onPress: () => {
                }
            },
            {
                text: '确定',
                onPress: () => {
                    ApiClient.post('/address/delete', {
                        address_id
                    }).then(response => {
                        let items = [];
                        this.state.items.map((item, i) => {
                            if (i !== index) {
                                items.push(item);
                            }
                        });
                        this.setState({items});
                    });
                }
            }
        ]);
    }
}
