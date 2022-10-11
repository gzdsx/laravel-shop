import React from 'react';
import {Provider} from 'react-redux';
import * as WeChat from 'react-native-wechat-lib';
import {RootSiblingParent} from 'react-native-root-siblings';
import configureStore from './store/configureStore';
import {WeChatAppId, WeChatUniversalLink} from "./base/constants";
import App from './containers/App';
import {LaunchScreen} from "./components";
import {PersistGate} from 'redux-persist/integration/react'

export default class Root extends React.Component {
    constructor() {
        super();
        this.state = {
            store: null,
            storeCreated: false
        }
    }

    render() {
        let {store, storeCreated} = this.state;
        if (!storeCreated) {
            return <LaunchScreen/>;
        }

        return (
            <Provider store={store}>
                <RootSiblingParent>
                    <App/>
                </RootSiblingParent>
            </Provider>
        );
    }

    componentDidMount(): void {
        configureStore(({store}) => {
            this.setState({store, storeCreated: true});
        });

        WeChat.registerApp(WeChatAppId, WeChatUniversalLink).then(res => {
            console.log('wecahtApp registered');
            //console.log(res);
        }).catch(reason => {
            console.log('wecaht register app failed');
            console.log(reason.message);
        });
    }
}
