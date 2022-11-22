import React from 'react';
import {FlatList, View, DeviceEventEmitter, SafeAreaView} from 'react-native';
import {LoadingView, Toast} from 'react-native-gzdsx-elements';
import {ListItem} from 'react-native-elements';
import {ApiClient} from '../../utils';
import {defaultNavigationConfigure} from '../../base/navconfig';

export default class DistrictSelector extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            loading: true,
            dataList: [],
        };
        this.district = {
            province: null,
            city: null,
            district: null,
        };
        this.level = 1;
    }


    render() {
        if (this.state.loading) {
            return <LoadingView/>;
        }
        return (
            <SafeAreaView style={{flex: 1, backgroundColor: '#fff'}}>
                <FlatList
                    style={{flex: 1, backgroundColor: '#fff'}}
                    data={this.state.dataList}
                    renderItem={({item}) => {
                        return (
                            <ListItem
                                bottomDivider
                                containerStyle={{
                                    borderBottomWidth: 0.5,
                                    borderBottomColor: '#f9f9f9',
                                    paddingVertical: 18
                                }}
                                onPress={() => this.onPickedDistrict(item)}
                            >
                                <ListItem.Content>
                                    <ListItem.Title>{item.name}</ListItem.Title>
                                </ListItem.Content>
                                <ListItem.Chevron/>
                            </ListItem>
                        );
                    }}
                    keyExtractor={(item) => item.id.toString()}
                    ItemSeparatorComponent={() => <View style={{height: 0.5, backgroundColor: '#e5e5e5'}}/>}
                />
            </SafeAreaView>
        );
    }


    componentDidMount() {
        this.fetchDatasource(0);
        const {navigation} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '选择区域',
        });
    }

    fetchDatasource = (parent_id) => {
        ApiClient.get('/district/list', {parent_id}).then(response => {
            this.setState({
                loading: false,
                dataList: response.result.items,
            });
        }).catch(reason => {
            Toast.fail(reason.errMsg);
        });
    };

    onPickedDistrict = (item) => {
        if (this.level === 1) {
            this.district.province = item.name;
            this.fetchDatasource(item.id);
            this.level = 2;
            return;
        }

        if (this.level === 2) {
            this.district.city = item.name;
            this.fetchDatasource(item.id);
            this.level = 3;
            return;
        }

        if (this.level === 3) {
            this.district.district = item.name;
            DeviceEventEmitter.emit('onChooseDistrict', this.district);
            this.props.navigation.goBack();
        }
    }
}
