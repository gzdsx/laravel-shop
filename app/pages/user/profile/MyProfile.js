import React from 'react';
import {View, Image, ScrollView, DeviceEventEmitter} from 'react-native';
import {bindActionCreators} from 'redux';
import {connect,} from "react-redux";
import ActionSheet from 'react-native-actionsheet'
import ImagePicker from 'react-native-image-picker';
import {LoadingView, Spinner, TableCellGroup, TableCell} from "react-native-dsxui";
import {UserDidLoggedInNotification, UserDidLogoutNotification, UserInfoStoreKey} from "../../../base/constants";
import {Utils, ApiClient} from "../../../utils";
import {CustomButton} from "../../../components";
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {authActionCreators, locationActionCreators} from "../../../actions";

class MyProfile extends React.Component {
    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '个人资料',
    });

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
                    <TableCellGroup>
                        <TableCell
                            title={"头像"}
                            isLink={true}
                            detailComponent={() => {
                                return (
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
                                )
                            }}
                            onPress={this.pickImage}
                        />
                        <TableCell
                            title={"账号"}
                            isLink={true}
                            detail={userinfo.username}
                        />
                        <TableCell
                            title={"性别"}
                            isLink={true}
                            detail={userinfo.gender ? '男' : '女'}
                            onPress={() => this.ActionSheet.show()}
                        />
                        <TableCell
                            title={"所在地"}
                            isLink={true}
                            detail={[userinfo.province, userinfo.city, userinfo.district].join(' ')}
                            onPress={() => navigation.navigate('DistrictSelector')}
                        />
                    </TableCellGroup>
                </ScrollView>
                <View>
                    <CustomButton type={"danger"} text={"退出当前账号"} onPress={this.logout} style={{borderRadius: 0}}/>
                </View>
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
            console.log(dist);
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
                ApiClient.post('/user/update', {info: {province, city, district}}).then(response => {

                });
            });
        });

        this.listner = this.props.navigation.addListener('willFocus', () => Utils.setStatusBarStyle('light'));
    }

    componentWillUnmount() {
        DeviceEventEmitter.removeAllListeners('onPickedDistrict');
        this.listner.remove();
    }

    logout = () => {
        DeviceEventEmitter.emit(UserDidLogoutNotification);
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
                    uploading:false
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
        authActions
    }
};

export default connect(mapDispatchToProps)(MyProfile);
