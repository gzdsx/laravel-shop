import React from 'react';
import {
    Image,
    ScrollView,
    DeviceEventEmitter,
    TouchableOpacity,
    Text,
    SafeAreaView,
    StyleSheet
} from 'react-native';
import {connect,} from "react-redux";
import ActionSheet from 'react-native-actionsheet'
import {launchImageLibrary} from 'react-native-image-picker';
import {Spinner, Toast} from "react-native-gzdsx-elements";
import {UserDidSignoutedNotification} from "../../base/constants";
import {ApiClient} from "../../utils";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Colors, StatusBarStyles} from "../../styles";
import {ListItem} from "react-native-elements";
import {userDidChanged} from "../../actions/user";

class UserProfile extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            userinfo: null,
            uploading: true
        };
    }

    componentDidMount() {
        const {navigation} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '个人资料',
        });
        this.unsubscribe = navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });

        this.listener = DeviceEventEmitter.addListener('onChooseLocation', (res) => {
            let {province, city, district, street} = res;
            ApiClient.post('/user/profile.update', {
                profile: {
                    province,
                    city,
                    district,
                    street
                }
            }).then(() => {
                this.props.dispatch(userDidChanged());
            });
        });
    }

    componentWillUnmount() {
        this.unsubscribe();
        this.listener.remove();
    }

    render() {
        const {navigation, userInfo} = this.props;
        return (
            <SafeAreaView style={{flex: 1}}>
                <ScrollView style={{flex: 1}}>
                    <ListItem containerStyle={styles.row} onPress={this.pickImage}>
                        <ListItem.Content>
                            <ListItem.Title style={styles.title}>头像</ListItem.Title>
                        </ListItem.Content>
                        <Image
                            source={{uri: userInfo.avatar}}
                            style={{
                                width: 50,
                                height: 50,
                                borderRadius: 10
                            }}
                        />
                        <ListItem.Chevron/>
                    </ListItem>
                    <ListItem containerStyle={styles.row}>
                        <ListItem.Content>
                            <ListItem.Title style={styles.title}>昵称</ListItem.Title>
                        </ListItem.Content>
                        <ListItem.Subtitle style={styles.subTitle}>{userInfo.nickname}</ListItem.Subtitle>
                        <ListItem.Chevron/>
                    </ListItem>
                    <ListItem containerStyle={styles.row} onPress={() => this.ActionSheet.show()}>
                        <ListItem.Content>
                            <ListItem.Title style={styles.title}>性别</ListItem.Title>
                        </ListItem.Content>
                        <ListItem.Subtitle style={styles.subTitle}>{userInfo.gender ? '男' : '女'}</ListItem.Subtitle>
                        <ListItem.Chevron/>
                    </ListItem>
                    <ListItem containerStyle={[styles.row, {borderBottomWidth: 0}]}
                              onPress={() => navigation.navigate('choose-location')}>
                        <ListItem.Content>
                            <ListItem.Title style={styles.title}>所在地</ListItem.Title>
                        </ListItem.Content>
                        <ListItem.Subtitle
                            style={styles.subTitle}>{[userInfo.province, userInfo.city, userInfo.district].join(' ')}</ListItem.Subtitle>
                        <ListItem.Chevron/>
                    </ListItem>
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
                        if (index < 2) {
                            ApiClient.post('/user/profile.update', {
                                profile: {
                                    gender: index
                                }
                            }).then(() => {
                                this.props.dispatch(userDidChanged());
                            });
                        }
                    }}
                />
            </SafeAreaView>
        );
    }

    logout = () => {
        DeviceEventEmitter.emit(UserDidSignoutedNotification);
        this.props.navigation.goBack();
    };

    pickImage = () => {
        launchImageLibrary({
            mediaType: 'photo',
            maxWidth: 1000
        }, response => {
            console.log(response);
            if (response.didCancel) {
                return false
            }

            if (response.errorCode) {
                Toast.fail(response.errorMessage);
                return false;
            }

            let {fileName, uri} = response.assets[0];
            Spinner.show('正在上传图片', {showModal: true});
            ApiClient.upload('/common/material.upload?type=image&width=500&fit=true', {
                uri,
                name: fileName
            }).then(res => {
                Spinner.hide();
                let {image} = res.result;
                ApiClient.post('/user/info.updateAvatar', {avatar: image}).then(() => {
                    this.props.dispatch(userDidChanged())
                });
            }).catch(reason => {
                Spinner.hide();
                Toast.fail(reason.errMsg);
            })
        });
    };
}

const mapStateToProps = state => {
    return state;
}

export default connect(mapStateToProps)(UserProfile);

const styles = StyleSheet.create({
    row: {
        borderBottomWidth: 0.5,
        borderBottomColor: '#f0f0f0',
        paddingVertical: 20
    },
    title: {
        fontSize: 16,
        color: '#333'
    },
    subTitle: {
        fontSize: 14,
        color: '#838383'
    }
})
