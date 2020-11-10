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

class NewsDetail extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '文章正文',
        headerRight: (
            <View style={Styles.headerRight}>
                <Ticon name={"share-squar-light"} size={28} color={"#fff"}
                       onPress={() => navigation.state.params.share()}/>
                <BarItemSeparate/>
                <Ticon name={"favor-light"} color={"#fff"} size={28}
                       onPress={() => navigation.state.params.addCollection()}/>
            </View>
        )
    });

    constructor(props) {
        super(props);
        this.state = {
            showShare: false
        }
    }

    render() {
        const {aid} = this.props.navigation.state.params;
        const url = BaseUri + '/post/detail/' + aid + '.html';
        return (
            <View style={{flex: 1}}>
                <WebView
                    source={{uri: url}}
                    renderError={() => <View/>}
                    renderLoading={() => <Loading/>}
                    onMessage={this.handlerMessage}
                    decelerationRate={"normal"}
                />
                <ShareView show={this.state.showShare} shareMessage={{
                    type:'news',
                    title:"下载童蒙家园APP",
                    description:"下载童蒙家园APP",
                    thumbImage:"http://tmjy.songdewei.com/storage/image/2019/10/uYhC6RKqwA5TYcpcJl1cVbRSwSnjgGHAIyGHu68F.png",
                    webpageUrl:"http://tmjy.songdewei.com/app"
                }}/>
            </View>
        );
    }


    componentDidMount() {
        const {aid} = this.props.navigation.state.params;
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

        if (res.event === 'viewArticle') {
            this.props.navigation.navigate('NewsDetail', {aid: res.aid});
        }
    }
}

const mapStateToProps = (store) => {
    return {
        auth: store.auth
    };
};

export default connect(mapStateToProps)(NewsDetail);
