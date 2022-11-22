import React from 'react';
import {SafeAreaView, ScrollView, StyleSheet} from 'react-native';
import {connect} from 'react-redux';
import {defaultNavigationConfigure} from "../../../base/navconfig";
import {ListItem} from "react-native-elements";
import {StatusBarStyles} from "../../../styles";

class Security extends React.Component {

    constructor(props) {
        super(props);
    }

    componentDidMount() {
        let {navigation} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '账号安全',
        });
        this.unsubscribe = navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render() {
        const {navigation, userInfo} = this.props;
        const {phone, email} = userInfo;
        return (
            <SafeAreaView style={{flex: 1}}>
                <ScrollView style={{flex: 1}}>
                    <ListItem containerStyle={styles.row} onPress={() => navigation.navigate('resetpassword')}>
                        <ListItem.Content>
                            <ListItem.Title style={styles.title}>修改密码</ListItem.Title>
                        </ListItem.Content>
                        <ListItem.Chevron/>
                    </ListItem>
                    <ListItem containerStyle={styles.row} onPress={() => navigation.navigate('edit-phone')}>
                        <ListItem.Content>
                            <ListItem.Title style={styles.title}>手机号</ListItem.Title>
                        </ListItem.Content>
                        <ListItem.Subtitle style={styles.subTitle}>{phone ? '已绑定' : '未绑定'}</ListItem.Subtitle>
                        <ListItem.Chevron/>
                    </ListItem>
                    <ListItem containerStyle={styles.row} onPress={() => navigation.navigate('edit-email')}>
                        <ListItem.Content>
                            <ListItem.Title style={styles.title}>邮箱</ListItem.Title>
                        </ListItem.Content>
                        <ListItem.Subtitle style={styles.subTitle}>{email ? '已绑定' : '未绑定'}</ListItem.Subtitle>
                        <ListItem.Chevron/>
                    </ListItem>
                </ScrollView>
            </SafeAreaView>
        );
    }
}

const mapStateToProps = state => {
    return state;
};

export default connect(mapStateToProps)(Security);

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
