import React from 'react';
import {View} from 'react-native';
import {connect} from "react-redux";
import {WebView} from 'react-native-webview';
import {Ticon} from 'react-native-ticon';
import {LoadingView} from "react-native-dsxui";
import {Styles, Colors} from '../../styles';
import {ShareView, BarItemSeparate} from '../../components';
import {ApiClient, Utils, Toast} from '../../utils';
import {BaseUri} from '../../base/constants';
import {defaultNavigationConfigure} from "../../base/navconfig";


class PostDetail extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '文章正文',
            headerRight: () => (
                <View style={Styles.headerRight}>
                    <Ticon
                        name={"share-squar-light"}
                        size={28}
                        color={"#fff"}
                        onPress={() => {
                            this.setState({showShare: true});
                        }}
                    />
                    <BarItemSeparate/>
                    <Ticon
                        name={"favor-light"}
                        color={"#fff"}
                        size={28}
                        onPress={() => {
                            if (this.props.auth.isSignined) {
                                const aid = route.params?.aid;
                                ApiClient.post('/post/collect/create', {aid}).then(response => {
                                    console.log(response.data);
                                    Toast.show('已成功加入收藏夹');
                                });
                            } else {
                                navigation.navigate('Signin');
                            }
                        }}
                    />
                </View>
            )
        })
    }

    constructor(props) {
        super(props);
        this.state = {
            showShare: false,
            shareMessage: {},
            post: {}
        }
    }

    render() {
        return (
            <View style={{flex: 1}}>
                <WebView
                    source={{uri: this.state.post.m_url}}
                    renderError={() => <View/>}
                    renderLoading={() => <LoadingView/>}
                    onMessage={this.handlerMessage}
                    decelerationRate={"normal"}
                />
                <ShareView show={this.state.showShare} shareMessage={this.state.shareMessage}/>
            </View>
        );
    }

    componentDidMount() {
        this.setNavigationOptions();
        const aid = this.props.route.params?.aid;
        ApiClient.get('/post/get', {aid}).then(response => {
            this.setState({post: response.data.post});
        })
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
