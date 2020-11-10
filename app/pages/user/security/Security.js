import React from 'react';
import {View} from 'react-native';
import {connect} from 'react-redux';
import {TableCellGroup, TableCell} from "react-native-dsxui";
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
                <TableCellGroup>
                    <TableCell
                        title={"修改密码"}
                        isLink={true}
                        onPress={() => navigation.navigate('EditPass')}
                    />
                    <TableCell
                        title={"手机号"}
                        detail={mobile ? '已绑定' : '未绑定'}
                        isLink={true}
                        onPress={() => navigation.navigate('EditMobile')}
                    />
                    <TableCell
                        title={"邮箱"}
                        isLink={true}
                        detail={email ? '已绑定' : '未绑定'}
                        onPress={() => navigation.navigate('EditEmail')}
                    />
                </TableCellGroup>
            </View>
        );
    }
}

const mapStateToProps = (store) => {
    return {auth: store.auth};
};

export default connect(mapStateToProps)(Security);
