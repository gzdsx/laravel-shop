import React from 'react';
import {Image, ImageBackground, KeyboardAvoidingView, ScrollView, Text, TouchableOpacity, View} from 'react-native';
import {LoadingView, Spinner, TableCell, TableView, TextField, Toast} from "react-native-gzdsx-elements";
import {CacheImage} from "react-native-gzdsx-cache-image";
import {AirbnbRating} from 'react-native-elements';
import ActionSheet from "react-native-actionsheet";
import ImagePicker from 'react-native-image-picker';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {ApiClient} from "../../utils";
import {isAndroid} from "../../base/constants";
import {Styles} from "../../styles";

export default class OrderRate extends React.Component {

    setNavigationOptions() {
        const {navigation, route} = this.props;
        navigation.setOptions({
            ...defaultNavigationConfigure(navigation),
            headerTitle: '发表评价',
            headerRight: () => (
                <TouchableOpacity activeOpacity={1} style={Styles.headerRight} onPress={this.submit}>
                    <Text style={{color: '#fff', fontSize: 18}}>发表</Text>
                </TouchableOpacity>
            )
        });
    }

    constructor(props) {
        super(props);
        this.state = {
            reviews: [],
            rateImages: [],
            loading: true
        };
    }


    render(): React.ReactNode {
        let {reviews, loading, rateImages} = this.state;
        if (loading) return <LoadingView/>;
        const items = this.props.route.params?.items || [];
        const contents = items.map((item, index) => {
            let images = rateImages[index];
            return (
                <View key={index.toString()}>
                    <TableView>
                        <View style={{
                            padding: 15,
                            flexDirection: 'row'
                        }} key={index.toString()}>
                            <CacheImage source={{uri: item.thumb}} style={{
                                width: 50,
                                height: 50,
                                borderRadius: 3,
                                marginRight: 10
                            }}/>
                            <View style={{flex: 1, flexDirection: 'column'}}>
                                <Text style={{fontSize: 14, color: '#333'}}>{item.title}</Text>
                                <View style={{flex: 1}}>
                                    <Text style={{fontSize: 12, color: '#777'}}>{item.sku_title}</Text>
                                </View>
                            </View>
                        </View>
                        <TableCell touchAble={false}>
                            <TableCell.Title title={"商品描述"} titleStyle={{fontSize: 14}}/>
                            <AirbnbRating size={22} defaultRating={0} showRating={false} onFinishRating={(number) => {
                                reviews[index].item_star = number;
                                this.setState({reviews});
                            }}/>
                        </TableCell>
                        <TableCell touchAble={false}>
                            <TableCell.Title title={"物流评分"} titleStyle={{fontSize: 14}}/>
                            <AirbnbRating size={22} defaultRating={0} showRating={false} onFinishRating={(number) => {
                                reviews[index].wuliu_star = number;
                                this.setState({reviews});
                            }}/>
                        </TableCell>
                        <TableCell touchAble={false}>
                            <TableCell.Title title={"服务态度"} titleStyle={{fontSize: 14}}/>
                            <AirbnbRating size={22} defaultRating={0} showRating={false} onFinishRating={(number) => {
                                reviews[index].service_star = number;
                                this.setState({reviews});
                            }}/>
                        </TableCell>
                        <TableCell touchAble={false} style={{borderBottomWidth: 0}}>
                            <TextField
                                placeholder={"补充描述，有助于商家更好的处理售后问题"}
                                multiline={true}
                                inputStyle={{textAlignVertical: 'top', height: 50, fontSize: 14}}
                                style={{borderBottomWidth: 0, backgroundColor: '#fefefe'}}
                                onChangeText={text => {
                                    reviews[index].message = text;
                                    this.setState({reviews});
                                }}
                            />
                        </TableCell>
                        <TableCell touchAble={false} style={{borderBottomWidth: 0}}>
                            {this.renderImages(images, index)}
                            {
                                images.length < 3 ?
                                    <TouchableOpacity
                                        activeOpacity={1}
                                        style={{width: 80, height: 80}}
                                        onPress={() => this.pickImage(index)}
                                    >
                                        <ImageBackground
                                            source={require('../../images/icon/si-glyph-square-dashed.png')}
                                            style={{
                                                width: 80,
                                                height: 80,
                                                justifyContent: 'center',
                                                alignItems: 'center',
                                                paddingHorizontal: 10
                                            }}
                                            imageStyle={{tintColor: '#ccc'}}
                                        >
                                            <Image
                                                source={require('../../images/icon/camera.png')}
                                                style={{
                                                    width: 30,
                                                    height: 30,
                                                    tintColor: '#ccc',
                                                }}
                                            />
                                            <Text
                                                style={{
                                                    fontSize: 10,
                                                    color: '#aaa',
                                                    textAlign: 'center'
                                                }}>上传凭证,最多3张</Text>
                                        </ImageBackground>
                                    </TouchableOpacity>
                                    : null
                            }
                        </TableCell>
                    </TableView>
                </View>
            )
        });
        return (
            <KeyboardAvoidingView style={{flex: 1}} behavior={isAndroid ? "height" : "padding"}>
                <ScrollView style={{flex: 1}}>
                    {contents}
                </ScrollView>
                <Toast ref={'toast'}/>
                <Spinner ref={'spinner'}/>
            </KeyboardAvoidingView>
        );
    }

    componentDidMount(): void {
        this.setNavigationOptions();
        let items = this.props.route.params?.items || [];
        let reviews = [];
        let rateImages = [];
        items.map((item, index) => {
            reviews.push({
                itemid: item.itemid,
                order_id: item.order_id,
                message: '',
                item_star: 0,
                service_star: 0,
                wuliu_star: 0,
                anony: 0,
                images: []
            });
            rateImages.push([]);
        });
        //console.log(reviews);
        this.setState({reviews, rateImages, loading: false});
    }

    renderImages = (images, idx) => {
        let contents = images.map((item, index) => {
            return (
                <View key={index.toString()} style={{
                    width: 80,
                    height: 80,
                    justifyContent: 'center',
                    alignItems: 'center',
                    marginRight: 15
                }}>
                    <Image
                        source={{uri: item.uri}}
                        style={{
                            width: 80,
                            height: 80,
                        }}
                    />
                    <TouchableOpacity
                        activeOpacity={1}
                        style={{
                            position: 'absolute',
                            top: -8,
                            right: -8
                        }}
                        onPress={() => {
                            let rateImages = this.state.rateImages;
                            images.splice(index, 1);
                            rateImages[idx] = images;
                            this.setState({rateImages});
                        }}
                    >
                        <Image source={require('../../images/icon/close_round.png')} style={{width: 20, height: 20}}/>
                    </TouchableOpacity>
                </View>
            )
        });
        return <View style={{flexDirection: 'row'}}>{contents}</View>;
    }

    pickImage = (index) => {
        ImagePicker.showImagePicker({
            title: '选择照片来源',
            cancelButtonTitle: '取消',
            takePhotoButtonTitle: '拍照',
            chooseFromLibraryButtonTitle: '相册',
            maxWidth: 2000,
            mediaType: 'photo'
        }, res => {
            //console.log(res);
            if (res.uri) {
                let rateImages = this.state.rateImages;
                rateImages[index].push(res);
                this.setState({rateImages});
            }
        });
    }

    submit = async () => {
        //console.log(this.state.reviews);
        let {rateImages, reviews} = this.state;
        let {order_id} = this.props.route.params;
        this.refs.spinner.show('正在上传数据...');
        for (let index = 0; index < rateImages.length; index++) {
            reviews[index].images = await this.uploadImages(rateImages[index]);
        }

        ApiClient.post('/order/rate', {reviews, order_id}).then(response => {
            this.refs.spinner.hide();
            this.props.navigation.goBack();
        });
    }

    uploadImages = async (files) => {
        let images = [];
        for (let file of files) {
            let response = await ApiClient.upload('/material/uploadimg', {
                uri: file.uri,
                name: file.fileName || file.uri.substring(file.uri.lastIndexOf('/'))
            });
            images.push(response.data.image);
        }

        return new Promise(resolve => {
            resolve(images);
        });
    }
}
