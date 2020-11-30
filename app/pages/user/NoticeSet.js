import React from 'react';
import {View, ScrollView, Switch} from 'react-native';
import {TableCellGroup, TableCell} from "react-native-dsxui";
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
                <TableCellGroup>
                    <TableCell
                        title={"业务通知"}
                        detailComponent={()=>{
                            return (
                                <View style={{alignItems:'center',justifyContent:'center'}}>
                                    <Switch
                                        value={this.state.serviceAble}
                                        onValueChange={(value) => this.setState({serviceAble: value})}
                                    />
                                </View>
                            )
                        }}
                    />
                    <TableCell
                        title={"系统消息"}
                        detailComponent={()=>{
                            return (
                                <Switch
                                    value={this.state.systemAble}
                                    onValueChange={(value) => this.setState({systemAble: value})}
                                    tintColor={Colors.primary}
                                />
                            )
                        }}
                    />
                </TableCellGroup>
            </ScrollView>
        );
    }

}
