import React from 'react';
import {Modal, View, Text, TouchableOpacity, Animated} from 'react-native';
import PropTypes from 'prop-types';
import {Ticon} from "react-native-ticon";
import {CacheImage} from 'react-native-gzdsx-cache-image';
import {NumberControl} from "./NumberControl";

export default class BuyModalView extends React.Component {

    static propTypes = {
        visible: PropTypes.bool,
        onSubmit: PropTypes.func
    };

    static defaultProps = {
        visible: false,
        onSubmit: (itemid, quantity) => null
    };

    constructor(props) {
        super(props);
        this.state = {
            visible: props.visible,
            bottom: new Animated.Value(-300),
        };
        this.quatity = 1;
    }

    render() {
        const {data} = this.props;
        return (
            <Modal
                visible={this.state.visible}
                onShow={() => {
                    Animated.timing(this.state.bottom, {
                        toValue: 0,
                        duration: 300,
                        useNativeDriver: false
                    }).start();
                }}
                onRequestClose={() => {

                }}
            >
                <TouchableOpacity
                    style={{
                        backgroundColor: 'rgba(0,0,0,0.5)',
                        flex: 1
                    }}
                    activeOpacity={1}
                >
                    <Animated.View style={{
                        backgroundColor: '#fff',
                        position: 'absolute',
                        left: 0,
                        right: 0,
                        bottom: this.state.bottom,
                        height: 300,
                    }}>
                        <View style={{
                            flexDirection: 'row',
                            borderBottomColor: '#e5e5e5',
                            borderBottomWidth: 0.5,
                            padding: 15
                        }}>
                            <CacheImage
                                source={{uri: data.thumb}}
                                style={{
                                    width: 90,
                                    height: 90,
                                    borderRadius: 3,
                                    marginRight: 10,
                                }}
                            />
                            <View style={{flex: 1}}>
                                <View style={{alignContent: 'flex-end', alignItems: 'flex-end', height: 40}}>
                                    <Ticon name={"close-light"} size={25} color={"#666"} onPress={this.hide}/>
                                </View>
                                <Text style={{
                                    color: '#f00',
                                    fontSize: 16,
                                    fontWeight: '300'
                                }}>￥{data.price}</Text>
                                <Text style={{
                                    fontSize: 14,
                                    color: '#333',
                                    marginTop: 5
                                }}>库存{data.stock}件</Text>
                            </View>
                        </View>
                        <View style={{flex: 1, padding: 15}}>
                            <View style={{flexDirection: 'row'}}>
                                <Text style={{
                                    fontSize: 14,
                                    color: '#333',
                                    flex: 1,
                                    lineHeight: 30
                                }}>购买数量</Text>
                                <NumberControl maxValue={data.stock} onValueChange={(value) => {
                                    this.quatity = value;
                                }}/>
                            </View>
                        </View>
                        <View style={{paddingTop: 10, paddingBottom: 10, paddingLeft: 20, paddingRight: 20}}>
                            <TouchableOpacity
                                style={{
                                    backgroundColor: '#FC461E',
                                    borderRadius: 20
                                }}
                                activeOpacity={0.8}
                                onPress={() => {
                                    this.setState({visible: false});
                                    this.props.onSubmit(data.itemid, this.quatity);
                                }}
                            >
                                <Text style={{
                                    textAlign: 'center',
                                    padding: 10,
                                    fontSize: 16,
                                    color: '#fff'
                                }}>确定</Text>
                            </TouchableOpacity>
                        </View>
                    </Animated.View>
                </TouchableOpacity>
            </Modal>
        );
    }


    componentDidMount() {

    }

    hide = () => {
        this.setState({
            visible: false,
            bottom: new Animated.Value(-300)
        });
    }
}
