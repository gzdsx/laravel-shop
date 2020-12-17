import React from 'react';
import {FlatList, Text, TouchableOpacity, View, StyleSheet} from 'react-native';
import {connect} from 'react-redux';
import {LoadingView, Ticon} from 'react-native-gzdsx-elements';
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {Colors, Size} from '../../styles';
import {ApiClient, Toast} from '../../utils';
import {defaultNavigationConfigure} from "../../base/navconfig";

class LiveIndex extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            items: [],
            isLoading: true,
        };
        this.vps = [];
    }

    render(): React.ReactNode {
        if (this.state.isLoading) return <LoadingView/>;
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
                        paddingVertical: 20,
                    }}>
                        <Text style={{color: '#666', fontSize: 16, textAlign: 'center'}}>当前没有直播内容</Text>
                    </View>
                )}
                style={{
                    paddingHorizontal: 5,
                    paddingVertical: 10
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
        this.fetchData();
    }

    fetchData = () => {
        ApiClient.get('/live/batchget?state=1').then(response => {
            console.log(response.data);
            let items = response.data.items;
            this.setState({
                isLoading: false,
                items
            });
        });
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
