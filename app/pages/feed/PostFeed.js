import React from 'react';
import {View, TouchableOpacity, Text, ScrollView, Image} from 'react-native';
import {Size, Styles} from "../../styles";
import ImagePicker from 'react-native-image-picker';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {CustomTextInput} from "../../components";
import {ApiClient, Toast, Utils} from "../../utils";
import {Spinner} from "react-native-dsxui";

export default class PostFeed extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '发布动态',
        headerRight: (
            <View style={Styles.headerRight}>
                <TouchableOpacity
                    activeOpacity={1}
                    onPress={() => navigation.state.params.submit()}
                >
                    <Text style={{fontSize: 16, color: '#fff'}}>发表</Text>
                </TouchableOpacity>
            </View>
        )
    });

    constructor(props) {
        super(props);
        this.state = {
            selectedImages: [],
            message: null
        };
    }


    render(): React.ReactNode {
        const w = (Size.screenWidth - 58) / 3;
        let contents = this.state.selectedImages.map((item, index) => {
            return <Image
                source={{uri: item.uri}}
                key={index.toString()}
                style={{
                    width: w,
                    height: w,
                    marginLeft: 3,
                    marginRight: 3
                }}
            />
        });
        return (
            <ScrollView style={{padding: 20}}>
                <View>
                    <CustomTextInput
                        placeholder={"这一刻的想法..."}
                        multiline={true}
                        numberOfLines={3}
                        style={{height: 60, fontSize: 16}}
                        onChangeText={(text) => {
                            this.setState({message: text});
                        }}
                        returnKeyType={"default"}
                    />
                </View>
                <View style={{flexDirection: 'row', marginTop: 30, flexWrap: 'wrap'}}>
                    {contents}
                    {
                        this.state.selectedImages.length < 9 ?
                            <TouchableOpacity
                                activeOpacity={1}
                                style={{
                                    backgroundColor: '#f2f2f2',
                                    alignItems: 'center',
                                    justifyContent: 'center',
                                    width: w,
                                    height: w
                                }}
                                onPress={this.pickImage}
                            >
                                <Image
                                    source={require('../../images/icon/add_light.png')}
                                    style={{
                                        width: 60,
                                        height: 60,
                                        tintColor: '#999'
                                    }}
                                />
                            </TouchableOpacity>
                            : null
                    }
                </View>
                <Spinner show={this.state.uploading}/>
            </ScrollView>
        );
    }

    componentDidMount(): void {
        this.props.navigation.setParams({
            submit: this.submit
        });
    }

    pickImage = () => {
        Utils.setStatusBarStyle();
        ImagePicker.showImagePicker({
            title: null,
            takePhotoButtonTitle: '拍照',
            chooseFromLibraryButtonTitle: '从相册选择',
            cancelButtonTitle: '取消',
            maxWidth: 1200,
            maxHeight: 1200,
            tintColor: '#333'
        }, response => {
            Utils.setStatusBarStyle('light');
            if (response.didCancel || response.error) {
                return false;
            }
            //console.log(response);
            let selectedImages = this.state.selectedImages;
            selectedImages.push(response);
            this.setState({selectedImages});
        });
    };

    submit = () => {
        const {message, selectedImages} = this.state;
        if (!message && selectedImages.length === 0) {
            Toast.show('请输入动态内容');
            return false;
        }

        this.uploadFiles().then(images => {
            ApiClient.post('/feed/save', {message, images}).then(response => {
                this.props.navigation.goBack();
            });
        });
    };

    uploadFiles = async () => {
        let uploads = [];
        const selectedImages = this.state.selectedImages;
        if (selectedImages.length > 0) {
            this.setState({uploading: true});
            for (let k in selectedImages) {
                //console.log(selectedImages[k]);
                let file = selectedImages[k];
                let response = await ApiClient.upload('/material/upload_img', {
                    uri: file.uri,
                    name: file.fileName ? file.fileName : this.getFileName(file.uri)
                });
                uploads.push(response.data.image);
            }
            this.setState({uploading: false});
        }

        return new Promise((resolve => {
            resolve(uploads);
        }));
    };

    getFileName = (url) => {
        let pos = url.lastIndexOf('/');
        return url.substring(pos + 1);
    }
}
