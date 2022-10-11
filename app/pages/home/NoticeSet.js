import React from 'react';
import {View, ScrollView, Switch} from 'react-native';
import {TableView, TableCell} from "react-native-gzdsx-elements";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Colors} from "../../styles";

export default class NoticeSet extends React.Component {
    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '消息及提醒设置',
    });

    constructor(props) {
        super(props);
        this.state = {
            serviceAble: true,
            systemAble: true
        }
    }

    render() {
        return (
            <ScrollView>
                <TableView>
                    <TableCell>
                        <TableCell.Title title={"业务通知"}/>
                        <View style={{alignItems: 'center', justifyContent: 'center'}}>
                            <Switch
                                value={this.state.serviceAble}
                                onValueChange={(value) => this.setState({serviceAble: value})}
                            />
                        </View>
                    </TableCell>
                    <TableCell>
                        <TableCell.Title title={"系统消息"}/>
                        <View style={{alignItems: 'center', justifyContent: 'center'}}>
                            <Switch
                                value={this.state.systemAble}
                                onValueChange={(value) => this.setState({systemAble: value})}
                                tintColor={Colors.primary}
                            />
                        </View>
                    </TableCell>
                </TableView>
            </ScrollView>
        );
    }

}
