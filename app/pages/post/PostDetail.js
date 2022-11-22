import React from 'react';
import {SafeAreaView, View} from 'react-native';
import {connect} from "react-redux";
import {WebView} from 'react-native-webview';
import {StatusBarStyles} from '../../styles';
import {ShareView} from '../../components';
import {ApiClient} from '../../utils';
import {defaultNavigationConfigure} from "../../base/navconfig";
import Icon from "react-native-vector-icons/AntDesign";
import {Toast} from "react-native-gzdsx-elements";


class PostDetail extends React.Component {

    setNavigationOptions() {
        const {navigation} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            title: '正文',
            headerRight: () => null
        })
    }

    setNavigationRight = () => {
        let {subscribe} = this.state;
        let {navigation} = this.props;
        navigation.setOptions({
            headerRight: () => (
                <View style={{flexDirection: 'row'}}>
                    <Icon
                        name={subscribe ? 'star' : 'staro'}
                        size={25}
                        color={"#333"}
                        suppressHighlighting={true}
                        onPress={this.addSubscribe}
                    />
                    <View style={{width: 10}}/>
                    <Icon
                        name={'sharealt'}
                        size={25}
                        color={"#333"}
                        suppressHighlighting={true}
                        onPress={() => {
                            this.share.show();
                        }}
                    />
                </View>
            )
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            post: {},
            subscribe: false
        }
    }

    fetchData = () => {
        const aid = this.props.route.params?.aid;
        ApiClient.get('/post/item.getInfo', {aid}).then(response => {
            const post = response.result;
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
        }).catch(reason => {
            console.log(reason);
        })
    }

    querySubscribe = () => {
        const aid = this.props.route.params?.aid;
        ApiClient.post('/post/subscribe.query', {aid}).then(response => {
            let {subscribe} = response.result;
            this.setState({subscribe}, this.setNavigationRight);
        });
    }

    componentDidMount() {
        this.setNavigationOptions();
        this.unsubscribe = this.props.navigation.addListener('focus', () => {
            StatusBarStyles.setToDarkStyle();
        });
        this.fetchData();
        this.querySubscribe();
    }

    componentWillUnmount() {
        this.unsubscribe();
    }

    render() {
        let {post} = this.state;
        return (
            <SafeAreaView style={{flex: 1}}>
                <WebView
                    source={{uri: post.m_url}}
                    renderError={() => <View/>}
                    renderLoading={() => <LoadingView/>}
                    onMessage={this.handlerMessage}
                    decelerationRate={"normal"}
                />
                <ShareView show={this.state.showShare} ref={o => this.share = o}/>
            </SafeAreaView>
        );
    }

    handlerMessage = (event: any) => {
        const res = JSON.parse(event.nativeEvent.data);
        if (res.event === 'onShare') {
            //console.log(event.nativeEvent);
            this.share.show();
        }

        if (res.event === 'onPressItem') {
            //console.log(event.nativeEvent);
            this.props.navigation.push('post-detail', {aid: res.aid});
        }
    }

    addSubscribe = () => {
        let {aid} = this.state.post;
        ApiClient.post('/post/subscribe.toggle', {aid}).then(response => {
            //console.log(response);
            if (response.result.attached.length) {
                Toast.success('添加收藏成功');
                this.setState({subscribe: true}, this.setNavigationRight);
            } else {
                Toast.success('取消收藏成功');
                this.setState({subscribe: false}, this.setNavigationRight);
            }
        }).catch(reason => {
            Toast.fail(reason.errMsg);
        });
    }
}

const mapStateToProps = state => {
    return state;
};

export default connect(mapStateToProps)(PostDetail);
