import React from 'react';
import {View, FlatList, Text} from 'react-native';
import {Utils,ApiClient} from "../../utils";
import {whiteNavigationConfigure} from "../../base/navconfig";

export default class Express extends React.Component {

    static navigationOptions = ({navigation}) => ({
        ...whiteNavigationConfigure(navigation),
        headerTitle: '物流查询',
    });

    constructor(props) {
        super(props);
        this.state = {
            items: []
        };
    }

    render(): React.ReactNode {
        return <FlatList
            renderItem={({item}) => this.renderItem(item)}
            data={this.state.items}
            initialNumToRender={10}
            keyExtractor={(item, index) => index.toString()}
        />
    }

    componentDidMount(): void {
        let order_id = this.props.navigation.getParam('order_id', '0');
        ApiClient.get('/express/get_express', {order_id}).then(response => {
            this.setState({
                items: response.result.result.data
            });
        });

        this.listener = this.props.navigation.addListener('willFocus', () => {
            Utils.setStatusBarStyle('default');
        });
    }

    componentWillUnmount(): void {
        this.listener.remove();
    }

    renderItem = (item) => {
        return (
            <View style={{
                flexDirection: 'row',
                paddingTop: 15,
                paddingBottom: 15,
                paddingLeft: 10,
                paddingRight: 10
            }}>
                <Text style={{
                    fontSize: 12,
                    color: '#666',
                    width: 70,
                    marginRight: 10
                }} numberOfLines={2}>{item.time}</Text>
                <Text style={{
                    fontSize: 12,
                    color: '#666',
                    flex: 1
                }} numberOfLines={10}>{item.remark}</Text>
            </View>
        );
    }
}
