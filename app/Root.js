import React from 'react';
import {Provider} from 'react-redux';
import * as WeChat from 'react-native-wechat-lib';
import configureStore from './store/configureStore';
import App from './containers/App';
import {sagas} from "./sagas";
import {WeChatAppId, WeChatUniversalLink} from "./base/constants";

const store = configureStore();
store.runSaga(sagas);

export default class Root extends React.Component {
    render() {
        return (
            <Provider store={store}>
                <App/>
            </Provider>
        );
    }

    componentDidMount(): void {
        WeChat.registerApp(WeChatAppId, WeChatUniversalLink).then(res => {
            console.log('wecahtApp registered');
            //console.log(res);
        }).catch(reason => {
            console.log(reason);
        });
    }
}
