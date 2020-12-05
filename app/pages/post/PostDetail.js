import React from 'react';
import {TouchableOpacity, View} from 'react-native';
import {connect} from "react-redux";
import {WebView} from 'react-native-webview';
import {Ticon, Toast} from "react-native-gzdsx-elements";
import {Styles} from '../../styles';
import {ShareView, BarItemSeparate} from '../../components';
import {ApiClient} from '../../utils';
import {defaultNavigationConfigure} from "../../base/navconfig";


class PostDetail extends React.Component {

    setNavigationOptions() {
        const {navigation, route, auth} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '正文',
            headerRight: () => (
                <View style={Styles.headerRight}>
                    <TouchableOpacity
                        onPress={() => {
                            this.setState({showShare: true});
                        }}
                        activeOpacity={1}
                    >
                        <Ticon name={"share-squar-light"} size={28} color={"#fff"}/>
                    </TouchableOpacity>
                    <BarItemSeparate/>
                    <TouchableOpacity
                        onPress={() => {
                            if (auth.isSignined) {
                                const aid = route.params?.aid;
                                ApiClient.post('/post/collect/create', {aid}).then(response => {
                                    this.refs.toast.show('已成功加入收藏夹');
                                });
                            } else {
                                navigation.navigate('Signin');
                            }
                        }}
                        activeOpacity={1}
                    >
                        <Ticon name={"favor-light"} color={"#fff"} size={28}/>
                    </TouchableOpacity>
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
                    //renderLoading={() => <LoadingView/>}
                    onMessage={this.handlerMessage}
                    decelerationRate={"normal"}
                />
                <ShareView show={this.state.showShare} shareMessage={this.state.shareMessage}/>
                <Toast ref={"toast"}/>
            </View>
        );
    }

    componentDidMount() {
        this.setNavigationOptions();
        const aid = this.props.route.params?.aid;
        ApiClient.get('/post/get', {aid}).then(response => {
            const {post} = response.data;
            this.setState({
                post,
                shareMessage: {
                    type: 'news',
                    title: post.title,
                    description: post.summary,
                    thumbImage: post.image || '',
                    webpageUrl: post.m_url
                }
            });
        })
    }

    handlerMessage = (event: any) => {
        const res = JSON.parse(event.nativeEvent.data);
        if (res.event === 'shareTo') {
            //console.log(event.nativeEvent);
            this.setState({showShare: true});
        }

        if (res.event === 'onPressItem') {
            //console.log(event.nativeEvent);
            this.props.navigation.push('PostDetail', {aid: res.aid});
        }
    }
}

const mapStateToProps = (store) => {
    return {auth: store.auth};
};

export default connect(mapStateToProps)(PostDetail);
