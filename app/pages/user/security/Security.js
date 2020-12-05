import React from 'react';
import {View} from 'react-native';
import {connect} from 'react-redux';
import {TableView, TableCell} from "react-native-gzdsx-elements";
import {defaultNavigationConfigure} from "../../../base/navconfig";

class Security extends React.Component {
    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '账号安全',
    });

    constructor(props) {
        super(props);
    }

    render() {
        const {navigation, auth} = this.props;
        const {mobile, email} = auth.userinfo;
        return (
            <View style={{flex: 1}}>
                <TableView>
                    <TableCell onPress={() => navigation.navigate('EditPass')}>
                        <TableCell.Title title={"修改密码"}/>
                        <TableCell.Accessory/>
                    </TableCell>
                    <TableCell onPress={() => navigation.navigate('EditMobile')}>
                        <TableCell.Title title={"手机号"}/>
                        <TableCell.Detail text={mobile ? '已绑定' : '未绑定'}/>
                        <TableCell.Accessory/>
                    </TableCell>
                    <TableCell onPress={() => navigation.navigate('EditEmail')}>
                        <TableCell.Title title={"邮箱"}/>
                        <TableCell.Detail text={email ? '已绑定' : '未绑定'}/>
                        <TableCell.Accessory/>
                    </TableCell>
                </TableView>
            </View>
        );
    }
}

const mapStateToProps = (store) => {
    return {...store};
};

export default connect(mapStateToProps)(Security);
