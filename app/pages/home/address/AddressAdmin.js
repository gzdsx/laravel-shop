import React from 'react';
import {FlatList, View, Text, TouchableOpacity, Alert, StyleSheet, DeviceEventEmitter} from 'react-native';
import {LoadingView, Ticon, Toast} from "react-native-gzdsx-elements";
import {ApiClient} from "../../../utils";
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {ButtonStyles, Colors, StatusBarStyles} from "../../../styles";
import {Button, ListItem} from "react-native-elements";
import {SafeFooter} from "../../../components/SafeView";

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

export default class AddressAdmin extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            loading: true,
            refreshing: false,
            dataList: []
        };
    }

    fetchData = () => {
        ApiClient.get('/user/address.getList').then(response => {
            this.setState({
                loading: false,
                refreshing: false,
                dataList: response.result.items
            });
        });
    };

    onRefresh = () => {
        this.setState({refreshing: true}, () => {
            setTimeout(this.fetchData, 500);
        });
    }

    componentDidMount() {
        const {navigation} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '管理收货地址',
        });
        this.unsubscribe = navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
            this.fetchData();
        });
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render() {
        let {loading, refreshing, dataList} = this.state;
        if (loading) return <LoadingView/>;
        return (
            <View style={{flex: 1}}>
                <FlatList
                    data={dataList}
                    renderItem={this.renderItem}
                    keyExtractor={(item, index) => index.toString()}
                    ItemSeparatorComponent={() => <View style={{height: 10}}/>}
                    refreshing={refreshing}
                    onRefresh={this.onRefresh}
                />
                <View style={{backgroundColor: '#fff'}}>
                    <View style={{padding: 6}}>
                        <Button
                            title={'添加新地址'}
                            buttonStyle={ButtonStyles.primary}
                            onPress={() => {
                                this.props.navigation.navigate('address-edit');
                            }}
                        />
                    </View>
                    <SafeFooter/>
                </View>
            </View>
        );
    }

    renderItem = ({item, index}) => {
        const address = item;
        return (
            <View style={{backgroundColor: '#fff'}}>
                <ListItem
                    containerStyle={styles.addressContainer}
                    onPress={() => {
                        let choose = this.props.route.params?.choose;
                        if (choose) {
                            DeviceEventEmitter.emit('onChooseAddress', address);
                            this.props.navigation.goBack();
                        }
                    }}
                >
                    <ListItem.Content>
                        <View style={{flexDirection: 'row'}}>
                            <Text style={styles.addressName}>{address.name}</Text>
                            <Text style={styles.addressPhone}>{address.phone}</Text>
                        </View>
                        <Text style={styles.addressDetail} numberOfLines={2}>{address.formatted_address}</Text>
                    </ListItem.Content>
                </ListItem>
                <ListItem>
                    <ListItem.Content>
                        <ListItem.CheckBox
                            iconType={'octicon'}
                            checkedIcon={'check-circle-fill'}
                            uncheckedIcon={'circle'}
                            checkedColor={Colors.primary}
                            size={20}
                            title={'设为默认'}
                            textStyle={styles.checkBoxTitle}
                            checked={address.isdefault === 1}
                            onPress={() => {
                                const {id} = address;
                                ApiClient.post('/user/address.setDefault', {id}).then(() => {
                                    this.fetchData();
                                });
                            }}
                        />
                    </ListItem.Content>
                    <View style={{justifyContent: 'center', flexDirection: 'row'}}>
                        <ActionButton name={"edit-light"} text={"编辑"} onPress={() => {
                            const {id} = address;
                            this.props.navigation.navigate('address-edit', {id});
                        }}/>
                        <View style={{width: 5}}/>
                        <ActionButton name={"delete-light"} text={"删除"} onPress={() => {
                            this.deleteAddress(address.id, index);
                        }}/>
                    </View>
                </ListItem>
            </View>
        );
    };

    deleteAddress = (id, index) => {
        Alert.alert(null, '确认要删除此地址吗?', [
            {
                text: '取消', onPress: () => {
                }
            },
            {
                text: '确定',
                onPress: () => {
                    ApiClient.post('/user/address.delete', {id}).then(response => {
                        let {dataList} = this.state;
                        dataList.splice(index, 1);
                        this.setState({dataList});
                    }).catch(reason => {
                        Toast.fail(reason.errMsg);
                    });
                }
            }
        ]);
    }
}


const styles = StyleSheet.create({
    flexCenter: {},
    addressContainer: {
        borderBottomWidth: 0.5,
        borderBottomColor: '#f2f2ef',
        paddingVertical: 20
    },
    addressName: {
        fontSize: 16,
        color: '#333',
        marginRight: 10
    },
    addressPhone: {
        fontSize: 16, color: '#333'
    },
    addressDetail: {
        marginTop: 10,
        fontSize: 14,
        color: '#737373'
    },
    actionBar: {
        paddingVertical: 10
    },
    checkBoxTitle: {
        fontWeight: '400'
    },
})
