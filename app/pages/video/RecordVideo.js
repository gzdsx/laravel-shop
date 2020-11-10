import React from 'react';
import {View, Image, TouchableOpacity} from 'react-native';
import {defaultNavigationConfigure} from "../../base/navconfig";
import {RNCamera} from 'react-native-camera';

export default class RecordVideo extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...defaultNavigationConfigure(navigation),
        headerTitle: '录制视频',
    });

    constructor(props) {
        super(props);
        this.state = {
            isFlashOn: false,        //闪光灯
            isRecording: false,      //是否在录像
        }

    }

    render(): React.ReactNode {
        return (
            <View style={{flex: 1}}>
                <RNCamera
                    style={{flex: 1}}
                    type={RNCamera.Constants.Type.back}
                    flashMode={this.state.isFlashOn === true ? RNCamera.Constants.FlashMode.on : RNCamera.Constants.FlashMode.off}
                    ref={(ref) => {
                        this.camera = ref;
                    }}
                />
                <View style={{
                    position: 'absolute',
                    left: 0,
                    right: 0,
                    bottom: 25,
                    alignItems: 'center',
                    justifyContent: 'center',
                }}>
                    <TouchableOpacity
                        activeOpacity={1}
                        style={{
                            width: 70,
                            height: 70,
                            borderRadius: 35,

                        }}
                        onPress={() => {
                            if (this.state.isRecording) {
                                this.stopRecord(this.camera);
                            } else {
                                this.takeRecord(this.camera);
                            }
                        }}
                    >
                        <Image
                            source={require('../../images/common/record.png')}
                            style={{
                                width: 70,
                                height: 70,
                                borderRadius: 35,
                                tintColor: this.state.isRecording ? '#fff' : '#f00',
                                backgroundColor: this.state.isRecording ? '#f00' : '#fff'
                            }}
                        />
                    </TouchableOpacity>
                </View>
            </View>
        );
    }

    componentDidMount(): void {

    }

    toggleFlash() {
        this.setState({isFlashOn: !this.state.isFlashOn})
    }

    //开始录像
    takeRecord = async function (camera) {
        this.setState({isRecording: true});
        const data = await camera.recordAsync({
            quality: RNCamera.Constants.VideoQuality["480p"],
            maxFileSize: (20 * 1024 * 1024)
        });
        console.log(data);
        //this.props.navigation.navigate('parentPage',{videoUrl:data.uri})
    };

    //停止录像
    stopRecord(camera) {
        this.setState({isRecording: false});
        camera.stopRecording()
    }
}
