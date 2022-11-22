import React from 'react';
import {Switch, SafeAreaView, StyleSheet} from 'react-native';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Colors, StatusBarStyles} from "../../styles";
import {ListItem} from "react-native-elements";

export default class NoticeSet extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            serviceAble: true,
            systemAble: true
        }
    }

    componentDidMount() {
        let {navigation} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '消息及提醒设置',
        });
        this.unsubsctibe = navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });
    }

    componentWillUnmount() {
        this.unsubsctibe();
    }

    render() {
        return (
            <SafeAreaView style={{flex: 1, backgroundColor: '#f2f2f2'}}>
                <ListItem containerStyle={styles.row}>
                    <ListItem.Content>
                        <ListItem.Title>业务通知</ListItem.Title>
                    </ListItem.Content>
                    <Switch
                        value={this.state.serviceAble}
                        onValueChange={(value) => this.setState({serviceAble: value})}
                    />
                </ListItem>
                <ListItem>
                    <ListItem.Content>
                        <ListItem.Title>系统消息</ListItem.Title>
                    </ListItem.Content>
                    <Switch
                        value={this.state.systemAble}
                        onValueChange={(value) => this.setState({systemAble: value})}
                        tintColor={Colors.primary}
                    />
                </ListItem>
            </SafeAreaView>
        );
    }

}

const styles = StyleSheet.create({
    row: {
        borderBottomWidth: 0.5,
        borderBottomColor: '#f2f2f2'
    }
})
