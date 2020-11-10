import React from 'react';
import {View} from 'react-native';
import {WebView} from "react-native-webview";
import {connect} from "react-redux";
import {LoadingView} from "react-native-dsxui";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {BaseUri} from "../../base/constants";

class NotificationDetail extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '消息通知',
    });

    constructor(props) {
        super(props);
        this.state = {
        }
    }

    render() {
        const aid = this.props.navigation.getParam('aid',0);
        const url = BaseUri + '/post/detail/' + aid + '.html';
        return (
            <View style={{flex: 1}}>
                <WebView
                    source={{uri: url}}
                    renderError={() => <View/>}
                    renderLoading={() => <LoadingView/>}
                    decelerationRate={"normal"}
                />
            </View>
        );
    }


    componentDidMount() {

    }
}

const mapStateToProps = (store) => {
    return {
        auth: store.auth
    };
};

export default connect(mapStateToProps)(NotificationDetail);
