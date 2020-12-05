import React from 'react';
import {View, Image, ScrollView, DeviceEventEmitter, TouchableOpacity, Text} from 'react-native';
import {bindActionCreators} from 'redux';
import {connect,} from "react-redux";
import ActionSheet from 'react-native-actionsheet'
import ImagePicker from 'react-native-image-picker';
import {LoadingView, Spinner, TableView, TableCell} from "react-native-gzdsx-elements";
import {UserDidSignoutedNotification} from "../../../base/constants";
import {Utils, ApiClient} from "../../../utils";
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {authActionCreators, locationActionCreators} from "../../../actions";
import {Colors} from "../../../styles";

class MyProfile extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            userinfo: null,
            isLoading: true,
            uploading: false
        };
    }

    render() {
        const {userinfo} = this.state;
        const {navigation} = this.props;
        if (this.state.isLoading) return <LoadingView/>;
        return (
            <View style={{flex: 1}}>
                <ScrollView style={{flex: 1}}>
                    <TableView>
                        <TableCell onPress={this.pickImage}>
                            <TableCell.Title title={"头像"}/>
                            <View style={{alignItems: 'center', justifyContent: 'center'}}>
                                <Image
                                    source={{uri: userinfo.avatar}}
                                    style={{
                                        width: 50,
                                        height: 50,
                                        borderRadius: 10
                                    }}
                                />
                            </View>
                            <TableCell.Accessory/>
                        </TableCell>
                        <TableCell>
                            <TableCell.Title title={"账号"}/>
                            <TableCell.Detail text={userinfo.username}/>
                            <TableCell.Accessory/>
                        </TableCell>
                        <TableCell onPress={() => this.ActionSheet.show()}>
                            <TableCell.Title title={"性别"}/>
                            <TableCell.Detail text={userinfo.gender ? '男' : '女'}/>
                            <TableCell.Accessory/>
                        </TableCell>
                        <TableCell onPress={() => navigation.navigate('DistrictSelector')}>
                            <TableCell.Title title={"所在地"}/>
                            <TableCell.Detail text={[userinfo.province, userinfo.city, userinfo.district].join(' ')}/>
                            <TableCell.Accessory/>
                        </TableCell>
                    </TableView>
                </ScrollView>
                <TouchableOpacity
                    activeOpacity={1}
                    style={{
                        height: 45,
                        flexDirection: 'column',
                        alignItems: 'center',
                        justifyContent: 'center',
                        backgroundColor: Colors.primary
                    }}
                    onPress={this.logout}
                >
                    <Text style={{color: '#fff', fontSize: 16}}>退出当前账号</Text>
                </TouchableOpacity>
                <ActionSheet
                    ref={o => this.ActionSheet = o}
                    options={['女', '男', '取消']}
                    cancelButtonIndex={2}
                    onPress={(index) => {
                        ApiClient.post('/user/update', {
                            userinfo: {
                                gender: index
                            }
                        }).then(response => {
                            let {userinfo} = this.state;
                            userinfo.gender = index;
                            this.setState({userinfo});
                        });
                    }}
                />
                <Spinner show={this.state.uploading}/>
            </View>
        );
    }


    componentDidMount() {
        const {navigation} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '个人资料',
        });

        ApiClient.get('/user/info').then(response => {
            //console.log(response);
            const {userinfo} = response.data;
            if (userinfo) {
                this.setState({
                    userinfo,
                    isLoading: false
                });
            } else {
                this.logout();
            }
        });

        DeviceEventEmitter.addListener('onPickedDistrict', (dist) => {
            let {userinfo} = this.state;
            let {province, city, district} = dist;
            userinfo = {
                ...userinfo,
                province,
                city,
                district
            };
            this.setState({
                userinfo
            }, () => {
                ApiClient.post('/user/update', {info: {province, city, district}});
            });
        });

        this.listner = this.props.navigation.addListener('willFocus', () => Utils.setStatusBarStyle('light'));
    }

    componentWillUnmount() {
        DeviceEventEmitter.removeAllListeners('onPickedDistrict');
        this.props.navigation.removeListener('willFocus');
    }

    logout = () => {
        DeviceEventEmitter.emit(UserDidSignoutedNotification);
        this.props.navigation.goBack();
    };

    pickImage = () => {
        Utils.setStatusBarStyle();
        ImagePicker.showImagePicker({
            title: '设置头像',
            takePhotoButtonTitle: '拍照',
            chooseFromLibraryButtonTitle: '从相册选择',
            cancelButtonTitle: '取消',
            maxWidth: 1200,
            maxHeight: 1200,
            tintColor: '#666'
        }, response => {
            Utils.setStatusBarStyle('light');
            if (response.didCancel || response.error) {
                return false;
            }

            this.setState({uploading: true});
            ApiClient.upload('/user/avatar', {
                uri: response.uri,
                name: response.fileName
            }).then(res => {
                //console.log(res.data);
                let {userinfo} = this.state;
                userinfo.avatar = res.data.avatar;
                DeviceEventEmitter.emit(UserDidLoggedInNotification, userinfo);
                this.setState({
                    userinfo,
                    uploading: false
                });
            }).catch(error => {
                this.setState({uploading: false});
            });
        });
    };
}

const mapDispatchToProps = (dispatch) => {
    const authActions = bindActionCreators(authActionCreators, dispatch);
    const locationActions = bindActionCreators(locationActionCreators, dispatch);
    return {
        authActions,
        locationActions
    }
};

export default connect(mapDispatchToProps)(MyProfile);
