import React from 'react';
import {
    FlatList,
    Text,
    TouchableOpacity,
    View,
    Image,
    Modal,
    KeyboardAvoidingView,
    Keyboard
} from 'react-native';
import {LoadingView} from "react-native-dsxui";
import ImageViewer from 'react-native-image-zoom-viewer';
import WebView from "react-native-webview";
import {defaultNavigationConfigure} from "../../base/navconfig";
import {Size, Styles} from "../../styles";
import {ApiClient} from "../../utils";
import {CustomTextInput} from "../../components";

export default class FeedIndex extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerLeft: <View style={Styles.headerLeft}/>,
        headerRight: (
            <View style={Styles.headerRight}>
                <TouchableOpacity
                    activeOpacity={1}
                    onPress={() => navigation.navigate('PostFeed')}
                >
                    <Image
                        source={require('../../images/icon/camera.png')}
                        style={{
                            width: 28,
                            height: 28,
                            tintColor: '#fff'
                        }}
                    />
                </TouchableOpacity>
            </View>
        ),
        headerTitle: '动态'
    });

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            isRefreshing: false,
            isLoadMore: false,
            items: [],
            showModal: false,
            imageUrls: [],
            imageIndex: 0,
            showFeedID: 0,
            showKeyBoard: false,
            KeyboardHeight: 0
        };
        this.catid = props.catid;
        this.offset = 0;
        this.loadMoreAble = false;
        this.commentFeedID = 0;
        this.replyUID = 0;
    }


    render(): React.ReactNode {
        return (
            <View style={{flex: 1}}>
                <WebView
                    source={{uri:'https://www.gzpbjjkfq.com/h5/post/detail/778.html'}}
                    startInLoadingState={true}
                    decelerationRate={"normal"}
                />
            </View>
        )
    }

    componentDidMount(): void {
    }

    componentWillUnmount(): void {
        this.setState = (state,callback)=>{
            return false;
        };
    }

    fetchData = async () => {
        const offset = this.offset;

        let items = this.state.items;
        let response = await ApiClient.get('/feed/batchget', {offset, count: 10});
        //console.log(response.data.items);

        if (this.state.isLoadMore) {
            items = items.concat(response.data.items);
        } else {
            items = response.data.items;
        }
        this.setState({
            isLoading: false,
            isRefreshing: false,
            isLoadMore: false,
            items
        });
        this.loadMoreAble = response.data.items.length === 20;
    };

    onRefresh = () => {
        if (this.state.isRefreshing || this.state.isLoading
            || this.state.isLoadMore) {
            return false;
        }

        this.offset = 0;
        this.setState({isRefreshing: true});
        setTimeout(this.fetchData, 1000);
    };

    onEndReached = () => {
        if (this.state.isRefreshing || this.state.isLoading
            || this.state.isLoadMore || !this.loadMoreAble) {
            return false;
        }

        this.offset += 20;
        this.setState({isLoadMore: true});
        setTimeout(this.fetchData, 500);
    };

    loadFeed = (id) => {
        ApiClient.get('/feed/get', {id}).then(response => {
            const feed = response.data.feed;
            let items = this.state.items.map((item, index) => {
                if (item.id === feed.id) {
                    return feed;
                } else {
                    return item;
                }
            });
            this.setState({items});
        });
    };

    renderItem = (item) => {
        let w;
        if (item.images.length > 2) {
            w = (Size.screenWidth - 100) / 3;
        } else {
            w = (Size.screenWidth - 90) / 2;
        }
        let images = item.images.map((img, index) => {
            return (
                <TouchableOpacity
                    activeOpacity={1}
                    style={{
                        width: w,
                        height: w,
                        margin: 5
                    }}
                    key={index.toString()}
                    onPress={() => this.showModel(item.images, index)}
                >
                    <Image
                        source={{uri: img.thumb}}
                        style={{
                            flex: 1
                        }}
                    />
                </TouchableOpacity>
            )
        });
        return (
            <TouchableOpacity
                style={{
                    padding: 15,
                    borderBottomColor: '#e5e5e5',
                    borderBottomWidth: 0.5,
                    flexDirection: 'row',
                    backgroundColor: '#fff'
                }}
                activeOpacity={1}
                onPress={()=>{
                    this.setState({
                        showFeedID:0
                    })
                }}
            >
                <View style={{marginRight: 10}}>
                    <Image
                        source={{uri: item.user.avatar}}
                        style={{
                            width: 40,
                            height: 40,
                            borderRadius: 5
                        }}
                    />
                </View>
                <View style={{flex: 1}}>
                    <Text style={{
                        fontSize: 18,
                        fontWeight: '600',
                        color: '#737EAB'
                    }}>{item.user.username}</Text>
                    <Text style={{
                        marginTop: 10,
                        marginBottom: 10,
                        fontSize: 16,
                        color: '#333'
                    }}>{item.message}</Text>
                    <View style={{flexDirection: 'row', flexWrap: 'wrap', marginLeft: -5, marginRight: -5}}>
                        {images}
                    </View>
                    <View style={{marginTop: 10, marginBottom: 10, flexDirection: 'row'}}>
                        <Text style={{
                            fontSize: 14,
                            color: '#666',
                            flex: 1,
                            height: 20,
                            lineHeight: 20
                        }}>{item.difftime}</Text>
                        <TouchableOpacity
                            style={{
                                backgroundColor: '#f0f0f0',
                                borderRadius: 5,
                                paddingLeft: 5,
                                paddingRight: 5
                            }}
                            activeOpacity={1}
                            onPress={() => {
                                this.setState({
                                    showFeedID: item.id
                                });
                            }}
                        >
                            <Image
                                source={require('../../images/common/more_light.png')}
                                style={{
                                    width: 20,
                                    height: 20,
                                    tintColor: '#555'
                                }}
                            />
                        </TouchableOpacity>
                        {
                            this.state.showFeedID === item.id ?
                                <View style={{
                                    backgroundColor: '#333',
                                    position: 'absolute',
                                    bottom: 0,
                                    right: 40,
                                    borderRadius: 6,
                                    flexDirection: 'row'
                                }}>
                                    <TouchableOpacity
                                        activeOpacity={1}
                                        onPress={() => {
                                            ApiClient.post('/feed/like', {feed_id: item.id}).then(response => {
                                                this.setState({
                                                    showFeedID: 0
                                                });
                                                this.loadFeed(item.id);
                                            });
                                        }}
                                    >
                                        <Text
                                            style={{
                                                fontSize: 14,
                                                color: '#fff',
                                                paddingLeft: 20,
                                                paddingRight: 20,
                                                height: 36,
                                                lineHeight: 36
                                            }}
                                        >赞</Text>
                                    </TouchableOpacity>
                                    <TouchableOpacity
                                        activeOpacity={1}
                                        onPress={() => {
                                            this.commentFeedID = item.id;
                                            this.setState({
                                                showKeyBoard: true,
                                                showFeedID: 0
                                            });
                                            this.loadFeed(item.id);
                                        }}
                                    >
                                        <Text
                                            style={{
                                                fontSize: 14,
                                                color: '#fff',
                                                paddingLeft: 20,
                                                paddingRight: 20,
                                                height: 36,
                                                lineHeight: 36
                                            }}
                                        >评论</Text>
                                    </TouchableOpacity>
                                </View>
                                : null
                        }
                    </View>
                    {this.renderLikes(item)}
                    {this.renderComments(item)}
                </View>
            </TouchableOpacity>
        );
    };

    renderLikes = (item) => {
        if (item.like_users.length > 0) {
            let contents = item.like_users.map((u, k) => {
                return (
                    <Text style={{
                        color: '#737EAB',
                        fontSize: 14,
                        marginLeft: 3,
                        marginRight: 3,
                        fontWeight: '500'
                    }} key={k.toString()}>{u.username}</Text>
                );
            });
            return (
                <View style={{
                    flexDirection: 'row',
                    borderBottomWidth: 0.5,
                    borderBottomColor: '#e2e2e2',
                    padding: 10,
                    backgroundColor: '#f2f2f2'
                }}>
                    <Image
                        source={require('../../images/common/like.png')}
                        style={{
                            width: 14,
                            height: 14,
                            tintColor: '#737EAB',
                            marginRight: 3
                        }}
                    />
                    {contents}
                </View>
            )
        }
        return null;
    };

    renderComments = (item) => {
        if (item.comments.length > 0) {
            let contents = item.comments.map((c) => {
                return (
                    <TouchableOpacity
                        activeOpacity={1}
                        style={{marginTop: 5}}
                        key={c.id.toString()}
                    >
                        <Text>
                            <Text style={{fontSize: 14, color: '#737EAB', fontWeight: '500'}}>{c.user.username}:</Text>
                            <Text style={{fontSize: 14, flex: 1}}>{c.message}</Text>
                        </Text>
                    </TouchableOpacity>
                )
            });
            return (
                <View style={{
                    paddingTop: 5,
                    paddingLeft: 10,
                    paddingRight: 10,
                    paddingBottom: 10,
                    backgroundColor: '#f2f2f2'
                }}>{contents}</View>
            )
        }
        return null;
    };

    renderKeyBoard = () => {
        if (this.state.showKeyBoard) {
            return (
                <View style={{
                    paddingLeft: 10,
                    paddingRight: 10,
                    paddingTop: 5,
                    paddingBottom: 5,
                    borderTopColor: '#ddd',
                    borderTopWidth: 0.5,
                    height: 50,
                    backgroundColor: '#fefefe',
                    position: 'absolute',
                    left: 0,
                    right: 0,
                    bottom: this.state.KeyboardHeight
                }}>
                    <CustomTextInput
                        style={{
                            flex: 1,
                            height: 40,
                            fontSize: 16
                        }}

                        placeholder={""}
                        autoFocus={true}
                        onSubmitEditing={(event) => {
                            //console.log(event.nativeEvent);
                            if (event.nativeEvent.text) {
                                ApiClient.post('/feed/comment', {
                                    feed_id: this.commentFeedID,
                                    message: event.nativeEvent.text,
                                    reply_uid: this.replyUID
                                }).then(response => {
                                    this.loadFeed(this.commentFeedID)
                                });
                            }
                            this.setState({
                                showKeyBoard: false,
                                showFeedID: 0
                            });
                        }}
                    />
                </View>
            )
        }
        return null;
    };

    showModel = (images, index) => {
        const imageUrls = images.map((img, index) => {
            return {
                url: img.image,
                props: {}
            }
        });
        this.setState({
            imageUrls,
            showModal: true,
            imageIndex: index
        });
    }
}
