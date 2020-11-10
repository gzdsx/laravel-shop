import React from 'react';
import {View} from 'react-native';
import {connect} from "react-redux";
import {WebView} from 'react-native-webview';
import {Ticon} from 'react-native-ticon';
import {Styles, Colors} from '../../styles';
import {ShareView, BarItemSeparate} from '../../components';
import {ApiClient, Utils, Toast} from '../../utils';
import {BaseUri} from '../../base/constants';
import {defaultNavigationConfigure} from "../../base/navconfig";

class PostDetail extends React.Component {

    static navigationOptions = ({navigation, route}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '文章正文',
        headerRight: () => (
            <View style={Styles.headerRight}>
                <Ticon name={"share-squar-light"} size={28} color={"#fff"}
                       onPress={() => route.params?.share()}/>
                <BarItemSeparate/>
                <Ticon name={"favor-light"} color={"#fff"} size={28}
                       onPress={() => route.params?.addCollection()}/>
            </View>
        )
    });

    constructor(props) {
        super(props);
        this.state = {
            showShare: false,
            shareMessage: {}
        }
    }

    render() {
        const aid = this.props.route.params?.aid;
        const url = BaseUri + '/post/' + aid + '.html';
        return (
            <View style={{flex: 1}}>
                <WebView
                    source={{uri: url}}
                    renderError={() => <View/>}
                    renderLoading={() => <Loading/>}
                    onMessage={this.handlerMessage}
                    decelerationRate={"normal"}
                />
                <ShareView show={this.state.showShare} shareMessage={this.state.shareMessage}/>
            </View>
        );
    }

    componentDidMount() {
        const aid = this.props.route.params?.aid;
        this.props.navigation.setParams({
            share: () => this.setState({showShare: true}),
            addCollection: () => {
                if (this.props.auth.isLoggedIn) {
                    ApiClient.post('/post/collect/add', {aid}).then(response => {
                        Toast.show('已成功加入收藏夹');
                    });
                } else {
                    this.props.navigation.navigate('Signin');
                }
            }
        });
    }

    handlerMessage = (event: any) => {
        console.log(event);
        const res = JSON.parse(event.nativeEvent.data);
        if (res.event === 'shareMessage') {
            this.setState({
                shareMessage: {
                    type: 'news',
                    title: res.data.title,
                    description: res.data.message,
                    thumbImage: res.data.pic,
                    webpageUrl: res.data.link
                }
            });
        }

        if (res.event === 'shareTo') {
            this.setState({showShare: true});
        }

        if (res.event === 'viewArticle') {
            this.props.navigation.navigate('PostDetail', {aid: res.aid});
        }
    }
}

const mapStateToProps = (store) => {
    return {
        auth: store.auth
    };
};

export default connect(mapStateToProps)(PostDetail);
