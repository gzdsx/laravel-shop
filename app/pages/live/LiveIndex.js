import React from 'react';
import {FlatList, Text, TouchableOpacity, View, StyleSheet} from 'react-native';
import {connect} from 'react-redux';
import {LoadingView, Ticon} from 'react-native-gzdsx-elements';
import {CacheImage} from 'react-native-gzdsx-cache-image';
import Swiper from "react-native-swiper";
import {Size} from '../../styles';
import {ApiClient} from '../../utils';
import {defaultNavigationConfigure} from "../../base/navconfig";


class LiveIndex extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            items: [],
            images: [],
            loading: true,
            refreshing: false,
            loadMore: false,
        };
        this.offset = 0;
        this.loadMoreAble = false;
    }

    render(): React.ReactNode {
        if (this.state.loading) return <LoadingView/>;
        return (<View style={{flex: 1, backgroundColor: '#fff'}}>
            <FlatList
                keyExtractor={(item) => item.id.toString()}
                data={this.state.items}
                renderItem={({item, index}) => {
                    return (
                        <TouchableOpacity
                            activeOpacity={1}
                            style={styles.videoBox}
                            onPress={() => {
                                this.props.navigation.navigate('LivePlay', {id: item.id});
                            }}
                        >
                            <CacheImage source={{uri: item.image}} style={styles.videoCover}/>
                            <View style={styles.videoTitle}>
                                <Text style={styles.videoTitleText}>{item.title}</Text>
                            </View>
                        </TouchableOpacity>
                    );
                }}
                showsHorizontalScrollIndicator={false}
                showsVerticalScrollIndicator={false}
                numColumns={2}
                ListEmptyComponent={() => (
                    <View style={{
                        flex: 1,
                        alignContent: 'center',
                        justifyContent: 'center',
                        flexDirection: 'column',
                        paddingVertical: 50,
                    }}>
                        <Text style={{color: '#666', fontSize: 16, textAlign: 'center'}}>当前没有直播内容</Text>
                    </View>
                )}
                ListHeaderComponent={this.renderSwiper}
                refreshing={this.state.refreshing}
                onRefresh={this.onRefresh}
                columnWrapperStyle={{
                    paddingVertical: 10,
                    paddingHorizontal: 5
                }}
            />
        </View>);
    }

    componentDidMount(): void {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '直播'
        });
        ApiClient.get('/block/item/batchget?block_id=4').then(response => {
            this.setState({
                images: response.result.items
            });
        })
        this.fetchData();
    }

    fetchData = () => {
        ApiClient.get('/live/batchget', {
            state: 1,
            offset: this.offset,
        }).then(response => {
            //console.log(response.result);
            let items = response.result.items;
            this.setState({
                items,
                loading: false,
                refreshing: false,
                loadMore: false
            });
            this.loadMoreAble = items.length === 10;
        });
    };

    onRefresh = () => {
        if (this.state.loading || this.state.refreshing || this.state.loadMore) {
            return false;
        }

        this.offset = 0;
        this.setState({refreshing: true});
        setTimeout(this.fetchData, 500);
    };

    onEndReached = () => {
        if (this.state.loading || this.state.refreshing || this.state.loadMore || !this.loadMoreAble) {
            return false;
        }

        this.offset += 20;
        this.setState({loadMore: true});
        setTimeout(this.fetchData, 500);
    };

    renderSwiper = () => {
        const size = {
            width: Size.screenWidth,
            height: Size.screenWidth * 0.4
        };
        let contents = this.state.images.map((item, index) => {
            return (
                <TouchableOpacity
                    activeOpacity={1}
                    key={'key1' + index.toString()}
                    onPress={() => {
                        if (/http(.*?)\/post\/detail\/(\d+)\.html/.test(item.url)) {
                            let aid = item.url.match(/(\d+)/g)[0];
                            this.props.navigation.navigate('PostDetail', {aid});
                        }
                    }}
                >
                    <CacheImage
                        source={{uri: item.image}}
                        style={{...size}}
                    />
                </TouchableOpacity>
            );
        });

        return (<Swiper style={{height: size.height}} dotColor={"#ccc"} autoplay>{contents}</Swiper>);
    };
}

const itemWidth = (Size.screenWidth - 30) / 2;
const styles = StyleSheet.create({
    videoBox: {
        width: itemWidth,
        paddingHorizontal: 5,
        marginBottom: 10,
        flex: 1,
    },
    videoCover: {
        width: itemWidth,
        height: itemWidth * 0.8,
        resizeMode: 'cover',
        borderRadius: 3
    },
    videoTitle: {
        paddingVertical: 7
    },
    videoTitleText: {
        fontSize: 14,
        color: '#333'
    }
});

const mapStateToProps = (store) => {
    return {
        auth: store.auth,
    };
};

export default connect(mapStateToProps)(LiveIndex);
