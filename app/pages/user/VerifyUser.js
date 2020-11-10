import React from 'react';
import {View} from 'react-native';
import {LoadingView, TableCell} from "react-native-dsxui";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";
import {CustomButton} from "../../components";

export default class VerifyUser extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '审核用户',
    });

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            user: null
        };
    }


    render(): React.ReactNode {
        if (this.state.isLoading) return <LoadingView/>;
        const user = this.state.user;
        return (
            <View>
                <TableCell
                    title={"用户名"}
                    detail={user.username}
                />
                <TableCell
                    title={"手机号"}
                    detail={user.mobile}
                />
                <TableCell
                    title={"学校"}
                    detail={user.shoool && user.shoool.title}
                />
                <TableCell
                    title={"班级"}
                    detail={user.classes && user.classes.title}
                />
                <TableCell
                    title={"学生姓名"}
                    detail={user.student && user.student.name}
                />

                <View style={{marginTop: 50, padding: 15}}>
                    <CustomButton text={"通过审核"} onPress={() => {
                        ApiClient.post('/user/verify/verify',{uid:user.uid}).then(response=>{
                            this.props.route.params?.callback();
                            this.props.navigation.goBack();
                        }).catch(reason => {

                        });
                    }}/>
                </View>
            </View>
        );
    }

    componentDidMount(): void {
        ApiClient.get('/user/verify/get', {uid: this.props.navigation.getParam('uid', 0)}).then(response => {
            const user = response.data.user;
            this.setState({
                user,
                isLoading: false
            });
        });
    }
}
